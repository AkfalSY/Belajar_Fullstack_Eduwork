<?php

namespace App\Http\Controllers;

use App\Models\CategoryProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categories = categoryProduct::all();
        $products = Product::with('category')
            ->when($request->q, fn ($query, $search) => $query->where('name', 'like', "%{$search}%"))
            ->orderBy('id')
            ->paginate(4)
            ->withQueryString();

        return view('products.index', compact('products', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:100', 'unique:products,name'],
            'description' => ['required', 'string', 'max:255'],
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'category_product_id' => ['required', 'exists:category_products,id'],
            'price' => ['required', 'numeric'],
            'stock' => ['required', 'numeric'],
        ]);

        $category = CategoryProduct::findOrFail($request->category_product_id);

        $product = new Product;
        $product->name = $request->name;
        $product->description = $request->description;
        if ($request->hasFile('image')) {
            $product->image = $request->file('image')->store('image', 'public');
        }
        $product->category()->associate($category);
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->save();

        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:100', Rule::unique('products', 'name')->ignore($product->id)],
            'description' => ['required', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'category_product_id' => ['required', 'exists:category_products,id'],
            'price' => ['required', 'numeric'],
            'stock' => ['required', 'numeric'],
        ]);

        $product->name = $data['name'];
        $product->description = $data['description'];
        $product->category_product_id = $data['category_product_id'];
        $product->price = $data['price'];
        $product->stock = $data['stock'];

        if ($request->hasFile('image')) {
            $product->image = $request->file('image')->store('image', 'public');
        }

        $product->save();

        return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus.');
    }
}
