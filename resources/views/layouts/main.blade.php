<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
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
       <div class="w-full block" x-data="cnf">
            <div x-init="console.log($refs.leftSideBar);sidebarInit()">
            <x-cleopatra.navbar />
            </div>
            <div>
            <x-cleopatra.left-sidebar />
            </div>
            {{ $slot }}
        </div>
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

        @livewireScriptConfig
    </body>
</html>
function colog() {

}
