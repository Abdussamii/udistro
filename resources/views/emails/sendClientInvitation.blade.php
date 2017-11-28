<!DOCTYPE html>
<html lang="en">

<head>
	<title>Invitation</title>
</head>
<body style="width: 60%; margin: auto;">

	<table>
		<tr>
			<td>
				<!-- User addressing -->
				<div>
					<p>
					  	<strong>Hi, {{ $clientName }}</strong>
					</p>
					<p>
						<strong>Thank you for choosing {{ $companyName }}</strong>
					</p>
				</div>
			</td>
		</tr>
		<tr>
			<td>
				<!-- Agent selected email template & message appended to that template goes here -->
				<div>
					<p>
						{!! $finalTemplateContent !!}
					</p>
				</div>
			</td>
		</tr>
		<tr>
			<td>
				<a style="display: block; width: 115px; height: 20px; background: #4E9CAF; padding: 10px; text-align: center; border-radius: 5px; color: white; font-weight: bold; text-decoration: none;" href="{{ $invitationURL }}">Get Started</a>
			</td>
		</tr>
		<tr>
			<td>
				<!-- Agent Image, Name, Social Icon with their links goes here  -->
				<table>
					<tr>
						<td>
							<p><img src="{{ url('/images/agents/' . $agentDetails->image) }}" height="80" width="80" style="border-radius: 25px;" alt="{{ ucwords( strtolower( trim( $agentDetails->fname. ' ' .$agentDetails->lname ) ) ) }}"></p>
							<p>
								<strong>{{ ucwords( strtolower( trim( $agentDetails->fname. ' ' .$agentDetails->lname ) ) ) }}</strong>
							</p>
						</td>
					</tr>
					<tr>
						<td>
							<?php echo ( $agentDetails->twitter != '' ) ? '<a href="'. $agentDetails->twitter .'"><img src="'. url('/images/emails/' . 'twitter.png') .'" alt="Twitter" width="24" height="24"></a>' : '' ?>
							<?php echo ( $agentDetails->linkedin != '' ) ? '<a href="'. $agentDetails->linkedin .'"><img src="'. url('/images/emails/' . 'linkedin.png') .'" alt="Linkedin" width="24" height="24"></a>' : '' ?>
							<?php echo ( $agentDetails->skype != '' ) ? '<a href="'. $agentDetails->skype .'"><img src="'. url('/images/emails/' . 'skype.png') .'" alt="Skype" width="24" height="24"></a>' : '' ?>
							<?php echo ( $agentDetails->website != '' ) ? '<a href="'. $agentDetails->website .'"><img src="'. url('/images/emails/' . 'website.jpg') .'" alt="Website" width="24" height="24"></a>' : '' ?>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>

</body>
</html>