@extends('vendor.care_connect_live.layouts.dashboard', ['title' => 'Patient'])
@section('content')
 <!-- Offset Top -->
 <!-- <div class="offset-top"></div> -->
    <!-- Home Banner Section -->
    <section class="bannerSection  dr-slider mt-0">
        <div id="demo" class="carousel slide carousel-fade" data-ride="carousel" data-interval="6000">

            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="{{asset('assets/care_connect_live/images/ic_1.png')}}" alt="">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="{{asset('assets/care_connect_live/images/ic_6.png')}}" alt="">
                </div>

                <!-- @foreach($banners as $k => $bannersInfo)
                    <div class="carousel-item @if($k == 0) active @endif">
                        <img class="d-block w-100" src="{{ Storage::disk('spaces')->url('uploads/'.$bannersInfo->image_web) }}" alt="">
                    </div>
                @endforeach -->
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-8">
                        <h2 class="sale-off"><span class="text-bold">Upto</span> 40% off</h2>
                        <p class="get-counsler">Get a Counselor at upto 40% discount. Hurry up and book now.</p>
                        <a href="{{url('/user/experts')}}">  <button type="button">Book Now</button> </a>
                    </div>
                </div>
                <ul class="carousel-indicators">
                    <li data-target="#demo" data-slide-to="0" class="active"></li>
                    <li data-target="#demo" data-slide-to="1"></li>
                    <li data-target="#demo" data-slide-to="2"></li>
                    <li data-target="#demo" data-slide-to="3"></li>
                    <li data-target="#demo" data-slide-to="4"></li>
                </ul>
            </div>
        </div>
    </section>
    <!-- cunsolt exepert -->
    <section class="consult-expert">
        <div class="container">
            <h2 class="cluster-expert">Consult Experts</h2>
            <p class="get-consult">Get consultations from top experts in various fields</p>
            <div class="row items_cat">
                @foreach($categories as $category)
                <div class="col-md-3 col-lg-3 col-sm-6">
                    <div class="outer-phy d-flex align-items-center" style="background-color:{{ $category->color_code }}">
                    <a href="{{ url('/user/experts') }}/{{ $category->id }}">
                        <img style="position:absolute;height: 130px;bottom: 10px;"  src="{{ Storage::disk('spaces')->url('original/'.$category->image) }}" class="img-fluid">
                    </a>
                        <h3 class="general">
                            {{ $category->name }}
                            <h3>
                    </div>
                </div>
                @endforeach

            </div>
            <div class="get-first">
                <h3>Get first consultation free with HealthCare</h3>
                <button type="button" class="book-now">Book Now</button>
            </div>
        </div>
    </section>
    <!-- Home testimonial Section -->

    <section class="home-testimonials">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="h2">Testimonials</div>
                </div>
                <div class="col-12">
                    <div class="testimonials common-spacing">
                    @foreach($testimonials as $test)
                        <div>
                            <div class="row align-items-center testimonials-box">
                                <div class="col-4">
                                    <div class="testimonials-img">
                                        <img class="img-fluid" src="{{ Storage::disk('spaces')->url('original/'.$test->image) }}" alt="">
                                    </div>
                                </div>
                                <div class="col-8">
                                    <div class="testimonials-text text-16">
                                        <h6 class="m-0">{{$test->user->name}}</h6>
                                        <label class="d-block text-14 my-1">{{$test->title}}</label>
                                        <p>{{$test->description}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                     @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- cunsolt exepert -->
    <section class="downloadSection">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-4 col-md-4">
                    <img src="{{asset('assets/care_connect_live/images/ic_mobile.png')}}" alt="" class="mobileImage">
                </div>
                <div class="col-lg-7 offset-lg-1 col-md-8">
                    <h2>Download the HealthCare app</h2>
                    <div class="row">
                        <div class="col-md-6">
                            <ul class="featuresList">
                                <li>
                                    Video call with experts
                                </li>
                                <li>
                                    Home consultation with experts
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <ul class="featuresList">
                                <li>
                                    Chat with experts
                                </li>
                                <li>
                                    Call consultation with experts
                                </li>
                            </ul>
                        </div>
                    </div>
                    <h4>Get the app download link</h4>
                    <div class="send-link">
                        <input type="tel" id="phone">
                        <button type="button">Send Link</button>
                    </div>
                    <div class="mobile-links">
                        <a href="#">
                            <img src="{{asset('assets/care_connect_live/images/playstore_button.png')}}" alt="">
                        </a>
                        <a href="#">
                            <img src="{{asset('assets/care_connect_live/images/appstore_button.png')}}" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Home Health Query Section -->
    <section class="health_query mt-lg-5 mt-4">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <div class="text-32">
                        Are you not feeling well? <br class="d-sm-block d-none">
                        ask a Health Query
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="query_box p-4 radius-8">
                        <form class="query_form" action="">
                            <h6 class="mb-3">Where should we send secure notifications?</h6>
                            <div class="form-group">
                                <input class="form-control" type="" name="" id="" placeholder="Enter your email">
                            </div>
                            <div class="form-group">
                                <div class="row no-gutters col-spacing">
                                    <div class="col-4">
                                        <select class="form-control" name="" id="">
                                            <option value="">+91 (IND)</option>
                                        </select>
                                    </div>
                                    <div class="col-8">
                                        <input class="form-control" type="text" placeholder="Enter your mobile number">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" name="" id="" cols="30" rows="5"
                                    placeholder="What is your question?"></textarea>
                            </div>

                            <button class="default-btn"><span>Post a query</span></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Home Blog Section -->
    <section class="home_blog">
        <div class="container">
            <div class="row mb-4 pb-lg-3">
                <div class="col-12">
                    <div class="h2">Blog</div>
                </div>
            </div>
            <div class="row  spacing-36">
            @foreach($blogs as $blog)
                @if($blog->user_id)



                <div class="col-lg-4 col-sm-6 mb-4 pb-lg-3">
                    <div class="blog-box radius-8 overflow-hidden">
                        <img src="images/blog1.jpg" alt="">
                        <div class="text-box py-4 px-3">
                            <h6 class="m-0">{{ $blog->title }}</h6>
                            <p>{{ \Illuminate\Support\Str::limit($blog->description, 99, $end='...') }}</p>

                            <div class="d-flex align-items-center justify-content-between mt-2">
                                <label class="text-14">{{ isset($username) ? $username: ''}} </label>
                                <a class="text-14" href="{{ url('web/blog-view').'/'.$blog->id }}">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
              @endforeach
                <!-- <div class="col-12 text-center mt-lg-3">
                    <a class="default-btn" href="#"><span>View more</span></a>
                </div> -->
            </div>
        </div>
    </section>
@endsection
