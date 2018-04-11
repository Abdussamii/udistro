@extends('layouts.app')
@section('title', 'Udistro | Our Team')

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
	<section class="topic-image"> <img src="{{ url('/images/team-topic.jpg') }}" alt=""/> </section>
	<section class="mid-udistro">
	 	<div class="container">
		  	<h2>Coming Soon</h2>
		  	<br><br>
		</div>
	</section>
	<!-- About STARTS -->
	<!-- <section class="mid-udistro">
	 <div class="container">
	  <h2>Leadership</h2>
	  <div class="team-pictures">
	   <div class="tagline-team">We’re led by a team who constantly questions, tinkers, and challenges to unlock great creativity around every turn.</div>
	  <div class="team-details">
	   <div class="col-sm-12">
	   	<div class="col-md-4 col-sm-6 col-xs-12 photo-wrap">
	    	<div class="picture-box">
	     	<div class="photo">
	      	<img src="{{ url('/images/one.png') }}" alt="" />
	      </div>
	      <div class="mem-detail">
	       <div class="name">Darrell Penner</div>
	       <div class="designation">Chief Operating Officer</div>
	      </div>
	     </div>
	    </div>
	    <div class="col-md-4 col-sm-6 col-xs-12 photo-wrap">
	    	<div class="picture-box">
	     	<div class="photo">
	      	<img src="{{ url('/images/two.png') }}" alt="" />
	      </div>
	      <div class="mem-detail">
	       <div class="name">Akeem Adebisi</div>
	       <div class="designation">Chief Information Officer</div>
	      </div>
	     </div>
	    </div>
	   
	   <div class="col-md-4 col-sm-6 col-xs-12 photo-wrap">
	    	<div class="picture-box">
	     	<div class="photo">
	      	<img src="{{ url('/images/three.png') }}" alt="" />
	      </div>
	      <div class="mem-detail">
	       <div class="name">Tope Otubusen</div>
	       <div class="designation">Chief Technology Officer</div>
	      </div>
	     </div>
	    </div>
	   
	   <div class="col-md-4 col-sm-6 col-xs-12 photo-wrap">
	    	<div class="picture-box">
	     	<div class="photo">
	      	<img src="{{ url('/images/rick_buchan.png') }}" alt="" />
	      </div>
	      <div class="mem-detail">
	       <div class="name">Rick Buchan</div>
	       <div class="designation">Chief Marketing Officer</div>
	      </div>
	     </div>
	  </div>
	   
	   <div class="col-md-4 col-sm-6 col-xs-12 photo-wrap">
	    	<div class="picture-box">
	     	<div class="photo">
	      	<img src="{{ url('/images/four.png') }}" alt="" />
	      </div>
	      <div class="mem-detail">
	       <div class="name">Tod Niblock</div>
	       <div class="designation">Board Members</div>
	      </div>
	     </div>
	    </div>
	   
	   <div class="col-md-4 col-sm-6 col-xs-12 photo-wrap">
	    	<div class="picture-box">
	     	<div class="photo">
	      	<img src="{{ url('/images/Lana.png') }}" alt="" />
	      </div>
	      <div class="mem-detail">
	       <div class="name">Lana Adeleye-Olusae</div>
	       <div class="designation">Board Members</div>
	      </div>
	     </div>
	    </div>
	   		
	   </div>
	  </div>
	  </div>
	 </div>
	</section> -->
	<!-- About ENDS --> 
@endsection