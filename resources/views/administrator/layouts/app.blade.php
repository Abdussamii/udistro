<html>
    <head>
    	<meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="route" content="{{ url('/') }}">
        
        <title>@yield('title')</title>
        <link rel="icon" type="image/png" href="{{ url('images/favicon.png') }}" sizes="32x32" />

		<link rel="stylesheet" href="{{ URL::asset('css/bootstrap.min.css') }}" />
		<link rel="stylesheet" href="{{ URL::asset('css/templatemo_main.css') }}" />
		<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open Sans:300,400,700')" />
		<link rel="stylesheet" href="{{ URL::asset('css/font-awesome.min.css') }}" />
		<link rel="stylesheet" href="{{ URL::asset('css/dataTables.min.css.css') }}" />
        
        <script type="text/javascript" src="{{ URL::asset('js/jquery.min.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('js/jquery.validate.min.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('js/templatemo_script.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('js/jquery.dataTables.min.js.js') }}"></script>

        <!-- JS Alert Plug-in -->
		<script type="text/javascript" src="{{ URL::asset('js/alertify.min.js') }}"></script>
		<link rel="stylesheet" href="{{ URL::asset('css/alertify.min.css') }}" />

        <!-- Admin JS -->
        <script type="text/javascript" src="{{ URL::asset('js/custom/administrator.js') }}"></script>

    </head>
    
    <body>

    	<div class="navbar navbar-inverse" role="navigation">
    	    <div class="navbar-header">
    	      	<div class="logo"><h1>Udistro</h1></div>
    	      	<!-- <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
	    	        <span class="sr-only">Toggle navigation</span>
	    	        <span class="icon-bar"></span>
	    	        <span class="icon-bar"></span>
	    	        <span class="icon-bar"></span>
    	      	</button> -->
    	    </div>

    	    <?php
    	    // Get the logged-in user email id
    	    $email = '';
    	    if( Auth::check() )
    	    {
    	    	$email = Auth::user()->email;
    	    }
    	    ?>
    	    <!-- <div class="pull-right" style="color:rgb(127,127,127); margin-right:10px;"><h4>Welcome: {{ $email }}</h4></div> -->

    	</div>

    	<div class="template-page-wrapper">

    		<!-- Side Navigation -->
    	  	<div class="navbar-collapse collapse templatemo-sidebar">
				<ul class="templatemo-sidebar-menu">
					<li <?php echo ( ( Request::path() == 'administrator/dashboard' ) ? 'class="active"' : '' ) ?> ><a href="{{ url('administrator/dashboard') }}"><i class="fa fa-home"></i>Dashboard</a></li>

					<li <?php echo ( ( Request::path() == 'administrator/navigationcategory' || Request::path() == 'administrator/navigation' ) ? 'class="sub open"' : 'class="sub"' ) ?> >
						<a href="javascript:void(0);">
							<i class="fa fa-th-list" aria-hidden="true"></i>Content Management<div class="pull-right"><span class="caret"></span></div>
						</a>
						<ul class="templatemo-submenu">
							<li <?php echo ( ( Request::path() == 'administrator/navigationcategory' ) ? 'class="active"' : '' ) ?> ><a href="{{ url('/administrator/navigationcategory') }}">Navigation Category</a></li>
							<li <?php echo ( ( Request::path() == 'administrator/navigation' ) ? 'class="active"' : '' ) ?> ><a href="{{ url('/administrator/navigation') }}">Navigation</a></li>
						</ul>
					</li>

					<!-- <li <?php echo ( ( Request::path() == 'administrator/users' ) ? 'class="active"' : '' ) ?> ><a href="{{ url('/administrator/users') }}"><i class="fa fa-user" aria-hidden="true"></i>View Users</a></li> -->

					<li><a href="{{ url('/logout') }}"><i class="fa fa-sign-out"></i>Sign Out</a></li>
				</ul>
    	  	</div>
    	  	<!-- Side Navigation -->

    	  	<!-- Page Content -->
    	  	<div class="templatemo-content-wrapper">
		           @yield('content')
    	  	</div>
    	  	<!-- Page Content -->
    	  
    	  	<!-- Footer -->
			<footer class="templatemo-footer">
				<div class="templatemo-copyright">
					<p>&copy; Copyright {{ date('Y') }}. All Rights Reserved.</p>
				</div>
			</footer>
			<!-- Footer -->

    	</div>
    </body>
</html>