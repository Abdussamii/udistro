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

<script type="text/javascript" src="{{ URL::asset('js/jquery-ui.min.js') }}"></script>

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
    // calculateRoute('{{ $clientMovingFromAddress->address1 }}', '{{ $clientMovingToAddress->address1 }}');

    // To manage the moving company details job description
    $('.collapse_moving_item_category').click(function(){

    	// If already open, don't do anything
    	let referId = $(this).attr('data-id');

    	if( !$('#'+referId).is(':visible') )
    	{
    		// Close all
    		$('.collapse_moving_item_container').slideUp();

    		// Open the current
    		$('#'+referId).slideDown();
    	}
    });

    // To manage the moving detailed job description selection functionality
    $('.show_selected_item_details').click(function(){
    	let itemCategoryId = $(this).attr('id');

    	$('#' + itemCategoryId + '.selected_item_details_container').toggle();
    });

    // To add the selected moving detailed job description to cart
    $('.add_item_to_selection').click(function(){

    	let movingItemCategoryId= $(this).closest('#moving_item_category_container').find('.moving_item_category').val();
    	let movingItemCategory 	= $(this).closest('#moving_item_category_container').find('.moving_item_category option:selected').text();
	    let quantity = $(this).closest('#moving_item_category_container').find('.moving_item_quantity').val();

    	if( movingItemCategoryId != '' && quantity != '' )
    	{
    		// Reset the selection
	    	$(this).closest('#moving_item_category_container').find('.moving_item_quantity').val('');
	    	$(this).closest('#moving_item_category_container').find('.moving_item_category').val('');

	    	// Create the html and add it
	    	var html = '<div class="selected_item_list"><input type="hidden" class="form-control" type="number" min="0" name="item_quantity['+ movingItemCategoryId +']" value="'+ quantity +'">';
	    	html += '<div>'+ movingItemCategory + ' - ' + quantity + ' <a href="javascript:void(0);" class="remove_item_from_list"><i class="fa fa-trash-o"></i></a></div></div>';

	    	$(this).closest('#moving_item_category_container').find('.selected_item_details_container').append(html);

	    	var itemCount = $(this).closest('#moving_item_category_container').find('.selected_item_details_container').find('.selected_item_list').length;

	    	$(this).closest('#moving_item_category_container').find('.show_selected_item_details').html('Cart ('+ itemCount +')');
    	}
    	else
    	{
    		if( movingItemCategoryId == '' )
    		{
    			alertify.error('Please select an option');
    			$(this).closest('#moving_item_category_container').find('.moving_item_category').focus();
    		}
    		else if( quantity == '' )
    		{
    			alertify.error('Please enter the weight');
    			$(this).closest('#moving_item_category_container').find('.moving_item_quantity').focus();
    		}
    	}

    });

    // To remove the moving detailed job description from cart
    $(document).on('click', '.remove_item_from_list', function(){

    	// Decrease the quantity from cart
    	var itemCount = $(this).closest('#moving_item_category_container').find('.selected_item_list').length - 1;

    	$(this).closest('#moving_item_category_container').find('.show_selected_item_details').html('Cart ('+ itemCount +')');

    	// Remove the list item
    	$(this).closest('.selected_item_list').remove();

    });
});

// To create route between two addresses
function calculateRoute(from, to) {
  // Center initialized
  // console.log( 'Moving from: ' + from + ', Moving to: ' + to );
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
        alertify.error('Unable to retrieve route map');
    }
  );
}
</script>

<style type="text/css">
.error {
	color: red;
}
/* For modal rating */
.red {
    color: #00bcea;
}
</style>
</head>

<body>
<!-- Navbar -->
<nav class="navbar navbar-inverse navbar-fixed-top" style="display:none;">
	<div class="container-fluid">
		<div class="navbar-header"> 
			<!-- Company image --> 
			<a class="navbar-brand" href="javascript:void(0)"> <img src="{{ url('/images/logo.png') }}" height="" width="" alt="Udistro" /> </a> 
		</div>
		<div class="nav navbar-nav navbar-right user-page">
			<div class="dropdown user-dropdown">
				<div class="user-short-name"> <span>{{ $clientInitials }}</span> </div>
				<button class="btnbg-none" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ ucwords( strtolower( $clientName ) ) }}<span class="caret"></span></button>
				<ul class="dropdown-menu" aria-labelledby="dLabel">
					<!-- <li> <a href="javascript:void(0);"><i class="fa fa-inbox" aria-hidden="true"></i> <span class="text">Inbox</span> </a> </li> -->
					<li> <a href="{{ url('/faqs') }}"><i class="fa fa-language" aria-hidden="true"></i> <span class="text">FAQ</span> </a> </li>
					<li> <a href="{{ url('/helpcenter') }}"><i class="fa fa-question-circle-o" aria-hidden="true"></i> <span class="text">Help Centre</span> </a> </li>
					<li> <a href="https://termsfeed.com/privacy-policy/78d745deeed0b145a84dbc4b46e88912"><i class="fa fa-key" aria-hidden="true"></i> <span class="text">Privacy</span> </a> </li>
					<li> <a href="{{ url('/logout') }}"> <i class="fa fa-power-off"></i> <span class="text">Logout</span> </a> </li>
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
			<div class="col-sm-8 col-md-8">
				<div class="contry-name">
					<h2>{{ ucwords( strtolower( $clientMovingToProvince->abbreviation ) ) }}</h2>
					<span>{{ ucwords( strtolower( $clientMovingToProvince->name ) ) }}</span>
				</div>
			</div>
			<div class="col-xs-12 col-sm-4 col-md-4"> 
				<!-- Google map here -->
				<div class="map-area" id="map" style="overflow: hidden; border-radius: 0;"> </div>
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
			<div class="col-md-12"> <h1 class="mover-steps-head">Moving Recommended Steps</h1></div>
			<!--<div class="col-md-10 col-md-offset-1">-->
			<div class="col-md-12">
				<?php
				if( isset( $activities ) && count( $activities ) > 0 )
				{
					foreach ($activities as $activity)
					{
					?>
						<div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-4 col-sm-600">
							<div class="boxes" data-toggle="tooltip" data-placement="{{ $activity->tooltip_position }}" title="{{ $activity->tooltip_data }}">
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
											<a href="javascript:void(0);" title="{{ ( $completed != '' ) ? 'Activity Completed' : 'Get started' }}" id="{{ $activity->id }}" class="{{ $activity->activity_class }} done_activity{{ ( $completed == '1' ) ? ' completed' : '' }}">
												<i class="{{ $icon1 }}" aria-hidden="true"></i>
											</a>
										</li>
										<li><a href="javascript:void(0);" title="Do it later" class="later_activity"><i class="fa fa-history" aria-hidden="true"></i></a></li>
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
		<div class="">
			<div class="col-xs-12 col-sm-6 col-md-4">
				<div class="user-name-review">
					<div class="user-short-name">
						<span>{{ $agentInitials }}</span>
						<p>{{ $agentName }}</p>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-8">
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
					<!-- <span id="agent_average_rating">( {{ $agentRating or 0 }} Rating )</span> -->
				</div>
			</div>
		</div>
	</div>
	<div class="comment-section">
		<form name="frm_agent_feedback" id="frm_agent_feedback" autocomplete="off">
			<div class="row">
				<div class="col-md-12">
					<div class="comment-area">
						<h2>Hi {{ $agentName }},</h2>
						<p id="agent_rating_message_container">
							I appreciate your work and want to say thank you.
						</p>
						<textarea name="agent_rating_message" id="agent_rating_message" class="form-control" style="display: none;">Hi {{ $agentName }},I appreciate your work and want to say thank you.</textarea>
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
					<div class="col-sm-12 box-H-250 box-P-100" id="forward_mail_step1">
						<div class="row">
							<div class="col-sm-12">
								<p>Moving or relocating to a new address? Ensure all your mail follow you to your new address. Letter mail, Registered Mail, and Magazines addressed to your old address will be delivered to the new address..</p>
							</div>
						</div>
						<div class="clearfix"></div>
						
						<div class="row">
							<div class="col-sm-12">
								<div class="get_started_LB">
									<a href="javascript:void(0);" id="forward_mail_method1" style="width: 250px; text-align: center;">Do it here online</a>
									<a href="javascript:void(0);" id="forward_mail_method2" style="width: 250px; text-align: center;">Do it at Canada post office</a>
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-12 box-H-250 box-P-100" id="forward_mail_step2" style="display: none;">
						<div class="row">
							<div class="col-sm-12">
								<p> When you buy a Mail Forwarding before you moves, with your permission, Canada Post will share your updated address information with companies who have an existing relationship with you and who are subscribed to Canada post NCOA Mover Data Service. Choose the 12-month service for the most convenience and savings.
								</p>
							</div>
						</div>
						<div class="get_started_LB"> <a href="javascript:void(0);" onclick="window.open('https://www.canadapost.ca/web/en/products/details.page?article=forward_your_mail_wh', '_blank', 'location=yes,height=800,width=1000,scrollbars=yes,status=yes');">Click here to get started</a>
						</div>
					</div>
					<div class="col-sm-12 box-H-250 box-P-100" id="forward_mail_step3" style="display: none;">
						<div class="row">
							<div class="col-sm-12">
								<p>Search Canada post office closest to you</p>
							</div>
						</div>
						<div>
							<form name="frm_forward_mail_search_postoffices" id="frm_forward_mail_search_postoffices" autocomplete="off">
								<div class="col-sm-9 col-md-9 col-lg-9 row">
									<input type="text" name="forward_mail_search_postoffices_address" id="forward_mail_search_postoffices_address" class="form-control" placeholder="Search for Canada post office" value="{{ $clientMovingFromProvince->name }}">
								</div>
								<div class="col-sm-3 col-md-3 col-lg-3 row"> 
									<!-- <input type="button" name="" id="" class="btn" value="Go"> --> 
									<a href="javascript:void(0);" onclick="" id="forward_mail_search_postoffice">Go</a>
								</div>
							</form>
						</div>
					</div>
				</div>

				<div class="row" id="forward_mail_flow_control" style="display: none;">
					<div class="col-sm-8 col-md-8 col-lg-8">&nbsp;</div>
					<div class="col-sm-4 col-md-4 col-lg-4 text-right">
						<a href="javascript:void(0);" class="btn btn_prev_forward_mail"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Back</a>
					</div>
				</div>

			</div>
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
      <div class="col-sm-12 box-H-250 box-P-100">
       <div class="row">
        <div class="col-sm-12">
         <p>Parcels, prepaid envelopes, and government mailers are excluded from Canada Post Mail Forward Service. If you are expecting any of these deliveries, you must advise the sender(s) of your new address.</p>
        </div>
        <div class="clearfix"></div>
        <div class="col-sm-12">
		<div class="get_started_LB">
			<a href="javascript:void(0);" id="update_address_agency1" style="width: 200px;">Federal Agency</a>
			<a href="javascript:void(0);" id="update_address_agency2" style="width: 200px;">Provincial Agencies</a>
		</div>
        </div>
        <div class="clearfix"></div>
       </div>
      </div>
     </div>

 	<div class="model-WrapCont" id="update_address_step3" style="display: none;"> 
	       <!-- HSA 1 -->
	      	<div class="model-WrapCont">
	       		<h2>Update Address</h2>
	      	</div>
	      		<div class="col-sm-12 box-H-250 box-P-100">
				  <div class="panel-group provincial_health_agencies" id="provincial_health_agencies1">
				  	<div class="panel panel-default">
				  	  <div class="panel-heading">
				  	    <h4 class="panel-title">
				  	      <a data-toggle="collapse" data-parent="#provincial_health_agencies1" href="#collapse_revenew">Canada Revenue Agency</a>
				  	    </h4>
				  	  </div>
				  	  <div id="collapse_revenew" class="panel-collapse collapse">
				  	    <div class="panel-body">
				  	    	<div class="panel-group" id="accordion_provincial_health_agencies">
				  	    	    <div class="panel panel-default">
				  	    	        <div class="panel-heading">
				  	    	            <h4 class="panel-title">
				  	    	                <a data-toggle="collapse" data-parent="#accordion_provincial_health_agencies" href="#provincial_health_agencies_collapse1" aria-expanded="false" class="collapsed">Do it Online</a>
				  	    	            </h4>
				  	    	        </div>
				  	    	        <div id="provincial_health_agencies_collapse1" class="panel-collapse collapse" aria-expanded="false">
				  	    	            <div class="panel-body">
				  	    					<div class="get_started_LB">
				  	    						<a href="javascript:void(0);" onclick="window.open('https://www.canada.ca/en/revenue-agency/services/e-services/e-services-individuals/account-individuals.html', '_blank', 'location=yes,height=800,width=1000,scrollbars=yes,status=yes');">Click here to get started</a>
				  	    					</div>
				  	    	            </div>
				  	    	        </div>
				  	    	    </div>
				  	    	    <div class="panel panel-default">
				  	    	        <div class="panel-heading">
				  	    	            <h4 class="panel-title">
				  	    	                <a data-toggle="collapse" data-parent="#accordion_provincial_health_agencies" href="#provincial_health_agencies_collapse2" class="collapsed" aria-expanded="false">Call Option</a>
				  	    	            </h4>
				  	    	        </div>
				  	    	        <div id="provincial_health_agencies_collapse2" class="panel-collapse collapse" aria-expanded="false">
				  	    	            <div class="panel-body">
				  	    	                <div class="col-md-12">
				  	    	                	<div class="block-head">
				  	    	                		<h3>Have these handy, before this call </h3>
				  	    	                	</div>
				  	    	                	<div class="up_add_li">
				  	    	                		<ul>
				  	    	                			<li class="col-sm-6"><i class="fa fa-angle-right" aria-hidden="true"></i> Your full name</li>
				  	    	                			<li class="col-sm-6"><i class="fa fa-angle-right" aria-hidden="true"></i> Old and new address</li>
				  	    	                			<li class="col-sm-6"><i class="fa fa-angle-right" aria-hidden="true"></i> Old and new postal codes</li>
				  	    	                			<li class="col-sm-6"><i class="fa fa-angle-right" aria-hidden="true"></i> Your SIN#</li>
				  	    	                			<li class="col-sm-6"><i class="fa fa-angle-right" aria-hidden="true"></i> Phone contact, name and DOB of children</li>
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
				  	    	</div>
				  		</div>
				  	  </div>
				  	</div>
				  </div>
				</div>
	      </div>

    <div class="model-WrapCont" id="update_address_step6" style="display: none;"> 
       <!-- HSA 1 -->
      	<div class="model-WrapCont">
       		<h2>Update Address</h2>
      	</div>
      		<div class="col-sm-12 box-H-250 box-P-100">
			  <div class="panel-group provincial_health_agencies" id="provincial_health_agencies2">
			  	<?php
			  	$step = 1;
			  	if( isset( $provincialAgencyDetails ) && count( $provincialAgencyDetails ) > 0 )
			  	{
			  		foreach ($provincialAgencyDetails as $provincialAgency)
			  		{
			  		?>
			  			<div class="panel panel-default">
			  			  <div class="panel-heading">
			  			    <h4 class="panel-title">
			  			      <a data-toggle="collapse" data-parent="#provincial_health_agencies2" href="#collapse{{ $step }}">{{ ucwords( strtolower( $provincialAgency->agency_name ) ) }}</a>
			  			    </h4>
			  			  </div>
			  			  <div id="collapse{{ $step }}" class="panel-collapse collapse {{ ( $step == 1 ) ? '' : '' }}">
			  			    <div class="panel-body">

			  			    	<div class="panel-group" id="accordion_internet_service_{{ $step }}">
			  			    	    <div class="panel panel-default">
			  			    	        <div class="panel-heading tab-new01">
			  			    	            <h4 class="panel-title">
			  			    	                <a data-toggle="collapse" data-parent="#accordion_internet_service_{{ $step }}" href="#cable_internet_services_collapse1{{ $step }}" aria-expanded="false" class="collapsed">{{ $provincialAgency->do_it_on_line_label }}</a>
			  			    	            </h4>
			  			    	        </div>
			  			    	        <div id="cable_internet_services_collapse1{{ $step }}" class="panel-collapse collapse in" aria-expanded="false">
			  			    	            <div class="panel-body">
			  			    					<!-- <div>
			  			    						<?php
			  			    						if( $provincialAgency->logo != '' )
			  			    						{
			  			    							echo '<img src="'. url('/images/provincial_agencies/' . $provincialAgency->logo) .'" height="100" width="100" alt="Udistro" />';
			  			    						}
			  			    						else
			  			    						{
			  			    							echo '<img src="'. url('/images/udistro-logo-pop.jpg') .'" alt="Udistro" />';
			  			    						}
			  			    						?>
			  			    					</div> -->
			  			    					<div>
			  			    						<?php
			  			    						// Check if it is a direct link or a search functionality
			  			    						if( $provincialAgency->direct_link == '1' )
			  			    						{
			  			    							if( $provincialAgency->link != '' )
			  			    							{
			  			    							?>
			  			    								<div class="get_started_LB blue-btn01">
			  			    									<a href="javascript:void(0);" onclick="window.open('{{ $provincialAgency->link }}', 'location=yes,height=800,width=1000,scrollbars=yes,status=yes');">{{ $provincialAgency->get_started_label }}</a>
			  			    								</div>
			  			    							<?php
			  			    							}
			  			    						}
			  			    						else
			  			    						{
			  			    						?>
			  			    							<div class="get_started_LB">
			  			    								<div class="row">
			  			    									<div class="col-sm-12">
			  			    										<p>Search the closest {{ $clientMovingToProvince->name }} public insurance office</p>
			  			    									</div>
			  			    								</div>
			  			    								<div>
			  			    									<form name="frm_update_address_search_insurance_office" id="frm_update_address_search_insurance_office" autocomplete="off">
			  			    										<div class="col-sm-9 col-md-9 col-lg-9 row">
			  			    											<input type="text" name="update_address_search_insurance_office" id="update_address_search_insurance_office" class="form-control" placeholder="Enter the address">
			  			    										</div>
			  			    										<div class="col-sm-3 col-md-3 col-lg-3"> 
			  			    											<!-- <input type="button" name="" id="" class="btn" value="Go"> --> 
			  			    											<a href="javascript:void(0);" onclick="" id="{{ $clientMovingToProvince->name }}" class="btn_update_address_search_insurance_office">Go</a>
			  			    										</div>
			  			    									</form>
			  			    								</div>
			  			    							</div>
			  			    						<?php
			  			    						}
			  			    						?>
			  			    					</div>
			  			    	            </div>
			  			    	        </div>
			  			    	    </div>
			  			    	    <div class="panel panel-default">
			  			    	        <div class="panel-heading tab-new01">
			  			    	            <h4 class="panel-title">
			  			    	                <a data-toggle="collapse" data-parent="#accordion_internet_service" href="#cable_internet_services_collapse2{{ $step }}" class="collapsed" aria-expanded="false">Call Option</a>
			  			    	            </h4>
			  			    	        </div>
			  			    	        <div id="cable_internet_services_collapse2{{ $step }}" class="panel-collapse collapse" aria-expanded="false">
			  			    	            <div class="panel-body">
			  			    	                
			  			    	                <div class="col-md-12">
			  			    	                	<div class="block-head">
			  			    	                		<h3>Have these handy, before this call </h3>
			  			    	                	</div>
			  			    	                	<div class="up_add_li">
			  			    	                		<ul>
			  			    	                		<?php
			  			    	                		echo ( $provincialAgency->label1 != '' ) ? '<li class="col-sm-6"><i class="fa fa-angle-right" aria-hidden="true"></i>' . $provincialAgency->label1 . '</li>' : '';
			  			    	                		echo ( $provincialAgency->label2 != '' ) ? '<li class="col-sm-6"><i class="fa fa-angle-right" aria-hidden="true"></i>' . $provincialAgency->label2 . '</li>' : '';
			  			    	                		echo ( $provincialAgency->label3 != '' ) ? '<li class="col-sm-6"><i class="fa fa-angle-right" aria-hidden="true"></i>' . $provincialAgency->label3 . '</li>' : '';
			  			    	                		echo ( $provincialAgency->label4 != '' ) ? '<li class="col-sm-6"><i class="fa fa-angle-right" aria-hidden="true"></i>' . $provincialAgency->label4 . '</li>' : '';
			  			    	                		echo ( $provincialAgency->label5 != '' ) ? '<li class="col-sm-6"><i class="fa fa-angle-right" aria-hidden="true"></i>' . $provincialAgency->label5 . '</li>' : '';
			  			    	                		echo ( $provincialAgency->label6 != '' ) ? '<li class="col-sm-6"><i class="fa fa-angle-right" aria-hidden="true"></i>' . $provincialAgency->label6 . '</li>' : '';
			  			    	                		echo ( $provincialAgency->label7 != '' ) ? '<li class="col-sm-6"><i class="fa fa-angle-right" aria-hidden="true"></i>' . $provincialAgency->label7 . '</li>' : '';
			  			    	                		echo ( $provincialAgency->label8 != '' ) ? '<li class="col-sm-6"><i class="fa fa-angle-right" aria-hidden="true"></i>' . $provincialAgency->label8 . '</li>' : '';
			  			    	                		echo ( $provincialAgency->label9 != '' ) ? '<li class="col-sm-6"><i class="fa fa-angle-right" aria-hidden="true"></i>' . $provincialAgency->label9 . '</li>' : '';
			  			    	                		echo ( $provincialAgency->label10 != '' ) ? '<li class="col-sm-6"><i class="fa fa-angle-right" aria-hidden="true"></i>' . $provincialAgency->label10 . '</li>' : '';
			  			    	                		?>
			  			    	                		</ul>
			  			    	                	</div>
			  			    	                </div>
			  			    	                <div class="col-sm-12 col-md-6 col-lg-6">
			  			    	                	<div class="block-head">
			  			    	                		<h3> Opening Hours </h3>
			  			    	                	</div>
			  			    	                	<div class="up_add_li">
			  			    	                		<ul>
			  			    	                			<li>
			  			    	                				<span>{{ ( $provincialAgency->heading1 != '' ) ? $provincialAgency->heading1 : '' }}</span><i class="fa fa-clock-o" aria-hidden="true"></i>{{ ( $provincialAgency->detail1 != '' ) ? $provincialAgency->detail1 : '' }}
			  			    	                			</li>
			  			    	                			<li>
			  			    	                				<span>{{ ( $provincialAgency->heading2 != '' ) ? $provincialAgency->heading1 : '' }}</span><i class="fa fa-clock-o" aria-hidden="true"></i>{{ ( $provincialAgency->detail2 != '' ) ? $provincialAgency->detail2 : '' }}
			  			    	                			</li>
			  			    	                		</ul>
			  			    	                	</div>
			  			    	                </div>
			  			    	                <div class="col-sm-12 col-md-6 col-lg-6">
			  			    	                	<div class="block-head">
			  			    	                		<h3> Phone Numbers </h3>
			  			    	                	</div>
			  			    	                	<div class="up_add_li">
			  			    	                		<ul>
			  			    	                			<li>
			  			    	                				<span>{{ ( $provincialAgency->heading3 != '' ) ? $provincialAgency->heading3 : '' }}</span><i class="fa fa-phone" aria-hidden="true"></i>{{ ( $provincialAgency->detail3 != '' ) ? $provincialAgency->detail3 : '' }}
			  			    	                			</li>
			  			    	                			<li>
			  			    	                				<span>{{ ( $provincialAgency->heading4 != '' ) ? $provincialAgency->heading4 : '' }}</span><i class="fa fa-phone" aria-hidden="true"></i>{{ ( $provincialAgency->detail4 != '' ) ? $provincialAgency->detail4 : '' }}
			  			    	                			</li>
			  			    	                		</ul>
			  			    	                	</div>
			  			    	                </div>

			  			    	            </div>
			  			    	        </div>
			  			    	    </div>
			  			    	</div>

			  				</div>
			  			  </div>
			  			</div>
			  		<?php
			  			$step++;
			  		}
			  	}
			  	?>
			  </div>

			</div>
      </div>

      <div class="pull-right" style="display: none;" id="update_address_control">
	  	<a href="javascript:void(0);" class="btn btn_prev_update_address"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Back</a>
	  </div>

    </div>
   </div>
  </div>
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
     <div class="col-sm-12 box-H-250 box-P-100" id="mailbox_keys_step1">
      <div class="row">
       <div class="col-sm-12">
        <p>If you have just moved to a new residence where you will receive mail at a community mailbox, complete the online form to request new keys. You will receive a notice-card when your keys are ready.</p>
       </div>
      </div>
      <div class="clearfix"></div>
      <div class="col-sm-12 mailfarwd_wrap_radio">

       <div class="get_started_LB">
			<a href="javascript:void(0);" id="mailbox_keys_method2" style="width: 250px; text-align: center;">Do it here online</a>
			<a href="javascript:void(0);" id="mailbox_keys_method1" style="width: 250px; text-align: center;">Do it at Canada post office</a>
		</div>

      </div>
     </div>
     <div class="col-sm-12 box-H-250 box-P-100" id="mailbox_keys_step2" style="display: none;">
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
     <div class="col-sm-12 box-H-250 box-P-100" id="mailbox_keys_step3" style="display: none;">
      <div class="row">
       <div class="col-sm-12">
        <p>Click the link below, you we will able to submit service request form to Canada post. They will leave a Delivery Notice Card on your front door indicating the location of the post office where you can pick up your keys.</p>
       </div>
      </div>
      <div class="get_started_LB"><a href="javascript:void(0);" onclick="window.open('https://www.canadapost.ca/cpo/mc/app/cmb/existing_state.jsf', '_blank', 'location=yes,height=800,width=1000,scrollbars=yes,status=yes');">Click here to get started</a></div>
     </div>
    </div>
    <div class="row" style="display:none;">
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

   	<div class="row" id="mailbox_keys_flow_control" style="display: none;">
     	<div class="col-sm-8 col-md-8 col-lg-8">&nbsp;</div>
     	<div class="col-sm-4 col-md-4 col-lg-4 text-right">
     		<a href="javascript:void(0);" id="btn_prev_mailbox_keys" class="btn"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Back</a> 
     	</div>
    </div>

   </div>
  </div>
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
    <div class="row">
	<!-- model box 1 starts -->
    <div id="connect_utilities_step1" class="model-WrapCont">
     <h2>Connect Utilities</h2>
     <div class="col-sm-12 box-H-250 box-P-100">
      <div class="row">
       <div class="col-sm-12">
        <p>If you are moving or relocating to a new address, you need a utility account at your new address. Set up water or waste account, get the city to deliver you recycle cart before you move in.</p>
       </div>
      </div>
      <div class="clearfix"></div>
      
      	<div class="get_started_LB">
			<a href="javascript:void(0);" id="connect_utility_agency1" style="width: 220px;">Manitoba Hydro</a>
			<a href="javascript:void(0);" id="connect_utility_agency2" style="width: 220px;">Water, Waste and Bin</a>
		</div>

     </div>
    </div>
	<!-- model box 1 ends -->

    <div id="connect_utilities_step3" class="model-WrapCont">
    	<h2>Connect Utilities</h2>
    	<div class="col-sm-12 box-H-250 box-P-100">
    		<p> Hydro, Electricity and Gas</p>
	    	<div class="panel-group" id="connect_utility_hydro_collapse">
	    	    <div class="panel panel-default">
	    	        <div class="panel-heading">
	    	            <h4 class="panel-title">
	    	                <a data-toggle="collapse" data-parent="#connect_utility_hydro_collapse" href="#connect_utility_hydro1" aria-expanded="false" class="collapsed">Do it Online</a>
	    	            </h4>
	    	        </div>
	    	        <div id="connect_utility_hydro1" class="panel-collapse collapse" aria-expanded="false">
	    	            <div class="panel-body">
	    					<div class="get_started_LB">      			
			        			<a href="javascript:void(0);" onclick="window.open('https://www.hydro.mb.ca/custmoves/main.jsf', '_blank', 'location=yes,height=800,width=1000,scrollbars=yes,status=yes');">Click here to get started</a>
			        		</div>
	    	            </div>
	    	        </div>
	    	    </div>
	    	    <div class="panel panel-default">
	    	        <div class="panel-heading">
	    	            <h4 class="panel-title">
	    	                <a data-toggle="collapse" data-parent="#connect_utility_hydro_collapse" href="#connect_utility_hydro2" class="collapsed" aria-expanded="false">Call Option</a>
	    	            </h4>
	    	        </div>
	    	        <div id="connect_utility_hydro2" class="panel-collapse collapse" aria-expanded="false">
	    	            <div class="panel-body">
							<div class="col-md-12">
								<div class="block-head">
									<h3> Have these handy, before this call </h3>
								</div>
								<div class="up_add_li">
									<ul>
										<li><i class="fa fa-angle-right" aria-hidden="true"></i> Your full name</li>
										<li><i class="fa fa-angle-right" aria-hidden="true"></i> Old and new address</li>
										<li><i class="fa fa-angle-right" aria-hidden="true"></i> Old and new postal codes</li>
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
										<li><span>Inside of Canada:</span> <i class="fa fa-phone" aria-hidden="true"></i> 1-866-607-6301</li>
										<li><span>Outside of Canada:</span> <i class="fa fa-phone" aria-hidden="true"></i> 416-979-3033</li>
									</ul>
								</div>
							</div>
	    	            </div>
	    	        </div>
	    	    </div>
	    	</div>
    	</div>
    </div>
	<!-- model box 3 ends -->

    <div id="connect_utilities_step5" class="model-WrapCont">
     	<h2>Connect Utilities</h2>
     	<div class="col-sm-12 box-H-250 box-P-100">
	     	<div> <strong>Water, Waste and Recycle Bins</strong>
	       		<p>If you are moving in or moving out, and are financially responsible for Water, waste, or recycle at your new address, you need to open and account:</p>
	      	</div>
	    	<div class="panel-group" id="connect_utility_water_collapse">
	    	    <div class="panel panel-default">
	    	        <div class="panel-heading">
	    	            <h4 class="panel-title">
	    	                <a data-toggle="collapse" data-parent="#connect_utility_water_collapse" href="#connect_utility_water1" aria-expanded="false" class="collapsed">Do it Online</a>
	    	            </h4>
	    	        </div>
	    	        <div id="connect_utility_water1" class="panel-collapse collapse" aria-expanded="false">
	    	            <div class="panel-body">
	    					<div class="get_started_LB">
	      						<a href="javascript:void(0);" onclick="window.open('https://www.hydro.mb.ca/custmoves/main.jsf', '_blank', 'location=yes,height=800,width=1000,scrollbars=yes,status=yes');">Click here to get started</a>
	      					</div>
	    	            </div>
	    	        </div>
	    	    </div>
	    	    <div class="panel panel-default">
	    	        <div class="panel-heading">
	    	            <h4 class="panel-title">
	    	                <a data-toggle="collapse" data-parent="#connect_utility_water_collapse" href="#connect_utility_water2" class="collapsed" aria-expanded="false">Call Option</a>
	    	            </h4>
	    	        </div>
	    	        <div id="connect_utility_water2" class="panel-collapse collapse" aria-expanded="false">
	    	            <div class="panel-body">
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
	    	    </div>
	    	</div>
	    </div>
    </div>
	<!-- model box 5 ends -->

    </div>
    <div class="row">
    	<div class="col-sm-8 col-md-8 col-lg-8">&nbsp;</div>

     	<div class="pull-right" id="connect_utilities_control" style="display: none;">
			<a href="javascript:void(0);" class="btn btn_prev_connect_utilities"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Back</a>
		</div>
    </div>
   </div>
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

		      	<div class="row">
					<div class="model-WrapCont">
					 <h2>Home Cleaning Services</h2>
					 </div>
		      		<div class="col-sm-12 box-P-100" id="home_cleaning_services_step1">
					<div class="row">
		      			<div class="col-sm-12">
      						<p>If you are moving out of your home or an apartment, you need to hire a move out cleaner. On uDistro, home cleaning service companies will provide you with no obligation quotes within 24 hours.</p>
      					</div>
						<div class="clearfix"></div>
      					<div class="col-sm-12">
      						<form name="frm_home_cleaning_services" id="frm_home_cleaning_services">
						        <div class="panel-group" id="accordion">

						        	<input type="hidden" value="{{ $clientMovingFromAddress->moving_from_house_type }}" name="home_cleaning_house_from_type" id="home_cleaning_house_from_type">
						        	<input type="hidden" value="{{ $clientMovingFromAddress->moving_from_floor }}" name="home_cleaning_house_from_level" id="home_cleaning_house_from_level">
						        	<input type="hidden" value="{{ $clientMovingFromAddress->moving_from_bedroom_count }}" name="home_cleaning_house_from_bedroom_count" id="home_cleaning_house_from_bedroom_count">
						        	<input type="hidden" value="{{ $clientMovingFromAddress->moving_from_property_type }}" name="home_cleaning_house_from_property_type" id="home_cleaning_house_from_property_type">

						        	<input type="hidden" value="{{ $clientMovingToAddress->moving_to_house_type }}" name="home_cleaning_house_to_type" id="home_cleaning_house_to_type">
						        	<input type="hidden" value="{{ $clientMovingToAddress->moving_to_floor }}" name="home_cleaning_house_to_level" id="home_cleaning_house_to_level">
						        	<input type="hidden" value="{{ $clientMovingToAddress->moving_to_bedroom_count }}" name="home_cleaning_house_to_bedroom_count" id="home_cleaning_house_to_bedroom_count">
						        	<input type="hidden" value="{{ $clientMovingToAddress->moving_to_property_type }}" name="home_cleaning_house_to_property_type" id="home_cleaning_house_to_property_type">

						            <!-- <div class="panel panel-default">
						                <div class="panel-heading">
						                    <h4 class="panel-title">
						                        <a data-toggle="collapse" data-parent="#accordion" href="#home_cleaning_services_collapse2">Moving From</a>
						                    </h4>
						                </div>
						                <div id="home_cleaning_services_collapse2" class="panel-collapse collapse in">
						                    <div class="panel-body">
						                    	<div class="form-group panel-Box">
						                        	<div class="accord-title">Move out cleaning</div>
						                        	<label class="form-group accord-radio"><input type="radio" name="home_cleaning_moveout" value="1">Yes</label>
						                        	<label class="form-group accord-radio"><input type="radio" name="home_cleaning_moveout" value="0">No</label>
						                        	<div class="clean-error"><label id="home_cleaning_moveout-error" class="error" for="home_cleaning_moveout"></label></div>
						                        </div>
						                        <div class="form-group panel-Box">
						                        	<div class="accord-title">Type</div>
						                        	<select class="form-control" name="home_cleaning_house_from_type" id="home_cleaning_house_from_type">
						                        		<option value="">Select</option>
						                        		<option value="house">House</option>
						                        		<option value="apartment/flat">Apartment/Flat</option>
						                        		<option value="condo">Condo</option>
						                        		<option value="studio">Studio</option>
						                        	</select>
						                        </div>
						                        <div class="form-group panel-Box">
						                        	<div class="accord-title">Floor Level</div>
						                        	<label class="form-group accord-radio"><input type="radio" name="home_cleaning_house_from_level" value="1">1</label>
						                        	<label class="form-group accord-radio"><input type="radio" name="home_cleaning_house_from_level" value="2">2</label>
						                        	<label class="form-group accord-radio"><input type="radio" name="home_cleaning_house_from_level" value="3">3</label>
						                        	<label class="form-group accord-radio"><input type="radio" name="home_cleaning_house_from_level" value="4+">4 or more</label>
						                        	<div class="clean-error"><label id="home_cleaning_house_from_level-error" class="error" for="home_cleaning_house_from_level"></label></div>
						                        </div>
						                        <div class="form-group panel-Box">
						                        	<div class="accord-title">No of bedrooms</div>
						                        	<label class="form-group accord-radio"><input type="radio" name="home_cleaning_house_from_bedroom_count" value="1">1</label>
						                        	<label class="form-group accord-radio"><input type="radio" name="home_cleaning_house_from_bedroom_count" value="2">2</label>
						                        	<label class="form-group accord-radio"><input type="radio" name="home_cleaning_house_from_bedroom_count" value="3">3</label>
						                        	<label class="form-group accord-radio"><input type="radio" name="home_cleaning_house_from_bedroom_count" value="4+">4 or more</label>
						                        	<div class="clean-error"><label id="home_cleaning_house_from_bedroom_count-error" class="error" for="home_cleaning_house_from_bedroom_count"></label></div>
						                        </div>
						                        <div class="form-group panel-Box">
						                        	<div class="accord-title">Did you own or rent this property</div>
						                        	<label class="form-group accord-radio"><input type="radio" name="home_cleaning_house_from_property_type" value="own">Own</label>
						                        	<label class="form-group accord-radio"><input type="radio" name="home_cleaning_house_from_property_type" value="rent">Rent</label>
						                        	<div class="clean-error"><label id="home_cleaning_house_from_property_type-error" class="error" for="home_cleaning_house_from_property_type"></label></div>
						                        </div>
						                    </div>
						                </div>
						            </div> -->
						            <!-- <div class="panel panel-default">
						                <div class="panel-heading">
						                    <h4 class="panel-title">
						                        <a data-toggle="collapse" data-parent="#accordion" href="#home_cleaning_services_collapse3">Moving To</a>
						                    </h4>
						                </div>
						                <div id="home_cleaning_services_collapse3" class="panel-collapse collapse">
						                    <div class="panel-body">
						                    	<div class="form-group panel-Box">
						                        	<div class="accord-title">Move in cleaning</div>
						                        	<label class="form-group accord-radio"><input type="radio" name="home_cleaning_movein" value="1">Yes</label>
						                        	<label class="form-group accord-radio"><input type="radio" name="home_cleaning_movein" value="0">No</label>
						                        	<div class="clean-error"><label id="home_cleaning_movein-error" class="error" for="home_cleaning_movein"></label></div>
						                        </div>
						                        <div class="form-group panel-Box">
						                        	<div class="accord-title">Type</div>
						                        	<select class="form-control" name="home_cleaning_house_to_type" id="home_cleaning_house_to_type">
						                        		<option value="">Select</option>
						                        		<option value="house">House</option>
						                        		<option value="apartment/flat">Apartment/Flat</option>
						                        		<option value="condo">Condo</option>
						                        		<option value="studio">Studio</option>
						                        	</select>
						                        </div>
						                        <div class="form-group panel-Box">
						                        	<div class="accord-title">Floor Level</div>
						                        	<label class="form-group accord-radio"><input type="radio" name="home_cleaning_house_to_level" value="1">1</label>
						                        	<label class="form-group accord-radio"><input type="radio" name="home_cleaning_house_to_level" value="2">2</label>
						                        	<label class="form-group accord-radio"><input type="radio" name="home_cleaning_house_to_level" value="3">3</label>
						                        	<label class="form-group accord-radio"><input type="radio" name="home_cleaning_house_to_level" value="4+">4 or more</label>
						                        	<div class="clean-error"><label id="home_cleaning_house_to_level-error" class="error" for="home_cleaning_house_to_level"></label></div>
						                        </div>
						                        <div class="form-group panel-Box">
						                        	<div class="accord-title">No of bedrooms</div>
						                        	<label class="accord-radio"><input type="radio" name="home_cleaning_house_to_bedroom_count" value="1">1</label>
						                        	<label class="accord-radio"><input type="radio" name="home_cleaning_house_to_bedroom_count" value="2">2</label>
						                        	<label class="accord-radio"><input type="radio" name="home_cleaning_house_to_bedroom_count" value="3">3</label>
						                        	<label class="accord-radio"><input type="radio" name="home_cleaning_house_to_bedroom_count" value="4+">4 or more</label>
						                        	<div class="clean-error"><label id="home_cleaning_house_to_bedroom_count-error" class="error" for="home_cleaning_house_to_bedroom_count"></label></div>
						                        </div>
						                        <div class="form-group panel-Box">
						                        	<div class="accord-title">Did you own or rent this property</div>
						                        	<label class="accord-radio"><input type="radio" name="home_cleaning_house_to_property_type" value="own">Own</label>
						                        	<label class="accord-radio"><input type="radio" name="home_cleaning_house_to_property_type" value="rent">Rent</label>
						                        	<div class="clean-error"><label id="home_cleaning_house_to_property_type-error" class="error" for="home_cleaning_house_to_property_type"></label></div>
						                        </div>
						                    </div>
						                </div>
						            </div> -->
						            <div class="panel panel-default">
						                <div class="panel-heading">
						                    <h4 class="panel-title">
						                        <a data-toggle="collapse" data-parent="#accordion" href="#home_cleaning_services_collapse4">Detailed Job Description</a>
						                    </h4>
						                </div>
						                <div id="home_cleaning_services_collapse4" class="panel-collapse collapse">
						                    <div class="panel-body">
						                        <div class="form-group panel-Box">
						                        	<div class="accord-title">Home Condition</div>
						                        	<label class="form-group accord-radio"><input type="radio" name="home_cleaning_condition" value="dirty">Dirty</label>
						                        	<label class="form-group accord-radio"><input type="radio" name="home_cleaning_condition" value="clean">Clean</label>
						                        	<label class="form-group accord-radio"><input type="radio" name="home_cleaning_condition" value="average">Average</label>
						                        	<label class="form-group accord-radio"><input type="radio" name="home_cleaning_condition" value="poor">Poor</label>
						                        </div>
						                        <div class="form-group panel-Box">
						                        	<div class="accord-title">How many levels do you have</div>
						                        	<label class="form-group accord-radio"><input type="radio" name="home_cleaning_levels" value="1">1</label>
						                        	<label class="form-group accord-radio"><input type="radio" name="home_cleaning_levels" value="2">2</label>
						                        	<label class="form-group accord-radio"><input type="radio" name="home_cleaning_levels" value="3">3</label>
						                        	<label class="form-group accord-radio"><input type="radio" name="home_cleaning_levels" value="4+">4 or more</label>
						                        </div>
						                        <div class="form-group panel-Box">
						                        	<div class="accord-title">Size of the property</div>
						                        	<label class="form-group accord-radio"><input type="radio" name="home_cleaning_area" value="0-600">0-600 sqft</label>
						                        	<label class="form-group accord-radio"><input type="radio" name="home_cleaning_area" value="600-1500">600-1500 sqft</label>
						                        	<label class="form-group accord-radio"><input type="radio" name="home_cleaning_area" value="1500-2500">1500-2500 sqft</label>
						                        	<label class="form-group accord-radio"><input type="radio" name="home_cleaning_area" value="above 2500">above 2500 sqft</label>
						                        </div>
						                        <div class="form-group panel-Box">
						                        	<div class="accord-title">How many peoples live in the house</div>
						                        	<label class="form-group accord-radio"><input type="radio" name="home_cleaning_peoples_count" value="1">1</label>
						                        	<label class="form-group accord-radio"><input type="radio" name="home_cleaning_peoples_count" value="2">2</label>
						                        	<label class="form-group accord-radio"><input type="radio" name="home_cleaning_peoples_count" value="3">3</label>
						                        	<label class="form-group accord-radio"><input type="radio" name="home_cleaning_peoples_count" value="4+">4 or more</label>
						                        </div>
						                        <div class="form-group panel-Box">
						                        	<div class="accord-title">How many pets live in the house</div>
						                        	<label class="form-group accord-radio"><input type="radio" name="home_cleaning_pets_count" value="0">None</label>
						                        	<label class="form-group accord-radio"><input type="radio" name="home_cleaning_pets_count" value="1">1</label>
						                        	<label class="form-group accord-radio"><input type="radio" name="home_cleaning_pets_count" value="2">2</label>
						                        	<label class="form-group accord-radio"><input type="radio" name="home_cleaning_pets_count" value="3">3</label>
						                        	<label class="form-group accord-radio"><input type="radio" name="home_cleaning_pets_count" value="4+">4 or more</label>
						                        </div>
						                        <div class="form-group panel-Box">
						                        	<div class="accord-title">How many bathrooms</div>
						                        	<label class="form-group accord-radio"><input type="radio" name="home_cleaning_bathrooms_count" value="1">1</label>
						                        	<label class="form-group accord-radio"><input type="radio" name="home_cleaning_bathrooms_count" value="2">2</label>
						                        	<label class="form-group accord-radio"><input type="radio" name="home_cleaning_bathrooms_count" value="3">3</label>
						                        	<label class="form-group accord-radio"><input type="radio" name="home_cleaning_bathrooms_count" value="4+">4 or more</label>
						                        </div>

						                        <div class="form-group panel-Box">
						                        	<div class="accord-title">Steaming carpet cleaning</div>
						                        	<?php
						                        	if( isset( $homeCleaningSteamingServices ) && count( $homeCleaningSteamingServices ) > 0 )
						                        	{
						                        		foreach ($homeCleaningSteamingServices as $service)
						                        		{
						                        		?>
						                        			<label class="form-group  accord-radio"><input type="checkbox" name="home_cleaning_steaming_services[]" value="{{ $service->id }}"> {{ ucwords( strtolower( $service->steaming_service_for ) ) }}</label>
						                        		<?php
						                        		}
						                        	}
						                        	?>
						                        </div>

						                        <div class="form-group panel-Box">
						                        	<div class="accord-title">Other places to clean</div>
						                        	<?php
						                        	if( isset( $homeCleaningOtherPlaces ) && count( $homeCleaningOtherPlaces ) > 0 )
						                        	{
						                        		foreach ($homeCleaningOtherPlaces as $service)
						                        		{
						                        		?>
						                        			
															<label class="form-group accord-radio">
						                        				<input type="checkbox" name="home_cleaning_other_places[]" value="{{ $service->id }}"> {{ ucwords( strtolower( $service->other_places ) ) }}</label>
						                        			
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
						                        <a data-toggle="collapse" data-parent="#accordion" href="#home_cleaning_services_collapse5">Additional Services</a>
						                    </h4>
						                </div>
						                <div id="home_cleaning_services_collapse5" class="panel-collapse collapse">
						                    <div class="panel-body">
											
						                    	<div class="form-group panel-Box">
						                    		<div class="col-lg-9"><div class="accord-title">Services</div></div>
						                    		<div class="col-lg-3"><div class="accord-title text-right">Quantity</div></div>
						                    	<!-- Additional services list -->
						                    	<?php
						                    	if( isset( $homeCleaningAdditionalService ) && count( $homeCleaningAdditionalService ) > 0 )
						                    	{
						                    		foreach ($homeCleaningAdditionalService as $service)
						                    		{
						                    		?>
						                    			<div class="clearfix"></div>
														<div class="add-serv-data">
						                        			<div class="col-lg-9"><div class="addServText">{{ $service->additional_service }}</div></div>
						                        			<div class="col-lg-3"><input class="form-control quantityBoxiN" type="number" name="home_cleaning_additional_services[{{ $service->id }}]"></div>
														</div>
						                    		<?php
						                    		}
						                    	}
						                    	?>
						                        		</div>

						                    	<div class="form-group panel-Box">
							                        <div class="accord-title">Cleaning behind the refrigerator and stove?</div>
							                        <label class="form-group accord-radio"><input type="radio" name="home_cleaning_behind_refrigerator_stove" value="1">Yes</label>
							                        <label class="form-group accord-radio"><input type="radio" name="home_cleaning_behind_refrigerator_stove" value="0">No</label>
							                    </div>
							                    <div class="form-group panel-Box">
							                        <div class="accord-title">Would you like baseboard to be washed?</div>
							                        <label class="form-group accord-radio"><input type="radio" name="home_cleaning_baseboard" value="1">Yes</label>
							                        <label class="form-group accord-radio"><input type="radio" name="home_cleaning_baseboard" value="0">No</label>
							                    </div>
							                    <div class="form-group panel-Box">
							                        <div class="accord-title">Elevator Available?</div>
							                        <label class="form-group accord-radio"><input type="radio" name="home_cleaning_elevator_availability" value="1">Yes</label>
							                        <label class="form-group accord-radio"><input type="radio" name="home_cleaning_elevator_availability" value="0">No</label>
							                    </div>
						                    </div>
						                </div>
						            </div>
									
									<div class="panel panel-default">
						                <div class="panel-heading">
						                    <h4 class="panel-title">
						                        <a data-toggle="collapse" data-parent="#accordion" href="#home_cleaning_services_collapse6">Availability</a>
						                    </h4>
						                </div>
						                <div id="home_cleaning_services_collapse6" class="panel-collapse collapse">
						                    <div class="panel-body">
						                    	<div class="add-serv-data allDaydaTa">
						                    		<div class="col-lg-2">Day 1</div>
						                    		<div class="col-lg-3"><input type="text" name="availability_date4" id="availability_date4" class="form-control datepicker"></div>
						                    		<div class="col-lg-3">
						                    			<select class="form-control" name="availability_time_from1" id="availability_time_from1">
						                    				<option value="">Select</option>
						                    				<option value="08:00AM to 07:00PM">All day</option>
						                    				<option value="08:00AM to 11:00AM">Morning</option>
						                    				<option value="12:00PM to 03:00PM">Afternoon</option>
						                    				<option value="03:00PM to 07:00PM">Evening</option>
						                    			</select>
						                    		</div>
						                    		<div class="col-lg-4">
						                    			<input type="text" name="availability_time_upto1" id="availability_time_upto1" class="form-control">
						                    		</div>
						                    	</div>
						                    	<div class="add-serv-data allDaydaTa">
						                    		<div class="col-lg-2">Day 2</div>
						                    		<div class="col-lg-3"><input type="text" name="availability_date5" id="availability_date5" class="form-control datepicker"></div>
						                    		<div class="col-lg-3">
						                    			<select class="form-control" name="availability_time_from2" id="availability_time_from2">
						                    				<option value="">Select</option>
						                    				<option value="08:00AM to 07:00PM">All day</option>
						                    				<option value="08:00AM to 11:00AM">Morning</option>
						                    				<option value="12:00PM to 03:00PM">Afternoon</option>
						                    				<option value="03:00PM to 07:00PM">Evening</option>
						                    			</select>
						                    		</div>
						                    		<div class="col-lg-4">
						                    			<input type="text" name="availability_time_upto2" id="availability_time_upto2" class="form-control">
						                    		</div>
						                    	</div>
						                    	<div class="add-serv-data allDaydaTa">
						                    		<div class="col-lg-2">Day 3</div>
						                    		<div class="col-lg-3"><input type="text" name="availability_date6" id="availability_date6" class="form-control datepicker"></div>
						                    		<div class="col-lg-3">
						                    			<select class="form-control" name="availability_time_from3" id="availability_time_from3">
						                    				<option value="">Select</option>
						                    				<option value="08:00AM to 07:00PM">All day</option>
						                    				<option value="08:00AM to 11:00AM">Morning</option>
						                    				<option value="12:00PM to 03:00PM">Afternoon</option>
						                    				<option value="03:00PM to 07:00PM">Evening</option>
						                    			</select>
						                    		</div>
						                    		<div class="col-lg-4">
						                    			<input type="text" name="availability_time_upto3" id="availability_time_upto3" class="form-control">
						                    		</div>
						                    	</div>
						                    </div>
						                </div>
						            </div>
									
						            <!-- <div class="panel panel-default">
						                <div class="panel-heading">
						                    <h4 class="panel-title">
						                        <a data-toggle="collapse" data-parent="#accordion" href="#home_cleaning_services_collapse7">Call Me On</a>
						                    </h4>
						                </div>
						                <div id="home_cleaning_services_collapse7" class="panel-collapse collapse">
						                    <div class="panel-body">
						                        <div class="form-group panel-Box">
						                        	<input type="text" name="home_cleaning_callback_primary_no" class="form-control accord-input" placeholder="Primary No. Ex: (123) 456 7899, (123)-456-7899, 123-456-7899, 123 456 7899">
						                        	<input type="text" name="home_cleaning_callback_secondary_no" class="form-control accord-input" placeholder="Additional No. Ex: (123) 456 7899, (123)-456-7899, 123-456-7899, 123 456 7899">
						                        </div>
						                    </div>
						                </div>
						            </div> -->

						            <div class="panel panel-default">
						                <div class="panel-heading">
						                    <h4 class="panel-title">
						                        <a data-toggle="collapse" data-parent="#accordion" href="#home_cleaning_services_collapse8">Additional Information (If Any)</a>
						                    </h4>
						                </div>
						                <div id="home_cleaning_services_collapse8" class="panel-collapse collapse">
						                    <div class="panel-body">
						                        <textarea class="form-control accord-input" name="home_cleaning_additional_information" class="form-control" placeholder="Enter Additional Information here If Any"></textarea>
						                    </div>
						                </div>
						            </div>
						        </div>

						        <div class="clean-error">
						        	<div><label id="home_cleaning_condition-error" class="error" for="home_cleaning_condition"></label></div>
						        	<div><label id="home_cleaning_area-error" class="error" for="home_cleaning_area"></label></div>
						        	<div><label id="home_cleaning_pets_count-error" class="error" for="home_cleaning_pets_count"></label></div>
						        	<div><label id="home_cleaning_elevator_availability-error" class="error" for="home_cleaning_elevator_availability"></label></div>
						        	<div><label id="availability_date4-error" class="error" for="availability_date4"></label></div>
						        	<div><label id="availability_time_from1-error" class="error" for="availability_time_from1"></label></div>
						        </div>

								<div class="row">
									<div class="col-sm-12">
										<button type="submit" class="btn btn-info" name="btn_submit_home_cleaning_query" id="btn_submit_home_cleaning_query">Submit</button>
									</div>
								</div>
						    </form>
      					</div>
						</div>
		      		</div>
		      	</div>
	      	</div>
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

		      	<div class="row">
				<div class="model-WrapCont">
		      	<h2>Moving Companies</h2>
					 </div>
		      		<div class="col-sm-12 box-P-100" id="moving_companies_step1">
		      			<div class="col-sm-12">
      						<p>If you are moving or relocating to a new address, you need professional moving companies to make your relocation a breeze. On uDistro, professional movers will provide you with no obligation quotes within 24 hours.</p>
      					</div>
      					<div class="clearfix"></div>
      					<div class="col-sm-12">
      						<form name="frm_home_moving_companies" id="frm_home_moving_companies" autocomplete="off">
						        <div class="panel-group" id="accordion_home_moving_companies">

						        	<input type="hidden" value="{{ $clientMovingFromAddress->moving_from_house_type }}" name="moving_house_from_type" id="moving_house_from_type">
						        	<input type="hidden" value="{{ $clientMovingFromAddress->moving_from_floor }}" name="moving_house_from_level" id="moving_house_from_level">
						        	<input type="hidden" value="{{ $clientMovingFromAddress->moving_from_bedroom_count }}" name="moving_house_from_bedroom_count" id="moving_house_from_bedroom_count">
						        	<input type="hidden" value="{{ $clientMovingFromAddress->moving_from_property_type }}" name="moving_house_from_property_type" id="moving_house_from_property_type">

						        	<input type="hidden" value="{{ $clientMovingToAddress->moving_to_house_type }}" name="moving_house_to_type" id="moving_house_to_type">
						        	<input type="hidden" value="{{ $clientMovingToAddress->moving_to_floor }}" name="moving_house_to_level" id="moving_house_to_level">
						        	<input type="hidden" value="{{ $clientMovingToAddress->moving_to_bedroom_count }}" name="moving_house_to_bedroom_count" id="moving_house_to_bedroom_count">
						        	<input type="hidden" value="{{ $clientMovingToAddress->moving_to_property_type }}" name="moving_house_to_property_type" id="moving_house_to_property_type">

						        	<!-- <div class="panel panel-default">
						                <div class="panel-heading">
						                    <h4 class="panel-title">
						                        <a data-toggle="collapse" data-parent="#accordion_home_moving_companies" href="#home_moving_companies_collapse3">Moving From</a>
						                    </h4>
						                </div>
						                <div id="home_moving_companies_collapse3" class="panel-collapse collapse in">
						                    <div class="panel-body">
						                        <div class="form-group panel-Box">
						                        	<div class="accord-title">Type</div>
						                        	<select class="form-control" name="moving_house_from_type" id="moving_house_from_type">
						                        		<option value="">Select</option>
						                        		<option value="house">House</option>
						                        		<option value="apartment/flat">Apartment/Flat</option>
						                        		<option value="condo">Condo</option>
						                        		<option value="studio">Studio</option>
						                        	</select>
						                        </div>
						                        <div class="form-group panel-Box">
						                        	<div class="accord-title">Floor Level</div>
						                        	<label class="form-group accord-radio"><input type="radio" name="moving_house_from_level" value="1">1</label>
						                        	<label class="form-group accord-radio"><input type="radio" name="moving_house_from_level" value="2">2</label>
						                        	<label class="form-group accord-radio"><input type="radio" name="moving_house_from_level" value="3">3</label>
						                        	<label class="form-group accord-radio"><input type="radio" name="moving_house_from_level" value="4+">4 or more</label>
						                        	<div class="clean-error"><label id="moving_house_from_level-error" class="error" for="moving_house_from_level"></label></div>
						                        </div>
						                        <div class="form-group panel-Box">
						                        	<div class="accord-title">No of bedrooms</div>
						                        	<label class="form-group accord-radio"><input type="radio" name="moving_house_from_bedroom_count" value="1">1</label>
						                        	<label class="form-group accord-radio"><input type="radio" name="moving_house_from_bedroom_count" value="2">2</label>
						                        	<label class="form-group accord-radio"><input type="radio" name="moving_house_from_bedroom_count" value="3">3</label>
						                        	<label class="form-group accord-radio"><input type="radio" name="moving_house_from_bedroom_count" value="4+">4 or more</label>
						                        	<div class="clean-error"><label id="moving_house_from_bedroom_count-error" class="error" for="moving_house_from_bedroom_count"></label></div>
						                        </div>
						                        <div class="form-group panel-Box">
						                        	<div class="accord-title">Did you own or rent this property</div>
						                        	<label class="form-group accord-radio"><input type="radio" name="moving_house_from_property_type" value="own">Own</label>
						                        	<label class="form-group accord-radio"><input type="radio" name="moving_house_from_property_type" value="rent">Rent</label>
						                        	<div class="clean-error"><label id="moving_house_from_property_type-error" class="error" for="moving_house_from_property_type"></label></div>
						                        </div>
						                    </div>
						                </div>
						            </div> -->
						            <!-- <div class="panel panel-default">
						                <div class="panel-heading">
						                    <h4 class="panel-title">
						                        <a data-toggle="collapse" data-parent="#accordion_home_moving_companies" href="#home_moving_companies_collapse2">Moving To</a>
						                    </h4>
						                </div>
						                <div id="home_moving_companies_collapse2" class="panel-collapse collapse">
						                    <div class="panel-body">
						                        <div class="form-group panel-Box">
						                        	<div class="accord-title">Type</div>
						                        	<select class="form-control" name="moving_house_to_type" id="moving_house_to_type">
						                        		<option value="">Select</option>
						                        		<option value="house">House</option>
						                        		<option value="apartment/flat">Apartment/Flat</option>
						                        		<option value="condo">Condo</option>
						                        		<option value="studio">Studio</option>
						                        	</select>
						                        </div>
						                        <div class="form-group panel-Box">
						                        	<div class="accord-title">Floor Level</div>
						                        	<label class="form-group accord-radio"><input type="radio" name="moving_house_to_level" value="1">1</label>
						                        	<label class="form-group accord-radio"><input type="radio" name="moving_house_to_level" value="2">2</label>
						                        	<label class="form-group accord-radio"><input type="radio" name="moving_house_to_level" value="3">3</label>
						                        	<label class="form-group accord-radio"><input type="radio" name="moving_house_to_level" value="4+">4 or more</label>
						                        	<div class="clean-error"><label id="moving_house_to_level-error" class="error" for="moving_house_to_level"></label></div>
						                        </div>
						                        <div class="form-group panel-Box">
						                        	<div class="accord-title">No of bedrooms</div>
						                        	<label class="form-group accord-radio"><input type="radio" name="moving_house_to_bedroom_count" value="1">1</label>
						                        	<label class="form-group accord-radio"><input type="radio" name="moving_house_to_bedroom_count" value="2">2</label>
						                        	<label class="form-group accord-radio"><input type="radio" name="moving_house_to_bedroom_count" value="3">3</label>
						                        	<label class="form-group accord-radio"><input type="radio" name="moving_house_to_bedroom_count" value="4+">4 or more</label>
						                        	<div class="clean-error"><label id="moving_house_to_bedroom_count-error" class="error" for="moving_house_to_bedroom_count"></label></div>
						                        </div>
						                        <div class="form-group panel-Box">
						                        	<div class="accord-title">Did you own or rent this property</div>
						                        	<label class="form-group accord-radio"><input type="radio" name="moving_house_to_property_type" value="own">Own</label>
						                        	<label class="form-group accord-radio"><input type="radio" name="moving_house_to_property_type" value="rent">Rent</label>
						                        	<div class="clean-error"><label id="moving_house_to_property_type-error" class="error" for="moving_house_to_property_type"></label></div>
						                        </div>
						                    </div>
						                </div>
						            </div> -->
						            
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
						                    			<div class="form-group panel-Box">
						                        			<!-- Collapse Title -->
						                        			<div>
						                        				<label class="form-group accord-radio">
						                        					<a class="collapse_moving_item_category" data-id="collapsable{{ $step }}" href="javascript:void(0);">{{ $movingItemCategory->item_name }}</a>
						                        				</label>
						                        			</div>

						                        			<!-- Collapse Body -->
						                        			<div id="collapsable{{ $step }}" class="collapse_moving_item_container" style="display: none;">
						                        				
						                        				<div class="row">
							                        				<div class="form-group" id="moving_item_category_container">
							                        					<div class="col-sm-6 col-md-6 col-lg-6">
								                        					<select class="form-control moving_item_category" name="moving_item_category">
								                        						<option value="">Select</option>
									                        					<?php
									                        					if( isset( $movingItemDetails ) && count( $movingItemDetails ) > 0 )
									                        					{
									                        						foreach ($movingItemDetails as $movingItemDetail)
									                        						{
									                        							if( $movingItemDetail->moving_item_category_id == $movingItemCategory->id )
									                        							{
									                        								echo '<option value="'. $movingItemDetail->id .'">'. $movingItemDetail->item_name . ' - ' . $movingItemDetail->item_weight .'</option>';
									                        							}
									                        						}
									                        					}
									                        					?>
								                        					</select>
							                        					</div>
							                        					<div class="col-sm-2 col-md-2 col-lg-2">
							                        						<input class="form-control moving_item_quantity" type="number" style="height: 32px;" min="0" name="moving_item_quantity" value="">
							                        					</div>
							                        					<div class="col-sm-2 col-md-2 col-lg-2">
							                        						<button type="button" id="{{ $movingItemCategory->id }}" class="add_item_to_selection">+</button>
							                        					</div>
							                        					<div class="col-sm-2 col-md-2 col-lg-2">
							                        						<a class="show_selected_item_details" id="{{ $movingItemCategory->id }}" href="javascript:void(0);">Cart (0)</a>
							                        					</div>

							                        					<div class="clearfix"></div>

							                        					<!-- To hold the selected item details -->
							                        					<div class="selected_item_details_container col-sm-12 col-md-12 col-lg-12" id="{{ $movingItemCategory->id }}" style="display: none;"></div>
							                        				</div>
							                        			</div>

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
						                    				<div class="form-group panel-Box">
						                    					<div class="accord-title">{{ $itemList->other_moving_items_services_details }}</div>
						                    					<label class="form-group accord-radio"> <input type="radio" name="moving_house_special_instruction[{{ $itemList->id }}]" value="1">Yes</label>
						                    					<label class="form-group accord-radio"> <input type="radio" name="moving_house_special_instruction[{{ $itemList->id  }}]" value="0">No</label>
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
						                    				<div class="form-group panel-Box">
						                    					<div class="accord-title">{{ $itemList->other_moving_items_services_details }}</div>
						                    					<label class="form-group accord-radio"> <input type="radio" name="moving_house_additional_service[{{ $itemList->id }}]" value="1">Yes</label>
						                    					<label class="form-group accord-radio"> <input type="radio" name="moving_house_additional_service[{{ $itemList->id }}]" value="0">No</label>
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
						                    			<div class="accord-title">{{ $transportationList->transportation_type }}</div>

							                        	<label class="form-group accord-radio"><input type="radio" name="moving_house_vehicle_type" value="pickup">Pickup</label>
							                        	<label class="form-group accord-radio"><input type="radio" name="moving_house_vehicle_type" value="cargo van">Cargo Van</label>
							                        	<label class="form-group accord-radio"><input type="radio" name="moving_house_vehicle_type" value="10' truck">10' Truck</label>
							                        	<label class="form-group accord-radio"><input type="radio" name="moving_house_vehicle_type" value="15' truck">15' Truck</label>
							                        	<label class="form-group accord-radio"><input type="radio" name="moving_house_vehicle_type" value="17' truck">17' Truck</label>
							                        	<label class="form-group accord-radio"><input type="radio" name="moving_house_vehicle_type" value="26' Truck">26' Truck</label>
							                        	<div class="clean-error"><label id="moving_house_vehicle_type-error" class="error" for="moving_house_vehicle_type"></label></div>
						                    		<?php
						                    		}
						                    	}
						                		?>
						                        </div>

						                        <div class="form-group panel-Box">
						                        	<div class="accord-title">Need insurance?</div>
						                        	<label class="form-group accord-radio"><input type="radio" name="moving_house_need_insurance" value="1">Yes</label>
						                        	<label class="form-group accord-radio"><input type="radio" name="moving_house_need_insurance" value="0">No</label>
						                        </div>
						                        <div class="form-group panel-Box">
						                        	<div class="accord-title">Call back option?</div>
						                        	<label class="form-group accord-radio"><input type="radio" name="moving_house_callback_option" value="1">Yes</label>
						                        	<label class="form-group accord-radio"><input type="radio" name="moving_house_callback_option" value="0">No</label>
						                        </div>
						                        <div class="form-group panel-Box">
						                        	<div class="accord-title">Call back time?</div>
						                        	<label class="form-group accord-radio"><input type="radio" name="moving_house_callback_time" value="0">Anytime</label>
						                        	<label class="form-group accord-radio"><input type="radio" name="moving_house_callback_time" value="1">Daytime</label>
						                        	<label class="form-group accord-radio"><input type="radio" name="moving_house_callback_time" value="2">Evening</label>
						                        	<div class="clean-error"><label id="moving_house_callback_time-error" class="error" for="moving_house_callback_time"></label></div>
						                        </div>
						                        <!-- <div class="form-group panel-Box">
						                        	<div class="accord-title">Call me on?</div>
						                        	<input type="text" name="moving_house_callback_primary_no" class="form-control" placeholder="Primary Number">
						                        	<input type="text" name="moving_house_callback_secondary_no" class="form-control" placeholder="Additional Number">
						                        </div> -->

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
						                    <div class="panel-body allDaydaTa">
						                        <input type="text" name="moving_house_date" id="moving_house_date" class="form-control datepicker">
						                    </div>
						                </div>
						            </div>
						        </div>

						        <div>
						        	<div class="clean-error">
						        		<div><label id="moving_house_need_insurance-error" class="error" for="moving_house_need_insurance"></label></div>
						        		<div><label id="moving_house_callback_option-error" class="error" for="moving_house_callback_option"></label></div>
						        	</div>
						        	<button type="submit" class="btn btn-info" name="btn_submit_moving_query" id="btn_submit_moving_query">Submit</button>
						        </div>
						    </form>
      					</div>
		      		</div>
		      	</div>
	      	</div>
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
		      	<div class="row">
				<div class="model-WrapCont">
					 <h2>Tech Concierge</h2>
					 </div>
		      		<div class="col-sm-12 box-P-100" id="tech_concierge_step2">
		      			<div class="col-sm-12">
      						<p>If you are moving or relocating to a new address, you need someone to install your appliances. From dishwasher to washing machines, dryers, range and stove. Technicians on uDistro will provide you with no obligation quotes within 24 hours.</p>
      					</div>
      					<div class="clearfix"></div>
		      			<div class="col-sm-12">
      						<form name="frm_tech_concierge" id="frm_tech_concierge" autocomplete="off">
						        <div class="panel-group" id="accordion_concierge">

						        	<input type="hidden" value="{{ $clientMovingToAddress->moving_to_house_type }}" name="moving_house_to_type" id="moving_house_to_type">
						        	<input type="hidden" value="{{ $clientMovingToAddress->moving_to_floor }}" name="moving_house_to_level" id="moving_house_to_level">
						        	<input type="hidden" value="{{ $clientMovingToAddress->moving_to_bedroom_count }}" name="moving_house_to_bedroom_count" id="moving_house_to_bedroom_count">
						        	<input type="hidden" value="{{ $clientMovingToAddress->moving_to_property_type }}" name="moving_house_to_property_type" id="moving_house_to_property_type">

						            <!-- <div class="panel panel-default">
						                <div class="panel-heading">
						                    <h4 class="panel-title">
						                        <a data-toggle="collapse" data-parent="#accordion_concierge" href="#tech_concierge_collapse2">Moving To</a>
						                    </h4>
						                </div>
						                <div id="tech_concierge_collapse2" class="panel-collapse collapse in">
						                    <div class="panel-body">
											<div class="form-group panel-Box">
						                        	<div class="accord-title">Type</div>
						                        	<select class="form-control" name="moving_house_to_type" id="moving_house_to_type">
						                        		<option value="">Select</option>
						                        		<option value="house">House</option>
						                        		<option value="apartment/flat">Apartment/Flat</option>
						                        		<option value="condo">Condo</option>
						                        		<option value="studio">Studio</option>
						                        	</select>
						                    </div>
											<div class="form-group panel-Box">
						                        	<div class="accord-title">Floor Level</div>
						                        	<label class="form-group accord-radio"><input type="radio" name="moving_house_to_level" value="1">1</label>
						                        	<label class="form-group accord-radio"><input type="radio" name="moving_house_to_level" value="2">2</label>
						                        	<label class="form-group accord-radio"><input type="radio" name="moving_house_to_level" value="3">3</label>
						                        	<label class="form-group accord-radio"><input type="radio" name="moving_house_to_level" value="4+">4 or more</label>
						                        	<div class="clean-error"><label id="moving_house_to_level-error" class="error" for="moving_house_to_level"></label></div>
						                    </div>
											<div class="form-group panel-Box">
						                        	<div class="accord-title">No of bedrooms</div>
						                        	<label class="form-group accord-radio"><input type="radio" name="moving_house_to_bedroom_count" value="1">1</label>
						                        	<label class="form-group accord-radio"><input type="radio" name="moving_house_to_bedroom_count" value="2">2</label>
						                        	<label class="form-group accord-radio"><input type="radio" name="moving_house_to_bedroom_count" value="3">3</label>
						                        	<label class="form-group accord-radio"><input type="radio" name="moving_house_to_bedroom_count" value="4+">4 or more</label>
						                        	<div class="clean-error"><label id="moving_house_to_bedroom_count-error" class="error" for="moving_house_to_bedroom_count"></label></div>
						                    </div>
											<div class="form-group panel-Box">
						                        	<div class="accord-title">Did you own or rent this property</div>
						                        	<label class="form-group accord-radio"><input type="radio" name="moving_house_to_property_type" value="own">Own</label>
						                        	<label class="form-group accord-radio"><input type="radio" name="moving_house_to_property_type" value="rent">Rent</label>
						                        	<div class="clean-error"><label id="moving_house_to_property_type-error" class="error" for="moving_house_to_property_type"></label></div>
						                        </div>
						                    </div>
						                </div>
						            </div> -->
						            <div class="panel panel-default">
						                <div class="panel-heading">
						                    <h4 class="panel-title">
						                        <a data-toggle="collapse" data-parent="#accordion_concierge" href="#tech_concierge_collapse3">Other Places to install appliances in</a>
						                    </h4>
						                </div>
						                <div id="tech_concierge_collapse3" class="panel-collapse collapse">
						                    <div class="panel-body">
											<div class="form-group panel-Box">
						                        	<div class="accord-title">Other place to install appliances in</div>
						                        	<div>
							                        	<?php
							                        	if( isset( $techConciergePlaces ) && count( $techConciergePlaces ) > 0 )
							                        	{
							                        		foreach( $techConciergePlaces as $details )
							                        		{
							                        		?>
							                        				<label class="form-group accord-radio">
							                        					<input type="checkbox" name="tech_concierge_places[]" value="{{ $details->id }}"> {{ ucwords( strtolower( $details->places ) ) }}
							                        				</label>
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
											<div class="form-group panel-Box">
						                        	<div class="accord-title">Which of these appliances you plan to install</div>
						                        	<div class="col-sm-12">
							                        	<?php
							                        	if( isset( $techConciergeAppliances ) && count( $techConciergeAppliances ) > 0 )
							                        	{
							                        		foreach( $techConciergeAppliances as $details )
							                        		{
							                        		?>
																	<label class="form-group accord-radio">
							                        					<input type="checkbox" name="tech_concierge_appliances[]" value="{{ $details->id }}"> {{ ucwords( strtolower( $details->appliances ) ) }}
							                        				</label>
							                        		
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
						                        		
						                        			<div class="add-serv-data">
						                        				<div class="col-lg-7"><div class="addServText">{{ ucfirst( strtolower( $otherDetails->details ) ) }}</div></div>
																<div class="col-lg-5">
						                        				<label class="form-group accord-radio"> <input type="radio" name="tech_concierge_details[{{ $otherDetails->id }}]" value="1"> Yes</label>
						                        				<label class="form-group accord-radio"> <input type="radio" name="tech_concierge_details[{{ $otherDetails->id }}]" value="0"> No</label>
																</div>
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
						                    	<div class="add-serv-data allDaydaTa">
						                    		<div class="col-lg-2">Day 1</div>
						                    		<div class="col-lg-3"><input type="text" name="availability_date1" id="availability_date1" class="form-control datepicker"></div>
						                    		<div class="col-lg-3">
						                    			<select class="form-control" name="availability_time_from1" id="availability_time_from1">
						                    				<option value="">Select</option>
						                    				<option value="08:00AM to 07:00PM">All day</option>
						                    				<option value="08:00AM to 11:00AM">Morning</option>
						                    				<option value="12:00PM to 03:00PM">Afternoon</option>
						                    				<option value="03:00PM to 07:00PM">Evening</option>
						                    			</select>
						                    		</div>
						                    		<div class="col-lg-4">
						                    			<input type="text" name="availability_time_upto1" id="availability_time_upto1" class="form-control">
						                    		</div>
						                    	</div>
						                    	<div class="add-serv-data allDaydaTa">
						                    		<div class="col-lg-2">Day 2</div>
						                    		<div class="col-lg-3"><input type="text" name="availability_date2" id="availability_date2" class="form-control datepicker"></div>
						                    		<div class="col-lg-3">
						                    			<select class="form-control" name="availability_time_from2" id="availability_time_from2">
						                    				<option value="">Select</option>
						                    				<option value="08:00AM to 07:00PM">All day</option>
						                    				<option value="08:00AM to 11:00AM">Morning</option>
						                    				<option value="12:00PM to 03:00PM">Afternoon</option>
						                    				<option value="03:00PM to 07:00PM">Evening</option>
						                    			</select>
						                    		</div>
						                    		<div class="col-lg-4">
						                    			<input type="text" name="availability_time_upto2" id="availability_time_upto2" class="form-control">
						                    		</div>
						                    	</div>
						                    	<div class="add-serv-data allDaydaTa">
						                    		<div class="col-lg-2">Day 3</div>
						                    		<div class="col-lg-3"><input type="text" name="availability_date3" id="availability_date3" class="form-control datepicker"></div>
						                    		<div class="col-lg-3">
						                    			<select class="form-control" name="availability_time_from3" id="availability_time_from3">
						                    				<option value="">Select</option>
						                    				<option value="08:00AM to 07:00PM">All day</option>
						                    				<option value="08:00AM to 11:00AM">Morning</option>
						                    				<option value="12:00PM to 03:00PM">Afternoon</option>
						                    				<option value="03:00PM to 07:00PM">Evening</option>
						                    			</select>
						                    		</div>
						                    		<div class="col-lg-4">
						                    			<input type="text" name="availability_time_upto3" id="availability_time_upto3" class="form-control">
						                    		</div>
						                    	</div>
						                    </div>
						                </div>
						            </div>
									
									<!-- <div class="panel panel-default">
						                <div class="panel-heading">
						                    <h4 class="panel-title">
						                         <a data-toggle="collapse" data-parent="#accordion_concierge" href="#tech_concierge_collapse7">Call me on</a>
						                    </h4>
						                </div>
						                <div id="tech_concierge_collapse7" class="panel-collapse collapse">
						                    <div class="panel-body">
						                        <div class="form-group panel-Box">
						                        <input type="text" name="tech_concierge_callback_primary_no" class="form-control accord-input" placeholder="Primary No. Ex: (123) 456 7899, (123)-456-7899, 123-456-7899, 123 456 7899">
						                        <input type="text" name="tech_concierge_callback_secondary_no" class="form-control accord-input" placeholder="Additional No. Ex: (123) 456 7899, (123)-456-7899, 123-456-7899, 123 456 7899">
						                        </div>
						                    </div>
						                </div>
						            </div> -->
									
						            <div class="panel panel-default">
						                <div class="panel-heading">
						                    <h4 class="panel-title">
						                        <a data-toggle="collapse" data-parent="#accordion_concierge" href="#tech_concierge_collapse8">Additional Information</a>
						                    </h4>
						                </div>
						                <div id="tech_concierge_collapse8" class="panel-collapse collapse">
						                    <div class="panel-body">
						                        <textarea class="form-control" name="tech_concierge_additional_information" id="tech_concierge_additional_information" placeholder="Enter Additional Information here If Any"></textarea>
						                    </div>
						                </div>
						            </div>
						        </div>

						        <div>
						        	<div class="clean-error">
						        		<div><label id="tech_concierge_places[]-error" class="error" for="tech_concierge_places[]"></label></div>
						        		<div><label id="tech_concierge_appliances[]-error" class="error" for="tech_concierge_appliances[]"></label></div>
						        		<div><label id="availability_date1-error" class="error" for="availability_date1"></label></div>
						        		<div><label id="availability_time_from1-error" class="error" for="availability_time_from1"></label></div>
						        	</div>

						        	<button type="submit" class="btn btn-info" name="btn_submit_tech_concierge_query" id="btn_submit_tech_concierge_query">Submit</button>
						        </div>
						    </form>
      					</div>
		      		</div>
		      	</div>
	      	</div>
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
		      	

		      	<div class="row">
					<div class="model-WrapCont">
						<h2>Cable &amp; Internet Service</h2>
					 </div>
		      		<div class="col-sm-12 box-P-100" id="cable_internet_services_step1">
						
						<div class="row">
		      			<div class="col-sm-12">
      						<p>If you are moving or relocating to a new address, you need cable and internet service set up at your new address. On uDistro, digital service companies will provide you with no obligation quotes within 24 hours.</p>
      					</div>
						<div class="clearfix"></div>
		      			<div class="col-sm-12">
      						<form name="frm_cable_internet_services" id="frm_cable_internet_services">
						        <div class="panel-group" id="accordion_internet_service">

						        	<input type="hidden" value="{{ $clientMovingFromAddress->moving_from_house_type }}" name="cable_internet_house_from_type" id="cable_internet_house_from_type">
						        	<input type="hidden" value="{{ $clientMovingFromAddress->moving_from_floor }}" name="cable_internet_house_from_level" id="cable_internet_house_from_level">
						        	<input type="hidden" value="{{ $clientMovingFromAddress->moving_from_bedroom_count }}" name="cable_internet_house_from_bedroom_count" id="cable_internet_house_from_bedroom_count">
						        	<input type="hidden" value="{{ $clientMovingFromAddress->moving_from_property_type }}" name="cable_internet_from_property_type" id="cable_internet_from_property_type">

						        	<input type="hidden" value="{{ $clientMovingToAddress->moving_to_house_type }}" name="cable_internet_house_to_type" id="cable_internet_house_to_type">
						        	<input type="hidden" value="{{ $clientMovingToAddress->moving_to_floor }}" name="cable_internet_house_to_level" id="cable_internet_house_to_level">
						        	<input type="hidden" value="{{ $clientMovingToAddress->moving_to_bedroom_count }}" name="cable_internet_house_to_bedroom_count" id="cable_internet_house_to_bedroom_count">
						        	<input type="hidden" value="{{ $clientMovingToAddress->moving_to_property_type }}" name="cable_internet_house_to_property_type" id="cable_internet_house_to_property_type">		        	

						            <!-- <div class="panel panel-default">
						                <div class="panel-heading">
						                    <h4 class="panel-title">
						                        <a data-toggle="collapse" data-parent="#accordion_internet_service" href="#cable_internet_services_collapse1">Moving From</a>
						                    </h4>
						                </div>
						                <div id="cable_internet_services_collapse1" class="panel-collapse collapse in">
						                    <div class="panel-body">
												<div class="form-group panel-Box">
						                        	<div class="accord-title">Type</div>
						                        	<select class="form-control" name="cable_internet_house_from_type" id="cable_internet_house_from_type">
						                        		<option value="">Select</option>
						                        		<option value="house">House</option>
						                        		<option value="apartment/flat">Apartment/Flat</option>
						                        		<option value="condo">Condo</option>
						                        		<option value="studio">Studio</option>
						                        	</select>
						                        </div>
						                        <div class="form-group panel-Box">
						                        	<div class="accord-title">Floor Level</div>
						                        	<label class="form-group accord-radio"><input type="radio" name="cable_internet_house_from_level" value="1">1</label>
						                        	<label class="form-group accord-radio"><input type="radio" name="cable_internet_house_from_level" value="2">2</label>
						                        	<label class="form-group accord-radio"><input type="radio" name="cable_internet_house_from_level" value="3">3</label>
						                        	<label class="form-group accord-radio"><input type="radio" name="cable_internet_house_from_level" value="4+">4 or more</label>
						                        	<div class="clean-error"><label id="cable_internet_house_from_level-error" class="error" for="cable_internet_house_from_level"></label></div>
						                        </div>
						                        <div class="form-group panel-Box">
						                        	<div class="accord-title">No of bedrooms</div>
						                        	<label class="form-group accord-radio"><input type="radio" name="cable_internet_house_from_bedroom_count" value="1">1</label>
						                        	<label class="form-group accord-radio"><input type="radio" name="cable_internet_house_from_bedroom_count" value="2">2</label>
						                        	<label class="form-group accord-radio"><input type="radio" name="cable_internet_house_from_bedroom_count" value="3">3</label>
						                        	<label class="form-group accord-radio"><input type="radio" name="cable_internet_house_from_bedroom_count" value="4+">4 or more</label>
						                        	<div class="clean-error"><label id="cable_internet_house_from_bedroom_count-error" class="error" for="cable_internet_house_from_bedroom_count"></label></div>
						                        </div>
						                        <div class="form-group panel-Box">
						                        	<div class="accord-title">Did you own or rent this property</div>
						                        	<label class="form-group accord-radio"><input type="radio" name="cable_internet_from_property_type" value="own">Own</label>
						                        	<label class="form-group accord-radio"><input type="radio" name="cable_internet_from_property_type" value="rent">Rent</label>
						                        	<div class="clean-error"><label id="cable_internet_from_property_type-error" class="error" for="cable_internet_from_property_type"></label></div>
						                        </div>
						                    </div>
						                </div>
						            </div> -->
						            <!-- <div class="panel panel-default">
						                <div class="panel-heading">
						                    <h4 class="panel-title">
						                        <a data-toggle="collapse" data-parent="#accordion_internet_service" href="#cable_internet_services_collapse2">Moving To</a>
						                    </h4>
						                </div>
						                <div id="cable_internet_services_collapse2" class="panel-collapse collapse">
						                    <div class="panel-body">
						                        <div class="form-group panel-Box">
						                        	<div class="accord-title">Type</div>
						                        	<select class="form-control" name="cable_internet_house_to_type" id="cable_internet_house_to_type">
						                        		<option value="">Select</option>
						                        		<option value="house">House</option>
						                        		<option value="apartment/flat">Apartment/Flat</option>
						                        		<option value="condo">Condo</option>
						                        		<option value="studio">Studio</option>
						                        	</select>
						                        </div>
						                        <div class="form-group panel-Box">
						                        	<div class="accord-title">Floor Level</div>
						                        	<label class="form-group accord-radio"><input type="radio" name="cable_internet_house_to_level" value="1">1</label>
						                        	<label class="form-group accord-radio"><input type="radio" name="cable_internet_house_to_level" value="2">2</label>
						                        	<label class="form-group accord-radio"><input type="radio" name="cable_internet_house_to_level" value="3">3</label>
						                        	<label class="form-group accord-radio"><input type="radio" name="cable_internet_house_to_level" value="4+">4 or more</label>
						                        	<div class="clean-error"><label id="cable_internet_house_to_level-error" class="error" for="cable_internet_house_to_level"></label></div>
						                        </div>
						                        <div class="form-group panel-Box">
						                        	<div class="accord-title">No of bedrooms</div>
						                        	<label class="form-group accord-radio"><input type="radio" name="cable_internet_house_to_bedroom_count" value="1">1</label>
						                        	<label class="form-group accord-radio"><input type="radio" name="cable_internet_house_to_bedroom_count" value="2">2</label>
						                        	<label class="form-group accord-radio"><input type="radio" name="cable_internet_house_to_bedroom_count" value="3">3</label>
						                        	<label class="form-group accord-radio"><input type="radio" name="cable_internet_house_to_bedroom_count" value="4+">4 or more</label>
						                        	<div class="clean-error"><label id="cable_internet_house_to_bedroom_count-error" class="error" for="cable_internet_house_to_bedroom_count"></label></div>
						                        </div>
						                        <div class="form-group panel-Box">
						                        	<div class="accord-title">Did you own or rent this property</div>
						                        	<label class="form-group accord-radio"><input type="radio" name="cable_internet_house_to_property_type" value="own">Own</label>
						                        	<label class="form-group accord-radio"><input type="radio" name="cable_internet_house_to_property_type" value="rent">Rent</label>
						                        	<div class="clean-error"><label id="cable_internet_house_to_property_type-error" class="error" for="cable_internet_house_to_property_type"></label></div>
						                        </div>
						                    </div>
						                </div>
						            </div> -->
						            <div class="panel panel-default">
						                <div class="panel-heading">
						                    <h4 class="panel-title">
						                        <a data-toggle="collapse" data-parent="#accordion_internet_service" href="#cable_internet_services_collapse3">Detailed Job Description</a>
						                    </h4>
						                </div>
						                <div id="cable_internet_services_collapse3" class="panel-collapse collapse">
						                    <div class="panel-body">
						                        <div class="form-group panel-Box">
						                        	<div class="accord-title">Do you have cable & internet service before</div>
						                        	<label class="form-group accord-radio"><input type="radio" name="cable_internet_service_before" value="1">Yes</label>
						                        	<label class="form-group accord-radio"><input type="radio" name="cable_internet_service_before" value="0">No</label>
						                        </div>
						                        <div class="form-group panel-Box">
						                        	<div class="accord-title">Employment Status</div>
						                        	<label class="form-group accord-radio"><input type="radio" name="cable_internet_employment_status" class="cable_internet_employment_status" value="1">Employed</label>
						                        	<label class="form-group accord-radio"><input type="radio" name="cable_internet_employment_status" class="cable_internet_employment_status" value="2">Self Employed</label>
						                        	<label class="form-group accord-radio"><input type="radio" name="cable_internet_employment_status" class="cable_internet_employment_status" value="0">Unemployed</label>
						                        </div>
						                        <div class="form-group panel-Box" id="cable_internet_billing_responsible_container" style="display: none;">
						                        	<div class="accord-title">Are there other adult responsible for billing at this address</div>
						                        	<label class="form-group accord-radio"><input type="radio" name="cable_internet_billing_responsible" value="1">Yes</label>
						                        	<label class="form-group accord-radio"><input type="radio" name="cable_internet_billing_responsible" value="0">No</label>
						                        	<div class="clean-error"><label id="cable_internet_billing_responsible-error" class="error" for="cable_internet_billing_responsible"></label></div>
						                        </div>

						                        <div class="form-group panel-Box">
						                        	<div class="accord-title">What service(s) are applying for</div>
							                        <?php
							                        if( isset( $digitalServiceTypes ) && count( $digitalServiceTypes ) > 0 )
							                        {
							                        	foreach( $digitalServiceTypes as $digitalServiceType )
							                        	{
							                        	?>
							                        		<label class="form-group accord-radio"> <input type="checkbox" name="cable_internet_service_type[]" class="cable_internet_service_types" value="{{ $digitalServiceType->id }}"> {{ $digitalServiceType->service }}</label>
							                        	<?php
							                        	}
							                        }
							                        ?>
						                        </div>

						                        <div class="form-group panel-Box">
						                        	<div class="accord-title">Would you like to receive your bill electronically</div>
						                        	<label class="form-group accord-radio"><input type="radio" name="cable_internet_bill_electronically" value="1">Yes</label>
						                        	<label class="form-group accord-radio"><input type="radio" name="cable_internet_bill_electronically" value="0">No</label>
						                        </div>
						                        <div class="form-group panel-Box">
						                        	<div class="accord-title">Would you consider any contract plan</div>
						                        	<label class="form-group accord-radio"><input type="radio" name="cable_internet_contract_plan" value="1">Yes</label>
						                        	<label class="form-group accord-radio"><input type="radio" name="cable_internet_contract_plan" value="0">No</label>
						                        </div>
						                        <div class="form-group panel-Box">
						                        	<div class="accord-title">Would you want to setup pre-authorise payment</div>
						                        	<label class="form-group accord-radio"><input type="radio" name="cable_internet_preauthorise_payment" value="1">Yes</label>
						                        	<label class="form-group accord-radio"><input type="radio" name="cable_internet_preauthorise_payment" value="0">No</label>
						                        </div>
						                        <div class="form-group panel-Box">
						                        	<div class="accord-title">Callback option</div>
						                        	<label class="form-group accord-radio"><input type="radio" name="cable_internet_callback_option" value="1">Yes</label>
						                        	<label class="form-group accord-radio"><input type="radio" name="cable_internet_callback_option" value="0">No</label>
						                        </div>
						                        <div class="form-group panel-Box">
						                        	<div class="accord-title">Call back time?</div>
						                        	<label class="form-group accord-radio"> <input type="radio" name="cable_internet_callback_time" value="0">Anytime</label>
						                        	<label class="form-group accord-radio"> <input type="radio" name="cable_internet_callback_time" value="1">Daytime</label>
						                        	<label class="form-group accord-radio"> <input type="radio" name="cable_internet_callback_time" value="2">Evening</label>
						                        </div>
												<!--
						                        <div class="form-group panel-Box">
						                        	<div class="accord-title">Call me on?</div>
						                        	<input type="text" name="cable_internet_callback_primary_no" class="form-control" placeholder="Primary Number">
						                        	<input type="text" name="cable_internet_callback_secondary_no" class="form-control" placeholder="Additional Number">
						                        </div>-->
						                    </div>
						                </div>
						            </div>
									
									<div class="panel panel-default">
						                <div class="panel-heading">
						                    <h4 class="panel-title">
						                        <a data-toggle="collapse" data-parent="#accordion_internet_service" href="#cable_internet_services_collapse5">Availability</a>
						                    </h4>
						                </div>
						                <div id="cable_internet_services_collapse5" class="panel-collapse collapse">
						                    <div class="panel-body">
						                    	<div class="add-serv-data allDaydaTa">

						                    		<!-- <input type="" name="" class="datepicker">
						                    		<input type="" name="" class="datepicker">
						                    		<input type="" name="" class="datepicker"> -->

						                    		<div class="col-lg-2">Day 1</div>
						                    		<div class="col-lg-3"><input type="text" name="availability_date7" id="availability_date7" class="form-control datepicker"></div>
						                    		<div class="col-lg-3">
						                    			<select class="form-control" name="availability_time_from1" id="availability_time_from1">
						                    				<option value="">Select</option>
						                    				<option value="08:00AM to 07:00PM">All day</option>
						                    				<option value="08:00AM to 11:00AM">Morning</option>
						                    				<option value="12:00PM to 03:00PM">Afternoon</option>
						                    				<option value="03:00PM to 07:00PM">Evening</option>
						                    			</select>
						                    		</div>
						                    		<div class="col-lg-4">
						                    			<input type="text" name="availability_time_upto1" id="availability_time_upto1" class="form-control">
						                    		</div>
						                    	</div>
						                    	<div class="add-serv-data allDaydaTa">
						                    		<div class="col-lg-2">Day 2</div>
						                    		<div class="col-lg-3"><input type="text" name="availability_date8" id="availability_date8" class="form-control datepicker"></div>
						                    		<div class="col-lg-3">
						                    			<select class="form-control" name="availability_time_from2" id="availability_time_from2">
						                    				<option value="">Select</option>
						                    				<option value="08:00AM to 07:00PM">All day</option>
						                    				<option value="08:00AM to 11:00AM">Morning</option>
						                    				<option value="12:00PM to 03:00PM">Afternoon</option>
						                    				<option value="03:00PM to 07:00PM">Evening</option>
						                    			</select>
						                    		</div>
						                    		<div class="col-lg-4">
						                    			<input type="text" name="availability_time_upto2" id="availability_time_upto2" class="form-control">
						                    		</div>
						                    	</div>
						                    	<div class="add-serv-data allDaydaTa">
						                    		<div class="col-lg-2">Day 3</div>
						                    		<div class="col-lg-3"><input type="text" name="availability_date9" id="availability_date9" class="form-control datepicker"></div>
						                    		<div class="col-lg-3">
						                    			<select class="form-control" name="availability_time_from3" id="availability_time_from3">
						                    				<option value="">Select</option>
						                    				<option value="08:00AM to 07:00PM">All day</option>
						                    				<option value="08:00AM to 11:00AM">Morning</option>
						                    				<option value="12:00PM to 03:00PM">Afternoon</option>
						                    				<option value="03:00PM to 07:00PM">Evening</option>
						                    			</select>
						                    		</div>
						                    		<div class="col-lg-4">
						                    			<input type="text" name="availability_time_upto3" id="availability_time_upto3" class="form-control">
						                    		</div>
						                    	</div>
						                    </div>
						                </div>
						            </div>
									
									
									<!-- 23-1-2018 start -->
									<!-- <div class="panel panel-default">
						                <div class="panel-heading">
						                    <h4 class="panel-title">
						                        <a data-toggle="collapse" data-parent="#accordion_internet_service" href="#home_cleaning_services_collapse10">Call Me On</a>
						                    </h4>
						                </div>
						                <div id="home_cleaning_services_collapse10" class="panel-collapse collapse" aria-expanded="true" style="">
						                    <div class="panel-body">
						                        <div class="form-group panel-Box">
						                        	<input name="cable_internet_callback_primary_no" class="form-control accord-input" placeholder="Primary No. Ex: (123) 456 7899, (123)-456-7899, 123-456-7899, 123 456 7899" type="text">
						                        	<input name="cable_internet_callback_secondary_no" class="form-control accord-input" placeholder="Additional No. Ex: (123) 456 7899, (123)-456-7899, 123-456-7899, 123 456 7899" type="text">
						                        </div>
						                    </div>
						                </div>
						            </div> -->
									<!-- 23-1-2018 ends -->

						            <div class="panel panel-default">
						                <div class="panel-heading">
						                    <h4 class="panel-title">
						                        <a data-toggle="collapse" data-parent="#accordion_internet_service" href="#cable_internet_services_collapse4">Additional Information</a>
						                    </h4>
						                </div>
						                <div id="cable_internet_services_collapse4" class="panel-collapse collapse">
						                    <div class="panel-body">
						                        <div class="form-group">
						                        	<div class="accord-title"></div>
							                        <?php
							                        if( isset( $digitalAdditionalServices ) && count( $digitalAdditionalServices ) > 0 )
							                        {
							                        	foreach( $digitalAdditionalServices as $digitalAdditionalService )
							                        	{
							                        	?>
															<div class="row">
																<div class="col-sm-12">
																	<label class="form-group accord-radioFull"><input type="checkbox" name="cable_internet_additional_service[]" class="cable_internet_additional_service" value="{{ $digitalAdditionalService->id }}"> {{ $digitalAdditionalService->additional_service }}</label>
																</div>
															</div>
							                        	<?php
							                        	}
							                        }
							                        ?>
						                        </div>
						                    </div>
						                    <div class="panel-body">
											<textarea class="form-control accord-input" name="cable_internet_additional_info" id="cable_internet_additional_info" placeholder="Enter Additional Information here If Any"></textarea>
						                    </div>
						                </div>
						            </div>
						        </div>
								<div class="row">
									<div class="col-sm-12">
										<div class="clean-error">
											<div><label id="cable_internet_service_type[]-error" class="error" for="cable_internet_service_type[]"></label></div>
											<div><label id="availability_date7-error" class="error" for="availability_date7"></label></div>
											<div><label id="availability_time_from1-error" class="error" for="availability_time_from1"></label></div>
										</div>
										<button type="submit" class="btn btn-info" name="btn_cable_internet_submit_query" id="btn_cable_internet_submit_query">Submit</button>
									</div>
								</div>
						    </form>
      					</div>
		      		</div>
					</div>

		      	</div>
	      	</div>

	    </div>
  	</div>
</div>
<!-- Cable & Internet Service Modal End -->

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

<!-- Share Announcement Modal -->
<div id="share_announcement_modal" class="modal fade">
    <div class="modal-dialog modal-lg">
    <!-- Modal content-->
	    <div class="modal-content">
	    	<div class="modal-body">
	      		<div class="close close-btn close_modal" data-activity="share_announcement" data-dismiss="modal"><img src="{{ url('/images/movers/close-img.png') }}" alt=""></div>
		      	
		      	<!-- <div class="row" id="share_announcement_container">
		      		<div class="col-sm-4 col-md-4 col-lg-4">
					<div class="propertyiMage">
		      			<img src="{{ url('/images/house_sold.png') }}" height="200" width="250" alt="udistro">
					</div>
		      			<div class="specialThanksBox">
		      				<h4>Special Thanks to Agent {{ $agentName }}</h4>
		      				<ul class="ratingstar">
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
						<div class="announcement_right-box">
							<div class="row" id="announcement_message">
								<div class="col-sm-12">
									<div class="announcement_title">
										<h2>The {{ ucwords( strtolower( $clientName ) ) }} are moving!</h2>
									</div>
									<div class="clearfix"></div>
									<div class="announcement_message">
										<div class="hi_hello">Hi friends</div>
										<p>we are moving from South to North.</p>
										<p>Stop by Saturday night for a housewarming party!</p>
										<p>With love from</p>
										<div class="announc_Client_name">{{ ucwords( strtolower( $clientName ) ) }}</div>
									</div>
								</div>
							</div>
							<div class="clearfix"></div>
							<div class="bottom_Cdetails-Box">
								<div class="col-sm-12">
									<div class="col-sm-6 col-md-6 col-lg-6 right-box-border">
										<div class="row">
											<div class="col-sm-4">
												<div class="row">
													<img src="{{ ( $companyDetails->image != '' ) ? url('/images/company/' . $companyDetails->image) : url('/images/movers/company_icon.png') }}" height="60px" width="60px" alt="Udistro" />
												</div>
											</div>
											<div class="col-sm-8">
												<div class="row">
													<div class="company-Details">
														{{ ucwords( strtolower( $companyDetails->company_name ) ) }}
													</div>
													<div class="company-Details">
														{{ ucwords( strtolower( $companyDetails->address ) ) }}, {{ $companyProvince->name }}, {{ $companyCity->name }}, {{ $companyDetails->postal_code }}
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-sm-6 col-md-6 col-lg-6 text-left">
										<img src="{{ ( $agentDetails->image != '' ) ? url('/images/agents/' . $agentDetails->image) : url('/images/movers/user-avtar.png') }}" class="user-avtar" alt="Udistro" height="50px" width="50px">
										<div class="client-Details">
											{{ $agentName }}
										</div>
									</div>
								</div>
							</div>
						</div>
		      		</div>
		      	</div> --> 
		      	<!-- <div class="annou-modelfooter-wrap">
		      		<div class="col-sm-8 col-md-8 col-lg-8">
		      			<ul class="comment-group">
							<li><a href="javascript:void(0);" class="agent_helpful"><i class="fa fa-thumbs-up" aria-hidden="true"></i><span class="agent_helpful_count">{{ $agentHelpfulCount }}</span> Helpful</a></li>
							<li><a href="javascript:void(0);" id="share_announcement_edit_message"><i class="fa fa-pencil" aria-hidden="true"></i>Edit Message</a></li>
						</ul>
		      		</div>
		      		<div class="col-sm-4 col-md-4 col-lg-4">
		      			<div class="share-announc">Share this on: </div>
		      			<a href="javascript:void(0);" id="share_announcement_email"><i class="fa fa-envelope-square"></i></a>
		      		</div>
		      	</div> -->

		      	<table align="center" style=" background:#fff; width:870px;">
	      			<tr id="share_announcement_container">
	      				<td style="padding:10px; width: 200px;">
	      					<img src="{{ url('/images/house_sold.png') }}" height="200" width="250" alt="udistro">
	      					
	      					<!-- <div style="background: #f4f5f5; border-radius: 5px; margin-top: 15px; text-align: center; padding: 10px; font-size:16px;">
	      						<h4>Special Thanks to Agent<br> {{ $agentName }}</h4>
	      						<ul class="ratingstar" style="height: 40px;">
	      							<li><a href="javascript:void(0);"><i class="fa fa-star assign_agent_rating" aria-hidden="true"></i></a></li>
	      							<li><a href="javascript:void(0);"><i class="fa fa-star assign_agent_rating" aria-hidden="true"></i></a></li>
	      							<li><a href="javascript:void(0);"><i class="fa fa-star assign_agent_rating" aria-hidden="true"></i></a></li>
	      							<li><a href="javascript:void(0);"><i class="fa fa-star assign_agent_rating" aria-hidden="true"></i></a></li>
	      							<li><a href="javascript:void(0);"><i class="fa fa-star assign_agent_rating" aria-hidden="true"></i></a></li>
	      						</ul>
	      						<span>( {{ $agentRating }} Rating )</span>
	      					</div> -->

	      					<table style="text-align: center; width: 100%;">
	      						<tr>
	      							<td>
	      								<h4 style="margin-bottom: 10px;">Special Thanks to Agent<br> {{ $agentName }}</h4>
	      							</td>
	      						</tr>
	      					</table>
	      					<table align="center" style="text-align: center; width: 60%;">
	      						<tr class="ratingstar">
	      							<td style=""><a style="color: #dbdbdb;" href="javascript:void(0);"><i class="fa fa-star assign_agent_rating" aria-hidden="true"></i></a></td>
	      							<td style=""><a style="color: #dbdbdb;" href="javascript:void(0);"><i class="fa fa-star assign_agent_rating" aria-hidden="true"></i></a></td>
	      							<td style=""><a style="color: #dbdbdb;" href="javascript:void(0);"><i class="fa fa-star assign_agent_rating" aria-hidden="true"></i></a></td>
	      							<td style=""><a style="color: #dbdbdb;" href="javascript:void(0);"><i class="fa fa-star assign_agent_rating" aria-hidden="true"></i></a></td>
	      							<td style=""><a style="color: #dbdbdb;" href="javascript:void(0);"><i class="fa fa-star assign_agent_rating" aria-hidden="true"></i></a></td>
	      						</tr>
	      					</table>
	      					<table style="text-align: center; width: 100%; margin:15px 0 0;">
	      						<!-- <tr>
	      							<td>( {{ $agentRating }} Rating )</td>
	      						</tr> -->
	      					</table>
	      				</td>
	      				<td style="padding: 10px; vertical-align: top;">
	      					<table style="text-align: center; background: #f3f9fc; width:100%; line-height: 33px;">
	      						<tr class="content_editable">
	      							<td><h2>The {{ ucwords( strtolower( $clientName ) . "'s" ) }} are moving!</h2></td>
	      						</tr>
	      						<tr class="content_editable">
	      							<td>Hi friends</td>
	      						</tr>
	      						<tr class="content_editable">
	      							<td>we are moving from South to North.</td>
	      						</tr>
	      						<tr class="content_editable">
	      							<td>Stop by Saturday night for a housewarming party!</td>
	      						</tr>
	      						<tr class="content_editable">
	      							<td>With love from</td>
	      						</tr>
	      						<tr class="content_editable">
	      							<td>{{ ucwords( strtolower( $clientName ) ) }}</td>
	      						</tr>
	      						<tr>
	      							<td>
	      								<table style="width: 100%; border-top:1px solid #dceaf1;">
	      									<tr>
	      										<td style="text-align: left; font-size: 14px; padding: 0px 10px; width: 50%; border-right:1px solid #dceaf1;">
	      											<table>
	      												<tr>
	      													<td>
	      														<img src="{{ ( $companyDetails->image != '' ) ? url('/images/company/' . $companyDetails->image) : url('/images/movers/company_icon.png') }}" height="60px" width="60px" alt="Udistro" />
	      													</td>
	      													<td style="padding: 15px;">
	      														{{ ucwords( strtolower( $companyDetails->company_name ) ) }}
	      														{{ ucwords( strtolower( $companyDetails->address ) ) }}, {{ $companyProvince->name }}, {{ $companyCity->name }}, {{ $companyDetails->postal_code }}
	      													</td>
	      												</tr>
	      											</table>
	      										</td>
	      										<td style="width: 50%; text-align: left; padding-left: 10px;">
	      											<span>
	      												<img src="{{ ( $agentDetails->image != '' ) ? url('/images/agents/' . $agentDetails->image) : url('/images/movers/user-avtar.png') }}" class="user-avtar" alt="Udistro" height="50px" width="50px">
	      											</span>
	      											<span>{{ $agentName }}</span>
	      										</td>
	      									</tr>
	      								</table>
	      							</td>
	      						</tr>
	      					</table>
	      				</td>
	      			</tr>
	      			<tr style="border:1px solid #dceaf1;">
	      				<td>
	      					<table>
	      						<tr>
	      							<td style="padding: 10px; font-size: 14px;"><a href="javascript:void(0);" class="agent_helpful"><i class="fa fa-thumbs-up" aria-hidden="true"></i><span class="agent_helpful_count"> {{ $agentHelpfulCount }}</span> Helpful</a></td>
	      							<td style="padding: 10px 10px 10px 55px; font-size: 14px;"><a href="javascript:void(0);" id="share_announcement_edit_message"><i class="fa fa-pencil" aria-hidden="true"></i> Edit Message</a></td>
	      						</tr>
	      					</table>
	      				</td>
	      				<td style="text-align: right; padding: 10px;">
	      					<table width="90%;">
	      						<tr>
	      							<td colspan="2">Share this on: <a href="javascript:void(0);" id="share_announcement_email"><i class="fa fa-envelope-square"></i></a></td>
	      						</tr>
	      					</table>
	      				</td>
	      			</tr>
	      		</table>


		    </div>
		</div>
	</div>
</div>
<!-- Share Announcement Modal -->

<!-- Share Announcement Email Modal -->
<div id="share_announcement_email_modal" class="modal fade">
    <div class="modal-dialog modal-lg">
    <!-- Modal content-->
	    <div class="modal-content">
	    	<div class="modal-body">
	      		<div class="close close-btn close_modal" data-activity="share_announcement" data-dismiss="modal"><img src="{{ url('/images/movers/close-img.png') }}" alt=""></div>
		      	
      	      	<div id="share_announcement_content">
      	      		<!-- Dynamic content here -->
      	      	</div>

		      	<div>
		      		<form name="frm_announcement_email" id="frm_announcement_email">
			      		<div class="form-group">
			                <input class="form-control" type="text" name="announcement_emails" id="announcement_emails" placeholder="Email id's seperated by comma" autocomplete="off">
			            </div>
			            <div class="form-group">
			            	<button type="submit" class="btn btn-primary" name="btn_send_announcement_email" id="btn_send_announcement_email">Send Email</button>
			            </div>
		      		</form>
		      	</div>

		    </div>
		</div>
	</div>
</div>
<!-- Share Announcement Email Modal -->

<!-- for share announcement purpose -->
<img id="star_image" style="display: none;" src="{{ url('/images/star.png') }}" alt="">

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

<!-- To handle the Is this activity helpful thing -->
<div id="user_activity_helpful_response_modal" class="modal fade">
    <div class="modal-dialog">
    <!-- Modal content-->
	    <div class="modal-content">
	    	<div class="modal-body">
	      		<div class="close close-btn" data-dismiss="modal"><img src="{{ url('/images/movers/close-img.png') }}" alt=""></div>
	      		<h4 class="modal-title">Is this helpful to you?</h4>
		    </div>
		    <div class="modal-footer">
				<form name="frm_activity_helpful_user_response" id="frm_activity_helpful_user_response">
	            	<!-- To hold the activity name generated dynamically -->
	            	<input type="hidden" name="activity_name" id="activity_name" value="">

	                <button type="button" class="btn btn-primary activity_feedback" id="1" data-dismiss="modal">Yes</button>
	                <button type="button" class="btn btn-primary activity_feedback" id="0" data-dismiss="modal">No</button>
                </form>
			</div>
		</div>
	</div>
</div>
<!-- To handle the Is this activity helpful thing -->

<div class="center-copypart text-center">
	<p>Copyright &copy; {{ date('Y') }} Udistro | All Rights Reserved</p>
</div>

</body>
</html> 