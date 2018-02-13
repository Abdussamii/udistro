@extends('administrator.layouts.app')
@section('title', 'Udistro | RolePermission')

@section('content')
	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Role Permission</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
      		<button type="button" class="btn btn-primary" data-toggle="modal" id="btn_modal_rolepermissions">Attach RolePermission</button>
      	</div>

      	<div class="col-lg-12 top-buffer">
	      	<!-- Table to show all the partner -->
			<table id="datatable_rolepermissions" class="table table-striped">
				<thead>
					<tr>
						<td>Role</td>
						<td>Permission</td>
						<td>Detach</td>
					</tr>
				</thead>
			</table>
		</div>

		<!-- Modal to add / edit rolepermissions -->
		<div id="modal_add_rolepermissions" class="modal fade" role="dialog">
		  	<div class="modal-dialog">
			    <!-- Modal content-->
			    <div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Attach RolePermission</h4>
					</div>

					<div class="modal-body">
						<div class="row">
							<div class="col-sm-9">
								<form name="frm_add_rolepermissions" id="frm_add_rolepermissions" autocomplete="off">
									<div class="form-group">
										<select name="role_name" id="role_name" class="form-control">
											<option value="">Select Role Type</option>
											<?php
												if( count( $roleNames ) > 0 )
												{
													foreach ($roleNames as $roleName)
													{
														echo '<option value="'. $roleName->id .'">'. ucwords( strtolower( $roleName->name ) ) .'</option>';
													}
												}
											?>
										</select>
									</div>
									<div class="form-group">
										<select name="permission_name" id="permission_name" class="form-control">
											<option value="">Select Permission Type</option>
											<?php
												if( count( $permissionNames ) > 0 )
												{
													foreach ($permissionNames as $permissionName)
													{
														echo '<option value="'. $permissionName->id .'">'. ucwords( strtolower( $permissionName->name ) ) .'</option>';
													}
												}
											?>
										</select>
									</div>
									
									<button type="submit" id="btn_add_rolepermissions" name="btn_add_rolepermissions" class="btn btn-primary">Submit</button>
								</form>
							</div>
							<div class="col-sm-3">
								
							</div>
						</div>
					</div>
			    </div>
		  	</div>
		</div>
		
		<div class="modal fade" id="deleteDialogModal" role="dialog">
			<div class="modal-dialog">
    
			<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Detach RolePermission</h4>
					</div>
					<div class="modal-body" style="padding:40px 50px;">
						<strong>Are You sure you want to detach permission from role?</strong>
					<div class="modal-footer">
						<form name="frm_detach_rolepermission"  id="frm_detach_rolepermission">
							<div class="form-group">
								<input type="hidden" name="role_permission_id" id="role_permission_id">
								<button name="yes" id="yes" type="submit" class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-star"></span> Yes</button>
								<button type="submit" class="btn btn-success btn-default pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> No</button>
							</div>
						</form>
          
					</div>
					</div>
				</div>
			</div> 
		</div> 
    </div>
@endsection