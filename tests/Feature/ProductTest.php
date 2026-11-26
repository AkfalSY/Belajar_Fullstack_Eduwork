<?php

use App\Models\CategoryProduct;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

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

test('product updates keep the existing image when no replacement is uploaded', function () {
    Storage::fake('public');

    $admin = User::factory()->create(['role' => 'admin']);
    $category = new CategoryProduct;
    $category->name = 'Audio';
    $category->save();

    $product = new Product;
    $product->name = 'Headphone';
    $product->description = 'Wireless headphone';
    $product->image = 'https://example.com/headphone.jpg';
    $product->price = 100000;
    $product->stock = 5;
    $product->category()->associate($category);
    $product->save();

    $response = $this->actingAs($admin)->put(route('product.update', $product), [
        'name' => 'Updated Headphone',
        'description' => 'Updated wireless headphone',
        'category_product_id' => $category->id,
        'price' => 120000,
        'stock' => 8,
    ]);

    $response->assertRedirect(route('products.index'));
    $this->assertDatabaseHas('products', [
        'id' => $product->id,
        'name' => 'Updated Headphone',
        'description' => 'Updated wireless headphone',
        'image' => 'https://example.com/headphone.jpg',
        'category_product_id' => $category->id,
        'price' => 120000,
        'stock' => 8,
    ]);
});

test('product updates store an uploaded replacement image', function () {
    Storage::fake('public');

    $admin = User::factory()->create(['role' => 'admin']);
    $category = new CategoryProduct;
    $category->name = 'Audio';
    $category->save();

    $product = new Product;
    $product->name = 'Headphone';
    $product->description = 'Wireless headphone';
    $product->image = 'https://example.com/headphone.jpg';
    $product->price = 100000;
    $product->stock = 5;
    $product->category()->associate($category);
    $product->save();

    $image = UploadedFile::fake()->create('replacement.jpg', 10, 'image/jpeg');

    $response = $this->actingAs($admin)->put(route('product.update', $product), [
        'name' => 'Updated Headphone',
        'description' => 'Updated wireless headphone',
        'category_product_id' => $category->id,
        'price' => 120000,
        'stock' => 8,
        'image' => $image,
    ]);

    $response->assertRedirect(route('products.index'));

    $updatedProduct = $product->fresh();
    Storage::disk('public')->assertExists($updatedProduct->image);
    $this->assertDatabaseHas('products', [
        'id' => $product->id,
        'image' => $updatedProduct->image,
    ]);
});
