@extends('movers.layouts.header')
@section('title', 'Udistro')

@section('content')
	<!----------------Navbar------------->
<nav class="navbar navbar-inverse navbar-fixed-top" style="display:none;">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="#"><img src="images/logo.png" alt="Udistro" /></a>
        </div>
          <ul class="nav navbar-nav navbar-right navbar-top-link">
            <li><a href="#"><i><img src="images/truck.png" /></i> <span><u>For Business</u></span></a></li>
            <li><a href="#"><button type="button" class="btn btn-blue">Login</button></a></li>
          </ul>
      </div>
    </nav>
<!------------End Navbar------------->
<!--Video Section-->
<section class="content-section video-section">
  <div class="video_bg">
	<video autoplay loop class="fillWidth" width="100%">
            <source src="images/udistro-video.webm" type="video/webm" />Your browser does not support the video tag. I suggest you upgrade your browser.
            <source src="images/udistro-video.mp4" type="video/mp4" />Your browser does not support the video tag. I suggest you upgrade your browser.
        </video>
        <div class="poster hidden">
            <img src="PATH_TO_JPEG" alt="">
        </div>
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="logo_banner"><img src="images/banner-logo.png" class="center-block img-responsive" alt="udistro"></div>
          <h1 class="title_banner">Improving relocation experience for 4 million household movers in Canada every year.</h1>
          <div class="banner_btn-group center-block">
            <button type="button" class="btn banner_btn btn-lg green_btn">I am Moving</button>
            <button type="button" class="btn banner_btn btn-lg white_btn">I Help Others Move</button>
          </div>
        </div>
      </div>
    </div>
    <a href="#" class="scroll-down" address="true"></a> </div>
</section>
<!--Video Section Ends Here--> 

<!--- /Let’s Organize Your Move/ --->
<section class="content-section section-pd">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="section-organise">
          <h2 class="center-block title-main">Let’s Organize Your Move</h2>
          <p class="discretion">Udistro is at the forefront of improving relocation experience for millions of households in Canada. We do this through our online moving application that organizes all moving-related tasks and process into one single platform.</p>
          <div class="banner_btn-group center-block">
            <button type="button" class="btn banner_btn btn-lg skyBlue_btn">Get Started</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<section class="content-section section-pd section-testi">
  <div class="container">
    <div class="row">
      <div class="col-md-7">
        <div class="well">
          <h2>uDistro</h2>
          <p>Investors, developers and property owners are cautiously optimistic about the Canadian real estate market’s outlook for the year ahead ... But the main message is that every regional market offers opportunities for savvy developers and investors —as long as they embrace technology and anticipate their future buyers’ needs.</p>
          <div class="client_name">
            <p>Frank Magliocco</p>
            <p>Partner, National Real Estate Leader</p>
          </div>
        </div>
        <ol class="carousel-indicators">
          <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
          <li data-target="#carousel-example-generic" data-slide-to="1"></li>
          <li data-target="#carousel-example-generic" data-slide-to="2"></li>
        </ol>
      </div>
    </div>
  </div>
</section>
<section class="section-pd section-service">
  <h2 class="text-center">Here Is What you Get With Udistro!</h2>
  <div class="container">
    <div class="row">
      <div class="col-md-3">
        <div class="serviceBox">
          <div class="serviceIcon text-center"><img src="images/mail-icon.png" alt="Mail Icon"/></div>
          <h3 class="text-center">Forward Mail</h3>
          <p class="text-justify">Relax your mind, knowing you’re not going to miss any important mail. Mail forwarding is more dependable than your neighbors and we made it easy for you to buy online or at the post office.</p>
        </div>
      </div>
      <div class="col-md-3">
        <div class="serviceBox">
          <div class="serviceIcon text-center"><img src="images/add_icon.png" alt="Address"/></div>
          <h3 class="text-center">Change Address</h3>
          <p class="text-justify">Let's help you update your new address with those mailers that Canada post is not able to — especially infrequent mailers such as, Canada Revenue Agency, License Agency, etc.</p>
        </div>
      </div>
      <div class="col-md-3">
        <div class="serviceBox">
          <div class="serviceIcon text-center"><img src="images/connect_icon.png" alt="Connect"/></div>
          <h3 class="text-center">Connect Utilities</h3>
          <p class="text-justify">If you like saving time and money, you’re going to like this. We’ve have the lists of the Utility companies that serve your new area, making it convenient for you to pick up phone and call them.</p>
        </div>
      </div>
      <div class="col-md-3">
        <div class="serviceBox">
          <div class="serviceIcon text-center"><img src="images/update_icon.png" alt="Update"/></div>
          <h3 class="text-center">Updates Friend & Families</h3>
          <p class="text-justify">When it comes to happiness, our nearest and dearest really matter. Use this tools to share the news of your new home with friends and families. Not forgetting to drop a thank you note to your agents as well.</p>
        </div>
      </div>
    </div>
    <div class="banner_btn-group center-block">
      <button type="button" class="btn banner_btn btn-lg skyBlue_btn">More Information</button>
    </div>
  </div>
</section>

<!-----/ How Udistro Works/------>
<section class="section-pd sectionWorks">
  <h2 class="text-center title_steps">How Udistro Works</h2>
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <ul class="timeline">
          <li class="first-step">
            <div class="stepsNumb"><span class="round-tab"> 1 </span></div>
            <div class="steps stepsOne timeline-panel">
              <div class="media">
                <div class="media-left"> <a href="#"> <img class="media-object" src="images/step_one.png" alt="Steps One"> </a> </div>
                <div class="media-body">
                  <h2 class="media-heading">Set up uDistro account</h2>
                  <p class="text-justify"> Stand out in your local market. We know you're an expert at what you do but our moving application will help you get the attention you deserve. With uDistro, you are now able to help your customers move everything — even intangible things, such as utilities and mail forwarding. </p>
                </div>
              </div>
            </div>
          </li>
          <li class="first-step">
            <div class="stepsNumb"><span class="round-tab yellow-cd"> 2 </span></div>
            <div class="steps stepsOne timeline-panel timeline-inverted">
              <div class="media">
                <div class="media-left pull-right"> <a href="#"> <img class="media-object" src="images/step_two.png" alt="Steps One"> </a> </div>
                <div class="media-body media-body-right">
                  <h2 class="media-heading yellow-cd-aft">Update your brand image</h2>
                  <p class="text-justify"> Add value in the face of disruptive technologies. Streamline moving process for your clients, by offering them a free service for their patronage. Your team can now focus on the business you do best and allow uDistro put you on top of the rankings in your industry. </p>
                </div>
              </div>
            </div>
          </li>
          <li class="first-step">
            <div class="stepsNumb"><span class="round-tab orange-cd"> 3 </span></div>
            <div class="steps stepsOne timeline-panel">
              <div class="media">
                <div class="media-left"> <a href="#"> <img class="media-object" src="images/step_three.png" alt="Steps One"> </a> </div>
                <div class="media-body">
                  <h2 class="media-heading orange-cd-aft">Invite new Clients</h2>
                  <p class="text-justify">Start inviting new clients to use uDistro. In order to gain access to uDistro, you must invite your clients – from your real estate agent account. Once you've invited them, they simply claim the account, and start crossing items off the moving checklist! Your clients can file their official Canada post mail forwarding form in one click. </p>
                </div>
              </div>
            </div>
          </li>
          <li class="first-step">
            <div class="stepsNumb"><span class="round-tab pink-cd"> 2 </span></div>
            <div class="steps stepsOne timeline-panel timeline-inverted">
              <div class="media">
                <div class="media-left pull-right"> <a href="#"> <img class="media-object" src="images/step_four.png" alt="Steps One"> </a> </div>
                <div class="media-body media-body-right">
                  <h2 class="media-heading pink-cd-aft">Become their Hero</h2>
                  <p class="text-justify">uDistro streamlines the moving process for your clients, while making you look real great. You simply become their hero. They cap it up by sending a digital moving e-card, branded for your company, to friends and family with their new address. What a kind referral this would be! </p>
                </div>
              </div>
            </div>
          </li>
        </ul>
        <div class="banner_btn-group center-block tab-btn">
          <button type="button" class="btn banner_btn btn-lg green_btn">Management</button>
          <button type="button" class="btn banner_btn btn-lg white_btn outline">Resident</button>
        </div>
      </div>
    </div>
  </div>
</section>

<!----/What you can help your client achive with Udistro/------>
<section class="content-section section-pd">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="section-organise">
          <h2 class="center-block title-main">What you can help your client achive with Udistro</h2>
          <div class="client-achive-Section">
            <div class="row">
              <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="media-body client-achive-step">
                  <h2 class="media-heading">Set up home utility service</h2>
                  <p>From electricity, to gas, to water, sewage and waste, to digital service such as television, phone and Internet uDistro not only give you information on how to get connected, but provides you with special offers from our lists of friends and partners who are bend on giving you a house warming gifts.</p>
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="media-body client-achive-step">
                  <h2 class="media-heading">Forward your email to your new address</h2>
                  <p>When you purchase Mail Forwarding, Letter mail™, Registered Mail™, and magazines addressed to your old address will be forwarded to new address.</p>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="media-body client-achive-step">
                  <h2 class="media-heading">Change your address with other organizations</h2>
                  <p>Parcels, prepaid envelopes and some special government mailers are excluded from Canada Post mail service. If you’re expecting any of these deliveries you must advise the sender(s) of your new address, uDistro will help do this. Consider this as the second home warming gifts</p>
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="media-body client-achive-step">
                  <h2 class="media-heading">Make moving memorable</h2>
                  <p>Share your moving good news with those that matter to you. uDistro allows you to send a digital moving announcement as e-cards, to friends and family with their new address. </p>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="media-body client-achive-step">
                  <h2 class="media-heading">Hire Professional Tech-squads</h2>
                  <p>As a uDistro’er, you’ll always save serious cash with exclusive access to deals and information that we’ve secured for you – everything from professional home cleaning services, snow removing service to cable companies available near you.</p>
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="media-body client-achive-step">
                  <h2 class="media-heading">Hire professional movers</h2>
                  <p>Sign on exclusive offers we already secured for you, from moving companies who are partnering with us to make your move stress free.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-----/ Pricing table/------>
<section class="content-section section-pd price-table">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="section-organise">
          <h2 class="center-block title-main">Our Price!</h2>
          <p class="discretion-pdb"> Less is more! Udistro will give you quality you’d expect at price you wouldn’t.</p>
          <div class="row">
            <div class="col-md-10 col-md-offset-1">
              <div class="col-md-4">
                <div class="panel panel-danger light-seegreen">
                  <div class="panel-heading">
                    <h3 class="text-center">Basic</h3>
                    <p class="text-center plan">Trial Plan</p>
                  </div>
                  <ul class="list-group list-group-flush text-center">
                    <li class="list-group-item">1-2 Email per user per month</li>
                    <li class="list-group-item">Brand Emails</li>
                    <li class="list-group-item">Custom Logo</li>
                    <li class="list-group-item">Review Brand</li>
                  </ul>
                  <div class="panel-body text-center">
                    <p class="lead" style="font-size:30px">
                    <strong><span class="dollor">$</span><span class="price-d">0.<small>00</small></span><br>
                    <p class="monthly">per month</p>
                    </strong>
                    </p>
                  </div>
                  <div class="panel-footer"> <a class="btn btn-lg btn-default light-seegreen_btn" href="#">Purchase Now</a> </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="panel panel-danger purple">
                  <div class="panel-heading">
                    <h3 class="text-center">Standard</h3>
                    <p class="text-center plan">Premium Plan</p>
                  </div>
                  <ul class="list-group list-group-flush text-center">
                    <li class="list-group-item">1-50 Email per user per month</li>
                    <li class="list-group-item">Brand Emails</li>
                    <li class="list-group-item">Custom Logo</li>
                    <li class="list-group-item">Review Brand</li>
                  </ul>
                  <div class="panel-body text-center">
                    <p class="lead" style="font-size:30px">
                    <strong><span class="dollor">$</span><span class="price-d">13.<small>99</small></span><br>
                    <p class="monthly">per month</p>
                    </strong>
                    </p>
                  </div>
                  <div class="panel-footer"> <a class="btn btn-lg btn-default purple-btn" href="#">Purchase Now</a> </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="panel panel-danger black">
                  <div class="panel-heading">
                    <h3 class="text-center">Proffesional</h3>
                    <p class="text-center plan">Premium Plan</p>
                  </div>
                  <ul class="list-group list-group-flush text-center">
                    <li class="list-group-item">1-500 Email per user per month</li>
                    <li class="list-group-item">Brand Emails</li>
                    <li class="list-group-item">Custom Logo</li>
                    <li class="list-group-item">Review Brand</li>
                  </ul>
                  <div class="panel-body text-center">
                    <p class="lead" style="font-size:30px">
                    <strong><span class="dollor">$</span><span class="price-d">49.<small>99</small></span><br>
                    <p class="monthly">per month</p>
                    </strong>
                    </p>
                  </div>
                  <div class="panel-footer"> <a class="btn btn-lg btn-default black-btn" href="#">Purchase Now</a> </div>
                </div>
              </div>
            </div>
          </div>
          <div class="banner_btn-group center-block">
            <button type="button" class="btn banner_btn btn-lg skyBlue_btn">More Information</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
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
@endsection