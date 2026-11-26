<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class HomeController extends Controller
{
    public function index(){
        $products = Product::paginate(4);    
        return view('home', compact('products'));
    }

    public function click($product_id){
        $product = Product::findOrFail($product_id);
        $product->clicks = $product->clicks + 1;
        $product->save();

        $no_wa = '6281234567890';

        $text = "hallo saya tertarik dengan produk *" . $product->name . "* dengan harga *Rp " . number_format($product->price, 0, ',', '.') . "*";
        $url = "https://wa.me/" . $no_wa . "?text=" . urlencode($text);

        return redirect()->away($url);
    }
    
    
    public function cart(){
        return view('cart');
    }
}
