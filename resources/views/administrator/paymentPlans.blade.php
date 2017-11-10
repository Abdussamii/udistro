@extends('administrator.layouts.app')
@section('title', 'Udistro | Payment Plans')

@section('content')
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
						<td>Validity (In Days)</td>
						<td>Number Of Emails</td>
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
								<label for="payment_plan_name">Payment Plan Name</label>
								<input type="text" name="payment_plan_name" id="payment_plan_name" class="form-control" placeholder="Enter plan name">
								<input type="hidden" name="payment_plan_id" id="payment_plan_id">
							</div>
							<div class="form-group">
								<label for="payment_plan_charge">Payment Plan Charge</label>
								<input type="text" name="payment_plan_charge" id="payment_plan_charge" class="form-control" placeholder="Enter charge">
							</div>
							<div class="form-group">
								<label for="payment_plan_validity">Validity (In days)</label>
								<input type="text" name="payment_plan_validity" id="payment_plan_validity" class="form-control" placeholder="Enter validity">
							</div>
							<div class="form-group">
								<label for="payment_plan_emails">Number of emails</label>
								<input type="text" name="payment_plan_emails" id="payment_plan_emails" class="form-control" placeholder="Enter number of emails">
							</div>
							<div class="form-group">
								<label for="payment_plan_status">Status</label>
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