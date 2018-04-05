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
						<p>Hi {{ $emailData['name'] }},</p>
						<p>Welcome to uDistro! You're one step closer to joining our relocation ecosystem on our award-winning relocation software.</p>
						<p>
							Whether you're a realtor, a property manager, a builder, a sale agent, or a local business our relo-tech solution solves practical business problem for everyone in the relocation ecosystem.
						</p>
						<p>
							Our mission is to provide hassle-free relocation experience to people who are moving, by developing agile solutions that improve process automation for all moving related tasks. We're re-imaging the way people move in North America.
						</p>
						<p>
							<strong>Username:</strong> {{ $emailData['email'] }}
						</p>
						<p>
							<strong>Setup Account:</strong> Click <a href="{{ $emailData['loginURL'] }}">here</a> to set up account 
						</p>
						<p>
							<strong>Watch:</strong> Click <a href="https://www.youtube.com/channel/UC6iNCk1iPfxUJCHLBHyVi0w?view_as=subscriber">here</a> to watch Demo Videos
						</p>
						<p>
							We look forward to helping you achieve your business goals!
						</p>
						<p>
							Best regards,
							<br>
							The uDistro Team
						</p>	
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>