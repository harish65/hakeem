@extends('vendor.mp2r.layouts.index', ['title' => 'Home'])
@section('content')
<style type="text/css">
    #carouselExampleIndicators .carousel-item.active::before {
    background-image: none !important;
}
#carouselExampleIndicators .carousel-item::before {
    content: '';
    position: absolute;
    width: 100%;
    height: 100%;
    left: 0px;
    right: 0px;
    top: 0px;
    bottom: 0px;
    background-image:none !important; 
    transition: 1s;
    transition-delay: 0.5s;
}

.bannerSection {
    margin-top:0px !important;
}
</style>
    <section class="services">
        <div class="container">
            <h2>Consult Professionals</h2>
            <p>Connect with caring Professionals now</p>
            <div class="row">
                @foreach($categories as $category)
                    <div class="col-md-6 col-lg-3 col-sm-6 select_category"  data-category_id="{{ $category->id}}" data-is_subcategory="{{ $category->is_subcategory}}">
                        @if($category->id == 2)

                        <a href="{{ route('user.counselor')}}">
                            <div class="outer-cover"  style="box-shadow: inset 0 2px 0 0 {{ $category->color_code }}, 0 1px 6px 0 rgba(0,0,0,0.11);background:{{ $category->color_code }} ">
                                <h2 class="mat-provider" style="font-size: 21px;">{{ $category->name }} </h2>
                                <img style="height: 200px" src="{{ Storage::disk('spaces')->url('uploads/'.$category->image) }}" class="img-fluid ml-auto d-block pt-3">
                            </div>
                        </a>

                        @elseif($category->id == 4)
                        
                        <a href="https://findhelp.org/search_results/%7BZipCode">
                            <div class="outer-cover"  style="box-shadow: inset 0 2px 0 0 {{ $category->color_code }}, 0 1px 6px 0 rgba(0,0,0,0.11);background:{{ $category->color_code }} ">
                                <h2 class="mat-provider" style="font-size: 21px;">{{ $category->name }} </h2>
                                <img style="height: 200px" src="{{ Storage::disk('spaces')->url('uploads/'.$category->image) }}" class="img-fluid ml-auto d-block pt-3">
                            </div>
                        </a>
                        @else


                        <a href="{{ route('User.SPRequest',['id' => $category->id ])}}">
                            <div class="outer-cover"  style="box-shadow: inset 0 2px 0 0 {{ $category->color_code }}, 0 1px 6px 0 rgba(0,0,0,0.11);background:{{ $category->color_code }} ">
                                <h2 class="mat-provider" style="font-size: 21px;">{{ $category->name }} </h2>
                                <img style="height: 200px" src="{{ Storage::disk('spaces')->url('uploads/'.$category->image) }}" class="img-fluid ml-auto d-block pt-3">
                            </div>
                        </a>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <h2 style="margin-left: 9%;color: #232323;font-size: 32px;font-weight: bold;letter-spacing: 0;line-height: 38px;">We can guide your Path of recovery </h2>
    <p style="margin-left: 9%;opacity: 0.44;color: #000000;font-size: 18px;font-weight: 300;letter-spacing: 0;line-height: 24px;margin-bottom: 50px;">Click on the Advertisement banners to connect with professionals.</p>
    <section class="bannerSection">
        
        <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-ride="carousel" data-interval="4000">
            <div class="carousel-inner">
                @foreach($banners as $k => $bannersInfo)
                <div class="carousel-item @if($k == 0) active @endif">
                    <img class="d-block w-100" src="{{ Storage::disk('spaces')->url('uploads/'.$bannersInfo->image_web) }}" alt="">
                </div>
                @endforeach
            </div>
        </div>
    </section>


    <section class="downloadSection">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-4 col-md-4">
                    <img src="{{ asset('assets/mp2r/images/screen.png') }}" alt="" class="mobileImage">
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
                        <input type="tel" id="phone">
                        <button type="button">Send Link</button>
                    </div>

                    <div class="mobile-links">
                        <a href="https://play.google.com/store/apps/details?id=com.mypathrecovery">
                            <img src="{{ asset('assets/mp2r/images/playstore_button.png') }}" alt="">
                        </a>
                        <a href="#">
                            <img src="{{ asset('assets/mp2r/images/appstore_button.png') }}" alt="">
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </section>


    <!-- <section class="procedure">
        <h4 style="color: white;text-align: center;margin-bottom: 30px;font-size: -webkit-xxx-large;">How It Works</h4>
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <img src="{{ asset('assets/mp2r/images/ic_1.png') }}" alt="">
                    <h2>Set up account easily</h2>
                    <p>Easily set up your account to get started</p>
                </div>
                <div class="col-lg-4 col-md-6">
                    <img src="{{ asset('assets/mp2r/images/ic_health-care copy.png') }}" alt="">
                    <h2>Find a Service Provider now</h2>
                    <p>Search your area to find local resources now</p>
                </div>
                <div class="col-lg-4 col-md-12">
                    <img src="{{ asset('assets/mp2r/images/ic_3.png') }}" alt="">
                    <h2>Connect Now</h2>
                    <p>Connect instantly or schedule for later</p>
                </div>
            </div>
        </div>
    </section>



    <section class="service-provider">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-6">
                    <h2>I would like 2 help people on their journey. I am a Service Provider.</h2>
                    <p>A lot of people are looking for the right Service Provider on <i>My Path 2 Recovery</i>. Start your
                        digital journey today by creating a Service Provider profile.</p>
                    <button type="button">Get Started</button>
                </div>
                <div class="col-lg-5 col-md-6">
                    <img src="{{ asset('assets/mp2r/images/ic_pic.png') }}" alt="">
                </div>
            </div>
        </div>
    </section>
 -->
@endsection
