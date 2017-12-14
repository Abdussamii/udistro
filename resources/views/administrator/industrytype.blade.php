@extends('administrator.layouts.app')
@section('title', 'Udistro | Industry Type')

@section('content')
	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Industry Type</h1>
        </div>
    </div>
    <div class="row">
      	<div class="col-lg-12 top-buffer">
	      	<!-- Table to show all the industry -->
			<table id="datatable_industry" class="table table-striped">
				<thead>
					<tr>
						<td>#</td>
						<td>Industry Name</td>
						<td>Status</td>
						<td>Action</td>
					</tr>
				</thead>
			</table>
		</div>

		<!-- Modal to edit Industry -->
		<div id="modal_edit_industry" class="modal fade" role="dialog">
		  	<div class="modal-dialog">
			    <!-- Modal content-->
			    <div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Edit Industry</h4>
					</div>

					<div class="modal-body">
						<div class="row">
							<div class="col-sm-9">
								<form name="frm_edit_industry" id="frm_edit_industry" autocomplete="off">
									<div class="form-group">
										<label for="industry_name">Industry Name</label>
										<input type="text" name="industry_name" id="industry_name" class="form-control" placeholder="Enter Industry Name">
										<input type="hidden" name="industry_id" id="industry_id">
									</div>
									<div class="form-group">
										<label for="industry_status">Status</label>
										<div class="radio">
										 	<label><input type="radio" name="industry_status" value="1" checked="true">Active</label>
										</div>
										<div class="radio">
										 	<label><input type="radio" name="industry_status" value="0">Inactive</label>
										</div>
										<label id="industry_status-error" class="error" for="industry_status"></label>
									</div>
									<button type="submit" id="btn_edit_industry" name="btn_edit_industry" class="btn btn-primary">Submit</button>
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