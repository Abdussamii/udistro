@extends('layouts.app')
@section('title', 'Udistro')

@section('content')

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
	<!-- End Navbar --> 
	<!-- Video Section -->
	<section class="content-section video-section">
	 <div class="video_bg">
	  <video autoplay loop class="fillWidth" width="100%">
	   <!-- <source src="images/udistro-video.webm" type="video/webm" /> -->
	   <source src="{{ url('/images/business-video.webm') }}" type="video/webm" />
	   Your browser does not support the video tag. I suggest you upgrade your browser.
	   <!-- <source src="images/udistro-video.mp4" type="video/mp4" /> -->
	   <source src="{{ url('/images/business-video.mp4') }}" type="video/webm" />
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
	     <h1 class="title_banner">Receive project requests for few cents a day from people who are actively seeking to use your service. </h1>
	     <div class="banner_btn-group center-block">
	      <!-- <button type="button" class="btn banner_btn btn-lg skyBlue_btn">I am a business</button> -->
	      <!--<a class="btn banner_btn btn-lg skyBlue_btn" href="{{ url('/company') }}">I'm a Business</a>-->
	      <a class="btn banner_btn btn-lg skyBlue_btn" href="javascript:void(0)">I'm a Local Business</a>
	      <a href="#learn_more"><button type="button" class="btn banner_btn btn-lg white_btn">Learn More</button></a>
	     </div>
	    </div>
	   </div>
	  </div>
		<a href="#partnerBlock" class="scroll-down" address="true"></a> </div>
	</section>
	<!--Video Section Ends Here--> 
	
	<!--Partner Logo Section Starts Here--> 
	<section class="content-section section-pd partner-wrap" id="partnerBlock">
	 <div class="container">
	  <div class="row">
	   <div class="col-md-12">
	     <h2 class="center-block title-main">Our Partners</h2>
			<div class="owl-carousel owl-theme">
				<div class="item partner-box"><img src="{{ url('/images/landing_image/chairmans_club.jpg') }}" alt="" /></div>
				<div class="item partner-box"><img src="{{ url('/images/landing_image/remax-1.jpg') }}" alt="" /></div>
				<div class="item partner-box"><img src="{{ url('/images/landing_image/remax.jpg') }}" alt="" /></div>
				<div class="item partner-box"><img src="{{ url('/images/landing_image/tod_niblock.jpg') }}" alt="" /></div>
				<div class="item partner-box"><img src="{{ url('/images/landing_image/PHD.jpg') }}" alt="" /></div>
				<div class="item partner-box"><img src="{{ url('/images/landing_image/merry_maids.jpg') }}" alt="" /></div>
			</div>
	   </div>
	  </div>
	 </div>
	</section>
	<!--Partner Logo Section Ends Here--> 
	   
	

	<!-- Let’s Organize Your Move -->
	<section class="content-section section-pd" id="learn_more">
	 <div class="container">
	  <div class="row">
	   <div class="col-md-12">
	    <div class="section-organise">
	     <h2 class="center-block title-main">uDistro for Local Businesses</h2>
	     <p class="discretion">Udistro is a powerful contextual marketing application that is reinventing advertising experience for all stakeholders in the relocation ecosystem, including moving, cleaning and storage companies, cable, satellite and internet service providers.</p>
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
	          <p>We make sure that you have everything you need to get the next job offer. From tips, to productivity features all available at your fingertips.</p>
	         </li>
	         <li><span>3</span>
	          <p>Standout in your local market, engage your new lead one on one, bargain and send them quotes all within uDistro for few cents per day.</p>
	         </li>
	         <li><span>4</span>
	          <p>uDistro gives you complete control to manage your review and rating and correct the impression of customer if you ever get bad review.</p>
	         </li>
	        </ul>
	       </div>
	       <div class="banner_btn-group center-block">
	        <!-- <button type="button" class="btn try_btn btn-lg blue_btn">Start your free trial today!</button> -->
	        <a href="{{ url('/freetrial') }}" class="btn try_btn btn-lg blue_btn">Start your free trial today!</a>
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
	     <h2 class="center-block title-main">Get to the market place before your customer does!</h2>
	     <p class="discretion">uDistro leads could bring in additional $50,000 of business each month from people who are actively seeking to use your services</p>

	     <div class="row">
	      <div class="col-md-12 local_b_3">
	      <div class="col-md-4 box-border">
	      			<div class="udistro_client">
	      				<!-- <img src="images/leaves.png" alt=""/> -->
	      				<img src="{{ url('/images/landing_image/leaves.png') }}" alt="" />
	      			</div>
	         <div class="heading2">Get New Leads</div>
	         <p>uDistro funnel technology provides you with the tools to succeed, the only thing that can stop you on our market place is your attitude.</p>
	      </div>
	      <div class="col-md-4 box-border">
	      			<div class="udistro_client">
	      				<!-- <img src="images/engage.png" alt=""/> -->
	      				<img src="{{ url('/images/landing_image/engage.png') }}" alt="" />
	      			</div>
	         <div class="heading2">Engage your customer</div>
	         <p>Repeat customers are a product of relationships. Become a recommended five-star rated business on uDistro by engaging in a meaningful relationship with your customers.</p>
	      </div>
	      <div class="col-md-4 box-border">
	      			<div class="udistro_client">
	      				<!-- <img src="images/business.png" alt=""/> -->
	      				<img src="{{ url('/images/landing_image/business.png') }}" alt="" />
	      			</div>
	         <div class="heading2">Expose your business</div>
	         <p>uDistro will expose your business to an entire new markets full of people who are ready to buy. Just create a profile, relax, seat back and respond to quotes requests.</p>
	      </div>
	      </div>
	      <div class="clearfix"></div>
	      <div class="banner_btn-group text-center">
	       <!-- <button type="button" class="btn banner_btn btn-lg blue_btn">Try uDistro today for free</button> -->
	       <a href="{{ url('/freetrial') }}" class="btn banner_btn btn-lg blue_btn">Try uDistro today for free</a>
	      </div>
	     </div>
	    </div>
	   </div>
	  </div>
	 </div>
	</section>

@endsection