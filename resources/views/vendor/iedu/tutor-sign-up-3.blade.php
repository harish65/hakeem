@extends('vendor.iedu.layouts.index', ['title' => 'Emsats','show_footer'=>true])
@section('content')
<!-- Header section -->
<section class="login-section">
  <div class="container-fluid px-0">
    <div class="row no-gutters">
      <div class="col-md-5">
        <div class="logo-side">
          <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
              <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img src="{{asset('assets/iedu/images/ic_1.png')}}" class="d-block w-100" alt="...">
              </div>
              <div class="carousel-item">
                <img src="{{asset('assets/iedu/images/ic_1.png')}}" class="d-block w-100" alt="...">
              </div>
              <div class="carousel-item">
                <img src="{{asset('assets/iedu/images/ic_1.png')}}" class="d-block w-100" alt="...">
              </div>
            </div>
          </div>
          <div class="vertical-center text-center full-width"><a href=""><img class="img-fluid logo" src="{{asset('assets/iedu/images/ic_2.png')}}"></a></div>
        </div>
      </div>
      <div class="offset-md-1 col-md-5">
        <div class="form-side">
          <div class="top-bar pt-4">
            <!-- <p>Already a member ? <a href=""> Sign In</a></p> -->
          </div>
        <div class="vertical-center22 full-width tutor-sign-up-form">
          <h4 class="mb-2">Signup for iEDU</h4>
          <p>Set up your personal, category and work details</p>
          <div class="upoad-profile">
              <h3>Select a Emsats</h3>
              @if(session('status.success'))
                  <div class="alert alert-outline alert-success custom_alert">
                      {{ session('status.success') }}
                  </div>
              @endif

              @if(session('status.error'))
                  <div class="alert alert-outline alert-danger custom_alert">
                      {{ session('status.error') }}
                  </div>
              @endif

          </div>
          <form class="" method="post" action="{{ url('sp-emsat') }}">
            @csrf
            <section class="popular-classes  pt-3 tutor-popular-classes">
              <div class="row">

                <?php foreach ($emsats as $key => $emsat) {

                ?>
                  <div class="col-md-6 emsat_div">
                    <input type="hidden" name="id[]" class="emsat_id" value="{{ $emsat->id }}">
                    <div
                    @if($emsat->consult_price != null)
                        class="class-card Music active" data-id="{{$emsat->id}}
                    @else
                        class="class-card Music" data-id="{{$emsat->id}}
                    @endif

                      style="height:100px">
                        <div class="image-wrap">
                        <img src="{{ Storage::disk('spaces')->url('original/'.$emsat->icon) }}">
                        </div>
                          <h3 class="mt-3">{{ $emsat->title }}</h3>
                          <!-- <p>1,119,045 Graduates</p> -->
                          <div
                            class="consult_fee"
                            @if($emsat->consult_price == null)
                                style="display:none;"
                            @endif
                        >
                                <input class="price" name="price[]" placeholder="Consultation fees" value="{{ $emsat->consult_price }}"/>
                         </div>
                    </div>
                </div>
                  <?php } ?>

              </div>
          </section>



            <div class="form-group back-steap">
            <a href="{{url('/profile/profile-setup-one/')}}/{{Auth::user()->id}}"> < Back</a>
              <input  type="submit" name="next" value="Next" class="btn rounded">
            </div>
          </form>
        </div>
        <!-- <div class="bottom-block">
          <div class="row"> -->
            <!-- <div class="col-md-7 pr-0">
              <small>©Copyright 2020 by Consumables and Stores. All Rights Reserved.</small>
            </div> -->
            <!-- <div class="col-md-5 text-right">
              <a href="">Privacy Policy<span class="ml-2 mr-2">•</span></a><a href="">   Terms & Conditions</a>
            </div> -->
          <!-- </div>
        </div> -->
        </div>
      </div>
    </div>
  </div>
</section>
<script>
    // $('.consult_fee').hide();
    $('.emsat_div').on('click',function(e){

        // console.log(e.target.className);

        if(e.target.className != "price")
        {
            if($(this).find('.class-card').hasClass("active"))
            {
                $(this).find('.class-card').removeClass("active");
                $(this).find('.consult_fee').hide();
                $(this).find("input.price").removeAttr("required");
                $(this).find("input.price").val(null);
            }
            else
            {
                $(this).find('.class-card').addClass("active");
                $(this).find('.consult_fee').show();
                $(this).find("input.price").attr("required", "required");
            }
        }
    });
</script>

@endsection
