<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class BackofficeController extends Controller
{
    public function productsList()
    {
        return Inertia::render('backoffice/Dashboard');
    }
}
