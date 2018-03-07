<div>
	<p>
		Hello {{ $emailData['name'] }},
	</p>
	<p>
		Your registration is successful, and its approval is pending.
	</p>
	<p>
		<a href="{{ $emailData['loginURL'] }}">Click here to login</a>
	</p>
	<p>
		Thanks,
	</p>
	<p>
		Team Udisrto
	</p>
</div>