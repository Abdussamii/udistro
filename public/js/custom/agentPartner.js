$(document).ready(function(){

// Auto-fill the table
	$('#cable_internet_service_request_id').val(cableInternetId);

	$('#moving_from_address').text(response.moving_from_address);
	$('#moving_to_address').text(response.moving_to_address);
	$('#moving_from_house_type').text(response.moving_from_house_type);
	$('#moving_from_floor').text(response.moving_from_floor);
	$('#moving_from_bedroom_count').text(response.moving_from_bedroom_count);
    $('#moving_from_property_type').text(response.moving_from_property_type);
    $('#moving_to_house_type').text(response.moving_to_house_type);
    $('#moving_to_floor').text(response.moving_to_floor);
    $('#moving_to_bedroom_count').text(response.moving_to_bedroom_count);
    $('#moving_to_property_type').text(response.moving_to_property_type);

    $('#have_cable_internet_already').text(response.have_cable_internet_already);
    $('#employment_status').text(response.employment_status);
    $('#want_to_receive_electronic_bill').text(response.want_to_receive_electronic_bill);
    $('#want_to_contract_plan').text(response.want_to_contract_plan);
    $('#want_to_setup_preauthorise_payment').text(response.want_to_setup_preauthorise_payment);

    $('#callback_option').text(response.callback_option);
    $('#callback_time').text(response.callback_time);
    $('#primary_no').text(response.primary_no);
    $('#secondary_no').text(response.secondary_no);
    $('#additional_information').text(response.additional_information);

    // Requested services
	$('#user_requested_cable_internet_services').html(response.request_services_details);

	// Requested Addotional services
	$('#user_requested_cable_internet_additional_services').html(response.request_additional_services_details);
     
 });