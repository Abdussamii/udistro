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
			    </div>
		  	</div>
		</div>
    </div>
@endsection