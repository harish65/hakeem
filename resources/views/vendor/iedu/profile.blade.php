@extends('vendor.iedu.layouts.index', ['title' => 'Profile','show_footer'=>true])
@section('content')
<section class="study-material">
<div class="container">
            <div class="row">
                <div class="col-12 mb-3">
                    <!-- <h1>Account</h1> -->
                </div>
                <div class="col-lg-4 pr-lg-0">
                <div class="profile-left-main">
                    <div class="doctor_box text-center mb-4 p-5">
                                @if($user->profile_image == '' &&  $user->profile_image == null)
                                 <img src="{{asset('assets/iedu/images/dummy_profile.webp')}}" alt="" height="130px" width="130px">
                                 @else
                                 <img class="img-thumbnail"  src="{{Storage::disk('spaces')->url('uploads/'.$user->profile_image)}}" alt="">
                                @endif
                    </div>
                    <div class="user-wrapper pass-btn">

                        <a class="default-btn radius-btn w-100 " href="{{url('user/change/password')}}"><span>Change Password</span></a>
                         <a class="default-btn radius-btn w-100 update_phone"><span>Update Phone</span></a>
                     </div>
                     </div>
                </div>
                <div class="col-lg-8 profile-detail">
                    <div class="doctor_box">
                    <div class="edit-btn-page">
                        <h3 class="txt-244">{{ ucwords($user->name) }}</h3>
                        <h6>Age : {{ $user['age'] }} years</h6>
                        <a href="{{url('edit/profile')}}"><label for="user-upload" class="img-upload-btn default-btn border-gray-btn border-0 radius-btn w-100"><span>Edit Profile</span> </label></a>
                       </div>
                        <hr class="mb-lg-4">

                    <div class="row">
                    <div class="col-md-6">
                        <div class="user-box mb-2">
                            <label class="txt-14 d-block txt-14">Bio</label>
                            <p class="text_16">{{ $user->profile->about  ?? ''}}
                                <!-- <img class="ml-2 align-middle" src="{{asset('assets/images/cill.jpg')}}" alt=""> -->
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="user-box">
                            <label class="d-block txt-14">Email ID</label>
                            <p class="text_16">{{ $user->email }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="user-box">
                            <label class="d-block txt-14">Phone Number</label>
                            <p class="text_16">{{ $user['country_code'] }}{{ $user['phone'] }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="user-box">
                            <label class="d-block txt-14">DOB</label>
                            <p class="text_16">{{ $user->profile->dob  ?? ''}}</p>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>

</section>
<script>
</script>
@endsection
