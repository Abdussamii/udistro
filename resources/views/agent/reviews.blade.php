@extends('agent.layouts.app')
@section('title', 'Udistro | Review Dashboard')

@section('content')

		<style>
		/* To resolve the google map autocomplete issue */
	    .pac-container {
	        z-index: 10000 !important;
	    }
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
		<div class="loader-wrapper">
			<div class="preload"><!-- <img src="http://i.imgur.com/KUJoe.gif"> -->Loading...</div>
		</div>

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
						<td>Comment</td>
						<td>Is helpful</td>
						<td>Rating</td>
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