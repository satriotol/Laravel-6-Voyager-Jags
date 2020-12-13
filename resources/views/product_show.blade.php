@extends('layouts.app')
@section('content')
<div class="container my-5">
    <div class="row bg-black">
        <div class="col-md-4">
            @foreach(json_decode($product->image, true) as $image)
            @if ($loop->first)
            <img class="card-img-top" src="{{ Voyager::image($image) }}" />
            @endif
            @endforeach
        </div>
        <div class="col-md-8">
            <div class="row">
                <div class="col-md-8">
                    <h4>{{$product->name}}</h4>
                </div>
                <div class="col-md-4">
                    <h4>IDR {{number_format($product -> price,2)}}</h4>
                    <form action="" method="post">
                        @csrf
                        <input type="submit" class="btn btn-light w-100" value="ORDER NOW">
                        <input type="text" value="{{$product->name}}">
                        <input type="text" value="{{number_format($product->price,2)}}">
                        <input type="text" class="input-test">
                        <input type="text" class="input-colour">
                    </form>
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
