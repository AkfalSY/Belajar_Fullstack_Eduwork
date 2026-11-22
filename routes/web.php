<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return 'ini adalah route utama';
});


Route::get('/products', function () {
    return 'ini adalah route product';
});

Route::get('/cart', function () {
    return 'ini adalah route cart';
});

Route::get('/checkout', function () {
    return 'ini adalah route checkout';
});

