@extends('layouts.app')
@section('title', "Udistro | FAQ's")

@section('content')
	<!-- Navbar -->
	<nav class="navbar navbar-inverse navbar-fixed-top" style="display:none;">
	 <div class="container-fluid">
	  <div class="navbar-header logo"> <a href="#"><img src="{{ url('/images/logo.png') }}" alt="Udistro" /></a> </div>
	  <ul class="nav navbar-nav navbar-right navbar-top-link">
	   <li><a href="#">
	    <button type="button" class="btn top-btn1"> I’m a Real-Estate Agent </button>
	    </a></li>
	   <li><a href="#">
	    <button type="button" class="btn top-btn1">I'm a Business</button>
	    </a></li>
	  </ul>
	 </div>
	</nav>
	<!-- End Navbar -->
	<section class="topic-image"><img src="{{ url('/images/faq-topic.jpg') }}" alt=""/> </section>
	<!-- About STARTS -->
	<section class="faq-udistro">
		<div class="container">
	 	<h2>FAQs</h2>
		
		<!-- Tabbing Starts -->
		
		<div class="FAQ-Tabs">
	  <ul class="nav nav-tabs">
	    <li class="active"><a href="#home">Users</a></li>
	    <li><a href="#menu1">Realtors</a></li>
	    <li><a href="#menu2">Business</a></li>
	  </ul>

	  <div class="tab-content">
	    <div id="home" class="tab-pane fade in active">
	      <h3>Users</h3>
	      <p>
		  <div class="panel-group" id="accordion">
	    <div class="panel panel-default">
	      <div class="panel-heading">
	        <h4 data-toggle="collapse" data-parent="#accordion1" href="#collapse1" class="panel-title expand">
	          <a href="#">What is uDistro?</a>
	           <div class="right-arrow pull-right">+</div>
	        </h4>
	      </div>
	      <div id="collapse1" class="panel-collapse collapse">
	        <div class="panel-body">
				<p>UDistro is a time-saving tool that offers you the ability to forward your mail, update businesses with your new address, connect internet and utilities, and share moving announcements with friends and family, –from one easy-to-use platform. You can do all of these for free and in minutes, saving hours!</p>
				<p>In order to gain access to UDistro, you must be invited by someone helping you move – your real estate agent, apartment community, moving company, etc. Once you've been invited, simply claim your account, and start crossing items out of your moving checklist!</p>
			</div>
	      </div>
	    </div>
	    <div class="panel panel-default">
	      <div class="panel-heading">
	        <h4 data-toggle="collapse" data-parent="#accordion2" href="#collapse2" class="panel-title expand">
	          <a href="#">How do I gain access to uDistro?</a>
	            <div class="right-arrow pull-right">+</div>
	        </h4>
	      </div>
	      <div id="collapse2" class="panel-collapse collapse">
	        <div class="panel-body">
				<p>uDistro is an invitation only-platform. In order to gain access to uDistro, you must be invited by someone helping you move – your real estate agent, apartment resident manager, builders etc. Once you have been invited, simply claim your account, and start crossing items out of your moving checklist!</p>
				<p>Not sure if anyone you're working with offers uDistro? Go ahead and request your uDistro invite from the form I’m moving page <a href="http://www.uDistro.ca/getinvitation">http://www.uDistro.ca/getinvitation</a> </p>

			</div>
	      </div>
	    </div>
	    <div class="panel panel-default">
	      <div class="panel-heading">
	        <h4 data-toggle="collapse" data-parent="#accordion3" href="#collapse3" class="panel-title expand">
	          <a href="#">I'm moving again. Can I use uDistro again?</a>
	            <div class="right-arrow pull-right">+</div>
	        </h4>
	      </div>
	      <div id="collapse3" class="panel-collapse collapse">
	        <div class="panel-body">
				<p>So happy to hear that you'd like to use uDistro again for your upcoming move!</p>
				<p>To start a new move, simply ask your realtor, sales agents, and apartment manager or request your uDistro invite from us at <a href="http://www.uDistro.ca/getinvitation">http://www.uDistro.ca/getinvitation</a>  </p>

			</div>
	      </div>
	    </div>
	    <div class="panel panel-default">
	      <div class="panel-heading">
	        <h4 data-toggle="collapse" data-parent="#accordion3" href="#collapse3" class="panel-title expand">
	          <a href="#">I'm moving from an international address. Can I still use uDistro to process international address changes?</a>
	            <div class="right-arrow pull-right">+</div>
	        </h4>
	      </div>
	      <div id="collapse3" class="panel-collapse collapse">
	        <div class="panel-body"><p>Unfortunately, uDistro cannot process international address changes at this time.</p></div>
	      </div>
	    </div>
	    <div class="panel panel-default">
	      <div class="panel-heading">
	        <h4 data-toggle="collapse" data-parent="#accordion4" href="#collapse4" class="panel-title expand">
	          <a href="#">I'm moving from an international address to Canada. Can I still use uDistro to set up services in my new home?</a>
	            <div class="right-arrow pull-right">+</div>
	        </h4>
	      </div>
	      <div id="collapse4" class="panel-collapse collapse">
	        <div class="panel-body"><p>Yes. As long your realtor or sales agents invite you to use uDistro.</p></div>
	      </div>
	    </div>
	    <div class="panel panel-default">
	      <div class="panel-heading">
	        <h4 data-toggle="collapse" data-parent="#accordion5" href="#collapse5" class="panel-title expand">
	          <a href="#">Where can I find my Canada Post Confirmation Number?</a>
	            <div class="right-arrow pull-right">+</div>
	        </h4>
	      </div>
	      <div id="collapse5" class="panel-collapse collapse">
	        <div class="panel-body">
				<p>Once the Canada Post has finished processing your mail forwarding request, they'll be sending you an official Confirmation Letter to your new address. Your Confirmation Number will be included in that letter so, be on the lookout for that in your mailbox within 1-2 weeks of submitting your mail forwarding request. This is the number you can use to edit or cancel your mail forwarding request in the future. </p>
				<p>Haven't yet received your Confirmation Letter but would like to check in with Canada Post regarding the status of your mail forwarding request? No problem! Just log in to your uDistro and call the number we provide in the mail forwarding section.</p>

			</div>
	      </div>
	    </div>
	    <div class="panel panel-default">
	      <div class="panel-heading">
	        <h4 data-toggle="collapse" data-parent="#accordion6" href="#collapse6" class="panel-title expand">
	          <a href="#">When I hire a local business from your site who am I paying to?</a>
	            <div class="right-arrow pull-right">+</div>
	        </h4>
	      </div>
	      <div id="collapse6" class="panel-collapse collapse">
	        <div class="panel-body">
				<p>If you hire a moving company or cleaning company or handyman from uDistro. Your payment comes to Rakoomi Inc. holding-account, but as soon as you confirm your work is completed without any hitch we would release the payment to the local business involved.</p>
			</div>
	      </div>
	    </div>
	    <div class="panel panel-default">
	      <div class="panel-heading">
	        <h4 data-toggle="collapse" data-parent="#accordion7" href="#collapse7" class="panel-title expand">
	          <a href="#">Am I a paying to use uDistro?</a>
	            <div class="right-arrow pull-right">+</div>
	        </h4>
	      </div>
	      <div id="collapse7" class="panel-collapse collapse">
	        <div class="panel-body"><p>No. In fact, uDistro is free for commercial and residential people who are moving and it will always be free. Rakoomi Inc. the owners of uDistro does take subscription charges from the realtors or sales agent who invited you to uDistro. We also charge our local business users for using our platform.</p></div>
	      </div>
	    </div>
		
		
	    <div class="panel panel-default">
	      <div class="panel-heading">
	        <h4 data-toggle="collapse" data-parent="#accordion8" href="#collapse8" class="panel-title expand">
	          <a href="#">Can I cancel my mail forwarding request once it has been filed with the Canada Post?</a>
	            <div class="right-arrow pull-right">+</div>
	        </h4>
	      </div>
	      <div id="collapse8" class="panel-collapse collapse">
	        <div class="panel-body">
					<p>Absolutely! Once your change of address form has been filed with the Canada Post for processing, you'll need to contact your local post office to cancel or make any changes. </p>
					<p>If you've already received your official Canada Post Confirmation Letter, you can use your Confirmation Number to cancel your mail forwarding request online or over the phon</p>
			</div>
	      </div>
	    </div>
	    <div class="panel panel-default">
	      <div class="panel-heading">
	        <h4 data-toggle="collapse" data-parent="#accordion9" href="#collapse9" class="panel-title expand">
	          <a href="#">How do I update my address with the Auto Insurer?</a>
	            <div class="right-arrow pull-right">+</div>
	        </h4>
	      </div>
	      <div id="collapse9" class="panel-collapse collapse">
	        <div class="panel-body">
				<p>We're glad you asked! Policies and procedures vary province-by-province and territories, which is why we've created a helpful guide which will walk you through the process of updating this information based on the province or territory you are moving from as well as the ones you are moving to.</p>
			</div>
	      </div>
	    </div>

	    <div class="panel panel-default">
	      <div class="panel-heading">
	        <h4 data-toggle="collapse" data-parent="#accordion10" href="#collapse10" class="panel-title expand">
	          <a href="#">How will I know if the groups I select have been updated?</a>
	            <div class="right-arrow pull-right">+</div>
	        </h4>
	      </div>
	      <div id="collapse10" class="panel-collapse collapse">
	        <div class="panel-body">
				<p>Usually, you will get an email from the agency indicating that your request has been fulfilled. However, if you use the option of calling the agency from uDistro, you know right away that your profile has been updated.</p>
			</div>
	      </div>
	    </div>

	    <div class="panel panel-default">
	      <div class="panel-heading">
	        <h4 data-toggle="collapse" data-parent="#accordion11" href="#collapse11" class="panel-title expand">
	          <a href="#">Why do you ask for a phone number for identity verification?</a>
	            <div class="right-arrow pull-right">+</div>
	        </h4>
	      </div>
	      <div id="collapse11" class="panel-collapse collapse">
	        <div class="panel-body">
				<p>We take your security here very seriously, which is why we ask all users to verify their identity before we process each and every new move. There is one way in which you can verify your identity:</p>
				<ul>
					<li>Verify by phone number:</li>
					<li><span>1</span> Enter your phone number and click Submit</li>
					<li><span>2</span> You will receive a text message or phone call with a 3-digit verification code at this phone number</li>
					<li><span>3</span> Enter the code</li>
				</ul>
			</div>
	      </div>
	    </div>

	    <div class="panel panel-default">
	      <div class="panel-heading">
	        <h4 data-toggle="collapse" data-parent="#accordion12" href="#collapse12" class="panel-title expand">
	          <a href="#">Why won't the site accept my phone number?</a>
	            <div class="right-arrow pull-right">+</div>
	        </h4>
	      </div>
	      <div id="collapse12" class="panel-collapse collapse">
	        <div class="panel-body">
				<p>We need to verify that you are who you say you are via phone. Therefore, we have implemented a few security measures that block some phone number. For example, you cannot use the same phone twice in year on our site</p>
				<ul>
					<li>We only allow:</li>
					<li><span>1</span> Landlines</li>
					<li><span>2</span> Cell phones with a carrier account/service provider</li>
					<li> We cannot accept the following for security reasons:</li>
					<li><span>1</span> Pre-paid cell phones</li>
					<li><span>2</span> Google Voice numbers</li>
					<li><span>3</span> VOIP phones</li>
				</ul>
			</div>
	      </div>
	    </div>

	    <div class="panel panel-default">
	      <div class="panel-heading">
	        <h4 data-toggle="collapse" data-parent="#accordion13" href="#collapse13" class="panel-title expand">
	          <a href="#">I'm not receiving a verification code</a>
	            <div class="right-arrow pull-right">+</div>
	        </h4>
	      </div>
	      <div id="collapse13" class="panel-collapse collapse">
	        <div class="panel-body">
				<p>That’s not cool. But we have various way to assist you, click on the Help-Centre on the footnote of our website and select one from our list of communication, you also the “Resend code” when prompted. </p>
			</div>
	      </div>
	    </div>

	    <div class="panel panel-default">
	      <div class="panel-heading">
	        <h4 data-toggle="collapse" data-parent="#accordion14" href="#collapse14" class="panel-title expand">
	          <a href="#">How do I know if I've successfully verified my identity?</a>
	            <div class="right-arrow pull-right">+</div>
	        </h4>
	      </div>
	      <div id="collapse14" class="panel-collapse collapse">
	        <div class="panel-body">
				<p>The easiest way to tell if you've successfully verified your identity is that you will be logged into your uDistro “My move” portal. If you see the background picture of the province you are moving to, a google map that shows where you are moving from and where you are moving to and an activity page that asks you to get started then be sure you have logged in successfully. </p>
			</div>
	      </div>
	    </div>

	    <div class="panel panel-default">
	      <div class="panel-heading">
	        <h4 data-toggle="collapse" data-parent="#accordion15" href="#collapse15" class="panel-title expand">
	          <a href="#">What utility providers can I set up from uDistro?</a>
	            <div class="right-arrow pull-right">+</div>
	        </h4>
	      </div>
	      <div id="collapse15" class="panel-collapse collapse">
	        <div class="panel-body">
				<p>You can set up the utility providers in your area. From water to gas to electricity. </p>
			</div>
	      </div>
	    </div>

	    <div class="panel panel-default">
	      <div class="panel-heading">
	        <h4 data-toggle="collapse" data-parent="#accordion16" href="#collapse16" class="panel-title expand">
	          <a href="#">What should I do if my utility provider is missing?</a>
	            <div class="right-arrow pull-right">+</div>
	        </h4>
	      </div>
	      <div id="collapse16" class="panel-collapse collapse">
	        <div class="panel-body">
				<p>We're sorry about that. Just send us an email at <a href="mailto:featuresupport@udistro.ca">featuresupport@udistro.ca</a> and we will help you out.  </p>
			</div>
	      </div>
	    </div>

	    <div class="panel panel-default">
	      <div class="panel-heading">
	        <h4 data-toggle="collapse" data-parent="#accordion17" href="#collapse17" class="panel-title expand">
	          <a href="#">Will you automatically disconnect and set up my digital service at my current home?</a>
	            <div class="right-arrow pull-right">+</div>
	        </h4>
	      </div>
	      <div id="collapse17" class="panel-collapse collapse">
	        <div class="panel-body">
				<p>Of course not! In fact, most utility providers require secure information (such as your social security number) in order to open, transfer or close an account. Instead, we would send your Open New Account request to multiple providers, who would then contact you with different offers and promos. As per disconnection, our software does not support that function at this time, you may have to call your provider to disconnect.</p>
			</div>
	      </div>
	    </div>

	    <div class="panel panel-default">
	      <div class="panel-heading">
	        <h4 data-toggle="collapse" data-parent="#accordion18" href="#collapse18" class="panel-title expand">
	          <a href="#">Will marketing companies receive my address?</a>
	            <div class="right-arrow pull-right">+</div>
	        </h4>
	      </div>
	      <div id="collapse18" class="panel-collapse collapse">
	        <div class="panel-body">
				<p>No marketing companies will receive your information from uDistro. We take security very seriously and pledge to take every possible precaution to ensure that your personal information is safe.</p>
				<p>However, when you use Canada Post Mail Forwarding Service from our site, Canada may make your address available through their National Change of Address (NCOA) list. As a result, mailers and marketing firms that know your name and old address will now have access to your new address.</p>
				<p>If you don’t want this to happen, Canada Post provides the option to opt out marketers getting your information. </p>
			</div>
	      </div>
	    </div>

	    <div class="panel panel-default">
	      <div class="panel-heading">
	        <h4 data-toggle="collapse" data-parent="#accordion19" href="#collapse19" class="panel-title expand">
	          <a href="#">What should I do if my address was changed fraudulently?</a>
	            <div class="right-arrow pull-right">+</div>
	        </h4>
	      </div>
	      <div id="collapse19" class="panel-collapse collapse">
	        <div class="panel-body">
				<p>We software do not update addresses directly because of privacy laws, we go through authorize agencies to help you update your address, most of the agencies will require personal information that only can provide, while other even ask you come in person to finalize the process. However, in the unlikely events that this happens from our site – please email us immediately at <a href="mailto:privacyconcern@udistro.ca">privacyconcern@udistro.ca</a>  </p>
			</div>
	      </div>
	    </div>
	  </div>
		  
		  </p>
	    </div>
	    <div id="menu1" class="tab-pane fade">
	      <h3>Realtors</h3>
	      <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
	    </div>
	    <div id="menu2" class="tab-pane fade">
	      <h3>Business</h3>
	      <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
	    </div>
	  </div>
	</div>	
	<!-- Tabbing Close -->
	</div>
	</section>
	<!-- About ENDS -->
@endsection