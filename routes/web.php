<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);
Route::get('/index', [HomeController::class, 'index']);
Route::get('/cart', [HomeController::class, 'cart']);

// cara memanggil 1 fungsi di controller
// Route::get('/products', [ProductController::class, 'index']);

// cara memanggil semua fungsi di controler
Route::resource('products', ProductController::class);

