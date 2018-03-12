<style type="text/css">
.about-company { display: block; border-top: 1px solid #ccc; }
.body-content { font-size: 16px; }
span.company-address p {
    font-size: 17px;
    padding: 10px 0px;
    margin: 0px;
    font-weight: bold;
}
span.company-image {
    display: table;
}
span.company-image img {
    width: 120px;
}
span.phone-no {
    display: block;
    font-size: 17px;
    font-weight: bold;
}
span.social-icon {
    display: block;
    margin-top: 10px;
}
span.social-icon a { margin-right:10px; }
span.social-icon img {
    width: 20px;
    border: 1px solid #ccc;
}	
</style>

<div>
	<div class="body-content">
		{!! $emailData['content'] or '' !!}
	</div>
	<div class="about-company">
		<span class="company-image"><img src="{{ url('/images/udistro-logo.png') }}" alt="Udisrto" /></span>
		<span class="company-address"><p>
			610 Kirkbridge Drive, Winnipeg, Manitoba
		</p></span>
		<span class="phone-no">
			204-202-3377
		</span>
		<span class="social-icon">
			<a class="s_i" href=""><img src="{{ url('/images/facebook-icon.png') }}" alt="facebook" /></a>
		</span>
	</div>
</div>