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

    .bg-black h4 {
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
        <a class="navbar-brand" href="#">
            <span class="site-title">JAG's</span>
            <p class="site-tagline">We Can Print The Universe</p>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item{{ Request::routeIs('home') ? 'active' : '' }}">
                    <a class="nav-link mx-3" href="{{route('home')}}">HOME <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mx-3" href="#">SALE</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mx-3" href="#">ABOUT US</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mx-3" href="#">CONTACT</a>
                </li>
                <li class="nav-item {{ Request::routeIs('products') ? 'active' : '' }}">
                    <a class="nav-link mx-3" href="{{route('products')}}">PRODUCTS</a>
                </li>
            </ul>
        </div>
    </nav>

    @yield('content')
    <section class="pt-5 container-fluid bg-black mt-5">
        <div class="row text-center mx-5">
            <div class="col-sm-4">
                <h4>Location</h4>
                <div class="mt-3">
                    <p>Semarang, Jawa Tengah Indonesia 50198</p>
                </div>
            </div>
            <div class="col-sm-4">
                <h4>Our hours</h4>
                <div class="mt-3">
                    <p>08:00 AM – 17.00 PM <br>
                        Monday – Friday <br>
                        08:00 AM – 15:00 PM <br>
                        Saturday – Sunday</p>
                </div>
            </div>
            <div class="col-sm-4">
                <h4>Contact Us</h4>
                <div class="mt-3">
                    <div class="mt-3">
                        <p>Email: jagsincorporate@gmail.com</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
    </script>
    <script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>


    <!-- Option 2: jQuery, Popper.js, and Bootstrap JS
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    -->
</body>

</html>
