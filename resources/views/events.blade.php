@extends('layouts.app')
@section('title', 'Udistro | Events')

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
	  <h2>uDistro Events</h2>
	  <div class="gallery-pictures">
	   <div class="tagline-team">We’re led by a team who constantly questions, tinkers, and challenges to unlock great creativity around every turn.</div>

	   <div class="demo-gallery">
	            <ul id="lightgallery" class="list-unstyled row">
	                <li class="col-xs-6 col-sm-4 col-md-3" data-responsive="img/1-375.jpg 375, img/1-480.jpg 480, img/1.jpg 800" data-src="images/gal-img/1-1600.jpg" data-sub-html="<h4>Fading Light</h4><p>Classic view from Rigwood Jetty on Coniston Water an old archive shot similar to an old post but a little later on.</p>">
	                    <a href="">
	                        <img class="img-responsive" src="{{ url('/images/gal-img/thumb-1.jpg') }}">
	                    </a>
	                </li>
	                <li class="col-xs-6 col-sm-4 col-md-3" data-responsive="img/2-375.jpg 375, img/2-480.jpg 480, img/2.jpg 800" data-src="images/gal-img/2-1600.jpg" data-sub-html="<h4>Bowness Bay</h4><p>A beautiful Sunrise this morning taken En-route to Keswick not one as planned but I'm extremely happy I was passing the right place at the right time....</p>">
	                    <a href="">
	                        <img class="img-responsive" src="{{ url('/images/gal-img/thumb-2.jpg') }}">
	                    </a>
	                </li>
	                <li class="col-xs-6 col-sm-4 col-md-3" data-responsive="img/13-375.jpg 375, img/13-480.jpg 480, img/13.jpg 800" data-src="images/gal-img/13-1600.jpg" data-sub-html="<h4>Bowness Bay</h4><p>A beautiful Sunrise this morning taken En-route to Keswick not one as planned but I'm extremely happy I was passing the right place at the right time....</p>">
	                    <a href="">
	                        <img class="img-responsive" src="{{ url('/images/gal-img/thumb-13.jpg') }}">
	                    </a>
	                </li>
	                <li class="col-xs-6 col-sm-4 col-md-3" data-responsive="img/4-375.jpg 375, img/4-480.jpg 480, img/4.jpg 800" data-src="images/gal-img/4-1600.jpg" data-sub-html="<h4>Bowness Bay</h4><p>A beautiful Sunrise this morning taken En-route to Keswick not one as planned but I'm extremely happy I was passing the right place at the right time....</p>">
	                    <a href="">
	                        <img class="img-responsive" src="{{ url('/images/gal-img/thumb-4.jpg') }}">
	                    </a>
	                </li><li class="col-xs-6 col-sm-4 col-md-3" data-responsive="img/1-375.jpg 375, img/1-480.jpg 480, img/1.jpg 800" data-src="images/gal-img/1-1600.jpg" data-sub-html="<h4>Fading Light</h4><p>Classic view from Rigwood Jetty on Coniston Water an old archive shot similar to an old post but a little later on.</p>">
	                    <a href="">
	                        <img class="img-responsive" src="{{ url('/images/gal-img/thumb-1.jpg') }}">
	                    </a>
	                </li>
	                <li class="col-xs-6 col-sm-4 col-md-3" data-responsive="img/2-375.jpg 375, img/2-480.jpg 480, img/2.jpg 800" data-src="images/gal-img/2-1600.jpg" data-sub-html="<h4>Bowness Bay</h4><p>A beautiful Sunrise this morning taken En-route to Keswick not one as planned but I'm extremely happy I was passing the right place at the right time....</p>">
	                    <a href="">
	                        <img class="img-responsive" src="{{ url('/images/gal-img/thumb-2.jpg') }}">
	                    </a>
	                </li>
	                <li class="col-xs-6 col-sm-4 col-md-3" data-responsive="img/13-375.jpg 375, img/13-480.jpg 480, img/13.jpg 800" data-src="images/gal-img/13-1600.jpg" data-sub-html="<h4>Bowness Bay</h4><p>A beautiful Sunrise this morning taken En-route to Keswick not one as planned but I'm extremely happy I was passing the right place at the right time....</p>">
	                    <a href="">
	                        <img class="img-responsive" src="{{ url('/images/gal-img/thumb-13.jpg') }}">
	                    </a>
	                </li>
	                <li class="col-xs-6 col-sm-4 col-md-3" data-responsive="img/4-375.jpg 375, img/4-480.jpg 480, img/4.jpg 800" data-src="images/gal-img/4-1600.jpg" data-sub-html="<h4>Bowness Bay</h4><p>A beautiful Sunrise this morning taken En-route to Keswick not one as planned but I'm extremely happy I was passing the right place at the right time....</p>">
	                    <a href="">
	                        <img class="img-responsive" src="{{ url('/images/gal-img/thumb-4.jpg') }}">
	                    </a>
	                </li><li class="col-xs-6 col-sm-4 col-md-3" data-responsive="img/1-375.jpg 375, img/1-480.jpg 480, img/1.jpg 800" data-src="images/gal-img/1-1600.jpg" data-sub-html="<h4>Fading Light</h4><p>Classic view from Rigwood Jetty on Coniston Water an old archive shot similar to an old post but a little later on.</p>">
	                    <a href="">
	                        <img class="img-responsive" src="{{ url('/images/gal-img/thumb-1.jpg') }}">
	                    </a>
	                </li>
	                <li class="col-xs-6 col-sm-4 col-md-3" data-responsive="img/2-375.jpg 375, img/2-480.jpg 480, img/2.jpg 800" data-src="images/gal-img/2-1600.jpg" data-sub-html="<h4>Bowness Bay</h4><p>A beautiful Sunrise this morning taken En-route to Keswick not one as planned but I'm extremely happy I was passing the right place at the right time....</p>">
	                    <a href="">
	                        <img class="img-responsive" src="{{ url('/images/gal-img/thumb-2.jpg') }}">
	                    </a>
	                </li>
	                <li class="col-xs-6 col-sm-4 col-md-3" data-responsive="img/13-375.jpg 375, img/13-480.jpg 480, img/13.jpg 800" data-src="images/gal-img/13-1600.jpg" data-sub-html="<h4>Bowness Bay</h4><p>A beautiful Sunrise this morning taken En-route to Keswick not one as planned but I'm extremely happy I was passing the right place at the right time....</p>">
	                    <a href="">
	                        <img class="img-responsive" src="{{ url('/images/gal-img/thumb-13.jpg') }}">
	                    </a>
	                </li>
	                <li class="col-xs-6 col-sm-4 col-md-3" data-responsive="img/4-375.jpg 375, img/4-480.jpg 480, img/4.jpg 800" data-src="images/gal-img/4-1600.jpg" data-sub-html="<h4>Bowness Bay</h4><p>A beautiful Sunrise this morning taken En-route to Keswick not one as planned but I'm extremely happy I was passing the right place at the right time....</p>">
	                    <a href="">
	                        <img class="img-responsive" src="{{ url('/images/gal-img/thumb-4.jpg') }}">
	                    </a>
	                </li><li class="col-xs-6 col-sm-4 col-md-3" data-responsive="img/1-375.jpg 375, img/1-480.jpg 480, img/1.jpg 800" data-src="images/gal-img/1-1600.jpg" data-sub-html="<h4>Fading Light</h4><p>Classic view from Rigwood Jetty on Coniston Water an old archive shot similar to an old post but a little later on.</p>">
	                    <a href="">
	                        <img class="img-responsive" src="{{ url('/images/gal-img/thumb-1.jpg') }}">
	                    </a>
	                </li>
	                <li class="col-xs-6 col-sm-4 col-md-3" data-responsive="img/2-375.jpg 375, img/2-480.jpg 480, img/2.jpg 800" data-src="images/gal-img/2-1600.jpg" data-sub-html="<h4>Bowness Bay</h4><p>A beautiful Sunrise this morning taken En-route to Keswick not one as planned but I'm extremely happy I was passing the right place at the right time....</p>">
	                    <a href="">
	                        <img class="img-responsive" src="{{ url('/images/gal-img/thumb-2.jpg') }}">
	                    </a>
	                </li>
	                <li class="col-xs-6 col-sm-4 col-md-3" data-responsive="img/13-375.jpg 375, img/13-480.jpg 480, img/13.jpg 800" data-src="images/gal-img/13-1600.jpg" data-sub-html="<h4>Bowness Bay</h4><p>A beautiful Sunrise this morning taken En-route to Keswick not one as planned but I'm extremely happy I was passing the right place at the right time....</p>">
	                    <a href="">
	                        <img class="img-responsive" src="{{ url('/images/gal-img/thumb-13.jpg') }}">
	                    </a>
	                </li>
	            </ul>
	        </div>

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