<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('assets/healtcaremydoctor/images/favicon.ico') }}" type="image/x-icon">
    <!-- Bootstrap Css -->
    <link rel="stylesheet" href="{{ asset('assets/healtcaremydoctor/css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/healtcaremydoctor/css/slick.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/healtcaremydoctor/css/slick-theme.css') }}">
     <link rel="stylesheet" href="{{ asset('assets/healtcaremydoctor/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link rel="stylesheet" href="{{ asset('assets/healtcaremydoctor/css/intlTelInput.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/healtcaremydoctor/css/owl.carousel.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/healtcaremydoctor/css/owl.theme.default.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/healtcaremydoctor/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/healtcaremydoctor/css/responsive.css') }}">
    <link href="{{asset('assets/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <title>Home</title>
    <script type="text/javascript">
      var base_url = "{{ url('/') }}";
      var timeZone = Intl.DateTimeFormat().resolvedOptions().timeZone;
    </script>
</head>

<body>
    <!-- header -->
    <header class="top-header">
        <div class="navigation-wrap">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <nav class="navbar navbar-expand-lg px-0">
                            <a class="navbar-brand" href="#">
                                <img src="{{ asset('assets/healtcaremydoctor/images/ic_logo.png') }}" alt="">
                            </a>
                            <button class="navbar-toggler" type="button" data-toggle="collapse"
                                data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav ml-auto py-4 py-md-0">
                                    <ul class="navbar-nav">
                                        <li class="nav-item">
                                            <a class="nav-link" href="#">About Us</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#">Contact Us</a>
                                        </li>
                                    </ul>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- header -->
    <!-- Offset Top -->
    <div class="offset-top"></div>
    <!-- Home Banner Section -->
    <section class="bannerSection  dr-slider mt-0">
        <div id="demo" class="carousel slide carousel-fade" data-ride="carousel" data-interval="6000">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="{{ asset('assets/healtcaremydoctor/images/ic_1.png') }}" alt="">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="{{ asset('assets/healtcaremydoctor/images/ic_6.png') }}" alt="">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="{{ asset('assets/healtcaremydoctor/images/ic_1.png') }}" alt="">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="{{ asset('assets/healtcaremydoctor/images/ic_6.png') }}" alt="">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="{{ asset('assets/healtcaremydoctor/images/ic_1.png') }}" alt="">
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-8">
                        <h2 class="sale-off">What is Lorem Ipsum?</h2>
                        <p class="get-counsler">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                        <!-- <button type="button">Book Now</button> -->
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

    <!-- Home About Us Section -->
    <section class="home-about py-md-5">
        <div class="container">
            <div class="row">
                <div class="col text-center">
                    <h2 class="mb-4">About Us</h2>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- cunsolt exepert -->
    <section class="downloadSection">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-4 col-md-4">
                    <img src="{{ asset('assets/healtcaremydoctor/images/ic_mobile.png') }}" alt="" class="mobileImage">
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
                        <input type="tel" id="phone" name="phone">
                        <button type="button" id="send_link">Send Link</button>
                    </div>
                    <div class="mobile-links">
                        <a href="#">
                            <img src="{{ asset('assets/healtcaremydoctor/images/playstore_button.png') }}" alt="">
                        </a>
                        <a href="#">
                            <img src="{{ asset('assets/healtcaremydoctor/images/appstore_button.png') }}" alt="">
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
                        <form class="query_form" id="query_post">
                            <div class="text-16 mb-3">Where should we send secure notifications?</div>
                            <div class="form-group">
                                <input class="form-control" type="email" name="email" id="email" placeholder="Enter your email" required="">
                            </div>
                            <div class="form-group">
                                <div class="row no-gutters col-spacing">
                                    <div class="col-4">
                                        <select class="form-control" id="">
                                            <option value="">+91 (IND)</option>
                                        </select>
                                    </div>
                                    <div class="col-8">
                                        <input class="form-control" name="phone_number" type="number" id="phone_number" placeholder="Enter your mobile number" required="">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" name="query_data" id="query_data" cols="30" rows="5"
                                    placeholder="What is your question?" required=""></textarea>
                            </div>

                            <button class="default-btn"><span id="btn_text_val">Post a query</span></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-5 col-sm-8">
                    <a href="index.html">
                        <img src="{{ asset('assets/healtcaremydoctor/images/ic_logo2.png') }}" alt="" class="">
                    </a>
                    <p>
                        One platform that takes care of your well being. You can consult experts in various fields and
                        even take classes from them in order to learn.
                    </p>
                </div>
                <div class="col-lg-3 offset-lg-1 col-md-3 col-sm-4">
                    <h3>Links</h3>
                    <ul class="footer_links">
                        <li>
                            <a href="#">
                                About Us
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                Terms & conditions
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                Privacy policy
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                Contact Us
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-8 col-7">
                    <h3>Social Links</h3>
                    <ul class="nav social-list">
                        <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                        <li><a href="#"><i class="fab fa-google-plus-g"></i></a></li>
                        <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fab fa-whatsapp"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="footer-btm">
            <div class="container">
                <h5>© 2020 HealthCare · All rights reserved</h5>
            </div>
        </div>
    </footer>


    <!-- footer -->
    <script src="{{ asset('assets/912consult/js/slick.min.js') }}"></script>
    <script src="{{ asset('assets/912consult/js/bootstrap.min.js') }}"></script>
    <!-- Date Rang JS -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script src="{{ asset('assets/912consult/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/912consult/js/main.js') }}"></script>
    <script src="{{asset('assets/libs/sweetalert2/sweetalert2.min.js')}}"></script>
    <script src="{{ asset('assets/912consult/js/intlTelInput.js') }}"></script>

    <!-- Start of code-brew6890 Zendesk Widget script -->
        <script id="ze-snippet" src="https://static.zdassets.com/ekr/snippet.js?key=dcf1f1ff-ac81-4b58-a238-c7ceba43980a"> </script>
        <!-- End of code-brew6890 Zendesk Widget script -->

    <script>
        var input = document.querySelector("#phone");
        window.intlTelInput(input, {
            utilsScript: "{{ asset('assets/912consult/js/utils.js') }}",
        });
        if($('#phone').get(0)!==undefined){
            var iti = intlTelInput($('#phone').get(0));
        }
    </script>

</body>

</html>
