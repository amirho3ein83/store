<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class UserController extends Controller
{
    public function profile()
    {
        return Inertia::render('Store/UserProfile', ['wallet' => Auth::user()->wallet]);
    }
}
