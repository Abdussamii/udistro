<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<title>uDistro</title>

<!-- Bootstrap -->
<!-- <link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet"> -->

<link rel="stylesheet" href="{{ URL::asset('css/bootstrap.min.css') }}" />
<link rel="stylesheet" href="{{ URL::asset('css/style_landing_page3.css') }}" />

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
</head>
<body>
<!-- Navbar -->
<nav class="navbar navbar-inverse navbar-fixed-top" style="display:none;">
 <div class="container-fluid">
  <div class="navbar-header">
  	<a class="navbar-brand" href="#">
  		<!-- <img src="images/logo.png" alt="Udistro" /> -->
  		<img src="{{ url('/images/logo.png') }}" alt="" />
  	</a>
  </div>
  <ul class="nav navbar-nav navbar-right navbar-top-link">
   <li><a href="#">
    <button type="button" class="btn top-btn1">I Am Moving</button>
    </a></li>
   <li><a href="#">
    <button type="button" class="btn top-btn1">I Help Others Move</button>
    </a></li>
  </ul>
 </div>
</nav>
<!-- End Navbar --> 
<!-- Video Section -->
<section class="content-section video-section">
 <div class="video_bg">
  <video autoplay loop class="fillWidth" width="100%">
   <!-- <source src="images/udistro-video.webm" type="video/webm" /> -->
   <source src="{{ url('/images/udistro-video.webm') }}" type="video/webm" />
   Your browser does not support the video tag. I suggest you upgrade your browser.
   <!-- <source src="images/udistro-video.mp4" type="video/mp4" /> -->
   <source src="{{ url('/images/udistro-video.mp4') }}" type="video/webm" />
   Your browser does not support the video tag. I suggest you upgrade your browser. </video>
  <div class="poster hidden"> <!-- <img src="PATH_TO_JPEG" alt=""> --> </div>
  <div class="overlay-bg"></div>
  <div class="container">
   <div class="row">
    <div class="col-lg-12">
     <div class="logo_banner">
     	<!-- <img src="images/banner-logo.png" class="center-block img-responsive" alt="udistro"> -->
     	<img src="{{ url('/images/banner-logo.png') }}" class="center-block img-responsive" alt="" />
     </div>
     <h1 class="title_banner">Improving relocation experience for 4 million household movers in Canada every year.</h1>
     <div class="banner_btn-group center-block">
      <button type="button" class="btn banner_btn btn-lg skyBlue_btn">I am a business</button>
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
     <h2 class="center-block title-main">uDistro For Local Businesses</h2>
     <p class="discretion">Udistro is a powerful contextual marketing application that is reinventing advertising experience for all stakeholders in the relocation ecosystem, including moving, cleaning and storage companies, cable, satelite and internet service providers.</p>
     <div class="videopart-2 row">
      <div class="col-md-7">
       <div class="video_box">
        <iframe width="100%" height="100%" src="https://www.youtube.com/embed/y-UPRuHv0lc?rel=0&amp;showinfo=0" frameborder="0" gesture="media" allow="encrypted-media" allowfullscreen></iframe>
       </div>
      </div>
      <div class="col-md-5">
       <div class="bullet-point">
        <ul>
         <li><span>1</span>
          <p>With uDistro, you are only going to get business requests from people who are actively seeking to use your services.</p>
         </li>
         <li><span>2</span>
          <p>We make sure that you have everything you need to get the next job offer. From tips, to prodcutivity features all avalable at your finger tips.</p>
         </li>
         <li><span>3</span>
          <p>Standout in your local market, engage your new lead one on one, bargain and send then quotes all within uDistro for few cents per day.</p>
         </li>
         <li><span>4</span>
          <p>uDistro gives you complete control to manage your your review and rating and correct the impresion of customer if you ever get back review.</p>
         </li>
        </ul>
       </div>
       <div class="banner_btn-group center-block">
        <button type="button" class="btn try_btn btn-lg blue_btn">Start your free trial today!</button>
       </div>
      </div>
     </div>
    </div>
   </div>
  </div>
 </div>
</section>

<!-- Let’s Organize Your Move -->
<section class="content-section udistro_client section-pd">
 <div class="container">
  <div class="row">
   <div class="col-md-12">
    <div class="section-organise">
     <h2 class="center-block title-main">Get to the market before your customer does!</h2>
     <p class="discretion">Our end to end moving application helps you organize all your moving related task into few manageable recommended steps performed from a single location.</p>

     <div class="row">
      <div class="col-md-12 local_b_3">
      <div class="col-md-4 box-border">
      			<div class="udistro_client">
      				<!-- <img src="images/time-save.png" alt=""/> -->
      				<img src="{{ url('/images/landing_page3/time-save.png') }}" alt="" />
      			</div>
         <div class="heading2">Get New Leads</div>
         <p>uDistro furnel technology provides you with the tools to succeed, the only thing that can stop you on our market place is your attitute.</p>
      </div>
      <div class="col-md-4 box-border">
      			<div class="udistro_client">
      				<!-- <img src="images/money-save.png" alt=""/> -->
      				<img src="{{ url('/images/landing_page3/money-save.png') }}" alt="" />
      			</div>
         <div class="heading2">Engage your customer</div>
         <p>Repeat customers are a product of relationships. Become a recommended business on uDistro by engaging in a meaningful relation with your customers.</p>
      </div>
      <div class="col-md-4 box-border">
      			<div class="udistro_client">
      				<!-- <img src="images/move-save.png" alt=""/> -->
      				<img src="{{ url('/images/landing_page3/move-save.png') }}" alt="" />
      			</div>
         <div class="heading2">Expose your business</div>
         <p>uDistro will expose your business an entire new markets full of people who are ready to buy. Just create a profile, relax, seat back and respond to quotes requests.</p>
      </div>
      </div>
      <div class="clearfix"></div>
      <div class="banner_btn-group text-center">
       <button type="button" class="btn banner_btn btn-lg blue_btn">Try uDistro today for free</button>
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
    	<img src="{{ url('/images/landing_page3/logo-foot.png') }}" alt="" />
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

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> 
<!-- Include all compiled plugins (below), or include individual files as needed --> 
<!-- <script src="js/bootstrap.min.js"></script> -->
<script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
<script>
 $(function() {
$('.scroll-down').click (function() {
  $('html, body').animate({scrollTop: $('section.ok').offset().top }, 'slow');
  return false;
});
});
</script> 
<script>
	$(function(){
    var navbar = $('.navbar');
    $(window).scroll(function(){
        if($(window).scrollTop() <= 40){
       		navbar.css('display', 'none');
        } else {
          navbar.css('display', 'block'); 
        }
    });  
})
</script>
</body>
</html>
