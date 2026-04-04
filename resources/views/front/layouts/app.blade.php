<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'AGEPIF - Agence Immobilière de Prestige en Côte d\'Ivoire')</title>

    <!-- Bootstrap -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Needed CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/icofont.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/stellarnav.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/featherlight.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/featherlight.gallery.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/hover.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/flexslider.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/slick.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/slick-theme.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/jquery-ui.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/animations.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/animate.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/morphext.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/jquery.mb.YTPlayer.min.css') }}">

    <!-- Main stylesheet -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    <!-- Responsive stylesheet -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/responsive.css') }}">

    <!-- Favicon -->
    <link href="{{ asset('assets/images/favicon.png') }}" rel="shortcut icon" type="image/png">
    <link href="{{ asset('assets/images/apple-icon.png') }}" rel="icon" type="image/png">

    @stack('styles')
</head>

<body>
    <div id="preloader"></div>

    <!-- Main Header Start -->
    @include('front.layouts.partials.nav')
    <!-- Main Header End -->

    <!-- Main Content Start -->
    <main>
        @yield('content')
    </main>
    <!-- Main Content End -->

    <!-- Brand start from here -->
    <section class="at-brand-sec">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="brand-carousel" data-slick='{"slidesToShow": 6, "slidesToScroll": 1}'>
                        <div class="item">
                            <a href="#"><img src="{{ asset('assets/images/brand/1.jpg') }}" alt="Partenaire"></a>
                        </div>
                        <div class="item">
                            <a href="#"><img src="{{ asset('assets/images/brand/2.jpg') }}" alt="Partenaire"></a>
                        </div>
                        <div class="item">
                            <a href="#"><img src="{{ asset('assets/images/brand/3.jpg') }}" alt="Partenaire"></a>
                        </div>
                        <div class="item">
                            <a href="#"><img src="{{ asset('assets/images/brand/4.jpg') }}" alt="Partenaire"></a>
                        </div>
                        <div class="item">
                            <a href="#"><img src="{{ asset('assets/images/brand/5.jpg') }}" alt="Partenaire"></a>
                        </div>
                        <div class="item">
                            <a href="#"><img src="{{ asset('assets/images/brand/6.jpg') }}" alt="Partenaire"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Brand End -->

    <!-- footer start from here -->
    @include('front.layouts.partials.footer')
    <!-- footer end -->

    <!-- jQuery -->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="{{ asset('assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>

    <!-- all plugins and JavaScript -->
    <script src="{{ asset('assets/js/css3-animate-it.js') }}"></script>
    <script src="{{ asset('assets/js/stellarnav.min.js') }}"></script>
    <script src="{{ asset('assets/js/featherlight.min.js') }}"></script>
    <script src="{{ asset('assets/js/featherlight.gallery.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.flexslider.js') }}"></script>
    <script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/js/jarallax.js') }}"></script>
    <script src="{{ asset('assets/js/slick.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-ui.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-scrolltofixed-min.js') }}"></script>
    <script src="{{ asset('assets/js/morphext.min.js') }}"></script>
    <script src="{{ asset('assets/js/dyscrollup.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.ripples.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.mb.YTPlayer.min.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>

    <!-- Main Custom JS -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

    @stack('scripts')
</body>

</html>
