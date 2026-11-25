<?php

use App\Models\CategoryProduct;
use App\Models\Product;

test('products store and resolve their category through category product id', function () {
    $category = new CategoryProduct;
    $category->name = 'Audio';
    $category->save();

    $product = new Product;
    $product->name = 'Bluetooth Speaker';
    $product->description = 'Portable Bluetooth speaker';
    $product->image = 'speaker.jpg';
    $product->price = 459000;
    $product->stock = 35;
    $product->category()->associate($category);
    $product->save();

    $savedProduct = $product->fresh();

    expect($savedProduct->category_product_id)->toBe($category->id);
    expect($savedProduct->category->getKey())->toBe($category->id);
});
