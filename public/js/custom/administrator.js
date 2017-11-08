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

    // To show the add province modal
    $('#btn_modal_province').click(function(){
    	// Set the modal title, as the same modal is used for edit also
    	$('#modal_add_province').find('.modal-title').html('Add Province');
    	$('#modal_add_province').modal('show');
    });

    // Add / Edit province form validation
    $('#frm_add_province').submit(function(e){
        e.preventDefault();
    });
    $('#frm_add_province').validate({
        rules: {
            province_name: {
                required: true
            },
            province_status: {
            	required: true	
            }
        },
        messages: {
            province_name: {
                required: 'Please enter the province name'
            },
            province_status: {
            	required: 'Please select status'
            }
        }
    });

    // Save the province data
    $('#btn_add_province').click(function(){
		if( $('#frm_add_province').valid() )
		{
			// Ajax call to save the page related data
			var $this = $(this);

			$.ajax({
				url: $('meta[name="route"]').attr('content') + '/administrator/saveprovince',
				method: 'post',
				data: {
					frmData: $('#frm_add_province').serialize()
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
			    		$('#frm_add_province')[0].reset();

			    		$('#modal_add_province').modal('hide');

			    		// Refresh the datatable
			    		$('#datatable_provinces').DataTable().ajax.reload();
			    	}
			    	else
			    	{
			    		alertify.error( response.errMsg );
			    	}
			    }
			});
		}
    });

    // Province list datatable
    $.fn.dataTableExt.errMode = 'ignore';
    $('#datatable_provinces').dataTable({
        "sServerMethod": "get", 
        "bProcessing": true,
        "bServerSide": true,
        "sAjaxSource": $('meta[name="route"]').attr('content') + '/administrator/fetchprovinces',
        
        "columnDefs": [
            { "className": "dt-center", "targets": [0, 2, 3] }
        ],
        
        "aoColumns": [
            { 'bSortable' : true, "width": "10%" },
            { 'bSortable' : true },
            { 'bSortable' : true },
            { 'bSortable' : false, "width": "10%" }
        ]
    });

    // To update the province details
    $(document).on('click', '.edit_province', function(){
    	var provinceId = $(this).attr('id');

    	if( provinceId != '' )
    	{
    		// Get the province details for the selected province
    		$.ajax({
				url: $('meta[name="route"]').attr('content') + '/administrator/getprovincedetails',
				method: 'get',
				data: {
					provinceId: provinceId
				},
			    success: function(response){
			    	$('#modal_add_province').find('.modal-title').html('Edit Province');

			    	// Auto-fill the form
			    	$('#frm_add_province #province_id').val(provinceId);
			    	$('#frm_add_province #province_name').val(response.name);
			    	$('#frm_add_province input[name="province_status"][value="'+ response.status +'"]').prop('checked', true);

			    	// Show the modal
			    	$('#modal_add_province').modal('show');
			    }
			});
    	}
    	else
    	{
    		alertify.error('Missing province id');
    	}
    });

    // To show the add utility service category modal
    $('#btn_modal_utility_service_category').click(function(){
    	// Set the modal title, as the same modal is used for edit also
    	$('#modal_add_utility_service_category').find('.modal-title').html('Add Service');
    	$('#modal_add_utility_service_category').modal('show');
    });

    // Add / Edit utility service categories form validation
    $('#frm_add_utility_service_category').submit(function(e){
        e.preventDefault();
    });
    $('#frm_add_utility_service_category').validate({
        rules: {
            service_type: {
                required: true
            },
            service_description: {
            	required: true
            },
            service_status: {
            	required: true	
            }
        },
        messages: {
            service_type: {
                required: 'Please enter service type'
            },
            service_description: {
            	required: 'Please enter service description'
            },
            service_status: {
            	required: 'Please select status'
            }
        }
    });

    // save the utility service category data
    $('#btn_add_utility_service_category').click(function(){
    	if( $('#frm_add_utility_service_category').valid() )
    	{
    		// Ajax call to save the page related data
			var $this = $(this);

    		$.ajax({
    			url: $('meta[name="route"]').attr('content') + '/administrator/saveutilityservicecategory',
    			method: 'post',
    			data: {
    				frmData: $('#frm_add_utility_service_category').serialize()
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
			    		$('#frm_add_utility_service_category')[0].reset();

			    		$('#modal_add_utility_service_category').modal('hide');

			    		// Refresh the datatable
			    		$('#datatable_utility_service_categories').DataTable().ajax.reload();
			    	}
			    	else
			    	{
			    		alertify.error( response.errMsg );
			    	}
			    }
    		});
    	}
    });

    // Utility service categories list datatable
    $.fn.dataTableExt.errMode = 'ignore';
    $('#datatable_utility_service_categories').dataTable({
        "sServerMethod": "get", 
        "bProcessing": true,
        "bServerSide": true,
        "sAjaxSource": $('meta[name="route"]').attr('content') + '/administrator/fetchutilityservicecategories',
        
        "columnDefs": [
            { "className": "dt-center", "targets": [0, 3, 4] }
        ],
        
        "aoColumns": [
            { 'bSortable' : true, "width": "10%" },
            { 'bSortable' : true },
            { 'bSortable' : false },
            { 'bSortable' : true },
            { 'bSortable' : false, "width": "10%" }
        ]
    });

    // To edit the utility service category
    $(document).on('click', '.edit_utility_service_category', function(){
    	serviceCategoryId = $(this).attr('id');

    	if( serviceCategoryId != '' )
    	{
    		// Get the details of the selected service category
    		$.ajax({
				url: $('meta[name="route"]').attr('content') + '/administrator/getutilityservicecategorydetails',
				method: 'get',
				data: {
					serviceCategoryId: serviceCategoryId
				},
			    success: function(response){
			    	$('#modal_add_utility_service_category').find('.modal-title').html('Edit Service');

			    	// Auto-fill the form
			    	$('#frm_add_utility_service_category #service_id').val(serviceCategoryId);
			    	$('#frm_add_utility_service_category #service_type').val(response.service_type);
			    	$('#frm_add_utility_service_category #service_description').val(response.description);
			    	$('#frm_add_utility_service_category input[name="service_status"][value="'+ response.status +'"]').prop('checked', true);

			    	// Show the modal
			    	$('#modal_add_utility_service_category').modal('show');
			    }
			});
    	}
    	else
    	{
    		alertify.error('Missing service category id');
    	}
    });

    // To add utility service type
    $('#btn_modal_service_type').click(function(){
    	$('#modal_add_service_type').find('.modal-title').html('Add Service Type');
    	$('#modal_add_service_type').modal('show');
    });

   	// Add / Edit utility service types form validation
    $('#frm_add_service_type').submit(function(e){
        e.preventDefault();
    });
    $('#frm_add_service_type').validate({
        rules: {
            service_type_category: {
                required: true
            },
            service_type: {
            	required: true
            },
            service_status: {
            	required: true	
            }
        },
        messages: {
            service_type_category: {
                required: 'Please select category'
            },
            service_type: {
            	required: 'Please enter service type'
            },
            service_status: {
            	required: 'Please select status'	
            }
        }
    });

    // Save the utility service type data
    $('#btn_add_service_type').click(function(){
    	if( $('#frm_add_service_type').valid() )
    	{
    		// Ajax call to save the page related data
			var $this = $(this);

    		$.ajax({
    			url: $('meta[name="route"]').attr('content') + '/administrator/saveutilityservicetype',
    			method: 'post',
    			data: {
    				frmData: $('#frm_add_service_type').serialize()
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
			    		$('#frm_add_service_type')[0].reset();

			    		$('#modal_add_service_type').modal('hide');

			    		// Refresh the datatable
			    		$('#datatable_utility_service_types').DataTable().ajax.reload();
			    	}
			    	else
			    	{
			    		alertify.error( response.errMsg );
			    	}
			    }
    		});
    	}
    });

    // Utility service type list datatable
    $.fn.dataTableExt.errMode = 'ignore';
    $('#datatable_utility_service_types').dataTable({
        "sServerMethod": "get", 
        "bProcessing": true,
        "bServerSide": true,
        "sAjaxSource": $('meta[name="route"]').attr('content') + '/administrator/fetchutilityservicetypes',
        
        "columnDefs": [
            { "className": "dt-center", "targets": [0, 3, 4] }
        ],
        
        "aoColumns": [
            { 'bSortable' : true, "width": "10%" },
            { 'bSortable' : true },
            { 'bSortable' : false },
            { 'bSortable' : true },
            { 'bSortable' : false, "width": "10%" }
        ]
    });

    // To edit the service type
    $(document).on('click', '.edit_service_type', function(){
    	var serviceTypeId = $(this).attr('id');

    	if( serviceTypeId != '' )
    	{
    		// Get the details of the selected service category
    		$.ajax({
				url: $('meta[name="route"]').attr('content') + '/administrator/getutilityservicetypedetails',
				method: 'get',
				data: {
					serviceTypeId: serviceTypeId
				},
			    success: function(response){
			    	$('#modal_add_service_type').find('.modal-title').html('Edit Service Type');

			    	// Auto-fill the form
			    	$('#frm_add_service_type #service_type_id').val(serviceTypeId);
			    	$('#frm_add_service_type #service_type_category').val(response.utility_service_category_id);
			    	$('#frm_add_service_type #service_type').val(response.service_type);
			    	$('#frm_add_service_type input[name="service_status"][value="'+ response.status +'"]').prop('checked', true);

			    	// Show the modal
			    	$('#modal_add_service_type').modal('show');
			    }
			});
    	}
    	else
    	{
    		alertify.error('Missing service type id');
    	}
    });






    // To add service provider
    $('#btn_modal_service_provider').click(function(){
    	$('#modal_add_service_provider').find('.modal-title').html('Add Service Provider');
    	$('#modal_add_service_provider').modal('show');
    });

});