@php
    if(empty($systemVersion)){$systemVersion = "0.5.01 git actions deploy on home";}
    if(empty($userImg)){$userImg = "img/users/user.png";}
    if(empty($email)){$email = Auth::user()->email;}else{$email="email@email.com";}
    $userName = Auth::user()->name;
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'JJLSYSTEM 2') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

        <!-- Scripts -->
        @vite('resources/css/app.css')
    </head>
    <body class="theme-teal">
        <div class="container-fluid">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div>
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
            <section>
                <x-leftsidebar
                    :user-name="$userName"
                    :user-img="$userImg"
                    :email="$email"
                    :system-version="$systemVersion"
                />
            </section>
                <section class="site-content" id="site-content">
                    {{ $slot }}
                </section>
            </main>
        </div>
        @vite('resources/js/app.js')
    </body>
</html>
