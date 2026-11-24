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

        return view('category.index', [
            'categories' => $categories,
            'totalCategories' => CategoryProduct::count(),
            'totalProducts' => Product::count(),
            'emptyCategories' => CategoryProduct::doesntHave('products')->count(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validateWithBag('createCategory', [
            'name' => ['required', 'string', 'max:100', 'unique:categories,name'],
        ]);

        CategoryProduct::create($data);

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function update(Request $request, CategoryProduct $category)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:100', Rule::unique('categories', 'name')->ignore($category->id)],
        ]);

        $category->update($data);

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(CategoryProduct $category)
    {
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil dihapus.');
    }
}
