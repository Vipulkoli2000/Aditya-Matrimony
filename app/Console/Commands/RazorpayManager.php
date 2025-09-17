<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Razorpay\Api\Api;
use App\Models\Package;

class RazorpayManager extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'razorpay:manage --action=check-payments';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check pending Razorpay payments and update their statuses';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🚀 Starting Razorpay Payment Status Check...');
        $this->info('Time: ' . now()->format('Y-m-d H:i:s'));
        $this->line('━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━');

        try {
            $results = $this->checkPaymentStatus();
            $this->displaySummary($results);
            
            Log::info('Razorpay payment check completed successfully', $results);
            return 0;

        } catch (\Exception $e) {
            $this->error('❌ Critical error in Razorpay payment check: ' . $e->getMessage());
            Log::error('Razorpay payment check failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return 1;
        }
    }

    /**
     * Check and update pending payment statuses
     */
    private function checkPaymentStatus(): array
    {
        $this->info('🔍 Checking Pending Payment Statuses...');
        
        try {
            $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));

            // Get pending payments (status = null) that are older than 5 minutes but newer than 7 days
            $pendingPayments = DB::table('profile_packages')
                ->whereNull('status')
                ->whereNotNull('order_id')
                ->where('created_at', '<', now()->subMinutes(5))
                ->where('created_at', '>', now()->subDays(7))
                ->get();

            $this->info("   📋 Found {$pendingPayments->count()} pending payments to check");

            $updated = 0;
            $failed = 0;
            $processed = 0;

            foreach ($pendingPayments as $profilePackage) {
                $processed++;
                
                try {
                    $this->line("   🔄 Processing order #{$processed}: {$profilePackage->order_id}");
                    
                    $order = $api->order->fetch($profilePackage->order_id);
                    $payments = $order->payments();

                    if ($payments['count'] > 0) {
                        $payment = $payments['items'][0];
                        
                        if ($payment['status'] === 'captured') {
                            // Payment successful - update records
                            if ($this->processSuccessfulPayment($profilePackage, $payment)) {
                                $updated++;
                                $this->info("     ✅ Payment successful - tokens granted");
                            }
                        } elseif (in_array($payment['status'], ['failed', 'error'])) {
                            // Payment failed
                            DB::table('profile_packages')
                                ->where('id', $profilePackage->id)
                                ->update([
                                    'status' => false,
                                    'updated_at' => now()
                                ]);
                            
                            $failed++;
                            $this->warn("     ❌ Payment failed - marked as failed");
                        } else {
                            $this->line("     ⏳ Payment pending - status: {$payment['status']}");
                        }
                    } else {
                        // No payments found - check if order is too old
                        $hoursOld = now()->diffInHours($profilePackage->created_at);
                        if ($hoursOld > 24) {
                            DB::table('profile_packages')
                                ->where('id', $profilePackage->id)
                                ->update([
                                    'status' => false,
                                    'updated_at' => now()
                                ]);
                            
                            $failed++;
                            $this->warn("     ⏰ Order expired ({$hoursOld}h old) - marked as failed");
                        } else {
                            $this->line("     ⌛ No payments yet - order is {$hoursOld}h old");
                        }
                    }
                    
                    // Small delay to avoid API rate limits
                    usleep(200000); // 0.2 seconds
                    
                } catch (\Exception $e) {
                    $this->error("     ❌ Error checking order: " . $e->getMessage());
                    Log::error('Payment status check error', [
                        'order_id' => $profilePackage->order_id,
                        'error' => $e->getMessage()
                    ]);
                }
            }

            $this->info("✅ Payment status check completed!");
            $this->info("   📊 Processed: {$processed} | Updated: {$updated} | Failed: {$failed}");

            return [
                'processed' => $processed,
                'successful_updates' => $updated,
                'failed_payments' => $failed,
                'total_checked' => $pendingPayments->count()
            ];

        } catch (\Exception $e) {
            $this->error('❌ Payment status check failed: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Process a successful payment
     */
    private function processSuccessfulPayment($profilePackage, $payment): bool
    {
        try {
            $package = Package::find($profilePackage->package_id);
            
            if (!$package) {
                $this->error("     ❌ Package not found: {$profilePackage->package_id}");
                return false;
            }

            DB::beginTransaction();
            
            // Update profile_packages record
            DB::table('profile_packages')
                ->where('id', $profilePackage->id)
                ->update([
                    'tokens_received' => $package->tokens,
                    'starts_at' => now(),
                    'expires_at' => now()->addDays($package->validity),
                    'payment_ref_id' => $payment['id'],
                    'status' => true,
                    'updated_at' => now()
                ]);

            // Update user's profile with tokens and package
            $profile = DB::table('profiles')->where('id', $profilePackage->profile_id)->first();
            if ($profile) {
                DB::table('profiles')
                    ->where('id', $profilePackage->profile_id)
                    ->update([
                        'profile_package_id' => $profilePackage->id,
                        'available_tokens' => ($profile->available_tokens ?? 0) + $package->tokens,
                        'updated_at' => now()
                    ]);
            }

            DB::commit();
            
            Log::info('Payment processed successfully via cronjob', [
                'order_id' => $profilePackage->order_id,
                'payment_id' => $payment['id'],
                'profile_id' => $profilePackage->profile_id,
                'package_name' => $package->name,
                'tokens_granted' => $package->tokens
            ]);

            return true;

        } catch (\Exception $e) {
            DB::rollBack();
            $this->error("     ❌ Database error: " . $e->getMessage());
            Log::error('Payment processing failed', [
                'order_id' => $profilePackage->order_id,
                'error' => $e->getMessage()
            ]);
            return false;
        }
    }


    /**
     * Display execution summary
     */
    private function displaySummary(array $results): void
    {
        $this->line('━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━');
        $this->info('📋 EXECUTION SUMMARY');
        $this->line('━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━');
        
        $this->info("💳 Payment Check Results:");
        $this->line("   • Payments processed: {$results['processed']}");
        $this->line("   • Successfully updated: {$results['successful_updates']}");
        $this->line("   • Failed payments: {$results['failed_payments']}");

        $this->line('');
        $this->info('✅ Razorpay Management Completed Successfully!');
        $this->info('⏰ Finished at: ' . now()->format('Y-m-d H:i:s'));
    }
}
