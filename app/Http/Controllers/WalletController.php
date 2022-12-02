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
            ['payer_id' => Auth::id(), 'transactionـfor' => 'Wallet', 'payment_status' => 'Pending'],
            ['amount' => $amount],
        );
    }

    public function transferToPaymentGateway()
    {

        $transaction = Transaction::where(
            [
                'payer_id' => Auth::id(), 'transactionـfor' => 'Wallet', 'payment_status' => 'Pending',
            ],
        )->first();

        $request = Toman::amount($transaction->amount)
            ->description('افزایش اعتبار کیف پول ' . Auth::user()->name)
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

    public function confirmWalletChargePayment(CallbackRequest $request)
    {
        // Use $request->transactionId() to match the payment record stored
        // in your persistence database and get expected amount, which is required
        // for verification. Take care of Double Spending.

        $transaction = Transaction::where(
            [
                'payer_id' => Auth::id(), 'transactionـfor' => 'Wallet'
            ],
        )->latest()->first();

        $payment = $request->amount($transaction->amount)->verify();

        if ($payment->successful()) {
            // Store the successful transaction details
            $transaction->payment_status = Transaction::PAYMENT_STATUS_PAID;
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
