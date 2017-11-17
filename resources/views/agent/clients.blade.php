@extends('agent.layouts.app')
@section('title', 'Udistro | Clients')

@section('content')
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

		<!-- Modal to add / edit cities -->
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
    </div>
@endsection