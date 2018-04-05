<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

<title>@yield('title')</title>

<link rel="icon" type="image/png" href="{{ url('images/udistro-fav.png') }}" sizes="32x32" />

<!-- Bootstrap -->
<link href="{{ URL::asset('css/movers/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('css/movers/style.css') }}" rel="stylesheet">
<!--------Fonts--------------->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600" rel="stylesheet">
<link href="{{ URL::asset('css/movers/font-awesome.min.css') }}" rel="stylesheet">
<meta property="og:title" content="udistro" />
<meta property="og:type" content="website" />
<meta property="og:url" content="http://udistro.ca/" />
<meta property="og:image" content="http://udistro.ca/images/logo.png" />
<meta property="og:site_name" content="udistro"/>
<meta property="og:description" content="udistro"/>

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

        <nav class="navbar navbar-inverse navbar-fixed-top" style="display:none;">
          <div class="container-fluid">
            <div class="navbar-header">
              <a class="navbar-brand" href="#"><img src="{{ url('/') . '/images/logo.png' }}" alt="Udistro" /></a>
            </div>
              <ul class="nav navbar-nav navbar-right navbar-top-link">
                <li><a href="#"><i><img src="{{ url('/') . '/images/truck.png' }}" /></i> <span><u>For Business</u></span></a></li>
                <li><a href="#"><button type="button" class="btn btn-blue">Login</button></a></li>
              </ul>
          </div>
        </nav>

        <div id="page-wrapper">
            @yield('content')
        </div>
        <!-- /#page-wrapper -->

        <footer class="footer-main section-pd">
          <div class="container">
            <div class="row">
            <?php if(count($navigationArray) > 0) {
                    foreach ($navigationArray as $categoryArray) {
            ?>
              <div class="col-md-4">
                <div class="media-body client-achive-step">
                  <h2 class="media-heading"><?=$categoryArray['category']?></h2>
                </div>
                <ul class="list-group custom-listgroup">
                <?php 
                if(count($categoryArray['navigation']) > 0) {
                  foreach ($categoryArray['navigation'] as $linkArray) { ?>
                  <li class="list-group-item"><a href="/<?=$linkArray['navigation_url']?>"><i class="fa fa-angle-double-right" aria-hidden="true"></i><?=$linkArray['navigation_text']?></a></li>
                <?php 
                  }
                } 
                ?>
                </ul>
              </div>
            <?php
                }
              }
            ?>
            </div>
          </div>
        </footer>

</body>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> 
<!-- Include all compiled plugins (below), or include individual files as needed --> 
<script src="{{ URL::asset('js/movers/bootstrap.js') }}"></script> 
<script>
 $(function() {
$('.scroll-down').click (function() {
  $('html, body').animate({scrollTop: $('section.ok').offset().top }, 'slow');
  return false;
});
});
</script>
<script>
    $(function(){
    var navbar = $('.navbar');
    $(window).scroll(function(){
        if($(window).scrollTop() <= 40){
            navbar.css('display', 'none');
        } else {
          navbar.css('display', 'block'); 
        }
    });  
})
</script>
</html> 