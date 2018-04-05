@extends('layouts.app')
@section('title', 'Udistro | Free Trial')

@section('content')
	
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> 
	<!-- Include all compiled plugins (below), or include individual files as needed -->

	<script type="text/javascript" src="{{ URL::asset('js/bootstrap.min.js') }}"></script>

	<!-- JQuery Validation -->
	<script type="text/javascript" src="{{ URL::asset('js/jquery.validate.min.js') }}"></script>

	<!-- JS Alert Plug-in -->
	<script type="text/javascript" src="{{ URL::asset('js/alertify.min.js') }}"></script>
	<link rel="stylesheet" href="{{ URL::asset('css/alertify.min.css') }}" />

	<script type="text/javascript">
	$(document).ready(function(){
		$.validator.addMethod("canadaPhone", function (value, element) {
			if( value != '' )
			{
			    var filter = /^((\+[1-9]{0,4}[ \-]*)|(\([0-9]{2,3}\)[ \-]*)|([0-9]{2,4})[ \-]*)*?[0-9]{3,4}?[ \-]*[0-9]{3,4}?$/;
			    if (filter.test(value)) {
			        return true;
			    }
			    else {
			        return false;
			    }
			}
			else
			{
				return true;
			}
		}, 'Please enter a valid number');

		$('#frm_company_registration').submit(function(e){
		    e.preventDefault();
		});
		$('#frm_company_registration').validate({
		    rules: {
		    	rep_fname: {
		    		required: true
		    	},
		    	rep_lname: {
		    		required: true
		    	},
		    	rep_designation: {
		    		required: true
		    	},
		    	email: {
		            required: true,
		            email: true
		        },
		        password: {
		            required: true,
		            minlength: 6
		        },
		    	phone_no: {
		    		required: true,
		    		number: true,
		    		canadaPhone: true
		    	},
		    	company_name: {
		    		required: true
		    	},
		    	company_province: {
		    		required: true
		    	},
		    	company_type: {
		    		required: true
		    	}
		    },
		    messages: {
		    	rep_fname: {
		    		required: 'Please enter first name'
		    	},
		    	rep_lname: {
		    		required: 'Please enter last name'
		    	},
		    	rep_designation: {
		    		required: 'Please enter job title'
		    	},
		    	email: {
		            required: 'Please enter email',
		            email: 'Please enter valid email'
		        },
		        password: {
		            required: 'Please enter password',
		            minlength: 'Password must contain atleat 6 characters'
		        },
		    	phone_no: {
		    		required: 'Please enter phone number',
		    		number: 'Please enter a valid number'
		    	},
		    	company_name: {
		    		required: 'Please enter company name'
		    	},
		    	company_province: {
		    		required: 'Please select province'
		    	},
		    	company_type: {
		    		required: 'Please select industry type'
		    	}
		    }
		});
		$('#btn_company_registration').click(function(){
	    	if( $('#frm_company_registration').valid() )
	    	{
	    		var $this = $(this);

	    		$.ajax({
	    			url: $('meta[name="route"]').attr('content') + '/company/registercompany',
	    			method: 'post',
	    			data: {
	    				frmData: $('#frm_company_registration').serialize()
	    			},
	    			beforeSend: function() {
	    				// Show the loading button
	    			    $this.button('loading');
	    			},
	    			complete: function()
	    			{
	    				// Change the button to previous
	    				$this.button('reset');
	    			},
	    			headers: {
				        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				    },
				    success: function(response){
				    	if( response.errCode == 0 )
				    	{
				    		alertify.success( response.errMsg );

				    		// Refresh the form
				    		$('#frm_company_registration')[0].reset();
				    	}
				    	else
				    	{
				    		alertify.error( response.errMsg );
				    	}
				    }
	    		});
	    	}
	    });
	});
	</script>

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
	<section class="topic-image"><img src="{{ url('/images/free-trail-topic.jpg') }}" alt=""/> </section>
	<!-- About STARTS -->
	<section class="mid-udistro">
	 <div class="container">
	  <h2>Free Trial</h2>
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
	                <input placeholder="Last name" name="rep_lname" id="rep_lname" type="text" class="form-control" />
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
	                	<?php
	                	if( count( $provinces ) > 0 )
	                	{
	                		foreach ($provinces as $province)
	                		{
	                			echo '<option value="'. $province->id .'">'. ucwords( strtolower( $province->name ) ) .'</option>';
	                		}
	                	}
	                	?>
	                </select>
	            </div>
	            <div class="form-group">
	                <select name="company_type" id="company_type" class="form-control">
	                	<option value="">Select Industry Type</option>
	                	<?php
	                	if( count( $companyCategories ) > 0 )
	                	{
	                		foreach ($companyCategories as $category)
	                		{
	                			echo '<option value="'. $category->id .'">'. ucwords( strtolower( $category->category ) ) .'</option>';
	                		}
	                	}
	                	?>
	                </select>
	            </div>
	            <div class="form-group">
	                <input type="button" class="btn btn-default" id="btn_company_registration" name="btn_company_registration" value="Start Free Trail" type="submit">
	            </div>
	            <span class="instraction"> No auto charge after the free trial ends. We ask you for your credit card to make sure you are not a robot. You won’t be charged unless you manually upgrade to a paid account.</span>
	        </form>
		</div>
	   </div>
	  </div>
	 </div>
	</section>
	<!-- About ENDS --> 
@endsection