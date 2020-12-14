<?php

namespace App\Http\Controllers;
use App\Category;
use App\Product;
use Illuminate\Http\Request;

class HomeController extends CartController
{
    public function index()
    {
        $carts = $this->getCarts();
        return view('home',compact('carts'));
    }
    public function products()
    {
        $carts = $this->getCarts();
        return view('products',['products'=>Product::all(),'categories'=>Category::all()],compact('carts'));
    }
    public function productshow(Product $product)
    {
        $carts = $this->getCarts();
        return view('product_show',['products'=>Product::all()],compact('carts'))->with('product',$product);
    }
    public function contact()
    {
        $carts = $this->getCarts();
        return view('contact',compact('carts'));
    }
    
}
