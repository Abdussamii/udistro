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

    <title>Udistro | Email Templates</title>

    <link rel="icon" type="image/png" href="{{ url('images/udistro-fav.png') }}" sizes="32x32" />

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
    <!-- <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"> 
    <link rel="stylesheet" href="{{ URL::asset('css/font-awesome.min.css') }}" />-->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />

	<!-- Multiple select -->
	<link rel="stylesheet" href="{{ URL::asset('css/multiple-select.css') }}" />

    <!-- JQuery UI -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" rel="stylesheet" type="text/css"/>

    <!-- x-editable -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
    <link href="https://vitalets.github.io/x-editable/assets/bootstrap/css/bootstrap.css" rel="stylesheet"/>
	<link href="https://vitalets.github.io/x-editable/assets/bootstrap/css/bootstrap-responsive.css" rel="stylesheet"/>
	<link href="https://vitalets.github.io/x-editable/assets/x-editable/inputs-ext/wysihtml5/bootstrap-wysihtml5-0.0.2/bootstrap-wysihtml5-0.0.2.css" rel="stylesheet"/>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

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

	<!-- Multiple select -->
	<script type="text/javascript" src="{{ URL::asset('js/multiple-select.js') }}"></script>

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


    <script type="text/javascript">
    $(document).ready(function(){
    	// Initiate the tooltip for static as well as dynamic content also
    	$('body').tooltip({selector: '[data-toggle="tooltip"]'});

    	// Multi-select
    	$('#recipient_email').multipleSelect({
            placeholder: 'Email Recipient'
        });
    });
    </script>

	<script type="text/javascript">
	var elementPos = 20;
    $(document).ready(function(){
    	$.fn.editable.defaults.mode = 'popup';
    	$('.editable').editable({
			type: 'wysihtml5',
			pk: 1,
			row: 3,
			placement: 'bottom'
		});

		// To make the table column resizable
		// $("table tr th, table tr td").resizable({handles: 'e'});

		$('.dropdown-toggle').click(function(){
			$('.dropdown-menu_logout').toggle();
		});

		/*$('body').click(function(){
			$('.dropdown-menu_logout').toggle();
		});*/
    });
    </script>

	<style type="text/css">
    .top-buffer { margin-top:20px; }
    .error {
    	color: red;
    }
	/* To manage the x-editable css confliction issues */
		#wrapper .navbar .nav > li {
			display: block;
			float: none;
		}

		#wrapper .navbar .nav {
			float: none;
			margin:0;
		}

		#wrapper .navbar .nav > li > a {
			color: #fff;
			text-shadow: none;
			padding: 10px 15px;
		}

		#wrapper .sidebar ul li a.active {
			color: #888;
		}
		.hide {
			display: block !important;
		}
		.modal {
		    position: fixed;
		    top: 0;
		    right: 0;
		     bottom: auto; 
		     margin: 0 auto;
		    left: 0;
		    z-index: 1050;
		    display: none;
		     overflow: visible; 
		    outline: 0;
		}

		.modal-header .close {
			line-height: 31px;
		}
		.btn:hover, .btn:focus {
		    color: #fff;
		    text-decoration: none;
		    background-position: 0 0px;
		}
		#exTab2 {
			width: 700px;
			margin: auto;
			background: #fff;
			padding: 10px;
			border-radius: 4px;
			border: 1px solid #eee;
			position:relative;
			border: 1px solid #eee;
		}
		.control-panel-box {
			display: inline-block;
			position: absolute;
			left: -201px;
			background: #fff;
			padding: 10px;
			width: 200px;
		}
		.control-panel-box h2 {
			font-size: 20px;
			font-weight: normal;
			text-transform: uppercase;
			border-bottom: 1px solid #ccc;
			margin-top: 0;
		}
		#page-wrapper .nav-tabs > li > a {
			padding: 10px 20px;
		}
		.btn.btn-info.add_more_row,
		.btn.btn-info.add_image,
		#btn_agent_send_email,
		#btn_agent_save_email_template		{
			padding: 10px;
			margin-bottom: 10px;
			font-size: 17px;
			width: 100%;
		}
		.control-email input[type="email"] {
			width: 100%;
			padding: 10px 10px 10px 30px;
			height: 40px;
			margin-bottom: 10px;
			font-size: 16px;
		}
		.control-buttons i {
			position: absolute;
			left: 20px;
			line-height: 20px;
			height: 40px;
		}
		.fa.fa-paper-plane.send-icon {
			line-height: 40px;
			color: #fff;
		}
		.fa.fa-envelope-open.email-icon {
			line-height: 40px;
			position: absolute;
			left: 20px;
		}
		#exTab2 .tab-content {
		    overflow: visible;
		    display: inline-block;
		}
		#exTab2 .editable-buttons .btn-primary,
		.editable-buttons .editable-cancel {
		    padding: 0px !important;
		    height: 30px;
		    width: 30px;
		}
		/*HSA*/
		ul.logout-box {
		    display: inline-block;
		    float: right;
		    padding: 20px;
		    margin: 0px;
		    list-style: none;
		}
		li.dropdown_logout i {
		    color: #fff;
		    font-size: 19px;
		}
		ul.dropdown-menu_logout li a { color: #000; text-decoration: none; }
		ul.dropdown-menu_logout li a i { color: #000; }
		ul.dropdown-menu_logout {
			display: none;
		    margin: 0;
		    padding: 10px;
		    list-style: none;
		    background: #fff;
		    border-radius: 4px;
		    border: 1px solid #ccc;
		    position: absolute;
		    right: 0;
		    width: 110px;
		}
/*		li.dropdown_logout:hover ul.dropdown-menu_logout {
			display: block;
		}*/

		/* To make the initial text normal instead of bold */
		.editable-unsaved {
			font-weight: normal;
		}

		ul.dropdown-menu_logout li a {
		    color: #000;
		    text-decoration: none;
		    display: block;
		    padding: 4px 0;
		}

		ul.dropdown-menu_logout {
		    display: block;
		    min-width: 180px;
		}

		ul.dropdown-menu_logout li a i {
		    color: #000;
		    margin-right: 10px;
		}
	</style>
</head>

<body>

	<!-- Server Response -->
	<div class="modal fade" id="service_response" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
	    <div class="modal-dialog">
	        <div class="modal-content">
	            <div class="modal-header">
	            	
	            </div>
	            <div class="modal-body">
	            	
	            </div>
	            <div class="modal-footer">
	                <a style="width: 80px;" id="bt-modal-cancel" class="btn btn-success" href="javascript:void(0);" data-dismiss="modal">OK</a>
	            </div>
	        </div>
	    </div>
	</div>
	<!-- Server Response -->

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
			<ul class="logout-box">
				
				<li class="dropdown_logout">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>

				    <ul class="dropdown-menu_logout" style="display: none;">
				        <li>
	                        <a href="{{ url('agent/profile') }}"><i class="fa fa-user fa-fw" aria-hidden="true"></i> Profile</a>
	                    </li>
	                    <li>
	                        <a href="{{ url('agent/changepassword') }}"><i class="fa fa-dashboard fa-fw"></i> Change Password</a>
	                    </li>
                        <li>
                        	<a href="{{ url('/agent/logout') }}"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
				    </ul>
				    <!-- /.dropdown-user -->
				</li>

			</ul>
            <!-- /.navbar-top-links -->

            <!-- /.sidebar-collapse -->
            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
						<li class="dash-logo">
							<img src="https://www.udistro.ca/images/logo-dash.png" alt="Udistro">
                        </li>
                        <li>
                            <a href="{{ url('agent/dashboard') }}"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href="{{ url('agent/clients') }}"><i class="fa fa-th-list" aria-hidden="true"></i> Clients</a>
                        </li>
                        <li>
                            <a href="{{ url('agent/emailtemplates') }}"><i class="fa fa-envelope" aria-hidden="true"></i>  Email Templates</a>
                        </li>
                        <li>
                            <a href="{{ url('agent/invites') }}"><i class="fa fa-th-list" aria-hidden="true"></i> Invites</a>
                        </li>
						<li>
                            <a href="{{ url('agent/partners') }}"><i class="fa fa-th-list" aria-hidden="true"></i> Partners</a>
                        </li>
                        <li>
                            <a href="{{ url('agent/paymentplan') }}"><i class="fa fa-money" aria-hidden="true"></i> Payment Plan</a>
                        </li>
                        <!-- <li>
                            <a href="{{ url('agent/changepassword') }}"><i class="fa fa-dashboard fa-fw"></i> Change Password</a>
                        </li> -->
                        <!-- <li>
                            <a href="{{ url('agent/logout') }}"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li> -->
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            
        	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header text-center">Email Templates</h1>
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
							
    						<div class="control-panel-box">
    							
    							<!-- Email template control panel -->
	    								<!--<h2>Control Panel</h2>-->
	    								<div class="control-buttons">
	    									<a href="javascript:void(0);" style="width: 180px;" class="btn btn-info add_more_row"><i class="fa fa-plus" aria-hidden="true"></i> Add More Row</a>
	    									<a href="javascript:void(0);" style="width: 180px;" class="btn btn-info add_image"><i class="fa fa-picture-o" aria-hidden="true"></i> Add Image</a>
	    								</div>

    								<?php
    								// For invitation tab, provide the save email template functionality
    								if( strtolower( $emailTemplateCategory->name ) == 'invite' )
    								{
    								?>
    									<div class="control-email">
											<i class="fa fa-envelope-open email-icon" aria-hidden="true"></i>
    										<input type="email" name="email_template_name" id="email_template_name" placeholder="Template Name" value="">
    										<input type="hidden" name="email_category_id" id="email_category_id" value="{{ $emailTemplateCategory->id }}">
    									</div>
    									<div class="control-buttons">
											<i class="fa fa-paper-plane send-icon" aria-hidden="true"></i>
    										<input type="button" name="btn_agent_save_email_template" id="btn_agent_save_email_template" class="btn btn-success" value="Save Template">
    									</div>
    								<?php
    								}
    								// For other then invitation tab, provide the send email functionality
    								else
    								{
    								?>
    									<div class="control-email">
											<!-- <i class="fa fa-envelope-open email-icon" aria-hidden="true"></i> -->
    										<!-- <input type="email" name="recipient_email" id="recipient_email" placeholder="Email Id" value=""> -->
    										<select name="recipient_email" id="recipient_email" multiple="true" style="width: 180px;">
    											<?php
    											if( isset( $clients ) && count( $clients ) > 0 )
    											{
    												foreach( $clients as $client )
    												{
    													echo '<option value="'. $client->email .'">'. ucwords( strtolower( $client->fname .' '. $client->lname ) ) .'</option>';
    												}
    											}
    											?>
    										</select>
    									</div>

    									<div class="control-buttons" style="margin-top: 10px;">
											<i class="fa fa-paper-plane send-icon" aria-hidden="true"></i>
    										<input type="button" name="btn_agent_send_email" id="btn_agent_send_email" class="btn btn-success" value="Send Email">
    									</div>
    								<?php
    								}
    								?>
    						</div>
						</div>
    				<?php
    					$step++;
    				}
    			}
    			?>

    			<!-- Email template creation panel -->
			    <div class="col-sm-12" style="">

			        <!-- Email template creation panel -->
					<div class="element_container" id="email_container">
						<table width="100%" border="0" cellspacing="0" cellpadding="0" style="min-width: 320px; font-size: 18px;">
							<tr>
								<td align="center" bgcolor="#eff3f8" style="">

								<!--[if gte mso 10]>
								<table width="680" border="0" cellspacing="0" cellpadding="0">
								<tr><td>
								<![endif]-->

								<table border="0" cellspacing="0" cellpadding="0" class="table_width_100" width="100%" style="max-width: 680px; min-width: 300px;" id="table_email_template_container">
									<tr>
										<td align="center">
											<span style="float: right;"><a href="javascript:void(0);" class="remove_editable">X</a></span>
											<span style="height: 80px; line-height: 80px; font-size: 20px; text-align: center;" id="table_header" class="editable">Email Template</span>
										</td>
									</tr>
									<tr>
										<td bgcolor="#fbfcfd">
											<table border="0" cellspacing="0" cellpadding="0" width="100%" style="margin-top:20px;">
												<tr>
													<td align="center" style="width: 33%; padding-left: 20px; padding-right: 20px;">
														<span style="float: right;"><a href="javascript:void(0);" class="remove_editable">X</a></span>
														<div class="editable">
															<img src="{{ url('/images/dummy_image.png') }}" class="logo_images" image-type="dummy" alt="" style="max-width: 100%;">
														</div>
													</td>
													<td align="center" style="width: 33%; padding-left: 20px; padding-right: 20px;">
														<span style="float: right;"><a href="javascript:void(0);" class="remove_editable">X</a></span>
														<div class="editable">
															<img src="{{ url('/images/dummy_image.png') }}" class="logo_images" image-type="dummy" alt="" style="max-width: 100%;">
														</div>
													</td>
													<td align="center" style="width: 33%; padding-left: 20px; padding-right: 20px;">
														<span style="float: right;"><a href="javascript:void(0);" class="remove_editable">X</a></span>
														<div class="editable">
															<img src="{{ url('/images/dummy_image.png') }}" class="logo_images" image-type="dummy" alt="" style="max-width: 100%;">
														</div>
													</td>
												</tr>
											</table>
											<table border="0" cellspacing="0" cellpadding="0" id="table_editable">
												<tr>
													<td>
														<table>
															<tr>
																<td style="padding-top: 20px; padding-left: 20px;">
																	Dear [firstname],
																</td>
															</tr>
														</table>
														<table>
															<tr>
																<td style="padding:20px;">
																	<span style="float: right;"><a href="javascript:void(0);" class="remove_editable">X</a></span>
																	<div class="editable" style="text-align: justify;">
																		<div style="margin-bottom: 20px;">
																			This is {{ ucwords( strtolower( $agentDetails->fname ) ) }}, your real estate agent. I know moving is tough. So I am happy to share uDistro with you. This application will help you to move everything you want to move including your mail and utility services. 
																		</div>
																		<div style="margin-bottom: 20px;">
																			Just click the get started button to claim your invitation and begin checking things of your recommended moving lists.
																		</div>
																		<div style="margin-bottom: 20px;">
																			Plus this is completely free. It is part of my contribution to your move.
																		</div>
																	</div>
																</td>
																<!-- <td style="padding:20px; width: 50%;">
																	<span style="float: right;"><a href="javascript:void(0);" class="remove_editable">X</a></span>
																	<div class="editable" style="text-align: justify;">
																		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
																		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
																		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
																		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
																		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
																		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
																	</div>
																</td> -->
															</tr>
														</table>
													</td>
												</tr>

												<!-- <tr>
													<td>
														<table>
															<tr>
																<td style="padding:20px; width: 50%;">
																	<span style="float: right;"><a href="javascript:void(0);" class="remove_editable">X</a></span>
																	<div class="editable" style="text-align: justify;">
																		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
																		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
																		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
																		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
																		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
																		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
																	</div>
																</td>
																<td style="padding:20px; width: 50%;">
																	<span style="float: right;"><a href="javascript:void(0);" class="remove_editable">X</a></span>
																	<div class="editable" style="text-align: justify;">
																		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
																		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
																		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
																		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
																		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
																		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
																	</div>
																</td>
															</tr>
														</table>
													</td>
												</tr> -->  					
											</table>
											<table border="0" cellspacing="0" cellpadding="0" width="100%" style="margin:20px 0;">
												<tr>
													<td align="center" style="width: 33%; padding-left: 20px; padding-right: 20px;">
														<span style="float: right;"><a href="javascript:void(0);" class="remove_editable">X</a></span>
														<div class="editable">
															<img src="{{ url('/images/dummy_image.png') }}" class="logo_images" image-type="dummy" alt="" style="max-width: 100%;">
														</div>
													</td>
													<td align="center" style="width: 33%; padding-left: 20px; padding-right: 20px;">
														<span style="float: right;"><a href="javascript:void(0);" class="remove_editable">X</a></span>
														<div class="editable">
															<img src="{{ url('/images/dummy_image.png') }}" class="logo_images" image-type="dummy" alt="" style="max-width: 100%;">
														</div>
													</td>
													<td align="center" style="width: 33%; padding-left: 20px; padding-right: 20px;">
														<span style="float: right;"><a href="javascript:void(0);" class="remove_editable">X</a></span>
														<div class="editable">
															<img src="{{ url('/images/dummy_image.png') }}" class="logo_images" image-type="dummy" alt="" style="max-width: 100%;">
														</div>
													</td>
												</tr>
											</table>		
										</td>
									</tr>
									<tr>
										<td align="center" style="padding-top: 20px; display: none;" id="get_started_link_container">
											<a id="get_started_link" href="https://www.udistro.ca/">
												<img src="{{ url('images/email_template/wH5yJUTpN1LE6Fbl9aZ2.jpg') }}">
											</a>
										</td>
									</tr>
								</table>
								<!--[if gte mso 10]>
								</td></tr>
								</table>
								<![endif]-->

								</td>
							</tr>

							<!-- <table width="80%" align="center" cellpadding="0" cellspacing="0">
								<tr>
									<td align="center" style="padding:20px 0; width: 33%;">
										<span style="float: right;"><a href="javascript:void(0);" class="remove_editable">X</a></span>
										<div class="editable">
											Address
										</div>
									</td>
									<td align="center" style="padding:20px 0; width: 33%;">
										<span style="float: right;"><a href="javascript:void(0);" class="remove_editable">X</a></span>
										<div class="editable">
											Website
										</div>
									</td>
									<td align="center" style="padding:20px 0; width: 33%;">
										<span style="float: right;"><a href="javascript:void(0);" class="remove_editable">X</a></span>
										<div class="editable">
											Phone Number
										</div>
									</td>
								</tr>
							</table> -->

							<!-- <table width="80%" align="center" cellpadding="0" cellspacing="0">
								<tr>
									<td colspan="3" align="center" style="border-top:1px solid #d9d9d9;">
										<span class="editable">Connect with us</span>
									</td>
								</tr>
								<tr>
									<td align="center" valign="middle" style="font-size: 12px; line-height: 22px; padding:20px 0;">
										<div>
											<a href="javascript:void(0);" target="_blank" class="editable" style="display: inline-block; padding: 5px;">
												<img src="{{ url('/images/facebook-icon.png') }}" alt="|" />
											</a>
											<a href="javascript:void(0);" target="_blank" class="editable" style="display: inline-block; padding: 5px;">
												<img src="{{ url('/images/twitter-icon.png') }}" alt="|" />
											</a>
											<a href="javascript:void(0);" target="_blank" class="editable" style="display: inline-block; padding: 5px;">
												<img src="{{ url('/images/linkedin-icon.png') }}" alt="|" />
											</a>
											<a href="javascript:void(0);" target="_blank" class="editable" style="display: inline-block; padding: 5px;">
												<img src="{{ url('/images/instagram-icon.png') }}" alt="|" />
											</a>
										</div>
									</td>
								</tr>                                        
							</table> -->
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

    <!-- Modal to add images -->
    <div id="modal_add_image" class="modal fade" role="dialog">
    	<div class="modal-content">
    		<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Upload Image</h4>
			</div>
			<div class="modal-body">
		    	<form id="frm_upload_email_template_image" name="frm_upload_email_template_image">
		    		<div class="form-group">
		    			<label for="upload_image">Select Image:</label>
		    			<input type="file" name="upload_image" id="upload_image">
		    		</div>
		    		<div id="container_email_template_image" style="display: none;">
		    			<div class="form-group">
		    				<!-- <label>Preview:</label>
		    				<div>
		    					<img src="" alt="Udistro" id="uploaded_image_preview">
		    				</div> -->
		    				<label>Image Path:</label>
		    				<div>
		    					<input type="text" name="uploaded_image_path" id="uploaded_image_path" class="form-control">
		    				</div>
		    				<a id="copy_image_path" href="javascript:void(0);">Copy image path</a>
		    			</div>
		    		</div>
		    	</form>
		    </div>
		    <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
	    </div>
    </div>

</body>

<script type="text/javascript">
$(document).ready(function(){

	// To resize table columns
	// $("table tr th, table tr td").resizable({handles: 'e'});

	// To remove the table td
	$(document).on('click', '.remove_editable', function(){
		
		// Check if it is the last td of the tr, then you cannot delete it
		let tdCount = $(this).closest('tr').find('td').length;

		if( tdCount > 1 )
		{
			$(this).closest('td').remove();
		}
		else
		{
			if( confirm('Are you sure to remove this placeholder?') )
			{
				$(this).closest('td').remove();
			}
		}

	});

	// Get the html of last row, and append it when required
	var newRow = $('#table_editable tr:last').wrap('</tr>').parent().html();
	// Add more row
	$('.add_more_row').click(function(){
		$('#table_editable tr:last').after(newRow);
	});

	// Add Image Modal
	$('.add_image').click(function(){
		// Flush the contents
		$('#upload_image').val('');
		// $('#uploaded_image_preview').attr('src', '');
		$('#container_email_template_image').hide();

		// Show the modal
		$('#modal_add_image').modal();
	});

	// To uplaod an image
	$('#upload_image').change(function(){
    	var formData = new FormData();
    	let image 	= $(this).prop('files')[0];

    	formData.append('image', image);

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
    	            // Show the image with the associated controls
    	            // $('#uploaded_image_preview').attr('src', response.filePath );
    	            $('#uploaded_image_path').val( response.filePath );

    	            $('#container_email_template_image').show();
    	        }
    	        else
    	        {
    	            // alertify.error( response.errMsg );
    	            $('#service_response').find('.modal-header').html('Alert');
    	            $('#service_response').find('.modal-body').html(response.errMsg);
    	            $('#service_response').modal('show');
    	        }
    	    }
    	});
    });

	// Form validation
	$('#frm_upload_email_template_image').validate({
		rules: {
			image_placement: {
				required: true
			}
		},
		messages: {
			image_placement: {
				required: 'Please select the placement'
			}	
		}
	});

	// Add image to placeholder
    $('#add_image_to_placeholder').click(function(){
    	if( $('#frm_upload_email_template_image').valid() )
    	{
    		// Get the selection value
    		let placementId = $('input[name="image_placement"]:checked').val();

    		// Assign it to respective image
    		// $('#logo_image' + placementId).attr('src', $('#uploaded_image_preview').attr('src'));

    		// Change its custom attribute
    		$('#logo_image' + placementId).attr('image-type', 'uploaded');

    		// Hide the modal
    		$('#modal_add_image').modal('hide');
    	}
    });

    // To send the email
    $('#btn_agent_send_email').click(function(){

    	let recipientEmails = $('#recipient_email').val();

    	if( recipientEmails == null )
    	{
    		// alertify.error('Please select atleast one email recipient');
    		$('#service_response').find('.modal-header').html('Alert');
    		$('#service_response').find('.modal-body').html('Please select atleast one email recipient');
    		$('#service_response').modal('show');

    		$('#recipient_email').focus();

    		return false;
    	}

    	// Clone the container
    	let emailContent = $('#email_container').clone();

    	// Remove the "X" place holder from html
    	$(emailContent).find('.remove_editable').remove();

    	// Iterate over all images
    	$(emailContent).find('img').each(function(){
    		// Remove all dummy logo images
    		if( $(this).attr('class') == 'logo_images' )
    		{
    			$(this).remove();
    		}

    		// Add max-width: 200px, max-height: 200px to all images
			$(this).css('max-width', '200px');
			$(this).css('max-height', '200px');
    	});

    	// Remove the "Click here to get started link" as display none will not work on the email server
    	$(emailContent).find('#get_started_link_container').closest('tr').remove();

    	// Get the updated html
    	let content = $(emailContent).html();

		$.ajax({
			url: $('meta[name="route"]').attr('content') + '/email',
			method: 'post',
			data: {
				recipientEmails: recipientEmails,
				content: content
			},
			headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    },
		    success: function(response){
		    	if( response.errCode == 0 )
		    	{
		    		// alertify.success( response.errMsg );
		    		$('#service_response').find('.modal-header').html('Success');
		    		$('#service_response').find('.modal-body').html(response.errMsg);
		    		$('#service_response').modal('show');
		    	}
		    	else
		    	{
		    		// alertify.error( response.errMsg );
		    		$('#service_response').find('.modal-header').html('Alert');
		    		$('#service_response').find('.modal-body').html(response.errMsg);
		    		$('#service_response').modal('show');
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
    		// Clone the container
    		let emailContent = $('#email_container').clone();

    		// Keep the original html content to show it again for editing purpose
    		let htmlContentToView = $(emailContent).html();

    		// Remove the "X" place holder from html
    		$(emailContent).find('.remove_editable').remove();

    		// Iterate over all images
    		$(emailContent).find('img').each(function(){
    			// Remove all dummy logo images
    			if( $(this).attr('class') == 'logo_images' )
    			{
    				$(this).remove();
    			}

    			// Add max-width: 150px, max-height: 150px to all images
    			$(this).css('max-width', '150px');
    			$(this).css('max-height', '150px');
    		});

    		// Show the get started button
    		$(emailContent).find('#get_started_link_container').show();

    		// Get the updated html, this is to be send over the email
    		let htmlContentToSend = $(emailContent).html();

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
			    		// alertify.success( response.errMsg );
			    		$('#service_response').find('.modal-header').html('Success');
			    		$('#service_response').find('.modal-body').html(response.errMsg);
			    		$('#service_response').modal('show');

			    		$('#email_template_name').val('');
			    	}
			    	else
			    	{
			    		// alertify.error( response.errMsg );
			    		$('#service_response').find('.modal-header').html('Success');
			    		$('#service_response').find('.modal-body').html(response.errMsg);
			    		$('#service_response').modal('show');
			    	}
			    }
    		});
    	}
    	else
    	{
    		// alertify.error('Please provide email template name');
    		$('#service_response').find('.modal-header').html('Alert');
    		$('#service_response').find('.modal-body').html('Please provide email template name');
    		$('#service_response').modal('show');

    		$('#email_template_name').focus();

    		return false;
    	}

    });

    // To copy the image path in clipboard
    $('#copy_image_path').click(function(){
    	var $temp = $("<input>");
	    $("body").append($temp);
	    $temp.val( $('#uploaded_image_path').val() ).select();
	    document.execCommand("copy");
	    $temp.remove();
    });

});
</script>
<script type="text/javascript">
	$(window).scroll(function() {    
    var scroll = $(window).scrollTop();

    if (scroll >= 10) {
        $(".dash-logo").addClass("blue-bg");
    } else {
        $(".dash-logo").removeClass("blue-bg");
    }
	});
</script>

</html>