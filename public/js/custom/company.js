/* Common js for all company related functionalities */

$(document).ready(function(){

	alertify.set('notifier','position', 'top-center');

    // Company registration form validation
    $('#frm_company_registration').submit(function(e){
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
    });

    // Register the company
    $('#btn_company_registration').click(function(){
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
    });

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
        		number: true
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
                success: function(response){

                    // Auto-fill the form
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
                    $('#frm_home_cleaning_services #primary_no').text(response.primary_no);
                    $('#frm_home_cleaning_services #secondary_no').text(response.secondary_no);

                    $('#frm_home_cleaning_services #cleaning_behind_refrigerator_and_stove').text( (response.cleaning_behind_refrigerator_and_stove) ? 'Yes' : 'No' );
                    $('#frm_home_cleaning_services #baseboard_to_be_washed').text( (response.baseboard_to_be_washed) ? 'Yes' : 'No' );

                    $('#frm_home_cleaning_services #calling_numbers').text( ( response.primary_no != '' ) ? response.primary_no : '' );
                    $('#frm_home_cleaning_services #calling_numbers').append( ( response.primary_no != '' && response.secondary_no != '' ) ? ', ' + response.secondary_no : response.secondary_no );

                    $('#frm_home_cleaning_services #additional_information').text(response.additional_information);

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


    $(document).on('click', '.edit_cable_internet_service', function()
    {
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
                success: function(response){
   
                    // Auto-fill the form
                    $('#frm_tech_concierge #moving_from_house_type').text(response.moving_from_house_type);
                    $('#frm_tech_concierge #moving_from_floor').text(response.moving_from_floor);
                    $('#frm_tech_concierge #moving_from_bedroom_count').text(response.moving_from_bedroom_count);
                    $('#frm_tech_concierge #moving_from_property_type').text(response.moving_from_property_type);
                    $('#frm_tech_concierge #primary_no').text(response.primary_no);
                    $('#frm_tech_concierge #secondary_no').text(response.secondary_no);
                    $('#frm_tech_concierge #availability_date1').text(response.availability_date1);
                    $('#frm_tech_concierge #availability_time_from1').text(response.availability_time_from1);
                    $('#frm_tech_concierge #availability_time_upto1').text(response.availability_time_upto1);
                    $('#frm_tech_concierge #availability_date2').text(response.availability_date2);
                    $('#frm_tech_concierge #availability_time_from2').text(response.availability_time_from2);
                    $('#frm_tech_concierge #availability_time_upto2').text(response.availability_time_upto2);
                    $('#frm_tech_concierge #availability_date3').text(response.availability_date3);
                    $('#frm_tech_concierge #availability_time_from3').text(response.availability_time_from3);
                    $('#frm_tech_concierge #availability_time_upto3').text(response.availability_time_upto3);
                    $('#frm_tech_concierge #additional_information').text(response.additional_information);

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
                success: function(response){
   
                    // Auto-fill the form
                    $('#frm_home_moving_companies #moving_from_house_type').text(response.moving_from_house_type);
                    $('#frm_home_moving_companies #moving_from_floor').text(response.moving_from_floor);
                    $('#frm_home_moving_companies #moving_from_bedroom_count').text(response.moving_from_bedroom_count);
                    $('#frm_home_moving_companies #moving_from_property_type').text(response.moving_from_property_type);
                    $('#frm_home_moving_companies #moving_to_house_type').text(response.moving_to_house_type);
                    $('#frm_home_moving_companies #moving_to_floor').text(response.moving_to_floor);
                    $('#frm_home_moving_companies #moving_to_bedroom_count').text(response.moving_to_bedroom_count);
                    $('#frm_home_moving_companies #moving_to_property_type').text(response.moving_to_property_type);
                    $('#frm_home_moving_companies #have_cable_internet_already').text(response.have_cable_internet_already);
                    $('#frm_home_moving_companies #employment_status').text(response.employment_status);
                    $('#frm_home_moving_companies #want_to_receive_electronic_bill').text(response.want_to_receive_electronic_bill);
                    $('#frm_home_moving_companies #want_to_contract_plan').text(response.want_to_contract_plan);
                    $('#frm_home_moving_companies #want_to_setup_preauthorise_payment').text(response.want_to_setup_preauthorise_payment);
                    $('#frm_home_moving_companies #callback_option').text(response.callback_option);
                    $('#frm_home_moving_companies #callback_time').text(response.callback_time);
                    $('#frm_home_moving_companies #primary_no').text(response.primary_no);
                    $('#frm_home_moving_companies #secondary_no').text(response.secondary_no);
                    $('#frm_home_moving_companies #additional_information').text(response.additional_information);

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

    $.fn.dataTableExt.errMode = 'ignore';
    $('#datatable_quotation_request').dataTable({
        "sServerMethod": "get", 
        "bProcessing": true,
        "bServerSide": true,
        "sAjaxSource": $('meta[name="route"]').attr('content') + '/company/fetchquotationrequest',
        
        "columnDefs": [
            { "className": "dt-center", "targets": [0, 4] }
        ],
        
        "aoColumns": [
            { 'bSortable' : true, "width": "10%" },
            { 'bSortable' : true },
            { 'bSortable' : true },
            { 'bSortable' : true },
            { 'bSortable' : false, "width": "10%" }
        ]
    });

});