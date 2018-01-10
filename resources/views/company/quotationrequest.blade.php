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

		<!-- Modal to add / edit moving category -->
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
    </div>
@endsection