<!-- Administrator Login -->
<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="route" content="{{ url('/') }}">

        <title>Udistro | Company Login</title>

        <link rel="stylesheet" href="{{ URL::asset('css/bootstrap.min.css') }}" />

        <link rel="stylesheet" href="{{ URL::asset('css/style.css') }}" />

        <script type="text/javascript" src="{{ URL::asset('js/jquery.min.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('js/jquery.validate.min.js') }}"></script>
        <script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>

        <!-- JS Alert Plug-in -->
		<script type="text/javascript" src="{{ URL::asset('js/alertify.min.js') }}"></script>
		<link rel="stylesheet" href="{{ URL::asset('css/alertify.min.css') }}" />

        <script type="text/javascript" src="{{ URL::asset('js/custom/dashboard.js') }}"></script>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
        .error {
        	color: red;
        }
        .loginPage_wrap {
        position: absolute;
        min-height: 100%;
        width: 100%;
        background: url(./images/video_bg.jpg);
        }
        .login-box {
        width: 500px;
        margin: 150px auto;
        }
        .login-box form {
        background: #FFF;
        padding: 30px;
        border-radius: 4px;
        }
        .login-head {
        text-align: center;
        margin-bottom: 30px;
        color: #fff;
        font-size: 36px;
        font-weight: bold;
        }
        .logo_udistro {
        text-align: center;
        border-bottom: 1px solid #eee;
        padding-bottom: 15px;
        margin-bottom: 15px;
        }
        .login-box input[type="email"],
        .login-box input[type="password"] {
        border: 1px solid #ccc;
        box-shadow: unset;
        height: 40px;
        }
        .loginPage_wrap .checkbox {
        position: relative;
        display: block;
        margin-top: 10px;
        margin-bottom: 10px;
        color: #999;
        font-size: 14px;
        }
        .loginPage_wrap .btn-primary {
        width: 100px;
        border-radius: 40px;
        margin: auto;
        display: block;
        }
        </style>
    </head>
    <body>
        <div class="loginPage_wrap">
	        <div class="container">
				<div class="login-box">
					<div class="login-head">Login uDistro</div>
		            <form name="frm_company_login" id="frm_company_login" autocomplete="off">
					<div class="logo_udistro">
						<img src="images/logo.png" />
					</div>
		                <div class="form-group">
		                    <label for="username">Email</label>
		                    <input type="email" class="form-control" id="username" name="username" placeholder="Email">
		                </div>
		                <div class="form-group">
		                    <label for="password">Password</label>
		                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
		                </div>
		                
		                <div class="checkbox">
		                    <label><input type="checkbox" name="remember" id="remember" value="1"> Remember me</label>
		                </div>
		                
		                <button type="submit" class="btn btn-primary" id="btn_company_login" name="btn_company_login">Login</button>
		            </form>
				</div>
	        </div>
        </div>
    </body>
</html>