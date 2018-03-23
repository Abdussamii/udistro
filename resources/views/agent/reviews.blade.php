@extends('agent.layouts.app')
@section('title', 'Udistro | Review Dashboard')

@section('content')

	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Review Dashboard</h1>
        </div>
    </div>
    <div class="row">

      	<div class="col-lg-12 top-buffer">
	      	<!-- Table to show all the cities -->
			<table id="datatable_reviews" class="table table-striped">
				<thead>
					<tr>
						<td>#</td>
						<td>First Name</td>
						<td>Last Name</td>
						<td>Email</td>
						<td>Rating</td>
						<td>Comment</td>
						<td>Action</td>
					</tr>
				</thead>
			</table>
		</div>

		<!-- Modal to add / edit client -->
		<div id="modal_add_client" class="modal fade" role="dialog">
		  	<div class="modal-dialog">
			    <!-- Modal content-->
			    <div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Add Client</h4>
					</div>

					<div class="modal-body">
						
					</div>
			    </div>
		  	</div>
		</div>

    </div>
@endsection