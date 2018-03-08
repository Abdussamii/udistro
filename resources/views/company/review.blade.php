@extends('company.layouts.app')
@section('title', 'Udistro | Review')

@section('content')
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