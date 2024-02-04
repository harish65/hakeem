@extends('vendor.mp2r.layouts.index', ['title' => 'Home'])
@section('content')
    <section class="bannerSection">
        <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-ride="carousel"
            data-interval="6000">
            <!-- <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="{{ asset('assets/mp2r/images/banner1.jpg')}}" alt="">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="{{ asset('assets/mp2r/images/banner2.jpg')}}" alt="">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="{{ asset('assets/mp2r/images/banner3.jpg')}}" alt="">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="{{ asset('assets/mp2r/images/banner4.jpg')}}" alt="">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="{{ asset('assets/mp2r/images/banner5.jpg')}}" alt="">
                </div>
            </div> -->
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="{{ asset('assets/mp2r/images/ic_11.png')}}" alt="">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="{{ asset('assets/mp2r/images/ic_22.png')}}" alt="">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="{{ asset('assets/mp2r/images/ic_33.png')}}" alt="">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="{{ asset('assets/mp2r/images/ic_44.png')}}" alt="">
                </div>
                
            </div>

            <div class="container">
                <div class="row">
                    <div class="col-lg-5 col-md-8">
                        <h2>Your Journey. Your Way.</h2>
                        <p>24/7 access to tools that connect you to on-demand local area resources and compassionate
                            service
                            providers, including MAT Providers, Counselors, and Peer Support Specialists.</p>
                        <button type="button"  href="#" data-toggle="modal" data-target="#login2">Get Started</button>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <section class="services">
        <div class="container">
            <h2>What are you looking for?</h2>
            <p>Connect with a Service Provider or schedule an appointment </p>
            <div class="row">
                @foreach($categories as $category)
                <div class="col-md-6 col-lg-3 col-sm-6 select_category"  data-category_id="{{ $category->id}}" data-is_subcategory="{{ $category->is_subcategory}}">
                        
                        <a href="#" data-toggle="modal" data-target="#login2">
                            <div class="outer-cover"  style="box-shadow: inset 0 2px 0 0 {{ $category->color_code }}, 0 1px 6px 0 rgba(0,0,0,0.11);background:{{ $category->color_code }} ">
                                <h2 class="mat-provider" style="font-size: 21px;">{{ $category->name }} </h2>
                                <img style="height: 200px" src="{{ Storage::disk('spaces')->url('uploads/'.$category->image) }}" class="img-fluid ml-auto d-block pt-3">
                            </div>
                        </a>
                       
                    </div>
                @endforeach
            </div>
        </div>
    </section>


    <section class="downloadSection">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-4 col-md-4">
                    <img src="{{ asset('assets/mp2r/images/screen.png')}}" alt="" class="mobileImage">
                </div>
                <div class="col-lg-7 offset-lg-1 col-md-8">
                    <h2>Download the My Path 2 Recovery App now</h2>

                    <div class="row">
                        <div class="col-md-6">
                            <ul class="featuresList">
                                <li>
                                    24/7 On-Demand Access to Care
                                </li>
                                <li>
                                    Medication Assisted Treatment
                                </li>
                                <li>
                                    Connect with Expert Professionals
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <ul class="featuresList">
                                <li>
                                    Schedule Future Appointments
                                </li>
                                <li>
                                    Insurance-Covered Services
                                </li>
                                <li>
                                    Find Local Resources
                                </li>
                            </ul>
                        </div>
                    </div>

                    <h4>Get a Link of the app sent to your phone</h4>

                    <div class="send-link">
                        <input type="tel" id="phone" name="phone">
                        <button type="button" id="send_link">Send Link</button>
                    </div>

                    <div class="mobile-links">
                        <a href="https://play.google.com/store/apps/details?id=com.mypathrecovery">
                            <img src="{{ asset('assets/mp2r/images/playstore_button.png')}}" alt="">
                        </a>
                        <a href="#">
                            <img src="{{ asset('assets/mp2r/images/appstore_button.png')}}" alt="">
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </section>


    <!-- <section class="procedure" style="padding: 34px 0px 20px;">
        <h4 style="color: white;text-align: center;margin-bottom: 50px;font-size: 32px;font-weight: bold">How It Works</h4>
        <div class="container">

            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <img src="{{ asset('assets/mp2r/images/ic_1.png')}}" alt="">
                    <h2>Set up account easily</h2>
                    <p>Easily set up your account to get started</p>
                </div>
                <div class="col-lg-4 col-md-6">
                    <img src="{{ asset('assets/mp2r/images/ic_health-care copy.png')}}" alt="">
                    <h2>Find a Service Provider now</h2>
                    <p>Search your area to find local resources now</p>
                </div>
                <div class="col-lg-4 col-md-12">
                    <img src="{{ asset('assets/mp2r/images/ic_3.png')}}" alt="">
                    <h2>Connect Now</h2>
                    <p>Connect instantly or schedule for later</p>
                </div>
            </div>
        </div>
    </section> -->


    <section class="testimonials">
        <div class="container">
            <h2>
                What the recovery community has to say
                <!-- <a href="#">
                    View all testimonials
                </a> -->
            </h2>
            <h6>Shared stories</h6>
            <div class="row">
                <div class="col-md-12">
                    <div class="owl-carousel owl-theme testimonials-slides">
                        <div class="item">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="o-video">
                                        <iframe src="https://www.youtube.com/embed/ziBRMSdkplg"
                                            allowfullscreen></iframe>
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <p>Listen to what others have to say about recovery,What recovery means to me:</p>
                                    <img src="{{ asset('assets/mp2r/images/ic_play.png')}}" alt="" class="text-colon">
                                    <span class="testimonial-name">
                                        <!-- <h3></h3> -->
                                        <h5>Courtesy of the Substance Abuse and Mental Health Services Administration</h5>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="o-video">
                                        <iframe src="https://www.youtube.com/embed/tMusvDyoIRI"
                                            allowfullscreen></iframe>
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <p>Medication-Assisted Treatment Overview: Naltrexone, Methadone & Suboxone</p>
                                    <img src="{{ asset('assets/mp2r/images/ic_play.png')}}" alt="" class="text-colon">
                                    <span class="testimonial-name">
                                        <!-- <h3>Sara Scott</h3> -->
                                        <h5>Salsitz, D. A., Israel, B., & Hersh, D. (2013, June 17). Medication-Assisted Treatment Overview: Naltrexone, Methadone & Suboxone l The Partnership. In Youtube.com. Retrieved from: https://www.youtube.com/watch?v=tMusvDyoIRI</h5>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="o-video">
                                        <iframe src="https://www.youtube.com/embed/Mnd2-al4LCU"
                                            allowfullscreen></iframe>
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <p>Neuroscientist Nora Volkow, director of the National Institute on Drug Abuse at the NIH, applies a lens of addiction to the obesity epidemic.Why do our brains get addicted?</p>
                                    <img src="{{ asset('assets/mp2r/images/ic_play.png')}}" alt="" class="text-colon">
                                    <span class="testimonial-name">
                                        <!-- <h3>Sara Scott</h3> -->
                                        <h5>Volkow, N. (2015, January). Why do our brains get addicted?. In TEDMED. Retrieved from: https://www.tedmed.com/talks/show?id=309096</h5>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="o-video">
                                        <iframe src="https://www.youtube.com/embed/Oaw60ymIyN4"
                                            allowfullscreen></iframe>
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <p>This video features peer support staff telling their personal stories of recovery, highlighting the advantages of peer support services, and describing how they currently serve clients with behavioral health needs.</p>
                                    <img src="{{ asset('assets/mp2r/images/ic_play.png')}}" alt="" class="text-colon">
                                    <span class="testimonial-name">
                                        <!-- <h3>Sara Scott</h3> -->
                                        <h5>ResourcesforIntegratedCare. (2014, December 4). Integrating Peer Support Staff into Behavioral Health. In YouTube.com. Retrieved from: https://www.youtube.com/watch?v=Oaw60ymIyN4</h5>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </section>

    <section class="videoSection">
        <div class="o-video">
           <!--  <iframe src="https://www.youtube.com/embed/8W9noM54Rmc?list=PL4Zkb_7gMrOzZlVy7jIeCjwScavYp6ssm&rel=0" allowfullscreen></iframe> -->



            <!-- <iframe src="https://www.youtube.com/embed/8W9noM54Rmc?rel=0&enablejsapi=1" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture; fullscreen;"></iframe> -->

            <iframe src="https://www.youtube.com/embed/8W9noM54Rmc?autoplay=1&rel=0&fs=0&showinfo=0&loop=0" allowfullscreen></iframe>
           
        </div>

    </section>
    <section class="service-provider">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-6">
                    <h2>I would like 2 help people on their journey. I am a Service Provider.</h2>
                    <p>A lot of people are looking for the right Service Provider on <i>My Path 2 Recovery</i>. Start your digital journey today by creating a Service Provider profile.</p>
                    <button type="button" onclick="window.location='{{ url('register/service_provider') }}'">Get Started</button>
                </div>
                <div class="col-lg-5 col-md-6">
                    <img src="{{ asset('assets/mp2r/images/ic_pic.png')}}" alt="">
                </div>
            </div>
        </div>
    </section>
    <!-- <section class="star-rating">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <div class="row align-items-center">
                        <div class="col-5">
                            <h1>4.8</h1>
                        </div>
                        <div class="col-7">
                            <ul class="starList">
                                <li>
                                    <img src="{{ asset('assets/mp2r/images/ic_star copy.png')}}" alt="">
                                </li>
                                <li>
                                    <img src="{{ asset('assets/mp2r/images/ic_star copy.png')}}" alt="">
                                </li>
                                <li>
                                    <img src="{{ asset('assets/mp2r/images/ic_star copy.png')}}" alt="">
                                </li>
                                <li>
                                    <img src="{{ asset('assets/mp2r/images/ic_star copy.png')}}" alt="">
                                </li>
                                <li>
                                    <img src="{{ asset('assets/mp2r/images/ic_star copy.png')}}" alt="">
                                </li>
                            </ul>
                            <h4>2000+ reviews</h4>
                            <h5>on Google playstore</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6">
                    <div class="row">
                        <div class="col-5">
                            <h1>4.7</h1>
                        </div>
                        <div class="col-7">
                            <ul class="starList">
                                <li>
                                    <img src="{{ asset('assets/mp2r/images/ic_star copy.png')}}" alt="">
                                </li>
                                <li>
                                    <img src="{{ asset('assets/mp2r/images/ic_star copy.png')}}" alt="">
                                </li>
                                <li>
                                    <img src="{{ asset('assets/mp2r/images/ic_star copy.png')}}" alt="">
                                </li>
                                <li>
                                    <img src="{{ asset('assets/mp2r/images/ic_star copy.png')}}" alt="">
                                </li>
                                <li>
                                    <img src="{{ asset('assets/mp2r/images/ic_star copy.png')}}" alt="">
                                </li>
                            </ul>
                            <h4>1500+ reviews</h4>
                            <h5>on Apple store</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> -->
@endsection
