@extends('administrator.layouts.app')
@section('title', 'Udistro | Dashboard')

@section('content')
	<div class="templatemo-content">
		<ol class="breadcrumb">
			<li><a href="{{ url('/administrator/dashboard') }}">Admin Panel</a></li>
			<li class="active">Dashboard</li>
		</ol>
      	<h1>Dashboard</h1>
	</div>
@endsection