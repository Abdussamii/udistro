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
    var navbar = $('.navbar');
    $(window).scroll(function(){
        if($(window).scrollTop() <= 40){
       		navbar.css('display', 'none');
        } else {
          navbar.css('display', 'block'); 
        }
    });

    // Multi-select Inintialize
    $('.multiselect').multipleSelect({
    	placeholder: 'Select',
        selectAll: false,
        multiple: true,
        width: 880,
        multipleWidth: 280
    });

    // Datepicker intialize
	$('.datepicker').datepicker({
		dateFormat: 'dd-mm-yy'
	});

    // Call the method to calculate the route between two addresses
    calculateRoute('{{ $clientMovingFromAddress->address1 . ' ' . $clientMovingFromProvince->name }}', '{{ $clientMovingToAddress->address1 . ' ' . $clientMovingToProvince->name }}');
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
   <a class="navbar-brand" href="{{ url('/') }}"> <img src="{{ url('/images/logo.png') }}" height="" width="" alt="Udistro" /> 
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
    <div class="user-short-name"> <span>{{ $clientInitials }}</span> </div>
    <button class="btnbg-none" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ ucwords( strtolower( $clientName ) ) }}<span class="caret"></span></button>
    <ul class="dropdown-menu" aria-labelledby="dLabel">
     <li> <a href="javascript:void(0);"> <i class="fa fa-power-off"></i> <span class="text">Logout</span> </a> </li>
    </ul>
   </div>
  </div>
 </div>
</nav>
<!-- End Navbar -->
<!-- Map Section -->
<!-- url('/images/movers/map-bg.jpg') -->
<section class="content-section map-bg" style="background:url('{{ ( $clientMovingToProvince->image != '' ) ? url('/images/province/' . $clientMovingToProvince->image) : url('/images/movers/map-bg.jpg') }}') no-repeat center center;position: relative;display: block; max-width: 100%; background-size:cover; padding: 50px 0; ">
 <div class="container-fluid">
  <div class="row">
   <div class="col-md-4">
    <div class="contry-name">
     <h2>{{ ucwords( strtolower( $clientMovingToProvince->abbreviation ) ) }}</h2>
     <span>{{ ucwords( strtolower( $clientMovingToProvince->name ) ) }}</span> </div>
   </div>
   <div class="col-md-4"> </div>
   <div class="col-md-4"> 
    <!-- Google map here -->
    <div class="map-area" id="map" style="overflow: hidden; border-radius: 0; height: 330px; width: 330px; border: 5px solid #fff;"> </div>
   </div>
  </div>
 </div>
</section>
<!-- Map Section Ends Here--> 


<!-- percentage bar -->

<section class="percentage-section">
	<div class="container">
		<div class="percentage-bar">
		<h2><span id="activity_progress1">{{ $completedActivitiesPercentage }}</span>% Completed</h2>
		<div class="progress">
			<div class="progress-bar" role="progressbar" id="activity_progress_bar" aria-valuenow="{{ $completedActivitiesPercentage }}" aria-valuemin="0" aria-valuemax="100" style="width:{{ $completedActivitiesPercentage }}%">
				<span class="sr-only"><span id="activity_progress2">{{ $completedActivitiesPercentage }}</span>% Complete</span>
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
										<li>
											<a href="javascript:void(0);" title="Get started" id="{{ $activity->id }}" class="{{ $activity->activity_class }} done_activity">
												<?php
												$icon1 = 'fa fa-arrow-circle-o-right';
												$icon2 = 'fa fa-times-circle';
												$completed = '';
												if( count( $completedActivities ) && array_key_exists($activity->id, $completedActivities) )
												{
													if( array_key_exists($activity->id, $completedActivities) && $completedActivities[$activity->id] == 1 )
													{
														$icon1 = 'fa fa-check';
													}
													else
													{
														$icon2 = 'fa fa-check';
													}

													$completed = 1;
												}
												?>
												<i class="{{ $icon1 }}" aria-hidden="true"></i>
											</a>
										</li>
										<li><a href="javascript:void(0);" title="Do it later" class=""><i class="fa fa-history" aria-hidden="true"></i></a></li>
										<li>
											<a href="javascript:void(0);" title="Discard" class="discard_activity" id="{{ $activity->id }}">
												<i class="{{ $icon2 }}" aria-hidden="true"></i>
											</a>
										</li>
										<li>
											<input type="hidden" name="activity_final_status[]" class="activity_final_status" value="{{ $completed }}">
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
						<li><a href="javascript:void(0);"><i class="fa fa-star assign_agent_rating {{ ( isset($agentClientRating->rating) && $agentClientRating->rating > 0 ) ? 'red' : '' }}" aria-hidden="true"></i></a></li>
						<li><a href="javascript:void(0);"><i class="fa fa-star assign_agent_rating {{ ( isset($agentClientRating->rating) && $agentClientRating->rating > 1 ) ? 'red' : '' }}" aria-hidden="true"></i></a></li>
						<li><a href="javascript:void(0);"><i class="fa fa-star assign_agent_rating {{ ( isset($agentClientRating->rating) && $agentClientRating->rating > 2 ) ? 'red' : '' }}" aria-hidden="true"></i></a></li>
						<li><a href="javascript:void(0);"><i class="fa fa-star assign_agent_rating {{ ( isset($agentClientRating->rating) && $agentClientRating->rating > 3 ) ? 'red' : '' }}" aria-hidden="true"></i></a></li>
						<li><a href="javascript:void(0);"><i class="fa fa-star assign_agent_rating {{ ( isset($agentClientRating->rating) && $agentClientRating->rating > 4 ) ? 'red' : '' }}" aria-hidden="true"></i></a></li>
					</ul>
					<span id="agent_average_rating">( {{ $agentRating or 0 }} Rating )</span>
				</div>
			</div>
		</div>
	</div>
	<div class="comment-section">
		<form name="frm_agent_feedback" id="frm_agent_feedback">
			<div class="row">
				<div class="col-md-12">
					<div class="comment-area">
						<h2>Hi {{ $agentName }},</h2>
						<p id="agent_rating_message_container">
							I appreciate you work and want to say thank you.
						</p>
						<textarea name="agent_rating_message" id="agent_rating_message" class="form-control" style="display: none;">Hi {{ $agentName }},I appreciate you work and want to say thank you.</textarea>
						<input type="hidden" name="agent_rating" id="agent_rating" value="">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="user-comment-info">
						<div class="col-md-8">
							<div class="comment-group-left">
								<ul class="comment-group">
									<li>
										<a href="javascript:void(0);" class="agent_helpful" data-status="{{ $agentClientHelpfulCount }}">
											<i class="fa fa-thumbs-up" aria-hidden="true" style="{{ ( $agentClientHelpfulCount == 1 ) ? 'color: green' : '' }}"></i><span class="agent_helpful_count">{{ $agentHelpfulCount }}</span> Helpful
										</a>
									</li>
									<!-- <li><a href="javascript:void(0);"><i class="fa">2</i>Follow</a></li> -->
									<li><a href="javascript:void(0);" id="agent_rating_edit_message"><i class="fa fa-pencil" aria-hidden="true"></i>Edit Message</a></li>
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
						<div class="text-center"><label id="agent_rating-error" class="error" for="agent_rating"></label></div>
						<button type="button" class="btn btn-lg center-block coment-submit-btn" name="btn_agent_feedback" id="btn_agent_feedback">Submit</button>
					</div>
				</div>
			</div>
		</form>
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
<div id="forward_mail_modal" class="modal fade mover-modal" role="dialog">
 <div class="modal-dialog modal-lg"> 
  <!-- Modal content-->
  <div class="modal-content">
   <div class="modal-body">
    <div class="close close-btn close_modal" data-activity="forward_mail" data-dismiss="modal"><img src="{{ url('/images/movers/close-img.png') }}" alt=""></div>
    <div class="model-WrapCont">
     <h2>Mail Forwarding</h2>
    </div>
    <div class="row">
     <div class="col-sm-3 col-md-3 col-lg-3">
      <div> <img src="{{ url('/images/udistro-logo-pop.jpg') }}" alt="Udistro" /> </div>
      <div>&nbsp;</div>
     </div>
     <div class="col-sm-9 col-md-9 col-lg-9 box-H-250" id="forward_mail_step1">
      <div class="row">
       <div class="col-sm-12">
        <p>Canada Post’s Mail Forwarding service ensures all your important mail reaches you at your new address.</p>
       </div>
      </div>
      <div class="clearfix"></div>
      <div class="row">
       <div class="col-sm-12 mailfarwd_wrap_radio">
        <form name="frm_forward_mail" id="frm_forward_mail">
         <label class="mailfarw_radio-lb">
          <input type="radio" name="forward_mail_method" value="1">
          Do it here online</label>
         <label class="mailfarw_radio-lb">
          <input type="radio" name="forward_mail_method" value="2">
          Do it at Canada post office</label>
         <label id="forward_mail_method-error" class="error" for="forward_mail_method"></label>
        </form>
       </div>
      </div>
     </div>
     <div class="col-sm-9 col-md-9 col-lg-9 box-H-250" id="forward_mail_step2" style="display: none;">
      <div class="row">
       <div class="col-sm-12">
        <p> When you buy a Mail Forwarding before you moves, with your permission, Canada Post will share your updated address information with companies who have an existing relationship with you and who are subscribed to Canada post NCOA Mover Data Service. Choose the 12-month service for the most convenience and savings. </p>
       </div>
      </div>
      <div class="get_started_LB"> <a href="javascript:void(0);" onclick="window.open('https://www.canadapost.ca/web/en/products/details.page?article=forward_your_mail_wh', '_blank', 'location=yes,height=800,width=1000,scrollbars=yes,status=yes');">Click here to get started</a> </div>
     </div>
     <div class="col-sm-9 col-md-9 col-lg-9 box-H-250" id="forward_mail_step3" style="display: none;">
      <div class="row">
       <div class="col-sm-12">
        <p>Search Canada post office closest to you</p>
       </div>
      </div>
      <div>
       <form name="frm_forward_mail_search_postoffices" id="frm_forward_mail_search_postoffices">
        <div class="col-sm-9 col-md-9 col-lg-9 row">
         <input type="text" name="forward_mail_search_postoffices_address" id="forward_mail_search_postoffices_address" class="form-control" placeholder="Search for Canada post office">
        </div>
        <div class="col-sm-3 col-md-3 col-lg-3 row"> 
         <!-- <input type="button" name="" id="" class="btn" value="Go"> --> 
         <a href="javascript:void(0);" onclick="" id="forward_mail_search_postoffice">Go</a> </div>
       </form>
      </div>
     </div>
    </div>
    <div class="row" style="display:none;">
     <div class="col-sm-3 col-md-3 col-lg-3">
      <div class="helpful-box">
       <label>Is this helpful to you?</label>
       <a href="javascript:void(0);" id="1" data-activity="forward_mail" class="activity_feedback">Yes</a> <a href="javascript:void(0);" id="0" data-activity="forward_mail" class="activity_feedback">No</a> </div>
     </div>
     <div class="col-sm-9 col-md-9 col-lg-9">
      <div class="row">
       <div class="col-md-4">
        <div class="lightbox-mailfarwd">
         <h3>Peace of mind</h3>
         <p>Ensure you don't miss important email</p>
        </div>
       </div>
       <div class="col-md-4">
        <div class="lightbox-mailfarwd">
         <h3>Security</h3>
         <p>Keep your valuable mail private</p>
        </div>
       </div>
       <div class="col-md-4">
        <div class="lightbox-mailfarwd">
         <h3>Reliability</h3>
         <p>More dependable than neighbours</p>
        </div>
       </div>
      </div>
     </div>
    </div>
    <div class="row">
     <div class="col-sm-8 col-md-8 col-lg-8">&nbsp;</div>
     <div class="col-sm-4 col-md-4 col-lg-4 text-right"> <a href="javascript:void(0);" id="btn_prev_forward_mail" class="btn"><i class="fa fa-angle-double-left" aria-hidden="true"></i> Previous</a> <a href="javascript:void(0);" id="btn_next_forward_mail" class="btn">Next <i class="fa fa-angle-double-right" aria-hidden="true"></i></a> </div>
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
<div id="update_address_modal" class="modal fade mover-modal">
 <div class="modal-dialog modal-lg"> 
  <!-- Modal content-->
  <div class="modal-content">
   <div class="modal-body">
    <div class="close close-btn close_modal" data-activity="update_address" data-dismiss="modal"><img src="{{ url('/images/movers/close-img.png') }}" alt=""></div>
    <div class="row">
     <div class="model-WrapCont" id="update_address_step1"> 
      <!-- HSA 1 -->
      <h2>Update Address</h2>
      <div class="col-sm-3 col-md-3 col-lg-3">
       <div> <img src="{{ url('/images/udistro-logo-pop.jpg') }}" alt="Udistro" /> </div>
       <div>&nbsp;</div>
      </div>
      <div class="col-sm-9 col-md-9 col-lg-9 box-H-250">
       <div class="row">
        <div class="col-sm-12">
         <p>Canada post cannot update your new address with all the organization you are have business with, especially infrequent mails such as, tax documents, driver's license renewals and financial statements</p>
        </div>
        <div class="clearfix"></div>
        <div class="col-sm-12 up_add_li">
         <ul>
          <li><i class="fa fa-check" aria-hidden="true"></i> Federal Agencies</li>
          <li><i class="fa fa-check" aria-hidden="true"></i> Provincial Agencies</li>
          <li><i class="fa fa-check" aria-hidden="true"></i> Other Check-list</li>
         </ul>
        </div>
        <div class="clearfix"></div>
        <div class="col-sm-12">
         <div class="row">
          <form name="frm_update_address" id="frm_update_address">
           <div class="col-md-4">
            <div class="model-box-YN"> <span> Do you have full access to your CRA? </span>
             <label>
              <input type="radio" name="update_address_method1" value="1">
              Yes</label>
             <label>
              <input type="radio" name="update_address_method1" value="2">
              No</label>
            </div>
            <label id="update_address_method1-error" class="error" for="update_address_method1"></label>
           </div>
           <div class="col-md-4">
            <div class="model-box-YN"> <span> Do you have dependent children?</span>
             <label>
              <input type="radio" name="update_address_method2" value="1">
              Yes</label>
             <label>
              <input type="radio" name="update_address_method2" value="2">
              No</label>
            </div>
            <label id="update_address_method2-error" class="error" for="update_address_method2"></label>
           </div>
           <div class="col-md-4">
            <div class="model-box-YN"> <span>Do you receive child benefit?</span>
             <label>
              <input type="radio" name="update_address_method3" value="1">
              Yes</label>
             <label>
              <input type="radio" name="update_address_method3" value="2">
              No</label>
            </div>
            <label id="update_address_method3-error" class="error" for="update_address_method3"></label>
           </div>
          </form>
         </div>
        </div>
       </div>
      </div>
     </div>
     <div class="model-WrapCont" id="update_address_step2" style="display: none;"> 
      <!-- HSA 1 -->
      <h2>Update Address Online</h2>
      <div class="col-sm-3 col-md-3 col-lg-3">
       <div> <img src="{{ url('/images/udistro-logo-pop.jpg') }}" alt="Udistro" /> </div>
       <div>&nbsp;</div>
      </div>
      <div class="col-sm-9 col-md-9 col-lg-9 box-H-250">
       <div class="block-head">
        <h3>Update address with Canada Revenue Agency</h3>
       </div>
       <div>
        <p> Since you have full access to your CRA account, you will be redirected to CRA website and you can do it online by yourself in less than 2 to 3 minutes. Having full access means you have access code giving to you by CRA </p>
        <div class="get_started_LB"> <a href="javascript:void(0);" onclick="window.open('https://www.canada.ca/en/revenue-agency/services/e-services/e-services-individuals/account-individuals.html', '_blank', 'location=yes,height=800,width=1000,scrollbars=yes,status=yes');">Click here to get started</a> </div>
       </div>
      </div>
     </div>
     <div class="model-WrapCont" id="update_address_step3" style="display: none;"> 
      <!-- HSA 1 -->
      <h2>Update Address On Phone</h2>
      <div class="col-sm-3 col-md-3 col-lg-3">
       <div> <img src="{{ url('/images/udistro-logo-pop.jpg') }}" alt="Udistro" /> </div>
       <div>&nbsp;</div>
      </div>
      <div class="col-sm-9 col-md-9 col-lg-9 box-H-250">
       <div class="block-head">
        <h3>Update address with Canada Revenue Agency</h3>
       </div>
       <div class="row">
        <div class="col-sm-12">
         <p>If you don't have full access to your CRA account, here is what you do:</p>
        </div>
        <div class="col-md-12">
         <div class="block-head">
          <h3>Have these handy, before this call </h3>
         </div>
         <div class="up_add_li">
          <ul>
           <li><i class="fa fa-angle-right" aria-hidden="true"></i> Your full name and Contact number</li>
           <li><i class="fa fa-angle-right" aria-hidden="true"></i> Old and new address</li>
           <li><i class="fa fa-angle-right" aria-hidden="true"></i> Old and new postal codes</li>
           <li><i class="fa fa-angle-right" aria-hidden="true"></i> Your SIN number</li>
           <li><i class="fa fa-angle-right" aria-hidden="true"></i> Name and Date Of Birth of children</li>
          </ul>
         </div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-6">
         <div class="block-head">
          <h3> Opening Hours </h3>
         </div>
         <div class="up_add_li">
          <ul>
           <li> <span>Monday to Friday,</span> <i class="fa fa-clock-o" aria-hidden="true"></i>07:00 AM - 11:00 PM ET </li>
           <li> <span>Saturday and Sunday,</span> <i class="fa fa-clock-o" aria-hidden="true"></i>09:00 AM - 09:00 PM ET </li>
          </ul>
         </div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-6">
         <div class="block-head">
          <h3> Phone Numbers </h3>
         </div>
         <div class="up_add_li">
          <ul>
           <li><span>Inside of Canada:</span> <i class="fa fa-phone" aria-hidden="true"></i>1-800-959-8281</li>
           <li><span>Outside of Canada:</span> <i class="fa fa-phone" aria-hidden="true"></i>613-940-8495</li>
          </ul>
         </div>
        </div>
       </div>
      </div>
     </div>
     <div class="model-WrapCont" id="update_address_step4" style="display: none;"> 
      <!-- HSA 1 -->
      <h2>Update Address</h2>
      <div class="col-sm-3 col-md-3 col-lg-3">
       <div> <img src="{{ url('/images/udistro-logo-pop.jpg') }}" alt="Udistro" /> </div>
       <div>&nbsp;</div>
      </div>
      <div class="col-sm-9 col-md-9 col-lg-9 box-H-250">
       <div class="block-head">
        <h3>Update address with Provincial Health Agency</h3>
       </div>
       <div class="row">
        <div class="col-sm-12">
         <p> If you have don't have full access to your CRA account, here is what you do, call CRA:</p>
        </div>
        <div class="col-md-12">
         <div class="block-head">
          <h3> Have these handy, before this call </h3>
         </div>
         <div class="up_add_li">
          <ul>
           <li><i class="fa fa-angle-right" aria-hidden="true"></i> Your full name</li>
           <li><i class="fa fa-angle-right" aria-hidden="true"></i> Old and new address</li>
           <li><i class="fa fa-angle-right" aria-hidden="true"></i> Old and new postal codes</li>
           <li><i class="fa fa-angle-right" aria-hidden="true"></i> Your SIN#</li>
           <li><i class="fa fa-angle-right" aria-hidden="true"></i> Phone contact, name and DOB of children</li>
          </ul>
         </div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-6">
         <div class="block-head">
          <h3> Opening Hours </h3>
         </div>
         <div class="up_add_li">
          <ul>
           <li> <span>Monday to Friday,</span> <i class="fa fa-clock-o" aria-hidden="true"></i>07:00 AM - 11:00 PM ET </li>
           <li> <span>Saturday and Sunday,</span> <i class="fa fa-clock-o" aria-hidden="true"></i>09:00 AM - 09:00 PM ET </li>
          </ul>
         </div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-6">
         <div class="block-head">
          <h3> Phone Numbers </h3>
         </div>
         <div class="up_add_li">
          <ul>
           <li><span>Inside of Canada:</span> <i class="fa fa-phone" aria-hidden="true"></i>1-800-959-8281</li>
           <li><span>Outside of Canada:</span> <i class="fa fa-phone" aria-hidden="true"></i>613-940-8495</li>
          </ul>
         </div>
        </div>
       </div>
      </div>
     </div>
     <div class="model-WrapCont" id="update_address_step5" style="display: none;"> 
      <!-- HSA 1 -->
      <h2>Update Address</h2>
      <div class="col-sm-3 col-md-3 col-lg-3">
       <div> <img src="{{ url('/images/udistro-logo-pop.jpg') }}" alt="Udistro" /> </div>
       <div>&nbsp;</div>
      </div>
      <div class="col-sm-9 col-md-9 col-lg-9 box-H-250">
       <div class="block-head">
        <h3>Update address with Driver's License Agency</h3>
       </div>
       <div class="row">
        <div class="col-sm-12">
         <p>You are required to report changes in your name or address in person within 15 days to your Autopac Agency. At that time, a new photo will be taken. Visit or call any Autopac Agent closest to you, or contact Manitoba Public Insurance at 204-985-7000 in the Winnipeg calling area or toll-free at 1-800-665-2410</p>
        </div>
        <div class="get_started_LB"> <a href="javascript:void(0);" onclick="window.open('https://www.google.co.in/maps/search/autopac+agency+in+canada/@49.0633977,-115.1102883,5z/data=!3m1!4b1', 'location=yes,height=800,width=1000,scrollbars=yes,status=yes');">Click here to get started</a> </div>
       </div>
      </div>
     </div>
     <div class="model-WrapCont" id="update_address_step6" style="display: none;"> 
      <!-- HSA 1 -->
      <h2>Update Address</h2>
      <div class="col-sm-3 col-md-3 col-lg-3">
       <div> <img src="{{ url('/images/udistro-logo-pop.jpg') }}" alt="Udistro" /> </div>
       <div>&nbsp;</div>
      </div>
      <div class="col-sm-9 col-md-9 col-lg-9 box-H-250">
       <div class="block-head">
        <h3>Update address with Driver's License Agency</h3>
       </div>
       <div class="row">
        <div class="col-sm-12">
         <p>You are required to report changes in your name or address in person within 15 days to your Autopac Agency. At that time, a new photo will be taken. Visit or call any Autopac Agent closest to you, or contact Manitoba Public Insurance at 204-985-7000 in the Winnipeg calling area or toll-free at 1-800-665-2410</p>
        </div>
        <div class="get_started_LB"> <a href="javascript:void(0);" onclick="window.open('https://www.google.co.in/maps/search/autopac+agency+in+canada/@49.0633977,-115.1102883,5z/data=!3m1!4b1', 'location=yes,height=800,width=1000,scrollbars=yes,status=yes');">Click here to get started</a> </div>
       </div>
      </div>
     </div>
     <div class="model-WrapCont" id="update_address_step7" style="display: none;"> 
      <!-- HSA 1 -->
      <h2>Update Address</h2>
      <div class="col-sm-3 col-md-3 col-lg-3">
       <div> <img src="{{ url('/images/udistro-logo-pop.jpg') }}" alt="Udistro" /> </div>
       <div>&nbsp;</div>
      </div>
      <div class="col-sm-9 col-md-9 col-lg-9 box-H-250">
       <div class="row">
        <div class="block-head">
         <h3>Update address with Driver's License Agency</h3>
        </div>
        <div class="col-sm-12">
         <p>You are required to report changes in your name or address in person within 15 days to your Autopac Agency. At that time, a new photo will be taken. Visit or call any Autopac Agent closest to you, or contact Manitoba Public Insurance at 204-985-7000 in the Winnipeg calling area or toll-free at 1-800-665-2410</p>
        </div>
        <div class="get_started_LB"> <a href="javascript:void(0);" onclick="window.open('https://www.google.co.in/maps/search/autopac+agency+in+canada/@49.0633977,-115.1102883,5z/data=!3m1!4b1', 'location=yes,height=800,width=1000,scrollbars=yes,status=yes');">Click here to get started</a> </div>
       </div>
      </div>
     </div>
    </div>
    
    <!-- <div class="col-sm-9 col-md-9 col-lg-9" id="update_address_step8" style="width: 500px; height: 300px; display: none;">
		      			<strong>Have you completed this task?</strong>
		      			<br>
		      			<div class="col-sm-6 col-md-6 col-lg-6">
		      				<button type="button" class="btn btn-primary btn_activity_user_response" data-dismiss="modal" data-activity="update_address" id="1">Yes</button>
		      			</div>
		      			<div class="col-sm-6 col-md-6 col-lg-6">
		      				<button type="button" class="btn btn-primary btn_activity_user_response" data-dismiss="modal" data-activity="update_address" id="0">No</button>
		      			</div>
		      		</div> -->
    
    <div class="row">
     <div class="col-sm-3 col-md-3 col-lg-3">
      <div class="helpful-box">
       <label>Is this helpful to you?</label>
       <a href="javascript:void(0);" id="1" data-activity="update_address" class="activity_feedback">Yes</a> <a href="javascript:void(0);" id="0" data-activity="update_address" class="activity_feedback">No</a> </div>
     </div>
     
     <!--<div class="col-sm-9 col-md-9 col-lg-9">
     <form name="frm_update_address" id="frm_update_address">
      <div class="col-md-4">
       <p> Do you have full access to your CRA? </p>
       <div>
        <label>
         <input type="radio" name="update_address_method1" value="1">
         Yes</label>
        <label>
         <input type="radio" name="update_address_method1" value="2">
         No</label>
       </div>
       <label id="update_address_method1-error" class="error" for="update_address_method1"></label>
      </div>
      <div class="col-md-4">
       <p> Do you have dependent children?</p>
       <div>
        <label>
         <input type="radio" name="update_address_method2" value="1">
         Yes</label>
        <label>
         <input type="radio" name="update_address_method2" value="2">
         No</label>
       </div>
       <label id="update_address_method2-error" class="error" for="update_address_method2"></label>
      </div>
      <div class="col-md-4">
       <p>Do you receive child benefit?</p>
       <div>
        <label>
         <input type="radio" name="update_address_method3" value="1">
         Yes</label>
        <label>
         <input type="radio" name="update_address_method3" value="2">
         No</label>
       </div>
       <label id="update_address_method3-error" class="error" for="update_address_method3"></label>
      </div>
     </form>
    </div>--> 
    </div>
    <div class="row">
     <div class="col-sm-8 col-md-8 col-lg-8">&nbsp;</div>
     <div class="col-sm-4 col-md-4 col-lg-4 text-right"> <a href="javascript:void(0);" id="btn_prev_update_address" class="btn"><i class="fa fa-angle-double-left" aria-hidden="true"></i> Previous</a> <a href="javascript:void(0);" id="btn_next_update_address" class="btn">Next <i class="fa fa-angle-double-right" aria-hidden="true"></i></a> </div>
    </div>
   </div>
  </div>
  <!--<div class="modal-footer">
	        	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      	</div>--> 
 </div>
</div>
<!-- Update Address Modal End -->

<!-- Mailbox keys Modal -->
<div id="mailbox_key_modal" class="modal fade mover-modal">
 <div class="modal-dialog modal-lg"> 
  <!-- Modal content-->
  <div class="modal-content">
   <div class="modal-body">
    <div class="close close-btn close_modal" data-activity="mailbox_keys" data-dismiss="modal"><img src="{{ url('/images/movers/close-img.png') }}" alt=""></div>
    <div class="model-WrapCont">
     <h2>Get Mailbox Keys</h2>
    </div>
    <div class="row">
     <div class="col-sm-3 col-md-3 col-lg-3">
      <div> <img src="{{ url('/images/udistro-logo-pop.jpg') }}" alt="Udistro" /> </div>
     </div>
     <div class="col-sm-9 col-md-9 col-lg-9 box-H-250" id="mailbox_keys_step1">
      <div class="row">
       <div class="col-sm-12">
        <p>If you recently moved to a neighbourhood where mail is delivered to a community mailbox, we recommend that you get new keys from Canada post, even if the former residents left the old mailbox keys behind.</p>
       </div>
      </div>
      <div class="clearfix"></div>
      <div class="col-sm-12 mailfarwd_wrap_radio">
       <form name="frm_mailbox_keys" id="frm_mailbox_keys">
        <label class="mailfarw_radio-lb">
         <input type="radio" name="mailbox_keys_method" value="2">
         Do it here online</label>
        <label class="mailfarw_radio-lb">
         <input type="radio" name="mailbox_keys_method" value="1">
         Call Canada Post</label>
        <label id="mailbox_keys_method-error" class="error" for="mailbox_keys_method"></label>
       </form>
      </div>
     </div>
     <div class="col-sm-9 col-md-9 col-lg-9 box-H-250" id="mailbox_keys_step2" style="display: none;">
      <div class="row">
       <div class="col-sm-12">
        <p>Canada post general enquiry numbers allow you to call in and get help with your community mailbox keys directly from a representative.</p>
       </div>
       <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="up_add_li">
         <div class="block-head">
          <h3>Have these handy, before this call </h3>
         </div>
         <div class="up_add_li">
          <ul>
           <li><i class="fa fa-angle-right" aria-hidden="true"></i> Your full name</li>
           <li><i class="fa fa-angle-right" aria-hidden="true"></i> Old and new address</li>
           <li><i class="fa fa-angle-right" aria-hidden="true"></i> Old and new postal code etc</li>
          </ul>
         </div>
        </div>
       </div>
       <div class="col-sm-12 col-md-6 col-lg-6">
        <div class="block-head">
         <h3> Opening Hours </h3>
        </div>
        <div class="up_add_li">
         <ul>
          <li> <span>Monday to Friday,</span> <i class="fa fa-clock-o" aria-hidden="true"></i>07:00 AM - 11:00 PM ET </li>
          <li> <span>Saturday and Sunday,</span> <i class="fa fa-clock-o" aria-hidden="true"></i>09:00 AM - 09:00 PM ET </li>
         </ul>
        </div>
       </div>
       <div class="col-sm-12 col-md-6 col-lg-6">
        <div class="block-head">
         <h3> Phone Numbers </h3>
        </div>
        <div class="up_add_li">
         <ul>
          <li><span>Inside of Canada:</span> <i class="fa fa-phone" aria-hidden="true"></i>1-800-959-8281</li>
          <li><span>Outside of Canada:</span> <i class="fa fa-phone" aria-hidden="true"></i>613-940-8495</li>
         </ul>
        </div>
       </div>
      </div>
     </div>
     <div class="col-sm-9 col-md-9 col-lg-9 box-H-250" id="mailbox_keys_step3" style="display: none;">
      <div class="row">
       <div class="col-sm-12">
        <p>Click the link below, you we will able to submit service request form to Canada post. They will leave a Delivery Notice Card on your front door indicating the location of the post office where you can pick up your keys.</p>
       </div>
      </div>
      <div class="get_started_LB"><a href="javascript:void(0);" onclick="window.open('https://www.canadapost.ca/cpo/mc/app/cmb/existing_state.jsf', '_blank', 'location=yes,height=800,width=1000,scrollbars=yes,status=yes');">Click here to get started</a></div>
     </div>
    </div>
    
    <!-- <div class="col-sm-9 col-md-9 col-lg-9" id="mailbox_keys_step4" style="width: 500px; height: 300px; display: none;">
		      			<strong>Have you completed this task?</strong>
		      			<br>
		      			<div class="col-sm-6 col-md-6 col-lg-6">
		      				<button type="button" class="btn btn-primary btn_activity_user_response" data-dismiss="modal" data-activity="mailbox_keys" id="1">Yes</button>
		      			</div>
		      			<div class="col-sm-6 col-md-6 col-lg-6">
		      				<button type="button" class="btn btn-primary btn_activity_user_response" data-dismiss="modal" data-activity="mailbox_keys" id="0">No</button>
		      			</div>
		      		</div> -->
    <div class="row" style="display:none;">
     <div class="col-sm-3 col-md-3 col-lg-3">
      <div class="helpful-box">
       <label>Is this helpful to you?</label>
       <a href="javascript:void(0);" id="1" data-activity="mailbox_keys" class="activity_feedback">Yes</a> <a href="javascript:void(0);" id="0" data-activity="mailbox_keys" class="activity_feedback">No</a> </div>
     </div>
     <div class="col-sm-9 col-md-9 col-lg-9">
      <div class="col-md-4">
       <p> Canada post will inform you of your community mailbox location </p>
      </div>
      <div class="col-md-4">
       <p> Canada post will leave Delivery Notice Card on your front door </p>
      </div>
      <div class="col-md-4">
       <p> Bring the Delivery Notice Card, government-issued photo identification and proof of residence when you pick up your keys </p>
      </div>
     </div>
    </div>
    <div class="row">
     <div class="col-sm-8 col-md-8 col-lg-8">&nbsp;</div>
     <div class="col-sm-4 col-md-4 col-lg-4 text-right"> <a href="javascript:void(0);" id="btn_prev_mailbox_keys" class="btn"><i class="fa fa-angle-double-left" aria-hidden="true"></i> Previous</a> <a href="javascript:void(0);" id="btn_next_mailbox_keys" class="btn">Next <i class="fa fa-angle-double-right" aria-hidden="true"></i></a> </div>
    </div>
   </div>
  </div>
  <!-- <div class="modal-footer">
	        	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      	</div> --> 
 </div>
</div>
<!-- Mailbox keys Modal End -->

<!-- Connect Utilities Modal -->
<div id="connect_utilities_modal" class="modal fade mover-modal">
 <div class="modal-dialog modal-lg"> 
  <!-- Modal content-->
  <div class="modal-content">
   <div class="modal-body">
    <div class="close close-btn close_modal" data-activity="connect_utilities" data-dismiss="modal"><img src="{{ url('/images/movers/close-img.png') }}" alt=""></div>
    <div class="model-WrapCont">
     <h2>Connect Utilities</h2>
    </div>
    <div class="row">
     <div class="col-sm-3 col-md-3 col-lg-3">
      <div> <img src="{{ url('/images/udistro-logo-pop.jpg') }}" alt="Udistro" /> </div>
     </div>
     <div class="col-sm-9 col-md-9 col-lg-9 box-H-250" id="connect_utilities_step1">
      <div class="row">
       <div class="col-sm-12">
        <p>Moving to a new neighborhood, you need to setup new, cancel or transfer old service to your new address. If you need to open a Hydro, Gas, Water and Waste accounts, then start here:</p>
       </div>
      </div>
      <div class="clearfix"></div>
      <div class="col-sm-12 up_add_li">
       <ul>
        <li><i class="fa fa-check" aria-hidden="true"></i> Hydro, Electricity and Gas</li>
        <li><i class="fa fa-check" aria-hidden="true"></i> Water, Waste and Recycle</li>
       </ul>
      </div>
	  <div class="clearfix"></div>
	  <div class="col-sm-12">
         <div class="row">
          <form name="frm_update_address" id="frm_update_address" novalidate="novalidate">
           <div class="col-md-4">
            <div class="model-box-YN"> <span> I need to start new service (new account) </span>
             <label>
              <input name="update_address_method1" value="1" type="radio">
              Yes</label>
             <label>
              <input name="update_address_method1" value="2" type="radio">
              No</label>
            </div>
            <label id="update_address_method1-error" class="error" for="update_address_method1"></label>
           </div>
           <div class="col-md-4">
            <div class="model-box-YN"> <span> I need to stop service (transfer account)</span>
             <label>
              <input name="update_address_method2" value="1" type="radio">
              Yes</label>
             <label>
              <input name="update_address_method2" value="2" type="radio">
              No</label>
            </div>
            <label id="update_address_method2-error" class="error" for="update_address_method2"></label>
           </div>
           <div class="col-md-4">
            <div class="model-box-YN"> <span>I need to stop service (cancel account)</span>
             <label>
              <input name="update_address_method3" value="1" type="radio">
              Yes</label>
             <label>
              <input name="update_address_method3" value="2" type="radio">
              No</label>
            </div>
            <label id="update_address_method3-error" class="error" for="update_address_method3"></label>
           </div>
          </form>
         </div>
        </div>
     </div>
     <div class="col-sm-9 col-md-9 col-lg-9 box-H-250" id="connect_utilities_step2" style="display: none;">
      <div class="row">
       <div class="col-sm-12"> <strong>Connect Hydro, Electricity and Gas</strong>
        <p>If you are moving in, and are financially responsible for Hydro, gas, or electricity at your new address, you need to open and account:</p>
       </div>
      </div>
      <div class="col-sm-12 mailfarwd_wrap_radio">
       <form>
        <label class="mailfarw_radio-lb">
         <input type="radio" name="connect_utilities_method_type" value="1" checked="">
         Do it here online </label>
        <label class="mailfarw_radio-lb">
         <input type="radio" name="connect_utilities_method_type" value="2">
         Call utility service </label>
       </form>
      </div>
      
      <!-- Different Methods --> 
      <!-- Call utility service --> 
      <!--
      <div class="row" id="connect_utilities_method_type_container1">
       <div class="col-sm-3 col-md-3 col-lg-3"> <strong> Have these handy, before this call</strong>
        <div>
         <div>Your full name</div>
         <div>Old and new address</div>
         <div>Old and new postal code</div>
        </div>
       </div>
       <div class="col-sm-3 col-md-3 col-lg-3"> <strong> Opening Hours </strong>
        <div>
         <div> Monday to Friday, 07:00 AM - 11:00 PM ET </div>
         <div> Saturday and Sunday, 09:00 AM - 09:00 PM ET </div>
        </div>
       </div>
       <div class="col-sm-3 col-md-3 col-lg-3"> <strong> Phone Numbers </strong>
        <div>
         <div><span>Inside of Canada:</span> 1-866-607-6301</div>
         <div><span>Outside of Canada:</span> 416-979-3033</div>
        </div>
       </div>
      </div>
	  --> 
      
      <!-- Do it here online --> 
      <!--
	  <div class="row" id="connect_utilities_method_type_container2" style="display: none;">
       <div> <strong>Do it online</strong> </div>
       <div class="get_started_LB"> <a href="javascript:void(0);" onclick="window.open('https://www.hydro.mb.ca/custmoves/main.jsf', '_blank', 'location=yes,height=800,width=1000,scrollbars=yes,status=yes');">Click here to get started</a> </div>
      </div>
	  --> 
      
     </div>
     <div class="col-sm-9 col-md-9 col-lg-9 box-H-250" id="connect_utilities_step3" style="display: none;">
      <div> <strong>Water, Waste and Recycle Bins</strong>
       <p>If you are moving in, and are financially responsible for Water, waste, or recycle at your new address, you need to open and account:</p>
      </div>
      <div class="col-sm-12 up_add_li">
       <ul>
        <li><i class="fa fa-check" aria-hidden="true"></i> Moving In</li>
        <li><i class="fa fa-check" aria-hidden="true"></i> Moving Out</li>
       </ul>
      </div>
      <div class="row">
       <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="up_add_li">
         <div class="block-head">
          <h3>We will require </h3>
         </div>
         <div class="up_add_li">
          <ul>
           <li><i class="fa fa-angle-right" aria-hidden="true"></i> Your name</li>
           <li><i class="fa fa-angle-right" aria-hidden="true"></i> Name of anyone financially responsible for the utility bill</li>
           <li><i class="fa fa-angle-right" aria-hidden="true"></i> Service Address</li>
          </ul>
         </div>
        </div>
       </div>
       <div class="col-sm-12 col-md-6 col-lg-6">
        <div class="block-head">
         <h3> Hours </h3>
        </div>
        <div class="up_add_li">
         <ul>
          <li> <span>Monday to Thursday,</span> <i class="fa fa-clock-o" aria-hidden="true"></i>08:30 AM - 07:00 PM (except holidays) </li>
          <li> <span>Friday and Saturday,</span> <i class="fa fa-clock-o" aria-hidden="true"></i>08:30 AM - 04:30 PM (except holiday long weekend) </li>
         </ul>
        </div>
       </div>
       <div class="col-sm-12 col-md-6 col-lg-6">
        <div class="block-head">
         <h3> Phone Numbers </h3>
        </div>
        <div class="up_add_li">
         <ul>
          <li><span>City Services:</span> <i class="fa fa-phone" aria-hidden="true"></i>3-1-1</li>
         </ul>
        </div>
       </div>
      </div>
     </div>
     
     <!-- <div class="col-sm-9 col-md-9 col-lg-9" id="connect_utilities_step4" style="width: 500px; height: 300px; display: none;">
		      			<strong>Have you completed this task?</strong>
		      			<br>
		      			<div class="col-sm-6 col-md-6 col-lg-6">
		      				<button type="button" class="btn btn-primary btn_activity_user_response" data-dismiss="modal" data-activity="connect_utilities" id="1">Yes</button>
		      			</div>
		      			<div class="col-sm-6 col-md-6 col-lg-6">
		      				<button type="button" class="btn btn-primary btn_activity_user_response" data-dismiss="modal" data-activity="connect_utilities" id="0">No</button>
		      			</div>
		     </div> --> 
     
    </div>
    <div class="row" style="display:none;">
     <div class="col-sm-3 col-md-3 col-lg-3">
      <div class="helpful-box">
       <label>Is this helpful to you?</label>
       <a href="javascript:void(0);" id="1" data-activity="connect_utilities" class="activity_feedback">Yes</a> <a href="javascript:void(0);" id="0" data-activity="connect_utilities" class="activity_feedback">No</a> </div>
     </div>
     <div class="col-sm-9 col-md-9 col-lg-9">
      <div class="col-md-4">
       <p> I need to start new service at a new address (open new account) </p>
      </div>
      <div class="col-md-4">
       <p> I need to stop service at one address and start service at a new address (transfer account) </p>
      </div>
      <div class="col-md-4">
       <p> I need to stop service or cancel account (account cancel) </p>
      </div>
     </div>
    </div>
    <div class="row">
     <div class="col-sm-8 col-md-8 col-lg-8">&nbsp;</div>
     <div class="col-sm-4 col-md-4 col-lg-4 text-right"> <a href="javascript:void(0);" id="btn_prev_connect_utilities" class="btn"><i class="fa fa-angle-double-left" aria-hidden="true"></i> Previous</a> <a href="javascript:void(0);" id="btn_next_connect_utilities" class="btn">Next <i class="fa fa-angle-double-right" aria-hidden="true"></i></a> </div>
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
						                        <a data-toggle="collapse" data-parent="#accordion" href="#home_cleaning_services_collapse1">Indicate type of cleaning</a>
						                    </h4>
						                </div>
						                <div id="home_cleaning_services_collapse1" class="panel-collapse collapse in">
						                    <div class="panel-body">
						                        <div><label><input type="checkbox" name=""> Move in cleaning</label></div>
						                        <div><label><input type="checkbox" name=""> Move out cleaning</label></div>
						                    </div>
						                </div>
						            </div>
						            <div class="panel panel-default">
						                <div class="panel-heading">
						                    <h4 class="panel-title">
						                        <a data-toggle="collapse" data-parent="#accordion" href="#home_cleaning_services_collapse2">Moving From</a>
						                    </h4>
						                </div>
						                <div id="home_cleaning_services_collapse2" class="panel-collapse collapse">
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
						                        <a data-toggle="collapse" data-parent="#accordion" href="#home_cleaning_services_collapse3">Moving To</a>
						                    </h4>
						                </div>
						                <div id="home_cleaning_services_collapse3" class="panel-collapse collapse">
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
						                        <a data-toggle="collapse" data-parent="#accordion" href="#home_cleaning_services_collapse4">Detailed Job Description</a>
						                    </h4>
						                </div>
						                <div id="home_cleaning_services_collapse4" class="panel-collapse collapse">
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
						                        <a data-toggle="collapse" data-parent="#accordion" href="#home_cleaning_services_collapse5">Additional Services</a>
						                    </h4>
						                </div>
						                <div id="home_cleaning_services_collapse5" class="panel-collapse collapse">
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
						                        <a data-toggle="collapse" data-parent="#accordion" href="#home_cleaning_services_collapse6">Call Me On</a>
						                    </h4>
						                </div>
						                <div id="home_cleaning_services_collapse6" class="panel-collapse collapse">
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
						                        <a data-toggle="collapse" data-parent="#accordion" href="#home_cleaning_services_collapse7">Additional Information (If Any)</a>
						                    </h4>
						                </div>
						                <div id="home_cleaning_services_collapse7" class="panel-collapse collapse">
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

		      		<!-- <div class="col-sm-9 col-md-9 col-lg-9" id="home_cleaning_services_step2" style="height: 300px; display: none;">
		      			<strong>Have you completed this task?</strong>
		      			<br>
		      			<div class="col-sm-6 col-md-6 col-lg-6">
		      				<button type="button" class="btn btn-primary btn_activity_user_response" data-dismiss="modal" data-activity="home_cleaning_services" id="1">Yes</button>
		      			</div>
		      			<div class="col-sm-6 col-md-6 col-lg-6">
		      				<button type="button" class="btn btn-primary btn_activity_user_response" data-dismiss="modal" data-activity="home_cleaning_services" id="0">No</button>
		      			</div>
		      		</div> -->
		      	</div>
		      	
		      	<div class="row">
		      		<div class="col-sm-8 col-md-8 col-lg-8">
		      			<div>
		      				<label>Is this helpful to you?</label>
		      				<a href="javascript:void(0);" id="1" data-activity="home_cleaning_services" class="activity_feedback">Yes</a>
		      				<a href="javascript:void(0);" id="0" data-activity="home_cleaning_services" class="activity_feedback">No</a>
		      			</div>
		      		</div>
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
		      	<h2>Moving Companies</h2>

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
      						<form name="frm_home_moving_companies" id="frm_home_moving_companies" autocomplete="off">
						        <div class="panel-group" id="accordion_home_moving_companies">
						        	<div class="panel panel-default">
						                <div class="panel-heading">
						                    <h4 class="panel-title">
						                        <a data-toggle="collapse" data-parent="#accordion_home_moving_companies" href="#home_moving_companies_collapse3">Moving From</a>
						                    </h4>
						                </div>
						                <div id="home_moving_companies_collapse3" class="panel-collapse collapse in">
						                    <div class="panel-body">
						                        <div class="form-group">
						                        	<label>Type</label>
						                        	<select class="form-control" name="moving_house_from_type" id="moving_house_from_type">
						                        		<option value="">Select</option>
						                        		<option value="house">House</option>
						                        		<option value="apartment/flat">Apartment/Flat</option>
						                        		<option value="condo">Condo</option>
						                        		<option value="studio">Studio</option>
						                        	</select>
						                        </div>
						                        <div class="form-group">
						                        	<label>Floor Level</label>
						                        	<label><input type="radio" name="moving_house_from_level" value="1">1</label>
						                        	<label><input type="radio" name="moving_house_from_level" value="2">2</label>
						                        	<label><input type="radio" name="moving_house_from_level" value="3">3</label>
						                        	<label><input type="radio" name="moving_house_from_level" value="4+">4 or more</label>
						                        	<div><label id="moving_house_from_level-error" class="error" for="moving_house_from_level"></label></div>
						                        </div>
						                        <div class="form-group">
						                        	<label>No of bedrooms</label>
						                        	<label><input type="radio" name="moving_house_from_bedroom_count" value="1">1</label>
						                        	<label><input type="radio" name="moving_house_from_bedroom_count" value="2">2</label>
						                        	<label><input type="radio" name="moving_house_from_bedroom_count" value="3">3</label>
						                        	<label><input type="radio" name="moving_house_from_bedroom_count" value="4+">4 or more</label>
						                        	<div><label id="moving_house_from_bedroom_count-error" class="error" for="moving_house_from_bedroom_count"></label></div>
						                        </div>
						                        <div class="form-group">
						                        	<label>Did you own or rent this property</label>
						                        	<label><input type="radio" name="moving_house_from_property_type" value="own">Own</label>
						                        	<label><input type="radio" name="moving_house_from_property_type" value="rent">Rent</label>
						                        	<div><label id="moving_house_from_property_type-error" class="error" for="moving_house_from_property_type"></label></div>
						                        </div>
						                    </div>
						                </div>
						            </div>
						            <div class="panel panel-default">
						                <div class="panel-heading">
						                    <h4 class="panel-title">
						                        <a data-toggle="collapse" data-parent="#accordion_home_moving_companies" href="#home_moving_companies_collapse2">Moving To</a>
						                    </h4>
						                </div>
						                <div id="home_moving_companies_collapse2" class="panel-collapse collapse">
						                    <div class="panel-body">
						                        <div class="form-group">
						                        	<label>Type</label>
						                        	<select class="form-control" name="moving_house_to_type" id="moving_house_to_type">
						                        		<option value="">Select</option>
						                        		<option value="house">House</option>
						                        		<option value="apartment/flat">Apartment/Flat</option>
						                        		<option value="condo">Condo</option>
						                        		<option value="studio">Studio</option>
						                        	</select>
						                        </div>
						                        <div class="form-group">
						                        	<label>Floor Level</label>
						                        	<label><input type="radio" name="moving_house_to_level" value="1">1</label>
						                        	<label><input type="radio" name="moving_house_to_level" value="2">2</label>
						                        	<label><input type="radio" name="moving_house_to_level" value="3">3</label>
						                        	<label><input type="radio" name="moving_house_to_level" value="4+">4 or more</label>
						                        	<div><label id="moving_house_to_level-error" class="error" for="moving_house_to_level"></label></div>
						                        </div>
						                        <div class="form-group">
						                        	<label>No of bedrooms</label>
						                        	<label><input type="radio" name="moving_house_to_bedroom_count" value="1">1</label>
						                        	<label><input type="radio" name="moving_house_to_bedroom_count" value="2">2</label>
						                        	<label><input type="radio" name="moving_house_to_bedroom_count" value="3">3</label>
						                        	<label><input type="radio" name="moving_house_to_bedroom_count" value="4+">4 or more</label>
						                        	<div><label id="moving_house_to_bedroom_count-error" class="error" for="moving_house_to_bedroom_count"></label></div>
						                        </div>
						                        <div class="form-group">
						                        	<label>Did you own or rent this property</label>
						                        	<label><input type="radio" name="moving_house_to_property_type" value="own">Own</label>
						                        	<label><input type="radio" name="moving_house_to_property_type" value="rent">Rent</label>
						                        	<div><label id="moving_house_to_property_type-error" class="error" for="moving_house_to_property_type"></label></div>
						                        </div>
						                    </div>
						                </div>
						            </div>
						            
						            <div class="panel panel-default">
						                <div class="panel-heading">
						                    <h4 class="panel-title">
						                        <a data-toggle="collapse" data-parent="#accordion_home_moving_companies" href="#home_moving_companies_collapse4">Detailed Job Description</a>
						                    </h4>
						                </div>
						                <div id="home_moving_companies_collapse4" class="panel-collapse collapse">
						                    <div class="panel-body">
						                    	<?php
						                    	// Moving item categories
						                    	if( isset( $movingItemCategories ) && count( $movingItemCategories ) > 0 )
						                    	{
						                    		$step = 1;
						                    		foreach ($movingItemCategories as $movingItemCategory)
						                    		{
						                    		?>
						                    			<div class="form-group">
						                        			<!-- Collapse Title -->
						                        			<div><label><a data-toggle="collapse" href="#collapse{{ $step }}">{{ $movingItemCategory->item_name }}</a></label></div>

						                        			<!-- Collapse Body -->
						                        			<div id="collapse{{ $step }}" class="panel-collapse collapse">
						                        				<div>
							                        				<div class="col-sm-6 col-md-6 col-lg-6"><strong>Item</strong></div>
							                        				<div class="col-sm-4 col-md-4 col-lg-4"><strong>Weight</strong></div>
							                        				<div class="col-sm-2 col-md-2 col-lg-2"><strong>Quantity</strong></div>
						                        				</div>
							                        			<?php
							                        			if( isset( $movingItemDetails ) && count( $movingItemDetails ) > 0 )
							                        			{
							                        				foreach ($movingItemDetails as $movingItemDetail)
							                        				{
							                        					if( $movingItemDetail->moving_item_category_id == $movingItemCategory->id )
							                        					{
							                        						// echo '<option value="'. $movingItemDetail->id .'">'. $movingItemDetail->item_name . ' - ' . $movingItemDetail->item_weight .'</option>';
							                        					?>
							                        						<div class="col-sm-6 col-md-6 col-lg-6">{{ $movingItemDetail->item_name }}</div>
							                        						<div class="col-sm-4 col-md-4 col-lg-4">{{ $movingItemDetail->item_weight }}</div>
							                        						<div class="col-sm-2 col-md-2 col-lg-2">
							                        							<input class="form-control" type="number" min="0" name="item_quantity[{{ $movingItemDetail->id }}]" value="">
							                        						</div>
							                        					<?php
							                        					}
							                        				}
							                        			}
							                        			?>
						                        			</div>
						                        		</div>
						                        		<div class="clearfix"></div>
						                    		<?php
						                    			$step++;
						                    		}
						                    	}
						                    	?>
						                    </div>
						                </div>
						            </div>
						            <div class="panel panel-default">
						                <div class="panel-heading">
						                    <h4 class="panel-title">
						                        <a data-toggle="collapse" data-parent="#accordion_home_moving_companies" href="#home_moving_companies_collapse5">Special Instructions</a>
						                    </h4>
						                </div>
						                <div id="home_moving_companies_collapse5" class="panel-collapse collapse">
						                    <div class="panel-body">
						                    	<?php
						                    	if( isset( $movingOtherItemList ) && count( $movingOtherItemList ) > 0 )
						                    	{
						                    		foreach ($movingOtherItemList as $itemList)
						                    		{
						                    			if( $itemList->type == 1 )
						                    			{
						                    			?>
						                    				<div class="form-group">
						                    					<label>{{ $itemList->other_moving_items_services_details }}</label>
						                    					<label> <input type="radio" name="moving_house_special_instruction[{{ $itemList->id }}]" value="1">Yes</label>
						                    					<label> <input type="radio" name="moving_house_special_instruction[{{ $itemList->id  }}]" value="0">No</label>
						                    				</div>
						                    			<?php
						                    			}
						                    		}
						                    	}
						                    	?>
						                    </div>
						                </div>
						            </div>
						            <div class="panel panel-default">
						                <div class="panel-heading">
						                    <h4 class="panel-title">
						                        <a data-toggle="collapse" data-parent="#accordion_home_moving_companies" href="#home_moving_companies_collapse6">Additional Services</a>
						                    </h4>
						                </div>
						                <div id="home_moving_companies_collapse6" class="panel-collapse collapse">
						                	<div class="panel-body">
						                		<?php
						                		$step2 = 1;
						                		if( isset( $movingOtherItemList ) && count( $movingOtherItemList ) > 0 )
						                		{
						                			foreach ($movingOtherItemList as $itemList)
						                    		{
						                    			if( $itemList->type == 2 )
						                    			{
						                    			?>
						                    				<div class="form-group">
						                    					<label>{{ $itemList->other_moving_items_services_details }}</label>
						                    					<label> <input type="radio" name="moving_house_additional_service[{{ $itemList->id }}]" value="1">Yes</label>
						                    					<label> <input type="radio" name="moving_house_additional_service[{{ $itemList->id }}]" value="0">No</label>
						                    				</div>
						                    			<?php
						                    				$step2++;
						                    			}
						                    		}
						                		}
						                		?>

						                		<div class="form-group">
						                		<?php
						                		if( isset( $MovingTransportationList ) && count( $MovingTransportationList ) > 0 )
						                		{
						                			foreach ($MovingTransportationList as $transportationList)
						                    		{
						                    		?>
						                    			<label>{{ $transportationList->transportation_type }}</label>
						                    			<br>
							                        	<label><input type="radio" name="moving_house_vehicle_type" value="pickup">Pickup</label>
							                        	<label><input type="radio" name="moving_house_vehicle_type" value="cargo van">Cargo Van</label>
							                        	<label><input type="radio" name="moving_house_vehicle_type" value="10' truck">10' Truck</label>
							                        	<label><input type="radio" name="moving_house_vehicle_type" value="15' truck">15' Truck</label>
							                        	<label><input type="radio" name="moving_house_vehicle_type" value="17' truck">17' Truck</label>
							                        	<label><input type="radio" name="moving_house_vehicle_type" value="26' Truck">26' Truck</label>
							                        	<div><label id="moving_house_vehicle_type-error" class="error" for="moving_house_vehicle_type"></label></div>
						                    		<?php
						                    		}
						                    	}
						                		?>
						                        </div>

						                        <div class="form-group">
						                        	<label>Call back option?</label>
						                        	<label> <input type="radio" name="moving_house_callback_option" value="1">Yes</label>
						                        	<label> <input type="radio" name="moving_house_callback_option" value="0">No</label>
						                        	<div><label id="moving_house_callback_option-error" class="error" for="moving_house_callback_option"></label></div>
						                        </div>
						                        <div class="form-group">
						                        	<label>Call back time?</label>
						                        	<label> <input type="radio" name="moving_house_callback_time" value="0">Anytime</label>
						                        	<label> <input type="radio" name="moving_house_callback_time" value="1">Daytime</label>
						                        	<label> <input type="radio" name="moving_house_callback_time" value="2">Evening</label>
						                        	<div><label id="moving_house_callback_time-error" class="error" for="moving_house_callback_time"></label></div>
						                        </div>
						                        <div class="form-group">
						                        	<label>Call me on?</label>
						                        	<input type="text" name="moving_house_callback_primary_no" class="form-control" placeholder="Primary Number">
						                        	<input type="text" name="moving_house_callback_secondary_no" class="form-control" placeholder="Additional Number">
						                        </div>

						                	</div>
						                </div>
						            </div>
						            <div class="panel panel-default">
						                <div class="panel-heading">
						                    <h4 class="panel-title">
						                        <a data-toggle="collapse" data-parent="#accordion_home_moving_companies" href="#home_moving_companies_collapse7">Additional Information (If Any)</a>
						                    </h4>
						                </div>
						                <div id="home_moving_companies_collapse7" class="panel-collapse collapse">
						                    <div class="panel-body">
						                        <textarea class="form-control" name="moving_house_additional_information" id="moving_house_additional_information"></textarea>
						                    </div>
						                </div>
						            </div>
						            <div class="panel panel-default">
						                <div class="panel-heading">
						                    <h4 class="panel-title">
						                        <a data-toggle="collapse" data-parent="#accordion_home_moving_companies" href="#home_moving_companies_collapse8">Moving Date</a>
						                    </h4>
						                </div>
						                <div id="home_moving_companies_collapse8" class="panel-collapse collapse">
						                    <div class="panel-body">
						                        <input type="text" name="moving_house_date" id="moving_house_date" class="form-control datepicker">
						                    </div>
						                </div>
						            </div>
						        </div>

						        <div>
						        	<button type="submit" class="btn btn-info" name="btn_submit_moving_query" id="btn_submit_moving_query">Submit</button>
						        </div>
						    </form>
      					</div>
		      		</div>

		      		<!-- <div class="col-sm-9 col-md-9 col-lg-9" id="moving_companies_step2" style="height: 300px; display: none;">
		      			<strong>Have you completed this task?</strong>
		      			<br>
		      			<div class="col-sm-6 col-md-6 col-lg-6">
		      				<button type="button" class="btn btn-primary btn_activity_user_response" data-dismiss="modal" data-activity="moving_companies" id="1">Yes</button>
		      			</div>
		      			<div class="col-sm-6 col-md-6 col-lg-6">
		      				<button type="button" class="btn btn-primary btn_activity_user_response" data-dismiss="modal" data-activity="moving_companies" id="0">No</button>
		      			</div>
		      		</div> -->

		      	</div>
		      	
		      	<div class="row">
		      		<div class="col-sm-8 col-md-8 col-lg-8">
		      			<div>
		      				<label>Is this helpful to you?</label>
		      				<a href="javascript:void(0);" id="1" data-activity="moving_companies" class="activity_feedback">Yes</a>
		      				<a href="javascript:void(0);" id="0" data-activity="moving_companies" class="activity_feedback">No</a>
		      			</div>
		      		</div>
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
		      	<h2>Tech Concierge</h2>

		      	<div class="row">
		      		<div class="col-sm-3 col-md-3 col-lg-3">
	      				<div>
      						<img src="{{ url('/images/canada_post_logo.jpg') }}" alt="Udistro" />
      					</div>
      					<div>&nbsp;</div>
		      		</div>

		      		<div class="col-sm-9 col-md-9 col-lg-9" id="tech_concierge_step1">
		      			<div>
      						<p>Moving to a new neighborhood, and you need someone to clean your old apartment, or new house before you move in. Anything you need do on home cleaning service service starts here</p>
      					</div>
      					<div>
      						<strong>Indicate type of Tech</strong>
      					</div>
      					<div>
      						<br>
      						<p>
      							<label>
      								<input type="radio" class="" name="type_of_tech_concierge" value="1"> Install Appliances
      							</label>
      						</p>
      						<p>
      							<label>
      								<input type="radio" class="" name="type_of_tech_concierge" value="2"> Install windows and blinds
      							</label>
      						</p>
      						<p>
      							<label>
      								<input type="radio" class="" name="type_of_tech_concierge" value="3" disabled="true"> Lawn care
      							</label>
      						</p>
      						<p>
      							<label>
      								<input type="radio" class="" name="type_of_tech_concierge" value="4" disabled="true"> Snow removal
      							</label>
      						</p>
      						<p>
      							<label>
      								<input type="radio" class="" name="type_of_tech_concierge" value="5" disabled="true"> Plumbing and painting
      							</label>
      						</p>
      					</div>
		      		</div>

		      		<div class="col-sm-9 col-md-9 col-lg-9" id="tech_concierge_step2">
		      			<div>
      						<strong>Moving to a new neighborhood, and you need someone to clean your old apartment, or new house before you move in. Anything you need do on home cleaning service service starts here</strong>
      					</div>
      					<br>
      					<div>
      						<form name="frm_tech_concierge" id="frm_tech_concierge" autocomplete="off">
						        <div class="panel-group" id="accordion_concierge">
						            <div class="panel panel-default">
						                <div class="panel-heading">
						                    <h4 class="panel-title">
						                        <a data-toggle="collapse" data-parent="#accordion_concierge" href="#tech_concierge_collapse2">Moving To</a>
						                    </h4>
						                </div>
						                <div id="tech_concierge_collapse2" class="panel-collapse collapse in">
						                    <div class="panel-body">
						                        <div class="form-group">
						                        	<label>Type</label>
						                        	<select class="form-control" name="moving_house_to_type" id="moving_house_to_type">
						                        		<option value="">Select</option>
						                        		<option value="house">House</option>
						                        		<option value="apartment/flat">Apartment/Flat</option>
						                        		<option value="condo">Condo</option>
						                        		<option value="studio">Studio</option>
						                        	</select>
						                        </div>
						                        <div class="form-group">
						                        	<label>Floor Level</label>
						                        	<label><input type="radio" name="moving_house_to_level" value="1">1</label>
						                        	<label><input type="radio" name="moving_house_to_level" value="2">2</label>
						                        	<label><input type="radio" name="moving_house_to_level" value="3">3</label>
						                        	<label><input type="radio" name="moving_house_to_level" value="4+">4 or more</label>
						                        	<div><label id="moving_house_to_level-error" class="error" for="moving_house_to_level"></label></div>
						                        </div>
						                        <div class="form-group">
						                        	<label>No of bedrooms</label>
						                        	<label><input type="radio" name="moving_house_to_bedroom_count" value="1">1</label>
						                        	<label><input type="radio" name="moving_house_to_bedroom_count" value="2">2</label>
						                        	<label><input type="radio" name="moving_house_to_bedroom_count" value="3">3</label>
						                        	<label><input type="radio" name="moving_house_to_bedroom_count" value="4+">4 or more</label>
						                        	<div><label id="moving_house_to_bedroom_count-error" class="error" for="moving_house_to_bedroom_count"></label></div>
						                        </div>
						                        <div class="form-group">
						                        	<label>Did you own or rent this property</label>
						                        	<label><input type="radio" name="moving_house_to_property_type" value="own">Own</label>
						                        	<label><input type="radio" name="moving_house_to_property_type" value="rent">Rent</label>
						                        	<div><label id="moving_house_to_property_type-error" class="error" for="moving_house_to_property_type"></label></div>
						                        </div>
						                    </div>
						                </div>
						            </div>
						            <div class="panel panel-default">
						                <div class="panel-heading">
						                    <h4 class="panel-title">
						                        <a data-toggle="collapse" data-parent="#accordion_concierge" href="#tech_concierge_collapse3">Other Places to install appliances in</a>
						                    </h4>
						                </div>
						                <div id="tech_concierge_collapse3" class="panel-collapse collapse">
						                    <div class="panel-body">
						                        <div class="form-group">
						                        	<label>Other place to install appliances in</label>
						                        	<div>
							                        	<?php
							                        	if( isset( $techConciergePlaces ) && count( $techConciergePlaces ) > 0 )
							                        	{
							                        		foreach( $techConciergePlaces as $details )
							                        		{
							                        		?>
							                        			<div class="col-lg-4 col-md-2 col-sm-1"><label class="form-group"><input type="checkbox" name="tech_concierge_places" value="{{ $details->id }}"> {{ ucwords( strtolower( $details->places ) ) }}</label></div>
							                        		<?php
							                        		}
							                        	}
							                        	?>
						                        	</div>
						                        </div>
						                    </div>
						                </div>
						            </div>
						            <div class="panel panel-default">
						                <div class="panel-heading">
						                    <h4 class="panel-title">
						                        <a data-toggle="collapse" data-parent="#accordion_concierge" href="#tech_concierge_collapse4">Job description</a>
						                    </h4>
						                </div>
						                <div id="tech_concierge_collapse4" class="panel-collapse collapse">
						                    <div class="panel-body">
						                        <div class="form-group">
						                        	<label>Which of these appliances you plan to install</label>
						                        	<div>
							                        	<?php
							                        	if( isset( $techConciergeAppliances ) && count( $techConciergeAppliances ) > 0 )
							                        	{
							                        		foreach( $techConciergeAppliances as $details )
							                        		{
							                        		?>
							                        			<div class="col-lg-4 col-md-2 col-sm-1"><label class="form-group"><input type="checkbox" name="tech_concierge_places" value="{{ $details->id }}"> {{ ucwords( strtolower( $details->appliances ) ) }}</label></div>
							                        		<?php
							                        		}
							                        	}
							                        	?>
						                        	</div>
						                        </div>
						                    </div>
						                </div>
						            </div>
						            <div class="panel panel-default">
						                <div class="panel-heading">
						                    <h4 class="panel-title">
						                        <a data-toggle="collapse" data-parent="#accordion_concierge" href="#tech_concierge_collapse5">Other details about the job</a>
						                    </h4>
						                </div>
						                <div id="tech_concierge_collapse5" class="panel-collapse collapse">
						                    <div class="panel-body">
						                        <div class="form-group">
						                        	<?php
						                        	if( isset( $techConciergeOtherDetails ) && count( $techConciergeOtherDetails ) > 0 )
						                        	{
						                        		foreach( $techConciergeOtherDetails as $otherDetails )
						                        		{
						                        		?>
						                        			<div class="">
						                        				{{ ucwords( strtolower( $otherDetails->details ) ) }}
						                        				<label> <input type="radio" name="tech_concierge_details[{{ $otherDetails->id }}]" value=""> Yes</label>
						                        				<label> <input type="radio" name="tech_concierge_details[{{ $otherDetails->id }}]" value=""> No</label>
						                        			</div>
						                        		<?php
						                        		}
						                        	}
						                        	?>
						                        </div>
						                    </div>
						                </div>
						            </div>
						            <div class="panel panel-default">
						                <div class="panel-heading">
						                    <h4 class="panel-title">
						                        <a data-toggle="collapse" data-parent="#accordion_concierge" href="#tech_concierge_collapse6">Availability</a>
						                    </h4>
						                </div>
						                <div id="tech_concierge_collapse6" class="panel-collapse collapse">
						                    <div class="panel-body">
						                    	<div>
						                    		<div class="col-lg-2">Day</div>
						                    		<div class="col-lg-4"><input type="" name="" class="form-control datepicker"></div>
						                    		<div class="col-lg-3"><input type="" name="" class="form-control" placeholder="From hours"></div>
						                    		<div class="col-lg-3"><input type="" name="" class="form-control" placeholder="To hours"></div>
						                    	</div>
						                    	<div>
						                    		<div class="col-lg-2">Evening</div>
						                    		<div class="col-lg-4"><input type="" name="" class="form-control datepicker"></div>
						                    		<div class="col-lg-3"><input type="" name="" class="form-control" placeholder="From hours"></div>
						                    		<div class="col-lg-3"><input type="" name="" class="form-control" placeholder="To hours"></div>
						                    	</div>
						                    	<div>
						                    		<div class="col-lg-2">All Day</div>
						                    		<div class="col-lg-4"><input type="" name="" class="form-control datepicker"></div>
						                    		<div class="col-lg-3"><input type="" name="" class="form-control" placeholder="From hours"></div>
						                    		<div class="col-lg-3"><input type="" name="" class="form-control" placeholder="To hours"></div>
						                    	</div>
						                    </div>
						                </div>
						            </div>
						            <div class="panel panel-default">
						                <div class="panel-heading">
						                    <h4 class="panel-title">
						                        <a data-toggle="collapse" data-parent="#accordion_concierge" href="#tech_concierge_collapse7">Call me on</a>
						                    </h4>
						                </div>
						                <div id="tech_concierge_collapse7" class="panel-collapse collapse">
						                    <div class="panel-body">
						                        <input type="text" name="moving_house_callback_primary_no" class="form-control" placeholder="Primary Number">
						                        <input type="text" name="moving_house_callback_secondary_no" class="form-control" placeholder="Additional Number">
						                    </div>
						                </div>
						            </div>
						            <div class="panel panel-default">
						                <div class="panel-heading">
						                    <h4 class="panel-title">
						                        <a data-toggle="collapse" data-parent="#accordion_concierge" href="#tech_concierge_collapse8">Additional Information</a>
						                    </h4>
						                </div>
						                <div id="tech_concierge_collapse8" class="panel-collapse collapse">
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

		      		<!-- <div class="col-sm-9 col-md-9 col-lg-9" id="tech_concierge_step2" style="height: 300px; display: none;">
		      			<strong>Have you completed this task?</strong>
		      			<br>
		      			<div class="col-sm-6 col-md-6 col-lg-6">
		      				<button type="button" class="btn btn-primary btn_activity_user_response" data-dismiss="modal" data-activity="tech_concierge" id="1">Yes</button>
		      			</div>
		      			<div class="col-sm-6 col-md-6 col-lg-6">
		      				<button type="button" class="btn btn-primary btn_activity_user_response" data-dismiss="modal" data-activity="tech_concierge" id="0">No</button>
		      			</div>
		      		</div> -->

		      	</div>
		      	
		      	<div class="row">
		      		<div class="col-sm-8 col-md-8 col-lg-8">
		      			<div>
		      				<label>Is this helpful to you?</label>
		      				<a href="javascript:void(0);" id="1" data-activity="tech_concierge" class="activity_feedback">Yes</a>
		      				<a href="javascript:void(0);" id="0" data-activity="tech_concierge" class="activity_feedback">No</a>
		      			</div>
		      		</div>
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

<!-- Cable & Internet Service Modal -->
<div id="cable_internet_services_modal" class="modal fade">
    <div class="modal-dialog modal-lg">
    <!-- Modal content-->
	    <div class="modal-content">
	    	<div class="modal-body">
	      		<div class="close close-btn close_modal" data-activity="cable_internet_services" data-dismiss="modal"><img src="{{ url('/images/movers/close-img.png') }}" alt=""></div>
		      	<h2>Cable & Internet Service</h2>

		      	<div class="row">
		      		<div class="col-sm-3 col-md-3 col-lg-3">
	      				<div>
      						<img src="{{ url('/images/canada_post_logo.jpg') }}" alt="Udistro" />
      					</div>
      					<div>&nbsp;</div>
		      		</div>

		      		<div class="col-sm-9 col-md-9 col-lg-9" id="cable_internet_services_step1">
		      			<div>
      						<strong>Moving to a new neighborhood, and you need someone to clean your old apartment, or new house before you move in. Anything you need do on home cleaning service service starts here</strong>
      					</div>
      					<br>
      					<div>
      						<form name="frm_cable_internet_services" id="frm_cable_internet_services">
						        <div class="panel-group" id="accordion_internet_service">
						            <div class="panel panel-default">
						                <div class="panel-heading">
						                    <h4 class="panel-title">
						                        <a data-toggle="collapse" data-parent="#accordion_internet_service" href="#cable_internet_services_collapse1">Indicate type of cleaning</a>
						                    </h4>
						                </div>
						                <div id="cable_internet_services_collapse1" class="panel-collapse collapse in">
						                    <div class="panel-body">
						                        <div><label><input type="checkbox" name=""> Move in cleaning</label></div>
						                        <div><label><input type="checkbox" name=""> Move out cleaning</label></div>
						                    </div>
						                </div>
						            </div>
						            <div class="panel panel-default">
						                <div class="panel-heading">
						                    <h4 class="panel-title">
						                        <a data-toggle="collapse" data-parent="#accordion_internet_service" href="#cable_internet_services_collapse2">Moving From</a>
						                    </h4>
						                </div>
						                <div id="cable_internet_services_collapse2" class="panel-collapse collapse">
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
						                        <a data-toggle="collapse" data-parent="#accordion_internet_service" href="#cable_internet_services_collapse3">Moving To</a>
						                    </h4>
						                </div>
						                <div id="cable_internet_services_collapse3" class="panel-collapse collapse">
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
						                        <a data-toggle="collapse" data-parent="#accordion_internet_service" href="#cable_internet_services_collapse4">Detailed Job Description</a>
						                    </h4>
						                </div>
						                <div id="cable_internet_services_collapse4" class="panel-collapse collapse">
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
						                        <a data-toggle="collapse" data-parent="#accordion_internet_service" href="#cable_internet_services_collapse5">Additional Services</a>
						                    </h4>
						                </div>
						                <div id="cable_internet_services_collapse5" class="panel-collapse collapse">
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
						                        <a data-toggle="collapse" data-parent="#accordion_internet_service" href="#cable_internet_services_collapse6">Call Me On</a>
						                    </h4>
						                </div>
						                <div id="cable_internet_services_collapse6" class="panel-collapse collapse">
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
						                        <a data-toggle="collapse" data-parent="#accordion_internet_service" href="#cable_internet_services_collapse7">Additional Information (If Any)</a>
						                    </h4>
						                </div>
						                <div id="cable_internet_services_collapse7" class="panel-collapse collapse">
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

		      		<!-- <div class="col-sm-9 col-md-9 col-lg-9" id="cable_internet_services_step2" style="height: 300px; display: none;">
		      			<strong>Have you completed this task?</strong>
		      			<br>
		      			<div class="col-sm-6 col-md-6 col-lg-6">
		      				<button type="button" class="btn btn-primary btn_activity_user_response" data-dismiss="modal" data-activity="cable_internet_services" id="1">Yes</button>
		      			</div>
		      			<div class="col-sm-6 col-md-6 col-lg-6">
		      				<button type="button" class="btn btn-primary btn_activity_user_response" data-dismiss="modal" data-activity="cable_internet_services" id="0">No</button>
		      			</div>
		      		</div> -->

		      	</div>
		      	
		      	<div class="row">
		      		<div class="col-sm-8 col-md-8 col-lg-8">
		      			<div>
		      				<label>Is this helpful to you?</label>
		      				<a href="javascript:void(0);" id="1" data-activity="cable_internet_services" class="activity_feedback">Yes</a>
		      				<a href="javascript:void(0);" id="0" data-activity="cable_internet_services" class="activity_feedback">No</a>
		      			</div>
		      		</div>
		      		<div class="col-sm-4 col-md-4 col-lg-4">
		      			<a href="javascript:void(0);" id="btn_prev_cable_internet_services" class="btn">Previous</a>
		      			<a href="javascript:void(0);" id="btn_next_cable_internet_services" class="btn">Next</a>
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
		      		<div class="col-sm-8 col-md-8 col-lg-8">
		      			<ul class="comment-group">
							<li><a href="javascript:void(0);" class="agent_helpful"><i class="fa fa-thumbs-up" aria-hidden="true"></i><span class="agent_helpful_count">{{ $agentHelpfulCount }}</span> Helpful</a></li>
							<!-- <li><a href="javascript:void(0);"><i class="fa">2</i>Follow</a></li> -->
							<li><a href="javascript:void(0);" id="agent_rating_edit_message"><i class="fa fa-pencil" aria-hidden="true"></i>Edit Message</a></li>
						</ul>
		      		</div>
		      		<!-- <div class="col-sm-4 col-md-4 col-lg-4">&nbsp;</div> -->
		      		<div class="col-sm-4 col-md-4 col-lg-4">
		      			Share this on: 
		      			<a href="https://www.facebook.com/sharer/sharer.php?u=http://udistro.ca/" target="_blank"><i class="fa fa-facebook-square"></i></a>
		      			<a href="http://twitter.com/share?text=udistro&url=http://udistro.ca/&hashtags=udistro" target="_blank"><i class="fa fa fa-twitter-square"></i></a>
		      			<a href="https://www.linkedin.com/shareArticle?mini=true&url=http://udistro.ca/&title=udistro&summary=udistro" target="_blank"><i class="fa fa fa-linkedin-square"></i></a>
		      			<i class="fa fa fa-google-plus-square"></i>
		      		</div>
		      	</div>

		    </div>
		</div>
	</div>
</div>
<!-- Share Announcement Modal -->

<!-- To handle the modal close event -->
<!-- <div id="user_response_modal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Have you completed this task?</h4>
            </div>
            <div class="modal-body">
            	<form name="frm_activity_user_response" id="frm_activity_user_response">
	            	<input type="hidden" name="activity_name" id="activity_name" value="">

	                <button type="button" class="btn btn-primary activity_user_response" id="1" data-dismiss="modal">Yes</button>
	                <button type="button" class="btn btn-primary activity_user_response" id="0" data-dismiss="modal">No</button>
                </form>
            </div>
        </div>
    </div>
</div> -->

<div id="user_response_modal" class="modal fade">
    <div class="modal-dialog">
    <!-- Modal content-->
	    <div class="modal-content">
	    	<div class="modal-body">
	      		<div class="close close-btn close_modal" data-dismiss="modal"><img src="{{ url('/images/movers/close-img.png') }}" alt=""></div>
	      		<h4 class="modal-title">Have you completed this task?</h4>
		    </div>
		    <div class="modal-footer">
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

<!-- Form submit confirmation modal -->
<div id="confirmation_modal" class="modal fade">
    <div class="modal-dialog">
    <!-- Modal content-->
	    <div class="modal-content">
	    	<div class="modal-body">
	      		<div class="close close-btn" data-activity="share_announcement" data-dismiss="modal"><img src="{{ url('/images/movers/close-img.png') }}" alt=""></div>
	      		<div>
	      			Have you completed all the task?
	      		</div>
		    </div>
		    <div class="modal-footer">
				<button type="button" data-dismiss="modal" class="btn btn-primary" id="btn_confirmation">Yes</button>
				<button type="button" data-dismiss="modal" class="btn" id="btn_decline">No</button>
			</div>
		</div>
	</div>
</div>
<!-- Form submit confirmation modal -->

</body>
</html> 