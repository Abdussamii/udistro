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

	<!-- Modal to enter the interact transaction id -->
	<div class="modal fade" id="modal_interact_transaction" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
	    <div class="modal-dialog">
	        <div class="modal-content">
	            <div class="modal-header">
	            	Enter Transaction Id
	            </div>
	            <div class="modal-body">
	            	<form name="frm_release_payment" id="frm_release_payment" autocomplete="off">
	            		<div class="form-group">
	            			<label for="transaction_id">Transaction Id <span class="error">*</span></label>
	            			<input type="text" name="transaction_id" id="transaction_id" class="form-control" placeholder="Transaction Id">
	            			<input type="hidden" name="txn_id" id="txn_id">
	            		</div>
	            		<button type="submit" id="btn_release_payment" name="btn_release_payment" class="btn btn-primary">Submit</button>
	            	</form>
	            </div>
	        </div>
	    </div>
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
    				<td>Delivery Date</td>
    				<td>Action</td>
    			</tr>
    		</thead>
    	</table>

    </div>
@endsection