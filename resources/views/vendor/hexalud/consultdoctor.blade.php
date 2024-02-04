@if(sizeof($doctors)>0)
@foreach($doctors as $doctor)
<div class="doctor_box  mb-4">
    <div class="row align-items-center">
        <div class="col-lg-7 mb-3" id="filterData">
            <ul class="d-flex m-auto align-items-center justify-content-start">
                <li class="doctor_pic">
                            @if($doctor['doctordetail']->profile_image == '' &&  $doctor['doctordetail']->profile_image == null)
                                 <img src="{{asset('assetss/images/ic_upload profile img.png')}}" alt="">
                                 @else
                                 <img src="{{Storage::disk('spaces')->has('uploads/'.$doctor['doctordetail']->profile_image)?Storage::disk('spaces')->url('uploads/'.$doctor['doctordetail']->profile_image):asset('assetss/images/ic_upload profile img.png')}}" alt="">
                                @endif
                    <!-- <img src="{{Storage::disk('spaces')->url('uploads/'.$doctor['doctordetail']->profile_image)}}" alt=""> -->
                </li>
                <li class="doctor_detail pl-3">
                    <h4>@if($doctor['doctordetail']){{ucwords($doctor['doctordetail']->name)}} @endif</h4>
                    <!-- <p>@if($doctor['categoryData']){{$doctor['categoryData']->name}} @endif  . @if($doctor['profile']){{$doctor['profile']->experience}} @endif </p> -->
                    <p>  @if($doctor['categoryData']) {{ $doctor['categoryData']->name }} @else {{''}}  @endif · @if($doctor['profile']) @if ($doctor['profile']->working_since == '' || $doctor['profile']->working_since== null)
                                            {{ 0 }} years
                                          @else
                                          @php
                                            $exp_start = new DateTime($doctor['profile']->working_since);
                                            $today_date = new DateTime();
                                            @endphp
                                            {{@$exp_start->diff($today_date)->y}}+ years
                                         @endif @endif of exp</p>
                                <p>Qualifications: @if($doctor['profile']){{strtoupper($doctor['profile']->qualification)}} @endif</p>
                                @php $preference = $doctor['doctordetail']['master_preferences']; @endphp
                                @if(!empty($preference))
                                @foreach($preference as $prefer)

                                @if($prefer['preference_name'] == "Languages")
                                    <p>
                                        {{ $prefer['preference_name'] }}:

                                        @foreach(json_decode($prefer['options']) as  $key => $opt)
                                            {{ $opt->option_name }}
                                            @if($key + 1 != sizeof(json_decode($prefer['options'])))
                                            ,
                                            @endif
                                        @endforeach
                                    </p>
                                    @else
                                    @foreach($prefer['options'] as $opt)
                                    <p>
                                        {{ $prefer['preference_name'] }}:

                                        {{$opt->option_name}}
                                    </p>
                                    @endforeach
                                @endif
                                @endforeach
                                @endif

                    <span class="rating vertical-middle">
                        <img src="{{asset('assetss/images/ic_Starx18.svg')}}" alt="">
                        <a class="review_txt" href="javacript:void(0);" style="cursor: default;"><i class="fas fa-star"></i> {{$doctor['totalRating']}} · {{$doctor['reviewCount']}} Reviews</a>
                        <a class="view_profile d-block mt-2" href="{{url('service_provider/profile')}}/{{$doctor['doctordetail']->id}}">View Profile</a>
                    </span>
                </li>
            </ul>
        </div>
        <div class="col-lg-5">
            @if($doctor['getServices'])
                @foreach($doctor['getServices'] as $key => $servicetype)
                    @if($key == 0 || $key == 2 || $key == 4)
                        <div class="btn_group d-flex align-items-center justify-content-between text-16">
                            @foreach($doctor['getServices'] as $item_key => $servicetype)
                                @if($item_key == $key || $item_key == $key + 1)
                                    <a class="chat_btn" style="background-color:{{ $servicetype['color_code'] }}"
                                        data-categoryid="{{$doctor['categoryData']->id}}"
                                        data-userid="{{$doctor['doctordetail']->id}}"
                                        data-serviceid="{{$servicetype['service_id'] }}"
                                        data-url="{{url('/user/doctor_details')}}/{{$servicetype['sp_id']}}"
                                        >
                                        <label class="d-block m-0"> {{ $servicetype['service_name'] }}</label>
                                        <span>$ {{ $servicetype['price'] }} /{{ $servicetype['duration'] }} mins</span>
                                    </a>
                                @endif
                            @endforeach
                        </div>
                    @endif
                @endforeach
            @endif

        </div>
    </div>
</div>
 <!-- Enter-Contact Modal -->
 <div class="modal fade" id="booking" role="dialog">
        <div class="modal-dialog modal-md ">
            <div class="modal-content ">
                <div class="modal-header d-block pt-3 px-4 pb-0 border-0">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body px-4 pt-2 pb-3">
                    <div class="chat_head position-relative">
                        <img class="position-absolute" src="{{asset('assetss/images/chat-icon.jpg')}}" alt="">
                    </div>
                    <form class="enter-contact-form mt-3" action="{{url('/user/getSchedule')}}" method="get">
                    <input type="hidden" value="" name="category_id" class="categoryid">
                    <input type="hidden" value="" name="service_id" class="serviceid">
                    <input type="hidden" value="" name="doctor_id" class="userid">
                    <input type="hidden" value="schedule" name="schedule_type" class="schedule_type" />
                    <input type="hidden" value="{{$current_date}}" name="date" class="date">
                        <div class="form-group">

                           <button type="button" class="default-btn w-100 radius-btn border-btn meet_now"><span>Meet Now</span></button>

                        </div>
                        <div class="form-group">
                        <!-- <a class="schedule_chat"  href=""> -->
                            <input type="submit" class="default-btn w-100 radius-btn" name="Schedule" value="Schedule">
                        <!-- </a> -->
                        </div>
                     </form>
                </div>
            </div>
        </div>
    </div>
@endforeach
@else
<!-- <img src="{{asset('assets/healtcaremydoctor/images/no-experts.png')}}" />
<h4 style="text-align:center; margin-top:40px;"> {{'No Experts Yet' }} </h4> -->

<div class="row">
<div class="appointment-inner">

    <img src="{{asset('assets/healtcaremydoctor/images/no-experts.png')}}" />
    <div class="text">
    <h4 class="mb-4">No Experts Yet</h4>
    <p><!-- You don't have any Appointment till --></p>
    </div>

</div>
 </div>
@endif
