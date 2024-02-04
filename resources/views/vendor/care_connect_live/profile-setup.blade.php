@extends('vendor.care_connect_live.layouts.dashboard', ['title' => 'Profile'])
@section('content')

<div class="offset-top" style="margin-top:51px;"></div>

    <!-- Setup Profile Section -->
    <section class="setup-wrapper position-relative">
        <div class="container">
            <div class="row no-gutters">
                <div class="col-lg-5">
                    <div class="setup-left">
                        <img class="img-fluid" src="{{asset('assets/care_connect_live/images/setup-bg.jpg')}}" alt="">

                        <div class="expert-box">
                            <div class="heading-32">Join the best Experts</div>
                            <p>Millions of people are looking for the right expert on TFH. Start your
                                digital journey with Expert Profile</p>
                        </div>
                    </div>
                </div>
                <div class="offset-lg-4 col-lg-8 setup-box">
                    <div class="setup-right pl-lg-3">
                        <div class="p-6 pb-0">
                            <h1>Set up your profile</h1>
                            <p class="mt-2">Set up your personal details, skills, consultation types and Availability
                            </p>
                            <hr class="my-lg-4">
                            <h4 class="mb-4">Profile Details</h4>
                        </div>
                        <form id="step_first" enctype="multipart/form-data"  class="setup-form common-form" method="post" action="{{ url('/profile/edit') }}">

                            <input type="hidden" name="user_id" value="{{ $user->id }}"/>
                            <input type="hidden" class="form-control" id="step" name="step" value="1">
                            {{ csrf_field() }}

                            <div class="p-6 pt-0">
                                <div class="profile-icon position-relative mb-lg-4 mb-3">

                                    @if(Auth::user()->profile_image)
                                    <img class="user-profile showImg" src="{{ Storage::disk('spaces')->url('uploads/'.Auth::user()->profile_image) }}" alt="">
                                    @else
                                    <img class="user-profile showImg" src="{{asset('assets/care_connect_live/images/ic_upload profile img.png')}}" alt="" id="showImg">
                                    @endif
                                    <div class="img-wrapper position-absolute">
                                        <label for="image_uploads" class="img-upload-btn"><i class="fas fa-plus"></i>
                                        </label>

                                        <input type="file" id="image_uploads" name="profile_image"
                                            accept=".jpg, .jpeg, .png" style="opacity: 0;">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="">Title</label>
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
                                            <label class="">Full Name</label>
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
                                            <label class="">Email</label>
                                            <input class="form-control" type="email" name="email" value="{{ isset($user->email) ? $user->email : '' }}" placeholder="jackwilson@gmail.com" required>
                                            @if ($errors->has('email'))
                                                <span class="help-block text-danger">
                                                    {{ $errors->first('email') }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>


                                    <!-- <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="">Password</label>
                                            <input class="form-control" type="password"  name="password" value="" placeholder="******" required>
                                            <i class="show-password far fa-eye" ></i>
                                            @if ($errors->has('password'))
                                                <span class="help-block text-danger">
                                                    {{ $errors->first('password') }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="">Confirm Password</label>
                                            <input class="form-control" type="password" name="confirm_password" id="confirmpassword"  value="" placeholder="******" required>
                                             <i class="show-password far fa-eye" id="togglePassword"></i>
                                            @if ($errors->has('confirm_password'))
                                                <span class="help-block text-danger">
                                                    {{ $errors->first('confirm_password') }}
                                                </span>
                                            @endif
                                        </div>
                                    </div> -->



                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="">Date of birth</label>
                                            <div  class="input-group date" data-date-format="mm-dd-yyyy">
                                                <input class="form-control bg-transparent border-0" type="text" value="{{ isset($profile->dob) ? $profile->dob : ''}}"
                                                    name="dob" placeholder="11/12/2020" required/>
                                                <span class="input-group-addon">

                                                    <img src="{{asset('assets/care_connect_live/images/ic_calender.svg')}}" alt="">
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
                                            <label class="">Working Since</label>
                                            <div class="input-group date" data-date-format="mm-dd-yyyy">
                                                <input class="form-control bg-transparent border-0" type="text" value="{{ isset($profile->working_since) ? $profile->working_since : ''}}"
                                                    name="working_since" placeholder="11/12/2020" required/>
                                                <span class="input-group-addon">

                                                    <img src="{{asset('assets/care_connect_live/images/ic_calender.svg')}}" alt="">
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
                                            <label class="">Gender</label>
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

                                    @php $varLang = []; @endphp
                                    @foreach($language as $lang)
                                    @foreach($getuserpreference as $getuser)
                                    @if($getuser->preference_option_id == $lang->optid &&  $getuser->preference_id ==$language[0]->preferid  )
                                        @php $varLang[] = $lang->optname;   @endphp
                                    @endif

                                    @endforeach
                                    @endforeach
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="">State</label>
                                            <select class="form-control" name="state" id="state_filter">
											  		<option value="">Select State</option>
											  		@foreach($states as $id=> $name)
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

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="">Qualification</label>
                                            <input class="form-control" type="text" name="qualification" value="{{ isset($profile->qualification) ? $profile->qualification : '' }}" placeholder="MBBS" required>
                                                @if ($errors->has('qualification'))
                                                <span class="help-block text-danger">
                                                    {{ $errors->first('qualification') }}
                                                </span>
                                            @endif

                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="">Language</label>
                                            <input type="hidden" value="{{$language[0]->preferid}}" name="language">
                                            <select class="form-control" name="language_opt_id[]" multiple>
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
                                            <label class="">Bio</label>
                                            <textarea class="form-control" name="bio" id="bio" cols="30" rows="3" required
                                                placeholder="Write your bio…">{{ isset($profile->about) ? $profile->about : '' }}</textarea>
                                                @if ($errors->has('bio'))
                                                <span class="help-block text-danger">
                                                    {{ $errors->first('bio') }}
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-footer2">
                                         <button type="submit" class="default-btn radius-btn" href="#"><span>Next</span> </button>
                                         </div>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endsection
