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
						<li  class="tablinks"  onclick="openCity(event, 'booking_request','dot2')"  id="defaultOpen" ><a href="{{ route('SPAppointment')}}"> <img src="{{ asset('assets/mp2r/images/ic_Booking Requests.png') }}" class="pr-3 show"><img src="{{ asset('assets/mp2r/images/ic_Booking Requests-active.png') }}" class="pr-3 hide"> <span class="dot hidden" style="display:none;" id="dot2"></span></a></li>

						<li class="active"><a href="#"> <img src="images/ic_Booking Requests.png" class="pr-3 show"><img src="images/ic_Booking Requests-active.png" class="pr-3 hide">UPCOMING REQUESTS<span class="dot"></span></a></li>
							
						<li class="tablinks" onclick="openCity(event, 'availability','dot1')"   ><a href="{{ url('service_provider/manage_availibilty')}}"> <img src="{{ asset('assets/mp2r/images/ic_Appointments.png') }}" class="pr-3 show"><img src="{{ asset('assets/mp2r/images/ic_Appointments-active.png') }}" class="pr-3 hide">PROFILE<span class="dot" style="display:none;" id="dot1" ></span></a></li>	

						<li class="tablinks"  onclick="openCity(event, 'reviews','dot5')"    ><a href="#"> <img src="{{ asset('assets/mp2r/images/ic_Reviews.png') }}" class="pr-3 show"><img src="{{ asset('assets/mp2r/images/ic_Reviews-active.png') }}" class="pr-3 hide">REVIEWS<span class="dot hidden" style="display:none;" id="dot5"></span></a></li>

						<li class="tablinks"  ><a href="#"> <img src="{{ asset('assets/mp2r/images/ic_Reports.png') }}" class="pr-3 show"><img src="{{ asset('assets/mp2r/images/ic_Reports-active.png') }}" class="pr-3 hide">REPORTS <span class="dot hidden" style="display:none;"></span></a></li>

						<li class="tablinks"><a href=""> <img src="{{ asset('assets/mp2r/images/ic_Booking Requests.png') }}" class="pr-3 show"><img src="{{ asset('assets/mp2r/images/ic_Booking Requests.png') }}" class="pr-3 hide">SCHEDULE<span class="dot"></span></a></li>

						<li class="tablinks"><a href=""> <img src="{{ asset('assets/mp2r/images/ic_Booking Requests.png') }}" class="pr-3 show"><img src="{{ asset('assets/mp2r/images/ic_Booking Requests.png') }}" class="pr-3 hide">ADVERTISING<span class="dot"></span></a></li>
						
						<li class="tablinks"><a href="{{ route('sp-plan') }}"> <img src="{{ asset('assets/mp2r/images/ic_Advertising.png') }}" class="pr-3  show">  <img src="{{ asset('assets/mp2r/images/ic_Advertising-active.png') }}" class="pr-3  hide" >SUBSCRIPTION PLAN<span class="dot hidden" style="display:none;"></span></a>
						</li>
						<li class="tablinks"><a href=""> <img src="{{ asset('assets/mp2r/images/ic_Booking Requests.png') }}" class="pr-3 show"><img src="{{ asset('assets/mp2r/images/ic_Booking Requests.png') }}" class="pr-3 hide">SUPPORT<span class="dot"></span></a></li>

						<li class="tablinks"><a href=""> <img src="{{ asset('assets/mp2r/images/ic_Booking Requests.png') }}" class="pr-3 show"><img src="{{ asset('assets/mp2r/images/ic_Booking Requests.png') }}" class="pr-3 hide">PATIENT<span class="dot"></span></a></li>

						<!-- <li class="tablinks" ><a href="#"> <img src="{{ asset('assets/mp2r/images/ic_Terms & Conditions.png') }}" class="pr-3  show">  <img src="{{ asset('assets/mp2r/images/ic_ic_Terms & Conditions-active.png') }}" class="pr-3  hide"> Terms & Conditions <span class="dot hidden" style="display:none;"></span></a></li>

						<li class="tablinks" onclick="openCity(event, 'availability','dot1')" id="defaultOpen"  ><a href="#"> <img src="{{ asset('assets/mp2r/images/ic_Appointments.png') }}" class="pr-3 show"><img src="{{ asset('assets/mp2r/images/ic_Appointments-active.png') }}" class="pr-3 hide">  Appointments <span class="dot" style="display:none;" id="dot1" ></span></a></li>
						
						<li  class="tablinks"  onclick="openCity(event, 'booking_request','dot2')"   ><a href="{{ route('SPAppointment')}}"> <img src="{{ asset('assets/mp2r/images/ic_Booking Requests.png') }}" class="pr-3 show"><img src="{{ asset('assets/mp2r/images/ic_Booking Requests-active.png') }}" class="pr-3 hide"> Booking Requests <span class="dot hidden" style="display:none;" id="dot2"></span></a></li>

						
						<li class="tablinks" onclick="openCity(event, 'Patients','dot4')"   ><a href=""> <img src="{{ asset('assets/mp2r/images/ic_Patients.png') }}" class="pr-3 show"><img src="{{ asset('assets/mp2r/images/ic_Patients-active.png') }}" class="pr-3 hide">Patients <span class="dot hidden" style="display:none;" id="dot4"></span></a></li>
						
						<li class="tablinks" ><a href="#"> <img src="{{ asset('assets/mp2r/images/ic_Subscription Plans.png') }}"class="pr-3 show"><img src="{{ asset('assets/mp2r/images/ic_ic_Subscription Plans-active.png') }}" class="pr-3 hide"> Subscription Plans <span class="dot hidden" style="display:none;"></span></a></li>
						<li class="tablinks" ><a href="#"> <img src="{{ asset('assets/mp2r/images/ic_support.png') }}" class="pr-3  show"> <img src="{{ asset('assets/mp2r/images/ic_support-active.png') }}" class="pr-3  hide"> Support <span class="dot hidden" style="display:none;"></span></a></li>
						
						<li class="tablinks" ><a href="#"> <img src="{{ asset('assets/mp2r/images/ic_Advertising.png') }}" class="pr-3  show">  <img src="{{ asset('assets/mp2r/images/ic_Advertising-active.png') }}" class="pr-3  hide" > Advertising <span class="dot hidden" style="display:none;"></span></a></li> -->
						
						</div>
						</ul>						
					</div>
				</div>
				
			<!-- left side  end -->	
				
				<div class="col-lg-8 col-md-8 col-sm-8 tabcontent" id="availability">
					<section class="right-side mt-5">
					<div class="row align-items-center">
						<div class="col-md-12 col-sm-12">
						<!-- <h3 class="appointment">Booking Requests</h3> -->
						</div>
						
					</div>
					</section>
					
					<section class="wrapper wrap">
                    @if(isset($appointments) && count($appointments) > 0)
                    @foreach($appointments as $request)
                   
					<div class="row align-items-center m-0 wrap-height pt-3">
						<div class="col-md-7 col-lg-7 ">
							<div class="row m-0 align-items-center">
								<div class="col-md-3 p-0"><img src="{{isset($request->from_user->profile_image) ?  Storage::disk('spaces')->url('uploads/'.$request->from_user->profile_image) : asset('assets/mp2r/images/default.png') }}" class="imgt"  ></div>
									<div class="col-md-9 p-0">
									<p class="first-name"> {{isset($request->from_user->name) ? $request->from_user->name : '' }}</p>
									<p class="second-call"><span class="clr-call"> Call Request</span>{{ isset($request->bookingDateUTC) ? \Carbon\Carbon::parse($request->bookingDateUTC)->format('j F, Y h:i:s A'): ''}}</p>
									</div>
							</div>
						</div>
						<div class="col-md-5 col-lg-5 ">
						<button type="button" class="btn-begin2 ml-2">Chat</button>
						<button type="button" class="btn-begin2 reject ml-2 ">Reject</button>
						</div>
                    </div>
                    @endforeach
                    @else
                        <center>No record Found </center>
                    @endif

					</section>
					
					
					
					
				
				
				</div>
				
				<div class="col-lg-8 col-md-8 col-sm-8 tabcontent" id="booking_request">
					<section class="right-side mt-5">
					<div class="row align-items-center">
						<div class="col-md-12 col-sm-12">
						<!-- <h3 class="appointment">Booking Requests</h3> -->
						</div>
						
					</div>
					</section>
					
					<section class="wrapper wrap">
                    @if(isset($requests) && count($requests) > 0)
                    @foreach($requests as $request)
                   
					<div class="row align-items-center m-0 wrap-height pt-3">
						<div class="col-md-7 col-lg-7 ">
							<div class="row m-0 align-items-center">
								<div class="col-md-3 p-0"><img src="{{isset($request->from_user->profile_image) ?  Storage::disk('spaces')->url('uploads/'.$request->from_user->profile_image) : asset('assets/mp2r/images/default.png') }}" class="imgt" ></div>
									<div class="col-md-9 p-0">
									<p class="first-name"> {{isset($request->from_user->name) ? $request->from_user->name : '' }}</p>
									<p class="second-call"><span class="clr-call"> Call Request</span>{{ isset($request->bookingDateUTC) ? \Carbon\Carbon::parse($request->bookingDateUTC)->format('j F, Y h:i:s A'): ''}}</p>
									</div>
							</div>
						</div>
						<div class="col-md-5 col-lg-5 ">
						<button type="button" class="btn-begin2 ml-2">Chat</button>
						<button type="button" class="btn-begin2 reject ml-2 ">Reject</button>
						</div>
                    </div>
                    @endforeach
                    @else
                        <center>No record Found </center>
                    @endif

					</section>
					
					
					
					
				
				
				</div>

				<div class="col-lg-8 col-md-8 col-sm-8 tabcontent" id="Patients">
					<section class="right-side mt-5">
					<div class="row align-items-center">
						<div class="col-md-12 col-sm-12">
						<!-- <h3 class="appointment">Patients Requests</h3> -->
						</div>
						
					</div>
					</section>
					<section class="wrapper wrap">
					
                    @if(isset($patients) && count($patients) > 0)
                    @foreach($patients as $request)

				
					<div class="row align-items-center m-0 wrap-height pt-3">
						<div class="col-md-7 col-lg-7 ">
							<div class="row m-0 align-items-center">
								<div class="col-md-3 p-0"><img src="{{isset($request->profile_image) ?  Storage::disk('spaces')->url('uploads/'.$request->profile_image) : asset('assets/mp2r/images/default.png') }}" class="imgt" ></div>
									<div class="col-md-9 p-0">
									<p class="first-name"> {{isset($request->name) ? $request->name : '' }}</p>
									


									<p class="second-call"><span class="clr-call"> Call Request</span>{{ \Carbon\Carbon::parse($request->last_consult_date)->format('j F, Y h:i:s A') }}</p>
									</div>
							</div>
						</div>
						<div class="col-md-5 col-lg-5 ">
						<button type="button" class="btn-begin2 ml-2">Chat</button>
						<!-- <button type="button" class="btn-begin2 reject ml-2 ">Reject</button> -->
						</div>
                    </div>
                    @endforeach
                    @else
                        <center>No record Found </center>
                    @endif

					</section>
					
					
					
					
				
				
				</div>

				<div class="col-lg-8 col-md-8 col-sm-8 tabcontent" id="reviews">
					<section class="right-side mt-5">
					<div class="row align-items-center">
						<div class="col-md-12 col-sm-12">
						<!-- <h3 class="appointment">Patients Requests</h3> -->
						</div>
						
					</div>
					</section>
					<section class="wrapper wrap">
					
                    @if(isset($reviews) && count($reviews) > 0)
					@foreach($reviews as $review)
							 <div class="row align-items-center m-0 wrap-height border-0 pt-3">
								<div class="col-md-12 col-lg-12 ">
									<div class="row m-0 ">
										<div class="col-md-2 col-lg-1 pl-0"><img src="{{isset($review->user->profile_image) ?  Storage::disk('spaces')->url('uploads/'.$review->user->profile_image) : asset('assets/mp2r/images/default.png') }}" class="img-fluid pb-2"></div>
											<div class="col-md-10 col-lg-11 p-0">
											<p class="first-name">{{$review->user->name}}</p>
											<img src="{{ asset('assets/mp2r/images/ic_Star.png')}}"> <span class="rating">{{$review->rating}}</span>
											<p class="second-name pt-2">{{$review->comment}}</p>
											</div>
									</div>
								</div>	
                              </div>
                              @endforeach
							  
							
							  
							 							 
							 <!-- <a href="#" class="more-review"> View more reviews</a> -->
							 </div>
                    @else
                        <center>No record Found </center>
                    @endif

					</section>
					
					
					
					
				
				
				</div>


			</div>
		</div>
	
	
	</section>
	





@endsection
@section('script')
<script>
   function openCity(evt, cityName,dot1) {
	//   alert('a');
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";

  evt.currentTarget.className += " active";
  $('.dot').hide();
  //document.getElementsByClassName('dot').style.display = "none";
  document.getElementById(dot1).style.display = "inline-block";
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();
</script>
@endsection