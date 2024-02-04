@extends('vendor.iedu.layouts.index', ['title' => 'Profile Step One','show_footer'=>true])
@section('content')
<!-- Header section -->
<section class="login-section">
  <div class="container-fluid px-0">
    <div class="row no-gutters">
      <div class="col-md-5">
        <div class="logo-side">
          <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
              <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img src="{{asset('assets/iedu/images/ic_1.png')}}" class="d-block w-100" alt="...">
              </div>
              <div class="carousel-item">
                <img src="{{asset('assets/iedu/images/ic_1.png')}}" class="d-block w-100" alt="...">
              </div>
              <div class="carousel-item">
                <img src="{{asset('assets/iedu/images/ic_1.png')}}" class="d-block w-100" alt="...">
              </div>
            </div>
          </div>
          <div class="vertical-center text-center full-width"><a href=""><img class="img-fluid logo" src="{{asset('assets/iedu/images/ic_2.png')}}"></a></div>
        </div>
      </div>
      <div class="offset-md-1 col-md-5 pb-3">
        <div class="form-side">
          <div class="top-bar pt-4">
            <!-- <p>Already a member ? <a href=""> Sign In</a></p> -->
          </div>
        <div class=" full-width tutor-sign-up-form">
          <h4 class="mb-2">Signup for IEDU</h4>
          <p>Set up your personal, category and work details</p>
          <div class="upoad-profile">
              <h3>Account Details</h3>

          </div>
          <form id="step_first" enctype="multipart/form-data"  class="setup-form common-form" method="post" action="{{ url('/profile/edit') }}">

          <input type="hidden" name="user_id" value="{{ $user->id }}"/>
          <input type="hidden" class="form-control" id="step" name="step" value="1">
          {{ csrf_field() }}

          <div class="p-6 pt-0">
              <div class="profile-icon position-relative mb-lg-4 mb-3">

                  @if($user->profile_image)
                  <img class="user-profile showImg" src="{{ Storage::disk('spaces')->url('uploads/'.$user->profile_image) }}" alt="">
                  @else
                  <img class="user-profile showImg" src="{{asset('assets/iedu/images/dummy_profile.webp')}}" height="100px" width="100px" alt="">
                  @endif
                  <div class="img-wrapper" style="position: static !important;">
                      <label for="image_uploads" class="img-upload-btn"><i class="fa fa-plus"></i>
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
                          <input class="form-control" @if(Auth::user()->provider_type == 'email'){{'readonly'}} @endif type="email" name="email" value="{{ isset($user) ? $user->email : '' }}" placeholder="jackwilson@gmail.com" >
                          @if ($errors->has('email'))
                              <span class="help-block text-danger">
                                  {{ $errors->first('email') }}
                              </span>
                          @endif
                      </div>
                  </div>

                    <!-- @if(Auth::user()->provider_type != 'email')
                  <div class="col-sm-6">
                      <div class="form-group">
                          <label class="">Password</label>
                          <input class="form-control" type="password"  name="password" value="" placeholder="******" required>
                          <i class="show-password fa fa-eye" ></i>
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
                          <i class="show-password fa fa-eye" id="togglePassword"></i>
                          @if ($errors->has('confirm_password'))
                              <span class="help-block text-danger">
                                  {{ $errors->first('confirm_password') }}
                              </span>
                          @endif
                      </div>
                  </div>
                    @endif -->


                  <div class="col-sm-6">
                      <div class="form-group">
                          <label class="">Date of birth</label>
                          <div  class="input-group date" data-date-format="mm-dd-yyyy">
                              <input class="form-control  border-0" type="text" value="{{ isset($profile->dob) ? $profile->dob : ''}}"
                                  name="dob" placeholder="11/12/2020" required/>
                              <span class="input-group-addon">

                                  <img src="{{asset('assets/care_connect_live/images/ic_calender.svg')}}" alt="" class="icon-pos">
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
                              <input class="form-control" type="text" value="{{ isset($profile->working_since) ? $profile->working_since : ''}}"
                                  name="working_since" placeholder="11/12/2020" required/>
                              <span class="input-group-addon">

                                  <img src="{{asset('assets/care_connect_live/images/ic_calender.svg')}}" alt="" class="icon-pos">
                              </span>
                              @if ($errors->has('working_since'))
                              <span class="help-block text-danger">
                                  {{ $errors->first('working_since') }}
                              </span>
                          @endif
                          </div>

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
                          <label class="">Language</label>
                          <input type="hidden" value="{{$language[0]->preferid}}" name="language">
                          <select class="form-control" name="language_opt_id[]" multiple id="option-droup-demo">
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
                      <button type="submit" class="btn rounded radius-btn" href="#"><span>Next</span> </button>
                      </div>
                  </div>
              </div>
          </div>

          </form>
        </div>
        <!-- <div class="bottom-block">
          <div class="row">
            <div class="col-md-7 pr-0">
              <small>©Copyright 2020 by Consumables and Stores. All Rights Reserved.</small>
            </div>
            <div class="col-md-5 text-right">
              <a href="">Privacy Policy<span class="ml-2 mr-2">•</span></a><a href="">   Terms & Conditions</a>
            </div>
          </div>
        </div> -->
        </div>
      </div>
    </div>
  </div>
</section>
 <div class="cursor"></div>
 <div class="spinner-wrapper">
    <div class="spinner-border"></div>
    </div>
@endsection
