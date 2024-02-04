@extends('vendor.care_connect_live.layouts.dashboard', ['title' => 'Patient'])
@section('content')
 <!-- Offset Top -->
 <div class="offset-top"></div>
   <!-- Manage Availability-Doctor Section -->
   <!-- Profile Section -->
   <section class="profile-wrapper mb-lg-5 py-5">
        <div class="container">
            <div class="row">
                <div class="col-12 mb-5">
                    <h1>Account</h1>
                </div>
                <div class="col-lg-4 pr-lg-0">
                    <div class="doctor_box text-center mb-4 p-5">
                                @if($user->profile_image == '' &&  $user->profile_image == null)
                                 <img src="{{asset('assets/images/ic_upload profile img.png')}}" alt="">
                                 @else
                                 <img class="img-thumbnail"  src="{{Storage::disk('spaces')->url('uploads/'.$user->profile_image)}}" alt="">
                                @endif
                    </div>
                    <div class="user-wrapper">
                        <a href="{{url('edit/profile')}}"><label for="user-upload" class="img-upload-btn default-btn border-gray-btn radius-btn w-100"><span>Edit Profile</span> </label></a>
                       
                     </div>
                </div>
                <div class="col-lg-8 profile-detail">
                    <div class="doctor_box">
                        <h3 class="txt-24">{{ $user->name }}</h3>
                        <h6>Age : {{ $user['age'] }} years</h6>
                        <hr class="mb-lg-4">
                        <div class="user-box">
                            <label class="txt-14 d-block txt-14">Bio</label>
                            <p class="text_16">{{ $user->profile->about }} <img class="ml-2 align-middle" src="{{asset('assets/images/cill.jpg')}}" alt=""></p>
                        </div>
                        <div class="user-box">
                            <label class="d-block txt-14">Email ID</label>
                            <p class="text_16">{{ $user->email }}</p>
                        </div>
                        <div class="user-box">
                            <label class="d-block txt-14">Phone Number</label>
                            <p class="text_16">{{ $user['country_code'] }}{{ $user['phone'] }}</p>
                        </div>
                        <div class="user-box">
                            <label class="d-block txt-14">DOB</label>
                            <p class="text_16">{{ $user->profile->dob }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endsection
  