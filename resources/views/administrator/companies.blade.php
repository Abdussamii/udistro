@extends('administrator.layouts.app')
@section('title', 'Udistro | Companies')

@section('content')
	<script type="text/javascript">
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
					<tr>
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
								<label for="company_address">Company Address</label>
								<textarea name="company_address" id="company_address" placeholder="Enter address" class="form-control"></textarea>
							</div>
							<div class="form-group">
								<div class="row">
								  	<div class="col-sm-6">
								  		<label for="company_province">Province</label>
								  		<select name="company_province" id="company_province" class="form-control">
								  			<option value="">Select</option>
								  			<?php
								  			if( isset( $provinces ) && count( $provinces ) > 0 )
								  			{
								  				foreach ($provinces as $province)
								  				{
								  					echo '<option value="'. $province->id .'">'. $province->name .'</option>';
								  				}
								  			}
								  			?>
								  		</select>
								  	</div>
								  	<div class="col-sm-6">
								  		<label for="company_city">Ciy</label>
								  		<select name="company_city" id="company_city" class="form-control">
								  			<option value="">Select</option>
								  		</select>
								  	</div>
								</div>
							</div>

							<div class="form-group">
								<label for="postal_code">Postal Code</label>
								<input type="text" name="postal_code" id="postal_code" class="form-control" placeholder="Enter postal code">
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
						<h4 class="modal-title">Add Company</h4>
					</div>

					<div class="modal-body">
						<form name="frm_edit_company" id="frm_edit_company" autocomplete="off">
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
								<label for="company_address">Company Address</label>
								<textarea name="company_address" id="company_address" placeholder="Enter address" class="form-control"></textarea>
							</div>
							<div class="form-group">
								<div class="row">
								  	<div class="col-sm-6">
								  		<label for="company_province">Province</label>
								  		<select name="company_province" id="company_province" class="form-control">
								  			<option value="">Select</option>
								  			<?php
								  			if( isset( $provinces ) && count( $provinces ) > 0 )
								  			{
								  				foreach ($provinces as $province)
								  				{
								  					echo '<option value="'. $province->id .'">'. $province->name .'</option>';
								  				}
								  			}
								  			?>
								  		</select>
								  	</div>
								  	<div class="col-sm-6">
								  		<label for="company_city">Ciy</label>
								  		<select name="company_city" id="company_city" class="form-control">
								  			<option value="">Select</option>
								  		</select>
								  	</div>
								</div>
							</div>

							<div class="form-group">
								<label for="postal_code">Postal Code</label>
								<input type="text" name="postal_code" id="postal_code" class="form-control" placeholder="Enter postal code">
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
							<button type="submit" id="btn_update_company_details" name="btn_update_company_details" class="btn btn-primary">Submit</button>
						</form>
					</div>
			    </div>
		  	</div>
		</div>

    </div>
@endsection