<ul class="left-side-bar mb-3">
	<div class="tab">
		<li class="{{ $tab=='spappointment'?'active':'' }}">
			<a href="{{ route('SPAppointment')}}"> 
				<img src="{{ asset('assets/mp2r/images/ic_Booking Requests.png') }}" class="pr-3 show">
				<img src="{{ asset('assets/mp2r/images/ic_Booking Requests-active.png') }}" class="pr-3 hide">Upcoming Request
				<span class="dot hidden" style="display:{{ $tab=='spappointment'?'':'none' }};"></span>
			</a>
		</li>

		<li class="{{ $tab=='search'?'active':'' }}"><a href="{{ route('SPFilter')}}"> <img src="{{ asset('assets/mp2r/images/ic_Booking Requests.png') }}" class="pr-3 show"><img src="{{ asset('assets/mp2r/images/ic_Booking Requests-active.png') }}" class="pr-3 hide">Search <span class="dot" style="display:{{ $tab=='search'?'':'none' }};"></span></a></li>
		<li class="{{ $tab=='profile'?'active':'' }}"  onclick="openCity(event, 'availability','dot1')"   ><a href="{{ url('Sp/manage_availibilty_new?tab=profile_detail')}}"> <img src="{{ asset('assets/mp2r/images/ic_Appointments.png') }}" class="pr-3 show"><img src="{{ asset('assets/mp2r/images/ic_Appointments-active.png') }}" class="pr-3 hide">Profile<span class="dot" style="display:none;" id="dot1" ></span></a></li>
		<li class="{{ $tab=='review'?'active':'' }}"  onclick="openCity(event, 'reviews','dot5')"    ><a href="{{ route('Reviews')}}"> <img src="{{ asset('assets/mp2r/images/ic_Reviews.png') }}" class="pr-3 show"><img src="{{ asset('assets/mp2r/images/ic_Reviews-active.png') }}" class="pr-3 hide">Reviews<span class="dot hidden" style="display:{{ $tab=='review'?'':'none' }};" id="dot5"></span></a></li>
		<li class="{{ $tab=='report'?'active':'' }}">
			<a href="{{ url('service_provider/reports')}}"> 
				<img src="{{ asset('assets/mp2r/images/ic_Reports.png') }}" class="pr-3 show">
				<img src="{{ asset('assets/mp2r/images/ic_Reports-active.png') }}" class="pr-3 hide">Reports 
				<span class="dot hidden" style="display:{{ $tab=='report'?'':'none' }};"></span>
			</a>
	</li>
		<li class="tablinks" ><a href="{{ url('Sp/manage_availibilty_new')}}"> <img src="{{ asset('assets/mp2r/images/ic_schedule.png') }}" class="pr-3  show">  <img src="{{ asset('assets/mp2r/images/ic_schedule copy.png') }}" class="pr-3  hide" >My  Schedule <span class="dot hidden" style="display:none;"></span></a></li>
		<li class="tablinks" ><a href="{{ route('sp.advertising') }}"> <img src="{{ asset('assets/mp2r/images/ic_Advertising.png') }}" class="pr-3  show">  <img src="{{ asset('assets/mp2r/images/ic_Advertising-active.png') }}" class="pr-3  hide" >Advertising <span class="dot hidden" style="display:none;"></span></a></li>
		<li class="{{ $tab=='subscription'?'active':'' }}" ><a href="{{ route('sp-plan') }}"> <img src="{{ asset('assets/mp2r/images/ic_Subscription Plans.png') }}" class="pr-3  show">  <img src="{{ asset('assets/mp2r/images/ic_ic_Subscription Plans-active.png') }}" class="pr-3  hide" >Subscription Plan <span class="dot hidden" style="display:{{ $tab=='subscription'?'':'none' }};"></span></a>
		</li>
		<li class="tablinks" ><a href="{{ url('service_provider/Chat?userid='.Auth::user()->id.'&nickname='.Auth::user()->name.'&receiver_id=1')}}"> <img src="{{ asset('assets/mp2r/images/ic_support.png') }}" class="pr-3  show">  <img src="{{ asset('assets/mp2r/images/ic_support-active.png') }}" class="pr-3  hide" >Supports<span class="dot hidden" style="display:none;"></span></a></li>
		<li class="tablinks" class="active">
		   <a href="{{ url('service_provider/patient/list') }}"> 
		   <img src="{{ asset('assets/mp2r/images/ic_Patients.png') }}" class="pr-3 show">
		   <img src="{{ asset('assets/mp2r/images/ic_Patients-active.png') }}" class="pr-3 hide">Patient
		   <span class="dot hidden" style="display:{{ $tab=='report'?'':'none' }};" id="dot4"></span>
		   </a>
		</li>
		<li class="tablinks" ><a href="{{ route('TermsConditions') }}"> <img src="{{ asset('assets/mp2r/images/ic_Terms & Conditions.png') }}" class="pr-3  show">  <img src="{{ asset('assets/mp2r/images/ic_ic_Terms & Conditions-active.png') }}" class="pr-3  hide"> Terms & Conditions<span class="dot hidden" style="display:none;"></span></a></li>
	</div>
</ul>