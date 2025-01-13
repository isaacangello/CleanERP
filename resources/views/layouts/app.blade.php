@php

    if(empty($systemVersion)){$systemVersion = "0.8.01";}
    if(empty($userImg)){$userImg = "/img/users/user.png";}
    if(!empty(Auth::user()->email)){$email = Auth::user()->email;}else{$email="email@email.com";}
    $userName = Auth::user()->name;
@endphp
        <!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
{{--    @livewireStyles--}}


    @yield('title')
{{--    @if(isset($title)){{ $title??'JJL System 2'   }}@endif--}}

    <!-- Favicon-->
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('./img/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('./img/favicon-16x16.png')}}">
{{--    <link rel="manifest" href="./img/site.webmanifest">--}}
    <link rel="mask-icon" href="{{ asset('./img/safari-pinned-tab.svg') }}" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#00a300">
    <meta name="theme-color" content="#ffffff">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
    {{--@use('Illuminate\Support\Facades\Vite')--}}
    <!-- Animation Css -->
    <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
    />





    {{--<link href="{!! asset('js/node-waves/dist/waves.min.css') !!}" rel="stylesheet" />--}}

    <!-- Materialize Core Css -->
    <link href="{!! asset('web/materialize/css/materialize.css') !!}" rel="stylesheet">
    <!-- jquery ui  Css -->
{{--    <link href="{!! asset('web/jquery-ui/jquery-ui.css') !!}" rel="stylesheet" />--}}
{{--    <!-- Animation Css -->--}}
{{--    <link href="{!! asset('js/animate.css/animate.css') !!}" rel="stylesheet" />--}}


    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="{!! asset('web/systheme/css/themes/all-themes.css') !!}" rel="stylesheet" />
    <!-- Custom Css -->
    <link href="{!! asset('web/custom/mobile.css') !!} " rel="stylesheet">

    <link href="{!! asset('web/systheme/css/style.css') !!}" rel="stylesheet">

    <link href="{!! asset('web/systheme/plugins/lou-multi-select/css/multi-select.css') !!}" rel="stylesheet">

    <link rel="stylesheet" href="{!! asset('web/systheme/css/themes/light.css') !!}">

    <link rel="stylesheet" href="{{  asset('/build/assets/app-306f5f6d.css') }}">
    @vite(['resources/css/app.css','resources/js/app.js'])

    {{--    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">--}}
</head>

<body class="theme-teal">
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
<!-- #END# Search Bar -->
<!-- Top NavBar -->
<nav class="nav-materialize navbar nav">
    <div class="nav-wrapper">

        <ul class="left">
            <li>
                <a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                <a href="#" id="btnCloseMenu"  class="btnCloseMenu hide-on-med-and-down " data-close="true"><i class="material-icons">menu</i></a>
            </li>
            <li class="valign-wrapper p-l-3 p-t-12 center-align">
                <span class="valign-wrapper "> <img src="{{asset('img/android-chrome-256x256.png')}}"  class="logo"  alt="jjl logo"/></span>
            </li>
            <li>
                <span class="person-shadow flow-text hide-on-med-and-down p-l-10" >
                    JJL System 2
                </span>
            </li>
        </ul>
        <ul id="nav-mobile" class="right">
            <li>
                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button">
                    <i class="material-icons" >notifications</i>
                    <span id="label-count-alarm">7</span>
                </a>
            </li>
            <li>
                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button">
                    <i class="material-icons" >flag</i>
                    <span id="label-count-msg">9</span>
                </a>

            </li>


        </ul>
    </div>
</nav>
<!-- #Top Bar  #########################################-->
<!-- Left Sidebar mobile laravel component #########################################-->
<x-mobile-left-sidebar
        :user-name="$userName"
        :user-img="$userImg"
        :email="$email"
        :system-version="$systemVersion"
/>
<!-- Left Sidebar mobile end #########################################-->

<section>
    <!--###### Left Sidebar ######################################### -->
    <aside id="leftsidebar" class="ls-closed sidebar ">
        <!-- User Info -->
        <div class="user-info" id="userInfoDesktop">
            <div class="image">
                <img src="{{asset('/img/users/user.png')}}" width="48" height="48" alt="User"/>
            </div>
            <div class="info-container">
                <div class="name person-shadow" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name }}</div>
                <div class="email person-shadow">{{ Auth::user()->email }}</div>
                <div class="user-helper-dropdown">
                    <div class="flex justify-center">
                        <div
                                x-data="{
                                    openDropDown: false,
                                    toggle() {
                                        if (this.openDropDown) {
                                            return this.close()
                                        }

                                        this.$refs.button.focus()

                                        this.openDropDown = true
                                    },
                                    close(focusAfter) {
                                        if (! this.openDropDown) return

                                        this.openDropDown = false

                                        focusAfter && focusAfter.focus()
                                    }
                                }"
                                x-on:keydown.escape.prevent.stop="close($refs.button)"
                                x-on:focusin.window="! $refs.panel.contains($event.target) && close()"
                                x-id="['dropdown-button']"
                                class="relative"
                        >
                            <!-- Button -->
                            <button
                                    x-ref="button"
                                    x-on:click="toggle()"
                                    :aria-expanded="openDropDown"
                                    :aria-controls="$id('dropdown-button')"
                                    type="button"
                                    class="relative flex items-center whitespace-nowrap justify-center gap-2 py-2 rounded-lg shadow-sm bg-white hover:bg-gray-50 text-gray-800 border border-gray-200 hover:border-gray-200 px-4"
                            >

                                <!-- Heroicon: micro chevron-down -->
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4">
                                    <path fill-rule="evenodd" d="M4.22 6.22a.75.75 0 0 1 1.06 0L8 8.94l2.72-2.72a.75.75 0 1 1 1.06 1.06l-3.25 3.25a.75.75 0 0 1-1.06 0L4.22 7.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                                </svg>
                            </button>

                            <!-- Panel -->
                            <div
                                    x-ref="panel"
                                    x-show="openDropDown"
                                    x-transition.origin.top.left
                                    x-on:click.outside="close($refs.button)"
                                    :id="$id('dropdown-button')"
                                    x-cloak
                                    class="absolute -left-36 min-w-48 text-left  shadow-sm mt-2  origin-top-left bg-white p-1.5 outline-none border border-gray-200"
                                    style="z-index: 9999999"
                            >
                                <a href="{{ route('profile.edit') }}" class="px-2 lg:py-1.5 py-2 w-full flex justify-start rounded-md transition-colors  text-gray-800 hover:bg-gray-50 focus-visible:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed">
                                    <i class="material-icons">person</i><span>Profile</span>
                                </a>

                                <a href="{{route('config')}}" class="px-2 lg:py-1.5 py-2 w-full flex justify-start rounded-md transition-colors text-left text-gray-800 hover:bg-gray-50 focus-visible:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed">
                                    <i class="material-icons">settings_applications</i><span>Config</span>
                                </a>
                                <form action="{{ route('logout') }}" method="post" >
                                    @csrf
                                    <button type="submit" class="px-2 lg:py-1.5 py-2 w-full flex justify-start  rounded-md transition-colors text-left text-gray-800 hover:bg-gray-50 focus-visible:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed">
                                        <i class="material-icons">input</i><span>Sign Out</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- #User Info -->
        <!-- Main Menu -->
        <!--
            material icons
            cleaning_services

        -->
        <div class="menu" id="menu-desktop">
            <ul>
                <x-menu-links />
            </ul>
        </div>
        <!-- #Menu -->
        <!-- Footer -->
        <div class="legal" id="legalDesktop">
            <div class="copyright">
                &copy; 2024 <a href="javascript:void(0);">JJL - SYSTEM 2</a>.
                <b>Version: </b> {{$systemVersion}}
            </div>
        </div>
        <!-- #Footer -->
    </aside>
    <!-- #END# Left Sidebar -->
    <!-- Right Sidebar -->
</section>

<section class="content" id="site-content">
    @yield('content')
    {{$slot??''}}
</section>


{{--@use(Illuminate\Support\Facades\Vite)--}}
<!-- Jquery core js -->
<script  src="{{ asset('web/jquery/jquery-3.7.1.min.js') }}"></script>
<script src="{{asset('web/systheme/plugins/jquery-countto/jquery.countTo.js')}}" />
{{--<!-- Jquery-ui Js -->--}}
{{--<script src="{{ asset('web/jquery-ui/jquery-ui.js') }}"></script>--}}

<!-- Materialize Core Js -->
<script src="{{ asset('web/materialize/js/materialize.min.js') }}"></script>

{{--<!-- Waves Effect Plugin Js -->--}}
{{--<script src="{{ asset('web/systheme/plugins/node-waves/dist/waves.min.js') }}"></script>--}}


<!-- Slimscroll Plugin Js -->
<script src="{{ asset('web/systheme/plugins/jquery-slimscroll/jquery.slimscroll.js') }}"></script>

{{--<!-- Jquery Validation Plugin Css -->--}}
{{--<script src="{{ asset('web/systheme/plugins/jquery-validation/jquery.validate.js') }}"></script>--}}

{{--<!-- JQuery Steps Plugin Js -->--}}
{{--<script src="{{ asset('web/systheme/plugins/jquery-steps/jquery.steps.js') }}"></script>--}}

{{--<!-- Sweet Alert Plugin Js -->--}}
{{--<!--Added version 2 -->--}}

{{--<script src="{{ asset('node_modules/sweetalert2/dist/sweetalert2.all.min.js') }}"></script>--}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Custom Js -->
<script type="module" src="{{ asset('web/systheme/js/admin.js') }}"></script>
<script src="{{ asset('web/systheme/js/pages/index.js') }}"></script>

<!-- Demo Js -->
<script src="{{ asset('web/systheme/js/demo.js')}}"></script>
<script src="{{ asset('web/systheme/js/systheme.js') }}"></script>
<script src="{{ asset('web/systheme/plugins/lou-multi-select/js/jquery.multi-select.js') }}"></script>

<script src="{{ asset('web/systheme/plugins/moment/min/moment.min.js') }}"></script>

<script  src="{{ asset('web/custom/helpers/plugins_init.js') }}"></script>


<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
{{--<script src="{{ asset('js/materialize-css/js/sidenav.js') }}"></script>--}}
<script src="{{asset('build/assets/app-21de2618.js')}}"></script>

</body>

</html>

