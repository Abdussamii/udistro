@extends('agent.layouts.app')
@section('title', 'Udistro | Invites')

@section('content')

	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Invites</h1>
        </div>
    </div>
    <div class="row">
      	<div class="col-lg-12 top-buffer">
	      	<!-- Table to show all the cities -->
			<table id="datatable_invites" class="table table-striped">
				<thead>
					<tr>
						<td>#</td>
						<td>First Name</td>
						<td>Last Name</td>
						<td>Email</td>
						<td>Email Template</td>
						<td>Status</td>
						<td>Content</td>
					</tr>
				</thead>
			</table>
		</div>
    </div>
@endsection