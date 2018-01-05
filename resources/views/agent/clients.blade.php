@extends('agent.layouts.app')
@section('title', 'Udistro | Clients')

@section('content')
	<!-- Jquery UI for datepicker -->
	<script type="text/javascript" src="{{ URL::asset('js/jquery-ui.min.js') }}"></script>
	<link rel="stylesheet" href="{{ URL::asset('css/jquery-ui.min.css') }}" />

	<!-- Canada Post API -->
	<script type="text/javascript" src="https://ws1.postescanada-canadapost.ca/js/addresscomplete-2.30.min.js?key=kp88-mx67-ff25-xd59"></script>
	<link rel="stylesheet" type="text/css" href="https://ws1.postescanada-canadapost.ca/css/addresscomplete-2.30.min.css?key=kp88-mx67-ff25-xd59" />

	<!-- TinyMCE -->
	<script type="text/javascript" src="https://cdn.tinymce.com/4/tinymce.min.js"></script>

	<script type="text/javascript">
	var fields = [
		{ element: "client_old_address1", field: "Line1" },
		{ element: "client_old_address2", field: "Line2", mode: pca.fieldMode.POPULATE },
		{ element: "city", field: "City", mode: pca.fieldMode.POPULATE },
		{ element: "state", field: "ProvinceName", mode: pca.fieldMode.POPULATE },
		{ element: "client_old_postalcode", field: "PostalCode" },
		{ element: "country", field: "CountryName", mode: pca.fieldMode.COUNTRY }
	],
	options = {
		key: "kp88-mx67-ff25-xd59"
	},
	control = new pca.Address(fields, options);

	// On the selesction of address get the province abbreviation, and set it on the province dropdown
	control.listen("populate", function (address) {

	    $("#client_old_province option").each(function() {
			if($(this).data('abbreviation') == address.Province)
			{
				$(this).attr('selected', 'selected').change();
			}
		});

	});

	var fields1 = [
		{ element: "client_new_address1", field: "Line1" },
		{ element: "client_new_address2", field: "Line2", mode: pca.fieldMode.POPULATE },
		{ element: "city", field: "City", mode: pca.fieldMode.POPULATE },
		{ element: "state", field: "ProvinceName", mode: pca.fieldMode.POPULATE },
		{ element: "client_new_postalcode", field: "PostalCode" },
		{ element: "country", field: "CountryName", mode: pca.fieldMode.COUNTRY }
	],
	options1 = {
		key: "kp88-mx67-ff25-xd59"
	},
	control1 = new pca.Address(fields1, options1);

	// On the selesction of address get the province abbreviation, and set it on the province dropdown
	control1.listen("populate", function (address) {

	    $("#client_new_province option").each(function() {
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

		$('#client_moving_date').datepicker({
			dateFormat: 'dd-mm-yy'
		});
		$('#client_invitation_schedule_date').datepicker({
			dateFormat: 'dd-mm-yy'
		});

		/*
		tinymce.init({
			selector: "#email_template_content",
			height: 400,
    		// width: 750,
			theme: "modern",
			paste_data_images: true,
			plugins: [
			  "advlist autolink lists link image charmap print preview hr anchor pagebreak",
			  "searchreplace wordcount visualblocks visualchars code fullscreen",
			  "insertdatetime media nonbreaking save table contextmenu directionality",
			  "emoticons template paste textcolor colorpicker textpattern"
			],
			toolbar1: "code fullpage insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
			toolbar2: "print preview media | forecolor backcolor emoticons",
			image_advtab: true,
			file_picker_callback: function(callback, value, meta) {
			  if (meta.filetype == 'image') {
			    $('#upload').trigger('click');
			    $('#upload').on('change', function() {
			      var file = this.files[0];
			      var reader = new FileReader();
			      reader.onload = function(e) {
			        callback(e.target.result, {
			          alt: ''
			        });
			      };
			      reader.readAsDataURL(file);
			    });
			  }
			}
		});
		*/

	});
	</script>

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
						<td>Invite</td>
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
		  	<div class="modal-dialog modal-lg">
			    <!-- Modal content-->
			    <div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Invite Client</h4>
					</div>

					<div class="modal-body">
						<form name="frm_invite_client" id="frm_invite_client" autocomplete="off">
							<div id="invite_client_step1">
								<div>
									<fieldset>
										<div class="form-group">
											<label for="client_fname">Old Address Line 1</label>
											<input type="text" class="form-control" name="client_old_address1" id="client_old_address1" value="">
											<input type="hidden" name="client_id" id="client_id">
										</div>
										<div class="form-group">
											<label for="client_fname">Old Address Line 2</label>
											<input type="text" class="form-control" name="client_old_address2" id="client_old_address2" value="">
										</div>

										<!-- Old address related fields -->
										<div id="container_old_address_fields">
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
											  		<label for="client_new_country">Postal Code</label>
											  		<input type="text" class="form-control" name="client_old_postalcode" id="client_old_postalcode" value="">
											  	</div>
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
										</div>

									</fieldset>
								</div>
								<br>
								<div>
									<fieldset>
										<div class="form-group">
											<label for="client_fname">New Address</label>
											<input type="text" class="form-control" name="client_new_address1" id="client_new_address1" value="">
										</div>

										<div class="form-group">
											<label for="client_fname">New Address</label>
											<input type="text" class="form-control" name="client_new_address2" id="client_new_address2" value="">
										</div>

										<!-- New address related fields -->
										<div id="container_new_address_fields">
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
											  		<label for="client_new_country">Postal Code</label>
											  		<input type="text" class="form-control" name="client_new_postalcode" id="client_new_postalcode" value="">
											  	</div>
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
											</div>
										</div>

									</fieldset>
								</div>
								<div class="">
							  		<label for="">Moving Date</label>
							  		<input type="text" class="form-control" name="client_moving_date" id="client_moving_date">
							  	</div>
								<hr />
								<button type="button" id="btn_next_invitation" class="btn btn-primary">Next</button>
							</div>

							<div class="hide" id="invite_client_step2">

								<div class="form-group">
									<label for="client_fname">Templates</label>
									<select class="form-control" name="client_email_template" id="client_email_template">
							  			<option value="">Select</option>
								  		<?php
								  		if( isset( $emailTemplates ) && count( $emailTemplates ) > 0 )
								  		{
								  			foreach ($emailTemplates as $emailTemplate)
								  			{
								  				echo '<option value="'. $emailTemplate->id .'">'. $emailTemplate->template_name .'</option>';
								  			}
								  		}
								  		?>
							  		</select>
									<div><label id="client_email_template-error" class="error" for="client_email_template"></label></div>
								</div>

								<!--<div class="form-group">
									<label for="email_template_content">Template Content <span class="alert-danger"> (Put [Content] for the content part, that is replaced with the actual content) </span></label>&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" id="email_template_previeww">Preview</a>
									<textarea class="form-control" name="email_template_content" id="email_template_content"></textarea>
									<input name="image" type="file" id="upload" class="hidden" onchange="">
								</div>-->

								<div class="form-group" id="email_previeww">
								</div>

								<div class="form-group" style="display: none;" id="client_invitation_scheduler">
									<label for="">Schedule Date</label>
							  		<input type="text" class="form-control" name="client_invitation_schedule_date" id="client_invitation_schedule_date">
							  		<div class="pull-right"><a href="javascript:void(0);" id="cancel_shedule">Cancel</a></div>
								</div>
								<hr />
								<button type="submit" id="btn_previous_invitation" class="btn btn-primary">Previous</button>
								<button type="submit" id="btn_send_invitation" class="btn btn-primary">Send</button>
								<button type="submit" id="btn_schedule_invitation" class="btn btn-primary">Schedule</button>
							</div>
							
						</form>
					</div>
			    </div>
		  	</div>
		</div>

    </div>
@endsection