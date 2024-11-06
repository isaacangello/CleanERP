<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'JJL System 2') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
{{--        @vite(['resources/css/app.css', 'resources/js/app.js'])--}}
        @include('layouts.generic_css')
        <style>
            input.form-control {
                margin-bottom: 0px!important;
                border-bottom: none!important;
            }
            textarea.form-control {
                margin-bottom: 0px!important;
                border-bottom: none!important;
            }
            input.select-dropdown {
                margin-bottom: 0px!important;
                border-bottom: none!important;
            }
            .red:hover{
                background-color: #ef9a9a!important;
            }
        </style>

    </head>
    <body class="">
        <div class="">
            <div class="container align-center" style="background-color: transparent;">
                <a href="{{ route('index') }}"  class="">
                    <img src="{{asset('/img/icon-81.png')}}" style="width: 5em;" alt="JJL logo" />
                </a>
            </div>

            <div>
                {{ $slot }}
            </div>
        </div>
        @include('layouts.generic_js')
    </body>
</html>
