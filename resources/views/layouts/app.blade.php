<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>@yield('title')</title>
</head>
<style>
    body {
        font-family: "AWConquerorCarvedOne", sans-serif;
        background-color: black !important;
    }

    .bg-dark {
        background-color: black !important;
    }

    .orange-color {
        color: #c0945c;
    }

    .color-grey {
        color: #c4c4c4;

    }

    p {
        color: #c4c4c4;
    }

    .navbar-dark .navbar-nav .nav-link {
        color: white;
        font-weight: bolder;
    }

    .navbar-dark .navbar-nav .nav-link:focus,
    .navbar-dark .navbar-nav .nav-link:hover {
        color: #c0945c;
        transition: color .1s ease-in-out;
    }
    .cat-active{
        color: #c0945c;
    }

    .navbar-dark .navbar-nav .active>.nav-link,
    .navbar-dark .navbar-nav .nav-link.active,
    .navbar-dark .navbar-nav .nav-link.show,
    .navbar-dark .navbar-nav .show>.nav-link {
        color: #c0945c;
    }

    .nopadding {
        padding: 0 !important;
        margin: 0 !important;
    }

    .site-title {
        font-size: 40px;
        line-height: 1;
        margin-bottom: 0;
        text-transform: uppercase;
        font-family: Raleway, sans-serif;
    }

    .site-tagline {
        color: #999;
        font-family: "Libre Baskerville", serif;
        font-style: italic;
        margin-bottom: 0;
        font-size: 13px;
    }


    /* flicky */
    .carousel {
        background: black;
    }

    .carousel-cell {
        margin-right: 20px;
        overflow: hidden;
    }

    .carousel-cell img {
        display: block;
        height: 500px;
    }

    .centered {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    .centered-down {
        position: absolute;
        top: 60%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    @media screen and (min-width: 768px) {
        .carousel-cell img {
            height: 500px;
        }

        .centered {
            position: absolute;
            top: 75%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .centered-down {
            position: absolute;
            top: 85%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
    }

    .bg-black {
        background-color: black;
    }

    .bg-black h1,
    .bg-black h2,
    .bg-black h3,
    .bg-black h4,
    .bg-black h5 {
        font-weight: bold;
        color: white;
    }

    .bg-white {
        background-color: white
    }

    .bg-white h4 {
        font-weight: bold;
        color: black;
    }

</style>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-5 p-3">
        <a class="navbar-brand" href="{{route('home')}}">
            <span class="site-title">JAG's</span>
            <p class="site-tagline">We Spoke For Quality</p>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto text-center">
                <li class="nav-item{{ Request::routeIs('home') ? ' active' : '' }}">
                    <a class="nav-link mx-3" href="{{route('home')}}">HOME <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mx-3" href="#">SALE</a>
                </li>
                <li class="nav-item {{ Request::routeIs('products','product.show') ? 'active' : '' }}">
                    <a class="nav-link mx-3" href="{{route('products')}}">PRODUCTS</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mx-3" href="#">ABOUT US</a>
                </li>
                <li class="nav-item{{ Request::routeIs('contact') ? ' active' : '' }}">
                    <a class="nav-link mx-3" href="{{route('contact')}}">CONTACT</a>
                </li>
            </ul>
            <ul class="navbar-nav text-center">
                <li class="nav-item">
                    <a class="nav-link text-decoration-none {{ Request::routeIs('front.list_cart') ? ' active' : '' }}" href="{{route('front.list_cart')}}"><i class="fa fa-shopping-cart fa-lg"
                            aria-hidden="true">
                            {{-- <span>{{count($carts)}}</span> --}}
                        </i></a>
                </li>
            </ul>
        </div>
    </nav>

    @yield('content')
    <section class="pt-5 container-fluid bg-black pb-5">
        <div class="container">
            <div class="text-right">
                <p><span style="color: white" class="font-weight-bold">JAGS.ID </span>All Right Reserved.</p>
            </div>
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
    </script>
    <script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
    <script src="https://unpkg.com/flickity-hash@1/hash.js"></script>
    @yield('script')

</body>

</html>
