<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Evryn\LaravelToman\CallbackRequest;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Evryn\LaravelToman\Facades\Toman;

class WalletController extends Controller
{


    public function walletChargeRequest($amount)
    {
        $transaction = Transaction::updateOrCreate(
            ['payer_id' => Auth::id(), 'for' => 'Wallet', 'status' => 'Pending'],
            ['amount' => $amount],
        );
    }

    public function walletPaymentRequest()
    {

        $transaction = Transaction::where(
            [
                'payer_id' => Auth::id(), 'for' => 'Wallet', 'status' => 'Pending',
            ],
        )->first();

        $request = Toman::amount($transaction->amount)
            ->description('charging wallet for ' . Auth::user()->name)
            ->callback(route('wallet.payment.callback'))
            // ->mobile(Auth::user()->mobile)
            // ->email(Auth::user()->email)
            ->request();

        if ($request->successful()) {

            $transaction->transaction_id = $request->transactionId();
            $transaction->save();

            // Redirect to payment URL
            return $request->pay();
        }

        if ($request->failed()) {
            $transaction->status = 'Failed';
        }
    }



    /**
     * Handle payment callback
     */
    public function walletPaymentCallback(CallbackRequest $request)
    {
        // Use $request->transactionId() to match the payment record stored
        // in your persistence database and get expected amount, which is required
        // for verification. Take care of Double Spending.

        $transaction = Transaction::where(
            [
                'payer_id' => Auth::id(), 'for' => 'Wallet'
            ],
        )->latest()->first();

        $payment = $request->amount($transaction->amount)->verify();

        if ($payment->successful()) {
            // Store the successful transaction details
            $transaction->status = 'Successful';
            $transaction->reference_id = $payment->referenceId();
            $transaction->save();

            Wallet::where('user_id', Auth::id())->increment('balance', $transaction->amount);

            return redirect()->route('user.wallet')->with(['message' => 'successful', 'new_val' => $transaction->amount]);
        }

        if ($payment->alreadyVerified()) {
            var_dump('alreadyVerified');
        }

        if ($payment->failed()) {
            $transaction->status = 'Failed';
            $transaction->save();
            return redirect()->route('user.wallet');
        }
    }
}
