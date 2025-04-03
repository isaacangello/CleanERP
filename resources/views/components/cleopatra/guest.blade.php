<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="text-gray-900 antialiased  bg-gradient-to-bl from-[#bdbdbd] to-[#bab5b5] dark:bg-gray-900 ">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="{{ asset('/favicon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://kit-pro.fontawesome.com/releases/v5.12.1/css/pro.min.css">
    <title>{{ $title ?? 'CleanERP' }}</title>
    @livewireStyles
    @vite('resources/js/app.js')
</head>
<body class="block text-gray-900 antialiased  bg-gradient-to-bl  from-gray-300 to-gray-400 dark:bg-gray-900 overflow-hidden "
    style="
    background: rgb(209,213,219);
    background: linear-gradient(188deg, rgba(209,213,219,0.01) 10%, rgba(156,163,175,1) 100%);
    "
>
    <x-cleopatra.loading  />

        {{ $slot }}


    @livewireScriptConfig
</body>
</html>
