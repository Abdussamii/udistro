/* Common js for all company related functionalities */

$(document).ready(function(){
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
    		
    	}
    });

    /* ----- Company profile related functionality ends ----- */

});