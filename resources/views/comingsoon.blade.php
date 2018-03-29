@extends('layouts.app')
@section('title', 'Udistro | Coming Soon')

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
<section class="topic-image login-bg"> 
    <div class="overlay"></div>
    <div class="comingsoon_udistro">
	     <div class="cs_banner">
	     	<img src="{{ url('/images/banner-logo.png') }}" class="center-block img-responsive" alt="" />
	     </div>
       <div class="h2-cs">Coming Soon</div>
    </div>
 </section>
@endsection