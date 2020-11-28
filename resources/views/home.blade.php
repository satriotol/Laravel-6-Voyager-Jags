<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    @foreach ($products as $product)
    {{$product -> categories}}
    {{$product -> name}}
    {{$product -> price}}
    @foreach(json_decode($product->image, true) as $image)
    <div @if ($loop->first) style="background-color:black" @endif>
        <img src="{{ Voyager::image($image) }}" />
    </div>
    @endforeach
    @endforeach
</body>

</html>
