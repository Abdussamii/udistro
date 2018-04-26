/* Common js for all administrator related functionalities */

$(document).ready(function(){

	alertify.set('notifier','position', 'top-center');
    
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
			    		// alertify.error( response.errMsg );
			    		$('#alert_box_modal').find('.modal-header').html('Alert');
			    		$('#alert_box_modal').find('.modal-body').html(response.errMsg);
			    		$('#alert_box_modal').modal('show');
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
                url: $('meta[name="route"]').attr('content') + '/administrator/changepassword',
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
                        // alertify.success( response.errMsg );
                        $('#alert_box_modal').find('.modal-header').html('Success');
                    	$('#alert_box_modal').find('.modal-body').html(response.errMsg);
                    	$('#alert_box_modal').modal('show');

                        // Refresh the form and close the modal
                        $('#frm_change_password')[0].reset();
                        document.location.href = $('meta[name="route"]').attr('content') + '/administrator/dashboard';
                    }
                    else
                    {
                        // alertify.error( response.errMsg );
                        $('#alert_box_modal').find('.modal-header').html('Alert');
                    	$('#alert_box_modal').find('.modal-body').html(response.errMsg);
                    	$('#alert_box_modal').modal('show');
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
            url: $('meta[name="route"]').attr('content') + '/administrator/forgotpassword',
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
                    // alertify.success( response.errMsg );
                    $('#alert_box_modal').find('.modal-header').html('Success');
                	$('#alert_box_modal').find('.modal-body').html(response.errMsg);
                	$('#alert_box_modal').modal('show');

                    // Refresh the form and close the modal
                    $('#frm_forgot_password')[0].reset();
                }
                else
                {
                    // alertify.error( response.errMsg );
                    $('#alert_box_modal').find('.modal-header').html('Alert');
                	$('#alert_box_modal').find('.modal-body').html(response.errMsg);
                	$('#alert_box_modal').modal('show');
                }
            }
        });
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
			    		// alertify.success( response.errMsg );
			    		$('#alert_box_modal').find('.modal-header').html('Success');
		    			$('#alert_box_modal').find('.modal-body').html(response.errMsg);
		    			$('#alert_box_modal').modal('show');

			    		// Refresh the form and close the modal
			    		$('#frm_navigation_category')[0].reset();
			    		$('#modal_add_navigation_category').modal('hide');

			    		// Refresh the datatable
			    		$('#datatable_navigation_category').DataTable().ajax.reload();

			    	}
			    	else
			    	{
			    		// alertify.error( response.errMsg );
			    		$('#alert_box_modal').find('.modal-header').html('Alert');
		    			$('#alert_box_modal').find('.modal-body').html(response.errMsg);
		    			$('#alert_box_modal').modal('show');
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
			    		// alertify.success( response.errMsg );
			    		$('#alert_box_modal').find('.modal-header').html('Success');
		    			$('#alert_box_modal').find('.modal-body').html(response.errMsg);
		    			$('#alert_box_modal').modal('show');
						
			    		// Refresh the form and close the modal
			    		$('#frm_navigation')[0].reset();
			    		$('#modal_add_navigation').modal('hide');

			    		// Refresh the datatable
			    		$('#datatable_navigation').DataTable().ajax.reload();
			    	}
			    	else
			    	{
			    		// alertify.error( response.errMsg );
			    		$('#alert_box_modal').find('.modal-header').html('Alert');
		    			$('#alert_box_modal').find('.modal-body').html(response.errMsg);
		    			$('#alert_box_modal').modal('show');
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
    	var navigationId = $(this).attr('id');

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
			    		// alertify.success( response.errMsg );
			    		$('#alert_box_modal').find('.modal-header').html('Success');
		    			$('#alert_box_modal').find('.modal-body').html(response.errMsg);
		    			$('#alert_box_modal').modal('show');
						
			    		// Refresh the form and close the modal
			    		$('#frm_navigation')[0].reset();

			    		$('#modal_edit_navigation').modal('hide');

			    		// Refresh the datatable
			    		$('#datatable_navigation').DataTable().ajax.reload();
			    	}
			    	else
			    	{
			    		// alertify.error( response.errMsg );
			    		$('#alert_box_modal').find('.modal-header').html('Alert');
		    			$('#alert_box_modal').find('.modal-body').html(response.errMsg);
		    			$('#alert_box_modal').modal('show');
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
    		   	// alertify.error('Please enter some page content');
    		   	$('#alert_box_modal').find('.modal-header').html('Alert');
    		   	$('#alert_box_modal').find('.modal-body').html(response.errMsg);
    		   	$('#alert_box_modal').modal('show');
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
				    		// alertify.success( response.errMsg );
				    		$('#alert_box_modal').find('.modal-header').html('Success');
			    			$('#alert_box_modal').find('.modal-body').html(response.errMsg);
			    			$('#alert_box_modal').modal('show');
							
				    		// Refresh the form and close the modal
				    		$('#frm_add_page')[0].reset();

				    		$('#modal_add_page').modal('hide');

				    		// Refresh the datatable
				    		$('#datatable_pages').DataTable().ajax.reload();
				    	}
				    	else
				    	{
				    		// alertify.error( response.errMsg );
				    		$('#alert_box_modal').find('.modal-header').html('Alert');
			    			$('#alert_box_modal').find('.modal-body').html(response.errMsg);
			    			$('#alert_box_modal').modal('show');
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
    		// alertify.error('Missing page id');
    		$('#alert_box_modal').find('.modal-header').html('Alert');
    		$('#alert_box_modal').find('.modal-body').html(response.errMsg);
    		$('#alert_box_modal').modal('show');
    	}
    });

    // To show the add province modal
    $('#btn_modal_province').click(function(){
    	// Set the modal title, as the same modal is used for edit also
    	$('#modal_add_province').find('.modal-title').html('Add Province');
    	$('#modal_add_province').modal('show');
    });

    // To show the add Moving Category modal
    $('#btn_modal_moving_category').click(function(){
        // Set the modal title, as the same modal is used for edit also
        $('#modal_add_moving_category').find('.modal-title').html('Add Moving Category');
        $('#modal_add_moving_category').modal('show');
    });

    // To show the add Moving Category modal
    $('#btn_modal_moving_item').click(function(){
        // Set the modal title, as the same modal is used for edit also
        $('#modal_add_moving_item').find('.modal-title').html('Add Moving Item Detail');
        $('#modal_add_moving_item').modal('show');
    });

    // To show the add activity modal
    $('#btn_modal_activity').click(function(){
        // Set the modal title, as the same modal is used for edit also
        $('#modal_add_activity').find('.modal-title').html('Add Activity');
        $('#modal_add_activity').modal('show');
        $('#frm_add_activity #activity_profile_image').attr('src', "");
    });

    // To check the file extension
    $('#frm_add_province #province_upload_image').change(function()
    {
        var ext = $(this).val().split('.').pop().toLowerCase();
        if($.inArray(ext, ['png','jpg','jpeg']) == -1) {
            $(this).val('');
            alert('invalid file type, only images are allowed');
        }
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
            },
			pst: {
            	required: true	
            },
			gst: {
            	required: true	
            },
			hst: {
            	required: true	
            },
			service_charge: {
            	required: true	
            },
            province_upload_image: {
                required: true
            }
        },
        messages: {
            province_name: {
                required: 'Please enter the province name'
            },
            province_status: {
                required: 'Please select status'
            },
			pst: {
            	required: 'Please enter PST'	
            },
			gst: {
            	required: 'Please enter GST'
            },
			hst: {
            	required: 'Please enter HST'	
            },
			service_charge: {
            	required: 'Please enter the Service Charge'	
            },
            province_upload_image: {
                required: 'Please select image to upload'
            }
        }
    });

    // Save the province data
    $('#btn_add_province').click(function(){
		if( $('#frm_add_province').valid() )
		{
			// Ajax call to save the page related data
			var $this = $(this);
            var provinceId     = $('#province_id').val();
            var countryId      = $('#country_id').val();
            var provinceName   = $('#province_name').val();
            var abbreviation   = $('#abbreviation').val();
			var pst			   = $('#pst').val();
			var gst			   = $('#gst').val();
			var hst			   = $('#hst').val();
			var serviceCharge  = $('#service_charge').val();
            var provinceStatus = $("input[name='province_status']:checked").val();
            var fileData       = $('#province_upload_image').prop('files')[0];

            // Create form data object and append the values into it
            var formData = new FormData();
            formData.append('fileData', fileData);
            formData.append('country_id', countryId);
            formData.append('province_id', provinceId);
            formData.append('abbreviation', abbreviation);
			formData.append('pst', pst);
			formData.append('gst', gst);
			formData.append('hst', hst);
			formData.append('service_charge', serviceCharge);
            formData.append('province_name', provinceName);
            formData.append('province_status', provinceStatus);

			$.ajax({
				url: $('meta[name="route"]').attr('content') + '/administrator/saveprovince',
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
			    		// alertify.success( response.errMsg );
			    		$('#alert_box_modal').find('.modal-header').html('Success');
		    			$('#alert_box_modal').find('.modal-body').html(response.errMsg);
		    			$('#alert_box_modal').modal('show');
						
			    		// Refresh the form and close the modal
			    		$('#frm_add_province')[0].reset();

			    		$('#modal_add_province').modal('hide');

			    		// Refresh the datatable
			    		$('#datatable_provinces').DataTable().ajax.reload();
			    	}
			    	else
			    	{
			    		// alertify.error( response.errMsg );
			    		$('#alert_box_modal').find('.modal-header').html('Alert');
		    			$('#alert_box_modal').find('.modal-body').html(response.errMsg);
		    			$('#alert_box_modal').modal('show');
			    	}
			    },

				error: function(xhr, ajaxOptions, thrownError) {
					alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);	
				}
			});
		}
    });

    // Add / Edit moving category form validation
    $('#frm_add_moving_category').submit(function(e){
        e.preventDefault();
    });
    $('#frm_add_moving_category').validate({
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
                required: 'Please enter the category name'
            },
            category_status: {
                required: 'Please select status'
            }
        }
    });

    // Save the province data
    $('#btn_add_moving_category').click(function(){
        if( $('#frm_add_moving_category').valid() )
        {
            // Ajax call to save the page related data
            var $this = $(this);
            var category_id     = $('#category_id').val();
            var category_name   = $('#category_name').val();
            var category_status = $("input[name='category_status']:checked").val();

            // Create form data object and append the values into it
            var formData = new FormData();
            formData.append('category_id', category_id);
            formData.append('category_name', category_name);
            formData.append('category_status', category_status);

            $.ajax({
                url: $('meta[name="route"]').attr('content') + '/administrator/savemovingcategory',
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
                        // alertify.success( response.errMsg );
                        $('#alert_box_modal').find('.modal-header').html('Success');
                    	$('#alert_box_modal').find('.modal-body').html(response.errMsg);
                    	$('#alert_box_modal').modal('show');
                        
                        // Refresh the form and close the modal
                        $('#frm_add_moving_category')[0].reset();

                        $('#modal_add_moving_category').modal('hide');

                        // Refresh the datatable
                        $('#datatable_moving_category').DataTable().ajax.reload();
                    }
                    else
                    {
                        // alertify.error( response.errMsg );
                        $('#alert_box_modal').find('.modal-header').html('Alert');
                    	$('#alert_box_modal').find('.modal-body').html(response.errMsg);
                    	$('#alert_box_modal').modal('show');
                    }
                }
            });
        }
    });

    // Add / Edit moving category form validation
    $('#frm_add_moving_item').submit(function(e){
        e.preventDefault();
    });
    $('#frm_add_moving_item').validate({
        rules: {
            item_name: {
                required: true
            },
            item_weight: {
                required: true  
            },
            item_status: {
                required: true
            },
            item_category: {
                required: true
            }
        },
        messages: {
            item_name: {
                required: 'Please enter the category name'
            },
            item_weight: {
                required: 'Please enter the item weight'
            },
            item_category: {
                required: 'Please enter the item category'
            },
            item_status: {
                required: 'Please select status'
            }
        }
    });

    // Save the province data
    $('#btn_add_moving_item').click(function(){
        if( $('#frm_add_moving_item').valid() )
        {
            // Ajax call to save the page related data
            var $this = $(this);
            var item_id         = $('#item_id').val();
            var item_name       = $('#item_name').val();
            var item_weight     = $('#item_weight').val();
            var item_category   = $('#item_category').val();
            var item_status     = $("input[name='item_status']:checked").val();

            // Create form data object and append the values into it
            var formData = new FormData();
            formData.append('item_id', item_id);
            formData.append('item_name', item_name);
            formData.append('item_weight', item_weight);
            formData.append('item_category', item_category);
            formData.append('item_status', item_status);

            $.ajax({
                url: $('meta[name="route"]').attr('content') + '/administrator/savemovingitemdetails',
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
                        // alertify.success( response.errMsg );
                        $('#alert_box_modal').find('.modal-header').html('Success');
                    	$('#alert_box_modal').find('.modal-body').html(response.errMsg);
                    	$('#alert_box_modal').modal('show');
                        
                        // Refresh the form and close the modal
                        $('#frm_add_moving_item')[0].reset();

                        $('#modal_add_moving_item').modal('hide');

                        // Refresh the datatable
                        $('#datatable_moving_item').DataTable().ajax.reload();
                    }
                    else
                    {
                        // alertify.error( response.errMsg );
                        $('#alert_box_modal').find('.modal-header').html('Alert');
                    	$('#alert_box_modal').find('.modal-body').html(response.errMsg);
                    	$('#alert_box_modal').modal('show');
                    }
                }
            });
        }
    });

    // To check the file extension
    $('#frm_add_activity #activity_upload_image').change(function()
    {
        var ext = $(this).val().split('.').pop().toLowerCase();
        if($.inArray(ext, ['png','jpg','jpeg']) == -1) {
            $(this).val('');
            alert('invalid file type, only images are allowed');
        }
    });

    // Add / Edit province form validation
    $('#frm_add_activity').submit(function(e){
        e.preventDefault();
    });
    $('#frm_add_activity').validate({
        rules: {
            activity_name: {
                required: true
            },
            activity_status: {
                required: true  
            },
            activity_upload_image: {
                required: true
            }
        },
        messages: {
            activity_name: {
                required: 'Please enter the activity name'
            },
            activity_status: {
                required: 'Please select status'
            },
            activity_upload_image: {
                required: 'Please select image to upload'
            }
        }
    });

    // Save the activity data
    $('#btn_add_activity').click(function(){
        if( $('#frm_add_activity').valid() )
        {
            // Ajax call to save the page related data
            var $this = $(this);
            var activityId     	= $('#activity_id').val();
            var activityName   	= $('#activity_name').val();
            var description   	= $('#description').val();
			var tooltip_data   	= $('#tooltip_data').val();
			var tooltip_position  = $('#tooltip_position').val();
            var activityStatus 	= $("input[name='activity_status']:checked").val();
            var fileData       	= $('#activity_upload_image').prop('files')[0];

            // Create form data object and append the values into it
            var formData = new FormData();
            formData.append('fileData', fileData);
            formData.append('activity_name', activityName);
            formData.append('description', description);
			formData.append('tooltip_data', tooltip_data);
			formData.append('tooltip_position', tooltip_position);
            formData.append('activity_id', activityId);
            formData.append('activity_status', activityStatus);

            $.ajax({
                url: $('meta[name="route"]').attr('content') + '/administrator/saveactivity',
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
                        // alertify.success( response.errMsg );
                        $('#alert_box_modal').find('.modal-header').html('Success');
                    	$('#alert_box_modal').find('.modal-body').html(response.errMsg);
                    	$('#alert_box_modal').modal('show');
                        
                        // Refresh the form and close the modal
                        $('#frm_add_activity')[0].reset();

                        $('#modal_add_activity').modal('hide');

                        // Refresh the datatable
                        $('#datatable_activity').DataTable().ajax.reload();
                    }
                    else
                    {
                        // alertify.error( response.errMsg );
                        $('#alert_box_modal').find('.modal-header').html('Alert');
                    	$('#alert_box_modal').find('.modal-body').html(response.errMsg);
                    	$('#alert_box_modal').modal('show');
                    }
                }
            });
        }
    });

    // Add / Edit activity form validation
    $('#frm_add_provincial_agency').submit(function(e){
        e.preventDefault();
    });
    $('#frm_add_provincial_agency').validate({
        rules: {
        	label1: { required: true },
        	agency_name: { required: true },
        	province: { required: true }
        },
        messages: {
        	label1: {	required: 'Please enter atleast one label'	},
        	agency_name: { required: 'Please enter agency name' },
        	province: { required: 'Please select province' }
        }
    });

    // Save the activity data
    $('#btn_add_address').click(function(){
        if( $('#frm_add_provincial_agency').valid() )
        {
        	let formData = new FormData();

        	formData.append('agencyId', $('#frm_add_provincial_agency #agency_id').val());
			
			formData.append('agencyType', $("input[name='agency_type']:checked").val());
			formData.append('agencyName', $('#frm_add_provincial_agency #agency_name').val());
			formData.append('province', $('#frm_add_provincial_agency #province').val());

			formData.append('logo', $('#frm_add_provincial_agency #logo').prop('files')[0]);

            formData.append('label1', $('#frm_add_provincial_agency #label1').val());
            formData.append('label2', $('#frm_add_provincial_agency #label2').val());
            formData.append('label3', $('#frm_add_provincial_agency #label3').val());
            formData.append('label4', $('#frm_add_provincial_agency #label4').val());
            formData.append('label5', $('#frm_add_provincial_agency #label5').val());
            formData.append('label6', $('#frm_add_provincial_agency #label6').val());
            formData.append('label7', $('#frm_add_provincial_agency #label7').val());
            formData.append('label8', $('#frm_add_provincial_agency #label8').val());
            formData.append('label9', $('#frm_add_provincial_agency #label9').val());
            formData.append('label10', $('#frm_add_provincial_agency #label10').val());

            formData.append('heading1', $('#frm_add_provincial_agency #heading1').val());
            formData.append('heading2', $('#frm_add_provincial_agency #heading2').val());
            formData.append('heading3', $('#frm_add_provincial_agency #heading3').val());
            formData.append('heading4', $('#frm_add_provincial_agency #heading4').val());

            formData.append('detail1', $('#frm_add_provincial_agency #detail1').val());
            formData.append('detail2', $('#frm_add_provincial_agency #detail2').val());
            formData.append('detail3', $('#frm_add_provincial_agency #detail3').val());
            formData.append('detail4', $('#frm_add_provincial_agency #detail4').val());
			
			formData.append('do_it_on_line_label', $('#frm_add_provincial_agency #do_it_on_line_label').val());
            formData.append('get_started_label', $('#frm_add_provincial_agency #get_started_label').val());
			formData.append('direct_link', $("input[name='direct_link']:checked").val());
			
            formData.append('link', $('#frm_add_provincial_agency #link').val());

            formData.append('status', $("input[name='province_address_status']:checked").val());

            $.ajax({
                url: $('meta[name="route"]').attr('content') + '/administrator/saveprovincialagency',
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
                        // alertify.success( response.errMsg );
                        $('#alert_box_modal').find('.modal-header').html('Success');
                    	$('#alert_box_modal').find('.modal-body').html(response.errMsg);
                    	$('#alert_box_modal').modal('show');
                        
                        // Refresh the form and close the modal
                        $('#frm_add_provincial_agency')[0].reset();

                        $('#modal_add_provincial_agency').modal('hide');

                        // Refresh the datatable
                        $('#datatable_provincial_agencies').DataTable().ajax.reload();
                    }
                    else
                    {
                        // alertify.error( response.errMsg );
                        $('#alert_box_modal').find('.modal-header').html('Alert');
                    	$('#alert_box_modal').find('.modal-body').html(response.errMsg);
                    	$('#alert_box_modal').modal('show');
                    }
                }
            });
        }
    });

    // Add / Edit services form validation
    $('#frm_add_services').submit(function(e){
        e.preventDefault();
    });
    $('#frm_add_services').validate({
        rules: {
            services_name: {
                required: true
            },
            services_status: {
                required: true  
            },
            description: {
                required: true
            },
            services_category: {
                required: true
            }
        },
        messages: {
            services_name: {
                required: 'Please enter the service name'
            },
            services_status: {
                required: 'Please select status'
            },
            description: {
                required: 'Please enter description'
            },
            services_category: {
                required: 'Please select service category'
            }
        }
    });

    // Save the activity data
    $('#btn_add_services').click(function(){
        if( $('#frm_add_services').valid() )
        {
            // Ajax call to save the page related data
            var $this = $(this);
            var services_id     = $('#services_id').val();
            var services_name   = $('#services_name').val();
            var description     = $('#description').val();
            var category        = $("#services_category").val();
            var services_status = $("input[name='services_status']:checked").val();

            // Create form data object and append the values into it
            var formData = new FormData();
            formData.append('services_name', services_name);
            formData.append('description', description);
            formData.append('services_id', services_id);
            formData.append('category', category);
            formData.append('services_status', services_status);

            $.ajax({
                url: $('meta[name="route"]').attr('content') + '/administrator/saveservices',
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
                        // alertify.success( response.errMsg );
                        $('#alert_box_modal').find('.modal-header').html('Success');
                    	$('#alert_box_modal').find('.modal-body').html(response.errMsg);
                    	$('#alert_box_modal').modal('show');
                        
                        // Refresh the form and close the modal
                        $('#frm_add_services')[0].reset();

                        $('#modal_add_services').modal('hide');

                        // Refresh the datatable
                        $('#datatable_services').DataTable().ajax.reload();
                    }
                    else
                    {
                        // alertify.error( response.errMsg );
                        $('#alert_box_modal').find('.modal-header').html('Alert');
                    	$('#alert_box_modal').find('.modal-body').html(response.errMsg);
                    	$('#alert_box_modal').modal('show');
                    }
                }
            });
        }
    });

    // Add / Edit province form validation
    $('#frm_edit_industry').submit(function(e){
        e.preventDefault();
    });

    $('#frm_edit_industry').validate({
        rules: {
            industry_name: {
                required: true
            },
            industry_status: {
                required: true  
            }
        },
        messages: {
            industry_name: {
                required: 'Please enter the industry name'
            },
            industry_status: {
                required: 'Please select status'
            }
        }
    });

    // Save the industry data
    $('#btn_edit_industry').click(function(){
        if( $('#frm_edit_industry').valid() )
        {
            // Ajax call to save the page related data
            var $this = $(this);
            var industry_id     = $('#industry_id').val();
            var industry_name   = $('#industry_name').val();
            var industry_status = $("input[name='industry_status']:checked").val();

            // Create form data object and append the values into it
            var formData = new FormData();
            formData.append('industry_id', industry_id);
            formData.append('industry_name', industry_name);
            formData.append('industry_status', industry_status);

            $.ajax({
                url: $('meta[name="route"]').attr('content') + '/administrator/saveindustrytype',
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
                        // alertify.success( response.errMsg );
                        $('#alert_box_modal').find('.modal-header').html('Success');
                    	$('#alert_box_modal').find('.modal-body').html(response.errMsg);
                    	$('#alert_box_modal').modal('show');
                        
                        // Refresh the form and close the modal
                        $('#frm_edit_industry')[0].reset();

                        $('#modal_edit_industry').modal('hide');

                        // Refresh the datatable
                        $('#datatable_industry').DataTable().ajax.reload();
                    }
                    else
                    {
                        // alertify.error( response.errMsg );
                        $('#alert_box_modal').find('.modal-header').html('Alert');
                    	$('#alert_box_modal').find('.modal-body').html(response.errMsg);
                    	$('#alert_box_modal').modal('show');
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
            { "className": "dt-center", "targets": [0, 6, 7] },
			{ "className": "dt-right", "targets": [ 2, 3, 4, 5] }
        ],
        // Hide the loader when datatable is rendered
        "initComplete": function(settings, json) {
        	$('.loader-wrapper').hide();
        },
        "aoColumns": [
            { 'bSortable' : true, "width": "10%" },
            { 'bSortable' : true },
            { 'bSortable' : false },
			{ 'bSortable' : false },
			{ 'bSortable' : false },
			{ 'bSortable' : false },
			{ 'bSortable' : false },
            { 'bSortable' : false, "width": "10%" }
        ]
    });

    $('#datatable_moving_category').dataTable({
        "sServerMethod": "get", 
        "bProcessing": true,
        "bServerSide": true,
        "sAjaxSource": $('meta[name="route"]').attr('content') + '/administrator/fetchmovingcategory',
        "columnDefs": [
            { "className": "dt-center", "targets": [0, 2, 3] }
        ],
        // Hide the loader when datatable is rendered
        "initComplete": function(settings, json) {
        	$('.loader-wrapper').hide();
        },
        "aoColumns": [
            { 'bSortable' : true, "width": "10%" },
            { 'bSortable' : true },
            { 'bSortable' : true },
            { 'bSortable' : false, "width": "10%" }
        ]
    });

    $('#datatable_moving_item').dataTable({
        "sServerMethod": "get", 
        "bProcessing": true,
        "bServerSide": true,
        "sAjaxSource": $('meta[name="route"]').attr('content') + '/administrator/fetchmovingitemdetails',
        "columnDefs": [
            { "className": "dt-center", "targets": [0, 4, 5] }
        ],
        // Hide the loader when datatable is rendered
        "initComplete": function(settings, json) {
        	$('.loader-wrapper').hide();
        },
        "aoColumns": [
            { 'bSortable' : true, "width": "10%" },
            { 'bSortable' : true },
            { 'bSortable' : true },
            { 'bSortable' : true },
            { 'bSortable' : true },
            { 'bSortable' : false, "width": "10%" }
        ]
    });

    $('#datatable_activity').dataTable({
        "sServerMethod": "get", 
        "bProcessing": true,
        "bServerSide": true,
        "sAjaxSource": $('meta[name="route"]').attr('content') + '/administrator/fetchactivity',
        "columnDefs": [
            { "className": "dt-center", "targets": [0] }
        ],
        // Hide the loader when datatable is rendered
        "initComplete": function(settings, json) {
        	$('.loader-wrapper').hide();
        },
        "aoColumns": [
            { 'bSortable' : true, "width": "10%" },
            { 'bSortable' : true },
            { 'bSortable' : true },
            { 'bSortable' : true },
            { 'bSortable' : false, "width": "10%" }
        ]
    });

    // To open the add provincial agency modal
    $('#btn_add_provincial_agency').click(function(){

    	$('#modal_add_provincial_agency').find('.modal-title').html('ADD PROVINCIAL AGENCY');
    	$('#modal_add_provincial_agency').modal('show');

    });

    $('#datatable_provincial_agencies').dataTable({
        "sServerMethod": "get", 
        "bProcessing": true,
        "bServerSide": true,
        "sAjaxSource": $('meta[name="route"]').attr('content') + '/administrator/fetchprovincialagencies',
        "columnDefs": [
            { "className": "dt-center", "targets": [0, 4] }
        ],
        // Hide the loader when datatable is rendered
        "initComplete": function(settings, json) {
        	$('.loader-wrapper').hide();
        },
        "aoColumns": [
            { 'bSortable' : true, "width": "10%" },
            { 'bSortable' : true },
            { 'bSortable' : true },
            { 'bSortable' : false },
            { 'bSortable' : false, "width": "10%" }
        ]
    });

    $('#datatable_activity_feedback').dataTable({
        "sServerMethod": "get", 
        "bProcessing": true,
        "bServerSide": true,
        "sAjaxSource": $('meta[name="route"]').attr('content') + '/administrator/fetchactivityfeedback',
        "columnDefs": [
            { "className": "dt-center", "targets": [0] }
        ],
        // Hide the loader when datatable is rendered
        "initComplete": function(settings, json) {
        	$('.loader-wrapper').hide();
        },
        "aoColumns": [
            { 'bSortable' : true, "width": "10%" },
            { 'bSortable' : true },
            { 'bSortable' : true },
            { 'bSortable' : true },
        ]
    });

    $('#datatable_industry').dataTable({
        "sServerMethod": "get", 
        "bProcessing": true,
        "bServerSide": true,
        "sAjaxSource": $('meta[name="route"]').attr('content') + '/administrator/fetchindustrytype',
        
        "columnDefs": [
            { "className": "dt-center", "targets": [0] }
        ],
        
        "aoColumns": [
            { 'bSortable' : true, "width": "10%" },
            { 'bSortable' : true },
            { 'bSortable' : true },
            { 'bSortable' : false, "width": "10%" }
        ]
    });

    $('#datatable_services').dataTable({
        "sServerMethod": "get", 
        "bProcessing": true,
        "bServerSide": true,
        "sAjaxSource": $('meta[name="route"]').attr('content') + '/administrator/fetchservices',
        "columnDefs": [
            { "className": "dt-center", "targets": [0] }
        ],
        // Hide the loader when datatable is rendered
        "initComplete": function(settings, json) {
        	$('.loader-wrapper').hide();
        },
        "aoColumns": [
            { 'bSortable' : true, "width": "10%" },
            { 'bSortable' : true },
            { 'bSortable' : false, "width": "20%" },
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
                    $('#frm_add_province #abbreviation').val(response.abbreviation);
					$('#frm_add_province #pst').val(response.pst);
					$('#frm_add_province #gst').val(response.gst);
					$('#frm_add_province #hst').val(response.hst);
					$('#frm_add_province #service_charge').val(response.service_charge);
                    $('#frm_add_province #province_profile_image').attr('src', response.image);
			    	$('#frm_add_province input[name="province_status"][value="'+ response.status +'"]').prop('checked', true);

			    	// Show the modal
			    	$('#modal_add_province').modal('show');
			    }
			});
    	}
    	else
    	{
    		// alertify.error('Missing province id');
		    $('#alert_box_modal').find('.modal-header').html('Alert');
			$('#alert_box_modal').find('.modal-body').html('Missing province id');
			$('#alert_box_modal').modal('show');
    	}
    });

    // To update the moving category details
    $(document).on('click', '.edit_moving_category', function(){
        var movingItemId = $(this).attr('id');

        if( movingItemId != '' )
        {
            // Get the province details for the selected province
            $.ajax({
                url: $('meta[name="route"]').attr('content') + '/administrator/getmovingcategory',
                method: 'get',
                data: {
                    movingItemId: movingItemId
                },
                success: function(response){
                    $('#modal_add_moving_category').find('.modal-title').html('Edit Moving Category');

                    // Auto-fill the form
                    $('#frm_add_moving_category #category_id').val(movingItemId);
                    $('#frm_add_moving_category #category_name').val(response.item_name);
                    $('#frm_add_moving_category input[name="category_status"][value="'+ response.status +'"]').prop('checked', true);

                    // Show the modal
                    $('#modal_add_moving_category').modal('show');
                }
            });
        }
        else
        {
            // alertify.error('Missing category id');
            $('#alert_box_modal').find('.modal-header').html('Alert');
			$('#alert_box_modal').find('.modal-body').html('Missing category id');
			$('#alert_box_modal').modal('show');
        }
    });

    // To update the moving category details
    $(document).on('click', '.edit_moving_item', function(){
        var movingItemId = $(this).attr('id');

        if( movingItemId != '' )
        {
            // Get the province details for the selected province
            $.ajax({
                url: $('meta[name="route"]').attr('content') + '/administrator/getmovingitemdetails',
                method: 'get',
                data: {
                    movingItemId: movingItemId
                },
                success: function(response){
                    $('#modal_add_moving_category').find('.modal-title').html('Edit Moving Item Name');

                    // Auto-fill the form
                    $('#frm_add_moving_item #item_id').val(movingItemId);
                    $('#frm_add_moving_item #item_category').val(response.moving_item_category_id);
                    $('#frm_add_moving_item #item_name').val(response.item_name);
                    $('#frm_add_moving_item #item_weight').val(response.item_weight);
                    $('#frm_add_moving_item input[name="item_status"][value="'+ response.status +'"]').prop('checked', true);

                    // Show the modal
                    $('#modal_add_moving_item').modal('show');
                }
            });
        }
        else
        {
            // alertify.error('Missing item id');
            $('#alert_box_modal').find('.modal-header').html('Alert');
			$('#alert_box_modal').find('.modal-body').html('Missing item id');
			$('#alert_box_modal').modal('show');
        }
    });

    // To update the activity details
    $(document).on('click', '.edit_activity', function(){
        var activityId = $(this).attr('id');

        if( activityId != '' )
        {
            // Get the province details for the selected province
            $.ajax({
                url: $('meta[name="route"]').attr('content') + '/administrator/getactivitydetails',
                method: 'get',
                data: {
                    activityId: activityId
                },
                success: function(response){
                    $('#modal_add_activity').find('.modal-title').html('Edit Activity');

                    // Auto-fill the form
                    $('#frm_add_activity #activity_id').val(activityId);
                    $('#frm_add_activity #activity_name').val(response.name);
                    $('#frm_add_activity #description').val(response.description);
					$('#frm_add_activity #tooltip_data').val(response.tooltip_data);
					$('#frm_add_activity #tooltip_position').val(response.tooltip_position);
                    $('#frm_add_activity #activity_profile_image').attr('src', response.image);
                    $('#frm_add_activity input[name="activity_status"][value="'+ response.status +'"]').prop('checked', true);

                    // Show the modal
                    $('#modal_add_activity').modal('show');
                }
            });
        }
        else
        {
            // alertify.error('Missing Activity id');
            $('#alert_box_modal').find('.modal-header').html('Alert');
			$('#alert_box_modal').find('.modal-body').html('Missing Activity id');
			$('#alert_box_modal').modal('show');
        }
    });

    // To update the address details
    $(document).on('click', '.edit_provincial_agency_details', function() {
        
        var agencyId = $(this).attr('id');

        if( agencyId != '' )
        {
            // Get the province details for the selected province
            $.ajax({
                url: $('meta[name="route"]').attr('content') + '/administrator/getprovincialagencydetails',
                method: 'get',
                data: {
                    agencyId: agencyId
                },
                success: function(response){

                    // Auto-fill the form
                    $('#frm_add_provincial_agency #agency_id').val(agencyId);

                    $('#frm_add_provincial_agency input[name="agency_type"][value="'+ response.agency_type +'"]').prop('checked', true);
                    $('#frm_add_provincial_agency #agency_name').val(response.agency_name);
                    $('#frm_add_provincial_agency #province').val(response.province_id);
                    
                    $('#frm_add_provincial_agency #label1').val(response.label1);
                    $('#frm_add_provincial_agency #label2').val(response.label2);
                    $('#frm_add_provincial_agency #label3').val(response.label3);
                    $('#frm_add_provincial_agency #label4').val(response.label4);
                    $('#frm_add_provincial_agency #label5').val(response.label5);
                    $('#frm_add_provincial_agency #label6').val(response.label6);
                    $('#frm_add_provincial_agency #label7').val(response.label7);
                    $('#frm_add_provincial_agency #label8').val(response.label8);
                    $('#frm_add_provincial_agency #label9').val(response.label9);
                    $('#frm_add_provincial_agency #label10').val(response.label10);

                    $('#frm_add_provincial_agency #heading1').val(response.heading1);
                    $('#frm_add_provincial_agency #heading2').val(response.heading2);
                    $('#frm_add_provincial_agency #heading3').val(response.heading3);
                    $('#frm_add_provincial_agency #heading4').val(response.heading4);

					$('#frm_add_provincial_agency #detail1').val(response.detail1);
                    $('#frm_add_provincial_agency #detail2').val(response.detail2);
                    $('#frm_add_provincial_agency #detail3').val(response.detail3);
                    $('#frm_add_provincial_agency #detail4').val(response.detail4);
					
					$('#frm_add_provincial_agency #do_it_on_line_label').val(response.do_it_on_line_label);
                    $('#frm_add_provincial_agency #get_started_label').val(response.get_started_label);
					$('#frm_add_provincial_agency input[name="direct_link"][value="'+ response.direct_link +'"]').prop('checked', true);

                    $('#frm_add_provincial_agency #link').val(response.link);
                    
                    $('#frm_add_provincial_agency input[name="status"][value="'+ response.status +'"]').prop('checked', true);

                    // Show the modal
                    $('#modal_add_provincial_agency').find('.modal-title').html('EDIT PROVINCIAL AGENCY');
                    $('#modal_add_provincial_agency').modal('show');
                }
            });
        }
        else
        {
            // alertify.error('Missing Activity id');
            $('#alert_box_modal').find('.modal-header').html('Alert');
			$('#alert_box_modal').find('.modal-body').html('Missing Activity id');
			$('#alert_box_modal').modal('show');
        }
    });

    // To update the services details
    $(document).on('click', '.edit_services', function()
    {
        var serviceId = $(this).attr('id');

        if( serviceId != '' )
        {
            // Get the service details for the selected service
            $.ajax({
                url: $('meta[name="route"]').attr('content') + '/administrator/getservicesdetails',
                method: 'get',
                data: {
                    serviceId: serviceId
                },
                success: function(response){
                    $('#modal_add_services').find('.modal-title').html('Edit Services');

                    // Auto-fill the form
                    $('#frm_add_services #services_id').val(serviceId);
                    $('#frm_add_services #services_name').val(response.service);
                    $('#frm_add_services #description').val(response.description);
                    $('#frm_add_services #services_category').val(response.category);
                    $('#frm_add_services input[name="services_status"][value="'+ response.status +'"]').prop('checked', true);

                    // Show the modal
                    $('#modal_add_services').modal('show');
                }
            });
        }
        else
        {
            // alertify.error('Missing Service id');
            $('#alert_box_modal').find('.modal-header').html('Alert');
			$('#alert_box_modal').find('.modal-body').html('Missing Service id');
			$('#alert_box_modal').modal('show');
        }
    });

    // To update the Industry details
    $(document).on('click', '.edit_industry', function(){
        var industryId = $(this).attr('id');

        if( industryId != '' )
        {
            // Get the province details for the selected province
            $.ajax({
                url: $('meta[name="route"]').attr('content') + '/administrator/getindustrytypedetails',
                method: 'get',
                data: {
                    industryId: industryId
                },
                success: function(response){
                    $('#frm_edit_industry #industry_id').val(industryId);
                    $('#frm_edit_industry #industry_name').val(response.category);
                    $('#frm_edit_industry input[name="industry_status"][value="'+ response.status +'"]').prop('checked', true);

                    // Show the modal
                    $('#modal_edit_industry').modal('show');
                }
            });
        }
        else
        {
            // alertify.error('Missing province id');
            $('#alert_box_modal').find('.modal-header').html('Alert');
			$('#alert_box_modal').find('.modal-body').html('Missing province id');
			$('#alert_box_modal').modal('show');
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
			    		// alertify.success( response.errMsg );
			    		$('#alert_box_modal').find('.modal-header').html('Success');
    					$('#alert_box_modal').find('.modal-body').html(response.errMsg);
    					$('#alert_box_modal').modal('show');
						
			    		// Refresh the form and close the modal
			    		$('#frm_add_utility_service_category')[0].reset();

			    		$('#modal_add_utility_service_category').modal('hide');

			    		// Refresh the datatable
			    		$('#datatable_utility_service_categories').DataTable().ajax.reload();
			    	}
			    	else
			    	{
			    		// alertify.error( response.errMsg );
			    		$('#alert_box_modal').find('.modal-header').html('Alert');
    					$('#alert_box_modal').find('.modal-body').html(response.errMsg);
    					$('#alert_box_modal').modal('show');
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
			    	$('#frm_add_utility_service_category #service_type').val(response.category_type);
			    	$('#frm_add_utility_service_category #service_description').val(response.description);
			    	$('#frm_add_utility_service_category input[name="service_status"][value="'+ response.status +'"]').prop('checked', true);

			    	// Show the modal
			    	$('#modal_add_utility_service_category').modal('show');
			    }
			});
    	}
    	else
    	{
    		// alertify.error('Missing service category id');
    		$('#alert_box_modal').find('.modal-header').html('Alert');
			$('#alert_box_modal').find('.modal-body').html('Missing service category id');
			$('#alert_box_modal').modal('show');
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
			    		// alertify.success( response.errMsg );
			    		$('#alert_box_modal').find('.modal-header').html('Success');
    					$('#alert_box_modal').find('.modal-body').html(response.errMsg);
    					$('#alert_box_modal').modal('show');
						
			    		// Refresh the form and close the modal
			    		$('#frm_add_service_type')[0].reset();

			    		$('#modal_add_service_type').modal('hide');

			    		// Refresh the datatable
			    		$('#datatable_utility_service_types').DataTable().ajax.reload();
			    	}
			    	else
			    	{
			    		// alertify.error( response.errMsg );
			    		$('#alert_box_modal').find('.modal-header').html('Alert');
    					$('#alert_box_modal').find('.modal-body').html(response.errMsg);
    					$('#alert_box_modal').modal('show');
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
    		// alertify.error('Missing service type id');
    		$('#alert_box_modal').find('.modal-header').html('Alert');
			$('#alert_box_modal').find('.modal-body').html('Missing service type id');
			$('#alert_box_modal').modal('show');
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
			    		// alertify.success( response.errMsg );
			    		$('#alert_box_modal').find('.modal-header').html('Success');
    					$('#alert_box_modal').find('.modal-body').html(response.errMsg);
    					$('#alert_box_modal').modal('show');

			    		// Refresh the form and close the modal
			    		$('#frm_add_service_provider')[0].reset();

			    		$('#modal_add_service_provider').modal('hide');

			    		// Refresh the datatable
			    		$('#datatable_service_providers').DataTable().ajax.reload();
			    	}
			    	else
			    	{
			    		// alertify.error( response.errMsg );
			    		$('#alert_box_modal').find('.modal-header').html('Alert');
    					$('#alert_box_modal').find('.modal-body').html(response.errMsg);
    					$('#alert_box_modal').modal('show');
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

    // To add company category
    $('#btn_modal_services').click(function(){
        $('#modal_add_services').find('.modal-title').html('Add Service');
        $('#modal_add_services').modal('show');
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
			    		// alertify.success( response.errMsg );
			    		$('#alert_box_modal').find('.modal-header').html('Success');
    					$('#alert_box_modal').find('.modal-body').html(response.errMsg);
    					$('#alert_box_modal').modal('show');

			    		// Refresh the form and close the modal
			    		$('#frm_add_company_category')[0].reset();

			    		$('#modal_add_company_category').modal('hide');

			    		// Refresh the datatable
			    		$('#datatable_company_categories').DataTable().ajax.reload();
			    	}
			    	else
			    	{
			    		// alertify.error( response.errMsg );
			    		$('#alert_box_modal').find('.modal-header').html('Alert');
    					$('#alert_box_modal').find('.modal-body').html(response.errMsg);
    					$('#alert_box_modal').modal('show');
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
        // Hide the loader when datatable is rendered
        "initComplete": function(settings, json) {
        	$('.loader-wrapper').hide();
        },
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
    		// alertify.error('Missing category id');
    		$('#alert_box_modal').find('.modal-header').html('Alert');
			$('#alert_box_modal').find('.modal-body').html('Missing category id');
			$('#alert_box_modal').modal('show');
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
			    		// alertify.success( response.errMsg );
			    		$('#alert_box_modal').find('.modal-header').html('Success');
    					$('#alert_box_modal').find('.modal-body').html(response.errMsg);
    					$('#alert_box_modal').modal('show');

			    		// Refresh the form and close the modal
			    		$('#frm_add_payment_plan')[0].reset();

			    		$('#modal_payment_plan').modal('hide');

			    		// Refresh the datatable
			    		$('#datatable_payment_plans').DataTable().ajax.reload();
			    	}
			    	else
			    	{
			    		// alertify.error( response.errMsg );
			    		$('#alert_box_modal').find('.modal-header').html('Alert');
    					$('#alert_box_modal').find('.modal-body').html(response.errMsg);
    					$('#alert_box_modal').modal('show');
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
            { "className": "dt-center", "targets": [0, 7, 8] },
            { "className": "dt-right", "targets": [2, 3, 4, 5] }
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
			    	$('#modal_payment_plan').find('.modal-title').html('Edit Plan');

			    	// Auto-fill the form
			    	$('#frm_add_payment_plan #payment_plan_id').val(planId);
			    	$('#frm_add_payment_plan #payment_plan_type').val(response.plan_type_id);
			    	$('#frm_add_payment_plan #payment_plan_name').val(response.plan_name);
			    	$('#frm_add_payment_plan #payment_plan_charge').val(response.plan_charge);
			    	$('#frm_add_payment_plan #payment_plan_discount').val(response.discount);
			    	$('#frm_add_payment_plan #payment_plan_validity').val(response.validity_days);
			    	$('#frm_add_payment_plan #payment_plan_emails').val(response.allowed_count);
			    	$('#frm_add_payment_plan input[name="payment_plan_status"][value="'+ response.status +'"]').prop('checked', true);

			    	$('#frm_add_payment_plan input[name="trial_plan"][value="'+ response.trial_plan +'"]').prop('checked', true);

			    	// Show the modal
			    	$('#modal_payment_plan').modal('show');
			    }
			});
    	}
    	else
    	{
    		// alertify.error('Missing category id');
    		$('#alert_box_modal').find('.modal-header').html('Alert');
			$('#alert_box_modal').find('.modal-body').html('Missing category id');
			$('#alert_box_modal').modal('show');
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
			    		// alertify.success( response.errMsg );
			    		$('#alert_box_modal').find('.modal-header').html('Success');
						$('#alert_box_modal').find('.modal-body').html(response.errMsg);
						$('#alert_box_modal').modal('show');

			    		// Refresh the form and close the modal
			    		$('#frm_add_city')[0].reset();

			    		$('#modal_add_city').modal('hide');

			    		// Refresh the datatable
			    		$('#datatable_cities').DataTable().ajax.reload();
			    	}
			    	else
			    	{
			    		// alertify.error( response.errMsg );
			    		$('#alert_box_modal').find('.modal-header').html('Alert');
						$('#alert_box_modal').find('.modal-body').html(response.errMsg);
						$('#alert_box_modal').modal('show');
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
        // Hide the loader when datatable is rendered
        "initComplete": function(settings, json) {
        	$('.loader-wrapper').hide();
        },
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
    		// alertify.error('Missing category id');
    		$('#alert_box_modal').find('.modal-header').html('Alert');
			$('#alert_box_modal').find('.modal-body').html('Missing category id');
			$('#alert_box_modal').modal('show');
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
	        company_name: {
	        	required: true
	        },
	        company_category: {
	        	required: true
	        },
	        company_address1: {
	        	required: true
	        },
	        company_province: {
	        	required: true
	        },
	        company_city: {
	        	required: true
	        },
            company_country: {
                required: true
            },
	        company_postalcode: {
	        	required: true
	        },
			company_status: {
	        	required: true	
	        },
	        payment_plan: {
	        	required: true	
	        }
	    },
	    messages: {
	        company_name: {
	        	required: 'Please enter company name'
	        },
	        company_category: {
	        	required: 'Please select company category'
	        },
	        company_address1: {
	        	required: 'Please enter company address'
	        },
	        company_province: {
	        	required: 'Please select province'
	        },
	        company_city: {
	        	required: 'Please select city'
	        },
            company_country: {
                required: 'Please select country'
            },
	        company_postalcode: {
	        	required: 'Please enter postal code'
	        },
	        company_status: {
	        	required: 'Please select status'
	        },
	        payment_plan: {
	        	required: 'Please select payment plan'	
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
			    		// alertify.success( response.errMsg );
			    		$('#alert_box_modal').find('.modal-header').html('Success');
    					$('#alert_box_modal').find('.modal-body').html(response.errMsg);
    					$('#alert_box_modal').modal('show');

			    		// Refresh the form and close the modal
			    		$('#frm_add_company')[0].reset();

			    		$('#modal_add_company').modal('hide');

			    		// Refresh the datatable
			    		$('#datatable_companies').DataTable().ajax.reload();
			    	}
			    	else
			    	{
			    		// alertify.error( response.errMsg );
			    		$('#alert_box_modal').find('.modal-header').html('Alert');
    					$('#alert_box_modal').find('.modal-body').html(response.errMsg);
    					$('#alert_box_modal').modal('show');
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
            { "className": "dt-center", "targets": [0, 6, 7] }
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
            { 'bSortable' : true },
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
			    	$('#frm_edit_company #street-address_edit').val(response.address1);
                    $('#frm_edit_company #street-address2_edit').val(response.address2);
			    	$('#frm_edit_company #company_province_edit').val(response.province_id);
                    $('#frm_edit_company #company_profile_image').attr('src', response.image);
			    	
			    	// Fill the cities
			    	var cities = '<option value="">Select</option>';
			    	for (var key in response.cities)
			    	{
			    	  	cities += '<option value="'+response.cities[key].id+'">'+response.cities[key].city+'</option>';
			    	}
			    	$('#frm_edit_company #company_city_edit').html(cities);
					
					// Make the city selected 
					$('#frm_edit_company #company_city_edit').val(response.city_id);
                    $('#frm_edit_company #company_country_edit').val(response.country_id);

			    	$('#frm_edit_company #postcode_edit').val(response.postal_code);

			    	// Make the payment plan selection
			    	if( $('#frm_edit_company #company_category').val() != '1' )
			    	{
			    		$('#edit_payment_plan_container').show();
			    		$('#frm_edit_company #payment_plan').val(response.paymentPlan);
			    	}
			    	else
			    	{
			    		$('#edit_payment_plan_container').hide();
			    	}
			    	
			    	$('#frm_edit_company input[name="company_status_edit"][value="'+ response.status +'"]').prop('checked', true);

			    	// Show the modal
			    	$('#modal_edit_company').modal('show');
			    }
			});
    	}
    });

    // To check the file extension
    $('#frm_edit_company #company_upload_image').change(function()
    {
        var ext = $(this).val().split('.').pop().toLowerCase();
        if($.inArray(ext, ['png','jpg','jpeg']) == -1) {
            $(this).val('');
            alert('invalid file type, only images are allowed');
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
	        company_category_edit: {
	        	required: true
	        },
	        company_address1_edit: {
	        	required: true
	        },
	        company_province_edit: {
	        	required: true
	        },
	        company_city_edit: {
	        	required: true
	        },
	        company_postalcode_edit: {
	        	required: true
	        },
			company_status: {
	        	required: true	
	        },
            company_upload_image: {
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
	        company_category_edit: {
	        	required: 'Please select company category'
	        },
	        company_address1_edit: {
	        	required: 'Please enter company address'
	        },
	        company_province_edit: {
	        	required: 'Please select province'
	        },
	        company_city_edit: {
	        	required: 'Please select city'
	        },
	        company_postalcode_edit: {
	        	required: 'Please enter postal code'
	        },
	        company_status: {
	        	required: 'Please select status'
	        },
            company_upload_image: {
                required: 'Please select image to upload'
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
            // Ajax call to save the page related data
            var $this = $(this);

            var company_name            = $('#frm_edit_company #company_name').val();
            var company_id              = $('#frm_edit_company #company_id').val();
            var company_category        = $("#frm_edit_company #company_category").val();
            var company_address1        = $('#frm_edit_company #street-address_edit').val();
            var company_address2        = $('#frm_edit_company #street-address2_edit').val();
            var company_province        = $("#frm_edit_company #company_province_edit").val();
            var company_city            = $("#frm_edit_company #company_city_edit").val();
            var company_country         = $("#frm_edit_company #company_country_edit").val();
            var postal_code             = $("#frm_edit_company #postcode_edit").val();
            var payment_plan            = $("#frm_edit_company #payment_plan").val();

            var company_status          = $("input[name='company_status_edit']:checked").val();
            var fileData                = $('#frm_edit_company #company_upload_image').prop('files')[0];

            // Create form data object and append the values into it
            var formData = new FormData();
            formData.append('fileData', fileData);
            formData.append('company_name', company_name);
            formData.append('company_id', company_id);
            formData.append('company_category', company_category);
            formData.append('company_address1', company_address1);
            formData.append('company_address2', company_address2);
            formData.append('company_province', company_province);
            formData.append('company_city', company_city);
            formData.append('company_country', company_country);
            formData.append('postal_code', postal_code);
            formData.append('payment_plan', payment_plan);

            formData.append('company_status', company_status);
            
    		$.ajax({
    			url: $('meta[name="route"]').attr('content') + '/administrator/updatecompanydetails',
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
			    		// alertify.success( response.errMsg );
			    		$('#alert_box_modal').find('.modal-header').html('Success');
    					$('#alert_box_modal').find('.modal-body').html(response.errMsg);
    					$('#alert_box_modal').modal('show');

			    		// Refresh the form and close the modal
			    		$('#frm_edit_company')[0].reset();

			    		$('#modal_edit_company').modal('hide');

			    		// Refresh the datatable
			    		$('#datatable_companies').DataTable().ajax.reload();
			    	}
			    	else
			    	{
			    		// alertify.error( response.errMsg );
			    		$('#alert_box_modal').find('.modal-header').html('Alert');
    					$('#alert_box_modal').find('.modal-body').html(response.errMsg);
    					$('#alert_box_modal').modal('show');
			    	}
			    }
    		});
		}
	});

	// To add an agent under the company
	$('#btn_modal_agent').click(function(){
		$('#modal_add_agent').find('.modal-title').text('ADD AGENT');
		$('#modal_add_agent').modal('show');
	});

	// To add a company representative under the company
	$('#btn_modal_company_representative').click(function(){
		$('#modal_add_company_representative').find('.modal-title').text('Add Company Representative');
		$('#modal_add_company_representative').modal('show');
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
	        agent_address1: {
	            required: true
	        },
	        agent_payment_plan: {
	        	required: true
	        },
			company_status: {
	        	required: true	
	        },

	        agent_city :{
	        	required: true
	        },
	        agent_province :{
	        	required: true
	        },
	        agent_postalcode :{
	        	required: true
	        },
	        agent_country :{
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
	        agent_address1: {
	            required: 'Please enter address'
	        },
	        agent_payment_plan: {
	        	required: 'Please select a payment plan'
	        },
			company_status: {
	        	required: 'Please select status'	
	        },

	        agent_city :{
	        	required: 'Please select city'
	        },
	        agent_province :{
	        	required: 'Please select province'
	        },
	        agent_postalcode :{
	        	required: 'Please enter postalcode'
	        },
	        agent_country :{
	        	required: 'Please select country'
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
			    		// alertify.success( response.errMsg );
			    		$('#alert_box_modal').find('.modal-header').html('Success');
    					$('#alert_box_modal').find('.modal-body').html(response.errMsg);
    					$('#alert_box_modal').modal('show');
						
			    		// Refresh the form and close the modal
			    		$('#frm_add_agent')[0].reset();

			    		$('#modal_add_agent').modal('hide');

			    		// Refresh the datatable
			    		$('#datatable_agents').DataTable().ajax.reload();
			    	}
			    	else
			    	{
			    		// alertify.error( response.errMsg );
			    		$('#alert_box_modal').find('.modal-header').html('Alert');
    					$('#alert_box_modal').find('.modal-body').html(response.errMsg);
    					$('#alert_box_modal').modal('show');
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
	        { "className": "dt-center", "targets": [ 0, 6, 7 ] }
	    ],
	    // Hide the loader when datatable is rendered
	    "initComplete": function(settings, json) {
	    	$('.loader-wrapper').hide();
	    },
	    "aoColumns": [
	        { 'bSortable' : true },
	        { 'bSortable' : true },
	        { 'bSortable' : true },
	        { 'bSortable' : false },
	        { 'bSortable' : false },
	        { 'bSortable' : false },
	        { 'bSortable' : true },
	        { 'bSortable' : false }
	    ]
	});

	// To update the agent details
	$(document).on('click', '.edit_agent', function(){

		$('#modal_edit_agent').find('.modal-title').text('EDIT AGENT');

		var agentId = $(this).attr('id');
		var userType= $(this).attr('data-usertype');

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
			    	$('#frm_edit_agent #agent_edit_address1').val(response.address1);
			    	$('#frm_edit_agent #agent_edit_province').val(response.province_id);
			    	$('#frm_edit_agent #agent_edit_postalcode').val(response.postalcode);
			    	$('#frm_edit_agent #agent_edit_country').val(response.country_id);
			    	$('#frm_edit_agent #agent_company').val(response.company_id);
			    	
			    	// Fill the cities
			    	$('#frm_edit_agent #agent_edit_city').html(response.cities);
					
					// Make the city selected 
					$('#frm_edit_agent #agent_edit_city').val(response.city_id);

			    	$('#frm_edit_agent input[name="agent_status"][value="'+ response.status +'"]').prop('checked', true);

			    	// Fill the user type
			    	$('#frm_edit_agent #user_type').val(userType);

			    	// payment plan 
			    	$('#frm_edit_agent #agent_edit_payment_plan').val(response.paymentPlan);

			    	// Show the modal
			    	$('#modal_edit_agent').modal('show');
			    }
			});
    	}
	});

	// Add company representative form validation
	$('#frm_add_company_representative').submit(function(e){
	    e.preventDefault();
	});

	$('#frm_add_company_representative').validate({
	    rules: {
	        company_representative_company: {
	            required: true
	        },
	        company_representative_fname: {
	            required: true
	        },
	        company_representative_lname: {
	            required: true
	        },
	        company_representative_email: {
	            required: true,
	        	email: true
	        },
	        company_representative_password: {
	            required: true,
	        	minlength: 6,
	        	atLeastOneLowercaseLetter: true,
	        	atLeastOneUppercaseLetter: true,
	        	atLeastOneNumber: true,
	        	atLeastOneSymbol: true
	        },
	        company_representative_address1: {
	            required: true
	        },
			company_representative_status: {
	        	required: true	
	        },

	        company_representative_city: {
	        	required: true	
	        },
	        company_representative_province: {
	        	required: true	
	        },
	        company_representative_postalcode: {
	        	required: true	
	        },
	        company_representative_country: {
	        	required: true	
	        }
	    },
	    messages: {
	        company_representative_company: {
	            required: 'Please select company'
	        },
	        company_representative_fname: {
	            required: 'Please enter first name'
	        },
	        company_representative_lname: {
	            required: 'Please enter last name'
	        },
	        company_representative_email: {
	            required: 'Please enter email',
	        	email: 'Please enter valid email'
	        },
	        company_representative_password: {
	            required: 'Please enter password',
	        	minlength: 'Password must contain atleat 6 characters'
	        },
	        company_representative_address1: {
	            required: 'Please enter address'
	        },
			company_representative_status: {
	        	required: 'Please select status'	
	        },

	        company_representative_city: {
	        	required: 'Please select city'	
	        },
	        company_representative_province: {
	        	required: 'Please select province'	
	        },
	        company_representative_postalcode: {
	        	required: 'Please enter postalcode'
	        },
	        company_representative_country: {
	        	required: 'Please select country'
	        }
	    }
	});

	// Save the company representative data
	$('#btn_add_company_representative').click(function(){
		if( $('#frm_add_company_representative').valid() )
		{
    		$.ajax({
    			url: $('meta[name="route"]').attr('content') + '/administrator/savecompanyrepresentative',
    			method: 'post',
    			data: {
    				frmData: $('#frm_add_company_representative').serialize()
    			},
    			headers: {
			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    },
			    success: function(response){
			    	if( response.errCode == 0 )
			    	{
			    		// alertify.success( response.errMsg );
			    		$('#alert_box_modal').find('.modal-header').html('Success');
    					$('#alert_box_modal').find('.modal-body').html(response.errMsg);
    					$('#alert_box_modal').modal('show');
						
			    		// Refresh the form and close the modal
			    		$('#frm_add_company_representative')[0].reset();

			    		$('#modal_add_company_representative').modal('hide');

			    		// Refresh the datatable
			    		$('#datatable_company_representatives').DataTable().ajax.reload();
			    	}
			    	else
			    	{
			    		// alertify.error( response.errMsg );
			    		$('#alert_box_modal').find('.modal-header').html('Alert');
    					$('#alert_box_modal').find('.modal-body').html(response.errMsg);
    					$('#alert_box_modal').modal('show');
			    	}
			    }
    		});
		}
	});

	// To update the company representative details
	$(document).on('click', '.edit_company_representative', function(){

		$('#modal_edit_company_representative').find('.modal-title').text('Edit Company Representative');

		var companyRepId = $(this).attr('id');
		var userType= $(this).attr('data-usertype');

    	if( companyRepId != '' )
    	{
    		// Get the details of selected company representative
    		$.ajax({
				url: $('meta[name="route"]').attr('content') + '/administrator/getcompanyrepresentativedetails',
				method: 'get',
				data: {
					companyRepId: companyRepId
				},
			    success: function(response){
			    	$('#frm_edit_company_representative #company_representative_id').val(companyRepId);

			    	$('#frm_edit_company_representative #company_representative_fname').val(response.fname);
			    	$('#frm_edit_company_representative #company_representative_lname').val(response.lname);
			    	$('#frm_edit_company_representative #company_representative_email').val(response.email);
			    	$('#frm_edit_company_representative #company_representative_edit_address1').val(response.address1);
			    	$('#frm_edit_company_representative #company_representative_edit_province').val(response.province_id);
			    	$('#frm_edit_company_representative #company_representative_edit_postalcode').val(response.postalcode);
			    	$('#frm_edit_company_representative #company_representative_edit_country').val(response.country_id);
			    	$('#frm_edit_company_representative #company_representative_company').val(response.company_id);
			    	
			    	// Fill the cities
			    	$('#frm_edit_company_representative #company_representative_edit_city').html(response.cities);
					
					// Make the city selected 
					$('#frm_edit_company_representative #company_representative_edit_city').val(response.city_id);

			    	$('#frm_edit_company_representative input[name="company_representative_status"][value="'+ response.status +'"]').prop('checked', true);

			    	// Fill the user type
			    	$('#frm_edit_company_representative #user_type').val(userType);

			    	// Show the modal
			    	$('#modal_edit_company_representative').modal('show');
			    }
			});
    	}
	});

	// To update company representative details
	$('#frm_edit_company_representative').submit(function(e){
	    e.preventDefault();
	});
	$('#frm_edit_company_representative').validate({
	    rules: {
	        company_representative_company: {
	            required: true
	        },
	        company_representative_fname: {
	            required: true
	        },
	        company_representative_lname: {
	            required: true
	        },
	        company_representative_email: {
	            required: true,
	        	email: true
	        },
	        company_representative_edit_address1: {
	            required: true
	        },
			company_representative_status: {
	        	required: true	
	        },

	        company_representative_edit_city: {
	        	required: true
	        },
	        company_representative_edit_province: {
	        	required: true
	        },
	        company_representative_edit_postalcode: {
	        	required: true
	        },
	        company_representative_edit_country: {
	        	required: true
	        }
	    },
	    messages: {
	        company_representative_company: {
	            required: 'Please select company'
	        },
	        company_representative_fname: {
	            required: 'Please enter first name'
	        },
	        company_representative_lname: {
	            required: 'Please enter last name'
	        },
	        company_representative_email: {
	            required: 'Please enter email',
	        	email: 'Please enter valid email'
	        },
	        company_representative_edit_address1: {
	            required: 'Please enter address'
	        },
			company_representative_status: {
	        	required: 'Please select status'	
	        },

	        company_representative_edit_city: {
	        	required: 'Please select city'
	        },
	        company_representative_edit_province: {
	        	required: 'Please select province'
	        },
	        company_representative_edit_postalcode: {
	        	required: 'Please enter postalcode'
	        },
	        company_representative_edit_country: {
	        	required: 'Please select country'	
	        }
	    }
	});

	// Update the agent data
	$('#btn_edit_company_representative').click(function(){
		if( $('#frm_edit_company_representative').valid() )
		{
    		$.ajax({
    			url: $('meta[name="route"]').attr('content') + '/administrator/updatecompanyrepresentative',
    			method: 'post',
    			data: {
    				frmData: $('#frm_edit_company_representative').serialize()
    			},
    			headers: {
			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    },
			    success: function(response){
			    	if( response.errCode == 0 )
			    	{
			    		// alertify.success( response.errMsg );
			    		$('#alert_box_modal').find('.modal-header').html('Success');
    					$('#alert_box_modal').find('.modal-body').html(response.errMsg);
    					$('#alert_box_modal').modal('show');
						
			    		// Refresh the form and close the modal
			    		$('#frm_edit_company_representative')[0].reset();

			    		$('#modal_edit_company_representative').modal('hide');

			    		// Refresh the datatable
			    		$('#datatable_company_representatives').DataTable().ajax.reload();
			    	}
			    	else
			    	{
			    		// alertify.error( response.errMsg );
			    		$('#alert_box_modal').find('.modal-header').html('Alert');
    					$('#alert_box_modal').find('.modal-body').html(response.errMsg);
    					$('#alert_box_modal').modal('show');
			    	}
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
	        agent_edit_address1: {
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
	        },
	        agent_edit_payment_plan: {
	        	required: true	
	        },

	        agent_edit_city: {
	        	required: true
	        },
	        agent_edit_province: {
	        	required: true
	        },
	        agent_edit_postalcode: {
	        	required: true
	        },
	        agent_edit_country: {
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
	        agent_edit_address1: {
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
	        },
	        agent_edit_payment_plan: {
	        	required: 'Please select payment plan'
	        },

	        agent_edit_city: {
	        	required: 'Please select city'
	        },
	        agent_edit_province: {
	        	required: 'Please select province'
	        },
	        agent_edit_postalcode: {
	        	required: 'Please enter postal code'
	        },
	        agent_edit_country: {
	        	required: 'Please select city'
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
			    		// alertify.success( response.errMsg );
			    		$('#alert_box_modal').find('.modal-header').html('Success');
    					$('#alert_box_modal').find('.modal-body').html(response.errMsg);
    					$('#alert_box_modal').modal('show');
						
			    		// Refresh the form and close the modal
			    		$('#frm_edit_agent')[0].reset();

			    		$('#modal_edit_agent').modal('hide');

			    		// Refresh the datatable
			    		$('#datatable_agents').DataTable().ajax.reload();
			    	}
			    	else
			    	{
			    		// alertify.error( response.errMsg );
			    		$('#alert_box_modal').find('.modal-header').html('Alert');
    					$('#alert_box_modal').find('.modal-body').html(response.errMsg);
    					$('#alert_box_modal').modal('show');
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
    		   	// alertify.error('Please enter some content');
	    		$('#alert_box_modal').find('.modal-header').html('Success');
				$('#alert_box_modal').find('.modal-body').html('Please enter some content');
				$('#alert_box_modal').modal('show');
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
				    		// alertify.success( response.errMsg );
				    		$('#alert_box_modal').find('.modal-header').html('Success');
							$('#alert_box_modal').find('.modal-body').html(response.errMsg);
							$('#alert_box_modal').modal('show');
							
				    		// Refresh the form and close the modal
				    		$('#frm_email_template')[0].reset();

				    		$('#modal_email_template').modal('hide');

				    		// Refresh the datatable
				    		$('#datatable_email_templates').DataTable().ajax.reload();
				    	}
				    	else
				    	{
				    		// alertify.error( response.errMsg );
				    		$('#alert_box_modal').find('.modal-header').html('Alert');
							$('#alert_box_modal').find('.modal-body').html(response.errMsg);
							$('#alert_box_modal').modal('show');
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
                    $('#frm_email_template #template_category').val(response.category_id);
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

    // To add new response time
    $('#btn_modal_response_time').click(function(){
    	$('#modal_response_time').find('.modal-title').text('Add Response Time');
    	$('#modal_response_time').modal('show');
    });

    // Response time form validation
    $('#frm_response_time').submit(function(e){
        e.preventDefault();
    });

    $('#frm_response_time').validate({
        rules: {
            slot_title: {
                required: true
            },
    		slot_time: {
            	required: true	
            }
        },
        messages: {
            slot_title: {
                required: 'Please enter slot title'
            },
    		slot_time: {
            	required: 'Please enter slot time'
            }
        }
    });

    // Save the data
    $('#btn_add_response_time').click(function(){
    	if( $('#frm_response_time').valid() )
    	{
    		var $this = $(this);

    		$.ajax({
    		    url: $('meta[name="route"]').attr('content') + '/administrator/saveresponsetime',
    		    method: 'post',
    		    data: {
    		        frmData: $('#frm_response_time').serialize()
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
    		            // alertify.success( response.errMsg );
    		            $('#alert_box_modal').find('.modal-header').html('Success');
						$('#alert_box_modal').find('.modal-body').html(response.errMsg);
						$('#alert_box_modal').modal('show');

    		            // Refresh the form and close the modal
    		            $('#frm_response_time')[0].reset();

    		            // Open the modal
    		            $('#modal_response_time').modal('hide');

    		            // Refresh the datatable
			    		$('#datatable_time_response').DataTable().ajax.reload();
    		        }
    		        else
    		        {
    		            // alertify.error( response.errMsg );
    		            $('#alert_box_modal').find('.modal-header').html('Alert');
						$('#alert_box_modal').find('.modal-body').html(response.errMsg);
						$('#alert_box_modal').modal('show');
    		        }
    		    }
    		});
    	}
    });

    // Datatable to show the resposne time slots
    $.fn.dataTableExt.errMode = 'ignore';
    $('#datatable_time_response').dataTable({
        "sServerMethod": "get", 
        "bProcessing": true,
        "bServerSide": true,
        "sAjaxSource": $('meta[name="route"]').attr('content') + '/administrator/fetchresponsetimeslots',
        "columnDefs": [
            { "className": "dt-center", "targets": [0, 3, 4] }
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
            { 'bSortable' : false, 'width': '10%' }
        ]
    });

    // Tp update the response time slot details
    $(document).on('click', '.edit_time_slot', function(){
    	
    	var slotId = $(this).attr('id');

    	if( slotId != '' )
    	{
    		// Get the details of selected email template
    		$.ajax({
				url: $('meta[name="route"]').attr('content') + '/administrator/getresponsetimeslotdetails',
				method: 'get',
				data: {
					slotId: slotId
				},
			    success: function(response){
			    	// Auto-fill the form
			    	$('#frm_response_time #slot_id').val(slotId);
                    $('#frm_response_time #slot_title').val(response.slot_title);
			    	$('#frm_response_time #slot_time').val(response.slot_time);
			    	$('#frm_response_time input[name="slot_status"][value="'+ response.status +'"]').prop('checked', true);

			    	// Show the modal
			    	$('#modal_response_time').find('.modal-title').text('Edit Response Time');
    				$('#modal_response_time').modal('show');
			    }
			});
    	}
    });
	
	
	//codes to manage laratrust added start here
	// To add new role
    $('#btn_modal_role').click(function(){
    	// Set the title
    	$('#modal_add_role').find('.modal-title').html('Add Role');

    	// Refresh the role_id value
		$('#role_id').val('');

    	// Show the modal
		$('#modal_add_role').modal('show');
    });

    // role form validation
    $('#frm_add_role').submit(function(e){
        e.preventDefault();
    });
    $('#frm_add_role').validate({
        rules: {
            name: {
            	required: true
            },
            display_name: {
            	required: true
            },
            description: {
            	required: true
            }
        },
        messages: {
            name: {
            	required: 'Please enter role name'
            },
            display_name: {
            	required: 'Please enter display name'
            },
            description: {
            	required: 'Please enter description'
            }
        }
    });

    // Save the role details
    $('#btn_add_role').click(function(){
    	if( $('#frm_add_role').valid() )
    	{
    		// Ajax call to save the role detail data
            var $this = $(this);
			var role_id     	= $('#role_id').val();
            var name     		= $('#name').val();
            var display_name   	= $('#display_name').val();
            var description		= $("#description").val();

            // Create form data object and append the values into it
            var formData = new FormData();
			formData.append('role_id', role_id);
            formData.append('name', name);
            formData.append('display_name', display_name);
            formData.append('description', description);

    		$.ajax({
    			url: $('meta[name="route"]').attr('content') + '/administrator/saverole',
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
			    		// alertify.success( response.errMsg );
			    		$('#alert_box_modal').find('.modal-header').html('Success');
						$('#alert_box_modal').find('.modal-body').html(response.errMsg);
						$('#alert_box_modal').modal('show');

			    		// Refresh the form and close the modal
			    		$('#frm_add_role')[0].reset();

			    		$('#modal_add_role').modal('hide');

			    		// Refresh the datatable
			    		$('#datatable_roles').DataTable().ajax.reload();
			    	}
			    	else
			    	{
			    		// alertify.error( response.errMsg );
			    		$('#alert_box_modal').find('.modal-header').html('Alert');
						$('#alert_box_modal').find('.modal-body').html(response.errMsg);
						$('#alert_box_modal').modal('show');
			    	}
			    }
    		});
    	}
    });

    // To show the role list in datatable
    $.fn.dataTableExt.errMode = 'ignore';
    $('#datatable_roles').dataTable({
        "sServerMethod": "get", 
        "bProcessing": true,
        "bServerSide": true,
        "sAjaxSource": $('meta[name="route"]').attr('content') + '/administrator/fetchroles',
        "columnDefs": [
            { "className": "dt-center", "targets": [ 0, 4 ] }
        ],
        "aoColumns": [
            { 'bSortable' : true },
            { 'bSortable' : true },
            { 'bSortable' : true },
            { 'bSortable' : true },
			{ 'bSortable' : false }
            
        ]
    });


    // To edit the role details
    $(document).on('click', '.edit_role', function(){
    	var roleId = $(this).attr('id');

    	if( roleId != '' )
    	{
    		// Get the role details for the selected role
    		$.ajax({
    			url: $('meta[name="route"]').attr('content') + '/administrator/getselectedrole',
    			method: 'get',
    			data: {
    				roleId: roleId
    			},
			    success: function(response){
			    	// Set the title
				    $('#modal_add_role').find('.modal-title').html('Edit Role');

				    // Auto-fill the form
				    $('#frm_add_role #role_id').val(roleId);

				    $('#frm_add_role #name').val(response.name);
				    $('#frm_add_role #display_name').val(response.display_name);
				    $('#frm_add_role #description').val(response.description);
				    
				    // Show the modal
				    $('#modal_add_role').modal('show');
			    },
				error: function(xhr, ajaxOptions, thrownError) {
					alert(thrownError + "\r\n" + xhr.statusText);
				}
				
    		});
    	}
		else
        {
            // alertify.error('Missing Role id');
            $('#alert_box_modal').find('.modal-header').html('Alert');
			$('#alert_box_modal').find('.modal-body').html('Missing Role id');
			$('#alert_box_modal').modal('show');
        }
    });

	// To add new permission
    $('#btn_modal_permission').click(function(){
    	// Set the title
    	$('#modal_add_permission').find('.modal-title').html('Add Permission');

    	// Refresh the permission_id value
		$('#permission_id').val('');

    	// Show the modal
		$('#modal_add_permission').modal('show');
    });

    // permission form validation
    $('#frm_add_permission').submit(function(e){
        e.preventDefault();
    });
    $('#frm_add_permission').validate({
        rules: {
            name: {
            	required: true
            },
            display_name: {
            	required: true
            },
            description: {
            	required: true
            }
        },
        messages: {
            name: {
            	required: 'Please enter permission name'
            },
            display_name: {
            	required: 'Please enter display name'
            },
            description: {
            	required: 'Please enter description'
            }
        }
    });

    // Save the permission details
    $('#btn_add_permission').click(function(){
    	if( $('#frm_add_permission').valid() )
    	{
    		// Ajax call to save the permission detail data
            var $this = $(this);
			var permission_id   = $('#permission_id').val();
            var name     		= $('#name').val();
            var display_name   	= $('#display_name').val();
            var description		= $("#description").val();

            // Create form data object and append the values into it
            var formData = new FormData();
			formData.append('permission_id', permission_id);
            formData.append('name', name);
            formData.append('display_name', display_name);
            formData.append('description', description);

    		$.ajax({
    			url: $('meta[name="route"]').attr('content') + '/administrator/savepermission',
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
			    		// alertify.success( response.errMsg );
			    		$('#alert_box_modal').find('.modal-header').html('Success');
						$('#alert_box_modal').find('.modal-body').html(response.errMsg);
						$('#alert_box_modal').modal('show');

			    		// Refresh the form and close the modal
			    		$('#frm_add_permission')[0].reset();

			    		$('#modal_add_permission').modal('hide');

			    		// Refresh the datatable
			    		$('#datatable_permissions').DataTable().ajax.reload();
			    	}
			    	else
			    	{
			    		// alertify.error( response.errMsg );
			    		$('#alert_box_modal').find('.modal-header').html('Alert');
						$('#alert_box_modal').find('.modal-body').html(response.errMsg);
						$('#alert_box_modal').modal('show');
			    	}
			    }
    		});
    	}
    });

    // To show the permission list in datatable
    $.fn.dataTableExt.errMode = 'ignore';
    $('#datatable_permissions').dataTable({
        "sServerMethod": "get", 
        "bProcessing": true,
        "bServerSide": true,
        "sAjaxSource": $('meta[name="route"]').attr('content') + '/administrator/fetchpermissions',
        "columnDefs": [
            { "className": "dt-center", "targets": [ 0, 4 ] }
        ],
        "aoColumns": [
            { 'bSortable' : true },
            { 'bSortable' : true },
            { 'bSortable' : true },
            { 'bSortable' : true },
			{ 'bSortable' : false }
            
        ]
    });


    // To edit the permission details
    $(document).on('click', '.edit_permission', function(){
    	var permissionId = $(this).attr('id');

    	if( permissionId != '' )
    	{
    		// Get the permission details for the selected permission
    		$.ajax({
    			url: $('meta[name="route"]').attr('content') + '/administrator/getselectedpermission',
    			method: 'get',
    			data: {
    				permissionId: permissionId
    			},
			    success: function(response){
			    	// Set the title
				    $('#modal_add_permission').find('.modal-title').html('Edit Permission');

				    // Auto-fill the form
				    $('#frm_add_permission #permission_id').val(permissionId);

				    $('#frm_add_permission #name').val(response.name);
				    $('#frm_add_permission #display_name').val(response.display_name);
				    $('#frm_add_permission #description').val(response.description);
				    
				    // Show the modal
				    $('#modal_add_permission').modal('show');
			    }
				
    		});
    	}
		else
        {
            // alertify.error('Missing permission id');
    		$('#alert_box_modal').find('.modal-header').html('Alert');
			$('#alert_box_modal').find('.modal-body').html('Missing permission id');
			$('#alert_box_modal').modal('show');
        }
    });

	// To attach new permission to role
    $('#btn_modal_rolepermissions').click(function(){
    	// Set the title
    	$('#modal_add_rolepermissions').find('.modal-title').html('Add RolePermission');

    	// Show the modal
		$('#modal_add_rolepermissions').modal('show');
    });

    // rolepermissions form data validation
    $('#frm_add_rolepermissions').submit(function(e){
        e.preventDefault();
    });
    $('#frm_add_rolepermissions').validate({
        rules: {
            role_name: {
            	required: true
            },
            permission_name: {
            	required: true
            }
        },
        messages: {
            role_name: {
            	required: 'Please select role'
            },
            permission_name: {
            	required: 'Please select permission'
            }
        }
    });

    // Save the rolepermissions details
    $('#btn_add_rolepermissions').click(function(){
    	if( $('#frm_add_rolepermissions').valid() )
    	{
    		// Ajax call to attach the rolepermissions detail data
            var $this = $(this);
			var role_name     		= $('#role_name').val();
            var permission_name   	= $('#permission_name').val();
            
            // Create form data object and append the values into it
            var formData = new FormData();
			formData.append('role_name', role_name);
            formData.append('permission_name', permission_name);
            
    		$.ajax({
    			url: $('meta[name="route"]').attr('content') + '/administrator/saverolepermission',
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
			    		// alertify.success( response.errMsg );
			    		$('#alert_box_modal').find('.modal-header').html('Success');
    					$('#alert_box_modal').find('.modal-body').html(response.errMsg);
    					$('#alert_box_modal').modal('show');

			    		// Refresh the form and close the modal
			    		$('#frm_add_rolepermissions')[0].reset();

			    		$('#modal_add_rolepermissions').modal('hide');

			    		// Refresh the datatable
			    		$('#datatable_rolepermissions').DataTable().ajax.reload();
			    	}
			    	else
			    	{
			    		// alertify.error( response.errMsg );
			    		$('#alert_box_modal').find('.modal-header').html('Alert');
    					$('#alert_box_modal').find('.modal-body').html(response.errMsg);
    					$('#alert_box_modal').modal('show');
			    	}
			    },
				error: function(xhr, ajaxOptions, thrownError) {
					alert(thrownError + "\r\n" + xhr.statusText);
					
				}
    		});
    	}
    });

    // To show the rolepermissions list in datatable
    $.fn.dataTableExt.errMode = 'ignore';
    $('#datatable_rolepermissions').dataTable({
        "sServerMethod": "get", 
        "bProcessing": true,
        "bServerSide": true,
        "sAjaxSource": $('meta[name="route"]').attr('content') + '/administrator/fetchrolespermissions',
        "columnDefs": [
            { "className": "dt-center", "targets": [2 ] }
        ],
        "aoColumns": [
			
            { 'bSortable' : true },
            { 'bSortable' : true },
           	{ 'bSortable' : false }  
        ]
    });

    // To detach the permission from role 
    $(document).on('click', '.detach_permission_role', function(){
		
		// Show the modal
		$('#deleteDialogModal').modal('show');
		
		var role_permission = $(this).attr('id');	 
		var pos = role_permission.indexOf('+');
		var role_id = role_permission.substring(0, pos);
		var permission_id = role_permission.substring(pos + 1);
		
		 $(document).on('click', '#yes', function(){					
		
		if( role_id != ''  && permission_id != '')
		{
			// Detach permission from the role
			$.ajax({
				url: $('meta[name="route"]').attr('content') + '/administrator/detachrolepermission',
				method: 'get',
				data: {
					role_id: role_id,
					permission_id: permission_id
				},
				success: function(response){
					if( response.errCode == 0 )
					{
						// alertify.success( response.errMsg );
						$('#alert_box_modal').find('.modal-header').html('Success');
    					$('#alert_box_modal').find('.modal-body').html(response.errMsg);
    					$('#alert_box_modal').modal('show');
						
			    		// Refresh the datatable
						$('#datatable_rolepermissions').DataTable().ajax.reload();
					}
					else
					{
						// alertify.error( response.errMsg );
						$('#alert_box_modal').find('.modal-header').html('Alert');
    					$('#alert_box_modal').find('.modal-body').html(response.errMsg);
    					$('#alert_box_modal').modal('show');
					}
				}
				
			});
			
		}
		else
		{
			// alertify.error('Missing permission and role');
			$('#alert_box_modal').find('.modal-header').html('Alert');
			$('#alert_box_modal').find('.modal-body').html(response.errMsg);
			$('#alert_box_modal').modal('show');
		}
		})
		
	});
	
	
	// To attach new role to user
    $('#btn_modal_roleusers').click(function(){
    	// Set the title
    	$('#modal_add_roleuser').find('.modal-title').html('Add RoleUser');

    	// Show the modal
		$('#modal_add_roleusers').modal('show');
    });

    // roleusers form data validation
    $('#frm_add_roleusers').submit(function(e){
        e.preventDefault();
    });
    $('#frm_add_roleusers').validate({
        rules: {
            role_name: {
            	required: true
            },
            user_name: {
            	required: true
            }
        },
        messages: {
            role_name: {
            	required: 'Please select role'
            },
            user_name: {
            	required: 'Please select user email'
            }
        }
    });

    // Save the roleusers details
    $('#btn_add_roleusers').click(function(){
    	if( $('#frm_add_roleusers').valid() )
    	{
    		// Ajax call to attach the roleusers detail data
            var $this = $(this);
			var role_name   = $('#role_name').val();
            var user_name   = $('#user_name').val();
            
            // Create form data object and append the values into it
            var formData = new FormData();
			formData.append('role_name', role_name);
            formData.append('user_name', user_name);
            
    		$.ajax({
    			url: $('meta[name="route"]').attr('content') + '/administrator/saveroleuser',
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
			    		// alertify.success( response.errMsg );
			    		$('#alert_box_modal').find('.modal-header').html('Success');
    					$('#alert_box_modal').find('.modal-body').html(response.errMsg);
    					$('#alert_box_modal').modal('show');

			    		// Refresh the form and close the modal
			    		$('#frm_add_roleusers')[0].reset();

			    		$('#modal_add_roleusers').modal('hide');

			    		// Refresh the datatable
			    		$('#datatable_roleusers').DataTable().ajax.reload();
			    	}
			    	else
			    	{
			    		// alertify.error( response.errMsg );
			    		$('#alert_box_modal').find('.modal-header').html('Alert');
    					$('#alert_box_modal').find('.modal-body').html(response.errMsg);
    					$('#alert_box_modal').modal('show');
			    	}
			    },
				error: function(xhr, ajaxOptions, thrownError) {
					alert(thrownError + "\r\n" + xhr.statusText);
					
				}
    		});
    	}
    });

    // To show the roleusers list in datatable
    $.fn.dataTableExt.errMode = 'ignore';
    $('#datatable_roleusers').dataTable({
        "sServerMethod": "get", 
        "bProcessing": true,
        "bServerSide": true,
        "sAjaxSource": $('meta[name="route"]').attr('content') + '/administrator/fetchrolesusers',
        "columnDefs": [
            { "className": "dt-center", "targets": [2 ] }
        ],
        "aoColumns": [
			
            { 'bSortable' : true },
            { 'bSortable' : true },
           	{ 'bSortable' : false }  
        ]
    });

    // To detach the role from user
    $(document).on('click', '.detach_role_usser', function(){
		
		// Show the modal
		$('#deleteDialogModal').modal('show');
		
		var role_user = $(this).attr('id');	 
		var pos = role_user.indexOf('+');
		var role_id = role_user.substring(0, pos);
		var user_id = role_user.substring(pos + 1);
		
		 $(document).on('click', '#yes', function(){					
		
		if( role_id != ''  && user_id != '')
		{
			// Detach role from the user
			$.ajax({
				url: $('meta[name="route"]').attr('content') + '/administrator/detachroleuser',
				method: 'get',
				data: {
					role_id: role_id,
					user_id: user_id
				},
				success: function(response){
					if( response.errCode == 0 )
					{
						// alertify.success( response.errMsg );
			    		$('#alert_box_modal').find('.modal-header').html('Success');
    					$('#alert_box_modal').find('.modal-body').html(response.errMsg);
    					$('#alert_box_modal').modal('show');
						
			    		// Refresh the datatable
						$('#datatable_roleusers').DataTable().ajax.reload();
					}
					else
					{
						// alertify.error( response.errMsg );
			    		$('#alert_box_modal').find('.modal-header').html('Alert');
    					$('#alert_box_modal').find('.modal-body').html(response.errMsg);
    					$('#alert_box_modal').modal('show');
					}
				}
				
			});
			
		}
		else
		{
			// alertify.error('Missing user and role id');
    		$('#alert_box_modal').find('.modal-header').html('Alert');
			$('#alert_box_modal').find('.modal-body').html('Missing user and role id');
			$('#alert_box_modal').modal('show');
		}
		})
		
	});
	
	
	// To attach new permission to user
    $('#btn_modal_permissionusers').click(function(){
    	// Set the title
    	$('#modal_add_permissionuser').find('.modal-title').html('Add RoleUser');

    	// Show the modal
		$('#modal_add_permissionusers').modal('show');
    });

    // permissionusers form data validation
    $('#frm_add_permissionusers').submit(function(e){
        e.preventDefault();
    });
    $('#frm_add_permissionusers').validate({
        rules: {
            permission_name: {
            	required: true
            },
            user_name: {
            	required: true
            }
        },
        messages: {
            permission_name: {
            	required: 'Please select permission'
            },
            user_name: {
            	required: 'Please select user email'
            }
        }
    });

    // Save the permissionusers details
    $('#btn_add_permissionusers').click(function(){
    	if( $('#frm_add_permissionusers').valid() )
    	{
    		// Ajax call to attach the permissionusers detail data
            var $this = $(this);
			var permission_name   = $('#permission_name').val();
            var user_name   = $('#user_name').val();
            
            // Create form data object and append the values into it
            var formData = new FormData();
			formData.append('permission_name', permission_name);
            formData.append('user_name', user_name);
            
    		$.ajax({
    			url: $('meta[name="route"]').attr('content') + '/administrator/savepermissionuser',
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
			    		// alertify.success( response.errMsg );
			    		$('#alert_box_modal').find('.modal-header').html('Success');
    					$('#alert_box_modal').find('.modal-body').html(response.errMsg);
    					$('#alert_box_modal').modal('show');

			    		// Refresh the form and close the modal
			    		$('#frm_add_permissionusers')[0].reset();

			    		$('#modal_add_permissionusers').modal('hide');

			    		// Refresh the datatable
			    		$('#datatable_permissionusers').DataTable().ajax.reload();
			    	}
			    	else
			    	{
			    		// alertify.error( response.errMsg );
			    		$('#alert_box_modal').find('.modal-header').html('Alert');
    					$('#alert_box_modal').find('.modal-body').html(response.errMsg);
    					$('#alert_box_modal').modal('show');
			    	}
			    },
				error: function(xhr, ajaxOptions, thrownError) {
					alert(thrownError + "\r\n" + xhr.statusText);
					
				}
    		});
    	}
    });

    // To show the permissionusers list in datatable
    $.fn.dataTableExt.errMode = 'ignore';
    $('#datatable_permissionusers').dataTable({
        "sServerMethod": "get", 
        "bProcessing": true,
        "bServerSide": true,
        "sAjaxSource": $('meta[name="route"]').attr('content') + '/administrator/fetchpermissionsusers',
        "columnDefs": [
            { "className": "dt-center", "targets": [ 2 ] }
        ],
        "aoColumns": [
			
            { 'bSortable' : true },
            { 'bSortable' : true },
           	{ 'bSortable' : false }  
        ]
    });

    // To detach the permission from user
    $(document).on('click', '.detach_permission_user', function(){
		
		// Show the modal
		$('#deleteDialogModal').modal('show');
		
		var permission_user = $(this).attr('id');	 
		var pos = permission_user.indexOf('+');
		var permission_id = permission_user.substring(0, pos);
		var user_id = permission_user.substring(pos + 1);
		
		 $(document).on('click', '#yes', function(){					
		
		if( permission_id != ''  && user_id != '')
		{
			// Detach permission from the user
			$.ajax({
				url: $('meta[name="route"]').attr('content') + '/administrator/detachpermissionuser',
				method: 'get',
				data: {
					permission_id: permission_id,
					user_id: user_id
				},
				success: function(response){
					if( response.errCode == 0 )
					{
						// alertify.success( response.errMsg );
						$('#alert_box_modal').find('.modal-header').html('Success');
    					$('#alert_box_modal').find('.modal-body').html(response.errMsg);
    					$('#alert_box_modal').modal('show');
						
			    		// Refresh the datatable
						$('#datatable_permissionusers').DataTable().ajax.reload();
					}
					else
					{
						// alertify.error( response.errMsg );
			    		$('#alert_box_modal').find('.modal-header').html('Alert');
    					$('#alert_box_modal').find('.modal-body').html(response.errMsg);
    					$('#alert_box_modal').modal('show');
					}
				}
				
			});
			
		}
		else
		{
			// alertify.error('Missing user and permission id');
			$('#alert_box_modal').find('.modal-header').html('Alert');
			$('#alert_box_modal').find('.modal-body').html('Missing user and permission id');
			$('#alert_box_modal').modal('show');
		}
		})
		
	});
	
	//code to manage laratrust end here

	// Company Representative datatable
	$.fn.dataTableExt.errMode = 'ignore';
	$('#datatable_company_representatives').dataTable({
	    "sServerMethod": "get", 
	    "bProcessing": true,
	    "bServerSide": true,
	    "sAjaxSource": $('meta[name="route"]').attr('content') + '/administrator/fetchcompanyrepresentatives',
	    
	    "columnDefs": [
	        { "className": "dt-center", "targets": [ 0, 6, 7 ] }
	    ],
	    // Hide the loader when datatable is rendered
	    "initComplete": function(settings, json) {
	    	$('.loader-wrapper').hide();
	    },
	    "aoColumns": [
	        { 'bSortable' : true },
	        { 'bSortable' : true },
	        { 'bSortable' : true },
	        { 'bSortable' : false },
	        { 'bSortable' : false },
	        { 'bSortable' : false },
	        { 'bSortable' : true },
	        { 'bSortable' : false }
	    ]
	});

	// Email notification to agent from admin
	$(document).on('click', '.agent_notification_email', function(){

		let agentId = $(this).attr('id');

		// Set the agent id
		$('#frm_send_agent_email #agent_id').val(agentId);

		// Show the modal
		$('#modal_send_agent_email').modal('show');
	});

	// Send email notification to agent from admin
	$('#frm_send_agent_email').submit(function(e){
		e.preventDefault();
	});
	$('#frm_send_agent_email').validate({
		rules: {
			email_content: {
				required: true
			}
		},
		messages: {
			email_content: {
				required: 'Please enter some email content'
			}
		}
	});
	$('#btn_send_agent_email').click(function(){
		if( $('#frm_send_agent_email').valid() )
		{
			var $this = $(this);

            // Create form data object and append the values into it
            var formData = new FormData();

			// Upload the file and send it as an email attachement
			let agentId 	= $('#agent_id').val();
			let emailContent= tinymce.activeEditor.getContent();
			let fileData 	= $('#email_attachement').prop('files')[0];

			formData.append('agentId', agentId);
			formData.append('emailContent', emailContent);
            formData.append('fileData', fileData);

            $.ajax({
				url: $('meta[name="route"]').attr('content') + '/administrator/sendagentemailnotification',
				method: 'post',
				data: formData,
                contentType : false,
                processData : false,
                beforeSend: function() {
                	// Show the loading button
                    $this.button('loading');
                },
                complete: function()
                {
                	// Change the button to previous
                	$this.button('reset');
                },
				headers: {
			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    },
			    success: function(response){
			    	if( response.errCode == 0 )
			    	{
			    		// alertify.success( response.errMsg );
			    		$('#alert_box_modal').find('.modal-header').html('Success');
    					$('#alert_box_modal').find('.modal-body').html(response.errMsg);
    					$('#alert_box_modal').modal('show');

			    		// Reset the form
			    		$('#frm_send_agent_email')[0].reset();
			    		$('#frm_send_agent_email #agent_id').val();

			    		// Hide the modal
			    		$('#modal_send_agent_email').modal('hide');
			    	}
			    	else
			    	{
			    		// alertify.error( response.errMsg );
			    		$('#alert_box_modal').find('.modal-header').html('Alert');
    					$('#alert_box_modal').find('.modal-body').html(response.errMsg);
    					$('#alert_box_modal').modal('show');
			    	}
			    }
			});
		}
	});

	// Email notification to company representative from admin
	$(document).on('click', '.company_representative_notification_email', function(){

		let companyRepId = $(this).attr('id');

		// Set the company representative id
		$('#frm_send_company_representative_email #company_representative_id').val(companyRepId);

		// Show the modal
		$('#modal_send_company_representative_email').modal('show');
	});

	// Send email notification to company representative from admin
	$('#frm_send_company_representative_email').submit(function(e){
		e.preventDefault();
	});
	$('#frm_send_company_representative_email').validate({
		rules: {
			email_content: {
				required: true
			}
		},
		messages: {
			email_content: {
				required: 'Please enter some email content'
			}
		}
	});
	$('#btn_send_company_representative_email').click(function(){
		if( $('#frm_send_company_representative_email').valid() )
		{
			var $this = $(this);

            // Create form data object and append the values into it
            var formData = new FormData();

			// Upload the file and send it as an email attachement
			let companyRepId= $('#company_representative_id').val();
			let emailContent= tinymce.activeEditor.getContent();
			let fileData 	= $('#email_attachement').prop('files')[0];

			formData.append('agentId', companyRepId);
			formData.append('emailContent', emailContent);
            formData.append('fileData', fileData);

            $.ajax({
				url: $('meta[name="route"]').attr('content') + '/administrator/sendagentemailnotification',
				method: 'post',
				data: formData,
                contentType : false,
                processData : false,
                beforeSend: function() {
                	// Show the loading button
                    $this.button('loading');
                },
                complete: function()
                {
                	// Change the button to previous
                	$this.button('reset');
                },
				headers: {
			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    },
			    success: function(response){
			    	if( response.errCode == 0 )
			    	{
			    		// alertify.success( response.errMsg );
			    		$('#alert_box_modal').find('.modal-header').html('Success');
    					$('#alert_box_modal').find('.modal-body').html(response.errMsg);
    					$('#alert_box_modal').modal('show');

			    		// Reset the form
			    		$('#frm_send_company_representative_email')[0].reset();
			    		$('#frm_send_company_representative_email #agent_id').val();

			    		// Hide the modal
			    		$('#modal_send_company_representative_email').modal('hide');
			    	}
			    	else
			    	{
			    		// alertify.error( response.errMsg );
			    		$('#alert_box_modal').find('.modal-header').html('Alert');
    					$('#alert_box_modal').find('.modal-body').html(response.errMsg);
    					$('#alert_box_modal').modal('show');
			    	}
			    }
			});
		}
	});

	// Datatable to show company assigned jobs
	$.fn.dataTableExt.errMode = 'ignore';
	$('#datatable_jobs').dataTable({
	    "sServerMethod": "get", 
	    "bProcessing": true,
	    "bServerSide": true,
	    "sAjaxSource": $('meta[name="route"]').attr('content') + '/administrator/fetchjobpayments',
	    "columnDefs": [
	        { "className": "dt-center", "targets": [ 0 ] },
	        { "className": "dt-right", "targets": [ 7 ] }
	    ],
	    // Hide the loader when datatable is rendered
	    "initComplete": function(settings, json) {
	    	$('.loader-wrapper').hide();
	    },
	    "aoColumns": [
	        { 'bSortable' : true },
	        { 'bSortable' : false },
	        { 'bSortable' : false },
	        { 'bSortable' : false },
	        { 'bSortable' : false },
	        { 'bSortable' : false },
	        { 'bSortable' : false },
	        { 'bSortable' : false },
	        { 'bSortable' : false },
	        { 'bSortable' : false }
	    ]
	});

	// Form validation
	$('#frm_release_payment').submit(function(e){
	    e.preventDefault();
	});
	$('#frm_release_payment').validate({
		rules: {
			transaction_id: {
				required: true
			}
		},
		messages: {
			transaction_id: {
				required: 'Please enter transaction id'
			}
		}
	});

	// Admin release payment
	$(document).on('click', '.release_payment', function(){

		let transactionId = $(this).attr('id');
		$('#frm_release_payment #txn_id').val(transactionId);
		$('#modal_interact_transaction').modal('show');
    	
	});

	$('#btn_release_payment').click(function(){

		let transactionId = $('#frm_release_payment #txn_id').val();
		let interactTransactionId = $('#frm_release_payment #transaction_id').val();

    	if( transactionId != '' )
    	{
    		$.ajax({
    			url: $('meta[name="route"]').attr('content') + '/administrator/releasepayment',
    			method: 'post',
    			data: {
    				transactionId: transactionId,
    				interactTransactionId: interactTransactionId
    			},
    			headers: {
			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    },
			    success: function(response){
			    	if( response.errCode == 0 )
			    	{
			    		$('#modal_interact_transaction').modal('hide');

			    		// alertify.success( response.errMsg );
			    		$('#alert_box_modal').find('.modal-header').html('Success');
    					$('#alert_box_modal').find('.modal-body').html(response.errMsg);
    					$('#alert_box_modal').modal('show');

			    		// Refresh the datatable
			    		$('#datatable_jobs').DataTable().ajax.reload();
			    	}
			    	else
			    	{
			    		// alertify.error( response.errMsg );
			    		$('#alert_box_modal').find('.modal-header').html('Alert');
    					$('#alert_box_modal').find('.modal-body').html(response.errMsg);
    					$('#alert_box_modal').modal('show');
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
	    	/*var responseTypes = '<option value="">Select</option>';

	    	for (var key in response)
	    	{
	    	  	responseTypes += '<option value="'+response[key].id+'">'+response[key].city+'</option>';
	    	}*/

	    	// Append the newly created options to the dropdown
	    	$(target).html(response);
	    }
	});
}