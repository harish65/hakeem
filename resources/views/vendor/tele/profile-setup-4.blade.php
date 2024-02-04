@extends('vendor.tele.layouts.home', ['title' => 'Profile'])
@section('content')
@php  $user_id = Auth::user()->id ?? Request::segment(3);
@endphp

<div class="offset-top"></div>

  <!-- Setup Profile Section -->
  <section class="setup-wrapper position-relative">
        <div class="container">
            <div class="row no-gutters">
                <div class="col-lg-5">
                    <div class="setup-left">
                        <img class="img-fluid" src="{{asset('assets/care_connect_live/images/setup-bg.jpg')}}" alt="">

                        <div class="expert-box">
                            <div class="heading-32">Join the best Experts</div>
                            <p>Millions of people are looking for the right expert on TFH. Start your digital journey with Expert Profile</p>
                        </div>
                    </div>
                </div>
                <div class="offset-lg-4 col-lg-8 setup-box">
                    <div class="setup-right pl-lg-3">
                        <div class="p-6 pb-0">
                            <h1>Select your skills</h1>
                            <p class="mt-2">Set up your personal details, skills, consultation types and Availability
                            </p>
                            <hr class="my-lg-4">
                            <h4 class="mb-4">Service type</h4>
                            @if(session('status.success'))
                                <div class="alert alert-outline alert-success custom_alert">
                                    {{ session('status.success') }}
                                </div>
                            @endif

                            <!-- <div class="alert alert-outline alert-success custom_alert">
                                some alert here
                            </div> -->

                            @if(session('status.error'))
                                <div class="alert alert-outline alert-danger custom_alert">
                                    {{ session('status.error') }}
                                </div>
                            @endif
                        </div>
                        <form  method="post" action="{{url('profile/submitServiceType')}}">
                        @csrf
                        <div class="p-6 pt-lg-3 pt-0">

                            <div class="row">
                            @if($services_data)
                                @foreach($services_data as $key => $service)

                                    <div class="col-12 mb-4" id="{{ $service->id }}_box">
                                        <div class="service-box toggle-icon d-flex align-items-center justify-content-between">
                                            <h6 class="m-0">{{ $service->name }}</h6>
                                            <input type="checkbox" class="toggleclass" value="1"  onchange="valueChanged(this)" name="available[]" id="{{ $service->id }}" data-id="{{ $service->service_id }}"  data-user_id="{{Request::segment(3)}}" @if($service->service_enabled) checked @endif><label for="{{$service->id}}">Toggle</label>
                                            <input type="hidden" name="service_id[]" class="serviceId" value="{{ $service->service_id }}">
                                            <input type="hidden" name="category_id" class="category" value="{{ $cat_info }}">
                                            <input type="hidden" name="user_id" value="{{Request::segment(3)}}">
                                        </div>
                                        <div class="row common-form togglediv" @if($service->service_enabled == false) style="display:none;" @endif>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label>Consultation Fees @if($service->fixed_price=='true') ({{$service->price_type}}) @else  <B>(Add Price {{  $service->price_minimum }}to{{  $service->price_maximum }})</b> @endif</label>
                                                        @if($service->fixed_price=='true')
                                                        @php $readonly = 'readonly'; @endphp
                                                         <input class="form-control price" data-id="{{ $service->service_id }}" name="price_fixed[]"  {{$readonly}} type="number" placeholder="{{$service->price_fixed}}" value="{{$service->price_fixed}}">
                                                        @else
                                                        @php $readonly = ''; @endphp
                                                        <input class="form-control price updateserviceprice" name="price_fixed[]"   {{$readonly}} type="number" placeholder="100" data-id="{{ $service->service_id }}" value="{{$service->price_fixed}}" >
                                                        @endif

                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group currency-format">
                                                        <label>For</label>
                                                        @if($service->fixed_price=='true')
                                                        @php $readonly = 'readonly'; @endphp
                                                        @else
                                                        @php $readonly = ''; @endphp
                                                        @endif

                                                        <span>&#8377; /</span> <input class="form-control duration" data-id="{{ $service->service_id }}" name="minimum_duration[]" type="text" readonly placeholder="1 min" value="{{$service->slot_duration}}">
                                                    </div>
                                                </div>

                                               @php

                                               $check_sp_availbility = \App\Model\ServiceProviderSlot::where('service_provider_id', $user_id)->where('service_id', $service->service_id)->get();
                                                $sp_availbility = \App\Model\SpAvailability::where('user_id', $user_id)->where('service_id', $service->service_id)->get();
                                                $check_sp_availbility = $check_sp_availbility->count();
                                                @endphp
                                                @if($check_sp_availbility > 0)
                                                <div class="col-12 my-3 edit_avail_div">
                                                    <a class="editavailability" data-id="{{ $service->service_id }}" data-category-id="{{  $cat_info  }}" href="#"><i class="fas fa-plus"></i> Edit Availability</a>
                                                </div>
                                                @else
                                                    <div class="col-12 my-3">
                                                    <a class="availability" href="#" data-id="{{ $service->service_id }}" data-category-id="{{  $cat_info }}"><i class="fas fa-plus"></i> Add Availability</a>
                                                </div>

                                                @endif
                                            </div>
                                    </div>

                               @endforeach
                            @endif
                            </div>

                            <div class="form-footer2">

                                <a class="text_16" href="{{url('/profile/profile-step-three/'.$id)}}"><i
                                        class="fas fa-chevron-left left-back align-middle pr-2"></i>
                                    <span>Back</span></a>
                                    <input type="submit" style="float:right;" class="default-btn radius-btn ml-4" name="Done" value="Done" />
                                <!-- <a style="float:inline-end;" class="default-btn radius-btn ml-4" href="#"><span>Done</span> </a> -->
                            </div>
                        </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        var _availbility_add_path = "{{ url('/profile/add_availbility') }}/";
        var _availbility_edit_path = "{{ url('/profile/edit_availbility') }}/";
   </script>
    @endsection
