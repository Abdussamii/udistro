/* Common js for all movers related functionalities */

$(document).ready(function(){

	alertify.set('notifier','position', 'top-center');
	
	// tooltip dispaly
	$('[data-toggle="tooltip"]').tooltip();
	
	// Validation to check the monbile number
	$.validator.addMethod("canadaPhone", function (value, element) {
		if( value != '' )
		{
		    var filter = /^((\+[1-9]{0,4}[ \-]*)|(\([0-9]{2,3}\)[ \-]*)|([0-9]{2,4})[ \-]*)*?[0-9]{3,4}?[ \-]*[0-9]{3,4}?$/;
		    if (filter.test(value)) {
		        return true;
		    }
		    else {
		        return false;
		    }
		}
		else
		{
			return true;
		}
	}, 'Please enter a valid number');

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
			// alertify.error('This activity is already completed');
			$('#service_response').find('.modal-header').html('Alert');
	    	$('#service_response').find('.modal-body').html('This activity is already completed.');
	    	$('#service_response').modal('show');

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

    $('#forward_mail_method1').click(function(){
    	$('#forward_mail_step1').hide();
    	$('#forward_mail_step2').show();
	    $('#forward_mail_step3').hide();

	    $('#forward_mail_flow_control').show();
    });

    $('#forward_mail_method2').click(function(){
    	$('#forward_mail_step1').hide();
    	$('#forward_mail_step2').hide();
	    $('#forward_mail_step3').show();

	    $('#forward_mail_flow_control').show();
    });

    $('.btn_prev_forward_mail').click(function(){
    	$('#forward_mail_step1').show();
    	$('#forward_mail_step2').hide();
	    $('#forward_mail_step3').hide();

	    $('#forward_mail_flow_control').hide();
    });

    // To open the website in a separate window
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

    // To open the nearest public insurance offices on map in a separate window
    $('.btn_update_address_search_insurance_office').click(function(){
    	let province = $(this).attr('id');

    	var paramString = $('#update_address_search_insurance_office').val();

    	var searchFor = '';
    	if( paramString != '' )
    	{
    		searchFor = 'public+insurance+office+in+' + paramString + '+' + province;
    	}
    	else
    	{
    		searchFor = 'public+insurance+office+in+' + province;	
    	}

    	var URL = window.open("https://www.google.co.in/maps/search/" + searchFor, "_blank", "location=yes,height=800,width=1000,scrollbars=yes,status=yes");
    });

	/* ---------- Activities functionality ends ---------- */

	/* ---------- Update Address functionality ---------- */

	var updateAddressStep = 1;
	$('.update_address').click(function(){

		if( $(this).hasClass('completed') )
		{
			// alertify.error('This activity is already completed');
			$('#service_response').find('.modal-header').html('Alert');
	    	$('#service_response').find('.modal-body').html('This activity is already completed.');
	    	$('#service_response').modal('show');

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

    $(document).on('click', '.view_home_cleaning_service', function()
    {
    	var array = $(this).attr('id').split('@@@@');
        var companyId = array[0];
        var homeServiceId = array[1];

        if( homeServiceId != '' )
        {
            // Get the details of selected payment plan
            $.ajax({
                url: $('meta[name="route"]').attr('content') + '/movers/gethomeservicerequest',
                method: 'get',
                data: {
                    homeServiceId: homeServiceId, companyId: companyId
                },
                success: function(response){

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
					
					$('#frm_home_cleaning_services #availability_day4').text( response.availability_date1 + ' (' + response.availability_time1 + ')' );
                    $('#frm_home_cleaning_services #availability_day5').text( response.availability_date2 + ' (' + response.availability_time2 + ')' );
                    $('#frm_home_cleaning_services #availability_day6').text( response.availability_date3 + ' (' + response.availability_time3 + ')' );

                    $('#frm_home_cleaning_services #additional_information').text(response.additional_information);

                    // Requested services
					$('#frm_home_cleaning_services #user_requested_home_cleaning_services').html(response.request_services_details);

					$('#frm_home_cleaning_services #subtotal').text('$'+response.subtotal);
					$('#frm_home_cleaning_services #gst_amount').text('$'+response.gst_amount);
                    $('#frm_home_cleaning_services #hst_amount').text('$'+response.hst_amount);
                    $('#frm_home_cleaning_services #pst_amount').text('$'+response.pst_amount);
                    $('#frm_home_cleaning_services #service_charge_amount').text('$'+response.service_charge_amount);
                    $('#frm_home_cleaning_services #total').text('$'+response.total_amount);
                    $('#frm_home_cleaning_services #discount').text('$'+response.discount);

                    $('#frm_home_cleaning_services #comment').text(response.comment);

                    // Mover acceptance option
                    $('#frm_home_cleaning_services .make_payment').attr('id', homeServiceId);
                    $('#frm_home_cleaning_services .make_payment').attr('data-amount', response.total_amount);

                    // Show the modal
                    $('#modal_home_cleaning_service_request').modal('show');
                }
            });
        }
        else
        {
            alertify.error('Missing id');
        }
    });

    $(document).on('click', '.view_tech_concierge_service', function()
    {
        var array = $(this).attr('id').split('@@@@');
        var companyId = array[0];
        var techConciergeId = array[1];

        if( techConciergeId != '' )
        {
            // Get the details of selected payment plan
            $.ajax({
                url: $('meta[name="route"]').attr('content') + '/movers/gettechconciergerequest',
                method: 'get',
                data: {
                    techConciergeId: techConciergeId, companyId: companyId
                },
                success: function(response){
   
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

                    $('#frm_tech_concierge #subtotal').text('$'+response.subtotal);
                    $('#frm_tech_concierge #gst_amount').text('$'+response.gst_amount);
                    $('#frm_tech_concierge #hst_amount').text('$'+response.hst_amount);
                    $('#frm_tech_concierge #pst_amount').text('$'+response.pst_amount);
                    $('#frm_tech_concierge #service_charge_amount').text('$'+response.service_charge);
                    $('#frm_tech_concierge #total').text('$'+response.total_amount);
                    $('#frm_tech_concierge #discount').text('$'+response.discount);

                    $('#frm_tech_concierge #comment').text(response.comment);

                    // Mover acceptance option
                    $('#frm_tech_concierge .make_payment').attr('id', techConciergeId);
                    $('#frm_tech_concierge .make_payment').attr('data-amount', response.total_amount);

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

    $(document).on('click', '.view_cable_internet_service', function()
    {
        var array = $(this).attr('id').split('@@@@');
        var companyId = array[0];
        var cableInternetId = array[1];

        if( cableInternetId != '' )
        {
            // Get the details of selected payment plan
            $.ajax({
                url: $('meta[name="route"]').attr('content') + '/movers/getcableservicerequest',
                method: 'get',
                data: {
                    cableInternetId: cableInternetId, companyId: companyId
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
					
					$('#frm_cable_internet_services #availability_day7').text( response.availability_date1 + ' (' + response.availability_time1 + ')' );
                    $('#frm_cable_internet_services #availability_day8').text( response.availability_date2 + ' (' + response.availability_time2 + ')' );
                    $('#frm_cable_internet_services #availability_day9').text( response.availability_date3 + ' (' + response.availability_time3 + ')' );

                    // Requested services
					$('#frm_cable_internet_services #user_requested_cable_internet_services').html(response.request_services_details);

					// Requested Addotional services
					$('#frm_cable_internet_services #user_requested_cable_internet_additional_services').html(response.request_additional_services_details);

					$('#frm_cable_internet_services #pst_percenateg').text(response.pst);
                    $('#frm_cable_internet_services #gst_percentage').text(response.gst);
                    $('#frm_cable_internet_services #hst_percentage').text(response.hst);
                    $('#frm_cable_internet_services #service_charge_percetage').text(response.service_charge);

                    $('#frm_cable_internet_services #subtotal').text('$'+response.subtotal);
                    $('#frm_cable_internet_services #gst_amount').text('$'+response.gst_amount);
                    $('#frm_cable_internet_services #hst_amount').text('$'+response.hst_amount);
                    $('#frm_cable_internet_services #pst_amount').text('$'+response.pst_amount);
                    $('#frm_cable_internet_services #service_charge_amount').text('$'+response.service_charge_amount);
                    $('#frm_cable_internet_services #total').text('$'+response.total_amount);
                    $('#frm_cable_internet_services #discount').text('$'+response.discount);

                    $('#frm_cable_internet_services #comment').text(response.comment);

                    // Mover acceptance option
                    $('#frm_cable_internet_services .make_payment').attr('id', cableInternetId);
                    $('#frm_cable_internet_services .make_payment').attr('data-amount', response.total_amount);

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

	
	$(document).on('click', '.view_moving_item_service', function()
    {
        var array = $(this).attr('id').split('@@@@');
        var companyId = array[0];
        var movingCompaniesId = array[1];

        if( movingCompaniesId != '' )
        {
            // Get the details of selected payment plan
            $.ajax({
                url: $('meta[name="route"]').attr('content') + '/movers/getmovingcompaniesrequest',
                method: 'get',
                data: {
                    movingCompaniesId: movingCompaniesId, companyId: companyId
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

					$('#frm_home_moving_companies #insurance').text('$'+response.insurance);
					$('#frm_home_moving_companies #gst_amount').text('$'+response.gst_amount);
                    $('#frm_home_moving_companies #hst_amount').text('$'+response.hst_amount);
                    $('#frm_home_moving_companies #pst_amount').text('$'+response.pst_amount);
                    $('#frm_home_moving_companies #service_charge_amount').text('$'+response.service_charge_amount);
                    $('#frm_home_moving_companies #total').text('$'+response.total_amount);
                    $('#frm_home_moving_companies #discount').text('$'+response.discount);

                    $('#frm_home_moving_companies #subtotal').text('$'+response.subtotal);

                    $('#frm_home_moving_companies #comment').text(response.comment);

                    // Mover acceptance option
                    $('#frm_home_moving_companies .make_payment').attr('id', movingCompaniesId);
                    $('#frm_home_moving_companies .make_payment').attr('data-amount', response.total_amount);

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
    $('#update_address_agency1').click(function(){
    	$('#update_address_step1').hide();
    	$('#update_address_step3').show();
    	$('#update_address_step6').hide();

    	$('#update_address_control').show();
    });
    $('#update_address_agency2').click(function(){
    	$('#update_address_step1').hide();
    	$('#update_address_step6').show();
    	$('#update_address_step3').hide();

    	$('#update_address_control').show();
    });

    // On click of close, show the first screen
    $('.btn_prev_update_address').click(function(){
    	$('#update_address_step1').show();
    	$('#update_address_step6').hide();
    	$('#update_address_step3').hide();

    	$('#update_address_control').hide();
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

    $('#mailbox_keys_method1').click(function(){
    	$('#mailbox_keys_step1').hide();
		$('#mailbox_keys_step2').show();
		$('#mailbox_keys_step3').hide();

		$('#mailbox_keys_flow_control').show();
    });

    $('#mailbox_keys_method2').click(function(){
    	$('#mailbox_keys_step1').hide();
		$('#mailbox_keys_step2').hide();
		$('#mailbox_keys_step3').show();

		$('#mailbox_keys_flow_control').show();
    });

    $('#btn_prev_mailbox_keys').click(function(){
    	$('#mailbox_keys_step1').show();
		$('#mailbox_keys_step2').hide();
		$('#mailbox_keys_step3').hide();

		$('#mailbox_keys_flow_control').hide();
    });
	
	/* ---------- Mail box functionality ends ---------- */

	/* ---------- Connect Utilities functionality ---------- */

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

	// Connect Utilities
	/*$('#connect_utility_agency1').click(function(){
		$('#connect_utilities_step1').hide();
		$('#connect_utilities_step3').show();

		$('#connect_utilities_control').show();
	});

	$('#connect_utility_agency2').click(function(){
		$('#connect_utilities_step1').hide();
		$('#connect_utilities_step5').show();

		$('#connect_utilities_control').show();
	});

	$('.btn_prev_connect_utilities').click(function(){
		$('#connect_utilities_step1').show();
		$('#connect_utilities_step3').hide();
		$('#connect_utilities_step5').hide();

		$('#connect_utilities_control').hide();
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
    });*/

    // Fetch the utility services for the selected company
    $('.moving_from_utility_companies').change(function(){
    	let utilityCompanyId= $(this).val();
    	let refer 			= $(this);

    	if( utilityCompanyId != '' )
    	{
    		$.ajax({
    			url: $('meta[name="route"]').attr('content') + '/movers/getcompanyservices',
    			method: 'get',
    			data: {
    				utilityCompanyId: utilityCompanyId
    			},
    		    beforeSend: function() {
    		    	$(refer).closest('.connect_utilitiy').find('.moving_from_utility_company_services').next('.utilitie-company-add').html('<i class="fa fa-spinner"></i>');
    		    },
    		    complete: function()
    		    {
    		        $(refer).closest('.connect_utilitiy').find('.moving_from_utility_company_services').next('.utilitie-company-add').html('<i class="fa fa-plus-circle"></i>');
    		    },
    		    success: function(response){
    		    	$(refer).closest('.connect_utilitiy').find('.moving_from_utility_company_services').html(response);
    		    	$(refer).closest('.connect_utilitiy').find('.moving_from_utility_company_services').multipleSelect("refresh");
    		    }
    		});
    	}
    	else
    	{
    		$(this).closest('.connect_utilitiy').find('.moving_from_utility_company_services').html('<option value="">Select Service</option>');
    	}
    });
    $('.moving_to_utility_companies').change(function(){
    	let utilityCompanyId= $(this).val();
    	let refer 			= $(this);

    	if( utilityCompanyId != '' )
    	{
    		$.ajax({
    			url: $('meta[name="route"]').attr('content') + '/movers/getcompanyservices',
    			method: 'get',
    			data: {
    				utilityCompanyId: utilityCompanyId
    			},
    		    beforeSend: function() {
    		    	$(refer).closest('.connect_utilitiy').find('.moving_to_utility_company_services').next('.utilitie-company-add').html('<i class="fa fa-spinner"></i>');
    		    },
    		    complete: function()
    		    {
    		        $(refer).closest('.connect_utilitiy').find('.moving_to_utility_company_services').next('.utilitie-company-add').html('<i class="fa fa-plus-circle"></i>');
    		    },
    		    success: function(response){
    		    	$(refer).closest('.connect_utilitiy').find('.moving_to_utility_company_services').html(response);
    		    	$(refer).closest('.connect_utilitiy').find('.moving_to_utility_company_services').multipleSelect("refresh");
    		    }
    		});
    	}
    	else
    	{
    		$(this).closest('.connect_utilitiy').find('.moving_to_utility_company_services').html('<option value="">Select Service</option>');
    	}
    });

    // Utility Services next button functionality
    $('.btn_next_utility_service').click(function(){
    	// Get selected companies details
    	let movingFromCompanyId = $(this).closest('.utility_service_container').find('.moving_from_utility_companies').val();
    	let movingToCompanyId 	= $(this).closest('.utility_service_container').find('.moving_to_utility_companies').val();
    	
    	let movingFromcompany 	= $(this).closest('.utility_service_container').find('.moving_from_utility_companies option:selected').text();
    	let movingTocompany 	= $(this).closest('.utility_service_container').find('.moving_to_utility_companies option:selected').text();

    	let movingFromContact	= $(this).closest('.utility_service_container').find('.moving_from_utility_companies option:selected').attr('data-contact');
    	let movingFromUrl		= $(this).closest('.utility_service_container').find('.moving_from_utility_companies option:selected').attr('data-url');
    	let movingToContact		= $(this).closest('.utility_service_container').find('.moving_to_utility_companies option:selected').attr('data-contact');
    	let movingToUrl			= $(this).closest('.utility_service_container').find('.moving_to_utility_companies option:selected').attr('data-url');

    	var movingFromCompanyServices = [];
    	$( $(this).closest('.utility_service_container').find('.moving_from_utility_company_container').find('.ms-drop').find('ul').find('li') ).each(function(){
    		if( $(this).hasClass('selected') && ( $(this).find('input').val() != 'on' ) )
    		{
    			movingFromCompanyServices.push( $(this).find('input').val() );
    		}
    	});

    	var movingToCompanyServices = [];
    	$( $(this).closest('.utility_service_container').find('.moving_to_utility_company_container').find('.ms-drop').find('ul').find('li') ).each(function(){
    		if( $(this).hasClass('selected') && ( $(this).find('input').val() != 'on' ) )
    		{
    			movingToCompanyServices.push( $(this).find('input').val() );
    		}
    	});

    	if( movingFromCompanyId == '' && movingToCompanyId == '' )
    	{
    		$('#service_response').find('.modal-header').html('Error');
    		$('#service_response').find('.modal-body').html('Please select atleast one company and their services.');
    		$('#service_response').modal('show');
    	}
    	else
    	{
    		if( movingFromCompanyId != '' && movingToCompanyId != '' ) 	// Show both the services
    		{
    			$('#utility_service_step_both #moving_from_company_name').text(movingFromcompany);
    			$('#utility_service_step_both #moving_to_company_name').text(movingTocompany);

    			$('#utility_service_step_both #btn_moving_from_arrange_disconnect_phone').attr('data-contact', movingFromContact);
    			$('#utility_service_step_both #btn_moving_from_arrange_disconnect_online').attr('data-url', movingFromUrl);
    			$('#utility_service_step_both #btn_moving_to_arrange_disconnect_phone').attr('data-contact', movingToContact);
    			$('#utility_service_step_both #btn_moving_to_arrange_disconnect_online').attr('data-url', movingToUrl);

    			$('#utility_service_step_start').hide();
    			$('#utility_service_step_moving_from').hide();
    			$('#utility_service_step_moving_to').hide();
    			$('#utility_service_step_both').show();
    		}
    		else if( movingFromCompanyId != '' )						// Show moving from service
    		{
    			$('#utility_service_step_moving_from #moving_from_company_name').text(movingFromcompany);
    			$('#utility_service_step_moving_from #moving_to_company_name').text(movingTocompany);

    			$('#utility_service_step_moving_from #btn_moving_from_arrange_disconnect_phone').attr('data-contact', movingFromContact);
    			$('#utility_service_step_moving_from #btn_moving_from_arrange_disconnect_online').attr('data-url', movingFromUrl);

    			$('#utility_service_step_start').hide();
    			$('#utility_service_step_both').hide();
    			$('#utility_service_step_moving_to').hide();
    			$('#utility_service_step_moving_from').show();
    		}
    		else if( movingToCompanyId != '' )							// Show moving to service
    		{
    			$('#utility_service_step_moving_to #moving_from_company_name').text(movingFromcompany);
    			$('#utility_service_step_moving_to #moving_to_company_name').text(movingTocompany);

    			$('#utility_service_step_moving_to #btn_moving_to_arrange_disconnect_phone').attr('data-contact', movingToContact);
    			$('#utility_service_step_moving_to #btn_moving_to_arrange_disconnect_online').attr('data-url', movingToUrl);

    			$('#utility_service_step_start').hide();
    			$('#utility_service_step_both').hide();
    			$('#utility_service_step_moving_from').hide();
    			$('#utility_service_step_moving_to').show();
    		}
    	}
    });

    // Utility Services previous button functionality
    $('.btn_previous_utility_service').click(function(){
    	$('#utility_service_step_start').show();
    	$('#utility_service_step_both').hide();
		$('#utility_service_step_moving_from').hide();
		$('#utility_service_step_moving_to').hide();
    });

    // Online option - open the web page
    $('.btn_connect_utilitiy_online').click(function(){
    	let webURL = $(this).attr('data-url');
    	window.open(webURL, "_blank", "location=yes,height=800,width=1000,scrollbars=yes,status=yes");
    });

    // Calling option - Initiate the call
    $('.btn_connect_utilitiy_call').click(function(){
    	let contactNumber = $(this).attr('data-contact');

    	// Initiate the call
        $.ajax({
            url: $('meta[name="route"]').attr('content') + '/call',
            method: 'POST',
            dataType: 'json',
			headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    },
            data: {
                userPhone: contactNumber
            }
        }).done(function(data) {
            // The JSON sent back from the server will contain a success message
            // alert(data.message);
            console.log( data.message );
        }).fail(function(error) {
            // alert(JSON.stringify(error));
            console.log( JSON.stringify(error) );
        });
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

		// Reset the form
		$('#frm_home_cleaning_services')[0].reset();

		$('#home_cleaning_services_modal').modal({ backdrop: 'static', keyboard: false });

		// Reset the popup
		$('#home_cleaning_services_step1').show();
		$('#home_cleaning_services_step2').hide();
	});

	// Save the query data
	$('#frm_home_cleaning_services').submit(function(e){
		e.preventDefault();
	});
	$('#frm_home_cleaning_services').validate({
		ignore: "not:hidden",
		rules: 
		{
			home_cleaning_condition: { required: true },
			home_cleaning_area: { required: true },
			home_cleaning_pets_count: { required: true },			
			home_cleaning_elevator_availability: { required: true },
			availability_date4: { required: true },
			availability_time_from1: { required: true },
		},
		messages: 
		{
			home_cleaning_condition: { required: 'Please select home condition' },
			home_cleaning_area: { required: 'Please select size of property' },
			home_cleaning_pets_count: { required: 'Please select pet count' },			
			home_cleaning_elevator_availability: { required: 'Please select elevator availability' },
			availability_date4: { required: 'Please select availability date' },
			availability_time_from1: { required: 'Please select availability time' },
		}
	});

	$('#btn_submit_home_cleaning_query').click(function(){
		if( $('#frm_home_cleaning_services').valid() )
		{
			var $this = $(this);

			$.ajax({
				url: $('meta[name="route"]').attr('content') + '/movers/savehomecleaningquery',
				method: 'post',
				data: {
					frmData: $('#frm_home_cleaning_services').serialize()
				},
				headers: {
			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    },
			    beforeSend: function() {
			        // Show the loading button
			        $this.button('loading');
			    },
			    complete: function()
			    {
			        // Change the button to previous
			        $this.button('reset');
			    },
			    success: function(response){
			    	if( response.errCode == 0 )
				    {
				    	// alertify.success(response.errMsg);
				    	$('#service_response').find('.modal-header').html('Congratulations');
				    	$('#service_response').find('.modal-body').html('Your project request has been submitted, please check your mail after 24 hours.');
				    	$('#service_response').modal('show');

				    	$('#home_cleaning_services_modal').modal('hide');

				    	// Mark the activity as completed
				    	var finalStatus = '1';
				    	var activityName= 'home_cleaning_services';
				    	var activityId  = '7';

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
				    			// $('#frm_activity_helpful_user_response #activity_name').val(activityName);
				    			// $('#user_activity_helpful_response_modal').modal({ backdrop: 'static', keyboard: false });
				    		}
				    		else 	// Activity is still pending
				    		{
				    			$('.'+activityName).find('i').removeClass('fa-check').addClass('fa-arrow-circle-o-right');

				    			// Set the status value
				    			$('.'+activityName).closest('.activities_container').find('.activity_final_status').val(0);
				    		}
				    	}
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

		// Reset the form
		$('#frm_home_moving_companies')[0].reset();

		$('#moving_companies_modal').modal({ backdrop: 'static', keyboard: false });

		// Reset the popup
		$('#moving_companies_step1').show();
		$('#moving_companies_step2').hide();
	});

	// Save the query data
	$('#frm_home_moving_companies').submit(function(e){
		e.preventDefault();
	});
	$('#frm_home_moving_companies').validate({
		ignore: "not:hidden",
		rules: 
		{	
			moving_house_callback_option: { required: true },
			moving_house_need_insurance: { required: true }
		},
		messages: 
		{
			moving_house_callback_option: { required: 'Please select callback option' },
			moving_house_need_insurance: { required: 'Please select an insurance option' }
		}
	});

	// To save the user's moving query detail
	$('#btn_submit_moving_query').click(function(){
		if( $('#frm_home_moving_companies').valid() )
		{
			var $this = $(this);

			$.ajax({
				url: $('meta[name="route"]').attr('content') + '/movers/saveusermovingquery',
				method: 'post',
				data: {
					frmData: $('#frm_home_moving_companies').serialize()
				},
				headers: {
			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    },
			    beforeSend: function() {
			        // Show the loading button
			        $this.button('loading');
			    },
			    complete: function()
			    {
			        // Change the button to previous
			        $this.button('reset');
			    },
			    success: function(response){
			    	if( response.errCode == 0 )
				    {
				    	// alertify.success(response.errMsg);
				    	$('#service_response').find('.modal-header').html('Congratulations');
				    	$('#service_response').find('.modal-body').html('Your project request has been submitted, please check your mail after 24 hours.');
				    	$('#service_response').modal('show');

				    	$('#moving_companies_modal').modal('hide');

				    	// Mark the activity as completed
				    	var finalStatus = '1';
				    	var activityName= 'moving_companies';
				    	var activityId  = '8';

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
				    			// $('#frm_activity_helpful_user_response #activity_name').val(activityName);
				    			// $('#user_activity_helpful_response_modal').modal({ backdrop: 'static', keyboard: false });
				    		}
				    		else 	// Activity is still pending
				    		{
				    			$('.'+activityName).find('i').removeClass('fa-check').addClass('fa-arrow-circle-o-right');

				    			// Set the status value
				    			$('.'+activityName).closest('.activities_container').find('.activity_final_status').val(0);
				    		}
				    	}
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

		// Reset the form
		$('#frm_tech_concierge')[0].reset();

		$('#tech_concierge_modal').modal({ backdrop: 'static', keyboard: false });
	});

	$('#frm_tech_concierge').submit(function(e){
		e.preventDefault();
	});
	$('#frm_tech_concierge').validate({
		ignore: "not:hidden",
		rules: 
		{
			'tech_concierge_places[]' : { required: true },
			'tech_concierge_appliances[]' : { required: true },
			availability_date1: { required: true },
			availability_time_from1: { required: true }
		},
		messages: 
		{
			'tech_concierge_places[]' : { required: 'Please select atleast one option from Other Place To Install Appliances' },
			'tech_concierge_appliances[]' : { required: 'Please select atleast one option from Job Description' },
			availability_date1: { required: 'Please select availability date' },
			availability_time_from1: { required: 'Please select availability time' }
		}
	});

	$('#btn_submit_tech_concierge_query').click(function(){
		if( $('#frm_tech_concierge').valid() )
		{
			var $this = $(this);

			$.ajax({
				url: $('meta[name="route"]').attr('content') + '/movers/savetechconciergequery',
				method: 'post',
				data: {
					frmData: $('#frm_tech_concierge').serialize()
				},
				headers: {
			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    },
			    beforeSend: function() {
			        // Show the loading button
			        $this.button('loading');
			    },
			    complete: function()
			    {
			        // Change the button to previous
			        $this.button('reset');
			    },
			    success: function(response){
			    	if( response.errCode == 0 )
				    {
				    	// alertify.success(response.errMsg);
				    	$('#service_response').find('.modal-header').html('Congratulations');
				    	$('#service_response').find('.modal-body').html('Your project request has been submitted, please check your mail after 24 hours.');
				    	$('#service_response').modal('show');

				    	$('#tech_concierge_modal').modal('hide');

				    	// Mark the activity as completed
				    	var finalStatus = '1';
				    	var activityName= 'tech_concierge';
				    	var activityId  = '9';

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
				    			// $('#frm_activity_helpful_user_response #activity_name').val(activityName);
				    			// $('#user_activity_helpful_response_modal').modal({ backdrop: 'static', keyboard: false });
				    		}
				    		else 	// Activity is still pending
				    		{
				    			$('.'+activityName).find('i').removeClass('fa-check').addClass('fa-arrow-circle-o-right');

				    			// Set the status value
				    			$('.'+activityName).closest('.activities_container').find('.activity_final_status').val(0);
				    		}
				    	}
				    }
				    else
				    {
				    	alertify.error(response.errMsg);
				    }
			    }
			});
		}
	});
	/* ---------- Tech Concierge functionality ends ---------- */
	
	/* ---------- Availability functionality for cable internet, tech concierge and home cleaning service start ---------- */
	
	$('#frm_cable_internet_services #availability_time_from1').change(function(){
		$('#frm_cable_internet_services #availability_time_upto1').val( $(this).val() );
	});
	$('#frm_cable_internet_services #availability_time_from2').change(function(){
		$('#frm_cable_internet_services #availability_time_upto2').val( $(this).val() );
	});
	$('#frm_cable_internet_services #availability_time_from3').change(function(){
		$('#frm_cable_internet_services #availability_time_upto3').val( $(this).val() );
	});
	
	
	$('#frm_tech_concierge #availability_time_from1').change(function(){
		$('#frm_tech_concierge #availability_time_upto1').val( $(this).val() );
	});
	$('#frm_tech_concierge #availability_time_from2').change(function(){
		$('#frm_tech_concierge #availability_time_upto2').val( $(this).val() );
	});
	$('#frm_tech_concierge #availability_time_from3').change(function(){
		$('#frm_tech_concierge #availability_time_upto3').val( $(this).val() );
	});
	
	
	$('#frm_home_cleaning_services #availability_time_from1').change(function(){
		$('#frm_home_cleaning_services #availability_time_upto1').val( $(this).val() );
	});
	$('#frm_home_cleaning_services #availability_time_from2').change(function(){
		$('#frm_home_cleaning_services #availability_time_upto2').val( $(this).val() );
	});
	$('#frm_home_cleaning_services #availability_time_from3').change(function(){
		$('#frm_home_cleaning_services #availability_time_upto3').val( $(this).val() );
	});

	/* ---------- Availability functionality for cable internet, tech concierge and home cleaning service ends ---------- */

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

		// Reset the already filled form
		$('#frm_cable_internet_services')[0].reset();

		$('#cable_internet_services_modal').modal({ backdrop: 'static', keyboard: false });

		// Reset the popup
		$('#cable_internet_services_step1').show();
		$('#cable_internet_services_step2').hide();
	});

	// Save the query data
	$('#frm_cable_internet_services').submit(function(e){
		e.preventDefault();
	});
	$('#frm_cable_internet_services').validate({
		ignore: "not:hidden",
		rules: 
		{
			'cable_internet_service_type[]': { required: true },
			availability_date7 : { required: true },
			availability_time_from1: { required: true }
		},
		messages: 
		{
			'cable_internet_service_type[]': { required: 'Please select atleast one service you are applying for under "Detailed Job Description"' },
			availability_date7 : { required: 'Please select atleast one availability date' },
			availability_time_from1: { required: 'Please select atleast one availability time' }
		}
	});

	$('#btn_cable_internet_submit_query').click(function(){
		if( $('#frm_cable_internet_services').valid() )
		{
			var $this = $(this);

			$.ajax({
				url: $('meta[name="route"]').attr('content') + '/movers/savecableinternetquery',
				method: 'post',
				data: {
					frmData: $('#frm_cable_internet_services').serialize()
				},
				headers: {
			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    },
			    beforeSend: function() {
			        // Show the loading button
			        $this.button('loading');
			    },
			    complete: function()
			    {
			        // Change the button to previous
			        $this.button('reset');
			    },
			    success: function(response){
			    	if( response.errCode == 0 )
				    {
				    	// alertify.success(response.errMsg);
				    	$('#service_response').find('.modal-header').html('Congratulations');
				    	$('#service_response').find('.modal-body').html('Your project request has been submitted, please check your mail after 24 hours.');
				    	$('#service_response').modal('show');

				    	$('#cable_internet_services_modal').modal('hide');

				    	// Mark the activity as completed
				    	var finalStatus = '1';
				    	var activityName= 'cable_internet_services';
				    	var activityId  = '6';

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
				    			// $('#frm_activity_helpful_user_response #activity_name').val(activityName);
				    			// $('#user_activity_helpful_response_modal').modal({ backdrop: 'static', keyboard: false });
				    		}
				    		else 	// Activity is still pending
				    		{
				    			$('.'+activityName).find('i').removeClass('fa-check').addClass('fa-arrow-circle-o-right');

				    			// Set the status value
				    			$('.'+activityName).closest('.activities_container').find('.activity_final_status').val(0);
				    		}
				    	}
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
				// $('#frm_activity_helpful_user_response #activity_name').val(activityName);
				// $('#user_activity_helpful_response_modal').modal({ backdrop: 'static', keyboard: false });
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

		// Check if the activity is already completed then discard the action
		if( $(this).closest('.activities_container').find('li:first').find('a').hasClass('completed') )
		{
			// alertify.error('This activity is already completed');
			$('#service_response').find('.modal-header').html('Alert');
	    	$('#service_response').find('.modal-body').html('This activity is already completed.');
	    	$('#service_response').modal('show');

			return false;
		}
		else
		{
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
		}
	});

	// Do it later functionality
	$('.later_activity').click(function(){

		// Check if the activity is already completed
		if( $(this).closest('.activities_container').find('.fa-check').length == 1 )
		{
			// alertify.error('This activity is already completed');
			$('#service_response').find('.modal-header').html('Alert');
	    	$('#service_response').find('.modal-body').html('This activity is already completed.');
	    	$('#service_response').modal('show');
		}
		else
		{
			$(this).find('i').removeClass('fa fa-history').addClass('fa fa-check');
		}

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
			    		// alertify.success(response.errMsg);
			    		$('#service_response').find('.modal-header').html('Success');
			    		$('#service_response').find('.modal-body').html(response.errMsg);
			    		$('#service_response').modal('show');

			    		// Update the rating average count
			    		$('#agent_average_rating').html('( ' + response.agentRating + ' Rating )');

			    		setTimeout(function(){
			    			window.location.href = $('meta[name="route"]').attr('content')
			    		}, 2000);
			    	}
			    	else
			    	{
			    		// alertify.error(response.errMsg);
			    		$('#service_response').find('.modal-header').html('Alert');
			    		$('#service_response').find('.modal-body').html(response.errMsg);
			    		$('#service_response').modal('show');
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
				// alertify.error('You are not following the correct sequence');

				$('#service_response').find('.modal-header').html('Alert');
				$('#service_response').find('.modal-body').html('You are not following the correct sequence');
				$('#service_response').modal('show');
			}
		}
	});

	// To show the make payment modal
	$(document).on('click', '.make_payment', function() {

		// Get the quotation response details
		let requestId 		= $(this).attr('id');
		let serviceType 	= $(this).attr('data-service');
		let paymentAmount 	= $(this).attr('data-amount');
		
		// Get the reference of element
		var $this = $(this);

		// ajax call to get payment related details
		$.ajax({
			url: $('meta[name="route"]').attr('content') + '/movers/getquotationresponsedetails',
			method: 'get',
			data: {
				requestId: requestId,
				serviceType: serviceType,
				paymentAmount: paymentAmount
			},
			beforeSend: function() {
		        $this.html('<i class="fa fa-spinner" aria-hidden="true"></i>');
		    },
		    complete: function()
		    {
		    	$this.html('<i class="fa fa-paypal" aria-hidden="true"></i>');
		    },
		    success: function(response){
		    	if( response.errCode == 0 )
		    	{
		    		$('#make_payment_modal').modal('show');

		    		// Autofill the form
		    		$('#paypal #payment_against').val( response.details.paymentAgainst );
		    		$('#paypal #payment_amount').val( '$' + response.details.amount );

		    		$('#paypal #first_name').val( response.details.fname );
		    		$('#paypal #last_name').val( response.details.lname );
		    		$('#paypal #email').val( response.details.email );
		    		$('#paypal #address1').val( response.details.address1 );
		    		$('#paypal #address2').val( response.details.address2 );
		    		$('#paypal #city').val( response.details.city );
		    		$('#paypal #zip').val( response.details.postal_code );
		    		$('#paypal #day_phone_a').val( response.details.contactNumber );
		    		$('#paypal #day_phone_b').val( response.details.contactNumber );
		    		$('#paypal #amount').val( response.details.amount );

		    		$('#paypal #item_name').val( response.details.paymentAgainst );

		    		$('#paypal #invoice').val( response.details.invoiceNo );
		    	}
		    	else
		    	{
		    		alertify.error( response.errMsg );
		    	}
		    }
		});
	});

	// Share announcement email functionality
	$('#share_announcement_email').click(function(){
		// Get the fa star icon and change them to images
		let rating = $('#agent_rating').val();

		var content = $('#share_announcement_container').clone();

		var step = 1;
		$(content).find('.ratingstar td a').each(function(){
			if( step <= rating )
			{
				let imagePath = $('#star_image').attr('src');
				$(this).html('<img src="'+ imagePath +'"/>');
			}
			else
			{
				$(this).html('');
			}
			step++;
		});

		// Get the content and show it
		$('#share_announcement_content').html($(content).html());

		// Open the modal
		$('#share_announcement_email_modal').modal('show');
	});

	// Share announcement email edit message
	$('#share_announcement_edit_message').click(function(){
		// $('#announcement_message').attr('contenteditable','true');
		// $('#announcement_message').focus();
		
		$('.content_editable').attr('contenteditable','true');
		$('.content_editable:first').focus();
	});

	// Share announcement email form validation
	$('#frm_announcement_email').submit(function(e){
		e.preventDefault();
	});
	$('#frm_announcement_email').validate({
		rules: {
			announcement_emails: {
				required: true
			}
		},
		messages: {
			announcement_emails: {
				required: 'Please enter atleast one email id'
			}
		}
	});

	// Share announcement send email
	$('#btn_send_announcement_email').click(function(){
		if( $('#frm_announcement_email').valid() )
		{
			// Get the email id's and email content
			let emailIds 	= $('#announcement_emails').val();

			// Wrap the tr content into table and tr
			let emailContent= '<table><tr>' + $('#share_announcement_content').html() + '</tr></table>';

			$.ajax({
    			url: $('meta[name="route"]').attr('content') + '/movers/saveannouncementemail',
    			method: 'post',
    			data: {
    				emailIds: emailIds,
    				emailContent: emailContent
    			},
    			headers: {
			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    },
			    success: function(response){
			    	if( response.errCode == 0 )
			    	{
			    		// alertify.success( response.errMsg );
			    		$('#service_response').find('.modal-header').html('Success');
			    		$('#service_response').find('.modal-body').html(response.errMsg);
			    		$('#service_response').modal('show');

			    		// Reset the form
			    		$('#frm_announcement_email')[0].reset();

			    		// Hide the modal
			    		$('#share_announcement_email_modal').modal('hide');
			    	}
			    	else
			    	{
			    		// alertify.error( response.errMsg );
			    		$('#service_response').find('.modal-header').html('Alert');
			    		$('#service_response').find('.modal-body').html(response.errMsg);
			    		$('#service_response').modal('show');
			    	}
			    }
    		});
		}
	});

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
		    	// alertify.success(response.errMsg);
		    	$('#service_response').find('.modal-header').html('Success');
		    	$('#service_response').find('.modal-body').html(response.errMsg);
		    	$('#service_response').modal('show');
		    }
		    else
		    {
		    	// alertify.error(response.errMsg);
		    	$('#service_response').find('.modal-header').html('Alert');
		    	$('#service_response').find('.modal-body').html(response.errMsg);
		    	$('#service_response').modal('show');
		    }
	    }
	});
}