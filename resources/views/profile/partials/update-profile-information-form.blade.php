<section>
    <header>
        <h2 class="grey-text text-darken-3 flow-text" >
            {{ __('Profile Information') }}
        </h2>

        <p class="grey-text text-darken-3 ">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')
        <div class="form-group">
            <div class="form-line success">
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" name="name" type="text" class="form-control" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            </div>
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>
        <div class="form-group">
            <div class="form-line success">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" name="email" type="email" class="form-control" :value="old('email', $user->email)" required autocomplete="username" />

            </div>
                <x-input-error class="mt-2" :messages="$errors->get('email')" />
        </div>
            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="form-group">
                    <div class="form-line success" style="align-items: end;align-content: flex-end">
                            <p>
                                {{ __('Your email address is unverified.') }}

                                <button form="send-verification">
                                    {{ __('Click here to re-send the verification email.') }}
                                </button>
                            </p>

                            @if (session('status') === 'verification-link-sent')
                                <p>
                                    {{ __('A new verification link has been sent to your email address.') }}
                                </p>
                            @endif
                        </div>
                </div>
            @endif

        <div class="form-group">
            <div class="form-line success">


            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="green-text text-darken-3"
                >{{ __('Saved.') }}</p>
            @endif

            </div>
        </div>

    </form>
</section>
