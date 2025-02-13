<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="bg-gray-100">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="shortcut icon" href="{{ asset('/favicon.ico') }}" type="image/x-icon">
        <link rel="stylesheet" href="https://kit-pro.fontawesome.com/releases/v5.12.1/css/pro.min.css">
        <title>{{ $title ?? 'JJL System' }}</title>
        @livewireStyles
        @vite('resources/js/app.js')
    </head>
    <body class="bg-gray-100">
        <x-cleopatra.loading  />
        <div  class="w-full h-full" x-cloak x-data="cnf" x-ref="allContent" x-init="$nextTick(() => { pageInit() })">
            <x-cleopatra.navbar  />
            <x-cleopatra.left-sidebar  />
            <div x-ref="mainContent" class="md:ml-64 md:px-3.5 pt-20 transition-all duration-300 ease-in-out">
                {{ $slot }}
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

        @livewireScriptConfig
    </body>
</html>
