@extends('administrator.layouts.app')
@section('title', 'Udistro | Payment Plans')

@section('content')
	
	<style type="text/css">
	.loader-wrapper {
		position: fixed;
		width: 100%;
		height: 100%;
		background: #fff;
		z-index: 999;
		left:0;
		top:0;
	}
	.preload {
	    position: absolute;
	    top: 50%;
	    left: 55%;
	    transform: translate(-50%, -55%);
	    -webkit-transform: translate(-50%, -55%);
	}
	</style>

	<!-- Loader -->
	<div class="loader-wrapper">
		<div class="preload">Loading...</div>
	</div>

	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Payment Plans</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
      		<button type="button" class="btn btn-primary" data-toggle="modal" id="btn_modal_payment_plan">Add Plan</button>
      	</div>

      	<div class="col-lg-12 top-buffer">
	      	<!-- Table to show all the province -->
			<table id="datatable_payment_plans" class="table table-striped">
				<thead>
					<tr>
						<td>#</td>
						<td>Plan Name</td>
						<td style="text-align: center;">Charge</td>
						<td style="text-align: center;">Discount</td>
						<td>Validity (In Days)</td>
						<td>Number Of Emails / Number of Quotations</td>
						<td>Plan Type</td>
						<td>Status</td>
						<td>Action</td>
					</tr>
				</thead>
			</table>
		</div>

		<!-- Modal to add / edit payment plan -->
		<div id="modal_payment_plan" class="modal fade" role="dialog">
		  	<div class="modal-dialog">
			    <!-- Modal content-->
			    <div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Add Plan</h4>
					</div>

					<div class="modal-body">
						<form name="frm_add_payment_plan" id="frm_add_payment_plan" autocomplete="off">
							<div class="form-group">
								<label for="payment_plan_type">Plan Type <span class="error">*</span></label>
								<select name="payment_plan_type" id="payment_plan_type" class="form-control">
									<option value="">Select</option>
									<?php
									if( isset( $paymentPlanTypes ) && count( $paymentPlanTypes ) > 0 )
									{
										foreach($paymentPlanTypes as $paymentPlanType)
										{
											echo '<option value="'. $paymentPlanType->id .'">'. ucwords( strtolower( $paymentPlanType->plan_type ) ) .'</option>';
										}
									}
									?>
								</select>
							</div>
							<div class="form-group">
								<label for="trial_plan">Trial Plan? <span class="error">*</span></label>
								<div class="radio">
								 	<label><input type="radio" name="trial_plan" value="1">Yes</label>
								</div>
								<div class="radio">
								 	<label><input type="radio" name="trial_plan" value="0" checked="true">No</label>
								</div>
							</div>
							<div class="form-group">
								<label for="payment_plan_name">Payment Plan Name <span class="error">*</span></label>
								<input type="text" name="payment_plan_name" id="payment_plan_name" class="form-control" placeholder="Enter plan name">
								<input type="hidden" name="payment_plan_id" id="payment_plan_id">
							</div>
							<div class="form-group">
								<label for="payment_plan_charge">Payment Plan Charge <span class="error">*</span></label>
								<input type="text" name="payment_plan_charge" id="payment_plan_charge" class="form-control" placeholder="Enter charge">
							</div>
							<div class="form-group">
								<label for="payment_plan_discount">Payment Plan Discount</label>
								<input type="text" name="payment_plan_discount" id="payment_plan_discount" class="form-control" placeholder="Enter discount, if any">
							</div>
							<div class="form-group">
								<label for="payment_plan_validity">Validity (In days) <span class="error">*</span></label>
								<input type="text" name="payment_plan_validity" id="payment_plan_validity" class="form-control" placeholder="Enter validity">
							</div>
							<div class="form-group">
								<label for="payment_plan_emails">Number of emails / Percentage of quotation <span class="error">*</span></label>
								<input type="text" name="payment_plan_emails" id="payment_plan_emails" class="form-control" placeholder="Enter number of emails / percentage of quotation">
							</div>
							<div class="form-group">
								<label for="payment_plan_status">Status <span class="error">*</span></label>
								<div class="radio">
								 	<label><input type="radio" name="payment_plan_status" value="1" checked="true">Active</label>
								</div>
								<div class="radio">
								 	<label><input type="radio" name="payment_plan_status" value="0">Inactive</label>
								</div>
								<label id="payment_plan_status-error" class="error" for="payment_plan_status"></label>
							</div>
							<button type="submit" id="btn_add_payment_plan" name="btn_add_payment_plan" class="btn btn-primary">Submit</button>
						</form>
					</div>
			    </div>
		  	</div>
		</div>

    </div>
@endsection