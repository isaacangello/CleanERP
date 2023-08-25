<x-guest-layout>
<div class="container-fluid">
    <div class="row">
        <div class="col s1 m4"></div>


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
                            <div class="form-line">
                                <x-input-label for="name" :value="__('Name')" />
                                <x-text-input id="name" class="form-control" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                                <x-input-error :messages="$errors->get('name')" class="" />
                            </div>
                        </div>

                        <!-- Email Address -->
                        <div class="form-group">
                            <div class="form-line">
                                <div class="mt-4">
                                    <x-input-label for="email" :value="__('Email')" />
                                    <x-text-input id="email" class="form-control" type="email" name="email" :value="old('email')" required autocomplete="username" />
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </div>
                            </div>
                        </div>
                        <!-- Password -->
                        <div class="form-group">
                            <div class="form-line">
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
                            <div class="form-line">

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

                            <x-primary-button class="btn btn-sm green darken-3 waves-effect waves-classic waves-light">
                                {{ __('Register') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col s1 m4"></div>
    </div>
</x-guest-layout>
