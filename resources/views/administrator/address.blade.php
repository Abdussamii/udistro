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
						<td>Status</td>
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
							<form name="frm_add_address" id="frm_add_address" autocomplete="off">
								<!-- Headings -->
								<div class="text-center"><h4>Labels</h4></div>
								<div>
									<div class="col-lg-6">
										<div class="form-group">
											<label for="label1">Label 1</label>
											<input type="text" name="label1" id="label1" class="form-control" placeholder="Enter Label 1">
											<input type="hidden" name="province_id" id="province_id">
											<input type="hidden" name="address_id" id="address_id">
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label for="label2">Label 2</label>
											<input type="text" name="label2" id="label2" class="form-control" placeholder="Enter Label 2">
										</div>
									</div>
								</div>
								<div>
									<div class="col-lg-6">
										<div class="form-group">
											<label for="label3">Label 3</label>
											<input type="text" name="label3" id="label3" class="form-control" placeholder="Enter Label 3">
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label for="label4">Label 4</label>
											<input type="text" name="label4" id="label4" class="form-control" placeholder="Enter Label 4">
										</div>
									</div>
								</div>
								<div>
									<div class="col-lg-6">
										<div class="form-group">
											<label for="label5">Label 5</label>
											<input type="text" name="label5" id="label5" class="form-control" placeholder="Enter Label 5">
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label for="label6">Label 6</label>
											<input type="text" name="label6" id="label6" class="form-control" placeholder="Enter Label 6">
										</div>
									</div>
								</div>
								<div>
									<div class="col-lg-6">
										<div class="form-group">
											<label for="label7">Label 7</label>
											<input type="text" name="label7" id="label7" class="form-control" placeholder="Enter Label 7">
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label for="label8">Label 8</label>
											<input type="text" name="label8" id="label8" class="form-control" placeholder="Enter Label 8">
										</div>
									</div>
								</div>
								<div>
									<div class="col-lg-6">
										<div class="form-group">
											<label for="label9">Label 9</label>
											<input type="text" name="label9" id="label9" class="form-control" placeholder="Enter Label 9">
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label for="label10">Label 10</label>
											<input type="text" name="label10" id="label10" class="form-control" placeholder="Enter Label 10">
										</div>
									</div>
								</div>

								<!-- Headings -->
								<div class="text-center"><h4>Headings</h4></div>
								<div>
									<div class="col-lg-6">
										<div class="form-group">
											<label for="heading1">Heading 1</label>
											<input type="text" name="heading1" id="heading1" class="form-control" placeholder="Heading 1">
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label for="detail1">Detail 1</label>
											<input type="text" name="detail1" id="detail1" class="form-control" placeholder="Detail 1">
										</div>
									</div>
								</div>
								<div>
									<div class="col-lg-6">
										<div class="form-group">
											<label for="heading2">Heading 2</label>
											<input type="text" name="heading2" id="heading2" class="form-control" placeholder="Heading 2">
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label for="detail2">Detail 2</label>
											<input type="text" name="detail2" id="detail2" class="form-control" placeholder="Detail 2">
										</div>
									</div>
								</div>
								<div>
									<div class="col-lg-6">
										<div class="form-group">
											<label for="heading3">Heading 3</label>
											<input type="text" name="heading3" id="heading3" class="form-control" placeholder="Heading 3">
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label for="detail3">Detail 3</label>
											<input type="text" name="detail3" id="detail3" class="form-control" placeholder="Detail 3">
										</div>
									</div>
								</div>
								<div>
									<div class="col-lg-6">
										<div class="form-group">
											<label for="heading4">Heading 4</label>
											<input type="text" name="heading4" id="heading4" class="form-control" placeholder="Heading 4">
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label for="detail4">Detail 4</label>
											<input type="text" name="detail4" id="detail4" class="form-control" placeholder="Detail 4">
										</div>
									</div>
								</div>
								<div>
									<div class="col-lg-6">
										<div class="form-group">
											<label for="link">Link</label>
											<input type="text" name="link" id="link" class="form-control" placeholder="Map URL" value="">
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label for="logo">Logo</label>
											<input type="file" name="logo" id="logo" class="form-control">
										</div>
									</div>
								</div>
								<div>
									<div class="col-lg-12">
										<div class="form-group">
											<label for="company_status">Status</label>
											<div class="radio">
											 	<label><input type="radio" name="province_address_status" value="1" checked="true">Active</label>
											</div>
											<div class="radio">
											 	<label><input type="radio" name="province_address_status" value="0">Inactive</label>
											</div>
											<label id="province_address_status-error" class="error" for="province_address_status"></label>
										</div>
									</div>
									<div class="col-lg-12">
										<div><label id="label1-error" class="error" for="label1"></label></div>
										<button type="submit" id="btn_add_address" name="btn_add_address" class="btn btn-primary">Submit</button>
									</div>
								</div>
							</form>
						</div>
					</div>
			    </div>
		  	</div>
		</div>
    </div>
@endsection