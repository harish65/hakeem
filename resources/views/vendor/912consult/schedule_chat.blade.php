@extends('vendor.912consult.layouts.dashboard', ['title' => 'Patient'])
@section('content')

<style>

#schedules {
	width: 640px;
	overflow-x: scroll;
	overflow-y: hidden;
}

.days-list li {
	margin-right: 25px;
}

.days-list li a {
	display: block;
	width: 100px;
}
.disabled{
	pointer-events: none;
    cursor: not-allowed;
    opacity: 0.5;
}
.time-slave{flex-wrap:wrap;}
.time-slave li{margin:5px 10px 5px 0px;}
</style>

 <!-- Offset Top -->
 <div class="offset-top"></div>
   <!-- Page Header Section -->
   <div class="schedule-body">
    <!-- Schedule Chat One Section -->
		<section class="schedule-chat-wrapper">
			<div class="container">
				<div class="row">
					<div class="col">

						<form class="expirence-form-2 bg-white radius-6" action="{{ url('user/doctor_details') }}/{{$doctor_id}}/{{$service_id}}" id="schedule_availbility" method="get">
							<h3 class="mb-lg-4 mb-3 pb-lg-3"><a class="text-black" href="{{ url()->previous() }}"> <i class="fas fa-chevron-left left-back"></i> Choose Date & Time</a></h3>
							<ul class="d-flex m-auto align-items-center justify-content-start pb-lg-3">
                                <li class="doctor_pic">
								@if($sp_data->profile_image == '' &&  $sp_data->profile_image == null)
                                 <img src="{{asset('assetss/images/ic_upload profile img.png')}}" alt="">
                                 @else
                                 <img src="{{Storage::disk('spaces')->url('uploads/'.$sp_data->profile_image)}}" alt="">
                                @endif
                                </li>
                                <li class="doctor_detail pl-3">
								<h4>{{ $sp_data['name'] }}</h4>
                                <p>{{ $sp_data['categoryData']->name }}  ·  @if ($sp_data['experience'] == '' || $sp_data['experience'] == null)
                                            {{ 0 }} years
                                          @else
                                         {{$sp_data['experience']}}+ years
                                         @endif of exp</p>
                                <p>Qualifications: {{$sp_data->profile->qualification}}</p>
                                @php $preference = $sp_data->master_preferences; @endphp
                                @foreach($preference as $prefer)
                                @foreach($prefer['options'] as $opt)
                                <p>{{ $prefer['preference_name'] }}: {{$opt->option_name}}</p>
                                @endforeach
                                @endforeach
                                <span class="rating vertical-middle">
                                    <img src="images/ic_Starx18.svg" alt="">
                                    <a class="review_txt" href="#"><i class="fas fa-star"></i> {{$sp_data['totalRating']}} · {{$sp_data['reviewCount']}} Reviews</a>
                                </span>
                                 </span>
                                </li>
                             </ul>

							<div  class="bg-gray position-relative p-3 mt-4">
								<ul class="days-list d-flex align-items-center" id="schedules">
									@if($data)
										@foreach($data as $datas)
										@php $showDate = date('d M, y', strtotime($datas['date'])); @endphp

									<li class="schedule_date" data-val = "{{$datas['date']}}">
										<a href="" >
										<span>{{ $datas['day']}}</span>
										<label class="m-0">{{ $showDate }}</label>
									</a>
									</li>
										@endforeach
									@endif

								</ul>
							</div>
							<input type="hidden" value="{{ Auth::user()->id }}" name="userid" class="userid" />
							<input type="hidden" value=" {{ request()->get('request_id') }}" name="request_id" class="request_id" />
							<input type="hidden" value="{{ $service_id }}" name="service_id" class="service_id" />
                            <input type="hidden" value="{{ $category_id }}" name="category_id" class="category_id" />
							<input type="hidden" value="{{ $doctor_id }}" name="doctor_id" class="doctor_id" />
							<input type="hidden" value="schedule" name="schedule_type" class="schedule_type" />
							<input type="hidden" value="" name="slot_time" class="slot_time" />
							<input type="hidden" value="" name="date" class="date" />
							<div class="day-shift pl-3 my-4 pb-4 border-bottom schedule_list">
								<div class="d-flex align-items-center justify-content-between mb-3 pt-2">
									<h6 class="m-0"><img class="mr-3" src="{{asset('asstess/images/morning_icon.png')}}" alt=""> Morning</h6>
									<i class="fas fa-chevron-up" style="font-size: 18px;"></i>
								</div>
								<ul class="time-slave d-flex align-items-center" id="morning_list">

									<li class="schedule_slots">
										<p> No Slots Available</p>
									</li>
								</ul>
							</div>

							<div class="day-shift pl-3 my-4 pb-4 border-bottom schedule_list">
								<div class="d-flex align-items-center justify-content-between mb-3 pt-2">
									<h6 class="m-0"><img class="mr-3" src="{{asset('assetss/images/afternoon_icon.png')}}" alt=""> Afternoon</h6>
									<i class="fas fa-chevron-up" style="font-size: 18px;"></i>
								</div>
								<ul class="time-slave d-flex align-items-center " id="afternoon_list">
									<li class="schedule_slots">
										<p> No Slots Available</p>
									</li>

								</ul>
							</div>


							<div class="day-shift pl-3 my-4 pb-4 border-bottom schedule_list">
								<div class="d-flex align-items-center justify-content-between mb-3 pt-2">
									<h6 class="m-0"><img class="mr-3" src="{{asset('assetss/images/evening_icon.png')}}" alt="">Evening</h6>
									<i class="fas fa-chevron-up" style="font-size: 18px;"></i>
								</div>
								<ul class="time-slave d-flex align-items-center" id="evening_list">
									<li class="schedule_slots">
									<p> No Slots Available</p>
									</li>

								</ul>
							</div>


							<div class="row mt-lg-5 mt-4 text-center">
								<div class="col">
								<input type="submit" name="next" value="Next" class="default-btn big-btn text-center radius-btn" />

								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
        </section>
    </div>
	<script>
		var _token = "{{ csrf_token() }}";
       var _get_booking = "{{ url('/user/doctor_details/{$doctor_id}/{$service_id')}}";
	 var _get_slots_url = "{{ url('/user/getSlots') }}";

	 // console.log(_get_slots_url);
	</script>
@endsection
