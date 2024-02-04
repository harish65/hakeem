
<table  cellpadding="0" cellspacing="0" width="100%" style="max-width:700px;margin:0 auto;box-shadow:0 0 10px 1px #ddd;padding:20px;border:1px solid #000;font-family:'arial';">
	<tr>
		<td>
			<h3 style="font-size:30px;margin:0 0 5px;">DR. {{ $requesttable->sr_info->name }}</h3>
			<p style="font-size: 16px; color: #777;">{{ $requesttable->sr_info->getCategoryData($requesttable->sr_info->id)->name }}:{{{ $requesttable->sr_info->country_code.''.$requesttable->sr_info->phone }}}</p>
            <!-- <p style="margin:0 0 3px;">Tamil Nadu Medical Council REGD No:999999</p> -->
			<p style="margin:0 0 3px;">{{ $requesttable->clinic_info->name}},{{ $requesttable->clinic_info->address}}</p>
		</td>
		<td><img src="{{ asset('assets2/images/curenik.png') }}" alt="" style="max-width: 140px;"></td>
		
	</tr>
	<tr>
	<td colspan="2" style="padding-top:15px;">
		<table style="width:100%; border-top:1px solid #000;padding-top:15px;">
		<tr>
			<?php 
			$to   = new DateTime('today');
			if($requesttable->cus_info->profile && $requesttable->cus_info->profile->dob){
				$from   = new DateTime($requesttable->cus_info->profile->dob);
				$age = $from->diff($to)->y;
			}else{
				$age = "NA";
			}
			?>
			<td>
				<h4 style="margin:0 0 5px; font-size:22px;">{{ $requesttable->cus_info->name }}, {{ $age }}/{{($requesttable->cus_info->profile->gender=='female')?"F":"M"}}</h4>
				<p style="margin:0 0 5px;">Patient ID: {{ $requesttable->cus_info->id }}</p>
				<!-- <p style="margin:0 0 3px;">Id:&nbsp;<span style="border-bottom: 1px dashed #000; padding: 0 20px;">10001</span></p> -->
			</td>
			
			<td>
				<h4 style="margin:0 0 5px; font-size:22px;text-align: right;">{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $requesttable->booking_date)->format('j M Y') }}</h4>
				<p style="margin:0 0 3px;text-align: right;">Prescription ID: {{ ($requesttable->pre_scription)?$requesttable->pre_scription->id:'NA' }}</p>
			</td>
		</tr>
		</table>
	</td>
	<tr>
		<td colspan="2" style="padding: 10px 0;">
			<table cellpadding="0" cellspacing="0" style="width:100%; border:1px solid #000;">
				<tr>
					<!-- <td style="padding: 7px 10px;border-right: 1px solid #000;font-size: 14px;">Ht: <b>180</b><span style="width:100%;display:table;    text-align: right;">(cm)</span></td>
					<td style="padding: 7px 10px;border-right: 1px solid #000;font-size: 14px;">Weight: <b>72</b><span style="width:100%;display:table;    text-align: right;">(kg)</span></td>
					<td style="padding: 7px 10px;border-right: 1px solid #000;font-size: 14px;">RR: <b>66</b><span style="width:100%;display:table;    text-align: right;">(per min)</span></td>
					<td style="padding: 7px 10px;border-right: 1px solid #000;font-size: 14px;">Temp: <b>90</b><span style="width:100%;display:table;text-align: right;">(F)</span></td> -->
					<td style="padding: 7px 10px;border-right: 1px solid #000;font-size: 14px;">Age: <b><span>{{ $age }}</span></b></td>
					<td style="padding: 7px 10px;border-right: 1px solid #000;font-size: 14px;">Gender: <b><span>{{ ($requesttable->cus_info->profile && $requesttable->cus_info->profile->gender)?$requesttable->cus_info->profile->gender:'NA' }}</span></b></td>
					<!-- <td style="padding: 7px 10px;border-right: 0px solid #000;font-size: 14px;">Drug Allergies: <b><span></span></b></td> -->
				</tr>
			</table>
		</td>
	</tr>
	
	@if(isset($requesttable->custom_info_1) && !empty($requesttable->custom_info_1))
	<?php  $custom_info_1 = json_decode($requesttable->custom_info_1);?>
	<tr>
		<td colspan="2" style="padding: 10px 0;">
			<table cellpadding="0" cellspacing="0" style="width:100%; border:1px solid #000;">
			@if(@$custom_info_1->current_diagnosis)
				<tr>
					<td style="background: #e5e5e5;padding: 12px 17px;border-bottom: 1px solid #000;border-right: 1px solid #000;">Current Diagnosis</td>
					<td style="padding: 0 12px;">{{$custom_info_1->current_diagnosis}}</td>
				</tr>
				@endif
				@if(@$custom_info_1->know_diagnosis)
				<tr>
					<td style="background: #e5e5e5;padding: 12px 17px;border-right: 1px solid #000;">Know Diagnosis</td>
					<td style="padding: 0 12px;border-top: 1px solid #000;">{{$custom_info_1->know_diagnosis}}</td>
				</tr>
				@endif
			</table>
		</td>
	</tr>
	@endif
    @if($requesttable->pre_scription && $requesttable->pre_scription->type=='digital')
	<tr>
		<td colspan="2" style="padding: 10px 0 0;">
			<table cellpadding="0" cellspacing="0" style="width:100%; border:1px solid #000;">
                <tbody>
                    <tr>
                        <th style="padding: 7px 10px;border-right:1px solid #000;"><img src="assets/images/rx.png" alt="" style="max-width: 20px;"></th>
                        <th style="padding: 7px 10px;border-right:1px solid #000;    width: 250px;font-size: 15px;">Medicine</th>
                        <th style="padding: 7px 10px;border-right:1px solid #000;font-size: 15px;">Frequency<br><span style="font-weight: 200;font-size: 14px;">(MN-AF-EN-NT)</span></th>
                        <th style="padding: 7px 10px;border-right:1px solid #000;font-size: 15px;">Duration</th>
                        <!-- <th style="padding: 7px 10px;border-right:1px solid #000;font-size: 15px;">Qty</th> -->
                        <th style="padding: 7px 10px;border-right:0px solid #000;font-size: 15px;">Remarks<br>Instruction</th>
                    </tr>
                    @foreach($requesttable->medicines as $key=>$medicine)
                    <tr>
                        <td style="font-size: 14px;padding: 7px 10px;border-right:1px solid #000;border-top:1px solid #000">{{ $key+1 }}</td>
                        <td style="font-size: 14px;padding: 7px 10px;border-right:1px solid #000;border-top:1px solid #000"><b>{{ $medicine->medicine_name }} -- {{ $medicine->dosage_type }}</b></td>
                        <td style="font-size: 14px;padding: 7px 10px;border-right:1px solid #000;border-top:1px solid #000; text-align: center;">
                            @foreach(json_decode($medicine->dosage_timing) as $dosage_timing) 
                                {{ (isset($dosage_timing->dose_value))? $dosage_timing->dose_value:'One' }} ( {{ $dosage_timing->with.' '.$dosage_timing->time }}),<br>
                            @endforeach
                        </td>
                        <td style="font-size: 14px;padding: 7px 10px;border-right:1px solid #000;border-top:1px solid #000; text-align: center;">{{ $medicine->duration }}</td>
                        <td style="font-size: 14px;padding: 7px 10px;border-right:0px solid #000;border-top:1px solid #000; text-align: center;">Take light food</td>
                    </tr>
                    @endforeach
            
                </tbody>
            </table>
		</td>
	</tr>
	@endif
	<tr>
		<td colspan="2">
			<table cellpadding="0" cellspacing="0" style="width:100%; border:1px solid #000; border-top:0; border-bottom:0;">
			<tr>
				<td style="padding: 10px 15px; height: 130px;vertical-align: baseline;"><b>Note:-</b>
                {{ isset($requesttable->pre_scription)?$requesttable->pre_scription->pre_scription_notes:'' }}
            </td>
				
			</tr>
			</table>
		</td>
	</tr>
		<tr>
		<td colspan="2" style="padding: 0px 0;">
			<table cellpadding="0" cellspacing="0" style="width:100%; border:1px solid #000;">
				<tr>
					<td style="background: #e5e5e5;padding: 12px 17px;border-bottom: 1px solid #000;border-right: 1px solid #000;    width: 220px;">Special Instruction</td>
					<td style="padding: 0 12px;border-bottom:1px solid #000;">
					@if(@$custom_info_1->special_instructions)
					{{$custom_info_1->special_instructions}}
				@endif</td>
				</tr>
				<tr>
					<td colspan="2" style="background: #e5e5e5;padding: 12px 17px;border-bottom: 1px solid #000;border-right: 0px solid #000;text-align:center;">Next Follow-Up Date : - 
					@if(@$custom_info_1->followup_date)
					{{$custom_info_1->followup_date}}
				@endif
				</td>
				</tr>
				<tr>
					<td style="background: #e5e5e5;padding: 12px 17px;border-right: 1px solid #000;border-bottom:0px solid #000;">Investigations for next Follow-Up</td>
					<td style="padding: 0 12px;border-top: 0px solid #000;border-bottom:0px solid #000;">@if(@$custom_info_1->followup_instructions)
					{{$custom_info_1->followup_instructions}}
				@endif
			</td>
				</tr>
				
			</table>
		</td>
	</tr>
	<tr>
		<td colspan="2">
			<table cellpadding="0" cellspacing="0" style="width:100%;">
				<tr>
					<td style="background: #e5e5e5;padding: 12px 0px 0;border-right: 1px solid #000;border-bottom:1px solid #000;width:400px;border-left: 1px solid #000;"><span style="padding: 0 19px 18px;display: table;">Dispensing Details (for Pharmacy use only):</span><br><span style="background: #000;color: #fff;width: 100%;display: table;text-align: center;padding: 6px 0;">DO NOT REFILL MORE THAN ONCE</span></td>
					<td style="padding: 0 12px;border-top: 0px solid #000;text-align: center; border-bottom:1px solid #000;border-right:1px solid #000;"><img src="{{ 'https://consultants3assets.sfo2.digitaloceanspaces.com/thumbs/'.$requesttable->sr_info->signature }}" alt="" style="max-width: 140px;"><br><span style="width: 100%;display: table;text-align: center;padding-top: 10px;">(Sign & Seal)</span></td>
				</tr>
				<tr>
					<td colspan="2" style="text-align:center;padding-top:10px;">For Appointment call: {{ $requesttable->sr_info->country_code.'  '.$requesttable->sr_info->phone }}, {{ $requesttable->sr_info->email }}</td>
				</tr>
			</table>
		</td>
	</tr>
	</tr>
</table>