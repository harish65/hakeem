@extends('vendor.heal.layouts.index', ['title' => 'Sign Up','sign_page'=>True])
@section('content')
<section class="top-bar-line second">
</section>
<!-- Next Section -->
<section class="welcome-block">
  <div class="row ">
    <div class="col-md-5">
      <img class="img-fluid full-width" src="{{ asset('assets/heal/images/singup.jpg') }}">
      <div class="left-img-blk">
        <h4 class="mb-3">Join the best Experts</h4>
        <p>Millions of people are looking for the right expert on Heal. Start your digital journey with Expert Profile</p>
      </div>
    </div>
    <div class="col-md-6">
      <div class="welcome-part profile-1 pl-5">
        <h4 class="mt-4">Set up your profile</h4>
        <p>Set up your personal details, skills and add documents</p>
        <hr>
        <h5>Profile Details</h5>
        <form class="profile-1">
        <div class="avatar-upload">
          <div class="avatar-preview">
            <img src="{{ asset('assets/heal/images/light-pink-box-image.jpg') }}">
          </div>
          <div class="avatar-edit d-flex align-items-center">
            <input type="file" id="imageUpload" accept=".png, .jpg, .jpeg">
            <label for="imageUpload"><img src="{{ asset('assets/heal/images/image_upload.png') }}"></label>
          </div>
          </div>
          <div class="row mt-5">
            <div class="col-md-6">
              <div class="form-group">
                <label>Title</label>
                <input class="form-control" type="" name="" placeholder="Dr">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Full Name</label>
                <input class="form-control" type="" name="" placeholder="Jack Wilson">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Email</label>
                <input class="form-control" type="" name="" placeholder="jackwilson@gmail.com">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group calandar">
                <label>Date of birth</label>
                <input class="form-control" type="" name="" placeholder="2 March 1994">
                <img src="{{ asset('assets/heal/images/ic_dd.png') }}">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group calandar">
                <label>Working Since</label>
                <input class="form-control" type="" name="" placeholder="2 March 1994">
                <img src="{{ asset('assets/heal/images/ic_dd.png') }}">
              </div>
            </div>
            <div class="col-md-12">
              <textarea rows="3" class="form-control" placeholder="Write your bio"></textarea>
            </div>
            <div class="col-md-12">
              <h5>Add Documents</h5>
            </div>
            <div class="col-md-6">
              <div class="row cirtification">
                <div class="col-md-9">
                  <h6>Certification <span> (optional)</span></h6>
                  <strong class="mt-4 d-block">M.D. Human Nutrition</strong>
                  <small>Gandhi Medical College, Hyderebad 2009</small>
                </div>
                <div class="col-md-3 text-right">
                  <a href="">Add</a>
                  <div class="cirtificate mt-4">
                    <img class="cirtificate-img" src="https://dummyimage.com/48x48/ccc/fff">
                    <img class="edit" src="">
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="row cirtification">
                <div class="col-md-9">
                  <h6>Professional Classification and Registration ID</h6>
                  <strong class="mt-4 d-block">Aadhar Card</strong>
                  <small>Document Type</small>
                </div>
                <div class="col-md-3 text-right">
                  <a href="">Add</a>
                  <div class="cirtificate mt-4">
                    <img class="cirtificate-img" src="https://dummyimage.com/48x48/ccc/fff">
                    <img class="edit" src="">
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-12 mt-4 mb-4">
              <hr>
              <a class="back-btn mr-4" href="{{ url('register/service_provider') }}">< Back</a>
              <a class="btn" href="{{ url('register/service_provider3') }}"> Next</a>
              <!-- <button class="btn"><span>Next</span></button> -->
            </div>
          </div>

          </form>
      </div>
    </div>
  </div>
</section>
@endsection
