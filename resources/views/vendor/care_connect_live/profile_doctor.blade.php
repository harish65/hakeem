@extends('vendor.care_connect_live.layouts.dashboard', ['title' => 'Patient'])
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
                                 <img style="width:200px;" src="{{asset('assets/care_connect_live/images/ic_upload profile img.png')}}" alt="">
                                 @else
                                 <img style="width:200px;" src="{{Storage::disk('spaces')->url('uploads/'.$doctor_details->profile_image)}}" alt="">
                                @endif
                            <hr>
                        </div>
                        <ul class="doctor-list pb-2 text-left">
                            <li class="active"><a href="{{url('service_provider/profile')}}/{{Auth::user()->id}}"> Profile Details</a></li>
                            @if(Auth::user()->hasrole('service_provider'))
                            <li><a href="{{ url('service_provider/get_manage_availibilty')}}">Manage Availability</a></li>
                            <li><a href="{{ url('service_provider/get_manage_preferences')}}">Manage Preferences</a></li>
                            <li><a href="{{ url('service_provider/get_update_category')}}">Update Category</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="col-lg-8 profile-detail">
                   <div class="bg-them manage-profile">

                    <div class="row">
                        <div class="col-12 mb-3">
                            <ul class="d-flex m-auto align-items-start justify-content-between">                                
                                <li class="doctor_detail pl-3">
                                <h4>{{ ucwords($doctor_details['name']) }}</h4>
                                <p>  @if($doctor_details['categoryData']) {{ $doctor_details['categoryData']->name }} @else {{''}}  @endif · @if ($doctor_details['experience'] == '' || $doctor_details['experience'] == null)
                                            {{ 0 }} years
                                          @else
                                         {{$doctor_details['experience']}}+ years
                                         @endif of exp</p>
                                <p>Qualifications: {{isset($doctor_details->profile->qualification) ? $doctor_details->profile->qualification : '' }}</p>
                                @php $preference = $doctor_details->master_preferences; @endphp
                                @if($preference)
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
                                    <img src="{{asset('assets/care_connect_live/images/ic_Starx18.svg')}}" alt="">
                                    <a class="review_txt" href="#"><i class="fas fa-star"></i> {{$doctor_details['totalRating']}} · {{$doctor_details['reviewCount']}} Reviews</a>
                                </span>
                                @if(Auth::user()->hasrole('service_provider'))
                                <div class="custom-control custom-switch" style="padding-top:5% !important">
                                    <input type="checkbox" class="custom-control-input" value="1" 
                                    @if($doctor_details->manual_available)
                                        checked
                                    @endif
                                     id="toggleSwitch1">
                                    <label class="custom-control-label" for="toggleSwitch1">Select Availability</label>
                                </div>
                                <li>
                                    <a class="edit-right" href="{{ url('service_provider/editprofile/')}}/{{Auth::user()->id}}">Edit Profile</a>
                                </li>
                                @endif
                             </ul>
                             <hr class="my-4">
                             <ul class="detail-list border-bottom d-flex align-items-center justify-content-between mb-4 pb-4">
                             <li>
                                    <label class="mb-0 d-block">Patients</label>
                                     <span>{{$doctor_details['patientCount']}}</span>
                                </li>
                                <li>
                                    <label class="mb-0 d-block">Experience</label>
                                    <span>@if ($doctor_details['experience'] == '' || $doctor_details['experience'] == null)
                                            {{ 0 }} years
                                          @else
                                         {{$doctor_details['experience']}}+ years
                                         @endif
                                    </span>
                                </li>
                                <li>
                                    <label class="mb-0 d-block">Reviews</label>
                                    <span>{{$doctor_details['reviewCount']}}</span>
                                </li>
                            </ul>

                            <div class="border-bottom mb-4">
                                <div class="user-box">
                                    <label class="txt-14 d-block txt-14">Bio</label>
                                    <p class="text_16">{{$doctor_details['bio']}} <img class="ml-2 align-middle" src="{{asset('assets/images/cill.jpg')}}" alt=""></p>
                                </div>
                                <div class="user-box">
                                    <label class="d-block txt-14">Email ID</label>
                                    <p class="text_16">{{$doctor_details['email']}}</p>
                                </div>
                                <div class="user-box">
                                    <label class="d-block txt-14">Phone Number</label>
                                    <p class="text_16">{{$doctor_details['country_code']}}{{$doctor_details['phone']}}</p>
                                  
                                </div>
                                <div class="user-box">
                                    <label class="d-block txt-14">DOB</label>
                                    <p class="text_16">{{$doctor_details['bio']}}</p>
                                </div>
                            </div>

                            <div class="artical_review">
                                <h4>Reviews</h4>
                                @if($doctor_details->reviewCount != 0)
                                   
                                    @foreach($doctor_details->review as $reviews)

                                    <ul class="review-artical d-flex align-items-top mt-4 pt-lg-1">
                                        <li>
                                            @if($doctor_details->profile_image == '' ||  $doctor_details->profile_image == null)
                                            <img class="rounded-circle"  src="{{asset('assets/images/ic_upload profile img.png')}}" alt="" width="60px" height="60px">
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
                                    
                                    @if(sizeOf($doctor_details->review)>5)
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
@endsection