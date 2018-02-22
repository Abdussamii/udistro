<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="route" content="{{ url('/') }}">

<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<title>uDistro</title>

<!-- Bootstrap -->
<link href="{{ URL::asset('css/movers/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('css/movers/style.css') }}" rel="stylesheet">

<!-- <link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet"> -->

<!-- Fonts -->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600" rel="stylesheet">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="{{ URL::asset('css/movers/font-awesome.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('css/movers/owl.carousel.min.css') }}" rel="stylesheet">

<!-- <link href="css/font-awesome.min.css" rel="stylesheet">
<link href="css/owl.carousel.min.css" rel="stylesheet"> -->

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="{{ URL::asset('js/jquery.min.js') }}"></script>
<script src="{{ URL::asset('js/movers/bootstrap.min.3.3.7.js') }}"></script>

<!-- Custom functionality -->
<script src="{{ URL::asset('js/custom/movers.js') }}"></script>

<!-- Google Map API -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCSaTspumQXz5ow3MBIbwq0e3qsCoT2LDE"></script>

<!-- JQuery Validation -->
<script type="text/javascript" src="{{ URL::asset('js/jquery.validate.min.js') }}"></script>

<!-- JS Alert Plug-in -->
<script type="text/javascript" src="{{ URL::asset('js/alertify.min.js') }}"></script>
<link rel="stylesheet" href="{{ URL::asset('css/alertify.min.css') }}" />

<!-- Multiple Select Dropdown -->
<script type="text/javascript" src="{{ URL::asset('js/multiple-select.js') }}"></script>
<link rel="stylesheet" href="{{ URL::asset('css/multiple-select.css') }}" />

<!-- Jquery UI for datepicker -->
<script type="text/javascript" src="{{ URL::asset('js/jquery-ui.min.js') }}"></script>
<link rel="stylesheet" href="{{ URL::asset('css/jquery-ui.min.css') }}" />

<script>
// To show the to navigation when page is scroll down
$(function(){
    
});
</script>

<style type="text/css">
.error {
    color: red;
    font-size: 14px;
    text-align: left;
    width: 100%;
    font-weight: normal;
}
</style>

<script type="text/javascript">
$(document).ready(function(){
	// Server side validation
	$('#frm_authenticate_user').submit(function(e){
		e.preventDefault();
	});

	$('#frm_authenticate_user').validate({
		rules: {
			mobile_no: {
				required: true,
				number: true
			}
		},
		messages: {
			mobile_no: {
				required: 'Please enter your mobile number',
				number: 'Please enter a valid mobile number'
			}
		}
	});

	$('#btn_authenticate_user').click(function(){
		if( $('#frm_authenticate_user').valid() )
		{
			let mobileNo 	= $('#mobile_no').val();
			let clientId 	= $('#client_id').val();
			let invitationId= $('#invitation_id').val();

    		$.ajax({
    			url: $('meta[name="route"]').attr('content') + '/movers/checkuserauthentication',
    			method: 'post',
    			data: {
    				mobileNo: mobileNo,
    				clientId: clientId,
    				invitationId: invitationId
    			},
    			headers: {
			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    },
			    success: function(response){
			    	if( response.errCode == 0 )
			    	{
			    		alertify.success( response.errMsg );

			    		// Redirect the view
                        setTimeout(function(){
                            window.location.reload();
                        }, 2000);
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
<style>
	form#frm_authenticate_user {
	    text-align: center;
	    margin: auto;
	    position: absolute;
	    left: 0;
	    right: 0;
	    top: 10%;
	    width: 500px;
	    height: 370px;
	    background: #fff;
	    border-radius: 4px;
	    padding: 20px;
	}
	.mover-authentication {
	    display: inline-block;
	    width: 100%;
	    height: 100%;
	    background: #eee;
	    position: fixed;
	}
	.classlogo_part {
	    padding-bottom: 20px;
	    border-bottom: 1px solid #eee;
	    margin-bottom: 20px;
	}
	.ma_h1 {
	    background: #eee;
	    padding: 10px;
	    font-size: 25px;
	    margin-bottom: 20px;
	    font-weight: bolder;
	    color: #000;
	}
</style>
</head>

<body>

	<div class="mover-authentication">
		<form name="frm_authenticate_user" id="frm_authenticate_user" autocomplete="off">
			<div class="classlogo_part">
				<img src="{{ url('images/udistro-logo.png') }}" alt="">
			</div>
			<div class="ma_h1">Mover Autentication</div>
			<div class="form-group">
				<label class="form-group">Enter your mobile number</label>
				<input type="text" name="mobile_no" id="mobile_no" class="form-control" placeholder="Mobile number">
				<input type="hidden" name="client_id" id="client_id" class="form-control" value="{{ $clientId }}">
				<input type="hidden" name="invitation_id" id="invitation_id" class="form-control" value="{{ $invitationId }}">
			</div>
			<button type="submit" id="btn_authenticate_user" name="btn_authenticate_user" class="btn btn-primary">Submit</button>
		</form>
	</div>

</body>
</html> 