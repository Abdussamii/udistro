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
		{ element: "city", field: "City", mode: pca.fieldMode.POPULATE },
		{ element: "state", field: "ProvinceName", mode: pca.fieldMode.POPULATE },
		{ element: "postcode", field: "PostalCode" },
		{ element: "country", field: "CountryName", mode: pca.fieldMode.COUNTRY }
	],
	options = {
		key: "kp88-mx67-ff25-xd59"
	},
	control = new pca.Address(fields, options);

	// On the selesction of address get the province abbreviation, and set it on the province dropdown
	control.listen("populate", function (address) {

	    $("#company_province option").each(function() {
			if($(this).data('abbreviation') == address.Province)
			{
				$(this).attr('selected', 'selected').change();
			}
		});

	});

	var fields1 = [
		{ element: "street-address_edit", field: "Line1" },
		{ element: "street-address2_edit", field: "Line2", mode: pca.fieldMode.POPULATE },
		{ element: "city", field: "City", mode: pca.fieldMode.POPULATE },
		{ element: "state", field: "ProvinceName", mode: pca.fieldMode.POPULATE },
		{ element: "postcode_edit", field: "PostalCode" },
		{ element: "country", field: "CountryName", mode: pca.fieldMode.COUNTRY }
	],
	options1 = {
		key: "kp88-mx67-ff25-xd59"
	},
	control1 = new pca.Address(fields1, options1);

	// On the selesction of address get the province abbreviation, and set it on the province dropdown
	control1.listen("populate", function (address) {

	    $("#company_province_edit option").each(function() {
			if($(this).data('abbreviation') == address.Province)
			{
				$(this).attr('selected', 'selected').change();
			}
		});

	});

	$(document).ready(function(){
		// To pot a space after user enters 3 characters like (123 456)
		$('#postal_code').keyup(function() {
		  	var postalCode = $(this).val().split(" ").join("");
		  	if (postalCode.length > 0) {
		    	postalCode = postalCode.match(new RegExp('.{1,3}', 'g')).join(" ");
		  	}
		  	$(this).val(postalCode);
		});
	});
	</script>
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
					<!-- <tr>
						<td>#</td>
						<td>Company Name</td>
						<td>Category</td>
						<td>Address</td>
						<td>Province</td>
						<td>City</td>
						<td>Postal Code</td>
						<td>Representative Name</td>
						<td>Email</td>
						<td>Status</td>
						<td>Action</td>
					</tr> -->

					<tr>
						<td>#</td>
						<td>Company Name</td>
						<td>Category</td>
						<td>Province</td>
						<td>Representative Name</td>
						<td>Email</td>
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
							<legend>Representative Information</legend>
							<div class="form-group">
								<div class="row">
								  	<div class="col-sm-6">
								  		<label for="representative_fname">First Name</label>
								  		<input type="text" name="representative_fname" id="representative_fname" class="form-control" placeholder="First Name">
								  	</div>
								  	<div class="col-sm-6">
								  		<label for="representative_lname">Last Name</label>
								  		<input type="text" name="representative_lname" id="representative_lname" class="form-control" placeholder="Last Name">
								  	</div>
								</div>
							</div>
							<div class="form-group">
								<div class="row">
								  	<div class="col-sm-6">
								  		<label for="representative_email">Email</label>
								  		<input type="text" name="representative_email" id="representative_email" class="form-control" placeholder="Representative Email">
								  	</div>
								  	<div class="col-sm-6">
								  		<label for="representative_password">Password</label>
								  		<input type="password" name="representative_password" id="representative_password" class="form-control" placeholder="Password">
								  	</div>
								</div>
							</div>

							<legend>Company Information</legend>
							<div class="form-group">
								<label for="company_name">Company Name</label>
								<input type="text" name="company_name" id="company_name" class="form-control" placeholder="Enter company name">
							</div>
							<div class="form-group">
								<label for="company_category">Company Category</label>
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
							<div class="form-group">
								<label class="control-label">Address Line 1:</label>
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
								<label class="control-label">City:</label>
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
								<label class="control-label">Province:</label>
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
								<label class="control-label">Postalcode:</label>
								<div class="input-line">
									<input id="postcode" name="company_postalcode" type="text" class="form-control" placeholder="Zip/Postcode" value="" />
								</div>
							</div>
							<div class="form-group">
								<label class="control-label">Country:</label>
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
			    <div class="modal-content" style="width:1100px;">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Edit Company</h4>
					</div>

					<div class="modal-body">
						<div class="row">
							<form name="frm_edit_company" id="frm_edit_company" autocomplete="off">
								<div class="col-sm-9">
									<legend>Representative Information</legend>
									<div class="form-group">
										<div class="row">
										  	<div class="col-sm-6">
										  		<label for="representative_fname">First Name</label>
										  		<input type="text" name="representative_fname" id="representative_fname" class="form-control" placeholder="First Name">
										  	</div>
										  	<div class="col-sm-6">
										  		<label for="representative_lname">Last Name</label>
										  		<input type="text" name="representative_lname" id="representative_lname" class="form-control" placeholder="Last Name">
										  	</div>
										</div>
									</div>
									<div class="form-group">
										<div class="row">
										  	<div class="col-sm-6">
										  		<label for="representative_email">Email</label>
										  		<input type="text" name="representative_email" id="representative_email" class="form-control" placeholder="Representative Email">
										  	</div>
										</div>
									</div>

									<legend>Company Information</legend>
									<div class="form-group">
										<label for="company_name">Company Name</label>
										<input type="text" name="company_name" id="company_name" class="form-control" placeholder="Enter company name">
										<input type="hidden" name="company_id" id="company_id">
									</div>
									<div class="form-group">
										<label for="company_category">Company Category</label>
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
									<div class="form-group">
										<label class="control-label">Address Line 1:</label>
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
										<label class="control-label">City:</label>
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
										<label class="control-label">Province:</label>
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
										<label class="control-label">Postalcode:</label>
										<div class="input-line">
											<input id="postcode_edit" name="company_postalcode_edit" type="text" class="form-control" placeholder="Zip/Postcode" value="" />
										</div>
									</div>
									<div class="form-group">
										<label class="control-label">Country:</label>
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
								<div class="col-sm-3">
									<label for="company_status">Image</label>
									<img src="" id="company_profile_image" height="150px" width="150px" class="avatar img-square" alt="avatar">
									<div class="top-buffer">
										<!-- To upload image -->
										<label for="company_upload_image" class="">Select File <i class="fa fa-file-image-o" aria-hidden="true"></i></label>
										<input type="file" id="company_upload_image" name="company_upload_image" accept="image/*" style="display: none">
										<div><label id="company_upload_image-error" class="error" for="company_upload_image"></label></div>
									</div>
								</div><br /><br /><br /><br /><br /><br />
								<button type="submit" id="btn_update_company_details" name="btn_update_company_details" class="btn btn-primary">Submit</button>
							</form>
						</div>
					</div>
			    </div>
		  	</div>
		</div>

    </div>
@endsection