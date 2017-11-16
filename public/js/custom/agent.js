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
});