@extends('vendor.taradoc.layouts.index', ['title' => 'Home'])
@section('content')


<div class="offset-top"></div>
    <!-- Home Banner Section -->
    <section class="bannerSection  dr-slider mt-0">
        <div id="demo" class="carousel slide carousel-fade" data-ride="carousel" data-interval="6000">
            <div class="carousel-inner">
                @foreach($banners as $k => $bannersInfo)
                    <div class="carousel-item @if($k == 0) active @endif">
                        <img class="d-block w-100" src="{{ Storage::disk('spaces')->url('original/'.$bannersInfo->image_web) }}" alt="">
                    </div>
                @endforeach
            </div>
            <div class="container">
                <div class="row bannar-text">
                    <div class="col-lg-6 col-md-6">
                        <!--h5>TaraDoc </h5>
                        <h2 style="color:#31398f!important;">Welcome to TaraDoc.</h2-->
                        <!--h2>On-Demand, Exclusive care for Indian women</h2>
                        <h2>Proficiency, Technology, Compassion</h2>
                        <h2>Enhancing care quality and expanding the options available to Indian women</h2-->
                        <a class="mr-4" target="__blank" href=""><img src="{{ asset('assets/taradoc/images/ic_google-new.png') }}"></a>
                        <a href=""><img src="{{ asset('assets/taradoc/images/ic_apple-new.png')}}"></a>
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
    <!-- About us Section -->
    <section class="about-us-section" id="about-us">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                <div class="top-rounded-text mb-3"><span class="">ABOUT US</span></div>
                <div class="heading-text mb-4">For women <span> by women </span></div>
                    <p>
Taradoc is a digital clinic for women. An on-demand healthcare platform that will help you journey through the different stages of womanhood</p>
<p>An app that you can truly rely on because it is led by a team of close knit specialists and health care providers that we know and meet personally. Each of the professionals have been handpicked to be a part of Taradoc. They are committed to filling critical gaps in women's wellness and elevate your patient experience.</p>
                </div>
                <div class="col-md-5 text-right">
                    <img class="img-fluid mt-4" src="{{ asset('assets/taradoc/images/ic_111-Recovered.png') }}">
                </div>
            </div>
        </div>
    </section>
    <!-- How it works -->
    <section class="how-it-works-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="top-rounded-text mb-3 text-center"><span class="">Better health for women & families</span></div>
                    <div class="heading-text mb-4 text-center">How It <span> Works</span></div>
                    <p>Discover doctors, specialists & wellness professionals through our app.</p>
                </div>
                <div class="col-md-3 text-center">
                    <img class="icon-resize" src="{{ asset('assets/taradoc/images/1.svg') }}">
                    <h5 class="mt-3 mb-0">Choose a Doctor/Specialised</h5>
                    <h4>Professional</h4>
                </div>
                <div class="col-md-3 text-center">
                    <img class="icon-resize" src="{{ asset('assets/taradoc/images/2.svg') }}">
                    <h5 class="mt-3 mb-0">Choose the mode of consultation</h5>
                    <h4>chat/video/in person/at home</h4>
                </div>
                <div class="col-md-3 text-center">
                    <img class="icon-resize" src="{{ asset('assets/taradoc/images/3.svg') }}">
                    <h5 class="mt-3 mb-0">Pay securely via Razorpay</h5>
                    <h4>using the Wallet System</h4>
                </div>
                <div class="col-md-3 text-center">
                    <img class="icon-resize" src="{{ asset('assets/taradoc/images/4.svg') }}">
                    <h5 class="mt-3 mb-0">Finish your consultation and save your medical history and </h5>
                    <h4>prescriptions digitally</h4>
                </div>
            </div>
        </div>
    </section>
    <!-- cunsolt exepert -->
    <section class="consult-expert without-bg-image">
        <div class="container">
            <div class="top-rounded-text mb-3"><span class=""></span></div>
            <p class="mb-5">Taradoc is making doctor consultations convenient, reliable & private, because every woman deserves a space of her own to address her health</p>
            <div class="row items_cat">
                @foreach($categories as $category)
                <div class="col-md-3 col-lg-3 col-sm-6">
                    <div class="outer-phy d-flex align-items-center" style="background-color:{{ $category->color_code }}">
                        <img style="position:absolute;height: 130px;bottom: 10px;"  src="{{ Storage::disk('spaces')->url('original/'.$category->image) }}" class="img-fluid">
                        <h3 class="general">
                            {{ $category->name }}
                            <h3>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Home Blog Section -->
    <!--section class="home_blog bg-white mb-5" id="blogs">
        <div class="container">
            <div class="row mb-4 pb-lg-3">
                <div class="col-12">
                    <div class="top-rounded-text mb-3"><span class="">Blogs</span></div>
                </div>
            </div>
            <div class="row  spacing-36">
                @foreach($blogs as $blog)
                <div class="col-lg-4 col-sm-6 mb-4 pb-lg-3">
                    <div class="blog-box radius-8 overflow-hidden">
                        <img src="{{ Storage::disk('spaces')->url('original/'.$blog->image) }}" alt="">
                        <div class="text-box py-4 px-3">
                            <h6 class="m-0">{{ $blog->title }}</h6>
                            <p>{{ \Illuminate\Support\Str::limit($blog->description, 99, $end='...') }}</p>

                            <div class="d-flex align-items-center justify-content-between mt-2">
                                <label class="text-14">Admin </label>
                                <a class="text-14" href="{{ url('web/blog-view').'/'.$blog->id }}">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section-->
    <!-- Next Section -->
    <section class="download-our-app">
        <div class="container">
            <div class="row d-flex align-items-center">
                <div class="col-md-6">
                    <h4>Download our app</h4>
                    <p>Taradoc is available for your smartphone. Download our app and enjoy the mobile experience</p>
                    <a class="mr-4" target="__blank" href=""><img src="{{ asset('assets/taradoc/images/ic_google-new.png') }}"></a>
                    <a href=""><img src="{{ asset('assets/taradoc/images/ic_apple-new.png') }}"></a>
                    <div class="row">
                        <div class="col-md-10">
                            <div class="input-group mb-3 mt-4">
                              <input type="number" id="phone_number" class="form-control" placeholder="Enter 10 digit number to get app link" autocomplete="off">
                            <div class="input-group-append">
                                <button class="btn" type="button"><b>Submit</b></button>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <img class="img-fluid simulator" src="{{ asset('assets/taradoc/images/ic_simulator-new.png')}}">
                </div>
            </div>
        </div>
    </section>
@endsection
