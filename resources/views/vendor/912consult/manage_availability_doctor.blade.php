@extends('vendor.912consult.layouts.dashboard', ['title' => 'Patient'])
@section('content')
 <!-- Offset Top -->
 <style>

#schedules {
	width: 640px;
	overflow-x: scroll;
	overflow-y: hidden;
}
.schedule_date
{
    border: 1px groove !important;
    padding: 7px !important;
}

.days-list li {
	margin-right: 12px;
}

.days-list li a {
	display: block;
	width: 100px;
}


</style>
 <div class="offset-top"></div>
   <!-- Manage Availability-Doctor Section -->
   <section class="profile-wrapper edit-profile mb-lg-5 py-5">
        <div class="container">
            <div class="row">
                <div class="col-12 mb-5">
                    <h1>Account</h1>
                </div>
                <div class="col-lg-4 pr-lg-0">
                    <div class="bg-them border-0 text-center">
                        <div class="position-relative px-5 pt-5">
                                 @if(Auth::user()->profile_image == '' &&  Auth::user()->profile_image == null)
                                 <img class="user-profile showImg" src="{{asset('assetss/images/ic_upload profile img.png')}}" alt="">
                                 @else
                                 <img class="user-profile showImg" src="{{Storage::disk('spaces')->url('uploads/'.Auth::user()->profile_image)}}" alt="">
                                @endif
                            <hr>
                        </div>
                        <ul class="doctor-list pb-2 text-left">
                            <li><a href="{{url('service_provider/profile')}}/{{Auth::user()->id}}"> Profile Details</a></li>
                            <li class="active"><a href="{{ url('service_provider/get_manage_availibilty')}}">Manage Availability</a></li>
                            <li><a href="{{ url('service_provider/get_manage_preferences')}}">Manage Preferences</a></li>
                            <li><a href="{{ url('service_provider/get_update_category')}}">Update Category</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-8 profile-detail">
                <div class="col-12">
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
                <!-- <form  method="post" action="{{url('profile/submitServiceType')}}">
                        @csrf    -->
                   <div class="bg-them manage-profile">
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
                                            <a class="editavailability_manage" data-id="{{ $service->service_id }}" data-category-id="{{  $cat_info  }}" href="#"><i class="fas fa-plus"></i> Edit Availability</a>
                                        </div>
                                        @else
                                            <div class="col-12 my-3">
                                            <a class="availability_manage" href="#" data-id="{{ $service->service_id }}" data-category-id="{{  $cat_info }}"><i class="fas fa-plus"></i> Add Availability</a>
                                        </div>

                                        @endif
                                    </div>
                            </div>

                        @endforeach
                    @endif
                    </div>
                   <!-- <div class="form-footer2">
                     <input type="submit"  class="default-btn radius-btn ml-4" name="Update" value="Done" />
                     <a style="float:inline-end;" class="default-btn radius-btn ml-4" href="#"><span>Done</span> </a>
                    </div> -->
                    </div>
                    <!-- </form> -->


            </div>
        </div>
    </section>
    <script>
        var _availbility_add_path = "{{ url('service_provider/add_availbility') }}/";
        var _availbility_edit_path = "{{ url('/profile/edit_availbility') }}/";
        var _availbility_get_path = "{{ url('/profile/get_availbility') }}";
   </script>

@endsection
