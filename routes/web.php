<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WalletController;
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

Route::redirect('/', '/home');

Route::get('/about', [ProductController::class, 'aboutPage'])->name('about');
Route::get('/home', [ProductController::class, 'homePage'])->name('home');
Route::get('/resume', [ProductController::class, 'resumePage'])->name('resume');
Route::get('/portfolio', [ProductController::class, 'portfolioPage'])->name('portfolio');


Route::get('/categories-all', [ProductController::class, 'categoryList'])->name('category.list');
Route::get('/categories/{category}/sub-categories', [ProductController::class, 'subCategoryList'])->name('subCategories.list');
// Route::get('/categories/{category}/product-list', [ProductController::class, 'productList'])->name('product-list');
Route::get('/products/{product}', [ProductController::class, 'showPage'])->name('product.show');
Route::match(['get', 'post'], '/categories/{category}/product-list', [ProductController::class, 'productList'])->name('product-list');
Route::get('/contact-us', function () {
    return Inertia::render('ContactUs');
})->name('contactus');

Route::post('/contact-us/report', [AdminController::class, 'report'])->name('contact.us.report');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::controller(AdminController::class)->middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {

        Route::get('/dashboard', 'dashboard')->name('dashboard');
        Route::get('/products-list', 'productsList')->name('products.list');
        Route::get('/user/orders-list', 'ordersList')->name('orders.list');
        Route::get('/clients-list', 'usersList')->name('clients.list');
        Route::get('/criticisms-list', 'criticismList')->name('criticisms.list');
        Route::get('/todo-list', 'todoList')->name('todolist');

        Route::get('/products/{product:id}/edit', [ProductController::class, 'edit'])->name('product.edit');
        Route::post('/products/{product:id}/update', [ProductController::class, 'update'])->name('product.update');

        Route::delete('/products/{product}/delete', [ProductController::class, 'delete'])->name('product.delete');
        Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
        Route::post('/product', [ProductController::class, 'store'])->name('product.store');
    });


    Route::get('/user/profile', [UserController::class, 'profile'])->name('user.profile');
    Route::put('/user/update-info', [UserController::class, 'updateInfo'])->name('user.updateInfo');

    Route::get('/user/address', [UserController::class, 'address'])->name('user.address');
    Route::get('/user/profile/wallet', [UserController::class, 'wallet'])->name('user.wallet');
    Route::get('/user/orders-list', [UserController::class, 'ordersList'])->name('user.orders.list');
    Route::get('/user/profile/liked-products', [UserController::class, 'likedProducts'])->name('user.liked.products');


    Route::post('/comment', [CommentController::class, 'storeComment'])->name('submit.comment');
    Route::get('products/{id}/comments', [CommentController::class, 'getComments'])->name('product.comments');


    Route::post('/cart', [OrderController::class, 'addToCart'])->name('addToCart');
    Route::get('/cart', [OrderController::class, 'index'])->name('Cart');
    Route::get('/cart/count', [OrderController::class, 'countOrders'])->name('cart.count');


    Route::post('/pay-with-wallet', [orderController::class, 'payOnlyWithWallet'])->name('pay.with.wallet');
    Route::post('/order-payment-request', [orderController::class, 'orderPaymentRequest'])->name('order.payment.request');
    Route::get('/order/payment-gateway', [orderController::class, 'transferToPaymentGateway'])->name('order.payment.gateway');
    Route::get('/order-payment-callback', [orderController::class, 'confirmOrderPayment'])->name('order.payment.callback');

    Route::get('/wallet-charge-request/{amount}', [WalletController::class, 'walletChargeRequest'])->name('wallet.charge.request');
    Route::get('/wallet-payment-request', [WalletController::class, 'transferToPaymentGateway'])->name('wallet.payment.gateway');
    Route::get('/wallet-payment-callback', [WalletController::class, 'confirmWalletChargePayment'])->name('wallet.payment.callback');

    Route::patch('/cart/products/{id}/increase-order', [OrderController::class, 'increaseOrder'])->name('cart.increase-order');
    Route::patch('/cart/products/{id}/decrease-order', [OrderController::class, 'decreaseOrder'])->name('cart.decrease-order');
    Route::delete('/cart/order-items/{id}', [OrderController::class, 'deleteOrderItem'])->name('orderItem.delete');



    Route::patch('/products/{id}/like', [ProductController::class, 'likeProduct'])->name('like-product');
    Route::patch('/products/{id}/unlike', [ProductController::class, 'unlikeProduct'])->name('unlike-product');
    Route::patch('/rate/product', [ProductController::class, 'rateProduct'])->name('rate-product');
});



Route::fallback(function () {
    return Inertia::render('404');
});
