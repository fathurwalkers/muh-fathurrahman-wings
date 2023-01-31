<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BackController;
use App\Http\Controllers\GenerateController;
use App\Http\Controllers\HomeController;

Route::get('/', function () {
    return redirect('/');
});

Route::get('/login-admin', [BackController::class, 'login_admin'])->name('login-admin');
Route::get('/login-client', [BackController::class, 'login_client'])->name('login-client');

Route::post('/proses-login', [BackController::class, 'post_login'])->name('post-login');
Route::post('/logout', [BackController::class, 'logout'])->name('logout');

Route::group(['prefix' => '/dashboard', 'middleware' => 'ceklogin'], function () {
    // DASHBOARD ROUTE
    Route::get('/', [BackController::class, 'index'])->name('dashboard');
});
Route::group(['prefix' => '/', 'middleware' => 'cekloginclient'], function () {
    // DASHBOARD ROUTE
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/product-list', [HomeController::class, 'product_list'])->name('product-list');
    Route::post('/checkout-product', [HomeController::class, 'checkout_product'])->name('checkout-product');
    Route::post('/proses-checkout/{product}', [HomeController::class, 'proses_checkout'])->name('proses-checkout');
});

Route::get('/generate-user', [GenerateController::class, 'generate_user'])->name('generate-user');
Route::get('/generate-product', [GenerateController::class, 'generate_product'])->name('generate-product');

