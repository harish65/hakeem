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
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

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
                            <li class="tablinks" onclick="openCity(event, 'manage_availability')" id="defaultOpen"><a href="{{ route('SP.manage_availibilty_new')}}" style="color: black;">Manage Availability</a></li>
                            <li class="tablinks" onclick="openCity(event, 'chat')" ><a href="{{ url('/Sp/ChatHistoryPage?userid='.Auth::user()->id.'&nickname='.Auth::user()->name)}}" style="color: black;">Chat</a></li>

                            <li class="tablinks" onclick="openCity(event, 'notification')">Notification</li>
                            <li class="tablinks"><a style="color: #212529" href="{{ url('service_provider/Appointment') }}">Menu</a></li>
                            <li class="tablinks" onclick="openCity(event, 'profile_detail')"> Profile Details</li>
                            <li class="tablinks" onclick="openCity(event, 'change_password')">Change Password</li>
                            <li class="tablinks" onclick="openCity(event, 'update_category')">Update Category</li>
                            <li  data-id="{{ Auth::user()->id }}"  class="tablinks" onclick="openCity(event, 'cookie_policy')">Cookie Policy</li>
                            <li  data-id="{{ Auth::user()->id }}"  class="tablinks" onclick="openCity(event, 'privacy_policy')">Privacy Policy</li>
                        </div>
                    </ul>
                </div>
            </div>
            <div id="manage_availability" class="col-lg-8 col-md-8 col-sm-8 tabcontent">
                <section class="wrapper2 form-sec">
                    <p class="change-pw">Manage Availability</p>
                    <div class="slider-sec">
                        @if (session('message'))

                        <div class="alert alert-success" role="alert">
                            {{ session('message') }}
                        </div>
                        @endif
                        <p class="select-date">Select Date</p>
                        <section class="day-slider ml-4" id="dateList">
                            <div v-for="date in dates" class='slider-days text-center' @click='selectedData(date)'>
                                <P class='today'>@{{ date . day_text }}</P>
                                <P class='date'>@{{ date . date }}</P>
                            </div>
                        </section>
                    </div>
                    <section class="select-time">
                        <p class="select-date">Select Time</p>
                        <div class="row" id="intervalList">
                            <div v-for="(interval, index) in intervals" class="col-md-12 row start_times">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="pwd">From</label>
                                        <select v-model="interval.seleted_start" class="form-control" id="sel1">
                                            <option v-for="time1 in interval.start_times" :value="time1.key">
                                                @{{ time1.value }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="pwd">To</label>
                                        <select v-model="interval.seleted_end" class="form-control" id="sel1">
                                            <option v-for="time in interval.end_times" :value="time.key">
                                                @{{ time.value }}</option>
                                        </select>
                                        <img :src="delete_img" class="img-fluid del-img delete_interval" @click="deleteInterval(index)">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <a href="javascript:void(0)" id='new_interval' @click="newInterval" class=" new-group">+ New
                        Interval</a>
                    <section class="radios">
                        <form id="submit_availiblity">
                            <ul class="nav">
                                <li class="radio-cover">
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" id="Weekdays" name="handle_type" value="all_weekdays" @input="clickHadleType('all_weekdays')"><label class="form-check-label pb-0" for="Weekdays">All Weekdays</label>
                                    </div>
                                </li>
                                <li class="radio-cover">
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" id="For" name="handle_type" value="date" @input="clickHadleType('date')" checked> <label class="form-check-label pb-0" for="For">For
                                            @{{ selected_date_model . date }}</label>
                                    </div>
                                </li>
                                <li class="radio-cover">
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" id="All" name="handle_type" value="all_selected_day" @input="clickHadleType('all_selected_day')"> <label class="form-check-label pb-0" for="All">All
                                            @{{ selected_date_model . day }}</label>
                                    </div>
                                </li>
                                <li class="radio-cover">
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" id="Block" name="handle_type" value="block_selected_date" @input="clickHadleType('block_date')"> <label class="form-check-label pb-0" for="Block">Block
                                            @{{ selected_date_model . date }}</label>
                                    </div>
                                </li>
                            </ul>
                        </form>
                    </section>
                    <div class="row m-0 ">
                        <button type="button" id="submit_btn_id" class="btn-next mt-3" @click="saveAvai()">
                            @{{ submit_btn_text }}</button>
                    </div>
                </section>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-8 tabcontent" id="notification">
                <section class="wrapper2 form-sec">
                    <p class="change-pw pb-3">Notifications</p>
                    <table class="table">
                    <tbody>
                     @forelse ($notifications as $notification)
                      <tr>
                        <td class="border-0">
                            <?php if($notification->form_user->profile_image)
                                $notification->form_user->profile_image = url('media/'.$notification->form_user->profile_image);
                            else
                                $notification->form_user->profile_image = url('images/ic_notification.png');
                            ?>
                            <img src="{{ $notification->form_user->profile_image }}" class="img-fluid notif-img">
                        </td>
                        <td class="border-0 notif-text">{{$notification->message}}</td>
                        <td class="one-day border-0">{{ \Carbon\Carbon::parse($notification->created_at)->diffForHumans() }}</td>
                      </tr>
                      @empty
                      No Notifications found.
                      @endforelse
                    </tbody>
                  </table>
                  {{ $notifications->links()}}
                </section>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-8 tabcontent" id="cookie_policy">
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
                <div class="col-lg-8 col-md-8 col-sm-8 tabcontent" id="privacy_policy">
                    
                    <section class="wrapper2 ">
                        <p class="change-pw pb-4">Privacy Policy</p>
                        <div class="row align-items-center m-0 wrap-height  border-0 pt-3">
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

            <div class="col-lg-8 col-md-8 col-sm-8 tabcontent" id="change_password">


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
            <div class="col-lg-8 col-md-8 col-sm-8 tabcontent" id="profile_detail">

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
                            <p class="first-name">{{ isset($user_insurance->insurance->name) ? $user_insurance->insurance->name : 'N/A' }}
                            </p>
                        </div>
                    </div>


                </section>

            </div>
            <div class="col-lg-8 col-md-8 col-sm-12 tabcontent" id="edit_profile">

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
                                    </div>
                                </div>
                            </div>
                            <div class="row pb-2">
                                <div class="col-md-6">
                                    <div class="form-group">

                                        <label for="state">City</label><!-- sel1 -->
                                        <select class="form-control city_change" id="city" name="city">
                                            @foreach ($cities as $city)
                                            <option value="{{ $city->id }}" <?php echo $city->name ==
                                                                                $user->profile->city ? 'selected' : ''; ?>>{{ $city->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="state">State</label><!-- state_change -->
                                        <select class="form-control" id="state" name="state">
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
                                        <select class="form-control" id="insurances2" name="insurance" multiple="">
                                            <option>Select Insurance </option>
                                            @foreach ($insurances as $insurance)
                                            <option value="{{ $insurance->id }}"
                                                <?php echo
                                                $insurance->id == $user_insurance_id ? 'selected' : ''; ?>>{{ $insurance->name }}
                                            </option>
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
            <div class="col-lg-8 col-md-8 col-sm-8 tabcontent" id="update_category">
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
<script>
    $(document).ready(function() {

        $('#state').on('change', function() {
            var stateid = this.value;
            var url = "{{ route('get-state') }}";
            var token = "{{ csrf_token() }}";
            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    'state_id': stateid,
                    '_token': token
                },
                success: function(res) {
                    $('.city_change').empty();
                    $.each(res.cities, function(key, value) {
                        $('.city_change').append('<option  value="' + value.id +
                            '">' + value.name + '</option>');
                    });
                },
                error: function() {

                }
            });
        });

        $("#imgupload").change(function(){

        
        $("#submitfile").trigger('click');

    });


            $("#user_image_upload").submit(function(e){

                e.preventDefault();
                var formData = new FormData($(this)[0]);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                        method: "POST",
                        url: "{{ route('ServiceUserImage')}}",
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: formData,
                        success: function(data) {

                          
                            Swal.fire(
                              'Success!','Image update  successfully','success'
                            ).then((result)=>{
                              location.reload();
                            });
                          
                        },
                        error: function(data)  {
                            
                           
                        }
                });

            });

        $('#change_password').on('click', function(e) {
            e.preventDefault();
            if (validateInputs()) {
                var data = $("#chnagePasswordForm").serializeArray();
                var url = $('#chnagePasswordForm').attr('action');
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: data,
                    success: function(data) {
                        $('.change_password_succ').show();
                        $('.change_password_error').hide();
                    },
                    error: function() {
                        $('.change_password_succ').hide();
                        $('.change_password_error').show();
                    }
                });
            }
        });

        function validateInputs() {
            $('.errors').html('');
            var old_password = $('#old_password').val();
            var new_password = $('#new_password').val();
            var re_password = $('#re_password').val();
            if (old_password === '') {
                $('#old_password_error').css('color', 'red').html('Please fill Old Password');
                return false;
            }
            if (new_password === '') {
                $('#new_password_error').css('color', 'red').html('Please fill New Password');
                return false;
            }
            if (re_password === '') {
                $('#re_password_error').css('color', 'red').html('Please fill Re Password');
                return false;
            }
            if (new_password != re_password) {
                $('#re_password_error').css('color', 'red').html(
                    'Your Re Password is not match with New password.');
                return false;
            }

            return true;
        }

    });

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
        "date": moment(day).format('MMM D,YY'),
        "full_date": moment(day).format('Y/M/D')
    };
    var current_date = new Date();
    var last_date = new Date(addMonths(new Date(), 3).toString());
    var dates = [];
    var weekday = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
    for (var day = current_date; day <= last_date; day.setDate(day.getDate() + 1)) {
        var same = moment(today_date).isSame(moment(day).format('Y/M/D'));
        var day_name = weekday[day.getDay()];
        if (same) {
            selected_date_model = {
                'day_text': 'Today',
                'day': day_name,
                "date": moment(day).format('MMM D,YY'),
                "full_date": moment(day).format('Y/M/D')
            };
            dates.push({
                'day_text': 'Today',
                'day': day_name,
                "date": moment(day).format('MMM D,YY')
            });
        } else {
            dates.push({
                'day_text': day_name,
                'day': day_name,
                "date": moment(day).format('MMM D,YY')
            });
        }
    }
    new Vue({
        el: '#manage_avail',
        data: {
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
            handle_type: 'date',
            submit_btn_text: 'Save',
        },
        methods: {
            selectedData: function(data) {
                this.selected_date_model = data;
            },
            clickHadleType: function(type) {
                this.handle_type = type;
            },
            saveAvai: function() {
                var _this = this;
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
                                "date": _this.selected_date_model,
                                "slots": _this.intervals,
                                "handle_type": _this.handle_type
                            },
                            dataType: "json",
                            success: function(response) {
                                _this.submit_btn_text = 'Save';
                                Swal.fire('Success!', 'Availability Saved', 'success');
                            },
                            error: function(jqXHR) {
                                _this.submit_btn_text = 'Save';
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
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.className += " active";
        if(cityName=='edit_profile'){
            $("#OpenImgUpload").css('cursor','pointer');
        }else{
            $("#OpenImgUpload").css('cursor','auto');
        }
    }

    // Get the element with id="defaultOpen" and click on it
    document.getElementById("defaultOpen").click();
</script>
@endsection