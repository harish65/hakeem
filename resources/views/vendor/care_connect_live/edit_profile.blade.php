@extends('vendor.care_connect_live.layouts.dashboard', ['title' => 'Patient'])
@section('content')
 <!-- Offset Top -->
 <div class="offset-top"></div>

  <!-- Edit Profile Section -->
  <section class="profile-wrapper edit-profile mb-lg-5 py-5">
        <div class="container">
        <form id="customer_profile" enctype="multipart/form-data" method="post" action="{{ url('/update/profile-user') }}">
            <div class="row">
                <div class="col-12 mb-5">
                    <h1>Account</h1>
                </div>

            @csrf
                <div class="col-lg-4 pr-lg-0">
                    <div class="doctor_box text-center mb-4 p-5">
                        <div class="position-relative">
                                    @if(Auth::user()->profile_image)
                                    <img class="user-profile showImg" src="{{ Storage::disk('spaces')->url('uploads/'.Auth::user()->profile_image) }}" alt="">
                                    @else
                                    <img class="user-profile showImg img-circle" src="{{asset('assets/images/ic_upload profile img.png')}}" alt="" id="showImg">
                                    @endif
                                    <div class="img-wrapper position-absolute">
                                        <label for="image_uploads" class="img-upload-btn"><i class="fas fa-plus"></i>
                                        </label>

                                        <input type="file" id="image_uploads" name="profile_image"
                                            accept=".jpg, .jpeg, .png" style="opacity: 0;">
                                    </div>
                            </div>
                    </div>
                    <input class="default-btn radius-btn w-100" type="submit" value="Update" name="save" />
                    <!-- <a class=" default-btn radius-btn w-100" href="#"><span>Save</span></a> -->
                </div>
                <div class="col-lg-8 profile-detail">
                    <div class="doctor_box">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input class="form-control" name="name" type="text" required placeholder="Full Name" value="{{ isset($user->name) ? $user->name : '' }}"  maxlength="20" required>
                                    @if ($errors->has('name'))
                                                <span class="help-block text-danger">
                                                    {{ $errors->first('name') }}
                                                </span>
                                            @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Date of Birth</label>
                                    <div  class="input-group date" data-date-format="mm-dd-yyyy">
                                                <input class="form-control bg-transparent border-0" type="text" value="{{ isset($user->profile->dob) ? $user->profile->dob : ''}}"
                                                    name="dob" placeholder="11/12/2020" required/>
                                                <span class="input-group-addon">

                                                    <img src="{{asset('assets/images/ic_calender.svg')}}" alt="">
                                                </span>
                                                @if ($errors->has('dob'))
                                                <span class="help-block text-danger">
                                                    {{ $errors->first('dob') }}
                                                </span>
                                            @endif
                                        </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input class="form-control" type="email" name="email" value="{{ isset($user->email) ? $user->email : '' }}" placeholder="jackwilson@gmail.com" required>
                                            @if ($errors->has('email'))
                                                <span class="help-block text-danger">
                                                    {{ $errors->first('email') }}
                                                </span>
                                            @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Phone Number</label>
                                    <input class="form-control phone_patient" type="tel"  onkeypress="return isNumberKey(event)" value="{{ isset($user->phone) ? $user->phone : '' }}"   id="phone" name="phone">
                                    <span class="text-danger error"></span>
                                    <input type="hidden" name="country_code" id="country_code" value="{{ isset($user->country_code) ? $user->country_code : '' }}">
                                    <!-- <input class="form-control" type="text" name="phone" value="{{ isset($user->phone) ? $user->phone : '' }}" placeholder="+91**********" required> -->
                                            @if ($errors->has('phone'))
                                                <span class="help-block text-danger">
                                                    {{ $errors->first('phone') }}
                                                </span>
                                            @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="">State</label>
                                    <select class="form-control" name="state" id="state_filter">
                                            <option value="">Select State</option>
                                            @foreach($states_d as $id=> $name)
                                                <option value="{{ $name }}" >{{ $name }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('state'))
                                        <span class="help-block text-danger">
                                            {{ $errors->first('state') }}
                                        </span>
                                    @endif

                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group mb-0">
                                    <label>Bio</label>
                                    <textarea class="form-control" name="about" id="bio" cols="30" rows="3" required
                                                placeholder="Write your bio…">{{ isset($user->profile->about) ? $user->profile->about : '' }}</textarea>
                                                @if ($errors->has('bio'))
                                                <span class="help-block text-danger">
                                                    {{ $errors->first('bio') }}
                                                </span>
                                            @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </section>
<script>
        var _token = "{{ csrf_token() }}";
        var _check_phone = "{{ url('/user/checkPhoneExistOrNot') }}";
</script>
@endsection

