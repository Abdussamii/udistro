@extends('company.layouts.app')
@section('title', 'Udistro | Profile')

@section('content')

	<!-- Multiple Select Dropdown -->
	<script type="text/javascript" src="{{ URL::asset('js/multiple-select.js') }}"></script>
	<link rel="stylesheet" href="{{ URL::asset('css/multiple-select.css') }}" />

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

	$(document).ready(function(){
		// Multi-select initialization
		$('#company_services').multipleSelect({
            width: '100%',
            selectAll: false
        });

        $('#company_image_upload').change(function () {
            var fileExtension = ['jpg', 'jpeg', 'png'];
            if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
                alert("Only image is allowed.");
                this.value = ''; // Clean field
                return false;
            }
        });

		// Show the preview of image
        $("#company_image_upload").change(function() {
		  readURL(this);
		});
	});

	// Function to show the preview of image
	function readURL(input)
	{
		if (input.files && input.files[0]) {
		var reader = new FileReader();

		reader.onload = function(e) {
		  $('#company_logo').attr('src', e.target.result);
		}

		reader.readAsDataURL(input.files[0]);
		}
	}
	</script>

	<style type="text/css">
	/* To create switch kind of button */
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

	<div class="container-fluid text-center">
	  <div class="col-lg-6 center-box">
	      <div class="col-lg-12">
	        <h1 class="page-header">Profile</h1>
	      </div>
	      <div class="col-lg-12 profile-box">
	        <ul class="nav nav-tabs">
	          <li class="active"><a data-toggle="tab" href="#profile">Company Details</a></li>
	          <li><a data-toggle="tab" href="#message">Settings</a></li>
	          <li><a data-toggle="tab" href="#template">Logo</a></li>
	        </ul>
	        <div class="tab-content">
	          <div id="profile" class="tab-pane fade in active">
	            <div class="row top-buffer"> 
	                <!-- left column -->
	                <div class="col-md-12">
	                  <!-- -->
	                  <div class="message-box">
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
											<input class="form-control" name="company_phone" id="company_phone" type="text" value="{{ $companyDetails->contact_number or '' }}" placeholder="Ex: (123) 456 7899, (123)-456-7899, 123-456-7899, 123 456 7899, 1234567899">
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
					</div>
	                  <!-- -->
	                  <div class="message-box">
						<form class="form-horizontal accordian" role="form" name="frm_company_address_details" id="frm_company_address_details" novalidate>
							<fieldset>
								<legend>Address Details: <span class="open-close"><i class="fa fa-angle-down" aria-hidden="true"></i></span></legend>
								<div class="collapsbox" style="display:block;">
									<div class="form-group">
										<label class="col-lg-3 control-label">Address Line 1:</label>
										<div class="col-lg-8 input-line">
											<input id="street-address" name="company_address1" type="text" class="form-control" placeholder="Street address" value="{{ $companyDetails->address1 or '' }}" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-lg-3 control-label">Address Line 2:</label>
										<div class="col-lg-8 input-line">
											<input id="street-address2" name="company_address2" type="text" class="form-control" placeholder="Street address" value="{{ $companyDetails->address2 or '' }}" />
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
														$selected = '';
														if( $city->id ==  $companyDetails->city_id )
														{
															$selected = 'selected="selected"';
														}

														echo '<option value="'. $city->id .'" '. $selected .'>'. $city->name .'</option>';
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
														$selected = '';
														if( $province->id ==  $companyDetails->province_id )
														{
															$selected = 'selected="selected"';
														}

														echo '<option data-abbreviation="'. $province->abbreviation .'" value="'. $province->id .'" '. $selected .'>'. $province->name .'</option>';
													}
												}
												?>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-lg-3 control-label">Postalcode:</label>
										<div class="col-lg-8 input-line">
											<input id="postcode" name="company_postalcode" type="text" class="form-control" placeholder="Zip/Postcode" value="{{ $companyDetails->postal_code or '' }}" />
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
														$selected = '';
														if( $country->id ==  $companyDetails->country_id )
														{
															$selected = 'selected="selected"';
														}

														echo '<option value="'. $country->id .'" '. $selected .'>'. $country->name .'</option>';
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
												<button type="submit" class="btn btn-primary" name="btn_update_company_address_details" id="btn_update_company_address_details">Submit</button>
											</div>
										</div>
									</div>
								</div>
							</fieldset>
						</form>
					</div>
	                 <!-- -->
	                <div class="message-box">
		                 <form class="form-horizontal accordian" role="form" name="frm_company_social_details" id="frm_company_social_details" novalidate>
							<fieldset>
								<legend>Social Network Details: <span class="open-close"><i class="fa fa-angle-down" aria-hidden="true"></i></span></legend>
								<div class="collapsbox" style="display:block;">
									<div class="form-group">
										<label class="col-lg-3 control-label">Facebook:</label>
										<div class="col-lg-8">
											<input class="form-control" name="company_facebook" id="company_facebook" type="text" value="{{ $companyDetails->facebook or '' }}">
										</div>
									</div>
									<div class="form-group">
										<label class="col-lg-3 control-label">Google Plus:</label>
										<div class="col-lg-8">
											<input class="form-control" name="company_google_plus" id="company_google_plus" type="text" value="{{ $companyDetails->google_plus or '' }}">
										</div>
									</div>
									<div class="form-group">
										<label class="col-lg-3 control-label">Instagram:</label>
										<div class="col-lg-8">
											<input class="form-control" name="company_instagram" id="company_instagram" type="text" value="{{ $companyDetails->instagram or '' }}">
										</div>
									</div>
									<div class="form-group">
										<label class="col-lg-3 control-label">Linkedin:</label>
										<div class="col-lg-8">
											<input class="form-control" name="company_linkedin" id="company_linkedin" type="text" value="{{ $companyDetails->linkedin or '' }}">
										</div>
									</div>
									<div class="form-group">
										<label class="col-lg-3 control-label">Skype:</label>
										<div class="col-lg-8">
											<input class="form-control" name="company_skype" id="company_skype" type="text" value="{{ $companyDetails->skype or '' }}">
										</div>
									</div>
									<div class="form-group">
										<label class="col-lg-3 control-label">Twitter:</label>
										<div class="col-lg-8">
											<input class="form-control" name="company_twitter" id="company_twitter" type="text" value="{{ $companyDetails->twitter or '' }}">
										</div>
									</div>
									<div class="form-group">
										<label class="col-lg-3 control-label">&nbsp;</label>
										<div class="col-lg-8">
											<div class="ui-select">
												<button type="submit" class="btn btn-primary" name="btn_update_company_social_details" id="btn_update_company_social_details">Submit</button>
											</div>
										</div>
									</div>
								</div>
							</fieldset>
						</form>
					</div>
	              <!-- -->
	            </div>
	          </div>
	        </div>

	        <div id="message" class="tab-pane fade">
	            <div class="message-box">
					<!-- -->
					<form class="form-horizontal" role="form" name="frm_company_additional_details" id="frm_company_additional_details" autocomplete="off">
						<fieldset>
							<!--<legend>Settings: <span class="open-close"><i class="fa fa-angle-down" aria-hidden="true"></i></span></legend>-->
							<div class="collapsbox1 top-buffer">
								<div class="form-group">
									<label class="col-lg-3 control-label">Industry Type:</label>
									<div class="col-lg-8">
										<select name="company_industry_type" id="company_industry_type" class="form-control">
												<option value="">Select</option>
												<?php
												if( isset( $companyCategories ) && count( $companyCategories ) > 0 )
												{
													foreach($companyCategories as $category)
													{
														$selected = '';
														if( $category->id ==  $companyDetails->company_category_id )
														{
															$selected = 'selected="selected"';
														}

														echo '<option value="'. $category->id .'" '. $selected .'>'. $category->category .'</option>';
													}
												}
												?>
											</select>
									</div>
								</div>
								<div class="form-group">
									<label class="col-lg-3 control-label">Services:</label>
									<div class="col-lg-8">
										<select name="company_services[]" id="company_services" multiple="true">
										<?php
										if( isset( $categoryServices ) && count( $categoryServices ) > 0 )
										{
											foreach ($categoryServices as $service)
											{
												$selected = '';
												if( in_array($service->id, $companyServices) )
												{
													$selected = 'selected="selected"';
												}

												echo '<option value="'. $service->id .'" '. $selected .'>'. $service->service .'</option>';
											}
										}
										?>
										</select>
										<label id="company_services-error" class="error" for="company_services"></label>
									</div>
								</div>
								<div class="form-group">
									<label class="col-lg-3 control-label">Target Area:</label>
									<div class="col-lg-8">
										<input type="text" name="company_target_area" id="company_target_area" class="form-control" placeholder="In KM" {{ ( $companyDetails['working_globally'] == 1 ) ? 'disabled' : '' }} value="{{ $companyDetails['target_area'] or '' }}" />
										<label>
											<input type="checkbox" name="company_target_global" id="company_target_global" value="1" {{ ( $companyDetails['working_globally'] == 1 ) ? 'checked' : '' }}> I am working on multiple locations
										</label>
										<div><label id="company_target_area-error" class="error" for="company_target_area" style=""></label></div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-lg-3 control-label">Availability Mode:</label>
									<div class="col-lg-8">
										<label class="switch">
										  <input type="checkbox" name="company_availability_mode" id="company_availability_mode" value="1" checked="">
										  <span class="slider round"></span>
										</label>
									</div>
								</div>
								<div class="form-group">
									<label class="col-lg-3 control-label">&nbsp;</label>
									<div class="col-lg-8">
										<div class="ui-select">
											<button type="submit" class="btn btn-primary" name="btn_update_company_additional_details" id="btn_update_company_additional_details">Submit</button>
										</div>
									</div>
								</div>
							</div>
						</fieldset>
					</form>
					<!-- -->

	            </div>
	          </div>

	          <div id="template" class="tab-pane fade">
	            <div class="email-template-wrap">
	              <!-- -->
	             <div class="message-box">
	              	<form class="form-horizontal" role="form" name="frm_company_logo" id="frm_company_logo">
						<div class="profile-pic-box">
							<!-- <img src="{{ url('/images/company/' . $companyDetails->image) }}" id="company_logo" name="company_logo" height="150" width="150" class="avatar img-circle" alt="Company Logo"> -->
							<img src="{{ ( $companyDetails->image != '' ) ? url('/images/company/' . $companyDetails->image) : url('/images/company_icon.png') }}" id="company_logo" name="company_logo" height="150" width="150" class="avatar img-circle" alt="Company Logo">
							<div class="edit-profile-pic">
								<label for="company_image_upload"><i class="fa fa-pencil" aria-hidden="true"></i></label>
								<input type="file" id="company_image_upload" name="company_image_upload" accept="image/*" style="display: none">
							</div>
						</div>
						<div class="sub-can-box">
							<button type="submit" class="btn btn-primary" name="btn_update_company_logo" id="btn_update_company_logo">Save</button>
							<button type="reset" class="btn btn-primary" name="btn_cancel_company_logo" id="btn_cancel_company_logo">Cancel</button>
						</div>
					</form>
				</div>
	              <!-- -->
	          </div>
	        </div>

	        <br />
	      </div>
	    </div>
	  </div>
	</div>
  
<script type="text/javascript">
/*Toggle*/
 $(document).ready(function(){
    $('.tab-content .collapsbox').hide();
    $('.tab-content legend:first').addClass('active').next().slideDown('slow');
    $('.tab-content legend').click(function() {
        if($(this).next().is(':hidden')) {
            $('.tab-content legend').removeClass('active').next().slideUp('slow');
            $(this).toggleClass('active').next().slideDown('slow');
        }
    });
});
</script>
@endsection