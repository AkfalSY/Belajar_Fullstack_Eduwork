<?php

use App\Models\CategoryProduct;
use App\Models\Product;
use App\Models\User;

test('dashboard shows category statistics and category page lists categories', function () {
    $categoryWithProducts = new CategoryProduct;
    $categoryWithProducts->name = 'Accessories';
    $categoryWithProducts->save();

    $emptyCategory = new CategoryProduct;
    $emptyCategory->name = 'Storage';
    $emptyCategory->save();

    $product = new Product;
    $product->name = 'Headphones';
    $product->description = 'Wireless headphones';
    $product->image = 'headphones.jpg';
    $product->price = 100;
    $product->stock = 3;
    $product->category_product_id = $categoryWithProducts->id;
    $product->save();

    $user = User::factory()->create(['role' => 'admin']);

    $this->actingAs($user)
        ->get(route('dashboard.index'))
        ->assertOk()
        ->assertSee('Dashboard')
        ->assertSee('Total Kategori');

    $this->get(route('category.index'))
        ->assertOk()
        ->assertViewHas('categories', function ($categories) {
            return $categories->first()->products_count === 1;
        });
});
