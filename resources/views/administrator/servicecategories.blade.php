@extends('administrator.layouts.app')
@section('title', 'Udistro | Utility Service Categories')

@section('content')
	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Utility Service Categories</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
      		<button type="button" class="btn btn-primary" data-toggle="modal" id="btn_modal_utility_service_category">Add Service</button>
      	</div>

      	<div class="col-lg-12 top-buffer">
	      	<!-- Table to show all the pages -->
			<table id="datatable_utility_service_categories" class="table table-striped">
				<thead>
					<tr>
						<td>#</td>
						<td>Service Type</td>
						<td>Description</td>
						<td>Status</td>
						<td>Action</td>
					</tr>
				</thead>
			</table>
		</div>

		<!-- Modal to add / edit utility service category -->
		<div id="modal_add_utility_service_category" class="modal fade" role="dialog">
		  	<div class="modal-dialog">
			    <!-- Modal content-->
			    <div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Add Service</h4>
					</div>

					<div class="modal-body">
						<form name="frm_add_utility_service_category" id="frm_add_utility_service_category" autocomplete="off">
							<div class="form-group">
								<label for="service_type">Service Type</label>
								<input type="text" name="service_type" id="service_type" class="form-control" placeholder="Enter service Type">
								<input type="hidden" name="service_id" id="service_id">
							</div>
							<div class="form-group">
								<label for="service_description">Service Description</label>
								<textarea class="form-control" id="service_description" name="service_description" placeholder="Enter service description"></textarea>
							</div>
							<div class="form-group">
								<label for="service_status">Status</label>
								<div class="radio">
								 	<label><input type="radio" name="service_status" value="1" checked="true">Active</label>
								</div>
								<div class="radio">
								 	<label><input type="radio" name="service_status" value="0">Inactive</label>
								</div>
								<label id="service_status-error" class="error" for="service_status"></label>
							</div>
							<button type="submit" id="btn_add_utility_service_category" name="btn_add_utility_service_category" class="btn btn-primary">Submit</button>
						</form>
					</div>
			    </div>
		  	</div>
		</div>

    </div>
@endsection