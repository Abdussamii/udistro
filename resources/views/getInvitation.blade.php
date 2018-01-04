<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="route" content="{{ url('/') }}">

<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<title>uDistro</title>

	<!-- Bootstrap -->
	<!-- <link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet"> -->

	<link rel="stylesheet" href="{{ URL::asset('css/bootstrap.min.css') }}" />
	<link rel="stylesheet" href="{{ URL::asset('css/style_landing_page.css') }}" />

	<!-- Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600" rel="stylesheet">
	<!-- <link href="css/font-awesome.min.css" rel="stylesheet"> -->
	<link rel="stylesheet" href="{{ URL::asset('css/font-awesome.min.css') }}" />

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	    <![endif]-->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
    <script src="{{ URL::asset('js/jquery.min.js') }}"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed --> 
    <!-- <script src="js/bootstrap.min.js"></script>  -->
    <script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>

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
  <div class="navbar-header"> <a class="navbar-brand" href="#"><img src="images/logo.png" alt="Udistro" /></a> </div>
  <ul class="nav navbar-nav navbar-right navbar-top-link">
   <li><a href="#">
    <button type="button" class="btn top-btn1">I Help Others Move</button>
    </a></li>
   <li><a href="#">
    <button type="button" class="btn top-btn1">I Am a Business</button>
    </a></li>
  </ul>
 </div>
</nav>
<!-- End Navbar --> 
<!-- Video Section-->
<section class="content-section video-section">
 <div class="video_bg">
  <video autoplay loop class="fillWidth" width="100%">
   <source src="images/udistro-video.webm" type="video/webm" />
   Your browser does not support the video tag. I suggest you upgrade your browser.
   <source src="images/udistro-video.mp4" type="video/mp4" />
   Your browser does not support the video tag. I suggest you upgrade your browser. </video>
  <div class="poster hidden"> <!-- <img src="PATH_TO_JPEG" alt=""> --> </div>
  <div class="overlay-bg"></div>
  <div class="container">
   <div class="row">
    <div class="col-lg-12">
     <div class="logo_banner"><img src="images/banner-logo.png" class="center-block img-responsive" alt="udistro"></div>
     <h1 class="title_banner">Improving relocation experience for 4 million household movers in Canada every year.</h1>
     <div class="banner_btn-group center-block">
      <!-- <button type="button" class="btn banner_btn btn-lg skyBlue_btn">I am Moving</button> -->
      <a href="{{ url('/getinvitation') }}" class="btn banner_btn btn-lg skyBlue_btn">I am Moving</a>
      <a href="#learn_more"><button type="button" class="btn banner_btn btn-lg white_btn">Learn More</button></a>
     </div>
    </div>
   </div>
  </div>
  <a href="#" class="scroll-down" address="true"></a> </div>
</section>
<!--Video Section Ends Here--> 

<!-- Let’s Organize Your Move -->
<section class="content-section section-pd" id="learn_more">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="section-organise">
					<h2 class="center-block title-main">Get Invitation</h2>
					<div>
						<div class="container">
							<form class="form-horizontal" name="frm_get_invitation" id="frm_get_invitation" autocomplete="off">
								<div class="form-group">
								  	<label class="control-label col-sm-2" for="fname">First Name:</label>
									<div class="col-sm-10">
										<input type="text" class="form-control" id="fname" name="fname" placeholder="First name">
									</div>
								</div>
								<div class="form-group">
								  	<label class="control-label col-sm-2" for="lname">Last Name:</label>
									<div class="col-sm-10">          
										<input type="text" class="form-control" id="lname" name="lname" placeholder="Last name">
									</div>
								</div>
								<div class="form-group">
								  	<label class="control-label col-sm-2" for="email">Email:</label>
									<div class="col-sm-10">          
										<input type="text" class="form-control" id="email" name="email" placeholder="Email Id">
									</div>
								</div>
								<div class="form-group">
								  	<label class="control-label col-sm-2" for="mobile">Mobile No:</label>
									<div class="col-sm-10">          
										<input type="text" class="form-control" id="mobile" name="mobile" placeholder="Mobile number">
									</div>
								</div>
								
								<div class="form-group"><label class="control-label">Moving From Address</label></div>
								<div class="form-group">
								  	<label class="control-label col-sm-2" for="moving_from_address1">Address 1:</label>
									<div class="col-sm-10">          
										<input type="text" class="form-control" id="moving_from_address1" name="moving_from_address1" placeholder="Address Line 1">
									</div>
								</div>
								<div class="form-group hide">
								  	<label class="control-label col-sm-2" for="moving_from_address2">Address 2:</label>
									<div class="col-sm-10">          
										<input type="text" class="form-control" id="moving_from_address2" name="moving_from_address2" placeholder="Address Line 2">
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
								  	<label class="control-label col-sm-2" for="moving_from_postalcode">Postal Code:</label>
									<div class="col-sm-10">          
										<input type="text" class="form-control" id="moving_from_postalcode" name="moving_from_postalcode" placeholder="Postal code">
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

								<div class="form-group"><label class="control-label">Moving To Address</label></div>
								<div class="form-group">
								  	<label class="control-label col-sm-2" for="moving_to_address1">Address 1:</label>
									<div class="col-sm-10">          
										<input type="text" class="form-control" id="moving_to_address1" name="moving_to_address1" placeholder="Address Line 1">
									</div>
								</div>
								<div class="form-group hide">
								  	<label class="control-label col-sm-2" for="moving_to_address2">Address 2:</label>
									<div class="col-sm-10">          
										<input type="text" class="form-control" id="moving_to_address2" name="moving_to_address2" placeholder="Address Line 2">
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
								<div class="form-group">
								  	<label class="control-label col-sm-2" for="moving_date">Moving Date:</label>
									<div class="col-sm-10">          
										<input type="text" class="form-control datepicker" id="moving_date" name="moving_date" placeholder="Moving date">
									</div>
								</div>
								<div class="form-group"> 
									<button type="submit" class="btn btn-default" name="btn_submit_invitation_details" id="btn_submit_invitation_details">Submit</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- Footer Starts -->

<footer class="footer-main section-pd">
 <div class="container">
  <div class="row">
   <div class="col-md-4">
    <div class="foot_logo">
    	<!-- <img src="images/logo-foot.png" alt=""/> -->
    	<img src="{{ url('/images/landing_page1/logo-foot.png') }}" alt="" />
    </div>
    <ul class="footer_social_icon">
     <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
     <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
     <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
     <li><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
     <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
    </ul>
    <address>
    <h4></h4>
    <ul>
     <li><strong>Winnipeg, Manitoba</strong></li>
     <li><i class="fa fa-phone" aria-hidden="true"></i> 204-807-6739</li>
     <li><i class="fa fa-phone" aria-hidden="true"></i> 204-330-7058</li>
     <li><i class="fa fa-phone" aria-hidden="true"></i> 204-981-5847</li>
     <li><i class="fa fa-map-marker" aria-hidden="true"></i> 610 Kirkbridge Drive</li>
    </ul>
    </address>
   </div>
   <div class="col-md-3">
    <div class="media-body client-achive-step">
     <h2 class="media-heading">Company</h2>
    </div>
    <ul class="list-group custom-listgroup">
     <li class="list-group-item"><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i>About</a></li>
     <li class="list-group-item"><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i>Our Team</a></li>
     <li class="list-group-item"><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i>Management</a></li>
     <li class="list-group-item"><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i>Our Customers</a></li>
    </ul>
   </div>
   <div class="col-md-3">
    <div class="media-body client-achive-step">
     <h2 class="media-heading">Important Links</h2>
    </div>
    <ul class="list-group custom-listgroup">
     <li class="list-group-item"><a href="#"> <i class="fa fa-angle-double-right" aria-hidden="true"></i>Login</a></li>
     <li class="list-group-item"><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i>Free Trial</a></li>
     <li class="list-group-item"><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i>Support</a></li>
     <li class="list-group-item"><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i>Schedule Demo</a></li>
    </ul>
   </div>
   <div class="col-md-2">
    <div class="media-body client-achive-step">
     <h2 class="media-heading">Resources</h2>
    </div>
    <ul class="list-group custom-listgroup">
     <li class="list-group-item"><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i>Events</a></li>
     <li class="list-group-item"><a href="#"> <i class="fa fa-angle-double-right" aria-hidden="true"></i>Help Center</a></li>
     <li class="list-group-item"><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i>Blog</a></li>
     <li class="list-group-item"><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i>Videos</a></li>
    </ul>
   </div>
  </div>
  
  <!-- -->
  <div class="footerAdditional">
   <ul>
    <li> <a href="#">Privacy</a> </li>
    <li> <a href="#">Terms</a> </li>
    <li> <a href="#">I Help Others Move</a> </li>
    <li> <a href="#">I Am a Business</a> </li>
    <li class="footerAdditional-item--copyright"> © uDistro 2017 All Rights Reserved </li>
   </ul>
  </div>
  <!-- --> 
  
 </div>
</footer>

</body>
</html>