/* Common js for all movers related functionalities */

$(document).ready(function(){

	// To fill the star as per the rating assigned
	$(document).on('click', '.assign_agent_rating', function(){
	  	// Get the start index
	    let start = 0;
	    
	    // Get the count of clicked item
	    let clickedCount = $(this).closest('.ratingstar').find('.assign_agent_rating').index(this) + 1;
	    
	    // Removed the already filled stars
	    $('.assign_agent_rating').removeClass('red');

	    $('.ratingstar').each(function(){
	    	$(this).find('.assign_agent_rating').slice(start, clickedCount).addClass('fa fa-star red');
	    });
	});

	// To show the textarea to edit the rating message
	$('#agent_rating_edit_message').click(function(){
		$('#agent_rating_message_container').hide();
		$('#agent_rating_message').show();
	});

	/* ---------- Activities functionality ---------- */

	var forwardMailStep = 1;
	$('.forward_mail').click(function(){
		$('#forward_mail_modal').modal('show');

		// Reset the counter
		forwardMailStep = 1;

		// Show the first step
		$('#forward_mail_step1').show();
		$('#forward_mail_step2').hide();
		$('#forward_mail_step3').hide();
		$('#forward_mail_step4').hide();
	});

	// Forward email activity form validation
    $('#frm_forward_mail').validate({
        rules: {
            forward_mail_method: {
                required: true
            }
        },
        messages: {
            forward_mail_method: {
                required: 'Please select a method'
            }
        }
    });

    // Forward mail - Show next step
    $('#btn_next_forward_mail').click(function(){
    	if( forwardMailStep == 1 )
    	{
	    	if( $('#frm_forward_mail').valid() )
	    	{
	    		if( $('input[name="forward_mail_method"]:checked').val() == 1 )
	    		{
	    			$('#forward_mail_step1').hide();
	    			$('#forward_mail_step3').hide();
	    			$('#forward_mail_step4').hide();
	    			$('#forward_mail_step2').show();
	    		}
	    		else
	    		{
	    			$('#forward_mail_step1').hide();
	    			$('#forward_mail_step2').hide();
	    			$('#forward_mail_step3').show();
	    			$('#forward_mail_step4').hide();
	    		}

	    		forwardMailStep++;
	    	}
    	}
    	else if( forwardMailStep == 2 )
    	{
    		$('#forward_mail_step1').hide();
			$('#forward_mail_step2').hide();
			$('#forward_mail_step3').hide();
			$('#forward_mail_step4').show();

    		forwardMailStep++;
    	}
    });

    // Forward mail - Show previous step
    $('#btn_prev_forward_mail').click(function(){
    	if( forwardMailStep == 3 )
    	{
    		if( $('input[name="forward_mail_method"]:checked').val() == 1 )
    		{
    			$('#forward_mail_step1').hide();
    			$('#forward_mail_step3').hide();
    			$('#forward_mail_step4').hide();
    			$('#forward_mail_step2').show();
    		}
    		else
    		{
    			$('#forward_mail_step1').hide();
    			$('#forward_mail_step2').hide();
    			$('#forward_mail_step3').show();
    			$('#forward_mail_step4').hide();
    		}

    		forwardMailStep--;
    	}
    	else if( forwardMailStep == 2 )
    	{
    		$('#forward_mail_step1').show();
    		$('#forward_mail_step2').hide();
	    	$('#forward_mail_step3').hide();
	    	$('#forward_mail_step4').hide();

    		forwardMailStep--;
    	}
    });

    // To opne the website in a separate window
    $('#forward_mail_search_postoffice').click(function(){
    	var paramString = $('#forward_mail_search_postoffices_address').val();

    	var searchFor = '';
    	if( paramString != '' )
    	{
    		searchFor = 'post+offices+in+';

    		var URL = window.open("https://www.google.co.in/maps/search/" + searchFor + paramString + "/@51.1745672,-115.6424392,12z/data=!3m1!4b1", "_blank", "location=yes,height=800,width=1000,scrollbars=yes,status=yes");
    	}
    	else
    	{
    		var URL = window.open("https://www.google.co.in/maps/search/canada+post+offices/@51.1745672,-115.6424392,12z/data=!3m1!4b1", "_blank", "location=yes,height=800,width=1000,scrollbars=yes,status=yes");
    	}
    });

	/* ---------- Activities functionality ends ---------- */

	/* ---------- Update Address functionality ---------- */

	var updateAddressStep = 1;
	$('.update_address').click(function(){
		$('#update_address_modal').modal('show');

		// Reset the steps
		$('#update_address_step1').show();
		$('#update_address_step2').hide();
		$('#update_address_step3').hide();
		$('#update_address_step4').hide();
		$('#update_address_step5').hide();
		$('#update_address_step6').hide();
		$('#update_address_step7').hide();
	});

	// Update address activity form validation
    $('#frm_update_address').validate({
        rules: {
            update_address_method1: {
                required: true
            },
            update_address_method2: {
                required: true
            },
            update_address_method3: {
                required: true
            }
        },
        messages: {
            update_address_method1: {
                required: 'Please select an option'
            },
            update_address_method2: {
                required: 'Please select an option'
            },
            update_address_method3: {
                required: 'Please select an option'
            }
        }
    });

    // Update address next button functionality
    $('#btn_next_update_address').click(function(){
    	if( updateAddressStep == 1 )
    	{
    		if( $('#frm_update_address').valid() )
    		{
	    		if( ( $('input[name="update_address_method1"]:checked').val() == 1 && $('input[name="update_address_method2"]:checked').val() == 1 && $('input[name="update_address_method3"]:checked').val() == 1 ) || ( $('input[name="update_address_method1"]:checked').val() == 1 && $('input[name="update_address_method2"]:checked').val() == 2 && $('input[name="update_address_method3"]:checked').val() == 2 ) )
	    		{
	    			$('#update_address_step1').hide();
	    			$('#update_address_step2').show();
	    			$('#update_address_step3').hide();
	    			$('#update_address_step4').hide();
	    			$('#update_address_step5').hide();
	    			$('#update_address_step6').hide();
	    			$('#update_address_step7').hide();
	    		}
	    		else
	    		{
	    			$('#update_address_step1').hide();
	    			$('#update_address_step2').hide();
	    			$('#update_address_step3').show();
	    			$('#update_address_step4').hide();
	    			$('#update_address_step5').hide();
	    			$('#update_address_step6').hide();
	    			$('#update_address_step7').hide();
	    		}

	    		updateAddressStep++;
    		}

    	}
    	else if( updateAddressStep == 2 )
    	{
    		$('#update_address_step1').hide();
			$('#update_address_step2').hide();
			$('#update_address_step3').show();
			$('#update_address_step4').hide();
			$('#update_address_step5').hide();
			$('#update_address_step6').hide();
			$('#update_address_step7').hide();

			updateAddressStep++;
    	}
    	else if( updateAddressStep == 3 )
    	{
    		$('#update_address_step1').hide();
			$('#update_address_step2').hide();
			$('#update_address_step3').hide();
			$('#update_address_step4').show();
			$('#update_address_step5').hide();
			$('#update_address_step6').hide();
			$('#update_address_step7').hide();

			updateAddressStep++;
    	}
    	else if( updateAddressStep == 4 )
    	{
    		$('#update_address_step1').hide();
			$('#update_address_step2').hide();
			$('#update_address_step3').hide();
			$('#update_address_step4').hide();
			$('#update_address_step5').show();
			$('#update_address_step6').hide();
			$('#update_address_step7').hide();

			updateAddressStep++;
    	}
    	else if( updateAddressStep == 5 )
    	{
    		$('#update_address_step1').hide();
			$('#update_address_step2').hide();
			$('#update_address_step3').hide();
			$('#update_address_step4').hide();
			$('#update_address_step5').hide();
			$('#update_address_step6').show();
			$('#update_address_step7').hide();

			updateAddressStep++;
    	}
    	else if( updateAddressStep == 6 )
    	{
    		$('#update_address_step1').hide();
			$('#update_address_step2').hide();
			$('#update_address_step3').hide();
			$('#update_address_step4').hide();
			$('#update_address_step5').hide();
			$('#update_address_step6').hide();
			$('#update_address_step7').show();

			updateAddressStep++;
    	}
    });

    // Update address previous button functionality
    $('#btn_prev_update_address').click(function(){
    	if( updateAddressStep == 2 )
    	{
    		if( $('#frm_update_address').valid() )
    		{
	    		$('#update_address_step1').show();
    			$('#update_address_step2').hide();
    			$('#update_address_step3').hide();
    			$('#update_address_step4').hide();
    			$('#update_address_step5').hide();
    			$('#update_address_step6').hide();
    			$('#update_address_step7').hide();

    			updateAddressStep--;
    		}

    	}
    	else if( updateAddressStep == 3 )
    	{
    		if( ( $('input[name="update_address_method1"]:checked').val() == 1 && $('input[name="update_address_method2"]:checked').val() == 1 && $('input[name="update_address_method3"]:checked').val() == 1 ) || ( $('input[name="update_address_method1"]:checked').val() == 1 && $('input[name="update_address_method2"]:checked').val() == 2 && $('input[name="update_address_method3"]:checked').val() == 2 ) )
    		{
    			$('#update_address_step1').hide();
    			$('#update_address_step2').show();
    			$('#update_address_step3').hide();
    			$('#update_address_step4').hide();
    			$('#update_address_step5').hide();
    			$('#update_address_step6').hide();
    			$('#update_address_step7').hide();
    		}
    		else
    		{
    			$('#update_address_step1').hide();
    			$('#update_address_step2').hide();
    			$('#update_address_step3').show();
    			$('#update_address_step4').hide();
    			$('#update_address_step5').hide();
    			$('#update_address_step6').hide();
    			$('#update_address_step7').hide();
    		}

    		updateAddressStep--;
    	}
    	else if( updateAddressStep == 4 )
    	{
    		if( ( $('input[name="update_address_method1"]:checked').val() == 1 && $('input[name="update_address_method2"]:checked').val() == 1 && $('input[name="update_address_method3"]:checked').val() == 1 ) || ( $('input[name="update_address_method1"]:checked').val() == 1 && $('input[name="update_address_method2"]:checked').val() == 2 && $('input[name="update_address_method3"]:checked').val() == 2 ) )
    		{
    			$('#update_address_step1').hide();
    			$('#update_address_step2').show();
    			$('#update_address_step3').hide();
    			$('#update_address_step4').hide();
    			$('#update_address_step5').hide();
    			$('#update_address_step6').hide();
    			$('#update_address_step7').hide();
    		}
    		else
    		{
    			$('#update_address_step1').hide();
    			$('#update_address_step2').hide();
    			$('#update_address_step3').show();
    			$('#update_address_step4').hide();
    			$('#update_address_step5').hide();
    			$('#update_address_step6').hide();
    			$('#update_address_step7').hide();
    		}

    		updateAddressStep--;
    	}
    	else if( updateAddressStep == 5 )
    	{
    		$('#update_address_step1').hide();
			$('#update_address_step2').hide();
			$('#update_address_step3').hide();
			$('#update_address_step4').show();
			$('#update_address_step5').hide();
			$('#update_address_step6').hide();
			$('#update_address_step7').hide();

			updateAddressStep--;
    	}
    	else if( updateAddressStep == 6 )
    	{
    		$('#update_address_step1').hide();
			$('#update_address_step2').hide();
			$('#update_address_step3').hide();
			$('#update_address_step4').hide();
			$('#update_address_step5').show();
			$('#update_address_step6').hide();
			$('#update_address_step7').hide();

			updateAddressStep--;
    	}
    	else if( updateAddressStep == 7 )
    	{
    		$('#update_address_step1').hide();
			$('#update_address_step2').hide();
			$('#update_address_step3').hide();
			$('#update_address_step4').hide();
			$('#update_address_step5').hide();
			$('#update_address_step6').show();
			$('#update_address_step7').hide();

			updateAddressStep--;
    	}
    });

	/* ---------- Update Address functionality ends ---------- */

	/* ---------- Mail box functionality ---------- */

	var mailBoxStep = 1;
	$('.mailbox_keys').click(function(){
		$('#mailbox_key_modal').modal('show');

		// Refresh the modal contents
		mailBoxStep = 1;

		$('#mailbox_keys_step1').show();
		$('#mailbox_keys_step2').hide();
		$('#mailbox_keys_step3').hide();
		$('#mailbox_keys_step4').hide();

	});

	// Mail box keys activity form validation
    $('#frm_mailbox_keys').validate({
        rules: {
            mailbox_keys_method: {
                required: true
            }
        },
        messages: {
            mailbox_keys_method: {
                required: 'Please select an option'
            }
        }
    });

    $('#btn_next_mailbox_keys').click(function(){
    	if( $('#frm_mailbox_keys').valid() )
    	{
    		if( mailBoxStep == 1 )
    		{
	    		if( $('input[name="mailbox_keys_method"]:checked').val() == 1 )
	    		{
	    			$('#mailbox_keys_step1').hide();
	    			$('#mailbox_keys_step2').show();
	    			$('#mailbox_keys_step3').hide();
	    			$('#mailbox_keys_step4').hide();
	    		}
	    		else
	    		{
	    			$('#mailbox_keys_step1').hide();
	    			$('#mailbox_keys_step2').hide();
	    			$('#mailbox_keys_step3').show();
	    			$('#mailbox_keys_step4').hide();
	    		}

	    		mailBoxStep++;
    		}
    		else if( mailBoxStep == 2 )
    		{
    			$('#mailbox_keys_step1').hide();
    			$('#mailbox_keys_step2').hide();
    			$('#mailbox_keys_step3').hide();
    			$('#mailbox_keys_step4').show();

    			mailBoxStep++;
    		}
    	}
    });

    $('#btn_prev_mailbox_keys').click(function(){
    	if( mailBoxStep == 3 )
    	{
    		if( $('input[name="mailbox_keys_method"]:checked').val() == 1 )
    		{
    			$('#mailbox_keys_step1').hide();
    			$('#mailbox_keys_step2').show();
    			$('#mailbox_keys_step3').hide();
    			$('#mailbox_keys_step4').hide();
    		}
    		else
    		{
    			$('#mailbox_keys_step1').hide();
    			$('#mailbox_keys_step2').hide();
    			$('#mailbox_keys_step3').show();
    			$('#mailbox_keys_step4').hide();
    		}

    		mailBoxStep--;
    	}
    	else if( mailBoxStep == 2 )
    	{
    		$('#mailbox_keys_step1').show();
			$('#mailbox_keys_step2').hide();
			$('#mailbox_keys_step3').hide();
			$('#mailbox_keys_step4').hide();

			mailBoxStep--;
    	}
    });
	
	/* ---------- Mail box functionality ends ---------- */

	/* ---------- Connect Utilities functionality ---------- */

	var connectUtilitiesStep = 1;
	$('.connect_utilities').click(function(){
		$('#connect_utilities_modal').modal('show');

		// Reset the steps
		$('#connect_utilities_step1').show();
		$('#connect_utilities_step2').hide();
		$('#connect_utilities_step3').hide();
		$('#connect_utilities_step4').hide();

		connectUtilitiesStep = 1;
	});

    // Connect utilities next step functionality
    $('#btn_next_connect_utilities').click(function(){
    	if( connectUtilitiesStep == 1 )
		{
			$('#connect_utilities_step1').hide();
			$('#connect_utilities_step2').show();
			$('#connect_utilities_step3').hide();
			$('#connect_utilities_step4').hide();

			connectUtilitiesStep++;
		}
		else if( connectUtilitiesStep == 2 )
		{
			$('#connect_utilities_step1').hide();
			$('#connect_utilities_step2').hide();
			$('#connect_utilities_step3').show();
			$('#connect_utilities_step4').hide();

			connectUtilitiesStep++;
		}
		else if( connectUtilitiesStep == 3 )
		{
			$('#connect_utilities_step1').hide();
			$('#connect_utilities_step2').hide();
			$('#connect_utilities_step3').hide();
			$('#connect_utilities_step4').show();

			connectUtilitiesStep++;
		}
    });

    // Connect utilities previous step functionality
    $('#btn_prev_connect_utilities').click(function(){
    	if( connectUtilitiesStep == 2 )
		{
			$('#connect_utilities_step1').show();
			$('#connect_utilities_step2').hide();
			$('#connect_utilities_step3').hide();
			$('#connect_utilities_step4').hide();

			connectUtilitiesStep--;
		}
		else if( connectUtilitiesStep == 3 )
		{
			$('#connect_utilities_step1').hide();
			$('#connect_utilities_step2').show();
			$('#connect_utilities_step3').hide();
			$('#connect_utilities_step4').hide();

			connectUtilitiesStep--;
		}
		else if( connectUtilitiesStep == 4 )
		{
			$('#connect_utilities_step1').hide();
			$('#connect_utilities_step2').hide();
			$('#connect_utilities_step3').show();
			$('#connect_utilities_step4').hide();

			connectUtilitiesStep--;
		}
    });

    // Show the different method details
    $('input[name="connect_utilities_method_type"]').click(function(){
    	if( $(this).val() == 1 )
    	{
    		$('#connect_utilities_method_type_container1').show();
    		$('#connect_utilities_method_type_container2').hide();
    	}
    	else
    	{
    		$('#connect_utilities_method_type_container1').hide();
    		$('#connect_utilities_method_type_container2').show();
    	}
    });

	/* ---------- Connect Utilities functionality ends ---------- */

	/* ---------- Home Cleaning Services functionality ---------- */

	var StepHomeCleaningServices = 1;
	$('.home_cleaning_services').click(function(){
		$('#home_cleaning_services_modal').modal('show');

		// Reset the popup
		$('#home_cleaning_services_step1').show();
		$('#home_cleaning_services_step2').hide();
	});

	// Previuos button functionality
	$('#btn_prev_home_cleaning_services').click(function(){
		if( StepHomeCleaningServices == 2 )
		{
			$('#home_cleaning_services_step1').show();
			$('#home_cleaning_services_step2').hide();
		}

		StepHomeCleaningServices--;
	});

	// Next button functionality
	$('#btn_next_home_cleaning_services').click(function(){
		if( StepHomeCleaningServices == 1 )
		{
			$('#home_cleaning_services_step1').hide();
			$('#home_cleaning_services_step2').show();
		}

		StepHomeCleaningServices++;
	});

	/* ---------- Home Cleaning Services functionality ends ---------- */

	/* ---------- Moving Companies functionality ---------- */

	var StepMovingCompanies = 1;
	$('.moving_companies').click(function(){
		$('#moving_companies_modal').modal('show');

		// Reset the popup
		$('#moving_companies_step1').show();
		$('#moving_companies_step2').hide();
	});

	// Previuos button functionality
	$('#btn_prev_home_moving_companies').click(function(){
		if( StepMovingCompanies == 2 )
		{
			$('#moving_companies_step1').show();
			$('#moving_companies_step2').hide();
		}

		StepMovingCompanies--;
	});

	// Next button functionality
	$('#btn_next_home_moving_companies').click(function(){
		if( StepMovingCompanies == 1 )
		{
			$('#moving_companies_step1').hide();
			$('#moving_companies_step2').show();
		}

		StepMovingCompanies++;
	});

	/* ---------- Moving Companies functionality ends ---------- */

	/* ---------- Tech Concierge functionality ---------- */

	var StepTechConcierge = 1;
	$('.tech_concierge').click(function(){
		$('#tech_concierge_modal').modal('show');

		// Reset the popup
		$('#tech_concierge_step1').show();
		$('#tech_concierge_step2').hide();
	});

	// Previuos button functionality
	$('#btn_prev_tech_concierge').click(function(){
		if( StepTechConcierge == 2 )
		{
			$('#tech_concierge_step1').show();
			$('#tech_concierge_step2').hide();
		}

		StepTechConcierge--;
	});

	// Next button functionality
	$('#btn_next_tech_concierge').click(function(){
		if( StepTechConcierge == 1 )
		{
			$('#tech_concierge_step1').hide();
			$('#tech_concierge_step2').show();
		}

		StepTechConcierge++;
	});

	/* ---------- Tech Concierge functionality ends ---------- */

	/* ---------- Share Announcement functionality ---------- */

	$('.share_announcement').click(function(){
		$('#share_announcement_modal').modal('show');
	});

	/* ---------- Share Announcement functionality ends ---------- */

	/* ---------- Tech Concierge functionality ---------- */

	var StepCableInternetService = 1;
	$('.cable_internet_services').click(function(){
		$('#cable_internet_services_modal').modal('show');

		// Reset the popup
		$('#cable_internet_services_step1').show();
		$('#cable_internet_services_step2').hide();
	});

	// Previuos button functionality
	$('#btn_prev_cable_internet_services').click(function(){
		if( StepTechConcierge == 2 )
		{
			$('#cable_internet_services_step1').show();
			$('#cable_internet_services_step2').hide();
		}

		StepTechConcierge--;
	});

	// Next button functionality
	$('#btn_next_cable_internet_services').click(function(){
		if( StepTechConcierge == 1 )
		{
			$('#cable_internet_services_step1').hide();
			$('#cable_internet_services_step2').show();
		}

		StepTechConcierge++;
	});

	/* ---------- Tech Concierge functionality ends ---------- */

	// To handle the modal close event
	$('.close_modal').click(function() {
		var activityName = $(this).data('activity');

		// Set the activity name
		$('#frm_activity_user_response #activity_name').val(activityName);

		$('#user_response_modal').modal({ backdrop: 'static', keyboard: false });
	});

	// To set active class according to the user response
	$('.activity_user_response').click(function(){
		var finalStatus = $(this).attr('id');
		var activityName= $('#frm_activity_user_response #activity_name').val();

		if( activityName != '' )
		{
			// Activity is done
			if( finalStatus == 1 )
			{
				$('.'+activityName).find('i').removeClass('fa-arrow-circle-o-right').addClass('fa-check');

				// Set the status value
				$('.'+activityName).closest('.activities_container').find('.activity_final_status').val(1);
			}
			else 	// Activity is still pending
			{
				$('.'+activityName).find('i').removeClass('fa-check').addClass('fa-arrow-circle-o-right');

				// Set the status value
				$('.'+activityName).closest('.activities_container').find('.activity_final_status').val(0);
			}
		}

	});

});