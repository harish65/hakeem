@extends('vendor.hexalud.layouts.index', ['title' => 'Home'])
@section('content')

<div class="offset-top"></div>
    <!-- Home Banner Section -->
    <section class="bannerSection  dr-slider" style="margin-top: 245px;">
        <div id="demo" class="carousel slide carousel-fade" data-ride="carousel" data-interval="6000">
            <div class="carousel-inner">
                @foreach($banners as $k => $bannersInfo)
                    <div class="carousel-item @if($k == 0) active @endif">
                        <img class="d-block w-100" src="{{ Storage::disk('spaces')->url('uploads/'.$bannersInfo->image_web) }}" alt="">
                    </div>
                @endforeach
            </div>
            <div class="container">
                <div class="row bannar-text">
                    <div class="col-lg-6 col-md-6">
                        <h5> The <span style="color: #00C46B !important">Hexalud</span> </h5><br/>
                        <h6 class="mt-1" style="font-size: 26px !important;">Welcome to Consultant services you can trust.</h6>
                        {{-- <a class="mr-4" target="__blank" href="https://play.google.com/store/apps/details?id=com.mydoctor.user"><img src="{{ asset('assets/healtcaremydoctor/images/ic_google-new.png') }}"></a>
                        <a href=""><img src="{{ asset('assets/healtcaremydoctor/images/ic_apple-new.png')}}"></a> --}}
                    </div>
                </div>
                @if(sizeof($banners)>1)
                <ul class="carousel-indicators">
                    @foreach($banners as $k => $bannersInfo)
                        <li data-target="#demo" data-slide-to="{{ $k }}" class="active"></li>
                    @endforeach
                </ul>
                @endif
            </div>
        </div>
    </section>
    <!-- About us Section -->
    <section class="about-us-section" id="about-us">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                <div class="top-rounded-text mb-3"><span class="">ABOUT US</span></div>
                <div class="heading-text mb-4">A few words about <span style="color:#00C46B"> Hexalud</span></div>
                    <p>The Hexalud is an online expert consultation application offering 24/7 expert availability. We connect you with specialist experts from across top specialties via video, audio and chat consultation. With The Hexalud, search the best experts by city, speciality or health conditions. Seamlessly book an appointment and receive instant confirmation along with expert details via SMS.</p>
                    <p>Get digital prescriptions in the app and keep those safely for future use. You'll also receive reminders for follow-ups, upcoming appointments, and more if you have the app. </p>
                </div>
                <div class="col-md-5 text-right">
                    <img class="img-fluid mt-4" src="{{ asset('assets/healtcaremydoctor/images/ic_111.png') }}">
                </div>
            </div>
        </div>
    </section>
    <!-- How it works -->
    <section class="how-it-works-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="top-rounded-text mb-3 text-center"><span class="">WORKING</span></div>
                    <div class="heading-text mb-4 text-center">How It <span> Works</span></div>
                    <p>Experts consultation with The Hexalud is an easiest and most convenient way to address your health concerns.</p>
                </div>
                <div class="col-md-3 text-center">
                    <img src="{{ asset('assets/healtcaremydoctor/images/ic_doctor.png') }}">
                    <h5 class="mt-3 mb-0">Book expert</h5>
                    <h4>Appointment</h4>
                </div>
                <div class="col-md-3 text-center">
                    <img src="{{ asset('assets/healtcaremydoctor/images/ic_online.png') }}">
                    <h5 class="mt-3 mb-0">Consult expert by</h5>
                    <h4>Chat, Call and Video</h4>
                </div>
                <div class="col-md-3 text-center">
                    <img src="{{ asset('assets/healtcaremydoctor/images/ic_ask_doctor.png') }}">
                    <h5 class="mt-3 mb-0">Get your doubts cleared</h5>
                    <h4>from Experts</h4>
                </div>
                <div class="col-md-3 text-center">
                    <img src="{{ asset('assets/healtcaremydoctor/images/ic_online.png') }}">
                    <h5 class="mt-3 mb-0">Second Opinion and</h5>
                    <h4>Health News and Tips</h4>
                </div>
            </div>
        </div>
    </section>
    <!-- cunsolt exepert -->
    <section class="consult-expert without-bg-image">
        <div class="container">
            <div class="top-rounded-text mb-3"><span class="">CONSULT</span></div>
            <p class="mb-5">Get consultations from <span> Top Experts </span></p>
            <div class="row items_cat">
                @foreach($categories as $category)
                <div class="col-md-3 col-lg-3 col-sm-6">
                    <div class="outer-phy d-flex align-items-center" style="background-color:{{ $category->color_code }}">
                        <span>
                        <img style="position:absolute;height: 130px;bottom: 10px;"  src="{{ Storage::disk('spaces')->url('original/'.$category->image) }}" class="img-fluid">
                        </span>
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

    <section class="home_blog bg-white mb-5" id="blogs">
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
                <div class="col-12 text-center mt-lg-3">
                    <a class="default-btn" href="{{url('web/blogs')}}"><span>View more</span></a>
                </div>
            </div>
        </div>
    </section>
    <!-- Next Section -->
    <section class="download-our-app">
        <div class="container">
            <div class="row d-flex align-items-center">
                <div class="col-md-6">
                    <h4>Download our app</h4>
                    <p>The Hexalud is available for your smartphone. Download our app and enjoy the mobile experience</p>
                    <a class="mr-4" target="__blank" href="https://play.google.com/store/apps/details?id=com.mydoctor.user"><img src="{{ asset('assets/healtcaremydoctor/images/ic_google-new.png') }}"></a>
                    <a href=""><img src="{{ asset('assets/healtcaremydoctor/images/ic_apple-new.png') }}"></a>
                    <div class="row">
                        <div class="col-md-10">
                            <div class="input-group mb-3 mt-4">
                              <input type="number" id="phone_number" class="form-control" placeholder="Enter 10 digit number to get app link" autocomplete="off">
                            <div class="input-group-append">
                                <button class="btn" type="button" id="send_link"><b>Submit</b></button>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <img class="img-fluid simulator" src="{{ asset('assets/healtcaremydoctor/images/ic_simulator-new.png')}}">
                </div>
            </div>
        </div>
    </section>
@endsection
@section('layout-footer-script')
<script type="text/javascript">
    $(document).ready(function() {
        var check = "{{$login_error_check}}";
        if(check == 1 || check == "1")
        {
            Swal.fire('Warning!','{{$login_error}}','warning');
        }
    });
</script>
@endsection
