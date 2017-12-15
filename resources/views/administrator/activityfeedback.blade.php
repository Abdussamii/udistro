@extends('administrator.layouts.app')
@section('title', 'Udistro | Activity Feedback')

@section('content')
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