@extends('administrator.layouts.app')
@section('title', 'Udistro | Cities')

@section('content')
	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Cities</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
      		<button type="button" class="btn btn-primary" data-toggle="modal" id="btn_modal_city">Add City</button>
      	</div>

      	<div class="col-lg-12 top-buffer">
	      	<!-- Table to show all the cities -->
			<table id="datatable_cities" class="table table-striped">
				<thead>
					<tr>
						<td>#</td>
						<td>Province</td>
						<td>City</td>
						<td>Status</td>
						<td>Action</td>
					</tr>
				</thead>
			</table>
		</div>

		<!-- Modal to add / edit cities -->
		<div id="modal_add_city" class="modal fade" role="dialog">
		  	<div class="modal-dialog">
			    <!-- Modal content-->
			    <div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Add City</h4>
					</div>

					<div class="modal-body">
						<form name="frm_add_city" id="frm_add_city" autocomplete="off">
							<div class="form-group">
								<label for="province">Province</label>
								<select name="province" id="province" class="form-control">
									<option value="">Select</option>
									<?php
									if( isset( $provinces ) && count( $provinces ) > 0 )
									{
										foreach ($provinces as $province)
										{
											echo '<option value="'. $province->id .'">'. $province->name .'</option>';
										}
									}
									?>
								</select>
							</div>
							<div class="form-group">
								<label for="city_name">City Name</label>
								<input type="text" name="city_name" id="city_name" class="form-control" placeholder="Enter city">
								<input type="hidden" name="city_id" id="city_id">
							</div>
							<div class="form-group">
								<label for="city_status">Status</label>
								<div class="radio">
								 	<label><input type="radio" name="city_status" value="1" checked="true">Active</label>
								</div>
								<div class="radio">
								 	<label><input type="radio" name="city_status" value="0">Inactive</label>
								</div>
								<label id="city_status-error" class="error" for="city_status"></label>
							</div>
							<button type="submit" id="btn_add_cities" name="btn_add_cities" class="btn btn-primary">Submit</button>
						</form>
					</div>
			    </div>
		  	</div>
		</div>
    </div>
@endsection