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
    <script type="text/javascript" src="{{ URL::asset('js/custom/administrator.js') }}"></script>

    <style type="text/css">
    .error {
    	color: red;
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
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li>
                        	<a href="{{ url('/administrator/logout') }}"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
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
                            <a href="{{ url('administrator/dashboard') }}"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        <!-- <li>
                            <a href="#"><i class="fa fa-th-list"></i> Content Management<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{ url('/administrator/navigationcategory') }}">Navigation Category</a>
                                </li>
                                <li>
                                    <a href="{{ url('/administrator/navigation') }}">Navigation</a>
                                </li>
                                <li>
                                    <a href="{{ url('/administrator/pages') }}">Pages</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-tasks" aria-hidden="true"></i> Utility Services<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{ url('/administrator/utilityservicecategories') }}">Utility Service Categories</a>
                                </li>
                                <li>
                                    <a href="{{ url('/administrator/utilityservicetypes') }}">Utility Service Types</a>
                                </li>
                                <li>
                                    <a href="{{ url('/administrator/utilityserviceproviders') }}">Utility Service Providers</a>
                                </li>
                            </ul>
                        </li> -->
                        <li>
                            <a href="#"><i class="fa fa-building-o" aria-hidden="true"></i> Company Management<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{ url('/administrator/companycategories') }}"> Company Categories</a>
                                </li>
                                <li>
                                    <a href="{{ url('/administrator/companies') }}"> Companies</a>
                                </li>
                                <li>
                                    <a href="{{ url('/administrator/agents') }}"> Agents</a>
                                </li>
                                <li>
                                    <a href="{{ url('/administrator/companyrepresentative') }}"> Company Representative</a>
                                </li>
                                <li>
                                    <a href="{{ url('/administrator/industrytype') }}"> Industry Type</a>
                                </li>
                                <li>
                                    <a href="{{ url('/administrator/services') }}"> Services</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-building-o" aria-hidden="true"></i> Moving Category Management<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{ url('/administrator/movingcategory') }}"> Moving Categories</a>
                                </li>
                                <li>
                                    <a href="{{ url('/administrator/movingitemdetails') }}"> Moving Details</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="{{ url('administrator/paymentplans') }}"><i class="fa fa-building-o"></i> Payment Plans</a>
                        </li>
                        <li>
                            <a href="{{ url('administrator/emailtemplates') }}"><i class="fa fa-envelope"></i> Email Templates</a>
                        </li>
						<li>
                            <a href="#"><i class="fa fa-th-large" aria-hidden="true"></i> Authorization<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{ url('/administrator/roles') }}">Roles</a>
                                </li>
                                <li>
                                    <a href="{{ url('/administrator/permissions') }}">Permissions</a>
                                </li>
								<li>
                                    <a href="{{ url('/administrator/rolespermissions') }}">Role Permissions</a>
                                </li>
								<li>
                                    <a href="{{ url('/administrator/rolesusers') }}">Users Roles</a>
                                </li>
								<li>
                                    <a href="{{ url('/administrator/permissionsusers') }}">Users Permissions</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-th-large" aria-hidden="true"></i> Miscellaneous<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{ url('/administrator/provinces') }}">Provinces</a>
                                </li>
                                <li>
                                    <a href="{{ url('/administrator/cities') }}">Cities</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-dashboard fa-fw"></i> Activity<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{ url('/administrator/activity') }}"> Activity List</a>
                                </li>
                                <li>
                                    <a href="{{ url('/administrator/activityfeedback') }}"> Activity Feedback</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="{{ url('administrator/changepassword') }}"><i class="fa fa-dashboard fa-fw"></i> Change Password</a>
                        </li>
                        <li>
                            <a href="{{ url('administrator/provincialagencies') }}"><i class="fa fa-dashboard fa-fw"></i> Provincial Agencies</a>
                        </li>
                        <li>
                            <a href="{{ url('administrator/generateinvoice') }}"><i class="fa fa-file-text-o" aria-hidden="true"></i> Generate Invoice</a>
                        </li>
                        <li>
                            <a href="{{ url('administrator/responsetime') }}"><i class="fa fa-clock-o"></i> Response Time</a>
                        </li>
                        <!-- <li>
                            <a href="{{ url('administrator/logout') }}"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
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

</body>

</html>