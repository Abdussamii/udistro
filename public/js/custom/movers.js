/* Common js for all movers related functionalities */

$(document).ready(function(){

	// To fill the star as per the rating assigned
	$(document).on('click', '.assign_agent_rating', function(){
		// Get the start index
		let start 	= 0;

		// Get the index of clicked element and add 1 to it to make it count
		let count 	= $('.assign_agent_rating').index(this) + 1;

		// Remove the already filled stars
		$('.assign_agent_rating').removeClass('red');
		
		// Fill the stars with the given range
		$('.assign_agent_rating').slice(start, count).addClass('fa fa-star red');
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

    	console.log(updateAddressStep);
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

	// To handle the modal close event
	$('.close_modal').click(function(){
		$('#user_response_modal').modal('show');
	});

});