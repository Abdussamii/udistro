@extends('company.layouts.app')
@section('title', 'Udistro | Quotation Request')

@section('content')
	<style type="text/css">
		/* Absolute Center Spinner */
		.loading {
		  position: fixed;
		  z-index: 100000;
		  height: 2em;
		  width: 2em;
		  overflow: show;
		  margin: auto;
		  top: 0;
		  left: 0;
		  bottom: 0;
		  right: 0;
		}

		/* Transparent Overlay */
		.loading:before {
		  content: '';
		  display: block;
		  position: fixed;
		  top: 0;
		  left: 0;
		  width: 100%;
		  height: 100%;
		  background-color: rgba(0,0,0,0.3);
		}

		/* :not(:required) hides these rules from IE9 and below */
		.loading:not(:required) {
		  /* hide "loading..." text */
		  font: 0/0 a;
		  color: transparent;
		  text-shadow: none;
		  background-color: transparent;
		  border: 0;
		}

		.loading:not(:required):after {
		  content: '';
		  display: block;
		  font-size: 10px;
		  width: 1em;
		  height: 1em;
		  margin-top: -0.5em;
		  -webkit-animation: spinner 1500ms infinite linear;
		  -moz-animation: spinner 1500ms infinite linear;
		  -ms-animation: spinner 1500ms infinite linear;
		  -o-animation: spinner 1500ms infinite linear;
		  animation: spinner 1500ms infinite linear;
		  border-radius: 0.5em;
		  -webkit-box-shadow: rgba(0, 0, 0, 0.75) 1.5em 0 0 0, rgba(0, 0, 0, 0.75) 1.1em 1.1em 0 0, rgba(0, 0, 0, 0.75) 0 1.5em 0 0, rgba(0, 0, 0, 0.75) -1.1em 1.1em 0 0, rgba(0, 0, 0, 0.5) -1.5em 0 0 0, rgba(0, 0, 0, 0.5) -1.1em -1.1em 0 0, rgba(0, 0, 0, 0.75) 0 -1.5em 0 0, rgba(0, 0, 0, 0.75) 1.1em -1.1em 0 0;
		  box-shadow: rgba(0, 0, 0, 0.75) 1.5em 0 0 0, rgba(0, 0, 0, 0.75) 1.1em 1.1em 0 0, rgba(0, 0, 0, 0.75) 0 1.5em 0 0, rgba(0, 0, 0, 0.75) -1.1em 1.1em 0 0, rgba(0, 0, 0, 0.75) -1.5em 0 0 0, rgba(0, 0, 0, 0.75) -1.1em -1.1em 0 0, rgba(0, 0, 0, 0.75) 0 -1.5em 0 0, rgba(0, 0, 0, 0.75) 1.1em -1.1em 0 0;
		}

		/* Animation */

		@-webkit-keyframes spinner {
		  0% {
		    -webkit-transform: rotate(0deg);
		    -moz-transform: rotate(0deg);
		    -ms-transform: rotate(0deg);
		    -o-transform: rotate(0deg);
		    transform: rotate(0deg);
		  }
		  100% {
		    -webkit-transform: rotate(360deg);
		    -moz-transform: rotate(360deg);
		    -ms-transform: rotate(360deg);
		    -o-transform: rotate(360deg);
		    transform: rotate(360deg);
		  }
		}
		@-moz-keyframes spinner {
		  0% {
		    -webkit-transform: rotate(0deg);
		    -moz-transform: rotate(0deg);
		    -ms-transform: rotate(0deg);
		    -o-transform: rotate(0deg);
		    transform: rotate(0deg);
		  }
		  100% {
		    -webkit-transform: rotate(360deg);
		    -moz-transform: rotate(360deg);
		    -ms-transform: rotate(360deg);
		    -o-transform: rotate(360deg);
		    transform: rotate(360deg);
		  }
		}
		@-o-keyframes spinner {
		  0% {
		    -webkit-transform: rotate(0deg);
		    -moz-transform: rotate(0deg);
		    -ms-transform: rotate(0deg);
		    -o-transform: rotate(0deg);
		    transform: rotate(0deg);
		  }
		  100% {
		    -webkit-transform: rotate(360deg);
		    -moz-transform: rotate(360deg);
		    -ms-transform: rotate(360deg);
		    -o-transform: rotate(360deg);
		    transform: rotate(360deg);
		  }
		}
		@keyframes spinner {
		  0% {
		    -webkit-transform: rotate(0deg);
		    -moz-transform: rotate(0deg);
		    -ms-transform: rotate(0deg);
		    -o-transform: rotate(0deg);
		    transform: rotate(0deg);
		  }
		  100% {
		    -webkit-transform: rotate(360deg);
		    -moz-transform: rotate(360deg);
		    -ms-transform: rotate(360deg);
		    -o-transform: rotate(360deg);
		    transform: rotate(360deg);
		  }
		}

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
	
	<!-- Loading Spinner -->
	<div class="loading" style="display: none;">Loading&#8230;</div>

	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Quotation Request</h1>
        </div>
    </div>
    <div class="row">
      	<div class="col-lg-12 top-buffer">
	      	<!-- Table to show all the province -->
			<table id="datatable_quotation_request" class="table table-striped">
				<thead>
					<tr>
						<td>#</td>
						<td>Client Name</td>
						<td>Email</td>
						<td>Request Time</td>
						<td>Response</td>
						<td>Response Email</td>
						<td>Response Time</td>
						<td>Action</td>
					</tr>
				</thead>
			</table>
		</div>


		<!-- Modal to Home Cleaning Service Request -->
		<div id="modal_home_cleaning_service_request" class="modal fade" role="dialog">
		  	<div class="modal-dialog modal-lg">
			    <!-- Modal content-->
			    <div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Home Cleaning Services Request</h4>
					</div>

					<div class="modal-body" style="height: 800px; overflow-y: auto;">
						<form id="frm_home_cleaning_services" name="frm_home_cleaning_services" autocomplete="off">
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
									<tr>
										<td>Moving from address</td>
										<td id="distance"></td>
									</tr>
									<tr>
										<td>Home Condition</td>
										<td id="home_condition"></td>
									</tr>
									<tr>
										<td>How many levels do you have</td>
										<td id="home_cleaning_level"></td>
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
										<td>Size of area you want to clean</td>
										<td id="home_cleaning_area"></td>
									</tr>
									<tr>
										<td>How many peoples live in the house</td>
										<td id="home_cleaning_people_count"></td>
									</tr>
									<tr>
										<td>How many pets live in the house</td>
										<td id="home_cleaning_pet_count"></td>
									</tr>
									<tr>
										<td>How many bathrooms</td>
										<td id="home_cleaning_bathroom_count"></td>
									</tr>
									<tr>
										<td>Cleaning behind the refrigerator and stove</td>
										<td id="cleaning_behind_refrigerator_and_stove"></td>
									</tr>
									<tr>
										<td>Would you like baseboard to be washed</td>
										<td id="baseboard_to_be_washed"></td>
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
											<th style="width: 30%">Items</th>
											<th style="width: 40%">User Input</th>
											<th style="width: 10%">Quantity</th>
											<th style="width: 10%">Time Estimate</th>
											<th style="width: 10%">Budget Estimate</th>
										</tr>
									</thead>
									<tbody id="user_requested_home_cleaning_services">
										
									</tbody>
								</table>
							</div>

							<div class="col-lg-12 col-md-12 col-sm-12">
								<table class="table table-striped" id="home_cleaning_calculations">
									<thead>
										<tr>
											<td colspan="4" style="width: 80%;">Discount</td>
											<td>
												<input type="text" name="discount" id="discount"  class="form-control home_cleaning_discount">
											</td>
										</tr>
										<tr>
											<td colspan="4" style="width: 80%;">Sub Total</td>
											<td id="subtotal">$0</td>
										</tr>
										<tr>
											<td colspan="4" style="width: 80%;">GST (<span id="gst_percentage"></span>)</td>
											<td id="gst_amount">$0</td>
										</tr>
										<tr>
											<td colspan="4" style="width: 80%;">HST (<span id="hst_percentage"></span>)</td>
											<td id="hst_amount">$0</td>
										</tr>
										<tr>
											<td colspan="4" style="width: 80%;">PST (<span id="pst_percenateg"></span>)</td>
											<td id="pst_amount">$0</td>
										</tr>
										<tr>
											<td colspan="4" style="width: 80%;">Service Charge (<span id="service_charge_percetage"></span>)</td>
											<td id="service_charge_amount">$0</td>
										</tr>
										<tr>
											<td colspan="4" style="width: 80%;">Total</td>
											<td id="total">$0</td>
										</tr>
										<tr>
											<td colspan="4" style="width: 80%;">Total Remittance</td>
											<td id="total_remittance">$0</td>
										</tr>
										<tr>
											<td>Comment</td>
											<td>
												<textarea class="form-control" name="comment" id="comment" style="resize: vertical;"></textarea>
											</td>
										</tr>
										<tr>
											<td colspan="4" style="width: 80%;"></td>
											<td>
												<input type="hidden" name="home_cleaning_service_request_id" id="home_cleaning_service_request_id">
												<input type="button" name="btn_update_home_cleaning_service_request" id="btn_update_home_cleaning_service_request" value="Submit" class="btn btn-info">
											</td>
										</tr>
									</thead>
								</table>
							</div>

							<div class="clearfix"></div>
						</form>
					</div>
			    </div>
		  	</div>
		</div>


		<!-- Modal to Cable & Internet Service Request -->
		<div id="modal_cable_internet_service_request" class="modal fade" role="dialog">
		  	<div class="modal-dialog modal-lg">
			    <!-- Modal content-->
			    <div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Cable & Internet Services Request</h4>
					</div>

					<div class="modal-body">
						<div class="row">
							<div class="col-sm-12">
								<form id="frm_cable_internet_services" name="frm_cable_internet_services" autocomplete="off">
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

									<div class="col-lg-12 col-md-12 col-sm-12">
										<table class="table table-striped" id="cable_internet_calculations">
											<thead>
												<tr>
													<td colspan="4" style="width: 80%;">Discount</td>
													<td>
														<input type="text" name="discount" id="discount"  class="form-control cable_internet_discount">
													</td>
												</tr>
												<tr>
													<td colspan="4" style="width: 80%;">Sub Total</td>
													<td id="subtotal">$0</td>
												</tr>
												<tr>
													<td colspan="4" style="width: 80%;">GST (<span id="gst_percentage"></span>)</td>
													<td id="gst_amount">$0</td>
												</tr>
												<tr>
													<td colspan="4" style="width: 80%;">HST (<span id="hst_percentage"></span>)</td>
													<td id="hst_amount">$0</td>
												</tr>
												<tr>
													<td colspan="4" style="width: 80%;">PST (<span id="pst_percenateg"></span>)</td>
													<td id="pst_amount">$0</td>
												</tr>
												<tr>
													<td colspan="4" style="width: 80%;">Service Charge (<span id="service_charge_percetage"></span>)</td>
													<td id="service_charge_amount">$0</td>
												</tr>
												<tr>
													<td colspan="4" style="width: 80%;">Total</td>
													<td id="total">$0</td>
												</tr>
												<tr>
													<td colspan="4" style="width: 80%;">Total Remittance</td>
													<td id="total_remittance">$0</td>
												</tr>
												<tr>
													<td>Comment</td>
													<td>
														<textarea class="form-control" name="comment" id="comment" style="resize: vertical;"></textarea>
													</td>
												</tr>
												<tr>
													<td colspan="4" style="width: 80%;"></td>
													<td>
														<input type="hidden" name="cable_internet_service_request_id" id="cable_internet_service_request_id">
														<input type="submit" name="btn_update_cable_internet_service_request" id="btn_update_cable_internet_service_request" value="Submit" class="btn btn-info">
													</td>
												</tr>
											</thead>
										</table>
									</div>

									<div class="clearfix"></div>
								</form>
							</div>
						</div>
					</div>
			    </div>
		  	</div>
		</div>


		<!-- Modal to Tech Concierge Service Request -->
		<div id="modal_tech_concierge_service_request" class="modal fade" role="dialog">
		  	<div class="modal-dialog modal-lg">
			    <!-- Modal content-->
			    <div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Tech Concierge Services Request</h4>
					</div>

					<div class="modal-body">
						<div class="row">
							<div class="col-sm-12">
								<form id="frm_tech_concierge" name="frm_tech_concierge" autocomplete="off">
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
												<td>Availability 1</td>
												<td id="availability_day1"></td>
											</tr>
											<tr>
												<td>Availability 2</td>
												<td id="availability_day2"></td>
											</tr>
											<tr>
												<td>Availability 3</td>
												<td id="availability_day3"></td>
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
											<tbody id="user_requested_tech_concierge_other_details">
												
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
											<tbody id="user_requested_tech_concierge_services">
												
											</tbody>
										</table>
									</div>

									<div class="col-lg-12 col-md-12 col-sm-12">
										<table class="table table-striped" id="tech_concierge_calculations">
											<thead>
												<tr>
													<td colspan="4" style="width: 80%;">Discount</td>
													<td>
														<input type="text" name="discount" id="discount"  class="form-control tech_concierge_discount">
													</td>
												</tr>
												<tr>
													<td colspan="4" style="width: 80%;">Sub Total</td>
													<td id="subtotal">$0</td>
												</tr>
												<tr>
													<td colspan="4" style="width: 80%;">GST (<span id="gst_percentage"></span>)</td>
													<td id="gst_amount">$0</td>
												</tr>
												<tr>
													<td colspan="4" style="width: 80%;">HST (<span id="hst_percentage"></span>)</td>
													<td id="hst_amount">$0</td>
												</tr>
												<tr>
													<td colspan="4" style="width: 80%;">PST (<span id="pst_percenateg"></span>)</td>
													<td id="pst_amount">$0</td>
												</tr>
												<tr>
													<td colspan="4" style="width: 80%;">Service Charge (<span id="service_charge_percetage"></span>)</td>
													<td id="service_charge_amount">$0</td>
												</tr>
												<tr>
													<td colspan="4" style="width: 80%;">Total</td>
													<td id="total">$0</td>
												</tr>
												<tr>
													<td colspan="4" style="width: 80%;">Total Remittance</td>
													<td id="total_remittance">$0</td>
												</tr>
												<tr>
													<td>Comment</td>
													<td>
														<textarea class="form-control" name="comment" id="comment" style="resize: vertical;"></textarea>
													</td>
												</tr>
												<tr>
													<td colspan="4" style="width: 80%;"></td>
													<td>
														<input type="hidden" name="tech_concierge_service_request_id" id="tech_concierge_service_request_id">
														<input type="button" name="btn_update_tech_concierge_service_request" id="btn_update_tech_concierge_service_request" value="Submit" class="btn btn-info">
													</td>
												</tr>
											</thead>
										</table>
									</div>

									<div class="clearfix"></div>
								</form>
							</div>
						</div>
					</div>
			    </div>
		  	</div>
		</div>



		<!-- Modal to Moving Companies Service Request -->
		<div id="modal_moving_companies_service_request" class="modal fade" role="dialog">
		  	<div class="modal-dialog modal-lg">
			    <!-- Modal content-->
			    <div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Moving Companies Services Request</h4>
					</div>

					<div class="modal-body">
						<div class="row">
							<div class="col-sm-12">
								<form id="frm_home_moving_companies" name="frm_home_moving_companies" autocomplete="off">
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
												<td>Moving date</td>
												<td id="moving_date"></td>
											</tr>
											<tr>
												<td>Distance</td>
												<td id="distance"></td>
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
											<tbody id="user_requested_moving_other_services">
												
											</tbody>
										</table>
									</div>

									<div class="col-lg-12 col-md-12 col-sm-12">
										<table class="table table-striped">
											<thead>
												<tr>
													<th style="width: 30%">Items</th>
													<th style="width: 40%">User Input</th>
													<th style="width: 10%">Quantity/Weight</th>
													<th style="width: 10%">Time Estimate</th>
													<th style="width: 10%">Budget Estimate</th>
												</tr>
											</thead>
											<tbody id="user_requested_moving_services">
												
											</tbody>
										</table>
									</div>

									<div class="col-lg-12 col-md-12 col-sm-12">
										<table class="table table-striped" id="moving_service_calculations">
											<thead>
												<tr>
													<td colspan="4" style="width: 80%;">Insurance</td>
													<td>
														<input type="text" name="insurance" id="insurance"  class="form-control moving_service_insurance">
													</td>
												</tr>
												<tr>
													<td colspan="4" style="width: 80%;">Discount</td>
													<td>
														<input type="text" name="discount" id="discount"  class="form-control moving_service_discount">
													</td>
												</tr>
												<tr>
													<td colspan="4" style="width: 80%;">Sub Total</td>
													<td id="subtotal">$0</td>
												</tr>
												<tr>
													<td colspan="4" style="width: 80%;">GST (<span id="gst_percentage"></span>)</td>
													<td id="gst_amount">$0</td>
												</tr>
												<tr>
													<td colspan="4" style="width: 80%;">HST (<span id="hst_percentage"></span>)</td>
													<td id="hst_amount">$0</td>
												</tr>
												<tr>
													<td colspan="4" style="width: 80%;">PST (<span id="pst_percenateg"></span>)</td>
													<td id="pst_amount">$0</td>
												</tr>
												<tr>
													<td colspan="4" style="width: 80%;">Service Charge (<span id="service_charge_percetage"></span>)</td>
													<td id="service_charge_amount">$0</td>
												</tr>
												<tr>
													<td colspan="4" style="width: 80%;">Total</td>
													<td id="total">$0</td>
												</tr>
												<tr>
													<td colspan="4" style="width: 80%;">Total Remittance</td>
													<td id="total_remittance">$0</td>
												</tr>
												<tr>
													<td>Comment</td>
													<td>
														<textarea class="form-control" name="comment" id="comment" style="resize: vertical;"></textarea>
													</td>
												</tr>
												<tr>
													<td colspan="4" style="width: 80%;"></td>
													<td>
														<input type="hidden" name="moving_service_request_id" id="moving_service_request_id" value="">
														<input type="submit" name="btn_update_moving_service_request" id="btn_update_moving_service_request" value="Submit" class="btn btn-info">
													</td>
												</tr>
											</thead>
										</table>
									</div>

									<div class="clearfix"></div>
								</form>
							</div>
						</div>
					</div>
			    </div>
		  	</div>
		</div>


    </div>
@endsection