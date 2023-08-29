@php
    if(empty($systemVersion)){$systemVersion = "0.5.01 git actions deploy on home";}
    if(empty($userImg)){$userImg = "img/users/user.png";}
    if(empty($email)){$email = Auth::user()->email;}else{$email="email@email.com";}
    $userName = Auth::user()->name;
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
    @yield('css-style')
    <link href="web-resources/custom/mobile.css" rel="stylesheet">
    @yield('script-top')
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
<nav class="navbar nav">
    <div class="nav-wrapper">
         <a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>
        <a href="#" id="hide-left-sidebar"  class="hide-left-sidebar brand-logo hide-on-med-and-down " data-close="true"><i class="material-icons">menu</i></a>
        <a href="javascript:void(0);" id="jjl-logo" class="brand-logo  person-shadow hide-on-med-and-down">
            <img src="img/android-chrome-256x256.png"   class="logo " alt="jjl logo"/>
        </a>
        <a href="javascript:void(0);" id="jjl-text" class=" brand-logo m-l-100 person-shadow flow-text hide-on-med-and-down" >
            JJL System 2
        </a>
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
    <aside id="leftsidebar" class="sidebar">
        <!-- User Info -->
        <div class="user-info">
            <div class="image">
                <img src="img/users/user.png" width="48" height="48" alt="User"/>
            </div>
            <div class="info-container">
                <div class="name person-shadow" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name }}</div>
                <div class="email person-shadow">{{ Auth::user()->email }}</div>
                <div class="user-helper-dropdown">
                    <a href="#" id="buton-user-dropdown" data-target='dropdown-left-sidebar'><i class="material-icons white-text">keyboard_arrow_down</i></a>
                    <ul id="dropdown-left-sidebar" class='z-depth-4 scale-transition scale-out scale-in'>
                        <li><a href="javascript:void(0);" class="waves-effect waves-classic waves-light"><i class="material-icons">person</i><span>Profile</span></a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="javascript:void(0);" class="waves-effect waves-classic waves-light"><i class="material-icons">settings_applications</i><span>Config</span></a></li>
                        <li role="separator" class="divider"></li>
                        <li>
                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <button type="submit" class="waves-effect waves-classic" style="border:none"><i class="material-icons">input</i><span>Sign Out</span> </button>
                            </form>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
        <!-- #User Info -->
        <!-- Main Menu -->
        <!--
            material icons
            cleaning_services

        -->
        <div class="menu">
            <ul class="list">
                <li class="header">MAIN NAVIGATION</li>
                <li class="active">
                    <a href="{{route('home')}}">
                        <i class="material-icons">home</i>
                        <span>Home</span>
                    </a>
                </li>
                <li class="header">
                    <span>SERVICES</span>
                </li>
                <li>
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">house</i>
                        <span>Residencial</span>
                    </a>
                    <ul class="ml-menu">
                        <li>
                            <a href="javascript:void(0);">
                                <i class="material-icons" style="font-size: 20px;">today</i>
                                <span>Services today</span>
                            </a>
                            <a href="javascript:void(0);">
                                <i class="material-icons" style="font-size: 20px;">calendar_view_week</i>
                                <span>Services Week</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">factory</i>
                        <span>Comercial</span>
                    </a>
                    <ul class="ml-menu">
                        <li>
                            <a href="javascript:void(0);">
                                <i class="material-icons" style="font-size: 20px;">today</i>
                                <span>Services today</span>
                            </a>
                            <a href="javascript:void(0);">
                                <i class="material-icons" style="font-size: 20px;">calendar_view_week</i>
                                <span>Services Week</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="header">
                    <span>REGISTER / VIEW</span>
                </li>
                <li>
                    <a href="{{route('customers')}}">
                        <i class="material-icons" style="font-size: 20px;">group_add</i>
                        <span>Customers</span>
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0);">
                        <i class="material-icons" style="font-size: 20px;">badge</i>
                        <span>Employees</span>
                    </a>
                </li>

                <li class="header">
                    <span>FINANCES</span>
                </li>
                <li>
                    <a href="javascript:void(0);">
                        <i class="material-icons">price_change</i>
                        <span>Home</span>
                    </a>
                </li>
                <li class="header">
                    <span>AGENDA CO.</span>
                </li>
                <li>
                    <a href="javascript:void(0);">
                        <i class="material-icons">free_cancellation</i>
                        <span>Tasks</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- #Menu -->
        <!-- Footer -->
        <div class="legal">
            <div class="copyright">
                &copy; 2023 <a href="javascript:void(0);">JJL - SYSTEM 2</a>.
            </div>
            <div class="version">
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
</section>
@yield('script-botton')
</body>

</html>

