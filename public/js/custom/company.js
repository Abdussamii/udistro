/* Common js for all company related functionalities */

$(document).ready(function(){

	alertify.set('notifier','position', 'top-center');

    // Company registration form validation
    /*$('#frm_company_registration').submit(function(e){
        e.preventDefault();
    });
    $('#frm_company_registration').validate({
        rules: {
        	rep_fname: {
        		required: true
        	},
        	rep_lname: {
        		required: true
        	},
        	rep_designation: {
        		required: true
        	},
        	email: {
                required: true,
                email: true
            },
            password: {
                required: true,
                minlength: 6
            },
        	phone_no: {
        		required: true,
        		number: true
        	},
        	company_name: {
        		required: true
        	},
        	company_province: {
        		required: true
        	},
        	company_type: {
        		required: true
        	}
        },
        messages: {
        	rep_fname: {
        		required: 'Please enter first name'
        	},
        	rep_lname: {
        		required: 'Please enter last name'
        	},
        	rep_designation: {
        		required: 'Please enter job title'
        	},
        	email: {
                required: 'Please enter email',
                email: 'Please enter valid email'
            },
            password: {
                required: 'Please enter password',
                minlength: 'Password must contain atleat 6 characters'
            },
        	phone_no: {
        		required: 'Please enter phone number',
        		number: 'Please enter a valid number'
        	},
        	company_name: {
        		required: 'Please enter company name'
        	},
        	company_province: {
        		required: 'Please select province'
        	},
        	company_type: {
        		required: 'Please select industry type'
        	}
        }
    });*/

    // Register the company
    /*$('#btn_company_registration').click(function(){
    	if( $('#frm_company_registration').valid() )
    	{
    		$.ajax({
    			url: $('meta[name="route"]').attr('content') + '/company/registercompany',
    			method: 'post',
    			data: {
    				frmData: $('#frm_company_registration').serialize()
    			},
    			headers: {
			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    },
			    success: function(response){
			    	if( response.errCode == 0 )
			    	{
			    		alertify.success( response.errMsg );

			    		// Refresh the form
			    		$('#frm_company_registration')[0].reset();
			    	}
			    	else
			    	{
			    		alertify.error( response.errMsg );
			    	}
			    }
    		});
    	}
    });*/

    /* ----- Company profile related functionality ----- */

    // Change Password form validation
    $('#frm_change_password').submit(function(e){
        e.preventDefault();
    });
    $('#frm_change_password').validate({
        rules: {
            oldpassword: {
                required: true
            },
            newpassword: {
                required: true
            },
            cnfpassword: {
                required: true
            }
        },
        messages: {
            oldpassword: {
                required: 'Please enter old password'
            },
            newpassword: {
                required: 'Please enter new password'
            },
            cnfpassword: {
                required: 'Please enter confirm password'
            }
        }
    });

    // Check Change Password details
    $('#btn_change_password').click(function(){
        // Check the validation
        if( $('#frm_change_password').valid() )
        {
            var $this = $(this);

            $.ajax({
                url: $('meta[name="route"]').attr('content') + '/company/changepassword',
                method: 'post',
                data: {
                    frmData: $('#frm_change_password').serialize()
                },
                beforeSend: function() {
                    // Show the loading button
                    $this.button('loading');
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                complete: function()
                {
                    // Change the button to previous
                    $this.button('reset');
                },
                success: function(response){
                    if( response.errCode == 0 )
                    {
                        alertify.success( response.errMsg );

                        // Refresh the form and close the modal
                        $('#frm_change_password')[0].reset();
                        document.location.href = $('meta[name="route"]').attr('content') + '/company/dashboard';
                    }
                    else
                    {
                        alertify.error( response.errMsg );
                    }
                }
            });
        }
    });

    // Change Password form validation
    $('#frm_forgot_password').submit(function(e){
        e.preventDefault();
    });

    // Check Change Password details
    $('#btn_forgot_password').click(function()
    {
        var $this = $(this);

        $.ajax({
            url: $('meta[name="route"]').attr('content') + '/company/forgotpassword',
            method: 'post',
            data: {
                frmData: $('#frm_forgot_password').serialize()
            },
            beforeSend: function() {
                // Show the loading button
                $this.button('loading');
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            complete: function()
            {
                // Change the button to previous
                $this.button('reset');
            },
            success: function(response)
            {
                if( response.errCode == 0 )
                {
                    alertify.success( response.errMsg );

                    // Refresh the form and close the modal
                    $('#frm_forgot_password')[0].reset();
                }
                else
                {
                    alertify.error( response.errMsg );
                }
            }
        });
    });

    // Canada number validation
    $.validator.addMethod("canadaPhone", function (value, element) {
        var filter = /^((\+[1-9]{0,4}[ \-]*)|(\([0-9]{2,3}\)[ \-]*)|([0-9]{2,4})[ \-]*)*?[0-9]{3,4}?[ \-]*[0-9]{3,4}?$/;
        if (filter.test(value)) {
            return true;
        }
        else {
            return false;
        }
    }, 'Please enter a valid number');

    // Company Details form validation
    $('#frm_company_details').submit(function(e){
        e.preventDefault();
    });
    $('#frm_company_details').validate({
        rules: {
        	company_name: {
        		required: true
        	},
        	company_email: {
                required: true,
                email: true
            },
            company_phone: {
        		required: true,
        		number: true,
                canadaPhone: true
        	}
        },
        messages: {
        	company_name: {
        		required: 'Please enter company name'
        	},
        	company_email: {
                required: 'Please enter email',
                email: 'Please enter valid email'
            },
            company_phone: {
        		required: 'Please enter phone number',
        		number: 'Please enter a valid number'
        	}	
        }
    });

    // Update the Company Details
    $('#btn_update_company_details').click(function(){
    	if( $('#frm_company_details').valid() )
    	{
    		$.ajax({
    			url: $('meta[name="route"]').attr('content') + '/company/updatecompanybasicdetails',
    			method: 'post',
    			data: {
    				frmData: $('#frm_company_details').serialize()
    			},
    			headers: {
			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    },
			    success: function(response){
			    	if( response.errCode == 0 )
			    	{
			    		alertify.success( response.errMsg );
			    	}
			    	else
			    	{
			    		alertify.error( response.errMsg );
			    	}
			    }
    		});
    	}
    });


    $(document).on('click', '.edit_home_cleaning_service', function()
    {
        var homeServiceId = $(this).attr('id');

        if( homeServiceId != '' )
        {
            // Get the details of selected payment plan
            $.ajax({
                url: $('meta[name="route"]').attr('content') + '/company/gethomeservicerequest',
                method: 'get',
                data: {
                    homeServiceId: homeServiceId
                },
                beforeSend: function(){
                	// Show loader
                	$('.loading').show();
                },
                success: function(response){

                	// Show loader
                	$('.loading').hide();

                    // Auto-fill the form
                    $('#frm_home_cleaning_services #home_cleaning_service_request_id').val(homeServiceId);

                    $('#frm_home_cleaning_services #moving_from_address').text( ( response.move_out_cleaning == '1' ) ? response.moving_from_address : 'NA' );
                    $('#frm_home_cleaning_services #moving_to_address').text( ( response.move_in_cleaning == '1' ) ? response.moving_to_address : 'NA' );

                    $('#frm_home_cleaning_services #moving_from_house_type').text(response.moving_from_house_type);
                    $('#frm_home_cleaning_services #moving_from_floor').text(response.moving_from_floor);
                    $('#frm_home_cleaning_services #moving_from_bedroom_count').text(response.moving_from_bedroom_count);
                    $('#frm_home_cleaning_services #moving_from_property_type').text(response.moving_from_property_type);
                    $('#frm_home_cleaning_services #moving_to_house_type').text(response.moving_to_house_type);
                    $('#frm_home_cleaning_services #moving_to_floor').text(response.moving_to_floor);
                    $('#frm_home_cleaning_services #moving_to_bedroom_count').text(response.moving_to_bedroom_count);
                    $('#frm_home_cleaning_services #moving_to_property_type').text(response.moving_to_property_type);
                    $('#frm_home_cleaning_services #home_condition').text(response.home_condition);
                    $('#frm_home_cleaning_services #home_cleaning_level').text(response.home_cleaning_level);
                    $('#frm_home_cleaning_services #home_cleaning_area').text(response.home_cleaning_area);
                    $('#frm_home_cleaning_services #home_cleaning_people_count').text(response.home_cleaning_people_count);
                    $('#frm_home_cleaning_services #home_cleaning_pet_count').text(response.home_cleaning_pet_count);
                    $('#frm_home_cleaning_services #home_cleaning_bathroom_count').text(response.home_cleaning_bathroom_count);
                    
                    $('#frm_home_cleaning_services #pst_percenateg').text(response.pst);
                    $('#frm_home_cleaning_services #gst_percentage').text(response.gst);
                    $('#frm_home_cleaning_services #hst_percentage').text(response.hst);
                    $('#frm_home_cleaning_services #service_charge_percetage').text(response.service_charge);

                    $('#frm_home_cleaning_services #cleaning_behind_refrigerator_and_stove').text( (response.cleaning_behind_refrigerator_and_stove) ? 'Yes' : 'No' );
                    $('#frm_home_cleaning_services #baseboard_to_be_washed').text( (response.baseboard_to_be_washed) ? 'Yes' : 'No' );

                    $('#frm_home_cleaning_services #additional_information').text(response.additional_information);

                    // Requested services
					$('#frm_home_cleaning_services #user_requested_home_cleaning_services').html(response.request_services_details);                  

                    // Show the modal
                    $('#modal_home_cleaning_service_request').modal('show');
                }
            });
        }
        else
        {
            alertify.error('Missing category id');
        }
    });


    $(document).on('click', '.edit_cable_internet_service', function(){
        var cableInternetId = $(this).attr('id');

        if( cableInternetId != '' )
        {
            // Get the details of selected payment plan
            $.ajax({
                url: $('meta[name="route"]').attr('content') + '/company/getcableservicerequest',
                method: 'get',
                data: {
                    cableInternetId: cableInternetId
                },
                success: function(response){
   
                    // Auto-fill the form
                    $('#frm_cable_internet_services #cable_internet_service_request_id').val(cableInternetId);

                    $('#frm_cable_internet_services #moving_from_address').text(response.moving_from_address);
                    $('#frm_cable_internet_services #moving_to_address').text(response.moving_to_address);

                    $('#frm_cable_internet_services #moving_from_house_type').text(response.moving_from_house_type);
                    $('#frm_cable_internet_services #moving_from_floor').text(response.moving_from_floor);
                    $('#frm_cable_internet_services #moving_from_bedroom_count').text(response.moving_from_bedroom_count);
                    $('#frm_cable_internet_services #moving_from_property_type').text(response.moving_from_property_type);
                    $('#frm_cable_internet_services #moving_to_house_type').text(response.moving_to_house_type);
                    $('#frm_cable_internet_services #moving_to_floor').text(response.moving_to_floor);
                    $('#frm_cable_internet_services #moving_to_bedroom_count').text(response.moving_to_bedroom_count);
                    $('#frm_cable_internet_services #moving_to_property_type').text(response.moving_to_property_type);

                    $('#frm_cable_internet_services #have_cable_internet_already').text(response.have_cable_internet_already);
                    $('#frm_cable_internet_services #employment_status').text(response.employment_status);
                    $('#frm_cable_internet_services #want_to_receive_electronic_bill').text(response.want_to_receive_electronic_bill);
                    $('#frm_cable_internet_services #want_to_contract_plan').text(response.want_to_contract_plan);
                    $('#frm_cable_internet_services #want_to_setup_preauthorise_payment').text(response.want_to_setup_preauthorise_payment);

                    $('#frm_cable_internet_services #callback_option').text(response.callback_option);
                    $('#frm_cable_internet_services #callback_time').text(response.callback_time);
                    $('#frm_cable_internet_services #primary_no').text(response.primary_no);
                    $('#frm_cable_internet_services #secondary_no').text(response.secondary_no);
                    $('#frm_cable_internet_services #additional_information').text(response.additional_information);

                    // Requested services
					$('#frm_cable_internet_services #user_requested_cable_internet_services').html(response.request_services_details);

					// Requested Addotional services
					$('#frm_cable_internet_services #user_requested_cable_internet_additional_services').html(response.request_additional_services_details);

					$('#frm_cable_internet_services #pst_percenateg').text(response.pst);
                    $('#frm_cable_internet_services #gst_percentage').text(response.gst);
                    $('#frm_cable_internet_services #hst_percentage').text(response.hst);
                    $('#frm_cable_internet_services #service_charge_percetage').text(response.service_charge);

                    // Show the modal
                    $('#modal_cable_internet_service_request').modal('show');
                }
            });
        }
        else
        {
            alertify.error('Missing id');
        }
    });


    $(document).on('click', '.edit_tech_concierge_service', function()
    {
        var techConciergeId = $(this).attr('id');

        if( techConciergeId != '' )
        {
            // Get the details of selected payment plan
            $.ajax({
                url: $('meta[name="route"]').attr('content') + '/company/gettechconciergerequest',
                method: 'get',
                data: {
                    techConciergeId: techConciergeId
                },
                beforeSend: function(){
                	// Show loader
                	$('.loading').show();
                },
                success: function(response){

                	// Show loader
                	$('.loading').hide();
   
                    // Auto-fill the form
                    $('#frm_tech_concierge #tech_concierge_service_request_id').val(techConciergeId);

                    $('#frm_tech_concierge #moving_from_address').text(response.moving_from_address);
                    $('#frm_tech_concierge #moving_to_address').text(response.moving_to_address);

                    $('#frm_tech_concierge #moving_to_house_type').text(response.moving_to_house_type);
                    $('#frm_tech_concierge #moving_to_floor').text(response.moving_to_floor);
                    $('#frm_tech_concierge #moving_to_bedroom_count').text(response.moving_to_bedroom_count);
                    $('#frm_tech_concierge #moving_to_property_type').text(response.moving_to_property_type);

                    $('#frm_tech_concierge #availability_day1').text( response.availability_date1 + ' (' + response.availability_time_from1 + ' to ' + response.availability_time_upto1 + ')' );
                    $('#frm_tech_concierge #availability_day2').text( response.availability_date2 + ' (' + response.availability_time_from2 + ' to ' + response.availability_time_upto2 + ')' );
                    $('#frm_tech_concierge #availability_day3').text( response.availability_date3 + ' (' + response.availability_time_from3 + ' to ' + response.availability_time_upto3 + ')' );
                    
                    $('#frm_tech_concierge #additional_information').text(response.additional_information);

                    // Requested services
					$('#frm_tech_concierge #user_requested_tech_concierge_services').html(response.request_services_details);

					// Reqested additional services
					$('#frm_tech_concierge #user_requested_tech_concierge_other_details').html(response.request_other_details);

					$('#frm_tech_concierge #pst_percenateg').text(response.pst);
                    $('#frm_tech_concierge #gst_percentage').text(response.gst);
                    $('#frm_tech_concierge #hst_percentage').text(response.hst);
                    $('#frm_tech_concierge #service_charge_percetage').text(response.service_charge);

                    // Show the modal
                    $('#modal_tech_concierge_service_request').modal('show');
                }
            });
        }
        else
        {
            alertify.error('Missing id');
        }
    });


    $(document).on('click', '.edit_moving_item_service', function()
    {
        var movingCompaniesId = $(this).attr('id');

        if( movingCompaniesId != '' )
        {
            // Get the details of selected payment plan
            $.ajax({
                url: $('meta[name="route"]').attr('content') + '/company/getmovingcompaniesrequest',
                method: 'get',
                data: {
                    movingCompaniesId: movingCompaniesId
                },
                beforeSend: function(){
                	// Show loader
                	$('.loading').show();
                },
                success: function(response){

                	// Show loader
                	$('.loading').hide();
   
                    // Auto-fill the form
                    $('#frm_home_moving_companies #moving_service_request_id').val(movingCompaniesId);

                    $('#frm_home_moving_companies #moving_from_house_type').text(response.moving_from_house_type);
                    $('#frm_home_moving_companies #moving_from_floor').text(response.moving_from_floor);
                    $('#frm_home_moving_companies #moving_from_bedroom_count').text(response.moving_from_bedroom_count);
                    $('#frm_home_moving_companies #moving_from_property_type').text(response.moving_from_property_type);

                    $('#frm_home_moving_companies #moving_to_house_type').text(response.moving_to_house_type);
                    $('#frm_home_moving_companies #moving_to_floor').text(response.moving_to_floor);
                    $('#frm_home_moving_companies #moving_to_bedroom_count').text(response.moving_to_bedroom_count);
                    $('#frm_home_moving_companies #moving_to_property_type').text(response.moving_to_property_type);
                    
                    $('#frm_home_moving_companies #additional_information').text(response.additional_information);
                    $('#frm_home_moving_companies #moving_date').text(response.moving_date);

                    $('#frm_home_moving_companies #moving_from_address').text(response.moving_from_address);
                    $('#frm_home_moving_companies #moving_to_address').text(response.moving_to_address);

                    // Requested services
					$('#frm_home_moving_companies #user_requested_moving_services').html(response.request_services_details);

					// Reqested additional services
					$('#frm_home_moving_companies #user_requested_moving_other_services').html(response.request_other_details);

					$('#frm_home_moving_companies #pst_percenateg').text(response.pst);
					$('#frm_home_moving_companies #gst_percentage').text(response.gst);
					$('#frm_home_moving_companies #hst_percentage').text(response.hst);
					$('#frm_home_moving_companies #service_charge_percetage').text(response.service_charge);

					// Distance between two addresses
					$('#frm_home_moving_companies #distance').text(response.distance);

                    // Show the modal
                    $('#modal_moving_companies_service_request').modal('show');
                }
            });
        }
        else
        {
            alertify.error('Missing id');
        }
    });

    // Company Address Details form validation
    $('#frm_company_address_details').submit(function(e){
        e.preventDefault();
    });
    $('#frm_company_address_details').validate({
        rules: {
        	company_address1: {
        		required: true
        	},
        	company_city: {
        		required: true	
        	},
        	company_province: {
        		required: true	
        	},
        	company_postalcode: {
        		required: true	
        	},
        	company_country: {
        		required: true		
        	}
        },
        messages: {
        	company_address1: {
        		required: 'Please enter address'
        	},
        	company_city: {
        		required: 'Please select city'
        	},
        	company_province: {
        		required: 'Please select province'
        	},
        	company_postalcode: {
        		required: 'Please enter postalcode'
        	},
        	company_country: {
        		required: 'Please select country'
        	}	
        }
    });

    // Update the Company Address Details
    $('#btn_update_company_address_details').click(function(){
    	if( $('#frm_company_address_details').valid() )
    	{
    		$.ajax({
    			url: $('meta[name="route"]').attr('content') + '/company/updatecompanyaddressdetails',
    			method: 'post',
    			data: {
    				frmData: $('#frm_company_address_details').serialize()
    			},
    			headers: {
			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    },
			    success: function(response){
			    	if( response.errCode == 0 )
			    	{
			    		alertify.success( response.errMsg );
			    	}
			    	else
			    	{
			    		alertify.error( response.errMsg );
			    	}
			    }
    		});
    	}
    });

    // Update the Company Social Details
    $('#frm_company_social_details').submit(function(e){
        e.preventDefault();
    });
    $('#btn_update_company_social_details').click(function() {
    	$.ajax({
			url: $('meta[name="route"]').attr('content') + '/company/updatecompanysocialdetails',
			method: 'post',
			data: {
				frmData: $('#frm_company_social_details').serialize()
			},
			headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    },
		    success: function(response){
		    	if( response.errCode == 0 )
		    	{
		    		alertify.success( response.errMsg );
		    	}
		    	else
		    	{
		    		alertify.error( response.errMsg );
		    	}
		    }
		});
    });

    // To fetch the services as per the selected category
    $('#company_industry_type').change(function(){
    	var industryTypeId = $(this).val();

    	// Empty the dropdown
    	$('#company_services').html('');

    	if( industryTypeId != '' )
    	{
	    	$.ajax({
				url: $('meta[name="route"]').attr('content') + '/company/getcompanycategoryservices',
				method: 'get',
				data: {
					industryTypeId: industryTypeId
				},
				headers: {
			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    },
			    success: function(response){

			    	$('#company_services').html(response);
			    	
			    	// Refresh the multiple-select dropdown
			    	$('#company_services').multipleSelect("refresh");

			    }
			});
    	}
    });

    // Clear the target area value and disable it when the company is working on multiple location
    $('#company_target_global').click(function(){
    	if( $(this).is(':checked') )
    	{
    		$('#company_target_area').val('');
    		$('#company_target_area').attr('disabled', true);
    	}
    	else
    	{
    		$('#company_target_area').val('');
    		$('#company_target_area').attr('disabled', false);	
    	}
    });

    // Company Additional Details form validation
    $('#frm_company_additional_details').submit(function(e){
        e.preventDefault();
    });
    $('#frm_company_additional_details').validate({
    	ignore: "not:hidden", 			// Put the validation on hidden also
        rules: {
        	company_industry_type: {
        		required: true
        	},
        	'company_services[]': {
                required: true
            },
            company_target_area: {
            	required: function (element) {
                    if($("#company_target_global").is(':checked'))
                    	return false;
                    else
                    	return true;
                }
            }
        },
        messages: {
        	company_industry_type: {
        		required: 'Please select industry type'
        	},
        	'company_services[]': {
                required: 'Please select atleast one service'
            },
            company_target_area: {
            	required: 'Please enter target area in KM'	
            }
        }
    });

    // Update the company additional information
    $('#btn_update_company_additional_details').click(function(){
    	if( $('#frm_company_additional_details').valid() )
    	{
    		$.ajax({
    			url: $('meta[name="route"]').attr('content') + '/company/updatecompanyadditionaldetails',
    			method: 'post',
    			data: {
    				frmData: $('#frm_company_additional_details').serialize()
    			},
    			headers: {
			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    },
			    success: function(response){
			    	if( response.errCode == 0 )
			    	{
			    		alertify.success( response.errMsg );
			    	}
			    	else
			    	{
			    		alertify.error( response.errMsg );
			    	}
			    }
    		});
    	}
    });

    // Company logo form validation
    $('#frm_company_logo').submit(function(e){
        e.preventDefault();
    });
    $('#frm_company_logo').validate({
    	ignore: "not:hidden",
        rules: {
        	company_image_upload: {
        		required: true
        	}
        },
        messages: {
        	company_image_upload: {
        		required: 'Please select image'
        	}	
        }
    });

    // To update the company image
    $('#btn_update_company_logo').click(function(){
    	if( $('#frm_company_logo').valid() )
    	{
    		var fileData = $('#company_image_upload').prop('files')[0];

    		var formData = new FormData();
    		formData.append('fileData', fileData);

    		$.ajax({
    			url: $('meta[name="route"]').attr('content') + '/company/updatecompanyimage',
    			method: 'post',
    			data: formData,
    		    contentType : false,
    		    processData : false,
    			headers: {
    		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    		    },
    		    success: function(response){
    		    	if( response.errCode == 0 )
    		    	{
    		    		alertify.success( response.errMsg );
    		    	}
    		    	else
    		    	{
    		    		alertify.error( response.errMsg );
    		    	}
    		    }
    		});
    	}
    });

    /* ----- Company profile related functionality ends ----- */

    // To update the company payment plan
    $('.company_plan_selection').click(function(){
    	var paymentPlanId = $(this).attr('id');

    	$.ajax({
    		url: $('meta[name="route"]').attr('content') + '/company/updatecompanypaymentplan',
    		method: 'post',
    		data: {
    			paymentPlanId: paymentPlanId
    		},
    		headers: {
    	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    	    },
    	    success: function(response){
    	    	if( response.errCode == 0 )
    	    	{
    	    		alertify.success( response.errMsg );
    	    	}
    	    	else
    	    	{
    	    		alertify.error( response.errMsg );
    	    	}
    	    }
    	});
    });

    // Datatable to show quotation request
    $.fn.dataTableExt.errMode = 'ignore';
    $('#datatable_quotation_request').dataTable({
        "sServerMethod": "get", 
        "bProcessing": true,
        "bServerSide": true,
        "sAjaxSource": $('meta[name="route"]').attr('content') + '/company/fetchquotationrequest',
        "columnDefs": [
            { "className": "dt-center", "targets": [ 0, 4, 5, 6, 7 ] }
        ],
        "aoColumns": [
            { 'bSortable' : false },
            { 'bSortable' : false },
            { 'bSortable' : false },
            { 'bSortable' : false },
            { 'bSortable' : false },
            { 'bSortable' : false },
            { 'bSortable' : false },
            { 'bSortable' : false, "width": "10%" }
        ],
        "order": [[ 6, "desc" ]]
    });

    // To update the home cleaning request quotation price related data
    $('#frm_home_cleaning_services').submit(function(e) {
    	e.preventDefault();
    });
    $('#btn_update_home_cleaning_service_request').click(function(){
    	
		$.ajax({
			url: $('meta[name="route"]').attr('content') + '/company/updatehomecleaningservicerequest',
			method: 'post',
			data: {
				frmData: $('#frm_home_cleaning_services').serialize()
			},
			headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    },
		    success: function(response){
		    	if( response.errCode == 0 )
		    	{
		    		$('#modal_home_cleaning_service_request').modal('hide');
		    		
		    		alertify.success( response.errMsg );
		    	}
		    	else
		    	{
		    		alertify.error( response.errMsg );
		    	}
		    }
		});

    });

    // To update the moving request quotation price related data
    $('#frm_home_moving_companies').submit(function(e) {
    	e.preventDefault();
    });
    $('#btn_update_moving_service_request').click(function(){
    	
		$.ajax({
			url: $('meta[name="route"]').attr('content') + '/company/updatemovingservicerequest',
			method: 'post',
			data: {
				frmData: $('#frm_home_moving_companies').serialize()
			},
			headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    },
		    success: function(response){
		    	if( response.errCode == 0 )
		    	{
		    		$('#modal_moving_companies_service_request').modal('hide');

		    		alertify.success( response.errMsg );
		    	}
		    	else
		    	{
		    		alertify.error( response.errMsg );
		    	}
		    }
		});

    });

    // To update the tech concierge request quotation price related data
    $('#frm_tech_concierge').submit(function(e) {
    	e.preventDefault();
    });
    $('#btn_update_tech_concierge_service_request').click(function(){
    	
		$.ajax({
			url: $('meta[name="route"]').attr('content') + '/company/updatetechconciergeservicerequest',
			method: 'post',
			data: {
				frmData: $('#frm_tech_concierge').serialize()
			},
			headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    },
		    success: function(response){
		    	if( response.errCode == 0 )
		    	{
		    		alertify.success( response.errMsg );

		    		$('#modal_tech_concierge_service_request').modal('hide');
		    	}
		    	else
		    	{
		    		alertify.error( response.errMsg );
		    	}
		    }
		});

    });

    // To update the cable internet request quotation price related data
    $('#frm_cable_internet_services').submit(function(e) {
    	e.preventDefault();
    });
    $('#btn_update_cable_internet_service_request').click(function(){
    	
		$.ajax({
			url: $('meta[name="route"]').attr('content') + '/company/updatecableinternetservicerequest',
			method: 'post',
			data: {
				frmData: $('#frm_cable_internet_services').serialize()
			},
			headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    },
		    success: function(response){
		    	if( response.errCode == 0 )
		    	{
		    		alertify.success( response.errMsg );

		    		$('#modal_cable_internet_service_request').modal('hide');
		    	}
		    	else
		    	{
		    		alertify.error( response.errMsg );
		    	}
		    }
		});

    });

    // Home cleaning services request amount calculation
    $('#frm_home_cleaning_services').on('blur', '.home_cleaning_amount, .home_cleaning_discount', function(){

    	// Ajax call to get the pst, gst, hst, service charge values
    	let serviceRequestId = $('#home_cleaning_service_request_id').val();
    	
    	$.ajax({
			url: $('meta[name="route"]').attr('content') + '/company/fetchprovincetaxes',
			method: 'get',
			data: {
				serviceRequestId: serviceRequestId,
				serviceType: 'home_cleaning'
			},
			beforeSend: function(){
				// Show loader
				$('.loading').show();
			},
		    success: function(response){

		    	// Hide loader
		    	$('.loading').hide();

		    	var subtotal 		= 0;
		    	var serviceTotal 	= 0;
		    	var discount 		= 0;
		    	var gstAmount 		= 0;
		    	var hstAmount 		= 0;
		    	var pstAmount 		= 0;
		    	var serviceCharge 	= 0;

		    	$('.home_cleaning_amount').each(function(){
		    		if( $(this).val() != '' )
		    		{
		    			serviceTotal += parseFloat( $(this).val() );
		    		}
		    	});

		    	discount = ( $('.home_cleaning_discount').val() != '' ) ? parseFloat( $('.home_cleaning_discount').val() ) : 0;

		    	if( serviceTotal > 0 )
		    	{
			    	// Subtotal value
			    	subtotal = serviceTotal - discount;

			    	// GST value
			    	if( response.gst != 0 )
			    	{
			    		gstAmount = ( response.gst / 100 ) * subtotal;
			    	}

			    	// HST value
			    	if( response.hst != 0 )
			    	{
			    		hstAmount = ( response.hst / 100 ) * subtotal;
			    	}

			    	// PST value
			    	if( response.pst != 0 )
			    	{
			    		pstAmount = ( response.pst / 100 ) * subtotal;
			    	}

			    	// Service charge
			    	if( response.service_charge != 0 )
			    	{
			    		serviceCharge = ( response.service_charge / 100 ) * subtotal;
			    	}

			    	$('#frm_home_cleaning_services #gst_amount').text( '$' + ( gstAmount ).toFixed(2) );
			    	$('#frm_home_cleaning_services #hst_amount').text( '$' + ( hstAmount ).toFixed(2) );
			    	$('#frm_home_cleaning_services #pst_amount').text( '$' + ( pstAmount ).toFixed(2) );
			    	$('#frm_home_cleaning_services #service_charge_amount').text( '$' + ( serviceCharge ).toFixed(2) );

			    	$('#frm_home_cleaning_services #subtotal').text( '$' + ( subtotal ).toFixed(2) );

			    	$('#frm_home_cleaning_services #total').text( '$' + ( subtotal + gstAmount + hstAmount + pstAmount ).toFixed(2) );

			    	$('#frm_home_cleaning_services #total_remittance').text( '$' + ( subtotal + gstAmount + hstAmount + pstAmount - serviceCharge ).toFixed(2) );
			    }

		    }
		});

    });

    // Tech concierge request amount calculation
    $('#frm_tech_concierge').on('blur', '.tech_concierge_amount, .tech_concierge_discount', function(){

    	// Ajax call to get the pst, gst, hst, service charge values
    	let serviceRequestId = $('#tech_concierge_service_request_id').val();
    	
    	$.ajax({
			url: $('meta[name="route"]').attr('content') + '/company/fetchprovincetaxes',
			method: 'get',
			data: {
				serviceRequestId: serviceRequestId,
				serviceType: 'tech_concierge'
			},
			beforeSend: function(){
				// Show loader
				$('.loading').show();
			},
		    success: function(response){

		    	// Hide loader
		    	$('.loading').hide();

		    	var subtotal 		= 0;
		    	var serviceTotal 	= 0;
		    	var discount 		= 0;
		    	var gstAmount 		= 0;
		    	var hstAmount 		= 0;
		    	var pstAmount 		= 0;
		    	var serviceCharge 	= 0;

		    	$('.tech_concierge_amount').each(function(){
		    		if( $(this).val() != '' )
		    		{
		    			serviceTotal += parseFloat( $(this).val() );
		    		}
		    	});

		    	discount = ( $('.tech_concierge_discount').val() != '' ) ? parseFloat( $('.tech_concierge_discount').val() ) : 0;

		    	if( serviceTotal > 0 )
		    	{
			    	// Subtotal value
			    	subtotal = serviceTotal - discount;

			    	// GST value
			    	if( response.gst != 0 )
			    	{
			    		gstAmount = ( response.gst / 100 ) * subtotal;
			    	}

			    	// HST value
			    	if( response.hst != 0 )
			    	{
			    		hstAmount = ( response.hst / 100 ) * subtotal;
			    	}

			    	// PST value
			    	if( response.pst != 0 )
			    	{
			    		pstAmount = ( response.pst / 100 ) * subtotal;
			    	}

			    	// Service charge
			    	if( response.service_charge != 0 )
			    	{
			    		serviceCharge = ( response.service_charge / 100 ) * subtotal;
			    	}

			    	$('#frm_tech_concierge #gst_amount').text( '$' + ( gstAmount ).toFixed(2) );
			    	$('#frm_tech_concierge #hst_amount').text( '$' + ( hstAmount ).toFixed(2) );
			    	$('#frm_tech_concierge #pst_amount').text( '$' + ( pstAmount ).toFixed(2) );
			    	$('#frm_tech_concierge #service_charge_amount').text( '$' + ( serviceCharge ).toFixed(2) );

			    	$('#frm_tech_concierge #subtotal').text( '$' + ( subtotal ).toFixed(2) );

			    	$('#frm_tech_concierge #total').text( '$' + ( subtotal + gstAmount + hstAmount + pstAmount ).toFixed(2) );

			    	$('#frm_tech_concierge #total_remittance').text( '$' + ( subtotal + gstAmount + hstAmount + pstAmount - serviceCharge ).toFixed(2) );
			    }

		    }
		});

    });

    // Home moving request amount calculation
    $('#frm_home_moving_companies').on('blur', '.moving_service_amount, .moving_service_discount, .moving_service_insurance', function() {

    	// Ajax call to get the pst, gst, hst, service charge values
    	let serviceRequestId = $('#moving_service_request_id').val();
    	
    	$.ajax({
			url: $('meta[name="route"]').attr('content') + '/company/fetchprovincetaxes',
			method: 'get',
			data: {
				serviceRequestId: serviceRequestId,
				serviceType: 'moving_company'
			},
			beforeSend: function(){
				// Show loader
				$('.loading').show();
			},
		    success: function(response){

		    	// Hide loader
		    	$('.loading').hide();

		    	var subtotal 		= 0;
		    	var serviceTotal 	= 0;
		    	var discount 		= 0;
		    	var insurance 		= 0;
		    	var gstAmount 		= 0;
		    	var hstAmount 		= 0;
		    	var pstAmount 		= 0;
		    	var serviceCharge 	= 0;

		    	$('.moving_service_amount').each(function(){
		    		if( $(this).val() != '' )
		    		{
		    			serviceTotal += parseFloat( $(this).val() );
		    		}
		    	});

		    	discount = ( $('.moving_service_discount').val() != '' ) ? parseFloat( $('.moving_service_discount').val() ) : 0;

		    	insurance = ( $('.moving_service_insurance').val() != '' ) ? parseFloat( $('.moving_service_insurance').val() ) : 0;

		    	if( serviceTotal > 0 )
		    	{
			    	// Subtotal value
			    	subtotal = ( serviceTotal + insurance ) - discount;

			    	// GST value
			    	if( response.gst != 0 )
			    	{
			    		gstAmount = ( response.gst / 100 ) * subtotal;
			    	}

			    	// HST value
			    	if( response.hst != 0 )
			    	{
			    		hstAmount = ( response.hst / 100 ) * subtotal;
			    	}

			    	// PST value
			    	if( response.pst != 0 )
			    	{
			    		pstAmount = ( response.pst / 100 ) * subtotal;
			    	}

			    	// Service charge
			    	if( response.service_charge != 0 )
			    	{
			    		serviceCharge = ( response.service_charge / 100 ) * subtotal;
			    	}

			    	$('#frm_home_moving_companies #gst_amount').text( '$' + ( gstAmount.toFixed(2) ) );
			    	$('#frm_home_moving_companies #hst_amount').text( '$' + ( hstAmount.toFixed(2) ) );
			    	$('#frm_home_moving_companies #pst_amount').text( '$' + ( pstAmount.toFixed(2) ) );
			    	$('#frm_home_moving_companies #service_charge_amount').text( '$' + ( serviceCharge.toFixed(2) ) );

			    	$('#frm_home_moving_companies #subtotal').text( '$' + ( subtotal.toFixed(2) ) );

			    	$('#frm_home_moving_companies #total').text( '$' + ( subtotal + gstAmount + hstAmount + pstAmount ).toFixed(2) );

			    	$('#frm_home_moving_companies #total_remittance').text( '$' + ( subtotal + gstAmount + hstAmount + pstAmount - serviceCharge ).toFixed(2) );
		    	}

		    }
		});

    });

    // Cable internet services request amount calculation
    $('#frm_cable_internet_services').on('blur', '.cable_internet_service_amount, .cable_internet_discount', function(){

    	// Ajax call to get the pst, gst, hst, service charge values
    	let serviceRequestId = $('#cable_internet_service_request_id').val();
    	
    	$.ajax({
			url: $('meta[name="route"]').attr('content') + '/company/fetchprovincetaxes',
			method: 'get',
			data: {
				serviceRequestId: serviceRequestId,
				serviceType: 'cable_internet'
			},
			beforeSend: function(){
				// Show loader
				$('.loading').show();
			},
		    success: function(response){

		    	// Hide loader
		    	$('.loading').hide();

		    	var subtotal 		= 0;
		    	var serviceTotal 	= 0;
		    	var discount 		= 0;
		    	var gstAmount 		= 0;
		    	var hstAmount 		= 0;
		    	var pstAmount 		= 0;
		    	var serviceCharge 	= 0;

		    	$('.cable_internet_service_amount').each(function(){
		    		if( $(this).val() != '' )
		    		{
		    			serviceTotal += parseFloat( $(this).val() );
		    		}
		    	});

		    	discount = ( $('.cable_internet_discount').val() != '' ) ? parseFloat( $('.cable_internet_discount').val() ) : 0;

		    	if( serviceTotal > 0 )
		    	{
			    	// Subtotal value
			    	subtotal = serviceTotal - discount;

			    	// GST value
			    	if( response.gst != 0 )
			    	{
			    		gstAmount = ( response.gst / 100 ) * subtotal;
			    	}

			    	// HST value
			    	if( response.hst != 0 )
			    	{
			    		hstAmount = ( response.hst / 100 ) * subtotal;
			    	}

			    	// PST value
			    	if( response.pst != 0 )
			    	{
			    		pstAmount = ( response.pst / 100 ) * subtotal;
			    	}

			    	// Service charge
			    	if( response.service_charge != 0 )
			    	{
			    		serviceCharge = ( response.service_charge / 100 ) * subtotal;
			    	}

			    	$('#frm_cable_internet_services #gst_amount').text( '$' + ( gstAmount ).toFixed(2) );
			    	$('#frm_cable_internet_services #hst_amount').text( '$' + ( hstAmount ).toFixed(2) );
			    	$('#frm_cable_internet_services #pst_amount').text( '$' + ( pstAmount ).toFixed(2) );
			    	$('#frm_cable_internet_services #service_charge_amount').text( '$' + ( serviceCharge ).toFixed(2) );

			    	$('#frm_cable_internet_services #subtotal').text( '$' + ( subtotal ).toFixed(2) );

			    	$('#frm_cable_internet_services #total').text( '$' + ( subtotal + gstAmount + hstAmount + pstAmount ).toFixed(2) );

			    	$('#frm_cable_internet_services #total_remittance').text( '$' + ( subtotal + gstAmount + hstAmount + pstAmount - serviceCharge ).toFixed(2) );
			    }

		    }
		});

    });


    // Datatable to show quotation request
    $.fn.dataTableExt.errMode = 'ignore';
    $('#datatable_reviews').dataTable({
        "sServerMethod": "get", 
        "bProcessing": true,
        "bServerSide": true,
        "sAjaxSource": $('meta[name="route"]').attr('content') + '/company/fetchreviews',
        "columnDefs": [
            { "className": "dt-center", "targets": [ 0, 2, 4 ] }
        ],
        "aoColumns": [
            { 'bSortable' : true },
            { 'bSortable' : false },
            { 'bSortable' : true },
            { 'bSortable' : false, "width": "60%" },
            { 'bSortable' : false, "width": "12%" }
        ]
    });

    // Datatable to show company assigned jobs
    $.fn.dataTableExt.errMode = 'ignore';
    $('#datatable_jobs').dataTable({
        "sServerMethod": "get", 
        "bProcessing": true,
        "bServerSide": true,
        "sAjaxSource": $('meta[name="route"]').attr('content') + '/company/fetchjobs',
        "columnDefs": [
            { "className": "dt-center", "targets": [ 0, 7 ] },
            { "className": "dt-right", "targets": [ 6 ] }
        ],
        "aoColumns": [
            { 'bSortable' : true },
            { 'bSortable' : false },
            { 'bSortable' : false },
            { 'bSortable' : false },
            { 'bSortable' : false },
            { 'bSortable' : false },
            { 'bSortable' : false },
            { 'bSortable' : false }
        ]
    });

    // Company request to release money
    $(document).on('click', '.request_money', function(){
    	let transactionId = $(this).attr('id');

    	// Get the reference of element
		var $this = $(this);

    	if( transactionId != '' )
    	{
    		$.ajax({
    			url: $('meta[name="route"]').attr('content') + '/company/requestmoney',
    			method: 'post',
    			data: {
    				transactionId: transactionId
    			},
				beforeSend: function() {
			        $this.html('<i class="fa fa-spinner" aria-hidden="true"></i>');
			    },
			    complete: function()
			    {
			    	$this.html('<i class="fa fa-paypal" aria-hidden="true"></i>');
			    },
    			headers: {
			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    },
			    success: function(response){
			    	if( response.errCode == 0 )
			    	{
			    		alertify.success( response.errMsg );

			    		// Refresh the datatable
			    		$('#datatable_jobs').DataTable().ajax.reload();
			    	}
			    	else
			    	{
			    		alertify.error( response.errMsg );
			    	}
			    }
    		});
    	}
    });

});