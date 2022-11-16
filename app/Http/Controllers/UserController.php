<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class UserController extends Controller
{
    public function profile()
    {
        $address = Auth::user()->address;
        return Inertia::render(
            'User/Profile',
            ['address' => $address]
        );
    }
    public function address()
    {
        return Auth::user()->address;
    }
    public function wallet()
    {
        return Inertia::render(
            'User/Wallet',
            [
                'wallet' => Auth::user()->wallet,
            ]
        );
    }

    public function purchaseList()
    {
        // $invoices = Invoice::whereHas('orders', function ($query) {
        //     $query->where('orders.buyer_id', Auth::id());
        // })->get();

        $orders = Order::purchased()->with('product')->latest()->get();

        $orders->map(function ($order) {
            $image_url = $order->product->getFirstMedia()->getUrl();
            $order->product->image_url = $image_url;
        });

        return Inertia::render(
            'User/PurchaseList',
            [
                'orders' => $orders
            ]
        );
    }

    public function likedProducts()
    {
        return Inertia::render(
            'User/LikedList',
            [
                'liked_products' => Auth::user()->likedProducts,
            ]
        );
    }
}
