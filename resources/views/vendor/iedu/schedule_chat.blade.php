@extends('vendor.iedu.layouts.index', ['title' => 'Schedule','show_footer'=>true])
@section('content')
<style>
/* schedule-chat Css */

h3 {
    opacity: 0.8;
    color: #000000;
    font-size: 24px;
    font-weight: 600;
    letter-spacing: 0;
    line-height: 24px;
}

.text-black {
    color: #000;
}

.schedule-body, .questions-body {
    background: #E8E8E8;
    padding: 61px 0;
}

.schedule-chat-wrapper .expirence-form-2 {
    padding: 30px 60px 40px 40px;
    border-radius: 6px;
    background-color: #FFFFFF;
    box-shadow: 0 1px 4px 0 rgba(0, 0, 0, 0.04);
}

.days-list li {
    margin-right: 40px;
}

.days-list li:last-child {
    margin-right: 0;
}

.bg-gray {
    z-index: 1;
}

.bg-gray::after {
    content: "";
    width: 100%;
    height: 100%;
    opacity: 0.1;
    background-color: rgba(250, 99, 115, 0.51);
    position: absolute;
    left: 0;
    top: 0;
    z-index: -1;
}

.day-shift .fa-chevron-up {
    color: rgba(250, 99, 115, 0.51);
}

.days-list li {
    display: inline-block;
}

.days-list li {
    opacity: .5;
    color: #282525;
    letter-spacing: 0;
    line-height: 20px;
    position: relative;
}

.days-list li a span {
    font-size: 14px;
    font-family: 'Campton';
    display: block;
    color: #000;
}

.days-list li a label {
    font-family: 'Campton';
    font-weight: 500;
    font-size: 18px;
    color: #282525;
    cursor: pointer;
}

.days-list li a:after {
    content: "";
    width: 100%;
    height: 2px;
    background: #2C358D;
    display: block;
    position: absolute;
    bottom: -16px;
    opacity: 0;
}
.left-back {
    font-size: 20px;
    color: #000;
    padding-right: 30px;
}

.time-slave li {
    width: 15%;
}

.time-slave li a {
    border: 1px solid #A1A1A1;
    border-radius: 60px;
    text-align: center;
    display: block;
    padding: 4.5px 5px;
    color: #282525;
    font-size: 14px;
    overflow: hidden;
}
ul>li
{
    list-style:none;
}

.schedule_slots
{
    list-style:none;
}

.time-slave li.active a {
    border: 1px solid blue;
    background-color: blue;
    color: #fff;
}

.big-btn {
    width: 344px;
    max-width: 100%;
}

.days-list li.active, .days-list li:hover, .days-list li:hover a:after, .days-list li.active a:after {
    opacity: 1;
}

.rotate img {
    -webkit-transform: rotate(-180deg);
    -moz-transform: rotate(-180deg);
    -ms-transform: rotate(-180deg);
    -o-transform: rotate(-180deg);
    transform: rotate(-180deg);
}


#schedules {
	width: 100%;
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

<!-- Bannar Section -->
<section class="header-height">
  <div class="container">
    <div class="row d-flex align-items-center">
      <!-- <div class="col-md-12">
        <div class="breadcrum mb-4">
          <a href="{{url('web/courses')}}">Home</a><span class="mr-2 ml-2">/</span>
          <a @if(Request::get('booking_type')=='course') href="{{url('web/courses')}}" @else href="{{url('web/emsats')}}" @endif>{{ucwords(Request::get('booking_type'))}}</a><span class="mr-2 ml-2">/</span>
          <a @if(Request::get('booking_type')=='course') href="{{url('experts/listing/1')}}" @else href="{{url('expert/listing/1')}}" @endif >Choose a Tutor</a><span class="mr-2 ml-2">/</span>
          <a class="active" href="#">choose a Schedule</a>
        </div>
      </div> -->

      <div class="col-md-12">
        <div class="row">

          <div class="col-md-12">
            <div class="schedule-booking mt-0">
              <h4>Schedule Meeting</h4>
              <hr class="mt-0 mb-0">

              <form class="expirence-form-2 bg-white radius-6" action="{{ url('user/expert_details') }}/{{Request::get('expert_id')}}/{{$service_id}}" id="schedule_availbility" method="get">

							<ul class="d-flex m-auto align-items-center justify-content-start p-3">
                                <li class="doctor_pic">
								@if($sp_data->profile_image == '' &&  $sp_data->profile_image == null)
                                 <img src="{{asset('assets/iedu/images/dummy_profile.webp')}}" alt="" height="120px" width="120px">
                                 @else
                                 <img src="{{Storage::disk('spaces')->url('uploads/'.$sp_data->profile_image)}}" alt="" height="120px" width="120px">
                                @endif
                                </li>
                                <li class="doctor_detail md-3 pl-3">
								<h5>{{ $sp_data['name'] }}</h5>
                                @php
                                    $date =$sp_data->profile->working_since
                                @endphp
                                <p class="text-s">{{ $sp_data['categoryData']->name }}  ·
                                    {{-- @if ($sp_data['experience'] == '' || $sp_data['experience'] == null)
                                            {{ 0 }} years
                                          @else
                                         {{$sp_data['experience']}}+ years
                                         @endif  --}}
                                         @if($sp_data->profile)
                                         {{\Carbon\Carbon::parse($sp_data->profile->working_since)->age}}
                                         @else
                                         0
                                         @endif
                                         year of exp</p>
                                <p class="text-s">Qualifications: {{$sp_data->profile->qualification}}</p>
                                @php $preference = $sp_data->master_preferences; @endphp
								@if($preference)
                                @foreach($preference as $prefer)
                                @foreach($prefer['options'] as $opt)
                                <p class="text-s"   >{{ $prefer['preference_name'] }}: {{$opt->option_name}}</p>
                                @endforeach
                                @endforeach
								@endif
                                <span class="rating vertical-middle">
                                    <img src="{{ asset('assets/iedu/images/ic_Starx18.svg') }}" alt="">
                                    <a class="review_txt" href="#"><i class="fa fa-star"></i> {{$sp_data['totalRating']}} · {{$sp_data['reviewCount']}} Reviews</a>
                                </span>
                                 </span>
                                </li>
                             </ul>
                             <hr class="mt-0 mb-0">

                             <h4 class="mb-lg-4 mb-3 pb-lg-3"><a class="text-white" href=""> <i class="fa fa-chevron-left left-back"></i> Choose Date & Time</a></h4>

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
                            <input type="hidden" value="{{ Request::get('booking_type') }}" name="booking_type" class="booking_type" />
							<input type="hidden" value="{{ Request::get('booking_id') }}" name="booking_id" class="booking_id" />
                            <input type="hidden" value="{{ Auth::user()->id }}" name="userid" class="userid" />
							<input type="hidden" value=" {{ request()->get('request_id') }}" name="request_id" class="request_id" />
							<input type="hidden" value="{{ $service_id }}" name="service_id" class="service_id" />
                            <input type="hidden" value="{{ $category_id }}" name="category_id" class="category_id" />
							<input type="hidden" value="{{ Request::get('expert_id') }}" name="doctor_id" class="doctor_id" />
							<input type="hidden" value="schedule" name="schedule_type" class="schedule_type" />
							<input type="hidden" value="" name="slot_time" class="slot_time" />
							<input type="hidden" value="" name="date" class="date" />
							<div class="day-shift pl-3 my-4 pb-4 border-bottom schedule_list">
								<div class="d-flex align-items-center justify-content-between mb-3 pt-2">
									<h6 class="m-0"><img class="mr-3" src="{{asset('assets/iedu/images/morning_icon.png')}}" alt=""> Morning</h6>
									<i class="fa fa-chevron-up" style="font-size: 18px;"></i>
								</div>
								<ul class="time-slave d-flex align-items-center justify-content-between" id="morning_list">

									<li class="schedule_slots">
										<p> No Slots Available</p>
									</li>
								</ul>
							</div>

							<div class="day-shift pl-3 my-4 pb-4 border-bottom schedule_list">
								<div class="d-flex align-items-center justify-content-between mb-3 pt-2">
									<h6 class="m-0"><img class="mr-3" src="{{asset('assets/iedu/images/afternoon_icon.png')}}" alt=""> Afternoon</h6>
									<i class="fa fa-chevron-up" style="font-size: 18px;"></i>
								</div>
								<ul class="time-slave d-flex align-items-center justify-content-between" id="afternoon_list">
									<li class="">
										<p> No Slots Available</p>
									</li>

								</ul>
							</div>


							<div class="day-shift pl-3 my-4 pb-4 border-bottom schedule_list">
								<div class="d-flex align-items-center justify-content-between mb-3 pt-2">
									<h6 class="m-0"><img class="mr-3" src="{{asset('assets/iedu/images/evening_icon.png')}}" alt="">Evening</h6>
									<i class="fa fa-chevron-up" style="font-size: 18px;"></i>
								</div>
								<ul class="time-slave d-flex align-items-center justify-content-between" id="evening_list">
									<li class="schedule_slots">
									<p> No Slots Available</p>
									</li>

								</ul>
							</div>


							<div class="row mt-lg-5 mt-4 text-center">
								<div class="col">

								<input  type="submit" name="next" value="Schedule a  Booking" style="margin:auto;color:#ffff;font-weight:bold;display:none; " class="btn mt-5 mb-3 full-width no-box-shaddow schedule_booking_btn" />

								</div>
							</div>
						</form>

              </div>
            </div>

            </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

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
                // console.log(data);

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
    $('.schedule_booking_btn').hide();
    $('#schedules li.schedule_date:nth-child(1) a').trigger("click");
	$("body").on("click", "li.schedule_slots", function(e) {
        e.preventDefault();

        $('.slot_time').val('');
        $('li.schedule_slots').removeClass('active');

        var slot_time = $(this).attr('data-val');
        // alert(slot_time);
        var data =  $('.slot_time').val(slot_time);
        $(this).addClass('active');
        $('.schedule_booking_btn').show();
    });


</script>
@endsection
