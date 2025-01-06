<section class="space-y-6" x-data="{ open:false }">
    <header>
        <h2 class="grey-text text-darken-3 flow-text">
            {{ __('Delete Account') }}
        </h2>

        <p class="grey-text text-darken-3">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="open = ! open"
        style="width:90px"
    >
        {{ __('Delete Account') }}
    </x-danger-button>

    <x-modal name="confirm-user-deletion"  focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="grey-text text-darken-3 flow-text">
                {{ __('Are you sure you want to delete your account?') }}
            </h2>

            <p class="grey-text text-darken-3 ">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-3/4"
                    placeholder="{{ __('Password') }}"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button @click="open = ! open" class="m-r-5">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button class="ml-3" style="width:90px">
                    {{ __('Delete Account') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
