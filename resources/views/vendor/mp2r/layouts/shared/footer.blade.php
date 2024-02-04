@if(isset($header_after_login))
    <footer>
        <div class="footer-btm bg-clr">
            <div class="container">
            <ul class="nav justify-content-center bottom-nav pb-2">
            <li><a href="#"> About Us  </a></li>·
            <li><a href="#"> Blogs  </a></li>·
            <li><a href="#"> Terms & Conditions   </a></li>·
            <li><a href="#"> Privacy policy  </a></li>·
            <li><a href="#"> Contact Us</a></li>
            </ul>
            <h5>© 2020 My Path 2 Recovery · All rights reserved</h5>
            </div>
        </div>
    </footer>
@else
    <footer>
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-6">
                        <a href="index.html">
                            <img src="{{ asset('assets/mp2r/images/ic_logo.png')}}" alt="" class="logo-image">
                        </a>
						 </div>
						  <div class="col-lg-9 col-md-9 col-sm-6">
                        <p>
                            My Path 2 Recovery&trade; is a HIPAA compliant virtual communication platform that provides 24/7
                            access to tools that connect people to on-demand local area resources and compassionate service
                            providers, including MAT Providers, Counselors, and Peer Support Specialists.
                        </p>
                    </div>
				</div>
				
				<div class="row py-3">
                    <div class="col-lg-12 offset-md-12 col-md-12 col-sm-12 ">
                       <!-- <h3 >Links</h3>-->
                        <ul class=" nav footer_links" style="">
                            <li>
                                <a href="#">
                                    About Us
                                </a>
                            </li>.
							 <li>
                                <a href="#">
                                    Contact Us
                                </a>
                            </li>.
							
                            <li>
                                <a href="#">
                                    Blogs
                                </a>
                            </li>.
                            <li>
                                <a href="{{ url('term-and-conditions') }}">
                                    Terms & conditions
                                </a>
                            </li>.
                            <li>
                                <a href="{{ url('privacy-policy') }}">
                                    Privacy policy
                                </a>
                            </li>.
                           
                           
                            <li>
                                <a href="{{ url('cookie-policy') }}">
                                    Cookies Policy
                                </a>
                            </li>
                        </ul>
                    </div>
					</div>
                   <!--  <div class="col-lg-3 col-md-3 col-sm-8 col-7">
                        <h3>Professionals</h3>
                        <ul class="footer_links">
                            <li>
                                <a href="#">
                                    MAT Providers
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    Counselors
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    Peer Support
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    Find Local Resources
                                </a>
                            </li>
                        </ul>
                    </div> -->
                    <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 ">
                       <!-- <h3 style="text-align: left">Social</h3> -->
                        <ul class=" nav footer_links social-link" style="text-align: left">
                            <li>
                                <a href="https://www.facebook.com/mypath2recovery" data-toggle="tooltip" title="Facebook">
                                    <img src="{{  asset('assets/images/ic_facebook.png') }}">
                                </a>
                            </li>
                            <li>
                                <a href="#" data-toggle="tooltip" title="google">
                                    <img src="{{  asset('assets/images/ic_google.png') }}">
                                </a>
                            </li>
                            <li>
                                <a href="https://twitter.com/mypath2recovery" data-toggle="tooltip" title="twitter">
                                    <img src="{{  asset('assets/images/ic_twitter.png') }}">
                                </a>
                            </li>
                            <li>
                                <a href="#" data-toggle="tooltip" title="Instagram">
                                    <img src="{{  asset('assets/images/ic_insta.png') }}">
                                </a>
                            </li>
                            <li>
                                <a href="#" data-toggle="tooltip" title="Linkdin">
                                    <img src="{{  asset('assets/images/ic_linkedin.png') }}">
                                </a>
                            </li>
                        </ul>
                    </div>
					 </div>
               
            </div>
            <div class="footer-btm">
                <div class="container">
                    <h5>© 2020 My Path 2 Recovery&trade;· All rights reserved</h5>
                </div>
            </div>
    </footer>
@endif