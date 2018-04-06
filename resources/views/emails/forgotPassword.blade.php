<div>
	<img src="{{ url('/images/logo.png') }}" alt="Udistro" />
	<br />
	<hr />
	<p>
		Dear {{$emailData['name']}},
	</p>
	<p>
		A lookup of your uDistro login details has been requested through our website. For security reasons, we do not send current passwords. Instead we have listed your accounts related with the email {{$emailData['email']}} below and you can reset the needed password through the corresponding link:
	</p>
	<p>
		Username: {{$emailData['email']}}
		Password reset:  <a href="{{ $emailData['url'] }}">click here to reset your password</a>
	</p>
	<p>
		After you reset the password, you will be able to log in with your username and new password.
	</p>
	<p>
		The password reset link(s) will be active only within the next 24 hours. If you want to reset the password after this period please restart the process.
	</p>
	<p>
		If you have not initiated the procedure, please ignore and delete this message.
	</p>
	<p>
		Best Regards,<br />
		The uDistro Team
	</p>
</div>