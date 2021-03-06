<?php

namespace App\Http\Controllers;

use App\City;
use App\Customer;
use App\District;
use App\invoice;
use App\Mail\TestEmail;
use App\Order;
use App\OrderDetail;
use App\Product;
use App\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use GuzzleHttp\Client;
use PDF;
use Midtrans\Snap;


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
            'qty' => 'required',
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
                'size' => $request->size,
                'colour' => $request->colour,
                'qty' => $product->qty,
                'weight' => $product->weight
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
        $weight = collect($carts)->sum(function($q) {
            return $q['qty'] * $q['weight'];
        });
        return view('product_checkout',compact('provinces','carts','subtotal','weight'));
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
            'district_id' => 'required|exists:districts,id',
            'courier' => 'required'
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
            $shipping = explode('-',$request->courier);
            $order = Order::create([
                'invoice' => Str::random(4) . '-' . time(), //INVOICENYA KITA BUAT DARI STRING RANDOM DAN WAKTU
                'customer_id' => $customer->id,
                'customer_name' => $customer->name,
                'customer_phone' => $request->customer_phone,
                'customer_address' => $request->customer_address,
                'district_id' => $request->district_id,
                'subtotal' => $subtotal,
                'cost' => $shipping[2],
                'shipping' => $shipping[0] . '-' . $shipping[1],
            ]);
            foreach($carts as $row){
                $product = Product::find($row['id']);
                $orderdetails = OrderDetail::create([
                    'order_id' => $order->id,
                    'product_id' => $row['id'],
                    'price' => $row['price'],
                    'qty' => $row['qty'],
                    'weight' => $product->weight
                ]);
                $invoice = invoice::create([
                    'order_id' => $order->id,
                    'product_name' => $row['name'],
                    'qty' => $row['qty'],
                    'price' => $row['price'],
                ]);
                $invoiceget = invoice::all();
            }
            DB::commit();
            $carts =[];
            $data = array(
                'invoice' => $order->invoice,
                'name' => $request->customer_name,
                'phone_number' => $request->customer_phone,
                'address' => $request->customer_address,
                'email' => $request->email,
                'province' => $order->district->province->name,
                'city' => $order->district->city->name,
                'district' => $order->district->name,
                'subtotal' => $order->subtotal,
                'cost' => $order->cost,
                'created_at' => $order->created_at,
                'subtotal' => $order->subtotal,
            );
            $pdf = PDF::loadView('invoice_pdf', compact('order','customer','invoiceget','carts'));
            $cookie = cookie('dw-carts',json_encode($carts),2880);
            Mail::to($customer['email'])->send(new TestEmail($data,$pdf));
            return redirect(route('front.finish_checkout', $order->invoice))->cookie($cookie);
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }
    public function checkoutFinish($invoice)
    {
        $order = Order::with('district.city')->where('invoice',$invoice)->first();
        $orderdetails = OrderDetail::all();
        $carts = $this->getCarts();
        $subtotal = collect($carts)->sum(function($q){
            return $q['qty'] * $q['price'];
        });
        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;
        $params = array(
            'transaction_details' => array(
                'order_id' => $order->id,
                'gross_amount' => $order->subtotal + $order->cost,
            ),
            'customer_details' => array(
                'first_name' => $order->customer_name,
                // 'last_name' => 'pratama',
                'email' => $order->customer->email,
                'phone' => $order->customer->phone_number,
            ),
            'enabled_payments' => ["bca_va", "bni_va","shopeepay"],
            'callbacks' => array (
                'finish' => env('APP_URL'),
            ),
        );
        
        $snapToken = \Midtrans\Snap::getSnapToken($params);
        return view('checkout_finish',compact('order','carts','orderdetails','snapToken'));
    }
    public function getCourier(Request $request)
    {
        $this->validate($request, [
            'destination' => 'required',
            'weight' => 'required|integer'
        ]);

        //MENGIRIM PERMINTAAN KE API RUANGAPI UNTUK MENGAMBIL DATA ONGKOS KIRIM
        //BACA DOKUMENTASI UNTUK PENJELASAN LEBIH LANJUT
        $url = 'https://ruangapi.com/api/v1/shipping';
        $client = new Client();
        $response = $client->request('POST', $url, [
            'headers' => [
                'Authorization' => 'v3v8k5TbRgZ5ZeVTdxHRLTQ0ONeocLiuTUZnZgcw'
            ],
            'form_params' => [
                'origin' => 399, //ASAL PENGIRIMAN, 22 = BANDUNG
                'destination' => $request->destination,
                'weight' => $request->weight,
                'courier' => 'jnt,sicepat' //MASUKKAN KEY KURIR LAINNYA JIKA INGIN MENDAPATKAN DATA ONGKIR DARI KURIR YANG LAIN
            ]
        ]);

        $body = json_decode($response->getBody(), true);
        return $body;
    }
    // public function invoicepdf()
    // {
    //     $order = Order::with('district.city')->first();
    //     $orderdetails = OrderDetail::all();
    //     $carts = $this->getCarts();
    //     $subtotal = collect($carts)->sum(function($q){
    //         return $q['qty'] * $q['price'];
    //     });
    //     $pdf = PDF::loadview('invoice_pdf',['orderdetails'=>$orderdetails,'order'=>$order,'subtotal'=>$subtotal]);
    //     return $pdf->download('laporan-pegawai-pdf');
    // }
}