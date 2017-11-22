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

    // To fetch the service type based on the selection of service category
    $('#service_provider_category').change(function(){
    	var categoryId = $(this).val();

    	// Refresh the service type dropdown
    	$('#service_types').html('');

    	if( categoryId != '' )
    	{
	    	// Ajax call to get the service type on the basis of selected service category
	    	$.ajax({
				url: $('meta[name="route"]').attr('content') + '/administrator/getcategoryservicetypes',
				method: 'get',
				data: {
					categoryId: categoryId
				},
			    success: function(response){
			    	var responseTypes = '';

			    	for (var key in response)
			    	{
			    	  	responseTypes += '<option value="'+response[key].id+'">'+response[key].service_type+'</option>';
			    	}

			    	// Append the newly created options to the dropdown
			    	$('#service_types').html(responseTypes);

			    	// Referesh the multi-select
			    	$('#service_types').multipleSelect("refresh");
			    }
			});
    	}
    });

    // To get the cities list as per the province selected
    $('#service_provider_province').change(function(){
    	var provinceId = $(this).val();

    	// Refresh the city dropdown
    	$('#service_provider_city').html('<option value="">Select</option>');

    	if( provinceId != '' )
    	{
	    	// Ajax call to get the cities on the basis of selected province
	    	getProvinceCities(provinceId, '#service_provider_city');
    	}
    });

    // Add service provider form validation
    $('#frm_add_service_provider').submit(function(e){
        e.preventDefault();
    });

    $('#frm_add_service_provider').validate({
    	ignore: "not:hidden",   // for category multi-select, which is hidden
        rules: {
        	service_provider_name: {
        		required: true
        	},
        	service_provider_category: {
        		required: true
        	},
        	'service_types[]': {
        		required: true
        	},
            service_provider_country: {
                required: true
            },
            service_provider_province: {
                required: true
            },
            service_provider_city: {
            	required: true	
            },
            service_provider_address: {
            	required: true	
            },
            service_provider_status: {
            	required: true	
            }
        },
        messages: {
        	service_provider_name: {
        		required: 'Please enter service provider name'
        	},
        	service_provider_category: {
        		required: 'Please select service category'
        	},
        	'service_types[]': {
        		required: 'Please select atleast one service type'
        	},
            service_provider_country: {
                required: 'Please select country'
            },
            service_provider_province: {
                required: 'Please select province'
            },
            service_provider_city: {
            	required: 'Please select city'
            },
            service_provider_address: {
            	required: 'Please enter address'
            },
            service_provider_status: {
            	required: 'Please select status'	
            }
        }
    });

    // Save the service provider data
    $('#btn_add_service_provider').click(function(){
    	if( $('#frm_add_service_provider').valid() )
    	{
    		$.ajax({
    			url: $('meta[name="route"]').attr('content') + '/administrator/saveserviceprovider',
    			method: 'post',
    			data: {
    				frmData: $('#frm_add_service_provider').serialize()
    			},
    			headers: {
			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    },
			    success: function(response){
			    	if( response.errCode == 0 )
			    	{
			    		alertify.success( response.errMsg );

			    		// Refresh the form and close the modal
			    		$('#frm_add_service_provider')[0].reset();

			    		$('#modal_add_service_provider').modal('hide');

			    		// Refresh the datatable
			    		$('#datatable_service_providers').DataTable().ajax.reload();
			    	}
			    	else
			    	{
			    		alertify.error( response.errMsg );
			    	}
			    }
    		});
    	}
    });

    // Utility service providers datatable
    $.fn.dataTableExt.errMode = 'ignore';
    $('#datatable_service_providers').dataTable({
        "sServerMethod": "get", 
        "bProcessing": true,
        "bServerSide": true,
        "sAjaxSource": $('meta[name="route"]').attr('content') + '/administrator/fetchserviceproviders',
        
        "columnDefs": [
            { "className": "dt-center", "targets": [0, 7, 8] }
        ],
        "aoColumns": [
            { 'bSortable' : true },
            { 'bSortable' : true },
            { 'bSortable' : true },
            { 'bSortable' : false },
            { 'bSortable' : false },
            { 'bSortable' : false },
            { 'bSortable' : false },
            { 'bSortable' : true },
            { 'bSortable' : false }
        ]
    });

    // Edit the service provider details
    $(document).on('click', '.edit_service_provider', function(){
    	var serviceProviderId = $(this).attr('id');

    	// Fetch the service provider details for the selected service provider
    	$.ajax({
			url: $('meta[name="route"]').attr('content') + '/administrator/getserviceproviderdetails',
			method: 'get',
			data: {
				serviceProviderId: serviceProviderId
			},
		    success: function(response){
		    	$('#modal_add_service_provider').find('.modal-title').html('Edit Service Type');

		    	// Auto-fill the form

		    	$('#frm_add_service_provider #service_provider_id').val(serviceProviderId);
		    	$('#frm_add_service_provider #service_provider_name').val(response.company_name);
		    	$('#frm_add_service_provider #service_provider_category').val(response.category_id);
				$('#frm_add_service_provider #service_provider_country').val(response.country_id);
		    	$('#frm_add_service_provider #service_provider_province').val(response.province_id);
		    	$('#frm_add_service_provider #service_provider_address').val(response.address);
		    	$('#frm_add_service_provider input[name="service_provider_status"][value="'+ response.status +'"]').prop('checked', true);

		    	// Append the service type list
		    	var responseTypes = '';
		    	for (var key in response.serviceTypes)
		    	{
		    	  	responseTypes += '<option value="'+response.serviceTypes[key].id+'">'+response.serviceTypes[key].service_type+'</option>';
		    	}
		    	$('#service_types').html(responseTypes);

		    	// Make the option selected
		    	for(var i = 0; i < response.selectedServiceTypes.length; i++)
		    	{
		    		$("#service_types option[value='" + response.selectedServiceTypes[i] + "']").prop("selected", true);
		    	}

		    	// Referesh the multi-select
		    	$('#service_types').multipleSelect("refresh");

		    	// Append the city list
		    	var cities = '';
		    	for (var key in response.cities)
		    	{
		    	  	cities += '<option value="'+response.cities[key].id+'">'+response.cities[key].city+'</option>';
		    	}
		    	$('#service_provider_city').html(cities);

		    	// Make it selected
		    	$('#service_provider_city').val(response.city_id);

		    	// Show the modal
		    	$('#modal_add_service_provider').modal('show');
		    }
		});
    });

    // To add company category
    $('#btn_modal_company_category').click(function(){
    	$('#modal_add_company_category').find('.modal-title').html('Add Category');
    	$('#modal_add_company_category').modal('show');
    });

   	// Add / Edit company category form validation
    $('#frm_add_company_category').submit(function(e){
        e.preventDefault();
    });

    $('#frm_add_company_category').validate({
        rules: {
            category_name: {
                required: true
            },
            category_status: {
            	required: true	
            }
        },
        messages: {
            category_name: {
                required: 'Please enter category name'
            },
            category_status: {
            	required: 'Please select status'	
            }
        }
    });

    // Save the company category details
    $('#btn_add_company_category').click(function(){
    	if( $('#frm_add_company_category').valid() )
    	{
    		$.ajax({
    			url: $('meta[name="route"]').attr('content') + '/administrator/savecompanycategory',
    			method: 'post',
    			data: {
    				frmData: $('#frm_add_company_category').serialize()
    			},
    			headers: {
			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    },
			    success: function(response){
			    	if( response.errCode == 0 )
			    	{
			    		alertify.success( response.errMsg );

			    		// Refresh the form and close the modal
			    		$('#frm_add_company_category')[0].reset();

			    		$('#modal_add_company_category').modal('hide');

			    		// Refresh the datatable
			    		$('#datatable_company_categories').DataTable().ajax.reload();
			    	}
			    	else
			    	{
			    		alertify.error( response.errMsg );
			    	}
			    }
    		});
    	}
    });

    // Utility service providers datatable
    $.fn.dataTableExt.errMode = 'ignore';
    $('#datatable_company_categories').dataTable({
        "sServerMethod": "get", 
        "bProcessing": true,
        "bServerSide": true,
        "sAjaxSource": $('meta[name="route"]').attr('content') + '/administrator/fetchcompanycategories',
        
        "columnDefs": [
            { "className": "dt-center", "targets": [0, 2, 3] }
        ],
        
        "aoColumns": [
            { 'bSortable' : true },
            { 'bSortable' : true },
            { 'bSortable' : true },
            { 'bSortable' : false }
        ]
    });

    // To edit the company category
    $(document).on('click', '.edit_company_category', function(){
    	var categoryId = $(this).attr('id');

    	if( categoryId != '' )
    	{
    		// Get the details of the selected service category
    		$.ajax({
				url: $('meta[name="route"]').attr('content') + '/administrator/getcompanycategorydetails',
				method: 'get',
				data: {
					categoryId: categoryId
				},
			    success: function(response){
			    	$('#modal_add_company_category').find('.modal-title').html('Edit Category');

			    	// Auto-fill the form
			    	$('#frm_add_company_category #category_id').val(categoryId);
			    	$('#frm_add_company_category #category_name').val(response.category);
			    	$('#frm_add_company_category input[name="category_status"][value="'+ response.status +'"]').prop('checked', true);

			    	// Show the modal
			    	$('#modal_add_company_category').modal('show');
			    }
			});
    	}
    	else
    	{
    		alertify.error('Missing category id');
    	}
    });

    // To add payment plan details
    $('#btn_modal_payment_plan').click(function(){
    	$('#modal_payment_plan').find('.modal-title').html('Add Plan');
    	$('#modal_payment_plan').modal('show');
    });

    // Add payment plan form validation
    $('#frm_add_payment_plan').submit(function(e){
        e.preventDefault();
    });

    $('#frm_add_payment_plan').validate({
        rules: {
            payment_plan_name: {
                required: true
            },
            payment_plan_charge: {
                required: true,
                number: true
            },
            payment_plan_validity: {
                required: true,
                digits: true
            },
            payment_plan_emails: {
                required: true,
                digits: true
            },
            payment_plan_status: {
                required: true
            },
            payment_plan_type: {
            	required: true	
            },
            payment_plan_discount: {
            	number: true
            }
        },
        messages: {
            payment_plan_name: {
                required: 'Please enter plan name'
            },
            payment_plan_charge: {
                required: 'Please enter charge',
                number: 'Please enter valid charge'
            },
            payment_plan_validity: {
                required: 'Please enter validity',
                digits: 'Please enter a valid value'
            },
            payment_plan_emails: {
                required: 'Please enter number of emails',
                digits: 'Please enter a valid value'
            },
            payment_plan_status: {
                required: 'Please select status'
            },
            payment_plan_type: {
            	required: 'Please select plan type'	
            },
            payment_plan_discount: {
            	number: 'Please enter valid discount value'
            }
        }
    });

    // Save the payment plan details
    $('#btn_add_payment_plan').click(function(){
    	if( $('#frm_add_payment_plan').valid() )
    	{
    		$.ajax({
    			url: $('meta[name="route"]').attr('content') + '/administrator/savepaymentplan',
    			method: 'post',
    			data: {
    				frmData: $('#frm_add_payment_plan').serialize()
    			},
    			headers: {
			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    },
			    success: function(response){
			    	if( response.errCode == 0 )
			    	{
			    		alertify.success( response.errMsg );

			    		// Refresh the form and close the modal
			    		$('#frm_add_payment_plan')[0].reset();

			    		$('#modal_payment_plan').modal('hide');

			    		// Refresh the datatable
			    		$('#datatable_payment_plans').DataTable().ajax.reload();
			    	}
			    	else
			    	{
			    		alertify.error( response.errMsg );
			    	}
			    }
    		});
    	}
    });

    // Payment plans datatable
    $.fn.dataTableExt.errMode = 'ignore';
    $('#datatable_payment_plans').dataTable({
        "sServerMethod": "get", 
        "bProcessing": true,
        "bServerSide": true,
        "sAjaxSource": $('meta[name="route"]').attr('content') + '/administrator/fetchpaymentplans',
        "columnDefs": [
            { "className": "dt-center", "targets": [0, 6, 7, 8] },
            { "className": "dt-right", "targets": [2, 3, 4, 5] }
        ],
        "aoColumns": [
            { 'bSortable' : true },
            { 'bSortable' : true },
            { 'bSortable' : true },
            { 'bSortable' : true },
            { 'bSortable' : true },
            { 'bSortable' : true },
            { 'bSortable' : false },
            { 'bSortable' : true },
            { 'bSortable' : false }
        ]
    });

    // To edit the payment plan details
    $(document).on('click', '.edit_payment_plan', function(){
    	var planId = $(this).attr('id');

    	if( planId != '' )
    	{
    		// Get the details of selected payment plan
    		$.ajax({
				url: $('meta[name="route"]').attr('content') + '/administrator/getpaymentplandetails',
				method: 'get',
				data: {
					planId: planId
				},
			    success: function(response){
			    	$('#modal_payment_plan').find('.modal-title').html('Edit Category');

			    	// Auto-fill the form
			    	$('#frm_add_payment_plan #payment_plan_id').val(planId);
			    	$('#frm_add_payment_plan #payment_plan_type').val(response.plan_type_id);
			    	$('#frm_add_payment_plan #payment_plan_name').val(response.plan_name);
			    	$('#frm_add_payment_plan #payment_plan_charge').val(response.plan_charge);
			    	$('#frm_add_payment_plan #payment_plan_discount').val(response.discount);
			    	$('#frm_add_payment_plan #payment_plan_validity').val(response.validity_days);
			    	$('#frm_add_payment_plan #payment_plan_emails').val(response.no_of_emails);
			    	$('#frm_add_payment_plan input[name="payment_plan_status"][value="'+ response.status +'"]').prop('checked', true);

			    	// Show the modal
			    	$('#modal_payment_plan').modal('show');
			    }
			});
    	}
    	else
    	{
    		alertify.error('Missing category id');
    	}
    });

    // To add city details
    $('#btn_modal_city').click(function(){
    	$('#modal_add_city').find('.modal-title').html('Add City');
    	$('#modal_add_city').modal('show');
    });

   	// Add payment plan form validation
   	$('#frm_add_city').submit(function(e){
   	    e.preventDefault();
   	});

   	$('#frm_add_city').validate({
   	    rules: {
   	        province: {
   	            required: true
   	        },
   	        city_name: {
   	            required: true
   	        },
   	        city_status: {
   	        	required: true	
   	        }
   	    },
   	    messages: {
   	        province: {
   	            required: 'Please select province'
   	        },
   	        city_name: {
   	            required: 'Please enter city name'
   	        },
   	        city_status: {
   	        	required: 'Please select status'	
   	        }
   	    }
   	});

   	// Save the city details
   	$('#btn_add_cities').click(function(){
   		if( $('#frm_add_city').valid() )
   		{
    		$.ajax({
    			url: $('meta[name="route"]').attr('content') + '/administrator/savecity',
    			method: 'post',
    			data: {
    				frmData: $('#frm_add_city').serialize()
    			},
    			headers: {
			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    },
			    success: function(response){
			    	if( response.errCode == 0 )
			    	{
			    		alertify.success( response.errMsg );

			    		// Refresh the form and close the modal
			    		$('#frm_add_city')[0].reset();

			    		$('#modal_add_city').modal('hide');

			    		// Refresh the datatable
			    		$('#datatable_cities').DataTable().ajax.reload();
			    	}
			    	else
			    	{
			    		alertify.error( response.errMsg );
			    	}
			    }
    		});
   		}
   	});

   	// Cities list datatable
    $.fn.dataTableExt.errMode = 'ignore';
    $('#datatable_cities').dataTable({
        "sServerMethod": "get", 
        "bProcessing": true,
        "bServerSide": true,
        "sAjaxSource": $('meta[name="route"]').attr('content') + '/administrator/fetchcities',
        
        "columnDefs": [
            { "className": "dt-center", "targets": [0, 3, 4] }
        ],
        "aoColumns": [
            { 'bSortable' : true },
            { 'bSortable' : false },
            { 'bSortable' : true },
            { 'bSortable' : true },
            { 'bSortable' : false }
        ]
    });

    // To edit the city details
    $(document).on('click', '.edit_city', function(){
    	var pageId = $(this).attr('id');

    	if( pageId != '' )
    	{
    		// Get the details of selected payment plan
    		$.ajax({
				url: $('meta[name="route"]').attr('content') + '/administrator/getcitydetails',
				method: 'get',
				data: {
					pageId: pageId
				},
			    success: function(response){
			    	$('#modal_add_city').find('.modal-title').html('Edit City');

			    	// Auto-fill the form
			    	$('#frm_add_city #city_id').val(pageId);
			    	$('#frm_add_city #province').val(response.province_id);
			    	$('#frm_add_city #city_name').val(response.name);
			    	$('#frm_add_city input[name="city_status"][value="'+ response.status +'"]').prop('checked', true);

			    	// Show the modal
			    	$('#modal_add_city').modal('show');
			    }
			});
    	}
    	else
    	{
    		alertify.error('Missing category id');
    	}
    });

    // To add company
    $('#btn_modal_company').click(function(){
    	$('#modal_add_company').modal('show');
    });

    // To get the cities list as per the province selected
    $('#frm_add_company #company_province').change(function(){
    	var provinceId = $(this).val();

    	// Refresh the city dropdown
    	$('#frm_add_company #company_city').html('<option value="">Select</option>');

    	if( provinceId != '' )
    	{
	    	getProvinceCities(provinceId, '#frm_add_company #company_city');
    	}
    });

     // To add city details
     $('#btn_modal_city').click(function(){
     	$('#modal_add_city').find('.modal-title').html('Add City');
     	$('#modal_add_city').modal('show');
     });

	// Add company form validation
	$('#frm_add_company').submit(function(e){
	    e.preventDefault();
	});

	/**
	 * Custom validator for contains at least one lower-case letter
	 */
	$.validator.addMethod("atLeastOneLowercaseLetter", function (value, element) {
	    return this.optional(element) || /[a-z]+/.test(value);
	}, "Password must have at least one lowercase letter");
	 
	/**
	 * Custom validator for contains at least one upper-case letter.
	 */
	$.validator.addMethod("atLeastOneUppercaseLetter", function (value, element) {
	    return this.optional(element) || /[A-Z]+/.test(value);
	}, "Password must have at least one uppercase letter");
	 
	/**
	 * Custom validator for contains at least one number.
	 */
	$.validator.addMethod("atLeastOneNumber", function (value, element) {
	    return this.optional(element) || /[0-9]+/.test(value);
	}, "Password must have at least one number");
	 
	/**
	 * Custom validator for contains at least one symbol.
	 */
	$.validator.addMethod("atLeastOneSymbol", function (value, element) {
	    return this.optional(element) || /[!@#$%^&*()]+/.test(value);
	}, "Password must have at least one symbol");

	$('#frm_add_company').validate({
	    rules: {
	        representative_fname: {
	            required: true
	        },
	        representative_email: {
	        	required: true,
	        	email: true
	        },
	        representative_password: {
	        	required: true,
	        	minlength: 6,
	        	atLeastOneLowercaseLetter: true,
	        	atLeastOneUppercaseLetter: true,
	        	atLeastOneNumber: true,
	        	atLeastOneSymbol: true
	        },
	        company_name: {
	        	required: true
	        },
	        company_category: {
	        	required: true
	        },
	        company_addres: {
	        	required: true
	        },
	        company_province: {
	        	required: true
	        },
	        company_city: {
	        	required: true
	        },
	        postal_code: {
	        	required: true
	        },
			company_status: {
	        	required: true	
	        }
	    },
	    messages: {
	        representative_fname: {
	            required: 'Please enter representative first name'
	        },
	        representative_email: {
	        	required: 'Please enter representative email',
	        	email: 'Please enter valid representative email'
	        },
	        representative_password: {
	        	required: 'Please enter password',
                minlength: 'Password must contain atleat 6 characters'
	        },
	        company_name: {
	        	required: 'Please enter company name'
	        },
	        company_category: {
	        	required: 'Please select company category'
	        },
	        company_addres: {
	        	required: 'Please enter company address'
	        },
	        company_province: {
	        	required: 'Please select province'
	        },
	        company_city: {
	        	required: 'Please select city'
	        },
	        postal_code: {
	        	required: 'Please enter postal code'
	        },
	        company_status: {
	        	required: 'Please select status'
	        }
	    }
	});

	// Save the company data
	$('#btn_add_company').click(function(){
		if( $('#frm_add_company').valid() )
		{
    		$.ajax({
    			url: $('meta[name="route"]').attr('content') + '/administrator/savecompanydetails',
    			method: 'post',
    			data: {
    				frmData: $('#frm_add_company').serialize()
    			},
    			headers: {
			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    },
			    success: function(response){
			    	if( response.errCode == 0 )
			    	{
			    		alertify.success( response.errMsg );

			    		// Refresh the form and close the modal
			    		$('#frm_add_company')[0].reset();

			    		$('#modal_add_company').modal('hide');

			    		// Refresh the datatable
			    		$('#datatable_companies').DataTable().ajax.reload();
			    	}
			    	else
			    	{
			    		alertify.error( response.errMsg );
			    	}
			    }
    		});
		}
	});

	// Companies list datatable
    $.fn.dataTableExt.errMode = 'ignore';
    $('#datatable_companies').dataTable({
        "sServerMethod": "get", 
        "bProcessing": true,
        "bServerSide": true,
        "sAjaxSource": $('meta[name="route"]').attr('content') + '/administrator/fetchcompanies',
        "columnDefs": [
            { "className": "dt-center", "targets": [0, 9, 10] }
        ],
        "aoColumns": [
            { 'bSortable' : true },
            { 'bSortable' : true },
            { 'bSortable' : false },
            { 'bSortable' : false },
            { 'bSortable' : false },
            { 'bSortable' : false },
            { 'bSortable' : false },
            { 'bSortable' : false },
            { 'bSortable' : false },
            { 'bSortable' : true },
            { 'bSortable' : false }
        ]
    });

    // To edit the company details
    $(document).on('click', '.edit_company', function(){
    	var companyId = $(this).attr('id');

    	if( companyId != '' )
    	{
    		// Get the details of selected company
    		$.ajax({
				url: $('meta[name="route"]').attr('content') + '/administrator/getcompanydetails',
				method: 'get',
				data: {
					companyId: companyId
				},
			    success: function(response){
			    	// Auto-fill the form
			    	$('#frm_edit_company #company_id').val(companyId);
			    	$('#frm_edit_company #representative_fname').val(response.fname);
			    	$('#frm_edit_company #representative_lname').val(response.lname);
			    	$('#frm_edit_company #representative_email').val(response.email);
			    	$('#frm_edit_company #company_name').val(response.company_name);
			    	$('#frm_edit_company #company_category').val(response.company_category_id);
			    	$('#frm_edit_company #company_address').val(response.address);
			    	$('#frm_edit_company #company_province').val(response.province_id);
			    	
			    	// Fill the cities
			    	var cities = '<option value="">Select</option>';
			    	for (var key in response.cities)
			    	{
			    	  	cities += '<option value="'+response.cities[key].id+'">'+response.cities[key].city+'</option>';
			    	}
			    	$('#frm_edit_company #company_city').html(cities);
					
					// Make the city selected 
					$('#frm_edit_company #company_city').val(response.city_id);

			    	$('#frm_edit_company #postal_code').val(response.postal_code);
			    	$('#frm_edit_company input[name="company_status"][value="'+ response.status +'"]').prop('checked', true);

			    	// Show the modal
			    	$('#modal_edit_company').modal('show');
			    }
			});
    	}
    });

    // Update company form validation
	$('#frm_edit_company').submit(function(e){
	    e.preventDefault();
	});

	$('#frm_edit_company').validate({
	    rules: {
	        representative_fname: {
	            required: true
	        },
	        representative_email: {
	        	required: true,
	        	email: true
	        },
	        company_name: {
	        	required: true
	        },
	        company_category: {
	        	required: true
	        },
	        company_addres: {
	        	required: true
	        },
	        company_province: {
	        	required: true
	        },
	        company_city: {
	        	required: true
	        },
	        postal_code: {
	        	required: true
	        },
			company_status: {
	        	required: true	
	        }
	    },
	    messages: {
	        representative_fname: {
	            required: 'Please enter representative first name'
	        },
	        representative_email: {
	        	required: 'Please enter representative email',
	        	email: 'Please enter valid representative email'
	        },
	        company_name: {
	        	required: 'Please enter company name'
	        },
	        company_category: {
	        	required: 'Please select company category'
	        },
	        company_addres: {
	        	required: 'Please enter company address'
	        },
	        company_province: {
	        	required: 'Please select province'
	        },
	        company_city: {
	        	required: 'Please select city'
	        },
	        postal_code: {
	        	required: 'Please enter postal code'
	        },
	        company_status: {
	        	required: 'Please select status'
	        }
	    }
	});

	// To get the cities list as per the province selected for edit company
    $('#frm_edit_company #company_province').change(function(){
    	var provinceId = $(this).val();

    	// Refresh the city dropdown
    	$('#frm_edit_company #company_city').html('<option value="">Select</option>');

    	if( provinceId != '' )
    	{
	    	getProvinceCities(provinceId, '#frm_edit_company #company_city');
    	}
    });

    // Update the company details
	$('#btn_update_company_details').click(function(){
		if( $('#frm_edit_company').valid() )
		{
    		$.ajax({
    			url: $('meta[name="route"]').attr('content') + '/administrator/updatecompanydetails',
    			method: 'post',
    			data: {
    				frmData: $('#frm_edit_company').serialize()
    			},
    			headers: {
			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    },
			    success: function(response){
			    	if( response.errCode == 0 )
			    	{
			    		alertify.success( response.errMsg );

			    		// Refresh the form and close the modal
			    		$('#frm_edit_company')[0].reset();

			    		$('#modal_edit_company').modal('hide');

			    		// Refresh the datatable
			    		$('#datatable_companies').DataTable().ajax.reload();
			    	}
			    	else
			    	{
			    		alertify.error( response.errMsg );
			    	}
			    }
    		});
		}
	});

	// To add an agent under the company
	$('#btn_modal_agent').click(function(){
		$('#modal_add_agent').modal('show');
	});

	// To get the cities list as per the province selected for add agent
    $('#frm_add_agent #agent_province').change(function(){
    	var provinceId = $(this).val();

    	// Refresh the city dropdown
    	$('#frm_add_agent #agent_city').html('<option value="">Select</option>');

    	if( provinceId != '' )
    	{
	    	getProvinceCities(provinceId, '#frm_add_agent #agent_city');
    	}
    });

    // Add agent form validation
	$('#frm_add_agent').submit(function(e){
	    e.preventDefault();
	});

	$('#frm_add_agent').validate({
	    rules: {
	        agent_company: {
	            required: true
	        },
	        agent_fname: {
	            required: true
	        },
	        agent_lname: {
	            required: true
	        },
	        agent_email: {
	            required: true,
	        	email: true
	        },
	        agent_password: {
	            required: true,
	        	minlength: 6,
	        	atLeastOneLowercaseLetter: true,
	        	atLeastOneUppercaseLetter: true,
	        	atLeastOneNumber: true,
	        	atLeastOneSymbol: true
	        },
	        agent_address: {
	            required: true
	        },
	        agent_province: {
	            required: true
	        },
	        agent_city: {
	        	required: true
	        },
	        agent_postalcode: {
	        	required: true
	        },
			company_status: {
	        	required: true	
	        }
	    },
	    messages: {
	        agent_company: {
	            required: 'Please select company'
	        },
	        agent_fname: {
	            required: 'Please enter first name'
	        },
	        agent_lname: {
	            required: 'Please enter last name'
	        },
	        agent_email: {
	            required: 'Please enter email',
	        	email: 'Please enter valid email'
	        },
	        agent_password: {
	            required: 'Please enter password',
	        	minlength: 'Password must contain atleat 6 characters'
	        },
	        agent_address: {
	            required: 'Please enter address'
	        },
	        agent_province: {
	            required: 'Please select province'
	        },
	        agent_city: {
	        	required: 'Please select city'
	        },
	        agent_postalcode: {
	        	required: 'Please enter postal code'
	        },
			company_status: {
	        	required: 'Please select status'	
	        }
	    }
	});

	// Save the agent data
	$('#btn_add_agent').click(function(){
		if( $('#frm_add_agent').valid() )
		{
    		$.ajax({
    			url: $('meta[name="route"]').attr('content') + '/administrator/saveagent',
    			method: 'post',
    			data: {
    				frmData: $('#frm_add_agent').serialize()
    			},
    			headers: {
			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    },
			    success: function(response){
			    	if( response.errCode == 0 )
			    	{
			    		alertify.success( response.errMsg );
						
			    		// Refresh the form and close the modal
			    		$('#frm_add_agent')[0].reset();

			    		$('#modal_add_agent').modal('hide');

			    		// Refresh the datatable
			    		$('#datatable_agents').DataTable().ajax.reload();
			    	}
			    	else
			    	{
			    		alertify.error( response.errMsg );
			    	}
			    }
    		});
		}
	});

	// Agent list datatable
	$.fn.dataTableExt.errMode = 'ignore';
	$('#datatable_agents').dataTable({
	    "sServerMethod": "get", 
	    "bProcessing": true,
	    "bServerSide": true,
	    "sAjaxSource": $('meta[name="route"]').attr('content') + '/administrator/fetchagents',
	    "columnDefs": [
	        { "className": "dt-center", "targets": [0, 8, 9] }
	    ],
	    "aoColumns": [
	        { 'bSortable' : true },
	        { 'bSortable' : true },
	        { 'bSortable' : true },
	        { 'bSortable' : false },
	        { 'bSortable' : false },
	        { 'bSortable' : false },
	        { 'bSortable' : false },
	        { 'bSortable' : false },
	        { 'bSortable' : true },
	        { 'bSortable' : false}
	    ]
	});

	// To update the agent details
	$(document).on('click', '.edit_agent', function(){
		var agentId = $(this).attr('id');

    	if( agentId != '' )
    	{
    		// Get the details of selected agent
    		$.ajax({
				url: $('meta[name="route"]').attr('content') + '/administrator/getagentdetails',
				method: 'get',
				data: {
					agentId: agentId
				},
			    success: function(response){
			    	$('#frm_edit_agent #agent_id').val(agentId);

			    	$('#frm_edit_agent #agent_id').val(agentId);
			    	$('#frm_edit_agent #agent_fname').val(response.fname);
			    	$('#frm_edit_agent #agent_lname').val(response.lname);
			    	$('#frm_edit_agent #agent_email').val(response.email);
			    	$('#frm_edit_agent #agent_address').val(response.address);
			    	$('#frm_edit_agent #agent_province').val(response.province_id);
			    	$('#frm_edit_agent #agent_postalcode').val(response.postalcode);
			    	$('#frm_edit_agent #agent_company').val(response.company_id);
			    	
			    	// Fill the cities
			    	var cities = '<option value="">Select</option>';
			    	for (var key in response.cities)
			    	{
			    	  	cities += '<option value="'+response.cities[key].id+'">'+response.cities[key].city+'</option>';
			    	}
			    	$('#frm_edit_agent #agent_city').html(cities);
					
					// Make the city selected 
					$('#frm_edit_agent #agent_city').val(response.city_id);

			    	$('#frm_edit_agent input[name="agent_status"][value="'+ response.status +'"]').prop('checked', true);

			    	// Show the modal
			    	$('#modal_edit_agent').modal('show');
			    }
			});
    	}
	});

	// To get the cities list as per the province selected for add agent
    $('#frm_edit_agent #agent_province').change(function(){
    	var provinceId = $(this).val();

    	// Refresh the city dropdown
    	$('#frm_edit_agent #agent_city').html('<option value="">Select</option>');

    	if( provinceId != '' )
    	{
	    	getProvinceCities(provinceId, '#frm_edit_agent #agent_city');
    	}
    });

    // Add agent form validation
	$('#frm_edit_agent').submit(function(e){
	    e.preventDefault();
	});

	$('#frm_edit_agent').validate({
	    rules: {
	        agent_company: {
	            required: true
	        },
	        agent_fname: {
	            required: true
	        },
	        agent_lname: {
	            required: true
	        },
	        agent_email: {
	            required: true,
	        	email: true
	        },
	        agent_address: {
	            required: true
	        },
	        agent_province: {
	            required: true
	        },
	        agent_city: {
	        	required: true
	        },
	        agent_postalcode: {
	        	required: true
	        },
			company_status: {
	        	required: true	
	        }
	    },
	    messages: {
	        agent_company: {
	            required: 'Please select company'
	        },
	        agent_fname: {
	            required: 'Please enter first name'
	        },
	        agent_lname: {
	            required: 'Please enter last name'
	        },
	        agent_email: {
	            required: 'Please enter email',
	        	email: 'Please enter valid email'
	        },
	        agent_address: {
	            required: 'Please enter address'
	        },
	        agent_province: {
	            required: 'Please select province'
	        },
	        agent_city: {
	        	required: 'Please select city'
	        },
	        agent_postalcode: {
	        	required: 'Please enter postal code'
	        },
			company_status: {
	        	required: 'Please select status'	
	        }
	    }
	});

	// Update the agent data
	$('#btn_edit_agent').click(function(){
		if( $('#frm_edit_agent').valid() )
		{
    		$.ajax({
    			url: $('meta[name="route"]').attr('content') + '/administrator/updateagent',
    			method: 'post',
    			data: {
    				frmData: $('#frm_edit_agent').serialize()
    			},
    			headers: {
			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    },
			    success: function(response){
			    	if( response.errCode == 0 )
			    	{
			    		alertify.success( response.errMsg );
						
			    		// Refresh the form and close the modal
			    		$('#frm_edit_agent')[0].reset();

			    		$('#modal_edit_agent').modal('hide');

			    		// Refresh the datatable
			    		$('#datatable_agents').DataTable().ajax.reload();
			    	}
			    	else
			    	{
			    		alertify.error( response.errMsg );
			    	}
			    }
    		});
		}
	});

	// To show the add email template modal
	$('#btn_modal_email_template').click(function() {
		$('#modal_email_template').find('.modal-title').html('Add Template');
		$('#frm_email_template #email_template_id').val('');
		$('#modal_email_template').modal('show');
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
    		let pageContentTxt 	= tinymce.activeEditor.getContent({ format: 'text' });
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

    // Email template listing datatable
    $.fn.dataTableExt.errMode = 'ignore';
    $('#datatable_email_templates').dataTable({
        "sServerMethod": "get", 
        "bProcessing": true,
        "bServerSide": true,
        "sAjaxSource": $('meta[name="route"]').attr('content') + '/administrator/fetchemailtemplates',
        
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
				url: $('meta[name="route"]').attr('content') + '/administrator/getemailtemplatedetails',
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