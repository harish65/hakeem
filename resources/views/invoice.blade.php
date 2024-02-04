<table  cellpadding="0" cellspacing="0" width="100%" style="max-width:700px;margin:0 auto;box-shadow:0 0 10px 1px #ddd;padding:20px;font-family:'arial';">
	<tr>
		<td style="text-align: center;font-size: 25px;padding-bottom: 30px;">TAX INVOICE</td>
	</tr>
	<tr>
		<td>
			<table cellpadding="0" cellspacing="0" width="100%" style="width: 100%;">
				<tbody style="vertical-align: baseline;">
				<tr>
					<td>
						<h4 style="font-size: 22px;font-weight: 600;margin: 0 0 10px;">Dr. Manoj</h4>
						<p style="margin: 0 0 4px;color: #6b6b6b;">Indira Gandhi Medical College</p>
						<p style="margin: 0 0 4px;color: #6b6b6b;">Ridge Sanjauli Road</p>
						<p style="margin: 0 0 4px;color: #6b6b6b;">Lakkar Bazar</p>
						<p style="margin: 0 0 4px;color: #6b6b6b;">Shimla</p>
						<p style="margin: 0 0 4px;color: #6b6b6b;">Himachal Pradesh 171001</p>
						<p style="margin: 0 0 12px;color: #6b6b6b;">+91 7688909987</p>
						<span style="background: #12aa85;color: #fff;font-weight: 500;padding: 6px 6px;letter-spacing: 2px;display: table;">BILL TO</span>
						<p style="margin: 12px 0 4px;color: #6b6b6b;" ></p>
						<p style="margin: 0 0 4px;color: #6b6b6b;"></p>
						<p style="margin: 0 0 4px;color: #6b6b6b;"></p>
					</td>
					<td>
						<span style="background: #12aa85;color: #fff;font-weight: 500;padding: 6px 6px;letter-spacing: 2px;">SAC Code</span>&nbsp;&nbsp;<span style="background: #12aa85;color: #fff;font-weight: 500;padding: 6px 6px;letter-spacing: 2px;">Service Tax Category</span><br>
						<span style="padding-top: 10px;color: #000;width: 113px;display: inline-block;padding-bottom: 26px;">993</span><span style="padding-top: 10px;color: #000;width: 180px;display: inline-block;padding-bottom: 26px;">Health Care Service</span><br>
						<span style="background: #12aa85;color: #fff;font-weight: 500;padding: 6px 6px;letter-spacing: 2px;">Invoice #</span>&nbsp;&nbsp; <span style="background: #12aa85;color: #fff;font-weight: 500;padding: 6px 6px;letter-spacing: 2px;">Date</span><br>
						<span style="padding-top: 10px;color: #000;width: 113px;display: inline-block;padding-bottom: 26px;">2701705</span><span style="padding-top: 10px;color: #000;width: 180px;display: inline-block;padding-bottom: 26px;">15 Jul 2020</span>
					</td>
				</tr>
			</tbody>
			</table>
		</td>
		<tr>
			<td>
				<table cellpadding="0" cellspacing="0" width="100%" style="width: 100%;">
					<tr>
						<th style="background: #12aa85;color: #fff;font-weight: 500;padding: 9px 6px; border-right: 1px solid #ddd;width: 300px; ">Booking Date</th>
						<th style="background: #12aa85;color: #fff;font-weight: 500;padding: 9px 6px;border-right: 1px solid #ddd; ">Service Name</th>
						<th style="background: #12aa85;color: #fff;font-weight: 500;padding: 9px 6px;border-right: 1px solid #ddd; "> Unit Price</th>
						<th style="background: #12aa85;color: #fff;font-weight: 500;padding: 9px 6px; border-right: 0px solid #ddd;">Amount</th>
					</tr>
					@if($requesttable)
					@foreach($requesttable as $requesttable)
					<tr>
						<td style="padding: 11px 6px;text-align: center;color: #717171; border: 1px solid #ddd;">{{ $requesttable->booking_date}}</td>
						<td style="padding: 11px 6px;text-align: center;color: #717171; border: 1px solid #ddd;border-left:0;">{{ $requesttable->service_name}}</td>
						<td style="padding: 11px 6px;text-align: center;color: #717171; border: 1px solid #ddd;border-left:0;">Rs.299</td>
						<td style="padding: 11px 6px;text-align: center;color: #717171; border: 1px solid #ddd;border-left:0;">Rs.299</td>
					</tr>
					@endforeach
					@else
					<tr>
						<td style="padding: 11px 6px;text-align: center;color: #717171; border: 1px solid #ddd;">No Data Found</td>
					</tr>
					@endif
				</table>
			</td>
		</tr>
		<tr>
			<td>
				<table cellpadding="0" cellspacing="0" width="100%" style="width: 100%;">
					<tr>
						<td style="vertical-align: baseline;">
							<table cellpadding="0" cellspacing="0" width="100%" style="width: 100%;">
								<tr>
									<td style="padding: 11px 6px;text-align: center;width: 299px;border: 1px solid #ddd;padding: 11px 6px;border-top: 0;">
										Thank you for service
									</td>
								</tr>
								<tr>
									<td style="background: #ddd; padding: 20px 10px;text-align: center; height: 164px;"><img src="assets/images/curenik.png" alt="" style="max-width: 140px;"><span style="width: 100%;display: table;padding-top: 10px;">Authorized Signature</span></td>
								</tr>
							</table>
						</td>
						<td>
									<table cellpadding="0" cellspacing="0" width="100%" style="width: 100%;">
										<tr>
											<td style="border: 1px solid #ddd;padding: 11px 6px;border-top: 0;border-left: 0;">Sub Total</td>
											<td style="text-align: right;border: 1px solid #ddd;padding: 11px 6px;border-top: 0;border-left: 0;">Rs.299</td>
										</tr>
										<tr>
											<td style="border: 1px solid #ddd;padding: 11px 6px;border-top: 0;border-left: 0;">Gst</td>
											<td style="text-align: right;border: 1px solid #ddd;padding: 11px 6px;border-top: 0;border-left: 0;">-</td>
										</tr>
										<tr>
											<td style="border: 1px solid #ddd;padding: 11px 6px;border-top: 0;border-left: 0;">Doc App Wallet</td>
											<td style="text-align: right;border: 1px solid #ddd;padding: 11px 6px;border-top: 0;border-left: 0;">- Rs.0</td>
										</tr>
										<tr>
											<td style="border: 1px solid #ddd;padding: 11px 6px;border-top: 0;border-left: 0;">Discount</td>
											<td style="text-align: right;border: 1px solid #ddd;padding: 11px 6px;border-top: 0;border-left: 0;">- Rs.0</td>
										</tr>
										<tr>
											<td style="border: 1px solid #ddd;padding: 11px 6px;border-top: 0;border-left: 0;">Total</td>
											<td style="text-align: right;border: 1px solid #ddd;padding: 11px 6px;border-top: 0;border-left: 0;">Rs. 299</td>
										</tr>
									</table>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>
				<table>
					<tr>
						<td>
						<p style="margin: 0;padding: 10px 0;color: #8e8e8e;font-weight: 200;line-height: 22px;">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
						</td>
					</tr>
					<tr>
						<td>
						<p style="margin: 0;padding: 0px 0 10px;color: #8e8e8e;font-weight: 200;line-height: 22px;">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
						</td>
					</tr>

				</table>
			</td>
		</tr>
		<tr>
			<td>
				<table cellpadding="0" cellspacing="0" width="100%" style="width: 100%;">
					<tr>
						<td>Powered by  DocsApp</td>
						<td><img src="assets/images/curenik.png" alt="" style="max-width: 140px;"></td>
						<td>Get Well Soon </td>
						<td>Powered by  DocsApp</td>
					</tr>
				</table>
			</td>
		</tr>

	</tr>
</table>