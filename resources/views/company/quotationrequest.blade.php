@extends('company.layouts.app')
@section('title', 'Udistro | Quotation Request')

@section('content')
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
						<td>Phone Number</td>
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

					<div class="modal-body">
						<div class="row">
							<div class="col-sm-12">
								<form name="frm_home_cleaning_services" id="frm_home_cleaning_services" novalidate="novalidate">
							        <div class="panel-group" id="accordion">
							            <div class="panel panel-default">
							                <div class="panel-heading">
							                    <h4 class="panel-title">
							                        <a data-toggle="collapse" data-parent="#accordion" href="#home_cleaning_services_collapse2" class="collapsed" aria-expanded="false">Moving From</a>
							                    </h4>
							                </div>
							                <div id="home_cleaning_services_collapse2" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
							                    <div class="panel-body">
							                        <div class="form-group">
							                        	<label>Type:&nbsp;&nbsp;</label><span id="moving_from_house_type"></span>
							                        </div>
							                        <div class="form-group">
							                        	<label>Floor Level:&nbsp;&nbsp;</label><span id="moving_from_floor"></span>
							                        </div>
							                        <div class="form-group">
							                        	<label>No of bedrooms:&nbsp;&nbsp;</label><span id="moving_from_bedroom_count"></span>
							                        </div>
							                        <div class="form-group">
							                        	<label>Did you own or rent this property:&nbsp;&nbsp;</label><span id="moving_from_property_type"></span>
							                        </div>
							                    </div>
							                </div>
							            </div>
							            <div class="panel panel-default">
							                <div class="panel-heading">
							                    <h4 class="panel-title">
							                        <a data-toggle="collapse" data-parent="#accordion" href="#home_cleaning_services_collapse3" class="collapsed" aria-expanded="false">Moving To</a>
							                    </h4>
							                </div>
							                <div id="home_cleaning_services_collapse3" class="panel-collapse collapse" aria-expanded="false">
							                    <div class="panel-body">
							                        <div class="form-group">
							                        	<label>Type:&nbsp;&nbsp;</label><span id="moving_to_house_type"></span>
							                        </div>
							                        <div class="form-group">
							                        	<label>Floor Level:&nbsp;&nbsp;</label><span id="moving_to_floor"></span>
							                        </div>
							                        <div class="form-group">
							                        	<label>No of bedrooms:&nbsp;&nbsp;</label><span id="moving_to_bedroom_count"></span>
							                        </div>
							                        <div class="form-group">
							                        	<label>Did you own or rent this property:&nbsp;&nbsp;</label><span id="moving_to_property_type"></span>
							                        </div>
							                    </div>
							                </div>
							            </div>
							            <div class="panel panel-default">
							                <div class="panel-heading">
							                    <h4 class="panel-title">
							                        <a data-toggle="collapse" data-parent="#accordion" href="#home_cleaning_services_collapse4" class="collapsed" aria-expanded="false">Detailed Job Description</a>
							                    </h4>
							                </div>
							                <div id="home_cleaning_services_collapse4" class="panel-collapse collapse" aria-expanded="false">
							                    <div class="panel-body">
							                        <div class="form-group">
							                        	<label>Home Condition:&nbsp;&nbsp;</label><span id="home_condition"></span>
							                        </div>
							                        <div class="form-group">
							                        	<label>How many levels do you have:&nbsp;&nbsp;</label><span id="home_cleaning_level"></span>
							                        </div>
							                        <div class="form-group">
							                        	<label>Size of area you want to clean:&nbsp;&nbsp;</label><span id="home_cleaning_area"></span>
							                        </div>
							                        <div class="form-group">
							                        	<label>How many peoples live in the house:&nbsp;&nbsp;</label><span id="home_cleaning_people_count"></span>
							                        </div>
							                        <div class="form-group">
							                        	<label>How many pets live in the house:&nbsp;&nbsp;</label><span id="home_cleaning_pet_count"></span>
							                        </div>
							                        <div class="form-group">
							                        	<label>How many bathrooms&nbsp;&nbsp;</label><span id="home_cleaning_bathroom_count"></span>
							                        </div>

							                        <div class="form-group">
							                        	<label>Steaming carpet cleaning</label><br>
							                        							                        			<label class="form-group"><input type="checkbox" name="home_cleaning_steaming_services[]" value="1"> Rooms</label>
							                        								                        			<label class="form-group"><input type="checkbox" name="home_cleaning_steaming_services[]" value="2"> Stair Case</label>
							                        								                        			<label class="form-group"><input type="checkbox" name="home_cleaning_steaming_services[]" value="3"> Hall Way</label>
							                        								                        			<label class="form-group"><input type="checkbox" name="home_cleaning_steaming_services[]" value="4"> Living Room</label>
							                        								                        </div>

							                        <div class="form-group">
							                        	<label>Other places to clean</label><br>
							                        							                        			<div class="col-lg-4"><label class="form-group">
							                        				<input type="checkbox" name="home_cleaning_other_places[]" value="1"> Kitchen</label>
							                        			</div>
							                        								                        			<div class="col-lg-4"><label class="form-group">
							                        				<input type="checkbox" name="home_cleaning_other_places[]" value="2"> Living Room</label>
							                        			</div>
							                        								                        			<div class="col-lg-4"><label class="form-group">
							                        				<input type="checkbox" name="home_cleaning_other_places[]" value="3"> Dining Room</label>
							                        			</div>
							                        								                        			<div class="col-lg-4"><label class="form-group">
							                        				<input type="checkbox" name="home_cleaning_other_places[]" value="4"> Stair Case</label>
							                        			</div>
							                        								                        			<div class="col-lg-4"><label class="form-group">
							                        				<input type="checkbox" name="home_cleaning_other_places[]" value="5"> Office Room</label>
							                        			</div>
							                        								                        			<div class="col-lg-4"><label class="form-group">
							                        				<input type="checkbox" name="home_cleaning_other_places[]" value="6"> Hall Way</label>
							                        			</div>
							                        								                        			<div class="col-lg-4"><label class="form-group">
							                        				<input type="checkbox" name="home_cleaning_other_places[]" value="7"> Interior</label>
							                        			</div>
							                        								                        			<div class="col-lg-4"><label class="form-group">
							                        				<input type="checkbox" name="home_cleaning_other_places[]" value="8"> Staircase</label>
							                        			</div>
							                        								                        			<div class="col-lg-4"><label class="form-group">
							                        				<input type="checkbox" name="home_cleaning_other_places[]" value="9"> Recreation Room</label>
							                        			</div>
							                        								                        			<div class="col-lg-4"><label class="form-group">
							                        				<input type="checkbox" name="home_cleaning_other_places[]" value="10"> Den</label>
							                        			</div>
							                        								                        			<div class="col-lg-4"><label class="form-group">
							                        				<input type="checkbox" name="home_cleaning_other_places[]" value="11"> Laundry</label>
							                        			</div>
							                        								                        </div>

							                    </div>
							                </div>
							            </div>
							            <div class="panel panel-default">
							                <div class="panel-heading">
							                    <h4 class="panel-title">
							                        <a data-toggle="collapse" data-parent="#accordion" href="#home_cleaning_services_collapse5" class="collapsed" aria-expanded="false">Additional Services</a>
							                    </h4>
							                </div>
							                <div id="home_cleaning_services_collapse5" class="panel-collapse collapse" aria-expanded="false">
							                    <div class="panel-body">
							                    	<div class="form-group">
							                    		<div class="col-lg-9"><label>Services</label></div>
							                    		<div class="col-lg-3"><label>Quantity</label></div>
							                    	</div>
							                    	<!-- Additional services list -->
							                    							                    			<div class="form-group">
							                        			<div class="col-lg-9 row"><label>Oven inside cleaned?</label></div>
							                        			<div class="col-lg-3 row"><input class="form-control" type="number" name="home_cleaning_additional_services[1]"></div>
							                        		</div>
							                    								                    			<div class="form-group">
							                        			<div class="col-lg-9 row"><label>Fridge inside cleaned?</label></div>
							                        			<div class="col-lg-3 row"><input class="form-control" type="number" name="home_cleaning_additional_services[2]"></div>
							                        		</div>
							                    								                    			<div class="form-group">
							                        			<div class="col-lg-9 row"><label>How many balconies woild you like to have swept?</label></div>
							                        			<div class="col-lg-3 row"><input class="form-control" type="number" name="home_cleaning_additional_services[3]"></div>
							                        		</div>
							                    								                    			<div class="form-group">
							                        			<div class="col-lg-9 row"><label>How many windows (interior) would you like to have washed?</label></div>
							                        			<div class="col-lg-3 row"><input class="form-control" type="number" name="home_cleaning_additional_services[4]"></div>
							                        		</div>
							                    								                    			<div class="form-group">
							                        			<div class="col-lg-9 row"><label>How many windows (exterior) would you like to have washed?</label></div>
							                        			<div class="col-lg-3 row"><input class="form-control" type="number" name="home_cleaning_additional_services[5]"></div>
							                        		</div>
							                    								                    			<div class="form-group">
							                        			<div class="col-lg-9 row"><label>Would you like wet wiping blinds? How many?</label></div>
							                        			<div class="col-lg-3 row"><input class="form-control" type="number" name="home_cleaning_additional_services[6]"></div>
							                        		</div>
							                    		
							                    	<div class="form-group">
								                        <label>Cleaning behind the refrigerator and stove?</label>
								                        <label class="form-group"><input type="radio" name="home_cleaning_behind_refrigerator_stove" value="1">Yes</label>
								                        <label class="form-group"><input type="radio" name="home_cleaning_behind_refrigerator_stove" value="0">No</label>
								                    </div>
								                    <div class="form-group">
								                        <label>Would you like baseboard to be washed?</label>
								                        <label class="form-group"><input type="radio" name="home_cleaning_baseboard" value="1">Yes</label>
								                        <label class="form-group"><input type="radio" name="home_cleaning_baseboard" value="0">No</label>
								                    </div>
							                    </div>
							                </div>
							            </div>
							            <div class="panel panel-default">
							                <div class="panel-heading">
							                    <h4 class="panel-title">
							                        <a data-toggle="collapse" data-parent="#accordion" href="#home_cleaning_services_collapse6" class="collapsed" aria-expanded="false">Call Me On</a>
							                    </h4>
							                </div>
							                <div id="home_cleaning_services_collapse6" class="panel-collapse collapse" aria-expanded="false">
							                    <div class="panel-body">
							                    	<div class="form-group">
							                        	<label>Primary Number:&nbsp;&nbsp;</label><span id="primary_no"></span>
							                        </div>
							                        <div class="form-group">
							                        	<label>Additional Number:&nbsp;&nbsp;</label><span id="secondary_no"></span>
							                        </div>
							                    </div>
							                </div>
							            </div>
							            <div class="panel panel-default">
							                <div class="panel-heading">
							                    <h4 class="panel-title">
							                        <a data-toggle="collapse" data-parent="#accordion" href="#home_cleaning_services_collapse7" class="collapsed" aria-expanded="false">Additional Information (If Any)</a>
							                    </h4>
							                </div>
							                <div id="home_cleaning_services_collapse7" class="panel-collapse collapse" aria-expanded="false">
							                    <div class="panel-body">
							                    	<div class="form-group">
							                        	<label>additional Information:&nbsp;&nbsp;</label><span id="additional_information"></span>
							                        </div>
							                    </div>
							                </div>
							            </div>
							        </div>

							        <div>
							        	<button type="submit" class="btn btn-info" name="btn_submit_home_cleaning_query" id="btn_submit_home_cleaning_query">Submit</button>
							        </div>
						    	</form>
							</div>
						</div>
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
								<form name="frm_cable_internet_services" id="frm_cable_internet_services" novalidate="novalidate">
							        <div class="panel-group" id="accordion_internet_service">
							            <div class="panel panel-default">
							                <div class="panel-heading">
							                    <h4 class="panel-title">
							                        <a data-toggle="collapse" data-parent="#accordion_internet_service" href="#cable_internet_services_collapse1" aria-expanded="false" class="collapsed">Moving From</a>
							                    </h4>
							                </div>
							                <div id="cable_internet_services_collapse1" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
							               		<div class="panel-body">
							                        <div class="form-group">
							                        	<label>Type:&nbsp;&nbsp;</label><span id="moving_from_house_type"></span>
							                        </div>
							                        <div class="form-group">
							                        	<label>Floor Level:&nbsp;&nbsp;</label><span id="moving_from_floor"></span>
							                        </div>
							                        <div class="form-group">
							                        	<label>No of bedrooms:&nbsp;&nbsp;</label><span id="moving_from_bedroom_count"></span>
							                        </div>
							                        <div class="form-group">
							                        	<label>Did you own or rent this property:&nbsp;&nbsp;</label><span id="moving_from_property_type"></span>
							                        </div>
							                    </div>
							                </div>
							            </div>
							            <div class="panel panel-default">
							                <div class="panel-heading">
							                    <h4 class="panel-title">
							                        <a data-toggle="collapse" data-parent="#accordion_internet_service" href="#cable_internet_services_collapse2" class="collapsed" aria-expanded="false">Moving To</a>
							                    </h4>
							                </div>
							                <div id="cable_internet_services_collapse2" class="panel-collapse collapse" aria-expanded="false">
							                	<div class="panel-body">
							                        <div class="form-group">
							                        	<label>Type:&nbsp;&nbsp;</label><span id="moving_to_house_type"></span>
							                        </div>
							                        <div class="form-group">
							                        	<label>Floor Level:&nbsp;&nbsp;</label><span id="moving_to_floor"></span>
							                        </div>
							                        <div class="form-group">
							                        	<label>No of bedrooms:&nbsp;&nbsp;</label><span id="moving_to_bedroom_count"></span>
							                        </div>
							                        <div class="form-group">
							                        	<label>Did you own or rent this property:&nbsp;&nbsp;</label><span id="moving_to_property_type"></span>
							                        </div>
							                    </div>
							                </div>
							            </div>
							            <div class="panel panel-default">
							                <div class="panel-heading">
							                    <h4 class="panel-title">
							                        <a data-toggle="collapse" data-parent="#accordion_internet_service" href="#cable_internet_services_collapse3" class="collapsed" aria-expanded="false">Detailed Job Description</a>
							                    </h4>
							                </div>
							                <div id="cable_internet_services_collapse3" class="panel-collapse collapse" aria-expanded="false">
							                    <div class="panel-body">
							                        <div class="form-group">
							                        	<label>Do you have cable &amp; internet service before:&nbsp;&nbsp;</label><span id="have_cable_internet_already"></span>
							                        </div>
							                        <div class="form-group">
							                        	<label>Employment Status:&nbsp;&nbsp;</label><span id="employment_status"></span>
							                        </div>

							                        <div class="form-group">
							                        	<label>What service(s) are applying for</label>
							                        	<br>
								                        							                        		<label> <input type="checkbox" name="cable_internet_service_type[]" class="cable_internet_service_types" value="1"> TV</label>
								                        								                        		<label> <input type="checkbox" name="cable_internet_service_type[]" class="cable_internet_service_types" value="2"> Internet</label>
								                        								                        		<label> <input type="checkbox" name="cable_internet_service_type[]" class="cable_internet_service_types" value="3"> Phone</label>
								                        								                        		<label> <input type="checkbox" name="cable_internet_service_type[]" class="cable_internet_service_types" value="4"> Fax</label>
								                        								                        		<label> <input type="checkbox" name="cable_internet_service_type[]" class="cable_internet_service_types" value="5"> Security system	</label>
								                        								                        <label id="cable_internet_service_type[]-error" class="error" for="cable_internet_service_type[]">Please select atleast one service</label>
							                        </div>

							                        <div class="form-group">
							                        	<label>Would you like to receive your bill electronically:&nbsp;&nbsp;</label><span id="want_to_receive_electronic_bill"></span>
							                        </div>
							                        <div class="form-group">
							                        	<label>Would you consider any contract plan:&nbsp;&nbsp;</label><span id="want_to_contract_plan"></span>
							                        </div>
							                        <div class="form-group">
							                        	<label>Would you want to setup pre-authorise payment:&nbsp;&nbsp;</label><span id="want_to_setup_preauthorise_payment"></span>
							                        </div>
							                        <div class="form-group">
							                        	<label>Callback option:&nbsp;&nbsp;</label><span id="callback_option"></span>
							                        </div>
							                        <div class="form-group">
							                        	<label></label>
							                        	<label>Call back time:&nbsp;&nbsp;</label><span id="callback_time"></span>
							                        </div>
							                        <div class="form-group">
							                        	<label>Call me on?</label><br />
							                        	<label>Primary Number:&nbsp;&nbsp;</label><span id="primary_no"></span><br />
							                        	<label>Additional Number:&nbsp;&nbsp;</label><span id="secondary_no"></span>
							                        </div>
							                    </div>
							                </div>
							            </div>
							            <div class="panel panel-default">
							                <div class="panel-heading">
							                    <h4 class="panel-title">
							                        <a data-toggle="collapse" data-parent="#accordion_internet_service" href="#cable_internet_services_collapse4" class="collapsed" aria-expanded="false">Additional Information</a>
							                    </h4>
							                </div>
							                <div id="cable_internet_services_collapse4" class="panel-collapse collapse" aria-expanded="false">
							                    <div class="panel-body">
							                        <div class="form-group">
							                        	<label></label>
							                        	<br>
								                        							                        		<div><label><input type="checkbox" name="cable_internet_additional_service[]" class="cable_internet_additional_service" value="1"> I would like to buy my equipment</label></div>
								                        								                        		<div><label><input type="checkbox" name="cable_internet_additional_service[]" class="cable_internet_additional_service" value="2"> I would like a special offer or promotion</label></div>
								                        								                        		<div><label><input type="checkbox" name="cable_internet_additional_service[]" class="cable_internet_additional_service" value="3"> I like to book a tech today</label></div>
								                        								                        		<div><label><input type="checkbox" name="cable_internet_additional_service[]" class="cable_internet_additional_service" value="4"> I like to get special promotion emails</label></div>
								                        							                        </div>
							                    </div>
							                    <div class="panel-body">
							                    	<label>additional Information:&nbsp;&nbsp;</label><span id="additional_information"></span>
							                    </div>
							                </div>
							            </div>
							        </div>

							        <div>
							        	<button type="submit" class="btn btn-info" name="btn_cable_internet_submit_query" id="btn_cable_internet_submit_query">Submit</button>
							        </div>
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
								<form name="frm_tech_concierge" id="frm_tech_concierge" autocomplete="off" novalidate="novalidate">
							        <div class="panel-group" id="accordion_concierge">
							            <div class="panel panel-default">
							                <div class="panel-heading">
							                    <h4 class="panel-title">
							                        <a data-toggle="collapse" data-parent="#accordion_concierge" href="#tech_concierge_collapse2" aria-expanded="false" class="collapsed">Moving To</a>
							                    </h4>
							                </div>
							                <div id="tech_concierge_collapse2" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
							                	<div class="panel-body">
							                        <div class="form-group">
							                        	<label>Type:&nbsp;&nbsp;</label><span id="moving_from_house_type"></span>
							                        </div>
							                        <div class="form-group">
							                        	<label>Floor Level:&nbsp;&nbsp;</label><span id="moving_from_floor"></span>
							                        </div>
							                        <div class="form-group">
							                        	<label>No of bedrooms:&nbsp;&nbsp;</label><span id="moving_from_bedroom_count"></span>
							                        </div>
							                        <div class="form-group">
							                        	<label>Did you own or rent this property:&nbsp;&nbsp;</label><span id="moving_from_property_type"></span>
							                        </div>
							                    </div>
							                </div>
							            </div>
							            <div class="panel panel-default">
							                <div class="panel-heading">
							                    <h4 class="panel-title">
							                        <a data-toggle="collapse" data-parent="#accordion_concierge" href="#tech_concierge_collapse3" class="collapsed" aria-expanded="false">Other Places to install appliances in</a>
							                    </h4>
							                </div>
							                <div id="tech_concierge_collapse3" class="panel-collapse collapse" aria-expanded="false">
							                    <div class="panel-body">
							                        <div class="form-group">
							                        	<label>Other place to install appliances in</label>
							                        	<div>
								                        								                        			<div class="col-lg-4 col-md-2 col-sm-1">
								                        				<label class="form-group">
								                        					<input type="checkbox" name="tech_concierge_places[]" value="3"> Basement
								                        				</label>
								                        			</div>
								                        									                        			<div class="col-lg-4 col-md-2 col-sm-1">
								                        				<label class="form-group">
								                        					<input type="checkbox" name="tech_concierge_places[]" value="2"> Bed Room(s)
								                        				</label>
								                        			</div>
								                        									                        			<div class="col-lg-4 col-md-2 col-sm-1">
								                        				<label class="form-group">
								                        					<input type="checkbox" name="tech_concierge_places[]" value="4"> Kitchen
								                        				</label>
								                        			</div>
								                        									                        			<div class="col-lg-4 col-md-2 col-sm-1">
								                        				<label class="form-group">
								                        					<input type="checkbox" name="tech_concierge_places[]" value="1"> Living Room
								                        				</label>
								                        			</div>
								                        									                        			<div class="col-lg-4 col-md-2 col-sm-1">
								                        				<label class="form-group">
								                        					<input type="checkbox" name="tech_concierge_places[]" value="5"> Office Room
								                        				</label>
								                        			</div>
								                        									                        			<div class="col-lg-4 col-md-2 col-sm-1">
								                        				<label class="form-group">
								                        					<input type="checkbox" name="tech_concierge_places[]" value="6"> Recreation Room
								                        				</label>
								                        			</div>
								                        								                        	</div>
							                        </div>
							                    </div>
							                </div>
							            </div>
							            <div class="panel panel-default">
							                <div class="panel-heading">
							                    <h4 class="panel-title">
							                        <a data-toggle="collapse" data-parent="#accordion_concierge" href="#tech_concierge_collapse4" class="collapsed" aria-expanded="false">Job description</a>
							                    </h4>
							                </div>
							                <div id="tech_concierge_collapse4" class="panel-collapse collapse" aria-expanded="false">
							                    <div class="panel-body">
							                        <div class="form-group">
							                        	<label>Which of these appliances you plan to install</label>
							                        	<div>
								                        								                        			<div class="col-lg-4 col-md-2 col-sm-1">
								                        				<label class="form-group">
								                        					<input type="checkbox" name="tech_concierge_appliances[]" value="3"> Dish Washer
								                        				</label>
								                        			</div>
								                        									                        			<div class="col-lg-4 col-md-2 col-sm-1">
								                        				<label class="form-group">
								                        					<input type="checkbox" name="tech_concierge_appliances[]" value="1"> Fridge
								                        				</label>
								                        			</div>
								                        									                        			<div class="col-lg-4 col-md-2 col-sm-1">
								                        				<label class="form-group">
								                        					<input type="checkbox" name="tech_concierge_appliances[]" value="6"> Home Theatre
								                        				</label>
								                        			</div>
								                        									                        			<div class="col-lg-4 col-md-2 col-sm-1">
								                        				<label class="form-group">
								                        					<input type="checkbox" name="tech_concierge_appliances[]" value="2"> Oven / Otr
								                        				</label>
								                        			</div>
								                        									                        			<div class="col-lg-4 col-md-2 col-sm-1">
								                        				<label class="form-group">
								                        					<input type="checkbox" name="tech_concierge_appliances[]" value="7"> Security System
								                        				</label>
								                        			</div>
								                        									                        			<div class="col-lg-4 col-md-2 col-sm-1">
								                        				<label class="form-group">
								                        					<input type="checkbox" name="tech_concierge_appliances[]" value="5"> Tv
								                        				</label>
								                        			</div>
								                        									                        			<div class="col-lg-4 col-md-2 col-sm-1">
								                        				<label class="form-group">
								                        					<input type="checkbox" name="tech_concierge_appliances[]" value="4"> Washer &amp; Dryer
								                        				</label>
								                        			</div>
								                        								                        	</div>
							                        </div>
							                    </div>
							                </div>
							            </div>
							            <div class="panel panel-default">
							                <div class="panel-heading">
							                    <h4 class="panel-title">
							                        <a data-toggle="collapse" data-parent="#accordion_concierge" href="#tech_concierge_collapse5" class="collapsed" aria-expanded="false">Other details about the job</a>
							                    </h4>
							                </div>
							                <div id="tech_concierge_collapse5" class="panel-collapse collapse" aria-expanded="false">
							                    <div class="panel-body">
							                        <div class="form-group">
							                        							                        			<div class="">
							                        				Do You Have Water Connection Ready For Fridge?
							                        				<label> <input type="radio" name="tech_concierge_details[1]" value="1"> Yes</label>
							                        				<label> <input type="radio" name="tech_concierge_details[1]" value="0"> No</label>
							                        			</div>
							                        								                        			<div class="">
							                        				Do You Have Water Connection Ready For Dish Washer?
							                        				<label> <input type="radio" name="tech_concierge_details[2]" value="1"> Yes</label>
							                        				<label> <input type="radio" name="tech_concierge_details[2]" value="0"> No</label>
							                        			</div>
							                        								                        			<div class="">
							                        				Do You Have Water Connection Ready For Laundry?
							                        				<label> <input type="radio" name="tech_concierge_details[3]" value="1"> Yes</label>
							                        				<label> <input type="radio" name="tech_concierge_details[3]" value="0"> No</label>
							                        			</div>
							                        								                        			<div class="">
							                        				Do You Have To Mount Tv On Brackets?
							                        				<label> <input type="radio" name="tech_concierge_details[4]" value="1"> Yes</label>
							                        				<label> <input type="radio" name="tech_concierge_details[4]" value="0"> No</label>
							                        			</div>
							                        								                        			<div class="">
							                        				Do You Have To Bore Hole For Over The Range Oven?
							                        				<label> <input type="radio" name="tech_concierge_details[5]" value="1"> Yes</label>
							                        				<label> <input type="radio" name="tech_concierge_details[5]" value="0"> No</label>
							                        			</div>
							                        								                        			<div class="">
							                        				Do You Have Installations Kit For Laundry Machines?
							                        				<label> <input type="radio" name="tech_concierge_details[6]" value="1"> Yes</label>
							                        				<label> <input type="radio" name="tech_concierge_details[6]" value="0"> No</label>
							                        			</div>
							                        								                        			<div class="">
							                        				Do You Have All Installation Pipe Ready For Fridge?
							                        				<label> <input type="radio" name="tech_concierge_details[7]" value="1"> Yes</label>
							                        				<label> <input type="radio" name="tech_concierge_details[7]" value="0"> No</label>
							                        			</div>
							                        								                        			<div class="">
							                        				Are All The Appliances Moved In And Ready For Installations?
							                        				<label> <input type="radio" name="tech_concierge_details[8]" value="1"> Yes</label>
							                        				<label> <input type="radio" name="tech_concierge_details[8]" value="0"> No</label>
							                        			</div>
							                        								                        </div>
							                    </div>
							                </div>
							            </div>
							            <div class="panel panel-default">
							                <div class="panel-heading">
							                    <h4 class="panel-title">
							                        <a data-toggle="collapse" data-parent="#accordion_concierge" href="#tech_concierge_collapse6" class="collapsed" aria-expanded="false">Availability</a>
							                    </h4>
							                </div>
							                <div id="tech_concierge_collapse6" class="panel-collapse collapse" aria-expanded="false">
							              		<div class="panel-body">
							                        <div class="form-group">
							                        	<label>Day1:&nbsp;&nbsp;</label><span id="availability_date1"></span>&nbsp;&nbsp;<span id="availability_time_from1"></span>&nbsp;&nbsp;<span id="availability_time_upto1"></span>
							                        </div>
							                        <div class="form-group">
							                        	<label>Day2:&nbsp;&nbsp;</label><span id="availability_date2"></span>&nbsp;&nbsp;<span id="availability_time_from2"></span>&nbsp;&nbsp;<span id="availability_time_upto2"></span>
							                        </div>
							                        <div class="form-group">
							                        	<label>Day3:&nbsp;&nbsp;</label><span id="availability_date3"></span>&nbsp;&nbsp;<span id="availability_time_from2"></span>&nbsp;&nbsp;<span id="availability_time_upto3"></span>
							                        </div>
							                    </div>
							                </div>
							            </div>
							            <div class="panel panel-default">
							                <div class="panel-heading">
							                    <h4 class="panel-title">
							                        <a data-toggle="collapse" data-parent="#accordion_concierge" href="#tech_concierge_collapse7" class="collapsed" aria-expanded="false">Call me on</a>
							                    </h4>
							                </div>
							                <div id="tech_concierge_collapse7" class="panel-collapse collapse" aria-expanded="false">
							                	<div class="panel-body">
							                    	<div class="form-group">
							                        	<label>Primary Number:&nbsp;&nbsp;</label><span id="primary_no"></span>
							                        </div>
							                        <div class="form-group">
							                        	<label>Additional Number:&nbsp;&nbsp;</label><span id="secondary_no"></span>
							                        </div>
							                    </div>
							                </div>
							            </div>
							            <div class="panel panel-default">
							                <div class="panel-heading">
							                    <h4 class="panel-title">
							                        <a data-toggle="collapse" data-parent="#accordion_concierge" href="#tech_concierge_collapse8" class="collapsed" aria-expanded="false">Additional Information</a>
							                    </h4>
							                </div>
							                <div id="tech_concierge_collapse8" class="panel-collapse collapse" aria-expanded="false">
							                    <div class="panel-body">
							                    	<div class="form-group">
							                        	<label>additional Information:&nbsp;&nbsp;</label><span id="additional_information"></span>
							                        </div>
							                    </div>
							                </div>
							            </div>
							        </div>

							        <div>
							        	<button type="submit" class="btn btn-info" name="btn_submit_tech_concierge_query" id="btn_submit_tech_concierge_query">Submit</button>
							        </div>
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
								<form name="frm_home_moving_companies" id="frm_home_moving_companies" autocomplete="off" novalidate="novalidate">
							        <div class="panel-group" id="accordion_home_moving_companies">
							        	<div class="panel panel-default">
							                <div class="panel-heading">
							                    <h4 class="panel-title">
							                        <a data-toggle="collapse" data-parent="#accordion_home_moving_companies" href="#home_moving_companies_collapse3" aria-expanded="false" class="collapsed">Moving From</a>
							                    </h4>
							                </div>
							                <div id="home_moving_companies_collapse3" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
							                	<div class="panel-body">
							                        <div class="form-group">
							                        	<label>Type:&nbsp;&nbsp;</label><span id="moving_from_house_type"></span>
							                        </div>
							                        <div class="form-group">
							                        	<label>Floor Level:&nbsp;&nbsp;</label><span id="moving_from_floor"></span>
							                        </div>
							                        <div class="form-group">
							                        	<label>No of bedrooms:&nbsp;&nbsp;</label><span id="moving_from_bedroom_count"></span>
							                        </div>
							                        <div class="form-group">
							                        	<label>Did you own or rent this property:&nbsp;&nbsp;</label><span id="moving_from_property_type"></span>
							                        </div>
							                    </div>
							                </div>
							            </div>
							            <div class="panel panel-default">
							                <div class="panel-heading">
							                    <h4 class="panel-title">
							                        <a data-toggle="collapse" data-parent="#accordion_home_moving_companies" href="#home_moving_companies_collapse2" class="collapsed" aria-expanded="false">Moving To</a>
							                    </h4>
							                </div>
							                <div id="home_moving_companies_collapse2" class="panel-collapse collapse" aria-expanded="false">
							                	<div class="panel-body">
							                        <div class="form-group">
							                        	<label>Type:&nbsp;&nbsp;</label><span id="moving_to_house_type"></span>
							                        </div>
							                        <div class="form-group">
							                        	<label>Floor Level:&nbsp;&nbsp;</label><span id="moving_to_floor"></span>
							                        </div>
							                        <div class="form-group">
							                        	<label>No of bedrooms:&nbsp;&nbsp;</label><span id="moving_to_bedroom_count"></span>
							                        </div>
							                        <div class="form-group">
							                        	<label>Did you own or rent this property:&nbsp;&nbsp;</label><span id="moving_to_property_type"></span>
							                        </div>
							                    </div>
							                </div>
							            </div>
							            
							            <div class="panel panel-default">
							                <div class="panel-heading">
							                    <h4 class="panel-title">
							                        <a data-toggle="collapse" data-parent="#accordion_home_moving_companies" href="#home_moving_companies_collapse4" class="collapsed" aria-expanded="false">Detailed Job Description</a>
							                    </h4>
							                </div>
							                <div id="home_moving_companies_collapse4" class="panel-collapse collapse" aria-expanded="false">
							                    <div class="panel-body">
							                    							                    			<div class="form-group">
							                        			<!-- Collapse Title -->
							                        			<div><label><a data-toggle="collapse" href="#collapse1">Living Room</a></label></div>

							                        			<!-- Collapse Body -->
							                        			<div id="collapse1" class="panel-collapse collapse">
							                        				<div>
								                        				<div class="col-sm-6 col-md-6 col-lg-6"><strong>Item</strong></div>
								                        				<div class="col-sm-4 col-md-4 col-lg-4"><strong>Weight</strong></div>
								                        				<div class="col-sm-2 col-md-2 col-lg-2"><strong>Quantity</strong></div>
							                        				</div>
								                        										                        						<div class="col-sm-6 col-md-6 col-lg-6">Piano</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">600 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[1]" value="">
								                        						</div>
								                        												                        						<div class="col-sm-6 col-md-6 col-lg-6">Bookcase</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">120 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[2]" value="">
								                        						</div>
								                        												                        						<div class="col-sm-6 col-md-6 col-lg-6">Bookshelf</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">70 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[3]" value="">
								                        						</div>
								                        												                        						<div class="col-sm-6 col-md-6 col-lg-6">Small Bookshelf</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">40 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[4]" value="">
								                        						</div>
								                        												                        						<div class="col-sm-6 col-md-6 col-lg-6">Chair - Arm</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">50 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[5]" value="">
								                        						</div>
								                        												                        						<div class="col-sm-6 col-md-6 col-lg-6">Chair - Overstuffed</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">150 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[6]" value="">
								                        						</div>
								                        												                        						<div class="col-sm-6 col-md-6 col-lg-6">Chair - Rocker</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">60 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[7]" value="">
								                        						</div>
								                        												                        						<div class="col-sm-6 col-md-6 col-lg-6">Aquarium</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">80 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[8]" value="">
								                        						</div>
								                        												                        						<div class="col-sm-6 col-md-6 col-lg-6">Desk + Chair (sm)</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">100 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[9]" value="">
								                        						</div>
								                        												                        						<div class="col-sm-6 col-md-6 col-lg-6">Desk + Chair (lg)</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">200 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[10]" value="">
								                        						</div>
								                        												                        						<div class="col-sm-6 col-md-6 col-lg-6">Fireplace Equipment</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">35 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[11]" value="">
								                        						</div>
								                        												                        						<div class="col-sm-6 col-md-6 col-lg-6">Fireplace</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">100 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[12]" value="">
								                        						</div>
								                        												                        						<div class="col-sm-6 col-md-6 col-lg-6">Lamp - Floor</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">15 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[13]" value="">
								                        						</div>
								                        												                        						<div class="col-sm-6 col-md-6 col-lg-6">Footstool</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">35 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[14]" value="">
								                        						</div>
								                        												                        						<div class="col-sm-6 col-md-6 col-lg-6">Mirror</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">40 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[15]" value="">
								                        						</div>
								                        												                        						<div class="col-sm-6 col-md-6 col-lg-6">Clock - Grandfather</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">160 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[16]" value="">
								                        						</div>
								                        												                        						<div class="col-sm-6 col-md-6 col-lg-6">Rug or Pad (sm)</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">30 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[17]" value="">
								                        						</div>
								                        												                        						<div class="col-sm-6 col-md-6 col-lg-6">Rug or Pad (lg)</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">60 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[18]" value="">
								                        						</div>
								                        												                        						<div class="col-sm-6 col-md-6 col-lg-6">Sofa - Loveseat</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">200 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[19]" value="">
								                        						</div>
								                        												                        						<div class="col-sm-6 col-md-6 col-lg-6">Sofa - 3 Cushion</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">250 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[20]" value="">
								                        						</div>
								                        												                        						<div class="col-sm-6 col-md-6 col-lg-6">Sofa - Hidabed</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">300 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[21]" value="">
								                        						</div>
								                        												                        						<div class="col-sm-6 col-md-6 col-lg-6">Tables - Sofa</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">60 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[22]" value="">
								                        						</div>
								                        												                        						<div class="col-sm-6 col-md-6 col-lg-6">Tables - End</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">35 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[23]" value="">
								                        						</div>
								                        												                        						<div class="col-sm-6 col-md-6 col-lg-6">Tables - Coffee</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">60 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[24]" value="">
								                        						</div>
								                        											                        			</div>
							                        		</div>
							                        		<div class="clearfix"></div>
							                    								                    			<div class="form-group">
							                        			<!-- Collapse Title -->
							                        			<div><label><a data-toggle="collapse" href="#collapse2">Dining Room</a></label></div>

							                        			<!-- Collapse Body -->
							                        			<div id="collapse2" class="panel-collapse collapse">
							                        				<div>
								                        				<div class="col-sm-6 col-md-6 col-lg-6"><strong>Item</strong></div>
								                        				<div class="col-sm-4 col-md-4 col-lg-4"><strong>Weight</strong></div>
								                        				<div class="col-sm-2 col-md-2 col-lg-2"><strong>Quantity</strong></div>
							                        				</div>
								                        										                        						<div class="col-sm-6 col-md-6 col-lg-6">Buffet</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">200 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[25]" value="">
								                        						</div>
								                        												                        						<div class="col-sm-6 col-md-6 col-lg-6">Cabinet - China 1 pc</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">150 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[26]" value="">
								                        						</div>
								                        												                        						<div class="col-sm-6 col-md-6 col-lg-6">Cabinet - Corner</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">125 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[27]" value="">
								                        						</div>
								                        												                        						<div class="col-sm-6 col-md-6 col-lg-6">Chair - Arm</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">50 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[28]" value="">
								                        						</div>
								                        												                        						<div class="col-sm-6 col-md-6 col-lg-6">Chair - Straight</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">30 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[29]" value="">
								                        						</div>
								                        												                        						<div class="col-sm-6 col-md-6 col-lg-6">Hutch (top)</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">125 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[30]" value="">
								                        						</div>
								                        												                        						<div class="col-sm-6 col-md-6 col-lg-6">Server / Tea Cart</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">50 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[31]" value="">
								                        						</div>
								                        												                        						<div class="col-sm-6 col-md-6 col-lg-6">Table - Dining</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">100 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[32]" value="">
								                        						</div>
								                        												                        						<div class="col-sm-6 col-md-6 col-lg-6">Table - Extension</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">175 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[33]" value="">
								                        						</div>
								                        											                        			</div>
							                        		</div>
							                        		<div class="clearfix"></div>
							                    								                    			<div class="form-group">
							                        			<!-- Collapse Title -->
							                        			<div><label><a data-toggle="collapse" href="#collapse3">Bedroom(s)</a></label></div>

							                        			<!-- Collapse Body -->
							                        			<div id="collapse3" class="panel-collapse collapse">
							                        				<div>
								                        				<div class="col-sm-6 col-md-6 col-lg-6"><strong>Item</strong></div>
								                        				<div class="col-sm-4 col-md-4 col-lg-4"><strong>Weight</strong></div>
								                        				<div class="col-sm-2 col-md-2 col-lg-2"><strong>Quantity</strong></div>
							                        				</div>
								                        										                        						<div class="col-sm-6 col-md-6 col-lg-6">King Bed</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">400 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[34]" value="">
								                        						</div>
								                        												                        						<div class="col-sm-6 col-md-6 col-lg-6">Captain Bed</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">400 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[35]" value="">
								                        						</div>
								                        												                        						<div class="col-sm-6 col-md-6 col-lg-6">Queen Bed</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">350 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[36]" value="">
								                        						</div>
								                        												                        						<div class="col-sm-6 col-md-6 col-lg-6">Double Bed</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">325 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[37]" value="">
								                        						</div>
								                        												                        						<div class="col-sm-6 col-md-6 col-lg-6">Single Bed</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">200 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[38]" value="">
								                        						</div>
								                        												                        						<div class="col-sm-6 col-md-6 col-lg-6">Water Bed</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">350 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[39]" value="">
								                        						</div>
								                        												                        						<div class="col-sm-6 col-md-6 col-lg-6">Dresser - Single - Vanity</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">125 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[40]" value="">
								                        						</div>
								                        												                        						<div class="col-sm-6 col-md-6 col-lg-6">Dresser - Double - Mirror</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">200 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[41]" value="">
								                        						</div>
								                        												                        						<div class="col-sm-6 col-md-6 col-lg-6">Dresser - Triple - Mirror</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">250 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[42]" value="">
								                        						</div>
								                        												                        						<div class="col-sm-6 col-md-6 col-lg-6">Cedar Chest</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">80 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[43]" value="">
								                        						</div>
								                        												                        						<div class="col-sm-6 col-md-6 col-lg-6">Armoire / Highboy</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">200 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[44]" value="">
								                        						</div>
								                        												                        						<div class="col-sm-6 col-md-6 col-lg-6">Night Table</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">30 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[45]" value="">
								                        						</div>
								                        												                        						<div class="col-sm-6 col-md-6 col-lg-6">Wardrobe (sm)</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">200 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[46]" value="">
								                        						</div>
								                        												                        						<div class="col-sm-6 col-md-6 col-lg-6">Wardrobe (lg)</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">300 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[47]" value="">
								                        						</div>
								                        											                        			</div>
							                        		</div>
							                        		<div class="clearfix"></div>
							                    								                    			<div class="form-group">
							                        			<!-- Collapse Title -->
							                        			<div><label><a data-toggle="collapse" href="#collapse4">Nursery</a></label></div>

							                        			<!-- Collapse Body -->
							                        			<div id="collapse4" class="panel-collapse collapse">
							                        				<div>
								                        				<div class="col-sm-6 col-md-6 col-lg-6"><strong>Item</strong></div>
								                        				<div class="col-sm-4 col-md-4 col-lg-4"><strong>Weight</strong></div>
								                        				<div class="col-sm-2 col-md-2 col-lg-2"><strong>Quantity</strong></div>
							                        				</div>
								                        										                        						<div class="col-sm-6 col-md-6 col-lg-6">Car Seat</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">30 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[48]" value="">
								                        						</div>
								                        												                        						<div class="col-sm-6 col-md-6 col-lg-6">Change Table</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">40 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[49]" value="">
								                        						</div>
								                        												                        						<div class="col-sm-6 col-md-6 col-lg-6">Crib</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">70 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[50]" value="">
								                        						</div>
								                        												                        						<div class="col-sm-6 col-md-6 col-lg-6">High Chair</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">35 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[51]" value="">
								                        						</div>
								                        												                        						<div class="col-sm-6 col-md-6 col-lg-6">Large Toys</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">50 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[52]" value="">
								                        						</div>
								                        												                        						<div class="col-sm-6 col-md-6 col-lg-6">Play Pen</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">30 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[53]" value="">
								                        						</div>
								                        												                        						<div class="col-sm-6 col-md-6 col-lg-6">Stroller</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">30 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[54]" value="">
								                        						</div>
								                        											                        			</div>
							                        		</div>
							                        		<div class="clearfix"></div>
							                    								                    			<div class="form-group">
							                        			<!-- Collapse Title -->
							                        			<div><label><a data-toggle="collapse" href="#collapse5">Kitchen</a></label></div>

							                        			<!-- Collapse Body -->
							                        			<div id="collapse5" class="panel-collapse collapse">
							                        				<div>
								                        				<div class="col-sm-6 col-md-6 col-lg-6"><strong>Item</strong></div>
								                        				<div class="col-sm-4 col-md-4 col-lg-4"><strong>Weight</strong></div>
								                        				<div class="col-sm-2 col-md-2 col-lg-2"><strong>Quantity</strong></div>
							                        				</div>
								                        										                        						<div class="col-sm-6 col-md-6 col-lg-6">Bakers Rack</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">60 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[55]" value="">
								                        						</div>
								                        												                        						<div class="col-sm-6 col-md-6 col-lg-6">Chair(s)</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">30 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[56]" value="">
								                        						</div>
								                        												                        						<div class="col-sm-6 col-md-6 col-lg-6">Ironing Board</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">10 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[57]" value="">
								                        						</div>
								                        												                        						<div class="col-sm-6 col-md-6 col-lg-6">Kitchen Cupboard</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">125 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[58]" value="">
								                        						</div>
								                        												                        						<div class="col-sm-6 col-md-6 col-lg-6">Microwave</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">50 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[59]" value="">
								                        						</div>
								                        												                        						<div class="col-sm-6 col-md-6 col-lg-6">Stool(s)</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">15 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[60]" value="">
								                        						</div>
								                        												                        						<div class="col-sm-6 col-md-6 col-lg-6">Table - 4 or less</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">60 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[61]" value="">
								                        						</div>
								                        												                        						<div class="col-sm-6 col-md-6 col-lg-6">Table - 5-6</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">80 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[62]" value="">
								                        						</div>
								                        												                        						<div class="col-sm-6 col-md-6 col-lg-6">T.V. Tables</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">40 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[63]" value="">
								                        						</div>
								                        											                        			</div>
							                        		</div>
							                        		<div class="clearfix"></div>
							                    								                    			<div class="form-group">
							                        			<!-- Collapse Title -->
							                        			<div><label><a data-toggle="collapse" href="#collapse6">Appliances</a></label></div>

							                        			<!-- Collapse Body -->
							                        			<div id="collapse6" class="panel-collapse collapse">
							                        				<div>
								                        				<div class="col-sm-6 col-md-6 col-lg-6"><strong>Item</strong></div>
								                        				<div class="col-sm-4 col-md-4 col-lg-4"><strong>Weight</strong></div>
								                        				<div class="col-sm-2 col-md-2 col-lg-2"><strong>Quantity</strong></div>
							                        				</div>
								                        										                        						<div class="col-sm-6 col-md-6 col-lg-6">Water Cooler</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">75 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[64]" value="">
								                        						</div>
								                        												                        						<div class="col-sm-6 col-md-6 col-lg-6">Dehumidifier / Humidifier</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">50 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[65]" value="">
								                        						</div>
								                        												                        						<div class="col-sm-6 col-md-6 col-lg-6">Air Conditioner</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">100 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[66]" value="">
								                        						</div>
								                        												                        						<div class="col-sm-6 col-md-6 col-lg-6">Freezer - 10 or less</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">225 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[67]" value="">
								                        						</div>
								                        												                        						<div class="col-sm-6 col-md-6 col-lg-6">Freezer - 11-15</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">300 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[68]" value="">
								                        						</div>
								                        												                        						<div class="col-sm-6 col-md-6 col-lg-6">Freezer - 16 + over</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">400 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[69]" value="">
								                        						</div>
								                        												                        						<div class="col-sm-6 col-md-6 col-lg-6">Microwave Stand</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">70 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[70]" value="">
								                        						</div>
								                        												                        						<div class="col-sm-6 col-md-6 col-lg-6">Range</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">200 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[71]" value="">
								                        						</div>
								                        												                        						<div class="col-sm-6 col-md-6 col-lg-6">Refrigerator - 6 or less</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">150 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[72]" value="">
								                        						</div>
								                        												                        						<div class="col-sm-6 col-md-6 col-lg-6">Refrigerator - 7-10</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">225 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[73]" value="">
								                        						</div>
								                        												                        						<div class="col-sm-6 col-md-6 col-lg-6">Refrigerator - 11 + over</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">325 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[74]" value="">
								                        						</div>
								                        												                        						<div class="col-sm-6 col-md-6 col-lg-6">Sewing Machine - Cabinet</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">90 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[75]" value="">
								                        						</div>
								                        												                        						<div class="col-sm-6 col-md-6 col-lg-6">Sewing Machine - Portable</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">50 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[76]" value="">
								                        						</div>
								                        												                        						<div class="col-sm-6 col-md-6 col-lg-6">Dishwasher</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">200 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[77]" value="">
								                        						</div>
								                        												                        						<div class="col-sm-6 col-md-6 col-lg-6">Dehumidifier / Humidifier</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">200 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[78]" value="">
								                        						</div>
								                        												                        						<div class="col-sm-6 col-md-6 col-lg-6">Washing Machine</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">175 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[79]" value="">
								                        						</div>
								                        												                        						<div class="col-sm-6 col-md-6 col-lg-6">Dryer</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">175 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[80]" value="">
								                        						</div>
								                        											                        			</div>
							                        		</div>
							                        		<div class="clearfix"></div>
							                    								                    			<div class="form-group">
							                        			<!-- Collapse Title -->
							                        			<div><label><a data-toggle="collapse" href="#collapse7">Electronics</a></label></div>

							                        			<!-- Collapse Body -->
							                        			<div id="collapse7" class="panel-collapse collapse">
							                        				<div>
								                        				<div class="col-sm-6 col-md-6 col-lg-6"><strong>Item</strong></div>
								                        				<div class="col-sm-4 col-md-4 col-lg-4"><strong>Weight</strong></div>
								                        				<div class="col-sm-2 col-md-2 col-lg-2"><strong>Quantity</strong></div>
							                        				</div>
								                        										                        						<div class="col-sm-6 col-md-6 col-lg-6">Entertainment Centre</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">150 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[81]" value="">
								                        						</div>
								                        												                        						<div class="col-sm-6 col-md-6 col-lg-6">Computer System</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">100 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[82]" value="">
								                        						</div>
								                        												                        						<div class="col-sm-6 col-md-6 col-lg-6">Speaker(s) (ea)</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">30 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[83]" value="">
								                        						</div>
								                        												                        						<div class="col-sm-6 col-md-6 col-lg-6">Stereo Component (ea)</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">25 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[84]" value="">
								                        						</div>
								                        												                        						<div class="col-sm-6 col-md-6 col-lg-6">Stereo Stand</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">80 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[85]" value="">
								                        						</div>
								                        												                        						<div class="col-sm-6 col-md-6 col-lg-6">T.V. Lg Screen</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">150 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[86]" value="">
								                        						</div>
								                        												                        						<div class="col-sm-6 col-md-6 col-lg-6">T.V. Flat Screen</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">80 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[87]" value="">
								                        						</div>
								                        												                        						<div class="col-sm-6 col-md-6 col-lg-6">T.V. Stand</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">60 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[88]" value="">
								                        						</div>
								                        												                        						<div class="col-sm-6 col-md-6 col-lg-6">CD Rack</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">20 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[89]" value="">
								                        						</div>
								                        											                        			</div>
							                        		</div>
							                        		<div class="clearfix"></div>
							                    								                    			<div class="form-group">
							                        			<!-- Collapse Title -->
							                        			<div><label><a data-toggle="collapse" href="#collapse8">Patio</a></label></div>

							                        			<!-- Collapse Body -->
							                        			<div id="collapse8" class="panel-collapse collapse">
							                        				<div>
								                        				<div class="col-sm-6 col-md-6 col-lg-6"><strong>Item</strong></div>
								                        				<div class="col-sm-4 col-md-4 col-lg-4"><strong>Weight</strong></div>
								                        				<div class="col-sm-2 col-md-2 col-lg-2"><strong>Quantity</strong></div>
							                        				</div>
								                        										                        						<div class="col-sm-6 col-md-6 col-lg-6">BBQ</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">100 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[90]" value="">
								                        						</div>
								                        												                        						<div class="col-sm-6 col-md-6 col-lg-6">Chair(s) - Lawn (ea)</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">20 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[91]" value="">
								                        						</div>
								                        												                        						<div class="col-sm-6 col-md-6 col-lg-6">Lawn Mower</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">100 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[92]" value="">
								                        						</div>
								                        												                        						<div class="col-sm-6 col-md-6 col-lg-6">Ladder - Step</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">30 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[93]" value="">
								                        						</div>
								                        												                        						<div class="col-sm-6 col-md-6 col-lg-6">Snow Blower</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">150 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[94]" value="">
								                        						</div>
								                        											                        			</div>
							                        		</div>
							                        		<div class="clearfix"></div>
							                    								                    			<div class="form-group">
							                        			<!-- Collapse Title -->
							                        			<div><label><a data-toggle="collapse" href="#collapse9">Miscellaneous</a></label></div>

							                        			<!-- Collapse Body -->
							                        			<div id="collapse9" class="panel-collapse collapse">
							                        				<div>
								                        				<div class="col-sm-6 col-md-6 col-lg-6"><strong>Item</strong></div>
								                        				<div class="col-sm-4 col-md-4 col-lg-4"><strong>Weight</strong></div>
								                        				<div class="col-sm-2 col-md-2 col-lg-2"><strong>Quantity</strong></div>
							                        				</div>
								                        										                        						<div class="col-sm-6 col-md-6 col-lg-6">Trash Cans</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">20 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[95]" value="">
								                        						</div>
								                        												                        						<div class="col-sm-6 col-md-6 col-lg-6">Bicycle</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">40 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[96]" value="">
								                        						</div>
								                        												                        						<div class="col-sm-6 col-md-6 col-lg-6">Treadmill</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">225 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[97]" value="">
								                        						</div>
								                        												                        						<div class="col-sm-6 col-md-6 col-lg-6">Exercise Bike</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">100 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[98]" value="">
								                        						</div>
								                        												                        						<div class="col-sm-6 col-md-6 col-lg-6">Exercise Machine</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">150 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[99]" value="">
								                        						</div>
								                        												                        						<div class="col-sm-6 col-md-6 col-lg-6">Filing Cabinet - 2 Drawer</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">50 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[100]" value="">
								                        						</div>
								                        												                        						<div class="col-sm-6 col-md-6 col-lg-6">Filing Cabinet - 4 Drawer</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">125 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[101]" value="">
								                        						</div>
								                        												                        						<div class="col-sm-6 col-md-6 col-lg-6">Hamper</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">15 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[102]" value="">
								                        						</div>
								                        												                        						<div class="col-sm-6 col-md-6 col-lg-6">Heater - Gas/Electric</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">20 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[103]" value="">
								                        						</div>
								                        												                        						<div class="col-sm-6 col-md-6 col-lg-6">Fan</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">15 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[104]" value="">
								                        						</div>
								                        												                        						<div class="col-sm-6 col-md-6 col-lg-6">Suitcase(s)</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">40 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[105]" value="">
								                        						</div>
								                        												                        						<div class="col-sm-6 col-md-6 col-lg-6">Patio Table / 6 Chairs / Umbrella</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">150 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[106]" value="">
								                        						</div>
								                        												                        						<div class="col-sm-6 col-md-6 col-lg-6">Patio Bench</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">80 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[107]" value="">
								                        						</div>
								                        												                        						<div class="col-sm-6 col-md-6 col-lg-6">Power Tool (floor model)</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">150 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[108]" value="">
								                        						</div>
								                        												                        						<div class="col-sm-6 col-md-6 col-lg-6">Wood Shelf</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">45 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[109]" value="">
								                        						</div>
								                        												                        						<div class="col-sm-6 col-md-6 col-lg-6">Shelves - Metal</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">40 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[110]" value="">
								                        						</div>
								                        												                        						<div class="col-sm-6 col-md-6 col-lg-6">Tool Chest - Large</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">90 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[111]" value="">
								                        						</div>
								                        												                        						<div class="col-sm-6 col-md-6 col-lg-6">Tool Chest - Small</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">60 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[112]" value="">
								                        						</div>
								                        												                        						<div class="col-sm-6 col-md-6 col-lg-6">Trunk - Large</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">60 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[113]" value="">
								                        						</div>
								                        												                        						<div class="col-sm-6 col-md-6 col-lg-6">Trunk - Small</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">40 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[114]" value="">
								                        						</div>
								                        												                        						<div class="col-sm-6 col-md-6 col-lg-6">Air Hockey Table</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">100 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[115]" value="">
								                        						</div>
								                        												                        						<div class="col-sm-6 col-md-6 col-lg-6">Fuseball Table</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">100 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[116]" value="">
								                        						</div>
								                        												                        						<div class="col-sm-6 col-md-6 col-lg-6">Lawn Ornaments</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">50 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[117]" value="">
								                        						</div>
								                        												                        						<div class="col-sm-6 col-md-6 col-lg-6">Utility / Gun Cabinet</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">125 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[118]" value="">
								                        						</div>
								                        												                        						<div class="col-sm-6 col-md-6 col-lg-6">Work Bench</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">150 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[119]" value="">
								                        						</div>
								                        												                        						<div class="col-sm-6 col-md-6 col-lg-6">Bathroom Toilet Cabinet</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">50 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[120]" value="">
								                        						</div>
								                        												                        						<div class="col-sm-6 col-md-6 col-lg-6">Garden Hose - Tool Bundle</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">35 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[121]" value="">
								                        						</div>
								                        												                        						<div class="col-sm-6 col-md-6 col-lg-6">Pool Table</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">400 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[122]" value="">
								                        						</div>
								                        												                        						<div class="col-sm-6 col-md-6 col-lg-6">Mops / Pails / Brooms</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">5 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[123]" value="">
								                        						</div>
								                        												                        						<div class="col-sm-6 col-md-6 col-lg-6">Vacuum Cleaner</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">25 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[124]" value="">
								                        						</div>
								                        											                        			</div>
							                        		</div>
							                        		<div class="clearfix"></div>
							                    								                    			<div class="form-group">
							                        			<!-- Collapse Title -->
							                        			<div><label><a data-toggle="collapse" href="#collapse10">Containers</a></label></div>

							                        			<!-- Collapse Body -->
							                        			<div id="collapse10" class="panel-collapse collapse">
							                        				<div>
								                        				<div class="col-sm-6 col-md-6 col-lg-6"><strong>Item</strong></div>
								                        				<div class="col-sm-4 col-md-4 col-lg-4"><strong>Weight</strong></div>
								                        				<div class="col-sm-2 col-md-2 col-lg-2"><strong>Quantity</strong></div>
							                        				</div>
								                        										                        						<div class="col-sm-6 col-md-6 col-lg-6">Boxes</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">30 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[125]" value="">
								                        						</div>
								                        												                        						<div class="col-sm-6 col-md-6 col-lg-6">Pictures / Mirrors (small)</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">30 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[126]" value="">
								                        						</div>
								                        												                        						<div class="col-sm-6 col-md-6 col-lg-6">Pictures / Mirrors (large)</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">40 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[127]" value="">
								                        						</div>
								                        												                        						<div class="col-sm-6 col-md-6 col-lg-6">Plastic Stacker Drawers</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">30 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[128]" value="">
								                        						</div>
								                        												                        						<div class="col-sm-6 col-md-6 col-lg-6">Totes / Rubbermaid Containers</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">45 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[129]" value="">
								                        						</div>
								                        												                        						<div class="col-sm-6 col-md-6 col-lg-6">Wardrobe Boxes</div>
								                        						<div class="col-sm-4 col-md-4 col-lg-4">60 LBS</div>
								                        						<div class="col-sm-2 col-md-2 col-lg-2">
								                        							<input class="form-control" type="number" min="0" name="item_quantity[130]" value="">
								                        						</div>
								                        											                        			</div>
							                        		</div>
							                        		<div class="clearfix"></div>
							                    								                    </div>
							                </div>
							            </div>
							            <div class="panel panel-default">
							                <div class="panel-heading">
							                    <h4 class="panel-title">
							                        <a data-toggle="collapse" data-parent="#accordion_home_moving_companies" href="#home_moving_companies_collapse5" class="collapsed" aria-expanded="false">Special Instructions</a>
							                    </h4>
							                </div>
							                <div id="home_moving_companies_collapse5" class="panel-collapse collapse" aria-expanded="false">
							                    <div class="panel-body">
							                    							                    				<div class="form-group">
							                    					<label>I have all items already in boxes and locked?</label>
							                    					<label> <input type="radio" name="moving_house_special_instruction[1]" value="1">Yes</label>
							                    					<label> <input type="radio" name="moving_house_special_instruction[1]" value="0">No</label>
							                    				</div>
							                    									                    				<div class="form-group">
							                    					<label>You need to move stuff from the basement?</label>
							                    					<label> <input type="radio" name="moving_house_special_instruction[2]" value="1">Yes</label>
							                    					<label> <input type="radio" name="moving_house_special_instruction[2]" value="0">No</label>
							                    				</div>
							                    									                    				<div class="form-group">
							                    					<label>You need to move stuff from the garage?</label>
							                    					<label> <input type="radio" name="moving_house_special_instruction[3]" value="1">Yes</label>
							                    					<label> <input type="radio" name="moving_house_special_instruction[3]" value="0">No</label>
							                    				</div>
							                    									                    				<div class="form-group">
							                    					<label>You need to move play structure from the nursery?</label>
							                    					<label> <input type="radio" name="moving_house_special_instruction[4]" value="1">Yes</label>
							                    					<label> <input type="radio" name="moving_house_special_instruction[4]" value="0">No</label>
							                    				</div>
							                    									                    				<div class="form-group">
							                    					<label>You need to move children swing set?</label>
							                    					<label> <input type="radio" name="moving_house_special_instruction[5]" value="1">Yes</label>
							                    					<label> <input type="radio" name="moving_house_special_instruction[5]" value="0">No</label>
							                    				</div>
							                    									                    </div>
							                </div>
							            </div>
							            <div class="panel panel-default">
							                <div class="panel-heading">
							                    <h4 class="panel-title">
							                        <a data-toggle="collapse" data-parent="#accordion_home_moving_companies" href="#home_moving_companies_collapse6" class="collapsed" aria-expanded="false">Additional Services</a>
							                    </h4>
							                </div>
							                <div id="home_moving_companies_collapse6" class="panel-collapse collapse" aria-expanded="false">
							                	<div class="panel-body">
							                								                    				<div class="form-group">
							                    					<label>I need packaging services?</label>
							                    					<label> <input type="radio" name="moving_house_additional_service[6]" value="1">Yes</label>
							                    					<label> <input type="radio" name="moving_house_additional_service[6]" value="0">No</label>
							                    				</div>
							                    									                    				<div class="form-group">
							                    					<label>I need packaging boxes?</label>
							                    					<label> <input type="radio" name="moving_house_additional_service[7]" value="1">Yes</label>
							                    					<label> <input type="radio" name="moving_house_additional_service[7]" value="0">No</label>
							                    				</div>
							                    									                    				<div class="form-group">
							                    					<label>I need to disassemble and re-assemble items?</label>
							                    					<label> <input type="radio" name="moving_house_additional_service[8]" value="1">Yes</label>
							                    					<label> <input type="radio" name="moving_house_additional_service[8]" value="0">No</label>
							                    				</div>
							                    									                    				<div class="form-group">
							                    					<label>I need storage service?</label>
							                    					<label> <input type="radio" name="moving_house_additional_service[9]" value="1">Yes</label>
							                    					<label> <input type="radio" name="moving_house_additional_service[9]" value="0">No</label>
							                    				</div>
							                    									                    				<div class="form-group">
							                    					<label>Any packing issue in the house?</label>
							                    					<label> <input type="radio" name="moving_house_additional_service[10]" value="1">Yes</label>
							                    					<label> <input type="radio" name="moving_house_additional_service[10]" value="0">No</label>
							                    				</div>
							                    			
							                		<div class="form-group">
							                								                    			<label>Transportation Vehicle</label>
							                    			<br>
								                        	<label><input type="radio" name="moving_house_vehicle_type" value="pickup">Pickup</label>
								                        	<label><input type="radio" name="moving_house_vehicle_type" value="cargo van">Cargo Van</label>
								                        	<label><input type="radio" name="moving_house_vehicle_type" value="10' truck">10' Truck</label>
								                        	<label><input type="radio" name="moving_house_vehicle_type" value="15' truck">15' Truck</label>
								                        	<label><input type="radio" name="moving_house_vehicle_type" value="17' truck">17' Truck</label>
								                        	<label><input type="radio" name="moving_house_vehicle_type" value="26' Truck">26' Truck</label>
								                        	<div><label id="moving_house_vehicle_type-error" class="error" for="moving_house_vehicle_type"></label></div>
							                    								                        </div>

							                        <div class="form-group">
							                        	<label>Call back option?</label>
							                        	<label> <input type="radio" name="moving_house_callback_option" value="1">Yes</label>
							                        	<label> <input type="radio" name="moving_house_callback_option" value="0">No</label>
							                        	<div><label id="moving_house_callback_option-error" class="error" for="moving_house_callback_option"></label></div>
							                        </div>
							                        <div class="form-group">
							                        	<label>Call back time?</label>
							                        	<label> <input type="radio" name="moving_house_callback_time" value="0">Anytime</label>
							                        	<label> <input type="radio" name="moving_house_callback_time" value="1">Daytime</label>
							                        	<label> <input type="radio" name="moving_house_callback_time" value="2">Evening</label>
							                        	<div><label id="moving_house_callback_time-error" class="error" for="moving_house_callback_time"></label></div>
							                        </div>
							                        <div class="form-group">
							                        	<label>Call me on?</label>
							                        	<input type="text" name="moving_house_callback_primary_no" class="form-control" placeholder="Primary Number">
							                        	<input type="text" name="moving_house_callback_secondary_no" class="form-control" placeholder="Additional Number">
							                        </div>

							                	</div>
							                </div>
							            </div>
							            <div class="panel panel-default">
							                <div class="panel-heading">
							                    <h4 class="panel-title">
							                        <a data-toggle="collapse" data-parent="#accordion_home_moving_companies" href="#home_moving_companies_collapse7" class="collapsed" aria-expanded="false">Additional Information (If Any)</a>
							                    </h4>
							                </div>
							                <div id="home_moving_companies_collapse7" class="panel-collapse collapse" aria-expanded="false">
							                    <div class="panel-body">
							                        <textarea class="form-control" name="moving_house_additional_information" id="moving_house_additional_information"></textarea>
							                    </div>
							                </div>
							            </div>
							            <div class="panel panel-default">
							                <div class="panel-heading">
							                    <h4 class="panel-title">
							                        <a data-toggle="collapse" data-parent="#accordion_home_moving_companies" href="#home_moving_companies_collapse8" class="collapsed" aria-expanded="false">Moving Date</a>
							                    </h4>
							                </div>
							                <div id="home_moving_companies_collapse8" class="panel-collapse collapse" aria-expanded="false">
							                    <div class="panel-body">
							                        <input type="text" name="moving_house_date" id="moving_house_date" class="form-control datepicker hasDatepicker">
							                    </div>
							                </div>
							            </div>
							        </div>

							        <div>
							        	<button type="submit" class="btn btn-info" name="btn_submit_moving_query" id="btn_submit_moving_query">Submit</button>
							        </div>
							    </form>
							</div>
						</div>
					</div>
			    </div>
		  	</div>
		</div>


    </div>
@endsection