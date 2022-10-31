<?php

use App\Http\Controllers\ProductController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Store/Products/Index', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});
Route::get('/cart', function () {
    return Inertia::render('Store/Cart');
});

Route::get('/show', function () {
    return Inertia::render('Store/Products/Show');
});
Route::get('/products/{product}/edit', [ProductController::class ,'edit'])->name('product.edit');

Route::get('/product/create', function () {
    return Inertia::render('Store/Products/Create');
});
Route::post('/product', [ProductController::class, 'store'])->name('product.store');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});
