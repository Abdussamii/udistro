@extends('administrator.layouts.app')
@section('title', 'Udistro | Company Agents')

@section('content')
	<script type="text/javascript">
	$(document).ready(function(){
		// To pot a space after user enters 3 characters like (123 456)
		$('#frm_add_agent #agent_postalcode').keyup(function() {
		  	var postalCode = $(this).val().split(" ").join("");
		  	if (postalCode.length > 0) {
		    	postalCode = postalCode.match(new RegExp('.{1,3}', 'g')).join(" ");
		  	}
		  	$(this).val(postalCode);
		});

		$('#frm_edit_agent #agent_postalcode').keyup(function() {
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
						<td>Agent Name</td>
						<td>Email</td>
						<td>Address</td>
						<td>Province</td>
						<td>City</td>
						<td>Postal Code</td>
						<td>Status</td>
						<td>Action</td>
					</tr>
				</thead>
			</table>
		</div>

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
								<label for="agent_company">Company</label>
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
								  		<label for="agent_fname">First Name</label>
								  		<input type="text" name="agent_fname" id="agent_fname" class="form-control" placeholder="First Name">
								  	</div>
								  	<div class="col-sm-6">
								  		<label for="agent_lname">Last Name</label>
								  		<input type="text" name="agent_lname" id="agent_lname" class="form-control" placeholder="Last Name">
								  	</div>
								</div>
							</div>
							<div class="form-group">
								<div class="row">
								  	<div class="col-sm-6">
								  		<label for="agent_email">Email</label>
								  		<input type="text" name="agent_email" id="agent_email" class="form-control" placeholder="Agent Email">
								  	</div>
								  	<div class="col-sm-6">
								  		<label for="agent_password">Password</label>
								  		<input type="password" name="agent_password" id="agent_password" class="form-control" placeholder="Password">
								  	</div>
								</div>
							</div>
							<div class="form-group">
								<label for="agent_address">Address</label>
								<textarea name="agent_address" id="agent_address" placeholder="Enter address" class="form-control"></textarea>
							</div>
							<div class="form-group">
								<div class="row">
								  	<div class="col-sm-6">
								  		<label for="agent_province">Province</label>
								  		<select name="agent_province" id="agent_province" class="form-control">
								  			<option value="">Select</option>
								  			<?php
								  			if( isset( $provinces ) && count( $provinces ) > 0 )
								  			{
								  				foreach ($provinces as $province)
								  				{
								  					echo '<option value="'. $province->id .'">'. ucwords( strtolower( $province->name ) ) .'</option>';
								  				}
								  			}
								  			?>
								  		</select>
								  	</div>
								  	<div class="col-sm-6">
								  		<label for="agent_city">City</label>
								  		<select name="agent_city" id="agent_city" class="form-control">
								  			<option value="">Select</option>
								  		</select>
								  	</div>
								</div>
							</div>
							<div class="form-group">
								<label for="agent_postalcode">Postalcode</label>
								<input type="text" name="agent_postalcode" id="agent_postalcode" class="form-control">
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
								<label for="agent_company">Company</label>
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
								  		<label for="agent_fname">First Name</label>
								  		<input type="text" name="agent_fname" id="agent_fname" class="form-control" placeholder="First Name">
								  		<input type="hidden" name="agent_id" id="agent_id" value="">
								  	</div>
								  	<div class="col-sm-6">
								  		<label for="agent_lname">Last Name</label>
								  		<input type="text" name="agent_lname" id="agent_lname" class="form-control" placeholder="Last Name">
								  	</div>
								</div>
							</div>
							<div class="form-group">
								<div class="row">
								  	<div class="col-sm-6">
								  		<label for="agent_email">Email</label>
								  		<input type="text" name="agent_email" id="agent_email" class="form-control" placeholder="Agent Email">
								  	</div>
								</div>
							</div>
							<div class="form-group">
								<label for="agent_address">Address</label>
								<textarea name="agent_address" id="agent_address" placeholder="Enter address" class="form-control"></textarea>
							</div>
							<div class="form-group">
								<div class="row">
								  	<div class="col-sm-6">
								  		<label for="agent_province">Province</label>
								  		<select name="agent_province" id="agent_province" class="form-control">
								  			<option value="">Select</option>
								  			<?php
								  			if( isset( $provinces ) && count( $provinces ) > 0 )
								  			{
								  				foreach ($provinces as $province)
								  				{
								  					echo '<option value="'. $province->id .'">'. ucwords( strtolower( $province->name ) ) .'</option>';
								  				}
								  			}
								  			?>
								  		</select>
								  	</div>
								  	<div class="col-sm-6">
								  		<label for="agent_city">City</label>
								  		<select name="agent_city" id="agent_city" class="form-control">
								  			<option value="">Select</option>
								  		</select>
								  	</div>
								</div>
							</div>
							<div class="form-group">
								<label for="agent_postalcode">Postalcode</label>
								<input type="text" name="agent_postalcode" id="agent_postalcode" class="form-control">
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
							<button type="submit" id="btn_edit_agent" name="btn_edit_agent" class="btn btn-primary">Submit</button>
						</form>
					</div>
			    </div>
		  	</div>
		</div>
    </div>
@endsection