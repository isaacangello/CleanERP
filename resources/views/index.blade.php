@extends('layouts.clean')
@section('title')
     Login - main - JJL System 2
@endsection
@section('css-style')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.8/dist/cdn.min.js"></script>
<style>
    @tailwind base;
    @tailwind components;
    @tailwind utilities;
</style>
@endsection
@section('content')
   <div  class="backdrop-blur-sm">
       @if($errors->get('email'))
           <div class="alert alert-danger p-10 ">

               @foreach($errors->get('email') as $message)
                   Email: {{ $message }}
               @endforeach

           </div>
       @endif
       @if($errors->get('password'))
           <div class="alert alert-danger">
               <ul class="collection">
               @foreach($errors->get('password') as $message)
                   <li class="collection-item">Password: {{ $message }}</li>
               @endforeach
               </ul>
           </div>
       @endif

        <div class="card shadow-lg rounded-xl">
            <div class="body">
                <form id="sign_in" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="msg w-full text-center">Sign in to start your session</div>
                    <div class="input-group flex">

                            <span class="input-group-addon">
                                <i class="material-icons">person</i>
                            </span>
                            <div class="form-line success">
                                <input id="email" type="email" name="email"  class="form-control"  placeholder="Email" required autofocus autocomplete="username" />
                            </div>

                        <x-input-error :messages="$errors->get('email')" class="red-text text-darken-4" />
                    </div>
                    <div class="input-group flex">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>

                            <div class="form-line success">
                                <input id="password" type="password" class="form-control" name="password"  autocomplete="current-password" placeholder="Password" required>
                            </div>

                        <x-input-error :messages="$errors->get('password')" class="red-text text-darken-4" />
                    </div>
                    <div class="row">
                        <div class="col s12 m6 valign-wrapper p-b-4 flex text-left align-middle justify-start gap-2">
                                    <input type="checkbox" name="remember" id="remember_me"
                                           class="w-4 h-4 accent-green-800 text-green-600 bg-gray-100 border-gray-300 rounded focus:ring-green-500 dark:focus:ring-green-600
                                                dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                    >
                                    <span>Remember Me</span>
                        </div>
                        <div class="col s12 m6 right-align">
                            <button class="btn btn-link waves-effect waves-teal " type="submit">SIGN IN</button>
                        </div>
                    </div>
                    <div class="row m-t-15">
                        <div class="col s12 m6">
                            &nbsp;
                        </div>
                        <div class="col s12 m6 right-align">
                            <a href="{{ route('password.request') }}" class="m-b-3 green-text text-darken-2">Forgot Password?</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
           <div>
               <div class="p-t-5 p-b-10 center-align">
                   <small class="w-75 text-bg-info white-text"  style="text-shadow: 2px 2px 6px rgba(3,3,3,0.81);"><b>The Office System. </b></small>
               </div>
           </div>

</div>

@endsection
