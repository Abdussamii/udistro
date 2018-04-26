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
							Dear {{$emailData['name']}},
						</p>
					</td>
				</tr>
				<tr>
					<td>
						<p>
							Companies have replied to your project request in the last 8 hours. For privacy reasons, we do not allow them to send you bunch of email. Instead we have listed all the responses on your accounts related with the email {{$emailData['email']}} below and you can review each of the response, accept and make payment through the following link below:
						</p>
					</td>
				</tr>
				<tr>
					<td>
						<p>
							Quotation Response:  <a href="{{ $emailData['url'] }}">Click here to see response from companies</a>
						</p>
					</td>
				</tr>
				<tr>
					<td>
						<p>
							After you review companies responses, you will be able to make a secure payment through your PayPal Account, Credit Card or Debit Card of your choice. 
						</p>
					</td>
				</tr>
				<tr>
					<td>
						<p>
							uDistro will not make payment commitments to the companies you are involved with until you have confirmed that your job is delivered as promised.
						</p>
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