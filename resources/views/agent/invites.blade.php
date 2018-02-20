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
						<td>Status</td>
						<td>Schedule Status</td>
						<td>Action</td>
					</tr>
				</thead>
			</table>
		</div>
    </div>

    <!-- Modal to add / edit activity -->
	<div id="modal_invite" class="modal fade" role="dialog">
	  	<div class="modal-dialog">
		    <!-- Modal content-->
		    <div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Invite</h4>
				</div>

				<div class="modal-body">
					<div class="row" id="htmlInvite"></div>
				</div>
		    </div>
	  	</div>
	</div>
@endsection