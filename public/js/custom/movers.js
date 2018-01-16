/* Common js for all movers related functionalities */

$(document).ready(function(){

	alertify.set('notifier','position', 'top-center');

	// Validation to check the monbile number
	$.validator.addMethod("mobileNoValidate",function(value) {
		if( value == '' )
		{
			return true;
		}
	    var filter = /^[0-9-+]+$/;
	    if (filter.test(value)) {
	        return true;
	    }
	    else {
	        return false;
	    }
	}, "Please enter valid number");

	// To fill the star as per the rating assigned
	$(document).on('click', '.assign_agent_rating', function(){
	  	// Get the start index
	    let start = 0;
	    
	    // Get the count of clicked item
	    let clickedCount = $(this).closest('.ratingstar').find('.assign_agent_rating').index(this) + 1;

	    // Set the value in form
	    $('#agent_rating').val(clickedCount);
	    
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

		if( $(this).hasClass('completed') )
		{
			alertify.error('This activity is already completed');
			return false;
		}

		$('#forward_mail_modal').modal({ backdrop: 'static', keyboard: false });

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
	    		// Change the next button to close on last step
	    		$(this).html('Close <i class="fa fa-times" aria-hidden="true"></i>');

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
    	else if( forwardMailStep == 2 )	// On click of next button close the modal
    	{
    		$(this).closest('.modal-body').find('.close_modal').click();
    	}
    });

    // Forward mail - Show previous step
    $('#btn_prev_forward_mail').click(function(){
    	if( forwardMailStep == 2 )
    	{
    		// Change close to next again
    		$(this).next('#btn_next_forward_mail').html('Next <i class="fa fa-angle-double-right" aria-hidden="true"></i>');

    		if( $('input[name="forward_mail_method"]:checked').val() == 1 )
    		{
    			$('#forward_mail_step1').show();
    			$('#forward_mail_step2').hide();
    			$('#forward_mail_step3').hide();
    		}
    		else
    		{
    			$('#forward_mail_step1').show();
    			$('#forward_mail_step2').hide();
    			$('#forward_mail_step3').hide();
    		}

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

		if( $(this).hasClass('completed') )
		{
			alertify.error('This activity is already completed');
			return false;
		}

		$('#update_address_modal').modal({ backdrop: 'static', keyboard: false });

		// Reset the steps
		$('#update_address_step1').show();
		$('#update_address_step2').hide();
		$('#update_address_step3').hide();
		$('#update_address_step4').hide();
		$('#update_address_step5').hide();
		$('#update_address_step6').hide();
		$('#update_address_step7').hide();
	});

	// To show the client list in datatable
    $.fn.dataTableExt.errMode = 'ignore';
    $('#datatable_quotation').dataTable({
        "sServerMethod": "get", 
        "bProcessing": true,
        "bServerSide": true,
        "searching": false,
        "paging": false,
        "ajax": {
            "url": $('meta[name="route"]').attr('content') + '/movers/getquotationresponse',
            "data": function ( d ) {
                d.clientId = $('#client_id').val();
                d.invitationId = $('#invitation_id').val();
            }
        },
        "columnDefs": [
            { "className": "dt-center", "targets": [ 0, 1, 2, 3, 4, 5, 6 ] }
        ],
        "aoColumns": [
            { 'bSortable' : false },
            { 'bSortable' : false },
            { 'bSortable' : false },
            { 'bSortable' : false },
            { 'bSortable' : false },
            { 'bSortable' : false },
            { 'bSortable' : false }
        ]
    });

    $(document).on('click', '.view_quotation_response', function()
    {
        var array = $(this).attr('id').split('@@@@');
        var type = array[0];
        var id = array[1];

        if( id != '' && type != '' )
        {
            // Get the details of selected payment plan
            $.ajax({
                url: $('meta[name="route"]').attr('content') + '/movers/getrequesttype',
                method: 'get',
                data: {
                    id: id, type: type
                },
                success: function(response){
   					
   					if(type == 1)
   					{
                    	$('#modal_tech_concierge').modal('show');
   					} 
   					else if (type == 2) 
   					{
   						$('#modal_home_cleaning').modal('show');
   					}
   					else if (type == 3)
   					{
   						$('#modal_moving_item').modal('show');
   					} 
   					else if (type == 4)
   					{
   						$('#modal_digital').modal('show');
   					}
                }
            });
        }
        else
        {
            alertify.error('Missing id');
        }
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

    // Update address provintial method validation
    $('#frm_update_address_provintial').validate({
    	rules: {
    		update_address_provintial_method: { required: true }
    	},
    	messages: {
    		update_address_provintial_method: { required: 'Please select an option' }
    	}
    });

    // Update address next button functionality
    $('#btn_next_update_address').click(function(){
    	if( updateAddressStep == 1 )
    	{
    		if( $('#frm_update_address').valid() )
    		{
	    		// Yes, No, No case
	    		if( $('input[name="update_address_method1"]:checked').val() == '1' && $('input[name="update_address_method2"]:checked').val() == '0'  && $('input[name="update_address_method3"]:checked').val() == '0' )
	    		{
	    			$('#update_address_step1').hide();
	    			$('#update_address_step2').show();
	    			$('#update_address_step3').hide();
	    			$('#update_address_step4').hide();
	    			$('#update_address_step5').hide();
	    			$('#update_address_step6').hide();
	    			$('#update_address_step7').hide();

	    			// Change the next button to close
	    			$(this).html('Close <i class="fa fa-times" aria-hidden="true"></i>');
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
    	else if( updateAddressStep == 2 )	// This step ends here
    	{
    		if( $('input[name="update_address_method1"]:checked').val() == '1' && $('input[name="update_address_method2"]:checked').val() == '0'  && $('input[name="update_address_method3"]:checked').val() == '0' )
    		{
    			$(this).closest('.modal-body').find('.close_modal').click();
    		}
    		else
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
    	}
    	else if( updateAddressStep == 3 )
    	{
    		if( $('#frm_update_address_provintial').valid() )
    		{
    			if( $('input[name="update_address_provintial_method"]:checked').val() == '1' )	// Do it here online
    			{
		    		$('#update_address_step1').hide();
					$('#update_address_step2').hide();
					$('#update_address_step3').hide();
					$('#update_address_step4').hide();
					$('#update_address_step5').show();
					$('#update_address_step6').hide();
					$('#update_address_step7').hide();
    			}
    			else 																			// Call Canada Post
    			{
    				$('#update_address_step1').hide();
					$('#update_address_step2').hide();
					$('#update_address_step3').hide();
					$('#update_address_step4').hide();
					$('#update_address_step5').hide();
					$('#update_address_step6').show();
					$('#update_address_step7').hide();
    			}

    			updateAddressStep++;

    			$(this).html('Close <i class="fa fa-times" aria-hidden="true"></i>');
    		}
    	}
    	else if( updateAddressStep == 4 )	// Last step, on click of next button click close the popup
    	{
    		$(this).closest('.modal-body').find('.close_modal').click();
    	}
    });

    // Update address previous button functionality
    $('#btn_prev_update_address').click(function(){
    	if( updateAddressStep == 4 )
    	{
    		$('#update_address_step1').hide();
			$('#update_address_step2').hide();
			$('#update_address_step3').hide();
			$('#update_address_step4').show();
			$('#update_address_step5').hide();
			$('#update_address_step6').hide();
			$('#update_address_step7').hide();

			updateAddressStep--;

			$(this).next('#btn_next_update_address').html('Next <i class="fa fa-angle-double-right" aria-hidden="true"></i>');
    	}
    	else if( updateAddressStep == 3 )
    	{
    		$('#update_address_step1').hide();
			$('#update_address_step2').hide();
			$('#update_address_step3').show();
			$('#update_address_step4').hide();
			$('#update_address_step5').hide();
			$('#update_address_step6').hide();
			$('#update_address_step7').hide();

			updateAddressStep--;
    	}
    	else if( updateAddressStep == 2 )
    	{
    		if( $('input[name="update_address_method1"]:checked').val() == '1' && $('input[name="update_address_method2"]:checked').val() == '0'  && $('input[name="update_address_method3"]:checked').val() == '0' )
    		{
    			$('#update_address_step1').show();
				$('#update_address_step2').hide();
				$('#update_address_step3').hide();
				$('#update_address_step4').hide();
				$('#update_address_step5').hide();
				$('#update_address_step6').hide();
				$('#update_address_step7').hide();

				$(this).next('#btn_next_update_address').html('Next <i class="fa fa-angle-double-right" aria-hidden="true"></i>');
    		}
    		else
    		{
    			$('#update_address_step1').show();
				$('#update_address_step2').hide();
				$('#update_address_step3').hide();
				$('#update_address_step4').hide();
				$('#update_address_step5').hide();
				$('#update_address_step6').hide();
				$('#update_address_step7').hide();
    		}

    		updateAddressStep--;
    	}
    });

	/* ---------- Update Address functionality ends ---------- */

	/* ---------- Mail box functionality ---------- */

	var mailBoxStep = 1;
	$('.mailbox_keys').click(function(){

		if( $(this).hasClass('completed') )
		{
			alertify.error('This activity is already completed');
			return false;
		}

		$('#mailbox_key_modal').modal({ backdrop: 'static', keyboard: false });

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
    			// Change the next button to close on last step
    			$(this).html('Close <i class="fa fa-times" aria-hidden="true"></i>');

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
    		else if( mailBoxStep == 2 )	// On click of next button close the modal
	    	{
	    		$(this).closest('.modal-body').find('.close_modal').click();
	    	}
    	}
    });

    $('#btn_prev_mailbox_keys').click(function(){
    	if( mailBoxStep == 2 )
    	{
    		$(this).next('#btn_next_mailbox_keys').html('Next <i class="fa fa-angle-double-right" aria-hidden="true"></i>');
    		
    		$('#mailbox_keys_step1').show();
			$('#mailbox_keys_step2').hide();
			$('#mailbox_keys_step3').hide();
			$('#mailbox_keys_step4').hide();

			mailBoxStep--;
    	}
    });
	
	/* ---------- Mail box functionality ends ---------- */

	/* ---------- Connect Utilities functionality ---------- */

	$('#frm_connect_utilities').validate({
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

	$('#frm_connect_utility_hydro_methods').validate({
		rules: {
			connect_utility_hydro_methods: { required: true }
		},
		messages: {
			connect_utility_hydro_methods: { required: 'Please select an option' }
		}
	});

	var connectUtilitiesStep = 1;
	$('.connect_utilities').click(function(){

		if( $(this).hasClass('completed') )
		{
			alertify.error('This activity is already completed');
			return false;
		}

		$('#connect_utilities_modal').modal({ backdrop: 'static', keyboard: false });

		// Reset the steps
		$('#connect_utilities_step1').show();
		$('#connect_utilities_step2').hide();
		$('#connect_utilities_step3').hide();
		$('#connect_utilities_step4').hide();
		$('#connect_utilities_step5').hide();

		connectUtilitiesStep = 1;
	});

    // Connect utilities next step functionality
    $('#btn_next_connect_utilities').click(function(){
    	if( connectUtilitiesStep == 1 )
    	{
	    	// Check if both the services are selected or an individual is selected
	    	if( $('input[name="connect_utilities_services_type1"]').is(':checked') && $('input[name="connect_utilities_services_type2"]').is(':checked') )
	    	{
	    		$('#connect_utilities_step1').hide();
				$('#connect_utilities_step2').show();
				$('#connect_utilities_step3').hide();
				$('#connect_utilities_step4').hide();
				$('#connect_utilities_step5').hide();

				connectUtilitiesStep++;
	    	}
	    	else if( $('input[name="connect_utilities_services_type1"]').is(':checked') )
	    	{
	    		$('#connect_utilities_step1').hide();
				$('#connect_utilities_step2').show();
				$('#connect_utilities_step3').hide();
				$('#connect_utilities_step4').hide();
				$('#connect_utilities_step5').hide();

	    		connectUtilitiesStep++;
	    	}
	    	else if( $('input[name="connect_utilities_services_type2"]').is(':checked') )
	    	{
	    		$('#connect_utilities_step1').hide();
				$('#connect_utilities_step2').hide();
				$('#connect_utilities_step3').hide();
				$('#connect_utilities_step4').hide();
				$('#connect_utilities_step5').show();

	    		connectUtilitiesStep++;

	    		// Change the next button to close
				$(this).html('Close <i class="fa fa-times" aria-hidden="true"></i>');
	    	}
	    	else
	    	{
	    		alertify.error('Please select atleast one service');
	    	}
    	}
    	else if( connectUtilitiesStep == 2 )
    	{
    		if( $('input[name="connect_utilities_services_type1"]').is(':checked') && $('input[name="connect_utilities_services_type2"]').is(':checked') )
	    	{
	    		if( $('#frm_connect_utility_hydro_methods').valid() )
	    		{
	    			if( $('input[name="connect_utility_hydro_methods"]:checked').val() == '1' )		// Call utility service
	    			{
	    				$('#connect_utilities_step1').hide();
						$('#connect_utilities_step2').hide();
						$('#connect_utilities_step3').show();
						$('#connect_utilities_step4').hide();
						$('#connect_utilities_step5').hide();

						connectUtilitiesStep++;
	    			}
	    			else 																			// Do it here online
	    			{
	    				$('#connect_utilities_step1').hide();
						$('#connect_utilities_step2').hide();
						$('#connect_utilities_step3').hide();
						$('#connect_utilities_step4').show();
						$('#connect_utilities_step5').hide();

						connectUtilitiesStep++;
	    			}
	    		}
	    	}
	    	else if( $('input[name="connect_utilities_services_type1"]').is(':checked') )
	    	{
	    		if( $('#frm_connect_utility_hydro_methods').valid() )
	    		{
	    			if( $('input[name="connect_utility_hydro_methods"]:checked').val() == '1' )		// Call utility service
	    			{
	    				$('#connect_utilities_step1').hide();
						$('#connect_utilities_step2').hide();
						$('#connect_utilities_step3').show();
						$('#connect_utilities_step4').hide();
						$('#connect_utilities_step5').hide();

						connectUtilitiesStep++;
	    			}
	    			else 																			// Do it here online
	    			{
	    				$('#connect_utilities_step1').hide();
						$('#connect_utilities_step2').hide();
						$('#connect_utilities_step3').hide();
						$('#connect_utilities_step4').show();
						$('#connect_utilities_step5').hide();

						connectUtilitiesStep++;
	    			}

	    			// Change the next button to close
					$(this).html('Close <i class="fa fa-times" aria-hidden="true"></i>');
	    		}
	    	}
	    	else if( $('input[name="connect_utilities_services_type2"]').is(':checked') )
	    	{
	    		$(this).closest('.modal-body').find('.close_modal').click();
	    	}
    	}
    	else if( connectUtilitiesStep == 3 )
    	{
    		if( $('input[name="connect_utilities_services_type1"]').is(':checked') && $('input[name="connect_utilities_services_type2"]').is(':checked') )
	    	{
	    		$('#connect_utilities_step1').hide();
				$('#connect_utilities_step2').hide();
				$('#connect_utilities_step3').hide();
				$('#connect_utilities_step4').hide();
				$('#connect_utilities_step5').show();

				connectUtilitiesStep++;

				// Change the next button to close
				$(this).html('Close <i class="fa fa-times" aria-hidden="true"></i>');
	    	}
	    	else if( $('input[name="connect_utilities_services_type1"]').is(':checked') )
	    	{
	    		$(this).closest('.modal-body').find('.close_modal').click();
	    	}
	    	else if( $('input[name="connect_utilities_services_type2"]').is(':checked') )
	    	{
	    		$(this).closest('.modal-body').find('.close_modal').click();
	    	}
    	}
    	else if( connectUtilitiesStep == 4 )
    	{
    		$(this).closest('.modal-body').find('.close_modal').click();
    	}
    });

    // Connect utilities previous step functionality
    $('#btn_prev_connect_utilities').click(function(){
    	if( connectUtilitiesStep == 4 )
    	{
    		if( $('input[name="connect_utilities_services_type1"]').is(':checked') && $('input[name="connect_utilities_services_type2"]').is(':checked') )
	    	{
	    		if( $('input[name="connect_utility_hydro_methods"]:checked').val() == '1' )		// Call utility service
    			{
    				$('#connect_utilities_step1').hide();
					$('#connect_utilities_step2').hide();
					$('#connect_utilities_step3').show();
					$('#connect_utilities_step4').hide();
					$('#connect_utilities_step5').hide();

					connectUtilitiesStep--;
    			}
    			else 																			// Do it here online
    			{
    				$('#connect_utilities_step1').hide();
					$('#connect_utilities_step2').hide();
					$('#connect_utilities_step3').hide();
					$('#connect_utilities_step4').show();
					$('#connect_utilities_step5').hide();

					connectUtilitiesStep--;
    			}

    			// Change the close button to next
				$(this).next('#btn_next_connect_utilities').html('Next <i class="fa fa-angle-double-right" aria-hidden="true"></i>');
	    	}
    	}
    	else if( connectUtilitiesStep == 3 )
    	{
    		if( $('input[name="connect_utilities_services_type1"]').is(':checked') && $('input[name="connect_utilities_services_type2"]').is(':checked') )
	    	{
    			$('#connect_utilities_step1').hide();
				$('#connect_utilities_step2').show();
				$('#connect_utilities_step3').hide();
				$('#connect_utilities_step4').hide();
				$('#connect_utilities_step5').hide();

				connectUtilitiesStep--;
	    	}
	    	else if( $('input[name="connect_utilities_services_type1"]').is(':checked') )
	    	{
	    		$('#connect_utilities_step1').hide();
				$('#connect_utilities_step2').show();
				$('#connect_utilities_step3').hide();
				$('#connect_utilities_step4').hide();
				$('#connect_utilities_step5').hide();

				// Change the close button to next
				$(this).next('#btn_next_connect_utilities').html('Next <i class="fa fa-angle-double-right" aria-hidden="true"></i>');

				connectUtilitiesStep--;
	    	}
    	}
    	else if( connectUtilitiesStep == 2 )
    	{
    		if( $('input[name="connect_utilities_services_type1"]').is(':checked') && $('input[name="connect_utilities_services_type2"]').is(':checked') )
	    	{
	    		$('#connect_utilities_step1').show();
				$('#connect_utilities_step2').hide();
				$('#connect_utilities_step3').hide();
				$('#connect_utilities_step4').hide();
				$('#connect_utilities_step5').hide();

				connectUtilitiesStep--;
	    	}
	    	else if( $('input[name="connect_utilities_services_type1"]').is(':checked') )
	    	{
	    		$('#connect_utilities_step1').show();
				$('#connect_utilities_step2').hide();
				$('#connect_utilities_step3').hide();
				$('#connect_utilities_step4').hide();
				$('#connect_utilities_step5').hide();

				connectUtilitiesStep--;
	    	}
	    	else if( $('input[name="connect_utilities_services_type2"]').is(':checked') )
	    	{
	    		$('#connect_utilities_step1').show();
				$('#connect_utilities_step2').hide();
				$('#connect_utilities_step3').hide();
				$('#connect_utilities_step4').hide();
				$('#connect_utilities_step5').hide();

				// Change the close button to next
				$(this).next('#btn_next_connect_utilities').html('Next <i class="fa fa-angle-double-right" aria-hidden="true"></i>');

				connectUtilitiesStep--;
	    	}
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

		if( $(this).hasClass('completed') )
		{
			alertify.error('This activity is already completed');
			return false;
		}

		$('#home_cleaning_services_modal').modal({ backdrop: 'static', keyboard: false });

		// Reset the popup
		$('#home_cleaning_services_step1').show();
		$('#home_cleaning_services_step2').hide();
	});

	// Previuos button functionality
	/*$('#btn_prev_home_cleaning_services').click(function(){
		if( StepHomeCleaningServices == 2 )
		{
			$('#home_cleaning_services_step1').show();
			$('#home_cleaning_services_step2').hide();
		}

		StepHomeCleaningServices--;
	});*/

	// Next button functionality
	/*$('#btn_next_home_cleaning_services').click(function(){
		if( StepHomeCleaningServices == 1 )
		{
			$('#home_cleaning_services_step1').hide();
			$('#home_cleaning_services_step2').show();
		}

		StepHomeCleaningServices++;
	});*/

	// Save the query data
	$('#frm_home_cleaning_services').submit(function(e){
		e.preventDefault();
	});
	$('#frm_home_cleaning_services').validate({
		ignore: "not:hidden",
		rules: 
		{
			home_cleaning_moveout: { required: true },
			home_cleaning_movein: { required: true },
			home_cleaning_house_from_type: { required: true },
			home_cleaning_house_from_level: { required: true },
			home_cleaning_house_from_bedroom_count: { required: true },
			home_cleaning_house_from_property_type: { required: true },

			home_cleaning_house_to_type: { required: true },
			home_cleaning_house_to_level: { required: true },
			home_cleaning_house_to_bedroom_count: { required: true },
			home_cleaning_house_to_property_type: { required: true },

			home_cleaning_callback_primary_no: { mobileNoValidate: true },
			home_cleaning_callback_secondary_no: { mobileNoValidate: true },
		},
		messages: 
		{
			home_cleaning_moveout: { required: 'Please select an option' },
			home_cleaning_movein: { required: 'Please select an option' },
			home_cleaning_house_from_type: { required: 'Select the type' },
			home_cleaning_house_from_level: { required: 'Please select floor level' },
			home_cleaning_house_from_bedroom_count: { required: 'Please select bedroom count' },
			home_cleaning_house_from_property_type: { required: 'Please select property type' },

			home_cleaning_house_to_type: { required: 'Select the type' },
			home_cleaning_house_to_level: { required: 'Please select floor level' },
			home_cleaning_house_to_bedroom_count: { required: 'Please select bedroom count' },
			home_cleaning_house_to_property_type: { required: 'Please select property type' },
		}
	});

	$('#btn_submit_home_cleaning_query').click(function(){
		if( $('#frm_home_cleaning_services').valid() )
		{
			$.ajax({
				url: $('meta[name="route"]').attr('content') + '/movers/savehomecleaningquery',
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
				    	alertify.success(response.errMsg);
				    }
				    else
				    {
				    	alertify.error(response.errMsg);
				    }
			    }
			});
		}
	})

	/* ---------- Home Cleaning Services functionality ends ---------- */

	/* ---------- Moving Companies functionality ---------- */

	var StepMovingCompanies = 1;
	$('.moving_companies').click(function(){

		if( $(this).hasClass('completed') )
		{
			alertify.error('This activity is already completed');
			return false;
		}

		$('#moving_companies_modal').modal({ backdrop: 'static', keyboard: false });

		// Reset the popup
		$('#moving_companies_step1').show();
		$('#moving_companies_step2').hide();
	});

	// Previuos button functionality
	/*$('#btn_prev_home_moving_companies').click(function(){
		if( StepMovingCompanies == 2 )
		{
			$('#moving_companies_step1').show();
			$('#moving_companies_step2').hide();
		}

		StepMovingCompanies--;
	});*/

	// Next button functionality
	/*$('#btn_next_home_moving_companies').click(function(){
		if( StepMovingCompanies == 1 )
		{
			$('#moving_companies_step1').hide();
			$('#moving_companies_step2').show();
		}

		StepMovingCompanies++;
	});*/

	// Save the query data
	$('#frm_home_moving_companies').submit(function(e){
		e.preventDefault();
	});
	$('#frm_home_moving_companies').validate({
		ignore: "not:hidden",
		rules: 
		{
			moving_house_to_type: { required: true },
			moving_house_to_level: { required: true },
			moving_house_to_bedroom_count: { required: true },
			moving_house_to_property_type: { required: true },
			moving_house_from_type: { required: true },
			moving_house_from_level: { required: true },
			moving_house_from_bedroom_count: { required: true },
			moving_house_from_property_type: { required: true },

			moving_house_description_1:  { required: true },
			moving_house_description_2:  { required: true },
			moving_house_description_3:  { required: true },
			moving_house_description_4:  { required: true },
			moving_house_description_5:  { required: true },
			moving_house_description_6:  { required: true },
			moving_house_description_7:  { required: true },
			moving_house_description_8:  { required: true },
			moving_house_description_9:  { required: true },
			moving_house_description_10: { required: true },
			
			moving_house_packing_issue: { required: true },
			moving_house_callback_option: { required: true },

			moving_house_callback_primary_no: { mobileNoValidate: true },
			moving_house_callback_secondary_no: { mobileNoValidate: true },
		},
		messages: 
		{
			moving_house_to_type: { required: 'Select the type' },
			moving_house_to_level: { required: 'Please select floor level' },
			moving_house_to_bedroom_count: { required: 'Please select bedroom count' },
			moving_house_to_property_type: { required: 'Please select property type' },
			moving_house_from_type: { required: 'Select the type' },
			moving_house_from_level: { required: 'Please select floor level' },
			moving_house_from_bedroom_count: { required: 'Please select bedroom count' },
			moving_house_from_property_type: { required: 'Please select property type' },

			moving_house_description_1:  { required: 'Please select a option' },
			moving_house_description_2:  { required: 'Please select a option' },
			moving_house_description_3:  { required: 'Please select a option' },
			moving_house_description_4:  { required: 'Please select a option' },
			moving_house_description_5:  { required: 'Please select a option' },
			moving_house_description_6:  { required: 'Please select a option' },
			moving_house_description_7:  { required: 'Please select a option' },
			moving_house_description_8:  { required: 'Please select a option' },
			moving_house_description_9:  { required: 'Please select a option' },
			moving_house_description_10: { required: 'Please select a option' },

			moving_house_vehicle_type: { required: 'Please select a option' },
			moving_house_packing_issue: { required: 'Please select a option' },
			moving_house_callback_option: { required: 'Please select a option' }
		}
	});

	// To save the user's moving query detail
	$('#btn_submit_moving_query').click(function(){
		if( $('#frm_home_moving_companies').valid() )
		{
			$.ajax({
				url: $('meta[name="route"]').attr('content') + '/movers/saveusermovingquery',
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
				    	alertify.success(response.errMsg);
				    }
				    else
				    {
				    	alertify.error(response.errMsg);
				    }
			    }
			});
		}
	});

	/* ---------- Moving Companies functionality ends ---------- */

	/* ---------- Tech Concierge functionality ---------- */

	var StepTechConcierge = 1;
	$('.tech_concierge').click(function(){

		if( $(this).hasClass('completed') )
		{
			alertify.error('This activity is already completed');
			return false;
		}

		$('#tech_concierge_modal').modal({ backdrop: 'static', keyboard: false });
	});

	// Previuos button functionality
	/*$('#btn_prev_tech_concierge').click(function(){
		if( StepTechConcierge == 2 )
		{
			$('#tech_concierge_step1').show();
			$('#tech_concierge_step2').hide();
		}

		StepTechConcierge--;
	});*/

	// Next button functionality
	/*$('#btn_next_tech_concierge').click(function(){
		if( StepTechConcierge == 1 )
		{
			$('#tech_concierge_step1').hide();
			$('#tech_concierge_step2').show();
		}

		StepTechConcierge++;
	});*/

	$('#frm_tech_concierge').submit(function(e){
		e.preventDefault();
	});
	$('#frm_tech_concierge').validate({
		ignore: "not:hidden",
		rules: 
		{
			moving_house_to_type : { required: true },
			moving_house_to_level : { required: true },
			moving_house_to_bedroom_count : { required: true },
			moving_house_to_property_type : { required: true },

			tech_concierge_callback_primary_no: { mobileNoValidate: true },
			tech_concierge_callback_secondary_no: { mobileNoValidate: true },
		},
		messages: 
		{
			moving_house_to_type: { required: 'Select the type' },
			moving_house_to_level: { required: 'Please select floor level' },
			moving_house_to_bedroom_count: { required: 'Please select bedroom count' },
			moving_house_to_property_type: { required: 'Please select property type' },
		}
	});

	$('#btn_submit_tech_concierge_query').click(function(){
		if( $('#frm_tech_concierge').valid() )
		{
			$.ajax({
				url: $('meta[name="route"]').attr('content') + '/movers/savetechconciergequery',
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
				    	alertify.success(response.errMsg);
				    }
				    else
				    {
				    	alertify.error(response.errMsg);
				    }
			    }
			});
		}
	});

	// Tech Concierge Availability functionality
	$('#availability_time_from1').change(function(){
		$('#availability_time_upto1').val( $(this).val() );
	});
	$('#availability_time_from2').change(function(){
		$('#availability_time_upto2').val( $(this).val() );
	});
	$('#availability_time_from3').change(function(){
		$('#availability_time_upto3').val( $(this).val() );
	});

	/* ---------- Tech Concierge functionality ends ---------- */

	/* ---------- Share Announcement functionality ---------- */

	$('.share_announcement').click(function(){
		$('#share_announcement_modal').modal({ backdrop: 'static', keyboard: false });
	});

	/* ---------- Share Announcement functionality ends ---------- */

	/* ---------- Cable & Internet Service functionality ---------- */

	var StepCableInternetService = 1;
	$('.cable_internet_services').click(function(){

		if( $(this).hasClass('completed') )
		{
			alertify.error('This activity is already completed');
			return false;
		}

		$('#cable_internet_services_modal').modal({ backdrop: 'static', keyboard: false });

		// Reset the popup
		$('#cable_internet_services_step1').show();
		$('#cable_internet_services_step2').hide();
	});

	// Previuos button functionality
	/*$('#btn_prev_cable_internet_services').click(function(){
		if( StepTechConcierge == 2 )
		{
			$('#cable_internet_services_step1').show();
			$('#cable_internet_services_step2').hide();
		}

		StepTechConcierge--;
	});*/

	// Next button functionality
	/*$('#btn_next_cable_internet_services').click(function(){
		if( StepTechConcierge == 1 )
		{
			$('#cable_internet_services_step1').hide();
			$('#cable_internet_services_step2').show();
		}

		StepTechConcierge++;
	});*/

	// Save the query data
	$('#frm_cable_internet_services').submit(function(e){
		e.preventDefault();
	});
	$('#frm_cable_internet_services').validate({
		ignore: "not:hidden",
		rules: 
		{
			cable_internet_house_to_type: { required: true },
			cable_internet_house_to_level: { required: true },
			cable_internet_house_to_bedroom_count: { required: true },
			cable_internet_house_to_property_type: { required: true },
			cable_internet_house_from_type: { required: true },
			cable_internet_house_from_level: { required: true },
			cable_internet_house_from_bedroom_count: { required: true },
			cable_internet_from_property_type: { required: true },
			'cable_internet_service_type[]': { required: true },

			cable_internet_callback_primary_no: { mobileNoValidate: true },
			cable_internet_callback_secondary_no: { mobileNoValidate: true },
		},
		messages: 
		{
			cable_internet_house_to_type: { required: 'Select the type' },
			cable_internet_house_to_level: { required: 'Please select floor level' },
			cable_internet_house_to_bedroom_count: { required: 'Please select bedroom count' },
			cable_internet_house_to_property_type: { required: 'Please select property type' },
			cable_internet_house_from_type: { required: 'Select the type' },
			cable_internet_house_from_level: { required: 'Please select floor level' },
			cable_internet_house_from_bedroom_count: { required: 'Please select bedroom count' },
			cable_internet_from_property_type: { required: 'Please select property type' },
			'cable_internet_service_type[]': { required: 'Please select atleast one service' }
		}
	});

	$('#btn_cable_internet_submit_query').click(function(){
		if( $('#frm_cable_internet_services').valid() )
		{
			$.ajax({
				url: $('meta[name="route"]').attr('content') + '/movers/savecableinternetquery',
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
				    	alertify.success(response.errMsg);
				    }
				    else
				    {
				    	alertify.error(response.errMsg);
				    }
			    }
			});
		}
	});

	//  Show/hide the billing responsible div
	$('.cable_internet_employment_status').click(function(){
		var employmentStatus = $(this).val();

		$('#cable_internet_billing_responsible_container').hide();
		
		if( employmentStatus == '0' )		// Unemployeed
		{
			$('#cable_internet_billing_responsible_container').show();
		}
		else
		{
			$('#cable_internet_billing_responsible_container').hide();
		}
	});

	/* ---------- Cable & Internet Service ends ---------- */

	// To handle the modal close event
	$('.close_modal').click(function() {
		var activityName = $(this).data('activity');

		// Set the activity name
		$('#frm_activity_user_response #activity_name').val(activityName);

		$('#user_response_modal').modal({ backdrop: 'static', keyboard: false });
	});

	// To send the response to the server and set active class according to the user response on click of close button confirmation modal
	$('.activity_user_response').click(function() {
		var finalStatus = $(this).attr('id');
		var activityName= $('#frm_activity_user_response #activity_name').val();
		var activityId  = $('.'+activityName).attr('id');

		if( activityName != '' )
		{
			// Activity is done
			if( finalStatus == 1 )
			{
				// Remove the tick mark if it is available on discard
				$('.'+activityName).closest('.activities_container').find('.discard_activity').find('i').removeClass('fa fa-check').addClass('fa fa-times-circle');

				// Put the tick mark on the activity marked as done
				$('.'+activityName).find('i').removeClass('fa-arrow-circle-o-right').addClass('fa-check');

				// Set the status value
				$('.'+activityName).closest('.activities_container').find('.activity_final_status').val(1);

				// Put the completed class on the anchor
				$('.'+activityName).closest('.activities_container').find('.done_activity').addClass('completed');

				$.ajax({
					url: $('meta[name="route"]').attr('content') + '/movers/updateactivitystatus',
					method: 'post',
					data: {
						activityId: activityId,
						action: finalStatus
					},
					headers: {
				        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				    },
				    success: function(response){
				    	if( response.errCode == 0 )
					    {
					    	$('#activity_progress1').html(response.percent);
					    	$('#activity_progress2').html(response.percent);
					    	$('#activity_progress_bar').css('width', response.percent + '%');
					    }
				    }
				});

				// Show the "Is this activity helpful thing" modal
				$('#frm_activity_helpful_user_response #activity_name').val(activityName);
				$('#user_activity_helpful_response_modal').modal({ backdrop: 'static', keyboard: false });
			}
			else 	// Activity is still pending
			{
				$('.'+activityName).find('i').removeClass('fa-check').addClass('fa-arrow-circle-o-right');

				// Set the status value
				$('.'+activityName).closest('.activities_container').find('.activity_final_status').val(0);
			}
		}

	});

	// To save the discard response for an activity
	$('.discard_activity').click(function(){
		var activityId = $(this).attr('id');

		$.ajax({
			url: $('meta[name="route"]').attr('content') + '/movers/updateactivitystatus',
			method: 'post',
			data: {
				activityId: activityId,
				action: '0'
			},
			headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    },
		    success: function(response){
		    	if( response.errCode == 0 )
			    {
			    	$('#activity_progress1').html(response.percent);
			    	$('#activity_progress2').html(response.percent);
			    	$('#activity_progress_bar').css('width', response.percent + '%');
			    }
		    }
		});
		
		// To remove the check mark from done
		$(this).closest('.activities_container').find('.done_activity').find('i').removeClass('fa fa-check').addClass('fa fa-arrow-circle-o-right');

		// To put the check mark on discard
		$(this).find('i').removeClass('fa fa-times-circle').addClass('fa fa-check');

		// Put the final status value to 0 i.e. discard
		$(this).closest('.activities_container').find('.activity_final_status').val(0);
	});

	// Update the helpful click response
	$('.agent_helpful').click(function() {

		// Hold the refernce
		var refernce = $(this);

		// Get the current status
		var currentStatus 	= $(refernce).attr('data-status');

		// Get the newly assigned status
		var newStatus = 0;
		if( currentStatus == 0 )
		{
			newStatus = 1;
		}

		$.ajax({
			url: $('meta[name="route"]').attr('content') + '/movers/updatehelpfulcount',
			method: 'post',
			data: {
				newStatus: newStatus
			},
			headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    },
		    success: function(response){
		    	if( response.errCode == 0 )
			    {
			    	alertify.success(response.errMsg);

					if( newStatus == 1 )
			    	{
			    		// Update the current status
				    	$(refernce).attr('data-status', 1);

				    	// Update the color
				    	$(refernce).find('i').css('color', 'green');

				    	// Update the count
				    	$(refernce).find('.agent_helpful_count').text( parseInt( $(refernce).find('.agent_helpful_count').text() ) + 1 );
			    	}
			    	else
			    	{
			    		// Update the current status
				    	$(refernce).attr('data-status', 0);

			    		// Update the color
				    	$(refernce).find('i').css('color', '');

				    	// Update the count
				    	$(refernce).find('.agent_helpful_count').text( parseInt( $(refernce).find('.agent_helpful_count').text() ) - 1 );
			    	}
			    }
			    else
			    {
			    	alertify.error(response.errMsg);
			    }
		    }
		});

	});

	// Agent feedback form
	$('#frm_agent_feedback').validate({
		ignore: "not:hidden",
        rules: {
            agent_rating: {
                required: true
            }
        },
        messages: {
            agent_rating: {
                required: 'Please assign agent rating'
            }
        }
    });

	// Submit the agent feedback form
	$('#btn_agent_feedback').click(function() {
		if( $('#frm_agent_feedback').valid() )
		{
			// Show the confirmation modal
			$('#confirmation_modal').modal({ backdrop: 'static', keyboard: false });
		}
	});

	// Check if all the user activities are completed or not, and submit the form
	$('#confirmation_modal #btn_confirmation').click(function(){

		var activitiesCheck = true;
		// Check if all the activities are done or not
		$('.activity_final_status').each(function(){
			if( $(this).val() == '' )
			{
				// Get the label text for the activity which is incomplete
				var labelTxt = $(this).closest('.boxes').find('.box-title').find('h3').html();

				if( !$(this).closest('ul').find('li').first().find('a').hasClass('share_announcement') )	// Share announcement is not a mandatory activity
				{
					// Show the alert message
					alertify.error(labelTxt + ' activity is still incomplete');

					activitiesCheck = false;

					return false;
					
				}
			}
		});

		// All the activities are completed, save the data
		if( activitiesCheck == true )
		{
			$.ajax({
				url: $('meta[name="route"]').attr('content') + '/movers/updateagentfeedback',
				method: 'post',
				data: {
					frmData: $('#frm_agent_feedback').serialize()
				},
				headers: {
			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    },
			    success: function(response){
			    	if( response.errCode == 0 )
			    	{
			    		alertify.success(response.errMsg);

			    		// Update the rating average count
			    		$('#agent_average_rating').html('( ' + response.agentRating + ' Rating )');
			    	}
			    	else
			    	{
			    		alertify.error(response.errMsg);
			    	}
			    }
			});
		}

	});

	// Capture the user feedback on different activities, whether it is helful for them or not
	$('.activity_feedback').click(function(){
		// var activityClass 	= $(this).attr('data-activity');
		var activityClass 	= $(this).closest('#frm_activity_helpful_user_response').find('#activity_name').val();
		var userFeedback  	= $(this).attr('id');

		// Call the function to save the data
		userActivityFeedback(activityClass, userFeedback);
	});

	// Show a message if user is not following the sequence of activities on first activity click
	$('.done_activity, .discard_activity').click(function(){
		var step = 0;
		$('.activity_final_status').each(function(){
			if( $(this).val() != '' )
			{
				step++;
			}
		});

		if( step == 0 )
		{
			// Check the index of the clicked item, if the index is greater then 1, the user is not following the correct sequence

			if( $('.done_activity, .discard_activity').index(this) > 1 )
			{
				alertify.error('You are not following the correct sequence');
			}
		}
	});

	// To set active class according to the user response on click of confirmation buttons
	/*$('.btn_activity_user_response').click(function(){
		var finalStatus = $(this).attr('id');
		var activityName= $(this).data('activity');
		var activityId  = $('.'+activityName).attr('id');

		if( activityName != '' )
		{
			// Activity is done
			if( finalStatus == 1 )
			{
				$('.'+activityName).find('i').removeClass('fa-arrow-circle-o-right').addClass('fa-check');

				// Set the status value
				$('.'+activityName).closest('.activities_container').find('.activity_final_status').val(1);

				$.ajax({
					url: $('meta[name="route"]').attr('content') + '/movers/updateactivitystatus',
					method: 'post',
					data: {
						activityId: activityId,
						action: finalStatus
					},
					headers: {
				        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				    },
				    success: function(response){
				    	if( response.errCode == 0 )
					    {
					    	$('#activity_progress1').html(response.percent);
					    	$('#activity_progress2').html(response.percent);
					    	$('#activity_progress_bar').css('width', response.percent + '%');
					    }
				    }
				});
			}
			else 	// Activity is still pending
			{
				$('.'+activityName).find('i').removeClass('fa-check').addClass('fa-arrow-circle-o-right');

				// Set the status value
				$('.'+activityName).closest('.activities_container').find('.activity_final_status').val(0);
			}
		}

	});*/

});

// function to update the user feedback on individual activity, whether it is helpful or not
function userActivityFeedback(activity, feedback)
{
	$.ajax({
		url: $('meta[name="route"]').attr('content') + '/movers/updateactivityfeedback',
		method: 'post',
		data: {
			activity: activity,
			feedback: feedback
		},
		headers: {
	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    },
	    success: function(response){
	    	if( response.errCode == 0 )
		    {
		    	alertify.success(response.errMsg);
		    }
		    else
		    {
		    	alertify.error(response.errMsg);	
		    }
	    }
	});
}