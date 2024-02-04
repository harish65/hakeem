@extends('vendor.care_connect_live.layouts.dashboard', ['title' => 'Patient'])
@section('content')
 <!-- Offset Top -->
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
                                 <img style="width:200px;" src="{{asset('assets/images/ic_upload profile img.png')}}" alt="">
                                 @else
                                 <img style="width:200px;" src="{{Storage::disk('spaces')->url('uploads/'.Auth::user()->profile_image)}}" alt="">
                                @endif
                            <hr>
                        </div>
                        <ul class="doctor-list pb-2 text-left">
                            <li><a href="{{url('service_provider/profile')}}/{{Auth::user()->id}}"> Profile Details</a></li>
                            <li><a href="{{ url('service_provider/get_manage_availibilty')}}">Manage Availability</a></li>
                            <li class="active"><a href="{{ url('service_provider/get_manage_preferences')}}">Manage Preferences</a></li>
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
                   <div class="bg-them manage-profile">
                   @if($filters)
                            @php $ii = 0; @endphp
                             @foreach($filters as $filterkey => $filter)
                             @php $ii++; @endphp
                             <form class="preference" id="Preference" method="post" action="{{url('/service_provider/setFilters')}}">
                             @csrf  
                            <h4 class="mb-4 filtername" data-id ="{{$filter['id']}}" data-multi="{{ $filter['is_multi']}}" >{{$filter['filter_name']}}</h4>
                            <input type="hidden" class="filters" name="filters[]" value="{{ $filter['id'] }}">
                        </div>
                    <div class="row">
                        <div class="col-12">
                            <!-- <h6 class="mt-0 mb-4">Skills</h6> -->
                        </div>
                        @foreach($filter['options'] as $key => $option)
                        
                        <?php
                            $option_enabled = false;
                            $check_status = \App\Model\ServiceProviderFilterOption::where('filter_option_id', $option['id'])->where('sp_id',Auth::user()->id)->first();
                          //  print_r($check_status);
                            if($check_status)
                            {
                                $option_enabled = true;
                            }
                        ?>

                        <div class="col-md-6 mb-4">
                            <div class="skill-box">
                                <div class="chiller_cb small_label d-inline-block checkval" data-id= '{{$filterkey.$key}}'> 
                                <ul class="list {{$filterkey.$key}}" >
                                    <li>
                                        @if($filter['is_multi'] == 0)
                                            <input class="filter_option_ids" @if($option_enabled == true) checked @endif id="pd{{ $filterkey.$key }}" value="{{ $option['id'] }}" type="radio" name="filter_option_ids[{{ $ii }}][]" >
                                        @else
                                            <input class="filter_option_ids"  id="pd{{ $filterkey.$key }}" @if($option_enabled == true) checked @endif value="{{ $option['id'] }}" type="checkbox" name="filter_option_ids[{{ $ii }}][]" >
                                        @endif

                                        <label for="pd{{ $filterkey.$key }}" class="optionname" data-id="{{ $option['id'] }}">{{$option['option_name']}}</label>
                                        <span class="check_icon"></span>
                                  
                                    </li>
                                </ul>   
                                  </div>
                            </div>
                        </div>
                    @endforeach
                     
                        
                        <div class="col-12 mt-5 pt-lg-5">
                             <input type="submit" name="update" class="default-btn radius-btn  w-136 disable-btn" value="Update">
                            <!-- <a class="default-btn radius-btn w-136 disable-btn" href="#"><span>Update</span></a> -->
                        </div>
                    </div>
                    </form>
                    @endforeach
                    @endif
                   </div>
                        
                </div>
            </div>
        </div>
    </section>

@endsection