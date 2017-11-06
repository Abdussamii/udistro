@extends('administrator.layouts.app')
@section('title', 'Udistro | Navigation Category')

@section('content')
	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Navigation Category</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
        	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_add_navigation_category">Add Category</button>
      	</div>

      	<div class="col-lg-12 top-buffer">
	      	<!-- Table to show all the navigation menus -->
			<table id="datatable_navigation_category" class="table table-striped">
				<thead>
					<tr>
						<td>#</td>
						<td>Navigation Type</td>
						<td>Navigation Category</td>
						<td>Status</td>
						<td>Action</td>
					</tr>
				</thead>
			</table>
		</div>

		<!-- Modal to add/edit navigation category menu -->
		<div id="modal_add_navigation_category" class="modal fade" role="dialog">
		  	<div class="modal-dialog">
			    <!-- Modal content-->
			    <div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Add Navigation Category</h4>
					</div>

					<div class="modal-body">
						<form name="frm_navigation_category" id="frm_navigation_category" autocomplete="off">
							<div class="form-group">
								<label for="navigation_category_type">Navigation Type</label>
								<select name="navigation_category_type" id="navigation_category_type" class="form-control">
									<option value="">Select Type</option>
									<?php
										// Iterate the navigation type
										if( count( $navigationTypes ) > 0 )
										{
											foreach ($navigationTypes as $navigation)
											{
												echo '<option value="'. $navigation->id .'">'. ucwords(strtolower($navigation->type)) .'</option>';
											}
										}
									?>
								</select>
							</div>
							<div class="form-group">
								<label for="navigation_category_name">Category Name</label>
								<input type="text" class="form-control" id="navigation_category_name" name="navigation_category_name" placeholder="Enter Category">
								<!-- For navigation category edit purpose -->
								<input type="hidden" class="form-control" id="navigation_category_id" name="navigation_category_id">
							</div>
							<div class="form-group">
								<label for="navigation_category_status">Status</label>
								<div class="radio">
								 	<label><input type="radio" name="navigation_category_status" value="1" checked="true">Active</label>
								</div>
								<div class="radio">
								 	<label><input type="radio" name="navigation_category_status" value="0">Inactive</label>
								</div>
								<label id="navigation_category_status-error" class="error" for="navigation_category_status"></label>
							</div>
							<button type="submit" id="btn_add_navigation_category" name="btn_add_navigation_category" class="btn btn-primary">Submit</button>
						</form>
					</div>
			    </div>
		  	</div>
		</div>
    </div>
@endsection