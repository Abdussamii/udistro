@extends('layouts.app')
@section('title', 'Udistro | About Us')

@section('content')
	<!-- Navbar -->
	<nav class="navbar navbar-inverse navbar-fixed-top" style="display:none;">
	 <div class="container-fluid">
	  <div class="navbar-header logo"> <a href="{{ url('/') }}"><img src="{{ url('/images/logo.png') }}" alt="Udistro" /></a> </div>
	  <ul class="nav navbar-nav navbar-right navbar-top-link">
	   <li><a href="#">
	    <button type="button" class="btn top-btn1"> I’m a Real-Estate Agent </button>
	    </a></li>
	   <li><a href="#">
	    <button type="button" class="btn top-btn1"> I'm a Local Business </button>
	    </a></li>
	  </ul>
	 </div>
	</nav>
	<!-- End Navbar --> 
	<section class="topic-image">
	  	<img src="{{ url('/images/about-topic.jpg') }}" alt=""/>
	</section>
	<!-- About STARTS -->
	<section class="about-udistro">
		<div class="container">
	 	<h2>About uDistro</h2>
	  <div class="about-para">
	  	<p>
	   	“Udistro is a time-saving tool that offer individual and commercial movers the ability to forward their mail using Canada Post Mail Forwarding Service, update address with agencies such as Canada Revenue Agency, Provincial Health Agencies, connect utilities, Cable and Internet Services, hire professional moving and home service companies and share your happiness with friends and families from one easy-to-use platform. You can do all of these for free and in minutes, saving hours!
	
	   </p>
	  </div>
	 </div>
	</section>
	<!-- About ENDS --> 
@endsection