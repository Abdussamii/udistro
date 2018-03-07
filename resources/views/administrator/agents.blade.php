@extends('administrator.layouts.app')
@section('title', 'Udistro | Company Agents')

@section('content')
	
	<!-- Canada Post API -->
	<script type="text/javascript" src="https://ws1.postescanada-canadapost.ca/js/addresscomplete-2.30.min.js?key=kp88-mx67-ff25-xd59"></script>
	<link rel="stylesheet" type="text/css" href="https://ws1.postescanada-canadapost.ca/css/addresscomplete-2.30.min.css?key=kp88-mx67-ff25-xd59" />

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
						<td>Company Category</td>
						<td>Agent Name</td>
						<td>Email</td>
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
								<input name="agent_address1" id="agent_address1" class="form-control" value="" placeholder="Enter address" autocomplete="off" type="text">
							</div>

							<div id="add_agent_address" style="display: none;">
								<input name="agent_address2" id="agent_address2" class="form-control" value="" placeholder="Enter address line 2" autocomplete="off" type="text">
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
		                        <input id="agent_postalcode" name="agent_postalcode" type="text" class="form-control" placeholder="Zip/Postcode" />
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
								  		<input type="hidden" name="user_type" id="user_type" value="">
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
								<input name="agent_edit_address1" id="agent_edit_address1" class="form-control" value="" placeholder="Enter address" autocomplete="off" type="text">
							</div>

							<div id="add_agent_address" style="display: none;">
								<input name="agent_edit_address2" id="agent_edit_address2" class="form-control" value="" placeholder="Enter address line 2" autocomplete="off" type="text">
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
		                        <input id="agent_edit_postalcode" name="agent_edit_postalcode" type="text" class="form-control" placeholder="Zip/Postcode" />
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