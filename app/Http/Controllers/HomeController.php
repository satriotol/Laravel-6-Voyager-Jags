<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }
    public function products()
    {
        return view('products',['products'=>Product::all(),'categories'=>Category::all()]);
    }
    public function productshow(Product $product)
    {
        return view('product_show',['products'=>Product::all()])->with('product',$product);
    }
    public function contact()
    {
        return view('contact');
    }
}
