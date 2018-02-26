<div>
	<p>
		Hello {{$emailData['name']}},
	</p>
	<p>
		Please click on the following link to check the company response.
	</p>
	<p>
		<a href="{{ $emailData['url'] }}">Click here</a>
	</p>
	<p>
		Thanks,
	</p>
	<p>
		Team Udisrto
	</p>
</div>