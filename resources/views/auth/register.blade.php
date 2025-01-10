@extends('layouts.main')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="header">
            <small>Register</small>
        </div>
        <div class="body">

            <div class="row">



                <div class="col s10 m4">
                    <div class="card" >
                        <div class="header bg-green">
                                    <h2>
                                        User Register <small>Register a new user in system.</small>
                                    </h2>
                                </div>
                            <div class="card-content " style="padding: 2em 2em 3.5em 2em ;">
                            <form method="POST" action="{{ route('register') }}">
                                @csrf

                                <!-- Name -->
                                <div class="form-group">
                                    <div class="form-line success">
                                        <x-input-label for="name" :value="__('Name')" />
                                        <x-text-input id="name" class="form-control" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                                        <x-input-error :messages="$errors->get('name')" class="" />
                                    </div>
                                </div>

                                <!-- Email Address -->
                                <div class="form-group">
                                    <div class="form-line success">
                                        <div class="mt-4">
                                            <x-input-label for="email" :value="__('Email')" />
                                            <x-text-input id="email" class="form-control" type="email" name="email" :value="old('email')" required autocomplete="username" />
                                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                        </div>
                                    </div>
                                </div>
                                <!-- Password -->
                                <div class="form-group">
                                    <div class="form-line success">
                                        <div class="mt-4">
                                            <x-input-label for="password" :value="__('Password')" />

                                            <x-text-input id="password" class="form-control"
                                                            type="password"
                                                            name="password"
                                                            required autocomplete="new-password" />

                                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                        </div>
                                    </div>
                                </div>

                                <!-- Confirm Password -->
                                <div class="form-group">
                                    <div class="form-line success">

                                        <div class="mt-4">
                                            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                                            <x-text-input id="password_confirmation" class="form-control"
                                                            type="password"
                                                            name="password_confirmation" required autocomplete="new-password" />

                                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                                        </div>
                                    </div>
                                </div>
                                <div class="right">
                                    <a class="green-text text-darken-3" href="{{ route('login') }}">
                                        {{ __('Already registered?') }}
                                    </a>

                                    <x-standard-btn class="btn btn-link btn-small  waves-effect waves-teal">
                                        {{ __('Register') }}
                                    </x-standard-btn>
                                </div>
                            </form>
                            </div>
                    </div>
                </div>
                <div class="col s1 m4"></div>
            </div>
<div class="row">
    <table>
        @if(\App\Models\User::all())
            <tr>
                <th>Created At</th>
                <th>Name</th>
                <th>Username</th>
                <th>Email</th>
            </tr>
            @foreach(\App\Models\User::all() as $key => $data)
                <tr>
                    <td>{{ $data->created_at }}</td>
                    <td>{{ $data->name }}</td>
                    <td>{{ $data->username }}</td>
                    <td>{{ $data->email }}</td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="4">Not found</td>
            </tr>
        @endif
    </table>
</div>        </div>
    </div>
</div>
@endsection
    @section('title')
        <title>register - main - JJL System 2</title>
    @endsection

    {{--css links para o head--}}
    @section('css-style')
        @include('layouts.generic_css')
        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @endsection
    @section('script-botton')
        @include('layouts.generic_js')
    @endsection