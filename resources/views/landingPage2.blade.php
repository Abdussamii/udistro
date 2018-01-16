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
	  		<img src="{{ url('/images/landing_image/logo.png') }}" alt="Udistro" />
	  	</a>
	  </div>
	  <ul class="nav navbar-nav navbar-right navbar-top-link">
	   <li>
	   		<a href="{{ url('/') }}">
	    		<button type="button" class="btn top-btn1">I Am Moving</button>
	    	</a>
	    </li>
	   <li>
	   		<a href="{{ url('/company/home') }}">
	    		<button type="button" class="btn top-btn1">I Am a Business</button>
	    	</a>
	    </li>
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
	     <h1 class="title_banner">Improving relocation experience for 4 million household movers in Canada every year.</h1>
	     <div class="banner_btn-group center-block">
	      <!-- <button type="button" class="btn banner_btn btn-lg skyBlue_btn">I Help Others Move</button> -->
	      <a href="{{ url('/agent') }}" class="btn banner_btn btn-lg skyBlue_btn">I Help Others Move</a>
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
	     <h2 class="center-block title-main">uDistro For Realtors and Property Managers</h2>
	     <p class="discretion">Udistro is a powerful moving application that is helping realtors and property managers streamline moving process and provide end-to-end moving experience to millins of Canadians who are on the move.</p>
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
	          <p>When you invite your clients to use uDistro for free, they not only feel obligated to refer you to others but our software encourage them to do so.</p>
	         </li>
	         <li><span>2</span>
	          <p>uDistro will help you improve customer experience initiatives, and in turn, you will get more refferals and increase your buttonlines.</p>
	         </li>
	         <li><span>3</span>
	          <p>Standout in your local market, engage your clients with news letter, monthly or annual renewal notices and custom greeting emails branded for you.</p>
	         </li>
	         <li><span>4</span>
	          <p> uDistro is a gift of time, the more time your clients get back to talk to friends, families and coleagues, the more they talk about you.</p>
	         </li>
	        </ul>
	       </div>
	       <div class="banner_btn-group center-block">
	       	<!-- The url is for agent registration -->
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
	     <h2 class="center-block title-main">Why you need to offer uDistro to your clients?</h2>
	     
	     <div class="row">
	      <div class="col-md-12">
	      <div class="col-md-4 box-border">
	      			<div class="udistro_client">
	      				<!-- <img src="images/time-save.png" alt=""/> -->
	      				<img src="{{ url('/images/landing_image/time-save.png') }}" alt=""/>
	      			</div>
	         <div class="heading2">You save them time</div>
	         <p>uDistro is a time saving machine for residential and commercial moves. Your clients  can complete each recommneded moving task in minutes, saving them hours!</p>
	      </div>
	      <div class="col-md-4 box-border">
	      			<div class="udistro_client">
	      				<!-- <img src="images/money-save.png" alt=""/> -->
	      				<img src="{{ url('/images/landing_image/money-save.png') }}" alt=""/>
	      			</div>
	         <div class="heading2">You save them money</div>
	         <p>uDistro compares hundreds of quotes from different service providers allowing your clients to seat back and choose the best </p>
	      </div>
	      <div class="col-md-4 box-border">
	      			<div class="udistro_client">
	      				<!-- <img src="images/move-save.png" alt=""/> -->
	      				<img src="{{ url('/images/landing_image/move-save.png') }}" alt=""/>
	      			</div>
	         <div class="heading2">You help them move everything!</div>
	         <p>uDistro helps your clients move everthing they need to move from one easy to use platform including mails and utility services.</p>
	      </div>
	      </div>
	      <div class="clearfix"></div>
	      <div class="banner_btn-group text-center">
	       <!-- <button type="button" class="btn banner_btn btn-lg blue_btn">Try uDistro today for free</button> -->
	       	<a href="{{ url('company/registration') }}" class="btn banner_btn btn-lg blue_btn">Try uDistro today for free</a>
	      </div>
	     </div>
	    </div>
	   </div>
	  </div>
	 </div>
	</section>

@endsection