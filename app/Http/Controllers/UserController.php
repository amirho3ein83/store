<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class UserController extends Controller
{
    public function updateInfo(Request $request)
    {

        if ($request->mobile == null && is_null($request->email)) {
            // return response()->json(['errors' => 'ssssssssssssssss']);
            // return redirect()->back()->with('error', 'keep email or mobile');
            // return Response::json(['error' => 'keep email or mobile'], 422);
            return null;
        }

        $validate_mobile = $request->mobile != Auth::user()->mobile ? ['unique:users,mobile', 'regex:/(09)[0-9]{9}/'] : 'nullable';
        $validate_email = $request->email != Auth::user()->email ? ['email', 'max:255', 'unique:users,email'] : 'nullable';

        Validator::make($request->all(), [
            'mobile' =>  $validate_mobile,
            'email' => $validate_email,
            'name' => ['max:255', 'nullable'],
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',

        ], [
            'profile_photo.max' => 'Image volume is too much!',

        ])->validate();


        $user = User::find(Auth::id());

        $user->update([
            'email' => $request->email,
            'mobile' => $request->mobile,
            'name' => $request->name
        ]);

        if ($request->profile_photo) {

            if ($user->hasMedia()) {

                $mediaItems = $user->getMedia();
                $mediaItems[0]->delete();

                $user->addMediaFromRequest('profile_photo')
                    ->toMediaCollection();
            } else {
                $user->addMediaFromRequest('profile_photo')
                    ->toMediaCollection();
            }

        }
    }

    public function profile()
    {
        $user = User::find(Auth::id());

        if ($user->hasMedia()) {
            $image_url = $user->getFirstMedia()->getUrl();
            $image_url = $image_url;
        } else {
            $image_url = null;
        }

        try {
            $user = User::find(Auth::id());
            $image_url = $user->getFirstMedia()->getUrl();
            $user->image_url = $image_url;
        } catch (\Throwable $th) {
            $user->image_url = null;
        }

        $address = Auth::user()->address;
        return Inertia::render(
            'User/Profile',
            ['address' => $address, 'image_url' => $image_url]
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

        $liked_products = Auth::user()->likedProducts;

        $liked_products->map(function ($product) {
            $image_url = $product->getFirstMedia()->getUrl();
            $product->image_url = $image_url;
        });

        return Inertia::render(
            'User/LikedList',
            [
                'liked_products' => $liked_products,
            ]
        );
    }
}
