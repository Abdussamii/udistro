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
<link rel="icon" type="image/png" href="{{ url('images/udistro-fav.png') }}" sizes="32x32" />

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
.error { color: red; font-size: 14px; text-align: left; width: 100%; font-weight: normal; }
html,
body { height: 100%; min-height: 100%; }
.backColor { background: #f7f7f7; padding: 20px 0; height: 100%; min-height: 100%; }
.backColor { background: #f7f7f7; padding: 20px 0; }
.backColor .classlogo_part { margin-bottom: 20px; text-align: center; }
.field-section {
	padding: 20px;
}
.field-section h1 { text-align: center; margin-top: 0; font-size: 30px; margin-bottom: 20px; display: inline-block; width: 100%; color: #5f6883; border-radius: 3px; text-transform: capitalize; font-weight: 900; }
.field-section .form-control { box-shadow: none; border-radius: 0; border: 1px solid #e2e2e2; height: 45px; line-height: 45px; background: #fff; }
.field-section .form-group label { color: #a09fa4; }
.field-section label.normal { color: #2c80bc; font-weight: normal; }
.field-section .btn { font-weight: 600; font-size: 16px; padding: 10px 30px; background: #44bae6; border: 1px solid #44bae6; display: inline-block; width: auto; border-radius: 3px; }
.field-section .btn:hover,
.btn-primary:focus,
.btn-primary:active:focus { background-color: #fff; color: #44bae6; }
.backColor .text-center { margin-top: 20px; }
.backColor .text-center a { font-size: 16px; color: #44bae6; }
.center-copypart { margin-top: 30px; color: #a9a9a9; font-size: 12px; }
#frm_agent_login { margin: 30px 0; }
#frm_agent_login .form-group { margin-bottom: 20px; }
.error { color: red !important; }
#frm_authenticate_user fieldset {
	display: inline-block;
	border: 1px solid #dedede;
	padding: 15px;
	background: #fff;
	text-align: left;
	margin-bottom: 20px;
}
.term-condition { display: inline-block; width: 100%; padding: 10px 0; }
.error-01 { display: inline-block; }
#frm_authenticate_user fieldset h2 { font-size: 20px; margin: 0px; margin-bottom: 0px; padding-bottom: 15px; color: #44bae6; font-weight: 600; border-bottom: 1px solid #eee; margin-bottom: 15px; }
.block-h2 {
	font-size: 16px;
	margin-bottom: 10px;
	font-weight: 600;
}
#mobile_no { text-align: center; padding: 15px; height: 60px; color: #555; font-size: 18px; font-weight: 600; border: 1px solid #44bae6; margin: 15px 0 30px; }
.submit-btn-box { text-align: center; }
.accord-radio:hover { border: 1px solid #44bae6; background: #fff; cursor: pointer; }
.term-condition a { color: #5f6883; font-size: 16px; font-weight: 300; margin-left: 10px; text-decoration: none; }
.autentication .panel-default > .panel-heading {
	border-bottom: 1px solid #e4e4e4;
}
.autentication .panel-collapse {
	margin-top: 15px;
}
.autentication .panel-default > .panel-heading {
	color: #fff;
	background-color: #44bae6;
}
.autentication .panel-default > .panel-heading a {
	text-decoration: none;
	display: block;
	font-size: 18px;
	padding: 10px;
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
			},
			moving_from_house_type: {
				required: true
			},
			moving_from_house_level: {
				required: true
			},
			moving_from_house_bedroom_count: {
				required: true
			},
			moving_from_property_type: {
				required: true
			},
			moving_from_house_type: {
				required: true
			},
			moving_to_house_level: {
				required: true
			},
			moving_to_house_bedroom_count: {
				required: true
			},
			moving_to_property_type: {
				required: true
			},
			terms: {
				required: true
			}
		},
		messages: {
			mobile_no: {
				required: 'Please enter your mobile number',
				number: 'Please enter a valid mobile number'
			},
			moving_from_house_type: {
				required: 'Please select an option'
			},
			moving_from_house_level: {
				required: 'Please select floor level'
			},
			moving_from_house_bedroom_count: {
				required: 'Please select number of bedroom'
			},
			moving_from_property_type: {
				required: 'Please select property type'
			},
			moving_from_house_type: {
				required: 'Please select an option'
			},
			moving_to_house_level: {
				required: 'Please select floor level'
			},
			moving_to_house_bedroom_count: {
				required: 'Please select number of bedroom'
			},
			moving_to_property_type: {
				required: 'Please select property type'
			},
			terms: {
				required: 'Please select the Terms & Condition'
			}
		}
	});

	$('#btn_authenticate_user').click(function(){
		if( $('#frm_authenticate_user').valid() )
		{
    		$.ajax({
    			url: $('meta[name="route"]').attr('content') + '/movers/checkuserauthentication',
    			method: 'post',
    			data: {
    				frmData: $('#frm_authenticate_user').serialize()
    			},
    			headers: {
			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    },
			    success: function(response){
			    	if( response.errCode == 0 )
			    	{
			    		// alertify.success( response.errMsg );
			    		$('#service_response').find('.modal-header').html('Success');
		    			$('#service_response').find('.modal-body').html(response.errMsg);
		    			$('#service_response').modal('show');

			    		// Redirect the view
                        setTimeout(function(){
                            window.location.reload();
                        }, 2000);
			    	}
			    	else
			    	{
			    		// alertify.error( response.errMsg );
			    		$('#service_response').find('.modal-header').html('Alert');
		    			$('#service_response').find('.modal-body').html(response.errMsg);
		    			$('#service_response').modal('show');
			    	}
			    }
    		});
		}
	});
});
</script>
</head>

<body>

	<!-- Server Response -->
	<div class="modal fade" id="service_response" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
	    <div class="modal-dialog">
	        <div class="modal-content">
	            <div class="modal-header">
	            	
	            </div>
	            <div class="modal-body">
	            	
	            </div>
	            <div class="modal-footer">
	                <a style="width: 80px;" id="bt-modal-cancel" class="btn btn-success" href="javascript:void(0);" data-dismiss="modal">OK</a>
	            </div>
	        </div>
	    </div>
	</div>
	<!-- Server Response -->

<div class="backColor">
 <div class="container">
  <div class="classlogo_part"> <img src="{{ url('images/udistro-logo.png') }}" alt=""> </div>
  <div class="field-section autentication">
  <form name="frm_authenticate_user" id="frm_authenticate_user" autocomplete="off">
  <h1>Mover Autentication</h1>
  <div class="panel-group" id="accordion">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">Moving From Details</a>
        </h4>
      </div>
      <div id="collapse1" class="panel-collapse collapse in">
        <fieldset>
       <div class="col-sm-12">
       <div class="row">
        <div class="form-group col-sm-12">
         <div class="block-h2">Type</div>
         <select class="form-control" name="moving_from_house_type" id="moving_from_house_type">
          <option value="">Select</option>
          <option value="house">House</option>
          <option value="apartment/flat">Apartment/Flat</option>
          <option value="condo">Condo</option>
          <option value="studio">Studio</option>
         </select>
        </div>
        <div class="form-group col-sm-12">
         <div class="block-h2">Floor Level</div>
         <label class="form-group accord-radio">
          <input type="radio" name="moving_from_house_level" value="1">
          1</label>
         <label class="form-group accord-radio">
          <input type="radio" name="moving_from_house_level" value="2">
          2</label>
         <label class="form-group accord-radio">
          <input type="radio" name="moving_from_house_level" value="3">
          3</label>
         <label class="form-group accord-radio">
          <input type="radio" name="moving_from_house_level" value="4+">
          4 or more</label>
         <div class="clean-error">
          <label id="moving_from_house_level-error" class="error" for="moving_from_house_level"></label>
         </div>
        </div>
       </div>
       <div class="row">
        <div class="form-group col-sm-12">
         <div class="block-h2">No of bedrooms</div>
         <label class="form-group accord-radio">
          <input type="radio" name="moving_from_house_bedroom_count" value="1">
          1</label>
         <label class="form-group accord-radio">
          <input type="radio" name="moving_from_house_bedroom_count" value="2">
          2</label>
         <label class="form-group accord-radio">
          <input type="radio" name="moving_from_house_bedroom_count" value="3">
          3</label>
         <label class="form-group accord-radio">
          <input type="radio" name="moving_from_house_bedroom_count" value="4+">
          4 or more</label>
         <div class="clean-error">
          <label id="moving_from_house_bedroom_count-error" class="error" for="moving_from_house_bedroom_count"></label>
         </div>
        </div>
        <div class="form-group col-sm-12">
         <div class="block-h2">Did you own or rent this property</div>
         <label class="form-group accord-radio">
          <input type="radio" name="moving_from_property_type" value="own">
          Own</label>
         <label class="form-group accord-radio">
          <input type="radio" name="moving_from_property_type" value="rent">
          Rent</label>
         <div class="clean-error">
          <label id="moving_from_property_type-error" class="error" for="moving_from_property_type"></label>
         </div>
        </div>
       </div>
	   </div>
      </fieldset>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">Moving To Details</a>
        </h4>
      </div>
      <div id="collapse2" class="panel-collapse collapse">
        <fieldset>
       <div class="col-sm-12">
       <div class="row">
        <div class="form-group col-sm-12">
         <div class="block-h2">Type</div>
         <select class="form-control" name="moving_to_house_type" id="moving_to_house_type">
          <option value="">Select</option>
          <option value="house">House</option>
          <option value="apartment/flat">Apartment/Flat</option>
          <option value="condo">Condo</option>
          <option value="studio">Studio</option>
         </select>
        </div>
        <div class="form-group col-sm-12">
         <div class="block-h2">Floor Level</div>
         <label class="form-group accord-radio">
          <input type="radio" name="moving_to_house_level" value="1">
          1</label>
         <label class="form-group accord-radio">
          <input type="radio" name="moving_to_house_level" value="2">
          2</label>
         <label class="form-group accord-radio">
          <input type="radio" name="moving_to_house_level" value="3">
          3</label>
         <label class="form-group accord-radio">
          <input type="radio" name="moving_to_house_level" value="4+">
          4 or more</label>
         <div class="clean-error">
          <label id="moving_to_house_level-error" class="error" for="moving_to_house_level"></label>
         </div>
        </div>
       </div>
       <div class="row">
        <div class="form-group col-sm-12">
         <div class="block-h2">No of bedrooms</div>
         <label class="form-group accord-radio">
          <input type="radio" name="moving_to_house_bedroom_count" value="1">
          1</label>
         <label class="form-group accord-radio">
          <input type="radio" name="moving_to_house_bedroom_count" value="2">
          2</label>
         <label class="form-group accord-radio">
          <input type="radio" name="moving_to_house_bedroom_count" value="3">
          3</label>
         <label class="form-group accord-radio">
          <input type="radio" name="moving_to_house_bedroom_count" value="4+">
          4 or more</label>
         <div class="clean-error">
          <label id="moving_to_house_bedroom_count-error" class="error" for="moving_to_house_bedroom_count"></label>
         </div>
        </div>
        <div class="form-group col-sm-12">
         <div class="block-h2">Did you own or rent this property</div>
         <label class="form-group accord-radio">
          <input type="radio" name="moving_to_property_type" value="own">
          Own</label>
         <label class="form-group accord-radio">
          <input type="radio" name="moving_to_property_type" value="rent">
          Rent</label>
         <div class="clean-error">
          <label id="moving_to_property_type-error" class="error" for="moving_to_property_type"></label>
         </div>
        </div>
       </div>
	   </div>
      </fieldset>
      </div>
    </div>
  </div> 
  <div class="form-group"> 
     <!--<label class="form-group">Enter your mobile number</label>-->
     <input type="text" name="mobile_no" id="mobile_no" class="form-control" placeholder="Enter your mobile number">
     <input type="hidden" name="client_id" id="client_id" class="form-control" value="{{ $clientId }}">
     <input type="hidden" name="invitation_id" id="invitation_id" class="form-control" value="{{ $invitationId }}">
    </div>
	
	<div class="term-condition">
     <label>
      <input type="checkbox" name="terms" id="terms">
      <a href="https://termsfeed.com/terms-conditions/ecb999172c16298afdddc8eb94b9a21b" target="_blank">Terms &amp; Condition</a> </label>
     <div class="error-01">
      <label id="terms-error" class="error" for="terms"></label>
     </div>
    </div>
    <div class="submit-btn-box">
     <button type="submit" class="btn btn-primary btn-block" id="btn_authenticate_user" name="btn_authenticate_user">Submit</button>
    </div>
   </form>
  <div class="center-copypart text-center">
   <p>Copyright &copy; {{ date('Y') }} Udistro | All Rights Reserved.</p>
  </div>
</div>

 </div>
</div>

</body>
</html>
