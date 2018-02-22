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
<link rel="stylesheet" href="{{ URL::asset('css/style_landing_page.css') }}" />
<link rel="stylesheet" href="{{ URL::asset('css/media.css') }}" />

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
  <div class="navbar-header logo"> <a href="{{ url('/') }}"><img src="{{ url('/images/logo.png') }}" alt="Udistro" /></a> </div>
  
	  <ul class="nav navbar-nav navbar-right navbar-top-link">
	   <li><a href="{{ url('/agent/home') }}">
	    <button type="button" class="btn top-btn1"> I’m a Real-Estate Agent </button>
	    </a></li>
	   <li><a href="{{ url('/company/home') }}">
	    <button type="button" class="btn top-btn1">I'm a Local Business</button>
	    </a></li>
	  </ul>
 </div>
</nav>
<!------------End Navbar-------------> 
<!--Video Section-->
<section class="content-section video-section">
 <div class="video_bg">
  <video autoplay loop class="fillWidth" width="100%">
   	<!-- <source src="images/udistro-video.webm" type="video/webm" /> -->
   	<source src="{{ url('/images/udistro-video.webm') }}" type="video/webm" />
   Your browser does not support the video tag. I suggest you upgrade your browser.
   	<!-- <source src="images/udistro-video.mp4" type="video/mp4" /> -->
   	<source src="{{ url('/images/udistro-video.mp4') }}" type="video/mp4" />
   Your browser does not support the video tag. I suggest you upgrade your browser. </video>
  <div class="poster hidden"> <!-- <img src="PATH_TO_JPEG" alt=""> --> </div>
  <div class="overlay-bg"></div>
  <div class="container">
   <div class="row">
    <div class="col-lg-12">
     <div class="logo_banner">
     	<!-- <img src="images/banner-logo.png" class="center-block img-responsive" alt="udistro"> -->
     	<img src="{{ url('/images/landing_image/banner-logo.png') }}" class="center-block img-responsive" alt="udistro">
     </div>
     <h1 class="title_banner">Use our customizable, branded email templates to engage your clients in a radically new way</h1>
     <div class="banner_btn-group center-block">
      <!-- <button type="button" class="btn banner_btn btn-lg skyBlue_btn">I Help Others Move</button> -->
      <a href="{{ url('/agent') }}" class="btn banner_btn btn-lg skyBlue_btn">I’m a Real-Estate Agent</a>
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
     <h2 class="center-block title-main">uDistro for Realtors and Property Managers</h2>
     <p class="discretion">Udistro is a powerful moving application that is helping realtors and property managers update their brands and streamline moving process for clients who are moving.</p>
     <div class="videopart-2 row">
      <div class="col-md-7">
       <div class="video_box">
       	<iframe width="100%" height="100%" src="https://www.youtube.com/embed/rxgAr5hdvl8?rel=0&amp;showinfo=0" frameborder="0" gesture="media" allow="encrypted-media" allowfullscreen></iframe>
       </div>
      </div>
      <div class="col-md-5">
       <div class="bullet-point">
        <ul>
         <li><span>1</span>
          <p>For the cost of a cup of coffee a day, you could improve the quality of relocation experience you provide to your clients forever.</p>
         </li>
         <li><span>2</span>
          <p>uDistro will help you improve customer experience initiatives, and in turn, you will get more referrals and increase your bottom lines.</p>
         </li>
         <li><span>3</span>
          <p>Standout in your local market, engage your clients with easy to use contact management and responsive email templates designs branded for just you.</p>
         </li>
         <li><span>4</span>
          <p>uDistro is a gift of time, the more time your clients get back to talk to friends, families and colleagues, the more they are likely to talk about you.</p>
         </li>
        </ul>
       </div>
       <div class="banner_btn-group center-block">
       	<!-- The url is for agent registration -->
        <button type="button" class="btn try_btn btn-lg blue_btn">Try uDistro for 60 days free</button>
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
     <h2 class="center-block title-main">Why you need to offer uDistro to your clients?</h2>
     
     <div class="row">
      <div class="col-md-12">
      <div class="col-md-4 box-border">
      			<div class="udistro_client">
      				<!-- <img src="images/time-save.png" alt=""/> -->
      				<img src="{{ url('/images/landing_image/time-save.png') }}" alt=""/>
      			</div>
         <div class="heading2">You save them time</div>
         <p>uDistro is a time saving tool for residential and commercial moves. Your clients can complete each recommended moving task in minutes, saving them hours!</p>
      </div>
      <div class="col-md-4 box-border">
      			<div class="udistro_client">
      				<!-- <img src="images/money-save.png" alt=""/> -->
      				<img src="{{ url('/images/landing_image/money-save.png') }}" alt=""/>
      			</div>
         <div class="heading2">You save them money</div>
         <p>uDistro compares hundreds of quotes from different service providers allowing your clients to seat back and make a good choice</p>
      </div>
      <div class="col-md-4 box-border">
      			<div class="udistro_client">
      				<!-- <img src="images/move-save.png" alt=""/> -->
      				<img src="{{ url('/images/landing_image/move-save.png') }}" alt=""/>
      			</div>
         <div class="heading2">You help them move everything!</div>
         <p>uDistro helps your clients move everything they need to move from one easy to use platform including mails and utility services.</p>
      </div>
      </div>
      <div class="clearfix"></div>
      <div class="banner_btn-group text-center">
       <!-- <button type="button" class="btn banner_btn btn-lg blue_btn">Try uDistro today for free</button> -->
       	<a href="{{ url('company/registration') }}" class="btn banner_btn btn-lg blue_btn">Try uDistro for 60 days free</a>
      </div>
     </div>
    </div>
   </div>
  </div>
 </div>
</section>

<!-----/ Footer Starts/------>

<footer class="footer-main section-pd">
 <div class="container">
  <div class="row">
   <div class="col-md-4">
    <div class="foot_logo">
    	<!-- <img src="images/logo-foot.png" alt=""/> -->
    	<img src="{{ url('/images/landing_image/logo-foot.png') }}" alt=""/>
    </div>
    <ul class="footer_social_icon">
     <li><a href="https://www.facebook.com/udistro.rakoomi" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
     <li><a href="https://www.linkedin.com/in/udistro-rakoomi-043323153/" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
     <li><a href="https://twitter.com/udistroca" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
     <li><a href="https://plus.google.com/" target="_blank"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
     <li><a href="https://www.instagram.com/udistroca" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
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
     <li class="list-group-item"><a href="https://udistro424000759.wordpress.com/" target="_blank"><i class="fa fa-angle-double-right" aria-hidden="true"></i>Blog</a></li>
     <li class="list-group-item"><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i>Videos</a></li>
    </ul>
   </div>
  </div>
  
  <!-- -->
  <div class="footerAdditional">
   <ul>
    <li> <a href="#">FAQs</a> </li>
    <li> <a href="#">Privacy</a> </li>
    <li> <a href="#">Terms</a> </li>
    <li> <a href="#">I’m a Real-Estate Agent</a> </li>
    <li> <a href="#">I'm a Business</a> </li>
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
<script type="text/javascript" src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
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
