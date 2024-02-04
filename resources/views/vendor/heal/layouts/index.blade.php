<!DOCTYPE html>
<html lang="en">
    <head>
        @include('vendor.heal.layouts.shared/head', ['title' => $title])
    </head>

    <body data-layout-mode="detached" @yield('body-extra')>

        @include('vendor.heal.layouts.shared/header')
        <!-- Begin page -->
        <div id="wrapper-main">
            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->
            <div class="content-page">
                <div class="content">
                    @yield('content')
                </div>
            </div>
            @include('vendor.heal.layouts.shared/footer')
            @include('vendor.heal.layouts.shared/footer-script')
            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->

            <!-- The Modal -->
            <div class="modal fade" id="myModal">
              <div class="modal-dialog">
                <div class="modal-content">

                  <!-- Modal Header -->
                  <div class="modal-header">
                    <h4 class="modal-title heading-popup">Sign Up</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>

                  <!-- Modal body -->
                  <div class="modal-body login-popup pl-0 pr-0 pb-0">
                    <div class="p-4">
                      <button class="login-btns"><img class="pr-3 mr-3 brdr-1" src="{{ asset('assets/heal/images/ic_user.png') }}">Continue with phone number</button>
                      <button class="login-btns"><img class="pr-3 mr-3 brdr-1" src="{{ asset('assets/heal/images/ic_user.png') }}">Continue with Facebook</button>
                      <button class="login-btns"><img class="pr-3 mr-3 brdr-1" src="{{ asset('assets/heal/images/ic_user.png') }}">Continue with Instagram</button>
                      <p>By continuing, you agree to our <a href=""> Terms of service </a> and <a href=""> Privacy policy </a></p>
                    </div>
                    <div class="bottom">
                      <p class="mb-0">Already have an account?<a href=""> Login</a></p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- The Modal -->
            <div class="modal fade" id="myModal1">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">

                  <!-- Modal Header -->
                  <div class="modal-header d-block">
                    <h4 class="modal-title heading-popup">Let’s  Get Started</h4>
                    <p class="d-block mb-0 login-phone">We need your phone number to identify you</p>
                    <button type="button" class="close started" data-dismiss="modal">&times;</button>
                  </div>

                  <!-- Modal body -->
                  <div class="modal-body login-popup pl-0 pr-0 pb-0">
                    <div class="pl-4 pr-4 pt-0 pb-3">
                      <form class="phone-login-form">
                        <div class="form-group">
                          <label>Enter your contact number</label>
                          <div class="row">
                            <div class="col-md-3 pr-0">
                              <div class="dropdown">
                                <button class="transparent-btn full-width dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  <img class="mr-2" src="{{ asset('assets/heal/images/ic_flag.png') }}">+966
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                  <a class="dropdown-item" href="#">+966</a>
                                  <a class="dropdown-item" href="#">+966</a>
                                  <a class="dropdown-item" href="#">+966</a>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-9">
                              <input type="" name="" placeholder="94929384">
                            </div>
                          </div>
                          <button class="btn full-width mt-4 mb-4"><span>Next</span></button>
                          <p>By continuing, you agree to our <a href=""> Terms of service </a> and <a href=""> Privacy policy </a></p>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
    </body>
</html>