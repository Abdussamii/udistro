<!-- Administrator Login -->
<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="route" content="{{ url('/') }}">

        <title>Udistro | Agent Login</title>

        <link rel="stylesheet" href="{{ URL::asset('css/bootstrap.min.css') }}" />
        <script type="text/javascript" src="{{ URL::asset('js/jquery.min.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('js/jquery.validate.min.js') }}"></script>
        <script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>

        <!-- JS Alert Plug-in -->
		<script type="text/javascript" src="{{ URL::asset('js/alertify.min.js') }}"></script>
		<link rel="stylesheet" href="{{ URL::asset('css/alertify.min.css') }}" />

        <script type="text/javascript" src="{{ URL::asset('js/custom/agent.js') }}"></script>


        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
        body {
            background: #eee !important;
        }
        .error {
        	color: red;
        }
        </style>
    </head>
    <body>
        <div class="container col-md-offset-4">
            <form class="col-sm-6 col-md-6 col-lg-6" name="frm_agent_login" id="frm_agent_login" autocomplete="off">
            	<center><h2>Login</h2></center>
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
                
                <button type="submit" class="btn btn-primary" id="btn_agent_login" name="btn_agent_login">Login</button>
            </form>
        </div>
    </body>
</html>