<x-guest-layout>
    <div class="container">
        <div class="row">
            <div class="col s1 m3"></div>
                <div class="col s10 m6">
                    {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                </div>
            <div class="col s1 m3"></div>
        </div>
        <div class="row">
            <div class="col s1 m3"></div>
            <div class="col s12 m6">
                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <!-- Email Address -->
                    <div class="form-group">
                        <div class="form-line">
                            <x-input-label class="form-label" for="email" :value="__('Email')" />
                            <x-text-input id="email" class="form-control" type="email" name="email" :value="old('email')" required autofocus />
                            <x-input-error :messages="$errors->get('email')" class="red-text text-darken-4" />
                        </div>
                    </div>
                    <div class="align-right">
                        <x-primary-button>
                            {{ __('Email Password Reset Link') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col s1 m3"></div>
    </div> <!--container -->
</x-guest-layout>
