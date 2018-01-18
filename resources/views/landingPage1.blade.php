@extends('layouts.app')
@section('title', 'Udistro')

@section('content')

	<!-- Navbar -->
	<nav class="navbar navbar-inverse navbar-fixed-top" style="display:none;">
	 <div class="container-fluid">
	  <div class="navbar-header logo"> <a href="{{ url('/') }}"><img src="{{ url('/images/logo.png') }}" alt="Udistro" /></a> </div>
	  <ul class="nav navbar-nav navbar-right navbar-top-link">
	   	<li>
		   	<a href="{{ url('/agent/home') }}">
		    	<button type="button" class="btn top-btn1">I’m a Real-Estate Agent</button>
		    </a>
		</li>
	   <li>
	   		<a href="{{ url('/company/home') }}">
	    		<button type="button" class="btn top-btn1">I'm a Business</button>
	    	</a>
		</li>
	  </ul>
	 </div>
	</nav>

	<!-- End Navbar --> 
	<!-- Video Section -->
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
	     <h1 class="title_banner">Improving relocation experience for 4 million Canadian families and businesses every year.</h1>
	     <div class="banner_btn-group center-block">
	      <!-- <button type="button" class="btn banner_btn btn-lg skyBlue_btn">I am Moving</button> -->
	      <a href="{{ url('/getinvitation') }}" class="btn banner_btn btn-lg skyBlue_btn">I'm Moving</a>
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
	     <h2 class="center-block title-main">uDistro for People Who Are Moving</h2>
	     <p class="discretion">We are at the forefront of improving relocation experience for millions of households in Canada. We do this through our online moving application that addresses all moving related problems from one easy to use platform.</p>
	     <div class="videopart-2 row">
	      <div class="col-md-7">
	       <div class="video_box">
	       <iframe width="100%" height="100%" src="https://www.youtube.com/embed/_f_nAStWhP8?rel=0&amp;showinfo=0" frameborder="0" gesture="media" allow="encrypted-media" allowfullscreen></iframe>
	       </div>
	      </div>
	      <div class="col-md-5">
	       <div class="bullet-point">
	        <ul>
	         <li><span>1</span>
	          <p>uDistro is a time saving tool to help you move, but you have to request for an invite.</p>
	         </li>
	         <li><span>2</span>
	          <p>uDistro technologies help you move everything! Including intangible stuff, like utilities and mails.</p>
	         </li>
	         <li><span>3</span>
	          <p>uDistro's end to end moving application saves you time, money, and headaches during your move.</p>
	         </li>
	         <li><span>4</span>
	          <p>uDistro helps you share your relocation good news with colleagues, families and friends.</p>
	         </li>
	        </ul>
	       </div>
	       <div class="banner_btn-group center-block">
	        <!-- <button type="button" class="btn try_btn btn-lg blue_btn">Ask for an Invite</button> -->
	        <a href="{{ url('/getinvitation') }}" class="btn try_btn btn-lg blue_btn">Ask for an Invite</a>
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
	     <h2 class="center-block title-main">Organize Your Move</h2>
	     <p class="discretion">Our end to end moving application helps you organize all your moving related tasks into few manageable recommended steps performed from one easy to use platform.</p>
	     <div class="row">
	      <div class="col-md-12">
	       <div class="software_content">
	       	<!-- <img src="images/softwr_contents.png" alt="" /> -->
	       	<img src="{{ url('/images/landing_image/softwr_contents.png') }}" alt="" />
	       </div>
	      </div>
	      <div class="clearfix"></div>
	      <div class="banner_btn-group text-center">
	       <!-- <button type="button" class="btn banner_btn btn-lg blue_btn">Ask for an Invite</button> -->
	       <a href="{{ url('/getinvitation') }}" class="btn banner_btn btn-lg blue_btn">Ask for an Invite</a>
	      </div>
	     </div>
	    </div>
	   </div>
	  </div>
	 </div>
	</section>

@endsection