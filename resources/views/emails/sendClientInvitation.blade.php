<!DOCTYPE html>
<html lang="en">

<head>
	<title>Invitation</title>
</head>
<body style="width: 600px; margin: auto; background-color: #fff; border: 5px solid #ececec; padding: 15px;">

	<table>
		<tr>
			<td>
				<!-- User addressing -->
				<div>
					<p>
					  	<strong>Hi, {{ $emailData['clientName'] }}</strong>
					</p>
					<p>
						<strong>Thank you for choosing {{ $emailData['companyName'] }}</strong>
					</p>
				</div>
			</td>
		</tr>
		<tr>
			<td>
				<!-- Agent selected email template & message appended to that template goes here -->
				<div>
					<p>
						{!! $emailData['finalTemplateContent'] !!}
					</p>
				</div>
			</td>
		</tr>
		<tr>
			<td>
				<a style="display: block; width: 115px; height: 20px; background: #4E9CAF; padding: 10px; text-align: center; border-radius: 5px; color: white; font-weight: bold; text-decoration: none;" href="{{ $emailData['invitationURL'] }}">Get Started</a>
			</td>
		</tr>
		<tr>
			<td>
				<!-- Agent Image, Name, Social Icon with their links goes here  -->
				<table>
					<tr>
						<td align="center">
							<p><img src="{{ url('/images/agents/' . $emailData['agentDetails']['image']) }}" height="80" width="80" style="border-radius: 50px; border: 5px solid #ececec;" alt="{{ ucwords( strtolower( trim( $emailData['agentDetails']['fname']. ' ' .$emailData['agentDetails']['lname'] ) ) ) }}"></p>
							<p>
								<strong style="color: #4e9caf; text-align: center; border-bottom: 2px solid #ececec; padding-bottom: 7px;">{{ ucwords( strtolower( trim( $emailData['agentDetails']['fname']. ' ' .$emailData['agentDetails']['lname'] ) ) ) }}</strong>
							</p>
						</td>
					</tr>
					<tr>
						<td>
							<?php echo ( $emailData['agentDetails']['twitter'] != '' ) ? '<a href="'. $emailData['agentDetails']['twitter'] .'"><img src="'. url('/images/emails/' . 'twitter.png') .'" alt="Twitter" width="24" height="24"></a>' : '' ?>
							<?php echo ( $emailData['agentDetails']['linkedin'] != '' ) ? '<a href="'. $emailData['agentDetails']['linkedin'] .'"><img src="'. url('/images/emails/' . 'linkedin.png') .'" alt="Linkedin" width="24" height="24"></a>' : '' ?>
							<?php echo ( $emailData['agentDetails']['skype'] != '' ) ? '<a href="'. $emailData['agentDetails']['skype'] .'"><img src="'. url('/images/emails/' . 'skype.png') .'" alt="Skype" width="24" height="24"></a>' : '' ?>
							<?php echo ( $emailData['agentDetails']['website'] != '' ) ? '<a href="'. $emailData['agentDetails']['website'] .'"><img src="'. url('/images/emails/' . 'website.jpg') .'" alt="Website" width="24" height="24"></a>' : '' ?>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>

</body>
</html>