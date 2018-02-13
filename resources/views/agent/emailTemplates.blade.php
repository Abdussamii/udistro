<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="route" content="{{ url('/') }}">

    <title>@yield('title')</title>

    <!-- Bootstrap Core CSS -->
    <!-- <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="{{ URL::asset('css/bootstrap.min.css') }}" />

    <!-- MetisMenu CSS -->
    <!-- <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="{{ URL::asset('css/metisMenu.min.css') }}" />

    <!-- Custom CSS -->
    <!-- <link href="../dist/css/sb-admin-2.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="{{ URL::asset('css/sb-admin-2.css') }}" />

    <!-- Morris Charts CSS -->
    <!-- <link href="../vendor/morrisjs/morris.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="{{ URL::asset('css/morris.css') }}" />

    <!-- Custom Fonts -->
    <!-- <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"> -->
    <link rel="stylesheet" href="{{ URL::asset('css/font-awesome.min.css') }}" />

    <!-- JQuery UI -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" rel="stylesheet" type="text/css"/>

    <!-- x-editable -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
    <link href="https://vitalets.github.io/x-editable/assets/bootstrap/css/bootstrap.css" rel="stylesheet"/>
	<link href="https://vitalets.github.io/x-editable/assets/bootstrap/css/bootstrap-responsive.css" rel="stylesheet"/>
	<link href="https://vitalets.github.io/x-editable/assets/x-editable/bootstrap-editable/css/bootstrap-editable.css" rel="stylesheet"/>
	<link href="https://vitalets.github.io/x-editable/assets/x-editable/inputs-ext/wysihtml5/bootstrap-wysihtml5-0.0.2/bootstrap-wysihtml5-0.0.2.css" rel="stylesheet"/>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style type="text/css">
    .top-buffer { margin-top:20px; }
    </style>

    <!-- jQuery -->
    <!-- <script src="../vendor/jquery/jquery.min.js"></script> -->
    <!-- <script type="text/javascript" src="{{ URL::asset('js/jquery.min.js') }}"></script> -->
    <script src="https://vitalets.github.io/x-editable/assets/jquery/jquery-1.9.1.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <!-- <script src="../vendor/bootstrap/js/bootstrap.min.js"></script> -->
    <script type="text/javascript" src="{{ URL::asset('js/bootstrap.min.js') }}"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <!-- <script src="../vendor/metisMenu/metisMenu.min.js"></script> -->
    <script type="text/javascript" src="{{ URL::asset('js/metisMenu.min.js') }}"></script>

    <!-- Custom Theme JavaScript -->
    <!-- <script src="../dist/js/sb-admin-2.js"></script> -->
    <script type="text/javascript" src="{{ URL::asset('js/sb-admin-2.js') }}"></script>

    <!-- JQuery Validation -->
    <script type="text/javascript" src="{{ URL::asset('js/jquery.validate.min.js') }}"></script>

    <!-- Datatable -->
    <script type="text/javascript" src="{{ URL::asset('js/jquery.dataTables.min.js.js') }}"></script>

    <!-- JS Alert Plug-in -->
	<script type="text/javascript" src="{{ URL::asset('js/alertify.min.js') }}"></script>
	<link rel="stylesheet" href="{{ URL::asset('css/alertify.min.css') }}" />

    <!-- Admin JS -->
    <script type="text/javascript" src="{{ URL::asset('js/custom/agent.js') }}"></script>

    <!-- JQuery UI -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    <!-- x-editable -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>

    <script src="https://vitalets.github.io/x-editable/assets/bootstrap/js/bootstrap.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://vitalets.github.io/x-editable/assets/x-editable/bootstrap-editable/js/bootstrap-editable.js"></script>
	<script src="https://vitalets.github.io/x-editable/assets/x-editable/inputs-ext/wysihtml5/bootstrap-wysihtml5-0.0.2/wysihtml5-0.3.0.min.js"></script>
	<script src="https://vitalets.github.io/x-editable/assets/x-editable/inputs-ext/wysihtml5/bootstrap-wysihtml5-0.0.2/bootstrap-wysihtml5-0.0.2.min.js"></script>
	<script src="https://vitalets.github.io/x-editable/assets/x-editable/inputs-ext/wysihtml5/wysihtml5-0.0.2.js"></script>

    <style type="text/css">
    .error {
    	color: red;
    }
    </style>

    <script type="text/javascript">
    $(document).ready(function(){
    	// Initiate the tooltip for static as well as dynamic content also
    	$('body').tooltip({selector: '[data-toggle="tooltip"]'});
    });
    </script>

	<script type="text/javascript">
	var elementPos = 20;
    $(document).ready(function(){
    	// $.fn.editable.defaults.mode = 'popup';
    	
    	$('#add_text_field').click(function()
    	{
    		var placeHolder = $(document.createElement('div')).css({
				border: '1px dashed',
				position: 'relative',
				// left: elementPos,
				width: '400', 
				height: '100', 
				padding: '3', 
				margin: '0'
			});

    		// Add the class to manage the css while sending the email
			$(placeHolder).addClass('email_component');

    		elementPos = elementPos + 25;

    		// Initialize the draggable and resizable on newly created placeholder
    		$(placeHolder).resizable().draggable({
		        // Restrict the dragging to parent div only
		        // containment: "parent"
    		}).append('Click here to enter text').appendTo("#email_template_content");

    		// Initialize the x-editable on newly created placeholder
    		$(placeHolder).editable({
    			type: 'wysihtml5',
				pk: 1,
				row: 3,
				placement: 'bottom'
    		});
    	});

    	// To render the image preview
		$("#file-input").change(function() {
          	readURL(this);
        });

        // To make social icon editable
        $('.x_editable').editable({
			type: 'wysihtml5',
			pk: 1,
			row: 3,
			placement: 'bottom'
		});

		// To hide the image upload button from x-editable popup when it is shown
		$('.x_editable').on('shown', function(e, editable) {
		    $('.btn').each(function(){
		    	if( $(this).attr('data-wysihtml5-command') == 'insertImage' )
		    	{
		    		$(this).hide();
		    	}
		    });
		});

		// To make already existing placeholder draggable and resizable
		$('.x_editable, .drag_resize').resizable().draggable({
	        // Restrict the dragging to parent div only
	        // containment: "parent"
		});

		// Get the html
		$('#btn_preview').click(function() {

			let logo = $('#company_logo');
			var position = logo.position();

			console.log( position.left + ' : ' + position.top  );

			$('#preview_dialog').html( $('#email_template_container').html() );
			
			$('#preview_dialog').dialog({
				width: 800,
                height: 'auto'
			});

		});

		// To remove the div
    	$('#trash').droppable({
	        drop: function(event, ui) {
                $(ui.draggable).remove();
            }
	    });


	    // To send the testing email
	    $('#btn_agent_send_email').click(function(){

	    	let recipientEmail = $('#recipient_email').val();

	    	if( recipientEmail == '' )
	    	{
	    		alertify.error('Please enter email id');
	    		$('#recipient_email').focus();

	    		return false;
	    	}

	    	let htmlContent = $('#table_email_container').wrap('<div/>').parent().clone();

	    	$(htmlContent).find('.email_component').each(function(){

	    		// Get the top and left css property values
	    		var top 	= $(this).css('top');
	    		var left 	= $(this).css('left');

	    		// Remove the dashed border from all elements
	    		$(this).css('border', 'none');

	    		// Add the css
	    		$(this).css({
	    			'margin-top' : top,
	    			'margin-left' : left
	    		});

	    		// Remove the dashed border

	    		$(this).wrap( '<div class="wrapper"></div>' );
	    	});

	    	let content = $(htmlContent).html();

    		$.ajax({
    			url: $('meta[name="route"]').attr('content') + '/email',
    			method: 'post',
    			data: {
    				recipientEmail: recipientEmail,
    				content: content
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

	    });

	    // To uplaod the email template image
	    $('#file_banner_image ,#file_logo_image').change(function(){

	    	var formData = new FormData();
	    	
	    	let image 	= $(this).prop('files')[0];
	    	let source 	= $(this).attr('data-source');

	    	formData.append('image', image);
	    	formData.append('source', source);

	    	$.ajax({
	    	    url: $('meta[name="route"]').attr('content') + '/agent/uploademailimage',
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
	    	            if( source == 'banner' )
	    	            {
	    	            	$('#banner_image').attr('src', response.fileName);
	    	            }
	    	            else
	    	            {
	    	            	$('#logo_image').attr('src', response.fileName);
	    	            }             
	    	        }
	    	        else
	    	        {
	    	            alertify.error( response.errMsg );
	    	        }
	    	    }
	    	});

	    });

	    // To save the email template in case of Invitation
	    $('#btn_agent_save_email_template').click(function(){

	    	let emailCategoryId = $('#email_category_id').val();
	    	let templateName 	= $('#email_template_name').val();

	    	// Check if email template name is available or not
	    	if( templateName != '' )
	    	{
	    		// Html content to show the email template
		    	let htmlContentToView = $('#table_email_container').wrap('<div/>').parent().html();

		    	// Html content to send over the email
		    	let htmlContent = $('#table_email_container').wrap('<div/>').parent().clone();

		    	$(htmlContent).find('.email_component').each(function(){

		    		// Get the top and left css property values
		    		var top 	= $(this).css('top');
		    		var left 	= $(this).css('left');

		    		// Remove the dashed border from all elements
		    		$(this).css('border', 'none');

		    		// Add the css
		    		$(this).css({
		    			'margin-top' : top,
		    			'margin-left' : left
		    		});

		    		// Remove the dashed border

		    		$(this).wrap( '<div class="wrapper"></div>' );
		    	});

		    	let htmlContentToSend = $(htmlContent).html();

	    		$.ajax({
	    			url: $('meta[name="route"]').attr('content') + '/agent/saveemailtemplate',
	    			method: 'post',
	    			data: {
	    				emailCategoryId: emailCategoryId,
	    				templateName: templateName,
	    				htmlContentToView: htmlContentToView,
	    				htmlContentToSend: htmlContentToSend
	    			},
	    			headers: {
				        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				    },
				    success: function(response){
				    	if( response.errCode == 0 )
				    	{
				    		alertify.success( response.errMsg );

				    		$('#email_template_name').val('');
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
	    		alertify.error('Please provide email template name');

	    		$('#email_template_name').focus();

	    		return false;
	    	}

	    });

    });
    </script>

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ url('/') }}">Dashboard</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-envelope fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-messages">
                        <li>
                            <a href="#">
                                <div>
                                    <strong>John Smith</strong>
                                    <span class="pull-right text-muted">
                                        <em>Yesterday</em>
                                    </span>
                                </div>
                                <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <strong>John Smith</strong>
                                    <span class="pull-right text-muted">
                                        <em>Yesterday</em>
                                    </span>
                                </div>
                                <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <strong>John Smith</strong>
                                    <span class="pull-right text-muted">
                                        <em>Yesterday</em>
                                    </span>
                                </div>
                                <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>Read All Messages</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-messages -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-tasks fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-tasks">
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Task 1</strong>
                                        <span class="pull-right text-muted">40% Complete</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                            <span class="sr-only">40% Complete (success)</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Task 2</strong>
                                        <span class="pull-right text-muted">20% Complete</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
                                            <span class="sr-only">20% Complete</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Task 3</strong>
                                        <span class="pull-right text-muted">60% Complete</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                                            <span class="sr-only">60% Complete (warning)</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Task 4</strong>
                                        <span class="pull-right text-muted">80% Complete</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                                            <span class="sr-only">80% Complete (danger)</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>See All Tasks</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-tasks -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts">
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-comment fa-fw"></i> New Comment
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                                    <span class="pull-right text-muted small">12 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-envelope fa-fw"></i> Message Sent
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-tasks fa-fw"></i> New Task
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-upload fa-fw"></i> Server Rebooted
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>See All Alerts</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-alerts -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="{{ url('/logout') }}"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <!-- /.sidebar-collapse -->
            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="{{ url('agent/dashboard') }}"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href="{{ url('agent/profile') }}"><i class="fa fa-user" aria-hidden="true"></i> Profile</a>
                        </li>
                        <li>
                            <a href="{{ url('agent/clients') }}"><i class="fa fa-th-list" aria-hidden="true"></i> Clients</a>
                        </li>
                        <li>
                            <a href="{{ url('agent/invites') }}"><i class="fa fa-th-list" aria-hidden="true"></i> Invites</a>
                        </li>
                        <li>
                            <a href="{{ url('agent/emailtemplates') }}"><i class="fa fa-envelope" aria-hidden="true"></i>  Email Templates</a>
                        </li>
                        <li>
                            <a href="{{ url('agent/changepassword') }}"><i class="fa fa-dashboard fa-fw"></i> Change Password</a>
                        </li>
                        <li>
                            <a href="{{ url('agent/logout') }}"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            
        	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Email Templates</h1>
        </div>
    </div>
    <div class="row">

    	<div id="exTab2" class="">	
    		<ul class="nav nav-tabs">
    			<?php
    			// Check if any email template categories is available
    			if( isset( $emailTemplateCategories ) && count( $emailTemplateCategories ) > 0 )
    			{
    				$step = 1;
    				foreach( $emailTemplateCategories as $emailTemplateCategory )
    				{
    				?>
    					<li class="{{ ( $step == 1 ) ? 'active' : '' }}"><a href="#{{ $step }}" data-toggle="tab">{{ ucwords( strtolower( $emailTemplateCategory->name ) ) }}</a></li>
    				<?php
    					$step++;
    				}
    			}
    			?>
			</ul>
			<div class="tab-content">
			  	<?php
    			// Check if any email template categories is available
    			if( isset( $emailTemplateCategories ) && count( $emailTemplateCategories ) > 0 )
    			{
    				$step = 1;
    				foreach( $emailTemplateCategories as $emailTemplateCategory )
    				{
    				?>
    					<div class="tab-pane {{ ( $step == 1 ) ? 'active' : '' }}" id="{{ $step }}">
							
    						<div>
    							
    							<!-- Email template control panel -->
    							<div class="col-sm-3 col-md-3 col-lg-3">
    								<div>
	    								<h2>Control Panel</h2>
	    								<div>
	    									<a href="javascript:void(0);" id="add_text_field" class="btn btn-primary">Add New Text Field</a>
	    								</div>
	    								<br>
	    								<div>
	    									<a href="javascript:void(0);" id="add_banner_image" class="btn btn-primary" onclick="document.getElementById('file_banner_image').click();">Add Banner Image</a>
	    									<input id="file_banner_image" name="file_banner_image" type="file" data-source="banner" style="display:none;">
	    								</div>
	    								<br>
	    								<div>
	    									<a href="javascript:void(0);" id="add_logo_image" class="btn btn-primary" onclick="document.getElementById('file_logo_image').click();">Add Logo Image</a>
	    									<input id="file_logo_image" name="file_logo_image" type="file" data-source="logo" style="display:none;">
	    								</div>
	    							</div>

    								<div id="trash" style="height: 200px; width: 200px; background: url('https://thumb1.shutterstock.com/display_pic_with_logo/1176923/583110190/stock-vector-cartoon-crumpled-paper-and-trash-can-vector-illustration-583110190.jpg') no-repeat; background-size: cover;">
    								</div>

    								<?php
    								// For invitation tab, provide the save email template functionality
    								if( strtolower( $emailTemplateCategory->name ) == 'invite' )
    								{
    								?>
    									<div>
    										<input type="email" name="email_template_name" id="email_template_name" placeholder="Template Name" value="">
    										<input type="hidden" name="email_category_id" id="email_category_id" value="{{ $emailTemplateCategory->id }}">
    									</div>
    									<div>
    										<input type="button" name="btn_agent_save_email_template" id="btn_agent_save_email_template" class="btn btn-primary" value="Save Email Template">
    									</div>
    								<?php
    								}
    								// For other then invitation tab, provide the send email functionality
    								else
    								{
    								?>
    									<div>
    										<input type="email" name="recipient_email" id="recipient_email" placeholder="Email Id" value="">
    									</div>

    									<div>
    										<input type="button" name="btn_agent_send_email" id="btn_agent_send_email" class="btn btn-primary" value="Send Email">
    									</div>
    								<?php
    								}
    								?>
    							</div>
    						</div>
						</div>
    				<?php
    					$step++;
    				}
    			}
    			?>

    			<!-- Email template creation panel -->
			    <div class="col-sm-9 col-md-9 col-lg-9" style="margin-bottom: 50px;" id="email_container">

			        <div class="col-sm-12 col-md-12 col-lg-12" style="width: 100%;">
                		<div class="text-center"><h3>Email Template</h3></div>
                		<table style="width: 800px;" id="table_email_container">
                			<tr>
                				<td style="border: 1px dashed #cccccc;" id="email_template_container">

                					<div id="email_template_content">

                						<!-- Email template banner -->
                						<div class="drag_resize email_component" style="text-align: center;">
                							<img id="banner_image" src="{{ url('images/email-template-banner.jpg') }}" style="max-width: 780px;" class="image_editable">
                						</div>

                						<!-- Email template logo -->
                						<div class="drag_resize email_component" style="text-align: center;">
                							<img id="logo_image" src="{{ url('images/email-template-logo.jpg') }}" style="max-width: 780px;" class="image_editable">
                						</div>

                						<!-- Email template text header -->
                						<div id="email_heading" class="x_editable email_component" style="height: 100px; border: 1px dashed;">
                							Header
                						</div>

                						<!-- Email template text content -->
                						<div id="email_content" class="x_editable email_component" style="height: 200px; border: 1px dashed;">
                							Content
                						</div>

                					</div>

                					<div style="padding-top: 50px; text-align: center;" id="social_links">
            							<div style="display: inline-block;">
            								<a href="javascript:void(0);" style="text-decoration: none; display: inline-block;" class="x_editable email_component">
            									<img src="https://cdnjs.cloudflare.com/ajax/libs/webicons/2.0.0/webicons/webicon-facebook.png" alt="|" />
            								</a>
            							</div>
            							<div style="display: inline-block;">
            								<a href="javascript:void(0);" style="text-decoration: none; display: inline-block;" class="x_editable email_component">
            									<img src="https://cdnjs.cloudflare.com/ajax/libs/webicons/2.0.0/webicons/webicon-twitter.png" alt="|" />
            								</a>
            							</div>
            							<div style="display: inline-block;">
	            							<a href="javascript:void(0);" style="text-decoration: none; display: inline-block;" class="x_editable email_component">
	            								<img src="https://cdnjs.cloudflare.com/ajax/libs/webicons/2.0.0/webicons/webicon-linkedin.png" alt="|" />
	            							</a>
            							</div>
            							<div style="display: inline-block;">
	            							<a href="javascript:void(0);" style="text-decoration: none; display: inline-block;" class="x_editable email_component">
	            								<img src="https://cdnjs.cloudflare.com/ajax/libs/webicons/2.0.0/webicons/webicon-instagram.png" alt="|" />
	            							</a>
            							</div>
            						</div>

                				</td>
                			</tr>
                		</table>
                	</div>

			    </div>

			</div>
    	</div>

    </div>

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

</body>

</html>