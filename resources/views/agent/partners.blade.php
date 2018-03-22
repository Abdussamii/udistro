@extends('agent.layouts.app')
@section('title', 'Udistro | Partner')

@section('content')

	<style type="text/css">
	.loader-wrapper {
    	position: fixed;
    	width: 100%;
    	height: 100%;
    	background: #fff;
    	z-index: 999;
    }
    .preload {
        position: absolute;
        top: 50%;
        left: 40%;
        transform: translate(-50%, -40%);
        -webkit-transform: translate(-50%, -40%);
    }
	</style>

	<!-- Loader -->
	<div class="loader-wrapper">
		<div class="preload">Loading...</div>
	</div>

	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Partner</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
      		<button type="button" class="btn btn-primary" data-toggle="modal" id="btn_modal_partner">Add Partner</button>
      	</div>

      	<div class="col-lg-12 top-buffer">
	      	<!-- Table to show all the partner -->
			<table id="datatable_partners" class="table table-striped">
				<thead>
					<tr>
						<td>#</td>
						<td>Business Name</td>
						<td>First Name</td>
						<td>Last Name</td>
						<td>E-mail</td>
						<td>Status</td>
						<td>Action</td>
					</tr>
				</thead>
			</table>
		</div>

		<!-- Modal to add / edit partner -->
		<div id="modal_add_partner" class="modal fade" role="dialog">
		  	<div class="modal-dialog">
			    <!-- Modal content-->
			    <div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Add Partner</h4>
					</div>

					<div class="modal-body">
						<div class="row">
							<div class="col-sm-9">
								<form name="frm_add_partner" id="frm_add_partner" autocomplete="off">
									<div class="form-group">
										<input type="text" name="business_name" id="business_name" class="form-control" placeholder="Enter business name">
										<input type="hidden" name="partner_id" id="partner_id">
									</div>
									
									<div class="form-group">
										<input type="text" name="f_name" id="f_name" class="form-control" placeholder="Enter first name">
									</div>
									
									<div class="form-group">
										<input type="text" name="l_name" id="l_name" class="form-control" placeholder="Enter last name">
									</div>
									
									<div class="form-group">
										<input type="email" name="partner_email" id="partner_email" class="form-control" placeholder="Enter Partner E-mail">
									</div>
									
									<div class="form-group">
										<label for="partner_status">Status</label>
										<div class="radio">
										 	<label><input type="radio" name="partner_status" value="1" checked="true">Active</label>
										</div>
										<div class="radio">
										 	<label><input type="radio" name="partner_status" value="0">Inactive</label>
										</div>
										<label id="partner_status-error" class="error" for="partner_status"></label>
									</div>
									
									
									<button type="submit" id="btn_add_partner" name="btn_add_partner" class="btn btn-primary">Submit</button>
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