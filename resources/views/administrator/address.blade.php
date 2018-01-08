@extends('administrator.layouts.app')
@section('title', 'Udistro | Address Details')

@section('content')
	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Address Details</h1>
        </div>
    </div>
    <div class="row">

      	<div class="col-lg-12 top-buffer">
	      	<!-- Table to show all the activity -->
			<table id="datatable_address" class="table table-striped">
				<thead>
					<tr>
						<td>#</td>
						<td>Province Name</td>
						<td>Action</td>
					</tr>
				</thead>
			</table>
		</div>

		<!-- Modal to add / edit activity -->
		<div id="modal_add_address" class="modal fade" role="dialog">
		  	<div class="modal-dialog">
			    <!-- Modal content-->
			    <div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Edit Address Details</h4>
					</div>

					<div class="modal-body">
						<div class="row">
							<div class="col-sm-9">
								<form name="frm_add_address" id="frm_add_address" autocomplete="off">
									<div class="form-group">
										<label for="label1">Title 1</label>
										<input type="text" name="title1" id="title1" class="form-control" placeholder="Enter Title 1" value="">
										<input type="hidden" name="province_id" id="province_id">
										<input type="hidden" name="id" id="id">
									</div>
									<div class="form-group">
										<label for="timing1">Timing 1</label>
										<input type="text" name="timing1" id="timing1" class="form-control" placeholder="Enter Timing 1" value="">
									</div>
									<div class="form-group">
										<label for="label2">Title 2</label>
										<input type="text" name="title2" id="title2" class="form-control" placeholder="Enter Title 2" value="">
									</div>
									<div class="form-group">
										<label for="timing2">Timing 2</label>
										<input type="text" name="timing2" id="timing2" class="form-control" placeholder="Enter Timing 2" value="">
									</div>
									<div class="form-group">
										<label for="timing2">Title 3</label>
										<input type="text" name="title3" id="title3" class="form-control" placeholder="Enter Title 3" value="">
									</div>
									<div class="form-group">
										<label for="timing2">Text 1</label>
										<input type="text" name="text1" id="text1" class="form-control" placeholder="Enter Timing 2" value="">
									</div>
									<div class="form-group">
										<label for="timing2">Title 4</label>
										<input type="text" name="title4" id="title4" class="form-control" placeholder="Enter Title 4" value="">
									</div>
									<div class="form-group">
										<label for="timing2">Text 2</label>
										<input type="text" name="text2" id="text2" class="form-control" placeholder="Enter Timing 2" value="">
									</div>
									<div class="form-group">
										<label for="timing2">Label 1</label>
										<input type="text" name="label1" id="label1" class="form-control" placeholder="Enter Label 1" value="">
									</div>
									<div class="form-group">
										<label for="timing2">Label 2</label>
										<input type="text" name="label2" id="label2" class="form-control" placeholder="Enter Label 2" value="">
									</div>
									<div class="form-group">
										<label for="timing2">Label 3</label>
										<input type="text" name="label3" id="label3" class="form-control" placeholder="Enter Label 3" value="">
									</div>
									<div class="form-group">
										<label for="timing2">Label 4</label>
										<input type="text" name="label4" id="label4" class="form-control" placeholder="Enter Label 4" value="">
									</div>
									<div class="form-group">
										<label for="timing2">Label 5</label>
										<input type="text" name="label5" id="label5" class="form-control" placeholder="Enter Label 5" value="">
									</div>
									<div class="form-group">
										<label for="timing2">Label 6</label>
										<input type="text" name="label6" id="label6" class="form-control" placeholder="Enter Label 6" value="">
									</div>
									<div class="form-group">
										<label for="timing2">Label 7</label>
										<input type="text" name="label7" id="label7" class="form-control" placeholder="Enter Label 7" value="">
									</div>
									<div class="form-group">
										<label for="timing2">Label 8</label>
										<input type="text" name="label8" id="label8" class="form-control" placeholder="Enter Label 8" value="">
									</div>
									<div class="form-group">
										<label for="timing2">Label 9</label>
										<input type="text" name="label9" id="label9" class="form-control" placeholder="Enter Label 9" value="">
									</div>
									<div class="form-group">
										<label for="timing2">Label 10</label>
										<input type="text" name="label10" id="label10" class="form-control" placeholder="Enter Label 10" value="">
									</div>
									<div class="form-group">
										<label for="company_status">Status</label>
										<div class="radio">
										 	<label><input type="radio" name="status" value="1" checked="true">Active</label>
										</div>
										<div class="radio">
										 	<label><input type="radio" name="status" value="0">Inactive</label>
										</div>
										<label id="status-error" class="error" for="status"></label>
									</div>
									<button type="submit" id="btn_add_address" name="btn_add_address" class="btn btn-primary">Submit</button>
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