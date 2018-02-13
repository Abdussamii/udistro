@extends('administrator.layouts.app')
@section('title', 'Udistro | Roles')

@section('content')
	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Roles</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
      		<button type="button" class="btn btn-primary" data-toggle="modal" id="btn_modal_role">Add Role</button>
      	</div>

      	<div class="col-lg-12 top-buffer">
	      	<!-- Table to show all the partner -->
			<table id="datatable_roles" class="table table-striped">
				<thead>
					<tr>
						<td>#</td>
						<td>Name</td>
						<td>Display Name</td>
						<td>Description</td>
						<td>Action</td>
					</tr>
				</thead>
			</table>
		</div>

		<!-- Modal to add / edit role -->
		<div id="modal_add_role" class="modal fade" role="dialog">
		  	<div class="modal-dialog">
			    <!-- Modal content-->
			    <div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Add Role</h4>
					</div>

					<div class="modal-body">
						<div class="row">
							<div class="col-sm-9">
								<form name="frm_add_role" id="frm_add_role" autocomplete="off">
									<div class="form-group">
										<input type="text" name="name" id="name" class="form-control" placeholder="Enter Role name">
										<input type="hidden" name="role_id" id="role_id">
										
									</div>
									<div class="form-group">
										<input type="text" name="display_name" id="display_name" class="form-control" placeholder="Enter Dispaly Name">
									</div>
									<div class="form-group">
										<input type="text" name="description" id="description" class="form-control" placeholder="Enter Description">
									</div>
									
									<button type="submit" id="btn_add_role" name="btn_add_role" class="btn btn-primary">Submit</button>
								</form>
							</div>
							<div class="col-sm-3">
								
							</div>
						</div>
					</div>
			    </div>
		  	</div>
		</div>
    </div>
@endsection