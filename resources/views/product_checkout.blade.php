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
                    <input type="hidden" name="weight" id="weight" value="{{ $weight }}">
                    <div class="col-md-12 form-group p_star">
                        <label for="">Kurir</label>
                        <select class="form-control" name="courier" id="courier" required>
                            <option value="">Pilih Kurir</option>
                        </select>
                        <p class="text-danger">{{ $errors->first('courier') }}</p>
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
                                <p id="ongkir">IDR 0</p>
                            </div>
                        </div>
                        <div class="items row">
                            <div class="col-5">
                                <h5>TOTAL</h5>
                            </div>
                            <div class="col-3">
                            </div>
                            <div class="col-4">
                                <h5 id="total">IDR {{ number_format($subtotal),2 }}</h5>
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
@endsection
@section('script')
<script>
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
                        item.type + " " +
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
    })
    $('#district_id').on('change', function () {
        $('#courier').empty()
        $('#courier').append('<option value="">Loading...</option>')
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: "{{ url('/api/cost') }}",
            type: "POST",
            data: {
                destination: $(this).val(),weight: $('#weight').val()
            },
            success: function (html) {
                $('#courier').empty()
                $('#courier').append('<option value="">Pilih Kurir</option>')
                $.each(html.data.results, function (key, item) {
                    let courier = item.courier + ' - ' + item.service + ' (IDR ' + item
                        .cost + ')'
                    let value = item.courier + '-' + item.service + '-' + item.cost
                    $('#courier').append('<option value="' + value + '">' + courier +
                        '</option>')
                })
            }
        });
    })
    $('#courier').on('change', function () {
        let split = $(this).val().split('-')
        $('#ongkir').text('IDR ' + split[2])
        let subtotal = "{{ $subtotal }}"
        {{ number_format($subtotal),2 }}
        let total = parseInt(subtotal) + parseInt(split['2'])
        $('#total').text('IDR ' + total)
    })

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
