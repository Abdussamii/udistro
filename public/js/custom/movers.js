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

	// Admin login form validation
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
    		$('#forward_mail_step1').hide();
			$('#forward_mail_step2').hide();
			$('#forward_mail_step3').show();
			$('#forward_mail_step4').hide();

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

    // To set the address in URL param string
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

	/* ---------- Activities functionality ---------- */

	// To handle the modal close event
	$('.close_modal').click(function(){
		$('#user_response_modal').modal('show');
		
	});

});