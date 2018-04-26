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
    <!-- <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"> -->
    <link rel="stylesheet" href="{{ URL::asset('css/font-awesome.min.css') }}" />

    <!-- dataTables -->
    <link rel="stylesheet" href="{{ URL::asset('css/dataTables.min.css.css') }}" />

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
    <script type="text/javascript" src="{{ URL::asset('js/jquery.min.js') }}"></script>

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
    <script type="text/javascript" src="{{ URL::asset('js/custom/company.js') }}"></script>

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

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-109910967-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-109910967-1');
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
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                    	<li>
                            <a href="{{ url('company/profile') }}"><i class="fa fa-user"></i> Profile</a>
                        </li>
                    	<li>
                        	<a href="{{ url('company/changepassword') }}"><i class="fa fa-lock"></i> Change Password</a>
                        </li>
                        <li>
                        	<a href="{{ url('/company/logout') }}"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
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
                    	<?php
                    		$companyDetails = Helper::checkUserCompanyType();
                    	?>
                    	<li class="dash-logo">
                    		<img src="https://www.udistro.ca/images/logo-dash.png" alt="Udistro">
                    	</li>
                        <li>
                            <a href="{{ url('company/dashboard') }}"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        <!-- <li>
                            <a href="{{ url('company/profile') }}"><i class="fa fa-user" aria-hidden="true"></i> Profile</a>
                        </li> -->
                        <?php
                        if( isset( $companyDetails ) && count( $companyDetails ) > 0 && $companyDetails->company_category_id != '4' )
                        {
	                        ?>
	                        	<li>
	                        	    <a href="{{ url('company/quotationrequest') }}"><i class="fa fa-dashboard fa-fw"></i> Quotation Request</a>
	                        	</li>
	                        	<li>
	                        	    <a href="{{ url('company/jobs') }}"><i class="fa fa-tasks" aria-hidden="true"></i> Jobs</a>
	                        	</li>
	                        <?php
                        }
                        ?>
                        <li>
                            <a href="{{ url('company/review') }}"><i class="fa fa-comments" aria-hidden="true"></i> Review</a>
                        </li>
                        <?php
                        if( isset( $companyDetails ) && count( $companyDetails ) > 0 && $companyDetails->company_category_id != '4' )
                        {
	                        ?>
	                        	<li>
	                        	    <a href="{{ url('company/paymentplan') }}"><i class="fa fa-credit-card" aria-hidden="true"></i> Payment Plan</a>
	                        	</li>
	                        <?php
                        }
                        ?>
                        <!-- <li>
                            <a href="{{ url('company/changepassword') }}"><i class="fa fa-dashboard fa-fw"></i> Change Password</a>
                        </li> -->
                        <!-- <li>
                            <a href="{{ url('company/logout') }}"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li> -->
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            @yield('content')
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Alert Box Modal -->
    <div class="modal fade" id="alert_box_modal" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
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
    <!-- Alert Box Modal -->

</body>

</html>