@php $requesttable = $requesttable[0]; @endphp
<table cellpadding="0" cellspacing="0" width="100%" style="max-width:700px;margin:0 auto;box-shadow:0 0 10px 1px #ddd;padding:20px;font-family:'arial';">
	<tr>
		<td style="text-align: center;font-size: 25px;padding-bottom: 30px;">TAX INVOICE</td>
	</tr>
	<tr>
		<td>
			<table cellpadding="0" cellspacing="0" width="100%" style="width: 100%;">
				<tbody style="vertical-align: baseline;">
					<tr>
						<td>
							<h4 style="font-size: 22px;font-weight: 600;margin: 0 0 10px;">Dr. {{ $requesttable->sr_info->name }}</h4>
							<p style="font-size: 16px; color: #777;">{{ $requesttable->sr_info->getCategoryData($requesttable->sr_info->id)->name }}:{{{ $requesttable->sr_info->country_code.''.$requesttable->sr_info->phone }}}</p>

							<p style="margin:0 0 3px;">{{ $requesttable->clinic_info->name ?? ''}},{{ $requesttable->clinic_info->address ?? '' }}</p>
							<span style="background: #12aa85;color: #fff;font-weight: 500;padding: 6px 6px;letter-spacing: 2px;">BILL TO</span>
							<p style="margin: 12px 0 4px;color: #6b6b6b;">{{ $requesttable->cus_info->name }}</p>
							<p style="margin: 0 0 4px;color: #6b6b6b;">{{ $requesttable->cus_info->phone }}</p>
							<p style="margin: 0 0 4px;color: #6b6b6b;">{{ $requesttable->cus_info->email }}</p>
						</td>
						<td>
							<span style="background: #12aa85;color: #fff;font-weight: 500;padding: 6px 6px;letter-spacing: 2px;">SAC Code</span>&nbsp;&nbsp;<span style="background: #12aa85;color: #fff;font-weight: 500;padding: 6px 6px;letter-spacing: 2px;">Service Tax Category</span><br>
							<span style="padding-top: 10px;color: #000;width: 113px;display: inline-block;padding-bottom: 26px;">993</span><span style="padding-top: 10px;color: #000;width: 180px;display: inline-block;padding-bottom: 26px;">Health Care Service</span><br>
							<span style="background: #12aa85;color: #fff;font-weight: 500;padding: 6px 6px;letter-spacing: 2px;">Invoice #</span>&nbsp;&nbsp; <span style="background: #12aa85;color: #fff;font-weight: 500;padding: 6px 6px;letter-spacing: 2px;">Date</span><br>
							<span style="padding-top: 10px;color: #000;width: 113px;display: inline-block;padding-bottom: 26px;">2701705</span><span style="padding-top: 10px;color: #000;width: 180px;display: inline-block;padding-bottom: 26px;">{{ date('d M Y',strtotime($requesttable->booking_date))}}</span>
						</td>
					</tr>
				</tbody>
			</table>
		</td>
	<tr>
		<td>
			<table cellpadding="0" cellspacing="0" width="100%" style="width: 100%;">
				<tr>

					<th style="background: #12aa85;color: #fff;font-weight: 500;padding: 9px 6px;border-right: 1px solid #ddd; ">Service Name</th>
					<th style="background: #12aa85;color: #fff;font-weight: 500;padding: 9px 6px;border-right: 1px solid #ddd; "> Unit Price</th>
					<th style="background: #12aa85;color: #fff;font-weight: 500;padding: 9px 6px; border-right: 0px solid #ddd;">Amount</th>
				</tr>
				@if($requesttable)

				@if(@$requesttable->transactions[0]->module_id)
				@php $price = 0; @endphp
				@else
				@php $price = $requesttable->transactions[0]->amount; @endphp
				@endif
				<tr>

					<td style="padding: 11px 6px;text-align: center;color: #717171; border: 1px solid #ddd;border-left:0;">{{ $requesttable->service_name}}<br/>@if($price==0)(Prepaid by subscription )@endif</td>
					<td style="padding: 11px 6px;text-align: center;color: #717171; border: 1px solid #ddd;border-left:0;">Rs.{{$requesttable->transactions[0]->amount}}</td>
					<td style="padding: 11px 6px;text-align: center;color: #717171; border: 1px solid #ddd;border-left:0;">Rs.{{$price}}</td>
				</tr>

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
					<td style="vertical-align: baseline;">
						<table cellpadding="0" cellspacing="0" width="100%" style="width: 100%;">
							<tr>
								<td style="border: 1px solid #ddd;padding: 11px 6px;text-align: center;color: #717171; border: 1px solid #ddd;border-left:0;">Sub Total</td>
								<td style="text-align: right;border: 1px solid #ddd;padding: 11px 6px;text-align: center;color: #717171; border: 1px solid #ddd;border-left:0;">Rs.{{$price}}</td>
							</tr>
							<tr>
								<td style="border: 1px solid #ddd;padding: 11px 6px;text-align: center;color: #717171; border: 1px solid #ddd;border-left:0;">Gst</td>
								<td style="text-align: right;border: 1px solid #ddd;padding: 11px 6px;text-align: center;color: #717171; border: 1px solid #ddd;border-left:0;">-</td>
							</tr>
							<tr>
								<td style="border: 1px solid #ddd;padding: 11px 6px;text-align: center;color: #717171; border: 1px solid #ddd;border-left:0;">Doc App Wallet</td>
								<td style="text-align: right;border: 1px solid #ddd;padding: 11px 6px;text-align: center;color: #717171; border: 1px solid #ddd;border-left:0;">- Rs.0</td>
							</tr>
							<tr>
								<td style="border: 1px solid #ddd;padding: 11px 6px;text-align: center;color: #717171; border: 1px solid #ddd;border-left:0;">Discount</td>
								<td style="text-align: right;border: 1px solid #ddd;padding: 11px 6px;text-align: center;color: #717171; border: 1px solid #ddd;border-left:0;">- Rs.0</td>
							</tr>
							<tr>
								<td style="border: 1px solid #ddd;padding: 11px 6px;text-align: center;color: #717171; border: 1px solid #ddd;border-left:0;">Total</td>
								<td style="text-align: right;border: 1px solid #ddd;padding: 11px 6px;text-align: center;color: #717171; border: 1px solid #ddd;border-left:0;">Rs. {{$price}}</td>
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
						<p style="margin: 0;padding: 10px 0;color: #8e8e8e;font-weight: 200;line-height: 22px;">1. This invoice is issued by the Curenik not by Phasorz Technologies Private
							Limited. Phasorz Technologies Private Limited acts as an intermediary for the Health Care Service.
							Since GST on the Health Care Service Provider is exempted no GST is collected and remitted by
							Phasorz Technologies Private Limited(GST 29AAHCP3193M1 ZR) in capacity of an "Electronic Commerce
							Operator" as Section 9(5) of the Central Goods & Service Tax Act, 201 7 and respective state Laws.

						</p>
					</td>
				</tr>
				<tr>
					<td>
						<p style="margin: 0;padding: 0px 0 10px;color: #8e8e8e;font-weight: 200;line-height: 22px;">2. This invoice has been signed by the Authorized signatory of Phasorz Technologies Private Limited
							only limited purposes of complying as an Electronic Commerce Operator</p>
					</td>
				</tr>

			</table>
		</td>
	</tr>
	<tr>
		<td>
			<table cellpadding="0" cellspacing="0" width="100%" style="width: 100%;">
				<tr>
					<td>Powered by DocsApp</td>
					<td><img src="assets/images/curenik.png" alt="" style="max-width: 140px;"></td>
					<td>Get Well Soon </td>
					<td>Powered by DocsApp</td>
				</tr>
			</table>
		</td>
	</tr>

	</tr>
</table>