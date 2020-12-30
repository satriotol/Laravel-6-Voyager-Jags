<section class="bg-black">
    <div class="container">
        <div class="bg-white p-4 mt-3 rounded-50">
            <div class="checkout-body p-5">
                <div class="row">
                    <div class="col-md-6">
                        <h3>JAGS Invoice</h3>
                    </div>
                    <div class="col-md-6 text-right">
                        <h4>Invoice : {{$data['invoice']}}</h4>
                        <h4>Created : {{$data['created_at']}}</h4>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-md-6">
                        <h4>{{$data['address']}}</h4>
                        <h4>{{$data['province']}}</h4>
                        <h4>{{$data['city']}},{{$data['district']}}</h4>
                    </div>
                    <div class="col-md-6 text-right">
                        <h4>{{$data['name']}}</h4>
                        <h4>{{$data['email']}}</h4>
                        <h4>{{$data['phone_number']}}</h4>
                    </div>
                </div>
                <div class="table-responsive mt-5">
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
                        {{-- @foreach ($orderdetails as $o)
                        @if ($o->order_id === $order->id)
                            <tr>
                                <td>{{$o->product->name}}</td>
                        <td>{{$o->qty}}</td>
                        <td>IDR {{number_format($o->price,2)}}</td>
                        <td>IDR {{ number_format($o->price * $o->qty,2) }}</td>
                        </tr>
                        @endif
                        @endforeach --}}
                        <tr>
                            <th colspan="3" class="text-center">SHIPPING</th>
                            <td>IDR {{number_format($data['cost'],2)}}</td>
                        </tr>
                        <tr>
                            <th colspan="3" class="text-center">TOTAL</th>
                            <td>IDR {{number_format($data['subtotal'] + $data['cost'],2)}}</td>
                        </tr>
                        </tbody>
                    </table>
                    <div class="mt-5">
                        <p class="text-dark">Please check your e-mail for more information <br>
                            or you can contact our admin via whatsapp <br>
                            open your invoice <a href="{{url('')}}/checkout/{{$data['invoice']}}">this</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
