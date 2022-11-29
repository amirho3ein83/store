<?php

namespace App\Http\Controllers;

use App\Jobs\SendUserInvoice;
use App\Mail\OrderPlaced;
use App\Models\Address;
use Evryn\LaravelToman\CallbackRequest;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Product;
use App\Models\RefOrder;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Wallet;
use App\Services\zarinPal;
use Evryn\LaravelToman\Facades\Toman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class OrderController extends Controller
{

    protected $_validation = [
        'recipient_name' => 'required_if:use_default_address,false',
        'mobile' => 'required_if:use_default_address,false',
        'address' => 'required_if:use_default_address,false',
        'zipcode' => 'required_if:use_default_address,false',
        'save_address_as_default ' => 'boolean',
        'use_default_address' => 'boolean',
    ];

    protected $_validationMessages = [
        'recipient_name.required_if' => ' نام لازم است',
        'mobile.required_if' => ' موبایل مورد نیاز است',
        'address.required_if' => ' آدرس مورد نیاز است',
        'zipcode.required_if' => ' کد پستی لازم است',
    ];

    public function index()
    {
        $order = Order::where('buyer_id', Auth::id())->pendingPayment()->with('items', 'address')->first();
        $orderItems = $order->items ?? null;
        if ($orderItems) {
            $orderItems->map(function ($item) {
                $image_url = $item->product->getFirstMedia()->getUrl();
                $item->product->image_url = $image_url;
                $item->product->en_price = $item->product->getRawOriginal('default_price');
            });

            $subtotal = 0;
            foreach ($orderItems as $key => $item) {
                $subtotal += $item->getRawOriginal('qty') * $item->product->getRawOriginal('default_price');
            }
        }

        $userAddress = Auth::user()->address;
        $walletBalance = Auth::user()->wallet->getRawOriginal('balance');

        return Inertia::render('Store/Cart', [
            'order' => $order ?? null,
            'subtotal' => $subtotal ?? null,
            'userAddress' => $userAddress ?? null,
            'walletBalance' => $walletBalance ?? null
        ]);
    }

    public function orderDetails(Order $order)
    {
        $order->load('items', 'items.product');

        $order->map(function ($order) {
            $order->items->map(function ($item) {
                $image_url = $item->product->getFirstMedia()->getUrl();
                $item->product->image_url = $image_url;
            });
        });

        return Inertia::render('Store/OrderShow', [
            'order' => $order
        ]);
    }

    public function addToCart(Request $request)
    {
        $order = Order::firstOrCreate(
            ['buyer_id' => Auth::id(), 'payment_status' => Order::PAYMENT_STATUS_PENDING],
            []
        );

        $product = Product::find($request->product_id);

        $found_in_cart = OrderItem::isInCart(
            $request->product_id,
            $request->picked_color,
            $request->picked_size,
        )
            ->first();

        if (!empty($found_in_cart)) {
            OrderItem::where('id', $found_in_cart->id)->increment('qty');
        } else {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'picked_color' => $request->picked_color,
                'picked_size' => $request->picked_size,
                'qty' => 1,
                'buyer_id' => Auth::id(),
                'payment_status' => 'pending'
            ]);
        }

        return response()->json([
            'message' => 'Order registered',
        ]);
    }

    public function switchToSaveForLater()
    {
    }
    public function increaseOrder($id)
    {
        OrderItem::where('product_id', $id)->pendingPayment()->increment('qty');
    }

    public function decreaseOrder($id)
    {
        OrderItem::where('product_id', $id)->pendingPayment()->decrement('qty');
    }

    public function deleteOrder($id)
    {
        OrderItem::where('product_id', $id)->pendingPayment()->delete();
    }

    public function countOrders(Product $product)
    {
        return  OrderItem::pendingPayment()->count();
    }


    public function finalizeOrderUsingWallet(Request $request, Order $order)
    {

        Validator::make($request->all(), $this->_validation, $this->_validationMessages)->validate();

        $order = Order::firstWhere(
            ['buyer_id' => Auth::id(), 'payment_status' => Order::PAYMENT_STATUS_PENDING]
        );

        try {
            DB::beginTransaction();

            $this->saveOrderAddress(
                $order,
                $request->address,
                $request->zipcode,
                $request->recipient_name,
                $request->mobile,
                $request->use_default_address = true,
                $request->save_address_as_default = false
            );

            $numbers = $this->getNumbers($order);

            $wallet = Wallet::firstWhere('user_id', Auth::id());

            $balance = $wallet->balance;

            if ($balance < $numbers['billingTotal']) {
                return redirect()->back()
                    ->withErrors('insufficient inventory');
            }

            Wallet::where('user_id', Auth::id())->decrement('balance', $numbers['billingTotal']);

            $this->setOrderPaid($order, $numbers);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            info($e);
            return response()->json([
                'error' => 'sth went wrong'
            ], 422);
        }


        // return response()->json([
        //     'message' => 'success'
        // ], 200);
    }






    public function orderPaymentRequest(Request $request)
    {

        Validator::make($request->all(), $this->_validation, $this->_validationMessages)->validate();

        $order = Order::firstWhere(
            ['buyer_id' => Auth::id(), 'payment_status' => Order::PAYMENT_STATUS_PENDING]
        );

        try {
            DB::beginTransaction();

            $this->saveOrderAddress(
                $order,
                $request->address,
                $request->zipcode,
                $request->recipient_name,
                $request->mobile,
                $request->use_default_address = true,
                $request->save_address_as_default = false
            );

            $numbers = $this->getNumbers($order);

            $transaction = Transaction::updateOrCreate(
                [
                    'payer_id' => Auth::id(),
                    'transactionـfor' => Transaction::TRANSACTION_FOR_ORDER,
                    'payment_status' => Transaction::PAYMENT_STATUS_PENDING
                ],
                ['amount' => $numbers['billingTotal']],
            );

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            info($e);
            return response()->json([
                'error' => 'sth went wrong'
            ], 422);
        }


        // return response()->json([
        //     'message' => 'success'
        // ], 200);
    }


    // Transfer to the payment gateway
    public function transferToPaymentGateway()
    {

        $transaction = Transaction::where(
            [
                'payer_id' => Auth::id(),
                'transactionـfor' => Transaction::TRANSACTION_FOR_ORDER,
                'payment_status' => Transaction::PAYMENT_STATUS_PENDING,
            ],
        )->first();

        $order = Order::firstWhere(
            ['buyer_id' => Auth::id(), 'payment_status' => 'pending']
        );

        $request = Toman::amount($transaction->amount)
            ->description($order->id . ' :پرداخت سفارش با شناسه ')
            ->callback(route('order.payment.callback'))
            ->mobile(Auth::user()->mobile)
            ->email(Auth::user()->email)
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

    public function confirmOrderPayment(CallbackRequest $request)
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

        if ($request->transactionId() != $transaction->transaction_id) {
            abort(422, 'شناسه تراکنش نامعتبر');
        }

        if ($payment->successful()) {
            // Store the successful transaction details
            $transaction->payment_status = Transaction::PAYMENT_STATUS_PAID;
            $transaction->reference_id = $payment->referenceId();
            $transaction->save();

            $order = Order::firstWhere(
                ['buyer_id' => Auth::id(), 'payment_status' => 'pending']
            );
            $numbers = $this->getNumbers($order);

            $this->setOrderPaid($order, $numbers);

            return redirect()->route('user.orders.list');
        }

        if ($payment->alreadyVerified()) {
            var_dump('alreadyVerified');
        }

        if ($payment->failed()) {
            $transaction->status = 'Failed';
            $transaction->save();
            return redirect()->route('user.orders.list');
        }
    }

    public function getNumbers($order)
    {
        $order->load('items');

        $billingSubtotal = 0;
        foreach ($order->items as $key => $orderItem) {
            $billingSubtotal += $orderItem->qty * $orderItem->product->getRawOriginal('default_price');
        }

        $billingTax = env('TAX_PERCENT', 9) / 100 * $billingSubtotal;
        $billingTotal = $billingTax + $billingSubtotal;
        $billingTotal = (int)$billingTotal;


        if ($billingTotal >= env('MINIMUM_PURCHASE_FOR_FREE_SHOPPING', 500000)) {
            $deliveryCost = 0;
        } else {
            $deliveryCost = env('DELIRVERY_COST', 18000);
        }
        $billingTotal += $deliveryCost;


        $numbers['billingSubtotal'] = $billingSubtotal;
        $numbers['billingTax'] = $billingTax;
        $numbers['deliveryCost'] = $deliveryCost;
        $numbers['billingTotal'] = $billingTotal;

        return $numbers;
    }

    public function saveOrderAddress($order, $address, $zipcode, $recipient_name, $mobile, $use_default = true, $save_as_default = false)
    {
        if ($use_default) {

            $user = User::find(Auth::id());

            $orderAddress = $user->address->replicate()->fill([
                'addressable_id' => $order->id,
                'addressable_type' => 'App\Models\Order'
            ]);

            $orderAddress->save();
        } else if ($save_as_default) {

            $user = User::find(Auth::id());

            $userAddress = $user->address;
            if (!$userAddress) {
                $userAddress = Address::create(
                    [
                        'addressable_id' => $user->id,
                        'addressable_type' => 'App\Models\User',
                        'text' => $address,
                        'zipcode' => $zipcode,
                        'user_id' => Auth::id(),
                        'recipient_name' => $recipient_name,
                        'mobile' => $mobile,
                    ]
                );
            }

            $orderAddress = $userAddress->replicate()->fill([
                'addressable_id' => $order,
                'addressable_type' => 'App\Models\Order'
            ]);

            $orderAddress->save();
        } else {
            $order->address()->create([
                'text' => $address,
                'zipcode' => $zipcode,
                'user_id' => Auth::id(),
                'recipient_name' => $recipient_name,
                'mobile' => $mobile,
                'addressable_id' => $order->id,
                'addressable_type' => 'App\Models\Order'
            ]);
        }
    }

    public function setOrderPaid($order, $numbers)
    {
        $order->update([
            'payment_status' => Order::PAYMENT_STATUS_PAID,
            'billing_subtotal' => $numbers['billingSubtotal'],
            'billing_tax' => $numbers['billingTax'],
            'billing_total' => $numbers['billingTotal'],
            'delivery_cost' => $numbers['deliveryCost'],
        ]);

        // set total for each order item
        foreach ($order->items as $key => $orderItem) {

            $product = Product::FirstWhere('id', $orderItem->product_id);
            $product->increment('sold_qty', $orderItem->qty);

            $numbers['billingTotal'] = ($orderItem->qty * $product->getRawOriginal('default_price')) + (9 / 100 * ($orderItem->qty * $product->getRawOriginal('default_price')));

            $orderItem->update([
                'billing_total' => $numbers['billingTotal'],
                'payment_status' => OrderItem::PAYMENT_STATUS_PAID,
            ]);
        }
    }
}
