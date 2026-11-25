<?php

namespace App\Http\Controllers;

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
         $products = Product::with('category')
        ->when($request->q, fn ($query, $search) => $query->where('name', 'like', "%{$search}%"))
        ->orderBy('id')
        ->paginate(4)
        ->withQueryString();

    return view('products.index', compact('products'));
    }

   public function store(Request $request)
    {
        $data = $request->validateWithBag('createProduct', [
            'name' => ['required', 'string', 'max:100', 'unique:products,name'],
            'description' => ['required', 'string', 'max:255'],
            'image' => ['required', 'string', 'max:255'],
            'price' => ['required', 'int', 'max:255'],
            'stock' => ['required', 'int', 'max:255'],
        ]);

        Product::create($data);

        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:100', Rule::unique('products', 'name')->ignore($product->id)],
            'description' => ['required', 'string', 'max:255'],
            'image' => ['required', 'string', 'max:255'],
            'price' => ['required', 'int', 'max:255'],
            'stock' => ['required', 'int', 'max:255'],
        ]);

        $product->update($data);

        return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus.');
    }
}
