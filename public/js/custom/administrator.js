/* Common js for all administrator related functionalities */

$(document).ready(function(){
    
    // Admin login form validation
    $('#frm_admin_login').submit(function(e){
        e.preventDefault();
    });
    $('#frm_admin_login').validate({
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
    $('#btn_admin_login').click(function(){
    	// Check the validation
    	if( $('#frm_admin_login').valid() )
    	{
    		var $this = $(this);

    		$.ajax({
    			url: $('meta[name="route"]').attr('content') + '/administrator/login',
    			method: 'post',
    			data: {
    				frmData: $('#frm_admin_login').serialize()
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
			    		document.location.href = $('meta[name="route"]').attr('content') + '/administrator/dashboard';
			    	}
			    	else
			    	{
			    		alertify.error( response.errMsg );
			    	}
			    }
    		});
    	}
    });

    // Navigation category form validation
    $('#frm_navigation_category').submit(function(e){
        e.preventDefault();
    });
    $('#frm_navigation_category').validate({
        rules: {
            navigation_category_type: {
                required: true
            },
            navigation_category_name: {
                required: true
            },
            navigation_category_status: {
            	required: true	
            }
        },
        messages: {
            navigation_category_type: {
                required: 'Please select navigation type'
            },
            navigation_category_name: {
                required: 'Please enter category name'
            },
            navigation_category_status: {
            	required: 'Please select status'
            }
        }
    });

    // Save the navigation category form data
    $('#btn_add_navigation_category').click(function(){
    	if( $('#frm_navigation_category').valid() )
    	{
    		var $this = $(this);

    		$.ajax({
    			url: $('meta[name="route"]').attr('content') + '/administrator/savenavigationcategory',
    			method: 'post',
    			data: {
    				frmData: $('#frm_navigation_category').serialize()
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
			    		$('#frm_navigation_category')[0].reset();
			    		$('#modal_add_navigation_category').modal('hide');

			    		// Refresh the datatable
			    		$('#datatable_navigation_category').DataTable().ajax.reload();

			    	}
			    	else
			    	{
			    		alertify.error( response.errMsg );
			    	}
			    }
    		});
    	}
    });

    // Navigation category datatable
    $.fn.dataTableExt.errMode = 'ignore';
    $('#datatable_navigation_category').dataTable({
        "sServerMethod": "get", 
        "bProcessing": true,
        "bServerSide": true,
        "sAjaxSource": $('meta[name="route"]').attr('content') + '/administrator/fetchnavigationcategories',
        
        "columnDefs": [
            { "className": "dt-center", "targets": [0, 3, 4] }
        ],
        "aoColumns": [
            { 'bSortable' : true, "width": "10%" },
            { 'bSortable' : true },
            { 'bSortable' : true },
            { 'bSortable' : true },
            { 'bSortable' : false, "width": "10%" }
        ]
    });

    // Edit category navigation
    $(document).on('click', '.edit_navigation_category', function(){
    	
    	let categoryId = $(this).attr('id');
    	if( categoryId != '' )
    	{
    		// Get the navigation category details for the selected category
    		$.ajax({
    			url: $('meta[name="route"]').attr('content') + '/administrator/getnavigationcategorydetails',
    			method: 'get',
    			data: {
    				categoryId: categoryId
    			},
			    success: function(response){
			    	// Auto-fill the form
			    	$('#frm_navigation_category #navigation_category_id').val(categoryId);
			    	$('#frm_navigation_category #navigation_category_type').val(response.type_id);
			    	$('#frm_navigation_category #navigation_category_name').val(response.category);
			    	$('input[name="navigation_category_status"][value="'+ response.status +'"]').prop('checked', true);

			    	// Show the modal
			    	$('#modal_add_navigation_category').modal('show');
			    }
    		});
    	}

    });

    // Add Navigation form validation
    $('#frm_navigation').submit(function(e){
        e.preventDefault();
    });

    // Validation method to allow alphabets with spaces only
    $.validator.addMethod("alphabetspace", function(value, element) {
        return this.optional(element) || value == value.match(/^[a-zA-Z\s]+$/);
    });
    // Validation method to allow alphabets only
    $.validator.addMethod("alphabets", function(value, element) {
        return this.optional(element) || value == value.match(/^[a-zA-Z]+$/);
    });

    $('#frm_navigation').validate({
    	ignore: "not:hidden",   // for category multi-select, which is hidden
        rules: {
        	'navigation_categories[]': {
        		required: true
        	},
            navigation_text: {
                required: true,
                alphabetspace: true
            },
            navigation_url: {
                required: true,
                alphabets: true
            },
            navigation_status: {
            	required: true	
            }
        },
        messages: {
        	'navigation_categories[]': {
        		required: 'Please select atleast one category'
        	},
            navigation_text: {
                required: 'Please enter navigation text',
                alphabetspace: 'Only alphabtes and spaces are allowed'
            },
            navigation_url: {
                required: 'Please enter navigation url',
                alphabets: 'Only small case letter are allowed'
            },
            navigation_status: {
            	required: 'Please select status'
            }
        }
    });

    // To generate the navigation url from the navigation text entered by the user
    $('#navigation_text').keyup(function(){
    	var navigationTxt = $(this).val().toLowerCase();
    	navigationTxt = navigationTxt.replace(/\s/g, '');
    	$('#navigation_url').val(navigationTxt);
    });

    // Save the navigation form data
    $('#btn_add_navigation').click(function(){
    	if( $('#frm_navigation').valid() )
    	{
    		$.ajax({
    			url: $('meta[name="route"]').attr('content') + '/administrator/savenavigation',
    			method: 'post',
    			data: {
    				frmData: $('#frm_navigation').serialize()
    			},
    			headers: {
			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    },
			    success: function(response){
			    	if( response.errCode == 0 )
			    	{
			    		alertify.success( response.errMsg );
						
			    		// Refresh the form and close the modal
			    		$('#frm_navigation')[0].reset();
			    		$('#modal_add_navigation').modal('hide');

			    		// Refresh the datatable
			    		$('#datatable_navigation').DataTable().ajax.reload();
			    	}
			    	else
			    	{
			    		alertify.error( response.errMsg );
			    	}
			    }
    		});
    	}
    });

    // Navigation datatable
    $.fn.dataTableExt.errMode = 'ignore';
    $('#datatable_navigation').dataTable({
        "sServerMethod": "get", 
        "bProcessing": true,
        "bServerSide": true,
        "sAjaxSource": $('meta[name="route"]').attr('content') + '/administrator/fetchnavigation',
        
        "columnDefs": [
            { "className": "dt-center", "targets": [0, 4, 5] }
        ],
        "aoColumns": [
            { 'bSortable' : true, "width": "10%" },
            { 'bSortable' : true },
            { 'bSortable' : false },
            { 'bSortable' : false },
            { 'bSortable' : true },
            { 'bSortable' : false, "width": "10%" }
        ]
    });

    // Get the navigation details and show the autofill form for edit navigation
    $(document).off('click', '.edit_navigation').on('click', '.edit_navigation', function(){
    	let navigationId = $(this).attr('id');

    	// Get the details of the selected navigation
		$.ajax({
			url: $('meta[name="route"]').attr('content') + '/administrator/getnavigationdetails',
			method: 'get',
			data: {
				navigationId: navigationId
			},
		    success: function(response){
		    	// Reset(flush) the form data
		    	$('#frm_edit_navigation')[0].reset();
		    	
		    	// Auto-fill the form
		    	$('#frm_edit_navigation #navigation_id').val(navigationId);
		    	$('#frm_edit_navigation #navigation_edit_text').val(response.navigationText);
		    	$('#frm_edit_navigation #navigation_edit_url').val(response.navigationURL);
		    	$('input[name="navigation_edit_status"][value="'+ response.navigationStatus +'"]').prop('checked', true);

		    	// Set the category selected
		    	for(var i = 0; i < response.navigationCategories.length; i++)
		    	{
		    		$("#navigation_edit_categories option[value='" + response.navigationCategories[i] + "']").prop("selected", true);
		    	}

		    	// Referesh the multi-select
		    	$('#navigation_edit_categories').multipleSelect("refresh");

		    	// Show the modal
		    	$('#modal_edit_navigation').modal('show');
		    }
		});
    });
    
    // To generate the navigation url from the navigation text entered by the user
    $('#navigation_edit_text').keyup(function(){
    	var navigationTxt = $(this).val().toLowerCase();
    	navigationTxt = navigationTxt.replace(/\s/g, '');
    	$('#navigation_edit_url').val(navigationTxt);
    });

    // Edit navigation detail form validation
    $('#frm_edit_navigation').submit(function(e){
        e.preventDefault();
    });
    $('#frm_edit_navigation').validate({
    	ignore: "not:hidden",
        rules: {
        	'navigation_edit_categories[]': {
        		required: true
        	},
            navigation_edit_text: {
                required: true,
                alphabetspace: true
            },
            navigation_edit_url: {
                required: true,
                alphabets: true
            },
            navigation_edit_status: {
            	required: true	
            }
        },
        messages: {
        	'navigation_edit_categories[]': {
        		required: 'Please select atleast one category'
        	},
            navigation_edit_text: {
                required: 'Please enter navigation text',
                alphabetspace: 'Only alphabtes and spaces are allowed'
            },
            navigation_edit_url: {
                required: 'Please enter navigation url',
                alphabets: 'Only small case letter are allowed'
            },
            navigation_edit_status: {
            	required: 'Please select status'
            }
        }
    });

    // Update the navigation detail
    $('#btn_update_navigation').click(function(){
    	if( $('#frm_edit_navigation').valid() )
    	{
    		$.ajax({
    			url: $('meta[name="route"]').attr('content') + '/administrator/updatenavigation',
    			method: 'post',
    			data: {
    				frmData: $('#frm_edit_navigation').serialize()
    			},
    			headers: {
			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    },
			    success: function(response){
			    	if( response.errCode == 0 )
			    	{
			    		alertify.success( response.errMsg );
						
			    		// Refresh the form and close the modal
			    		$('#frm_navigation')[0].reset();

			    		$('#modal_edit_navigation').modal('hide');

			    		// Refresh the datatable
			    		$('#datatable_navigation').DataTable().ajax.reload();
			    	}
			    	else
			    	{
			    		alertify.error( response.errMsg );
			    	}
			    }
    		});
    	}
    });

    // CMS add page form validation
    $('#frm_add_page').submit(function(e){
        e.preventDefault();
    });
    $('#frm_add_page').validate({
        rules: {
            page_name: {
                required: true
            },
            page_navigation: {
                required: true
            },
            page_status: {
            	required: true,
            }
        },
        messages: {
            page_name: {
                required: 'Please enter the page name'
            },
            page_navigation: {
                required: 'Please select the navigation'
            },
            page_status: {
            	required: 'Please select status',
            }
        }
    });

    // Save the data
    $('#btn_add_page').click(function(){
    	if( $('#frm_add_page').valid() )
    	{
    		// Check for the page content
    		let pageContentTxt 	= tinymce.activeEditor.getContent({ format: 'text' });
    		let pageContentHtml = tinymce.activeEditor.getContent();

    		if($.trim(pageContentTxt) == '')
    		{
    		   	alertify.error('Please enter some page content');
    		}
    		else
    		{
				// Save the tinymce editor data to the textarea so that we can send it by using serialize() method
    			tinyMCE.triggerSave();
    			
    			// Ajax call to save the page related data
    			var $this = $(this);

	    		$.ajax({
	    			url: $('meta[name="route"]').attr('content') + '/administrator/savepage',
	    			method: 'post',
	    			data: {
	    				frmData: $('#frm_add_page').serialize()
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
				    		$('#frm_add_page')[0].reset();

				    		$('#modal_add_page').modal('hide');

				    		// Refresh the datatable
				    		$('#datatable_pages').DataTable().ajax.reload();
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

    // Pages list datatable
    $.fn.dataTableExt.errMode = 'ignore';
    $('#datatable_pages').dataTable({
        "sServerMethod": "get", 
        "bProcessing": true,
        "bServerSide": true,
        "sAjaxSource": $('meta[name="route"]').attr('content') + '/administrator/fetchpages',
        
        "columnDefs": [
            { "className": "dt-center", "targets": [0, 4, 5] }
        ],
        "aoColumns": [
            { 'bSortable' : true },
            { 'bSortable' : true },
            { 'bSortable' : true },
            { 'bSortable' : false },
            { 'bSortable' : true },
            { 'bSortable' : false}
        ]
    });

    // To edit the page content
    $(document).on('click', '.edit_page_content', function(){
    	pageId = $(this).attr('id');

    	if( pageId != '' )
    	{
	    	// Get the page details for the selected page
			$.ajax({
				url: $('meta[name="route"]').attr('content') + '/administrator/getpagedetails',
				method: 'get',
				data: {
					pageId: pageId
				},
			    success: function(response){
			    	// Auto-fill the form
			    	$('#frm_add_page #page_id').val(pageId);
			    	$('#frm_add_page #page_name').val(response.page_name);
					$('#frm_add_page #page_navigation').val(response.navigation_id);
					tinymce.activeEditor.setContent(response.page_content);
			    	$('#frm_add_page input[name="page_status"][value="'+ response.status +'"]').prop('checked', true);

			    	// Show the modal
			    	$('#modal_add_page').modal('show');
			    }
			});
    	}
    	else
    	{
    		alertify.error('Missing page id');
    	}
    });

});