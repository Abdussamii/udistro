@extends('agentPartner.layouts.app')
@section('title', 'Udistro | Dashboard')

@section('content')
	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Dashboard</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
			<div class="col-lg-6 col-md-6 col-sm-6">
				<table class="table table-striped">
					<tr>
						<td style="width: 30%;">Moving from</td>
						<td id="moving_from_address"></td>
					</tr>
				</table>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-6">
				<table class="table table-striped">
					<tr>
						<td style="width: 30%;">Moving to</td>
						<td id="moving_to_address"></td>
					</tr>
				</table>
			</div>						

			<div class="clearfix"></div>
				<div class="col-lg-6 col-md-6 col-sm-6">
					<table class="table table-striped">
						<tr>
							<th style="width:70%">Items</th>
							<th>User Input</th>
						</tr>
						<tr>
							<td>Moving from house type</td>
							<td id="moving_from_house_type"></td>
						</tr>
						<tr>
							<td>Moving from floor level</td>
							<td id="moving_from_floor"></td>
						</tr>
						<tr>
							<td>Moving from no of bedroom</td>
							<td id="moving_from_bedroom_count"></td>
						</tr>
						<tr>
							<td>Moving from property type</td>
							<td id="moving_from_property_type"></td>
						</tr>
						<tr>
							<td>Moving to house type</td>
							<td id="moving_to_house_type"></td>
						</tr>
						<tr>
							<td>Moving to floor level</td>
							<td id="moving_to_floor"></td>
						</tr>
						<tr>
							<td>Moving to no of bedroom</td>
							<td id="moving_to_bedroom_count"></td>
						</tr>
						<tr>
							<td>Moving to property type</td>
							<td id="moving_to_property_type"></td>
						</tr>
					</table>
				</div>
					<div class="col-lg-6 col-md-6 col-sm-6">
						<table class="table table-striped">
							<tr>
								<th style="width:70%">Items</th>
								<th>User Input</th>
							</tr>
							<tr>
								<td>Do you have cable &amp; internet service before</td>
								<td id="have_cable_internet_already"></td>
							</tr>
							<tr>
								<td>Employment Status</td>
								<td id="employment_status"></td>
							</tr>
							<tr>
								<td>Would you like to receive your bill electronically</td>
								<td id="want_to_receive_electronic_bill"></td>
							</tr>
							<tr>
								<td>Would you consider any contract plan</td>
								<td id="want_to_contract_plan"></td>
							</tr>
							<tr>
								<td>Would you want to setup pre-authorise payment</td>
								<td id="want_to_setup_preauthorise_payment"></td>
							</tr>
							<tr>
								<td>Additional Information</td>
								<td id="additional_information"></td>
							</tr>
						</table>
					</div>

				<div class="col-lg-12 col-md-12 col-sm-12">
					<table class="table table-striped">
						<thead>
							<tr>
								<th>Items</th>
								<th>User Input</th>
							</tr>
						</thead>
						<tbody id="user_requested_cable_internet_additional_services">
												
						</tbody>
					</table>
				</div>

				<div class="col-lg-12 col-md-12 col-sm-12">
					<table class="table table-striped">
						<thead>
							<tr>
								<th style="width: 30%">Items</th>
								<th style="width: 40%">User Input</th>
								<th style="width: 10%">Quantity</th>
								<th style="width: 10%">Time Estimate</th>
								<th style="width: 10%">Budget Estimate</th>
							</tr>
						</thead>
						<tbody id="user_requested_cable_internet_services">
									
						</tbody>
					</table>
				</div>
		</div>
    </div>
@endsection