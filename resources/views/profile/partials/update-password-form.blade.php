<section>
    <header>
        <h2 class="grey-text text-darken-3 flow-text">
            {{ __('Update Password') }}
        </h2>

        <p class="grey-text text-darken-3">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

         <div class="form-group">
            <div class="form-line success">
               <x-input-label for="current_password" :value="__('Current Password')" />
                <x-text-input id="current_password" name="current_password" type="password" class="form-control" autocomplete="current-password" />
            </div>
             <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
         </div>

        <div class="form-group">
            <div class="form-line success">
                <x-input-label for="password" :value="__('New Password')" />
                <x-text-input id="password" name="password" type="password" class="mt-1 block w-full" autocomplete="new-password" />

            </div>
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>
        <div class="form-group">
            <div class="form-line success">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password" />
            </div>
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>
        <div class="form-group">
            <div class="form-line success">
                <div class="">
                    <x-standard-btn class="btn-small">{{ __('Save') }}</x-standard-btn>

                    @if (session('status') === 'password-updated')
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
        </div>
    </form>
</section>
