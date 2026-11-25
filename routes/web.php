<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
Use App\Http\Controllers\ProductController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);

Route::get('/dashboard', function () {
    return view('dashboard.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('dashboard', DashboardController::class);
});

Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
Route::resource('category', CategoryController::class)
        ->parameters(['category' => 'category'])
        ->except(['create', 'show', 'edit']);

require __DIR__.'/auth.php';
