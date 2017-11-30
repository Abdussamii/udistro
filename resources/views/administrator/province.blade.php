@extends('administrator.layouts.app')
@section('title', 'Udistro | Provinces')

@section('content')
	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Provinces</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
      		<button type="button" class="btn btn-primary" data-toggle="modal" id="btn_modal_province">Add Province</button>
      	</div>

      	<div class="col-lg-12 top-buffer">
	      	<!-- Table to show all the province -->
			<table id="datatable_provinces" class="table table-striped">
				<thead>
					<tr>
						<td>#</td>
						<td>Province</td>
						<td>Status</td>
						<td>Action</td>
					</tr>
				</thead>
			</table>
		</div>

		<!-- Modal to add / edit province -->
		<div id="modal_add_province" class="modal fade" role="dialog">
		  	<div class="modal-dialog">
			    <!-- Modal content-->
			    <div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Add Province</h4>
					</div>

					<div class="modal-body">
						<div class="row">
							<div class="col-sm-9">
								<form name="frm_add_province" id="frm_add_province" autocomplete="off">
									<div class="form-group">
										<label for="province_name">Province Name</label>
										<input type="text" name="province_name" id="province_name" class="form-control" placeholder="Enter province name">
										<input type="hidden" name="province_id" id="province_id">
									</div>
									<div class="form-group">
										<label for="province_status">Status</label>
										<div class="radio">
										 	<label><input type="radio" name="province_status" value="1" checked="true">Active</label>
										</div>
										<div class="radio">
										 	<label><input type="radio" name="province_status" value="0">Inactive</label>
										</div>
										<label id="province_status-error" class="error" for="province_status"></label>
									</div>
									<button type="submit" id="btn_add_province" name="btn_add_province" class="btn btn-primary">Submit</button>
								</form>
							</div>
							<div class="col-sm-3">
								<form class="form-horizontal hide" role="form" name="frm_province_image" id="frm_province_image">
									<div class="text-center">
										<img src="" id="province_profile_image" height="150px" width="150px" class="avatar img-square" alt="avatar">
										<div class="top-buffer">
											<!-- To upload image -->
											<label for="province_upload_image" class="">Select File <i class="fa fa-file-image-o" aria-hidden="true"></i></label>
											<input type="file" id="province_upload_image" name="province_upload_image" accept="image/*" style="display: none">
											<button type="submit" class="btn btn-primary" name="btn_update_province_image" id="btn_update_province_image">Upload</button>

											<div><label id="province_upload_image-error" class="error" for="province_upload_image"></label></div>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
			    </div>
		  	</div>
		</div>
    </div>
@endsection