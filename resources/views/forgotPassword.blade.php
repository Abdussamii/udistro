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
        .error {
        	color: red;
        }
        html, body {
        	height: 100%;
        	min-height: 100%;
        }
        .backColor {
        	background: #f7f7f7;
        	padding: 20px 0;
        	height: 100%;
        	min-height: 100%;
        }
        .backColor {
        	background: #f7f7f7;
        	padding: 20px 0;
        }

        .backColor .classlogo_part {
        	margin-bottom: 20px;
        	text-align: center;
        }
        .field-section {
        	background: #fff;
        	border:1px solid #e2e2e2;
        	padding: 20px;
        }

        .field-section h1 {
        	border-bottom:1px solid #e2e2e2;
        	padding-bottom: 15px;
        	text-align: center;
        	color: #44bae6;
        	margin-top: 0;
        	font-size: 30px;
        }
        .field-section .form-control {
			box-shadow: none;
			border-radius: 0;
			border: 1px solid #e2e2e2;
			height: 45px;
			line-height: 45px;
		}
        .field-section .form-group label {
        	color:#a09fa4;
        }

        .field-section label.normal {
        	color:#2c80bc;
        	font-weight: normal;
        }

        .field-section .btn {
        	border-radius: 0;
        	font-weight: 600;
        	font-size: 16px;
        	padding: 15px 0;
        	background: #44bae6;
        	border:1px solid #44bae6;
        }
		.field-section .btn:hover,
		.btn-primary:focus,
		.btn-primary:active:focus		{
			background-color: #3393bd;
		}
		
        .backColor .text-center {
        	margin-top:20px;
        }
        .backColor .text-center a {
        	font-size: 16px;
        	color: #44bae6;
        }
        .center-copypart {
        	margin-top:30px;
        	color: #a9a9a9;
        	font-size: 12px;
        }
		#frm_agent_login {
			margin: 30px 0;
		}
		#frm_agent_login .form-group {
			margin-bottom: 20px;
		}
        .error {
        	color: red !important;
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

        <div class="backColor">
        	<div class="container">
        		<div class="col-md-4 col-md-push-4">
        			<div class="classlogo_part">
        				<img src="{{ url('images/udistro-logo.png') }}" alt="">
        			</div>
        			<div class="field-section">
        				<h1>Forgot Password</h1>
				        <form name="frm_forgot_password" id="frm_forgot_password" autocomplete="off">
				            <div class="form-group">
				                <label for="email">Email</label>
				                <input type="email" class="form-control" id="email" name="email" placeholder="Please Enter Email">
				            </div>
				            
				            <button type="submit" class="btn btn-primary btn-block" id="btn_forgot_password" name="btn_forgot_password">Send Link</button>
				        </form>
        			</div>
        			<div class="center-copypart text-center">
        				<p>Copyright &copy; {{ date('Y') }} Udistro | All Rights Reserved.</p>
        			</div>
        		</div>
        	</div>
        </div>
        
        <!-- <div class="container col-md-offset-4">
            <form class="col-sm-6 col-md-6 col-lg-6" name="frm_forgot_password" id="frm_forgot_password" autocomplete="off">
            	<center><h2>Forgot Password</h2></center>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Please Enter Email">
                </div>
                <button type="submit" class="btn btn-primary" id="btn_forgot_password" name="btn_forgot_password">Send Link</button>
            </form>
        </div> -->

    </body>
</html>