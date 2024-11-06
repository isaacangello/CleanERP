<x-guest-layout>
<div class="row">
    <div class="col s1 m3"></div>
    <div class="col s10 m6">
        <div class="alert alert-info">
            {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
        </div>
    </div>
    <div class="col s1 m3"></div>
</div>
    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf
        <!-- Password -->
<div class="row">
    <div class="col s1 m3"></div>
    <div class="col s10 m6">
       <div class="form-group">
            <div class="form-line success">
                <x-input-label class="form-label" for="password" :value="__('Password')" />

                <x-text-input id="password" class="form-control"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
            </div>
           <x-input-error :messages="$errors->get('password')" class="red-text text-darken-4" />
        </div>

    </div>
    <div class="col s1 m3"></div>
</div>

<div class="row">
    <div class="col s1 m3"></div>
    <div class="col s10 m6">
        <div class="align-right">
            <x-primary-button>
                {{ __('Confirm') }}
            </x-primary-button>
        </div>
    </div>
    <div class="col s1 m3"></div>
</div>

    </form>
</x-guest-layout>
