<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Scripts -->



    <!--oneschool-->

    <link href="https://fonts.googleapis.com/css?family=Muli:300,400,700,900" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('oneschool/css/sb-admin-2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('oneschool/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('oneschool/css/jquery-ui.css')}}">
    <link rel="stylesheet" href="{{ asset('oneschool/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{ asset('oneschool/css/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{ asset('oneschool/css/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{ asset('oneschool/css/jquery.fancybox.min.css')}}">
    <link rel="stylesheet" href="{{ asset('oneschool/css/bootstrap-datepicker.css')}}">
    <link rel="stylesheet" href="{{ asset('oneschool/fonts/flaticon/font/flaticon.css')}}">
    <link rel="stylesheet" href="{{ asset('oneschool/css/aos.css')}}">
    <link rel="stylesheet" href="{{ asset('oneschool/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/dropdownmenu.css')}}">

    <!--clever-->
    <link rel="icon" href="{{ asset('clever/img/core-img/favicon.ico') }}">

    <!-- Stylesheet -->
    <link rel="stylesheet" href="{{ asset('clever/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('clever/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('clever/css/classy-nav.min.css') }}">
    <link rel="stylesheet" href="{{ asset('clever/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('clever/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('clever/css/owl.carousel.min.css') }}">
    @yield('style')
    <!--skwela-->







</head>
<body>
<div id="preloader">
    <div class="spinner"></div>
</div>

<div id="app">
    @include('layouts.student-navbar')
    @section('classnav')
        @yield('classnav')

    @endsection
    @yield('start')
    <main class=" ">
        <div class="container-fluid" style="padding-left: -20px">
            <div class="row"></div>
            @yield('content')
        </div>
    </main>
</div>



<!-- ##### Footer Area Start ##### -->
<footer class="footer-area sticky-bottom mt-5">
    <!-- Top Footer Area -->
    <div class="top-footer-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- Footer Logo -->
                    <div class="footer-logo">
                        <a href="index.html"><img src="img/core-img/logo2.png" alt=""></a>
                    </div>
                    <!-- Copywrite -->
                    <p><a href="#"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved  RemoteClassroom <i class="fa fa-heart-o" aria-hidden="true"></i></a>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom Footer Area -->
    <div class="bottom-footer-area d-flex justify-content-between align-items-center">
        <!-- Contact Info -->
        <div class="contact-info">
            <a href="#"><span>Phone:</span> +XXX X XXX XXX</a>
            <a href="#"><span>Email:</span> info@remoteclassroom.com</a>
        </div>

    </div>
</footer>


<!--onechool-->


<script src="{{ asset('oneschool/js/jquery-3.3.1.min.js')}}"></script>
<script src="{{ asset('oneschool/js/jquery-migrate-3.0.1.min.js')}}"></script>
<script src="{{ asset('oneschool/js/jquery-ui.js')}}"></script>
<script src="{{ asset('oneschool/js/popper.min.js')}}"></script>
<script src="{{ asset('oneschool/js/bootstrap.min.js')}}"></script>
<script src="{{ asset('oneschool/js/owl.carousel.min.js')}}"></script>
<script src="{{ asset('oneschool/js/jquery.stellar.min.js')}}"></script>
<script src="{{ asset('oneschool/js/jquery.countdown.min.js')}}"></script>
<script src="{{ asset('oneschool/js/bootstrap-datepicker.min.js')}}"></script>
<script src="{{ asset('oneschool/js/jquery.easing.1.3.js')}}"></script>
<script src="{{ asset('oneschool/js/aos.js')}}"></script>
<script src="{{ asset('oneschool/js/jquery.fancybox.min.js')}}"></script>
<script src="{{ asset('oneschool/js/jquery.sticky.js')}}"></script>
<script src="{{ asset('oneschool/js/main.js')}}"></script>

<script src="{{ asset('clever/js/main.js')}}"></script>
<!--clever-->
<!-- All Plugins js -->
<script src="{{ asset('clever/js/plugins/plugins.js')}}"></script>
<!-- Active js -->
<script src="{{ asset('clever/js/active.js')}}"></script>

<!-- ##### All Javascript Script ##### -->
<!-- jQuery-2.2.4 js -->
<script src="{{ asset('clever/js/jquery/jquery-2.2.4.min.js')}}"></script>
<!-- Popper js -->
<script src="{{ asset('clever/js/bootstrap/popper.min.js')}}"></script>
<!-- Bootstrap js -->
<script src="{{ asset('clever/js/bootstrap/bootstrap.min.js')}}"></script>
<script src="{{ asset('js/flipdown.js')}}"></script>
<script src="{{asset('js/countdown.js')}}"></script>
<script>

    @yield('script')

</script>
</body>
</html>
