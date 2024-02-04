@extends('vendor.iedu.layouts.index', ['title' => 'Login','no_show_header'=>true])
@section('content')
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
                <img src="{{ asset('assets/iedu/images/ic_1.png') }}" class="d-block w-100" alt="...">
              </div>
              <div class="carousel-item">
                <img src="{{ asset('assets/iedu/images/ic_1.png') }}" class="d-block w-100" alt="...">
              </div>
              <div class="carousel-item">
                <img src="{{ asset('assets/iedu/images/ic_1.png') }}" class="d-block w-100" alt="...">
              </div>
            </div>
          </div>
          <div class="vertical-center text-center full-width"><a href=""><img class="img-fluid logo" src="{{ asset('assets/iedu/images/ic_2.png') }}"></a></div>
        </div>
      </div>
      <div class="offset-md-1 col-md-5" id="signup_form_cus">
        <div class="form-side">
          <div class="top-bar pt-4">
            <p>Already a member ? <a href="{{ url('web/login') }}"> Sign In</a></p>
          </div>
        <div class="vertical-center full-width">
          <h4 class="mb-3">Sign up to Continue</h4>
          <form id="guest__signup_step_first" class="">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="user_side" value="customer">
            <input type="hidden" name="step" value="step1">
            <div class="form-group">
              <div class="row">
                <div class="col-md-6">
                  <label>First Name</label>
                  <input class="form-control" type="text" name="first_name" id="first_name_first">
                  <span class="alert-danger first_name_error"></span>
                </div>
                <div class="col-md-6">
                  <label>Last Name</label>
                  <input class="form-control" type="text" name="last_name" id="last_name_first">
                  <span class="alert-danger last_name_error"></span>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label>Email Address</label>
              <input class="form-control" type="email" name="email" id="email_first">
              <span class="alert-danger email_error"></span>
            </div>
            <div class="form-group">
              <label>Mobile Number</label>
              <input class="form-control" type="number" name="phone" id="phone_first">
              <span class="alert-danger phone_error"></span>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="cutsom-checkbox-row">
                  <input id="checkbox1" type="checkbox" required="">
                  <label for="checkbox1">By signing up you’re agree with our <a href=""> Terms of Service </a> and <a href=""> Privacy Policy</a>.</label>
                </div>
              </div>
            </div>
            <div class="form-group">
              <button class="btn"><span class="login_btn_text">Next</span></button>
            </div>
          </form>
        </div>
        <div class="bottom-block">
          <div class="row">
            <div class="col-md-7 pr-0">
              <small>©Copyright 2020 by Consumables and Stores. All Rights Reserved.</small>
            </div>
            <div class="col-md-5 text-right">
              <a href="">Privacy Policy<span class="ml-2 mr-2">•</span></a><a href="">   Terms & Conditions</a>
            </div>
          </div>
        </div>
        </div>
      </div>

      <div class="offset-md-1 col-md-5" id="set_password" style="display: none;">
        <div class="form-side">
          <div class="top-bar pt-4">
            <p><a href="javascript:void(0);" id="back_btn_second">Back</a></p>
          </div>
        <div class="vertical-center full-width">
          <h4 class="mb-2">Set Password</h4>
          <form id="guest__signup_step_second" class="">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="user_side" value="customer">
            <input type="hidden" name="step" value="step2">
            <input type="hidden" name="email" id="email">
            <input type="hidden" name="first_name" id="first_name">
            <input type="hidden" name="last_name" id="last_name">
            <input type="hidden" name="phone" id="phone">
            <span class="alert-danger all_error"></span>
            <div class="form-group">
              <div class="row">
                <div class="col-md-12">
                  <label>Enter Password</label>
                  <input class="form-control" type="password" name="password" placeholder="6+ characters">
                  <span class="alert-danger password_error"></span>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-md-12">
                  <label>Confirm Password</label>
                  <input class="form-control" type="password" name="password_confirmation" placeholder="Re-enter your Password">
                  <span class="alert-danger confirm_password_error"></span>
                </div>
              </div>
            </div>
            <div class="form-group">
              <button class="btn"><span class="login_btn_text">Save</span></button>
            </div>
          </form>
        </div>
        <div class="bottom-block">
          <div class="row">
            <div class="col-md-7 pr-0">
              <small>©Copyright 2020 by Consumables and Stores. All Rights Reserved.</small>
            </div>
            <div class="col-md-5 text-right">
              <a href="">Privacy Policy<span class="ml-2 mr-2">•</span></a><a href="">   Terms & Conditions</a>
            </div>
          </div>
        </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection

 