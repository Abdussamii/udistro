@extends('administrator.layouts.app')
@section('title', 'Udistro | Moving Item details')

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
            <h1 class="page-header">Moving Item details</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
      		<button type="button" class="btn btn-primary" data-toggle="modal" id="btn_modal_moving_item">Add Item</button>
      	</div>

      	<div class="col-lg-12 top-buffer">
	      	<!-- Table to show all the province -->
			<table id="datatable_moving_item" class="table table-striped">
				<thead>
					<tr>
						<td>#</td>
						<td>Category Name</td>
						<td>Item Name</td>
						<td>Item Weight (in LBS)</td>
						<td>Status</td>
						<td>Action</td>
					</tr>
				</thead>
			</table>
		</div>

		<!-- Modal to add / edit moving category -->
		<div id="modal_add_moving_item" class="modal fade" role="dialog">
		  	<div class="modal-dialog">
			    <!-- Modal content-->
			    <div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Add Moving Item Name</h4>
					</div>

					<div class="modal-body">
						<div class="row">
							<div class="col-sm-9">
								<form name="frm_add_moving_item" id="frm_add_moving_item" autocomplete="off">
									<div class="form-group">
										<label for="item_name">Item Name <span class="error">*</span></label>
										<input type="text" name="item_name" id="item_name" class="form-control" placeholder="Enter Item name">
										<input type="hidden" name="item_id" id="item_id">
									</div>
									<div class="form-group">
										<label for="province">Category Name <span class="error">*</span></label>
										<select name="item_category" id="item_category" class="form-control">
											<option value="">Select</option>
											<?php
											if( isset( $movingItemArray ) && count( $movingItemArray ) > 0 )
											{
												foreach ($movingItemArray as $movingItem)
												{
													echo '<option value="'. $movingItem->id .'">'. $movingItem->item_name .'</option>';
												}
											}
											?>
										</select>
									</div>
									<div class="form-group">
										<label for="category_name">Item Weight (in LBS) <span class="error">*</span></label>
										<input type="text" name="item_weight" id="item_weight" class="form-control" placeholder="Enter item weight">
									</div>
									<div class="form-group">
										<label for="item_status">Status <span class="error">*</span></label>
										<div class="radio">
										 	<label><input type="radio" name="item_status" value="1" checked="true">Active</label>
										</div>
										<div class="radio">
										 	<label><input type="radio" name="item_status" value="0">Inactive</label>
										</div>
										<label id="province_status-error" class="error" for="item_status"></label>
									</div>
									<button type="submit" id="btn_add_moving_item" name="btn_add_moving_item" class="btn btn-primary">Submit</button>
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