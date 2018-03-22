@extends('administrator.layouts.app')
@section('title', 'Udistro | Activity Feedback')

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
            <h1 class="page-header">Activity Feedback</h1>
        </div>
    </div>
    <div class="row">
      	<div class="col-lg-12 top-buffer">
	      	<!-- Table to show all the activity -->
			<table id="datatable_activity_feedback" class="table table-striped">
				<thead>
					<tr>
						<td>#</td>
						<td>Activity Name</td>
						<td>Yes Count</td>
						<td>No Count</td>
					</tr>
				</thead>
			</table>
		</div>
    </div>
@endsection