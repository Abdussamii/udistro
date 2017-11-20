@extends('agent.layouts.app')
@section('title', 'Udistro | Profile')

@section('content')
	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Profile</h1>
        </div>
    </div>

    <ul class="nav nav-tabs">
		<li class="active"><a data-toggle="tab" href="#profile">Profile</a></li>
		<li><a data-toggle="tab" href="#message">Message</a></li>
		<li><a data-toggle="tab" href="#themes">Themes</a></li>
	</ul>

	<div class="tab-content">
		<div id="profile" class="tab-pane fade in active">
			<div class="row top-buffer">
				<!-- left column -->
				<div class="col-md-8">
					<form class="form-horizontal" role="form" name="frm_agent_profile" id="frm_agent_profile">
						<fieldset>
  							<legend>Personal Information:</legend>
							<div class="form-group">
								<label class="col-lg-2 control-label">Email:</label>
								<div class="col-lg-8">
								  	<input class="form-control" type="text" value="{{ $agentDetails->email or '' }}" name="agent_email" id="agent_email">
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-2 control-label">First name:</label>
								<div class="col-lg-8">
								  	<input class="form-control" type="text" value="{{ $agentDetails->fname or '' }}" name="agent_fname" id="agent_fname">
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-2 control-label">Last name:</label>
								<div class="col-lg-8">
								  	<input class="form-control" type="text" value="{{ $agentDetails->lname or '' }}" name="agent_lname" id="agent_lname">
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-2 control-label">Address:</label>
								<div class="col-lg-8">
								  	<textarea class="form-control autocomplete" name="agent_address" id="agent_address">{{ $agentDetails->address or '' }}</textarea>
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-2 control-label">Province:</label>
								<div class="col-lg-8">
								  	<div class="ui-select">
									    <select id="user_time_zone" class="form-control" name="agent_province" id="agent_province">
											<option value="">Select</option>
											<?php
											if( isset( $provinces ) &&  count( $provinces ) > 0 )
											{
												foreach ($provinces as $province)
												{
													if($agentDetails->province_id == $province->id) 
														$selected = 'selected';
													else
														$selected = ''; 
													echo '<option value="'. $province->id .'" '.$selected.'>'. ucwords( strtolower( $province->name ) ) .'</option>';
												}
											}
											?>
									    </select>
								  	</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-2 control-label">City:</label>
								<div class="col-lg-8">
								  	<div class="ui-select">
									    <select id="user_time_zone" class="form-control" name="agent_city" id="agent_city">
											<option value="">Select</option>
											<?php
											if( isset( $cityArray ) &&  count( $cityArray ) > 0 )
											{
												foreach ($cityArray as $city)
												{
													if($agentDetails->city_id == $city['id']) 
														$selected = 'selected';
													else
														$selected = ''; 
													echo '<option value="'. $city['id'] .'" '.$selected.'>'. ucwords( strtolower( $city['city'] ) ) .'</option>';
												}
											}
											?>
									    </select>
								  	</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-2 control-label">Postal Code:</label>
								<div class="col-lg-8">
								  	<input class="form-control" type="text" value="{{ $agentDetails->postalcode or '' }}" name="agent_postalcode" id="agent_postalcode">
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-2 control-label">Country:</label>
								<div class="col-lg-8">
								  	<div class="ui-select">
									    <select id="user_time_zone" class="form-control" name="agent_country" id="agent_country">
											<?php
											if( isset( $countries ) &&  count( $countries ) > 0 )
											{
												foreach ($countries as $country)
												{
													if($agentDetails->country_id == $country->id) 
														$selected = 'selected';
													else
														$selected = '';
													echo '<option value="'. $country->id .'" '.$selected.'>'. ucwords( strtolower( $country->name ) ) .'</option>';
												}
											}
											?>
									    </select>
								  	</div>
								</div>
							</div>
						</fieldset>
						<fieldset>
  							<legend>Company Information:</legend>
  							<div class="form-group">
								<label class="col-lg-2 control-label">Company Name:</label>
								<div class="col-lg-8">
								  	<input class="form-control" type="text" value="{{ $companyDetails[0]->company_name or '' }}" name="agent_company_name" id="agent_company_name">
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-2 control-label">Company Category:</label>
								<div class="col-lg-8">
								  	<div class="ui-select">
									    <select id="user_time_zone" class="form-control" name="agent_company_category" id="agent_company_category">
											<?php
											if( isset( $companyCategories ) &&  count( $companyCategories ) > 0 )
											{
												foreach ($companyCategories as $category)
												{
													if($companyDetails[0]->country_id == $country->id) 
														$selected = 'selected';
													else
														$selected = '';
													echo '<option value="'. $category->id .'" '.$selected.'>'. ucwords( strtolower( $category->category ) ) .'</option>';
												}
											}
											?>
									    </select>
								  	</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-2 control-label">Address:</label>
								<div class="col-lg-8">
								  	<textarea class="form-control autocomplete" name="agent_company_address" id="agent_company_address">{{ $companyDetails[0]->address or '' }}</textarea>
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-2 control-label">Province:</label>
								<div class="col-lg-8">
								  	<div class="ui-select">
									    <select id="user_time_zone" class="form-control" name="agent_company_province" id="agent_company_province">
											<option value="">Select</option>
											<?php
											if( isset( $provinces ) &&  count( $provinces ) > 0 )
											{
												foreach ($provinces as $province)
												{
													if($companyDetails[0]->province_id == $province->id) 
														$selected = 'selected';
													else
														$selected = ''; 
													echo '<option value="'. $province->id .'" '.$selected.'>'. ucwords( strtolower( $province->name ) ) .'</option>';
												}
											}
											?>
									    </select>
								  	</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-2 control-label">City:</label>
								<div class="col-lg-8">
								  	<div class="ui-select">
									    <select id="user_time_zone" class="form-control" name="agent_company_city" id="agent_company_city">
											<option value="0">Select</option>
											<?php
											if( isset( $cityArray ) &&  count( $cityArray ) > 0 )
											{
												foreach ($cityArray as $city)
												{
													if($companyDetails[0]->city_id == $city['id']) 
														$selected = 'selected';
													else
														$selected = '';
													echo '<option value="'. $city['id'] .'" '.$selected.'>'. ucwords( strtolower( $city['city'] ) ) .'</option>';
												}
											}
											?>
									    </select>
								  	</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-2 control-label">Postal Code:</label>
								<div class="col-lg-8">
								  	<input class="form-control" type="text" value="{{ $companyDetails[0]->postal_code or '' }}" name="agent_company_postalcode" id="agent_company_postalcode">
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-2 control-label">Country:</label>
								<div class="col-lg-8">
								  	<div class="ui-select">
									    <select id="user_time_zone" class="form-control" name="agent_company_country" id="agent_company_country">
											<?php
											if( isset( $countries ) &&  count( $countries ) > 0 )
											{
												foreach ($countries as $country)
												{
													if($agentDetails->country_id == $country->id) 
														$selected = 'selected';
													else
														$selected = '';
													echo '<option value="'. $country->id .'" '.$selected.'>'. ucwords( strtolower( $country->name ) ) .'</option>';
												}
											}
											?>
									    </select>
								  	</div>
								</div>
							</div>
  						</fieldset>
  						<div class="form-group">
							<label class="col-lg-2 control-label">&nbsp;</label>
							<div class="col-lg-8">
							  	<div class="ui-select">
								    <button type="submit" class="btn btn-primary" name="btn_update_agent_profile" id="btn_update_agent_profile">Submit</button>
							  	</div>
							</div>
						</div>
					</form>
				</div>
				<div class="col-md-4">
					<div class="text-center">
						<img src="//placehold.it/100" class="avatar img-square" alt="avatar">
						<h6>Upload a different photo...</h6>
					</div>
				</div>
			</div>
		</div>
		<div id="message" class="tab-pane fade">
			<h3>Message</h3>
			<div>
				<form class="form-horizontal" role="form" name="frm_agent_message" id="frm_agent_message">
					<div class="form-group">
						<div class="col-lg-4">
						  	<textarea class="form-control" rows="10" name="agent_message" id="agent_message">{{ $message->message }}</textarea>
						</div>
					</div>
					<div>
						<div class="ui-select">
						    <button type="submit" class="btn btn-primary" name="btn_update_agent_message" id="btn_update_agent_message">Submit</button>
					  	</div>
					</div>
				</form>
			</div>
		</div>
		<div id="themes" class="tab-pane fade">
			<h3>Themes</h3>
			<div>
				Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
				quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
				consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
				cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
				proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
			</div>
		</div>

		<br>

	</div>

	<!-- Google map address auto-complete -->
	<!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCY6SWc-U6uPnlw4_7Q05yWib74zHGlxo8&libraries=places&callback=initMap" async defer></script> -->
	<script type="text/javascript">
	/*function initMap() {
	    new google.maps.places.Autocomplete(
	    (document.getElementById('agent_company_address')), {
	        types: ['geocode']
	    });
	}*/
	</script>
@endsection