<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SubscriptionController extends Controller
{
   
    public function __construct()
    {
        
    }

    public function index()
    {
        return view('pages.subscription');
    }

    public function initiatePayment(Request $request)
    {
        $request->validate([
            'plan' => 'required|in:basic,premium,pro',
        ]);

        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to subscribe');
        }

        $planPrices = [
            'basic' => 999.00,
            'premium' => 1999.00,
            'pro' => 2999.00,
        ];

        $planNames = [
            'basic' => 'CarGo Basic',
            'premium' => 'CarGo Premium',
            'pro' => 'CarGo Pro',
        ];

        $amount = $planPrices[$request->plan];
        $planName = $planNames[$request->plan];

        // Create subscription record
        $subscription = Subscription::create([
            'user_id' => Auth::id(),
            'plan_name' => $request->plan,
            'amount' => $amount,
            'currency' => 'BDT',
            'status' => 'pending',
        ]);

        $storeId = env('SSLC_STORE_ID', 'cargo64d5f5ccd6fbc');
        $storePassword = env('SSLC_STORE_PASSWORD', 'cargo64d5f5ccd6fbc@ssl');
        $isSandbox = env('SSLC_IS_SANDBOX', true);
        
        $baseUrl = $isSandbox 
            ? 'https://sandbox.sslcommerz.com/gwprocess/v4/api.php' 
            : 'https://securepay.sslcommerz.com/gwprocess/v4/api.php';

        // Use absolute URLs
        $postData = [
            'store_id' => $storeId,
            'store_passwd' => $storePassword,
            'total_amount' => $amount,
            'currency' => 'BDT',
            'tran_id' => 'CARGO' . $subscription->id . '_' . time(),
            'success_url' => url('subscription/success'),
            'fail_url' => url('subscription/fail'),
            'cancel_url' => url('subscription/cancel'),
            'cus_name' => Auth::user()->name,
            'cus_email' => Auth::user()->email,
            'cus_add1' => Auth::user()->address ?? 'N/A',
            'cus_add2' => '',
            'cus_city' => 'Dhaka',
            'cus_state' => 'Dhaka',
            'cus_postcode' => '1000',
            'cus_country' => 'Bangladesh',
            'cus_phone' => Auth::user()->phone ?? '01700000000',
            'product_name' => $planName,
            'product_category' => 'Subscription',
            'product_profile' => 'general',
            'shipping_method' => 'NO',
            'num_of_item' => 1,
            'multi_card_name' => '',
            'value_a' => (string)$subscription->id,
            'value_b' => (string)Auth::id(),
        ];

        $subscription->update([
            'transaction_id' => $postData['tran_id'],
        ]);

        $response = Http::asForm()->post($baseUrl, $postData);

        if ($response->successful()) {
            $data = $response->json();
            
            if (isset($data['status']) && $data['status'] === 'SUCCESS') {
                return redirect($data['GatewayPageURL']);
            } else {
                return back()->with('error', 'Payment initiation failed. Please try again.');
            }
        }

        return back()->with('error', 'Unable to connect to payment gateway. Please try again.');
    }

    public function success(Request $request)
    {

        file_put_contents(storage_path('logs/sslcommerz_success.txt'), 
            date('Y-m-d H:i:s') . "\n" . 
            "Method: " . $request->method() . "\n" .
            "Data: " . json_encode($request->all(), JSON_PRETTY_PRINT) . "\n\n",
            FILE_APPEND
        );

        try {
            $transactionId = $request->input('tran_id', $request->input('value_a'));
            
            if (!$transactionId) {
                return $this->simpleRedirect('home', 'Invalid payment response.');
            }

            $subscriptionId = $request->input('value_a');
            
            if (!$subscriptionId && $transactionId) {
                if (strpos($transactionId, 'CARGO') !== false) {
                    $parts = explode('_', $transactionId);
                    $subscriptionId = str_replace('CARGO', '', $parts[0]);
                }
            }
            
            if (!$subscriptionId) {
                return $this->simpleRedirect('home', 'Unable to identify subscription.');
            }

            $subscription = Subscription::find($subscriptionId);

            if (!$subscription) {
                return $this->simpleRedirect('home', 'Subscription not found.');
            }

            
            if (!Auth::check() && $subscription->user_id) {
                Auth::loginUsingId($subscription->user_id);
            }

            if ($subscription->status === 'success') {
                return $this->simpleRedirect('subscription.index', 'This subscription is already active.', 'info');
            }

            $storeId = env('SSLC_STORE_ID', 'cargo64d5f5ccd6fbc');
            $storePassword = env('SSLC_STORE_PASSWORD', 'cargo64d5f5ccd6fbc@ssl');
            $isSandbox = env('SSLC_IS_SANDBOX', true);
            
            $verifyUrl = $isSandbox 
                ? 'https://sandbox.sslcommerz.com/validator/api/validationserverAPI.php' 
                : 'https://securepay.sslcommerz.com/validator/api/validationserverAPI.php';

            $valId = $request->input('val_id');
            
            if (!$valId) {
                $subscription->update([
                    'status' => 'pending',
                    'sslcommerz_response' => ['val_id_missing' => true],
                    'payment_details' => $request->all(),
                ]);
                
                return $this->simpleRedirect('subscription.index', 'Payment received. Verifying...', 'info');
            }

            $verifyData = [
                'val_id' => $valId,
                'store_id' => $storeId,
                'store_passwd' => $storePassword,
                'format' => 'json',
            ];

           
            if ($request->input('status') === 'VALID') {
                
                $subscription->update([
                    'status' => 'success',
                    'sslcommerz_tran_id' => $valId,
                    'payment_method' => $request->input('card_type', 'unknown'),
                    'card_brand' => $request->input('card_brand'),
                    'card_last_four' => $request->input('card_no') ? substr($request->input('card_no'), -4) : null,
                    'sslcommerz_response' => $request->all(),
                    'subscription_start_date' => now(),
                    'subscription_end_date' => now()->addYear(),
                    'payment_details' => $request->all(),
                ]);

                return redirect()->route('subscription.success.page')->with('success', 'Subscription activated successfully!');
            }

            
            $verifyResponse = Http::asForm()->post($verifyUrl, $verifyData);

            if ($verifyResponse->successful()) {
                $verifyResult = $verifyResponse->json();

                if (isset($verifyResult['status']) && $verifyResult['status'] === 'VALID') {
                    $subscription->update([
                        'status' => 'success',
                        'sslcommerz_tran_id' => $valId,
                        'payment_method' => $verifyResult['card_type'] ?? 'unknown',
                        'card_brand' => $verifyResult['card_brand'] ?? null,
                        'card_last_four' => isset($verifyResult['card_no']) ? substr($verifyResult['card_no'], -4) : null,
                        'sslcommerz_response' => $verifyResult,
                        'subscription_start_date' => now(),
                        'subscription_end_date' => now()->addYear(),
                        'payment_details' => $request->all(),
                    ]);

                    return $this->simpleRedirect('home', 'Subscription activated successfully!', 'success');
                } else {
                    $subscription->update([
                        'status' => 'failed',
                        'sslcommerz_response' => $verifyResult,
                        'payment_details' => $request->all(),
                    ]);
                    
                    return $this->simpleRedirect('subscription.index', 'Payment verification failed - Invalid status.');
                }
            }

            $subscription->update([
                'sslcommerz_response' => ['verification_failed' => true, 'reason' => 'Server verification API failed'],
                'payment_details' => $request->all(),
            ]);

            return $this->simpleRedirect('subscription.index', 'Payment verification API failed.');

        } catch (\Exception $e) {
            file_put_contents(storage_path('logs/sslcommerz_error.txt'), 
                date('Y-m-d H:i:s') . "\n" . 
                "Error: " . $e->getMessage() . "\n" .
                "Trace: " . $e->getTraceAsString() . "\n\n",
                FILE_APPEND
            );
            
            return $this->simpleRedirect('home', 'An error occurred. Please contact support.');
        }
    }

    public function fail(Request $request)
    {
        file_put_contents(storage_path('logs/sslcommerz_fail.txt'), 
            date('Y-m-d H:i:s') . "\n" . json_encode($request->all(), JSON_PRETTY_PRINT) . "\n\n",
            FILE_APPEND
        );

        $subscriptionId = $request->input('value_a');
        $userId = $request->input('value_b');
        
        
        if (!Auth::check() && $userId) {
            Auth::loginUsingId($userId);
        }
        
        if (!$subscriptionId && $request->input('tran_id')) {
            $transactionId = $request->input('tran_id');
            if (strpos($transactionId, 'CARGO') !== false) {
                $parts = explode('_', $transactionId);
                $subscriptionId = str_replace('CARGO', '', $parts[0]);
            }
        }
        
        if ($subscriptionId) {
            $subscription = Subscription::find($subscriptionId);
            
            if ($subscription) {
                $subscription->update([
                    'status' => 'failed',
                    'sslcommerz_response' => $request->all(),
                    'payment_details' => $request->all(),
                ]);
            }
        }

        return $this->simpleRedirect('subscription.index', 'Payment failed. Please try again.');
    }

    public function cancel(Request $request)
    {
        file_put_contents(storage_path('logs/sslcommerz_cancel.txt'), 
            date('Y-m-d H:i:s') . "\n" . json_encode($request->all(), JSON_PRETTY_PRINT) . "\n\n",
            FILE_APPEND
        );

        $subscriptionId = $request->input('value_a');
        $userId = $request->input('value_b');
        
        
        if (!Auth::check() && $userId) {
            Auth::loginUsingId($userId);
        }
        
        if (!$subscriptionId && $request->input('tran_id')) {
            $transactionId = $request->input('tran_id');
            if (strpos($transactionId, 'CARGO') !== false) {
                $parts = explode('_', $transactionId);
                $subscriptionId = str_replace('CARGO', '', $parts[0]);
            }
        }
        
        if ($subscriptionId) {
            $subscription = Subscription::find($subscriptionId);
            
            if ($subscription) {
                $subscription->update([
                    'status' => 'cancelled',
                    'sslcommerz_response' => $request->all(),
                    'payment_details' => $request->all(),
                ]);
            }
        }

        return $this->simpleRedirect('subscription.index', 'Payment cancelled.', 'info');
    }

    
    private function simpleRedirect($route, $message, $type = 'error')
    {
        return redirect()->route($route)->with($type, $message);
    }
}