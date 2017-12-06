<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<title>uDistro</title>

<!-- Bootstrap -->
<link href="{{ URL::asset('css/movers/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('css/movers/style.css') }}" rel="stylesheet">

<!-- <link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet"> -->

<!-- Fonts -->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600" rel="stylesheet">

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

	<script>
	// To show the to navigation when page is scroll down
	$(function(){
	    var navbar = $('.navbar');
	    $(window).scroll(function(){
	        if($(window).scrollTop() <= 40){
	       		navbar.css('display', 'none');
	        } else {
	          navbar.css('display', 'block'); 
	        }
	    });

	    calculateRoute('{{ $clientMovingFromAddress->address . ' ' . $clientMovingFromProvince->name }}', '{{ $clientMovingToAddress->address . ' ' . $clientMovingToProvince->name }}');
	});

	// To create route between two addresses
	function calculateRoute(from, to) {
	  // Center initialized to Naples, Italy
	  var myOptions = {
	    zoom: 10,
	    center: new google.maps.LatLng(56.1304, 106.3468),
	    mapTypeId: google.maps.MapTypeId.ROADMAP
	  };
	  // Draw the map
	  var mapObject = new google.maps.Map(document.getElementById("map"), myOptions);
	  var directionsService = new google.maps.DirectionsService();
	  var directionsRequest = {
	    origin: from,
	    destination: to,
	    travelMode: google.maps.DirectionsTravelMode.DRIVING,
	    unitSystem: google.maps.UnitSystem.METRIC
	  };
	  directionsService.route(
	    directionsRequest,
	    function(response, status)
	    {
	      if (status == google.maps.DirectionsStatus.OK)
	      {
	        new google.maps.DirectionsRenderer({
	          map: mapObject,
	          directions: response
	        });
	      }
	      else
	        alert('Unable to retrieve your route');
	    }
	  );
	}
	</script>

	<style type="text/css">
	.error {
		color: red;
	}
	</style>
</head>

<body>
<!-- Navbar -->
<nav class="navbar navbar-inverse navbar-fixed-top" style="display:none;">
    <div class="container-fluid">
        <div class="navbar-header">
        	<!-- Company image -->
          	<a class="navbar-brand" href="{{ url('/') }}">
          		<img src="{{ url('/images/logo.png') }}" height="60px" width="60px" alt="Udistro" />
          		<!-- <img src="{{ ( $companyDetails->image != '' ) ? url('/images/company/' . $companyDetails->image) : url('/images/movers/company_icon.png') }}" height="60px" width="60px" alt="Udistro" /> -->
          	</a>
          	<!-- <div class="user-name-section">
	          	<a href="javascript:void(0);">
	          		<img src="{{ ( $agentDetails->image != '' ) ? url('/images/agents/' . $agentDetails->image) : url('/images/movers/user-avtar.png') }}" class="user-avtar" alt="Udistro" height="50px" width="50px">
	          	</a>
	          	<div class="username">
	          		<h3>{{ $agentName }}</h3>
	          	</div>
          	</div> -->
        </div>
        <div class="nav navbar-nav navbar-right user-page">
	        <div class="dropdown user-dropdown">
		        <div class="user-short-name">
		        	<span>{{ $clientInitials }}</span>
		        </div>
	        	<button class="btnbg-none" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ ucwords( strtolower( $clientName ) ) }}<span class="caret"></span></button>
		        <ul class="dropdown-menu" aria-labelledby="dLabel">
		            <li>
			            <a href="javascript:void(0);">
			            	<i class="fa fa-power-off"></i>
			            	<span class="text">Logout</span>
			            </a>
		            </li>
		        </ul>
	        </div>
        </div>
    </div>
</nav>
<!-- End Navbar -->
<!-- Map Section -->
<!-- url('/images/movers/map-bg.jpg') -->
<section class="content-section map-bg" style="background:url('{{ ( $clientMovingToProvince->image != '' ) ? url('/images/province/' . $clientMovingToProvince->image) : url('/images/movers/map-bg.jpg') }}') no-repeat center center;position: relative;display: block;max-width: 100%;">
	<div class="container-fluid">
      	<div class="row">
	        <div class="col-md-4">
	          <div class="contry-name">
	          <h2>{{ ucwords( strtolower( $clientMovingToProvince->abbreviation ) ) }}</h2>
	          <span>{{ ucwords( strtolower( $clientMovingToProvince->name ) ) }}</span>
	          </div>
	        </div>
	        <div class="col-md-4">
	        
	        </div>
	        <div class="col-md-4">
	        	<!-- Google map here -->
				<div class="map-area" id="map" style="overflow: hidden; border-radius: 50%; height: 330px; width: 330px;">
					
				</div>
	        </div>
      	</div>
    </div>
</section>
<!-- Map Section Ends Here--> 


<!-- percentage bar -->

<section class="percentage-section">
	<div class="container">
		<div class="percentage-bar">
		<h2>25 Percent Completed</h2>
		<div class="progress">
			<div class="progress-bar" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width:25%">
				<span class="sr-only">25% Complete</span>
			</div>
		</div>
		</div>
	</div>
</section>
<!-- end percentage bar -->

<!-- activities-section -->
<section class="mailboxes-section">

	<div class="container">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<?php
				if( isset( $activities ) && count( $activities ) > 0 )
				{
					foreach ($activities as $activity)
					{
					?>
						<div class="col-xs-6 col-lg-4">
							<div class="boxes">
								<div class="img-icon">
									<!-- If image is not available, show the default image -->
									<img src="{{ ($activity->image_name !='' ) ? url('/images/activities/' . $activity->image_name) : url('/images/activity_image_not_found.png') }}" class="center-block" alt="">
								</div>
								<div class="box-title">
								<h3>{{ ucwords( strtolower( $activity->activity ) ) }}</h3>
								</div>
								<div class="pophover-icon">
									<ul class="popover-icon-group activities_container">
										<li><a href="javascript:void(0);" title="Get started" class="{{ $activity->activity_class }}"><i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></a></li>
										<li><a href="javascript:void(0);" title="Do it later" class=""><i class="fa fa-history" aria-hidden="true"></i></a></li>
										<li><a href="javascript:void(0);" title="Discard" class=""><i class="fa fa-times-circle" aria-hidden="true"></i></a></li>
										<li>
											<input type="hidden" name="activity_final_status[]" class="activity_final_status" value="0">
										</li>
									</ul>
								</div>
							</div>
						</div>
					<?php
					}
				}
				?>
			</div>
		</div>
	</div>

</section>
<!--  End activities-section -->

<div class="container">
	<div class="review-section">
		<div class="row">
			<div class="col-md-4">
				<div class="user-name-review">
					<div class="user-short-name">
						<span>{{ $agentInitials }}</span>
						<p>{{ $agentName }}</p>
					</div>
				</div>
			</div>
			<div class="col-md-8">
				<div class="reciew-box">
					<h2>Special Thanks to Agent {{ $agentName }}</h2>
					<ul class="ratingstar">
						<!-- <li><a href="javascript:void(0);"><i class="fa fa-star red" aria-hidden="true"></i></a></li> -->
						<li><a href="javascript:void(0);"><i class="fa fa-star assign_agent_rating" aria-hidden="true"></i></a></li>
						<li><a href="javascript:void(0);"><i class="fa fa-star assign_agent_rating" aria-hidden="true"></i></a></li>
						<li><a href="javascript:void(0);"><i class="fa fa-star assign_agent_rating" aria-hidden="true"></i></a></li>
						<li><a href="javascript:void(0);"><i class="fa fa-star assign_agent_rating" aria-hidden="true"></i></a></li>
						<li><a href="javascript:void(0);"><i class="fa fa-star assign_agent_rating" aria-hidden="true"></i></a></li>
					</ul>
					<span>( {{ $agentRating }} Rating )</span>
				</div>
			</div>
		</div>
	</div>
	<div class="comment-section">
		<div class="row">
			<div class="col-md-12">
				<div class="comment-area">
					<h2>Hi {{ $agentName }},</h2>
					<p id="agent_rating_message_container">
						I appreciate you work and want to say thank you.
					</p>
					<textarea id="agent_rating_message" class="form-control" style="display: none;">I appreciate you work and want to say thank you.</textarea>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="user-comment-info">
					<div class="col-md-8">
						<div class="comment-group-left">
							<ul class="comment-group">
								<li><a href="javascript:void(0);"><i class="fa fa-thumbs-up" aria-hidden="true"></i>Helpful</a></li>
								<li><a href="javascript:void(0);"><i class="fa">2</i>Follow</a></li>
								<li><a href="javascript:void(0);" id="agent_rating_edit_message">Edit Message</a></li>
							</ul>
						</div>
					</div>
					<div class="col-md-4">
						<div class="user-name-section user-pro-coment">
							<strong>Share this with :</strong>
							<img src="{{ ( $agentDetails->image != '' ) ? url('/images/agents/' . $agentDetails->image) : url('/images/movers/user-avtar.png') }}" class="user-avtar" alt="Udistro" height="50px" width="50px">
							<div class="username">
								<h3>{{ $agentName }}</h3>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<button type="button" class="btn btn-lg center-block coment-submit-btn">Submit</button>
				</div>
			</div>
		</div>
	</div>
</div>

<footer class="footer-main section-pd">
  <div class="container">
    <div class="row">
      <div class="col-md-4">
        <div class="media-body client-achive-step">
          <h2 class="media-heading">Company</h2>
        </div>
        <ul class="list-group custom-listgroup">
          <li class="list-group-item"><a href="javascript:void(0);"><i class="fa fa-angle-double-right" aria-hidden="true"></i>About</a></li>
          <li class="list-group-item"><a href="javascript:void(0);"><i class="fa fa-angle-double-right" aria-hidden="true"></i>Career</a></li>
          <li class="list-group-item"><a href="javascript:void(0);"><i class="fa fa-angle-double-right" aria-hidden="true"></i>Sitemap</a></li>
          <li class="list-group-item"><a href="javascript:void(0);"><i class="fa fa-angle-double-right" aria-hidden="true"></i>Terms of Use</a></li>
          <li class="list-group-item"><a href="javascript:void(0);"><i class="fa fa-angle-double-right" aria-hidden="true"></i>Terms of services</a></li>
          <li class="list-group-item"><a href="javascript:void(0);"><i class="fa fa-angle-double-right" aria-hidden="true"></i>Privacy Policy</a></li>
        </ul>
      </div>
      <div class="col-md-4">
        <div class="media-body client-achive-step">
          <h2 class="media-heading">Important Links</h2>
        </div>
        <ul class="list-group custom-listgroup">
          <li class="list-group-item"><a href="javascript:void(0);"><i class="fa fa-angle-double-right" aria-hidden="true"></i>Login</a></li>
          <li class="list-group-item"><a href="javascript:void(0);"><i class="fa fa-angle-double-right" aria-hidden="true"></i>Features</a></li>
          <li class="list-group-item"><a href="javascript:void(0);"><i class="fa fa-angle-double-right" aria-hidden="true"></i>Free Trial</a></li>
          <li class="list-group-item"><a href="javascript:void(0);"><i class="fa fa-angle-double-right" aria-hidden="true"></i>Pricing</a></li>
          <li class="list-group-item"><a href="javascript:void(0);"><i class="fa fa-angle-double-right" aria-hidden="true"></i>Support</a></li>
          <li class="list-group-item"><a href="javascript:void(0);"><i class="fa fa-angle-double-right" aria-hidden="true"></i>Schedule Demo</a></li>
        </ul>
      </div>
      <div class="col-md-4">
        <div class="media-body client-achive-step">
          <h2 class="media-heading">Follow Us</h2>
        </div>
        <ul class="list-group custom-listgroup">
          <li class="list-group-item"><a href="javascript:void(0);"><i class="fa fa-angle-double-right" aria-hidden="true"></i>Twitter</a></li>
          <li class="list-group-item"><a href="javascript:void(0);"><i class="fa fa-angle-double-right" aria-hidden="true"></i>Facebook</a></li>
          <li class="list-group-item"><a href="javascript:void(0);"><i class="fa fa-angle-double-right" aria-hidden="true"></i>Google Plus</a></li>
          <li class="list-group-item"><a href="javascript:void(0);"><i class="fa fa-angle-double-right" aria-hidden="true"></i>Linkedin</a></li>
          <li class="list-group-item"><a href="javascript:void(0);"><i class="fa fa-angle-double-right" aria-hidden="true"></i>You tube</a></li>
          <li class="list-group-item"><a href="javascript:void(0);"><i class="fa fa-angle-double-right" aria-hidden="true"></i>Instagram</a></li>
        </ul>
      </div>
    </div>
  </div>
</footer>

<!-- Forward Mail Modal -->
<div id="forward_mail_modal" class="modal fade" role="dialog">
  	<div class="modal-dialog modal-lg">
    <!-- Modal content-->
	    <div class="modal-content">
	    	<div class="modal-body">
	      		<div class="close close-btn close_modal" data-activity="forward_mail" data-dismiss="modal"><img src="{{ url('/images/movers/close-img.png') }}" alt=""></div>
		      	<h2>Mail Forward</h2>
		      	<div class="row">
		      		<div class="col-sm-3 col-md-3 col-lg-3">
	      				<div>
      						<img src="{{ url('/images/canada_post_logo.jpg') }}" alt="Udistro" />
      					</div>
      					<div>&nbsp;</div>
		      		</div>

		      		<div class="col-sm-9 col-md-9 col-lg-9" id="forward_mail_step1" style="width: 500px; height: 300px;">
		      			<div>
      						<strong>Ensure all your mail follows you to your new address</strong>
      					</div>
      					<br>
      					<div>
      						<form name="frm_forward_mail" id="frm_forward_mail">
      							<div><input type="radio" name="forward_mail_method" value="1"> Do it here online</div>
      							<div><input type="radio" name="forward_mail_method" value="2"> Do it at Canada post office</div>
      							<label id="forward_mail_method-error" class="error" for="forward_mail_method"></label>
      						</form>
      					</div>
		      		</div>

		      		<div class="col-sm-9 col-md-9 col-lg-9" id="forward_mail_step2" style="width: 500px; height: 300px; display: none;">
		      			<p>
		      				When you buy a Mail Forwarding before you moves, with your permission, Canada Post will share your updated address information with companies who have an existing relationship with you and who are subscribed to Canada post NCOA Mover Data Service. Choose the 12-month service for the most convenience and savings. 
		      			</p>
		      			<a href="javascript:void(0);" onclick="window.open('https://www.canadapost.ca/web/en/products/details.page?article=forward_your_mail_wh', '_blank', 'location=yes,height=800,width=1000,scrollbars=yes,status=yes');">Click here to get started</a>
		      		</div>

		      		<div class="col-sm-9 col-md-9 col-lg-9" id="forward_mail_step3" style="width: 500px; height: 300px; display: none;">
		      			<div>
      						<strong>Search Canada post office closest to you</strong>
      					</div>
      					<div>
      						<form name="frm_forward_mail_search_postoffices" id="frm_forward_mail_search_postoffices">
	      						<div class="col-sm-9 col-md-9 col-lg-9">
	      							<input type="text" name="forward_mail_search_postoffices_address" id="forward_mail_search_postoffices_address" class="form-control" placeholder="Search for Canada post office">
	      						</div>
	      						<div class="col-sm-3 col-md-3 col-lg-3">
	      							<!-- <input type="button" name="" id="" class="btn" value="Go"> -->
	      							<a href="javascript:void(0);" onclick="" id="forward_mail_search_postoffice">Go</a>
	      						</div>
      						</form>
      					</div>
		      		</div>

		      		<div class="col-sm-9 col-md-9 col-lg-9" id="forward_mail_step4" style="width: 500px; height: 300px; display: none;">
		      			<strong>Have you completed this task?</strong>
		      			<br>
		      			<div class="col-sm-6 col-md-6 col-lg-6">
		      				<button type="button" class="btn btn-primary forward_mail_user_response" id="1">Yes</button>
		      			</div>
		      			<div class="col-sm-6 col-md-6 col-lg-6">
		      				<button type="button" class="btn btn-primary forward_mail_user_response" id="0">No</button>
		      			</div>
		      		</div>

		      	</div>
		      	<div class="row">
		      		<div class="col-sm-3 col-md-3 col-lg-3">
		      			Review / Rating
		      		</div>
		      		<div class="col-sm-9 col-md-9 col-lg-9">
		      			<div class="col-md-4">
	      					<p>Peace of mind</p>
	      					<p>Ensure you don't miss important email</p>
	      				</div>
	      				<div class="col-md-4">
	      					<p>Security</p>
	      					<p>Keep your valuable mail private</p>
	      				</div>
	      				<div class="col-md-4">
	      					<p>Reliability</p>
	      					<p>More dependable than neighbours</p>
	      				</div>
		      		</div>
		      	</div>
		      	<div class="row">
		      		<div class="col-sm-8 col-md-8 col-lg-8">&nbsp;</div>
		      		<div class="col-sm-4 col-md-4 col-lg-4">
		      			<a href="javascript:void(0);" id="btn_prev_forward_mail" class="btn">Previous</a>
		      			<a href="javascript:void(0);" id="btn_next_forward_mail" class="btn">Next</a>
		      		</div>
		      	</div>
	      	</div>
	      	<!-- <div class="modal-footer">
	        	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      	</div> -->
	    </div>
  	</div>
</div>
<!-- Forward Mail Modal End -->

<!-- Update Address Modal -->
<div id="update_address_modal" class="modal fade">
    <div class="modal-dialog modal-lg">
    <!-- Modal content-->
	    <div class="modal-content">
	    	<div class="modal-body">
	      		<div class="close close-btn close_modal" data-activity="update_address" data-dismiss="modal"><img src="{{ url('/images/movers/close-img.png') }}" alt=""></div>
		      	<h2>Update Address</h2>
		      	<div class="row">
		      		<div class="col-sm-3 col-md-3 col-lg-3">
	      				<div>
      						<img src="{{ url('/images/canada_post_logo.jpg') }}" alt="Udistro" />
      					</div>
      					<div>&nbsp;</div>
		      		</div>

		      		<div class="col-sm-9 col-md-9 col-lg-9" id="update_address_step1" style="width: 500px; height: 300px;">
		      			<div>
      						<strong>Canada post cannot update your new address with all the organization you are have business with, especially infrequent mailers(for example, tax documents, licence renewals and financial statements)</strong>
      					</div>
      					<br>
      					<div>
      						<ul>
      							<li>Federal Agencies</li>
      							<li>Provincial Agencies</li>
      							<li>Other Checklist</li>
      						</ul>
      					</div>
		      		</div>

		      		<div class="col-sm-9 col-md-9 col-lg-9" id="update_address_step2" style="width: 500px; height: 400px; display: none;">
		      			<div>
		      				<strong>Update address with CRA</strong>
		      			</div>
		      			<div>
		      				<div>
		      					Since you have full access to your CRA account, you will be redirected to CRA website and you can do it online by yourself in less than 2 to 3 minutes. Having full access means you have access code giving to you by CRA
		      				</div>
		      				<div>
		      					<a href="javascript:void(0);" onclick="window.open('https://www.canada.ca/en/revenue-agency/services/tax/businesses/topics/changes-your-business/change-address.html', '_blank', 'location=yes,height=800,width=1000,scrollbars=yes,status=yes');">Click here to get started</a>
		      				</div>
		      			</div>
		      		</div>

		      		<div class="col-sm-9 col-md-9 col-lg-9" id="update_address_step3" style="height: 400px; display: none;">
		      			<div>
		      				<strong>Update address with CRA</strong>
		      			</div>
		      			<div>
		      				<div>
		      					If you have don't have full access to your CRA account, here is what you do, call CRA:
		      				</div>
		      				<div class="row">
		      					<div class="col-sm-3 col-md-3 col-lg-3">
		      						<strong>
		      							Have these handy, before this call
		      						</strong>
		      						<div>
		      							<div>Your full name</div>
		      							<div>Old and new address</div>
		      							<div>Old and new postal codes</div>
		      							<div>Your SIN#</div>
		      							<div>Phone contact, name and DOB of children</div>
		      						</div>
		      					</div>
		      					<div class="col-sm-3 col-md-3 col-lg-3">
		      						<strong>
		      							Opening Hours
		      						</strong>
		      						<div>
		      							<div>
		      								Monday to Friday, 07:00 AM - 11:00 PM ET
 		      							</div>
		      							<div>
		      								Saturday and Sunday, 09:00 AM - 09:00 PM ET
		      							</div>
		      						</div>
		      					</div>
		      					<div class="col-sm-3 col-md-3 col-lg-3">
		      						<strong>
		      							Phone Numbers
		      						</strong>
		      						<div>
		      							<div>1-800-959-8281</div>
		      							<div>Outside of Canada: 613-940-8495</div>
		      							
		      						</div>
		      					</div>
		      				</div>
		      			</div>
		      		</div>

		      		<div class="col-sm-9 col-md-9 col-lg-9" id="update_address_step4" style="height: 400px; display: none;">
		      			<div>
		      				<strong>Update address with Provincial Health Agency</strong>
		      			</div>
		      			<div>
		      				<div>
		      					If you have don't have full access to your CRA account, here is what you do, call CRA:
		      				</div>
		      				<div class="row">
		      					<div class="col-sm-3 col-md-3 col-lg-3">
		      						<strong>
		      							Have these handy, before this call
		      						</strong>
		      						<div>
		      							<div>Your full name</div>
		      							<div>Old and new address</div>
		      							<div>Old and new postal codes</div>
		      							<div>Your SIN#</div>
		      							<div>Phone contact, name and DOB of children</div>
		      						</div>
		      					</div>
		      					<div class="col-sm-3 col-md-3 col-lg-3">
		      						<strong>
		      							Opening Hours
		      						</strong>
		      						<div>
		      							<div>
		      								Monday to Friday, 07:00 AM - 11:00 PM ET
 		      							</div>
		      							<div>
		      								Saturday and Sunday, 09:00 AM - 09:00 PM ET
		      							</div>
		      						</div>
		      					</div>
		      					<div class="col-sm-3 col-md-3 col-lg-3">
		      						<strong>
		      							Phone Numbers
		      						</strong>
		      						<div>
		      							<div>1-800-959-8281</div>
		      							<div>Outside of Canada: 613-940-8495</div>
		      							
		      						</div>
		      					</div>
		      				</div>
		      			</div>
		      		</div>

		      		<div class="col-sm-9 col-md-9 col-lg-9" id="update_address_step5" style="width: 500px; height: 400px; display: none;">
		      			<div>
		      				<strong>Update address with Driver's License Agency</strong>
		      			</div>
		      			<div>
		      				<div>
		      					You are required to report changes in your name or address in person within 15 days to your Autopac Agency. At that time, a new photo will be taken. Visit or call any Autopac Agent closest to you, or contact Manitoba Public Insurance at 204-985-7000 in the Winnipeg calling area or toll-free at 1-800-665-2410
		      				</div>
		      				<div>
		      					<a href="javascript:void(0);" onclick="window.open('https://www.google.co.in/maps/search/autopac+agency+in+canada/@49.0633977,-115.1102883,5z/data=!3m1!4b1', 'location=yes,height=800,width=1000,scrollbars=yes,status=yes');">Click here to get started</a>
		      				</div>
		      			</div>
		      		</div>

		      		<div class="col-sm-9 col-md-9 col-lg-9" id="update_address_step6" style="width: 500px; height: 400px; display: none;">
		      			<div>
		      				<strong>Update address with Driver's License Agency</strong>
		      			</div>
		      			<div>
		      				<div>
		      					You are required to report changes in your name or address in person within 15 days to your Autopac Agency. At that time, a new photo will be taken. Visit or call any Autopac Agent closest to you, or contact Manitoba Public Insurance at 204-985-7000 in the Winnipeg calling area or toll-free at 1-800-665-2410
		      				</div>
		      				<div>
		      					<a href="javascript:void(0);" onclick="window.open('https://www.google.co.in/maps/search/autopac+agency+in+canada/@49.0633977,-115.1102883,5z/data=!3m1!4b1', 'location=yes,height=800,width=1000,scrollbars=yes,status=yes');">Click here to get started</a>
		      				</div>
		      			</div>
		      		</div>

		      		<div class="col-sm-9 col-md-9 col-lg-9" id="update_address_step7" style="width: 500px; height: 400px; display: none;">
		      			<div>
		      				<strong>Update address with Driver's License Agency</strong>
		      			</div>
		      			<div>
		      				<div>
		      					You are required to report changes in your name or address in person within 15 days to your Autopac Agency. At that time, a new photo will be taken. Visit or call any Autopac Agent closest to you, or contact Manitoba Public Insurance at 204-985-7000 in the Winnipeg calling area or toll-free at 1-800-665-2410
		      				</div>
		      				<div>
		      					<a href="javascript:void(0);" onclick="window.open('https://www.google.co.in/maps/search/autopac+agency+in+canada/@49.0633977,-115.1102883,5z/data=!3m1!4b1', 'location=yes,height=800,width=1000,scrollbars=yes,status=yes');">Click here to get started</a>
		      				</div>
		      			</div>
		      		</div>

		      	</div>
		      	<div class="row">
		      		<div class="col-sm-3 col-md-3 col-lg-3">
		      			Review / Rating
		      		</div>
		      		<div class="col-sm-9 col-md-9 col-lg-9">
		      			<form name="frm_update_address" id="frm_update_address">
			      			<div class="col-md-4">
		      					<p>
		      						Do you have full access to your CRA My online account?
		      					</p>
		      					<div>
		      						<label><input type="radio" name="update_address_method1" value="1">Yes</label>
		      						<label><input type="radio" name="update_address_method1" value="2">No</label>
		      					</div>
		      					<label id="update_address_method1-error" class="error" for="update_address_method1"></label>
		      				</div>
		      				<div class="col-md-4">
		      					<p>
		      						Do you have dependent children
		      					</p>
		      					<div>
		      						<label><input type="radio" name="update_address_method2" value="1">Yes</label>
		      						<label><input type="radio" name="update_address_method2" value="2">No</label>
		      					</div>
		      					<label id="update_address_method2-error" class="error" for="update_address_method2"></label>
		      				</div>
		      				<div class="col-md-4">
		      					<p>Do you receive child benefit</p>
		      					<div>
		      						<label><input type="radio" name="update_address_method3" value="1">Yes</label>
		      						<label><input type="radio" name="update_address_method3" value="2">No</label>
		      					</div>
		      					<label id="update_address_method3-error" class="error" for="update_address_method3"></label>
		      				</div>
	      				</form>
		      		</div>
		      	</div>
		      	<div class="row">
		      		<div class="col-sm-8 col-md-8 col-lg-8">&nbsp;</div>
		      		<div class="col-sm-4 col-md-4 col-lg-4">
		      			<a href="javascript:void(0);" id="btn_prev_update_address" class="btn">Previous</a>
		      			<a href="javascript:void(0);" id="btn_next_update_address" class="btn">Next</a>
		      		</div>
		      	</div>
	      	</div>
	      	<!-- <div class="modal-footer">
	        	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      	</div> -->
	    </div>
  	</div>
</div>
<!-- Update Address Modal End -->

<!-- Mailbox keys Modal -->
<div id="mailbox_key_modal" class="modal fade">
    <div class="modal-dialog modal-lg">
    <!-- Modal content-->
	    <div class="modal-content">
	    	<div class="modal-body">
	      		<div class="close close-btn close_modal" data-activity="mailbox_keys" data-dismiss="modal"><img src="{{ url('/images/movers/close-img.png') }}" alt=""></div>
		      	<h2>Mailbox Keys</h2>
		      	<div class="row">
		      		<div class="col-sm-3 col-md-3 col-lg-3">
	      				<div>
      						<img src="{{ url('/images/canada_post_logo.jpg') }}" alt="Udistro" />
      					</div>
      					<div>&nbsp;</div>
		      		</div>

		      		<div class="col-sm-9 col-md-9 col-lg-9" id="mailbox_keys_step1" style="width: 500px; height: 300px;">
		      			<div>
      						<strong>New to the neighbourhood, you need mailbox keys. If you are moving to a neighbourhood where mail is delivered to a community mailbox, check to see if the former residents left the mailbox keys behind. If not, here's what to do:</strong>
      					</div>
      					<br>
      					<div>
      						<form name="frm_mailbox_keys" id="frm_mailbox_keys">
      							<div><input type="radio" name="mailbox_keys_method" value="2"> Do it here online</div>
      							<div><input type="radio" name="mailbox_keys_method" value="1"> Call Canada Post</div>

      							<label id="mailbox_keys_method-error" class="error" for="mailbox_keys_method"></label>
      						</form>
      					</div>
		      		</div>

		      		<div class="col-sm-9 col-md-9 col-lg-9" id="mailbox_keys_step2" style="width: 500px; height: 300px; display: none;">
		      			<div>
      						<strong>Calling Canada Post</strong>
      						<div class="row">
      							<br>
      							<div class="col-sm-4 col-md-4 col-lg-4">
      								<strong>What you to make this call</strong>
      								<ul>
      									<li>Your full name</li>
      									<li>Old and new address</li>
      									<li>Old and new postal code etc</li>
      								</ul>
      							</div>
      							<div class="col-sm-4 col-md-4 col-lg-4">
      								<strong>Opening Hours</strong>
      								<p>
      									Monday to Friday, 7:00 AM - 11:00 PM ET
      								</p>
      								<p>
      									Saturday and Sunday, 09:00 AM - 09:00 PM ET
      								</p>
      							</div>
      							<div class="col-sm-4 col-md-4 col-lg-4">
      								<strong>Phone Numbers</strong>
      								<p>
      									1-866-607-6301
      								</p>
      								<p>
      									Outside of Canada: 416-979-3033
      								</p>
      							</div>
      						</div>
      					</div>
      				</div>

      				<div class="col-sm-9 col-md-9 col-lg-9" id="mailbox_keys_step3" style="width: 500px; height: 300px; display: none;">
		      			<div>
      						<strong>Do it online:</strong>
      						<div><a href="javascript:void(0);" onclick="window.open('https://www.canadapost.ca/cpo/mc/app/cmb/existing_state.jsf', '_blank', 'location=yes,height=800,width=1000,scrollbars=yes,status=yes');">Click here to get started</a></div>
      					</div>
      				</div>

      				<div class="col-sm-9 col-md-9 col-lg-9" id="mailbox_keys_step4" style="width: 500px; height: 300px; display: none;">
		      			<strong>Have you completed this task?</strong>
		      			<br>
		      			<div class="col-sm-6 col-md-6 col-lg-6">
		      				<button type="button" class="btn btn-primary mailbox_keys_user_response" id="1">Yes</button>
		      			</div>
		      			<div class="col-sm-6 col-md-6 col-lg-6">
		      				<button type="button" class="btn btn-primary mailbox_keys_user_response" id="0">No</button>
		      			</div>
		      		</div>

		      	</div>
		      	<div class="row">
		      		<div class="col-sm-3 col-md-3 col-lg-3">
		      			Review / Rating
		      		</div>
		      		<div class="col-sm-9 col-md-9 col-lg-9">
		      			<div class="col-md-4">
	      					<p>
	      						Canada post will inform you of your community mailbox location
	      					</p>
	      				</div>
	      				<div class="col-md-4">
	      					<p>
	      						Canada post will leave Delivery Notice Card on your front door
	      					</p>
	      				</div>
	      				<div class="col-md-4">
	      					<p>
	      						Bring the Delivery Notice Card, government-issued photo identification and proof of residence when you pick up your keys 
	      					</p>
	      				</div>
		      		</div>
		      	</div>
		      	<div class="row">
		      		<div class="col-sm-8 col-md-8 col-lg-8">&nbsp;</div>
		      		<div class="col-sm-4 col-md-4 col-lg-4">
		      			<a href="javascript:void(0);" id="btn_prev_mailbox_keys" class="btn">Previous</a>
		      			<a href="javascript:void(0);" id="btn_next_mailbox_keys" class="btn">Next</a>
		      		</div>
		      	</div>
	      	</div>
	      	<!-- <div class="modal-footer">
	        	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      	</div> -->
	    </div>
  	</div>
</div>
<!-- Mailbox keys Modal End -->

<!-- Connect Utilities Modal -->
<div id="connect_utilities_modal" class="modal fade">
    <div class="modal-dialog modal-lg">
    <!-- Modal content-->
	    <div class="modal-content">
	    	<div class="modal-body">
	      		<div class="close close-btn close_modal" data-activity="connect_utilities" data-dismiss="modal"><img src="{{ url('/images/movers/close-img.png') }}" alt=""></div>
		      	<h2>Connect Utilities</h2>
		      	<div class="row">
		      		<div class="col-sm-3 col-md-3 col-lg-3">
	      				<div>
      						<img src="{{ url('/images/canada_post_logo.jpg') }}" alt="Udistro" />
      					</div>
      					<div>&nbsp;</div>
		      		</div>

		      		<div class="col-sm-9 col-md-9 col-lg-9" id="connect_utilities_step1" style="height: 300px;">
		      			<div>
      						<strong>Moving to a new neighborhood, you need to setup new, cancel or transfer old service to your new address. If you need to open a Hydro, Gas, Water and Waste accounts, then start here:</strong>
      					</div>
      					<br>
      					<div>
      						<ul>
      							<li>Hydro, Electricity and Gas</li>
      							<li>Water, Waste and Recycle</li>
      						</ul>
      					</div>
		      		</div>

		      		<div class="col-sm-9 col-md-9 col-lg-9" id="connect_utilities_step2" style="height: 400px; display: none;">
		      			<div>
      						<strong>Connect Hydro, Electricity and Gas</strong>
      						<p>If you are moving in, and are financially responsible for Hydro, gas, or electricity at your new address, you need to open and account:</p>
      					</div>
      					<div>
      						<div><label><input type="radio" name="connect_utilities_method_type" value="1" checked=""> Call utility service</label></div>
      						<div><label><input type="radio" name="connect_utilities_method_type" value="2"> Do it here online</label></div>
      					</div>

      					<!-- Different Methods -->
      					<!-- Call utility service -->
      					<div class="row" id="connect_utilities_method_type_container1">
	      					<div class="col-sm-3 col-md-3 col-lg-3">
	      						<strong>
	      							What you to make this call
	      						</strong>
	      						<div>
	      							<div>Your full name</div>
	      							<div>Old and new address</div>
	      							<div>Old and new postal code</div>
	      						</div>
	      					</div>
	      					<div class="col-sm-3 col-md-3 col-lg-3">
	      						<strong>
	      							Opening Hours
	      						</strong>
	      						<div>
	      							<div>
	      								Monday to Friday, 07:00 AM - 11:00 PM ET
		      							</div>
	      							<div>
	      								Saturday and Sunday, 09:00 AM - 09:00 PM ET
	      							</div>
	      						</div>
	      					</div>
	      					<div class="col-sm-3 col-md-3 col-lg-3">
	      						<strong>
	      							Phone Numbers
	      						</strong>
	      						<div>
	      							<div>1-866-607-6301</div>
	      							<div>Outside of Canada: 416-979-3033</div>
	      						</div>
	      					</div>
	      				</div>

	      				<!-- Do it here online -->
      					<div class="row" id="connect_utilities_method_type_container2" style="display: none;">
	      					<div>
	      						<strong>Do it online</strong>
	      					</div>
	      					<a href="javascript:void(0);" onclick="window.open('https://www.hydro.mb.ca/custmoves/main.jsf', '_blank', 'location=yes,height=800,width=1000,scrollbars=yes,status=yes');">Click here to get started</a>
	      				</div>


		      		</div>

		      		<div class="col-sm-9 col-md-9 col-lg-9" id="connect_utilities_step3" style="height: 450px; display: none;">
		      			<div>
      						<strong>Water, Waste and Recycle Bins</strong>
      						<p>If you are moving in, and are financially responsible for Water, waste, or recycle at your new address, you need to open and account:</p>
      					</div>
      					<div>
      						<ul>
      							<li>Moving In</li>
      							<li>Moving Out</li>
      						</ul>
      					</div>

      					<div class="row">
	      					<div class="col-sm-3 col-md-3 col-lg-3">
	      						<strong>
	      							We will require
	      						</strong>
	      						<div>
	      							<div>Your name</div>
	      							<div>Name of anyone financially resonsible for the utility bill</div>
	      							<div>Service Address</div>
	      						</div>
	      					</div>
	      					<div class="col-sm-3 col-md-3 col-lg-3">
	      						<strong>
	      							Hours
	      						</strong>
	      						<div>
	      							<div>
	      								Monday to Thursday, 08:30 AM - 07:00 PM (except holidays)
		      							</div>
	      							<div>
	      								Friday and Saturday, 08:30 AM - 04:30 PM (except holiday long weekend)
	      							</div>
	      						</div>
	      					</div>
	      					<div class="col-sm-3 col-md-3 col-lg-3">
	      						<strong>
	      							Phone Numbers
	      						</strong>
	      						<div>
	      							<div>City Services: 3-1-1</div>
	      						</div>
	      					</div>
	      				</div>
		      		</div>

      				<div class="col-sm-9 col-md-9 col-lg-9" id="connect_utilities_step4" style="width: 500px; height: 300px; display: none;">
		      			<strong>Have you completed this task?</strong>
		      			<br>
		      			<div class="col-sm-6 col-md-6 col-lg-6">
		      				<button type="button" class="btn btn-primary mailbox_keys_user_response" id="1">Yes</button>
		      			</div>
		      			<div class="col-sm-6 col-md-6 col-lg-6">
		      				<button type="button" class="btn btn-primary mailbox_keys_user_response" id="0">No</button>
		      			</div>
		      		</div>

		      	</div>
		      	<div class="row">
		      		<div class="col-sm-3 col-md-3 col-lg-3">
		      			Review / Rating
		      		</div>
		      		<div class="col-sm-9 col-md-9 col-lg-9">
		      			<div class="col-md-4">
	      					<p>
	      						I need to start new service at a new address (open new account)
	      					</p>
	      				</div>
	      				<div class="col-md-4">
	      					<p>
	      						I need to stop service at one address and start service at a new address (transfer account)
	      					</p>
	      				</div>
	      				<div class="col-md-4">
	      					<p>
	      						I need to stop service or cancel account (account cancel)
	      					</p>
	      				</div>
		      		</div>
		      	</div>
		      	<div class="row">
		      		<div class="col-sm-8 col-md-8 col-lg-8">&nbsp;</div>
		      		<div class="col-sm-4 col-md-4 col-lg-4">
		      			<a href="javascript:void(0);" id="btn_prev_connect_utilities" class="btn">Previous</a>
		      			<a href="javascript:void(0);" id="btn_next_connect_utilities" class="btn">Next</a>
		      		</div>
		      	</div>
	      	</div>
	      	<!-- <div class="modal-footer">
	        	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      	</div> -->
	    </div>
  	</div>
</div>
<!-- Connect Utilities Modal End -->

<!-- Home Cleaning Services Modal -->
<div id="home_cleaning_services_modal" class="modal fade">
    <div class="modal-dialog modal-lg">
    <!-- Modal content-->
	    <div class="modal-content">
	    	<div class="modal-body">
	      		<div class="close close-btn close_modal" data-activity="home_cleaning_services" data-dismiss="modal"><img src="{{ url('/images/movers/close-img.png') }}" alt=""></div>
		      	<h2>Home Cleaning Services</h2>

		      	<div class="row">
		      		<div class="col-sm-3 col-md-3 col-lg-3">
	      				<div>
      						<img src="{{ url('/images/canada_post_logo.jpg') }}" alt="Udistro" />
      					</div>
      					<div>&nbsp;</div>
		      		</div>

		      		<div class="col-sm-9 col-md-9 col-lg-9" id="home_cleaning_services_step1">
		      			<div>
      						<strong>Moving to a new neighborhood, and you need someone to clean your old apartment, or new house before you move in. Anything you need do on home cleaning service service starts here</strong>
      					</div>
      					<br>
      					<div>
      						<form name="frm_home_cleaning_services" id="frm_home_cleaning_services">
						        <div class="panel-group" id="accordion">
						            <div class="panel panel-default">
						                <div class="panel-heading">
						                    <h4 class="panel-title">
						                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Indicate type of cleaning</a>
						                    </h4>
						                </div>
						                <div id="collapseOne" class="panel-collapse collapse in">
						                    <div class="panel-body">
						                        <div><label><input type="checkbox" name=""> Move in cleaning</label></div>
						                        <div><label><input type="checkbox" name=""> Move out cleaning</label></div>
						                    </div>
						                </div>
						            </div>
						            <div class="panel panel-default">
						                <div class="panel-heading">
						                    <h4 class="panel-title">
						                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">Moving From</a>
						                    </h4>
						                </div>
						                <div id="collapseTwo" class="panel-collapse collapse">
						                    <div class="panel-body">
						                        <div class="form-group">
						                        	<label>Type</label>
						                        	<select class="form-control">
						                        		<option value="House">House</option>
						                        		<option value="Apartment/Flat">Apartment/Flat</option>
						                        		<option value="Condo">Condo</option>
						                        		<option value="Studio">Studio</option>
						                        	</select>
						                        </div>
						                        <div class="form-group">
						                        	<label>No of bedrooms</label>
						                        	<label class="form-group"><input type="radio" name="">1</label>
						                        	<label class="form-group"><input type="radio" name="">2</label>
						                        	<label class="form-group"><input type="radio" name="">3</label>
						                        	<label class="form-group"><input type="radio" name="">4 or more</label>
						                        </div>
						                        <div class="form-group">
						                        	<label>Did you own or rent this property</label>
						                        	<label class="form-group"><input type="radio" name="">Own</label>
						                        	<label class="form-group"><input type="radio" name="">Rent</label>
						                        </div>
						                    </div>
						                </div>
						            </div>
						            <div class="panel panel-default">
						                <div class="panel-heading">
						                    <h4 class="panel-title">
						                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">Moving To</a>
						                    </h4>
						                </div>
						                <div id="collapseThree" class="panel-collapse collapse">
						                    <div class="panel-body">
						                        <div class="form-group">
						                        	<label>Type</label>
						                        	<select class="form-control">
						                        		<option value="House">House</option>
						                        		<option value="Apartment/Flat">Apartment/Flat</option>
						                        		<option value="Condo">Condo</option>
						                        		<option value="Studio">Studio</option>
						                        	</select>
						                        </div>
						                        <div class="form-group">
						                        	<label>No of bedrooms</label>
						                        	<label class="form-group"><input type="radio" name="">1</label>
						                        	<label class="form-group"><input type="radio" name="">2</label>
						                        	<label class="form-group"><input type="radio" name="">3</label>
						                        	<label class="form-group"><input type="radio" name="">4 or more</label>
						                        </div>
						                        <div class="form-group">
						                        	<label>Did you own or rent this property</label>
						                        	<label class="form-group"><input type="radio" name="">Own</label>
						                        	<label class="form-group"><input type="radio" name="">Rent</label>
						                        </div>
						                    </div>
						                </div>
						            </div>
						            <div class="panel panel-default">
						                <div class="panel-heading">
						                    <h4 class="panel-title">
						                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour">Detailed Job Description</a>
						                    </h4>
						                </div>
						                <div id="collapseFour" class="panel-collapse collapse">
						                    <div class="panel-body">
						                        <div class="form-group">
						                        	<label>Home Condition</label>
						                        	<label class="form-group"><input type="radio" name="">Dirty</label>
						                        	<label class="form-group"><input type="radio" name="">Clean</label>
						                        	<label class="form-group"><input type="radio" name="">Average</label>
						                        	<label class="form-group"><input type="radio" name="">Poor</label>
						                        </div>
						                        <div class="form-group">
						                        	<label>How many levels do you have</label>
						                        	<label class="form-group"><input type="radio" name="">1</label>
						                        	<label class="form-group"><input type="radio" name="">2</label>
						                        	<label class="form-group"><input type="radio" name="">3</label>
						                        	<label class="form-group"><input type="radio" name="">4 or more</label>
						                        </div>
						                        <div class="form-group">
						                        	<label>Size of area you want to clean</label>
						                        	<label class="form-group"><input type="radio" name="">0-600 sqft</label>
						                        	<label class="form-group"><input type="radio" name="">600-1500 sqft</label>
						                        	<label class="form-group"><input type="radio" name="">1500-2500 sqft</label>
						                        	<label class="form-group"><input type="radio" name="">above 2500 sqft</label>
						                        </div>
						                        <div class="form-group">
						                        	<label>How many peoples live in the house</label>
						                        	<label class="form-group"><input type="radio" name="">1</label>
						                        	<label class="form-group"><input type="radio" name="">2</label>
						                        	<label class="form-group"><input type="radio" name="">3</label>
						                        	<label class="form-group"><input type="radio" name="">4 or more</label>
						                        </div>
						                        <div class="form-group">
						                        	<label>How many pets live in the house</label>
						                        	<label class="form-group"><input type="radio" name="">1</label>
						                        	<label class="form-group"><input type="radio" name="">2</label>
						                        	<label class="form-group"><input type="radio" name="">3</label>
						                        	<label class="form-group"><input type="radio" name="">4 or more</label>
						                        </div>
						                        <div class="form-group">
						                        	<label>How many bathrooms</label>
						                        	<label class="form-group"><input type="radio" name="">1</label>
						                        	<label class="form-group"><input type="radio" name="">2</label>
						                        	<label class="form-group"><input type="radio" name="">3</label>
						                        	<label class="form-group"><input type="radio" name="">4 or more</label>
						                        </div>
						                        <div class="form-group">
						                        	<label>Streaming Carpet Cleaning</label>
						                        	<label class="form-group"><input type="checkbox" name="">Rooms</label>
						                        	<label class="form-group"><input type="checkbox" name="">Stair Case</label>
						                        	<label class="form-group"><input type="checkbox" name="">Hall Way</label>
						                        	<label class="form-group"><input type="checkbox" name="">Living Room</label>
						                        </div>
						                        <div class="form-group">
						                        	<label>Other place to clean</label>
						                        	<label class="form-group"><input type="checkbox" name="">Kitchen</label>
						                        	<label class="form-group"><input type="checkbox" name="">Living Room</label>
						                        	<label class="form-group"><input type="checkbox" name="">Dinning Room</label>
						                        	<label class="form-group"><input type="checkbox" name="">Stair Case</label>
						                        	<label class="form-group"><input type="checkbox" name="">Office Room</label>
						                        	<label class="form-group"><input type="checkbox" name="">Half Way</label>
						                        	<label class="form-group"><input type="checkbox" name="">Interior</label>
						                        	<label class="form-group"><input type="checkbox" name="">Staircase</label>
						                        	<label class="form-group"><input type="checkbox" name="">Recreation Room</label>
						                        	<label class="form-group"><input type="checkbox" name="">Den</label>
						                        	<label class="form-group"><input type="checkbox" name="">Laundry</label>
						                        </div>
						                    </div>
						                </div>
						            </div>
						            <div class="panel panel-default">
						                <div class="panel-heading">
						                    <h4 class="panel-title">
						                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseFive">Additional Services</a>
						                    </h4>
						                </div>
						                <div id="collapseFive" class="panel-collapse collapse">
						                    <div class="panel-body">
						                        <div class="form-group">
						                        	<label>Oven inside cleaned</label>
						                        </div>
						                        <div class="form-group">
						                        	<label>Fridge inside cleaned</label>
						                        </div>
						                        <div class="form-group">
						                        	<label>How many balconies would you like to have swept</label>
						                        </div>
						                        <div class="form-group">
						                        	<label>How many windows(interior) would you like to have washed</label>
						                        </div>
						                        <div class="form-group">
						                        	<label>How many windows(exterior) would you like to have washed</label>
						                        </div>
						                        <div class="form-group">
						                        	<label>Would you like wet wiping blinds? How many?</label>
						                        </div>
						                        <div class="form-group">
						                        	<label>Cleaning behind the refrigrator and stove</label>
						                        </div>
						                        <div class="form-group">
						                        	<label>Would you like baseboard to be washed</label>
						                        </div>
						                        <div class="form-group">
						                        	<label>Clean Fireplace</label>
						                        </div>
						                    </div>
						                </div>
						            </div>
						            <div class="panel panel-default">
						                <div class="panel-heading">
						                    <h4 class="panel-title">
						                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseSix">Call Me On</a>
						                    </h4>
						                </div>
						                <div id="collapseSix" class="panel-collapse collapse">
						                    <div class="panel-body">
						                        <div class="form-group">
						                        	<input type="" name="" placeholder="Contact Number" class="form-control">
						                        	<button type="button" class="btn">+</button>
						                        </div>
						                    </div>
						                </div>
						            </div>
						            <div class="panel panel-default">
						                <div class="panel-heading">
						                    <h4 class="panel-title">
						                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseSeven">Additional Information (If Any)</a>
						                    </h4>
						                </div>
						                <div id="collapseSeven" class="panel-collapse collapse">
						                    <div class="panel-body">
						                        <textarea class="form-control">
						                        	
						                        </textarea>
						                    </div>
						                </div>
						            </div>
						        </div>

						        <div>
						        	<button type="button" class="btn btn-info">Submit</button>
						        </div>
						    </form>
      					</div>
		      		</div>

		      		<div class="col-sm-9 col-md-9 col-lg-9" id="home_cleaning_services_step2" style="height: 300px; display: none;">
		      			<strong>Have you completed this task?</strong>
		      			<br>
		      			<div class="col-sm-6 col-md-6 col-lg-6">
		      				<button type="button" class="btn btn-primary home_cleaning_services_user_response" id="1">Yes</button>
		      			</div>
		      			<div class="col-sm-6 col-md-6 col-lg-6">
		      				<button type="button" class="btn btn-primary home_cleaning_services_user_response" id="0">No</button>
		      			</div>
		      		</div>
		      	</div>
		      	
		      	<div class="row">
		      		<div class="col-sm-8 col-md-8 col-lg-8">&nbsp;</div>
		      		<div class="col-sm-4 col-md-4 col-lg-4">
		      			<a href="javascript:void(0);" id="btn_prev_home_cleaning_services" class="btn">Previous</a>
		      			<a href="javascript:void(0);" id="btn_next_home_cleaning_services" class="btn">Next</a>
		      		</div>
		      	</div>
	      	</div>
	      	<!-- <div class="modal-footer">
	        	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      	</div> -->
	    </div>
  	</div>
</div>
<!-- Home Cleaning Services Modal End -->

<!-- Moving Companies Modal -->
<div id="moving_companies_modal" class="modal fade">
    <div class="modal-dialog modal-lg">
    <!-- Modal content-->
	    <div class="modal-content">
	    	<div class="modal-body">
	      		<div class="close close-btn close_modal" data-activity="moving_companies" data-dismiss="modal"><img src="{{ url('/images/movers/close-img.png') }}" alt=""></div>
		      	<h2>Home Cleaning Services</h2>

		      	<div class="row">
		      		<div class="col-sm-3 col-md-3 col-lg-3">
	      				<div>
      						<img src="{{ url('/images/canada_post_logo.jpg') }}" alt="Udistro" />
      					</div>
      					<div>&nbsp;</div>
		      		</div>

		      		<div class="col-sm-9 col-md-9 col-lg-9" id="moving_companies_step1">
		      			<div>
      						<strong>Moving to a new neighborhood, and you need someone to clean your old apartment, or new house before you move in. Anything you need do on home cleaning service service starts here</strong>
      					</div>
      					<br>
      					<div>
      						<form name="frm_home_moving_companies" id="frm_home_moving_companies">
						        <div class="panel-group" id="accordion">
						            <div class="panel panel-default">
						                <div class="panel-heading">
						                    <h4 class="panel-title">
						                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Indicate type of cleaning</a>
						                    </h4>
						                </div>
						                <div id="collapseOne" class="panel-collapse collapse in">
						                    <div class="panel-body">
						                        <div><label><input type="checkbox" name=""> Move in cleaning</label></div>
						                        <div><label><input type="checkbox" name=""> Move out cleaning</label></div>
						                    </div>
						                </div>
						            </div>
						            <div class="panel panel-default">
						                <div class="panel-heading">
						                    <h4 class="panel-title">
						                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">Moving From</a>
						                    </h4>
						                </div>
						                <div id="collapseTwo" class="panel-collapse collapse">
						                    <div class="panel-body">
						                        <div class="form-group">
						                        	<label>Type</label>
						                        	<select class="form-control">
						                        		<option value="House">House</option>
						                        		<option value="Apartment/Flat">Apartment/Flat</option>
						                        		<option value="Condo">Condo</option>
						                        		<option value="Studio">Studio</option>
						                        	</select>
						                        </div>
						                        <div class="form-group">
						                        	<label>No of bedrooms</label>
						                        	<label class="form-group"><input type="radio" name="">1</label>
						                        	<label class="form-group"><input type="radio" name="">2</label>
						                        	<label class="form-group"><input type="radio" name="">3</label>
						                        	<label class="form-group"><input type="radio" name="">4 or more</label>
						                        </div>
						                        <div class="form-group">
						                        	<label>Did you own or rent this property</label>
						                        	<label class="form-group"><input type="radio" name="">Own</label>
						                        	<label class="form-group"><input type="radio" name="">Rent</label>
						                        </div>
						                    </div>
						                </div>
						            </div>
						            <div class="panel panel-default">
						                <div class="panel-heading">
						                    <h4 class="panel-title">
						                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">Moving To</a>
						                    </h4>
						                </div>
						                <div id="collapseThree" class="panel-collapse collapse">
						                    <div class="panel-body">
						                        <div class="form-group">
						                        	<label>Type</label>
						                        	<select class="form-control">
						                        		<option value="House">House</option>
						                        		<option value="Apartment/Flat">Apartment/Flat</option>
						                        		<option value="Condo">Condo</option>
						                        		<option value="Studio">Studio</option>
						                        	</select>
						                        </div>
						                        <div class="form-group">
						                        	<label>No of bedrooms</label>
						                        	<label class="form-group"><input type="radio" name="">1</label>
						                        	<label class="form-group"><input type="radio" name="">2</label>
						                        	<label class="form-group"><input type="radio" name="">3</label>
						                        	<label class="form-group"><input type="radio" name="">4 or more</label>
						                        </div>
						                        <div class="form-group">
						                        	<label>Did you own or rent this property</label>
						                        	<label class="form-group"><input type="radio" name="">Own</label>
						                        	<label class="form-group"><input type="radio" name="">Rent</label>
						                        </div>
						                    </div>
						                </div>
						            </div>
						            <div class="panel panel-default">
						                <div class="panel-heading">
						                    <h4 class="panel-title">
						                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour">Detailed Job Description</a>
						                    </h4>
						                </div>
						                <div id="collapseFour" class="panel-collapse collapse">
						                    <div class="panel-body">
						                        <div class="form-group">
						                        	<label>Home Condition</label>
						                        	<label class="form-group"><input type="radio" name="">Dirty</label>
						                        	<label class="form-group"><input type="radio" name="">Clean</label>
						                        	<label class="form-group"><input type="radio" name="">Average</label>
						                        	<label class="form-group"><input type="radio" name="">Poor</label>
						                        </div>
						                        <div class="form-group">
						                        	<label>How many levels do you have</label>
						                        	<label class="form-group"><input type="radio" name="">1</label>
						                        	<label class="form-group"><input type="radio" name="">2</label>
						                        	<label class="form-group"><input type="radio" name="">3</label>
						                        	<label class="form-group"><input type="radio" name="">4 or more</label>
						                        </div>
						                        <div class="form-group">
						                        	<label>Size of area you want to clean</label>
						                        	<label class="form-group"><input type="radio" name="">0-600 sqft</label>
						                        	<label class="form-group"><input type="radio" name="">600-1500 sqft</label>
						                        	<label class="form-group"><input type="radio" name="">1500-2500 sqft</label>
						                        	<label class="form-group"><input type="radio" name="">above 2500 sqft</label>
						                        </div>
						                        <div class="form-group">
						                        	<label>How many peoples live in the house</label>
						                        	<label class="form-group"><input type="radio" name="">1</label>
						                        	<label class="form-group"><input type="radio" name="">2</label>
						                        	<label class="form-group"><input type="radio" name="">3</label>
						                        	<label class="form-group"><input type="radio" name="">4 or more</label>
						                        </div>
						                        <div class="form-group">
						                        	<label>How many pets live in the house</label>
						                        	<label class="form-group"><input type="radio" name="">1</label>
						                        	<label class="form-group"><input type="radio" name="">2</label>
						                        	<label class="form-group"><input type="radio" name="">3</label>
						                        	<label class="form-group"><input type="radio" name="">4 or more</label>
						                        </div>
						                        <div class="form-group">
						                        	<label>How many bathrooms</label>
						                        	<label class="form-group"><input type="radio" name="">1</label>
						                        	<label class="form-group"><input type="radio" name="">2</label>
						                        	<label class="form-group"><input type="radio" name="">3</label>
						                        	<label class="form-group"><input type="radio" name="">4 or more</label>
						                        </div>
						                        <div class="form-group">
						                        	<label>Streaming Carpet Cleaning</label>
						                        	<label class="form-group"><input type="checkbox" name="">Rooms</label>
						                        	<label class="form-group"><input type="checkbox" name="">Stair Case</label>
						                        	<label class="form-group"><input type="checkbox" name="">Hall Way</label>
						                        	<label class="form-group"><input type="checkbox" name="">Living Room</label>
						                        </div>
						                        <div class="form-group">
						                        	<label>Other place to clean</label>
						                        	<label class="form-group"><input type="checkbox" name="">Kitchen</label>
						                        	<label class="form-group"><input type="checkbox" name="">Living Room</label>
						                        	<label class="form-group"><input type="checkbox" name="">Dinning Room</label>
						                        	<label class="form-group"><input type="checkbox" name="">Stair Case</label>
						                        	<label class="form-group"><input type="checkbox" name="">Office Room</label>
						                        	<label class="form-group"><input type="checkbox" name="">Half Way</label>
						                        	<label class="form-group"><input type="checkbox" name="">Interior</label>
						                        	<label class="form-group"><input type="checkbox" name="">Staircase</label>
						                        	<label class="form-group"><input type="checkbox" name="">Recreation Room</label>
						                        	<label class="form-group"><input type="checkbox" name="">Den</label>
						                        	<label class="form-group"><input type="checkbox" name="">Laundry</label>
						                        </div>
						                    </div>
						                </div>
						            </div>
						            <div class="panel panel-default">
						                <div class="panel-heading">
						                    <h4 class="panel-title">
						                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseFive">Additional Services</a>
						                    </h4>
						                </div>
						                <div id="collapseFive" class="panel-collapse collapse">
						                    <div class="panel-body">
						                        <div class="form-group">
						                        	<label>Oven inside cleaned</label>
						                        </div>
						                        <div class="form-group">
						                        	<label>Fridge inside cleaned</label>
						                        </div>
						                        <div class="form-group">
						                        	<label>How many balconies would you like to have swept</label>
						                        </div>
						                        <div class="form-group">
						                        	<label>How many windows(interior) would you like to have washed</label>
						                        </div>
						                        <div class="form-group">
						                        	<label>How many windows(exterior) would you like to have washed</label>
						                        </div>
						                        <div class="form-group">
						                        	<label>Would you like wet wiping blinds? How many?</label>
						                        </div>
						                        <div class="form-group">
						                        	<label>Cleaning behind the refrigrator and stove</label>
						                        </div>
						                        <div class="form-group">
						                        	<label>Would you like baseboard to be washed</label>
						                        </div>
						                        <div class="form-group">
						                        	<label>Clean Fireplace</label>
						                        </div>
						                    </div>
						                </div>
						            </div>
						            <div class="panel panel-default">
						                <div class="panel-heading">
						                    <h4 class="panel-title">
						                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseSix">Call Me On</a>
						                    </h4>
						                </div>
						                <div id="collapseSix" class="panel-collapse collapse">
						                    <div class="panel-body">
						                        <div class="form-group">
						                        	<input type="" name="" placeholder="Contact Number" class="form-control">
						                        	<button type="button" class="btn">+</button>
						                        </div>
						                    </div>
						                </div>
						            </div>
						            <div class="panel panel-default">
						                <div class="panel-heading">
						                    <h4 class="panel-title">
						                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseSeven">Additional Information (If Any)</a>
						                    </h4>
						                </div>
						                <div id="collapseSeven" class="panel-collapse collapse">
						                    <div class="panel-body">
						                        <textarea class="form-control">
						                        	
						                        </textarea>
						                    </div>
						                </div>
						            </div>
						        </div>

						        <div>
						        	<button type="button" class="btn btn-info">Submit</button>
						        </div>
						    </form>
      					</div>
		      		</div>

		      		<div class="col-sm-9 col-md-9 col-lg-9" id="moving_companies_step2" style="height: 300px; display: none;">
		      			<strong>Have you completed this task?</strong>
		      			<br>
		      			<div class="col-sm-6 col-md-6 col-lg-6">
		      				<button type="button" class="btn btn-primary moving_companies_user_response" id="1">Yes</button>
		      			</div>
		      			<div class="col-sm-6 col-md-6 col-lg-6">
		      				<button type="button" class="btn btn-primary moving_companies_user_response" id="0">No</button>
		      			</div>
		      		</div>

		      	</div>
		      	
		      	<div class="row">
		      		<div class="col-sm-8 col-md-8 col-lg-8">&nbsp;</div>
		      		<div class="col-sm-4 col-md-4 col-lg-4">
		      			<a href="javascript:void(0);" id="btn_prev_home_moving_companies" class="btn">Previous</a>
		      			<a href="javascript:void(0);" id="btn_next_home_moving_companies" class="btn">Next</a>
		      		</div>
		      	</div>
	      	</div>
	      	<!-- <div class="modal-footer">
	        	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      	</div> -->
	    </div>
  	</div>
</div>
<!-- Moving Companies Modal End -->

<!-- Tech Concierge Modal -->
<div id="tech_concierge_modal" class="modal fade">
    <div class="modal-dialog modal-lg">
    <!-- Modal content-->
	    <div class="modal-content">
	    	<div class="modal-body">
	      		<div class="close close-btn close_modal" data-activity="tech_concierge" data-dismiss="modal"><img src="{{ url('/images/movers/close-img.png') }}" alt=""></div>
		      	<h2>Home Cleaning Services</h2>

		      	<div class="row">
		      		<div class="col-sm-3 col-md-3 col-lg-3">
	      				<div>
      						<img src="{{ url('/images/canada_post_logo.jpg') }}" alt="Udistro" />
      					</div>
      					<div>&nbsp;</div>
		      		</div>

		      		<div class="col-sm-9 col-md-9 col-lg-9" id="tech_concierge_step1">
		      			<div>
      						<strong>Moving to a new neighborhood, and you need someone to clean your old apartment, or new house before you move in. Anything you need do on home cleaning service service starts here</strong>
      					</div>
      					<br>
      					<div>
      						<form name="frm_home_moving_companies" id="frm_home_moving_companies">
						        <div class="panel-group" id="accordion">
						            <div class="panel panel-default">
						                <div class="panel-heading">
						                    <h4 class="panel-title">
						                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Indicate type of cleaning</a>
						                    </h4>
						                </div>
						                <div id="collapseOne" class="panel-collapse collapse in">
						                    <div class="panel-body">
						                        <div><label><input type="checkbox" name=""> Move in cleaning</label></div>
						                        <div><label><input type="checkbox" name=""> Move out cleaning</label></div>
						                    </div>
						                </div>
						            </div>
						            <div class="panel panel-default">
						                <div class="panel-heading">
						                    <h4 class="panel-title">
						                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">Moving From</a>
						                    </h4>
						                </div>
						                <div id="collapseTwo" class="panel-collapse collapse">
						                    <div class="panel-body">
						                        <div class="form-group">
						                        	<label>Type</label>
						                        	<select class="form-control">
						                        		<option value="House">House</option>
						                        		<option value="Apartment/Flat">Apartment/Flat</option>
						                        		<option value="Condo">Condo</option>
						                        		<option value="Studio">Studio</option>
						                        	</select>
						                        </div>
						                        <div class="form-group">
						                        	<label>No of bedrooms</label>
						                        	<label class="form-group"><input type="radio" name="">1</label>
						                        	<label class="form-group"><input type="radio" name="">2</label>
						                        	<label class="form-group"><input type="radio" name="">3</label>
						                        	<label class="form-group"><input type="radio" name="">4 or more</label>
						                        </div>
						                        <div class="form-group">
						                        	<label>Did you own or rent this property</label>
						                        	<label class="form-group"><input type="radio" name="">Own</label>
						                        	<label class="form-group"><input type="radio" name="">Rent</label>
						                        </div>
						                    </div>
						                </div>
						            </div>
						            <div class="panel panel-default">
						                <div class="panel-heading">
						                    <h4 class="panel-title">
						                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">Moving To</a>
						                    </h4>
						                </div>
						                <div id="collapseThree" class="panel-collapse collapse">
						                    <div class="panel-body">
						                        <div class="form-group">
						                        	<label>Type</label>
						                        	<select class="form-control">
						                        		<option value="House">House</option>
						                        		<option value="Apartment/Flat">Apartment/Flat</option>
						                        		<option value="Condo">Condo</option>
						                        		<option value="Studio">Studio</option>
						                        	</select>
						                        </div>
						                        <div class="form-group">
						                        	<label>No of bedrooms</label>
						                        	<label class="form-group"><input type="radio" name="">1</label>
						                        	<label class="form-group"><input type="radio" name="">2</label>
						                        	<label class="form-group"><input type="radio" name="">3</label>
						                        	<label class="form-group"><input type="radio" name="">4 or more</label>
						                        </div>
						                        <div class="form-group">
						                        	<label>Did you own or rent this property</label>
						                        	<label class="form-group"><input type="radio" name="">Own</label>
						                        	<label class="form-group"><input type="radio" name="">Rent</label>
						                        </div>
						                    </div>
						                </div>
						            </div>
						            <div class="panel panel-default">
						                <div class="panel-heading">
						                    <h4 class="panel-title">
						                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour">Detailed Job Description</a>
						                    </h4>
						                </div>
						                <div id="collapseFour" class="panel-collapse collapse">
						                    <div class="panel-body">
						                        <div class="form-group">
						                        	<label>Home Condition</label>
						                        	<label class="form-group"><input type="radio" name="">Dirty</label>
						                        	<label class="form-group"><input type="radio" name="">Clean</label>
						                        	<label class="form-group"><input type="radio" name="">Average</label>
						                        	<label class="form-group"><input type="radio" name="">Poor</label>
						                        </div>
						                        <div class="form-group">
						                        	<label>How many levels do you have</label>
						                        	<label class="form-group"><input type="radio" name="">1</label>
						                        	<label class="form-group"><input type="radio" name="">2</label>
						                        	<label class="form-group"><input type="radio" name="">3</label>
						                        	<label class="form-group"><input type="radio" name="">4 or more</label>
						                        </div>
						                        <div class="form-group">
						                        	<label>Size of area you want to clean</label>
						                        	<label class="form-group"><input type="radio" name="">0-600 sqft</label>
						                        	<label class="form-group"><input type="radio" name="">600-1500 sqft</label>
						                        	<label class="form-group"><input type="radio" name="">1500-2500 sqft</label>
						                        	<label class="form-group"><input type="radio" name="">above 2500 sqft</label>
						                        </div>
						                        <div class="form-group">
						                        	<label>How many peoples live in the house</label>
						                        	<label class="form-group"><input type="radio" name="">1</label>
						                        	<label class="form-group"><input type="radio" name="">2</label>
						                        	<label class="form-group"><input type="radio" name="">3</label>
						                        	<label class="form-group"><input type="radio" name="">4 or more</label>
						                        </div>
						                        <div class="form-group">
						                        	<label>How many pets live in the house</label>
						                        	<label class="form-group"><input type="radio" name="">1</label>
						                        	<label class="form-group"><input type="radio" name="">2</label>
						                        	<label class="form-group"><input type="radio" name="">3</label>
						                        	<label class="form-group"><input type="radio" name="">4 or more</label>
						                        </div>
						                        <div class="form-group">
						                        	<label>How many bathrooms</label>
						                        	<label class="form-group"><input type="radio" name="">1</label>
						                        	<label class="form-group"><input type="radio" name="">2</label>
						                        	<label class="form-group"><input type="radio" name="">3</label>
						                        	<label class="form-group"><input type="radio" name="">4 or more</label>
						                        </div>
						                        <div class="form-group">
						                        	<label>Streaming Carpet Cleaning</label>
						                        	<label class="form-group"><input type="checkbox" name="">Rooms</label>
						                        	<label class="form-group"><input type="checkbox" name="">Stair Case</label>
						                        	<label class="form-group"><input type="checkbox" name="">Hall Way</label>
						                        	<label class="form-group"><input type="checkbox" name="">Living Room</label>
						                        </div>
						                        <div class="form-group">
						                        	<label>Other place to clean</label>
						                        	<label class="form-group"><input type="checkbox" name="">Kitchen</label>
						                        	<label class="form-group"><input type="checkbox" name="">Living Room</label>
						                        	<label class="form-group"><input type="checkbox" name="">Dinning Room</label>
						                        	<label class="form-group"><input type="checkbox" name="">Stair Case</label>
						                        	<label class="form-group"><input type="checkbox" name="">Office Room</label>
						                        	<label class="form-group"><input type="checkbox" name="">Half Way</label>
						                        	<label class="form-group"><input type="checkbox" name="">Interior</label>
						                        	<label class="form-group"><input type="checkbox" name="">Staircase</label>
						                        	<label class="form-group"><input type="checkbox" name="">Recreation Room</label>
						                        	<label class="form-group"><input type="checkbox" name="">Den</label>
						                        	<label class="form-group"><input type="checkbox" name="">Laundry</label>
						                        </div>
						                    </div>
						                </div>
						            </div>
						            <div class="panel panel-default">
						                <div class="panel-heading">
						                    <h4 class="panel-title">
						                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseFive">Additional Services</a>
						                    </h4>
						                </div>
						                <div id="collapseFive" class="panel-collapse collapse">
						                    <div class="panel-body">
						                        <div class="form-group">
						                        	<label>Oven inside cleaned</label>
						                        </div>
						                        <div class="form-group">
						                        	<label>Fridge inside cleaned</label>
						                        </div>
						                        <div class="form-group">
						                        	<label>How many balconies would you like to have swept</label>
						                        </div>
						                        <div class="form-group">
						                        	<label>How many windows(interior) would you like to have washed</label>
						                        </div>
						                        <div class="form-group">
						                        	<label>How many windows(exterior) would you like to have washed</label>
						                        </div>
						                        <div class="form-group">
						                        	<label>Would you like wet wiping blinds? How many?</label>
						                        </div>
						                        <div class="form-group">
						                        	<label>Cleaning behind the refrigrator and stove</label>
						                        </div>
						                        <div class="form-group">
						                        	<label>Would you like baseboard to be washed</label>
						                        </div>
						                        <div class="form-group">
						                        	<label>Clean Fireplace</label>
						                        </div>
						                    </div>
						                </div>
						            </div>
						            <div class="panel panel-default">
						                <div class="panel-heading">
						                    <h4 class="panel-title">
						                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseSix">Call Me On</a>
						                    </h4>
						                </div>
						                <div id="collapseSix" class="panel-collapse collapse">
						                    <div class="panel-body">
						                        <div class="form-group">
						                        	<input type="" name="" placeholder="Contact Number" class="form-control">
						                        	<button type="button" class="btn">+</button>
						                        </div>
						                    </div>
						                </div>
						            </div>
						            <div class="panel panel-default">
						                <div class="panel-heading">
						                    <h4 class="panel-title">
						                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseSeven">Additional Information (If Any)</a>
						                    </h4>
						                </div>
						                <div id="collapseSeven" class="panel-collapse collapse">
						                    <div class="panel-body">
						                        <textarea class="form-control">
						                        	
						                        </textarea>
						                    </div>
						                </div>
						            </div>
						        </div>

						        <div>
						        	<button type="button" class="btn btn-info">Submit</button>
						        </div>
						    </form>
      					</div>
		      		</div>

		      		<div class="col-sm-9 col-md-9 col-lg-9" id="tech_concierge_step2" style="height: 300px; display: none;">
		      			<strong>Have you completed this task?</strong>
		      			<br>
		      			<div class="col-sm-6 col-md-6 col-lg-6">
		      				<button type="button" class="btn btn-primary tech_concierge_user_response" id="1">Yes</button>
		      			</div>
		      			<div class="col-sm-6 col-md-6 col-lg-6">
		      				<button type="button" class="btn btn-primary tech_concierge_user_response" id="0">No</button>
		      			</div>
		      		</div>

		      	</div>
		      	
		      	<div class="row">
		      		<div class="col-sm-8 col-md-8 col-lg-8">&nbsp;</div>
		      		<div class="col-sm-4 col-md-4 col-lg-4">
		      			<a href="javascript:void(0);" id="btn_prev_tech_concierge" class="btn">Previous</a>
		      			<a href="javascript:void(0);" id="btn_next_tech_concierge" class="btn">Next</a>
		      		</div>
		      	</div>
	      	</div>
	      	<!-- <div class="modal-footer">
	        	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      	</div> -->
	    </div>
  	</div>
</div>
<!-- Tech Concierge Modal End -->

<!-- Share Announcement Modal -->
<div id="share_announcement_modal" class="modal fade">
    <div class="modal-dialog modal-lg">
    <!-- Modal content-->
	    <div class="modal-content">
	    	<div class="modal-body">
	      		<div class="close close-btn close_modal" data-activity="share_announcement" data-dismiss="modal"><img src="{{ url('/images/movers/close-img.png') }}" alt=""></div>
		      	
		      	<div class="row">
		      		<div class="col-sm-4 col-md-4 col-lg-4">
		      			<img src="{{ url('/images/house_sold.png') }}" height="200" width="250" alt="udistro">
		      		</div>
		      		<div class="col-sm-8 col-md-8 col-lg-8">
		      			<div>
		      				<strong>The {{ ucwords( strtolower( $clientName ) ) }} are moving!</strong>
		      			</div>
		      			<br>
		      			<div>
		      				<p><strong>Hi friends</strong> we are moving from South to North.</p>
		      				<p>Stop by Saturday night for a housewarming party!</p>
		      				<p>With love from</p>
		      				<p><strong>{{ ucwords( strtolower( $clientName ) ) }}</strong></p>
		      			</div>
		      		</div>
		      	</div>

		      	<div class="row">
		      		<div class="col-sm-4 col-md-4 col-lg-4">
		      			<div class="">
		      				<h4>Special Thanks to Agent {{ $agentName }}</h4>
		      				<ul class="ratingstar">
		      					<!-- <li><a href="javascript:void(0);"><i class="fa fa-star red" aria-hidden="true"></i></a></li> -->
		      					<li><a href="javascript:void(0);"><i class="fa fa-star assign_agent_rating" aria-hidden="true"></i></a></li>
		      					<li><a href="javascript:void(0);"><i class="fa fa-star assign_agent_rating" aria-hidden="true"></i></a></li>
		      					<li><a href="javascript:void(0);"><i class="fa fa-star assign_agent_rating" aria-hidden="true"></i></a></li>
		      					<li><a href="javascript:void(0);"><i class="fa fa-star assign_agent_rating" aria-hidden="true"></i></a></li>
		      					<li><a href="javascript:void(0);"><i class="fa fa-star assign_agent_rating" aria-hidden="true"></i></a></li>
		      				</ul>
		      				<span>( {{ $agentRating }} Rating )</span>
		      			</div>
		      		</div>
		      		<div class="col-sm-8 col-md-8 col-lg-8">
		      			<div class="row">
			      			<div class="col-sm-6 col-md-6 col-lg-6">
			      				<img src="{{ ( $companyDetails->image != '' ) ? url('/images/company/' . $companyDetails->image) : url('/images/movers/company_icon.png') }}" height="60px" width="60px" alt="Udistro" />
			      				<div>
			      					{{ ucwords( strtolower( $companyDetails->company_name ) ) }}
			      				</div>
			      				<div>
			      					{{ ucwords( strtolower( $companyDetails->address ) ) }}, {{ $companyProvince->name }}, {{ $companyCity->name }}, {{ $companyDetails->postal_code }}
			      				</div>
			      			</div>
			      			<div class="col-sm-6 col-md-6 col-lg-6">
			      				<img src="{{ ( $agentDetails->image != '' ) ? url('/images/agents/' . $agentDetails->image) : url('/images/movers/user-avtar.png') }}" class="user-avtar" alt="Udistro" height="50px" width="50px">
			      				<div>
			      					{{ $agentName }}
			      				</div>
			      			</div>
			      		</div>
		      		</div>
		      	</div>

		      	<div class="row">
		      		<div class="col-sm-4 col-md-4 col-lg-4">&nbsp;</div>
		      		<div class="col-sm-4 col-md-4 col-lg-4">&nbsp;</div>
		      		<div class="col-sm-4 col-md-4 col-lg-4">
		      			Share this on: 
		      			<i class="fa fa-facebook-square"></i>
		      			<i class="fa fa fa-twitter-square"></i>
		      			<i class="fa fa fa-google-plus-square"></i>
		      			<i class="fa fa fa-linkedin-square"></i>
		      		</div>
		      	</div>

		    </div>
		</div>
	</div>
</div>
<!-- Share Announcement Modal -->

<!-- To handle the modal close event -->
<div id="user_response_modal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Have you completed this task?</h4>
            </div>
            <div class="modal-body">
            	<form name="frm_activity_user_response" id="frm_activity_user_response">
	            	<!-- To hold the activity name generated dynamically -->
	            	<input type="hidden" name="activity_name" id="activity_name" value="">

	                <button type="button" class="btn btn-primary activity_user_response" id="1" data-dismiss="modal">Yes</button>
	                <button type="button" class="btn btn-primary activity_user_response" id="0" data-dismiss="modal">No</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- To handle the modal close event -->

</body>
</html> 