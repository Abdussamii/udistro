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
							Hello {{$emailData['name']}},
						</p>
						<p>
							You have a new quotation request.
						</p>
						<p>
							<a href="{{ $emailData['url'] }}">Click here to check the details</a>
						</p>
						<p>
							Thanks,
						</p>
						<p>
							Team Udisrto
						</p>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>