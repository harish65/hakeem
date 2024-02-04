@extends('vendor.mp2r.layouts.index', ['title' => 'Manage Availability','header_after_login'=>true])
@section('css')
@endsection
@section('content')
<style>
    .tablinks {
        cursor: pointer;
    }
    .second-name p{
        font-size: 16px !important;
    }
</style>
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<section class="main-height-clr bg-clr" id="manage_avail">
    <div class="container">
        <h2 class="heading-top">Account</h2>
        <div class="row">
            <!-- left side  -->
            <div class="col-md-4 col-lg-4 col-sm-4">
                <div class="left-dashboard2 mt-4">
                    <div class="side-head p-4">
                        <img id="OpenImgUpload"  src="{{ Auth()->user()->profile_image ? Storage::disk('spaces')->url('uploads/' . Auth()->user()->profile_image) : asset('assets/mp2r/images/default.png') }}" class="img-fluid mx-auto d-block" style="height: 192px;width: 192px;border-radius: 50%;">
                        <form id="user_image_upload" enctype="multipart/form-data" method="post">
                          <input name="profile_image" type="file" id="imgupload" style="display:none" accept="image/*" /> 
                          <input type="submit" name="" id="submitfile" style="display: none;">
                        </form>
                    </div>
                    <ul class="left-side-bar mb-3">
                        <div class="tab"> 
                        
                            <li class="tablinks" onclick="openCity(event, 'manage_availability')"  id="manage_availability_1" >Manage Availability</li>
                            <li class="tablinks" ><a href="{{ url('/Sp/ChatHistoryPage?userid='.Auth::user()->id.'&nickname='.Auth::user()->name)}}"  style="color: black;">Chat</a></li>
                            <li class="tablinks" id="notification_1"  onclick="openCity(event, 'notification')">Notification</li>
                            <li class="tablinks" ><a style="color: #212529" href="{{ url('service_provider/Appointment') }}">Service Provider Dashboard</a></li>
                            <li class="tablinks" id="profile_detail_1" onclick="openCity(event, 'profile_detail')"> Profile Details</li>
                            <li class="tablinks" id="change_password_1" onclick="openCity(event, 'change_password')">Change Password</li>
                            <li class="tablinks" id="update_category_1" onclick="openCity(event, 'update_category')">Update Category</li>
                            <li  data-id="{{ Auth::user()->id }}" id="cookie_policy_1"  class="tablinks" onclick="openCity(event, 'cookie_policy')">Cookie Policy</li>
                            <li  data-id="{{ Auth::user()->id }}" id="privacy_policy_1"  class="tablinks" onclick="openCity(event, 'privacy_policy')">Privacy Policy</li>
                        </div>
                    </ul>
                </div>
            </div>
            <div id="manage_availability" class="col-lg-8 col-md-8 col-sm-12 tabcontent editmanage" style="display: none;">    
                    <section class="wrapper2 p-0 form-sec scroll_new">
                        @if (session('message'))

                        <div class="alert alert-success" role="alert">
                            {{ session('message') }}
                        </div>
                        @endif
                        
                        <section class="select-time p-4">
                        <p class="change-pw">Manage Availability</p>
                        <div class="row align-items-center py-2">
                            <div class="col-md-6 col-lg-6 col-sm-6">
                                <p class="select-date">Set Availability</p>
                            </div>
                        
                            <div class="col-md-6 col-lg-6 col-sm-6">
                                <a href="{{ url('/Sp/add_manage_availibilty_new')}}" class="mange-avail ml-auto d-block">Manage Availability </a>
                            </div>
                        </div>
                        
                        <div class="row align-items-center py-2">
                            <div class="col-md-6 col-lg-6 col-sm-6">
                                <p class="show-date">Showing Availability from <br><span id="start_date">2020-11-02 </span> to <span id="end_date">2020-11-08</span></p>
                            </div>
                        
                            <div class="col-md-6 col-lg-6 col-sm-6">
                                <button type="button" class="mange-avail ml-auto d-block"  name="daterange">Change Dates </button>
                                <!-- <input type="text" name="daterange"> -->
                            </div>
                        </div>
                        </section>
                        
                        <section class="time-section" id="getslotsofsp">
                        
                        </section>
                    
                        <!-- <div class="row m-0 p-4">
                            <button type="button" class="btn-next mt-3">Save</button></div> -->
                    </section>
                </div>
            <div class="col-lg-8 col-md-8 col-sm-8 currentdate" style="display: none;">
                <section class="wrapper2 form-sec">
                    <p class="change-pw">Manage Availability</p>
                    <div class="slider-sec">
                        @if (session('message'))

                        <div class="alert alert-success" role="alert">
                            {{ session('message') }}
                        </div>
                        @endif
                        
                    </div>
                    <section class="select-time">
                        <p class="select-date">Select Time</p>
                        <div class="row" id="intervalList">
                            <div v-for="(interval, index) in intervals" class="col-md-12 row start_times">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="pwd">From</label>
                                        <select v-model="interval.seleted_start" class="form-control" id="start_date_from">
                                            <option v-for="time1 in interval.start_times" :value="time1.key">@{{ time1.value }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="pwd">To</label>
                                        <select v-model="interval.seleted_end" class="form-control" id="end_date_from">
                                            <option v-for="time in interval.end_times" :value="time.key">@{{ time.value }}</option>
                                        </select>
                                        <img :src="delete_img" class="img-fluid del-img delete_interval" @click="deleteInterval(index)">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <a href="javascript:void(0)" id='new_interval' @click="newInterval" class=" new-group">+ New
                        Interval</a>
            <div class="slider-sec">
            <div class="row m-0">
                <div class="col-md-12">
                 <div class="form-group form-check">
                      <div id="daterangepicker"></div>
                      <input id="onclickdate" @input="clickHadleType('specific_date')" class="form-check-input pr-2" type="checkbox" ><label class="form-check-label pb-0 checkbox-label">Select availabilty for Particular date
                    </label>
                  </div>
                </div>
            </div>
            <section class="day-slider ml-4" id="dateList">
                <div v-for="date in dates" class='slider-days text-center' @click="selectedData($event,date)">
                    <P class='today'>@{{ date . day_text }}</P>
                    
                </div>
            </section>          
            </div>
                    <div class="row m-0 ">
                        <button type="button" id="submit_btn_id" class="btn-next mt-3" @click="saveAvai()">
                            @{{ submit_btn_text }}</button>
                    </div>
                </section>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-8 tabcontent" id="notification" style="display: none;">
                <section class="wrapper2 form-sec">
                    <p class="change-pw pb-3">Notifications</p>
                    <table class="table">
                    <tbody>
                     @forelse ($notifications as $notification)
                      <tr>
                        <td class="border-0">
                            
                            <img src="{{ $notification->form_user->profile_image ? Storage::disk('spaces')->url('uploads/' .  $notification->form_user->profile_image) : asset('assets/mp2r/images/default.png') }}" class="img-fluid notif-img">
                        </td>
                        <td class="border-0 notif-text">{{$notification->message}}</td>
                        <td class="one-day border-0" style="width: 25%;">{{ \Carbon\Carbon::parse($notification->created_at)->diffForHumans() }}</td>
                      </tr>
                      @empty
                      No Notifications found.
                      @endforelse
                    </tbody>
                  </table>
                  {{ $notifications->appends(Request::except('page'))->links() }}
                </section>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-8 tabcontent" id="cookie_policy" style="display: none;">
                    <section class="wrapper2 cookies-text">
                        <p class="change-pw pb-4">Cookie Policy</p>
                        <div class="row align-items-center m-0 wrap-height border-0 pt-3">
                            <div class="col-md-12 col-lg-12 ">
                                @if(isset($cookie_policy) && $cookie_policy)
                                    <h5 class="latest-update">{{ \Carbon\Carbon::parse($cookie_policy->updated_at)->diffForHumans() }}</h5>
                                    <span class="second-name pt-2">{!! $cookie_policy->body !!}</span>
                                @else
                                    <center>NO COOKIE POLICY FOUND </center>
                                @endif
                            
                            </div>  
                        </div>
                    </section>
                
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8 tabcontent" id="privacy_policy" style="display: none;">
                    
                    <section class="wrapper2 cookies-text">
                        <p class="change-pw pb-4">Privacy Policy</p>
                        <div class="row align-items-center m-0 wrap-height border-0 pt-3">
                            <div class="col-md-12 col-lg-12 ">
                                @if(isset($privacy_policy) && $privacy_policy)
                                    <h5 class="latest-update">{{ \Carbon\Carbon::parse($privacy_policy->updated_at)->diffForHumans() }}</h5>
                                    <span class="second-name pt-2">{!! $privacy_policy->body !!}</span>
                                @else
                                    <center>NO PRIVACY POLICY FOUND </center>
                                @endif
                            
                            </div>  
                        </div>
                    </section>
                
                </div>

            <div class="col-lg-8 col-md-8 col-sm-8 tabcontent" id="change_password" style="display: none;">


                <section class="wrapper2">
                    <p class="change-pw pb-4">Change Password</p>

                    <div class="modal-body p-0 form-sec">
                        <div class="alert alert-success change_password_succ" role="alert" style="display:none;">
                            Password Changed successfully!!
                        </div>
                        <div class="alert alert-danger change_password_error" role="alert" style="display:none;">
                            The Old password is not match with old password.
                        </div>
                        <form id="chnagePasswordForm" action="{{ route('change-password') }}" method="post">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group show-pos">
                                        <label for="pwd">Old Password</label>
                                        <input id="old_password" type="password" class="form-control" name="old_password" value="">
                                        <span toggle="#password-field" class="field-icon toggle-password hide-show">Show</span>
                                    </div>
                                    <span class="errors" id="old_password_error"></span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group show-pos">
                                        <label for="pwd">New Password</label>
                                        <input id="new_password" type="password" class="form-control" name="new_password" value="">
                                        <span toggle="#password-field" class="field-icon toggle-password hide-show">Show</span>
                                    </div>
                                    <small id="emailHelp" class="form-text text-muted">Password should contain at-least 1 Uppercase, 1 Lowercase, 1 Numeric and at least 8 characters.</small>
                                    <span class="errors" id="new_password_error"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group show-pos">
                                        <label for="pwd">Retype New Password</label>
                                        <input id="re_password" type="password" class="form-control" name="re_password" value="">
                                        <span toggle="#password-field" class="field-icon toggle-password hide-show">Show</span>
                                    </div>
                                    <span class="errors" id="re_password_error"></span>
                                </div>
                            </div>
                            <button type="submit" class="btn-login w-auto" id="change_password">Update</button>
                        </form>
                    </div>
                </section>

            </div>
            <div class="col-lg-8 col-md-8 col-sm-8 tabcontent" id="profile_detail" style="display: none;">

                <section class="wrapper2">
                    <div class="row align-items-center pt-2 pb-2">
                        <div class="col-md-6 col-lg-6 ">
                            <h2 class="edit-name">{{ isset($user->name) ? $user->name : 'N/A' }}</h2>
                        </div>
                        <div class="col-md-6 col-lg-6 ">
                            <li class="tablinks edit" onclick="openCity(event, 'edit_profile')" style="list-style:none;">Edit Profile</li>
                        </div>


                    </div>
                    <hr>

                    <div class="row align-items-center pt-3">
                        <div class="col-md-6 col-lg-6 ">
                            <p class="second-name2">Username/Email ID</p>
                            <p class="first-name">{{ isset($user->email) ? $user->email : 'N/A' }}</p>
                        </div>
                        <div class="col-md-6 col-lg-6 ">
                            <p class="second-name2">Phone Number</p>
                            <p class="first-name">
                                {{ isset($user->phone) ? $user->country_code . '' . $user->phone : 'N/A' }}</p>
                        </div>
                    </div>

                    <div class="row align-items-center pt-3">
                        <div class="col-md-6 col-lg-6 ">
                            <p class="second-name2">Address</p>
                            <p class="first-name">{{ isset($user->profile->address) ? $user->profile->address : 'N/A' }}
                            </p>
                        </div>
                        <div class="col-md-6 col-lg-6 ">
                            <p class="second-name2">City</p>
                            <p class="first-name">{{ isset($user->profile->city) ? $user->profile->city : 'N/A' }}</p>
                        </div>
                    </div>

                    <div class="row align-items-center pt-3">
                        <div class="col-md-6 col-lg-6 ">
                            <p class="second-name2">State</p>
                            <p class="first-name">{{ isset($user->profile->state) ? $user->profile->state : 'N/A' }}</p>
                        </div>
                        <div class="col-md-6 col-lg-6 ">
                            <p class="second-name2">Zip</p>
                            <p class="first-name">{{ isset($user_zip_code->field_value) ? $user_zip_code->field_value : 'N/A' }}</p>
                        </div>
                    </div>



                    <div class="row align-items-center pt-3">
                        <div class="col-md-12 col-lg-12 ">
                            <p class="second-name2">Insurance</p>
                           
                            <p class="first-name">@php $resultstr=array(); @endphp @foreach($user_insurance_id as  $user_insurances_info)
                                @php $resultstr[] = $user_insurances_info->insurance->name   @endphp
                            @endforeach
                            {{ implode(",",$resultstr) }}
                            </p>
                        </div>
                    </div>


                </section>

            </div>
            <div class="col-lg-8 col-md-8 col-sm-12 tabcontent" id="edit_profile" style="display: none;">

                <section class="wrapper2">
                    <!-- form start -->
                    <section class="form-sec p-0">
                        <form action="{{ route('update-profile') }}" method="post">
                            {{ csrf_field() }}
                            <div class="row pb-2">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="pwd">Name</label>
                                        <input required="" type="text" class="form-control" id="name" placeholder="John Doe" name="name" value="{{ isset($user->name) ? $user->name : '' }}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="pwd">Username / Email</label>
                                        <input required="" type="text" class="form-control" id="johndoe@gmail.com" placeholder="johndoe@gmail.com" name="email" value="{{ isset($user->email) ? $user->email : '' }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row pb-2">
                                <div class="col-md-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="pwd">Phone number</label>

                                        <div class="input-outer d-flex align-items-center p-2">
                                            <div class="flag row m-0">
                                                <img src="{{ asset('assets/mp2r/images/ic_flag.png') }}" class="img-fluid pr-2">
                                                <div class="dropdown">
                                                    <span type="button" data-toggle="dropdown">{{ isset($user->country_code) ? $user->country_code : '' }}
                                                        <span><img src="{{ asset('assets/mp2r/images/ic_dd-header.png') }}" class="img-fluid pl-2"></span>

                                                </div>
                                            </div>
                                            <input type="text" class="border-0 pl-2" id="name" placeholder="9984929384" name="phone" value="{{ isset($user->phone) ? $user->phone : '' }}">
                                        </div>

                                        <!-- <img src="images/ic_flag@2x.png"><input type="text" class="form-control" id="name" placeholder="Yuvraj" name="name"> -->
                                    </div>

                                </div>

                                <div class="col-md-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="email">Address</label>
                                        <input required="" type="text" class="form-control" id="pac-input" placeholder="204, Eloisa Village Apt. 827" name="address" value="{{ isset($user->profile->address) ? $user->profile->address : '' }}">
                                        <input type="hidden" name="custom_field_id" value="3">

                                    </div>
                                </div>
                            </div>
                            <div class="row pb-2">
                                <div class="col-md-6">
                                    <div class="form-group">

                                        <label for="state">City</label><!-- sel1 -->
                                        <select class="form-control city_change" id="city_manage" name="city">
                                            @foreach ($cities as $city)
                                            <option value="{{ $city->name }}" <?php echo $city->name ==
                                                                                $user->profile->city ? 'selected' : ''; ?>>{{ $city->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="state">State</label><!-- state_change -->
                                        <select class="form-control" id="state_manage" name="state">
                                            <option>Select State</option>
                                            @foreach ($states as $state)
                                            <option value="{{ $state->name }}" <?php echo $state->name
                                                                                    == $user->profile->state ? 'selected' : ''; ?>>{{ $state->name }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row pb-2">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="pwd">Zip Code</label>
                                        <input type="number" class="form-control" id="zipcodee" placeholder="90010" name="zip" value="{{ isset($user_zip_code->field_value) ? $user_zip_code->field_value : 'N/A'}}" >

                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="pwd">Education</label>
                                        <input type="text" class="form-control" id="johndoe@gmail.com" placeholder="M.D. MBBS" name="qualification" value="{{ isset($user->profile->qualification) ? $user->profile->qualification : '' }}">
                                    </div>
                                </div>
                            </div>
                            <div class="seprator" style="border:1px solid #ddd;padding: 15px 20px; position:relative;">
                                <span style="position:absolute;left: 20px;padding: 0 20px;top: -12px;background: #fff;">Security Question for reset password</span>
                                <div class="row pb-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                           <label for="question1">Question1</label>                    
                                            <select class="form-control" id="question1" name="question1">
                                                @foreach($question1 as $q)
                                                <option {{ ($selectedQ1)?($selectedQ1->security_question_id==$q->id?'selected':''):''}} value="{{ $q->id }}">{{ $q->question }}</option>
                                                @endforeach
                                             </select>
                                             <span class="alert-danger question1_error"></span>                     
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                           <label for="state">Answer1</label>                      
                                            <input type="text" value="{{ ($selectedQ1)?$selectedQ1->answer:''}}" class="form-control" id="answer1" name="answer1" placeholder="Answer1" required="">
                                             <span class="alert-danger answer1_error"></span>                       
                                        </div>
                                    </div>
                                </div>
                                <div class="row pb-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                           <label for="state">Question2</label>                    
                                            <select class="form-control" id="question2" name="question2">
                                                @foreach($question2 as $q)
                                                <option {{ ($selectedQ2)?($selectedQ2->security_question_id==$q->id?'selected':''):''}} value="{{ $q->id }}">{{ $q->question }}</option>
                                                @endforeach
                                             </select>
                                             <span class="alert-danger question3_error"></span>                     
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                           <label for="state">Answer2</label>                      
                                            <input type="text" value="{{ ($selectedQ2)?$selectedQ2->answer:''}}" class="form-control" id="answer2" name="answer2" placeholder="Answer2" required="">
                                             <span class="alert-danger answer2_error"></span>                       
                                        </div>
                                    </div>
                                </div>
                                <div class="row pb-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                           <label for="state">Question3</label>                    
                                            <select class="form-control" id="question3" name="question3">
                                                @foreach($question3 as $q)
                                                <option {{ ($selectedQ3)?($selectedQ3->security_question_id==$q->id?'selected':''):''}} value="{{ $q->id }}">{{ $q->question }}</option>
                                                @endforeach
                                             </select>
                                             <span class="alert-danger question3_error"></span>                     
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                           <label for="state">Answer3</label>                      
                                            <input type="text" value="{{ ($selectedQ3)?$selectedQ3->answer:''}}" class="form-control" id="answer3" name="answer3" placeholder="Answer3" required="">
                                             <span class="alert-danger answer3_error"></span>                       
                                        </div>
                                    </div>
                                </div>
                            </div>

                                            
                            <div class="row pb-2">
                                <div class="col-md-6" id="insurances_dropdown">
                                    <div class="form-group">
                                        <label for="state">Your Accepted Insurance</label>
                                        
                                        <select class="form-control" id="insurances2" name="insurance[]" multiple="">
                                            <option>Select Insurance </option>

                                            
                                            @foreach ($insurances as $insurance)
                                             <option value="{{ $insurance->id }}" 
                                               @foreach ($user_insurance_id as $user_insurance_iinfo)
                                                 @if ($user_insurance_iinfo->insurance_id == $insurance->id)
                                                 {{'selected="selected"'}}
                                                 @endif 
                                               @endforeach >
                                              {{ $insurance->name }} </option>               
                                            @endforeach 
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row align-items-center pt-3">
                                <div class="col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <label for="comment">About:</label>
                                        <textarea class="form-control height-100" rows="5" id="comment" placeholder="If you’re looking for feedback on a doctor but don’t have anyone to ask, online reviews will tell you everything you needed to know." name="about">{{ isset($user->profile->about) ? $user->profile->about : '' }}</textarea>
                                    </div>
                                </div>

                            </div>
                            <div class="row m-0 ">
                                <button type="submit" class="btn-next">Save</button>
                            </div>
                        </form>
                    </section>
                </section>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-8 tabcontent" id="update_category" style="display: none;">
                @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
                @endif
                <section class="wrapper2 form-sec">
                    <p class="change-pw">Update Category</p>
                    <form action="{{ route('category_update') }}" method="post">
                        {{ csrf_field() }}
                        <div class="row align-items-center pt-3">
                            <div class="col-md-6 col-lg-6 ">
                                <div class="form-group ">
                                    <label for="pwd"> Category</label>
                                    <select class="form-control" id="sel1" name="category_id">
                                        @if (isset($parentCategories))
                                        @foreach ($parentCategories as $category)
                                        <optgroup label="{{ $category->name }}">
                                            @if (isset($category->subcategory) && count($category->subcategory) > 0)
                                            @foreach ($category->subcategory as $sub)
                                            <option value="{{ $sub->id }}">{{ $sub->name }}</option>
                                            @endforeach
                                            @endif
                                        </optgroup>

                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row m-0 ">
                            <button type="submit" class="btn-next mt-3">Update</button>
                        </div>
                    </form>
                </section>
            </div>
            
        </div>
    </div>
</section>
@endsection
@section('script')
<script type="text/javascript">
    $(function() {
  $('button[name="daterange"]').daterangepicker({
    opens: 'left'
  }, function(start, end, label) {
    console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
        $("#start_date").text(start.format('YYYY-MM-DD'));
        $("#end_date").text(end.format('YYYY-MM-DD'));

  });
});

 var today_date = new Date();
var month = today_date.getMonth()+1;
var day = today_date.getDate();

var start_date = today_date.getFullYear() + '-' +
    (month<10 ? '0' : '') + month + '-' +
    (day<10 ? '0' : '') + day;

today_date.setDate(today_date.getDate() + 6);
var seven_month=today_date.getMonth()+1;
var seven_day = today_date.getDate();

var end_date=today_date.getFullYear() + '-' +
    (seven_month<10 ? '0' : '') + seven_month + '-' +
    (seven_day<10 ? '0' : '') + seven_day;


$("#start_date").text(start_date);
$("#end_date").text(end_date);

var start = new Date(start_date),
        end = new Date(end_date),
        currentDate = new Date(start),
        between = []
    ;

    while (currentDate <= end) {
            var yy=new Date(currentDate);
        between.push(yy.getFullYear()+"-"+(yy.getMonth()+1)+"-"+yy.getDate());
        currentDate.setDate(currentDate.getDate() + 1);
    }
var dates=between.join(',');
var category_id=1;
// alert(category_id);
$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
$.ajax({
      url:"{{ url('/Sp/getSlotsByMultipleDates')}}",
      method:"post",
      data:{service_id:1,category_id:category_id,dates:dates},
      beforeSend: function() {
          $("#wait").show();
       },
      success:function(data){
        var html='';
        
            $.each(data.data, function (key, val) {
                
                 if(val.sp_slot_array != ""){
                    $.each(val.sp_slot_array, function(keys,vals) {             
                               
                        
                    html+='<div class="main-bg px-4 py-3 "><p class="time-date">'+val.date+'<a style="color: #0491FF;" data-date="'+val.date+'" data-start_date="'+vals.start_time+'" data-end_date="'+vals.end_time+'" class="edit2">Edit</a></p><div class="row m-0"><div class="round-outer">'+vals.start_time+' - '+vals.end_time+'</div></div></div></form> ';
                    }); 
                }else if(val.sp_slot_array == ""){

                    html+='<div class="main-bg px-4 py-3"><p class="time-date">'+val.date+'  <a href="{{ url("/Sp/add_manage_availibilty_new")}}" class="edit">Add slot</a></p></div>';
                }
            });
        
        $("#getslotsofsp").html(html);

        // $("#wait").css("display", "none");
        
      },error: function(data) {
           //alert('hh1');
        }
     });

    $(document).on('click','.applyBtn',function(){

        var start_date=$("#start_date").text();
        var end_date=$("#end_date").text();

        var start = new Date(start_date),
        end = new Date(end_date),
        currentDate = new Date(start),
        between = [];

        while (currentDate <= end) {
                var yy=new Date(currentDate);
            between.push(yy.getFullYear()+"-"+(yy.getMonth()+1)+"-"+yy.getDate());
            currentDate.setDate(currentDate.getDate() + 1);
        }
        var dates=between.join(',');
        
        var category_id=1;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
              url:"{{ url('/Sp/getSlotsByMultipleDates')}}",
              method:"post",
              data:{service_id:1,category_id:category_id,dates:dates},
              beforeSend: function() {
                  $("#wait").show();
               },
              success:function(data){
                var html='';
                
                    $.each(data.data, function (key, val) {
                        
                         if(val.sp_slot_array != ""){
                            $.each(val.sp_slot_array, function(keys,vals) {             
                                       
                                
                            html+='<div class="main-bg px-4 py-3 "><p class="time-date">'+val.date+'<a href="{{ url("/Sp/add_manage_availibilty_new")}}" class="edit2">Edit</a></p><div class="row m-0"><div class="round-outer">'+vals.start_time+' - '+vals.end_time+'</div></div></div>';
                            }); 
                        }else if(val.sp_slot_array == ""){

                            html+='<div class="main-bg px-4 py-3"><p class="time-date">'+val.date+'  <a href="{{ url("/Sp/add_manage_availibilty_new")}}" class="edit2">Add  slot</a></p></div>';
                        }
                    });
                
                $("#getslotsofsp").html(html);

                 $("#wait").css("display", "none");
                
              },error: function(data) {
                   //alert('hh1');
                }
        });


    });
    
    var date_picker_date = null;
    $(document).on('click','.edit2',function(){
       

        $(".editmanage").css('display','none');

        $(".currentdate").css('display','block');
       
        var start_str=$(this).attr('data-start_date');
        var start_sub= start_str.substr(0, 5);
        var start_date = start_sub.replace(/\s/g, '');
        

        var end_str=$(this).attr('data-end_date');
        var end_sub= end_str.substr(0, 5);
        var end_date = end_sub.replace(/\s/g, '');
       
        
        $("#start_date_from").val(start_date).prop('selected',true);

        $("#end_date_from").val(end_date).prop('selected',true);
        date_picker_date= $(this).attr('data-date');
        //alert(date_picker_date);
        var today_date23 = moment(date_picker_date).format('MMM D,YY');
        $('.day-slider').css('display','none');
        $("#submit_btn_id").text('Save For '+today_date23);

        date_picker_date = today_date23;
        

        $("#onclickdate").trigger('click');

        $("#onclickdate").attr('checked',true);

        $(".applyBtn").trigger('click');


    });
    $(document).ready(function() {});
       $(function() {
          $("#daterangepicker").daterangepicker({
            autoclose: false,
            closeBtn: true,
            singleDatePicker: true,
            showDropdowns: true,
            minYear: 1901,
            maxYear: parseInt(moment().format('YYYY'),10),
            onClose: function () {
                alert('Datepicker Closed');
            }
          }, function(start, end, label) {
            console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));

        });
        $("#onclickdate").click(function () {
            console.log($(this).prop('checked'));
            if ($(this).prop('checked') == false) {
                $('.day-slider').css('display','block');
                $("#submit_btn_id").text('Save');
            }else{
                $("#daterangepicker").trigger('click');
                if(date_picker_date!==null){
                    var today_date23 = moment(date_picker_date).format('MMM D,YY');
                    $('.day-slider').css('display','none');
                    $("#submit_btn_id").text('Save For '+today_date23);
                }
            }
        });
    });
    var date_picker_date = null;
    $(document).on('click','.today',function(){
        if($(this).parent().hasClass('slick-current')){
           $(this).parent().removeClass('slick-current');
        }else{
          $(this).parent().addClass('slick-current');
        }
    });

    $(document).on('click','.applyBtn',function(){
        var startDate = $('#daterangepicker').data('daterangepicker').startDate._d;
        date_picker_date = startDate;
        var today_date = moment(startDate).format('MMM D,YY');
        $('.day-slider').css('display','none');
        $("#submit_btn_id").text('Save For '+today_date);
        
    });
    let weeks = [];
    let daysRequired = 7;

    
    function addMonths(date, months) {
        var d = date.getDate();
        date.setMonth(date.getMonth() + +months);
        if (date.getDate() != d) {
            date.setDate(0);
        }
        return date;
    }
    var today_date = moment().format('Y/M/D');
    var selected_date_model = {
        'day_text': '',
        'day': '',
        "date": moment(today_date).format('MMM D,YY'),
        "full_date": moment(today_date).format('Y/M/D')
    };
    var days = [];
    var current_date = new Date();
    var last_date = new Date(addMonths(new Date(), 3).toString());
    var dates = [];
    var weekday = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
    for (let i = 0; i<daysRequired; i++) {
        var d = moment().add(i, 'days');
        var same = moment(today_date).isSame(d.format('Y/M/D'));
        var day_name = weekday[d.day()];
        if (same) {
            selected_date_model = {
                'day_text': 'Today',
                'day': day_name,
                "date": moment(d).format('MMM D,YY'),
                "full_date": moment(d).format('Y/M/D')
            };
            days.push(selected_date_model);
            dates.push({
                'day_text': 'Today',
                'day': day_name,
                "date": moment(d).format('MMM D,YY'),
                "full_date": moment(d).format('Y/M/D')
            });
        } else {
            dates.push({
                'day_text': day_name,
                'day': day_name,
                "date": moment(d).format('MMM D,YY'),
                "full_date": moment(d).format('Y/M/D')
            });
        }
    }
    // for (var day = current_date; day <= last_date; day.setDate(day.getDate() + 1)) {
    //     var same = moment(today_date).isSame(moment(day).format('Y/M/D'));
    //     var day_name = weekday[day.getDay()];
    //     if (same) {
    //         selected_date_model = {
    //             'day_text': 'Today',
    //             'day': day_name,
    //             "date": moment(day).format('MMM D,YY'),
    //             "full_date": moment(day).format('Y/M/D')
    //         };
    //         days[selected_date_model.day] = selected_date_model;
    //         dates.push({
    //             'day_text': 'Today',
    //             'day': day_name,
    //             "date": moment(day).format('MMM D,YY'),
    //             "full_date": moment(day).format('Y/M/D')
    //         });
    //     } else {
    //         dates.push({
    //             'day_text': day_name,
    //             'day': day_name,
    //             "date": moment(day).format('MMM D,YY'),
    //             "full_date": moment(day).format('Y/M/D')
    //         });
    //     }
    // }
    new Vue({
        el: '#manage_avail',
        data: {
            days:days,
            dates: dates,
            start_times: [{
                    "key": "00:00",
                    "value": "00:00 am"
                },
                {
                    "key": "01:00",
                    "value": "01:00 am"
                },
                {
                    "key": "02:00",
                    "value": "02:00 am"
                },
                {
                    "key": "03:00",
                    "value": "03:00 am"
                },
                {
                    "key": "04:00",
                    "value": "04:00 am"
                },
                {
                    "key": "05:00",
                    "value": "05:00 am"
                },
                {
                    "key": "06:00",
                    "value": "06:00 am"
                },
                {
                    "key": "07:00",
                    "value": "07:00 am"
                },
                {
                    "key": "08:00",
                    "value": "08:00 am"
                },
                {
                    "key": "09:00",
                    "value": "09:00 am"
                },
                {
                    "key": "10:00",
                    "value": "10:00 am"
                },
                {
                    "key": "11:00",
                    "value": "11:00 am"
                },
                {
                    "key": "12:00",
                    "value": "12:00 pm"
                },
                {
                    "key": "13:00",
                    "value": "1:300 pm"
                },
                {
                    "key": "14:00",
                    "value": "14:00 pm"
                },
                {
                    "key": "15:00",
                    "value": "15:00 pm"
                },
                {
                    "key": "16:00",
                    "value": "16:00 pm"
                },
                {
                    "key": "17:00",
                    "value": "17:00 pm"
                },
                {
                    "key": "18:00",
                    "value": "18:00 pm"
                },
                {
                    "key": "19:00",
                    "value": "19:00 pm"
                },
                {
                    "key": "20:00",
                    "value": "20:00 pm"
                },
                {
                    "key": "21:00",
                    "value": "21:00 pm"
                },
                {
                    "key": "22:00",
                    "value": "22:00 pm"
                },
                {
                    "key": "23:00",
                    "value": "23:00 pm"
                }
            ],
            end_times: [{
                "key": "00:00",
                    "value": "00:00 am"
                },
                {
                    "key": "01:00",
                    "value": "01:00 am"
                },
                {
                    "key": "02:00",
                    "value": "02:00 am"
                },
                {
                    "key": "03:00",
                    "value": "03:00 am"
                },
                {
                    "key": "04:00",
                    "value": "04:00 am"
                },
                {
                    "key": "05:00",
                    "value": "05:00 am"
                },
                {
                    "key": "06:00",
                    "value": "06:00 am"
                },
                {
                    "key": "07:00",
                    "value": "07:00 am"
                },
                {
                    "key": "08:00",
                    "value": "08:00 am"
                },
                {
                    "key": "09:00",
                    "value": "09:00 am"
                },
                {
                    "key": "10:00",
                    "value": "10:00 am"
                },
                {
                    "key": "11:00",
                    "value": "11:00 am"
                },
                {
                    "key": "12:00",
                    "value": "12:00 pm"
                },
                {
                    "key": "13:00",
                    "value": "13:00 pm"
                },
                {
                    "key": "14:00",
                    "value": "14:00 pm"
                },
                {
                    "key": "15:00",
                    "value": "15:00 pm"
                },
                {
                    "key": "16:00",
                    "value": "16:00 pm"
                },
                {
                    "key": "17:00",
                    "value": "17:00 pm"
                },
                {
                    "key": "18:00",
                    "value": "18:00 pm"
                },
                {
                    "key": "19:00",
                    "value": "19:00 pm"
                },
                {
                    "key": "20:00",
                    "value": "20:00 pm"
                },
                {
                    "key": "21:00",
                    "value": "21:00 pm"
                },
                {
                    "key": "22:00",
                    "value": "22:00 pm"
                },
                {
                    "key": "23:00",
                    "value": "23:00 pm"
                }
            ],
            intervals: [{
                seleted_start: "00:00",
                seleted_end: "01:00",
                start_times: [{
                        "key": "00:00",
                        "value": "00:00 am"
                    },
                    {
                        "key": "01:00",
                        "value": "01:00 am"
                    },
                    {
                        "key": "02:00",
                        "value": "02:00 am"
                    },
                    {
                        "key": "03:00",
                        "value": "03:00 am"
                    },
                    {
                        "key": "04:00",
                        "value": "04:00 am"
                    },
                    {
                        "key": "05:00",
                        "value": "05:00 am"
                    },
                    {
                        "key": "06:00",
                        "value": "06:00 am"
                    },
                    {
                        "key": "07:00",
                        "value": "07:00 am"
                    },
                    {
                        "key": "08:00",
                        "value": "08:00 am"
                    },
                    {
                        "key": "09:00",
                        "value": "09:00 am"
                    },
                    {
                        "key": "10:00",
                        "value": "10:00 am"
                    },
                    {
                        "key": "11:00",
                        "value": "11:00 am"
                    },
                    {
                        "key": "12:00",
                        "value": "12:00 pm"
                    },
                    {
                        "key": "14:00",
                        "value": "13:00 pm"
                    },
                    {
                        "key": "01:00",
                        "value": "14:00 pm"
                    },
                    {
                        "key": "15:00",
                        "value": "15:00 pm"
                    },
                    {
                        "key": "16:00",
                        "value": "16:00 pm"
                    },
                    {
                        "key": "17:00",
                        "value": "17:00 pm"
                    },
                    {
                        "key": "18:00",
                        "value": "18:00 pm"
                    },
                    {
                        "key": "19:00",
                        "value": "19:00 pm"
                    },
                    {
                        "key": "20:00",
                        "value": "20:00 pm"
                    },
                    {
                        "key": "21:00",
                        "value": "21:00 pm"
                    },
                    {
                        "key": "22:00",
                        "value": "22:00 pm"
                    },
                    {
                        "key": "23:00",
                        "value": "23:00 pm"
                    }
                ],
                end_times: [{

                        "key": "00:00",
                        "value": "00:00 am"
                    },
                    {

                        "key": "01:00",
                        "value": "01:00 am"
                    },
                    {
                        "key": "02:00",
                        "value": "02:00 am"
                    },
                    {
                        "key": "03:00",
                        "value": "03:00 am"
                    },
                    {
                        "key": "04:00",
                        "value": "04:00 am"
                    },
                    {
                        "key": "05:00",
                        "value": "05:00 am"
                    },
                    {
                        "key": "06:00",
                        "value": "06:00 am"
                    },
                    {
                        "key": "07:00",
                        "value": "07:00 am"
                    },
                    {
                        "key": "08:00",
                        "value": "08:00 am"
                    },
                    {
                        "key": "09:00",
                        "value": "09:00 am"
                    },
                    {
                        "key": "10:00",
                        "value": "10:00 am"
                    },
                    {
                        "key": "11:00",
                        "value": "11:00 am"
                    },
                    {
                        "key": "12:00",
                        "value": "12:00 pm"
                    },
                    {
                        "key": "14:00",
                        "value": "13:00 pm"
                    },
                    {
                        "key": "01:00",
                        "value": "14:00 pm"
                    },
                    {
                        "key": "15:00",
                        "value": "15:00 pm"
                    },
                    {
                        "key": "16:00",
                        "value": "16:00 pm"
                    },
                    {
                        "key": "17:00",
                        "value": "17:00 pm"
                    },
                    {
                        "key": "18:00",
                        "value": "18:00 pm"
                    },
                    {
                        "key": "19:00",
                        "value": "19:00 pm"
                    },
                    {
                        "key": "20:00",
                        "value": "20:00 pm"
                    },
                    {
                        "key": "21:00",
                        "value": "21:00 pm"
                    },
                    {
                        "key": "22:00",
                        "value": "22:00 pm"
                    },
                    {
                        "key": "23:00",
                        "value": "23:00 pm"
                    }
                ]
            }],
            start_intervals: "00:00",
            end_intervals: "01:00",
            class_number: 1,
            selected_int_list: [],
            delete_img: base_url + "/assets/mp2r/images/delet.png",
            selected_date_model: selected_date_model,
            submit: false,
            handle_type: 'multiple_days',
            submit_btn_text: 'Next',
        },
        methods: {
            selectedData: function(event,data) {
                this.selected_date_model = data;
                const filteredPeople = this.days.findIndex((item) => item.day==data.day);
                if(filteredPeople!==-1){
                    this.days.splice(filteredPeople,1);
                }else{
                    this.days.push(data);
                }
            },
            clickHadleType: function(type) {
                this.handle_type = type;
                
                if($("#onclickdate").prop('checked') == false){
                    this.handle_type = 'multiple_days';
                }
            },
            saveAvai: function() {
                var _this = this;
                
                if(this.handle_type=='specific_date' && date_picker_date==null){
                    Swal.fire('Error!','Please Select Date', 'error');
                    return false;
                }else if(this.handle_type=='multiple_days' && _this.days.length==0){
                    Swal.fire('Error!','Please Select Days', 'error');
                    return false;
                }
                var date_picker_new=date=moment(date_picker_date).format('Y/M/D');
                Swal.fire({
                    title: 'Confirm!',
                    text: 'Do you want to set Availability for ' + _this.handle_type,
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes!',
                }).then((result) => {
                    if (result.value) {
                        _this.submit_btn_text = 'Saving...';
                        $.ajax({
                            type: "post",
                            url: base_url + '/service_provider/manage_availibilty',
                            data: {
                                'timzone': timZone,
                                "handle_type": _this.handle_type,
                                "date": _this.selected_date_model,
                                "interval": _this.intervals,
                                "days": _this.days,
                                "date_picker_date":date_picker_new,
                                
                            },
                            dataType: "json",
                            success: function(response) {
                                _this.submit_btn_text = 'Next';
                                Swal.fire('Success!', 'Availability Saved', 'success').then((result) => {
                                    location.reload();
                                });
                            },
                            error: function(jqXHR) {
                                _this.submit_btn_text = 'Next';
                                var response = $.parseJSON(jqXHR.responseText);
                                if (response.message) {
                                    Swal.fire('Error!', response.message, 'error');
                                }
                            }
                        });
                    }
                });
            },
            deleteInterval: function(index) {
                this.intervals.splice(index, 1);
            },
            newInterval: function() {
                this.intervals.push({
                    seleted_start: "00:00",
                    seleted_end: "01:00",
                    start_times: this.start_times,
                    end_times: this.end_times
                });
            },
        },
        mounted() {}
    });
</script>
<script>
    function openCity(evt, cityName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        var current_tab = document.getElementById(cityName);
        if(current_tab)
            document.getElementById(cityName).style.display = "block";
        else
            document.getElementById("manage_availability").style.display = "block";
        if(cityName=='edit_profile'){
            cityName = 'profile_detail';
        }
        var _this = document.getElementById(cityName+"_1");
        if(_this)
            _this.classList.toggle("active");
        else
            document.getElementById("manage_availability_1").classList.toggle("active");
        if(cityName=='profile_detail'){
            $("#OpenImgUpload").css('cursor','pointer');
        }else{
            $("#OpenImgUpload").css('cursor','auto');
        }
        var queryParams = new URLSearchParams(window.location.search);
        queryParams.set("tab", cityName);
        history.replaceState(null, null, "?"+queryParams.toString());
    }
    let tab = "{{ Request::get('tab') }}";
    if(tab){
        openCity(null,tab);
    }else{
        openCity(null,'manage_availability');
    }
    // Get the element with id="defaultOpen" and click on it
    // document.getElementById("defaultOpen").click();


</script>
@endsection