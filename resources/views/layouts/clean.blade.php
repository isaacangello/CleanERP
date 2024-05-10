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

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="{{Vite::asset('resources/web/materialize/css/materialize.css') }}" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="{{ Vite::asset('resources/web/systheme/plugins/node-waves/waves.css') }}" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="{{ Vite::asset('resources/web/systheme/plugins/animate-css/animate.css') }}" rel="stylesheet" />

    <!-- Morris Chart Css-->
    <link href="{{ Vite::asset('resources/web/systheme/plugins/morrisjs/morris.css') }}" rel="stylesheet" />


    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="{{ Vite::asset('resources/web/systheme/css/themes/all-themes.css') }}" rel="stylesheet" />
    <!-- Custom Css -->
    <link href="{{ Vite::asset('resources/web/systheme/css/style.css') }}" rel="stylesheet">

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
    <div class="search-bar">
        <div class="search-icon">
            <i class="material-icons">search</i>
        </div>
        <input type="text" placeholder="START TYPING...">
        <div class="close-search">
            <i class="material-icons">close</i>
        </div>
    </div>
    <!-- #END# Search Bar -->
    <!-- Top Bar -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="{{route('index')}}">JJL - SYSTEM 2</a>
            </div>
            <div class="nav-item">

            </div>
    </nav>

    <!-- #Top Bar -->



        <div class="container-fluid" style="margin-top: 70px;">
                @yield('content')
        </div>


    <!-- Jquery Core Js -->
    <script src="{{ Vite::asset('resources/web/systheme/plugins/jquery/jquery.min.js') }}"></script>

    <!-- Bootstrap Core Js -->
    <script src="{{ Vite::asset('resources/web/materialize/js/materialize.js') }}"></script>

    <!-- Select Plugin Js -->
    <script src="{{ Vite::asset('resources/web/systheme/plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="{{ Vite::asset('resources/web/systheme/plugins/jquery-slimscroll/jquery.slimscroll.js') }}"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="{{ Vite::asset('resources/web/systheme/plugins/node-waves/waves.js') }}"></script>

    <!-- Jquery CountTo Plugin Js -->
    <script src="{{ Vite::asset('resources/web/systheme/plugins/jquery-countto/jquery.countTo.js') }}"></script>

    <!-- Morris Plugin Js -->
    <script src="{{ Vite::asset('resources/web/systheme/plugins/raphael/raphael.min.js') }}"></script>
    <script src="{{ Vite::asset('resources/web/systheme/plugins/morrisjs/morris.js') }}"></script>

    <!-- ChartJs -->
    <script src="{{ Vite::asset('resources/web/systheme/plugins/chartjs/Chart.bundle.js') }}"></script>

    <!-- Flot Charts Plugin Js -->
    <script src="{{ Vite::asset('resources/web/systheme/plugins/flot-charts/jquery.flot.js') }}"></script>
    <script src="{{ Vite::asset('resources/web/systheme/plugins/flot-charts/jquery.flot.resize.js') }}"></script>
    <script src="{{ Vite::asset('resources/web/systheme/plugins/flot-charts/jquery.flot.pie.js') }}"></script>
    <script src="{{ Vite::asset('resources/web/systheme/plugins/flot-charts/jquery.flot.categories.js') }}"></script>
    <script src="{{ Vite::asset('resources/web/systheme/plugins/flot-charts/jquery.flot.time.js') }}"></script>

    <!-- Sparkline Chart Plugin Js -->
    <script src="{{ Vite::asset('resources/web/systheme/plugins/jquery-sparkline/jquery.sparkline.js') }}"></script>

    <!-- Custom Js -->
    <script src="{{ Vite::asset('resources/web/systheme/js/admin.js') }}"></script>
    <script src="{{ Vite::asset('resources/web/systheme/js/pages/index.js') }}"></script>

    <!-- Demo Js -->
    <script src="{{ Vite::asset('resources/web/systheme/js/demo.js') }}"></script>
    @yield('script-botton')
</body>

</html>


