<?php

namespace App\Http\Controllers;

use App\Models\CategoryProduct;
use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    public function index(Request $request): View
    {
        $categories = CategoryProduct::withCount('products')
            ->when($request->q, fn ($query, $search) => $query->where('name', 'like', "%{$search}%"))
            ->orderBy('id')
            ->paginate(10)
            ->withQueryString();

        return view('category.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:100'],
        ]);

        $name_check = CategoryProduct::where('name', $request->name)->exists();

        if ($name_check) {
            return back()
                ->withInput()
                ->withErrors(['Category name already exists']);
        } else {
            $category = new CategoryProduct;
            $category->name = $request->name;
            $category->save();

            return redirect()->route('category.index')->with('success', 'Kategori berhasil ditambahkan.');
        }

    }

    public function update(Request $request, CategoryProduct $category)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:100', Rule::unique('category_products', 'name')->ignore($category->id)],
        ]);

        $category->update($data);

        return redirect()->route('category.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $category = CategoryProduct::findOrFail($id);
        $product_check = Product::where('category_product_id', $category->id)->exists();
        if ($product_check) {
            $products = Product::where('category_product_id', $category->id)->update(['category_product_id' => null]);
        }
        $category->delete();

        return redirect()->route('category.index')->with('success', 'Kategori berhasil dihapus.');
    }
}
