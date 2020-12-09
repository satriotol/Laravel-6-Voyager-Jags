@extends('layouts.app')
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
        left: -200px;
        bottom: 200px;
        padding: 0;
        margin-left: 50px;
        list-style: none;
        text-align: center;
        line-height: 1;
    }

    .title-home h4 {
        font-size: 200px;
        color: #FFFAFA;
    }

    .body-home {
        position: absolute;
        bottom: 0px;
        padding: 0;
        margin-left: 50px;
        list-style: none;
        text-align: center;
        line-height: 1;
    }

    .body-home h4 {
        font-size: 40px;
        color: #FFFAFA;
    }

    @media (max-width: 767.98px) {
        .title-home {
            left: -125px;
            bottom: 200px;
        }
        .title-home h4 {
            font-size: 100px;
            color: #FFFAFA;
        }
        .body-home {
            bottom: 100px;
            left: -25px;
        }

        .body-home h4 {
            font-size: 20px;
        }
    }

</style>
<div class="carousel" id="test">
    <div class="carousel-cell">
        <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/82/orange-tree.jpg" alt="orange tree" />
    </div>
    <div class="carousel-cell">
        <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/82/one-world-trade.jpg" alt="One World Trade" />
    </div>
    <div class="carousel-cell">
        <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/82/drizzle.jpg" alt="drizzle" />
    </div>
</div>

{{-- <h4 class="title-h4">J<br>A<br>G<br>S</h4> --}}

@endsection
@section('script')
<script>
    // $(".carousel").after(txt);

</script>
<script>
    var txt1 = "<div class='title-home'><h4>JAGS</h4></div>";
    var txt2 = "<div class='body-home'><h4>WE CAN PRINT THE UNIVERSE</h4></div>";
    $(".carousel").flickity({
        wrapAround: true,
    }).append(txt1, txt2);

</script>
@endsection
