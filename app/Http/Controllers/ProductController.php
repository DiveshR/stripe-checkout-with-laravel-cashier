<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::select('name','slug','price')->latest()->get();
        return view('product', compact('products'));
    }

    public function confirmBuy($slug)
    {
        $product =  Product::where('slug',$slug)->first();
        return view('confirm-buy', compact('product'));
    }
}
