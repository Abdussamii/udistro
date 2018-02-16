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
    	$.fn.editable.defaults.mode = 'popup';
    	$('.editable').editable({
			type: 'wysihtml5',
			pk: 1,
			row: 3,
			placement: 'bottom'
		});

		// To make the table column resizable
		// $("table tr th, table tr td").resizable({handles: 'e'});
    });
    </script>

	<style type="text/css">
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
	</style>
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
	    									<a href="javascript:void(0);" style="width: 180px;" class="btn btn-primary add_more_row">Add More Row</a>
	    								</div>
	    								<br>
	    								<div>
	    									<a href="javascript:void(0);" style="width: 180px;" class="btn btn-primary add_image">Add Image</a>
	    								</div>
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
    									<br>
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
			    <div class="col-sm-9 col-md-9 col-lg-9" style="margin-bottom: 50px;">

			        <!-- Email template creation panel -->
					<div class="element_container" id="email_container">
						<table width="100%" border="0" cellspacing="0" cellpadding="0" style="min-width: 320px; font-size: 18px;">
							<tr>
								<td align="center" bgcolor="#eff3f8" style="padding-bottom: 40px;">

								<!--[if gte mso 10]>
								<table width="680" border="0" cellspacing="0" cellpadding="0">
								<tr><td>
								<![endif]-->

								<table border="0" cellspacing="0" cellpadding="0" class="table_width_100" width="100%" style="max-width: 680px; min-width: 300px;">
									<tr>
										<td align="center">
											<span style="height: 80px; line-height: 80px; font-size: 20px; text-align: center;" id="table_header" class="editable">Email Template</span>
											<span style="float: right;"><a href="javascript:void(0);" class="remove_editable">X</a></span>
										</td>
									</tr>
									<tr>
										<td bgcolor="#fbfcfd">
											<table border="0" cellspacing="0" cellpadding="0" width="100%" style="margin-top:20px;">
												<tr>
													<td align="center" style="width: 33%; padding-left: 20px; padding-right: 20px;">
														<span style="float: right;"><a href="javascript:void(0);" class="remove_editable">X</a></span>
														<div class="editable">
															<img src="{{ url('/images/dummy_image.png') }}" class="logo_images" image-type="dummy" alt="" style="max-width: 800px;">
														</div>
													</td>
													<td align="center" style="width: 33%; padding-left: 20px; padding-right: 20px;">
														<span style="float: right;"><a href="javascript:void(0);" class="remove_editable">X</a></span>
														<div class="editable">
															<img src="{{ url('/images/dummy_image.png') }}" class="logo_images" image-type="dummy" alt="" style="max-width: 800px;">
														</div>
													</td>
													<td align="center" style="width: 33%; padding-left: 20px; padding-right: 20px;">
														<span style="float: right;"><a href="javascript:void(0);" class="remove_editable">X</a></span>
														<div class="editable">
															<img src="{{ url('/images/dummy_image.png') }}" class="logo_images" image-type="dummy" alt="" style="max-width: 800px;">
														</div>
													</td>
												</tr>
											</table>
											<table border="0" cellspacing="0" cellpadding="0" id="table_editable">
												<tr>
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
												</tr>

												<tr>
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
												</tr>  					
											</table>
											<table border="0" cellspacing="0" cellpadding="0" width="100%" style="margin:20px 0;">
												<tr>
													<td align="center" style="width: 33%; padding-left: 20px; padding-right: 20px;">
														<span style="float: right;"><a href="javascript:void(0);" class="remove_editable">X</a></span>
														<div class="editable">
															<img src="{{ url('/images/dummy_image.png') }}" class="logo_images" image-type="dummy" alt="" style="max-width: 800px;">
														</div>
													</td>
													<td align="center" style="width: 33%; padding-left: 20px; padding-right: 20px;">
														<span style="float: right;"><a href="javascript:void(0);" class="remove_editable">X</a></span>
														<div class="editable">
															<img src="{{ url('/images/dummy_image.png') }}" class="logo_images" image-type="dummy" alt="" style="max-width: 800px;">
														</div>
													</td>
													<td align="center" style="width: 33%; padding-left: 20px; padding-right: 20px;">
														<span style="float: right;"><a href="javascript:void(0);" class="remove_editable">X</a></span>
														<div class="editable">
															<img src="{{ url('/images/dummy_image.png') }}" class="logo_images" image-type="dummy" alt="" style="max-width: 800px;">
														</div>
													</td>
												</tr>
											</table>		
										</td>
									</tr>
								</table>
								<!--[if gte mso 10]>
								</td></tr>
								</table>
								<![endif]-->

								</td>
							</tr>
							<table width="80%" align="center" cellpadding="0" cellspacing="0">
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
							</table>

							<table width="80%" align="center" cellpadding="0" cellspacing="0">
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
							</table>
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

    <!-- Add Image Modal -->
    <!-- <div id="modal_add_image" class="modal fade" role="dialog">
        <div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Uplaod Image</h4>
			</div>
			<div class="modal-body">
				<form id="frm_upload_email_template_image" name="frm_upload_email_template_image">
					<div class="form-group">
						<label for="upload_image">Select Image:</label>
						<input type="file" name="upload_image" id="upload_image">
					</div>
					<div id="container_email_template_image" style="display: none;">
						<div class="form-group">
							<label>Preview:</label>
							<div>
								<img src="" alt="Udistro" id="uploaded_image_preview">
							</div>
							<label>Image Path:</label>
							<div>
								<input type="text" name="uploaded_image_path" id="uploaded_image_path" class="form-control">
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
        </div>
    </div> -->

    <div id="modal_add_image" class="modal fade" role="dialog">
    	<div class="modal-content">
    		<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Uplaod Image</h4>
			</div>
			<div class="modal-body">
		    	<ul class="nav nav-tabs">
		    	    <li class="active"><a data-toggle="tab" href="#home">Upload Image</a></li>
		    	    <li><a data-toggle="tab" href="#menu1">Choose from Udistro</a></li>
		    	</ul>

		    	<div class="tab-content">
		    	    <div id="home" class="tab-pane fade in active">
		    	      	<form id="frm_upload_email_template_image" name="frm_upload_email_template_image">
		    	      		<div class="form-group">
		    	      			<label for="upload_image">Select Image:</label>
		    	      			<input type="file" name="upload_image" id="upload_image">
		    	      		</div>
		    	      		<div id="container_email_template_image" style="display: none;">
		    	      			<div class="form-group">
		    	      				<label>Preview:</label>
		    	      				<div>
		    	      					<img src="" alt="Udistro" id="uploaded_image_preview">
		    	      				</div>
		    	      				<label>Image Path:</label>
		    	      				<div>
		    	      					<input type="text" name="uploaded_image_path" id="uploaded_image_path" class="form-control">
		    	      				</div>
		    	      			</div>
		    	      		</div>
		    	      	</form>
		    	    </div>
		    	    <div id="menu1" class="tab-pane fade">
		    	      	<div class="form-group">
		    	      		<img src="{{ url('images/email_template/wH5yJUTpN1LE6Fbl9aZ2.jpg') }}" width="200" height="200">
		    	      		<input type="" name="" value="{{ url('images/email_template/wH5yJUTpN1LE6Fbl9aZ2.jpg') }}" class="form-control">
		    	      	</div>
		    	    </div>
		    	</div>
		    </div>
		    <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
	    </div>
    </div>

</body>

<script type="text/javascript">
$(document).ready(function(){

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
		$('#uploaded_image_preview').attr('src', '');
		$('#container_email_template_image').hide();

		// Show the modal
		$('#modal_add_image').modal();
	});

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
    	            $('#uploaded_image_preview').attr('src', response.filePath );
    	            $('#uploaded_image_path').val( response.filePath );

    	            $('#container_email_template_image').show();
    	        }
    	        else
    	        {
    	            alertify.error( response.errMsg );
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

    $('#add_image_to_placeholder').click(function(){
    	if( $('#frm_upload_email_template_image').valid() )
    	{
    		// Get the selection value
    		let placementId = $('input[name="image_placement"]:checked').val();

    		// Assign it to respective image
    		$('#logo_image' + placementId).attr('src', $('#uploaded_image_preview').attr('src'));

    		// Change its custom attribute
    		$('#logo_image' + placementId).attr('image-type', 'uploaded');

    		// Hide the modal
    		$('#modal_add_image').modal('hide');
    	}
    });

    // To send the email
    $('#btn_agent_send_email').click(function(){

    	let recipientEmail = $('#recipient_email').val();

    	if( recipientEmail == '' )
    	{
    		alertify.error('Please enter email id');
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

    		// Add max-width: 800 to all images
    		$(this).css('max-width', '800px');
    	});

    	// Get the updated html
    	let content = $(emailContent).html();

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

    // To save the email template in case of Invitation
    $('#btn_agent_save_email_template').click(function(){

    	let emailCategoryId = $('#email_category_id').val();
    	let templateName 	= $('#email_template_name').val();

    	// Check if email template name is available or not
    	if( templateName != '' )
    	{
    		// Clone the container
	    	let emailContent = $('#email_container').clone();

	    	// Remove the "X" place holder from html
	    	$(emailContent).find('.remove_editable').remove();

	    	// Remove all dummy logo images
	    	$(emailContent).find('.logo_images').each(function(){
	    		if( $(this).attr('image-type') == 'dummy' )
	    		{
	    			$(this).remove();
	    		}
	    	});

	    	// Get the updated html
	    	let htmlContentToSend = $(emailContent).html();

    		$.ajax({
    			url: $('meta[name="route"]').attr('content') + '/agent/saveemailtemplate',
    			method: 'post',
    			data: {
    				emailCategoryId: emailCategoryId,
    				templateName: templateName,
    				htmlContentToView: htmlContentToSend,
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

</html>