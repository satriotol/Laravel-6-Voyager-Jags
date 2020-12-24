@extends('layouts.app')

@section('title')
Keranjang Belanja - Dw Ecommerce
@endsection

@section('content')
<!--================Home Banner Area =================-->
<section class="banner_area">
    <div class="banner_inner d-flex align-items-center">
        <div class="container">
            <div class="banner_content text-center">
                <h2>Pesanan Diterima</h2>
                <div class="page_link">
                    <a href="{{ url('/') }}">Home</a>
                    <a href="">Invoice</a>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="bg-black">
    <div class="container">
        <div class="bg-white p-4 mt-3 rounded-50">
            <div class="checkout-body p-5">
                <div class="row">
                    <div class="col-md-6">
                        <h3>JAGS Invoice</h3>
                    </div>
                    <div class="col-md-6 text-right">
                        <h4>Invoice : {{ $order->invoice }}</h4>
                        <h4 class="mt-4">Created : {{ $order->created_at }}</h4>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-md-6">
                        <h4>{{$order->customer_address}}</h4>
                        <h4>{{$order->district->province->name}}</h4>
                        <h4>{{$order->district->city->name}}</h4>
                        <h4>{{$order->district->name}}</h4>
                    </div>
                    <div class="col-md-6 text-right">
                        <h4>{{$order->customer_name}}</h4>
                        <h4>{{$order->customer->email}}</h4>
                        <h4>{{$order->customer->phone_number}}</h4>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">PRODUCT</th>
                                <th scope="col">QTY</th>
                                <th scope="col">PRICE</th>
                                <th scope="col">SUBTOTAL</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orderdetails as $o)
                            @if ($o->order_id === $order->id)
                            <tr>
                                <td>{{$o->product->name}}</td>
                                <td>{{$o->qty}}</td>
                                <td>IDR {{number_format($o->price,2)}}</td>
                                <td>IDR {{ number_format($o->price * $o->qty,2) }}</td>
                            </tr>
                            @endif
                            @endforeach
                            <tr>
                                <th colspan="3" class="text-center">SHIPPING</th>
                                <td>IDR {{number_format($order->cost,2)}}</td>
                            </tr>
                            <tr>
                                <th colspan="3" class="text-center">TOTAL</th>
                                <td>IDR {{number_format($order->subtotal,2)}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================End Home Banner Area =================-->

<!--================Order Details Area =================-->
<section class="order_details p_120">
    <div class="container">
        <h3 class="title_confirmation">Terima kasih, pesanan anda telah kami terima.</h3>
        <div class="row order_d_inner">
            <div class="col-lg-6">
                <div class="details_item">
                    <h4>Informasi Pesanan</h4>
                    <ul class="list">
                        <li>
                            @foreach ($orderdetails as $o)
                            @if ($o->order_id === $order->id)
                            {{$o->product->name}}
                            {{$o->qty}}
                            @endif
                            @endforeach
                        </li>
                        <li>
                            <a href="#">
                                <span>Invoice</span> : {{ $order->invoice }}</a>
                        </li>
                        <li>
                            <a href="#">
                                <span>Tanggal</span> : {{ $order->created_at }}</a>
                        </li>
                        <li>
                            <a href="#">
                                <span>Subtotal</span> : Rp {{ number_format($order->subtotal) }}
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span>Ongkos Kirim</span> : Rp {{ number_format($order->cost) }}
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span>Total</span> : Rp {{ number_format($order->total) }}
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="details_item">
                    <h4>Informasi Pemesan</h4>
                    <ul class="list">
                        <li>
                            <a href="#">
                                <span>Alamat</span> : {{ $order->customer_address }}</a>
                        </li>
                        <li>
                            <a href="#">
                                <span>Kota</span> : {{ $order->district->city->name }}</a>
                        </li>
                        <li>
                            <a href="#">
                                <span>Country</span> : Indonesia</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================End Order Details Area =================-->

@endsection
