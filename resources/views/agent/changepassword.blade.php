@extends('agent.layouts.app')
@section('title', 'Udistro | Change Password')

@section('content')
	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Change Password</h1>
        </div>
    </div>
    <div class="row">
    	<div class="col-lg-6">
	    	<form name="frm_change_password" id="frm_change_password" autocomplete="off">
				<div class="form-group">
					<label for="oldpassword">Old Password</label>
					<input type="text" name="oldpassword" id="oldpassword" class="form-control" placeholder="Enter Old Password">
				</div>
				<div class="form-group">
					<label for="newpassword">New Password</label>
					<input type="password" name="newpassword" id="newpassword" class="form-control" placeholder="Enter New Password">
				</div>
				<div class="form-group">
					<label for="cnfpassword">Confirm Password</label>
					<input type="text" name="cnfpassword" id="cnfpassword" class="form-control" placeholder="Enter Confirm Password">
				</div>
				<button type="submit" id="btn_change_password" name="btn_change_password" class="btn btn-primary">Submit</button>
			</form>
		</div>
	</div>
@endsection