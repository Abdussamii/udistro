@extends('agent.layouts.app')
@section('title', 'Udistro | Clients')

@section('content')
	<style>
	/* To resolve the google map autocomplete issue */
    .pac-container {
        z-index: 10000 !important;
    }
	</style>

	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Clients</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
      		<button type="button" class="btn btn-primary" data-toggle="modal" id="btn_modal_client">Add Client</button>
      	</div>

      	<div class="col-lg-12 top-buffer">
	      	<!-- Table to show all the cities -->
			<table id="datatable_clients" class="table table-striped">
				<thead>
					<tr>
						<td>#</td>
						<td>First Name</td>
						<td>Middle Name</td>
						<td>Last Name</td>
						<td>Email</td>
						<td>Mobile</td>
						<td>Status</td>
						<td>Action</td>
					</tr>
				</thead>
			</table>
		</div>

		<!-- Modal to add / edit client -->
		<div id="modal_add_client" class="modal fade" role="dialog">
		  	<div class="modal-dialog">
			    <!-- Modal content-->
			    <div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Add Client</h4>
					</div>

					<div class="modal-body">
						<form name="frm_add_client" id="frm_add_client" autocomplete="off">
							<div class="form-group">
								<label for="client_fname">First Name</label>
								<input type="text" name="client_fname" id="client_fname" class="form-control" placeholder="Enter first name">
								<input type="hidden" name="client_id" id="client_id" value="">
							</div>
							<div class="form-group">
								<label for="client_mname">Middle Name</label>
								<input type="text" name="client_mname" id="client_mname" class="form-control" placeholder="Enter middle name">
							</div>
							<div class="form-group">
								<label for="client_lname">Last Name</label>
								<input type="text" name="client_lname" id="client_lname" class="form-control" placeholder="Enter last name">
							</div>
							<div class="form-group">
								<label for="client_email">Email</label>
								<input type="text" name="client_email" id="client_email" class="form-control" placeholder="Enter email">
							</div>
							<div class="form-group">
								<label for="client_number">Contact Number</label>
								<input type="text" name="client_number" id="client_number" class="form-control" placeholder="Enter contact number">
							</div>
							<div class="form-group">
								<label for="client_status">Status</label>
								<div class="radio">
								 	<label><input type="radio" name="client_status" value="1" checked="true">Active</label>
								</div>
								<div class="radio">
								 	<label><input type="radio" name="client_status" value="0">Inactive</label>
								</div>
								<label id="client_status-error" class="error" for="client_status"></label>
							</div>
							<button type="submit" id="btn_add_client" name="btn_add_client" class="btn btn-primary">Submit</button>
						</form>
					</div>
			    </div>
		  	</div>
		</div>

		<!-- Modal to invite client -->
		<div id="modal_invite_client" class="modal fade" role="dialog">
		  	<div class="modal-dialog" style="width: 1000px;">
			    <!-- Modal content-->
			    <div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Invite Client</h4>
					</div>

					<div class="modal-body">
						<form name="frm_invite_client" id="frm_invite_client" autocomplete="off">
							<div class="row">
								<div class="col-sm-6 col-md-6 col-lg-6">
									<fieldset>
		    							<legend>Old Address:</legend>
										<div class="form-group">
											<label for="client_fname">Address</label>
											<input type="text" class="form-control" name="client_old_address" id="client_old_address">
										</div>
										<div class="row">
											<div class="col-sm-6">
										  		<label for="">Unit</label>
										  		<select class="form-control" name="client_old_unit_type" id="client_old_unit_type">
										  			<option value="">Select</option>
											  		<option value="appartment">Appartment</option>
											  		<option value="basement">Basement</option>
										  		</select>
										  	</div>
										  	<div class="col-sm-6">
										  		<label for="">Street Type</label>
										  		<select class="form-control" name="client_old_street_type" id="client_old_street_type">
										  			<option value="">Select</option>
											  		<?php
											  		if( isset( $streetTypes ) && count( $streetTypes ) > 0 )
											  		{
											  			foreach ($streetTypes as $streetType)
											  			{
											  				echo '<option value="'. $streetType->id .'">'. $streetType->type .'</option>';
											  			}
											  		}
											  		?>
										  		</select>
										  	</div>
										</div>
										<div class="row">
											<div class="col-sm-6">
										  		<label for="">Province</label>
										  		<select class="form-control" name="client_old_province" id="client_old_province">
										  			<option value="">Select</option>
											  		<?php
											  		if( isset( $provinces ) && count( $provinces ) > 0 )
											  		{
											  			foreach ($provinces as $province)
											  			{
											  				echo '<option data-abbreviation="'. $province->abbreviation .'" value="'. $province->id .'">'. $province->abbreviation . ' - ' . $province->name .'</option>';
											  			}
											  		}
											  		?>
										  		</select>
										  	</div>
										  	<div class="col-sm-6">
										  		<label for="">City</label>
										  		<select class="form-control" name="client_old_city" id="client_old_city">
										  			<option value="">Select</option>
											  		<?php
											  		if( isset( $cities ) && count( $cities ) > 0 )
											  		{
											  			foreach ($cities as $city)
											  			{
											  				echo '<option value="'. $city->id .'">'. $city->name .'</option>';
											  			}
											  		}
											  		?>
										  		</select>
										  	</div>
										</div>
										<div class="row">
											<div class="col-sm-6">
										  		<label for="">Country</label>
										  		<select class="form-control" name="client_old_country" id="client_old_country">
										  			<option value="">Select</option>
											  		<?php
											  		if( isset( $countries ) && count( $countries ) > 0 )
											  		{
											  			foreach ($countries as $country)
											  			{
											  				echo '<option value="'. $country->id .'">'. $country->name .'</option>';
											  			}
											  		}
											  		?>
										  		</select>
										  	</div>
										</div>
									</fieldset>
								</div>
								<div class="col-sm-6 col-md-6 col-lg-6">
									<fieldset>
		    							<legend>New Address:</legend>
										<div class="form-group">
											<label for="client_fname">Address</label>
											<input type="text" class="form-control" name="client_new_address" id="client_new_address">
										</div>
										<div class="row">
											<div class="col-sm-6">
										  		<label for="">Unit</label>
										  		<select class="form-control" name="client_new_unit_type" id="client_new_unit_type">
										  			<option value="">Select</option>
											  		<option value="appartment">Appartment</option>
											  		<option value="basement">Basement</option>
										  		</select>
										  	</div>
										  	<div class="col-sm-6">
										  		<label for="">Street Type</label>
										  		<select class="form-control" name="client_new_street_type" id="client_new_street_type">
										  			<option value="">Select</option>
											  		<?php
											  		if( isset( $streetTypes ) && count( $streetTypes ) > 0 )
											  		{
											  			foreach ($streetTypes as $streetType)
											  			{
											  				echo '<option value="'. $streetType->id .'">'. $streetType->type .'</option>';
											  			}
											  		}
											  		?>
										  		</select>
										  	</div>
										</div>
										<div class="row">
											<div class="col-sm-6">
										  		<label for="">Province</label>
										  		<select class="form-control" name="client_new_province" id="client_new_province">
										  			<option value="">Select</option>
											  		<?php
											  		if( isset( $provinces ) && count( $provinces ) > 0 )
											  		{
											  			foreach ($provinces as $province)
											  			{
											  				echo '<option data-abbreviation="'. $province->abbreviation .'" value="'. $province->id .'">'. $province->abbreviation . ' - ' . $province->name .'</option>';
											  			}
											  		}
											  		?>
										  		</select>
										  	</div>
										  	<div class="col-sm-6">
										  		<label for="">City</label>
										  		<select class="form-control" name="client_new_city" id="client_new_city">
										  			<option value="">Select</option>
											  		<?php
											  		if( isset( $cities ) && count( $cities ) > 0 )
											  		{
											  			foreach ($cities as $city)
											  			{
											  				echo '<option value="'. $city->id .'">'. $city->name .'</option>';
											  			}
											  		}
											  		?>
										  		</select>
										  	</div>
										</div>
										<div class="row">
											<div class="col-sm-6">
										  		<label for="">Country</label>
										  		<select class="form-control" name="client_new_country" id="client_new_country">
										  			<option value="">Select</option>
											  		<?php
											  		if( isset( $countries ) && count( $countries ) > 0 )
											  		{
											  			foreach ($countries as $country)
											  			{
											  				echo '<option value="'. $country->id .'">'. $country->name .'</option>';
											  			}
											  		}
											  		?>
										  		</select>
										  	</div>
										  	<div class="col-sm-6">
										  		<label for="">Moving Date</label>
										  		<input type="text" class="form-control" name="client_moving_date" id="client_moving_date">
										  	</div>
										</div>
									</fieldset>
								</div>
							</div>
							<hr>
							<div class="form-group">
								<label for="client_fname">Client Message</label>
								<textarea class="form-control" name="client_message" id="client_message" rows="10"></textarea>
							</div>
							<button type="submit" id="btn_invite_client" name="btn_invite_client" class="btn btn-primary">Send</button>
							<button type="submit" id="btn_invite_client" name="btn_invite_client" class="btn btn-primary">Schedule</button>
						</form>
					</div>
			    </div>
		  	</div>
		</div>

    </div>

    <!-- Google map address auto-complete -->
    <!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCSaTspumQXz5ow3MBIbwq0e3qsCoT2LDE&libraries=places&callback=initMap" async defer></script>
    <script type="text/javascript">
    // For agent address
    function initMap() {
      	new google.maps.places.Autocomplete(
        (document.getElementById('client_old_address')), {
          	types: ['geocode'],
          	componentRestrictions: {country: "ca"}
        });

        new google.maps.places.Autocomplete(
        (document.getElementById('client_new_address')), {
          	types: ['geocode'],
          	componentRestrictions: {country: "ca"}
        });
    }
    </script>
	-->

	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCSaTspumQXz5ow3MBIbwq0e3qsCoT2LDE&libraries=places&callback=initMap" async defer></script>
	<script type="text/javascript">
	function initMap() {
		// To manage the client old address
		$clientOldAddress = $("#client_old_address");
	    var options = {
	        types: ['geocode'],
	        componentRestrictions: {
	            country: 'ca'
	        }
	    };
	    autocomplete = new google.maps.places.Autocomplete($clientOldAddress.get(0), options);    
	    google.maps.event.addListener(autocomplete, 'place_changed', function() {
	        var address = $clientOldAddress.val();
            addressComponent = address.split(",");
            
            // Replace the complete address with the address part only
            $clientOldAddress.val(addressComponent[0]);

            // (4) ["104 Nelson Street West", " Brampton", " ON", " Canada"]
            // [0]: Address, [1]: City, [2]: Province, [3]: Country

            // Set the province
            var province = addressComponent[2].trim();
            $("#client_old_province option").each(function() {
				if($(this).data('abbreviation') == province)
				{
					$(this).attr('selected', 'selected').change();
				}
			});

            // Set the city
            let city = addressComponent[1].trim();
            $("#client_old_city option:contains(" + city + ")").attr('selected', 'selected').change();

            // Set the country
            let country = addressComponent[3].trim();
            $("#client_old_country option:contains(" + country + ")").attr('selected', 'selected').change();
	    });

	    // To manage the client new address
	    $clientNewAddress = $("#client_new_address");
	    var options = {
	        types: ['geocode'],
	        componentRestrictions: {
	            country: 'ca'
	        }
	    };
	    autocomplete = new google.maps.places.Autocomplete($clientNewAddress.get(0), options);    
	    google.maps.event.addListener(autocomplete, 'place_changed', function() {
	        var address = $clientNewAddress.val();
            addressComponent = address.split(",");
            
            // Replace the complete address with the address part only
            $clientOldAddress.val(addressComponent[0]);

            // (4) ["104 Nelson Street West", " Brampton", " ON", " Canada"]
            // [0]: Address, [1]: City, [2]: Province, [3]: Country

            // Set the province
            var province = addressComponent[2].trim();
            $("#client_new_province option").each(function() {
				if($(this).data('abbreviation') == province)
				{
					$(this).attr('selected', 'selected').change();
				}
			});

            // Set the city
            let city = addressComponent[1].trim();
            $("#client_new_city option:contains(" + city + ")").attr('selected', 'selected').change();

            // Set the country
            let country = addressComponent[3].trim();
            $("#client_new_country option:contains(" + country + ")").attr('selected', 'selected').change();
	    });
	}
	</script>
@endsection