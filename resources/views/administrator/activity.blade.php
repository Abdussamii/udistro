@extends('administrator.layouts.app')
@section('title', 'Udistro | Activity')

@section('content')
	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Activity</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
      		<button type="button" class="btn btn-primary" data-toggle="modal" id="btn_modal_activity">Add Activity</button>
      	</div>

      	<div class="col-lg-12 top-buffer">
	      	<!-- Table to show all the activity -->
			<table id="datatable_activity" class="table table-striped">
				<thead>
					<tr>
						<td>#</td>
						<td>Activity Name</td>
						<td>Activity Desc</td>
						<td>Status</td>
						<td>Action</td>
					</tr>
				</thead>
			</table>
		</div>

		<!-- Modal to add / edit activity -->
		<div id="modal_add_activity" class="modal fade" role="dialog">
		  	<div class="modal-dialog">
			    <!-- Modal content-->
			    <div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Add Activity</h4>
					</div>

					<div class="modal-body">
						<div class="row">
							<div class="col-sm-9">
								<form name="frm_add_activity" id="frm_add_activity" autocomplete="off">
									<div class="form-group">
										<label for="activity_name">Activity Name</label>
										<input type="text" name="activity_name" id="activity_name" class="form-control" placeholder="Enter Activity Name">
										<input type="hidden" name="activity_id" id="activity_id">
									</div>
									<div class="form-group">
										<label for="description">Description</label>
										<input type="text" name="description" id="description" class="form-control" placeholder="Enter Description">
									</div>
									<div class="form-group">
										<label for="activity_status">Status</label>
										<div class="radio">
										 	<label><input type="radio" name="activity_status" value="1" checked="true">Active</label>
										</div>
										<div class="radio">
										 	<label><input type="radio" name="activity_status" value="0">Inactive</label>
										</div>
										<label id="activity_status-error" class="error" for="activity_status"></label>
									</div>
									<div class="form-group">
										<label for="activity_status">Image</label>
										<img src="" id="activity_profile_image" height="150px" width="150px" class="avatar img-square" alt="avatar">
										<div class="top-buffer">
											<!-- To upload image -->
											<label for="activity_upload_image" class="">Select File <i class="fa fa-file-image-o" aria-hidden="true"></i></label>
											<input type="file" id="activity_upload_image" name="activity_upload_image" accept="image/*" style="display: none">
											<div><label id="activity_upload_image-error" class="error" for="activity_upload_image"></label></div>
										</div>
									</div>
									<button type="submit" id="btn_add_activity" name="btn_add_activity" class="btn btn-primary">Submit</button>
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