<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Evryn\LaravelToman\CallbackRequest;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Wallet;
use Evryn\LaravelToman\Facades\Toman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

use function PHPUnit\Framework\isEmpty;

class OrderController extends Controller
{

    protected $_validation = [
        'recipient_name' => 'required',
        'mobile' => 'required|regex:/(09)[0-9]{9}/',
        'address' => 'required|max:255',
        'zipcode' => 'required|max:255',
    ];

    protected $_validationMessages = [
        'recipient_name.required' => ' نام لازم است',
        'mobile.required' => ' موبایل مورد نیاز است',
        'mobile.regex' => 'فرمت موبایل نادرست است',
        'address.required' => ' آدرس مورد نیاز است',
        'zipcode.required' => ' کد پستی لازم است',
    ];

    public function index()
    {
        $order = Order::where('buyer_id', 33)->pendingPayment()
            ->with('items', 'items.color', 'address')
            ->first();

        info(!gettype($order));
        info($order);
        if ($order) {
            $order->items->map(function ($item) {
                $image_url = $item->product->getFirstMedia()->getUrl();
                $item->product->image_url = $image_url;
                $item->product->en_price = $item->product_price;
            });

            $subtotal = 0;
            foreach ($order->items as $key => $item) {
                $subtotal += $item->getRawOriginal('qty') * $item->product_price;
            }

            $cartIsEmpty = false;
        } else {
            $cartIsEmpty = true;
        }

        $userAddress = Auth::user()->address;
        $walletBalance = Auth::user()->wallet->getRawOriginal('balance');

        return Inertia::render('Store/Cart', [
            'order' => $order ?? null,
            'subtotal' => $subtotal ?? null,
            'userAddress' => $userAddress ?? null,
            'walletBalance' => $walletBalance ?? null,
            'cartIsEmpty' => $cartIsEmpty,
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
            $request->picked_color_id,
        )->first();


        if (empty($found_in_cart)) {

            $productPrice = DB::table('color_product')
                ->where('product_id', $request->product_id)
                ->where('color_id', $request->picked_color_id)
                ->pluck('price')->first();

            OrderItem::create([
                'order_id' => $order->id,
                'product_price' => $productPrice,
                'product_id' => $product->id,
                'color_id' => $request->picked_color_id,
                'buyer_id' => Auth::id(),
                'payment_status' => 'pending'
            ]);
        } else {
            OrderItem::where('id', $found_in_cart->id)->increment('qty');
        }
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

    public function deleteOrderItem($id)
    {
        OrderItem::whereId($id)->delete();
    }

    public function countOrders(Product $product)
    {
        return  OrderItem::pendingPayment()->count();
    }


    public function finalizeOrderUsingWallet(Request $request, Order $order)
    {

        if ($request->use_default_address == false) {
            Validator::make($request->all(), $this->_validation, $this->_validationMessages)->validate();
        }

        $order = Order::firstWhere(
            ['buyer_id' => Auth::id(), 'payment_status' => Order::PAYMENT_STATUS_PENDING]
        );

        try {
            DB::beginTransaction();

            $this->saveOrderAddress(
                $order->id,
                $request->address,
                $request->zipcode,
                $request->recipient_name,
                $request->mobile,
                $request->use_default_address,
                $request->save_address_as_default
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
            return back()->with([
                'error' => $e->getMessage()
            ]);
        }
    }

    public function orderPaymentRequest(Request $request)
    {

        if ($request->use_default_address == false) {
            Validator::make($request->all(), $this->_validation, $this->_validationMessages)->validate();
        }

        $order = Order::firstWhere(
            ['buyer_id' => Auth::id(), 'payment_status' => Order::PAYMENT_STATUS_PENDING]
        );

        try {
            DB::beginTransaction();

            $this->saveOrderAddress(
                $order->id,
                $request->address,
                $request->zipcode,
                $request->recipient_name,
                $request->mobile,
                $request->use_default_address,
                $request->save_address_as_default
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
            ->description(' :پرداخت سفارش با شناسه ' . $order->id)
            ->callback(route('order.payment.callback'))
            // ->email(Auth::user()->email)
            // ->mobile(Auth::user()->mobile)
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

        $transaction = Transaction::firstWhere(
            [
                'payer_id' => Auth::id(),
                'transactionـfor' => Transaction::TRANSACTION_FOR_ORDER,
                'payment_status' => Transaction::PAYMENT_STATUS_PENDING
            ]
        );

        $payment = $request->amount($transaction->amount)->verify();

        if ($payment->successful()) {
            // Store the successful transaction details
            $transaction->payment_status = Transaction::PAYMENT_STATUS_PAID;
            $transaction->reference_id = $payment->referenceId();
            $transaction->save();

            $order = Order::firstWhere(
                ['buyer_id' => Auth::id(), 'payment_status' => 'pending']
            );
            $numbers = $this->getNumbers($order);

            $this->setOrderPaid($order, $numbers, $transaction->id);

            return redirect()->route('user.orders.list');
        }

        if ($payment->alreadyVerified()) {
            var_dump('alreadyVerified');
        }

        if ($payment->failed()) {
            $transaction->payment_status = Transaction::PAYMENT_STATUS_FAILED;
            $transaction->save();
            return redirect()->route('user.orders.list');
        }
    }

    public function getNumbers($order)
    {
        $order->load('items');

        $billingSubtotal = 0;
        foreach ($order->items as $key => $orderItem) {
            $billingSubtotal += $orderItem->qty * $orderItem->product_price;
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

    public function saveOrderAddress($orderId, $address, $zipcode, $recipient_name, $mobile, $use_default = false, $save_as_default = false)
    {
        if ($use_default) {

            $user = User::find(Auth::id());

            $orderAddress = $user->address->replicate()->fill([
                'addressable_id' => $orderId,
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
                'addressable_id' => $orderId,
                'addressable_type' => 'App\Models\Order'
            ]);

            $orderAddress->save();
        } else {
            Address::create([
                'text' => $address,
                'zipcode' => $zipcode,
                'user_id' => Auth::id(),
                'recipient_name' => $recipient_name,
                'mobile' => $mobile,
                'addressable_id' => $orderId,
                'addressable_type' => 'App\Models\Order'
            ]);
        }
    }

    public function setOrderPaid($order, $numbers, $transactionId = null)
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

            $numbers['billingTotal'] = ($orderItem->qty * $orderItem->product_price);

            $orderItem->update([
                'billing_total' => $numbers['billingTotal'],
                'payment_status' => OrderItem::PAYMENT_STATUS_PAID,
            ]);
        }
    }
}
