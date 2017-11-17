@extends('agent.layouts.app')
@section('title', 'Udistro | Profile')

@section('content')
	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Profile</h1>
        </div>
    </div>

    <ul class="nav nav-tabs">
		<li class="active"><a data-toggle="tab" href="#profile">Profile</a></li>
		<li><a data-toggle="tab" href="#message">Message</a></li>
		<li><a data-toggle="tab" href="#themes">Themes</a></li>
	</ul>

	<div class="tab-content">
		<div id="profile" class="tab-pane fade in active">
			<div class="row top-buffer">
				<!-- left column -->
				<div class="col-md-8">
					<form class="form-horizontal" role="form">
						<div class="form-group">
							<label class="col-lg-2 control-label">First name:</label>
							<div class="col-lg-8">
							  	<input class="form-control" type="text" value="Jane">
							</div>
						</div>
						<div class="form-group">
							<label class="col-lg-2 control-label">Last name:</label>
							<div class="col-lg-8">
							  	<input class="form-control" type="text" value="Bishop">
							</div>
						</div>
						<div class="form-group">
							<label class="col-lg-2 control-label">Company:</label>
							<div class="col-lg-8">
							  	<input class="form-control" type="text" value="">
							</div>
						</div>
						<div class="form-group">
							<label class="col-lg-2 control-label">Email:</label>
							<div class="col-lg-8">
							  	<input class="form-control" type="text" value="janesemail@gmail.com">
							</div>
						</div>
						<div class="form-group">
							<label class="col-lg-2 control-label">Time Zone:</label>
							<div class="col-lg-8">
							  	<div class="ui-select">
								    <select id="user_time_zone" class="form-control">
										<option value="Hawaii">(GMT-10:00) Hawaii</option>
										<option value="Alaska">(GMT-09:00) Alaska</option>
										<option value="Pacific Time (US &amp; Canada)">(GMT-08:00) Pacific Time (US &amp; Canada)</option>
										<option value="Arizona">(GMT-07:00) Arizona</option>
										<option value="Mountain Time (US &amp; Canada)">(GMT-07:00) Mountain Time (US &amp; Canada)</option>
										<option value="Central Time (US &amp; Canada)" selected="selected">(GMT-06:00) Central Time (US &amp; Canada)</option>
										<option value="Eastern Time (US &amp; Canada)">(GMT-05:00) Eastern Time (US &amp; Canada)</option>
										<option value="Indiana (East)">(GMT-05:00) Indiana (East)</option>
								    </select>
							  	</div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Username:</label>
							<div class="col-md-8">
							  	<input class="form-control" type="text" value="janeuser">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Password:</label>
							<div class="col-md-8">
							  	<input class="form-control" type="password" value="11111122333">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Confirm password:</label>
							<div class="col-md-8">
							  	<input class="form-control" type="password" value="11111122333">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label"></label>
							<div class="col-md-8">
							  	<input type="button" class="btn btn-primary" value="Save Changes">
							  	<span></span>
							  	<input type="reset" class="btn btn-default" value="Cancel">
							</div>
						</div>
					</form>
				</div>
				<div class="col-md-4">
					<div class="text-center">
						<img src="//placehold.it/100" class="avatar img-square" alt="avatar">
						<h6>Upload a different photo...</h6>
					</div>
				</div>
			</div>
		</div>
		<div id="message" class="tab-pane fade">
			<h3>Message</h3>
			<div>
				Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
				quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
				consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
				cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
				proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
			</div>
		</div>
		<div id="themes" class="tab-pane fade">
			<h3>Themes</h3>
			<div>
				Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
				quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
				consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
				cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
				proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
			</div>
		</div>

		<br>

	</div>
@endsection