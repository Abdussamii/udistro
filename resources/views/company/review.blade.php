@extends('company.layouts.app')
@section('title', 'Udistro | Review')

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
            <h1 class="page-header">Review</h1>
        </div>
    </div>
    <div class="row">
        
        <table class="table table-striped" id="datatable_reviews">
        	<thead>
        		<tr>
        			<td>#</td>
        			<td>User</td>
        			<td>Rating</td>
        			<td>Comment</td>
        			<td>Created At</td>
        		</tr>
        	</thead>
        </table>

    </div>
@endsection