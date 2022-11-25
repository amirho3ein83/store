<?php

namespace App\Http\Controllers;

use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Evryn\LaravelToman\Facades\Toman;

class WalletController extends Controller
{
    public function increaseWalletBalance(Request $request)
    {

        $request = Toman::amount(1000)
            ->description('Subscribing to Plan A')
            // ->callback(route('payment.callback'))
            ->mobile('09350000000')
            ->email('amirreza@example.com')
            ->request();

        if ($request->successful()) {
            // Store created transaction details for verification
            $transactionId = $request->transactionId();

            $res =   Wallet::where('user_id', Auth::id())->increment('balance', $request->increaseAmount);
            $new_val = $request->increaseAmount;
            if (!$res) {
                return response()->json([
                    'message' => 'failure',
                ], 400);
            } else {
                return response()->json([
                    'message' => 'success',
                    'new_val' => $new_val
                ], 200);

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
    }
}
