@extends('vendor.iedu.layouts.index', ['title' => 'Home', 'show_footer'=>true])
@section('content')
<!-- Bannar Section -->
<section class="bannar-section">
  <div class="container">
    <div class="row">
      <div class="offset-md-1 col-md-10">
        <h2 class="pl-4 pr-4">Find personalized classes with online tutors</h2>
      </div>
    </div>
    <div class="col-md-12 mt-4 text-center">
      <a class="d-inline-block" href="{{ url('web/courses') }}"><button class="btn rounded"><span>Explore More</span></button></a>
    </div>
  </div>
</section>
<!-- Why Choose Section Css -->
<section class="popular-classes">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h3 class="section-heading">Popular Courses</h3>
      </div>
      @foreach($courses as $course)
      <div class="col-lg-3 col-md-6 col-sm-6">
        @if(Auth::check())
        <a href="{{url('experts/listing')}}/{{$course->id}}">
          <div class="class-card education " style="--bg-color:{{ $course->color_code }}">
            <div class="overlay"></div>
            <div class="image-wrap">
              <img height="100px" width="100px" src="{{ Storage::disk('spaces')->url('uploads/'.$course->image_icon) }}">
            </div>
            <h3 class="mt-3">{{ $course->title }}</h3>
            <p>1,119,045 Graduates</p>
            <button class="enroll-btn" >Enroll Now</button>
          </div>
        </a>
        @else
        <div class="class-card education" style="--bg-color:{{ $course->color_code }}">
          <div class="overlay"></div>
          <div class="image-wrap">
            <img height="100px" width="100px" src="{{ Storage::disk('spaces')->url('uploads/'.$course->image_icon) }}">
          </div>
          <h3 class="mt-3">{{ $course->title }}</h3>
          <p>1,119,045 Graduates</p>
          <button class="enroll-btn" data-toggle="modal" data-target="#users">Enroll Now</button>
        </div>
        @endif
      </div>
      @endforeach
      <div class="col-md-12 mt-4 text-center view-courses-btn">
        <button type="btn" class="btn"><span>View All Courses</span></button>
      </div>
    </div>
  </div>
</section>
<!-- Next Section -->
<section class="how-it-works bg-line-img">
  <div class="container ">
    <div class="row">
      <div class="col-md-12">
        <h3 class="section-heading text-center mb-5">How It works</h3>
      </div>
      <div class="col-md-4">
        <div class="how-it-inner">
          <span class="circle-number">01</span>
          <span class="hw-it-img"> <img src="{{ asset('assets/iedu/images/Book_It.png') }}" alt=""></span>
          <h4 class="mt-4">Book It</h4>
          <p>Choose your Course Touter, Time, Solo, Group</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="how-it-inner">
          <span class="hw-it-img"><img src="{{ asset('assets/iedu/images/Learn_it.png') }}" alt=""></span>
          <span class="circle-number">02</span>
          <h4 class="mt-4">Learn It</h4>
          <p>Think, Ask, Discuss, Intract</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="how-it-inner">
          <span class="hw-it-img"><img src="{{ asset('assets/iedu/images/Practice_it.png') }}" alt=""></span>
          <span class="circle-number">03</span>
          <h4 class="mt-4">Practice It</h4>
          <p>Do Revisions, Educational material, chats with your study group</p>
        </div>
      </div>

      <!--   <div class="col-md-12 mt-5 text-center view-courses-btn">
        <button class="btn"><span>Start Your Free Course</span></button>
      </div> -->
    </div>
  </div>
</section>
<!-- Plan details section -->
<!-- <section class="plan-details">
  <div class="container">
    <div class="row">
      <div class="offset-md-3 col-md-6">
        <h3 class="section-heading text-center">The more you learn, the less you pay.</h3>
      </div>
      <div class="col-md-6">
        <div class="m-5 plan-card">
          <h4 class="text-center">Monthly Plan</h4>
          <p class="text-center">Beginners & Advanced Learners</p>
          <h5 class="text-center mt-4">At just $69.99 / month post trial</h5>
          <div class="text-center mt-4 mb-4 view-courses-btn">
          <button class="btn no-box-shaddow"><span>Start Your Free Course</span></button>
          </div>
          <h6 class="text-center"><i class="mr-3 fa fa-check"></i>lorem ipsum lorem ipsum</h6>
          <h6 class="text-center"><i class="mr-3 fa fa-check"></i>lorem ipsum lorem ipsum</h6>
        </div>
      </div>
      <div class="col-md-6">
        <div class="m-5 plan-card">
          <h4 class="text-center">Monthly Plan</h4>
          <p class="text-center">Beginners & Advanced Learners</p>
          <h5 class="text-center mt-4">At just $69.99 / month post trial</h5>
          <div class="text-center mt-4 mb-4 view-courses-btn">
          <button class="btn no-box-shaddow"><span>Start Your Free Course</span></button>
          </div>
          <h6 class="text-center"><i class="mr-3 fa fa-check"></i>lorem ipsum lorem ipsum</h6>
          <h6 class="text-center"><i class="mr-3 fa fa-check"></i>lorem ipsum lorem ipsum</h6>
        </div>
      </div>
    </div>
  </div>
</section> -->
<!-- Next Section -->
<section class="download-our-app">
  <div class="container">
    <div class="row d-flex align-items-center">
      <div class="col-md-6">
        <img src="{{ asset('assets/iedu/images/ic_15.png') }}" class="img-fluid">
      </div>
      <div class="col-md-5 text-center">
        <h4>Download Our APP</h4>
        <p>Download our app to access your Education at all times.</p>
        <a class="mr-3" href="https://play.google.com/store/apps/developer?id=i+Edu.ae&hl=en_IN&gl=US" target="__blank"><img src="{{ asset('assets/iedu/images/ic_17.png') }}" width="150px" class="img-fluid"></a>
        <a class="mr-3" href="javascript:void(0)"><img src="{{ asset('assets/iedu/images/flamex-ios_coming_soon.png') }}" width="150px" class="img-fluid"></a>
        {{-- {{ asset('assets/iedu/images/ic_18.png') }} --}}
      </div>
    </div>
  </div>
</section>
<!-- Next Section -->
<section class="became-an-instructor pt-5 pb-5">
  <div class="container">
    <div class="row d-flex align-items-center">
      <div class="offset-lg-1 col-lg-5 col-sm-6">
        <img class="img-fluid" src="{{ asset('assets/iedu/images/smile.png') }}">
      </div>
      <div class="col-lg-5 col-sm-6">
        <h4 class="section-heading mb-3">Became an instructor</h4>
        <p>Top instructions from around the world teach millions of studentson <strong>IEDU</strong> we provide the tools and skills to teach what you love</p>
        <button class="btn" id="home_doctor_sign_up_modal_btn"><span>Start teaching today</span></button>
      </div>
    </div>
  </div>
</section>

<!-- Next Section -->
<section class="students-testimonials">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h4># testimonials</h4>
        <h3 class="section-heading">What Our Students Say</h3>
      </div>
      <div class="col-md-12 p-0">
        <div id="testimonial" class="owl-carousel">
          <div>
            <div class="col-md-12">
              <div class="student-wrap">
                <img class="coln-img" src="{{ asset('assets/iedu/images/ic_20.png') }}">
                <div class="profile-img-wrap">
                  <img src="{{ asset('assets/iedu/images/student_3.png') }}">
                </div>
                <p>I tried a math lesson and it was a great experience, the teacher was responsive to my questions and we solved some exercises to apply what I learned directly.</p>
                <h5>Ayisha salim</h5>
                <!-- <p>Grade 11</p> -->
              </div>
            </div>
          </div>
          <div>
            <div class="col-md-12">
              <div class="student-wrap">
                <img class="coln-img" src="{{ asset('assets/iedu/images/ic_20.png') }}">
                <div class="profile-img-wrap">
                  <img src="{{ asset('assets/iedu/images/student_4.png') }}">
                </div>
                <p>I am a graphic design student and I joined the design classes, I learned a lot of tricks and innovative ways, it was a wonderful experience and completely different from what I learned in university</p>
                <h5>Tariq Yousif</h5>
              </div>
            </div>
          </div>
          <div>
            <div class="col-md-12">
              <div class="student-wrap">
                <img class="coln-img" src="{{ asset('assets/iedu/images/ic_20.png') }}">
                <div class="profile-img-wrap">
                  <img src="{{ asset('assets/iedu/images/student_3.png') }}">
                </div>
                <p>The emsat test was my biggest fear but after three lessons I was able to train better and achieve better results</p>
                <h5>Sara alshamsi</h5>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Next Section -->
<section class="testimonial">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
          <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
          </ol>
          <div class="carousel-inner">
            <div class="carousel-item active">
              <div class="testimonial-slide">
                <div class="row">
                  <div class="offset-md-2 col-md-8 text-center">
                    <img src="{{ asset('assets/iedu/images/ic_20.png') }}">
                    <p>Maryam CBL Client: The site is simple and easy to use. It has many advantages for both teachers and students</p>
                    <img class="mb-3" src="{{ asset('assets/iedu/images/ic_20.png') }}">
                    <div class="client-image-wrap">
                      <img src="{{ asset('assets/iedu/images/teacher_3.png') }}">
                    </div>
                    <div class="client-rating text-center">
                      <span class="mr-2">Mr. Ali zain</span><img class="mr-2" src="{{ asset('assets/iedu/images/ic_star.png') }}"><img class="mr-2" src="{{ asset('assets/iedu/images/ic_star.png') }}"><img class="mr-2" src="{{ asset('assets/iedu/images/ic_star.png') }}"><img class="mr-2" src="{{ asset('assets/iedu/images/ic_star.png') }}"><img class="mr-2" src="{{ asset('assets/iedu/images/ic_star.png') }}">
                    </div>
                    <!-- <h6 class="text-center">Services Provider – Vedant Technologies</h6> -->
                  </div>
                </div>
              </div>
            </div>
            <div class="carousel-item">
              <div class="testimonial-slide">
                <div class="row">
                  <div class="offset-md-2 col-md-8 text-center">
                    <img src="{{ asset('assets/iedu/images/ic_20.png') }}">
                    <p>Working in two jobs used to be difficult or nearly impossible, but now it doesn't even need to be thought, all I need is to be online</p>
                    <img class="mb-3" src="{{ asset('assets/iedu/images/ic_20.png') }}">
                    <div class="client-image-wrap">
                      <img src="{{ asset('assets/iedu/images/teacher_2.png') }}">
                    </div>
                    <div class="client-rating text-center">
                      <span class="mr-2">Amanda ogrman</span><img class="mr-2" src="{{ asset('assets/iedu/images/ic_star.png') }}"><img class="mr-2" src="{{ asset('assets/iedu/images/ic_star.png') }}"><img class="mr-2" src="{{ asset('assets/iedu/images/ic_star.png') }}"><img class="mr-2" src="{{ asset('assets/iedu/images/ic_star.png') }}"><img class="mr-2" src="{{ asset('assets/iedu/images/ic_star.png') }}">
                    </div>
                    <!-- <h6 class="text-center">Services Provider – Vedant Technologies</h6> -->
                  </div>
                </div>
              </div>
            </div>
            <div class="carousel-item">
              <div class="testimonial-slide">
                <div class="row">
                  <div class="offset-md-2 col-md-8 text-center">
                    <img src="{{ asset('assets/iedu/images/ic_20.png') }}">
                    <p>Working from home with what I'm skilled at and love in, at the time that suits me! I don't think there is anything that makes me hesitate to join it.</p>
                    <img class="mb-3" src="{{ asset('assets/iedu/images/ic_20.png') }}">
                    <div class="client-image-wrap">
                      <img src="{{ asset('assets/iedu/images/teacher_3.png') }}">
                    </div>
                    <div class="client-rating text-center">
                      <span class="mr-2">Akeem</span><img class="mr-2" src="{{ asset('assets/iedu/images/ic_star.png') }}"><img class="mr-2" src="{{ asset('assets/iedu/images/ic_star.png')}}"><img class="mr-2" src="{{ asset('assets/iedu/images/ic_star.png') }}"><img class="mr-2" src="{{ asset('assets/iedu/images/ic_star.png') }}"><img class="mr-2" src="{{ asset('assets/iedu/images/ic_star.png') }}">
                    </div>
                    <!-- <h6 class="text-center">Services Provider – Vedant Technologies</h6> -->
                  </div>
                </div>
              </div>
            </div>
          </div>
          <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
  // check if loggedin
  @if(Auth::check())
  var _redirect = null;
  @if(Auth::user()->hasRole('service_provider'))
  var _redirect = "{{ url('/') }}/user/requests";
  @else
  var _redirect = "{{ url('/') }}/web/courses";
  @endif

  if (_redirect != null) {
    window.location.href = _redirect;
  }
  @endif

  $(document).ready(function() {
    $(window).keydown(function(event) {
      if (event.keyCode == 13) {
        event.preventDefault();
        return false;
      }
    });
  });
</script>
@endsection