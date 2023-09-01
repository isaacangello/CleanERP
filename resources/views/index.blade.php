@extends('layouts.clean')
@section('title')
     <title>Login - main - JJL System 2</title>
@endsection

@section('content')
<div class="row">
<div class="col-3"></div>
<div class="col-6">
   <div class="login-box" style="opacity: 1;">
        <div  style="width: 100%;">
            <div class="p-t-5 p-b-10 align-center ">
                <a href="javascript:void(0);" class="force-white-text" style="text-shadow: 2px 2px 6px rgba(3,3,3,0.81);"><b>JJLSYSTEM 2</b></a><br>
                <small class="w-75 text-bg-info force-white-text"  style="text-shadow: 2px 2px 6px rgba(3,3,3,0.81);"><b>The second version - The Powerful System. </b></small>
            </div>
        </div>
       @if($errors->get('email'))
           <div class="alert alert-danger">
               <ul class="collection">
               @foreach($errors->get('email') as $message)
                   <li class="collection-item">Email: {{ $message }}</li>
               @endforeach
               </ul>
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

        <div class="card">
            <div class="body" style="padding: 20px;">
                <form id="sign_in" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="msg">Sign in to start your session</div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input id="email" type="email" name="email"  class="form-control"  placeholder="Email" required autofocus autocomplete="username" />
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="red-text text-darken-4" />
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input id="password" type="password" class="form-control" name="password"  autocomplete="current-password" placeholder="Password" required>
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="red-text text-darken-4" />
                    </div>
                    <div class="row">
                        <div class="col-xs-8 p-t-5">
                            <input type="checkbox" name="remember" id="remember_me" class="filled-in chk-col-teal">
                            <label for="remember_me">Remember Me</label>
                        </div>
                        <div class="col-xs-4">
                            <button class="btn btn-block bg-teal waves-effect" type="submit">SIGN IN</button>
                        </div>
                    </div>
                    <div class="row m-t-15 m-b--20">
                        <div class="col-xs-6">
                            &nbsp;
                        </div>
                        <div class="col-xs-6 align-right">
                            <a href="{{ route('password.request') }}">Forgot Password?</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
<div class="col-3"></div>
</div>
@endsection
