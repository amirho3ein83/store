<?php

namespace App\Http\Controllers;

use Evryn\LaravelToman\CallbackRequest;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Evryn\LaravelToman\Facades\Toman;

class WalletController extends Controller
{
    public function walletPaymentRequest()
    {

        $request = Toman::amount(140000)
            ->description('Subscribing to Plan A')
            ->callback(route('payment.callback'))
            ->mobile('09350000000')
            ->email('amirreza@example.com')
            ->request();


        // $request = Toman::amount($amount)
        //     ->description('درگاه یرداخن برای شارژ کیف بول')
        //     ->callback(route('payment.callback'))
        //     ->mobile('09350000000')
        //     ->email('amirreza@example.com')
        //     ->request();

        if ($request->successful()) {
            // Store created transaction details for verification
            $transactionId = $request->transactionId();

            // Redirect to payment URL
            return $request->pay();
        }

        if ($request->failed()) {
            // Handle transaction request failure.
        }




        // $res =   Wallet::where('user_id', Auth::id())->increment('balance', $request->increaseAmount);
        // $new_val = $request->increaseAmount;
        // if (!$res) {
        //     return response()->json([
        //         'message' => 'failure',
        //     ], 400);
        // } else {
        //     return response()->json([
        //         'message' => 'success',
        //         'new_val' => $new_val
        //     ], 200);
        // }
    }



    /**
     * Handle payment callback
     */
    public function walletPaymentCallback(CallbackRequest $request)
    {
        // Use $request->transactionId() to match the payment record stored
        // in your persistence database and get expected amount, which is required
        // for verification. Take care of Double Spending.

        $payment = $request->amount(1000)->verify();

        if ($payment->successful()) {
            // Store the successful transaction details
            $referenceId = $payment->referenceId();
        }

        if ($payment->alreadyVerified()) {
            // ...
        }

        if ($payment->failed()) {
            // ...
        }
    }
}
