@if(sizeof($doctors)>0)
@foreach($doctors as $doctor)
<div class="doctor_box  mb-4">
    <div class="row align-items-center">
        <div class="col-lg-7 mb-3" id="filterData">
            <ul class="d-flex m-auto align-items-center justify-content-start">
                <li class="doctor_pic">
                            @if($doctor['doctordetail']->profile_image == '' &&  $doctor['doctordetail']->profile_image == null)
                                 <img src="{{asset('assets/care_connect_live/images/ic_upload profile img.png')}}" alt="">
                                 @else
                                 <img src="{{Storage::disk('spaces')->url('uploads/'.$doctor['doctordetail']->profile_image)}}" alt="">
                                @endif
                    <!-- <img src="{{Storage::disk('spaces')->url('uploads/'.$doctor['doctordetail']->profile_image)}}" alt=""> -->
                </li>
                <li class="doctor_detail pl-3">
                    <h4>@if($doctor['doctordetail']){{$doctor['doctordetail']->name}} @endif</h4>
                    <p>@if($doctor['categoryData']){{$doctor['categoryData']->name}} @endif  . @if($doctor['profile']){{$doctor['profile']->experience}} @endif </p>
                    <span class="rating vertical-middle">
                        <img src="{{asset('assets/care_connect_live/images/ic_Starx18.svg')}}" alt="">
                        <a class="review_txt" href="#"><i class="fas fa-star"></i> {{$doctor['rating']}} · {{$doctor['reviewcount']}} Reviews</a>
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
                                        @if(Config('client_connected') && Config::get('client_data')->domain_name == 'iedu')
                                        <span>AED {{ $servicetype['price'] }} /{{ $servicetype['duration'] }} mins</span>
                                        @else
                                        <span>₹ {{ $servicetype['price'] }} /{{ $servicetype['duration'] }} mins</span>
                                        @endif
                                       
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
                        <img class="position-absolute" src="{{asset('assets/care_connect_live/images/chat-icon.jpg')}}" alt="">
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
                            <input type="submit" class="default-btn w-100 radius-btn" name="Schedule" value="Choose Schedule">
                        <!-- </a> -->
                        </div>
                     </form> 
                </div>
            </div>
        </div>
    </div>
@endforeach
@else
<h4 style="text-align:center; margin-top:40px;"> {{'No Experts Yet' }} </h4>
@endif
