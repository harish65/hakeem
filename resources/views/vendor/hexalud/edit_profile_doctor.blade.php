@extends('vendor.hexalud.layouts.dashboard', ['title' => 'Patient'])
@section('content')
 <!-- Offset Top -->
 <style>
 .iti.iti--allow-dropdown.iti--separate-dial-code
 {
     width:100% !important;
 }
 .error
 {
     color:red;
     font-size:large;
 }
 </style>
 <div class="offset-top"></div>
   <!-- Edit Profile Section -->
   <section class="profile-wrapper edit-profile mb-lg-5 py-5">
        <div class="container">
        <form id="customer_profile" class="bg-them doctor-form common-form border-0" enctype="multipart/form-data" method="post" action="{{ url('/service_provider/profile/update') }}">
            <div class="row">
                <div class="col-12 mb-5">
                    <h1 style="color: #000;margin-left: 15px;">Edit Profile</h1>

                </div>
                <div class="col-lg-4 pr-lg-0">
                    <div class="bg-them border-0 text-center mb-4 p-5">
                        <div class="position-relative">
                                    @if(Auth::user()->profile_image)
                                    <img class="user-profile showImg" src="{{ Storage::disk('spaces')->url('uploads/'.Auth::user()->profile_image) }}" alt="">
                                    @else
                                    <img class="user-profile showImg" src="{{asset('assetss/images/ic_upload profile img.png')}}" alt="" id="showImg">
                                    @endif

                            <div class="img-wrapper position-absolute">
                                <label for="image_uploads" class="img-upload-btn"><i class="fas fa-camera"></i> </label>
                                <input type="file" id="image_uploads" name="profile_image"
                                            accept=".jpg, .jpeg, .png" style="opacity: 0;">
                            </div>
                            </div>

                    </div>
                    @if($user->provider_type=='email')
                    <a class="default-btn radius-btn w-100 " href="{{url('user/change/password')}}"><span>Change Password</span></a>
                    @endif
                    {{--  <a class="default-btn radius-btn w-100 update_phone"><span>Update Phone</span></a>  --}}
                </div>
                <div class="col-lg-8 profile-detail">
                <div class="col-12">
                @if(session('status.success'))
                                <div class="alert alert-outline alert-success custom_alert">
                                    {{ session('status.success') }}
                                </div>
                     @endif
                     @if(session('status.error'))
                                <div class="alert alert-outline alert-danger custom_alert">
                                    {{ session('status.error') }}
                                </div>
                     @endif
                </div>
                         <input type="hidden" name="user_id" value="{{ $user->id }}"/>
                            <input type="hidden" class="form-control" id="step" name="step" value="1">
                            {{ csrf_field() }}
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Title<span class="error">*</span></label>
                                    <select class="form-control" name="title" required>
                                            <option value="dr"  >Dr.</option>
                                                <option value="mr"  >Mr.</option>
                                                <option value="mrs"  >Mrs.</option>
                                                <option value="ms"  >Ms.</option>

                                            </select>
                                            @if ($errors->has('title'))
                                                <span class="help-block text-danger">
                                                    {{ $errors->first('title') }}
                                                </span>
                                            @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Name<span class="error">*</span></label>
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
                                    <label>Email<span class="error">*</span></label>
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
                                    <label>Phone Number<span class="error">*</span></label>
                                    <input @if($user->phone)readonly @endif class="form-control phone_patient" type="tel"  onkeypress="return isNumberKey(event)" value="{{ isset($user->phone) ? $user->phone : '' }}"   id="phone" name="phone">
                                    <span class="text-danger error"></span>
                                    <input type="hidden"  name="country_code" id="country_code" value="{{ isset($user->country_code) ? $user->country_code : '' }}">
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
                                    <label>Date of birth<span class="error">*</span></label>
                                    <div id="datepicker4" class="input-group date" data-date-format="mm-dd-yyyy">
                                                <input class="form-control bg-transparent border-0" type="date" value="{{ isset($profile->dob) ? $profile->dob : ''}}"
                                                    name="dob" placeholder="11/12/2020" required/>
                                                <span class="input-group-addon">

                                                    <!-- <img src="{{asset('assetss/images/ic_calender.svg')}}" alt=""> -->
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
                                    <label>Working Since<span class="error">*</span></label>
                                    <div class="input-group date" data-date-format="mm-dd-yyyy">
                                                <input class="form-control bg-transparent border-0" type="date" value="{{ isset($profile->working_since) ? $profile->working_since : ''}}"
                                                    name="working_since" placeholder="11/12/2020" required/>
                                                <span class="input-group-addon">

                                                    <!-- <img src="{{asset('assetss/images/ic_calender.svg')}}" alt=""> -->
                                                </span>
                                                @if ($errors->has('working_since'))
                                                <span class="help-block text-danger">
                                                    {{ $errors->first('working_since') }}
                                                </span>
                                            @endif
                                            </div>
                                </div>
                            </div>
                            @php $varCheck = ''; @endphp
                                    @foreach($Gender as $gen)
                                    @foreach($getuserpreference as $getuser)
                                    @if($getuser->preference_option_id == $gen->optid &&  $getuser->preference_id ==$Gender[0]->preferid  )
                                        @php $varCheck = $gen->optname;   @endphp
                                    @endif
                                    @endforeach
                                    @endforeach

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="">Gender<span class="error">*</span></label>
                                            <input type="hidden" value="{{$Gender[0]->preferid}}" name="gender">
                                            <select class="form-control" name="gender_opt_id">
                                                @foreach($Gender as $gen)
                                                        <option value="{{$gen->optid}}" @if($varCheck == $gen->optname) selected="selected" @endif>{{$gen->optname}}</option>
                                                @endforeach

                                            </select>
                                                @if ($errors->has('gender'))
                                                <span class="help-block text-danger">
                                                    {{ $errors->first('gender') }}
                                                </span>
                                            @endif

                                        </div>
                                    </div>


                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="">Qualification<span class="error">*</span></label>
                                            <input class="form-control" type="text" name="qualification" value="{{ isset($profile->qualification) ? $profile->qualification : '' }}" placeholder="MBBS" required>
                                                @if ($errors->has('qualification'))
                                                <span class="help-block text-danger">
                                                    {{ $errors->first('qualification') }}
                                                </span>
                                            @endif

                                        </div>
                                    </div>
                                    @php $varLang = []; @endphp
                                    @foreach($language as $lang)
                                    @foreach($getuserpreference as $getuser)
                                    @if($getuser->preference_option_id == $lang->optid &&  $getuser->preference_id ==$language[0]->preferid  )
                                        @php $varLang[] = $lang->optname;   @endphp
                                    @endif

                                    @endforeach
                                    @endforeach
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="">Language<span class="error">*</span></label>
                                            <input type="hidden" value="{{$language[0]->preferid}}" name="language">
                                            <select class="form-control" name="language_opt_id[]" id="multiselect" multiple="multiple">
                                                @foreach($language as $lang)
                                                        <option  value="{{$lang->optid}}" @if(in_array($lang->optname, $varLang)) selected="selected" @endif >{{$lang->optname}}</option>

                                                @endforeach
                                            </select>
                                                @if ($errors->has('language'))
                                                <span class="help-block text-danger">
                                                    {{ $errors->first('language') }}
                                                </span>
                                            @endif

                                        </div>
                                    </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label>Bio</label>
                                    <textarea class="form-control" name="bio" id="bio" cols="30" rows="3"
                                                placeholder="Write your bio…">{{ isset($profile->about) ? $profile->about : '' }}</textarea>
                                                @if ($errors->has('bio'))
                                                <span class="help-block text-danger">
                                                    {{ $errors->first('bio') }}
                                                </span>
                                            @endif
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group mb-0 mt-3">
                                    <input type="submit" name="update" class="default-btn radius-btn" value="Update">
                                </div>
                            </div>
                        </div>

                </div>
            </div>
            </form>
        </div>



    </section>
    <script>

    </script>
@endsection
