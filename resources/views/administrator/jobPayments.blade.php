@extends('administrator.layouts.app')
@section('title', 'Udistro | Job Payment')

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
            <h1 class="page-header">Job Payment</h1>
        </div>
    </div>

    <div class="row">
        
    	<!-- Datatable to show the jobs listing -->
    	<table id="datatable_jobs" class="table table-striped">
    		<thead>
    			<tr>
    				<td>#</td>
    				<td>Name</td>
    				<td>Phone</td>
    				<td>Company Name</td>
    				<td>Order Detail</td>
    				<td>Invoice #</td>
    				<td>Payment Status</td>
    				<td>Receivable Amount</td>
    				<!-- <td>Delivery Date</td> -->
    				<td>Action</td>
    			</tr>
    		</thead>
    	</table>

    </div>
@endsection