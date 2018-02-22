@extends('layouts.app')
@section('title', 'Udistro')

@section('content')

	<!-- Navbar -->
	<nav class="navbar navbar-inverse navbar-fixed-top" style="display:none;">
	 <div class="container-fluid">
	  <div class="navbar-header logo"> <a href="{{ url('/') }}"><img src="{{ url('/images/logo.png') }}" alt="Udistro" /></a> </div>
	  
	  <ul class="nav navbar-nav navbar-right navbar-top-link">
	   <li><a href="{{ url('/agent/home') }}">
	    <button type="button" class="btn top-btn1"> I’m a Real-Estate Agent</button>
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
	   	<source src="{{ url('/images/real-estate-video.webm') }}" type="video/webm" />
	   Your browser does not support the video tag. I suggest you upgrade your browser.
	   	<!-- <source src="images/udistro-video.mp4" type="video/mp4" /> -->
	   	<source src="{{ url('/images/real-estate-video.mp4') }}" type="video/mp4" />
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
	        <!-- <button type="button" class="btn try_btn btn-lg blue_btn">Try uDistro for 60 days free</button> -->
	        <a href="{{ url('freetrial') }}" class="btn try_btn btn-lg blue_btn">Try uDistro for 60 days free</a>
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

@endsection