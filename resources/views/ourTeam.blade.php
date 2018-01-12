@extends('layouts.app')
@section('title', 'Udistro | Our Team')

@section('content')
	<!-- Navbar -->
	<nav class="navbar navbar-inverse navbar-fixed-top" style="display:none;">
	 <div class="container-fluid">
	  <div class="navbar-header logo"><a href="#"><img src="{{ url('/images/logo.png') }}" alt="Udistro" /></a> </div>
	  <ul class="nav navbar-nav navbar-right navbar-top-link">
	   <li><a href="#">
	    <button type="button" class="btn top-btn1"> I’m a Real-Estate Agent </button>
	    </a></li>
	   <li><a href="#">
	    <button type="button" class="btn top-btn1">I'm a Business</button>
	    </a></li>
	  </ul>
	 </div>
	</nav>
	<!-- End Navbar -->
	<section class="topic-image"> <img src="{{ url('/images/team-topic.jpg') }}" alt=""/> </section>
	<!-- About STARTS -->
	<section class="mid-udistro">
	 <div class="container">
	  <h2>Leadership</h2>
	  <div class="team-pictures">
	   <div class="tagline-team">We’re led by a team who constantly questions, tinkers, and challenges to unlock great creativity around every turn.</div>
	  <div class="team-details">
	   <div class="col-sm-12">
	   	<div class="col-xs-6 col-sm-4 photo-wrap">
	    	<div class="picture-box">
	     	<div class="photo">
	      	<img src="{{ url('/images/one.jpg') }}" alt="" />
	      </div>
	      <div class="mem-detail">
	       <div class="name">Darrell</div>
	       <div class="designation">Chief Operating Officer</div>
	      </div>
	     </div>
	    </div>
	    <div class="col-xs-6 col-sm-4 photo-wrap">
	    	<div class="picture-box">
	     	<div class="photo">
	      	<img src="{{ url('/images/two.jpg') }}" alt="" />
	      </div>
	      <div class="mem-detail">
	       <div class="name">Akeem</div>
	       <div class="designation">Chief Information Officer</div>
	      </div>
	     </div>
	    </div>
	   
	   <div class="col-xs-6 col-sm-4 photo-wrap">
	    	<div class="picture-box">
	     	<div class="photo">
	      	<img src="{{ url('/images/three.jpg') }}" alt="" />
	      </div>
	      <div class="mem-detail">
	       <div class="name">Tope</div>
	       <div class="designation">Chief Technology Officer</div>
	      </div>
	     </div>
	    </div>
	   </div>
	  </div>
	  </div>
	 </div>
	</section>
	<!-- About ENDS --> 
@endsection