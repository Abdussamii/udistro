<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="route" content="{{ url('/') }}">

    <title>@yield('title')</title>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
	<script type="text/javascript" src="{{ URL::asset('js/jquery.min.js') }}"></script>

	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script type="text/javascript" src="{{ URL::asset('js/bootstrap.min.js') }}"></script>

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
	});
	</script>

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
   	
    <link rel="stylesheet" href="{{ URL::asset('css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('css/style_other_pages.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('css/media.css') }}" />
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600" rel="stylesheet">
    
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

    <style type="text/css">
    .error {
    	color: red;
    }
    </style>

    <script type="text/javascript">
    $(document).ready(function(){
    	
    });
    </script>

</head>

<body>

	<div id="page-wrapper">
        @yield('content')
    </div>

	<!-- Footer Starts -->
	<footer class="footer-main section-pd">
	 <div class="container">
	  <div class="row">
	   <div class="col-md-4">
	    <div class="foot_logo">
	    	<!-- <img src="images/logo-foot.png" alt=""/> -->
	    	<img src="http://www.udistro.ca/images/landing_image/logo-foot.png" alt="">
	    </div>
	    <ul class="footer_social_icon">
	     <li><a href="https://www.facebook.com/udistro.rakoomi" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
	     <li><a href="https://www.linkedin.com/in/udistro-rakoomi-043323153/" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
	     <li><a href="https://twitter.com/udistroca" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
	     <li><a href="https://plus.google.com/" target="_blank"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
	     <li><a href="https://www.instagram.com/udistroca" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
	     <li><a href="" target="_blank"><i class="fa fa-youtube" aria-hidden="true"></i></a></li>
	    </ul>
	    <address>
	    <h4></h4>
	    <ul>
	     <li class="address-post">Winnipeg, Manitoba</li>
	     <li><i class="fa fa-phone" aria-hidden="true"></i> Fongo Phone: 204-202-3377</li>
	     <li><i class="fa fa-map-marker" aria-hidden="true"></i> 610 Kirkbridge Drive</li>
	    </ul>
	    </address>
	   </div>
	   <div class="col-md-3 col-sm-4">
	    <div class="media-body client-achive-step">
	     <h2 class="media-heading">Company</h2>
	    </div>
	    <ul class="list-group custom-listgroup">
	     <li class="list-group-item"><a href="{{ url('/aboutus') }}"><i class="fa fa-angle-double-right" aria-hidden="true"></i>About</a></li>
	     <li class="list-group-item"><a href="{{ url('/ourteam') }}"><i class="fa fa-angle-double-right" aria-hidden="true"></i>Our Team</a></li>
	     <li class="list-group-item"><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i>Management</a></li>
	     <li class="list-group-item"><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i>Our Customers</a></li>
	    </ul>
	   </div>
	   <div class="col-md-3 col-sm-4">
	    <div class="media-body client-achive-step">
	     <h2 class="media-heading">Important Links</h2>
	    </div>
	    <ul class="list-group custom-listgroup">
	     <li class="list-group-item"><a href="{{ url('/login') }}"> <i class="fa fa-angle-double-right" aria-hidden="true"></i>Login</a></li>
	     <li class="list-group-item"><a href="{{ url('/freetrial') }}"><i class="fa fa-angle-double-right" aria-hidden="true"></i>Free Trial</a></li>
	     <li class="list-group-item"><a href="{{ url('/helpcenter') }}"><i class="fa fa-angle-double-right" aria-hidden="true"></i>Support</a></li>
	     <li class="list-group-item"><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i>Schedule Demo</a></li>
	    </ul>
	   </div>
	   <div class="col-md-2 col-sm-4">
	    <div class="media-body client-achive-step">
	     <h2 class="media-heading">Resources</h2>
	    </div>
	    <ul class="list-group custom-listgroup">
	     <li class="list-group-item"><a href="{{ url('/events') }}"><i class="fa fa-angle-double-right" aria-hidden="true"></i>Events</a></li>
	     <li class="list-group-item"><a href="{{ url('/helpcenter') }}"> <i class="fa fa-angle-double-right" aria-hidden="true"></i>Help Center</a></li>
	     <li class="list-group-item"><a href="https://udistro424000759.wordpress.com/" target="_blank"><i class="fa fa-angle-double-right" aria-hidden="true"></i>Blog</a></li>
	     <li class="list-group-item"><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i>Videos</a></li>
	    </ul>
	   </div>
	  </div>
	  
	  <!-- -->
	  <div class="footerAdditional">
	   <ul>
	    <li> <a href="faquestions.html">FAQs</a> </li>
	    <li> <a href="https://termsfeed.com/privacy-policy/78d745deeed0b145a84dbc4b46e88912" target="_blank">Privacy</a> </li>
	    <li> <a href="https://termsfeed.com/terms-conditions/ecb999172c16298afdddc8eb94b9a21b" target="_blank">Terms</a> </li>
	    <li> <a href="{{ url('/agent/home') }}">I’m a Real-Estate Agent</a> </li>
	    <li> <a href="{{ url('/getinvitation') }}">I'm a Moving</a> </li>
	    <li class="footerAdditional-item--copyright"> © uDistro 2017 All Rights Reserved </li>
	   </ul>
	  </div>
	  <!-- --> 
	  
	 </div>
	</footer>

</body>

</html>