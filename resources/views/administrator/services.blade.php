@extends('administrator.layouts.app')
@section('title', 'Udistro | Services')

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
            <h1 class="page-header">Service</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
      		<button type="button" class="btn btn-primary" data-toggle="modal" id="btn_modal_services">Add Service</button>
      	</div>

      	<div class="col-lg-12 top-buffer">
	      	<!-- Table to show all the services -->
			<table id="datatable_services" class="table table-striped">
				<thead>
					<tr>
						<td>#</td>
						<td>Service Name</td>
						<td>Service Desc</td>
						<td>Category Name</td>
						<td>Status</td>
						<td>Action</td>
					</tr>
				</thead>
			</table>
		</div>

		<!-- Modal to add / edit services -->
		<div id="modal_add_services" class="modal fade" role="dialog">
		  	<div class="modal-dialog">
			    <!-- Modal content-->
			    <div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Add Services</h4>
					</div>

					<div class="modal-body">
						<div class="row">
							<div class="col-sm-12">
								<form name="frm_add_services" id="frm_add_services" autocomplete="off">
									<div class="form-group">
										<label for="services_name">Services Name <span class="error">*</span></label>
										<input type="text" name="services_name" id="services_name" class="form-control" placeholder="Enter services Name">
										<input type="hidden" name="services_id" id="services_id">
									</div>
									<div class="form-group">
										<label for="description">Description <span class="error">*</span></label>
										<input type="text" name="description" id="description" class="form-control" placeholder="Enter Description">
									</div>
									<div class="form-group">
								  		<label for="services_category">Service Category <span class="error">*</span></label>
								  		<select name="services_category" id="services_category" class="form-control">
								  			<option value="">Select</option>
								  			<?php
								  			if( isset( $companyCategories ) && count( $companyCategories ) > 0 )
								  			{
								  				foreach ($companyCategories as $category)
								  				{
								  					echo '<option value="'. $category->id .'">'. ucwords( strtolower( $category->category ) ) .'</option>';
								  				}
								  			}
								  			?>
								  		</select>
									</div>
									<div class="form-group">
										<label for="services_status">Status <span class="error">*</span></label>
										<div class="radio">
										 	<label><input type="radio" name="services_status" value="1" checked="true">Active</label>
										</div>
										<div class="radio">
										 	<label><input type="radio" name="services_status" value="0">Inactive</label>
										</div>
										<label id="services_status-error" class="error" for="services_status"></label>
									</div>
									<button type="submit" id="btn_add_services" name="btn_add_services" class="btn btn-primary">Submit</button>
								</form>
							</div>
						</div>
					</div>
			    </div>
		  	</div>
		</div>
    </div>
@endsection