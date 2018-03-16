<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Successful Payment</title>
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<style>
@import url('https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i');
body { background-image: url({{ url("images/video_bg.jpg") }}); background-size: cover; }
.logo { padding-bottom: 10px; border-bottom: 1px solid #ddd; margin-bottom: 15px; }
.logo img { width: 215px; height: 78px; }
.sucessfull-payment { font-family: 'Open Sans', sans-serif; width: 450px; background: #fff; height: 200px; position: absolute; left: 0; right: 0; top: 0; bottom: 0; margin: auto; border-radius: 4px; padding: 20px; text-align: center; font-size: 18px; }
.congrats-message { font-size: 14px; color: #555; }
.success-message { color: #1bbc28; font-size: 30px; font-weight: 300; padding: 15px 0; }
.total-amount { font-size: 24px; font-weight: 700; color: #777; }
.contact-box { padding: 15px 0; background: #eee; margin: 15px 0; }
.number { display: inline-block; padding: 0px 10px; font-size: 16px; color: #666; }
.number i { color: #1bbc28; }
.tagline { font-size: 16px; color: #555; }
.starts i { color: #ccc; font-size: 30px; padding: 0 5px; margin-top: 15px; cursor: pointer; }
.starts i:hover { color: #ff8700; }
.active-star {	color: #ff8700 !important; }
</style>
</head>

<body>
<div class="sucessfull-payment">
 <div class="paymenet-box">
  <div class="logo"><img src="{{ url('images/logo.png') }}" alt="uDistro"/></div>
  <!-- <div class="congrats-message">Congratulations</div> -->
  <div class="success-message">Payment Successful!</div>
  <!-- <div class="total-amount">Total: <span>$7,343</span></div> -->
  <!-- <div class="contact-box">
   <div class="number"><i class="fa fa-phone" aria-hidden="true"></i> 1860-500-0044</div>
   <div class="number"><i class="fa fa-envelope-open" aria-hidden="true"></i> info@udistro.ca</div>
  </div> -->
 </div>
</div>
</body>
</html>
