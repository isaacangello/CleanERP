@extends('layouts.clean')
@section('title')
     <title>Teste Login - main - JJL System 2</title>
@endsection

@section('content')
<div class="row">
<div class="col-3"></div>
<div class="col-6">
   <div class="login-box" style="opacity: 1;">
        <div class="logo">
            <div class="float-end text-success">
                <a href="javascript:void(0);" style="text-shadow: 2px 2px 6px rgba(3,3,3,0.81);"><b>JJLSYSTEM 2</b></a>
                <small class="w-75 text-bg-info" style="text-shadow: 2px 2px 6px rgba(3,3,3,0.81);"><b>The second version - The Powerful System. </b></small>
            </div>
        </div>
        <div class="card">
            <div class="body">
                <form id="sign_in" method="POST" action="javascript:void(0);">
                    @csrf
                    <div class="msg">Sign in to start your session</div>
                    <div class="result" id="result"></div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" name="username" placeholder="Username" required autofocus>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control" name="password" placeholder="Password" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-8 p-t-5">
                            <input type="checkbox" name="rememberme" id="rememberme" class="filled-in chk-col-teal">
                            <label for="rememberme">Remember Me</label>
                        </div>
                        <div class="col-xs-4">
                            <button id="btn_sigin_id" class="btn btn-block bg-teal waves-effect"  type="submit">SIGN IN</button>
                        </div>
                    </div>
                    <div class="row m-t-15 m-b--20">
                        <div class="col-xs-6">
                            &nbsp;
                        </div>
                        <div class="col-xs-6 align-right">
                            <a href="javascript:void(0);">Forgot Password?</a>
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
@section('script-botton')
    @php  $url = url('get_ajax_login'); @endphp
    <script>
        var url = "@php echo $url; @endphp"+"/"

    </script>
    <script src="web-resources/custom/ajaxteste.js"></script>
@endsection
