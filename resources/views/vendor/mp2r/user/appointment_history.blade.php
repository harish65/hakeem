@extends('vendor.mp2r.layouts.index', ['title' => 'Manage Availability','header_after_login'=>true])
<?php $timezone = 'UTC'; if(isset($_COOKIE["timZone"])) 
$timezone =  $_COOKIE["timZone"]; ?>
@section('content')
<style>
   .tablinks{
      cursor: pointer;
   }
</style>

	<section class="main-height-clr bg-clr">
		<div class="container">
			<div class="row">
				<!-- left side  -->
				<div class="col-md-4 col-lg-4 col-sm-4">
					<div class="left-dashboard mt-5">
						<div class="side-head pb-0">
							<h3 class="">Menu</h3>
						</div>
						<hr/>
						<ul class="left-side-bar mb-3">
							
							<li class="active"  id="defaultOpen"><a style="color: black !important;" href="{{ route('user.AppointmentHistory')}}">Appointment</a></li>
		                  	<li class="tablinks" onclick="openCity(event, 'profile_detail')" id="defaultOpen" > Profile Details</li>
		                  	<li class="tablinks" onclick="openCity(event, 'notification')" id="defaultOpen" > Notification</li>
		                  	<li id="btn_login" data-id="{{ Auth::user()->id }}"  class="tablinks" onclick="openCity(event, 'change_password')">Change Password</li>
		                  	{{-- <li   class="tablinks" onclick="openCity(event, 'Tokyo1')">Update Category</li> --}}
		                  	<li  data-id="{{ Auth::user()->id }}"  class="tablinks" onclick="openCity(event, 'cookie_policy')">Cookie Policy</li>
		                  	<li  data-id="{{ Auth::user()->id }}"  class="tablinks" onclick="openCity(event, 'privacy_policy')">Privacy Policy</li>	
						</ul>						
					</div>
				</div>
				<!-- left side  end -->	
				<div class="col-lg-8 col-md-8 col-sm-8">
					<section class="right-side mt-5">
						<div class="row align-items-center">
							<div class="col-md-8 col-sm-6">
							<h3 class="appointment">Appointments</h3>
							</div>
							
							<div class="col-md-4 col-sm-6">
								<div class="appointment-date">
									<form>
									 <div class="form-group mb-0"> 
									 <input type="date" class="form-control border-0" id="usr">
									</div>
									</form>
								</div>
							</div>
						</div>
					</section>
					
					@foreach($booking_history as $booking_history_info)
					<section class="wrapper">
						<?php $date = Carbon\Carbon::parse($booking_history_info->booking_date,'UTC')->setTimezone($timezone);
	    					$booking_history_info->booking_date = $date->isoFormat('D MMMM YYYY, h:mm a');
	    					$booking_history_info->time = $date->isoFormat('h:mm a'); 
	    				?>
						<h2 class="date-time">{{ $booking_history_info->booking_date }} </h2>
						<p class="audio-call">Audio Call consultation</p>
						
						<div class="row align-items-center pt-3">
							<div class="col-md-6 col-lg-6 ">
							
							<div class="row align-items-center">
								<div class="col-md-3 "><img style="height: 72px;width: 100px;border-radius: 50%;" src="{{ $booking_history_info->sr_info->profile_image ? Storage::disk('spaces')->url('uploads/' . $booking_history_info->sr_info->profile_image) : asset('assets/mp2r/images/default.png') }}" class="img-fluid img-round-second"></div>
									<div class="col-md-9 p-0">
									<p class="first-name">{{ $booking_history_info->sr_info->name}}</p>
									@if($booking_history_info->requesthistory->status == 'pending')
										<p class="second-name" style="color: #0080C9"><a href="{{ route('User.ServiceproviderDetail',['id' => $booking_history_info->sr_info->categoryserviceProvider->category_id,'user_id' => $booking_history_info->sr_info->id ])}}">New</a></p>
										<p class="second-name"  style="color: #0080C9"><a href="{{ route('User.ServiceproviderDetail',['id' => $booking_history_info->sr_info->categoryserviceProvider->category_id,'user_id' => $booking_history_info->sr_info->id ])}}">Re-Schedue</a></p>
										@elseif($booking_history_info->requesthistory->status == 'canceled')
										<p class="second-name"  style="color: #0080C9"><a href="{{ route('User.ServiceproviderDetail',['id' => $booking_history_info->sr_info->categoryserviceProvider->category_id,'user_id' => $booking_history_info->sr_info->id ])}}">Book again</a></p>
										@elseif($booking_history_info->requesthistory->status == 'completed')
										<p class="second-name" style="color: #0080C9">Completed</p>
										<p class="second-name"  style="color: #0080C9"><a href="{{ route('User.ServiceproviderDetail',['id' => $booking_history_info->sr_info->categoryserviceProvider->category_id,'user_id' => $booking_history_info->sr_info->id ])}}">Book again</a></p>

									@endif
									</div>
								</div>
							</div>
							<div class="col-md-6 col-lg-6 ">
								@if($booking_history_info->requesthistory->status == 'pending')
									<button type="button" class="btn-begin">Cancel</button>
									@elseif($booking_history_info->requesthistory->status == 'in-progress')
									<button type="button" class="btn-begin">Cancel</button>
									@elseif($booking_history_info->requesthistory->status == 'completed')
									<button type="button" class="btn-begin" data-toggle="modal" data-target="#confirm-booking_{{ $booking_history_info->id }}">RATE</button>
								@endif
							</div>
						</div>
					</section>
					<div class="modal fade" id="confirm-booking_{{ $booking_history_info->id }}">
					    <div class="modal-dialog modal-md">
						    <div class="modal-content">
						        <!-- Modal Header -->
						        <div class="modal-header p-4 border-0">
						          <h4 class="modal-head">Please give Feedback</h4>
						          <button type="button" class="close p-0 m-0" data-dismiss="modal">&times;</button>
						        </div>
						        
						        <!-- Modal body -->
						        <div class="modal-body p-4">
						          	<img src="{{ asset('assets/images/ic_notification.png') }}" class="model-image-round">
								  	<p class="feedback-name">Terry Oliver</p>

										<ul class="nav star-nav justify-content-center my-3 ">
										  	@for($i=1;$i<=5;$i++)
										  		<li style="cursor: pointer;" ><img src="{{ asset('assets/images/ic_grey.png') }}"></li>
										  		<input id="rating_{{ $booking_history_info->id }}" class="chnagecolorReview" type="checkbox" name="rating" value="{{ $i }}" >
										  	@endfor
										</ul>
								  
										<div class="row m-0">
											<div class="col-md-11  mx-auto d-block">
												<div class="form-group">
												  <textarea class="form-control" name="comment" rows="5" id="comment_{{ $booking_history_info->id }}" placeholder="Write down your reviews"></textarea>
												  
												</div>
												<button data-consultantid="{{ $booking_history_info->sr_info->id }}" data-requestid="{{ $booking_history_info->id }}" type="submit" id="submitReviewButton" class="confirm-book w-100 ">Submit</button>
											</div>

						        		</div>
						    		</div>
					    		</div>
							</div>
						</div>
					@endforeach
				</div>
			</div>
		</div>
	</section>
	<!-- model -->

	
	  <!-- ic_yellow -->
	  <script type="text/javascript">
	  		$(document).on('click','.chnagecolorReview',function(){


	  			if ($(this).is(':checked')) {


	  				$(this).prev().find('img').attr('src',"{{ asset('assets/images/ic_yellow.png') }}");
	  			
	  			}else{

	  				$(this).prev().find('img').attr('src',"{{ asset('assets/images/ic_grey.png') }}");
	  			}

	  			
	  		});

	  		
	  </script>
@endsection