@extends('layouts.app')
@section('title', 'Udistro | Login')

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
    <div class="login-box-foot">
       <div class="h2-login">Login to uDistro</div>
       <div class="login-type-box">
         <ul class="nav navbar-nav navbar-right navbar-top-link">
	   <li><a href="https://www.udistro.ca/agent">
	    <button type="button" class="btn top-btn1"> I’m a Real-Estate Agent </button>
	    </a></li>
	   <li><a href="https://www.udistro.ca/company">
	    <button type="button" class="btn top-btn1">I'm a Business</button>
	    </a></li>
	  </ul
       </div>
     </div>
 </section>
@endsection