/* Common js for all agent related functionalities like register, login etc */

$(document).ready(function(){

	alertify.set('notifier','position', 'top-center');

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
                url: $('meta[name="route"]').attr('content') + '/agent/changepassword',
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

    // Change Password form validation
    $('#frm_forgot_password').submit(function(e){
        e.preventDefault();
    });

    // Check Change Password details
    $('#btn_forgot_password').click(function()
    {
        var $this = $(this);

        $.ajax({
            url: $('meta[name="route"]').attr('content') + '/agent/forgotpassword',
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
    		$.ajax({
    			url: $('meta[name="route"]').attr('content') + '/agent/saveclient',
    			method: 'post',
    			data: {
    				frmData: $('#frm_add_client').serialize()
    			},
    			headers: {
			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
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

        // Hide the loader when datatable is rendered
		"initComplete": function(settings, json) {
			$('.loader-wrapper').hide();
		},

        "bServerSide": true,
        "sAjaxSource": $('meta[name="route"]').attr('content') + '/agent/fetchclients',
        "columnDefs": [
            { "className": "dt-center", "targets": [ 0, 6, 7, 8 ] }
        ],
        "aoColumns": [
            { 'bSortable' : true },
            { 'bSortable' : true },
            { 'bSortable' : true },
            { 'bSortable' : true },
            { 'bSortable' : false },
            { 'bSortable' : false },
            { 'bSortable' : true },
            { 'bSortable' : false },
            { 'bSortable' : false }
        ]
    });

    // To show the invited client list in datatable
    $.fn.dataTableExt.errMode = 'ignore';
    $('#datatable_invited_clients').dataTable({
        "sServerMethod": "get", 
        "bProcessing": true,

        // Hide the loader when datatable is rendered
		"initComplete": function(settings, json) {
			$('.loader-wrapper').hide();
		},

		"searching": false,   	// Search Box will Be Disabled
		"ordering": false,    	// Ordering (Sorting on Each Column)will Be Disabled
		"info": false,         	// Will show "1 to n of n entries" Text at bottom
		"lengthChange": false,	// Will Disabled Record number per page
		"bPaginate": false,		// for pagination

        "bServerSide": true,
        "sAjaxSource": $('meta[name="route"]').attr('content') + '/agent/fetchinvitedclients',
        "columnDefs": [
            { "className": "dt-center", "targets": [ 0, 6 ] }
        ],
        "aoColumns": [
            { 'bSortable' : true },
            { 'bSortable' : true },
            { 'bSortable' : true },
            { 'bSortable' : true },
            { 'bSortable' : false },
            { 'bSortable' : false },
            { 'bSortable' : true }
        ]
    });

    $('#datatable_email_templates').dataTable({
        "sServerMethod": "get", 
        "bProcessing": true,
        "bServerSide": true,
        "sAjaxSource": $('meta[name="route"]').attr('content') + '/agent/fetchemailtemplates',
        
        "columnDefs": [
            { "className": "dt-center", "targets": [0, 3, 4] }
        ],
        "aoColumns": [
            { 'bSortable' : true },
            { 'bSortable' : true },
            { 'bSortable' : false },
            { 'bSortable' : true },
            { 'bSortable' : false, 'width': '10%' }
        ]
    });

    $('#datatable_invites').dataTable({ 
        "sServerMethod": "get", 
        "bProcessing": true,
        "bServerSide": true,
        "sAjaxSource": $('meta[name="route"]').attr('content') + '/agent/fetchinvites',
        "columnDefs": [
            { "className": "dt-center", "targets": [0, 6] }
        ],
        // Hide the loader when datatable is rendered
        "initComplete": function(settings, json) {
        	$('.loader-wrapper').hide();
        },
        "aoColumns": [
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
                	$('#modal_invite').modal('show');
                    $('#htmlInvite').append(response.html);
                }
            });
        }
    });

    // To resend the invite
    $(document).on('click', '.resend_invite', function(){
    	var inviteId = $(this).attr('id');

    	$.ajax({
    	    url: $('meta[name="route"]').attr('content') + '/agent/resendemail',
    	    method: 'post',
    	    data: {
    	        inviteId: inviteId
    	    },
    	    headers: {
    	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    	    },
    	    success: function(response){
    	        if( response.errCode == 0 )
    	        {
    	            alertify.success( response.errMsg );

    	            // Refresh the datatable
    	            $('#datatable_invites').DataTable().ajax.reload();                       
    	        }
    	        else
    	        {
    	            alertify.error( response.errMsg );
    	        }
    	    }
    	});
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
            agent_fname: {
                required: true
            },
            agent_lname: {
                required: true
            }
        },
        messages: {
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

    // Canada number validation
    $.validator.addMethod("canadaPhone", function (value, element) {
        var filter = /^((\+[1-9]{0,4}[ \-]*)|(\([0-9]{2,3}\)[ \-]*)|([0-9]{2,4})[ \-]*)*?[0-9]{3,4}?[ \-]*[0-9]{3,4}?$/;
        if (filter.test(value)) {
            return true;
        }
        else {
            return false;
        }
    }, 'Please enter a valid number');

    // Agent profile form validation
    $('#frm_agent_contact').submit(function(e){
        e.preventDefault();
    });
    $('#frm_agent_contact').validate({
        rules: {
            agent_email: {
                required: true,
                email: true
            },
            phone_number: {
                required: true,
                number: true,
                canadaPhone: true
            }
        },
        messages: {
            agent_email: {
                required: 'Please enter email',
                email: 'Please enter valid email'
            },
            phone_number: {
                required: 'Please enter phone number',
                number: 'Please enter a valid number'
            }
        }
    });

    // Update agent profile
    $('#btn_update_agent_contact').click(function(){
        // Check the validation
        if( $('#frm_agent_contact').valid() )
        {
            var $this = $(this);

            $.ajax({
                url: $('meta[name="route"]').attr('content') + '/agent/savecontactdetails',
                method: 'post',
                data: {
                    frmData: $('#frm_agent_contact').serialize()
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

    // Add company form validation
    $('#frm_agent_address').submit(function(e){
        e.preventDefault();
    });
    
     // Agent address form validation
    $('#frm_agent_address').validate({
        rules: {
            agent_address1: {
                required: true
            },
            agent_city: {
                required: true
            },
            agent_country: {
                required: true
            },
            agent_province: {
                required: true
            },
            agent_postalcode: {
                required: true
            }
        },
        messages: {
            agent_address1: {
                required: 'Please enter address1'
            },
            agent_city: {
                required: 'Please enter city'
            },
            agent_country: {
                required: 'Please enter country'
            },
            agent_province: {
                required: 'Please enter province'
            },
            agent_postalcode: {
                required: 'Please enter postal code'
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
                    frmData: $('#frm_agent_address').serialize()
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

    // Invite client next button functionality
    $('#btn_next_invitation').click(function(){
    	if( $('#frm_invite_client').valid() )
    	{
	        $('#invite_client_step1').addClass('hide');
	        $('#invite_client_step2').removeClass('hide');
    	}
    });

    // Invite client previous button functionality
    $('#btn_previous_invitation').click(function()
    {
        $('#invite_client_step1').removeClass('hide');
        $('#invite_client_step2').addClass('hide');
    });

    // To invite the client
    $(document).on('click', '.agent_invite_client', function(){
    	var clientId = $(this).attr('id');

    	if( clientId != '' )
    	{
    		// Fetch the client details and email template details
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
			    			$('#frm_invite_client #client_old_address1').val(response.oldAddress.address1);
                            $('#frm_invite_client #client_old_address2').val(response.oldAddress.address2);
			    			$('#frm_invite_client #client_old_province').val(response.oldAddress.province_id);
			    			$('#frm_invite_client #client_old_city').val(response.oldAddress.city_id);
			    			$('#frm_invite_client #client_old_postalcode').val(response.oldAddress.postal_code);
			    			$('#frm_invite_client #client_old_country').val(response.oldAddress.country_id);
			    		}

			    		// fill the new address, if available
			    		if( !$.isEmptyObject(response.newAddress) )
			    		{
			    			$('#frm_invite_client #client_new_address1').val(response.newAddress.address1);
                            $('#frm_invite_client #client_new_address2').val(response.newAddress.address2);
			    			$('#frm_invite_client #client_new_province').val(response.newAddress.province_id);
			    			$('#frm_invite_client #client_new_city').val(response.newAddress.city_id);
			    			$('#frm_invite_client #client_new_postalcode').val(response.newAddress.postal_code);
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

    $('#client_email_template').on('change', function()
    {
    	let emailTemplateId = $(this).val();

    	// Get the mover id
    	let clientId = $('#frm_invite_client #client_id').val();

    	if( emailTemplateId != '' )
    	{
	        $.ajax({
	            url: $('meta[name="route"]').attr('content') + '/agent/emailpreview',
	            method: 'post',
	            data: {
	                emailTemplateId: emailTemplateId,
	                clientId: clientId
	            },
	            headers: {
	                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	            },
	            success: function(response){
	                if( response.errCode == 0 )
	                {
	                    $('#email_preview').html( response.preview );
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
    		$('#email_preview').html('');
    	}
    });


    // To get the email template content and render the html
    $('input[name="agent_email_template"]').change(function()
    {
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
            client_old_address1: {
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
            client_new_address1: {
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
    		            // alertify.success( response.errMsg );

    		            // Show the alert on modal
    		            $('#sent_invitation_response').find('.modal-body').html(response.errMsg);
    		            $('#sent_invitation_response').modal('show');

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

    // To show the add email template modal
    $('#btn_modal_email_template').click(function() {
        $('#modal_email_template').find('.modal-title').html('Add Template');
        $('#frm_email_template #email_template_id').val('');
        $('#modal_email_template').modal('show');
    });

    // To show/hide the email template preview in datatable
    $(document).on('click', '.datatable_template_check_preview', function(){
        $(this).next('.datatable_template_preview').toggle();
    });

    // To edit the email template
    $(document).on('click', '.edit_email_template', function(){
        var templateId = $(this).attr('id');

        if( templateId != '' )
        {
            // Get the details of selected email template
            $.ajax({
                url: $('meta[name="route"]').attr('content') + '/agent/getemailtemplatedetails',
                method: 'get',
                data: {
                    templateId: templateId
                },
                success: function(response){
                    // Auto-fill the form
                    $('#frm_email_template #email_template_id').val(templateId);
                    $('#frm_email_template #email_template_name').val(response.template_name);

                    // Set the content in tinymce editor
                    tinymce.activeEditor.setContent(response.template_content);
                    
                    $('#frm_email_template input[name="email_template_status"][value="'+ response.status +'"]').prop('checked', true);

                    // Show the modal
                    $('#modal_email_template').modal('show');
                }
            });
        }
    });

    // Add agent form validation
    $('#frm_email_template').submit(function(e){
        e.preventDefault();
    });

    $('#frm_email_template').validate({
        rules: {
            email_template_name: {
                required: true
            },
            company_status: {
                required: true  
            }
        },
        messages: {
            email_template_name: {
                required: 'Please enter template name'
            },
            company_status: {
                required: 'Please select status'
            }
        }
    });

    // Save the email template
    $('#btn_add_email_template').click(function(){
        if( $('#frm_email_template').valid() )
        {
            // Check for the page content
            let pageContentTxt  = tinymce.activeEditor.getContent({ format: 'text' });
            let pageContentHtml = tinymce.activeEditor.getContent();

            if($.trim(pageContentTxt) == '')
            {
                alertify.error('Please enter some content');
            }
            else
            {
                // Save the tinymce editor data to the textarea so that we can send it by using serialize() method
                tinyMCE.triggerSave();
                
                // Ajax call to save the page related data
                var $this = $(this);

                $.ajax({
                    url: $('meta[name="route"]').attr('content') + '/administrator/saveemailtemplate',
                    method: 'post',
                    data: {
                        frmData: $('#frm_email_template').serialize()
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
                            $('#frm_email_template')[0].reset();

                            $('#modal_email_template').modal('hide');

                            // Refresh the datatable
                            $('#datatable_email_templates').DataTable().ajax.reload();
                        }
                        else
                        {
                            alertify.error( response.errMsg );
                        }
                    }
                });
            }
        }
    });
	
	//agent partner codes start here
	// To add new partner
    $('#btn_modal_partner').click(function(){
    	// Set the title
    	$('#modal_add_partner').find('.modal-title').html('Add Partner');

    	// Refresh the partner_id value
		$('#partner_id').val('');

    	// Show the modal
		$('#modal_add_partner').modal('show');
    });

    // partner Detail form validation
    $('#frm_add_partner').submit(function(e){
        e.preventDefault();
    });
    $('#frm_add_partner').validate({
        rules: {
            business_name: {
            	required: true
            },
            partner_email: {
            	required: true,
            	email: true
            }, 
			f_name: {
            	required: true
            },
			l_name: {
            	required: true
            },
            partner_status: {
            	required: true
            }
			 
        },
        messages: {
            business_name: {
            	required: 'Please enter first name'
            },
            partner_email: {
            	required: 'Please enter partner email',
            	email: 'Please enter valid email'
            }, 
			f_name: {
            	required: 'Please enter first name'
            },
			l_name: {
            	required: 'Please enter last name'
            },
            partner_status: {
            	required: 'Please select status'
            }
        }
    });

    // Save the partner details
    $('#btn_add_partner').click(function(){
    	if( $('#frm_add_partner').valid() )
    	{
    		// Ajax call to save the partner detail data
            var $this = $(this);
			var partner_id     	= $('#partner_id').val();
			var business_name   = $('#business_name').val();
            var f_name     		= $('#f_name').val();
			var l_name     		= $('#l_name').val();
            var partner_email   = $('#partner_email').val();
            var partner_status	= $("input[name='partner_status']:checked").val();
			

            // Create form data object and append the values into it
            var formData = new FormData();
			formData.append('partner_id', partner_id);
			formData.append('business_name', business_name);
            formData.append('f_name', f_name);
			formData.append('l_name', l_name);
            formData.append('partner_email', partner_email);
            formData.append('partner_status', partner_status);
			
    		$.ajax({
    			url: $('meta[name="route"]').attr('content') + '/agent/savepartnerdetails',
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

			    		// Refresh the form and close the modal
			    		$('#frm_add_partner')[0].reset();

			    		$('#modal_add_partner').modal('hide');

			    		// Refresh the datatable
			    		$('#datatable_partners').DataTable().ajax.reload();
			    	}
			    	else
			    	{
			    		alertify.error( response.errMsg );
			    	}
			    }
    		});
    	}
    });

    // To show the partner list in datatable
    $.fn.dataTableExt.errMode = 'ignore';
    $('#datatable_partners').dataTable({
        "sServerMethod": "get", 
        "bProcessing": true,
        "bServerSide": true,
        "sAjaxSource": $('meta[name="route"]').attr('content') + '/agent/fetchpartners',
        "columnDefs": [
            { "className": "dt-center", "targets": [ 0, 4, 5 ] }
        ],
        // Hide the loader when datatable is rendered
        "initComplete": function(settings, json) {
        	$('.loader-wrapper').hide();
        },
        "aoColumns": [
            { 'bSortable' : true },
			{ 'bSortable' : true },
            { 'bSortable' : true },
            { 'bSortable' : true },
            { 'bSortable' : true },
            { 'bSortable' : false },
			{ 'bSortable' : false }
        ]
    });


    // To edit the partner details
    $(document).on('click', '.edit_partner', function(){
    	var partnerId = $(this).attr('id');

    	if( partnerId != '' )
    	{
    		// Get the partner details for the selected partner
    		$.ajax({
    			url: $('meta[name="route"]').attr('content') + '/agent/getpartnerdetails',
    			method: 'get',
    			data: {
    				partnerId: partnerId
    			},
			    success: function(response){
			    	// Set the title
				    $('#modal_add_partner').find('.modal-title').html('Edit partner');

				    // Auto-fill the form
				    $('#frm_add_partner #partner_id').val(partnerId);
					$('#frm_add_partner #business_name').val(response.business_name);
				    $('#frm_add_partner #f_name').val(response.f_name);
					$('#frm_add_partner #l_name').val(response.l_name);
				    $('#frm_add_partner #partner_email').val(response.partner_email);
				    $('#frm_add_partner input[name="partner_status"][value="'+ response.partner_status +'"]').prop('checked', true);

				    // Show the modal
				    $('#modal_add_partner').modal('show');
			    },
				error: function(xhr, ajaxOptions, thrownError) {
					alert(thrownError + "\r\n" + xhr.statusText);
				}
				
    		});
    	}
		else
        {
            alertify.error('Missing Partner id');
        }
    });
	//agent partner code end here

	// To show the reviews in datatable
    $.fn.dataTableExt.errMode = 'ignore';
    $('#datatable_reviews').dataTable({
        "sServerMethod": "get", 
        "bProcessing": true,
        "bServerSide": true,
        "sAjaxSource": $('meta[name="route"]').attr('content') + '/agent/fetchreviews',
        
        "columnDefs": [
            { "className": "dt-center", "targets": [ 0, 4, 6 ] }
        ],

        "aoColumns": [
            { 'bSortable' : true },
            { 'bSortable' : true },
            { 'bSortable' : true },
            { 'bSortable' : false },
            { 'bSortable' : true },
            { 'bSortable' : false },
            { 'bSortable' : false }
        ]
    });

    // Agent paypal payment
    $('.agent_plan_selection').click(function(){
    	
    	let planId 	= $(this).attr('id');

    	// ajax call to get payment related details
    	$.ajax({
    		url: $('meta[name="route"]').attr('content') + '/agent/getplandetails',
    		method: 'get',
    		data: {
    			planId: planId
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