<?php

namespace App\Http\Controllers;

use App\City;
use App\Customer;
use App\District;
use App\Mail\TestEmail;
use App\Order;
use App\OrderDetail;
use App\Product;
use App\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use PHPUnit\Util\Test;

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
            return $q['qty'] * $q['price'];
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
    public function checkout()
    {
        $provinces = Province::orderBy('created_at','DESC')->get();
        $carts = $this->getCarts();

        $subtotal = collect($carts)->sum(function($q){
            return $q['qty'] * $q['price'];
        });
        return view('product_checkout',compact('provinces','carts','subtotal'));
    }
    public function getCity()
    {
        $cities = City::where('province_id', request()->province_id)->get();
        return response()->json(['status'=> 'success','data'=>$cities]);
    }
    public function getDistrict()
    {
        $districts = District::where('city_id', request()->city_id)->get();
        return response()->json(['status'=> 'success','data'=> $districts]);
    }
    public function processCheckout(Request $request)
    {
        $this->validate($request,[
            'customer_name'=>'required|string|max:100',
            'customer_phone'=>'required',
            'email'=>'required|email',
            'customer_address'=>'required|string',
            'province_id' => 'required|exists:provinces,id',
            'city_id' => 'required|exists:cities,id',
            'district_id' => 'required|exists:districts,id'
        ]);
        DB::beginTransaction();
        try{
            $carts = $this->getCarts();
            $subtotal = collect($carts)->sum(function($q){
                return $q['qty'] * $q['price'];
            });
            $customer = Customer::create([
                'name' => $request->customer_name,
                'email' => $request->email,
                'phone_number' => $request->customer_phone,
                'address' => $request->customer_address,
                'district_id' => $request->district_id,
                'status' => false
            ]);
            $order = Order::create([
                'invoice' => Str::random(4) . '-' . time(), //INVOICENYA KITA BUAT DARI STRING RANDOM DAN WAKTU
                'customer_id' => $customer->id,
                'customer_name' => $customer->name,
                'customer_phone' => $request->customer_phone,
                'customer_address' => $request->customer_address,
                'district_id' => $request->district_id,
                'subtotal' => $subtotal
            ]);
            foreach($carts as $row){
                $product = Product::find($row['id']);
                OrderDetail::create([
                    'order_id' => $order->id,
                    'product_id' => $row['id'],
                    'price' => $row['price'],
                    'qty' => $row['qty'],
                    'weight' => $product->weight
                ]);
            }
            DB::commit();
            $carts =[];
            $cookie = cookie('dw-carts',json_encode($carts),2880);
            Mail::to($customer['email'])->send(new TestEmail($customer));
            return redirect(route('front.finish_checkout', $order->invoice))->cookie($cookie);
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }
    public function checkoutFinish($invoice)
    {
        $order = Order::with('district.city')->where('invoice',$invoice)->first();
        $carts = $this->getCarts();

        $subtotal = collect($carts)->sum(function($q){
            return $q['qty'] * $q['price'];
        });
        return view('checkout_finish',compact('order','carts'));
    }
}