<section class="w-full">
    <header>
        <h2 class="text-gray-700 " >
            {{ __('Profile Information') }}
        </h2>

        <p class="text-gray-700 ">
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

                <x-flowbite.input-label for="profile-name" :value="__('Name')" />
                <x-flowbite.input id="profile-name" name="name" type="text" class="form-control" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            </div>
                <x-flowbite.input-error class="mt-2" :messages="$errors->get('name')" />
        </div>
        <div class="form-group">
            <div class="form-line success">
                <x-flowbite.input-label for="profile-email" :value="__('Email')" />
                <x-flowbite.input id="profile-email" name="email" type="email" class="form-control" :value="old('email', $user->email)" required autocomplete="username" />

            </div>
                <x-flowbite.input-error class="mt-2" :messages="$errors->get('email')" />
        </div>

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="form-group">
                    <div class="" >
                            <p>
                                {{ __('Your email address is unverified.') }}

                                <button form="send-verification" type="submit">
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


            <x-flowbite.btn-blue>{{ __('Save') }}</x-flowbite.btn-blue>

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
