@extends('layouts.app')
<style>
    .form-group label {
        color: white;
    }

    .items p {
        color: black;
        font-weight: normal !important;
    }

</style>
@section('title')
Checkout
@endsection

@section('content')
<section class="bg-black">
    <div class="container">
        <div class="text-center">
            <h4>Checkout Form</h4>
        </div>
    </div>
</section>
<section class="bg-black">
    <div class="container">
        <div class="row">
            <div class="col-lg-7">
                @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
                <form action="{{ route('front.store_checkout') }}" method="POST" class="row" novalidate="novalidate">
                    @csrf
                    <div class="col-md-12 form-group">
                        <label for="customer_name">Full Name</label>
                        <input type="text" name="customer_name" required class="form-control">
                        <p class="text-danger">{{ $errors->first('customer_name') }}</p>
                    </div>
                    <div class="col-md-12 form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="phone">Phone Number</label>
                                <input type="text" class="form-control" name="customer_phone" required>
                                <p class="text-danger">{{ $errors->first('customer_phone') }}</p>
                            </div>
                            <div class="col-md-6">
                                <label for="email">E-mail</label>
                                <input type="email" name="email" class="form-control" name="email" required>
                                <p class="text-danger">{{ $errors->first('email') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 form-group">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" name="customer_address" required>
                        <p class="text-danger">{{ $errors->first('customer_address') }}</p>
                    </div>
                    <div class="col-md-12 form-group">
                        <label for="province_id">Province</label>
                        <select class="form-control w-100" name="province_id" id="province_id" required>
                            <option value="">Select Province</option>
                            @foreach ($provinces as $row)
                            <option value="{{ $row->id }}">{{ $row->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-12 form-group">
                        <label for="">Kabupaten / Kota</label>
                        <select class="form-control w-100" name="city_id" id="city_id" required>
                            <option value="">Select City</option>
                        </select>
                    </div>
                    <div class="col-md-12 form-group">
                        <label for="">District</label>
                        <select class="form-control w-100" name="district_id" id="district_id" required>
                            <option value="">Select District</option>
                        </select>
                    </div>
            </div>
            <div class="col-lg-5">
                <div class="bg-white p-4 mt-3 rounded-50">
                    <div class="checkout-title text-center">
                        <h4>Your Shortlist Checkout</h4>
                    </div>
                    <div class="checkout-body">
                        <div class="row">
                            <div class="col-md-12 mt-5">
                                <h5>Products Total</h5>
                            </div>
                        </div>
                        @foreach ($carts as $cart)
                        <div class="items row">
                            <div class="col-5">
                                <p>{{ \Str::limit($cart['name'], 10) }}</p>
                            </div>
                            <div class="col-3">
                                <p>x {{ $cart['qty'] }}</p>
                            </div>
                            <div class="col-4">
                                <p>IDR {{number_format($cart['price'],2)}}</p>
                            </div>
                        </div>
                        @endforeach
                        <div class="items row">
                            <div class="col-5">
                                <h5>Sub Total</h5>
                            </div>
                            <div class="col-3">
                            </div>
                            <div class="col-4">
                                <p>IDR {{ number_format($subtotal,2) }}</p>
                            </div>
                        </div>
                        <div class="items row">
                            <div class="col-5">
                                <h5>Shipping</h5>
                            </div>
                            <div class="col-3">
                            </div>
                            <div class="col-4">
                                <p>IDR 0</p>
                            </div>
                        </div>
                        <div class="items row">
                            <div class="col-5">
                                <h5>TOTAL</h5>
                            </div>
                            <div class="col-3">
                            </div>
                            <div class="col-4">
                                <h5>IDR {{ number_format($subtotal),2 }}</h5>
                            </div>
                        </div>
                    </div>
                    <div class="checkout-footer text-center p-5">
                        <input type="submit" value="ORDER NOW" class="btn btn-dark rounded-50">
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
{{-- <section class="checkout_area section_gap">
    <div class="container">
        <div class="billing_details">
            <div class="row">
                <div class="col-lg-8">
                    <h3>Informasi Pengiriman</h3>
                    @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
@endif
<form class="row contact_form" action="" method="post" novalidate="novalidate">
    @csrf
    <div class="col-md-12 form-group p_star">
        <label for="">Nama Lengkap</label>
        <input type="text" class="form-control" id="first" name="customer_name" required>
        <p class="text-danger">{{ $errors->first('customer_name') }}</p>
    </div>
    <div class="col-md-6 form-group p_star">
        <label for="">No Telp</label>
        <input type="text" class="form-control" id="number" name="customer_phone" required>
        <p class="text-danger">{{ $errors->first('customer_phone') }}</p>
    </div>
    <div class="col-md-6 form-group p_star">
        <label for="">Email</label>
        <input type="email" class="form-control" id="email" name="email" required>
        <p class="text-danger">{{ $errors->first('email') }}</p>
    </div>
    <div class="col-md-12 form-group p_star">
        <label for="">Alamat Lengkap</label>
        <input type="text" class="form-control" id="add1" name="customer_address" required>
        <p class="text-danger">{{ $errors->first('customer_address') }}</p>
    </div>
    <div class="col-md-12 form-group p_star">
        <label for="">Propinsi</label>
        <select class="form-control w-100" name="province_id" id="province_id" required>
            <option value="">Pilih Propinsi</option>
            @foreach ($provinces as $row)
            <option value="{{ $row->id }}">{{ $row->name }}</option>
            @endforeach
        </select>
        <p class="text-danger">{{ $errors->first('province_id') }}</p>
    </div>
    <div class="col-md-12 form-group p_star">
        <label for="">Kabupaten / Kota</label>
        <select class="form-control w-100" name="city_id" id="city_id" required>
            <option value="">Pilih Kabupaten/Kota</option>
        </select>
        <p class="text-danger">{{ $errors->first('city_id') }}</p>
    </div>
    <div class="col-md-12 form-group p_star">
        <label for="">Kecamatan</label>
        <select class="form-control w-100" name="district_id" id="district_id" required>
            <option value="">Pilih Kecamatan</option>
        </select>
        <p class="text-danger">{{ $errors->first('district_id') }}</p>
    </div>
    </div>
    <div class="col-lg-4">
        <div class="order_box">
            <h2>Ringkasan Pesanan</h2>
            <ul class="list">
                <li>
                    <a href="#">Product
                        <span>Total</span>
                    </a>
                </li>
                @foreach ($carts as $cart)
                <li>
                    <a href="#">{{ \Str::limit($cart['name'], 10) }}
                        <span class="middle">x {{ $cart['qty'] }}</span>
                        <span class="last">Rp {{ number_format($cart['price']) }}</span>
                    </a>
                </li>
                @endforeach
            </ul>
            <ul class="list list_2">
                <li>
                    <a href="#">Subtotal
                        <span>Rp {{ number_format($subtotal) }}</span>
                    </a>
                </li>
                <li>
                    <a href="#">Pengiriman
                        <span>Rp 0</span>
                    </a>
                </li>
                <li>
                    <a href="#">Total
                        <span>Rp {{ number_format($subtotal) }}</span>
                    </a>
                </li>
            </ul>
            <button class="main_btn">Bayar Pesanan</button>
</form>
</div>
</div>
</div>
</div>
</div>
</section> --}}
@endsection
@section('script')
<script>
    $(document).ready(function () {
        $('#province_id').on('change', function () {
            $.ajax({
                url: "{{url('/api/city')}}",
                type: "GET",
                data: {
                    province_id: $(this).val()
                },
                success: function (html) {
                    $('#city_id').empty();
                    $('#city_id').append('<option value="">Select City</option>')
                    $.each(html.data, function (key, item) {
                        $('#city_id').append('<option value="' + item.id + '">' +
                            item.name + '</option>');
                    });
                },
            });
        });
        $('#city_id').on('change', function () {
            $.ajax({
                url: "{{ url('/api/district') }}",
                type: "GET",
                data: {
                    city_id: $(this).val()
                },
                success: function (html) {
                    $('#district_id').empty();
                    $('#district_id').append('<option value="">Select District</option>')
                    $.each(html.data, function (key, item) {
                        $('#district_id').append('<option value="' + item.id +
                            '">' + item.name + '</option>');
                    });
                },
            });
        });
    });

</script>
<script>
    $(document).ready(function () {

        $('input').focus(function () {
            $(this).parent().find(".label-txt").addClass('label-active');
        });

        $("input").focusout(function () {
            if ($(this).val() == '') {
                $(this).parent().find(".label-txt").removeClass('label-active');
            };
        });

    });

</script>
@endsection
