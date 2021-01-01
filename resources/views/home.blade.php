@extends('layouts.app')
@section('title')
    HOME
@endsection
@section('content')
<style>
    .carousel-cell {
        width: 100%;
        /* full width */
        height: 1000px;
        /* height of carousel */
        margin-right: 10px;
        display: flex;
    }

    .carousel-cell img {
        display: block;
        height: 100%;
        width: 100%;
        object-fit: cover;
    }

    /* position dots in carousel */
    .flickity-page-dots {
        bottom: 50px;
    }

    /* white circles */
    .flickity-page-dots .dot {
        width: 12px;
        height: 12px;
        opacity: 1;
        background: transparent;
        border: 2px solid white;
    }

    /* fill-in selected dot */
    .flickity-page-dots .dot.is-selected {
        background: white;
    }

    .title-home {
        transform: rotate(90deg);
        position: absolute;
        left: -150px;
        bottom: 200px;
        padding: 0;
        margin-left: 50px;
        list-style: none;
        text-align: center;
        line-height: 1;
    }

    .title-home h4 {
        font-size: 140px;
        color: #FFFAFA;
    }

    .body-home {
        position: absolute;
        bottom: 0px;
        padding: 0;
        left: 100px;
        list-style: none;
        text-align: center;
        line-height: 1;
    }

    .body-home h4 {
        font-size: 40px;
        color: #FFFAFA;
    }

    .categories-layer {
        position: absolute;
        top: 900px;
        z-index: 1;
        width: 100%;
    }

    .categories-home {
        position: absolute;
        bottom: 100px;
        padding: 0;
        list-style: none;
        text-align: center;
        line-height: 1;
    }

    .shop-btn {
        bottom: 500px;
    }

    .shop-btn a {
        min-width: 250px;
        max-width: 250px;
        font-weight: 600;
        border: 5px solid #343a40;
        border-radius: 25px;
    }

    @media (max-width: 767.98px) {
        .title-home {
            left: -125px;
            bottom: 150px;
        }

        .title-home h4 {
            font-size: 70px;
            color: #FFFAFA;
        }

        .body-home {
            bottom: 50px;
            left: 25px;
        }

        .body-home h4 {
            font-size: 20px;
        }

        .categories-layer {
            position: absolute;
            top: 800px;
            z-index: 1;
            width: 100%;
        }
        .categories-layer h4{
            font-size: 20px;
        }
    }

</style>
<div class="categories-layer">
    <div class='container-fluid categories-home'>
        <h4 class='text-white'><a href='#men' class='text-white text-decoration-none'>
            <span id="men-txt" class='cat font-weight-bold'>MAN</span></a> / 
            <a href='#women'class='text-white text-decoration-none'><span id="women-txt" class='cat font-weight-bold'>WOMEN</span> </a> / 
            <a href='#child' class='text-white text-decoration-none'><span id="child-txt" class='cat font-weight-bold'>CHILD</span> </a>
        </h4>
    </div>
</div>


<div class="carousel" id="test">
    <div class="carousel-cell" id="men">
        <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/82/orange-tree.jpg" alt="orange tree" />
    </div>
    <div class="carousel-cell" id="women">
        <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/82/one-world-trade.jpg" alt="One World Trade" />
    </div>
    <div class="carousel-cell" id="child">
        <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/82/drizzle.jpg" alt="drizzle" />
    </div>
</div>


{{-- <h4 class="title-h4">J<br>A<br>G<br>S</h4> --}}

@endsection
@section('script')
<script>
    var txt1 = "<div class='title-home'><h4>JAGGS</h4></div>";
    var txt2 = "<div class='body-home'><h4>WE SPOKE FOR QUALITY</h4></div>";
    var shopnow =
        "<div class='shop-btn text-center w-100 position-absolute'><a href='{{ route('products') }}' class='btn btn-dark'>SHOP NOW</a></div>";
    var categories =
        "<div class='container categories-home'><h4 class='text-white'><a href='#men' class='text-white text-decoration-none'><span class='cat cat-active font-weight-bold'>MAN</span></a> / <a href='#women' class='text-white text-decoration-none'><span class='cat font-weight-bold'>WOMEN</span> </a> / <a href='#child' class='text-white text-decoration-none'><span class='cat font-weight-bold'>CHILD</span> </a></h4></div>"
    $(".carousel").flickity({
        wrapAround: true,
        hash: true,
        pageDots: false,
        prevNextButtons: false,
        draggable: false
    }).append(txt1, txt2, shopnow);

</script>
<script>
    $(document).ready(function () {
        $(".cat").click(function () {
            $(".cat").removeClass("cat-active");
            $(this).addClass("cat-active");
        });
        if (location.hash === "#child") {
            $("#men-txt").removeClass("cat-active");
            $("#women-txt").removeClass("cat-active");
            $("#child-txt").addClass("cat-active");
        }
        else if (location.hash === "#men" || location.hash === ""){
            $("#men-txt").addClass("cat-active");
            $("#women-txt").removeClass("cat-active");
            $("#child-txt").removeClass("cat-active");
        }
        else{
            $("#men-txt").removeClass("cat-active");
            $("#women-txt").addClass("cat-active");
            $("#child-txt").removeClass("cat-active");
        }
    });

</script>
@endsection
