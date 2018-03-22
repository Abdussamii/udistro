@extends('administrator.layouts.app')
@section('title', 'Udistro | Provinces')

@section('content')
	
	<style type="text/css">
	.loader-wrapper {
		position: fixed;
		width: 100%;
		height: 100%;
		background: #fff;
		z-index: 999;
		left:0;
		top:0;
	}
	.preload {
	    position: absolute;
	    top: 50%;
	    left: 55%;
	    transform: translate(-50%, -55%);
	    -webkit-transform: translate(-50%, -55%);
	}
	</style>

	<!-- Loader -->
	<div class="loader-wrapper">
		<div class="preload">Loading...</div>
	</div>

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
						<td>PST</td>
						<td>GST</td>
						<td>HST</td>
						<td>Service Charge</td>
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
										<label for="province">Province <span class="error">*</span></label>
										<input type="text" name="province_name" id="province_name" class="form-control" placeholder="Enter province name">
										<input type="hidden" name="province_id" id="province_id">
										<input type="hidden" name="country_id" id="country_id" value="1">
									</div>
									<div class="form-group">
										<label for="province">Province Abbreviation <span class="error">*</span></label>
										<input type="text" name="abbreviation" id="abbreviation" class="form-control" placeholder="Enter Abbreviation">
									</div>
									<div class="form-group">
										<label for="province">PST <span class="error">*</span></label>
										<input type="number" name="pst" id="pst" class="form-control" placeholder="Enter PST">
									</div>
									<div class="form-group">
										<label for="province">GST <span class="error">*</span></label>
										<input type="number" name="gst" id="gst" class="form-control" placeholder="Enter GST">
									</div>
									<div class="form-group">
										<label for="province">HST <span class="error">*</span></label>
										<input type="number" name="hst" id="hst" class="form-control" placeholder="Enter HST">
									</div>
									<div class="form-group">
										<label for="province">Service Charge <span class="error">*</span></label>
										<input type="number" name="service_charge" id="service_charge" class="form-control" placeholder="Enter Service Charge">
									</div>
									<div class="form-group">
										<label for="province_status">Status <span class="error">*</span></label>
										<div class="radio">
										 	<label><input type="radio" name="province_status" value="1" checked="true">Active</label>
										</div>
										<div class="radio">
										 	<label><input type="radio" name="province_status" value="0">Inactive</label>
										</div>
										<label id="province_status-error" class="error" for="province_status"></label>
									</div>
									<div class="form-group">
										<img src="" id="province_profile_image" height="150px" width="150px" class="avatar img-square" alt="avatar">
										<div class="top-buffer">
											<!-- To upload image -->
											<label for="province_upload_image" class="">Select File <i class="fa fa-file-image-o" aria-hidden="true"></i></label>
											<input type="file" id="province_upload_image" name="province_upload_image" accept="image/*" style="display: none">
											<div><label id="province_upload_image-error" class="error" for="province_upload_image"></label></div>
										</div>
									</div>
									<button type="submit" id="btn_add_province" name="btn_add_province" class="btn btn-primary">Submit</button>
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