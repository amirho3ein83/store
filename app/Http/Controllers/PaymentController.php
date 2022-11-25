<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Services\zarinPal;
use Evryn\LaravelToman\CallbackRequest;
use Evryn\LaravelToman\Facades\Toman;

class PaymentController extends Controller
{
    /**
     * Handle payment request
     */
    public function payRequest()
    {
        $request = Toman::amount(1000)
            ->description('Subscribing to Plan A')
            ->callback(route('payment.callback'))  
            ->mobile('09350000000')
            ->email('amirreza@example.com')
            ->request();


        if ($request->successful()) {
            $transactionId = $request->transactionId();
            // Store created transaction details for verification

            return $request->pay(); // Redirect to payment URL
        }

        if ($request->failed()) {
            // Handle transaction request failure; Probably showing proper error to user.
        }
    }
    /**
     * Handle payment callback
     */
    public function paymentCallback(CallbackRequest $request)
    {
        // Use $request->transactionId() to match the payment record stored
        // in your persistence database and get expected amount, which is required
        // for verification. Take care of Double Spending.

        $payment = $request->amount(1000)->verify();

        if ($payment->successful()) {
            // Store the successful transaction details
            // $referenceId = $payment->referenceId();

            return redirect()->to('/user/profile/wallet');
        }

        if ($payment->alreadyVerified()) {
            return redirect()->to('/user/profile/wallet');
        }

        if ($payment->failed()) {
            // ...
        }
    }
}
    
