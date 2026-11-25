<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CategoryProduct;
use App\Models\Product;
use Illuminate\View\View;

class DashboardController extends Controller
{
     public function index(Request $request): View
    {
        $categories = CategoryProduct::withCount('products')
            ->when($request->q, fn ($query, $search) => $query->where('name', 'like', "%{$search}%"))
            ->orderBy('id')
            ->paginate(10)
            ->withQueryString();

        return view('dashboard.index', [
            'categories' => $categories,
            'totalCategories' => CategoryProduct::count(),
            'totalProducts' => Product::count(),
            'emptyCategories' => CategoryProduct::doesntHave('products')->count(),
        ]);
    }
}
