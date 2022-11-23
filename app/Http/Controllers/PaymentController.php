<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use shopid\zarinPal;

class PurchaseController extends Controller
{
    public function zarinpalPay(Order $order)
    {
        $payment = Payment::create([
            'order_id' => $order->id,
            'bank' => 'zarinpal',
        ]);

        $zarinpal = new zarinPal();
    }
}
