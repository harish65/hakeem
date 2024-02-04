@extends('vendor.heal.layouts.index', ['title' => 'Sign Up','sign_page'=>True])
@section('content')
	  <!-- Bannar Section -->
<section class="top-bar-line">
</section>
<!-- Next Section -->
<section class="welcome-block">
  <div class="row d-flex align-items-center">
    <div class="col-md-5">
      <img class="img-fluid full-width" src="{{ asset('assets/heal/images/singup.jpg') }}">
      <div class="left-img-blk">
        <h4 class="mb-3">Join the best Experts</h4>
        <p>Millions of people are looking for the right expert on Heal. Start your digital journey with Expert Profile</p>
      </div>
    </div>
    <div class="col-md-5">
      <div class="welcome-part">
        <h4>Welcome to Heal</h4>
        <p>Sign up with us!</p>
        <div class="new-contact">
          <form class="form c-form" name="c-form">
            <div class="group">
                <input type="text" required="">
                <span class="highlight"></span>
                <span class="bar"></span>
                <label>Name</label>
            </div>
            <div class="group">
                <input type="text" required="">
                <span class="highlight"></span>
                <span class="bar"></span>
                <label>Email</label>
            </div>
            <div class="group mobile-no-block">
                <div class="row">
                  <div class="col-md-3 pr-0">
                    <select>
                      <option>SA +966 </option>
                      <option>SA +966 </option>
                      <option>SA +966 </option>
                    </select>
                  </div>
                  <div class="col-md-9 pl-0">
                    <input type="text" required="">
                    <span class="highlight"></span>
                    <span class="bar"></span>
                    <label>Phone Number</label>
                  </div>
                </div>
            </div>
            <div class="group">
                <input type="text" required="">
                <span class="highlight"></span>
                <span class="bar"></span>
                <label>Password</label>
            </div>
            <div class="group">
                <input type="text" required="">
                <span class="highlight"></span>
                <span class="bar"></span>
                <label>Confirm Password</label>
            </div>
            <div class="form-group read-terms mr-5">
              <input type="checkbox">
              <label for="html">Remember me</label>
            </div>
            <div class="form-group read-terms mr-1">
              <input type="checkbox">
              <label for="html">I agree to the </label>
            </div>
            <div class="form-group read-terms">
              <a class="terms-text" href="">Terms and conditions</a>
            </div>
            <div class="form-group">
              <p>Already have an account ? <a href=""> Login</a></p>
            </div>
            <hr class="mt-5">
            <div class="form-group mt-3">
            	<a class="btn" href="{{ url('register/service_provider2') }}"> Next</a>
                <!-- <button type="submit" class="btn"><span>Next</span></button>  -->
                <!-- <button type="submit" class="btn"><span>Next</span></button>  -->
            </div>         
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection