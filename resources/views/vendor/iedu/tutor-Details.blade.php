@extends('vendor.iedu.layouts.index', ['title' => 'Tutor Details','show_footer'=>true])
@section('content')
<style>
  ul>li
  {
    list-style:none;
  }
  </style>
<!-- Bannar Section -->
<section class="choose-tutor header-height">
  <div class="container">
    <div class="row d-flex align-items-center">
      <div class="col-md-12">
        <div class="breadcrum mb-4">
          <a href="">Home</a><span class="mr-2 ml-2">/</span>
          @if($booking_type=='subject')
          <a href="{{url('web/grade')}}">Grades</a><span class="mr-2 ml-2">/</span>
          @else
          <a href="">Courses</a><span class="mr-2 ml-2">/</span>
          @endif
          <a href="">Choose a Tutor</a><span class="mr-2 ml-2">/</span>
          <a class="active" href="">Tutor Details</a>
        </div>
      </div>

      <div class="col-md-12">
      @if(isset($doctor_details))
        <div class="row">
          <div class="col-md-8">
            <div class="tutuor-details-wrap">
              <div class="row d-flex align-items-center">
                <div class="col-md-2">
                  <div class="img-wrap">
                  @if($doctor_details->profile_image == '' &&  $doctor_details->profile_image == null)
                  <img src="{{asset('assets/iedu/images/dummy_profile.webp')}}" alt="">
                  @else
                  <img src="{{Storage::disk('spaces')->url('uploads/'.$doctor_details->profile_image)}}" alt="">
                @endif
                  </div>
                </div>
                <div class="col-md-10">
                  <h5>{{ ucwords($doctor_details['name']) }}
                    <!-- <strong class="float-right">Fee : $ 45/Hr</strong> -->
                  </h5>
                  <span>{{ $doctor_details['categoryData']->name }}</span>
                  <p class="mb-0"><img class="mr-2" src="{{asset('assets/iedu/images/ic_star.png')}}">{{$doctor_details['totalRating']}} · {{$doctor_details['reviewCount']}} Reviews</p>
                </div>
              </div>
              <hr class="mt-4 mb-4">
              <div class="row">
              <div class="col-md-3">
                  <span>Students</span>
                  <p class="mb-0">{{$doctor_details['patientCount']}}</p>
                </div>

                <div class="col-md-3">
                  <span>Experience</span>
                  <p class="mb-0">
                    {{-- @if ($doctor_details['experience'] == '' || $doctor_details['experience'] == null)
                                            {{ 0 }} years
                                          @else
                                         {{$doctor_details['experience']}}+ years
                                         @endif --}}
                    @if($doctor_details['profile'])
                        {{\Carbon\Carbon::parse($doctor_details['profile']['working_since'])->age}}
                    @else
                    0
                    @endif
                    year
                    </p>
                </div>
                <div class="col-md-3">
                  <span>Job Done</span>
                  <p class="mb-0">95%</p>
                </div>
              </div>
              <hr class="mt-4 mb-4">
              <h5>About</h5>
              <p class="about-text mb-0">{{ $doctor_details['profile']->bio}}</p>
              <hr class="mt-4 mb-4">
              <h5>Teaching Languages</h5>
              <p class="about-text">English , Arabic </p>
              <h4>Reviews</h4>
                <?php
                if(sizeof($review_list)>0) {
                foreach ($review_list as $key => $value) { ?>
                <ul class="review-artical d-flex align-items-top mt-4 pt-lg-1">
                    <li>
                        <img src="images/ic_review-userprofile.png" alt="">
                    </li>
                    <li class="pl-3">
                        <label class="d-block"><?php echo $value['user']['name'] ?></label>
                        <a class="review_txt d-block my-2" href="#"><i class="fas fa-star"></i> <span><?php echo $value['rating'] ?></span> </a>
                        <article>
                            <p><?php echo $value['comment'] ?></p>
                        </article>
                    </li>
                </ul>
                  <?php } }
                  else{ ?>
                      {{'No Reviews.'}}
                    <?php
                  }
                   ?>


                <div class="col-lg-9">


                    <div class="row mt-5 pt-lg-4">
                        <div class="col text-center">

                        </div>
                    </div>
                </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="schedule-booking">
              <h4 style="margin:0px;">Schedule Booking</h4>

              <form method="post" id="create_request" action="{{url('user/create_request')}}">
                        <input type="hidden" value="{{$schedule_type}}" name="schedule_type" class="schedule_type" />
                        <input type="hidden" value="{{$doctor_details['id']}}" name="consultant_id" class="consultant_id" />
                        @csrf
                        <input type="hidden" name="request_id" value="{{request()->get('request_id') }}" class="request_id">
                        <input type="hidden" value="{{$current_date}}" name="current_date" class="date" />
                        <input type="hidden" value="{{$current_time}}" name="time" class="time" />
                        <input type="hidden" value="" name="request_step" class="request_step" />
                        <input type="hidden" value="{{ Request::get('booking_type') }}" name="booking_type" class="booking_type" />
                        <input type="hidden" value="{{ Request::get('booking_id') }}" name="booking_id" class="booking_id" />
                        <input type="hidden" value="{{ Request::get('service_id') }}" name="service_id" class="service_id" />
                        <input type="hidden" value="{{ Request::get('category_id') }}" name="category_id" class="category_id" />
                        @if($services)
                            @foreach( $services as $service)
                        <div id="collapseOne" class="collapse show" aria-labelledby="category"
                                    data-parent="#doctor_dropdown">
                                    <div class="card-body p-4">
                                        <div class="detail-box border-bottom mb-4 pb-2">
                                            <label class="d-block">Appointment Date & Tmings</label>
                                            <p>{{ $datetime }} to {{ $end_slot }}</p>
                                        </div>

                                        <div class="coupon-input d-flex align-items-center my-4">
                                            <input class="form-control border-0" type="text" name="coupon_code" placeholder="Add Coupon Code">
                                            <button style="padding:5px;" type="button" class="btn no-box-shaddow" id="apply_coupon"><span>Apply</span></button>

                                        </div>
                                        <p id="coupon_message" style="display: none; margin-bottom: 20px;"></p>
                                        <input type="hidden" name="package_id" value="" class="package_id">
                                        <input type="hidden" name="payment_type" value="" class="payment_type">

                                        <input type="hidden" name="request_id" value="{{request()->get('request_id') }}" class="request_id">
                                        <input type="hidden" name="total" value="@if( $total_charges ){{ $total_charges }}@else{{ 0}} @endif">
                                        @if(Config('client_connected') && Config::get('client_data')->domain_name == 'iedu')
                                            @php $currency = 'AED';  @endphp
                                        @else
                                            @php $currency = '₹'; @endphp
                                        @endif
                                        <div class="price-detail mb-4">
                                            <h5>Price Details</h5>
                                            <hr class="mt-4 mb-4">
                                            <ul class="d-flex align-items-center justify-content-between">
                                                <li>Sub-Total</li>
                                                <li>{{$currency}} @if( $total_charges ){{ $total_charges }}  @else {{ 0}} @endif</li>
                                            </ul>
                                            <ul class="d-flex align-items-center justify-content-between">
                                                <li>Promo Applied</li>
                                                <li id="promo_value">{{$currency}} 0</li>
                                            </ul>
                                            <ul class="d-flex align-items-center justify-content-between">
                                                <li><b>Total</b></li>
                                                <li><b id="total_value" data-og="@if( $grand_total ){{ $grand_total }}@else{{ 0 }}@endif">{{$currency}} @if( $grand_total ){{ $grand_total }}  @else {{ 0 }} @endif</b></li>
                                            </ul>
                                        </div>
                                        <p class="text-13 mb-3">By Booking this appointment, you agree to the terms & conditions</p>

                                        <p id="form_message" class="text-danger" style="display: none; margin-bottom: 20px;"></p>

                                        <button class="btn mt-5 mb-3 full-width no-box-shaddow spinner_btn" type="button" disabled style="display:none;">
                                                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span><span class="visually-hidden">Loading...</span>
                                                    </button>

                                        <input type="submit" name="booking" id="booking_btn" style="color:#ffff; font-weight:bold;"  class="btn mt-5 mb-3 full-width no-box-shaddow"  value="Create Booking">

                                    </div>
                                </div>
                                @endforeach
                                @endif
                            </form>
                              </div>
                        </div>


            </div>
          </div>
        </div>
      @endif
      </div>
    </div>
  </div>
</section>
<script>
     $("#create_request").submit(function(e) {
        e.preventDefault();
        // reset
        $("#form_message").hide();
        $("#form_message").attr("class", "");

        var _form = $(this);
        var _url = _form.attr("action");

        $.post(_url, $("#create_request").serialize())
            .done(function(data) {
             //console.log(data);
                if (data.status == "error") {

                    $("#wallet_message").text(data.message);

                    $("#wallet_message_container").modal('show');

                }

                else{

                        $('.spinner_btn').hide();
                       // $('#bookingCreatedModal').modal('show');
                       Swal.fire(
                            'Awesome!',
                            'Your booking created Successfully!',
                            'success'
                            )
                        var url  = '{{url('web/courses')}}';

                        setTimeout(function(){
                            window.location.href= url;
                            }, 2000);

                }
            })
            .fail(function (jqXHR) {
                var msg = jqXHR.responseJSON.message ;
                alert(msg);
                        setTimeout(function(){
                            window.location.reload(1);
                            }, 2000);

                 if(data.type="alert")
                     {
                        alert(data.message);
                        setTimeout(function(){
                            window.location.reload(1);
                            }, 2000);
                    }
             })

    });

</script>
@endsection
