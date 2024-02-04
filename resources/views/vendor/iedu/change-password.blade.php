@extends('vendor.iedu.layouts.index', ['title' => 'Profile','show_footer'=>true])
@section('content')
 <!-- Offset Top -->
 <style>
 .iti.iti--allow-dropdown.iti--separate-dial-code
 {
     width:100% !important;
 }
 form i {
    /*margin-left: -30px;*/
    cursor: pointer;
}
 </style>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
<section class="study-material">
        <div class="container">
       
            <div class="row">
                <div class="col-12 mb-5">
                    <div class="breadcrum ">
                        < <a href="{{ url('/') }}">Back</a>
                    </div>
                    <!-- <h1>Edit Profile</h1> -->
                  
                </div>
                <div class="col-lg-4 pr-lg-0">
                    <div class="bg-them border-0 text-center mb-4 p-5">
                        <div class="position-relative">
                                    @if(Auth::user()->profile_image)
                                    <img class="user-profile showImg" src="{{ Storage::disk('spaces')->url('uploads/'.Auth::user()->profile_image) }}" alt="">
                                    @else
                                    <img class="user-profile showImg" height="120px" width="120px" src="{{asset('assets/iedu/images/dummy_profile.webp')}}" alt="" id="showImg">
                                    @endif
                                
                            <div class="img-wrapper position-absolute">
                                <label for="image_uploads" class="img-upload-btn"></label>
                                <!-- <input type="file" id="image_uploads" name="profile_image" accept=".jpg, .jpeg, .png" style="opacity: 0;"> -->
                            </div>
                            </div>
                            
                    </div>
                   
                    <!-- <a class="default-btn radius-btn w-100"><span>Change Password</span></a> -->
                </div>

                <div class="col-lg-8 profile-detail">
                        @if(session()->has('message'))
                            <div class="alert alert-outline alert-success custom_alert">
                                {{ session()->get('message') }}
                            </div>
                        @endif
				   <form  action="{{ url('/change/password')}}" method="post">
		      @csrf
			   <div class="row">
				   <div class="col-md-12 col-lg-12">
						<div class="form-group show-pos">
						  <label for="pwd">Old Password</label>
                           <div class="position-relative">
    						   <input id="old_password"  type="password" placeholder="Your Old Password" class="form-control" name="old_password" value="{{ old('old_password')}}">
                               <i class="bi bi-eye-slash icon-pos" style="top: 6px !important" id="togglePassword"></i>
                           </div>
						  <!-- <i class="show-password1 fa fa-eye" ></i> -->
               			</div>
               			@error('old_password')
                        <div class="alert alert-danger change_password_succ" role="alert" >
                            <li>{{$message}}</li>
                        </div>
                        @enderror
					</div>
				</div>
				
				<div class="row">
				   <div class="col-md-12 col-lg-12">
						<div class="form-group show-pos">
						  <label for="pwd">New Password</label>
                          <div class="position-relative">
						      <input id="new_password" type="password" class="form-control" placeholder="New Password" name="new_password" value="{{ old('new_password')}}">
                            <i class="bi bi-eye-slash icon-pos" style="top: 6px !important" id="togglePassword2"></i>
                           </div>
						    <small id="emailHelp" class="form-text text-muted">Password should contain at-least 1 Uppercase, 1 Lowercase, 1 Numeric and at least 8 characters.</small>
						  
						  
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
                          <div class="position-relative">
						      <input id="re_password" type="password" class="form-control" placeholder="Retype New Password" name="re_password" value="{{ old('re_password')}}">
                           <i class="bi bi-eye-slash icon-pos" style="top: 6px !important" id="togglePassword3"></i>
                           </div>
               			</div>
               			@error('re_password')
                        <div class="alert alert-danger change_password_succ" role="alert" >
                            <li>{{$message}}</li>
                        </div>
                        @enderror
					</div>
				</div>
                <div class="form-group">
                    <button type="submit" class="btn rounded w-100 radius-btn" id="Submit"><span>Update Password</span></button>
                </div>
				
				 </form>			
                </div>
            
            </div>
        </div>


      </div>
           
        </div>
       

    </section>
<script>
        const togglePassword = document.querySelector("#togglePassword");
        const password = document.querySelector("#old_password");

        togglePassword.addEventListener("click", function () {
            // toggle the type attribute
            const type = password.getAttribute("type") === "password" ? "text" : "password";
            password.setAttribute("type", type);
            
            // toggle the icon
            this.classList.toggle("bi-eye");
        });

        const togglePassword2 = document.querySelector("#togglePassword2");
        const password2 = document.querySelector("#new_password");

        togglePassword2.addEventListener("click", function () {
            // toggle the type attribute
            const type = password2.getAttribute("type") === "password" ? "text" : "password";
            password2.setAttribute("type", type);
            
            // toggle the icon
            this.classList.toggle("bi-eye");
        });

        const togglePassword3 = document.querySelector("#togglePassword3");
        const password3 = document.querySelector("#re_password");

        togglePassword3.addEventListener("click", function () {
            // toggle the type attribute
            const type = password3.getAttribute("type") === "password" ? "text" : "password";
            password3.setAttribute("type", type);
            
            // toggle the icon
            this.classList.toggle("bi-eye");
        });


        // prevent form submit
        const form = document.querySelector("form");
        form.addEventListener('submit', function (e) {
            e.preventDefault();
        });
    </script>
@endsection