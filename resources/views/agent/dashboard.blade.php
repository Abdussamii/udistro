@extends('agent.layouts.app')
@section('title', 'Udistro | Dashboard')

@section('content')
	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Dashboard</h1>
        </div>
    </div>
    <div class="row">
    	<!-- Total clients -->
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-phone fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{ $clientCount }}</div>
                            <div>Clients</div>
                        </div>
                    </div>
                </div>
                <a href="{{ url('/agent/clients') }}">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>

        <!-- Total invitation sent -->
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-user-plus fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{ $inviteCount }}</div>
                            <div>Sent Invitations</div>
                        </div>
                    </div>
                </div>
                <a href="{{ url('/agent/invites') }}">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>

        <!-- Total invitation accepted -->
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-check fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{ $acceptedInviteCount }}</div>
                            <div>Accepted Invitations</div>
                        </div>
                    </div>
                </div>
                <a href="{{ url('/agent/invites') }}">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>

        <!-- Rating (Review Board) -->
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-star-o fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{ $agnetRating->rating or 0 }}</div>
                            <div>Review Board</div>
                        </div>
                    </div>
                </div>
                <a href="{{ url('/agent/reviews') }}">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>

        <!-- Client in critical zone -->
        <?php
        if( isset( $criticalZoneClients ) && count( $criticalZoneClients ) > 0 )
        {
        ?>
        	<div class="col-lg-3 col-md-6">
        	    <div class="panel panel-primary">
        	        <div class="panel-heading" style="background-color: red;">
        	            <div class="row">
        	                <div class="col-xs-3">
        	                    <i class="fa fa-warning fa-5x"></i>
        	                    <!-- <i class="fa fa-warning fa-5x" style="color:red"></i> -->
        	                </div>
        	                <div class="col-xs-9 text-right">
        	                    <div class="huge">{{ $criticalZoneClients or 0 }}</div>
        	                    <div>Send Invitation Immediately</div>
        	                </div>
        	            </div>
        	        </div>
        	        <a href="{{ url('/agent/clients') }}">
        	            <div class="panel-footer">
        	                <span class="pull-left">View Details</span>
        	                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
        	                <div class="clearfix"></div>
        	            </div>
        	        </a>
        	    </div>
        	</div>
        <?php
        }
        ?>

      	<div class="col-lg-12">
      		<h1 class="page-header">Recent Clients</h1>
	      	<!-- Table to show all the cities -->
			<table id="datatable_invited_clients" class="table table-striped">
				<thead>
					<tr>
						<td>#</td>
						<td>First Name</td>
						<td>Middle Name</td>
						<td>Last Name</td>
						<td>Email</td>
						<td>Mobile</td>
						<td>Status</td>
					</tr>
				</thead>
			</table>
		</div>

    </div>
@endsection