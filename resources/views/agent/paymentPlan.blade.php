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
		                  	<!-- <div class="panel-footer">
		                  		<a class="btn btn-lg btn-default light-seegreen_btn agent_plan_selection" href="javascript:void(0);" id="{{ $plan->id }}">Select</a>
		                  	</div> -->
		                </div>
		            </div>
	        	<?php
	        	}
	        }
	        ?>
	  	</div>
	</div>

	<!-- Modal to show the payment options -->
    <div class="modal fade" id="make_payment_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Make Payment</h4>
				</div>
				<!-- <form action="https://secure.paypal.com/uk/cgi-bin/webscr" method="post" name="paypal" id="paypal"> -->
				<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" name="paypal" id="paypal">
					<div class="modal-body">
						<div class="form-group">
							<label for="payment_against">Payment Against</label>
							<input type="text" name="payment_against" id="payment_against" class="form-control" placeholder="Payment against" value="" disabled="true">
						</div>
						<div class="form-group">
							<label for="payment_amount">Amount</label>
							<input type="text" name="payment_amount" id="payment_amount" class="form-control" placeholder="Amount" disabled="true">
						</div>

					    <!-- Prepopulate the PayPal checkout page with customer details -->
					    <div class="form-group" style="display: none;">
						    <input type="text" name="first_name" id="first_name" value="">
						    <input type="text" name="last_name" id="last_name" value="">
						    <input type="text" name="email" id="email" value="">
						    <input type="text" name="address1" id="address1" value="">
						    <input type="text" name="address2" id="address2" value="">
						    <input type="text" name="city" id="city" value="">
						    <input type="text" name="zip" id="zip" value="">
						    <input type="text" name="day_phone_a" id="day_phone_a" value="">
						    <input type="text" name="day_phone_b" id="day_phone_b" value="">
					    </div>

					    <!-- We don't need to use _ext-enter anymore to prepopulate pages -->
					    <!-- cmd = _xclick will automatically pre populate pages -->
					    <!-- More information: https://www.x.com/docs/DOC-1332 -->
					    <div class="form-group" style="display: none;">
						    <input type="text" name="cmd" value="_xclick" />
						    <input type="text" name="business" value="info@udistro.ca" />
						    <input type="text" name="cbt" value="Return to uDistro" />
						    <input type="text" name="currency_code" value="CAD" />
						</div>

					    <!-- Allow the customer to enter the desired quantity -->
					    <div class="form-group" style="display: none;">
						    <input type="text" name="quantity" id="quantity" value="1" />
						    <input type="text" name="item_name" id="item_name" value="" />
						</div>

					    <!-- Custom value you want to send and process back in the IPN -->
					    <div class="form-group" style="display: none;">
						    <!-- <input type="text" name="custom" value="" />
						    <input type="text" name="shipping" value="" /> -->
						    <input type="text" name="invoice" id="invoice" value="" />
						    <input type="text" name="amount" id="amount" value="" />
						    <input type="text" name="return" value="{{ url('/paypal/success') }}"/>		<!-- http://localhost/paypal_integration_php/success.php -->
						    <input type="text" name="cancel_return" value="{{ url('/paypal/cancel') }}" />		<!-- http://localhost/paypal_integration_php/cancel.php -->
						</div>

					    <!-- Where to send the PayPal IPN to. -->
					    <input type="text" name="notify_url" value="{{ url('/paypal/paymentstatus') }}" style="display: none;"/>

					    <!-- Redirect the user to the billing page instead of paypal payment page -->
					    <input type="hidden" name="landing_page" value="billing">
					</div>

					<div class="modal-footer">
						<!-- For production -->
						<!-- <input type="image" name="submit" border="0" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif" alt="PayPal - The safer, easier way to pay online"> 
						<img alt="" border="0" width="1" height="1" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" >  -->

						<!-- For development -->
						<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
 						<img alt="" border="0" src="https://www.sandbox.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
					</div>
				</form>
			</div>
		</div>
    </div>

@endsection