<?php

namespace App\Http\Controllers;

use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WalletController extends Controller
{
    public function increaseWalletBalance(Request $request)
    {
        $res =   Wallet::where('user_id', Auth::id())->increment('stock', $request->increaseAmount);
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
        }
    }
}
