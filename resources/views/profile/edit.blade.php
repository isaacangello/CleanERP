
@extends('layouts.main')
@section('title')
     <title>Profile - main - JJL System 2</title>
@endsection
{{--css links para o head--}}
@section('css-style')
     <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
{{--    <link href="web-resources/bootstrap/bootstrap.min.css" rel="stylesheet">--}}
    <!-- Materialize Core Css -->
    <link href="web-resources/materialize/css/materialize.css" rel="stylesheet">

    <!-- Waves Effect Css -->
{{--    <link href="web-resources/systheme/plugins/node-waves/waves.css" rel="stylesheet" />--}}

    <!-- Animation Css -->
    <link href="web-resources/systheme/plugins/animate-css/animate.css" rel="stylesheet" />
    <!-- Sweet Alert Css -->
    <link href=web-resources/systheme/plugins/sweetalert/sweetalert.css" rel="stylesheet" />


    <!-- Custom Css -->
    <link href="web-resources/systheme/css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="web-resources/systheme/css/themes/all-themes.css" rel="stylesheet" />


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
@endsection


@section('content')
<div class="container-fluid">
    <div class="block-header">
        <h2>
            <small>USER PROFILE</small>
        </h2>
    </div>

    <div class="card">
        <div class="header">
            <x-slot name="header">
                <h2 class="grey-text font-10">
                    {{ __('Profile') }}
                </h2>
            </x-slot>
        </div>
        <div class="body">
            <div class="row">
                <div class="col s1 m3"></div>
                <div class="col s10 m6">
                    @include('profile.partials.update-profile-information-form')
                </div>
                <div class="col s1 m3"></div>
                <div class="col s1 m3"></div>
                <div class="col s10 m6">

                            @include('profile.partials.update-password-form')
                </div>
                <div class="col s1 m3"></div>

                <div class="col s1 m3"></div>
                <div class="col s10 m6">

                            @include('profile.partials.delete-user-form')
                </div>
                <div class="col s1 m3"></div>
            </div>
        </div> <!--card body-->
    </div> <!-- card -->
</div>{{-- container--}}
@endsection

{{-- inclusção de scripts  no final no corpo--}}
@section('script-botton')
    <!-- Jquery Core Js -->
{{--    <script src="web-resources/systheme/plugins/jquery/jquery.min.js"></script>--}}
    <script src="web-resources/jquery/jquery-3.7.0.min.js"></script>
    <!-- Bootstrap Core Js -->
{{--    <script src="web-resources/bootstrap/bootstrap.min.js"></script>--}}
    <script src="web-resources/materialize/js/materialize.min.js"></script>

    <!-- Select Plugin Js -->
{{--    <script src="web-resources/systheme/plugins/bootstrap-select/js/bootstrap-select.js"></script>--}}

    <!-- Slimscroll Plugin Js -->
    <script src="web-resources/systheme/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="web-resources/systheme/plugins/node-waves/waves.js"></script>
    <!-- Jquery Validation Plugin Css -->
    <script src="../../plugins/jquery-validation/jquery.validate.js"></script>

    <!-- JQuery Steps Plugin Js -->
    <script src="../../plugins/jquery-steps/jquery.steps.js"></script>

    <!-- Sweet Alert Plugin Js -->
    <script src="../../plugins/sweetalert/sweetalert.min.js"></script>

    <!-- Custom Js -->
    <script src="web-resources/systheme/js/admin.js"></script>
{{--    <script src="web-resources/systheme/js/pages/tables/jquery-datatable.js"></script>--}}
    <script src="web-resources/systheme/js/pages/index.js"></script>
<script src="web-resources/systheme/js/pages/forms/form-validation.js"></script>
    <!-- Demo Js -->
    <script src="web-resources/systheme/js/demo.js"></script>
    <script src="web-resources/systheme/js/systheme.js"></script>
@endsection

