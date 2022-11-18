<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class UserController extends Controller
{
    public function updateInfo(Request $request)
    {

        // dd($request->profile_photo);

        $validate_mobile = $request->mobile != Auth::user()->mobile ? ['unique:users,mobile', 'regex:/(09)[0-9]{9}/'] : 'nullable';
        $validate_email = $request->email != Auth::user()->email ? ['email', 'max:255', 'unique:users,email'] : 'nullable';

        Validator::make($request->all(), [
            'mobile' =>  $validate_mobile,
            'email' => $validate_email,
            'name' => ['max:255', 'nullable'],
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',

        ], [
            'profile_photo.max' => 'iamge volume is too much!',

        ])->validate();


        $user = User::find(Auth::id());

        $user->update([
            'email' => $request->email,
            'mobile' => $request->mobile,
            'name' => $request->name
        ]);

        if ($request->profile_photo ) {
            info($request->profile_photo);
            // $user->addMediaFromRequest($request->profile_photo)
            //     ->toMediaCollection();
        }
    }

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
