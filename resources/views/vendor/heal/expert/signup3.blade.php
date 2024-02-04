@extends('vendor.heal.layouts.index', ['title' => 'Sign Up','sign_page'=>True])
@section('content')
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
    <div class="col-md-6">
      <div class="row">
        <div class="offset-md-1 col-md-10">
          <div class="welcome-part">
            <h4>Verify your phone number?</h4>
            <p>We just sent you a 6-Digit OTP on +966 7854889344. Not you? <a href="">Change Phone number</a></p>
            <form class="verify-no mt-5 mb-5">
            <div class="row">
              <div class="col-md-2">
                <input type="" name="">
              </div>
              <div class="col-md-2">
                <input type="" name="">
              </div>
              <div class="col-md-2">
                <input type="" name="">
              </div>
              <div class="col-md-2">
                <input type="" name="">
              </div>
              <div class="col-md-2">
                <input type="" name="">
              </div>
              <div class="col-md-2">
                <input type="" name="">
              </div>
            </div>
            </form>
            <p class="pt-4">Didn’t receive the code? <a href=""> Resend</a></p>
            <p class="pt-4 reset-line">Resend OTP via other options. <select><option>Email</option><option>Phone</option></select></p>
          </div>
        </div>
        <div class="col-md-12">
          <div class="bottom-buttons">
            <!-- <a class="back-btn mr-4" href="">< Back</a> -->
            <a class="back-btn mr-4" href="{{ url('register/service_provider2') }}">< Back</a>
            <button class="btn" data-toggle="modal" data-target="#myModal"><span>Next</span></button>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- The Modal -->
<div class="modal fade" id="myModal">
  <div class="modal-dialog modal-sm modal-dialog-centered">
    <div class="modal-content">
      <!-- Modal body -->
      <div class="modal-body text-center acc-sucessful">
        <img src="images/ic_tick_12.png">
        <h4>Account Successful</h4>
        <p>Loreum Ipsum is a simple and easy text and is easy to read</p>
      </div>
    </div>
  </div>
</div>
@endsection