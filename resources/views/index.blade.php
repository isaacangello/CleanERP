@extends('layouts.clean')
@section('title')
     <title>Login - main - JJL System 2</title>
@endsection

@section('content')
<div class="row">
<div class="col s1 m4"></div>
<div class="col s10 m4">
   <div class="login-box " style="opacity: 1;">
        <div>
            <div class="p-t-5 p-b-10 center-align">
                <a href="javascript:void(0);" class="white-text " style="text-shadow: 2px 2px 6px rgba(3,3,3,0.81);"><b>JJLSYSTEM 2</b></a><br>
                <small class="w-75 text-bg-info white-text"  style="text-shadow: 2px 2px 6px rgba(3,3,3,0.81);"><b>The second version - The Powerful System. </b></small>
            </div>
        </div>
       @if($errors->get('email'))
           <div class="alert alert-danger p-10 z-depth-3">

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

        <div class="card p-20 z-depth-4">
            <div class="body">
                <form id="sign_in" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="msg">Sign in to start your session</div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-group">
                            <div class="form-line success">
                                <input id="email" type="email" name="email"  class="form-control"  placeholder="Email" required autofocus autocomplete="username" />
                            </div>
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="red-text text-darken-4" />
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-group">
                            <div class="form-line success">
                                <input id="password" type="password" class="form-control" name="password"  autocomplete="current-password" placeholder="Password" required>
                            </div>
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="red-text text-darken-4" />
                    </div>
                    <div class="row">
                        <div class="col s12 m6 valign-wrapper p-b-4">
                            <p>
                                <label>
                                    <input type="checkbox" name="remember" id="remember_me" class="filled-in chk-col-teal">
                                    <span>Remember Me</span>
                                </label>
                            </p>
                        </div>
                        <div class="col s12 m6 right-align">
                            <button class="waves-effect waves-light btn bg-teal" type="submit">SIGN IN</button>
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
    </div>

</div>
<div class="col s1 m4"></div>
</div>
@endsection
