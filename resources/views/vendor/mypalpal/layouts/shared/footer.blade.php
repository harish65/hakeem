<!-- footer -->
<section class="new-footer">
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <h4>COMPANY</h4>
                <p><a href="{{ url('/about') }}">About Us</a></p>
                <p><a href="{{ url('term-conditions') }}">Terms and conditions</a></p>
                <p><a href="{{ url('privacy-policy') }}">Privacy Policy</a></p>
                <p><a href="">Reviews</a></p>
            </div>
            <div class="col-md-2">
                <h4>PROVIDERS</h4>
                <p><a href="">General Physician</a></p>
                <p><a href="">Homeopathy</a></p>
                <p><a href="">Dentist</a></p>
                <p><a href="">Psychology</a></p>
            </div>
            <div class="col-md-5">
                <h4>LEARN MORE</h4>
                <p><a href="{{ url('web/support') }}">Help & Support</a></p>
                <p><a href="{{ url('faq') }}">FAQs</a></p>
                <p><a href="{{ url('/').'?tab=blog#blogs' }}">Blogs</a></p>
            </div>
            <div class="col-md-3">
                <h4>FOLLOW US ON</h4>
                <a class="mr-4" href=""><img src="{{ asset('assets/healtcaremydoctor/images/ic_Google-signup.png') }}"></a>
                <a class="mr-4" href=""><img src="{{ asset('assets/healtcaremydoctor/images/ic_twitter-new.png') }}"></a>
                <a class="mr-4" href=""><img src="{{ asset('assets/healtcaremydoctor/images/ic_linkedin.png') }}"></a>
                <a class="mr-4" href=""><img src="{{ asset('assets/healtcaremydoctor/images/ic_facebook-letter-log.png') }}"></a>
            </div>
        </div>
    </div>
</section>
<div class="copyright-text">
    <div class="container">
        <small>Copyright © 2021 My PalPal Pvt. Ltd. All Rights Reserved.</small>
    </div>
</div>
 <!-- Select User Modal -->
 <section class="model-form">
        <div class="modal fade" id="users" tabindex="-1" role="dialog" aria-labelledby="users-popupLabel" aria-hidden="true">
            <div class="modal-dialog modal-md ">
                <div class="modal-content">
                    <div class="modal-header d-block pt-3 px-4 pb-0 border-0">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title login-head">Are you a Doctor or Patient?</h4>
                        <hr>
                    </div>
                    <div class="row select-doc-pat">
                        <div class="col-md-6 text-center">
                            <a href="#" data-type="service_provider" id="doctor_sign_up_modal_btn">
                                <label class="creator-icon d-block">
                                    <img src="{{asset('assets/healtcaremydoctor/images/ic_prof-medium@2x.png')}}" height="150px" width="180px" class="rounded-circle" >
                                </label>
                                <span class="d-block heading-28 mb-4"> Doctor </span>
                            </a>
                        </div>

                        <div class="col-md-6 text-center" >
                            <a href="#" data-type="customer" id="patient_sign_up_modal_btn">
                            <label class="creator-icon d-block">
                                <img src="{{asset('assets/healtcaremydoctor/images/prag-bus-tours.jpg')}}" height="150px" width="180px" class="rounded-circle" ></label>
                            <span class="d-block heading-28 mb-4"> Patient </span>
                            </a>
                        </div>
		            </div>
                </div>
            </div>
        </div>
    </section>
 <!-- Modal -->
 <section class="model-form">
        <div class="modal fade" id="sign-up" role="dialog" class="signupmodal" tabindex="-1" role="dialog" aria-labelledby="signup-popupLabel" aria-hidden="true">
            <div class="modal-dialog modal-md ">
                <div class="modal-content ">
                    <div class="modal-header d-block pt-3 px-4 pb-0 border-0">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <!-- <h4 class="modal-title login-head">Sign Up</h4> -->
                        <p class="mb-3" id="signup_modal_title">Sign up for</p>
                        <hr>
                    </div>
                    <div class="modal-body px-4 py-3">
                        <a class="signup-box mb-4" id="signup_phone_number">
                            <i class="far fa-user-circle"></i>
                            <span class="position-relative">Continue with Phone Number</span>
                        </a>
                        <input type="hidden" id="role_type" value="">
                        <a class="signup-box mb-4" id="signup_email">
                            <i class="far fa-envelope"></i>
                            <span class="position-relative">Continue with Email</span>
                        </a>
                        <!-- <a class="signup-box mb-4 social_login" id="signup_facebook_number">
                            <i class="fab fa-facebook-f"></i>
                            <span class="position-relative">Continue with Facebook</span>
                        </a> -->
                        <p class="text-center mt-5 pt-lg-5">By continuing, you agree to our <a href="{{ url('terms-conditions') }}">Terms of Service </a> and <br> <a href="{{ url('privacy-policy') }}"> Privacy policy</a></p>
                    </div>
                    <div class="modal-footer text-center mt-3 border-0 d-block bg-clr ">
                        <p class="emergency">Already have an account? <a href="#" class="login_btn_modal"> Login</a></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Enter-Contact Modal -->
    <div class="modal fade" id="contact_details" tabindex="-1" role="dialog" aria-labelledby="login-popupLabel" aria-hidden="true">
        <div class="modal-dialog modal-md ">
            <div class="modal-content ">
                <div class="modal-header d-block pt-3 px-4 pb-0 border-0">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title login-head">Let’s  Get Started</h4>
                    <p class="text-14 mt-1">We need your phone number to identify you</p>
                    <hr>
                </div>
                <div class="modal-body px-4 pt-2 pb-3" id="login_form" name="c-form">
                    <div class="msgdivsuccess text-success" style="display: none;"></div>
                    <div class="msgdiv text-danger" style="display: none;"></div>
                    <h6>Enter your contact number</h6>
                    <form class="form-default" id="otp_login" role="form" action="#" method="POST">
                        @csrf
                        <div class="form-group mb-4">
                            <div class="row no-gutters col-spacing">
                                <div class="col-12">
                                  <input type="tel"  onkeypress="return isNumberKey(event)" onchange="return isNumberKey(event)"  id="phoneno" name="phone">
                                  <input type="hidden" id="role_type" name="role_type" value="">
                                <input type="hidden" id="type" name="type" value="">
                                <input type="hidden" id="email" name="email" value="">
                                <input type="hidden" id="userid" name="userid" value="">
                               <input type="hidden" name="country_code" id="country_code" value="">
                               <span class="alert-danger phone"></span><br>

                                </div>

                            </div>
                        </div>
                        <div class="form-group">
                            <button type="button" class="default-btn w-100 radius-btn" id="nextbtn" ><span>Next</span></button>
                        </div>
                        <p class="text-center mt-4" ><span>By continuing, you agree to our </span><a href="{{ url('terms-conditions') }}">Terms of Service </a> <span>and</span> <br> <a href="{{ url('privacy-policy') }}"> Privacy policy</a></p>
                     </form>
                </div>
                <div class="modal-footer text-center mt-3 border-0 d-block bg-clr ">
                        <!-- <p class="emergency">Signup Using <a href="#" class="signup_email">Email</a></p> -->
                        <p class="emergency">Already Resiter? <a href="#" class="login_btn_modal"> Login</a></p>
                </div>
            </div>
        </div>
    </div>

      <!-- Enter-Login Modal -->
      <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="login-popupmodalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md ">
            <div class="modal-content ">
                <div class="modal-header d-block pt-3 px-4 pb-0 border-0">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title login-head">Let’s  Get Started</h4>
                    <p class="text-14 mt-1">We need your phone number to identify you</p>
                    <hr>
                </div>

                <div class="modal-body px-4 pt-2 pb-3" id="login_modal_form" name="l-form">
                    <div class="msgdivsuccess text-success" style="display: none;"></div>
                    <div class="msgdiv text-danger" style="display: none;"></div>
                    <h6>Enter your contact number</h6>
                    <form class="form-default" id="loginform" role="form" action="#" method="POST">
                        @csrf
                        <div class="form-group mb-4">
                            <div class="row no-gutters col-spacing">
                                <div class="col-12">
                                   <input  type="tel"  onkeypress="return isNumberKey(event)" onchange="return isNumberKey(event)"  id="phone" name="phone">

                                    <input type="hidden" id="role_type" name="role_type" value="">
                                    <input type="hidden" name="country_code" id="country_code" value="">
                                    <!-- <input class="form-control phone" type="number" onkeypress="return isNumberKey(event)" onchange="return isNumberKey(event)"  id="phoneno" name="phone" placeholder="9984929384"> -->

                                    <span class="alert-danger phone"></span><br>

                                </div>


                            </div>
                        </div>
                        <div class="form-group">
                            <button type="button" class="default-btn w-100 radius-btn" id="loginnextbtn" ><span>Next</span></button>
                        </div>
                        <p class="text-center mt-4" ><span>By continuing, you agree to our </span><a href="{{ url('terms-conditions') }}">Terms of Service </a> <span>and</span> <br> <a href="{{ url('privacy-policy') }}"> Privacy policy</a></p>
                     </form>
                </div>
                <div class="modal-footer text-center mt-3 border-0 d-block bg-clr ">
                        <div class="">
                         <a class="signup-box social_login" id="signup_facebook_number">
                            <i class="fab fa-facebook-f"></i>

                        </a>
                        <a class="signup-box social_login_google" id="signup_google_number">
                            <i class="fab fa-google"></i>

                        </a>
                        </div>
                        <p class="emergency">Login with <a href="#" class="login_email">Email</a></p>
                        <p class="emergency">Didn't have an account? <a href="#" class="login_sign_up_modal">Signup</a></p>
                </div>
            </div>
        </div>
    </div>



     <!-- Enter-Login Email Modal -->
     <div class="modal fade" id="loginEmailModal" tabindex="-1" role="dialog" aria-labelledby="loginemail-popupmodalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md ">
            <div class="modal-content ">
                <div class="modal-header d-block pt-3 px-4 pb-0 border-0">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title login-head">Login using Email</h4>
                    <p class="text-14 mt-1">We need your Email & Password to identify you</p>
                    <hr>
                </div>

                <div class="modal-body px-4 pt-2 pb-3" id="login_modal_form" name="l-form">
                    <div class="msgdivsuccess text-success" style="display: none;"></div>
                    <div class="msgdiv text-danger" style="display: none;"></div>
                    <!-- <h6>Login </h6> -->
                    <form class="form-default" id="loginform" role="form" action="#" method="POST">
                        @csrf
                        <div class="form-group mb-4">
                            <div class="row no-gutters col-spacing">
                            <div class="col-sm-12">
                                <div class="form-group">
                                     <label class="">Email</label>
                                            <input class="form-control" name="email" type="email" id="email" placeholder="Email">
                                            <span class="alert-danger email_error"></span>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                     <label class="">Password</label>
                                            <input class="form-control" name="password" type="password" id="password" placeholder="Password">
                                            <span class="alert-danger email_password"></span>
                                            <input type="hidden" id="role_type" name="role_type" value="">
                                <input type="hidden" id="logintype" name="logintype" value="email">
                                <input type="hidden" name="country_code" id="country_code" value="">
                                </div>
                            </div>

                            </div>
                        </div>

                        <div class="form-group">
                            <button type="button" class="default-btn w-100 radius-btn" id="loginnextbtn" ><span>Sign In</span></button>
                        </div>

                             <!-- <p class="emergency"> <a href="#" class="forgot" style="float:inline-end;">Forgot Password</a></p> -->

                     </form>
                </div>
                <!-- <div class="modal-footer text-center mt-3 border-0 d-block bg-clr ">

                        <p class="emergency">Didn't have an account? <a href="#" class="login_sign_up_modal">Sign Up</a></p>
                </div>                                                                                                                                                                       -->
            </div>
        </div>
    </div>


    <!-- Enter-Contact Modal -->
    <div class="modal fade" id="otp-popup" role="dialog" tabindex="-1" role="dialog" aria-labelledby="otp-popupLabel" aria-hidden="true">
        <div class="modal-dialog modal-md ">
            <div class="modal-content ">
                <div class="modal-header d-block pt-3 px-4 pb-0 border-0">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title login-head">Verification</h4>
                    <p class="text-14 mt-1">We sent you a code to <span class="phonenumber" style="font-weight: bold; opacity: 1.0;color: #323a8f;">+91 **********</span>
                    <hr>
                </div>
                <div class="modal-body px-4 pt-2 pb-3">
                <div class="msgdivsuccess text-success" style="display: none;"></div>
                    <div class="msgdiv text-danger" style="display: none;"></div>
                    <h6>Enter OTP</h6>
                    <form class="digit-group" data-group-name="digits" data-autosubmit="false" autocomplete="off" id="otpform" role="form" action="#" method="POST">
                        @csrf
                        <input type="hidden" class="role_type" name="role_type" value="">
                        <input type="hidden" class="phone" name="phone" value="">
                        <input type="hidden" class="country_code" name="country_code" value="">
                        <input type="hidden" id="signuptype" name="signuptype" value="">
                        <input type="hidden" id="email" name="email" value="">
                         <input type="hidden" name="userid" id="userid" value="">
                         <input type="hidden" name="applyoption" id="applyoption" value="">

                        <input class="form-control mr-2" value="" id="digit-1" name="digit1" data-next="digit-2"  type="number" min='0' max='9' placeholder=""  style="width: 80px; display: inline-block;">
                        <input class="form-control  mr-2" value="" id="digit-2" name="digit2" data-next="digit-3" data-previous="digit-1" min='0' max='9' type="number" placeholder=""  style="width: 80px; display: inline-block;">
                        <input class="form-control  mr-2" value=""  id="digit-3" name="digit3" data-next="digit-4" data-previous="digit-2"  min='0' max='9' type="number" placeholder=""  style="width: 80px; display: inline-block;">
                        <input class="form-control  mr-2" value="" id="digit-4"  name="digit4" data-previous="digit-3"  type="number" min='0' max='9' placeholder=""  style="width: 80px; display: inline-block;">

                        <p class="my-4"><span>Didn’t receive the code yet?</span>  <a href="#" id="resend_otp"> Resend Code</a></p>
                        <div class="form-group">
                            <button type="button" class="default-btn w-100 radius-btn" id="Submit"><span>Submit</span></button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

     <!--Signup Email Modal -->
     <div class="modal fade" id="signuppatientEmailModal" tabindex="-1" role="dialog" aria-labelledby="signuppatientemail-popupmodalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md ">
            <div class="modal-content ">
                <div class="modal-header d-block pt-3 px-4 pb-0 border-0">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title login-head">Sign Up</h4>
                    <hr>
                </div>

                <div class="modal-body px-4 pt-2 pb-3" id="signup_patient_email_form" name="l-form">
                    <div class="msgdivsuccess text-success" style="display: none;"></div>
                    <div class="msgdiv text-danger" style="display: none;"></div>
                    <!-- <h6>Login </h6> -->
                    <form class="form-default" id="SignuppatientEmailForm" role="form" action="#" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-4">
                            <div class="row no-gutters col-spacing">
                                <div class="col-sm-12">
                                <div class="profile-icon position-relative mb-lg-4 mb-3" style="margin:0 auto;">
                                @if(Auth::user())
                                    <img class="user-profile showImg" src="{{Storage::disk('spaces')->url('uploads/'.Auth::user()->profile_image)}}" alt="" >
                                    @else
                                    <img class="user-profile showImg" src="{{asset('assetss/images/ic_upload profile img.png')}}" alt="">
                                    @endif
                                    <div class="img-wrapper position-absolute">
                                        <label for="image_uploads" class="img-upload-btn"><i class="fas fa-plus"></i>
                                        </label>

                                        <input type="file" id="image_uploads" name="profile_image"
                                            accept=".jpg, .jpeg, .png" style="opacity: 0;">
                                    </div>
                                </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="">Name</label>
                                                <input class="form-control" name="name" type="name" placeholder="Name">
                                                <span class="alert-danger name_error"></span>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="">Email</label>
                                                <input class="form-control" name="email" type="email" placeholder="Email">
                                                <span class="alert-danger name_error"></span>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="">Password</label>
                                                <input class="form-control" name="password" type="password" placeholder="Password">
                                                <span class="alert-danger password_error"></span>
                                                <input type="hidden" id="role_type" name="role_type" value="">
                                                <input type="hidden" id="signuptype" name="signuptype" value="email">
                                                <input type="hidden" name="country_code" id="country_code" value="">

                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="form-group">
                            <button type="button" class="default-btn w-100 radius-btn" id="sign_upnextbtn" ><span>Sign Up</span></button>
                        </div>
<!--
                             <p class="emergency"> <a href="#" class="forgot" style="float:inline-end;">Forgot Password</a></p>
                         -->
                     </form>
                </div>
                <div class="modal-footer text-center mt-3 border-0 d-block bg-clr ">

                        <p class="emergency">Already Register? <a href="#" class="login_btn_modal">Login</a></p>
                </div>
            </div>
        </div>
    </div>


     <!--Signup Doctor Email Modal -->
     <div class="modal fade" id="signupdoctorEmailModal" tabindex="-1" role="dialog" aria-labelledby="signupdoctoremail-popupmodalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-md ">
            <div class="modal-content ">
                <div class="modal-header d-block pt-3 px-4 pb-0 border-0">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title login-head">Sign Up</h4>
                    <hr>
                    <div class="msgdivsuccess text-success" style="display: none;"></div>
                    <div class="msgdiv text-danger" style="display: none;"></div>
                </div>

                <div class="modal-body px-4 pt-2 pb-3" id="signup_doctor_email_form" name="l-form">

                    <!-- <h6>Login </h6> -->
                    <form class="form-default" id="SignupDoctorEmailForm" role="form" action="#" method="POST">
                        @csrf

                        <div class="form-group mb-4">
                            <div class="row no-gutters col-spacing">

                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="">Title</label>
                                            <select class="form-control" name="title">
                                                <option value="dr" >Dr.</option>
                                                <option value="mr" >Mr.</option>
                                                <option value="mrs" >Mrs.</option>
                                                <option value="ms" >Ms.</option>
                                            </select>

                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="">Full Name</label>
                                            <input class="form-control" type="text" name="name" placeholder="Jack Wilson">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="">Email</label>
                                            <input class="form-control" type="email" name="email" placeholder="jackwilson@gmail.com">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="">Password</label>
                                            <input class="form-control" name="password" type="password" placeholder="*******">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="">Date of birth</label>
                                            <div id="datepicker" class="input-group date" data-date-format="mm-dd-yyyy">
                                                <input class="form-control bg-transparent border-0" type="text"
                                                    name="dob" placeholder="07/07/2020" />
                                                <span class="input-group-addon">
                                                    <img src="{{asset('assetss/images/ic_calender.svg')}}" alt="">
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="">Working Since</label>
                                            <div id="datepicker2" class="input-group date" data-date-format="mm-dd-yyyy">
                                                <input class="form-control bg-transparent border-0" type="text"
                                                    name="working_since" placeholder="07/07/2020" />
                                                <span class="input-group-addon">
                                                    <img src="{{asset('assetss/images/ic_calender.svg')}}" alt="">
                                                </span>
                                            </div>

                                            <input type="hidden" id="role_type" name="role_type" value="">
                                            <input type="hidden" id="signuptype" name="signuptype" value="email">
                                            <input type="hidden" name="country_code" id="country_code" value="">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="">Qualification</label>
                                            <input class="form-control" name="qualification" type="text" placeholder="MBA">

                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="">Gender</label>
                                            {{-- <input type="hidden" value="   @if(isset($Gender)) {{$Gender[0]->preferid}} @endif" name="gender"> --}}
                                            <select class="form-control" name="gender_opt_id">
                                            @if(isset($Gender))
                                                @foreach($Gender as $gen)
                                                    <option value="{{$gen->optid}}" >{{$gen->optname}}</option>

                                                @endforeach
                                            @endif

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="">Language</label>
                                            {{-- <input type="hidden" value="  @if(isset($language)) {{$language[0]->preferid}} @endif" name="language"> --}}
                                            <select class="form-control" id="multiselect" name="language_opt_id[]" multiple="multiple">
                                            @if(isset($language))
                                                @foreach($language as $lang)
                                                        <option value="{{$lang->optid}}" >{{$lang->optname}}</option>

                                                @endforeach
                                            @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="">Bio</label>
                                            <textarea class="form-control" name="bio" id="" cols="30" rows="3"
                                                placeholder="Write your bio…"></textarea>
                                        </div>
                                    </div>

                            </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="button" class="default-btn w-100 radius-btn" id="sign_upnextbtn" ><span>Sign Up</span></button>
                        </div>
<!--
                             <p class="emergency"> <a href="#" class="forgot" style="float:inline-end;">Forgot Password</a></p>
                         -->
                     </form>
                     <!-- <div class="modal-footer text-center mt-3 border-0 d-block bg-clr ">
                        <p class="emergency">Already Register? <a href="#" class="login_btn_modal">Login</a></p>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
