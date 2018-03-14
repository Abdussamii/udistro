@extends('company.layouts.app')
@section('title', 'Udistro | Jobs')

@section('content')
	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Jobs</h1>
        </div>
    </div>

    <div class="row">
        
    	<!-- Datatable to show the jobs listing -->
    	<table id="datatable_jobs" class="table table-striped">
    		<thead>
    			<tr>
    				<td>#</td>
    				<td>Client Name</td>
    				<td>Phone</td>
    				<td>Order Detail</td>
    				<td>Invoice#</td>
    				<td>Payment Status</td>
    				<td>Receivable Amount</td>
    				<td>Ask For Money</td>
    			</tr>
    		</thead>
    	</table>

    </div>
@endsection