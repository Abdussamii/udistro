@extends('layouts.app')
@section('title', 'Udistro | Customers')

@section('content')
	
	<link rel="stylesheet" href="{{ URL::asset('css/lightgallery.min.css') }}" />

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
		<img src="{{ url('/images/gal-topic.jpg') }}" alt=""/>
	</section>
	<!-- Events STARTS -->
	<section class="mid-udistro">
	 <div class="container">
	  <h2>Our Customers</h2>
	  <div class="our-customers">
			<ul>
				<li class="customer-box"> Company Logo</li>
				<li class="customer-box"> Company Logo</li>
				<li class="customer-box"> Company Logo</li>
				<li class="customer-box"> Company Logo</li>
				<li class="customer-box"> Company Logo</li>
				<li class="customer-box"> Company Logo</li>
				<li class="customer-box"> Company Logo</li>
				<li class="customer-box"> Company Logo</li>
				<li class="customer-box"> Company Logo</li>
				<li class="customer-box"> Company Logo</li>
				<li class="customer-box"> Company Logo</li>
				<li class="customer-box"> Company Logo</li>
				<li class="customer-box"> Company Logo</li>
				<li class="customer-box"> Company Logo</li>
				<li class="customer-box"> Company Logo</li>
				<li class="customer-box"> Company Logo</li>
				<li class="customer-box"> Company Logo</li>
				<li class="customer-box"> Company Logo</li>
				<li class="customer-box"> Company Logo</li>
			</ul>
	  </div>
	 </div>
	</section>
	<!-- Events ENDS --> 

	<!-- Event Gallery -->
	<script type="text/javascript">
	$(document).ready(function(){
		$('#lightgallery').lightGallery();
	});
	</script>
	<script src="https://cdn.jsdelivr.net/picturefill/2.3.1/picturefill.min.js"></script>
	<script type="text/javascript" src="{{ URL::asset('js/lightgallery-all.min.js') }}"></script>
	<script type="text/javascript" src="{{ URL::asset('js/jquery.mousewheel.min.js') }}"></script>

@endsection