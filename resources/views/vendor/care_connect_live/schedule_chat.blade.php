@extends('vendor.care_connect_live.layouts.dashboard', ['title' => 'Patient'])
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
.disabled {
    pointer-events:none; //This makes it not clickable
    opacity:0.6;         //This grays it out to look disabled
}

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
							<h3 class="mb-lg-4 mb-3 pb-lg-3"><a class="text-black" href=""> <i class="fas fa-chevron-left left-back"></i> Choose Date & Time</a></h3>
							<ul class="d-flex m-auto align-items-center justify-content-start pb-lg-3">
                                <li class="doctor_pic">
								@if($sp_data->profile_image == '' &&  $sp_data->profile_image == null)
                                 <img src="{{asset('assets/care_connect_live/images/ic_upload profile img.png')}}" alt="">
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
								@if($preference)
                                @foreach($preference as $prefer)
                                @foreach($prefer['options'] as $opt)
                                <p>{{ $prefer['preference_name'] }}: {{$opt->option_name}}</p>
                                @endforeach
                                @endforeach
								@endif
                                <span class="rating vertical-middle">
                                    <img src="{{ asset('assets/care_connect_live/images/ic_Starx18.svg') }}" alt="">
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
									<h6 class="m-0"><img class="mr-3" src="{{asset('asstess/care_connect_live/images/morning_icon.png')}}" alt=""> Morning</h6>
									<i class="fas fa-chevron-up" style="font-size: 18px;"></i>
								</div>
								<ul class="time-slave d-flex align-items-center justify-content-between" id="morning_list">
									
									<li class="schedule_slots">
										<p> No Slots Available</p>
									</li>
								</ul>
							</div>

							<div class="day-shift pl-3 my-4 pb-4 border-bottom schedule_list">
								<div class="d-flex align-items-center justify-content-between mb-3 pt-2">									
									<h6 class="m-0"><img class="mr-3" src="{{asset('assets/care_connect_live/images/afternoon_icon.png')}}" alt=""> Afternoon</h6>
									<i class="fas fa-chevron-up" style="font-size: 18px;"></i>
								</div>
								<ul class="time-slave d-flex align-items-center justify-content-between" id="afternoon_list">
									<li class="schedule_slots">
										<p> No Slots Available</p>
									</li>
									
								</ul>
							</div>
							

							<div class="day-shift pl-3 my-4 pb-4 border-bottom schedule_list">
								<div class="d-flex align-items-center justify-content-between mb-3 pt-2">									
									<h6 class="m-0"><img class="mr-3" src="{{asset('assets/care_connect_live/images/evening_icon.png')}}" alt="">Evening</h6>
									<i class="fas fa-chevron-up" style="font-size: 18px;"></i>
								</div>
								<ul class="time-slave d-flex align-items-center justify-content-between" id="evening_list">
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
	<script src="{{asset('assets/care_connect_live/js/jquery-min.js')}}"></script>
<script src="{{asset('assets/care_connect_live/js/slick.min.js')}}"></script>
<script src="{{asset('assets/care_connect_live/js/bootstrap.min.js')}}"></script>
	<script>
		var _token = "{{ csrf_token() }}";
       var _get_booking = "{{ url('/user/doctor_details/{$doctor_id}/{$service_id')}}";
	 var _get_slots_url = "{{ url('/user/getSlots') }}";
	 

	   $('#schedules .schedule_date') .on('click',function(e){
            e.preventDefault();
            $('.schedule_date').removeClass("active");
            $(this).addClass("active");
           
            $("#morning_list").empty();
            $("#afternoon_list").empty();
            $("#evening_list").empty();

            var date = $(this).attr('data-val');
            var doctor_id = $('.doctor_id').val();
            var category_id = $('.category_id').val();
            var service_id = $('.service_id').val();
            $('.date').val(date);
            $.get(_get_slots_url, {
                "_token": _token,
                "date": date,
                "doctor_id": doctor_id,
                "category_id": category_id,
                "service_id": service_id                
            }).done(function(data){
                data = JSON.parse(data);
                console.log(data.morning);
                if(data.morning.length > 0)
                {
                    $.each(data.morning, function(key, item){
                        if(item.available == true){
                            var _item = `<li class="schedule_slots" data-val= "`+item.time+`"> 
                                <a href="#">`+item.time+`</a>
                            </li>`;
                        }
                        else{
                            var _item = `<li class="disabled schedule_slots" data-val= "`+item.time+`">
                                <a href="#">`+item.time+`</a>
                            </li>`;
                        }
                        $("#morning_list").append(_item);
                    });
                }
                else
                {
                    var _item = `
                    <li>
						<p> No Slots Available</p>
					</li>
                    `;
                    $("#morning_list").append(_item);
                }

                if(data.afternoon.length > 0)
                {
                    $.each(data.afternoon, function(key, item){
                        if(item.available == true){
                            var _item = `<li class="schedule_slots" data-val="`+item.time+`">
                                <a href="#">`+item.time+`</a>
                            </li>`;
                        }
                        else{
                            var _item = `<li class="disabled schedule_slots" data-val= "`+item.time+`">
                                <a href="#">`+item.time+`</a>
                            </li>`;
                        }
                        $("#afternoon_list").append(_item);
                    });
                }
                else
                {
                    var _item = `
                    <li>
						<p> No Slots Available</p>
					</li>
                    `;
                    $("#afternoon_list").append(_item);
                }

                if(data.evening.length > 0)
                {
                    $.each(data.evening, function(key, item){
                        if(item.available == true){
                            var _item = `<li class="schedule_slots" data-val="`+item.time+`">
                                <a href="#">`+item.time+`</a>
                            </li>`;
                        }
                        else{
                            var _item = `<li class="active schedule_slots" data-val="`+item.time+`">
                                <a href="#">`+item.time+`</a>
                            </li>`;
                        }
                        $("#evening_list").append(_item);
                    });
                }
                else
                {
                    var _item = `
                    <li>
						<p> No Slots Available</p>
					</li>
                    `;
                    $("#evening_list").append(_item);
                }

            });
    });
   
    $('#schedules li.schedule_date:nth-child(1) a').trigger("click");
	$("body").on("click", "li.schedule_slots", function(e) {
        e.preventDefault();

        $('.slot_time').val('');
        $('li.schedule_slots').removeClass('active');
        var slot_time = $(this).attr('data-val');
        // alert(slot_time);
        var data =  $('.slot_time').val(slot_time); 
        $(this).addClass('active');
    });
    
    
	</script>
@endsection