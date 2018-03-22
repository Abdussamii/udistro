@extends('layouts.app')
@section('title', 'Udistro')

@section('content')

	<!-- Home JS -->
    <script src="{{ URL::asset('js/custom/home.js') }}"></script>

    <!-- JQuery Validation -->
    <script type="text/javascript" src="{{ URL::asset('js/jquery.validate.min.js') }}"></script>

    <!-- Canada Post Address Auto-complete API -->
	<script type="text/javascript" src="https://ws1.postescanada-canadapost.ca/js/addresscomplete-2.30.min.js?key=kp88-mx67-ff25-xd59"></script>
	<link rel="stylesheet" type="text/css" href="https://ws1.postescanada-canadapost.ca/css/addresscomplete-2.30.min.css?key=kp88-mx67-ff25-xd59" />

	<!-- JS Alert Plug-in -->
	<script type="text/javascript" src="{{ URL::asset('js/alertify.min.js') }}"></script>
	<link rel="stylesheet" href="{{ URL::asset('css/alertify.min.css') }}" />

	<!-- Jquery UI for datepicker -->
	<script type="text/javascript" src="{{ URL::asset('js/jquery-ui.min.js') }}"></script>
	<link rel="stylesheet" href="{{ URL::asset('css/jquery-ui.min.css') }}" />

    <script>
    $(function() {
    	$('.scroll-down').click (function() {
    	  $('html, body').animate({scrollTop: $('section.ok').offset().top }, 'slow');
    	  return false;
    	});
    	
    	var navbar = $('.navbar');
        $(window).scroll(function(){
            if($(window).scrollTop() <= 40){
           		navbar.css('display', 'none');
            } else {
              navbar.css('display', 'block'); 
            }
        });

        // Datepicker intialize
		$('.datepicker').datepicker({
			dateFormat: 'dd-mm-yy',
			// minDate: 0
			minDate: '+15'	// enable the dates after 15 days only
		}); 
    });

    var fields1 = [
    	{ element: "moving_from_address1", field: "Line1" },
    	{ element: "moving_from_address2", field: "Line2", mode: pca.fieldMode.POPULATE },
    	{ element: "moving_from_city", field: "City", mode: pca.fieldMode.POPULATE },
    	{ element: "moving_from_province", field: "ProvinceName", mode: pca.fieldMode.POPULATE },
    	{ element: "moving_from_postalcode", field: "PostalCode" },
    	{ element: "moving_from_country", field: "CountryName", mode: pca.fieldMode.COUNTRY }
    ],
    options1 = {
    	key: "kp88-mx67-ff25-xd59"
    },
    control = new pca.Address(fields1, options1);

    var fields2 = [
    	{ element: "moving_to_address1", field: "Line1" },
    	{ element: "moving_to_address2", field: "Line2", mode: pca.fieldMode.POPULATE },
    	{ element: "moving_to_city", field: "City", mode: pca.fieldMode.POPULATE },
    	{ element: "moving_to_province", field: "ProvinceName", mode: pca.fieldMode.POPULATE },
    	{ element: "moving_to_postalcode", field: "PostalCode" },
    	{ element: "moving_to_country", field: "CountryName", mode: pca.fieldMode.COUNTRY }
    ],
    options2 = {
    	key: "kp88-mx67-ff25-xd59"
    },
    control = new pca.Address(fields2, options2);
    </script>

	<nav class="navbar navbar-inverse navbar-fixed-top" style="display: block;">
	 <div class="container-fluid">
	  <div class="navbar-header"> <a class="navbar-brand" href="{{ url('/') }}"><img src="{{ url('/images/logo.png') }}" alt="Udistro"></a> </div>
	  <ul class="nav navbar-nav navbar-right navbar-top-link">
	   <li><a href="http://www.udistro.ca">
	    <button type="button" class="btn top-btn1">Back to Home Page</button>
	    </a></li>
	  </ul>
	 </div>
	</nav>
	<!-- Banner Starts -->
	<section class="topic-banner">
			<img src="{{ url('/images/getinvitation-banner.png') }}" alt="Udistro" /> 
	</section>
	<!-- Banner Ends -->

	<!-- Let’s Organize Your Move -->
	<section class="content-section section-pd" id="learn_more">
		<div class="container">
			<div class="row">
				<div class="getInvitation-wrap">
					<div class="section-organise">
						<h2 class="center-block title-main">Get Invitation</h2>
						<div>
							<div class="container invitation-wrapper">
								<form class="form-horizontal" name="frm_get_invitation" id="frm_get_invitation" autocomplete="off">
									<div class="form-group inputBOXs">
										<div class="col-sm-12">
											<i class="fa fa-user" aria-hidden="true"></i>
											<input type="text" class="form-control" id="fname" name="fname" placeholder="Enter Your First name">
										</div>
									</div>
									<div class="form-group inputBOXs">
										<div class="col-sm-12">
											<i class="fa fa-user" aria-hidden="true"></i>
											<input type="text" class="form-control" id="lname" name="lname" placeholder="Enter Your Last name">
										</div>
									</div>
									<div class="form-group inputBOXs">
										<div class="col-sm-12">
											<i class="fa fa-envelope-open" aria-hidden="true"></i>
											<input type="text" class="form-control" id="email" name="email" placeholder="Enter Your Email Address">
										</div>
									</div>
									<div class="form-group inputBOXs">
										<div class="col-sm-12">
											<i class="fa fa-mobile" aria-hidden="true"></i>
											<input type="text" class="form-control" id="mobile" name="mobile" placeholder="Enter Your Phone number">
										</div>
									</div>
									<div class="form-group inputBOXs">
										<div class="col-sm-12">
											<i class="fa fa-address-card" aria-hidden="true"></i>
											<input type="text" class="form-control" id="moving_from_address1" name="moving_from_address1" placeholder="Enter The Address You Are Moving From">
										</div>
									</div>
									<div class="form-group hide">
										<div class="col-sm-12">
											<i class="fa fa-address-card" aria-hidden="true"></i>
											<input type="text" class="form-control" id="moving_from_address2" name="moving_from_address2" placeholder="Enter The Address You Are Moving From">
										</div>
									</div>
									<div class="form-group hide">
									  	<label class="control-label col-sm-2" for="moving_from_province">Province:</label>
										<div class="col-sm-10">          
											<select name="moving_from_province" id="moving_from_province" class="form-control">
												<option value="">Select</option>
												<?php
												if( isset( $provinces ) && count( $provinces ) > 0 )
												{
													foreach($provinces as $province)
													{
														echo '<option data-abbreviation="'. $province->abbreviation .'" value="'. $province->id .'">'. $province->name .'</option>';
													}
												}
												?>
											</select>
										</div>
									</div>
									<div class="form-group hide">
									  	<label class="control-label col-sm-2" for="moving_from_city">City:</label>
										<div class="col-sm-10">          
											<select name="moving_from_city" id="moving_from_city" class="form-control">
												<option value="">Select</option>
												<?php
												if( isset( $cities ) && count( $cities ) > 0 )
												{
													foreach($cities as $city)
													{
														echo '<option value="'. $city->id .'">'. $city->name .'</option>';
													}
												}
												?>
											</select>
										</div>
									</div>
									<div class="form-group hide">
										<div class="col-sm-12">          
											<input type="text" class="form-control" id="moving_from_postalcode" name="moving_from_postalcode" placeholder="Enter Your Postal code">
										</div>
									</div>
									<div class="form-group hide">
									  	<label class="control-label col-sm-2" for="moving_from_country">Country:</label>
										<div class="col-sm-10">          
											<select name="moving_from_country" id="moving_from_country" class="form-control">
												<option value="">Select</option>
												<?php
												if( isset( $countries ) && count( $countries ) > 0 )
												{
													foreach($countries as $country)
													{
														echo '<option value="'. $country->id .'">'. $country->name .'</option>';
													}
												}
												?>
											</select>
										</div>
									</div>

									<div class="form-group inputBOXs">
										<div class="col-sm-12">
											<i class="fa fa-address-card" aria-hidden="true"></i>
											<input type="text" class="form-control" id="moving_to_address1" name="moving_to_address1" placeholder="Enter The Address You Are Moving TO">
										</div>
									</div>
									<div class="form-group hide">
										<div class="col-sm-12">
											<i class="fa fa-address-card" aria-hidden="true"></i>
											<input type="text" class="form-control" id="moving_to_address2" name="moving_to_address2" placeholder="Enter The Address You Are Moving TO">
										</div>
									</div>
									<div class="form-group hide">
									  	<label class="control-label col-sm-2" for="moving_to_province">Province:</label>
										<div class="col-sm-10">          
											<select name="moving_to_province" id="moving_to_province" class="form-control">
												<option value="">Select</option>
												<?php
												if( isset( $provinces ) && count( $provinces ) > 0 )
												{
													foreach($provinces as $province)
													{
														echo '<option data-abbreviation="'. $province->abbreviation .'" value="'. $province->id .'">'. $province->name .'</option>';
													}
												}
												?>
											</select>
										</div>
									</div>
									<div class="form-group hide">
									  	<label class="control-label col-sm-2" for="moving_to_city">City:</label>
										<div class="col-sm-10">          
											<select name="moving_to_city" id="moving_to_city" class="form-control">
												<option value="">Select</option>
												<?php
												if( isset( $cities ) && count( $cities ) > 0 )
												{
													foreach($cities as $city)
													{
														echo '<option value="'. $city->id .'">'. $city->name .'</option>';
													}
												}
												?>
											</select>
										</div>
									</div>
									<div class="form-group hide">
									  	<label class="control-label col-sm-2" for="moving_to_postalcode">Postal Code:</label>
										<div class="col-sm-10">          
											<input type="text" class="form-control" id="moving_to_postalcode" name="moving_to_postalcode" placeholder="Postal code">
										</div>
									</div>
									<div class="form-group hide">
									  	<label class="control-label col-sm-2" for="moving_to_country">Country:</label>
										<div class="col-sm-10">          
											<select name="moving_to_country" id="moving_to_country" class="form-control">
												<option value="">Select</option>
												<?php
												if( isset( $countries ) && count( $countries ) > 0 )
												{
													foreach($countries as $country)
													{
														echo '<option value="'. $country->id .'">'. $country->name .'</option>';
													}
												}
												?>
											</select>
										</div>
									</div>
									<div class="form-group inputBOXs">
										<div class="col-sm-12">
											<i class="fa fa-calendar" aria-hidden="true"></i>
											<input type="text" class="form-control datepicker" id="moving_date" name="moving_date" placeholder="Enter The Date You Are Moving" readonly="true">
										</div>
									</div>
									<div class="form-group"> 
										<button type="submit" class="btn btn-default" name="btn_submit_invitation_details" id="btn_submit_invitation_details">Get an Invite</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

@endsection