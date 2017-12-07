/* Common js for all agent related functionalities like register, login etc */

$(document).ready(function(){
    // Admin login form validation
    $('#frm_agent_login').submit(function(e){
        e.preventDefault();
    });
    $('#frm_agent_login').validate({
        rules: {
            username: {
                required: true,
                email: true
            },
            password: {
                required: true,
                minlength: 6
            }
        },
        messages: {
            username: {
                required: 'Please enter email',
                email: 'Please enter valid email'
            },
            password: {
                required: 'Please enter password',
                minlength: 'Password must contain atleat 6 characters'
            }
        }
    });

    // Check the user credentials for backend login
    $('#btn_agent_login').click(function(){
    	// Check the validation
    	if( $('#frm_agent_login').valid() )
    	{
    		var $this = $(this);

    		$.ajax({
    			url: $('meta[name="route"]').attr('content') + '/agent/login',
    			method: 'post',
    			data: {
    				frmData: $('#frm_agent_login').serialize()
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
			    		document.location.href = $('meta[name="route"]').attr('content') + '/agent/dashboard';
			    	}
			    	else
			    	{
			    		alertify.error( response.errMsg );
			    	}
			    }
    		});
    	}
    });

    // To add new agent
    $('#btn_modal_client').click(function(){
    	// Set the title
    	$('#modal_add_client').find('.modal-title').html('Add Client');

    	// Refresh the client_id value
		$('#client_id').val('');

    	// Show the modal
		$('#modal_add_client').modal('show');
    });

    // Admin login form validation
    $('#frm_add_client').submit(function(e){
        e.preventDefault();
    });
    $('#frm_add_client').validate({
        rules: {
            client_fname: {
            	required: true
            },
            client_email: {
            	required: true,
            	email: true
            },
            client_number: {
            	required: true,
            	digits: true
            },
            client_status: {
            	required: true
            }
        },
        messages: {
            client_fname: {
            	required: 'Please enter first name'
            },
            client_email: {
            	required: 'Please enter email',
            	email: 'Please enter valid email'
            },
            client_number: {
            	required: 'Please enter contact number',
            	digits: 'Please enter valid contact number'
            },
            client_status: {
            	required: 'Please select status'
            }
        }
    });

    // Save the client details
    $('#btn_add_client').click(function(){
    	if( $('#frm_add_client').valid() )
    	{
    		var $this = $(this);

    		$.ajax({
    			url: $('meta[name="route"]').attr('content') + '/agent/saveclient',
    			method: 'post',
    			data: {
    				frmData: $('#frm_add_client').serialize()
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
			    		$('#frm_add_client')[0].reset();

			    		$('#modal_add_client').modal('hide');

			    		// Refresh the datatable
			    		$('#datatable_clients').DataTable().ajax.reload();
			    	}
			    	else
			    	{
			    		alertify.error( response.errMsg );
			    	}
			    }
    		});
    	}
    });

    // To show the client list in datatable
    $.fn.dataTableExt.errMode = 'ignore';
    $('#datatable_clients').dataTable({
        "sServerMethod": "get", 
        "bProcessing": true,
        "bServerSide": true,
        "sAjaxSource": $('meta[name="route"]').attr('content') + '/agent/fetchclients',
        "columnDefs": [
            { "className": "dt-center", "targets": [0, 6, 7] }
        ],
        "aoColumns": [
            { 'bSortable' : true },
            { 'bSortable' : true },
            { 'bSortable' : true },
            { 'bSortable' : true },
            { 'bSortable' : false },
            { 'bSortable' : false },
            { 'bSortable' : true },
            { 'bSortable' : false }
        ]
    });

    $('#datatable_invites').dataTable({ 
        "sServerMethod": "get", 
        "bProcessing": true,
        "bServerSide": true,
        "sAjaxSource": $('meta[name="route"]').attr('content') + '/agent/fetchinvites',
        "columnDefs": [
            { "className": "dt-center", "targets": [0, 1, 2] }
        ],
        "aoColumns": [
            { 'bSortable' : true },
            { 'bSortable' : true },
            { 'bSortable' : true },
            { 'bSortable' : true },
            { 'bSortable' : true },
            { 'bSortable' : true },
            { 'bSortable' : true },
            { 'bSortable' : false },
            { 'bSortable' : false }
        ]
    });

    $(document).on('click', '.view_invite', function(){
        $('#modal_invite').modal('show');
        var inviteId = $(this).attr('id');
        if( inviteId != '' )
        {
            // Get the navigation category details for the selected category
            $.ajax({
                url: $('meta[name="route"]').attr('content') + '/agent/getinvitedetails',
                method: 'get',
                data: {
                    inviteId: inviteId
                },
                success: function(response){
                    $('#htmlInvite').append(response.html);
                }
            });
        }
    });

    // To edit the client details
    $(document).on('click', '.edit_client', function(){
    	var clientId = $(this).attr('id');

    	if( clientId != '' )
    	{
    		// Get the navigation category details for the selected category
    		$.ajax({
    			url: $('meta[name="route"]').attr('content') + '/agent/getclientdetails',
    			method: 'get',
    			data: {
    				clientId: clientId
    			},
			    success: function(response){
			    	if( response.errCode == 0 )
			    	{
			    		// Set the title
				    	$('#modal_add_client').find('.modal-title').html('Edit Client');

				    	// Auto-fill the form
				    	$('#frm_add_client #client_id').val(clientId);

				    	$('#frm_add_client #client_fname').val(response.details.fname);
				    	$('#frm_add_client #client_mname').val(response.details.mname);
				    	$('#frm_add_client #client_lname').val(response.details.lname);
				    	$('#frm_add_client #client_email').val(response.details.email);
				    	$('#frm_add_client #client_number').val(response.details.contact_no);
				    	
				    	$('#frm_add_client input[name="client_status"][value="'+ response.details.status +'"]').prop('checked', true);

				    	// Show the modal
				    	$('#modal_add_client').modal('show');
			    	}
			    	else
			    	{
			    		alertify.error( response.errMsg );
			    	}
			    }
    		});
    	}
    });

    // Agent profile form validation
    $('#frm_agent_profile').submit(function(e){
        e.preventDefault();
    });
    $('#frm_agent_profile').validate({
        rules: {
            agent_email: {
                required: true,
                email: true
            },
            agent_fname: {
                required: true
            },
            agent_lname: {
                required: true
            }
        },
        messages: {
            agent_email: {
                required: 'Please enter email',
                email: 'Please enter valid email'
            },
            agent_fname: {
                required: 'Please enter first name'
            },
            agent_lname: {
                required: 'Please enter last name'
            }
        }
    });

    // Update agent profile
    $('#btn_update_agent_profile').click(function(){
        // Check the validation
        if( $('#frm_agent_profile').valid() )
        {
            var $this = $(this);

            $.ajax({
                url: $('meta[name="route"]').attr('content') + '/agent/saveprofiledetails',
                method: 'post',
                data: {
                    frmData: $('#frm_agent_profile').serialize()
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
                    }
                    else
                    {
                        alertify.error( response.errMsg );
                    }
                }
            });
        }
    });

     // Agent address form validation
    $('#frm_agent_address').submit(function(e){
        e.preventDefault();
    });
    $('#frm_agent_address').validate({
        rules: {
            agent_address: {
                required: true
            }
        },
        messages: {
            agent_address: {
                required: 'Please enter address'
            }
        }
    });

    // Update agent profile
    $('#btn_update_agent_address').click(function(){
        // Check the validation
        if( $('#frm_agent_address').valid() )
        {
            var $this = $(this);

            $.ajax({
                url: $('meta[name="route"]').attr('content') + '/agent/saveaddressdetails',
                method: 'post',
                data: {
                    frmData: $('#frm_agent_address').serialize(),
                    agent_address: $('#agent_address').text()
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
                    }
                    else
                    {
                        alertify.error( response.errMsg );
                    }
                }
            });
        }
    });

     // Agent social form validation
    $('#frm_agent_social').submit(function(e){
        e.preventDefault();
        
        var $this = $(this);
        $.ajax({
            url: $('meta[name="route"]').attr('content') + '/agent/savesocialdetails',
            method: 'post',
            data: {
                frmData: $('#frm_agent_social').serialize()
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
                }
                else
                {
                    alertify.error( response.errMsg );
                }
            }
        });
    });

    $('#frm_agent_company #company_upload_image').change(function()
    {
        var ext = $(this).val().split('.').pop().toLowerCase();
        if($.inArray(ext, ['png','jpg','jpeg']) == -1) {
            $(this).val('');
            alert('invalid file type, only images are allowed');
        }
    });

     // Agent profile form validation
    $('#frm_agent_company').submit(function(e){
        e.preventDefault();
    });

    $('#frm_agent_company').validate({
        rules: {
            agent_company_name: {
                required: true
            },
            agent_company_address: {
                required: true
            },
            company_upload_image: {
                required: true
            }
        },
        messages: {
            agent_company_name: {
                required: 'Please enter company name'
            },
            agent_company_address: {
                required: 'Please enter company address'
            },
            company_upload_image: {
                required: 'Please select image to upload'
            }
        }
    });

    // Update agent profile
    $('#btn_update_agent_company').click(function(){
        // Check the validation
        if( $('#frm_agent_company').valid() )
        {
            var $this = $(this);
            var agent_company_name          = $('#agent_company_name').val();
            var agent_company_category      = $('select[name=agent_company_category]').val();
            var agent_company_address       = $('#agent_company_address').val();
            var agent_company_province      = $('select[name=agent_company_province]').val();
            var agent_company_city          = $('select[name=agent_company_city]').val();
            var agent_company_postalcode    = $('#agent_company_postalcode').val();
            var agent_company_country       = $('select[name=agent_company_country]').val();
            var fileData                    = $('#company_upload_image').prop('files')[0];

            // Create form data object and append the values into it
            var formData = new FormData();
            formData.append('fileData', fileData);
            formData.append('agent_company_name', agent_company_name);
            formData.append('agent_company_category', agent_company_category);
            formData.append('agent_company_address', agent_company_address);
            formData.append('agent_company_province', agent_company_province);
            formData.append('agent_company_city', agent_company_city);
            formData.append('agent_company_postalcode', agent_company_postalcode);
            formData.append('agent_company_country', agent_company_country);

            $.ajax({
                url: $('meta[name="route"]').attr('content') + '/agent/savecompanydetails',
                method: 'post',
                data: formData,
                contentType : false,
                processData : false,
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
                    }
                    else
                    {
                        alertify.error( response.errMsg );
                    }
                }
            });
        }
    });

    // To invite the client
    $(document).on('click', '.agent_invite_client', function(){
    	var clientId = $(this).attr('id');

    	if( clientId != '' )
    	{
    		// Fetch the client details as well as its associated message and template details to show in popup
    		$.ajax({
    			url: $('meta[name="route"]').attr('content') + '/agent/createinvitation',
    			method: 'get',
    			data: {
    				clientId: clientId
    			},
			    success: function(response){
			    	if( response.errCode == 0 )
			    	{
			    		// Pre-fill the popup with the details
			    		$('#frm_invite_client #client_message').val(response.message);
			    		$('#frm_invite_client #client_id').val(clientId);

			    		// fill the old address, if available
			    		if( !$.isEmptyObject( response.oldAddress ) )
			    		{
			    			$('#frm_invite_client #client_old_address').val(response.oldAddress.address);
			    			$('#frm_invite_client #client_old_unit_type').val(response.oldAddress.unit_type);
			    			$('#frm_invite_client #client_old_unit_no').val(response.oldAddress.unit_no);
			    			$('#frm_invite_client #client_old_street_type').val(response.oldAddress.street_type_id);
			    			$('#frm_invite_client #client_old_province').val(response.oldAddress.province_id);
			    			$('#frm_invite_client #client_old_city').val(response.oldAddress.city_id);
			    			$('#frm_invite_client #client_old_postalcode').val(response.oldAddress.postalcode);
			    			$('#frm_invite_client #client_old_country').val(response.oldAddress.country_id);
			    		}

			    		// fill the new address, if available
			    		if( !$.isEmptyObject(response.newAddress) )
			    		{
			    			$('#frm_invite_client #client_new_address').val(response.newAddress.address);
			    			$('#frm_invite_client #client_new_unit_type').val(response.newAddress.unit_type);
			    			$('#frm_invite_client #client_new_unit_no').val(response.newAddress.unit_no);
			    			$('#frm_invite_client #client_new_street_type').val(response.newAddress.street_type_id);
			    			$('#frm_invite_client #client_new_province').val(response.newAddress.province_id);
			    			$('#frm_invite_client #client_new_city').val(response.newAddress.city_id);
			    			$('#frm_invite_client #client_new_postalcode').val(response.newAddress.postalcode);
			    			$('#frm_invite_client #client_new_country').val(response.newAddress.country_id);

			    			// Moving date
			    			$('#frm_invite_client #client_moving_date').val(response.newAddress.moving_date);
			    		}

			    		// Set the selected template
			    		// $('input["name=client_email_template"][value="'+ response.emailTemplate +'"]').prop('checked', true);

			    		$('input:radio[name="client_email_template"][value="' + response.emailTemplate + '"]').prop('checked', true);

			    		$('#modal_invite_client').modal('show');
			    	}
			    	else
			    	{
			    		alertify.error( response.errMsg );
			    	}
			    }
    		});
    	}
    	else
    	{
    		alertify.error('Missing client id');
    	}
    });

    // Agent message form validation
    $('#frm_agent_message').submit(function(e){
        e.preventDefault();
    });
    $('#frm_agent_message').validate({
        rules: {
            agent_message: {
                required: true
            }
        },
        messages: {
            agent_message: {
                required: 'Please enter message'
            }
        }
    });

    // Update agent the message
    $('#btn_update_agent_message').click(function(){
    	if( $('#frm_agent_message').valid() )
    	{
    		$.ajax({
    			url: $('meta[name="route"]').attr('content') + '/agent/updatemessage',
    			method: 'post',
    			data: {
    				frmData: $('#frm_agent_message').serialize()
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

    // To get the email template content and render the html
    $('input[name="agent_email_template"]').change(function(){
    	var templateId = $(this).val();

    	// Show the spinner
    	$('#frm_agent_email_template #email_template_preview').html('<i class="fa fa-gear fa-spin" style="font-size:48px"></i>');

    	// Ajax call to get the email template content
    	$.ajax({
			url: $('meta[name="route"]').attr('content') + '/agent/getemailtemplatecontent',
			method: 'get',
			data: {
				templateId: templateId
			},
		    success: function(response){
		    	if( response.errCode == 0 )
		    	{
		    		// Replace spinner with the email template content
		    		$('#frm_agent_email_template #email_template_preview').html(response.content);
		    	}
		    	else
		    	{
		    		alertify.error( response.errMsg );
		    	}
		    }
		});
    });

    // Agent email template form validation
    $('#frm_agent_email_template').submit(function(e){
        e.preventDefault();
    });
    $('#frm_agent_email_template').validate({
        rules: {
            agent_email_template: {
                required: true
            }
        },
        messages: {
            agent_email_template: {
                required: 'Please select email template'
            }
        }
    });

    // Save the selected email template by agent
    $('#btn_update_agent_email_template').click(function(){
    	if( $('#frm_agent_email_template').valid() )
    	{
			$.ajax({
    			url: $('meta[name="route"]').attr('content') + '/agent/updateemailtemplate',
    			method: 'post',
    			data: {
    				frmData: $('#frm_agent_email_template').serialize()
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

    // To check the file extension
	$('#frm_agent_image #agent_upload_image').change(function(){
		var ext = $(this).val().split('.').pop().toLowerCase();
		if($.inArray(ext, ['png','jpg','jpeg']) == -1) {
		    $(this).val('');
		    alert('invalid file type, only images are allowed');
		}
	});

	// Agent image form validation
    $('#frm_agent_image').submit(function(e){
        e.preventDefault();
    });
    $('#frm_agent_image').validate({
    	ignore: "not:hidden",	// As the input file is hidden
        rules: {
            agent_upload_image: {
                required: true
            }
        },
        messages: {
            agent_upload_image: {
                required: 'Please select image to upload'
            }
        }
    });

    // Update the image data
    $('#btn_update_agent_image').click(function(){
    	if( $('#frm_agent_image').valid() )
    	{
			// Get the image and append it to form object
            var fileData = $('#agent_upload_image').prop('files')[0];

            // Create form data object and append the values into it
            var formData = new FormData();

            formData.append('fileData', fileData);

            $.ajax({
                url: $('meta[name="route"]').attr('content') + '/agent/updateagentimage',
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
			    		// Show the uploaded image
			    		$('#agent_profile_image').attr('src', response.imgPath);

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

    // Invite client form validation
    $('#frm_invite_client').submit(function(e){
        e.preventDefault();
    });
    $('#frm_invite_client').validate({
        rules: {
            client_old_address: {
                required: true
            },
            client_old_unit_type: {
                required: true
            },
            client_old_province: {
                required: true
            },
            client_old_city: {
                required: true
            },
            client_old_postalcode: {
            	required: true
            },
            client_old_country: {
                required: true
            },
            client_new_address: {
                required: true
            },
            client_new_unit_type: {
                required: true
            },
            client_new_province: {
                required: true
            },
            client_new_city: {
                required: true
            },
            client_new_postalcode: {
            	required: true
            },
            client_new_country: {
                required: true
            },
            client_moving_date: {
                required: true
            },
            client_message: {
                required: true
            },
            client_email_template: {
                required: true
            },
            client_invitation_schedule_date: {
            	required: true	
            }
        },
        messages: {
            client_old_address: {
                required: 'Please enter address'
            },
            client_old_unit_type: {
                required: 'Please select unit'
            },
            client_old_province: {
                required: 'Please select province'
            },
            client_old_city: {
                required: 'Please select city'
            },
            client_old_postalcode: {
                required: 'Please enter postalcode'
            },
            client_old_country: {
                required: 'Please select country'
            },
            client_new_address: {
                required: 'Please enter address'
            },
            client_new_unit_type: {
                required: 'Please select unit'
            },
            client_new_province: {
                required: 'Please select province'
            },
            client_new_city: {
                required: 'Please select city'
            },
            client_new_postalcode: {
            	required: 'Please enter postalcode'
            },
            client_new_country: {
                required: 'Please select country'
            },
            client_moving_date: {
                required: 'Please enter moving date'
            },
            client_message: {
                required: 'Please enter message'
            },
            client_email_template: {
                required: 'Please select template'
            },
            client_invitation_schedule_date: {
            	required: 'Please select schedule date'
            }
        }
    });

    // Save the client invitation data
    $('#btn_send_invitation').click(function(){
    	if( $('#frm_invite_client').valid() )
    	{
    		// Check if agent want to update the default address or not
    		var updateDefaultDetails = confirm('Want to update the default details as well?');

    		$.ajax({
    		    url: $('meta[name="route"]').attr('content') + '/agent/saveinvitationdetails',
    		    method: 'post',
    		    data: {
    		        frmData: $('#frm_invite_client').serialize(),
    		        updateDefaultDetails: updateDefaultDetails
    		    },
    		    headers: {
    		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    		    },
    		    success: function(response){
    		        if( response.errCode == 0 )
    		        {
    		            alertify.success( response.errMsg );

    		        	// Refresh the form and close the modal
			    		$('#frm_invite_client')[0].reset();

			    		$('#modal_invite_client').modal('hide');
    		        }
    		        else
    		        {
    		            alertify.error( response.errMsg );
    		        }
    		    }
    		});
    	}
    });

    // Show the datepicker to select the scheduling date
    $('#btn_schedule_invitation').click(function(){
    	$('#client_invitation_scheduler').show();
    	$('#client_invitation_schedule_date').focus();
    });

    // Cancel scheduling
    $('#cancel_shedule').click(function(){
    	$('#client_invitation_schedule_date').val('');
    	$('#client_invitation_scheduler').hide();
    });
});

/**
 * Function to get the list of cities as options for the selected province
 */
function getProvinceCities(provinceId, target)
{
    // Ajax call to get the cities on the basis of selected province
    $.ajax({
        url: $('meta[name="route"]').attr('content') + '/administrator/getprovincecities',
        method: 'get',
        data: {
            provinceId: provinceId
        },
        success: function(response){
            var responseTypes = '<option value="">Select</option>';

            for (var key in response)
            {
                responseTypes += '<option value="'+response[key].id+'">'+response[key].city+'</option>';
            }

            // Append the newly created options to the dropdown
            $(target).html(responseTypes);
        }
    });
}