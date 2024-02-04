<!-- Header section -->
<!-- <header class="fixed-top">
  <nav class="navbar navbar-expand-lg navbar-light container">
    <a class="navbar-brand" href="#"><img src="{{ asset('assets/iedu/images/main-logo.png') }}"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ml-auto display-flex align-items-center">
        <li class="nav-item active">
          <a class="nav-link" href="">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="">Courses</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="">Study Material</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="">EMSAT</a>
        </li>
        <li class="nav-item mr-4">
          <a class="nav-link" href="">About Us</a>
        </li>
        <li class="nav-item expand-search">
          <form class="nav-link" id="demo-2">
            <input type="search" placeholder="Search">
          </form>
        </li>
        <li class="nav-item login-reg-btn">
          <button class="btn no-box-shaddow"><span>Login / Register</span></button>
        </li>
      </ul>
    </div>
  </nav>
</header> -->

<header class="fixed-top innerpages-header">
  <nav class="navbar navbar-expand-lg navbar-light container  nav-mob">
    <a class="navbar-brand" href="{{ url('/') }}"><img src="{{ asset('assets/iedu/images/main-logo.png') }}"></a>
    <button class="navbar-toggler btn-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ml-auto display-flex mob-list mob-l">
      @if(Auth::check() && Auth::user()->hasrole('customer')  && Auth::user()->profile )


        <li class="nav-item {{ Request::is('web/courses') ? 'active' : '' }}">
          <a class="nav-link" href="{{ url('web/courses') }}">University Education</a>
        </li>
        <li class="nav-item {{ Request::is('web/stdudy-material') ? 'active' : '' }}">
          <a class="nav-link" href="{{ url('web/stdudy-material') }}"> Study Material</a>
        </li>
        <!-- <li class="nav-item {{ Request::is('web/grade') ? 'active' : '' }}">
          <a class="nav-link" href="{{ url('web/grade') }}">Group Study</a>
        </li> -->

        <li class="nav-item {{ Request::is('web/emsats') ? 'active' : '' }}">
          <a class="nav-link" href="{{ url('web/emsats') }}">EMSAT</a>
        </li>

        <li class="nav-item {{ Request::is('user/appointments') ? 'active' : '' }}">
          <a class="nav-link" href="{{ url('user/appointments') }}">Bookings</a>
        </li>
        <li class="nav-item {{ Request::is('web/grade') ? 'active' : '' }}">
          <a class="nav-link" href="{{ url('web/grade') }}">School Education</a>
        </li>
        <li class="nav-item {{ Request::is('user/chat/iedu') ? 'active' : '' }}">
          <a class="nav-link" href="{{ url('user/chat/iedu') }}">Chats</a>
        </li>

        <li class="nav-item {{ Request::is('web/about-us') ? 'active' : '' }} mr-4">
          <a class="nav-link" href="{{ url('web/about-us') }}">About Us</a>
        </li>

        @endif

        @if(Config('client_connected') && Config::get('client_data')->domain_name == 'iedu')
        @php $currency = 'AED';  @endphp
    @else
        @php $currency = '₹'; @endphp
    @endif

        @if(Config('client_connected') && Config::get('client_data')->domain_name != 'curenik')
        @if(Auth::check())
        @if(Auth::user()->hasRole('customer'))
        <li class="nav-item">
            <a class="nav-link" href="{{url('user/wallet')}}"><img style="background: #f78d2c;" class="mr-2" src="{{asset('assets/iedu/images/ic_wallet.png')}}" alt=""><span>{{$currency}} @if(Auth::user()->wallet) {{ Auth::user()->wallet->balance ?? ''}} @endif</span></a>
        </li>
        @else
         <li class="nav-item {{ Request::is('user/chat/iedu') ? 'active' : '' }}">
          <a class="nav-link" href="{{ url('user/chat/iedu') }}">Chats</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{url('service_provider/wallet')}}"><img style="background: #f78d2c;" class="mr-2" src="{{asset('assets/iedu/images/ic_wallet.png')}}" alt=""><span>{{$currency}} @if(Auth::user()->wallet->balance ?? ''){{Auth::user()->wallet->balance ?? ''}} @else {{0}} @endif</span></a>
        </li>
        @endif

        @endif
        @endif
        @if(!Auth::check())
        <li class="nav-item {{ Request::is('/') ? 'active' : '' }}">
          <a class="nav-link" href="{{ url('/') }}">Home</a>
        </li>
        <li class="nav-item {{ Request::is('web/courses') ? 'active' : '' }}">
          <a class="nav-link" href="{{ url('web/courses') }}">Courses</a>
        </li>
        <li class="nav-item {{ Request::is('web/grade') ? 'active' : '' }}">
          <a class="nav-link" href="{{ url('web/grade') }}">Grades</a>
        </li>
        <li class="nav-item {{ Request::is('web/stdudy-material') ? 'active' : '' }}">
          <a class="nav-link" href="{{ url('web/stdudy-material') }}">Study Material</a>
        </li>
        <li class="nav-item {{ Request::is('web/emsats') ? 'active' : '' }}">
          <a class="nav-link" href="{{ url('web/emsats') }}">EMSAT</a>
        </li>
        <li class="nav-item {{ Request::is('web/about-us') ? 'active' : '' }} mr-4">
          <a class="nav-link" href="{{ route('about-us') }}">About Us</a>
        </li>
        <li class="nav-item expand-search black-img">
          <form class="nav-link" id="demo-2">
            <input type="search" placeholder="Search">
          </form>
        </li>
        @endif


        @if(Auth::Check())
        <li class="nav-item user-acc-links">
          <div class="dropdown">
            <button class="transparent-btn p-0 dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <span class="user-small-img">
                @if(Auth::user()->profile_image)
                    <img src="{{ Storage::disk('spaces')->url('uploads/'.Auth::user()->profile_image) }}">
                @else
                    <img src="{{ asset('assets/iedu/images/favourite_lender_4.png') }}">

                @endif

            </span>
            </button>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
             <a class="dropdown-item" href="{{url('user/notifications')}}"><i style="color: #f78d2c;" class="fa fa-bell-o"></i> Notifications </a>
             @if(Auth::check() && Auth::user()->hasrole('customer')  )
             <a class="dropdown-item" href="{{url('user/account')}}"><i style="color: #f78d2c;" class="fa fa-user"></i> Profle </a>
             @endif
              <a class="dropdown-item" href="{{ url('logout') }}" style="color: black !important;"><i style="color: #f78d2c;" class="fa fa-sign-out"></i> Logout</a>
              <!-- <a class="dropdown-item" href="#" style="color: black !important;">Another action</a> -->
              <!-- <a class="dropdown-item" href="#" style="color: black !important;">Something else here</a> -->
            </div>
          </div>
        </li>
        @else
          <li class="nav-item login-reg-btn">
          <button class="btn no-box-shaddow headerSignup"><span><a href="#" data-toggle="modal" data-target="#users"> Login / Register</a></span></button>
            <!-- <button class="btn no-box-shaddow"><span><a href="{{ url('web/login') }}"> Login / Register</a></span></button> -->
          </li>
        @endif
      </ul>
    </div>
  </nav>
</header>
<!-- Select User Modal -->
<section class="model-form">
        <div class="modal  fade" id="users" tabindex="-1" role="dialog" aria-labelledby="users-popupLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg  modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header d-block pt-3 px-4 pb-0 border-0">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h5 class="modal-title login-head">Are you a Teacher or Student? </h5>
                        <hr>
                    </div>
                    <div class="row select-doc-pat m-0">
                        <div class="col-md-6 text-center">
                            <a href="#" data-type="service_provider" id="doctor_sign_up_modal_btn">
                                <!-- <label class="creator-icon d-block">
                                    <img src="{{asset('assets/iedu/images/teacher.jpg')}}" height="150px" width="180px" class="rounded-circle img-fluid" >
                                </label>
                                <span class="d-block heading-28 mb-4"> Teacher </span> -->
                                <div class="outer-card">
                                <label class="creator-icon d-block mb-0">
                                    <img src="{{asset('assets/iedu/images/stud111.png')}}" height="150px" width="180px" class="rounded-circle2 img-fluid" >
                                </label>
                                <span class="d-block heading-28 p-3"> Teacher </span>
                                </div>
                            </a>
                        </div>

                        <div class="col-md-6 text-center" >
                            <a href="#" data-type="customer" id="patient_sign_up_modal_btn">
                            <div class="outer-card">
                            <label class="creator-icon d-block mb-0">
                                <img src="{{asset('assets/iedu/images/two-s.png ')}}" height="150px" width="180px" class="rounded-circle2 img-fluid" ></label>
                            <span class="d-block heading-28 p-3"> Student </span>
                            </div>
                            </a>
                        </div>
		            </div>
                </div>
            </div>
        </div>
    </section>
    <section class="model-form">
        <div class="modal fade" id="sign-up" role="dialog" class="signupmodal" tabindex="-1" role="dialog" aria-labelledby="signup-popupLabel" aria-hidden="true">
            <div class="modal-dialog modal-md modal-dialog-centered">
                <div class="modal-content ">
                    <div class="modal-header d-block pt-3 px-4 pb-0 border-0">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <!-- <h4 class="modal-title login-head">Sign Up</h4> -->
                        <h4 class="modal-title" id="signup_modal_title">Sign up for</h4>
                        <hr>
                    </div>
                    <div class="modal-body px-4 py-3">
                        <a class="signup-box mb-4" id="signup_phone_number">
                        <i class="fa fa-phone" aria-hidden="true"></i>
                            <span class="position-relative">Continue with phone number</span>
                        </a>
                        <br>
                        <input type="hidden" id="role_type" value="">
                        <a class="signup-box mb-4" id="signup_email">
                            <i class="fa fa-envelope"></i>
                            <span class="position-relative">Continue with Email</span>
                        </a>
                        <br>
                        <a class="signup-box mb-4 social_login_google"  id="signup_google_number">
                        <i class="fa fa-google-plus"></i>
                            <span class="position-relative">Continue with Google</span>
                        </a>
                        <br>
                        <!-- <p class="text-center mt-5 pt-lg-5">By continuing, you agree to our <a href="{{ url('terms-conditions') }}">Terms of serice </a> and <br> <a href="{{ url('privacy-policy') }}"> Privacy policy</a></p> -->
                    </div>
                    <div class="modal-footer text-center mt-3 border-0 d-block bg-clr ">
                        <p class="emergency">Already have an account? <a href="#" class="login_btn_modal"> Login</a></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- <section class="model-form">
        <div class="modal fade" id="sign-up" role="dialog" class="signupmodal" tabindex="-1" role="dialog" aria-labelledby="signup-popupLabel" aria-hidden="true">
            <div class="modal-dialog modal-md modal-dialog-centered">
                <div class="modal-content ">
                    <div class="modal-header d-block pt-3 px-4 pb-0 border-0">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title" id="signup_modal_title">Sign up for</h4>
                        <hr>
                    </div>
                    <div class="modal-body px-4 py-3">
                        <a class="signup-box mb-4" id="signup_phone_number">
                        <i class="fa fa-phone" aria-hidden="true"></i>
                            <span class="position-relative">Continue with phone number</span>
                        </a>
                        <br>
                        <input type="hidden" id="role_type" value="">
                        <a class="signup-box mb-4" id="signup_email">
                            <i class="far fa-envelope"></i>
                            <span class="position-relative">Continue with Email</span>
                        </a>
                        <br>
                        <a class="signup-box mb-4" href="{{ url('/redirect?type=facebook&role=doctor') }}"  id="signup_facebook_number">
                        <i class="fa fa-facebook" aria-hidden="true"></i>
                            <span class="position-relative">Continue with Facebook</span>
                        </a>
                        <br>
                    </div>
                    <div class="modal-footer text-center mt-3 border-0 d-block bg-clr ">
                        <p class="emergency">Already have an account? <a href="#" class="login_btn_modal"> Login</a></p>
                    </div>
                </div>
            </div>
        </div>
    </section> -->
<!-- Enter-Login Modal -->
<section class="model-form">
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="login-popupmodalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content ">
                <div class="modal-header d-block pt-3 px-4 pb-0 border-0">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title login-head">Let’s  Get Started</h4>
                    <p class="text-14 mt-1"><small>We need your phone number to identify you</small></p>
                    <hr>
                </div>

                <div class="modal-body px-4 pb-0 pt-2" id="login_modal_form" name="l-form">
                    <div class="msgdivsuccess text-success" style="display: none;"></div>
                    <div class="msgdiv text-danger" style="display: none;"></div>
                    <h6>Enter your contact number</h6>
                    <form class="form-default" id="loginform" role="form" action="#" method="POST">
                        @csrf
                        <div class="form-group mb-4">
                            <div class="row no-gutters col-spacing">
                                <div class="col-12 phon_field">
                                   <input style="height:inherit !important; width: 100%" type="tel"  onkeypress="return isNumberKey(event)" onchange="return isNumberKey(event)"  id="phone" name="phone" class="form-control">

                                    <input type="hidden" id="role_type" name="role_type" value="">
                                    <input type="hidden" name="country_code" id="country_code" value="">
                                    <!-- <input class="form-control phone" type="number" onkeypress="return isNumberKey(event)" onchange="return isNumberKey(event)"  id="phoneno" name="phone" placeholder="9984929384"> -->

                                    <span class="alert-danger phone"></span><br>

                                </div>


                            </div>
                        </div>
                        <div class="form-group">
                            <button type="button" class="btn no-box-shaddow w-100 radius-btn" id="loginnextbtn" ><span>Next</span></button>
                        </div>
                        <!-- <p class="text-center mt-4" ><span>By continuing, you agree to our </span><a href="{{ url('terms-conditions') }}">Terms of serice </a> <span>and</span> <br> <a href="{{ url('privacy-policy') }}"> Privacy policy</a></p> -->
                     </form>
                </div>
                <div class="modal-footer text-center border-0 pt-0 d-block bg-clr ">
                        <p class="emergency mb-2">Login with <a href="#" class="login_email">Email</a></p>
                        <p class="emergency mb-2">Didn't have an account? <a href="#" class="login_sign_up_modal">Signup</a></p>
                </div>
            </div>
        </div>
    </div>
</section>



     <!-- Enter-Login Email Modal -->
     <section class="model-form">
     <div class="modal fade" id="loginEmailModal" tabindex="-1" role="dialog" aria-labelledby="loginemail-popupmodalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content ">
                <div class="modal-header d-block pt-3 px-4 pb-0 border-0">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title login-head">Login using Email</h4>
                    <p class="text-14 mt-1"><small>We need your Email & Password to identify you</small></p>
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
                            <button type="button" class="btn no-box-shaddow w-100 radius-btn" id="loginnextbtn" ><span>Sign In</span></button>
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
</section>
<!-- Enter-Contact Modal -->
<div class="modal fade" id="contact_details" tabindex="-1" role="dialog" aria-labelledby="login-popupLabel" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content ">
                <div class="modal-header d-block pt-3 px-4 pb-0 border-0">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title login-head">Let’s  Get Started</h4>
                    <p class="text-14 mt-1"><small>We need your phone number to identify you</small></p>
                    <hr>
                </div>
                <div class="modal-body px-4 pt-2 pb-2" id="login_form" name="c-form">
                    <div class="msgdivsuccess text-success" style="display: none;"></div>
                    <div class="msgdiv text-danger" style="display: none;"></div>
                    <h6>Enter your contact number</h6>
                    <form class="form-default" id="otp_login" role="form" action="#" method="POST">
                        @csrf
                        <div class="form-group mb-4">
                            <div class="row no-gutters col-spacing">
                                <div class="col-12 phon_field">
                                  <input type="tel"  onkeypress="return isNumberKey(event)" onchange="return isNumberKey(event)"  id="phoneno" name="phone" class="form-control">
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
                            <button type="button" class="btn no-box-shaddow w-100 radius-btn" id="nextbtn" ><span>Next</span></button>
                        </div>
                        <!-- <p class="text-center mt-4" ><span>By continuing, you agree to our </span><a href="{{ url('terms-conditions') }}">Terms of serice </a> <span>and</span> <br> <a href="{{ url('privacy-policy') }}"> Privacy policy</a></p> -->
                     </form>
                </div>
                <div class="modal-footer text-center mt-0 border-0 d-block pt-0  bg-clr ">
                        <!-- <p class="emergency">Signup Using <a href="#" class="signup_email">Email</a></p> -->
                        <p class="emergency">Already Resiter? <a href="#" class="login_btn_modal"> Login</a></p>
                </div>
            </div>
        </div>
    </div>



    <div class="modal fade" id="otp-popup" role="dialog" tabindex="-1" role="dialog" aria-labelledby="otp-popupLabel" aria-hidden="true">
        <div class="modal-dialog modal-md  modal-dialog-centered">
            <div class="modal-content ">
                <div class="modal-header d-block pt-3 px-4 pb-0 border-0">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title login-head">Verifications</h4>
                    <p class="text-14 mt-1">We sent you a code tos <span class="phonenumber" style="font-weight: bold; opacity: 1.0;color: #323a8f;">+91 **********</span>
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

                        <input class="form-control mr-2" value="" id="digit-1" name="digit1" data-next="digit-2"  type="text" placeholder=""  style="width: 80px; display: inline-block;">
                        <input class="form-control  mr-2" value="" id="digit-2" name="digit2" data-next="digit-3" data-previous="digit-1"  type="text" placeholder=""  style="width: 80px; display: inline-block;">
                        <input class="form-control  mr-2" value=""  id="digit-3" name="digit3" data-next="digit-4" data-previous="digit-2"  type="text" placeholder=""  style="width: 80px; display: inline-block;">
                        <input class="form-control  mr-2" value="" id="digit-4"  name="digit4" data-previous="digit-3"  type="text" placeholder=""  style="width: 80px; display: inline-block;">

                        <p class="my-4"><span>Didn’t receive the code yet?</span>  <a href="#" id="resend_otp"> Resend Code</a></p>
                        <div class="form-group">
                            <button type="button" class="btn no-box-shaddow w-100 radius-btn" id="Submit"><span>Submit</span></button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="otp-email" style="display: none" role="dialog" tabindex="-1" role="dialog" aria-labelledby="otp-popupLabel" aria-hidden="true">
        <div class="modal-dialog modal-md  modal-dialog-centered">
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
                    <form class="digit-group" data-group-name="digits" data-autosubmit="false" autocomplete="off" id="otpemail" role="form" action="#" method="POST">
                        @csrf
                        <input type="hidden" class="role_type" name="role_type" value="">
                        <input type="hidden" class="phone" name="phone" value="">
                        <input type="hidden" class="country_code" name="country_code" value="">
                        <input type="hidden" id="signuptype" name="signuptype" value="">
                        <input type="hidden" id="email" name="email" value="">
                         <input type="hidden" name="userid" id="userid" value="">
                         <input type="hidden" name="applyoption" id="applyoption" value="">
                        <input type="hidden" name="otpemail" id="otpemail">
                        <input type="hidden" name="otp" id="otp">
                        <input type="hidden" name="emails" id="emails">
                        <input class="form-control mr-2" value="" id="digit-1" name="digit1" data-next="digit-2"  type="text" placeholder=""  style="width: 80px; display: inline-block;">
                        <input class="form-control  mr-2" value="" id="digit-2" name="digit2" data-next="digit-3" data-previous="digit-1"  type="text" placeholder=""  style="width: 80px; display: inline-block;">
                        <input class="form-control  mr-2" value=""  id="digit-3" name="digit3" data-next="digit-4" data-previous="digit-2"  type="text" placeholder=""  style="width: 80px; display: inline-block;">
                        <input class="form-control  mr-2" value="" id="digit-4"  name="digit4" data-previous="digit-3"  type="text" placeholder=""  style="width: 80px; display: inline-block;">

                        <p class="my-4"><span>Didn’t receive the code yet?</span>  <a href="#" id="resend_otp_email" class="resend_otp_email"> Resend Code</a></p>
                        <div class="form-group">
                            <button type="button" class="btn no-box-shaddow w-100 radius-btn" id="Submit"><span>Submit</span></button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    @if(!Auth::user())
     <!--Signup Email Modal -->
     <div class="modal fade" id="signuppatientEmailModal" tabindex="-1" role="dialog" aria-labelledby="signuppatientemail-popupmodalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md  modal-dialog-centered">
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
                                    <img class="user-profile showImg" height="130px" width="130px" src="{{asset('assets/iedu/images/dummy_profile.webp')}}" alt="">
                                    @endif
                                    <div class="img-wrapper position-absolute">
                                        <label for="image_uploads" class="img-upload-btn"><i class="fa fa-plus"></i>
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

                        <div class="form-group mb-0">
                            <button type="button" class="btn no-box-shaddow w-100 radius-btn" id="sign_upnextbtn" ><span>Sign Up</span></button>
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
    @endif

      <!--Signup Doctor Email Modal -->
      <div class="modal fade" id="signupdoctorEmailModal" tabindex="-1" role="dialog" aria-labelledby="signupdoctoremail-popupmodalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-md  modal-dialog-centered ">
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
                                                <input class="form-control bg-transparent" type="text"
                                                    name="dob" placeholder="2020/07/07" />
                                                <span class="input-group-addon">
                                                    <img src="{{asset('assets/iedu/images/ic_calender.svg')}}" alt="">
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="">Working Since</label>
                                            <div id="datepicker2" class="input-group date" data-date-format="mm-dd-yyyy">
                                                <input class="form-control bg-transparent" type="text"
                                                    name="working_since" placeholder="2020/07/07" />
                                                <span class="input-group-addon">
                                                    <img src="{{asset('assets/iedu/images/ic_calender.svg')}}" alt="">
                                                </span>
                                            </div>

                                            <input type="hidden" id="role_type" name="role_type" value="">
                                            <input type="hidden" id="signuptype" name="signuptype" value="email">
                                            <input type="hidden" name="country_code" id="country_code" value="">
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="">Language</label>
                                            @if(isset($language))
                                            <input type="hidden" value="  @if(sizeof($language)>0) {{$language[0]->preferid}} @endif" name="language">
                                            <select class="form-control" name="language_opt_id[]" multiple>

                                                @foreach($language as $lang)
                                                        <option value="{{$lang->optid}}" >{{$lang->optname}}</option>

                                                @endforeach

                                            </select>
                                            @endif
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

                        <div class="form-group mb-0">
                            <button type="button" class="btn rounded w-100 radius-btn" id="sign_upnextbtn" ><span>Sign Up</span></button>
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
