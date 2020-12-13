<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    private function getCarts()
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
            //TAMBAHKAN DATA BARU DENGAN MENJADIKAN PRODUCT_ID SEBAGAI KEY DARI ARRAY CARTS
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
        return redirect()->back()->cookie($cookie);
    }
    public function listCart()
    {
        $carts = $this->getCarts();
        $subtotal = collect($carts)->sum(function($q){
            return $q['qty']*$q['price'];
        });
        return view('product_cart',compact('carts','subtotal'));
    }
    public function updateCart(Request $request)
    {
        //AMBIL DATA DARI COOKIE
        $carts = $this->getCarts();
        //KEMUDIAN LOOPING DATA PRODUCT_ID, KARENA NAMENYA ARRAY PADA VIEW SEBELUMNYA
        //MAKA DATA YANG DITERIMA ADALAH ARRAY SEHINGGA BISA DI-LOOPING
        foreach ($request->id as $key => $row) {
            //DI CHECK, JIKA QTY DENGAN KEY YANG SAMA DENGAN PRODUCT_ID = 0
            if ($request->qty[$key] == 0) {
                //MAKA DATA TERSEBUT DIHAPUS DARI ARRAY
                unset($carts[$row]);
            } else {
                //SELAIN ITU MAKA AKAN DIPERBAHARUI
                $carts[$row]['qty'] = $request->qty[$key];
            }
        }
        //SET KEMBALI COOKIE-NYA SEPERTI SEBELUMNYA
        $cookie = cookie('dw-carts', json_encode($carts), 2880);
        //DAN STORE KE BROWSER.
        return redirect()->back()->cookie($cookie);
    }
}
