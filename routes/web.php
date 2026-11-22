<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return 'ini adalah route utama';
});

// cara memanggil 1 fungsi di controller
// Route::get('/products', [ProductController::class, 'index']);

// cara memanggil semua fungsi di controler
Route::resource('products', ProductController::class);

Route::get('/cart', function () {
    return 'ini adalah route cart';
});

Route::get('/checkout', function () {
    return 'ini adalah route checkout';
});

