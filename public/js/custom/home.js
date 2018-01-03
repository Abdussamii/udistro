/* Common js for all front-end related functionalities like register, login etc */

$(document).ready(function(){

	// Get invite form validation
	$('#frm_get_invitation').submit(function(e){
		e.preventDefault();
	});

	$('#frm_get_invitation').validate({
		rules:{
			fname: {
				required: true
			},
			lname: {
				required: true
			},
			email: {
				required: true,
				email: true
			},
			mobile: {
				required: true,
				digits: true
			},
			// Moving from address
			moving_from_address1: {
				required: true
			},
			moving_from_province: {
				required: true
			},
			moving_from_city: {
				required: true
			},
			moving_from_postalcode: {
				required: true
			},
			moving_from_country: {
				required: true
			},
			// Moving to address
			moving_to_address1: {
				required: true
			},
			moving_to_province: {
				required: true
			},
			moving_to_city: {
				required: true
			},
			moving_to_postalcode: {
				required: true
			},
			moving_to_country: {
				required: true
			},
			moving_date: {
				required: true	
			}
		},
		messages:{
			fname: {
				required: 'Please enter first name'
			},
			lname: {
				required: 'Please enter last name'
			},
			email: {
				required: 'Please enter email',
				email: 'Please enter valid email'
			},
			mobile: {
				required: 'Please enter mobile no',
				digits: 'Please enter valid mobile no'
			},

			// Moving from address
			moving_from_address1: {
				required: 'Please enter address'
			},
			
			// Moving to address
			moving_to_address1: {
				required: 'Please enter address'
			},
			moving_date: {
				required: 'Please select moving date'
			}
		}
	});

	// Save the invitation details
	$('#btn_submit_invitation_details').click(function(){
		if( $('#frm_get_invitation').valid() )
		{
    		$.ajax({
    			url: $('meta[name="route"]').attr('content') + '/saveinvitationdetails',
    			method: 'post',
    			data: {
    				frmData: $('#frm_get_invitation').serialize()
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

});