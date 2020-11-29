@extends('layouts.app')
@section('content')
<style>
    .section{
        background-color: black;
    }
    .section .container{
        background-color: white
    }
</style>
<div class="section py-5">
    <div class="container">
        
        @foreach ($products as $product)
        {{$product -> categories}}
        {{$product -> name}}
        {{$product -> price}}
        @foreach(json_decode($product->image, true) as $image)
        <img src="{{ Voyager::image($image) }}" />
        @endforeach
        @endforeach
    </div>
</div>
@endsection
