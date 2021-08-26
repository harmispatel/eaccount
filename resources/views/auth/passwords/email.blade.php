@extends('layouts.etemplate')

@section('auth-body')
<style type="text/css">
    body { font-size: 13px;    line-height: 1.428571429; font-weight: 400;}
    .form-box {
    width: 360px;
    margin: 90px auto 0 auto;
}
a {
    color: #1546a0; font-size: 13px;
}
a:hover, a:active, a:focus {
    outline: none;
    text-decoration: none;
    color: #72afd2;
}
.form-control { font-size: 13px; }
.bg-gray {
    background-color: #eaeaec !important;
}
 .form-group {
    margin-top: 20px;
    margin-bottom: 15px;
}
.btn {
    font-weight: 500;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    border-radius: 3px;
    border: 1px solid transparent;
    -webkit-box-shadow: inset 0px -2px 0px 0px rgb(0 0 0 / 9%);
    -moz-box-shadow: inset 0px -2px 0px 0px rgba(0, 0, 0, 0.09);
    /* box-shadow: inset 0px -1px 0px 0px rgb(0 0 0 / 9%); */
}
.btn-primary.focus, .btn-primary:focus, .btn-primary:active { box-shadow: none !important; }
.btn:active {
    -webkit-box-shadow: inset 0 3px 5px rgb(0 0 0 / 13%) !important;
    -moz-box-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125) !important;
    box-shadow: inset 0 3px 5px rgb(0 0 0 / 13%) !important;
}
.btn-primary {
    background-color: #018738 !important;
    border-color: #018738 !important;
    color: white !important;
}
.form-group a {
    color: #1546a0;
}
.form-group a:hover {
    color: #7d9bd3 ;
}
.main-footer {
    background: #fff;
    padding: 15px;
    color: #444;
    border-top: 1px solid #d2d6de;
    position: fixed;
    bottom: 0;
    width: 100%;
    }
    .form-box .body > .form-group, .form-box .footer > .form-group {
    margin-top: 20px;
}
.form-box .body > .form-group > input, .form-box .footer > .form-group > input {
    border: #fff;
}
.form-box .body, .form-box .footer {
    padding: 10px 20px;
    background: #fff;
    color: #444;
}
.form-box .body > .btn, .form-box .footer > .btn {
    margin-bottom: 10px;
}
.navbar {
    position: relative;
    min-height: 50px;
    margin-bottom: 20px;
    border: 1px solid transparent;
}
.fo_pass{
    margin-bottom: 20px;
}
</style>
<header class="main-header ">               
    <nav class="navbar navbar-static-top" style="padding:5px; background:#FFFFFF; border-bottom:1px solid #d2d6de">
        <div class="col-sm-2">
            <div><img src="{{ asset( config('settings.company_logo')) }}" height="30"></div>
        </div>
        <div class="col-sm-10" style="text-align:right"><b>Sikika MIS</b></div> 
         {{-- <a href="">Contact us</a> --}}
    </nav>
</header>
<div class="container" style="min-height:500px;">
    <div class="form-box" id="login-box">
        <div><h2 style="text-align:center; margin-top: 20px; margin-bottom: 10px;">Forgot Password</h2></div>
        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="body ">
                <div class="form-group ">    
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <input placeholder="E-Mali Address" id="email" type="email" class="form-control bg-gray{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
                    
                    @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif

                    @if ($errors->has('email'))
                        <span role="alert">
                            <strong class="text-red">{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                    
                </div>
            </div>
            <div class="footer pt-0">
                <button type="submit" class="btn btn-primary btn-block">
                    {{ __('Send Password Reset Link') }}
                </button>
            </div>
        </form>
        
    </div>
</div>

<div class="main-footer">
    <div class="col-md-12" style="text-align:right">Copyright © 2021 Product of <a href="" target="_blank"><b>Sikika</b></a></div>
</div>
@endsection
