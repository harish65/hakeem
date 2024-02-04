@extends('vendor.iedu.layouts.index', ['title' => 'Login','no_show_header'=>true])
@section('content')
<!-- Header section -->
<section class="login-section">
  <div class="container-fluid px-0">
    <div class="row no-gutters">
      <div class="col-md-6">
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
      <div class="offset-md-1 col-md-5">
        <div class="form-side">
          <div class="top-bar pt-4">
            <p>Not a member <a href="{{ url('web/sign-up') }}">Sign Up Now</a></p>
          </div>
        <div class="vertical-center full-width">
          <h4 class="mb-3">Sign in to Continue</h4>
          <form id="guest__login" class="">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
              <label>Choose your role</label>
              <select class="form-control" name="role" required="">
                <option value="">Choose Option</option>
                <option value="customer">Student</option>
                <option value="service_provider">Teacher</option>
              </select>
              <span class="alert-danger role_error"></span>
            </div>
            <div class="form-group">
              <label>Email Address or mobile number</label>
              <input class="form-control" required="" type="email" name="email" placeholder="Email Address">
              <span class="alert-danger email_error"></span>
            </div>
            <div class="form-group">
              <label>Password</label>
              <input class="form-control" required="" type="password" name="password">
              <span class="alert-danger password_error"></span>
            </div>
            <span class="alert-danger main_error"></span>
            <div class="row">
              <div class="col-md-4 col-6">
                <div class="cutsom-checkbox-row">
                  <input id="checkbox1" type="checkbox">
                  <label for="checkbox1">Remember Me</label>
                </div>
              </div>
              <div class="col-md-8 text-right col-6">
                <p class="forgot-anchor"><a href="">Forgot Password? </a></p>
              </div>
            </div>
            <div class="form-group">
              <button type="submit"  class="btn"><span class="login_btn_text">Login</span></button>
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