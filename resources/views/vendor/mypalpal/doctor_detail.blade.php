@extends('vendor.tele.layouts.dashboard', ['title' => 'Patient'])
@section('content')
 <!-- Offset Top -->
 <div class="offset-top"></div>
   <!-- Page Header Section -->
   <section class="page-header">
        <div class="container">
            <div class="row align-items-center py-lg-5 py-4">
                <div class="col">
                    <ul class="page_navigation d-flex align-items-center">
                        <li><a href="{{url('/user/patient')}}">Home</a></li>
                        <li><a href="{{url('/user/experts')}}">Consult a Doctor</a></li>
                        <li class="active"><a href="#">Doctor Details</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Doctor Details Section  -->
    <section class="doctor_details mb-5 pb-lg-5">
        <div class="container">
        @if(isset($doctor_details))
            <div class="row">
                <div class="col-lg-8 pr-lg-4">
                    <div class="doctor_box">
                        <div class="px-4 pt-4 mx-lg-2 mt-lg-1">
                            <ul class="border-bottom d-flex align-items-center justify-content-start mb-4 pb-4">
                                <li class="doctor_pic">
                                @if($doctor_details->profile_image == '' &&  $doctor_details->profile_image == null)
                                 <img src="{{asset('assetss/images/ic_upload profile img.png')}}" alt="">
                                 @else
                                 <img src="{{Storage::disk('spaces')->url('uploads/'.$doctor_details->profile_image)}}" alt="">
                                @endif
                                </li>
                                <li class="doctor_detail pl-3">
                                <h4>{{ $doctor_details['name'] }}</h4>
                                <p>{{ $doctor_details['categoryData']->name }}  ·  @if ($doctor_details['profile']->working_since == '' || $doctor_details['profile']->working_since == null)
                                            {{ 0 }} years
                                          @else
                                          @php
                                        $exp_start = new DateTime($doctor_details['profile']->working_since);
                                        $today_date = new DateTime();
                                        @endphp
                                        {{@$exp_start->diff($today_date)->y}}+ years
                                         @endif of exp</p>
                                <p>Qualifications: {{$doctor_details->profile->qualification}}</p>
                                @php $preference = $doctor_details->master_preferences; @endphp
                                @foreach($preference as $prefer)
                                @foreach($prefer['options'] as $opt)
                                <p>{{ $prefer['preference_name'] }}: {{$opt->option_name}}</p>
                                @endforeach
                                @endforeach
                                <span class="rating vertical-middle">
                                    <img src="images/ic_Starx18.svg" alt="">
                                    <a class="review_txt" href="#"><i class="fas fa-star"></i> {{$doctor_details['totalRating']}} · {{$doctor_details['reviewCount']}} Reviews</a>
                                </span>
                                </li>
                            </ul>
                            <ul class="detail-list border-bottom  d-flex align-items-center justify-content-between mb-4 pb-4">
                                <li>
                                    <label class="mb-0 d-block">Patients</label>
                                     <span>{{$doctor_details['patientCount']}}</span>
                                </li>
                                <li>
                                    <label class="mb-0 d-block">Experience</label>
                                    <span>@if ($doctor_details['profile']->working_since == '' || $doctor_details['profile']->working_since == null)
                                            {{ 0 }} years
                                          @else
                                          @php
                                        $exp_start = new DateTime($doctor_details['profile']->working_since);
                                        $today_date = new DateTime();
                                        @endphp
                                        {{@$exp_start->diff($today_date)->y}}+ years
                                         @endif
                                    </span>
                                </li>
                                <li>
                                    <label class="mb-0 d-block">Reviews</label>
                                    <span>{{$doctor_details['reviewCount']}}</span>
                                </li>
                            </ul>

                            <article class="border-bottom  mb-4 pb-4">
                                <h4 class="mb-3">About</h4>
                                <p>{{ $doctor_details['profile']->bio}}</p>
                            </article>

                            <div class="artical_review">
                                <h4>Reviews</h4>
                                <?php foreach ($review_list ?? [] as $key => $value) { ?>
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
                                 <?php } ?>


                <div class="col-lg-9">


                    <div class="row mt-5 pt-lg-4">
                        <div class="col text-center">

                        </div>
                    </div>
                </div>
                             <!--    <a class="more_review d-block mb-lg-5" href="#"> View more reviews</a> -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="listing_option_wrapper">
                    <form method="post" id="create_request" action="{{url('user/create_request')}}">
                        <input type="hidden" value="{{$schedule_type}}" name="schedule_type" class="schedule_type" />
                        <input type="hidden" value="{{$doctor_details['id']}}" name="consultant_id" class="consultant_id" />
                        @csrf
                        <input type="hidden" value="" name="request_id" class="request_id" />
                        <input type="hidden" value="{{$current_date}}" name="current_date" class="date" />
                        <input type="hidden" value="{{$current_time}}" name="time" class="time" />
                        <input type="hidden" value="" name="request_step" class="request_step" />
                        <div class="accordion" id="doctor_dropdown">
                            @if($services)
                            @foreach( $services as $service)
                            <div class="card bg-transparent mb-4">
                                <div class="card-header bg-transparent p-0" id="category">
                                    <h2 class="mb-0 position-relative">
                                        <button class="btn d-block position-relative btn-block text-left px-4 chat_btn " type="button"
                                            data-toggle="collapse" data-target="#collapseOne" aria-expanded="true"
                                             aria-controls="collapseOne">
                                            <label class="d-block">{{$service->service_name}}</label>
                                            <input type="hidden" value="{{ $service['service_id'] }}" name="service_id" class="service_id" />
                                            <input type="hidden" value="{{ $service['category_id'] }}" name="category_id" class="category_id" />
                                            <span>₹ {{ $service->price }} / {{ $service->duration }} mins</span>

                                           <b class= "show-tprice d-none" data-og="@if( $service->price ){{ $service->price .'.00' }}@else{{ 0.00 }}@endif">₹ @if( $service->price ){{ $service->price .'.00' }}  @else {{ 0.00 }} @endif</b>
                                        </button>
                                    </h2>
                                </div>

                                <div id="collapseOne" class="collapse show" aria-labelledby="category"
                                    data-parent="#doctor_dropdown">

                                    <div class="card-body p-4">
                                        <div class="detail-box border-bottom mb-4 pb-2">

                                            <label class="d-block">Appointment Date & Tmings</label>
                                            <p>{{ $datetime }}</p>
                                        </div>

                                        <div class="coupon-input d-flex align-items-center my-4">
                                            <input class="form-control border-0" type="text" name="coupon_code" placeholder="Add Coupon Code">
                                            <button type="button" class="default-btn" id="apply_coupon"><span>Apply</span></button>
                                        </div>
                                        <p id="coupon_message" style="display: none; margin-bottom: 20px;"></p>
                                        <input type="hidden" name="package_id" value="" class="package_id">
                                        <input type="hidden" name="payment_type" value="" class="payment_type">

                                        <input type="hidden" name="request_id" value="" class="request_id">
                                        <input type="hidden" name="total" value="@if( $service->price ){{ $service->price .'.00' }}@else{{ 0.00}} @endif">
                                        <div class="price-detail mb-4">
                                            <h4>Price Details</h4>.
                                            <ul class="d-flex align-items-center justify-content-between">
                                                <li>Sub-Total</li>
                                                <li>₹ @if( $service->price ){{ $service->price .'.00' }}  @else {{ 0.00}} @endif</li>
                                            </ul>
                                            <ul class="d-flex align-items-center justify-content-between">
                                                <li>Promo Applied</li>
                                                <li id="promo_value">₹ 0.00</li>
                                            </ul>
                                            <ul class="d-flex align-items-center justify-content-between">
                                                <li><b>Total</b></li>
                                                <li><b id="total_value" data-og="@if( $service->price ){{ $service->price .'.00' }}@else{{ 0.00 }}@endif">₹ @if( $service->price ){{ $service->price .'.00' }}  @else {{ 0.00 }} @endif</b></li>
                                            </ul>
                                        </div>
                                        <p class="text-13 mb-3">By Booking this appointment, you agree to the terms & conditions</p>

                                        <p id="form_message" class="text-danger" style="display: none; margin-bottom: 20px;"></p>

                                        <input type="submit" name="booking" class="default-btn radius-btn w-100" value="Confirm Booking">

                                    </div>
                                </div>
                            </div>
                            @endforeach
                            @endif


                            </div>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        @endif
        </div>
    </section>

    <script>
        var _token = "{{ csrf_token() }}";
        var _coupon_check_url = "{{ url('/user/check_coupon') }}";
    </script>
@endsection
