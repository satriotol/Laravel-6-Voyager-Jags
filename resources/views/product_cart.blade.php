@extends('layouts.app')

@section('title')
Shoping Chart
@endsection

@section('content')
<section class="banner_area">
    <div class="banner_inner d-flex align-items-center">
        <div class="container">
            <div class="banner_content text-center text-white">
                <h2>Shooping Chart</h2>
            </div>
        </div>
    </div>
</section>

<section class="cart_area">
    <div class="container">
        <div class="cart_inner">
            <form action="{{ route('front.update_cart') }}" method="post">
                @csrf
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr class="text-white">
                                <th scope="col">Product</th>
                                <th scope="col">Price</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- LOOPING DATA DARI VARIABLE CARTS -->
                            @forelse ($carts as $row)
                            <tr class="text-white">
                                <td>
                                    <div class="media">
                                        <div class="d-flex">
                                        </div>
                                        <div class="media-body ">
                                            <a class="text-white text-decoration-none"
                                                href="{{route('product.show',$row['id'])}}">{{ $row['name'] }}</a>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <h5>IDR. {{ number_format($row['price'],2) }}</h5>
                                </td>
                                <td>
                                    <input type="text" name="qty[]" id="sst{{ $row['id'] }}"
                                        value="{{ $row['qty'] }}">
                                    <input type="hidden" name="id[]" value="{{ $row['id'] }}" class="form-control">
                                    <button
                                        onclick="var result = document.getElementById('sst{{ $row['id'] }}'); var sst = result.value; if( !isNaN( sst )) result.value++;return false;"
                                        class="increase items-count" type="button">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                    <button
                                        onclick="var result = document.getElementById('sst{{ $row['id'] }}'); var sst = result.value; if( !isNaN( sst ) &amp;&amp; sst > 0 ) result.value--;return false;"
                                        class="reduced items-count" type="button">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                </td>
                                <td>
                                    <h5>Rp {{ number_format($row['price'] * $row['qty'],2) }}</h5>
                                </td>
                            </tr>
                            @empty
                            <tr class="text-white">
                                <td colspan="4">No Items</td>
                            </tr>
                            @endforelse
                            <tr class="bottom_button">
                                <td>
                                    @if (!$carts)
                                    <a href="{{route('products')}}" class="btn btn-light">Search For Product</a>
                                    @else
                                    <button class="btn btn-dark">Update Cart</button>
                                    @endif
                                </td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
            </form>
            <tr class="text-white">
                <td>
                </td>
                <td>
                </td>
                <td>
                    <h5>Subtotal</h5>
                </td>
                <td>
                    <h5>IDR. {{ number_format($subtotal,2) }}</h5>
                </td>
            </tr>
            <tr class="out_button_area">
                <td></td>
                <td></td>
                <td></td>
                <td>
                    <div class="checkout_btn_inner">
                        <a class="gray_btn" href="{{route('products')}}">Continue Shopping</a>
                        <a class="main_btn" href="#">Proceed to checkout</a>
                    </div>
                </td>
            </tr>
            </tbody>
            </table>
        </div>
    </div>
    </div>
</section>
@endsection
