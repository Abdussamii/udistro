@extends('company.layouts.app')
@section('title', 'Udistro | Payment Plan')

@section('content')
	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Payment Plan</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
      		<button type="button" class="btn btn-primary" data-toggle="modal" id="btn_company_payment_plan">Select Plan</button>
      	</div>

      	<div class="col-lg-12 top-buffer">
      		
      	</div>
    </div>

    <script type="text/javascript">
    $(document).ready(function(){
    	$('#btn_company_payment_plan').click(function(){
    		console.log('hello');
    	});
    });
    </script>

@endsection