@extends('vendor.tele.layouts.dashboard', ['title' => 'Patient'])
@section('content')
 <!-- Offset Top -->
 <div class="offset-top"></div>
   <!-- Manage Availability-Doctor Section -->
   <section class="profile-wrapper edit-profile mb-lg-5 py-5">
        <div class="container">
            <div class="row">
                <div class="col-12 mb-5">
                @if(session('status.success'))
                                <div class="alert alert-outline alert-success custom_alert">
                                    {{ session('status.success') }}
                                </div>
                     @endif
                    <h1>Account</h1>


                </div>

                <div class="col-lg-4 pr-lg-0">
                    <div class="bg-them border-0 text-center mb-4">
                        <div class="position-relative px-5 pt-5">
                             @if($doctor_details->profile_image == '' &&  $doctor_details->profile_image == null)
                                 <img class="user-profile showImg" src="{{asset('assetss/images/ic_upload profile img.png')}}" alt="">
                                 @else
                                 <img class="user-profile showImg" src="{{Storage::disk('spaces')->url('uploads/'.$doctor_details->profile_image)}}" alt="">
                                @endif
                            <hr>
                        </div>
                        @if(Auth::user()->hasrole('service_provider'))
                        <ul class="doctor-list pb-2 text-left">
                            <li class="active"><a href="{{url('service_provider/profile')}}/{{Auth::user()->id}}"> Profile Details</a></li>
                            <li><a href="{{ url('service_provider/get_manage_availibilty')}}">Manage Availability</a></li>
                            <li><a href="{{ url('service_provider/get_manage_preferences')}}">Manage Preferences</a></li>
                            <li><a href="{{ url('service_provider/get_update_category')}}">Update Category</a></li>
                        </ul>
                        @endif
                    </div>
                </div>
                <div class="col-lg-8 profile-detail">
                   <div class="bg-them manage-profile">

                    <div class="row">
                        <div class="col-12 mb-3">
                            <div class='row'>
                                <div class="col-lg-6">
                                    <ul class="d-flex m-auto align-items-start justify-content-between">
                                        <li class="doctor_detail pl-3">
                                        <h4>{{ ucwords($doctor_details['name']) }}</h4>
                                        <p>  @if($doctor_details['categoryData']) {{ $doctor_details['categoryData']->name }} @else {{''}}  @endif · @if (@$doctor_details->profile->working_since == '' || @$doctor_details->profile->working_since == null)
                                                    {{ 0 }} years
                                                  @else
                                                @php
                                                $exp_start = new DateTime($doctor_details->profile->working_since);
                                                $today_date = new DateTime();
                                                  @endphp
                                                 {{@$exp_start->diff($today_date)->y}}+ years
                                                 @endif of exp</p>
                                        <p>Qualifications: {{ strtoupper(@$doctor_details->profile->qualification) }}</p>
                                        @php $preference = $doctor_details->master_preferences; @endphp
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
                                        <span class="rating vertical-middle">
                                            <img src="images/ic_Starx18.svg" alt="">
                                            <a class="review_txt" href="#"><i class="fas fa-star"></i> {{$doctor_details['totalRating']}} · {{$doctor_details['reviewCount']}} Reviews</a>
                                        </span>
                                        </li>
                                        @if(Auth::user()->hasrole('service_provider'))
                                        <li>
                                            <a class="edit-right" href="{{ url('service_provider/editprofile/')}}/{{Auth::user()->id}}">Edit Profile</a>
                                        </li>
                                        @endif
                                     </ul>
                                 </div>
                                 <div class="col-lg-6">
                                    @if(!Auth::user()->hasrole('service_provider'))
                                    @if($doctor_details['services'])
                                        @foreach($doctor_details['services'] as $key => $servicetype)
                                            @if($key == 0 || $key == 2 || $key == 4)
                                                <div class="btn_group d-flex align-items-center justify-content-between text-16">
                                                    @foreach($doctor_details['services'] as $item_key => $servicetype)
                                                        @if($item_key == $key || $item_key == $key + 1)
                                                            <a class="chat_btn" style="background-color:{{ $servicetype['color_code'] }}"
                                                                data-categoryid="{{$doctor_details['categoryData']->id}}"
                                                                data-userid="{{$doctor_details->id}}"
                                                                data-serviceid="{{$servicetype['service_id'] }}"
                                                                data-url="{{url('/user/doctor_details')}}/{{$servicetype['sp_id']}}"
                                                                >
                                                                <label class="d-block m-0"> {{ $servicetype['service_name'] }}</label>
                                                                <span>₹ {{ $servicetype['price'] }} /{{ $servicetype['duration'] }} mins</span>
                                                            </a>
                                                        @endif
                                                    @endforeach
                                            </div>
                                        @endif
                                    @endforeach
                                @endif
                                @endif
                                 </div>
                            </div>
                             <hr class="my-4">
                             <ul class="detail-list border-bottom d-flex align-items-center justify-content-between mb-4 pb-4">
                             <li>
                                    <label class="mb-0 d-block">Patients</label>
                                     <span>{{$doctor_details['patientCount']}}</span>
                                </li>
                                <li>
                                    <label class="mb-0 d-block">Experience</label>
                                    <span>@if (@$doctor_details->profile->working_since == '' || @$doctor_details->profile->working_since == null)
                                            {{ 0 }} years
                                          @else
                                          @php
                                            $exp_start = new DateTime($doctor_details->profile->working_since);
                                            $today_date = new DateTime();
                                            @endphp
                                            {{@$exp_start->diff($today_date)->y}}+ years
                                         @endif
                                    </span>
                                </li>
                                <li>
                                    <label class="mb-0 d-block">Reviews</label>
                                    <span>{{$doctor_details['reviewCount']}}</span>
                                </li>
                            </ul>

                            <div class="border-bottom mb-4">
                                @if($doctor_details->bio != "" && !is_null($doctor_details->bio))
                                <div class="user-box">
                                    <label class="txt-14 d-block txt-14">Bio</label>
                                    <p class="text_16">{{$doctor_details['bio']}}</p>
                                </div>
                                @endif
                                @if($doctor_details->email != "" && !is_null($doctor_details->email))
                                <div class="user-box">
                                    <label class="d-block txt-14">Email ID</label>
                                    <p class="text_16">{{$doctor_details['email']}}</p>
                                </div>
                                @endif
                                @if($doctor_details->phone != "" && !is_null($doctor_details->phone))
                                <div class="user-box">
                                    <label class="d-block txt-14">Phone Number</label>
                                    <p class="text_16">{{$doctor_details['country_code']}}{{$doctor_details['phone']}}</p>
                                </div>
                                @endif
                                <div class="user-box">
                                    <label class="d-block txt-14">DOB</label>
                                    <p class="text_16">{{@$doctor_details->profile->dob}}</p>
                                </div>
                            </div>

                            <div class="artical_review">
                                <h4>Reviews</h4>
                                @if($doctor_details)

                                    @foreach(($doctor_details->review ?? []) as $reviews)

                                    <ul class="review-artical d-flex align-items-top mt-4 pt-lg-1">
                                        <li>
                                            @if($doctor_details->profile_image == '' ||  $doctor_details->profile_image == null)
                                            <img class="rounded-circle"  src="{{asset('assetss/images/ic_upload profile img.png')}}" alt="" width="60px" height="60px">
                                            @else
                                            <img class="rounded-circle"  src="{{Storage::disk('spaces')->url('uploads/'.$doctor_details->profile_image)}}" alt="" width="60px" height="60px">
                                            @endif
                                        </li>
                                        <li class="pl-3">
                                            <label class="d-block">{{$doctor_details->name}}</label>
                                            <a class="review_txt d-block my-2" href="#"><i class="fas fa-star"></i> <span>{{$reviews->rating}}</span> </a>
                                            <article>
                                                <p>{{$reviews->comment}}</p>
                                            </article>
                                        </li>
                                    </ul>
                                    @endforeach

                                    @if(sizeOf($doctor_details->review ?? [])>5)
                                     <a class="more_review d-block" href="#"> View more reviews</a>
                                     @endif
                                @endif
                            </div>
                        </div>
                    </div>

                   </div>

                </div>
            </div>
        </div>
    </section>
 <!-- Enter-Contact Modal -->
 @php
    $date=\Carbon\Carbon::now()->format('d-m-Y');
 @endphp
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
                    <input type="hidden" value="{{$current_date ?? $date}}" name="date" class="date">
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
@endsection
