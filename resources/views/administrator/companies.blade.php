@extends('administrator.layouts.app')
@section('title', 'Udistro | Companies')

@section('content')
	<!-- Multiple Select Dropdown -->
	<script type="text/javascript" src="{{ URL::asset('js/multiple-select.js') }}"></script>
	<link rel="stylesheet" href="{{ URL::asset('css/multiple-select.css') }}" />

	<!-- Canada Post API -->
	<script type="text/javascript" src="https://ws1.postescanada-canadapost.ca/js/addresscomplete-2.30.min.js?key=kp88-mx67-ff25-xd59"></script>
	<link rel="stylesheet" type="text/css" href="https://ws1.postescanada-canadapost.ca/css/addresscomplete-2.30.min.css?key=kp88-mx67-ff25-xd59" />

	<script type="text/javascript">
	var fields = [
		{ element: "street-address", field: "Line1" },
		{ element: "street-address2", field: "Line2", mode: pca.fieldMode.POPULATE },
		{ element: "company_city", field: "City", mode: pca.fieldMode.POPULATE },
		{ element: "company_province", field: "ProvinceName", mode: pca.fieldMode.POPULATE },
		{ element: "postcode", field: "PostalCode" },
		{ element: "country", field: "CountryName", mode: pca.fieldMode.COUNTRY }
	],
	options = {
		key: "kp88-mx67-ff25-xd59"
	},
	control = new pca.Address(fields, options);
	// For testing
	/*control.listen("populate", function (address) {
	    console.log(address.City + ' - ' + address.ProvinceCode);
	});*/

	var fields1 = [
		{ element: "street-address_edit", field: "Line1" },
		{ element: "street-address2_edit", field: "Line2", mode: pca.fieldMode.POPULATE },
		{ element: "company_city_edit", field: "City", mode: pca.fieldMode.POPULATE },
		{ element: "company_province_edit", field: "ProvinceName", mode: pca.fieldMode.POPULATE },
		{ element: "postcode_edit", field: "PostalCode" },
		{ element: "company_country_edit", field: "CountryName", mode: pca.fieldMode.COUNTRY }
	],
	options1 = {
		key: "kp88-mx67-ff25-xd59"
	},
	control1 = new pca.Address(fields1, options1);

	$(document).ready(function(){
		// To pot a space after user enters 3 characters like (123 456)
		$('#postal_code').keyup(function() {
		  	var postalCode = $(this).val().split(" ").join("");
		  	if (postalCode.length > 0) {
		    	postalCode = postalCode.match(new RegExp('.{1,3}', 'g')).join(" ");
		  	}
		  	$(this).val(postalCode);
		});

		// According to company category selection hide/show the payment_plan selection
		// Add
		$('#payment_plan_container').hide();
		$('#frm_add_company #company_category').change(function(){
			let companyCategoryId = $(this).val();

			if( companyCategoryId == '1' )
			{
				$('#payment_plan_container').hide();
			}
			else
			{
				$('#payment_plan_container').show();
			}
		});

		// Edit
		$('#edit_payment_plan_container').hide();
		$('#frm_edit_company #company_category').change(function(){
			let companyCategoryId = $(this).val();

			if( companyCategoryId == '1' )
			{
				$('#edit_payment_plan_container').hide();
			}
			else
			{
				$('#edit_payment_plan_container').show();
			}
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
            <h1 class="page-header">Companies</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
      		<button type="button" class="btn btn-primary" data-toggle="modal" id="btn_modal_company">Add Company</button>
      	</div>

      	<div class="col-lg-12 top-buffer">
	      	<!-- Table to show all the cities -->
			<table id="datatable_companies" class="table table-striped">
				<thead>
					<tr>
						<td>#</td>
						<td>Company Name</td>
						<td>Category</td>
						<td>Address</td>
						<td>Province</td>
						<td>City</td>
						<td>Status</td>
						<td>Action</td>
					</tr>
				</thead>
			</table>
		</div>

		<!-- Modal to add company -->
		<div id="modal_add_company" class="modal fade" role="dialog">
		  	<div class="modal-dialog">
			    <!-- Modal content-->
			    <div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Add Company</h4>
					</div>

					<div class="modal-body">
						<form name="frm_add_company" id="frm_add_company" autocomplete="off">
							<legend>Company Information</legend>
							<div class="form-group">
								<label for="company_name">Company Name <span class="error">*</span></label>
								<input type="text" name="company_name" id="company_name" class="form-control" placeholder="Enter company name">
							</div>
							<div class="form-group">
								<label for="company_category">Company Category <span class="error">*</span></label>
								<select name="company_category" id="company_category" class="form-control">
									<option value="">Select</option>
									<?php
									if( isset( $companyCategories ) && count( $companyCategories ) > 0 )
									{
										foreach ($companyCategories as $companyCategory)
										{
											echo '<option value="'. $companyCategory->id .'">'. ucwords( strtolower( $companyCategory->category ) ) .'</option>';
										}
									}
									?>
								</select>
							</div>

							<!-- Payment Plan Selection only for companies other than Real Estate companies -->
							<div class="form-group" id="payment_plan_container" style="display: none;">
								<label for="payment_plan">Payment Plan <span class="error">*</span></label>
								<select name="payment_plan" id="payment_plan" class="form-control">
									<option value="">Select</option>
									<?php
									if( isset( $paymentPlans ) && count( $paymentPlans ) > 0 )
									{
										foreach ($paymentPlans as $paymentPlan)
										{
											echo '<option value="'. $paymentPlan->id .'">'. ucwords( strtolower( $paymentPlan->plan_name ) ) .'</option>';
										}
									}
									?>
								</select>
							</div>

							<div class="form-group">
								<label class="control-label">Address Line 1: <span class="error">*</span></label>
								<div class="input-line">
									<input id="street-address" name="company_address1" type="text" class="form-control" placeholder="Street address" value="" />
								</div>
							</div>
							<div class="form-group">
								<label class="control-label">Address Line 2:</label>
								<div class="input-line">
									<input id="street-address2" name="company_address2" type="text" class="form-control" placeholder="Street address" value="" />
								</div>
							</div>
							<div class="form-group">
								<label class="control-label">City: <span class="error">*</span></label>
								<div class="input-line">
									<select name="company_city" id="company_city" class="form-control">
										<option value="">Select</option>
										<?php
										if( isset( $cities ) && count( $cities ) > 0 )
										{
											foreach($cities as $city)
											{
												$selected = '';
												echo '<option value="'. $city->id .'" '. $selected .'>'. $city->name .'</option>';
											}
										}
										?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label">Province: <span class="error">*</span></label>
								<div class="input-line">
									<select name="company_province" id="company_province" class="form-control">
										<option value="">Select</option>
										<?php
										if( isset( $provinces ) && count( $provinces ) > 0 )
										{
											foreach($provinces as $province)
											{
												$selected = '';
												echo '<option data-abbreviation="'. $province->abbreviation .'" value="'. $province->id .'" '. $selected .'>'. $province->name .'</option>';
											}
										}
										?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label">Postalcode: <span class="error">*</span></label>
								<div class="input-line">
									<input id="postcode" name="company_postalcode" type="text" class="form-control" placeholder="Zip/Postcode" value="" />
								</div>
							</div>
							<div class="form-group">
								<label class="control-label">Country: <span class="error">*</span></label>
								<div class="input-line">
									<select name="company_country" id="company_country" class="form-control">
										<option value="">Select</option>
										<?php
										if( isset( $countries ) && count( $countries ) > 0 )
										{
											foreach($countries as $country)
											{
												$selected = '';
												echo '<option value="'. $country->id .'" '. $selected .'>'. $country->name .'</option>';
											}
										}
										?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="company_status">Status</label>
								<div class="radio">
								 	<label><input type="radio" name="company_status" value="1" checked="true">Active</label>
								</div>
								<div class="radio">
								 	<label><input type="radio" name="company_status" value="0">Inactive</label>
								</div>
								<label id="company_status-error" class="error" for="company_status"></label>
							</div>
							<button type="submit" id="btn_add_company" name="btn_add_company" class="btn btn-primary">Submit</button>
						</form>
					</div>
			    </div>
		  	</div>
		</div>

		<!-- Modal to edit company -->
		<div id="modal_edit_company" class="modal fade" role="dialog">
		  	<div class="modal-dialog">
			    <!-- Modal content-->
			    <div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Edit Company</h4>
					</div>

					<div class="modal-body">
						<div class="row">
							<form name="frm_edit_company" id="frm_edit_company" autocomplete="off">
								<div class="col-sm-12">
									<legend>Company Information</legend>
									<div class="form-group">
										<label for="company_name">Company Name <span class="error">*</span></label>
										<input type="text" name="company_name" id="company_name" class="form-control" placeholder="Enter company name">
										<input type="hidden" name="company_id" id="company_id">
									</div>
									<div class="form-group">
										<label for="company_category">Company Category <span class="error">*</span></label>
										<select name="company_category_edit" id="company_category" class="form-control">
											<option value="">Select</option>
											<?php
											if( isset( $companyCategories ) && count( $companyCategories ) > 0 )
											{
												foreach ($companyCategories as $companyCategory)
												{
													echo '<option value="'. $companyCategory->id .'">'. ucwords( strtolower( $companyCategory->category ) ) .'</option>';
												}
											}
											?>
										</select>
									</div>

									<!-- Payment Plan Selection only for companies other than Real Estate companies -->
									<div class="form-group" id="edit_payment_plan_container" style="display: none;">
										<label for="payment_plan">Payment Plan <span class="error">*</span></label>
										<select name="payment_plan" id="payment_plan" class="form-control">
											<option value="">Select</option>
											<?php
											if( isset( $paymentPlans ) && count( $paymentPlans ) > 0 )
											{
												foreach ($paymentPlans as $paymentPlan)
												{
													echo '<option value="'. $paymentPlan->id .'">'. ucwords( strtolower( $paymentPlan->plan_name ) ) .'</option>';
												}
											}
											?>
										</select>
									</div>

									<div class="form-group">
										<label class="control-label">Address Line 1: <span class="error">*</span></label>
										<div class="input-line">
											<input id="street-address_edit" name="company_address1_edit" type="text" class="form-control" placeholder="Street address" value="" />
										</div>
									</div>
									<div class="form-group">
										<label class="control-label">Address Line 2:</label>
										<div class="input-line">
											<input id="street-address2_edit" name="company_address2_edit" type="text" class="form-control" placeholder="Street address" value=""/>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label">City: <span class="error">*</span></label>
										<div class="input-line">
											<select name="company_city_edit" id="company_city_edit" class="form-control">
												<option value="">Select</option>
												<?php
												if( isset( $cities ) && count( $cities ) > 0 )
												{
													foreach($cities as $city)
													{
														$selected = '';
														echo '<option value="'. $city->id .'" '. $selected .'>'. $city->name .'</option>';
													}
												}
												?>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label">Province: <span class="error">*</span></label>
										<div class="input-line">
											<select name="company_province_edit" id="company_province_edit" class="form-control">
												<option value="">Select</option>
												<?php
												if( isset( $provinces ) && count( $provinces ) > 0 )
												{
													foreach($provinces as $province)
													{
														$selected = '';
														echo '<option data-abbreviation="'. $province->abbreviation .'" value="'. $province->id .'" '. $selected .'>'. $province->name .'</option>';
													}
												}
												?>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label">Postalcode: <span class="error">*</span></label>
										<div class="input-line">
											<input id="postcode_edit" name="company_postalcode_edit" type="text" class="form-control" placeholder="Zip/Postcode" value="" />
										</div>
									</div>
									<div class="form-group">
										<label class="control-label">Country: <span class="error">*</span></label>
										<div class="input-line">
											<select name="company_country_edit" id="company_country_edit" class="form-control">
												<option value="">Select</option>
												<?php
												if( isset( $countries ) && count( $countries ) > 0 )
												{
													foreach($countries as $country)
													{
														$selected = '';
														echo '<option value="'. $country->id .'" '. $selected .'>'. $country->name .'</option>';
													}
												}
												?>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label for="company_status">Status</label>
										<div class="radio">
										 	<label><input type="radio" name="company_status_edit" value="1" checked="true">Active</label>
										</div>
										<div class="radio">
										 	<label><input type="radio" name="company_status_edit" value="0">Inactive</label>
										</div>
										<label id="company_status-error" class="error" for="company_status"></label>
									</div>
								</div>
								<div class="form-group col-sm-12">
									<label for="company_status">Company Logo</label>
									<img src="" id="company_profile_image" height="150px" width="150px" class="avatar img-square" alt="avatar">
									<div class="top-buffer">
										<!-- To upload image -->
										<label for="company_upload_image" class="">Select File <i class="fa fa-file-image-o" aria-hidden="true"></i></label>
										<input type="file" id="company_upload_image" name="company_upload_image" accept="image/*" style="display: none">
										<div><label id="company_upload_image-error" class="error" for="company_upload_image"></label></div>
									</div>
								</div>
								<div class="col-sm-12">
									<button type="submit" id="btn_update_company_details" name="btn_update_company_details" class="btn btn-primary">Submit</button>
								</div>
							</form>
						</div>
					</div>
			    </div>
		  	</div>
		</div>

    </div>
@endsection