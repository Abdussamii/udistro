@extends('layouts.app')
@section('title', 'Udistro | About Us')

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
	<section class="topic-image">
	  	<img src="{{ url('/images/about-topic.jpg') }}" alt=""/>
	</section>
	<!-- About STARTS -->
	<section class="about-udistro">
		<div class="container">
	 	<h2>About uDistro</h2>
	  <div class="about-para">
	  	<p>
	   	uDistro is a time-saving tool that offers individual and commercial movers the ability to forward their mail using Canada Post Mail Forwarding Service, update address with agencies such as Canada Revenue Agency, provincial health agencies, connect utilities, cable and internet services, hire professional moving and home cleaning companies and share the happiness with friends, families and colleagues from one easy-to-use platform. You can do all of these in minutes, saving several hours plus it is completely Free!
	   </p>
	   <p>uDistro is an invite-only platform. In order to gain access to uDistro, you must be invited by someone helping you to move – your real estate agent, property manager, builder etc. Once you have been invited, simply claim your account, and start crossing items out of your moving check-lists!</p>
	  </div>
	 </div>
	</section>
	<!-- About ENDS --> 
@endsection