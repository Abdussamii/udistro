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
<link href="{{ URL::asset('css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('css/style1.css') }}" rel="stylesheet">

<!-- Fonts -->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600" rel="stylesheet">
<link href="{{ URL::asset('css/font-awesome.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('css/owl.carousel.min.css') }}" rel="stylesheet">

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> 
<!-- Include all compiled plugins (below), or include individual files as needed -->

<script src="{{ URL::asset('js/owl.carousel.min.js') }}"></script>
<script src="{{ URL::asset('js/bootstrap.min.3.3.7.js') }}"></script> 

<!-- JQuery Validation -->
<script type="text/javascript" src="{{ URL::asset('js/jquery.validate.min.js') }}"></script>

<!-- JS Alert Plug-in -->
<script type="text/javascript" src="{{ URL::asset('js/alertify.min.js') }}"></script>
<link rel="stylesheet" href="{{ URL::asset('css/alertify.min.css') }}" />

<!-- Company JS -->
<script type="text/javascript" src="{{ URL::asset('js/custom/company.js') }}"></script>

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

    // owl-carousel
	$('.owl-carousel').owlCarousel({
		items: 1,
		margin: 10,
		autoHeight: false,
		dots:true
	});

	$(".expand").on( "click", function() {
	    // $(this).next().slideToggle(200);
	    $expand = $(this).find(">:first-child");
	    
	    if($expand.text() == "+") {
	      $expand.text("-");
	    } else {
	      $expand.text("+");
	    }
  	});
});      
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
          <a class="navbar-brand" href="landing-page.html"><img src="{{ URL::asset('images/logo.png') }}" alt="Udistro" /></a>
        </div>
          <ul class="nav navbar-nav navbar-right navbar-top-link">
            <!--<li><a href="#"><i><img src="{{ URL::asset('images/truck.png') }}" /></i> <span><u>For Business</u></span></a></li>-->
            <li><a href="#"><button type="button" class="btn grn-blue">Login</button></a></li>
          </ul>
      </div>
    </nav>
<!-- End Navbar -->
<!-- Video Section -->
<section class="content-section video-section video-bg2">
  <div class="video_bg">
  <video autoplay loop class="fillWidth" width="100%">
            <source src="{{ URL::asset('images/udistro-video.webm') }}" type="video/webm" />Your browser does not support the video tag. I suggest you upgrade your browser.
            <source src="{{ URL::asset('images/udistro-video.mp4') }}" type="video/mp4" />Your browser does not support the video tag. I suggest you upgrade your browser.
        </video>
        <div class="overlay-bg"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="row">
          <div class="col-md-8">
          <div class="leftbg-text">
          <h1 class="title-bg2small">Get new quote requests from movers, all day long!</h1>
          <h3 class="overview">Our business product helps you communicate contextually with movers, who are actively looking for your services</h3>
			</div>
			</div>

<!-- Company Registration -->
<div class="col-md-4">
	<div class="login-box">
        <form name="frm_company_registration" id="frm_company_registration" autocomplete="off">
            <div class="form-title">
            <h2>Get started. It’s 100% Free!</h2>
            <h3>Start your 30 days FREE trial Now!</h3>
            </div>
            <div class="form-group">
                <input placeholder="First name" name="rep_fname" id="rep_fname" type="text" class="form-control" />
            </div>
            <div class="form-group">
                <input placeholder="Last name" name="rep_lname" id="rep_lname" type="text" class="form-control" />
            </div>
            <div class="form-group">
                <input placeholder="Job Title" name="rep_designation" id="rep_designation" type="text" class="form-control" />
            </div>
            <div class="form-group">
                <input placeholder="Email" name="email" id="email" type="text" class="form-control" />
            </div>
            <div class="form-group">
                <input placeholder="Password" name="password" id="password" type="password" class="form-control" />
            </div>
            <div class="form-group">
                <input placeholder="Phone Number" name="phone_no" id="phone_no" type="text" class="form-control" />
            </div>
            <div class="form-group">
                <input placeholder="Company Name" name="company_name" id="company_name" type="text" class="form-control" />
            </div>
            <div class="form-group">
                <select name="company_province" id="company_province" class="form-control">
                	<option value="">Select Province</option>
                	<?php
                	if( count( $provinces ) > 0 )
                	{
                		foreach ($provinces as $province)
                		{
                			echo '<option value="'. $province->id .'">'. ucwords( strtolower( $province->name ) ) .'</option>';
                		}
                	}
                	?>
                </select>
            </div>
            <div class="form-group">
                <select name="company_type" id="company_type" class="form-control">
                	<option value="">Select Industry Type</option>
                	<?php
                	if( count( $companyCategories ) > 0 )
                	{
                		foreach ($companyCategories as $category)
                		{
                			echo '<option value="'. $category->id .'">'. ucwords( strtolower( $category->category ) ) .'</option>';
                		}
                	}
                	?>
                </select>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-default btn-login-submit" id="btn_company_registration" name="btn_company_registration" value="Start Free Trail" />
            </div>
            <span class="text-center instraction">No risk. No credit card required.</span>
        </form>
	</div>
</div>
<!-- Company Registration -->

</div>
        </div>
      </div>
    </div>
    <a href="#" class="scroll-down" address="true"></a> </div>
</section>
<!--Video Section Ends Here--> 

<!--- /Let’s Organize Your Move/ ->
<section class="content-section section-pd">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="section-organise">
          <h2 class="center-block title-main">Be here, before your customer does</h2>
          <p class="discretion">Movers get access to uDistro via email invitation from a real estate brokerage or agent, mortgage or title company, etc. So when you get quotes from here, you know you are talking to right person.</p>
          
          <div class="row">
          <div class="col-sm-6 col-md-3 col-lg-3">
          <div class="customer-box">
          <div class="img-section"><img src="{{ URL::asset('images/notice-icon.png') }}" class="img-circle" alt=""></div>
          <div class="textbox">
          <h2>Get Noticed</h2>
          <p>Create your company profile and become part of our community of reputable service professionals.</p>
          </div>
          </div>
          </div>
          <div class="col-sm-6 col-md-3 col-lg-3">
          <div class="customer-box">
          <div class="img-section"><img src="{{ URL::asset('images/talk-icon.png') }}" class="img-circle" alt=""></div>
          <div class="textbox">
          <h2>Talk to movers</h2>
          <p>Receive new project requests from the people who are actually moving and are actively looking for your service.</p>
          </div>
          </div>
          </div>
          <div class="col-sm-6 col-md-3 col-lg-3">
          <div class="customer-box">
          <div class="img-section"><img src="{{ URL::asset('images/brand-2icon.png') }}" class="img-circle" alt=""></div>
          <div class="textbox">
          <h2>Improve your brand</h2>
          <p>Manage everything from one single platform, Quotes, reviews, job descriptions. You just push the button and allow uDistro do the rest.</p>
          </div>
          </div>
          </div>
          <div class="col-sm-6 col-md-3 col-lg-3">
          <div class="customer-box">
          <div class="img-section"><img src="{{ URL::asset('images/increase-icon.png') }}" class="img-circle" alt=""></div>
          <div class="textbox">
          <h2>Increase your revenue</h2>
          <p>Let movers recommend you to other movers by adding customer reviews to your quotations. Add value in the face of disruptive technologies.</p>
          </div>
          </div>
          </div>
          </div>          
          <!--<div class="banner_btn-group center-block">
            <button type="button" class="btn banner_btn btn-lg skyBlue_btn">Get Started</button>
          </div>-->
        </div>
      </div>
    </div>
  </div>
</section>


<!-- / New customer / -->

<section class="content-section section-pd price-table new-customer-section">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="section-organise">
          <h2 class="center-block title-main no-pd">Ready for new customers?</h2>
          <p class="pd-2 discretion-pdb">Experience it now for free - 14 days</p>
          
      <div id="demos">
      <div class="row">
        <div class=" col-md-12 custom-owl">
          <div class="owl-carousel owl-theme">
            <div class="item" >
              <img src="{{ URL::asset('images/slide-2.jpg') }}" class="img-responsive" alt="">
               <br>
              <p>Our partner real estate agents and brokers send personalised invite to the movers who ready to move.</p>
            </div>
            <div class="item">
              <img src="{{ URL::asset('images/slide-3.jpg') }}" class="img-responsive" alt="">
               <br>
              <p>The movers receive our recommended workflow of tasks and complete it promptly, efficiently and for free.</p>
            </div>
            <div class="item">
              <img src="{{ URL::asset('images/slide-4.jpg') }}" class="img-responsive" alt="">
               <br>
              <p>Our business products helps you get quote requests from those movers who are looking for your services.</p>
            </div>           
           </div>
        </div>
      </div>
    </div>
          
    <div class="banner_btn-group center-block">
            <button type="button" class="btn banner_btn btn-lg green_btn">Start Free Trail</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>



<!-- / Get Started -->
<section class="content-section section-pd get-start-free-trial">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="section-organise">
          <h2 class="center-block title-main">Get started</h2>
          <p class="discretion-pdb">Start with a 14 day free trial then become a full member</p>
          <div class="row">
            <div class="col-md-10 col-md-offset-1">
              <div class="col-md-4 no-pd no-mg">
                <div class="list-group packag-menu">
                <a href="#" class="list-group-item"> <img src="{{ URL::asset('images/chat.png') }}" alt=""> Communicate</a>
                <a href="#" class="list-group-item"><img src="{{ URL::asset('images/user.png') }}" alt="">Profile</a>
                <a href="#" class="list-group-item"><img src="{{ URL::asset('images/favorite.png') }}" alt="">Reviews</a>
                <a href="#" class="list-group-item"><img src="{{ URL::asset('images/loupe.png') }}" alt="">Range</a>
                <a href="#" class="list-group-item"><img src="{{ URL::asset('images/suitcase.png') }}" alt="">Job types</a>
                <a href="#" class="list-group-item"><img src="{{ URL::asset('images/loupe.png') }}" alt="">Transparency</a>
                <a href="#" class="list-group-item"><img src="{{ URL::asset('images/file.png') }}" alt="">Job Description</a>
                <a href="#" class="list-group-item"><img src="{{ URL::asset('images/medal.png') }}" alt="">Quality Assurance</a>
                <a href="#" class="list-group-item"><img src="{{ URL::asset('images/caution-sign.png') }}" alt="">Risk-Free</a>
                <a href="#" class="list-group-item"><img src="{{ URL::asset('images/phone-call.png') }}" alt="">Support</a>
                <a href="#" class="list-group-item"><img src="{{ URL::asset('images/boom.png') }}" alt="">Exposure</a>
                
                </div>
              </div>
              
              
              <div class="col-md-4 no-pd no-mg">
                <div class="panel panel-danger">
                  <div class="trial-title">
                  <h3 class="text-center">Free trial</h3>
                  </div>
                  <div class="panel-heading orange_cd">
                    <h4> Free project requests </h4>
                  </div>
                  <ul class="list-group list-group-flush text-center">
                    <li class="list-group-item">Contextually with real movers</li>
                    <li class="list-group-item">Set up profile</li>
                    <li class="list-group-item">Not applicable</li>
                    <li class="list-group-item">Set target areas</li>
                    <li class="list-group-item">Choose preferred job types</li>
                    <li class="list-group-item">Competition visible on quote requests</li>
                    <li class="list-group-item">Detailed job description</li>
                    <li class="list-group-item">Form Check and Validations</li>
                    <li class="list-group-item">Stops automatically after 30 days</li>
                    <li class="list-group-item">Ask a question via email and life</li>
                    <li class="list-group-item">Chat Not applicable</li>
                  </ul>
                  <div class="panel-footer"> <a class="btn btn-lg btn-default orange-btn btn-sm " href="#">Start Now</a> </div>
                  <div class="panel-body text-center">
                    <p class="lead">  100% free - No Risk </p>
                  </div>
                </div>
              </div>
              
              <div class="col-md-4 no-pd no-mg">
                <div class="panel panel-danger purple">
                  <div class="trial-title">
                  <h3 class="text-center">Full membership</h3>
                  </div>
                  <div class="panel-heading blue_cd">
                    <h4>  Pay per project request  </h4>
                  </div>
                  <ul class="list-group list-group-flush text-center">
                    <li class="list-group-item">Contextually with real movers</li>
                    <li class="list-group-item">Pay per project request</li>
                    <li class="list-group-item">Flaunt your Reviews</li>
                    <li class="list-group-item">Set your area(s), unlimited choice</li>
                    <li class="list-group-item">Specify suitable job types</li>
                    <li class="list-group-item">Set according to your capacity</li>
                    <li class="list-group-item">Competition visible on quote requests</li>
                    <li class="list-group-item">Detailed job description</li>
                    <li class="list-group-item">Form Check and validations</li>
                    <li class="list-group-item">60 Day Money Back Guarantee</li>
                    <li class="list-group-item">Your dedicated Account Manager</li>
                  </ul>
                </div>
              </div>
              
            </div>
          </div>
          
        </div>
      </div>
    </div>
  </div>
</section>


<!-- / scale your business/ -->
<section class="content-section section-pd ready-yourBusiness">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="section-organise">
          <h2 class="center-block title-main">Ready to scale your business?</h2>
          <p class="discretion-pdb">Experience the flood for the next 14 days free</p>
          <div class="row">
            <div class="col-md-12">
            <ul class="number-list">
            <li class="col-md-4">
            <div class="number">
            <p>Movers Product</p>
            <div class="circle-border"><span>1</span></div>
            </div>
            <div class="numb-pro-text">
            Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
            </div>
            </li>
            
            <li class="col-md-4">
            <div class="number">
            <p>Real Estate Product</p>
            <div class="circle-border"><span>2</span></div>
            </div>
            
            <div class="numb-pro-text">
            Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
            </div>
            </li>
            
            <li class="col-md-4">
            <div class="number">
            <p>Business product</p>
            <div class="circle-border"><span>3</span></div>
            </div>
            <div class="numb-pro-text">
            Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
            </div>
            </li>
            </ul>
            </div>
            
            
          </div>
          <div class="banner_btn-group center-block">
            <button type="button" class="btn btn-lg btn-default orange-btn btn-sm ">Start Free Trail</button>
            <p class="center-block pd-top-1">No risk. No credit card required.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


<!-- / FAQ / -->
<section class="content-section section-pd faq-section">
  <div class="container">
  
  <div class="section-organise">
          <h2 class="center-block title-main">FAQs Questions</h2>
        </div>
  <br />

  <div class="container">

  <div class="panel-group" id="accordion">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 data-toggle="collapse" data-parent="#accordion1" href="#collapse1" class="panel-title expand">
           <div class="right-arrow pull-right">+</div>
          <a href="#">What is Udistro?</a>
        </h4>
      </div>
      <div id="collapse1" class="panel-collapse collapse">
        <div class="panel-body">Udistro is a time-saving tool that offers you the ability to forward your mail, update businesses with your new address, connect internet and utilities, and share moving announcements with friends and family, –from one easy-to-use platform. You can do all of these for free and in minutes, saving hours!</div>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 data-toggle="collapse" data-parent="#accordion2" href="#collapse2" class="panel-title expand">
            <div class="right-arrow pull-right">+</div>
          <a href="#">Why use Udistro to change my address?</a>
        </h4>
      </div>
      <div id="collapse2" class="panel-collapse collapse">
        <div class="panel-body">Udistro is a time-saving tool that offers you the ability to forward your mail, update businesses with your new address, connect internet and utilities, and share moving announcements with friends and family, –from one easy-to-use platform. You can do all of these for free and in minutes, saving hours!</div>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 data-toggle="collapse" data-parent="#accordion3" href="#collapse3" class="panel-title expand">
            <div class="right-arrow pull-right">+</div>
          <a href="#">How do I gain access to Udistro?</a>
        </h4>
      </div>
      <div id="collapse3" class="panel-collapse collapse">
        <div class="panel-body">Udistro is a time-saving tool that offers you the ability to forward your mail, update businesses with your new address, connect internet and utilities, and share moving announcements with friends and family, –from one easy-to-use platform. You can do all of these for free and in minutes, saving hours!</div>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 data-toggle="collapse" data-parent="#accordion3" href="#collapse3" class="panel-title expand">
            <div class="right-arrow pull-right">+</div>
          <a href="#">I'm moving again. Can I use Udistro again?</a>
        </h4>
      </div>
      <div id="collapse3" class="panel-collapse collapse">
        <div class="panel-body">Udistro is a time-saving tool that offers you the ability to forward your mail, update businesses with your new address, connect internet and utilities, and share moving announcements with friends and family, –from one easy-to-use platform. You can do all of these for free and in minutes, saving hours!</div>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 data-toggle="collapse" data-parent="#accordion4" href="#collapse4" class="panel-title expand">
            <div class="right-arrow pull-right">+</div>
          <a href="#">I'm moving from an international address. Can I still use Udistro to set up services in my new home?</a>
        </h4>
      </div>
      <div id="collapse4" class="panel-collapse collapse">
        <div class="panel-body">Udistro is a time-saving tool that offers you the ability to forward your mail, update businesses with your new address, connect internet and utilities, and share moving announcements with friends and family, –from one easy-to-use platform. You can do all of these for free and in minutes, saving hours!</div>
      </div>
    </div>
  </div> 
  
  
</div>

</div>
</section>

<footer class="footer-main section-pd">
  <div class="container">
    <div class="row">
      <div class="col-md-4">
        <div class="media-body client-achive-step">
          <h2 class="media-heading">Company</h2>
        </div>
        <ul class="list-group custom-listgroup">
          <li class="list-group-item"><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i>About</a></li>
          <li class="list-group-item"><a href="#"> <i class="fa fa-angle-double-right" aria-hidden="true"></i>Career</a></li>
          <li class="list-group-item"><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i>Sitemap</a></li>
          <li class="list-group-item"><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i>Terms of Use</a></li>
          <li class="list-group-item"><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i>Terms of services</a></li>
          <li class="list-group-item"><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i>Privacy Policy</a></li>
        </ul>
      </div>
      <div class="col-md-4">
        <div class="media-body client-achive-step">
          <h2 class="media-heading">Important Links</h2>
        </div>
        <ul class="list-group custom-listgroup">
          <li class="list-group-item"><a href="#"> <i class="fa fa-angle-double-right" aria-hidden="true"></i>Login</a></li>
          <li class="list-group-item"><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i>Features</a></li>
          <li class="list-group-item"><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i>Free Trial</a></li>
          <li class="list-group-item"><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i>Pricing</a></li>
          <li class="list-group-item"><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i>Support</a></li>
          <li class="list-group-item"><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i>Schedule Demo</a></li>
        </ul>
      </div>
      <div class="col-md-4">
        <div class="media-body client-achive-step">
          <h2 class="media-heading">Follow Us</h2>
        </div>
        <ul class="list-group custom-listgroup">
          <li class="list-group-item"><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i>Twitter</a></li>
          <li class="list-group-item"><a href="#"> <i class="fa fa-angle-double-right" aria-hidden="true"></i>Facebook</a></li>
          <li class="list-group-item"><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i>Google Plus</a></li>
          <li class="list-group-item"><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i>Linkedin</a></li>
          <li class="list-group-item"><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i>You tube</a></li>
          <li class="list-group-item"><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i>Instagram</a></li>
        </ul>
      </div>
    </div>
  </div>
</footer>
</body>
</html> 