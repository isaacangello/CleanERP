@php
    $systemVersion = "0.7.02";
    use Illuminate\Support\Facades\Vite;
@endphp
        <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=Edge">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <title>
            @yield('title')
        </title>
        <!-- Favicon-->
        <link rel="icon" href="favicon.ico" type="image/x-icon">
        <link rel="apple-touch-icon" sizes="180x180" href="img/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="./img/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="./img/favicon-16x16.png">
        <link rel="manifest" href="./img/site.webmanifest">
        <link rel="mask-icon" href="./img/safari-pinned-tab.svg" color="#5bbad5">
        <meta name="msapplication-TileColor" content="#00a300">
        <meta name="theme-color" content="#ffffff">
        @yield('css-style')
        @include('layouts.generic_css')
</head>

<body class="theme-teal  text-gray-900 antialiased  bg-gradient-to-bl from-[#bdbdbd] to-[#bab5b5] dark:bg-gray-900 " >
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

    <div class="h-full max-h-screen w-full flex flex-col  sm:justify-center items-center pt-0 sm:pt-0  bg-gradient-to-bl from-[#bdbdbd] to-[#bab5b5] dark:bg-gray-900" style="height: 100vh">
        <div>
            <a href="/home" wire:navigate>
                <x-application-logo src="/img/Logo.png" class="w-32 fill-current rounded-xl text-gray-500" />
            </a>
        </div>

        <div class="w-full sm:max-w-md rounded overflow-hidden sm:rounded-lg">
                @yield('content')
        </div>

    </div>
   @include('layouts.generic_js')
    @yield('script-botton')
</body>

</html>


