@extends('layouts.main_old')
@section('title')
    <title>Profile - main - JJL System 2</title>
@endsection
{{--css links para o head--}}
@section('css-style')

    @include('layouts.generic_css')
    <style>
        input.form-control {
            margin-bottom: 0 !important;
            border-bottom: none !important;
        }

        textarea.form-control {
            margin-bottom: 0 !important;
            border-bottom: none !important;
        }

        input.select-dropdown {
            margin-bottom: 0 !important;
            border-bottom: none !important;
        }

        .red:hover {
            background-color: #ef9a9a !important;
        }

        input.form-line.success {
            margin-bottom: 3px;
        }
    </style>
@endsection
@section('script-top')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
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
                <div class="row clearfix">
                    <div class="col s1 m3"></div>
                    <div class="col s10 m6">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                    <div class="col s1 m3"></div>
                </div>
                <div class="row clearfix">
                    <div class="col s1 m3"></div>
                    <div class="col s10 m6">

                        @include('profile.partials.update-password-form')
                    </div>
                    <div class="col s1 m3"></div>
                </div>
                <div class="row clearfix">
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
    @include('layouts.generic_js')
@endsection

