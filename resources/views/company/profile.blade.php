@extends('company.layouts.app')
@section('title', 'Udistro | Profile')

@section('content')

	<!-- Canada Post API -->
	<script type="text/javascript" src="https://ws1.postescanada-canadapost.ca/js/addresscomplete-2.30.min.js?key=kp88-mx67-ff25-xd59"></script>
	<link rel="stylesheet" type="text/css" href="https://ws1.postescanada-canadapost.ca/css/addresscomplete-2.30.min.css?key=kp88-mx67-ff25-xd59" />

	<script type="text/javascript">
	var fields = [
		{ element: "street-address", field: "Line1" },
		{ element: "street-address2", field: "Line2", mode: pca.fieldMode.POPULATE },
		{ element: "city", field: "City", mode: pca.fieldMode.POPULATE },
		{ element: "state", field: "ProvinceName", mode: pca.fieldMode.POPULATE },
		{ element: "postcode", field: "PostalCode" },
		{ element: "country", field: "CountryName", mode: pca.fieldMode.COUNTRY }
	],
	options = {
		key: "kp88-mx67-ff25-xd59"
	},
	control = new pca.Address(fields, options);

	// On the selesction of address get the province abbreviation, and set it on the province dropdown
	control.listen("populate", function (address) {

	    $("#company_province option").each(function() {
			if($(this).data('abbreviation') == address.Province)
			{
				$(this).attr('selected', 'selected').change();
			}
		});

	});
	</script>

	<style type="text/css">
	.switch {
	  position: relative;
	  display: inline-block;
	  width: 60px;
	  height: 34px;
	}

	.switch input {display:none;}

	.slider {
	  position: absolute;
	  cursor: pointer;
	  top: 0;
	  left: 0;
	  right: 0;
	  bottom: 0;
	  background-color: #ccc;
	  -webkit-transition: .4s;
	  transition: .4s;
	}

	.slider:before {
	  position: absolute;
	  content: "";
	  height: 26px;
	  width: 26px;
	  left: 4px;
	  bottom: 4px;
	  background-color: white;
	  -webkit-transition: .4s;
	  transition: .4s;
	}

	input:checked + .slider {
	  background-color: #2196F3;
	}

	input:focus + .slider {
	  box-shadow: 0 0 1px #2196F3;
	}

	input:checked + .slider:before {
	  -webkit-transform: translateX(26px);
	  -ms-transform: translateX(26px);
	  transform: translateX(26px);
	}

	/* Rounded sliders */
	.slider.round {
	  border-radius: 34px;
	}

	.slider.round:before {
	  border-radius: 50%;
	}
	</style>

	<div class="row">
    	<div class="col-lg-6 center-box">
    	  	<div class="col-lg-12">
    	   		<h1 class="page-header">Profile</h1>
    	  	</div>
    	  	<div class="col-lg-12 profile-box">
				<ul class="nav nav-tabs">
					<li class="active"><a data-toggle="tab" href="#details">Company Details</a></li>
					<li><a data-toggle="tab" href="#settings">Settings</a></li>
					<li><a data-toggle="tab" href="#logo">Logo</a></li>
				</ul>
    	   		<div class="tab-content">
	    	    	<div id="details" class="tab-pane fade in active">
	    	     		<div class="row top-buffer"> 
			    	      	<!-- left column -->
			    	      	<div class="col-md-12">
								<form class="form-horizontal accordian" role="form" name="frm_company_details" id="frm_company_details" autocomplete="off">
									<fieldset>
										<legend>Company Details: <span class="open-close"><i class="fa fa-angle-down" aria-hidden="true"></i></span></legend>
										<div class="collapsbox" style="display:block;">
											<div class="form-group">
												<label class="col-lg-3 control-label">Company Name:</label>
												<div class="col-lg-8">
													<input class="form-control" name="company_name" id="company_name" type="text" placeholder="Company Name" value="{{ $companyDetails->company_name or '' }}">
												</div>
											</div>
											<div class="form-group">
												<label class="col-lg-3 control-label">Email:</label>
												<div class="col-lg-8">
													<input class="form-control" name="company_email" id="company_email" type="text" placeholder="Company Email" value="{{ $companyDetails->email or '' }}">
												</div>
											</div>
											<div class="form-group">
												<label class="col-lg-3 control-label">Phone No:</label>
												<div class="col-lg-8">
													<input class="form-control" name="company_phone" id="company_phone" type="text" placeholder="Company Phone No" value="{{ $companyDetails->contact_number or '' }}">
												</div>
											</div>
											<div class="form-group">
												<label class="col-lg-3 control-label">Fax:</label>
												<div class="col-lg-8">
													<input class="form-control" name="company_fax" id="company_fax" type="text" placeholder="Company Fax" value="{{ $companyDetails->fax or '' }}">
												</div>
											</div>
											<div class="form-group">
												<label class="col-lg-3 control-label">Website:</label>
												<div class="col-lg-8">
													<input class="form-control" name="company_website" id="company_website" type="text" placeholder="Company Website" value="{{ $companyDetails->website or '' }}">
												</div>
											</div>
											<div class="form-group">
												<label class="col-lg-3 control-label">&nbsp;</label>
												<div class="col-lg-8">
													<div class="ui-select">
														<button type="submit" class="btn btn-primary" name="btn_update_company_details" id="btn_update_company_details">Submit</button>
													</div>
												</div>
											</div>
										</div>
									</fieldset>
								</form>

								<form class="form-horizontal accordian" role="form" name="frm_company_address_details" id="frm_company_address_details" novalidate>
									<fieldset>
										<legend>Address Details: <span class="open-close"><i class="fa fa-angle-down" aria-hidden="true"></i></span></legend>
										<div class="collapsbox" style="display:block;">
											<div class="form-group">
												<label class="col-lg-3 control-label">Address Line 1:</label>
												<div class="col-lg-8 input-line">
													<input id="street-address" type="text" class="form-control" placeholder="Street address" />
												</div>
											</div>
											<div class="form-group">
												<label class="col-lg-3 control-label">Address Line 2:</label>
												<div class="col-lg-8 input-line">
													<input id="street-address2" type="text" class="form-control" placeholder="Street address" />
												</div>
											</div>
											<div class="form-group">
												<label class="col-lg-3 control-label">City:</label>
												<div class="col-lg-8 input-line">
													<!-- <input id="city" type="text" class="form-control" placeholder="City" /> -->
													<select name="company_city" id="company_city" class="form-control">
														<option value="">Select</option>
														<?php
														if( isset( $cities ) && count( $cities ) > 0 )
														{
															foreach($cities as $city)
															{
																echo '<option value="'. $city->id .'">'. $city->name .'</option>';
															}
														}
														?>
													</select>
												</div>
											</div>
											<div class="form-group">
												<label class="col-lg-3 control-label">Province:</label>
												<div class="col-lg-8 input-line">
													<select name="company_province" id="company_province" class="form-control">
														<option value="">Select</option>
														<?php
														if( isset( $provinces ) && count( $provinces ) > 0 )
														{
															foreach($provinces as $province)
															{
																echo '<option data-abbreviation="'. $province->abbreviation .'" value="'. $province->id .'">'. $province->name .'</option>';
															}
														}
														?>
													</select>
												</div>
											</div>
											<div class="form-group">
												<label class="col-lg-3 control-label">Postalcode:</label>
												<div class="col-lg-8 input-line">
													<input id="postcode" type="text" class="form-control" placeholder="Zip/Postcode" />
												</div>
											</div>
											<div class="form-group">
												<label class="col-lg-3 control-label">Country:</label>
												<div class="col-lg-8 input-line">
													<!-- <input id="country" type="text" class="form-control" placeholder="Country" /> -->
													<select name="company_country" id="company_country" class="form-control">
														<option value="">Select</option>
														<?php
														if( isset( $countries ) && count( $countries ) > 0 )
														{
															foreach($countries as $country)
															{
																echo '<option value="'. $country->id .'">'. $country->name .'</option>';
															}
														}
														?>
													</select>
												</div>
											</div>
											<div class="form-group">
												<label class="col-lg-3 control-label">&nbsp;</label>
												<div class="col-lg-8">
													<div class="ui-select">
														<button type="submit" class="btn btn-primary" name="btn_update_agent_profile" id="btn_update_agent_profile">Submit</button>
													</div>
												</div>
											</div>
										</div>
									</fieldset>
								</form>

								<form class="form-horizontal accordian" role="form" name="frm_company_social_details" id="frm_company_social_details" novalidate>
									<fieldset>
										<legend>Social Network Details: <span class="open-close"><i class="fa fa-angle-down" aria-hidden="true"></i></span></legend>
										<div class="collapsbox" style="display:block;">
											<div class="form-group">
												<label class="col-lg-3 control-label">Facebook:</label>
												<div class="col-lg-8">
													<input class="form-control" value="" name="" id="" type="text">
												</div>
											</div>
											<div class="form-group">
												<label class="col-lg-3 control-label">Google Plus:</label>
												<div class="col-lg-8">
													<input class="form-control" value="" name="" id="" type="text">
												</div>
											</div>
											<div class="form-group">
												<label class="col-lg-3 control-label">Instagram:</label>
												<div class="col-lg-8">
													<input class="form-control" value="" name="" id="" type="text">
												</div>
											</div>
											<div class="form-group">
												<label class="col-lg-3 control-label">Linkedin:</label>
												<div class="col-lg-8">
													<input class="form-control" value="" name="" id="" type="text">
												</div>
											</div>
											<div class="form-group">
												<label class="col-lg-3 control-label">Skype:</label>
												<div class="col-lg-8">
													<input class="form-control" value="" name="" id="" type="text">
												</div>
											</div>
											<div class="form-group">
												<label class="col-lg-3 control-label">Twitter:</label>
												<div class="col-lg-8">
													<input class="form-control" value="" name="" id="" type="text">
												</div>
											</div>
											<div class="form-group">
												<label class="col-lg-3 control-label">&nbsp;</label>
												<div class="col-lg-8">
													<div class="ui-select">
														<button type="submit" class="btn btn-primary" name="btn_update_agent_profile" id="btn_update_agent_profile">Submit</button>
													</div>
												</div>
											</div>
										</div>
									</fieldset>
								</form>

	    	      			</div>
	    	     		</div>
	    	    	</div>
					<div id="settings" class="tab-pane fade">
						<div class="profile-wrap top-buffer">
							<form class="form-horizontal" role="form" name="frm_company_setting" id="frm_company_setting">
								<fieldset>
									<legend>Settings: <span class="open-close"><i class="fa fa-angle-down" aria-hidden="true"></i></span></legend>
									<div class="collapsbox" style="display:block;">
										<div class="form-group">
											<label class="col-lg-3 control-label">Industry Type:</label>
											<div class="col-lg-8">
												<input id="street-address" type="text" class="form-control" placeholder="" autofocus />
											</div>
										</div>
										<div class="form-group">
											<label class="col-lg-3 control-label">Services:</label>
											<div class="col-lg-8">
												<input id="street-address" type="text" class="form-control" placeholder="" autofocus />
											</div>
										</div>
										<div class="form-group">
											<label class="col-lg-3 control-label">Target Area:</label>
											<div class="col-lg-8">
												<input id="street-address" type="text" class="form-control" placeholder="In KM" autofocus />
												<label>
													<input type="checkbox" name="" id=""> I am working on multiple locations
												</label>
											</div>
										</div>
										<div class="form-group">
											<label class="col-lg-3 control-label">Availability Mode:</label>
											<div class="col-lg-8">
												<label class="switch">
												  <input type="checkbox" checked>
												  <span class="slider round"></span>
												</label>
											</div>
										</div>
										<div class="form-group">
											<label class="col-lg-3 control-label">&nbsp;</label>
											<div class="col-lg-8">
												<div class="ui-select">
													<button type="submit" class="btn btn-primary" name="btn_update_agent_profile" id="btn_update_agent_profile">Submit</button>
												</div>
											</div>
										</div>
									</div>
								</fieldset>
							</form>
						</div>
					</div>
		    	    <div id="logo" class="tab-pane fade">
						<!-- <h3>Email Template</h3> -->
						<div class="email-template-wrap top-buffer">
							<form class="form-horizontal" role="form" name="frm_company_logo" id="frm_company_logo">
								
							</form>
						</div>
		    	    </div>
    	   		</div>
    	  	</div>
    	</div>
    </div>
@endsection