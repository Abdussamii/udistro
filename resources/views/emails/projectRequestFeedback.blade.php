<table align="center" style="background-color: #f5f5f5; width: 100%; padding: 20px 0px;">
	<tr>
		<td>
			<table align="center" style="background-color: #fff; width: 700px; padding: 20px;">
				<tr>
					<td style="border-bottom: 1px solid #ddd;">
						<img src="{{ url('/images/udistro-logo.png') }}" alt="uDistro">
					</td>
				</tr>
				<tr>
					<td>
						<p>
							Dear {{ $emailData['fname'] }},
						</p>
						<p>
							Thank you for submitting quote request on uDistro.ca.
						</p>
						<p>
							Please find a copy of the details you submitted at the bottom of this email.
						</p>
						<p>
							Your quote request has now been sent to the following companies.
						</p>
					</td>
				</tr>
				<tr>
					<td>
						
					</td>
				</tr>
				<tr>
					<td>
						<p>
							These companies will provide you with no obligation quotes within 24 hours. The successful bidder may, if necessary telephone you to ask for additional information about your requirements. 
						</p>
						<p>
							NP: During your selection process, it is recommended that you check ratings, company profile & qualifications and guarantee policies of the companies. 
						</p>
						<p>
							For privacy reasons, we do not allow them to send you bunch of email. Instead we have listed all the responses on your accounts related with the email mayankpandey@virtualemployee.com below and you can review each of the response, accept and make payment through the following link below:
						</p>
						<p>
							Quotation Response: <a href="{{ $emailData['url'] }}">Click here to see response from companies</a>
						</p>
						<p>
							You can always come back to this page to check new responses.
						</p>
						<p>
							After you review companies responses, you will be able to make a secure payment through your PayPal Account, Credit Card or Debit Card of your choice.
						</p>
						<p>
							uDistro will not make payment commitments to the companies you are involved with until you have confirmed that your job is delivered as promised.
						</p>
						<p>
							<strong>Details of the quote request you submitted:</strong>
						</p>
					</td>
				</tr>

				<tr>
					<td>
						<table border="1" cellpadding="5" cellspacing="0" style="width: 100%;">
							<tr>
								<th>Company name</th>
								<th>Rating</th>
								<th>Profile</th>
								<th>Active member</th>
								<th>Guarantee policy</th>
							</tr>
							<?php
							if( isset( $emailData['companies'] ) && count( $emailData['companies'] ) > 0 )
							{
								foreach($emailData['companies'] as $company)
								{
								?>
									<tr>
										<td>{{ ucwords( strtolower( $company['company_name'] ) ) }}</td>
										<td style="text-align: center;">
										<?php
										if( $company['rating'] > 0 )
										{
											for($i=1; $i<=$company['rating']; $i++)
											{
												echo '<img src="'. url('/images/star.png') .'" alt="uDistro">';
											}
										}
										else
										{
											echo 'NA';
										}
										?>	
										</td>
										<td>{{ ucwords( $company['profile'] ) }}</td>
										<td style="text-align: center;">{{ $company['member_since'] or 'NA' }}</td>
										<td style="text-align: center;">
										<?php
										if( !is_null( $company['guarantee_policy'] ) )
										{
											echo ( $company['guarantee_policy'] == '1' ) ? 'Yes' : 'No';
										}
										else
										{
											echo 'No';
										}
										?>
										</td>
									</tr>
								<?php
								}
							}
							else
							{
							?>
								<tr>
									<td colspan="5" style="text-align: center;">No matching company found</td>
								</tr>
							<?php
							}
							?>
						</table>
					</td>
				</tr>

				<tr>
					<td>
						<p>
							Contact information:
						</p>
					</td>
				</tr>
				<tr>
					<td>
						<table>
							<tr>
								<td>Name</td>
								<td>{{ $emailData['name'] }}</td>
							</tr>
							<tr>
								<td>Telephone</td>
								<td>{{ $emailData['contact_number'] }}</td>
							</tr>
							<tr>
								<td>Email</td>
								<td>{{ $emailData['email'] }}</td>
							</tr>
							<tr>
								<td>Moving from:</td>
							</tr>
							<tr>
								<td>Address</td>
								<td>{{ $emailData['moving_from']['address1'] or '' }}</td>
							</tr>
							<tr>
								<td>City</td>
								<td>{{ $emailData['moving_from']['city'] or '' }}</td>
							</tr>
							<tr>
								<td>Province</td>
								<td>{{ $emailData['moving_from']['province'] or '' }}</td>
							</tr>
							<tr>
								<td>Postal code</td>
								<td>{{ $emailData['moving_from']['postal_code'] or '' }}</td>
							</tr>
							<tr>
								<td>Property</td>
								<td>{{ $emailData['moving_from']['moving_from_house_type'] or '' }}</td>
							</tr>
							<tr>
								<td>Floor #</td>
								<td>{{ $emailData['moving_from']['moving_from_floor'] or '' }}</td>
							</tr>
							<tr>
								<td>Number of bedrooms</td>
								<td>{{ $emailData['moving_from']['moving_from_bedroom_count'] or '' }}</td>
							</tr>
							<tr>
								<td>Moving to:</td>
								<td></td>
							</tr>
							<tr>
								<td>Address</td>
								<td>{{ $emailData['moving_to']['address1'] or '' }}</td>
							</tr>
							<tr>
								<td>City</td>
								<td>{{ $emailData['moving_to']['city'] or '' }}</td>
							</tr>
							<tr>
								<td>Province</td>
								<td>{{ $emailData['moving_to']['province'] or '' }}</td>
							</tr>
							<tr>
								<td>Postal code</td>
								<td>{{ $emailData['moving_to']['postal_code'] or '' }}</td>
							</tr>
							<tr>
								<td>Property</td>
								<td>{{ $emailData['moving_to']['moving_to_property_type'] or '' }}</td>
							</tr>
							<tr>
								<td>Floor #</td>
								<td>{{ $emailData['moving_to']['moving_to_floor'] or '' }}</td>
							</tr>
							<tr>
								<td>Number of bedrooms</td>
								<td>{{ $emailData['moving_to']['moving_to_bedroom_count'] or '' }}</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<p>
							If you have any questions or would like further information about uDistro service, please visit our website www.udistro.ca Alternatively, you can email at moving@udistro.ca, or chat with our Customer Service team on our website.
						</p>
						<p>
							Kind Regards,
							<br>
							<strong>The uDistro Team</strong>
						</p>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>