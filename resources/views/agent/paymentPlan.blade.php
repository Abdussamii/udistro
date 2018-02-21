@extends('agent.layouts.app')
@section('title', 'Udistro | Payment Plan')

@section('content')
	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Payment Plan</h1>
        </div>
    </div>
    <div class="row">
        <h3>Current Plan</h3>
        <?php
        if( count( $selectedPaymentPlan ) == 1 )
        {
        ?>
    		<div class="col-md-3">
                <div class="panel panel-danger light-seegreen">
					<div class="panel-heading">
						<h3 class="text-center">{{ ucwords(strtolower( $selectedPaymentPlan->plan_name )) }}</h3>
						<!-- <p class="text-center plan">Trial Plan</p> -->
					</div>
					<ul class="list-group list-group-flush text-center">
						<li class="list-group-item">Quota: {{ $selectedPaymentPlan->quota }} emails</li>
						<li class="list-group-item">Remaining Quota: {{ $selectedPaymentPlan->remaining_qouta }} emails</li>
					</ul>
					<div class="panel-body text-center">
						<p class="lead" style="font-size:30px">
						<strong><span class="dollor">${{ $selectedPaymentPlan->plan_charges }}</span><span class="price-d"></span><br>
						<p class="monthly">Valid Upto {{ date('d-m-Y', strtotime( $selectedPaymentPlan->end_date ) ) }}</p>
						</strong>
						</p>
					</div>
                  	<!-- <div class="panel-footer">
                  		<a class="btn btn-lg btn-default light-seegreen_btn company_plan_selection" href="javascript:void(0);" id="">Select</a>
                  	</div> -->
                </div>
            </div>
        <?php
        }
        else
        {
        ?>
    		<div class="col-md-3">
                <div class="panel panel-danger light-seegreen">
					<div class="panel-heading">
						<h3 class="text-center">No payment plan is selected</h3>
						<!-- <p class="text-center plan">Trial Plan</p> -->
					</div>
					<ul class="list-group list-group-flush text-center">
						<li class="list-group-item">Quota: 0 emails</li>
						<li class="list-group-item">Remaining Quota: 0 emails</li>
					</ul>
					<div class="panel-body text-center">
						<p class="lead" style="font-size:30px">
						<strong><span class="dollor">$0</span><span class="price-d"></span><br>
						<p class="monthly">Expired</p>
						</strong>
						</p>
					</div>
                  	<!-- <div class="panel-footer">
                  		<a class="btn btn-lg btn-default light-seegreen_btn company_plan_selection" href="javascript:void(0);" id="">Select</a>
                  	</div> -->
                </div>
            </div>
        <?php
        }
        ?>
    </div>
    
    <div class="row">
    	<h3>Plan Listing</h3>
	    <div class="col-lg-12 col-md-12 col-sm-12 top-buffer">
	        <?php 
	        if( count( $paymentPlans ) > 0 )
	        {
	        	foreach ($paymentPlans as $plan)
	        	{
	        	?>
	        		<div class="col-md-3">
		                <div class="panel panel-danger light-seegreen">
							<div class="panel-heading">
								<h3 class="text-center">{{ ucwords(strtolower( $plan->plan_name )) }}</h3>
								<!-- <p class="text-center plan">Trial Plan</p> -->
							</div>
							<ul class="list-group list-group-flush text-center">
								<li class="list-group-item">{{ $plan->allowed_count }} emails</li>
								<!-- <li class="list-group-item">Brand Emails</li>
								<li class="list-group-item">Custom Logo</li>
								<li class="list-group-item">Review Brand</li> -->
							</ul>
							<div class="panel-body text-center">
								<p class="lead" style="font-size:30px">
								<strong><span class="dollor">$</span><span class="price-d">{{ $plan->plan_charges }}</span><br>
								<p class="monthly">{{ $plan->validity_days . ' days' }}</p>
								</strong>
								</p>
							</div>
		                  	<div class="panel-footer">
		                  		<a class="btn btn-lg btn-default light-seegreen_btn company_plan_selection" href="javascript:void(0);" id="{{ $plan->id }}">Select</a>
		                  	</div>
		                </div>
		            </div>
	        	<?php
	        	}
	        }
	        ?>
	  	</div>
	</div>

@endsection