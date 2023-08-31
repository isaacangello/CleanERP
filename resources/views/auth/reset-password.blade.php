<x-guest-layout>
    <div class="container">
    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
    <div class="row" >
        <div class="col s1 m3"></div>
        <div class="col s10 m6">
            <div class="form-group">
                <div class="form-line">
                    <x-input-label class="form-label" for="email" :value="__('Email')" />
                    <x-text-input id="email" class="form-control" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="red-text text-darken-4" />
                </div>
           </div>
        </div>
        <div class="col s1 m3"></div>
    </div>
        <!-- Password -->
    <div class="row" >
        <div class="col s1 m3"></div>
        <div class="col s10 m6">
            <div class="form-group">
                <div class="form-line">
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="red-text text-darken-4" />
                </div>
            </div>
        </div>
    </div>
        <!-- Confirm Password -->
    <div class="row" >
        <div class="col s1 m3"></div>
        <div class="col s10 m6">
            <div class="form-group">

                <div class="form-line">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                    <x-text-input id="password_confirmation" class="form-control"
                                        type="password"
                                        name="password_confirmation" required autocomplete="new-password" />

                    <x-input-error :messages="$errors->get('password_confirmation')" class="red-text text-darken-4" />
                </div>
            </div>
        </div>
        <div class="col s1 m3"></div>
    </div>
    <div class="row" >
        <div class="col s1 m3"></div>
        <div class="col s10 m6">
            <div class="align-right">
                <x-primary-button>
                    {{ __('Reset Password') }}
                </x-primary-button>
            </div>
        </div>
        <div class="col s1 m3"></div>
    </div>
    </form>
    </div>
</x-guest-layout>
