<!-- Administrator Login -->
<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="route" content="{{ url('/') }}">

        <title>Udistro | Forgot Password</title>

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
        	$('#frm_forgot_password').submit(function(e){
        		e.preventDefault();
        	});
        	// Form validation
        	$('#frm_forgot_password').validate({
        		rules: {
        			email: {
        				required: true,
        				email: true
        			}
        		},
        		messages: {
        			email: {
        				required: 'Please enter your email id',
        				email: 'Please enter a valid email id'
        			}	
        		}
        	});

        	// Process the data
        	$('#btn_forgot_password').click(function(){
        		if( $('#frm_forgot_password').valid() )
        		{
        			let email = $('#email').val();

		    		$.ajax({
		    			url: $('meta[name="route"]').attr('content') + '/forgotpasswordemail',
		    			method: 'post',
		    			data: {
		    				email: email
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
            <form class="col-sm-6 col-md-6 col-lg-6" name="frm_forgot_password" id="frm_forgot_password" autocomplete="off">
            	<center><h2>Forgot Password</h2></center>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Please Enter Email">
                </div>
                <button type="submit" class="btn btn-primary" id="btn_forgot_password" name="btn_forgot_password">Send Link</button>
            </form>
        </div>

    </body>
</html>