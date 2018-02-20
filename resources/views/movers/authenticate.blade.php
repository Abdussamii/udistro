<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="route" content="{{ url('/') }}">

<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<title>uDistro</title>

<!-- Bootstrap -->
<link href="{{ URL::asset('css/movers/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('css/movers/style.css') }}" rel="stylesheet">

<!-- <link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet"> -->

<!-- Fonts -->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600" rel="stylesheet">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="{{ URL::asset('css/movers/font-awesome.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('css/movers/owl.carousel.min.css') }}" rel="stylesheet">

<!-- <link href="css/font-awesome.min.css" rel="stylesheet">
<link href="css/owl.carousel.min.css" rel="stylesheet"> -->

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="{{ URL::asset('js/jquery.min.js') }}"></script>
<script src="{{ URL::asset('js/movers/bootstrap.min.3.3.7.js') }}"></script>

<!-- Custom functionality -->
<script src="{{ URL::asset('js/custom/movers.js') }}"></script>

<!-- Google Map API -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCSaTspumQXz5ow3MBIbwq0e3qsCoT2LDE"></script>

<!-- JQuery Validation -->
<script type="text/javascript" src="{{ URL::asset('js/jquery.validate.min.js') }}"></script>

<!-- JS Alert Plug-in -->
<script type="text/javascript" src="{{ URL::asset('js/alertify.min.js') }}"></script>
<link rel="stylesheet" href="{{ URL::asset('css/alertify.min.css') }}" />

<!-- Multiple Select Dropdown -->
<script type="text/javascript" src="{{ URL::asset('js/multiple-select.js') }}"></script>
<link rel="stylesheet" href="{{ URL::asset('css/multiple-select.css') }}" />

<!-- Jquery UI for datepicker -->
<script type="text/javascript" src="{{ URL::asset('js/jquery-ui.min.js') }}"></script>
<link rel="stylesheet" href="{{ URL::asset('css/jquery-ui.min.css') }}" />

<script>
// To show the to navigation when page is scroll down
$(function(){
    
});
</script>

<style type="text/css">
.error {
	color: red;
}
</style>
</head>

<body>

	

</body>
</html> 