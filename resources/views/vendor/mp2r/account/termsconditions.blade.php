@extends('vendor.mp2r.layouts.index', ['title' => 'Manage Availability','header_after_login'=>true])
@section('css')
    
@endsection
@section('content')

<style>
.hide{
	display:none;
}
.imgt{
height: 79px;
    width: 79px;
    border-radius: 50%;
    object-fit: cover;
    /* border: solid; */
}
.second-name p{
        font-size: 16px !important;
    }
</style>
	<section class="main-height-clr bg-clr">
		<div class="container">
			<div class="row">
					<!-- left side  -->
				<div class="col-md-4 col-lg-4 col-sm-4">
					<div class="left-dashboard mt-5">
						<div class="side-head pb-0">
						<h3 class="">Service Provider Dashboard</h3>
						</div>
						<hr/>
						
						<ul class="left-side-bar mb-3">
						<div class="tab">
						

						<li class="tablinks"><a href="{{ route('SPAppointment')}}"> <img src="{{ asset('assets/mp2r/images/ic_Booking Requests.png') }}" class="pr-3 show"><img src="{{ asset('assets/mp2r/images/ic_Booking Requests-active.png') }}" class="pr-3 hide">UPCOMING REQUESTS<span class="dot" style="display:none;"></span></a></li>
							
						<li class="tablinks" onclick="openCity(event, 'availability','dot1')"   ><a href="{{ url('service_provider/manage_availibilty')}}"> <img src="{{ asset('assets/mp2r/images/ic_Appointments.png') }}" class="pr-3 show"><img src="{{ asset('assets/mp2r/images/ic_Appointments-active.png') }}" class="pr-3 hide">PROFILE<span class="dot" style="display:none;" id="dot1" ></span></a></li>	

						<li class="tablinks"><a href="{{ route('Reviews')}}"> <img src="{{ asset('assets/mp2r/images/ic_Reviews.png') }}" class="pr-3 show"><img src="{{ asset('assets/mp2r/images/ic_Reviews-active.png') }}" class="pr-3 hide">REVIEWS<span class="dot hidden" style="display:none;" id="dot5"></span></a></li>

						<li class="tablinks"  ><a href="#"> <img src="{{ asset('assets/mp2r/images/ic_Reports.png') }}" class="pr-3 show"><img src="{{ asset('assets/mp2r/images/ic_Reports-active.png') }}" class="pr-3 hide">REPORTS <span class="dot hidden" style="display:none;"></span></a></li>

						
						<li class="tablinks" ><a href="#"> <img src="{{ asset('assets/mp2r/images/ic_Advertising.png') }}" class="pr-3  show">  <img src="{{ asset('assets/mp2r/images/ic_Advertising-active.png') }}" class="pr-3  hide" >SCHEDULE<span class="dot hidden" style="display:none;"></span></a></li>
						

						<li class="tablinks" ><a href="#"> <img src="{{ asset('assets/mp2r/images/ic_Advertising.png') }}" class="pr-3  show">  <img src="{{ asset('assets/mp2r/images/ic_Advertising-active.png') }}" class="pr-3  hide" >ADVERTISING<span class="dot hidden" style="display:none;"></span></a></li>

						<li class="tablinks"><a href="{{ route('sp-plan') }}"> <img src="{{ asset('assets/mp2r/images/ic_Advertising.png') }}" class="pr-3  show">  <img src="{{ asset('assets/mp2r/images/ic_Advertising-active.png') }}" class="pr-3  hide" >SUBSCRIPTION PLAN<span class="dot hidden" style="display:none;"></span></a>
						</li>
						

						<li class="tablinks" ><a href="#"> <img src="{{ asset('assets/mp2r/images/ic_Advertising.png') }}" class="pr-3  show">  <img src="{{ asset('assets/mp2r/images/ic_Advertising-active.png') }}" class="pr-3  hide" >SUPPORT<span class="dot hidden" style="display:none;"></span></a></li>



						
						<li class="tablinks" onclick="openCity(event, 'Patients','dot4')"   ><a href="#"> <img src="{{ asset('assets/mp2r/images/ic_Patients.png') }}" class="pr-3 show"><img src="{{ asset('assets/mp2r/images/ic_Patients-active.png') }}" class="pr-3 hide">PATIENT <span class="dot hidden" style="display:none;" id="dot4"></span></a></li>

						<li class="active" ><a href="{{ route('TermsConditions') }}"> <img src="{{ asset('assets/mp2r/images/ic_Terms & Conditions.png') }}" class="pr-3  show">  <img src="{{ asset('assets/mp2r/images/ic_ic_Terms & Conditions-active.png') }}" class="pr-3  hide"> TERMS & CONDITIONS<span class="dot"></span></a></li>
						</div>
						</ul>						
					</div>
				</div>
				
			<!-- left side  end -->	
				<div class="col-lg-8 col-md-8 col-sm-8">
					<section class="right-side mt-5">
					<div class="row align-items-center">
						<div class="col-md-12 col-sm-12">
						<h3 class="appointment">TERMS & CONDITIONS</h3>
						</div>
						
					</div>
					</section>

					<section class="wrapper wrap2">
						<div class="row align-items-center m-0 wrap-height border-0 pt-3">
							<div class="col-md-12 col-lg-12 ">
								@if($data)
									<h5 class="latest-update">{{ \Carbon\Carbon::parse($data->updated_at)->diffForHumans() }}</h5>
									<span class="second-name pt-2">{!! $data->body !!}</span>
								@else
									<center>NO TERMS & CONDITIONS FOUND </center>
								@endif
							
							</div>	
						</div>
					</section>
				</div>
			</div>
		</div>
	</section>
	    @endsection