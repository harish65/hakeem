@extends('vendor.hexalud.layouts.home', ['title' => 'Profile'])
@section('content')

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
                            <p>Millions of people are looking for the right expert on TFH. Start your
                                digital journey with Expert Profile</p>
                        </div>
                    </div>
                </div>
                <div class="offset-lg-4 col-lg-8 setup-box">

                    <div class="setup-right pl-lg-3">
                        <div class="p-6 pb-0">
                        <h1>Set Preference</h1>
                            <p class="mt-2">Set up your personal details, skills, consultation types and Availability
                            </p>

                            <hr class="my-lg-4">
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
                            @if($filters)
                            @php $ii = 0; @endphp
                             @foreach($filters as $filterkey => $filter)
                             @php $ii++; @endphp
                             <form class="preference" id="Preference" method="post" action="{{url('/profile/setFilters')}}">
                             @csrf
                            <h4 class="mb-4 filtername" data-id ="{{$filter['id']}}" data-multi="{{ $filter['is_multi']}}" >
                            <input type="hidden" name="user_id" value="{{Auth::user()->id ?? Request::segment(3)}}">
                            {{$filter['filter_name']}}</h4>
                            <input type="hidden" class="filters" name="filters[]" value="{{ $filter['id'] }}">
                        </div>

                        <div class="p-6 pt-lg-3 pt-0">

                            <div class="row">
                                @php
                                $user_id = Request::segment(3);
                                if(Auth::user())
                                {
                                    $user_id = Auth::user()->id;
                                }
                                @endphp

                          @foreach($filter['options'] as $key => $option)

                                <?php
                                    $option_enabled = false;
                                    $check_status = \App\Model\ServiceProviderFilterOption::where('filter_option_id', $option['id'])->where('sp_id',$user_id)->first();
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

                            </div>
                            @endforeach
                            @endif

                            <div class="form-footer2 ">
                               <a class="text_16" href="{{url('/profile/profile-step-two/'.$id)}}"><i class="fas fa-chevron-left left-back align-middle pr-2"></i> <span>Back</span></a>
                               <!-- <a style="float:inline-end;" class="default-btn radius-btn ml-4" href="{{url('/profile/profile-step-four/'.$id)}}"><span>Next</span> </a> -->
                           <input type="submit"  class="default-btn radius-btn ml-4"  style="float:inline-end;" Value="next">
                            </div>
                        </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </section>
    @endsection
