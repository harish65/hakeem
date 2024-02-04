@forelse($Sp_Detail as $Sp_Info)
<div class="wrapper3 mb-3">
	<div class="row">
		<div class="col-md-6 col-lg-8 col-sm-12">
			<div class="row m-0 align-items-center sm-text-center pt-0">
				<div class="col-md-12 col-lg-3 "><img src="{{ $Sp_Info->doctor_data->profile_image?Storage::disk('spaces')->url('uploads/'.$Sp_Info->doctor_data->profile_image):asset('assets/mp2r/images/ic_prof-medium@2x.png') }}"  style="border-radius: 50%;width: 100px;height: 100px;" class="img-fluid mb-2">@if($Sp_Info->doctor_data->manual_available == 1 || $Sp_Info->doctor_data->availability_available == true) <span class="online"></span>@else <span class="online" style="color: red"></span> @endif</div>
				<div class="col-md-12 col-lg-9 pl-0 pt-2">
					<h5 class="first-name">{{ $Sp_Info->doctor_data->name }}</h5>
					<p class="second-name pt-2 pb-1">{{ $Sp_Info->doctor_data->group }}</p>
					
				</div>
			</div>
		</div>
		<div class="col-md-6 col-lg-4 col-sm-12">
			
			<a href="{{ url('service_provider/Chat?userid='.Auth::user()->id.'&nickname='.Auth::user()->name.'&receiver_id='.$Sp_Info->doctor_data->id )}}" id="btn_start"  class="btn-begin2 ml-2 modal-messaging-list__icon--select modal-confirm-submit">Chat</a>
		</div>
	</div>	
</div>
@empty
<center>No Service Provider Found</center>
@endforelse