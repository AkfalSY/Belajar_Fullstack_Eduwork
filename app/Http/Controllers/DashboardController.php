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
        $totalCategories = CategoryProduct::count();
        $totalProducts = Product::count();
        $jumlahClickProduct= Product::sum('clicks');

        return view('dashboard.index', compact('totalCategories', 'totalProducts', 'jumlahClickProduct'));
    }
}
