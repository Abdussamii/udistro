@extends('administrator.layouts.app')
@section('title', 'Udistro | Response Time')

@section('content')
	
	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Response Time</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
      		<button type="button" class="btn btn-primary" data-toggle="modal" id="btn_modal_response_time">Add Response Time</button>
      	</div>

      	<div class="col-lg-12 top-buffer">
	      	<!-- Table to show all the services -->
			<table id="datatable_time_response" class="table table-striped">
				<thead>
					<tr>
						<td>#</td>
						<td>Slot Title</td>
						<td>Slot Time (In Minutes)</td>
						<td>Status</td>
						<td>Action</td>
					</tr>
				</thead>
			</table>
		</div>

		<!-- Modal to add / edit services -->
		<div id="modal_response_time" class="modal fade" role="dialog">
		  	<div class="modal-dialog">
			    <!-- Modal content-->
			    <div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Add Response Time</h4>
					</div>

					<div class="modal-body">
						<div class="row">
							<div class="col-sm-12">
								<form name="frm_response_time" id="frm_response_time" autocomplete="off">
									<div class="form-group">
										<label for="slot_title">Response Time Slot Title</label>
										<input type="text" name="slot_title" id="slot_title" class="form-control" placeholder="Enter services Name">
										<input type="hidden" name="slot_id" id="slot_id">
									</div>
									<div class="form-group">
										<label for="slot_time">Response Time Slot Time (In Minutes)</label>
										<input type="number" name="slot_time" id="slot_time" class="form-control" placeholder="Enter Description">
									</div>
									<div class="form-group">
										<label for="slot_status">Status</label>
										<div class="radio">
										 	<label><input type="radio" name="slot_status" value="1" checked="true">Active</label>
										</div>
										<div class="radio">
										 	<label><input type="radio" name="slot_status" value="0">Inactive</label>
										</div>
										<label id="slot_status-error" class="error" for="slot_status"></label>
									</div>
									<button type="submit" id="btn_add_response_time" name="btn_add_response_time" class="btn btn-primary">Submit</button>
								</form>
							</div>
						</div>
					</div>
			    </div>
		  	</div>
		</div>
    </div>

@endsection