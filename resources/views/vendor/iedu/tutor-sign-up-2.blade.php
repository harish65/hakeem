@extends('vendor.iedu.layouts.index', ['title' => 'Courses','show_footer'=>true])
@section('content')
<!-- Header section -->
<section class="login-section">
  <div class="container-fluid px-0 mob-pad ">
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
        <div class="vertical-center full-width tutor-sign-up-form mon-top-space">
          <h4 class="mb-3">Signup for iEDU</h4>
          <p>Set up your personal, category and work details</p>
          <div class="upoad-profile">
              <h3>Select a Course</h3>
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
          <form class="" method="post" action="{{url('sp-course')}}">
          @csrf
            <section class="tutor-popular-classes">
              <div class="row">
              <input type="hidden" name="course_id" class="course_id" value="{{ implode(",",$selected_ids) }}">
                <?php foreach ($Courses as $key => $course) {

                ?>


                  <div  class="col-md-6 course_div" data-id="{{$course->id}}">

                    <div
                    @if($course->active != true)
                    class="class-card Music" data-id="{{$course->id}}"
                    @else
                    class="class-card Music active" data-id="{{$course->id}}"
                    @endif

                     >
                        <div class="image-wrap">
                        <img src="{{ Storage::disk('spaces')->url('original/'.$course->image_icon) }}">
                        </div>
                          <h3 class="mt-3">{{ $course->title }}</h3>
                          <!-- <p>1,119,045 Graduates</p> -->
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

  $('.course_div').on('click',function(e){

      var _this = this;
        var _values = $('.course_id').val();

        var courseId = $(this).attr('data-id');

        if(_values.length > 0)
        {
            var _old_values = _values.split(",");

            // check if exists
            if(_old_values.indexOf(courseId) > -1)
            {
              // remove item and class

              var index = _old_values.indexOf(courseId);
              if (index !== -1) {
                _old_values.splice(index, 1);
              }

              if(_old_values.length > 0)
              {
                if(_old_values > 1)
                {
                  var _new_values = _old_values.join(",");
                }
                else
                {
                  var _new_values = _old_values;
                }
              }
              else
              {
                var _new_values = null;
              }


              _values = _new_values;
              $(_this).find('.class-card').removeClass('active');

            }
            else
            {
              // add item and class
              _values = _values + "," + courseId;
              $(_this).find('.class-card').addClass('active');
            }
        }
        else
        {
            _values = courseId;
            $(_this).find('.class-card').addClass('active');
        }

        $('.course_id').val(_values);
  });
</script>

@endsection
