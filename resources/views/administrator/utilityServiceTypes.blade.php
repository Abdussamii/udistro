@extends('administrator.layouts.app')
@section('title', 'Udistro | Utility Service Types')

@section('content')
	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Utility Service Types</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
      		<button type="button" class="btn btn-primary" data-toggle="modal" id="btn_modal_service_type">Add Service Type</button>
      	</div>

      	<div class="col-lg-12 top-buffer">
	      	<!-- Table to show all the province -->
			<table id="datatable_utility_service_types" class="table table-striped">
				<thead>
					<tr>
						<td>#</td>
						<td>Service Category</td>
						<td>Service Type</td>
						<td>Status</td>
						<td>Action</td>
					</tr>
				</thead>
			</table>
		</div>

		<!-- Modal to add / edit service type -->
		<div id="modal_add_service_type" class="modal fade" role="dialog">
		  	<div class="modal-dialog">
			    <!-- Modal content-->
			    <div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Add Service Provider</h4>
					</div>

					<div class="modal-body">
						<form name="frm_add_service_type" id="frm_add_service_type" autocomplete="off">
							<div class="form-group">
								<label for="service_type_category">Category</label>
								<select class="form-control" name="service_type_category" id="service_type_category">
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
								<label for="service_type">Service Type</label>
								<input type="text" name="service_type" id="service_type" class="form-control" placeholder="Enter the service type">
								<input type="hidden" name="service_type_id" id="service_type_id">
							</div>
							<div class="form-group">
								<label for="service_type_status">Status</label>
								<div class="radio">
								 	<label><input type="radio" name="service_type_status" value="1" checked="true">Active</label>
								</div>
								<div class="radio">
								 	<label><input type="radio" name="service_type_status" value="0">Inactive</label>
								</div>
								<label id="service_type_status-error" class="error" for="service_type_status"></label>
							</div>
							<button type="submit" id="btn_add_service_type" name="btn_add_service_type" class="btn btn-primary">Submit</button>
						</form>
					</div>
			    </div>
		  	</div>
		</div>

    </div>
@endsection