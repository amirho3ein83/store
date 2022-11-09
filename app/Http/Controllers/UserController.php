<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class UserController extends Controller
{
    public function profile()
    {
        // return Inertia::render(
        //     'User/Profile',
        //     []
        // );
        return Inertia::render(
            'User/Address',
            [
                'address' => Auth::user()->address
            ]
        );
    }
    public function address()
    {
        return Inertia::render(
            'User/Address',
            [
                'address' => Auth::user()->address
            ]
        );
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

    public function purchases()
    {
        return Inertia::render(
            'User/Purchase',
            [
                'wallet' => Auth::user()->wallet,
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
