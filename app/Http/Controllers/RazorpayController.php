<?php

namespace App\Http\Controllers;

use Razorpay\Api\Api;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class RazorpayController extends Controller
{
    public function index()
    {
        try {
            return view('razorpay.index');
        } catch (\Throwable $th) {
            Log::error('PAYMENT_INDEX_ERROR'.$th->getMessage());
            return back()->with('error', 'An unexpected error occurred. Please try again.');
        }
    } 

    /**
     * Create a new Razorpay order.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function createOrder(Request $request): JsonResponse
    {
        // Check authentication
        if (!auth()->check()) {
            return response()->json(['success' => false, 'message' => 'Authentication required'], 401);
        }

        if (!auth()->user()->profile) {
            return response()->json(['success' => false, 'message' => 'User profile not found'], 404);
        }

        $request->validate([
            'package_id' => 'required|exists:packages,id',
        ]);

        try {
            $package = Package::findOrFail($request->package_id);
            $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));

            // Razorpay expects the amount in paise as an *integer*. If the package price
            // is stored as a float it may result in a non-integer value (e.g. 999.99 * 100).
            // This will cause Razorpay to throw an "amount should be integer" error.
            // Casting the calculated value to int guarantees that we always send an integer.
            $amount = (int) round($package->price * 100);

            if ($amount <= 0) {
                Log::warning('RAZORPAY_CREATE_ORDER_INVALID_AMOUNT', ['package_id' => $package->id, 'calculated_amount' => $amount]);
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid package amount configured. Please contact support.'
                ], 422);
            }

            $orderData = [
                'receipt'         => 'rcptid_' . uniqid(),
                'amount'          => $amount, // amount in the smallest currency unit (paise)
                'currency'        => 'INR',
                'payment_capture' => 1 // auto capture
            ];

            $razorpayOrder = $api->order->create($orderData);

            // Create a pending profile_packages row to track this order (NULL status = pending)
            // Only if the user has a profile (user flow). Admin flow should continue to use admin controller.
            if (auth()->check() && auth()->user()->profile) {
                DB::table('profile_packages')->insert([
                    'profile_id'      => auth()->user()->profile->id,
                    'package_id'      => $package->id,
                    'tokens_received' => 0, // will be updated on success
                    'tokens_used'     => 0,
                    'starts_at'       => null,
                    'expires_at'      => null,
                    'order_id'        => $razorpayOrder['id'],
                    'payment_ref_id'  => null,
                    'status'          => false, // false means pending
                    'created_at'      => now(),
                    'updated_at'      => now(),
                ]);
            }

            return response()->json([
                'success'       => true,
                'order_id'      => $razorpayOrder['id'],
                'amount'        => $razorpayOrder['amount'],
                'currency'      => 'INR',
                'key'           => config('services.razorpay.key'),
                'name'          => $package->name,
                'description'   => "Purchase " . $package->name,
                'prefill'       => [
                    'name'      => auth()->user()->name ?? '',
                    'email'     => auth()->user()->email ?? ''
                ]
            ]);
        } catch (\Exception $e) {
            Log::error('RAZORPAY_CREATE_ORDER_ERROR: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Could not create order.'], 500);
        }
    }

    /**
     * Verify the Razorpay payment and process the package purchase.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function verifyPayment(Request $request): JsonResponse
    {
        // Check authentication
        if (!auth()->check()) {
            return response()->json(['success' => false, 'message' => 'Authentication required'], 401);
        }

        if (!auth()->user()->profile) {
            return response()->json(['success' => false, 'message' => 'User profile not found'], 404);
        }

        $request->validate([
            'razorpay_payment_id' => 'required|string',
            'razorpay_order_id'   => 'required|string',
            'razorpay_signature'  => 'required|string',
            'package_id'          => 'required|exists:packages,id',
        ]);

        try {
            $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));
            $api->utility->verifyPaymentSignature([
                'razorpay_order_id'   => $request->razorpay_order_id,
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'razorpay_signature'  => $request->razorpay_signature
            ]);

            // Fetch the payment to check its status
            $paymentId = $request->razorpay_payment_id;
            $payment = $api->payment->fetch($paymentId);
            $order = $api->order->fetch($request->razorpay_order_id);
            $amount = $order->amount;
           

            // Check if payment is already captured
            if ($payment->status === 'captured') {
                Log::info('Payment already captured, proceeding with package processing', ['payment_id' => $paymentId]);
            } else {
                // Attempt to capture the payment if not already captured
                $captureResponse = $payment->capture(['amount' => $amount, 'currency' => 'INR']);
                Log::info('Payment captured successfully', ['payment_id' => $paymentId, 'capture_response' => $captureResponse->toArray()]);
            }
            
            // Display the payment details for debugging
            
        } catch (\Exception $e) {
            Log::error('RAZORPAY_SIGNATURE_VERIFICATION_FAILED: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Payment verification failed: ' . $e->getMessage()], 400);
        }

        DB::beginTransaction();
        try {
            $user = auth()->user()->profile;
            $package = Package::find($request->package_id);

            if (!$user || !$package) {
                DB::rollBack();
                Log::error('Payment successful but user or package not found.', ['user_id' => auth()->id(), 'package_id' => $request->package_id]);
                return response()->json(['success' => false, 'message' => 'User or Package not found.'], 404);
            }

            // Find and update existing pending record or create new one
            $existingRecord = DB::table('profile_packages')
                ->where('order_id', $request->razorpay_order_id)
                ->where('profile_id', $user->id)
                ->first();

            if ($existingRecord) {
                // Update existing pending record
                DB::table('profile_packages')
                    ->where('id', $existingRecord->id)
                    ->update([
                        'tokens_received' => $package->tokens,
                        'starts_at'       => now(),
                        'expires_at'      => now()->addDays($package->validity),
                        'payment_ref_id'  => $request->razorpay_payment_id,
                        'status'          => true,
                        'updated_at'      => now()
                    ]);
                $profilePackageId = $existingRecord->id;
            } else {
                // Create new record if none exists
                $profilePackageId = DB::table('profile_packages')->insertGetId([
                    'profile_id'      => $user->id,
                    'package_id'      => $package->id,
                    'tokens_received' => $package->tokens,
                    'tokens_used'     => 0,
                    'starts_at'       => now(),
                    'expires_at'      => now()->addDays($package->validity),
                    'order_id'        => $request->razorpay_order_id,
                    'payment_ref_id'  => $request->razorpay_payment_id,
                    'status'          => true,
                    'created_at'      => now(),
                    'updated_at'      => now()
                ]);
            }

            $user->profile_package_id = $profilePackageId;
            $user->available_tokens += $package->tokens;
            $user->save();

            DB::commit();
            Session::put('success', 'Payment Successful! Package purchased.');

            Log::info('Package purchase successful', [
                'user_id'    => auth()->id(),
                'package_id' => $request->package_id,
                'order_id'   => $request->razorpay_order_id,
                'payment_id' => $request->razorpay_payment_id,
                'amount'     => $package->price
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Payment successful and package purchased',
                'package' => [
                    'name'       => $package->name,
                    'tokens'     => $package->tokens,
                    'expires_at' => now()->addDays($package->validity)->format('d-m-Y H:i:s')
                ]
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('PAYMENT_PROCESS_ERROR: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            Session::put('error', $e->getMessage());
            return response()->json(['success' => false, 'error' => 'Payment processing error: ' . $e->getMessage()], 500);
        }
    }

    public function failure(Request $request): JsonResponse
    {
        $data = $request->input('response');
        $errorMessage = $data['error']['description'] ?? 'Unknown error';
        $errorCode = $data['error']['code'] ?? 'N/A';
        $paymentId = $data['error']['metadata']['payment_id'] ?? 'N/A';
        $orderId = $data['error']['metadata']['order_id'] ?? 'N/A';

        Log::error('RAZORPAY_PAYMENT_FAILED', [
            'error_code' => $errorCode,
            'error_message' => $errorMessage,
            'payment_id' => $paymentId,
            'order_id' => $orderId,
        ]);

        return response()->json(['success' => false, 'message' => 'Payment failed and logged.']);
    }

    public function pay($packageId)
    {
        $package = \App\Models\Package::findOrFail($packageId);
        return view('razorpay.index', compact('package'));
    }
}