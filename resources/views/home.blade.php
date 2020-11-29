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
        <br>
        @foreach(json_decode($product->image, true) as $image)
        @if ($loop->first)
        <img class="img-thumbnail rounded" src="{{ Voyager::image($image) }}" />
        @endif
        @endforeach
        @endforeach
    </div>
</div>
@endsection
