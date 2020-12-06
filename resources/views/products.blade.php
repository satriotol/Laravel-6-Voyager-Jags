@extends('layouts.app')
@section('content')
<style>
    .active {
        color: #c0945c;
    }

    img.card-img-top {
        height: 500px;
        width: 100%;
        object-fit: cover;
    }

    @media screen and (max-width: 768px) {
        .products-list {
            margin-top: 2rem;
        }
    }

</style>
<div class="bg-black">
    <div class="container">
        <div class="text-center my-5">
            <h4><span class="active">MAN</span> / <span>WOMAN</span> / CHILD</h4>
        </div>
        <div class="container">
            <div class="border-bottom mb-5">
                <h4>JACKET</h4>
            </div>
            <div class="row products">
                @foreach ($products as $product)
                @if ($product->categories == 'Jacket')
                <div class="products-list col-md-6 col-sm-12 col-lg-4">
                    <a href="{{route('product.show', $product->id)}}">
                        @foreach(json_decode($product->image, true) as $image)
                        @if ($loop->first)
                        <img class="card-img-top" src="{{ Voyager::image($image) }}" />
                        @endif
                        @endforeach
                        <div class="mt-3">
                            <h4 class="text-center">{{$product->name}}</h4>
                    </a>
                    <div class="mt-2 text-center">
                        <p>IDR {{number_format($product -> price,2)}}</p>
                    </div>
                </div>
                @endif
            </div>
            @endforeach
        </div>
        <div class="container">
            <div class="border-bottom mb-5">
                <h4>T-SHIRT</h4>
            </div>
            <div class="row products">
                @foreach ($products as $product)
                @if ($product->categories == 'T-Shirt')
                <div class="products-list col-md-6 col-sm-12 col-lg-4">
                    <a href="{{route('product.show', $product->id)}}">
                        @foreach(json_decode($product->image, true) as $image)
                        @if ($loop->first)
                        <img class="card-img-top" src="{{ Voyager::image($image) }}" />
                        @endif
                        @endforeach
                        <div class="mt-3">
                            <h4 class="text-center">{{$product->name}}</h4>
                    </a>
                    <div class="mt-2 text-center">
                        <p>IDR {{number_format($product -> price,2)}}</p>
                    </div>
                </div>
                @endif
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
