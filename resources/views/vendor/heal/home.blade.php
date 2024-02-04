@extends('vendor.heal.layouts.index', ['title' => 'Home'])
@section('content')
  <!-- Bannar Section -->
<section class="slider-section">
  <div id="carousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#carousel" data-slide-to="0" class="active"></li>
      <li data-target="#carousel" data-slide-to="1"></li>
      <li data-target="#carousel" data-slide-to="2"></li>
    </ol> <!-- End of Indicators -->

    <!-- Carousel Content -->
    <div class="carousel-inner" role="listbox">
      <div class="carousel-item active" style="background-image: url({{ asset('assets/heal/images/slider_image.jpg') }});">
          <div class="container">
            <div class="row">
              <div class="col-md-6">
              <h3>Loreum Ipsum </h3>
              <p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
              <button class="btn"><span>Get Started</span></button>
              </div>
            </div>
        </div>
      </div> <!-- End of Carousel Item -->

      <div class="carousel-item" style="background-image: url({{ asset('assets/heal/images/slider_image.jpg') }});">
        <div class="container">
            <div class="row">
              <div class="col-md-6">
              <h3>Loreum Ipsum </h3>
              <p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
              <button class="btn"><span>Get Started</span></button>
              </div>
            </div>
        </div>
      </div> <!-- End of Carousel Item -->

      <div class="carousel-item" style="background-image: url({{ asset('assets/heal/images/slider_image.jpg') }});">
        <div class="container">
            <div class="row">
              <div class="col-md-6">
              <h3>Loreum Ipsum </h3>
              <p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
              <button class="btn"><span>Get Started</span></button>
              </div>
            </div>
        </div>
      </div> <!-- End of Carousel Item -->
    </div> <!-- End of Carousel Content -->
  </div> <!-- End of Carousel -->
</section> <!-- End of Slider -->

<!-- Next Section -->
<section class="looking-for">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h4>What are you looking for?</h4>
        <p>Connect with a Experts now or schedule an appointment</p>
      </div>
      <div class="row">
        @foreach($categories as $key=>$category)
          <div class="col-md-3" style="padding-top: 10px;">
            <div class="card-block specialist text-center" style="background-color: {{ $category->color_code }}">
              @if($category->image)
                <img class="mb-4 d-block mx-auto"  src="{{ Storage::disk('spaces')->url('uploads/'.$category->image) }}" style="height: 150px;width: 200px">
              @else
                <img class="mb-4 d-block mx-auto"  src="https://via.placeholder.com/218x260/{{ str_replace('#','',$category->color_code) }}/{{ str_replace('#','',$category->color_code) }}?text={{ $category->name }}" style="height: 150px;width: 200px">
              @endif
              <h5 class="d-inline-block">{{ \Illuminate\Support\Str::limit($category->name, 15, $end='...') }}</h5>
            </div>
          </div>
        @endforeach
    </div>
  </div>
</section>
<!-- Next Section -->
<section class="download-section">
  <div class="container">
    <div class="row d-flex align-items-center">
      <div class="col-md-4">
        <img class="d-block mx-auto" src="{{ asset('assets/heal/images/ic_simulator.png') }}">
      </div>
      <div class="col-md-8">
        <h3>Download the Heal App now</h3>
        <ul class="list-inline">
          <li><p><img class="mr-3" src="{{ asset('assets/heal/images/ic_tick.png') }}">24/7 On-Demand Access to Care</p></li>
          <li><p><img class="mr-3" src="{{ asset('assets/heal/images/ic_tick.png') }}">Schedule Future Appointments</p></li>
          <li><p><img class="mr-3" src="{{ asset('assets/heal/images/ic_tick.png') }}">Medication Assisted Treatment Platform</p></li>
          <li><p><img class="mr-3" src="{{ asset('assets/heal/images/ic_tick.png') }}"> Insurance-Covered Services</p></li>
          <li><p><img class="mr-3" src="{{ asset('assets/heal/images/ic_tick.png') }}">Connect with Expert Professionals Now</p></li>
          <li><p><img class="mr-3" src="{{ asset('assets/heal/images/ic_tick.png') }}">Loreum Ipsum</p></li>
        </ul>
        <h5 class="">Get the app download link</h5>
        <div class="row">
          <div class="col-md-9">
            <div class="enter-phone-block">
              <div class="row">
                <div class="col-md-3 pr-0">
                  <img class="mr-1" src="{{ asset('assets/heal/images/ic_flag.png') }}">
                  <select>
                    <option>+966</option>
                    <option>+966</option>
                    <option>+966</option>
                    <option>+966</option>
                  </select>
                </div>
                <div class="col-md-8 pl-0">
                  <input type="" name="" placeholder="Enter your phone number">
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <button class="btn pl-4 pr-4 rounded"><span>Send Link</span></button>
          </div>
        </div>
        <div class="downnload-icons mt-4">
          <a class="mr-3 d-inline-block" href=""><img src="{{ asset('assets/heal/images/ic_app_store.png') }}"></a>
          <a class="d-inline-block" href=""><img src="{{ asset('assets/heal/images/ic_google_play.png') }}"></a>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Next Section -->
<section class="set-up-acc">
  <div class="container">
    <div class="row">
      <div class="col-md-4 text-center">
        <img src="{{ asset('assets/heal/images/ic_account_setup.png') }}">
        <h4>Set up account easily</h4>
        <p class="mb-0">Easily set up your account to get started</p>
      </div>
      <div class="col-md-4 text-center">
        <img src="{{ asset('assets/heal/images/ic_account_setup.png') }}">
        <img src="{{ asset('assets/heal/images/ic_expert_now.png') }}">
        <h4>Find an Expert now</h4>
        <p class="mb-0">Search the experts for your medications</p>
      </div>
      <div class="col-md-4 text-center">
        <img src="{{ asset('assets/heal/images/ic_account_setup.png') }}">
        <img src="{{ asset('assets/heal/images/ic_connetnow.png') }}">
        <h4>Connect Now</h4>
        <p class="mb-0">Connect instantly or schedule for later</p>
      </div>
    </div>
  </div>
</section>
<!-- Next Section -->
<section class="what-user-say">
  <div class="container">
    <div class="row">
      <div class="col-md-7">
        <h4>What our users have to say</h4>
        <p>Read stories shared by our users</p>
      </div>
      <div class="col-md-5 text-right">
        <a href="">View all testimonials</a>
      </div>
      <div class="col-md-12">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
          <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
          </ol>
          <div class="carousel-inner">
            <div class="carousel-item active">
              <div class="row d-flex align-items-center">
                <div class="col-md-5">
                  <img class="img-fluid" src="{{ asset('assets/heal/images/video.png') }}">
                </div>
                <div class="col-md-7">
                  <div class="testimonial-text">
                    <img class="commas" src="{{ asset('assets/heal/images/ic_image.png') }}">
                    <span>I’m a working mom with four kids so it’s really challenging when one of them gets sick. I can talk to a doctor anytime 24/7 from anywhere, whether I’m at home or in the office. Heal is a game-changer.</span>
                    <div class="clr-lft-brdr mt-5">
                      <h6 class="mb-0">Sara Scott</h6>
                      <p class="mb-0">Working mom</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="carousel-item">
              <div class="row d-flex align-items-center">
                <div class="col-md-5">
                  <img class="img-fluid" src="{{ asset('assets/heal/images/video.png') }}">
                </div>
                <div class="col-md-7">
                  <div class="testimonial-text">
                    <img class="commas" src="{{ asset('assets/heal/images/ic_image.png') }}">
                    <span>I’m a working mom with four kids so it’s really challenging when one of them gets sick. I can talk to a doctor anytime 24/7 from anywhere, whether I’m at home or in the office. Heal is a game-changer.</span>
                    <div class="clr-lft-brdr mt-5">
                      <h6 class="mb-0">Sara Scott</h6>
                      <p class="mb-0">Working mom</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="carousel-item">
              <div class="row d-flex align-items-center">
                <div class="col-md-5">
                  <img class="img-fluid" src="{{ asset('assets/heal/images/video.png') }}">
                </div>
                <div class="col-md-7">
                  <div class="testimonial-text">
                    <img class="commas" src="{{ asset('assets/heal/images/ic_image.png') }}">
                    <span>I’m a working mom with four kids so it’s really challenging when one of them gets sick. I can talk to a doctor anytime 24/7 from anywhere, whether I’m at home or in the office. Heal is a game-changer.</span>
                    <div class="clr-lft-brdr mt-5">
                      <h6 class="mb-0">Sara Scott</h6>
                      <p class="mb-0">Working mom</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Section -->
<section class="health-tips">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h3>Health Tips</h3>
        <p>Get some the health tips from the expert doctors</p>
      </div>
      <div class="col-md-3">
        <div class="card-block">
        <div class="image-block">
          <img src="{{ asset('assets/heal/images/health-tip-1.png') }}">
        </div>
        <div class="p-2">
          <h6>How Music Can Help Health Conditions. Loreum Ipsum Is a dummy text of the printng and type setting and is ….</h6>
          <span>23/03/2020</span>
        </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card-block">
        <div class="image-block">
          <img src="{{ asset('assets/heal/images/health-tip-2.png') }}">
        </div>
        <div class="p-2">
          <h6>How Music Can Help Health Conditions. Loreum Ipsum Is a dummy text of the printng and type setting and is ….</h6>
          <span>23/03/2020</span>
        </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card-block">
        <div class="image-block">
          <img src="{{ asset('assets/heal/images/health-tip-1.png') }}">
        </div>
        <div class="p-2">
          <h6>How Music Can Help Health Conditions. Loreum Ipsum Is a dummy text of the printng and type setting and is ….</h6>
          <span>23/03/2020</span>
        </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card-block">
        <div class="image-block">
          <img src="{{ asset('assets/heal/images/health-tip-2.png') }}">
        </div>
        <div class="p-2">
          <h6>How Music Can Help Health Conditions. Loreum Ipsum Is a dummy text of the printng and type setting and is ….</h6>
          <span>23/03/2020</span>
        </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card-block">
        <div class="image-block">
          <img src="{{ asset('assets/heal/images/health-tip-1.png') }}">
        </div>
        <div class="p-2">
          <h6>How Music Can Help Health Conditions. Loreum Ipsum Is a dummy text of the printng and type setting and is ….</h6>
          <span>23/03/2020</span>
        </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card-block">
        <div class="image-block">
          <img src="{{ asset('assets/heal/images/health-tip-2.png') }}">
        </div>
        <div class="p-2">
          <h6>How Music Can Help Health Conditions. Loreum Ipsum Is a dummy text of the printng and type setting and is ….</h6>
          <span>23/03/2020</span>
        </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card-block">
        <div class="image-block">
          <img src="{{ asset('assets/heal/images/health-tip-1.png') }}">
        </div>
        <div class="p-2">
          <h6>How Music Can Help Health Conditions. Loreum Ipsum Is a dummy text of the printng and type setting and is ….</h6>
          <span>23/03/2020</span>
        </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card-block">
          <div class="image-block">
          <img src="{{ asset('assets/heal/images/health-tip-2.png') }}">
        </div>
        <div class="p-2">
          <h6>How Music Can Help Health Conditions. Loreum Ipsum Is a dummy text of the printng and type setting and is ….</h6>
          <span>23/03/2020</span>
        </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Section -->
<section class="health-tools">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h3>Health Tools</h3>
        <p>Loreum Ipsum is a dummy text and is simple to read</p>
      </div>
      <div class="col-md-3">
        <div class="card-block text-center">
          <img src="{{ asset('assets/heal/images/ic_bmi.png') }}">
          <h5>BMI Calculator</h5>
          <span>Loreum Ipsum Is a dummy text and is simple</span>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card-block text-center">
          <img src="{{ asset('assets/heal/images/ic_water.png') }}">
          <h5>Water Intake Calculator</h5>
          <span>Loreum Ipsum Is a dummy text and is simple</span>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card-block text-center">
          <img src="{{ asset('assets/heal/images/ic_protein.png') }}">
          <h5>Protein Intake Calculator</h5>
          <span>Loreum Ipsum Is a dummy text and is simple</span>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card-block text-center">
          <img src="{{ asset('assets/heal/images/ic_pregnancy.png') }}">
          <h5>Pregnancy Calculator</h5>
          <span>Loreum Ipsum Is a dummy text and is simple</span>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Testimonials -->
<section class="testimonials">
  <div class="container">
  <div class="row side-btn">
    <div class="col-md-12">
      <h3>Testimonials</h3>
      <p>What our customers are saying…</p>
      <div class="owl-slider">
        <div id="carouselone" class="owl-carousel">
          <div class="item">
            <div class="col-md-12 p-0">
              <div class="card-wrap">
                <div class="row">
                  <div class="col-md-6 pr-0">
                    <div class="card-left">
                      <img class="profile-icon" src="{{ asset('assets/heal/images/ic_candidate-notification.png') }}">
                      <span>Sahili Khan</span>
                    </div>
                  </div>
                  <div class="col-md-6 pl-0">
                    <div class="pt-5 pb-5 pl-3 pr-3 card-right">
                      <div class="text-right">
                        <img style="height: 28px; width: auto;display: inline-block;" src="{{ asset('assets/heal/images/ic_image.png') }}">
                      </div>
                      <h6>With<br> Heal is the best for the doctor consultation and is loreum ipsum</h6>
                    </div>
                  </div>
                </div>
              </div>    
            </div>
          </div>
          <div class="item">
            <div class="col-md-12 p-0">
                <div class="card-wrap">
                <div class="row">
                  <div class="col-md-6 pr-0">
                    <div class="card-left">
                      <img class="profile-icon" src="{{ asset('assets/heal/images/ic_candidate-notification.png') }}">
                      <span>Sahili Khan</span>
                    </div>
                  </div>
                  <div class="col-md-6 pl-0">
                    <div class="pt-5 pb-5 pl-3 pr-3 card-right">
                      <div class="text-right">
                        <img style="height: 28px; width: auto;display: inline-block;" src="{{ asset('assets/heal/images/ic_image.png') }}">
                      </div>
                      <h6>With<br> Heal is the best for the doctor consultation and is loreum ipsum</h6>
                    </div>
                  </div>
                </div>
              </div> 
              </div>
          </div>
          <div class="item">
            <div class="card-wrap">
                <div class="row">
                  <div class="col-md-6 pr-0">
                    <div class="card-left">
                      <img class="profile-icon" src="{{ asset('assets/heal/images/ic_candidate-notification.png') }}">
                      <span>Sahili Khan</span>
                    </div>
                  </div>
                  <div class="col-md-6 pl-0">
                    <div class="pt-5 pb-5 pl-3 pr-3 card-right">
                      <div class="text-right">
                        <img style="height: 28px; width: auto;display: inline-block;" src="{{ asset('assets/heal/images/ic_image.png') }}">
                      </div>
                      <h6>With<br> Heal is the best for the doctor consultation and is loreum ipsum</h6>
                    </div>
                  </div>
                </div>
              </div> 
          </div>
          <div class="item">
            <div class="card-wrap">
                <div class="row">
                  <div class="col-md-6 pr-0">
                    <div class="card-left">
                      <img class="profile-icon" src="{{ asset('assets/heal/images/ic_candidate-notification.png') }}">
                      <span>Sahili Khan</span>
                    </div>
                  </div>
                  <div class="col-md-6 pl-0">
                    <div class="pt-5 pb-5 pl-3 pr-3 card-right">
                      <div class="text-right">
                        <img style="height: 28px; width: auto;display: inline-block;" src="{{ asset('assets/heal/images/ic_image.png') }}">
                      </div>
                      <h6>With<br> Heal is the best for the doctor consultation and is loreum ipsum</h6>
                    </div>
                  </div>
                </div>
              </div> 
          </div>
        </div>
        </div>
      </div>
    </div>
  </div>
  </section>
<!-- Next Section -->
<section class="get-started">
  <div class="container">
    <div class="row">
      <div class="col-md-7">
        <h3>Heal for Doctors</h3>
        <p>Increase your monthly income by reaching out to patient’s through Heal Arabia platform.</p>
        <button class="btn rounded"><span>Join the Heal Family</span></button>
      </div>
      <div class="col-md-5">
        <img class="img-fluid" src="{{ asset('assets/heal/images/image3collaps.jpg') }}">
      </div>
    </div>
  </div>
</section>
<!-- Rating and review -->
<section class="rating-section">
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <div class="row d-flex align-items-center">
          <div class="col-md-4">
            <strong>4.8</strong>
          </div>
          <div class="col-md-8 pl-0">
            <ul class="list-inline">
              <li><img src="{{ asset('assets/heal/images/ic_star.png') }}"></li>
              <li><img src="{{ asset('assets/heal/images/ic_star.png') }}"></li>
              <li><img src="{{ asset('assets/heal/images/ic_star.png') }}"></li>
              <li><img src="{{ asset('assets/heal/images/ic_star.png') }}"></li>
              <li><img src="{{ asset('assets/heal/images/ic_star.png') }}"></li>
            </ul>
            <p class="mb-2">2000+ reviews</p>
            <span>on Google playstore</span>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="row d-flex align-items-center">
          <div class="col-md-4">
            <strong>4.8</strong>
          </div>
          <div class="col-md-8 pl-0">
            <ul class="list-inline">
              <li><img src="{{ asset('assets/heal/images/ic_star.png') }}"></li>
              <li><img src="{{ asset('assets/heal/images/ic_star.png') }}"></li>
              <li><img src="{{ asset('assets/heal/images/ic_star.png') }}"></li>
              <li><img src="{{ asset('assets/heal/images/ic_star.png') }}"></li>
              <li><img src="{{ asset('assets/heal/images/ic_star.png') }}"></li>
            </ul>
            <p class="mb-2">1500+ reviews</p>
            <span>on Apple Store</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection