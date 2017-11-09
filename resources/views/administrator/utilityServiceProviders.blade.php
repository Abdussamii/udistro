@extends('administrator.layouts.app')
@section('title', 'Udistro | Utility Service Providers')

@section('content')
	<!-- Multiple Select Dropdown -->
	<script type="text/javascript" src="{{ URL::asset('js/multiple-select.js') }}"></script>
	<link rel="stylesheet" href="{{ URL::asset('css/multiple-select.css') }}" />

	<!-- Jquery UI -->
	<script type="text/javascript" src="{{ URL::asset('js/jquery-ui.min.js') }}"></script>
	<link rel="stylesheet" href="{{ URL::asset('css/jquery-ui.min.css') }}" />

	<script type="text/javascript">
	$(document).ready(function(){
		// Multi-select initialization for service types
		$('#service_types').multipleSelect({
	        width: '100%',
	        selectAll: false
	    });
	});
	</script>

	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Utility Service Providers</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
      		<button type="button" class="btn btn-primary" data-toggle="modal" id="btn_modal_service_provider">Add Service Provider</button>
      	</div>

      	<div class="col-lg-12 top-buffer">
	      	<!-- Table to show all the province -->
			<table id="datatable_service_providers" class="table table-striped">
				<thead>
					<tr>
						<td>#</td>
						<td>Provider Name</td>
						<td>Service Category</td>
						<td>Service Types</td>
						<td>Province</td>
						<td>City</td>
						<td>Address</td>
						<td>Status</td>
						<td>Action</td>
					</tr>
				</thead>
			</table>
		</div>

		<!-- Modal to add / edit service provider -->
		<div id="modal_add_service_provider" class="modal fade" role="dialog">
		  	<div class="modal-dialog">
			    <!-- Modal content-->
			    <div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Add Service Provider</h4>
					</div>

					<div class="modal-body">
						<form name="frm_add_service_provider" id="frm_add_service_provider" autocomplete="off">
							<div class="form-group">
								<label for="service_provider_name">Service Provider Name</label>
								<input type="text" name="service_provider_name" id="service_provider_name" class="form-control" placeholder="">
								<input type="hidden" name="service_provider_id" id="service_provider_id">
							</div>
							<div class="form-group">
								<label for="service_provider_category">Service Category</label>
								<select class="form-control" name="service_provider_category" id="service_provider_category">
									<option value="">Select</option>
									<?php
									if( isset( $serviceCategories ) &&  count( $serviceCategories ) > 0 )
									{
										foreach ($serviceCategories as $serviceCategory)
										{
											echo '<option value="'. $serviceCategory->id .'">'. ucwords( strtolower( $serviceCategory->category_type ) ) .'</option>';
										}
									}
									?>
								</select>
							</div>
							<div class="form-group">
								<label for="service_types">Service Type</label>
								<select name="service_types[]" id="service_types" multiple="true">
									<!-- Multiple select, its content are based on service category -->
								</select>

								<label id="service_types-error" class="error" for="service_types"></label>
							</div>
							<div class="form-group">
								<label for="service_provider_country">Country</label>
								<select class="form-control" name="service_provider_country" id="service_provider_country">
									<?php
									if( isset( $countries ) &&  count( $countries ) > 0 )
									{
										foreach ($countries as $country)
										{
											echo '<option value="'. $country->id .'">'. ucwords( strtolower( $country->name ) ) .'</option>';
										}
									}
									?>
								</select>
							</div>
							<div class="form-group">
								<label for="service_provider_province">Province</label>
								<select class="form-control" name="service_provider_province" id="service_provider_province">
									<option value="">Select</option>
									<?php
									if( isset( $provinces ) &&  count( $provinces ) > 0 )
									{
										foreach ($provinces as $province)
										{
											echo '<option value="'. $province->id .'">'. ucwords( strtolower( $province->name ) ) .'</option>';
										}
									}
									?>
								</select>
							</div>
							<div class="form-group">
								<label for="service_provider_city">City</label>
								<select class="form-control" name="service_provider_city" id="service_provider_city">
									<option value="">Select</option>
									<!-- Its content are based on province selection -->
								</select>
							</div>
							<div class="form-group">
								<label for="service_provider_address">Address</label>
								<textarea type="text" name="service_provider_address" id="service_provider_address" class="form-control" placeholder=""></textarea>
							</div>
							<div class="form-group">
								<label for="service_provider_status">Status</label>
								<div class="radio">
								 	<label><input type="radio" name="service_provider_status" value="1" checked="true">Active</label>
								</div>
								<div class="radio">
								 	<label><input type="radio" name="service_provider_status" value="0">Inactive</label>
								</div>
								<label id="service_provider_status-error" class="error" for="service_provider_status"></label>
							</div>
							<button type="submit" id="btn_add_service_provider" name="btn_add_service_provider" class="btn btn-primary">Submit</button>
						</form>
					</div>
			    </div>
		  	</div>
		</div>

    </div>
@endsection