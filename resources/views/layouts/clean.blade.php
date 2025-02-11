<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=Edge">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <title>
            {{ config('app.name', 'JJL System') }} - Login
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
{{--        @yield('css-style')--}}
{{--        @include('layouts.generic_css')--}}
    @livewireStyles
    @vite('resources/js/app.js')
</head>

<body class=" text-gray-900 antialiased  bg-gradient-to-bl from-[#bdbdbd] to-[#bab5b5] dark:bg-gray-900 " >
    <!-- Top Bar -->
    <div class="h-full max-h-screen w-full flex flex-col  sm:justify-center items-center pt-0 sm:pt-0  bg-gradient-to-bl from-[#bdbdbd] to-[#bab5b5] dark:bg-gray-900" style="height: 100vh">
        <div>
            <a href="/home" wire:navigate>
                <x-old.application-logo src="/img/Logo.png" class="w-32 fill-current rounded-xl text-gray-500" />
            </a>
        </div>

        <div class="w-full sm:max-w-md rounded overflow-hidden sm:rounded-lg">
                {{$slot}}
        </div>
    </div>
    @livewireScriptConfig
</body>

</html>


