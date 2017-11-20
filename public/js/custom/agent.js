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

    // Admin profile form validation
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
            },
            agent_address: {
                required: true
            },
            agent_company_name: {
                required: true
            },
            agent_company_address: {
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
            },
            agent_address: {
                required: 'Please enter address'
            },
            agent_company_name: {
                required: 'Please enter company name'
            },
            agent_company_address: {
                required: 'Please enter company address'
            }
        }
    });

    // save agent profile
    $('#btn_update_agent_profile').click(function(){
        // Check the validation
        if( $('#frm_agent_profile').valid() )
        {
            var $this = $(this);

            $.ajax({
                url: $('meta[name="route"]').attr('content') + '/agent/saveprofiledetails',
                method: 'post',
                data: {
                    frmData: $('#frm_agent_profile').serialize(),
                    agent_address: $('#agent_address').text(),
                    agent_company_address: $('#agent_company_address').text()
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
                        $('#frm_agent_profile')[0].reset();

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