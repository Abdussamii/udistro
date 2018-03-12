@extends('administrator.layouts.app')
@section('title', 'Udistro | Company Representative')

@section('content')

	<!-- Canada Post API -->
	<script type="text/javascript" src="https://ws1.postescanada-canadapost.ca/js/addresscomplete-2.30.min.js?key=kp88-mx67-ff25-xd59"></script>
	<link rel="stylesheet" type="text/css" href="https://ws1.postescanada-canadapost.ca/css/addresscomplete-2.30.min.css?key=kp88-mx67-ff25-xd59" />

	<!-- Tinymce -->
	<script type="text/javascript" src="https://tinymce.cachefly.net/4.2/tinymce.min.js"></script>

	<script type="text/javascript">
		var fields = [
			{ element: "company_representative_address1", field: "Line1" },
			{ element: "company_representative_address2", field: "Line2", mode: pca.fieldMode.POPULATE },
			{ element: "company_representative_city", field: "City", mode: pca.fieldMode.POPULATE },
			{ element: "company_representative_province", field: "ProvinceName", mode: pca.fieldMode.POPULATE },
			{ element: "company_representative_postalcode", field: "PostalCode" },
			{ element: "company_representative_country", field: "CountryName", mode: pca.fieldMode.COUNTRY }
		],
		options = {
			key: "kp88-mx67-ff25-xd59"
		},
		control = new pca.Address(fields, options);

		var fields = [
			{ element: "company_representative_edit_address1", field: "Line1" },
			{ element: "company_representative_edit_address2", field: "Line2", mode: pca.fieldMode.POPULATE },
			{ element: "company_representative_edit_city", field: "City", mode: pca.fieldMode.POPULATE },
			{ element: "company_representative_edit_province", field: "ProvinceName", mode: pca.fieldMode.POPULATE },
			{ element: "company_representative_edit_postalcode", field: "PostalCode" },
			{ element: "company_representative_edit_country", field: "CountryName", mode: pca.fieldMode.COUNTRY }
		],
		options = {
			key: "kp88-mx67-ff25-xd59"
		},
		control = new pca.Address(fields, options);

		$(document).ready(function(){
	    	tinymce.init({
	        selector: ".tinyMCE",
	        height: "300",
	        // For enabling diff plugin like file upload, create href link etc.
	        // plugins : 'advlist autolink link image imagetools lists charmap print preview contextmenu textcolor colorpicker fullscreen hr insertdatetime media pagebreak save table textpattern wordcount visualchars'
	    	});
	    });
	</script>

	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Company Representative</h1>
        </div>
    </div>
    <div class="row">
		<div class="col-lg-12">
			<button type="button" class="btn btn-primary" data-toggle="modal" id="btn_modal_company_representative">Add Company Representative</button>
		</div>

        <div class="col-lg-12 top-buffer">
	      	<!-- Table to show all the cities -->
			<table id="datatable_company_representatives" class="table table-striped">
				<thead>
					<tr>
						<td>#</td>
						<td>Company</td>
						<td>Company Category</td>
						<td>company_representative Name</td>
						<td>Email</td>
						<td>Payment Plan Expiry</td>
						<td>Status</td>
						<td>Action</td>
					</tr>
				</thead>
			</table>
		</div>
    </div>

    <!-- Modal to send email to the company representative with attachement -->
    <div id="modal_send_company_representative_email" class="modal fade" role="dialog">
      	<div class="modal-dialog">
    	    <!-- Modal content-->
    	    <div class="modal-content">
    			<div class="modal-header">
    				<button type="button" class="close" data-dismiss="modal">&times;</button>
    				<h4 class="modal-title">Send Email</h4>
    			</div>

    			<div class="modal-body">
    				<form name="frm_send_company_representative_email" id="frm_send_company_representative_email" autocomplete="off">
    					<div class="form-group">
    						<label for="email_content">Email Content</label>
    						<textarea name="email_content" id="email_content" class="form-control tinyMCE"></textarea>
    						<input type="hidden" name="company_representative_id" id="company_representative_id" value="">
    					</div>
    					<div class="form-group">
    						<label for="email_attachement">Email Attachement</label>
    						<input type="file" name="email_attachement" id="email_attachement">
    					</div>
    					<button type="submit" id="btn_send_company_representative_email" name="btn_send_company_representative_email" class="btn btn-primary">Submit</button>
    				</form>
    			</div>
    	    </div>
      	</div>
    </div>
    <!-- Modal to send email to the company representative with attachement -->

    <!-- Modal to add company representative -->
    <div id="modal_add_company_representative" class="modal fade" role="dialog">
	  	<div class="modal-dialog">
		    <!-- Modal content-->
		    <div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Add company_representative</h4>
				</div>

				<div class="modal-body">
					<form name="frm_add_company_representative" id="frm_add_company_representative" autocomplete="off">
						<div class="form-group">
							<label for="company_representative_company">Company</label>
							<select name="company_representative_company" id="company_representative_company" class="form-control">
								<option value="">Select</option>
								<?php
								if( isset( $companies ) && count( $companies ) > 0 )
								{
									foreach ($companies as $company)
									{
										echo '<option value="'. $company->id .'">'.ucwords( strtolower( $company->company_name ) ) .'</option>';
									}
								}
								?>
							</select>
						</div>
						<div class="form-group">
							<div class="row">
							  	<div class="col-sm-6">
							  		<label for="company_representative_fname">First Name</label>
							  		<input type="text" name="company_representative_fname" id="company_representative_fname" class="form-control" placeholder="First Name">
							  	</div>
							  	<div class="col-sm-6">
							  		<label for="company_representative_lname">Last Name</label>
							  		<input type="text" name="company_representative_lname" id="company_representative_lname" class="form-control" placeholder="Last Name">
							  	</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
							  	<div class="col-sm-6">
							  		<label for="company_representative_email">Email</label>
							  		<input type="text" name="company_representative_email" id="company_representative_email" class="form-control" placeholder="company_representative Email">
							  	</div>
							  	<div class="col-sm-6">
							  		<label for="company_representative_password">Password</label>
							  		<input type="password" name="company_representative_password" id="company_representative_password" class="form-control" placeholder="Password">
							  	</div>
							</div>
						</div>
						<div class="form-group">
							<label for="company_representative_address1">Address</label>
							<input name="company_representative_address1" id="company_representative_address1" class="form-control" value="" placeholder="Enter address" autocomplete="off" type="text">
						</div>

						<div id="add_company_representative_address" style="display: none;">
							<input name="company_representative_address2" id="company_representative_address2" class="form-control" value="" placeholder="Enter address line 2" autocomplete="off" type="text">
				            <select id="company_representative_city" class="form-control" name="company_representative_city">
								<option value="">Select</option>
									<?php
									if( isset( $cities ) && count( $cities ) > 0 )
									{
										foreach($cities as $city)
										{
											echo '<option value="'. $city['id'] .'">'. $city['name'] .'</option>';
										}
									}
									?>
				            </select>
	                        <select id="company_representative_province" class="form-control" name="company_representative_province">
	            				<option value="">Select</option>
	            					<?php
	            					if( isset( $provinces ) && count( $provinces ) > 0 )
	            					{
	            						foreach($provinces as $province)
	            						{
	            							echo '<option data-abbreviation="'. $province->abbreviation .'" value="'. $province->id .'">'. $province->name .'</option>';
	            						}
	            					}
	            					?>
	                        </select>
	                        <input id="company_representative_postalcode" name="company_representative_postalcode" type="text" class="form-control" placeholder="Zip/Postcode" />
                            <select name="company_representative_country" id="company_representative_country" class="form-control">
                				<option value="">Select</option>
                					<?php
                					if( isset( $countries ) && count( $countries ) > 0 )
                					{
                						foreach($countries as $country)
                						{
                							echo '<option value="'. $country->id .'">'. $country->name .'</option>';
                						}
                					}
                					?>
                            </select>
						</div>
						<div class="form-group">
							<label for="company_representative_payment_plan">Payment Plan</label>
							<select name="company_representative_payment_plan" id="company_representative_payment_plan" class="form-control">
								<option value="">Select</option>
								<?php
								if( isset( $paymentPlans ) && count( $paymentPlans ) > 0 )
								{
									foreach ($paymentPlans as $paymentPlan)
									{
										echo '<option value="'. $paymentPlan->id .'">'.ucwords( strtolower( $paymentPlan->plan_name ) ) .' - $'. $paymentPlan->plan_charges . ' - ' . $paymentPlan->validity_days . ' Days' .'</option>';
									}
								}
								?>
							</select>
						</div>
						<div class="form-group">
							<label for="company_representative_status">Status</label>
							<div class="radio">
							 	<label><input type="radio" name="company_representative_status" value="1" checked="true">Active</label>
							</div>
							<div class="radio">
							 	<label><input type="radio" name="company_representative_status" value="0">Inactive</label>
							</div>
							<label id="company_representative_status-error" class="error" for="company_representative_status"></label>
						</div>
						<button type="submit" id="btn_add_company_representative" name="btn_add_company_representative" class="btn btn-primary">Submit</button>
					</form>
				</div>
		    </div>
	  	</div>
	</div>

	<!-- Modal to edit company_representative -->
	<div id="modal_edit_company_representative" class="modal fade" role="dialog">
	  	<div class="modal-dialog">
		    <!-- Modal content-->
		    <div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Add Company Representative</h4>
				</div>

				<div class="modal-body">
					<form name="frm_edit_company_representative" id="frm_edit_company_representative" autocomplete="off">
						<div class="form-group">
							<label for="company_representative_company">Company</label>
							<select name="company_representative_company" id="company_representative_company" class="form-control">
								<option value="">Select</option>
								<?php
								if( isset( $companies ) && count( $companies ) > 0 )
								{
									foreach ($companies as $company)
									{
										echo '<option value="'. $company->id .'">'.ucwords( strtolower( $company->company_name ) ) .'</option>';
									}
								}
								?>
							</select>
						</div>
						<div class="form-group">
							<div class="row">
							  	<div class="col-sm-6">
							  		<label for="company_representative_fname">First Name</label>
							  		<input type="text" name="company_representative_fname" id="company_representative_fname" class="form-control" placeholder="First Name">
							  		<input type="hidden" name="company_representative_id" id="company_representative_id" value="">
							  		<input type="hidden" name="user_type" id="user_type" value="">
							  	</div>
							  	<div class="col-sm-6">
							  		<label for="company_representative_lname">Last Name</label>
							  		<input type="text" name="company_representative_lname" id="company_representative_lname" class="form-control" placeholder="Last Name">
							  	</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
							  	<div class="col-sm-6">
							  		<label for="company_representative_email">Email</label>
							  		<input type="text" name="company_representative_email" id="company_representative_email" class="form-control" placeholder="Company Representative Email">
							  	</div>
							</div>
						</div>
						
						<div class="form-group">
							<label for="company_representative_address">Address</label>
							<input name="company_representative_edit_address1" id="company_representative_edit_address1" class="form-control" value="" placeholder="Enter address" autocomplete="off" type="text">
						</div>

						<div id="edit_company_representative_address" style="display: none;">
							<input name="company_representative_edit_address2" id="company_representative_edit_address2" class="form-control" value="" placeholder="Enter address line 2" autocomplete="off" type="text">
				            <select id="company_representative_edit_city" class="form-control" name="company_representative_edit_city">
								<option value="">Select</option>
									<?php
									if( isset( $cities ) && count( $cities ) > 0 )
									{
										foreach($cities as $city)
										{
											echo '<option value="'. $city['id'] .'">'. $city['name'] .'</option>';
										}
									}
									?>
				            </select>
	                        <select id="company_representative_edit_province" class="form-control" name="company_representative_edit_province">
	            				<option value="">Select</option>
	            					<?php
	            					if( isset( $provinces ) && count( $provinces ) > 0 )
	            					{
	            						foreach($provinces as $province)
	            						{
	            							echo '<option data-abbreviation="'. $province->abbreviation .'" value="'. $province->id .'">'. $province->name .'</option>';
	            						}
	            					}
	            					?>
	                        </select>
	                        <input id="company_representative_edit_postalcode" name="company_representative_edit_postalcode" type="text" class="form-control" placeholder="Zip/Postcode" />
                            <select name="company_representative_edit_country" id="company_representative_edit_country" class="form-control">
                				<option value="">Select</option>
                					<?php
                					if( isset( $countries ) && count( $countries ) > 0 )
                					{
                						foreach($countries as $country)
                						{
                							echo '<option value="'. $country->id .'">'. $country->name .'</option>';
                						}
                					}
                					?>
                            </select>
						</div>
						<div class="form-group">
							<label for="company_representative_edit_payment_plan">Payment Plan</label>
							<select name="company_representative_edit_payment_plan" id="company_representative_edit_payment_plan" class="form-control">
								<option value="">Select</option>
								<?php
								if( isset( $paymentPlans ) && count( $paymentPlans ) > 0 )
								{
									foreach ($paymentPlans as $paymentPlan)
									{
										echo '<option value="'. $paymentPlan->id .'">'.ucwords( strtolower( $paymentPlan->plan_name ) ) .' - $'. $paymentPlan->plan_charges . ' - ' . $paymentPlan->validity_days . ' Days' .'</option>';
									}
								}
								?>
							</select>
						</div>
						<div class="form-group">
							<label for="company_representative_status">Status</label>
							<div class="radio">
							 	<label><input type="radio" name="company_representative_status" value="1" checked="true">Active</label>
							</div>
							<div class="radio">
							 	<label><input type="radio" name="company_representative_status" value="0">Inactive</label>
							</div>
							<label id="company_representative_status-error" class="error" for="company_representative_status"></label>
						</div>
						<button type="submit" id="btn_edit_company_representative" name="btn_edit_company_representative" class="btn btn-primary">Submit</button>
					</form>
				</div>
		    </div>
	  	</div>
	</div>

@endsection