@extends('layouts.app')
@section('title', 'Udistro | Help Center')

@section('content')
	<!-- Navbar -->
	<nav class="navbar navbar-inverse navbar-fixed-top" style="display:none;">
	 <div class="container-fluid">
	  <div class="navbar-header logo"> <a href="#"><img src="{{ url('/images/logo.png') }}" alt="Udistro" /></a> </div>
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
	<section class="topic-image"><img src="{{ url('/images/contact-topic.jpg') }}" alt=""/> </section>
	<!-- About STARTS -->
	<section class="mid-udistro">
	 <div class="container">
	  <h2>Help Center</h2>
	  <div class="help-center-box">
	   <div class="col-sm-12">
	    <div class="col-sm-4 email-help">
	     <div class="email-icon"><i class="fa fa-envelope-open" aria-hidden="true"></i></div>
	     <div class="h3-box-head">Email Us</div>
	     <div class="input-box">
	      <div class="email">info@udistro.ca</div>
	     </div>
	    </div>
	    <div class="col-sm-4 call-help">
	     <div class="email-icon"><i class="fa fa-phone" aria-hidden="true"></i></div>
	     <div class="h3-box-head">Call Us</div>
	     <div class="input-box">
	      <div class="number">+91-256 526 5123</div>
	     </div>
	    </div>
	    <div class="col-sm-4 chat-help">
	     <div class="email-icon"><i class="fa fa-weixin" aria-hidden="true"></i></div>
	     <div class="h3-box-head">Chat With Us</div>
	     <div class="input-box">
	      <div class="livechat">Live Chat</div>
	     </div>
	    </div>
	   </div>
	  </div>
	 </div>
	</section>
	<!-- About ENDS --> 
@endsection