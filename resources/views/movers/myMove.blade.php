<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<title>uDistro</title>

<!-- Bootstrap -->
<link href="{{ URL::asset('css/movers/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('css/movers/style.css') }}" rel="stylesheet">

<!-- <link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet"> -->

<!-- Fonts -->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600" rel="stylesheet">

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
</head>

<body>
<!-- Navbar -->
<nav class="navbar navbar-inverse navbar-fixed-top" style="display:none;">
    <div class="container-fluid">
        <div class="navbar-header">
          	<a class="navbar-brand" href="#"><img src="{{ url('/images/movers/advising-logo.png') }}" alt="Udistro" /></a>
          	<div class="user-name-section">
	          	<a href="#"><img src="{{ url('/images/movers/user-avtar.png') }}" class="user-avtar" alt=""></a>
	          	<div class="username">
	          		<h3>{{ ucwords( strtolower( trim($agentDetails->fname . ' ' . $agentDetails->lname) ) ) }}</h3>
	          	</div>
          	</div>
        </div>
        <div class="nav navbar-nav navbar-right user-page">
	        <div class="dropdown user-dropdown">
		        <div class="user-short-name">
		        	<span>{{ $clientInitials }}</span>
		        </div>
	        	<button class="btnbg-none" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ ucwords( strtolower( $clientName ) ) }}<span class="caret"></span></button>
		        <ul class="dropdown-menu" aria-labelledby="dLabel">
		            <li>
			            <a href="#">
			            	<i class="fa fa-power-off"></i>
			            	<span class="text">Logout</span>
			            </a>
		            </li>
		        </ul>
	        </div>
        </div>
    </div>
</nav>
<!-- End Navbar -->
<!-- Map Section -->
<section class="content-section map-bg" style="background:url('{{ url('/images/movers/map-bg.jpg') }}') no-repeat center center;position: relative;display: block;max-width: 100%;">
	<div class="container-fluid">
      	<div class="row">
	        <div class="col-md-4">
	          <div class="contry-name">
	          <h2>Winnipeg</h2>
	          <span>Manitoba</span>
	          </div>
	        </div>
	        <div class="col-md-4">
	        
	        </div>
	        <div class="col-md-4">
				<div class="map-area">
					<img src="{{ url('/images/movers/map-circle.png') }}"  class="img-circle" alt="">
				</div>
	        </div>
      	</div>
    </div>
</section>
<!-- Map Section Ends Here--> 


<!-- percentage bar -->

<section class="percentage-section">
	<div class="container">
		<div class="percentage-bar">
		<h2>25 Percent Completed</h2>
		<div class="progress">
			<div class="progress-bar" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width:25%">
				<span class="sr-only">25% Complete</span>
			</div>
		</div>
		</div>
	</div>
</section>
<!-- end percentage bar -->

<!-- mailboxes-section -->

<section class="mailboxes-section">
	<div class="container">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<div class="col-xs-6 col-lg-4">
					<div class="boxes">
						<div class="img-icon">
							<img src="{{ url('/images/movers/forward_mail_icon.png') }}" class="center-block" alt="">
						</div>
						<div class="box-title">
						<h3>Forward Mail</h3>
						</div>
						<div class="pophover-icon">
							<ul class="popover-icon-group">
								<li><a href="#" title="Get-started" data-toggle="modal" data-target="#myModal"><i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></a></li>
								<li><a href="#" title="Get-started"><i class="fa fa-history" aria-hidden="true"></i></a></li>
								<li><a href="#" title="Get-started"><i class="fa fa-times-circle" aria-hidden="true"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-xs-6 col-lg-4">
					<div class="boxes">
						<div class="img-icon">
							<img src="{{ url('/images/movers/update_address_icon.png') }}" class="center-block" alt="">
						</div>
					<div class="box-title">
						<h3>Update Address</h3>
					</div>
						<div class="pophover-icon">
							<ul class="popover-icon-group">
								<li><a href="#" title="Get-started"><i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></a></li>
								<li><a href="#" title="Get-started"><i class="fa fa-history" aria-hidden="true"></i></a></li>
								<li><a href="#" title="Get-started"><i class="fa fa-times-circle" aria-hidden="true"></i></a></li>
							</ul>
						</div>
					</div>
				</div>

				<div class="col-xs-6 col-lg-4">
					<div class="boxes">
						<div class="img-icon">
							<img src="{{ url('/images/movers/connect_utilities_icon.png') }}" class="center-block" alt="">
						</div>
						<div class="box-title">
							<h3>Connect Utilities</h3>
						</div>
						<div class="pophover-icon">
							<ul class="popover-icon-group">
								<li><a href="#" title="Get-started"><i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></a></li>
								<li><a href="#" title="Get-started"><i class="fa fa-history" aria-hidden="true"></i></a></li>
								<li><a href="#" title="Get-started"><i class="fa fa-times-circle" aria-hidden="true"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</section>

<!--  End mailboxes-section -->




<div class="container">
	<div class="review-section">
		<div class="row">
			<div class="col-md-4">
				<div class="user-name-review">
					<div class="user-short-name">
						<span>EH</span>
						<p>Essie Howell</p>
					</div>
				</div>
			</div>
			<div class="col-md-8">
				<div class="reciew-box">
					<h2>Special Thanks to Agent Roy</h2>
					<ul class="ratingstar">
						<li><a href="#"><i class="fa fa-star red" aria-hidden="true"></i></a></li>
						<li><a href="#"><i class="fa fa-star red" aria-hidden="true"></i></a></li>
						<li><a href="#"><i class="fa fa-star red" aria-hidden="true"></i></a></li>
						<li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
						<li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
					</ul>
					<span>( 3.2 Rating )</span>
				</div>
			</div>
		</div>
	</div>
	<div class="comment-section">
		<div class="row">
			<div class="col-md-12">
				<div class="comment-area">
					<h2>Hi Roy,</h2>
					<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="user-comment-info">
					<div class="col-md-8">
						<div class="comment-group-left">
							<ul class="comment-group">
								<li><a href="#"><i class="fa fa-thumbs-up" aria-hidden="true"></i>Helpful</a></li>
								<li><a href="#"><i class="fa">2</i>Helpful</a></li>
								<li><a href="#"><i class="fa">5</i>Follow</a></li>
							</ul>
						</div>
					</div>
					<div class="col-md-4">
						<div class="user-name-section user-pro-coment">
							<strong>Share this with :</strong>
							<a href="#"><img src="{{ url('/images/movers/user-avtar.png') }}" class="user-avtar" alt=""></a>
							<div class="username">
								<h3>Roy</h3>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<button type="button" class="btn btn-lg center-block coment-submit-btn">Submit</button>
				</div>
			</div>
		</div>
	</div>
</div>



<footer class="footer-main section-pd">
  <div class="container">
    <div class="row">
      <div class="col-md-4">
        <div class="media-body client-achive-step">
          <h2 class="media-heading">Company</h2>
        </div>
        <ul class="list-group custom-listgroup">
          <li class="list-group-item"><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i>About</a></li>
          <li class="list-group-item"><a href="#"> <i class="fa fa-angle-double-right" aria-hidden="true"></i>Career</a></li>
          <li class="list-group-item"><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i>Sitemap</a></li>
          <li class="list-group-item"><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i>Terms of Use</a></li>
          <li class="list-group-item"><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i>Terms of services</a></li>
          <li class="list-group-item"><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i>Privacy Policy</a></li>
        </ul>
      </div>
      <div class="col-md-4">
        <div class="media-body client-achive-step">
          <h2 class="media-heading">Important Links</h2>
        </div>
        <ul class="list-group custom-listgroup">
          <li class="list-group-item"><a href="#"> <i class="fa fa-angle-double-right" aria-hidden="true"></i>Login</a></li>
          <li class="list-group-item"><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i>Features</a></li>
          <li class="list-group-item"><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i>Free Trial</a></li>
          <li class="list-group-item"><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i>Pricing</a></li>
          <li class="list-group-item"><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i>Support</a></li>
          <li class="list-group-item"><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i>Schedule Demo</a></li>
        </ul>
      </div>
      <div class="col-md-4">
        <div class="media-body client-achive-step">
          <h2 class="media-heading">Follow Us</h2>
        </div>
        <ul class="list-group custom-listgroup">
          <li class="list-group-item"><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i>Twitter</a></li>
          <li class="list-group-item"><a href="#"> <i class="fa fa-angle-double-right" aria-hidden="true"></i>Facebook</a></li>
          <li class="list-group-item"><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i>Google Plus</a></li>
          <li class="list-group-item"><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i>Linkedin</a></li>
          <li class="list-group-item"><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i>You tube</a></li>
          <li class="list-group-item"><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i>Instagram</a></li>
        </ul>
      </div>
    </div>
  </div>
</footer>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      
    <div class="modal-body text-center">
      	<div class="close close-btn" data-dismiss="modal"><img src="{{ url('/images/movers/close-img.png') }}" alt=""></div>
	      	<h2>The Freddys are moving!</h2>
	      	<p><h3><strong>Hi Friends,</strong></h3><br>
	        We're moving from the South to the Noth of the city.Stop by Saturday night for a housewarming party!With Love From</p>
			<p><strong>David, Daniel & Debra</strong></p>
      	</div>
      	<div class="modal-footer">
        	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      	</div>
    </div>

  </div>
</div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="{{ URL::asset('js/jquery.min.js') }}"></script>
<script src="{{ URL::asset('js/movers/bootstrap.min.3.3.7.js') }}"></script>

<script>
// To show the to navigation when page is scroll down
$(function(){
    var navbar = $('.navbar');
    $(window).scroll(function(){
        if($(window).scrollTop() <= 40){
       		navbar.css('display', 'none');
        } else {
          navbar.css('display', 'block'); 
        }
    });  
});
</script>

</body>
</html> 