@if(Auth::user()->hasRole('Customer'))
<!-- footer -->
<footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-5 col-sm-8">
                    <a href="{{url('/home')}}">
                    <h3>Consultant</h3>
                        <!-- <img src="{{asset('assets/care_connect_live/images/ic_logo2.png')}}" alt="" class=""> -->
                    </a>
                    <p>
                        One platform that takes care of your well being. You can consult experts in various fields and
                        even take classes from them in order to learn.
                    </p>
                    <ul class="nav social-list">
                        <li><a href="#"><img src="{{asset('assets/care_connect_live/images/ic_fb.png')}}"></a></li>
                        <li><a href="#"><img src="{{asset('assets/care_connect_live/images/ic_google.png')}}"></a></li>
                        <li><a href="#"><img src="{{asset('assets/care_connect_live/images/ic_twitter.png')}}"></a></li>
                        <li><a href="#"><img src="{{asset('assets/care_connect_live/images/ic_whatsapp.png')}}"></a></li>
                    </ul>
                </div>
                <div class="col-lg-3 offset-lg-1 col-md-3 col-sm-4">
                    <h3>Links</h3>
                    <ul class="footer_links">
                        <li>
                            <a href="{{ url('/').'?tab=about#about-us' }}">
                                About Us
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/').'?tab=blog#blogs' }}">
                                Blogs
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('terms-conditions') }}">
                                Terms & conditions
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('privacy-policy') }}">
                                Privacy policy
                            </a>
                        </li>
                        <li>
                            <a href="{{url('web/contact-us')}}">
                                Contact Us
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                Become an experts
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-8 col-7">
                    <h3>Consult experts</h3>
                    <ul class="footer_links">
                    @if(isset($categories))
                        @foreach($categories as $category)
                            <li>
                                <a href="#">
                                {{ $category->name }}
                                </a>
                            </li>
                        @endforeach
                    @endif
                    </ul>
                </div>
            </div>
        </div>
        <div class="footer-btm">
            <div class="container">
                @if(Config('client_connected') && Config::get('client_data')->domain_name == "tele"){
                    <h5>© 2020 Telegreen · All rights reserved</h5>
                @elseif(Config('client_connected') && Config::get('client_data')->domain_name == "hexalud")
                    <h5>© 2020 Hexalud · All rights reserved</h5>
                @else
                    <h5>© 2020 HealthCare · All rights reserved</h5>
                @endif
            </div>
        </div>
    </footer>
@endif
@if(Auth::user()->hasRole('Service Provider'))
      <!-- footer -->
      <footer class="appointment-footer mb-4">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <ul class="footer-page-link d-flex align-items-center justify-content-center mt-4 mb-3">
                        <li>
                            <a href="#">About Us</a>
                        </li>
                        <li>
                            <a href="#">Blogs</a>
                        </li>
                        <li>
                            <a href="#">Terms & Conditions</a>
                        </li>
                        <li>
                            <a href="#">Privacy policy</a>
                        </li>
                        <li>
                            <a href="#">Contact Us</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="footer-btm">
            <div class="container border-0">
                <h5>© 2020 Nilay Telemed · All rights reserved</h5>
            </div>
        </div>
    </footer>
    @endif

