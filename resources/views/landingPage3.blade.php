@extends('layouts.app')
@section('title', 'Udistro')

@section('content')

	<link rel="stylesheet" href="{{ URL::asset('css/style_landing_page.css') }}" />
	
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
	   <li>
	   		<a href="{{ url('/') }}">
	    		<button type="button" class="btn top-btn1">I Am Moving</button>
	    	</a>
	    </li>
	   <li><a href="{{ url('/agent/home') }}">
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
	      <!-- <button type="button" class="btn banner_btn btn-lg skyBlue_btn">I am a business</button> -->
	      <a class="btn banner_btn btn-lg skyBlue_btn" href="{{ url('/company') }}">I am a business</a>
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
	        <!-- <button type="button" class="btn try_btn btn-lg blue_btn">Start your free trial today!</button> -->
	        <a href="{{ url('/company/registration') }}" class="btn try_btn btn-lg blue_btn">Start your free trial today!</a>
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
	      				<!-- <img src="images/leaves.png" alt=""/> -->
	      				<img src="{{ url('/images/landing_image/leaves.png') }}" alt="" />
	      			</div>
	         <div class="heading2">Get New Leads</div>
	         <p>uDistro furnel technology provides you with the tools to succeed, the only thing that can stop you on our market place is your attitute.</p>
	      </div>
	      <div class="col-md-4 box-border">
	      			<div class="udistro_client">
	      				<!-- <img src="images/engage.png" alt=""/> -->
	      				<img src="{{ url('/images/landing_image/engage.png') }}" alt="" />
	      			</div>
	         <div class="heading2">Engage your customer</div>
	         <p>Repeat customers are a product of relationships. Become a recommended business on uDistro by engaging in a meaningful relation with your customers.</p>
	      </div>
	      <div class="col-md-4 box-border">
	      			<div class="udistro_client">
	      				<!-- <img src="images/business.png" alt=""/> -->
	      				<img src="{{ url('/images/landing_image/business.png') }}" alt="" />
	      			</div>
	         <div class="heading2">Expose your business</div>
	         <p>uDistro will expose your business an entire new markets full of people who are ready to buy. Just create a profile, relax, seat back and respond to quotes requests.</p>
	      </div>
	      </div>
	      <div class="clearfix"></div>
	      <div class="banner_btn-group text-center">
	       <!-- <button type="button" class="btn banner_btn btn-lg blue_btn">Try uDistro today for free</button> -->
	       <a href="{{ url('/company/registration') }}" class="btn banner_btn btn-lg blue_btn">Try uDistro today for free</a>
	      </div>
	     </div>
	    </div>
	   </div>
	  </div>
	 </div>
	</section>

@endsection