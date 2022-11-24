<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Services\zarinPal;

class PaymentController extends Controller
{
    public function zarinpalPay(Order $order)
    {
        $payment = Payment::create([
            'order_id' => $order->id,
            'bank' => 'zarinpal',
        ]);

        $zarinpal = new zarinPal([
            'merchantId' => '12369874156985214563258745632555'
        ]);

        try {
            $request = $zarinpal->apiRequest([
                'callbackurl' => 'http://localhost:8000/order/' . $order->id . '/details',
                // if the currency is Rial strike 10   total *10
                'amount' => 'paying for order by id :' . $order->id,
                'description' => $order->billing_total,
                'mobile' => $order->buyer()->mobile ?? null,
                'email' => $order->buyer()->email ?? null,
            ]);

            $payment->request_info = $request;
            $payment->save();

            $decodedRequest = json_decode($request);

            return redirect()->intended($decodedRequest->url);
        } catch (\Throwable $th) {
            var_dump(json_decode($th->getMessage()));
        }
    }

    
    public function zarinpalVerify(Payment $payment)
    {

        $zarinpal = new zarinPal([
            'merchantId' => '12369874156985214563258745632555'
        ]);

        $order = Order::find($payment->order_id);

        $reqInfo = json_decode($payment->request_info);



        try {

            $verify = $zarinpal->verify([
                'authority' => $reqInfo->authority,
                'amount' => $order->billing_total,
            ]);

            $decodedVerify = json_decode($verify);

            if ($decodedVerify->code == 100 || $decodedVerify->code == 101) {
                $payment->status = 'paid';
            }

            $payment->verify_info = $verify;
        } catch (\Throwable $th) {
            $payment->verify_info = $th->getMessage();
        }

        $payment->save();
    }
}
