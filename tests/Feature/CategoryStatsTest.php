<?php

use App\Models\CategoryProduct;
use App\Models\Product;
use App\Models\User;

test('dashboard only shows its title while category statistics appear on the category page', function () {
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

    $user = User::factory()->create();

    $this->actingAs($user)
        ->get(route('dashboard'))
        ->assertOk()
        ->assertSee('Dashboard')
        ->assertDontSee('Total Kategori');

    $this->get(route('category-products.index'))
        ->assertOk()
        ->assertViewHas('totalCategories', 2)
        ->assertViewHas('totalProducts', 1)
        ->assertViewHas('emptyCategories', 1)
        ->assertViewHas('categories', function ($categories) {
            return $categories->first()->products_count === 1;
        });
});
