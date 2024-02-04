@extends('vendor.care_connect_live.layouts.dashboard', ['title' => 'Profile'])
@section('content')

<div class="offset-top" style="margin-top:51px;"></div>

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
                                            <input type="checkbox" class="toggleclass" value="1" @if($service->service_enabled) checked @endif onchange="valueChanged(this)" name="available[]" id="{{ $service->id }}" data-id="{{ $service->service_id }}"  /><label for="{{$service->id}}">Toggle</label>
                                            <input type="hidden" name="service_id[]" class="serviceId" value="{{ $service->service_id }}">
                                            <input type="hidden" name="category_id" class="category" value="{{ $cat_info }}">
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
                                               $check_sp_availbility = \App\Model\ServiceProviderSlot::where('service_provider_id', Auth::user()->id)->where('service_id', $service->service_id)->get();
                                                $sp_availbility = \App\Model\SpAvailability::where('user_id', Auth::user()->id)->where('service_id', $service->service_id)->get();
                                                $check_sp_availbility = $check_sp_availbility->count();
                                                @endphp
                                                @if($check_sp_availbility > 0)
                                                <div class="col-12 my-3 edit_avail_div">
                                                    <!-- <a class="editavailability" data-id="{{ $service->service_id }}" data-category-id="{{  $cat_info  }}" href="#"><i class="fas fa-plus"></i> Edit Availability</a> -->
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
        <!-- availbility -->

 <!-- Add Availability Modal -->
<section class="availability-popup">
  <div class="container">
    <div class="row">
      <div class="col">
        <div class="modal fade" id="addAvailbityModal">
          <div class="modal-dialog modal-md ">
              <div class="modal-content ">
                  <div class="modal-header d-block pt-3 px-4 pb-0 border-0">
                      <button type="button" class="close" data-dismiss="modal">
                          <img src="{{asset('assets/images/ic_cancel.png')}}" alt="">
                      </button>
                      <h4 class="modal-title login-head">Add availability</h4>
                      <hr>
                  </div>
                  <form class="availbilityform"  method="post" action="{{url('/profile/add_availbility')}}">
                  @csrf
                  <div class="modal-body px-4 pt-2 pb-3">
                  <h6>Week Days</h6>
                  <div class="button-group-pills text-center" data-toggle="buttons">
                        <label class="btn btn-default active">
                          <input type="checkbox" name="options[]"  value="0">
                          <div>S</div>
                        </label>
                        <label class="btn btn-default">
                          <input type="checkbox" name="options[]"  value="1">
                          <div>M</div>
                        </label>
                        <label class="btn btn-default">
                          <input type="checkbox" name="options[]"  value="2">
                          <div>T</div>
                        </label>
                        <label class="btn btn-default">
                          <input type="checkbox" name="options[]"  value="3">
                          <div>W</div>
                        </label>
                        <label class="btn btn-default">
                          <input type="checkbox" name="options[]"  value="4">
                          <div>T</div>
                        </label>
                        <label class="btn btn-default">
                          <input type="checkbox" name="options[]"  value="5">
                          <div>F</div>
                        </label>
                        <label class="btn btn-default">
                          <input type="checkbox" name="options[]" value="6">
                          <div>S</div>
                        </label>
                      </div>
                      <input type="hidden" name="service_id" class="serviceid">
                      <input type="hidden" name="category_id" class="categoryid">
                      <h6 style="display:none;">Select Date</h6>
                      <div class="date-carousel px-5 mt-4 mb-5" style="display:none;"  >
                          <div>
                              <div class="date-box">
                                  <label class="d-block">Today</label>
                                  <h6>Jun 22, 20</h6>
                              </div>
                          </div>
                          <div>
                              <div class="date-box">
                                  <label class="d-block">Tomorrow</label>
                                  <h6>Jun 23, 20</h6>
                              </div>
                          </div>
                          <div>
                              <div class="date-box">
                                  <label class="d-block">Wednesday</label>
                                  <h6>Jun 24, 20</h6>
                              </div>
                          </div>
                          <div>
                              <div class="date-box">
                                  <label class="d-block">Thursday</label>
                                  <h6>Jun 25, 20</h6>
                              </div>
                          </div>
                          <div>
                              <div class="date-box">
                                  <label class="d-block">Friday</label>
                                  <h6>Jun 26, 20</h6>
                              </div>
                          </div>
                          <div>
                              <div class="date-box">
                                  <label class="d-block">Tomorrow</label>
                                  <h6>Jun 23, 20</h6>
                              </div>
                          </div>
                          <div>
                              <div class="date-box">
                                  <label class="d-block">Wednesday</label>
                                  <h6>Jun 24, 20</h6>
                              </div>
                          </div>
                      </div>
                      <h6>Select Time</h6>
                      <div id="customFields">
                        <div class="new_row row align-items-center">
                            <div class="col-11 pr-0 interv_div" >
                                <div class="row common-form">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>From</label>
                                            <input class="form-control" type="time" placeholder="11:00 am" name="start_time[]" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>To</label>
                                            <input class="form-control" type="time" placeholder="11:00 am" name="end_time[]" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-1">
                                <label></label>
                                <a class="remCF" href="#"><i class="fas fa-trash-alt"></i></a>
                            </div>
                        </div>
                      </div>
                      <div class="row">
                          <div class="col-12">
                              <a class="newrow" href="#"><i class="fas fa-plus"></i> New Interval</a>
                          </div>
                      </div>
                      <div class="form-group spacing-eight mt-6 mb-3">
                        <input type="submit" class="default-btn w-100 radius-btn" id="add_availbility" name="Save" value="Save">
                      </div>
                      <div class="row no-gutters spacing-eight mt-6 mb-3" style="display:none;">
                          <div class="col-sm-4">
                              <a class="default-btn radius-btn border-btn w-100 px-2" href="#"><span>All Weekdays</span></a>
                          </div>
                          <div class="col-sm-3">
                              <a class="default-btn radius-btn border-btn w-100 px-2" href="#"><span>For Jun 24, 20</span></a>
                          </div>
                          <div class="col-sm-3">
                              <a class="default-btn radius-btn border-btn w-100 px-2" href="#"><span>All Wednesday</span></a>
                          </div>
                      </div>
                  </div>
                </form>
              </div>
          </div>
        </div>

        <div class="modal fade" id="editAvailbityModal">
          <div class="modal-dialog modal-md ">
              <div class="modal-content ">
                  <div class="modal-header d-block pt-3 px-4 pb-0 border-0">
                      <button type="button" class="close" data-dismiss="modal">
                          <img src="{{asset('assets/images/ic_cancel.png')}}" alt="">
                      </button>
                      <h4 class="modal-title login-head">Edit availability</h4>
                      <hr>
                  </div>
                  <form class="availbilityform" method="post" action="{{url('/profile/edit_availbility')}}">
                    @csrf
                    <!-- <input type="hidden" name="service_id"> -->
                    <input type="hidden" name="category_id" class="categoryid">

                  <div class="modal-body px-4 pt-2 pb-3">
                  <h6>Week Days</h6>
                  <div class="button-group-pills text-center" data-toggle="buttons">
                        <label class="btn btn-default">
                          <input type="checkbox" name="options[]" value="0">
                          <div>S</div>
                        </label>
                        <label class="btn btn-default">
                          <input type="checkbox" name="options[]"  value="1">
                          <div>M</div>
                        </label>
                        <label class="btn btn-default">
                          <input type="checkbox" name="options[]"  value="2">
                          <div>T</div>
                        </label>
                        <label class="btn btn-default">
                          <input type="checkbox" name="options[]"  value="3">
                          <div>W</div>
                        </label>
                        <label class="btn btn-default">
                          <input type="checkbox" name="options[]"  value="4">
                          <div>T</div>
                        </label>
                        <label class="btn btn-default">
                          <input type="checkbox" name="options[]"  value="5">
                          <div>F</div>
                        </label>
                        <label class="btn btn-default">
                          <input type="checkbox" name="options[]" value="6">
                          <div>S</div>
                        </label>
                      </div>
                      <input type="hidden" name="service_id" class="serviceid">
                      <h6>Select Time</h6>
                      <div id="customFields">
                      </div>
                      <div class="row">
                          <div class="col-12">
                              <a class="newrow" href="#"><i class="fas fa-plus"></i> New Interval</a>
                          </div>
                      </div>
                      <div class="form-group spacing-eight mt-6 mb-3">
                        <input type="submit" class="default-btn w-100 radius-btn" id="add_availbility" name="Save" value="Update">
                      </div>
                  </div>
                </form>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

    </section>
    <script>
        var _availbility_add_path = "{{ url('/profile/add_availbility') }}/";
        var _availbility_edit_path = "{{ url('/profile/edit_availbility') }}/";
        
   </script>
    @endsection