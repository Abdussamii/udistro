@extends('administrator.layouts.app')
@section('title', 'Udistro | Company Agents')

@section('content')
	
	<!-- Canada Post API -->
	<script type="text/javascript" src="https://ws1.postescanada-canadapost.ca/js/addresscomplete-2.30.min.js?key=kp88-mx67-ff25-xd59"></script>
	<link rel="stylesheet" type="text/css" href="https://ws1.postescanada-canadapost.ca/css/addresscomplete-2.30.min.css?key=kp88-mx67-ff25-xd59" />

	<!-- Tinymce -->
	<script type="text/javascript" src="https://tinymce.cachefly.net/4.2/tinymce.min.js"></script>

	<script type="text/javascript">
		var fields = [
		{ element: "agent_address1", field: "Line1" },
		{ element: "agent_address2", field: "Line2", mode: pca.fieldMode.POPULATE },
		{ element: "agent_city", field: "City", mode: pca.fieldMode.POPULATE },
		{ element: "agent_province", field: "ProvinceName", mode: pca.fieldMode.POPULATE },
		{ element: "agent_postalcode", field: "PostalCode" },
		{ element: "country", field: "CountryName", mode: pca.fieldMode.COUNTRY }
		],
		options = {
			key: "kp88-mx67-ff25-xd59"
		},
		control = new pca.Address(fields, options);

		var fields = [
		{ element: "agent_edit_address1", field: "Line1" },
		{ element: "agent_edit_address2", field: "Line2", mode: pca.fieldMode.POPULATE },
		{ element: "agent_edit_city", field: "City", mode: pca.fieldMode.POPULATE },
		{ element: "agent_edit_province", field: "ProvinceName", mode: pca.fieldMode.POPULATE },
		{ element: "agent_edit_postalcode", field: "PostalCode" },
		{ element: "agent_edit_country", field: "CountryName", mode: pca.fieldMode.COUNTRY }
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
            <h1 class="page-header">Company Agents</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
      		<button type="button" class="btn btn-primary" data-toggle="modal" id="btn_modal_agent">Add Agent</button>
      	</div>

      	<div class="col-lg-12 top-buffer">
	      	<!-- Table to show all the cities -->
			<table id="datatable_agents" class="table table-striped">
				<thead>
					<tr>
						<td>#</td>
						<td>Company</td>
						<td>Company Category</td>
						<td>Agent Name</td>
						<td>Email</td>
						<td>Payment Plan Expiry</td>
						<td>Status</td>
						<td>Action</td>
					</tr>
				</thead>
			</table>
		</div>

		<!-- Modal to send email to the agent with attachement -->
		<div id="modal_send_agent_email" class="modal fade" role="dialog">
		  	<div class="modal-dialog">
			    <!-- Modal content-->
			    <div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Send Email</h4>
					</div>

					<div class="modal-body">
						<form name="frm_send_agent_email" id="frm_send_agent_email" autocomplete="off">
							<div class="form-group">
								<label for="email_content">Email Content</label>
								<textarea name="email_content" id="email_content" class="form-control tinyMCE"></textarea>
								<input type="hidden" name="agent_id" id="agent_id" value="">
							</div>
							<div class="form-group">
								<label for="email_attachement">Email Attachement</label>
								<input type="file" name="email_attachement" id="email_attachement">
							</div>
							<button type="submit" id="btn_send_agent_email" name="btn_send_agent_email" class="btn btn-primary">Submit</button>
						</form>
					</div>
			    </div>
		  	</div>
		</div>
		<!-- Modal to send email to the agent with attachement -->

		<!-- Modal to add agent -->
		<div id="modal_add_agent" class="modal fade" role="dialog">
		  	<div class="modal-dialog">
			    <!-- Modal content-->
			    <div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Add Agent</h4>
					</div>

					<div class="modal-body">
						<form name="frm_add_agent" id="frm_add_agent" autocomplete="off">
							<div class="form-group">
								<label for="agent_company">Company <span class="error">*</span></label>
								<select name="agent_company" id="agent_company" class="form-control">
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
								  		<label for="agent_fname">First Name <span class="error">*</span></label>
								  		<input type="text" name="agent_fname" id="agent_fname" class="form-control" placeholder="First Name">
								  	</div>
								  	<div class="col-sm-6">
								  		<label for="agent_lname">Last Name <span class="error">*</span></label>
								  		<input type="text" name="agent_lname" id="agent_lname" class="form-control" placeholder="Last Name">
								  	</div>
								</div>
							</div>
							<div class="form-group">
								<div class="row">
								  	<div class="col-sm-6">
								  		<label for="agent_email">Email <span class="error">*</span></label>
								  		<input type="text" name="agent_email" id="agent_email" class="form-control" placeholder="Agent Email">
								  	</div>
								  	<div class="col-sm-6">
								  		<label for="agent_password">Password <span class="error">*</span></label>
								  		<input type="password" name="agent_password" id="agent_password" class="form-control" placeholder="Password">
								  	</div>
								</div>
							</div>
							<div class="form-group">
								<label for="agent_address">Address <span class="error">*</span></label>
								<input name="agent_address1" id="agent_address1" class="form-control" value="" placeholder="Enter address" autocomplete="off" type="text">
							</div>

							<div id="add_agent_address" style="display: none;">
								<div class="form-group">
									<label for="agent_address2">Address 2</label>
									<input name="agent_address2" id="agent_address2" class="form-control" value="" placeholder="Enter address line 2" autocomplete="off" type="text">
								</div>
								<div class="form-group">
									<label for="agent_city">City</label>
						            <select id="agent_city" class="form-control" name="agent_city">
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
						        </div>
						        <div class="form-group">
									<label for="agent_province">Province</label>
			                        <select id="agent_province" class="form-control" name="agent_province">
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
			                    </div>
			                    <div class="form-group">
									<label for="agent_postalcode">Postal Code</label>
		                        	<input id="agent_postalcode" name="agent_postalcode" type="text" class="form-control" placeholder="Postal Code" />
		                        </div>
		                        <div class="form-group">
									<label for="agent_country">Country</label>
	                                <select name="agent_country" id="agent_country" class="form-control">
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
							</div>
							<div class="form-group">
								<label for="agent_payment_plan">Payment Plan <span class="error">*</span></label>
								<select name="agent_payment_plan" id="agent_payment_plan" class="form-control">
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
								<label for="agent_status">Status</label>
								<div class="radio">
								 	<label><input type="radio" name="agent_status" value="1" checked="true">Active</label>
								</div>
								<div class="radio">
								 	<label><input type="radio" name="agent_status" value="0">Inactive</label>
								</div>
								<label id="agent_status-error" class="error" for="agent_status"></label>
							</div>
							<button type="submit" id="btn_add_agent" name="btn_add_agent" class="btn btn-primary">Submit</button>
						</form>
					</div>
			    </div>
		  	</div>
		</div>

		<!-- Modal to edit agent -->
		<div id="modal_edit_agent" class="modal fade" role="dialog">
		  	<div class="modal-dialog">
			    <!-- Modal content-->
			    <div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Add Agent</h4>
					</div>

					<div class="modal-body">
						<form name="frm_edit_agent" id="frm_edit_agent" autocomplete="off">
							<div class="form-group">
								<label for="agent_company">Company <span class="error">*</span></label>
								<select name="agent_company" id="agent_company" class="form-control">
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
								  		<label for="agent_fname">First Name <span class="error">*</span></label>
								  		<input type="text" name="agent_fname" id="agent_fname" class="form-control" placeholder="First Name">
								  		<input type="hidden" name="agent_id" id="agent_id" value="">
								  		<input type="hidden" name="user_type" id="user_type" value="">
								  	</div>
								  	<div class="col-sm-6">
								  		<label for="agent_lname">Last Name <span class="error">*</span></label>
								  		<input type="text" name="agent_lname" id="agent_lname" class="form-control" placeholder="Last Name">
								  	</div>
								</div>
							</div>
							<div class="form-group">
								<div class="row">
								  	<div class="col-sm-6">
								  		<label for="agent_email">Email <span class="error">*</span></label>
								  		<input type="text" name="agent_email" id="agent_email" class="form-control" placeholder="Agent Email">
								  	</div>
								</div>
							</div>
							
							<div class="form-group">
								<label for="agent_address">Address <span class="error">*</span></label>
								<input name="agent_edit_address1" id="agent_edit_address1" class="form-control" value="" placeholder="Enter address" autocomplete="off" type="text">
							</div>

							<div id="add_agent_address" style="display: none;">
								<div class="form-group">
									<label for="agent_address">Address 2</label>
									<input name="agent_edit_address2" id="agent_edit_address2" class="form-control" value="" placeholder="Enter address line 2" autocomplete="off" type="text">
								</div>
								<div class="form-group">
									<label for="agent_edit_city">City</label>
						            <select id="agent_edit_city" class="form-control" name="agent_edit_city">
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
						        </div>
						        <div class="form-group">
									<label for="agent_edit_province">Province</label>
			                        <select id="agent_edit_province" class="form-control" name="agent_edit_province">
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
			                    </div>
			                    <div class="form-group">
									<label for="agent_edit_postalcode">Postal Code</label>
		                        	<input id="agent_edit_postalcode" name="agent_edit_postalcode" type="text" class="form-control" placeholder="Postal Code" />
		                        </div>
		                        <div class="form-group">
									<label for="agent_edit_country">Country</label>
	                                <select name="agent_edit_country" id="agent_edit_country" class="form-control">
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
							</div>
							<div class="form-group">
								<label for="agent_edit_payment_plan">Payment Plan <span class="error">*</span></label>
								<select name="agent_edit_payment_plan" id="agent_edit_payment_plan" class="form-control">
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
								<label for="agent_status">Status <span class="error">*</span></label>
								<div class="radio">
								 	<label><input type="radio" name="agent_status" value="1" checked="true">Active</label>
								</div>
								<div class="radio">
								 	<label><input type="radio" name="agent_status" value="0">Inactive</label>
								</div>
								<label id="agent_status-error" class="error" for="agent_status"></label>
							</div>
							<button type="submit" id="btn_edit_agent" name="btn_edit_agent" class="btn btn-primary">Submit</button>
						</form>
					</div>
			    </div>
		  	</div>
		</div>
    </div>
@endsection