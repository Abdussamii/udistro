@extends('administrator.layouts.app')
@section('title', 'Udistro | Navigation')

@section('content')
	<!-- Multiple Select Dropdown -->
	<script type="text/javascript" src="{{ URL::asset('js/multiple-select.js') }}"></script>
	<link rel="stylesheet" href="{{ URL::asset('css/multiple-select.css') }}" />

	<!-- Jquery UI -->
	<script type="text/javascript" src="{{ URL::asset('js/jquery-ui.min.js') }}"></script>
	<link rel="stylesheet" href="{{ URL::asset('css/jquery-ui.min.css') }}" />

	<script type="text/javascript">
	$(document).ready(function(){
		// Multi-select initialization for add navigation
		$('#navigation_categories').multipleSelect({
	        width: '100%',
	        selectAll: false
	    });

	    // Multi-select initialization for add navigation
		$('#navigation_edit_categories').multipleSelect({
	        width: '100%',
	        selectAll: false
	    });
	});
	</script>

	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Navigation</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
      		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_add_navigation">Add Navigation</button>
      	</div>

      	<div class="col-lg-12 top-buffer">
	      	<!-- Table to show all the navigation menus -->
			<table id="datatable_navigation" class="table table-striped">
				<thead>
					<tr>
						<td>#</td>
						<td>Navigation Text</td>
						<td>Navigation URL</td>
						<td>Categories</td>
						<td>Status</td>
						<td>Action</td>
					</tr>
				</thead>
			</table>
		</div>

		<!-- Modal to add navigation category menu -->
		<div id="modal_add_navigation" class="modal fade" role="dialog">
		  	<div class="modal-dialog">
			    <!-- Modal content-->
			    <div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Add Navigation Category</h4>
					</div>

					<div class="modal-body">
						<form name="frm_navigation" id="frm_navigation" autocomplete="off">
							<div class="form-group">
								<label for="navigation_categories">Category</label>
								<select name="navigation_categories[]" id="navigation_categories" multiple="true">
									<?php
									if( count( $categories ) > 0 )
									{
										foreach ($categories as $category)
										{
											echo '<option value="'. $category->id .'"> '. ucwords( strtolower( $category->category ) ) .'</option>';
										}
									}
									?>
								</select>
								<label id="navigation_categories-error" class="error" for="navigation_categories"></label>
							</div>
							<div class="form-group">
								<label for="navigation_text">Navigation Text</label>
								<input type="text" class="form-control" id="navigation_text" name="navigation_text" placeholder="Enter Navigation Text">
							</div>
							<div class="form-group">
								<label for="navigation_url">Navigation URL</label>
								<input type="text" class="form-control" id="navigation_url" name="navigation_url">
							</div>
							<div class="form-group">
								<label for="navigation_status">Status</label>
								<div class="radio">
								 	<label><input type="radio" name="navigation_status" value="1" checked="true">Active</label>
								</div>
								<div class="radio">
								 	<label><input type="radio" name="navigation_status" value="0">Inactive</label>
								</div>
								<label id="navigation_status-error" class="error" for="navigation_status"></label>
							</div>
							<button type="submit" id="btn_add_navigation" name="btn_add_navigation" class="btn btn-primary">Submit</button>
						</form>
					</div>
			    </div>
		  	</div>
		</div>

		<!-- Modal to edit navigation category menu -->
		<div id="modal_edit_navigation" class="modal fade" role="dialog">
		  	<div class="modal-dialog">
			    <!-- Modal content-->
			    <div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Add Navigation Category</h4>
					</div>

					<div class="modal-body">
						<form name="frm_edit_navigation" id="frm_edit_navigation" autocomplete="off">
							<div class="form-group">
								<label for="navigation_edit_categories">Category</label>
								<select name="navigation_edit_categories[]" id="navigation_edit_categories" multiple="true">
									<?php
									if( count( $categories ) > 0 )
									{
										foreach ($categories as $category)
										{
											echo '<option value="'. $category->id .'"> '. ucwords( strtolower( $category->category ) ) .'</option>';
										}
									}
									?>
								</select>
								<label id="navigation_edit_categories-error" class="error" for="navigation_edit_categories"></label>
							</div>
							<div class="form-group">
								<label for="navigation_edit_text">Navigation Text</label>
								<input type="text" class="form-control" id="navigation_edit_text" name="navigation_edit_text" placeholder="Enter Navigation Text">
								<input type="hidden" class="form-control" id="navigation_id" name="navigation_id">
							</div>
							<div class="form-group">
								<label for="navigation_edit_url">Navigation URL</label>
								<input type="text" class="form-control" id="navigation_edit_url" name="navigation_edit_url">
							</div>
							<div class="form-group">
								<label for="navigation_edit_status">Status</label>
								<div class="radio">
								 	<label><input type="radio" name="navigation_edit_status" value="1">Active</label>
								</div>
								<div class="radio">
								 	<label><input type="radio" name="navigation_edit_status" value="0">Inactive</label>
								</div>
								<label id="navigation_edit_status-error" class="error" for="navigation_edit_status"></label>
							</div>
							<button type="submit" id="btn_update_navigation" name="btn_update_navigation" class="btn btn-primary">Submit</button>
						</form>
					</div>
			    </div>
		  	</div>
		</div>

    </div>
@endsection