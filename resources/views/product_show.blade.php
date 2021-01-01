<style>
    .flickity-enabled {
        position: relative;
    }

    .flickity-enabled:focus {
        outline: none;
    }

    .flickity-viewport {
        overflow: hidden;
        position: relative;
        height: 100%;
    }

    .flickity-slider {
        position: absolute;
        width: 100%;
        height: 100%;
    }

    /* draggable */

    .flickity-enabled.is-draggable {
        -webkit-tap-highlight-color: transparent;
        tap-highlight-color: transparent;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }

    .flickity-enabled.is-draggable .flickity-viewport {
        cursor: move;
        cursor: -webkit-grab;
        cursor: grab;
    }

    .flickity-enabled.is-draggable .flickity-viewport.is-pointer-down {
        cursor: -webkit-grabbing;
        cursor: grabbing;
    }

    .carousel-main {
        margin-bottom: 8px;
    }

    .carousel-cell {
        width: 100%;
        height: 504px;
        margin-right: 8px;
        /* counter-increment: carousel-cell; */
    }
    .carousel-nav .carousel-cell {
        height: 90px;
        width: 120px;
    }

    .carousel-main img {
        display: block;
        margin: 0 auto;
    }

    .container {
        max-width: 672px;
        margin: 0 auto;
    }

</style>
@extends('layouts.app')
@section('content')
<div class="container my-5">
    @if (session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{session()->get('success')}}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    <div class="row bg-black">
        <div class="col-md-4">
            <div class="carousel carousel-main" data-flickity='{"pageDots": false,"prevNextButtons": false }'>
                @foreach(json_decode($product->image, true) as $image)
                <div class="carousel-cell"> <img style="object-fit: cover;" class="card-img-top" src="{{ Voyager::image($image) }}" /></div>
                @endforeach
            </div>
            <div class="carousel carousel-nav"
                data-flickity='{ "asNavFor": ".carousel-main", "contain": true, "pageDots": false,"prevNextButtons": false }'>
                @foreach(json_decode($product->image, true) as $image)
                <div class="carousel-cell"><img class="card-img-top" style="height: 100%;object-fit: contain;" src="{{ Voyager::image($image) }}" /></div>
                @endforeach
            </div>
        </div>
        <div class="col-md-8">
            <div class="row">
                <div class="col-md-8">
                    <h4>{{$product->name}}</h4>
                </div>
                <div class="col-md-4">
                    <h4>IDR {{number_format($product -> price,2)}}</h4>
                    <form action="{{ route('front.cart') }}" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{$product->id}}">
                        <input type="hidden" name="name" value="{{$product->name}}">
                        <input type="hidden" name="price" value="{{number_format($product->price,2)}}">
                        <input type="hidden" name="size" class="input-test">
                        <input type="hidden" name="colour" class="input-colour">
                        <input type="hidden" name="weight" value="{{$product->weight}}">
                        <input class="qty" type="hidden" name="qty" id="sst" value="1">
                        {{-- <button
                            onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst )) result.value++;return false;"
                            class="increase items-count" type="button">
                            <i class="lnr lnr-chevron-up"></i>
                        </button>
                        <button
                            onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst ) &amp;&amp; sst > 0 ) result.value--;return false;"
                            class="reduced items-count" type="button">
                            <i class="lnr lnr-chevron-down"></i>
                        </button> --}}
                        <input type="submit" class="btn btn-light w-100" value="ADD TO CART">
                    </form>
                    {{-- <a href="https://wa.me/089620755330?text=Hi Jags I Want to Order : {{$product->name}}"
                    class="btn btn-light w-100" value="Order Now"></a> --}}
                    <p>Your Size is <span class="p-size">None</span></p>
                    <p>Your Colour is <span class="p-colour">None</span></p>
                </div>
            </div>
            <div class="mt-5">
                <h5>Description :</h5>
                <p>{!!$product->description!!}</p>
            </div>
            <div class="mt-5">
                <h5>Size Chart :</h5>
                <div class="row">
                    @if (!empty($product->size) > 0)
                    @foreach(json_decode($product->size, true) as $size)
                    <div class="col-sm-4 mt-2">
                        <input type="button" class="btn-size btn btn-light w-100 text-center" value="{{$size}}">
                    </div>
                    @endforeach
                </div>
                @else
                <div class="col-sm-4">
                    <p>Kosong</p>
                </div>
                @endif
            </div>
            <div class="mt-5">
                <h5>Colour : </h5>
                <div class="row">
                    @if (!empty($product->colour)>0)
                    @foreach(json_decode($product->colour, true) as $colour)
                    <div class="col-sm-4 mt-2">
                        <input type="button" class="btn-colour btn btn-light w-100 text-center" value="{{$colour}}">
                    </div>
                    @endforeach
                    @else
                    <div class="col-sm-4">
                        <p>Kosong</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container mt-5 bg-black">
    <h4 class="border-bottom">Related Product</h4>
    <div class="row">
        @foreach ($products as $p)
        @if ($p->categories == $product->categories)
        <div class="col-sm-6 col-md-4">
            @foreach(json_decode($p->image, true) as $image)
            @if ($loop->first)
            <img class="card-img-top" src="{{ Voyager::image($image) }}" />
            @endif
            @endforeach
            <div class="text-right mt-2">
                <h4>{{$p->name}}</h4>
                <p>IDR {{number_format($p -> price,2)}}</p>
            </div>
        </div>
        @endif
        @endforeach
    </div>
</div>
@endsection
@section('script')
<script>
    $(".btn-size").click(function () {
        var text = $(this).val();
        $(".input-test").val(text);
        $(".p-size").text(text);
    });
    $(".btn-colour").click(function () {
        var text = $(this).val();
        $(".input-colour").val(text);
        $(".p-colour").text(text);
    })

</script>
@endsection
