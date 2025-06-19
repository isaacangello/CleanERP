<x-cleopatra.guest>
<x-slot name="title"> {{ config('app.name', 'CleanERP') }} - Login </x-slot>
<x-slot name="slot">
   <div
           class="w-screen h-screen flex flex-col justify-center items-center pt-0 sm:pt-0 overflow-hidden"
           x-data="loginInit"
           x-cloak

           x-init="pageInit()"
           wire:loading.class="flex"
   >

        <div class="p-5 shadow-lg rounded-xl bg-white/80 backdrop-blur-md dark:bg-gray-800">
            <div class="card-body gap-4">
                <form id="sign_in" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="w-full text-center text-sm text-gray-500 mb-4">Sign in to start your session</div>
                    <div class="w-full text-center flex flex-col gap-2">
                        <label class="input input-bordered  @if($errors->get('email'))  input-error @endif flex items-center gap-2">
                            <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 16 16"
                                    fill="currentColor"
                                    class="h-4 w-4 opacity-70">
                                <path
                                        d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6ZM12.735 14c.618 0 1.093-.561.872-1.139a6.002 6.002 0 0 0-11.215 0c-.22.578.254 1.139.872 1.139h9.47Z" />
                            </svg>
                            <x-flowbite.input type="email" name="email" class="grow" placeholder="Username" />
                        </label>
                        @error('email')
                        <div class="text-red-500 text-xs italic">
                             <span>{{ $message }}</span>
                        </div>
                        @enderror
                        <label class="input input-bordered @if($errors->get('password')) input-error @endif flex items-center gap-2">
                            <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 16 16"
                                    fill="currentColor"
                                    class="h-4 w-4 opacity-70">
                                <path
                                        fill-rule="evenodd"
                                        d="M14 6a4 4 0 0 1-4.899 3.899l-1.955 1.955a.5.5 0 0 1-.353.146H5v1.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-2.293a.5.5 0 0 1 .146-.353l3.955-3.955A4 4 0 1 1 14 6Zm-4-2a.75.75 0 0 0 0 1.5.5.5 0 0 1 .5.5.75.75 0 0 0 1.5 0 2 2 0 0 0-2-2Z"
                                        clip-rule="evenodd" />
                            </svg>
                            <x-flowbite.input type="password"  name="password" class="grow" placeholder="password" />
                        </label>
                        @error('password')
                        <div class="text-red-500 text-xs italic">
                            <span>{{ $message }}</span>
                        </div>
                        @enderror

                    </div>
                    <div class="flex  mt-4  justify-between">
                        <div class=" flex  items-center justify-between gap-2">
                                    <input type="checkbox" name="remember" id="remember_me"
                                           class="w-4 h-4 accent-blue-800 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600
                                                dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                    >
                                    <span>Remember Me</span>
                        </div>
                        <div class="">
                            <x-flowbite.btn-blue  type="submit">SIGN IN</x-flowbite.btn-blue>
                        </div>
                    </div>
                    <div class="flex justify-between">
                        <div class="">
                            &nbsp;
                        </div>
                        <div class="text-end mt-5">
                            <a href="{{ route('password.request') }}" class="link link-info">Forgot Password?</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
           <div>
               <div class="pt-5 pb-10 text-center text-white">
                   <small class=""  style="text-shadow: 2px 2px 6px rgba(3,3,3,0.81);"><b>The Office System.</b></small>
               </div>
           </div>

</div>
</x-slot>
</x-cleopatra.guest>
