@extends('administrator.layouts.app')
@section('title', 'Udistro | Company Categories')

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
            <h1 class="page-header">Company Categories</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
      		<button type="button" class="btn btn-primary" data-toggle="modal" id="btn_modal_company_category">Add Category</button>
      	</div>

      	<div class="col-lg-12 top-buffer">
	      	<!-- Table to show all the province -->
			<table id="datatable_company_categories" class="table table-striped">
				<thead>
					<tr>
						<td>#</td>
						<td>Category</td>
						<td>Status</td>
						<td>Action</td>
					</tr>
				</thead>
			</table>
		</div>

		<!-- Modal to add / edit company category -->
		<div id="modal_add_company_category" class="modal fade" role="dialog">
		  	<div class="modal-dialog">
			    <!-- Modal content-->
			    <div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Add Category</h4>
					</div>

					<div class="modal-body">
						<form name="frm_add_company_category" id="frm_add_company_category" autocomplete="off">
							<div class="form-group">
								<label for="category_name">Category Name <span class="error">*</span></label>
								<input type="text" name="category_name" id="category_name" class="form-control" placeholder="Enter category name">
								<input type="hidden" name="category_id" id="category_id">
							</div>
							<div class="form-group">
								<label for="category_status">Status</label>
								<div class="radio">
								 	<label><input type="radio" name="category_status" value="1" checked="true">Active</label>
								</div>
								<div class="radio">
								 	<label><input type="radio" name="category_status" value="0">Inactive</label>
								</div>
								<label id="category_status-error" class="error" for="category_status"></label>
							</div>
							<button type="submit" id="btn_add_company_category" name="btn_add_company_category" class="btn btn-primary">Submit</button>
						</form>
					</div>
			    </div>
		  	</div>
		</div>

    </div>
@endsection