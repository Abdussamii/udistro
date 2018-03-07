<!-- Administrator Login -->
<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="route" content="{{ url('/') }}">

        <title>Udistro | Reset Password</title>

        <link rel="stylesheet" href="{{ URL::asset('css/bootstrap.min.css') }}" />
        <script type="text/javascript" src="{{ URL::asset('js/jquery.min.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('js/jquery.validate.min.js') }}"></script>
        <script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>

        <!-- JS Alert Plug-in -->
		<script type="text/javascript" src="{{ URL::asset('js/alertify.min.js') }}"></script>
		<link rel="stylesheet" href="{{ URL::asset('css/alertify.min.css') }}" />

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

        <script type="text/javascript">
        $(document).ready(function(){
        	// Hold the form submit
        	$('#frm_reset_password').submit(function(e){
        		e.preventDefault();
        	});
        	// Form validation
        	$('#frm_reset_password').validate({
        		rules: {
        			password: {
			            required: true,
			        	minlength: 6
			        }
        		},
        		messages: {
        			password: {
			            required: 'Please enter password',
			        	minlength: 'Password minimum length is 6 characters'
			        }
        		}
        	});

        	// Process the data
        	$('#btn_forgot_password').click(function(){
        		if( $('#frm_reset_password').valid() )
        		{
        			let token 	= $('#token').val();
        			let password= $('#password').val();

		    		$.ajax({
		    			url: $('meta[name="route"]').attr('content') + '/updatepassword',
		    			method: 'post',
		    			data: {
		    				token: token,
		    				password: password
		    			},
		    			headers: {
					        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					    },
					    success: function(response){
					    	if( response.errCode == 0 )
					    	{
					    		alertify.success( response.errMsg );
					    	}
					    	else
					    	{
					    		alertify.error( response.errMsg );
					    	}
					    }
		    		});
        		}
        	});
        });
        </script>
    </head>
    <body>
        
        <div class="container col-md-offset-4">
        	<?php
        	if( $response['errCode'] == 0 )
        	{
			?>
				<form class="col-sm-6 col-md-6 col-lg-6" name="frm_reset_password" id="frm_reset_password" autocomplete="off">
					<center><h2>Reset Password</h2></center>
				    <div class="form-group">
				        <label for="password">New Password</label>
				        <input type="password" class="form-control" id="password" name="password" placeholder="Please Enter password">
				        <input type="hidden" name="token" id="token" value="{{ $response['token'] }}">
				    </div>
				    <button type="submit" class="btn btn-primary" id="btn_forgot_password" name="btn_forgot_password">Reset Password</button>
				</form>
			<?php
        	}
        	else if( $response['errCode'] != 0 )
        	{
        	?>
        		<form class="col-sm-6 col-md-6 col-lg-6">
        			<center><h2>Error</h2></center>
	        		<div class="alert alert-danger">
	        			{{ $response['errMsg'] }}
	        		</div>
        		</form>
        	<?php
        	}
        	?>
        </div>

    </body>
</html>