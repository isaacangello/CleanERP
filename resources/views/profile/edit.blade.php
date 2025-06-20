<x-flowbite.layout.main>
{{--css links para o head--}}
    <div class="w-full">
        <div class="w-full py-3 font-bold">
            <h2>
                <small>USER PROFILE</small>
            </h2>
        </div>

        <div class="w-full flex flex-col items-center justify-center">
            <div class="header">

                    <h2 class="text-gray-700 font-10">
                        {{ __('Profile') }}
                    </h2>

            </div>
            <div class="flex flex-col gap-4 items-center justify-center max-w-6xl">
                <div class="bg-white w-full  p-3 rounded">
                        @include('profile.partials.update-profile-information-form')
                </div>
                <div class="bg-white w-full p-3 rounded">
                        @include('profile.partials.update-password-form')
                </div>
                <div class="bg-white w-full p-3 rounded">
                        @include('profile.partials.delete-user-form')
                </div>
            </div> <!--card body-->
        </div> <!-- card -->
    </div>{{-- container--}}
</x-flowbite.layout.main>
