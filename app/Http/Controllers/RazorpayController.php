<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Razorpay\Api\Api;

class RazorpayController extends Controller
{
    public function index(): View
    {
        try {
            return view('razorpay.index');
        } catch (\Throwable $th) {
            Log::error('PAYMENT_INDEX_ERROR'.$th->getMessage());
        }
    } 

    public function store(Request $request): JsonResponse
    {
        DB::beginTransaction();

        try {
            // Accept razorpay_payment_id and package_id directly
            $razorpayPaymentId = $request->input('razorpay_payment_id');
            $packageId = $request->input('package_id');

            if (empty($razorpayPaymentId)) {
                Log::error('Payment failed: No payment ID found');
                Session::put('error', 'No Payment ID Found');
                return response()->json(['success' => false, 'message' => 'No Payment ID Found'], 400);
            }

            if (empty($packageId)) {
                Log::error('Payment failed: No package ID found');
                Session::put('error', 'No Package ID Found');
                return response()->json(['success' => false, 'message' => 'No Package ID Found'], 400);
            }

            $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));
            $payment = $api->payment->fetch($razorpayPaymentId);
            $response = $payment->capture(['amount' => $payment['amount']]);
            
            // Assign the purchased package to the user using the correct pivot/attach logic
            $user = auth()->user()->profile;
            $package = \App\Models\Package::find($packageId);
            
            if (!$user) {
                Log::error('Payment successful but user profile not found: ' . auth()->id());
                DB::rollBack();
                return response()->json(['success' => false, 'message' => 'User profile not found'], 404);
            }
            
            if (!$package) {
                Log::error('Payment successful but package not found: ' . $packageId);
                DB::rollBack();
                return response()->json(['success' => false, 'message' => 'Package not found'], 404);
            }

            // Create profile package record using direct DB insert instead of attach() method
            $profilePackageId = DB::table('profile_packages')->insertGetId([
                'profile_id' => $user->id,
                'package_id' => $package->id,
                'tokens_received' => $package->tokens,
                'tokens_used' => 0,
                'starts_at' => now(),
                'expires_at' => now()->addDays($package->validity),
                'order_id' => $response->id,
                'payment_ref_id' => $response->id,
                'status' => true,
                'created_at' => now(),
                'updated_at' => now()
            ]);
            
            // No need to query for the profile package since we already have the ID
            $user->profile_package_id = $profilePackageId;
            
            // Update available tokens
            $user->available_tokens += $package->tokens;
            $user->save();

            Log::info('Package purchase successful', [
                'user_id' => auth()->id(),
                'package_id' => $packageId,
                'payment_id' => $response->id,
                'amount' => $response->amount / 100
            ]);

            Session::put('success', 'Payment Successful! Package purchased.');
            DB::commit();

            return response()->json([
                'success' => true, 
                'message' => 'Payment successful and package purchased',
                'package' => [
                    'name' => $package->name,
                    'tokens' => $package->tokens,
                    'expires_at' => now()->addDays($package->validity)->format('Y-m-d H:i:s')
                ]
            ]);

        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error('PAYMENT_STORE_ERROR: ' . $th->getMessage(), ['trace' => $th->getTraceAsString()]);
            Session::put('error', $th->getMessage());

            return response()->json(['success' => false, 'error' => 'Payment processing error: ' . $th->getMessage()], 500);
        }
    }

    public function failure(Request $request): JsonResponse {
        DB::beginTransaction();

        try {
            $responseData = $request->input('response', []);
            $errorData = $responseData['error'] ?? [];

            DB::commit();
            return response()->json(['success' => true, 'message' => 'Payment failure recorded']);

        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error('PAYMENT_FAILURE_ERROR: '.$th->getMessage());
            return response()->json(['success' => false, 'error' => 'Internal Server Error'], 500);
        }
    }

    public function pay($packageId)
    {
        $package = \App\Models\Package::findOrFail($packageId);
        return view('razorpay.index', compact('package'));
    }
    
    /**
     * Process the Razorpay payment coming from the AJAX request
     */
    public function payment(Request $request)
    {
        DB::beginTransaction();

        try {
            // Get the payment ID and package ID from the request
            $razorpayPaymentId = $request->input('razorpay_payment_id');
            $packageId = $request->input('package_id');

            if (empty($razorpayPaymentId)) {
                Log::error('Payment failed: No payment ID found');
                Session::put('error', 'No Payment ID Found');
                return response()->json(['success' => false, 'message' => 'No Payment ID Found'], 400);
            }

            if (empty($packageId)) {
                Log::error('Payment failed: No package ID found');
                Session::put('error', 'No Package ID Found');
                return response()->json(['success' => false, 'message' => 'No Package ID Found'], 400);
            }

            // Verify the payment status with Razorpay before capturing
            $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));
            $payment = $api->payment->fetch($razorpayPaymentId);
            
            // Make sure payment exists and is authorized
            if (!$payment || $payment->status !== 'authorized') {
                Log::error('Payment failed: Payment not authorized', ['status' => $payment->status ?? 'unknown']);
                DB::rollBack();
                return response()->json(['success' => false, 'message' => 'Payment not authorized by gateway'], 400);
            }
            
            // Capture the payment
            $response = $payment->capture(['amount' => $payment['amount']]);
            
            // Purchase the package for the user
            $user = auth()->user()->profile;
            $package = \App\Models\Package::find($packageId);
            
            if (!$user) {
                Log::error('Payment successful but user profile not found: ' . auth()->id());
                DB::rollBack();
                return response()->json(['success' => false, 'message' => 'User profile not found'], 404);
            }
            
            if (!$package) {
                Log::error('Payment successful but package not found: ' . $packageId);
                DB::rollBack();
                return response()->json(['success' => false, 'message' => 'Package not found'], 404);
            }

            // Create profile package record using direct DB insert instead of attach() method
            $profilePackageId = DB::table('profile_packages')->insertGetId([
                'profile_id' => $user->id,
                'package_id' => $package->id,
                'tokens_received' => $package->tokens,
                'tokens_used' => 0,
                'starts_at' => now(),
                'expires_at' => now()->addDays($package->validity),
                'order_id' => $response->id,
                'payment_ref_id' => $response->id,
                'status' => true,
                'created_at' => now(),
                'updated_at' => now()
            ]);
            
            // No need to query for the profile package since we already have the ID
            $user->profile_package_id = $profilePackageId;
            
            // Update available tokens
            $user->available_tokens += $package->tokens;
            $user->save();
            
            Session::put('success', 'Payment Successful! Package purchased.');
            DB::commit();

            Log::info('Package purchase successful', [
                'user_id' => auth()->id(),
                'package_id' => $packageId,
                'payment_id' => $response->id,
                'amount' => $response->amount / 100
            ]);

            return response()->json([
                'success' => true, 
                'message' => 'Payment successful and package purchased',
                'package' => [
                    'name' => $package->name,
                    'tokens' => $package->tokens,
                    'expires_at' => now()->addDays($package->validity)->format('Y-m-d H:i:s')
                ]
            ]);

        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error('PAYMENT_PROCESS_ERROR: ' . $th->getMessage(), ['trace' => $th->getTraceAsString()]);
            Session::put('error', $th->getMessage());

            return response()->json(['success' => false, 'error' => 'Payment processing error: ' . $th->getMessage()], 500);
        }
    }
}