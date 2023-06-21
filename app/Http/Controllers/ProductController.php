<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::select('name','slug','price')->latest()->get();
        return view('product', compact('products'));
    }

    public function confirmBuy($slug)
    {
        $product =  Product::where('slug',$slug)->firstOrFail();
        return view('confirm-buy', compact('product'));
    }

    public function buy(Request $request)
    {
        // return $request->all();
        $product =  Product::where('slug',$request->product_slug)->firstOrFail();
        // return $product;
        $user = User::firstOrCreate([
            'email' => $request->email,
        ],
            [
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'password' => 'password',
        ]);
        if(! auth()->id()){
        auth()->login($user);
        }

        $user->orders()->create([
            'product_id' => $product->id,
            'price' => $product->price,
        ]);

        return redirect()->route('checkout');
    }

    public function checkout()
    {
        return view('checkout');
    }
}
