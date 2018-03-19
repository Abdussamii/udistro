<div>
	<p>
		Hello {{ $emailData['name'] }},
	</p>
	<p>
		Payment is released for {{ $emailData['requestedService'] }}. Please start the work.
	</p>
	<p>
		Click <a href="{{ url('/company') }}">here</a> to login and check the details.
	</p>
	<p>
		Thanks,
	</p>
	<p>
		Team Udisrto
	</p>
</div>