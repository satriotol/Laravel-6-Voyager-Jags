<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function getCarts()
    {
        $carts = json_decode(request()->cookie('dw-carts'), true);
        $carts = $carts != '' ? $carts:[];
        return $carts;
    }
    public function addToCart(Request $request)
    {
        $this->validate($request,[
            'id' => 'required',
            'name' => 'required',
            'price' => 'required',
            'size' => 'required',
            'colour' => 'required',
            'qty' => 'required'
        ]);

        $carts = $this->getCarts();
        if ($carts && array_key_exists($request->id, $carts)) {
            $carts[$request->id]['qty'] += $request->qty;
        }else{
            $product = Product::find($request->id);
            $carts[$request->id] = [
                'id' => $request->id,
                'name' => $product->name,
                'price' => $product->price,
                'size' => $product->size,
                'colour' => $product->colour,
                'qty' => $product->qty
            ];
        }
        $cookie = cookie('dw-carts',json_encode($carts), 2880);
        session()->flash('success','Product Add To Cart Successfully');
        return redirect()->back()->cookie($cookie);
    }
    protected function listCart()
    {
        $carts = $this->getCarts();
        $subtotal = collect($carts)->sum(function($q){
            return $q['qty']*$q['price'];
        });
        return view('product_cart',compact('carts','subtotal'));
    }
    public function updateCart(Request $request)
    {
        $carts = $this->getCarts();
        foreach ($request->id as $key => $row) {
            if ($request->qty[$key] == 0) {
                unset($carts[$row]);
            } else {
                $carts[$row]['qty'] = $request->qty[$key];
            }
        }
        $cookie = cookie('dw-carts', json_encode($carts), 2880);
        return redirect()->back()->cookie($cookie);
    }
}
