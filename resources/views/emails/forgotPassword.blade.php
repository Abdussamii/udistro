<div>
	<p>
		Hello {{$emailData['name']}},
	</p>
	<p>
		Please click on the following link to reset the password.
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