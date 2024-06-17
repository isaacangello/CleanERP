@php
    $systemVersion = "0.7.02";
    use Illuminate\Support\Facades\Vite;
@endphp
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    @yield('title')
    <!-- Favicon-->
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" sizes="180x180" href="img/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="./img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="./img/favicon-16x16.png">
    <link rel="manifest" href="./img/site.webmanifest">
    <link rel="mask-icon" href="./img/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#00a300">
    <meta name="theme-color" content="#ffffff">

    @include('layouts.generic_css')
    <style type="text/css">
    .body_class {
        background-image: url({{ asset('img/Background_login.png') }});
        background-size: 100% 100vh;
        background-repeat: no-repeat;
    }
</style>
</head>

<body class="theme-teal login-page body_class" >
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-teal">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Search Bar -->
{{--    <div class="search-bar">--}}
{{--        <div class="search-icon">--}}
{{--            <i class="material-icons">search</i>--}}
{{--        </div>--}}
{{--        <input type="text" placeholder="START TYPING...">--}}
{{--        <div class="close-search">--}}
{{--            <i class="material-icons">close</i>--}}
{{--        </div>--}}
{{--    </div>--}}
    <!-- #END# Search Bar -->
    <!-- Top Bar -->
    <nav class="navbar">
        <div class="nav-wrapper p-l-20">
                <a class="brand-logo font-16 " href="{{route('index')}}">JJL - SYSTEM 2</a>
        </div>
    </nav>


        <div class="container-fluid" style="margin-top: 70px;">
                @yield('content')
        </div>


   @include('layouts.generic_js')
    @yield('script-botton')
</body>

</html>


