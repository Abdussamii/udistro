@extends('administrator.layouts.app')
@section('title', 'Udistro | Pages')

@section('content')
	<!-- TinyMCE -->
	<script type="text/javascript" src="http://tinymce.moxiecode.com//js/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
	
	<script type="text/javascript">
    $(document).ready(function(){
    	// TinyMCE initialization
        tinymce.init({
            selector: "#page_content",
            height: 400,
    		width: 750,
            // For enabling diff plugin like file upload, create href link etc.
            // plugins : 'advlist autolink link image imagetools lists charmap print preview contextmenu textcolor colorpicker fullscreen hr insertdatetime media pagebreak save table textpattern wordcount visualchars'
        });
    });
    </script>

	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Pages</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
      		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_add_page">Add Page</button>
      	</div>

      	<div class="col-lg-12 top-buffer">
	      	<!-- Table to show all the pages -->
			<table id="datatable_pages" class="table table-striped">
				<thead>
					<tr>
						<td>#</td>
						<td>Navigation</td>
						<td>Page Name</td>
						<td>Page Content</td>
						<td>Status</td>
						<td>Action</td>
					</tr>
				</thead>
			</table>
		</div>

		<!-- Modal to add / edit pages -->
		<div id="modal_add_page" class="modal fade" role="dialog">
		  	<div class="modal-dialog" style="width:800px;">
			    <!-- Modal content-->
			    <div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Add Page</h4>
					</div>

					<div class="modal-body">
						<form name="frm_add_page" id="frm_add_page" autocomplete="off">
							<div class="form-group">
								<label for="page_name">Page Name</label>
								<input type="text" name="page_name" id="page_name" class="form-control">
								<input type="hidden" name="page_id" id="page_id">
							</div>
							<div class="form-group">
								<label for="page_navigation">Navigation</label>
								<select name="page_navigation" id="page_navigation" class="form-control">
									<option value="">Select</option>
									<?php
									if( isset( $navigations ) && count($navigations) > 0 )
									{
										foreach ($navigations as $navigation)
										{
											echo '<option value="'. $navigation->id .'">'. ucfirst( strtolower( $navigation->navigation_text ) ) .'</option>';	
										}
									}
									?>
								</select>								
							</div>
							<div class="form-group">
								<label for="page_content">Page Content</label>
								<textarea id="page_content" name="page_content" class="form-control"></textarea>
							</div>
							<div class="form-group">
								<label for="page_status">Status</label>
								<div class="radio">
								 	<label><input type="radio" name="page_status" value="1" checked="true">Active</label>
								</div>
								<div class="radio">
								 	<label><input type="radio" name="page_status" value="0">Inactive</label>
								</div>
								<label id="page_status-error" class="error" for="page_status"></label>
							</div>
							<button type="submit" id="btn_add_page" name="btn_add_page" class="btn btn-primary">Submit</button>
						</form>
					</div>
			    </div>
		  	</div>
		</div>

    </div>
@endsection