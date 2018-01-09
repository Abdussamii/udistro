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
            { "className": "dt-center", "targets": [0, 2, 3] }
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