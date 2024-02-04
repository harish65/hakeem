@extends('vendor.hexalud.layouts.dashboard', ['title' => 'Patient'])
@section('content')
 <!-- Offset Top -->
 <style>
 .iti.iti--allow-dropdown.iti--separate-dial-code
 {
     width:100% !important;
 }
 </style>

 <div class="offset-top"></div>
   <!-- Edit Profile Section -->
   <section class="profile-wrapper edit-profile mb-lg-5 py-5">
        <div class="container">

            <div class="row">
                <div class="col-12 mb-5">
                    <h1>Change Password</h1>

                </div>
                <div class="col-lg-4 pr-lg-0">
                    <div class="bg-them border-0 text-center mb-4 p-5">
                        <div class="position-relative">
                                    @if(Auth::user()->profile_image)
                                    <img class="user-profile showImg" src="{{ Storage::disk('spaces')->url('uploads/'.Auth::user()->profile_image) }}" alt="">
                                    @else
                                    <img class="user-profile showImg" src="{{asset('assetss/images/ic_upload profile img.png')}}" alt="" id="showImg">
                                    @endif

                            <div class="img-wrapper position-absolute" style="display:none;">
                                <label for="image_uploads" class="img-upload-btn"><i class="fas fa-camera"></i> </label>
                                <input type="file" id="image_uploads" name="profile_image"
                                            accept=".jpg, .jpeg, .png" style="opacity: 0;">
                            </div>
                            </div>

                    </div>

                    <!-- <a class="default-btn radius-btn w-100 update_phone"><span>Update Phone</span></a> -->
                </div>

                <div class="col-lg-8 profile-detail">
                        @if(session()->has('message'))
                            <div class="alert alert-outline alert-success custom_alert">
                                {{ session()->get('message') }}
                            </div>
                        @endif
				   <form  action="{{ url('/change/password')}}" method="post">
		      @csrf
                @if(Auth::user()->provider_type=='email')
                {{--  && Auth::user()->is_password_set!=0  --}}
    			   <div class="row">
    				   <div class="col-md-12 col-lg-12">
    						<div class="form-group show-pos">
    						  <label for="pwd">Old Password</label>
    						   <input id="old_password" type="password" class="form-control" name="old_password" value="">
                   			</div>
                   			@error('old_password')
                            <div class="alert alert-danger change_password_succ" role="alert" >
                                <li>{{$message}}</li>
                            </div>
                            @enderror
    					</div>
    				</div>
                @endif

				<div class="row">
				   <div class="col-md-12 col-lg-12">
						<div class="form-group show-pos">
						  <label for="pwd">New Password</label>
						   <input id="new_password" type="password" class="form-control" name="new_password" value="{{ old('new_password')}}">
						  <!-- <i class="show-password1 far fa-eye" ></i> -->
						    <!-- <small id="emailHelp" class="form-text text-muted">Password should contain at-least 1 Uppercase, 1 Lowercase, 1 Numeric and at least 8 characters.</small> -->


               			</div>
               			@error('new_password')
                        <div class="alert alert-danger change_password_succ" role="alert" >
                            <li>{{$message}}</li>
                        </div>
                        @enderror
					</div>
				</div>

				<div class="row">
				   <div class="col-md-12 col-lg-12">
						<div class="form-group show-pos">
						  <label for="pwd">Retype New Password</label>
						   <input id="re_password" type="password" class="form-control" name="re_password" value="{{ old('re_password')}}">
						  <!-- <i class="show-password1 far fa-eye" ></i> -->
               			</div>
               			@error('re_password')
                        <div class="alert alert-danger change_password_succ" role="alert" >
                            <li>{{$message}}</li>
                        </div>
                        @enderror
					</div>
				</div>
                <div class="form-group">
                    <button type="submit" class="default-btn w-100 radius-btn" id="Submit"><span>Update</span></button>
                </div>

				 </form>
                </div>

            </div>
        </div>


      </div>

        </div>


    </section>
    <script>

    </script>
@endsection
