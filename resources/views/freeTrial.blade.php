@extends('layouts.app')
@section('title', 'Udistro | Events')

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
	<section class="topic-image"><img src="{{ url('/images/free-trail-topic.jpg') }}" alt=""/> </section>
	<!-- About STARTS -->
	<section class="mid-udistro">
	 <div class="container">
	  <h2>Free Trail</h2>
	  <div class="free-trail-box">
	   <div class="col-md-7">
	          <div class="leftbg-text">
	          <div class="reg-image"><img src="{{ url('/images/resgist-image.jpg') }}" alt=""/></div>
	          <h1 class="title-bg2small">When you invite clients to uDistro, they not only feel obligated to refer you to others but our software encourages them to do so.</h1>
	          <!--<h3 class="overview">Our business product helps you communicate contextually with movers, who are actively looking for your services</h3>-->
				</div>
				</div>
	   <div class="col-md-5">
	   	<div class="login-box">
	        <form name="frm_company_registration" id="frm_company_registration" autocomplete="off" novalidate>
	            <div class="form-title">
	            <h2>Get started. It’s 100% Free!</h2>
	            <h3>Start your 60 days FREE trial Now!</h3>
	            </div>
	            <div class="form-group">
	                <input placeholder="Enter Your First Name" name="rep_fname" id="rep_fname" class="form-control" type="text">
	            </div>
	            <div class="form-group">
	                <input placeholder="Enter Your Job Title" name="rep_designation" id="rep_designation" class="form-control" type="text">
	            </div>
	            <div class="form-group">
	                <input placeholder="Enter Your Email ID" name="email" id="email" class="form-control" type="text">
	            </div>
	            <div class="form-group">
	                <input placeholder="Enter Your Password" name="password" id="password" class="form-control" type="password">
	            </div>
	            <div class="form-group">
	                <input placeholder="Enter Your Phone Number" name="phone_no" id="phone_no" class="form-control" type="text">
	            </div>
	            <div class="form-group">
	                <input placeholder="Enter Your Company Name" name="company_name" id="company_name" class="form-control" type="text">
	            </div>
	            <div class="form-group">
	                <select name="company_province" id="company_province" class="form-control">
	                	<option value="">Select Province</option>
	                	<option value="1">Alberta</option><option value="2">British Columbia</option><option value="3">Manitoba</option><option value="4">New Brunswick</option><option value="5">Newfoundland And Labrador</option><option value="6">Northwest Territories</option><option value="7">Nova Scotia</option><option value="8">Nunavut</option><option value="9">Ontario</option><option value="10">Prince Edward Island</option><option value="11">Quebec</option><option value="12">Saskatchewan</option><option value="13">Yukon</option>                </select>
	            </div>
	            <div class="form-group">
	                <select name="company_type" id="company_type" class="form-control">
	                	<option value="">Select Industry Type</option>
	                	<option value="2">Home Service Company</option><option value="4">Internet &amp; Cable Service Provider</option><option value="3">Moving Company</option><option value="1">Real Estate Company</option><option value="5">Tech Concierge</option><option value="6">Utility Company</option>                </select>
	            </div>
	            <div class="form-group">
	                <input class="btn btn-default" id="btn_company_registration" name="btn_company_registration" value="Start Free Trail" type="submit">
	            </div>
	            <span class="instraction">No Risk. We won't charge your credit card until we get your permission</span>
	        </form>
		</div>
	   </div>
	  </div>
	 </div>
	</section>
	<!-- About ENDS --> 
@endsection