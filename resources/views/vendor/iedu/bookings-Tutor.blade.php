@extends('vendor.iedu.layouts.index', ['title' => 'Home'])
@section('content')
<link rel="stylesheet" href="{{asset('assets/care_connect_live/css/bootstrap.css')}}">
    <style type="text/css">
        input[type=checkbox] {
            width: auto !important;
        }
    </style>
    <section class="study-material booking-request">
        <div class="container">
            <div class="row">
                <div class="col-md-4 menu-b">
                    <button class="btn btn-menu" id="menu-btn" >Menu</button>
                    <ul class="nav nav-tabs " id="menu-btn-slide">
                        <h3>Menu</h3>
                        <li><a class="active" data-toggle="tab" href="#home"><i class="fa fa-calendar-o"
                                    aria-hidden="true"></i>Booking Requests</a></li>
                        <!-- <li><a data-toggle="tab" href="#menu1"><i class="fa fa-calendar" aria-hidden="true"></i>Bookings</a></li> -->
                        <li><a data-toggle="tab" href="#menu2"><i class="fa fa-calendar" aria-hidden="true"></i>Revenue</a>
                        </li>
                        <li><a data-toggle="tab" href="#menu3"><i class="fa fa-calendar" aria-hidden="true"></i>Study
                                Material</a></li>
                        <li><a data-toggle="tab" href="#menu4"><i class="fa fa-calendar" aria-hidden="true"></i>Reviews</a>
                        </li>
                        <li><a data-toggle="tab" href="#menu5"><i class="fa fa-calendar" aria-hidden="true"></i>Profile
                                Settings</a></li>
                        <!-- <li><a data-toggle="tab" href="#menu6"><i class="fa fa-calendar" aria-hidden="true"></i>Manage Availability</a></li> -->
                        <li><a data-toggle="tab" href="#menu7"><i class="fa fa-calendar" aria-hidden="true"></i>Choose
                                Course</a></li>
                        <li><a data-toggle="tab" href="#menu8"><i class="fa fa-calendar" aria-hidden="true"></i>Emsat</a>
                        </li>
                        <!-- <li><a data-toggle="tab" href="#menu9"><i class="fa fa-calendar" aria-hidden="true"></i>Manage Documents</a></li> -->
                        <li><a data-toggle="tab" href="#menu10"><i class="fa fa-calendar" aria-hidden="true"></i>Update
                                Category</a></li>
                        <li><a data-toggle="tab" href="#menu11"><i class="fa fa-calendar" aria-hidden="true"></i>Update
                            Availability</a></li>
                    </ul>
                </div>
                <div class="col-md-8">
                    <div class="tab-content">
                        <div id="home" class="tab-pane fade in active show">
                            <div class="bokking-date">
                                <h3>Booking Requests</h3>
                                {{-- <form class="appiontment" method="get" action="{{ url('user/appointments') }}">
                                    <input type="date" id="birthday" class="appiontmentdate" name="date">
                                </form> --}}
                            </div>
                            <div class="all-booking-section">
                                @if (Auth::user()->account_verified == '' && Auth::user()->account_verified == null)

                                    <div class="col-sm-12">

                                        <h4 style="margin-top:10%"> Your Profile Submit for Approval. </h4>

                                    </div>
                                @else
                                    @if ($data)
                                        @foreach ($data as $request)
                                            @if($request && isset($request->id))
                                            <div class="bokking-id2 appointment_div" data-id="{{ $request->id }}">
                                                @if ($request->from_user->profile_image == '' && $request->from_user->profile_image == null)
                                                    <img class="rounded-circle"
                                                        src="{{ asset('assets/iedu/images/dummy_profile.webp') }}" alt="">
                                                @else
                                                    <img class="rounded-circle"
                                                        src="{{ Storage::disk('spaces')->url('uploads/' . $request->from_user->profile_image) }}"
                                                        alt="">
                                                @endif
                                                <div class="client-desc">
                                                    @php
                                                        $status = $request->requesthistory->status;
                                                        $bookingdate = date('Y-m-d', strtotime($request->booking_date));
                                                    @endphp
                                                    @if ($bookingdate >= $current_date)
                                                        @if ($status == 'pending')
                                                            <span class="badge badge-primary">{{ 'NEW REQUEST' }}</span>
                                                        @elseif($status == 'canceled')
                                                            <span class="badge badge-danger">{{ 'CANCELLED' }}</span>
                                                        @elseif($status == 'accept')
                                                            <span class="badge badge-success ">{{ 'ACCEPTED' }}</span>
                                                        @elseif($status == 'in-progress')
                                                            <span class="badge badge-info">{{ 'In Progress' }}</span>
                                                        @else
                                                            <span class="badge badge-dark">{{ 'COMPLETED' }}</span>
                                                        @endif
                                                    @else
                                                        @if ($status == 'pending')
                                                            <span class="badge badge-danger">{{ 'No Show' }}</span>
                                                        @elseif($status == 'canceled')
                                                            <span class="badge badge-danger">{{ 'CANCELLED' }}</span>
                                                        @elseif($status == 'accept')
                                                            <span class="badge badge-danger ">{{ 'No Show' }}</span>
                                                        @elseif($status == 'in-progress')
                                                            <span class="badge badge-danger">{{ 'No Show' }}</span>
                                                        @else
                                                            <span class="badge badge-dark">{{ 'COMPLETED' }}</span>
                                                        @endif
                                                    @endif

                                                    @if (Config('client_connected') && Config::get('client_data')->domain_name == 'iedu')
                                                        @php $currency = 'AED';  @endphp
                                                    @else
                                                        @php $currency = '₹'; @endphp
                                                    @endif
                                                    <h4>{{ $request->from_user->name }}<span>.</span>{{ $currency }}
                                                        {{ $request->price }}</h4>
                                                    <p><a href="#">
                                                            @if ($request->request_category_type)
                                                                {{ $request->request_category_type }}
                                                                ({{ $request->to_user->categoryData->name }})
                                                            @endif
                                                        </a></p>
                                                    <p> {{ date('d M, Y  . h:i a', strtotime($request->booking_date)) }}
                                                    </p>
                                                    <a class="view_details" data-id="{{ $request->id }}"
                                                        href="javascript:void(0)"><span>View Details</span></a>
                                                </div>
                                                @if ($bookingdate >= $current_date)
                                                    @if ($status == 'pending')
                                                        <div class="client-btn">
                                                            <a class="default-btn radius-btn border-btn accept_request"
                                                                data-request='Accept' href="javascript:void(0)"
                                                                data-service_id='{{ $request->service_id }}'
                                                                data-request_id='{{ $request->id }}'
                                                                data-to_user='{{ $request->to_user->id }}'
                                                                data-from_user='{{ $request->from_user->id }}'><span>Accept</span></a>
                                                            <a class="default-btn radius-btn border-btn  cancel_request"
                                                                data-request='Cancel'
                                                                data-service_id='{{ $request->service_id }}'
                                                                data-request_id='{{ $request->id }}'
                                                                data-to_user='{{ $request->to_user->id }}'
                                                                data-from_user='{{ $request->from_user->id }}'
                                                                href="javascript:void(0)"><span>Cancel</span></a>
                                                        </div>
                                                    @endif
                                                    @if ($status == 'accept' && $request->service_type != 'Clinic Visit')
                                                        <div class="client-btn">
                                                            <a class="default-btn radius-btn border-btn start_request"
                                                                data-request='Start' href="javascript:void(0)"
                                                                data-service_id='{{ $request->service_id }}'
                                                                data-request_id='{{ $request->id }}'
                                                                data-to_user='{{ $request->to_user->id }}'
                                                                data-from_user='{{ $request->from_user->id }}'><span>Start
                                                                    Request</span></a>
                                                            <a class="default-btn radius-btn border-btn mark_complete"
                                                                data-service='{{ $request->service_type }}'
                                                                data-request='Mark Complete' href="javascript:void(0)"
                                                                data-service_id='{{ $request->service_id }}'
                                                                data-request_id='{{ $request->id }}'
                                                                data-to_user='{{ $request->to_user->id }}'
                                                                data-from_user='{{ $request->from_user->id }}'><span>Mark
                                                                    Complete</span></a>
                                                        </div>
                                                    @endif
                                                    @if ($status == 'in-progress')
                                                        <div class="client-btn">
                                                            @if ($request->service_type == 'Audio Call' || $request->service_type == 'audio_call' || $request->service_type == 'Video Call' || $request->service_type == 'video_call')
                                                                <a class="default-btn radius-btn border-btn start_request"
                                                                    data-request='Start' href="javascript:void(0)"
                                                                    data-service_id='{{ $request->service_id }}'
                                                                    data-request_id='{{ $request->id }}'
                                                                    data-to_user='{{ $request->to_user->id }}'
                                                                    data-from_user='{{ $request->from_user->id }}'><span>Start
                                                                        Request</span></a>
                                                            @endif
                                                            <a class="default-btn radius-btn border-btn mark_complete"
                                                                data-service='{{ $request->service_type }}'
                                                                data-request='Mark Complete' href="javascript:void(0)"
                                                                data-service_id='{{ $request->service_id }}'
                                                                data-request_id='{{ $request->id }}'
                                                                data-to_user='{{ $request->to_user->id }}'
                                                                data-from_user='{{ $request->from_user->id }}'><span>Mark
                                                                    Complete</span></a>
                                                        </div>
                                                    @endif
                                                @endif
                                                @if ($status == 'completed')
                                                    <div class="client-btn">
                                                        <!-- @if ($request->is_prescription == true)
    <a class="default-btn radius-btn border-btn prescription" href="{{ url('/generate-pdf') }}?request_id={{ $request->id }}&client_id={{ Config::get('client_id') }}" ><span><i class="fa fa-eye"></i> Prescription</span></a>
              <a class="default-btn radius-btn border-btn prescription" href="{{ url('service_provider/prescription') }}?request_id={{ $request->id }}&pre_scription_id={{ $request->prescription->id }}" ><span><i class="fa fa-edit"></i> Prescription</span></a>
@else
    <a class="default-btn radius-btn border-btn prescription" href="{{ url('service_provider/prescription') }}?request_id={{ $request->id }}" ><span><i class="fa fa-plus"></i> Prescription</span></a>
    @endif -->
                                                    </div>
                                                @endif
                                                <!-- <div class="client-btn">
             <a class="reject" href="#">Reject</a>
              <a class="acept" href="#">Accept</a>
            </div> -->
                                            </div>
                                            <!-- View detail Modal -->
                                            <div class="modal  fade" id="view_detail_container{{ $request->id }}"
                                                tabindex="-1">
                                                <div class="modal-dialog modal-md modal-dialog-center">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Details</h5>

                                                            <button type="button" class="close"
                                                                data-dismiss="modal">&times;</button>
                                                        </div>
                                                        <div class="modal-body">

                                                            <div class="row">
                                                                <div class="col-sm-6">
                                                                    @if ($request->from_user->profile_image == '' || $request->from_user->profile_image == null)
                                                                        <img width="200px"
                                                                            src="{{ asset('assets/images/ic_upload profile img.png') }}"
                                                                            alt="">
                                                                    @else
                                                                        <img width="200px"
                                                                            src="{{ Storage::disk('spaces')->url('uploads/' . $request->from_user->profile_image) }}"
                                                                            alt="">
                                                                    @endif
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <label>{{ ucwords($request->from_user->name) }}</label>
                                                                </div>
                                                            </div>
                                                            <hr>
                                                            <div class="row">
                                                                <div class="col-sm-6">
                                                                    <p> Service type </p>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <p> {{ $request->service_type }} </p>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-6">
                                                                    Date
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    {{ date(' d M , Y', strtotime($request->booking_date)) }}

                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-6">
                                                                    Time
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    {{ $request->time }}
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-6">
                                                                    Price
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    â‚¹ {{ $request->price }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                        @endforeach
                                    @endif
                                @endif
                                <!-- Delete  Modal -->
                                <div class="modal fade formConfirm" id="" tabindex="-1" role="dialog"
                                    aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-md modal-dialog-center">
                                        <div class="modal-content">
                                            <div class="modal-header">

                                                <h5 class="modal-title" id="frm_title"><span class="request">
                                                    </span> Confirmation</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body confirm_model_body" id="frm_body">
                                                <p> Are you Sure you want to <span class="request"></span> Request ?
                                                </p>
                                                <input type="hidden" class="request_id" name="request_id">
                                                <input type="hidden" class="from_user" name="from_user">
                                                <input type="hidden" class="to_user" name="to_user">
                                                <input type="hidden" class="service_id" name="service_id">
                                                <input type="hidden" class="service" name="service">
                                            </div>
                                            <div class="modal-footer">
                                                @if (isset($request) && isset($request->id))
                                                    <button type="button"
                                                        class="btn btn-primary pull-right final_cancel_confirmmation"
                                                        data-service='{{ $request->service_type }}'
                                                        data-service_id='{{ $request->service_id }}'
                                                        data-request_id='{{ $request->id }}'
                                                        data-to_user='{{ $request->to_user->id }}'
                                                        data-from_user='{{ $request->from_user->id }}'
                                                        id="frm_submit"><span class="request"></span> </button>
                                                    <button style="color:#ffff; font-weight:bold;" type="button"
                                                        class="btn btn-danger  pull-right" data-dismiss="modal"
                                                        id="frm_cancel">No</button>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>

                        <div id="menu1" class="tab-pane past-bokking fade in">
                            <div class="bokking-date">
                                <h3>All Bookings</h3>
                                <span>Filter<i class="fa fa-list" aria-hidden="true"></i></span>
                            </div>
                            <div class="all-booking-section">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a class="active" data-toggle="tab"
                                            href="#tb-1">Upcoming</a></li>
                                    <li><a data-toggle="tab" href="#tb-2">Past</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div id="tb-1" class="tab-pane fade in active show">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="upcomming-events">
                                                    <div class="upcomming-events-in">
                                                        <img src="images/favourite_lender_4.png" alt="">
                                                        <div class="upcoming-des">
                                                            <h3>Geetika Gupta</h3>
                                                            <p>Today · 12:30 pm</p>

                                                        </div>
                                                        <span>$55</span>
                                                    </div>
                                                    <div class="cancel-bokking">
                                                        <a href="#">Accept</a>
                                                        <a href="#">Cancel booking</a>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="col-md-6">
                                                <div class="upcomming-events">
                                                    <div class="upcomming-events-in">
                                                        <img src="images/favourite_lender_4.png" alt="">
                                                        <div class="upcoming-des">
                                                            <h3>Geetika Gupta</h3>
                                                            <p>Today · 12:30 pm</p>

                                                        </div>
                                                        <span>$55</span>
                                                    </div>
                                                    <div class="cancel-bokking">
                                                        <a href="#">Accept</a>
                                                        <a href="#">Cancel booking</a>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="col-md-6">
                                                <div class="upcomming-events">
                                                    <div class="upcomming-events-in">
                                                        <img src="images/favourite_lender_4.png" alt="">
                                                        <div class="upcoming-des">
                                                            <h3>Geetika Gupta</h3>
                                                            <p>Today · 12:30 pm</p>

                                                        </div>
                                                        <span>$55</span>
                                                    </div>
                                                    <div class="cancel-bokking">
                                                        <a href="#">Accept</a>
                                                        <a href="#">Cancel booking</a>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="col-md-6">
                                                <div class="upcomming-events">
                                                    <div class="upcomming-events-in">
                                                        <img src="images/favourite_lender_4.png" alt="">
                                                        <div class="upcoming-des">
                                                            <h3>Geetika Gupta</h3>
                                                            <p>Today · 12:30 pm</p>

                                                        </div>
                                                        <span>$55</span>
                                                    </div>
                                                    <div class="cancel-bokking">
                                                        <a href="#">Accept</a>
                                                        <a href="#">Cancel booking</a>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="col-md-6">
                                                <div class="upcomming-events">
                                                    <div class="upcomming-events-in">
                                                        <img src="images/favourite_lender_4.png" alt="">
                                                        <div class="upcoming-des">
                                                            <h3>Geetika Gupta</h3>
                                                            <p>Today · 12:30 pm</p>

                                                        </div>
                                                        <span>$55</span>
                                                    </div>
                                                    <div class="cancel-bokking">
                                                        <a href="#">Accept</a>
                                                        <a href="#">Cancel booking</a>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="col-md-6">
                                                <div class="upcomming-events">
                                                    <div class="upcomming-events-in">
                                                        <img src="images/favourite_lender_4.png" alt="">
                                                        <div class="upcoming-des">
                                                            <h3>Geetika Gupta</h3>
                                                            <p>Today · 12:30 pm</p>

                                                        </div>
                                                        <span>$55</span>
                                                    </div>
                                                    <div class="cancel-bokking">
                                                        <a href="#">Accept</a>
                                                        <a href="#">Cancel booking</a>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div id="tb-2" class="tab-pane past-event fade">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="upcomming-events">
                                                    <div class="upcomming-events-in">
                                                        <img src="images/favourite_lender_4.png" alt="">
                                                        <div class="upcoming-des">
                                                            <h3>Geetika Gupta</h3>
                                                            <p>Today · 12:30 pm</p>

                                                        </div>
                                                        <span>$55</span>
                                                    </div>
                                                    <div class="cancel-bokking">
                                                        <a href="#">Completed</a>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="col-md-6">
                                                <div class="upcomming-events">
                                                    <div class="upcomming-events-in">
                                                        <img src="images/favourite_lender_4.png" alt="">
                                                        <div class="upcoming-des">
                                                            <h3>Geetika Gupta</h3>
                                                            <p>Today · 12:30 pm</p>

                                                        </div>
                                                        <span>$55</span>
                                                    </div>
                                                    <div class="cancel-bokking">
                                                        <a href="#">Completed</a>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="col-md-6">
                                                <div class="upcomming-events">
                                                    <div class="upcomming-events-in">
                                                        <img src="images/favourite_lender_4.png" alt="">
                                                        <div class="upcoming-des">
                                                            <h3>Geetika Gupta</h3>
                                                            <p>Today · 12:30 pm</p>

                                                        </div>
                                                        <span>$55</span>
                                                    </div>
                                                    <div class="cancel-bokking">
                                                        <a href="#">Completed</a>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="col-md-6">
                                                <div class="upcomming-events">
                                                    <div class="upcomming-events-in">
                                                        <img src="images/favourite_lender_4.png" alt="">
                                                        <div class="upcoming-des">
                                                            <h3>Geetika Gupta</h3>
                                                            <p>Today · 12:30 pm</p>

                                                        </div>
                                                        <span>$55</span>
                                                    </div>
                                                    <div class="cancel-bokking">
                                                        <a href="#">Completed</a>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="col-md-6">
                                                <div class="upcomming-events">
                                                    <div class="upcomming-events-in">
                                                        <img src="images/favourite_lender_4.png" alt="">
                                                        <div class="upcoming-des">
                                                            <h3>Geetika Gupta</h3>
                                                            <p>Today · 12:30 pm</p>

                                                        </div>
                                                        <span>$55</span>
                                                    </div>
                                                    <div class="cancel-bokking">
                                                        <a href="#">Completed</a>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="col-md-6">
                                                <div class="upcomming-events">
                                                    <div class="upcomming-events-in">
                                                        <img src="images/favourite_lender_4.png" alt="">
                                                        <div class="upcoming-des">
                                                            <h3>Geetika Gupta</h3>
                                                            <p>Today · 12:30 pm</p>

                                                        </div>
                                                        <span>$55</span>
                                                    </div>
                                                    <div class="cancel-bokking">
                                                        <a href="#">Completed</a>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if (Config('client_connected') && Config::get('client_data')->domain_name == 'iedu')
                            @php $currency = 'AED';  @endphp
                        @else
                            @php $currency = '₹'; @endphp
                        @endif
                        <div id="menu2" class="tab-pane past-bokking fade in">
                            <div class="bokking-date">
                                <h3>Revenue</h3>
                            </div>
                            <div class="all-booking-section">
                                <div class="row">
                                    <div class="col-lg-3 col-md-6 col-sm-6">
                                        <div class="revenue-inner">
                                            <img src="images/ic_9.png" alt="">
                                            <p>Highest no. of online Classes </p>
                                            <div class="revenue-detail">
                                                <h5>English</h5><span>0</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-6">
                                        <div class="revenue-inner ren-st-1">
                                            <img src="images/ic_9.png" alt="">
                                            <p>Highest no. of online Classes </p>
                                            <div class="revenue-detail">
                                                <h5>English</h5><span>0</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-6">
                                        <div class="revenue-inner ren-st-2">
                                            <img src="images/ic_9.png" alt="">
                                            <p>Highest no. of online Classes </p>
                                            <div class="revenue-detail">
                                                <h5>English</h5><span>0</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-6">
                                        <div class="revenue-inner ren-st-3">
                                            <img src="images/ic_9.png" alt="">
                                            <p>Highest no. of online Classes </p>
                                            <div class="revenue-detail">
                                                <h5>English</h5><span>0</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tol-reven">
                                    <p>Total amount collected </p>
                                    <h4>{{ $currency }} {{$revenu_res['totalRevenue'] ?? 0}}</h4>

                                </div>
                                <div class="chart-img">
                                    <img src="images/chart.png" alt="">
                                </div>
                            </div>
                        </div>

                        <div id="menu3" class="tab-pane past-bokking study-material fade in">
                            <div class="bokking-date">
                                <h3>Study Material</h3>
                            </div>
                            <div class="all-booking-section">
                                <ul class="nav nav-tabs">
                                    @foreach ($classes as $k => $class)
                                        <li><a class="{{ $k == 0 ? 'active' : '' }}" data-toggle="tab"
                                                href="#bk-{{ $k }}">{{ $class->name }}</a></li>
                                    @endforeach
                                </ul>
                                <div class="tab-content">
                                    @foreach ($classes as $k => $class)
                                        <div id="bk-{{ $k }}"
                                            class="tab-pane fade in {{ $k == 0 ? 'active show' : '' }}">
                                            <div class="row">
                                                @foreach ($class->subjects as $subject)
                                                    <div class="col-lg-3 col-md-6 col-sm-6"
                                                        onclick="location.href=base_url+'/subject/topics/{{ $subject->id }}';">
                                                        <div class="class-card"
                                                            style="--bg-color:{{ '#' . substr(str_shuffle('ABCDEF0123456789'), 0, 6) }}">
                                                            <div class="overlay"></div>
                                                            <div class="image-wrap">
                                                                <img height="130px" width="130px"
                                                                    src="{{ Storage::disk('spaces')->url('uploads/' . $subject->image) }}">
                                                            </div>
                                                            <h3 class="mt-3">
                                                                {{ $subject ? $subject->name : '' }}</h3>
                                                            <!-- <p>1,119,045 Graduates</p> -->
                                                            @if (!Auth::check())
                                                                <button class="enroll-btn">Enroll Now</button>
                                                            @endif
                                                        </div>

                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div id="menu4" class="tab-pane past-bokking fade in">
                            <div class="bokking-date">
                                <h3>Reviews</h3>
                            </div>
                            <div class="all-booking-section">
                                <!-- <div class="reviews-in">
                                  <a class="active" href="#">Positive</a>
                                  <a href="#">Negative</a>
                                  <a href="#">5 <i class="fa fa-star" aria-hidden="true"></i></a>
                                  <a href="#">4 <i class="fa fa-star" aria-hidden="true"></i></a>
                                  <a href="#">3 <i class="fa fa-star" aria-hidden="true"></i></a>
                              </div> -->
                                <?php
                          if(sizeof($review_list)>0) {
                          foreach ($review_list as $key => $value) {  ?>

                                <div class="review-profile">
                                    <img src="images/favourite_lender_4.png" alt="">
                                    <div class="review-desc-in">
                                        <h5><?php echo $value['user']['name'] ?? ''; ?></h5>
                                        <span><i class="fa fa-star" aria-hidden="true"></i><?php echo $value['rating']; ?></span>
                                        <p class="review_txt"><?php echo $value['comment']; ?></p>
                                    </div>
                                </div>

                                <?php } }
                            else{ ?>
                                {{ 'No Reviews.' }}
                                <?php
                            }
                            ?>


                            </div>
                        </div>


                        <div id="menu5" class="tab-pane past-bokking fade in form-side">
                            <div class="bokking-date">
                                <h3>Profile Settings</h3>
                            </div>
                            <div class="all-booking-section">
                                <form enctype="multipart/form-data" method="post"
                                    action="{{ url('/service_provider/profile/update') }}">
                                    <input type="hidden" name="user_id" value="{{ $userz->id }}" />
                                    <input type="hidden" class="form-control" id="step" name="step" value="1">
                                    {{ csrf_field() }}
                                    <div class="edit-pro">
                                        <span class="position-relative">
                                            @if (Auth::user()->profile_image)
                                                <img class="user-profile showImg"
                                                    src="{{ Storage::disk('spaces')->url('uploads/' . Auth::user()->profile_image) }}"
                                                    alt="">
                                            @else
                                                <img class="user-profile showImg"
                                                    src="{{ asset('assets/iedu/images/dummy_profile.webp') }}" alt=""
                                                    id="showImg">
                                            @endif

                                            <div class="img-wrapper ">
                                                <!-- <label for="image_uploads" class="img-upload-btn"><i class="fa fa-camera"></i> </label> -->
                                                <input type="file" id="image_uploads" name="profile_image"
                                                    accept=".jpg, .jpeg, .png" class="file-pos">
                                            </div>
                                            <i class="fa fa-pencil" id="trigger_upload" aria-hidden="true"></i>
                                        </span>
                                        <!-- <h4>John Doe</h4> -->
                                        <!-- <a href="{{ url('service_provider/editprofile') . '/' . Auth::user()->id }}">Edit Profile</a> -->
                                    </div>
                                    <div class="edi-pro-form border-bottom-0">
                                        <div class="row">
                                            <div class="col-md-12 position-relative">
                                                <!-- @if (Auth::user()->profile_image)
    <img class="user-profile showImg" src="{{ Storage::disk('spaces')->url('uploads/' . Auth::user()->profile_image) }}" alt="">
@else
    <img class="user-profile showImg" src="{{ asset('assets/iedu/images/dummy_profile.webp') }}" alt="" id="showImg">
    @endif

                                      <div class="img-wrapper position-absolute">
                                          <label for="image_uploads" class="img-upload-btn"><i class="fa fa-camera"></i> </label>
                                          <input type="file" id="image_uploads" name="profile_image" accept=".jpg, .jpeg, .png" style="opacity: 0;">
                                      </div> -->
                                            </div>
                                            <div class="col-md-12"></div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Title</label>
                                                    <select class="form-control" name="title" required>
                                                        <option value="dr">Dr.</option>
                                                        <option value="mr">Mr.</option>
                                                        <option value="mrs">Mrs.</option>
                                                        <option value="ms">Ms.</option>

                                                    </select>
                                                    @if ($errors->has('title'))
                                                        <span class="help-block text-danger">
                                                            {{ $errors->first('title') }}
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Name</label>
                                                    <input class="form-control" name="name" type="text" required
                                                        placeholder="Full Name"
                                                        value="{{ isset($userz->name) ? $userz->name : '' }}"
                                                        maxlength="20" required>

                                                    @if ($errors->has('name'))
                                                        <span class="help-block text-danger">
                                                            {{ $errors->first('name') }}
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>


                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Email ID</label>
                                                    <input class="form-control  border-0" type="email" name="email"
                                                        placeholder="johndoe@gmail.com"
                                                        value="@if ($userz) {{ $userz->email }} @endif">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Phone Number</label>
                                                    <input class="form-control  border-0" type="text" id="quantity"
                                                        name="quantity" placeholder="+91 9984929384"
                                                        value="@if ($userz) {{ $userz->country_code }}{{ $userz->phone }} @endif">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="">Date of birth</label>
                                                    <div class="input-group date" data-date-format="mm-dd-yyyy">
                                                        <input class="form-control  border-0" type="text"
                                                            value="{{ isset($userz->profile->dob) ? $userz->profile->dob : '' }}"
                                                            name="dob" placeholder="11/12/2020" required />
                                                        <span class="input-group-addon">

                                                            <img src="{{ asset('assets/iedu/images/ic_calender.svg') }}"
                                                                alt="">
                                                        </span>
                                                        @if ($errors->has('dob'))
                                                            <span class="help-block text-danger">
                                                                {{ $errors->first('dob') }}
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="">Working Since</label>
                                                    <div class="input-group date" data-date-format="mm-dd-yyyy">
                                                        <input class="form-control  border-0" type="text"
                                                            value="{{ isset($userz->profile->working_since) ? $userz->profile->working_since : '' }}"
                                                            name="working_since" placeholder="11/12/2020" required />
                                                        <span class="input-group-addon">

                                                            <img src="{{ asset('assets/iedu/images/ic_calender.svg') }}"
                                                                alt="">
                                                        </span>
                                                        @if ($errors->has('working_since'))
                                                            <span class="help-block text-danger">
                                                                {{ $errors->first('working_since') }}
                                                            </span>
                                                        @endif
                                                    </div>

                                                </div>
                                            </div>
                                            @php $varLang = []; @endphp
                                            @foreach ($language as $lang)
                                                @foreach ($getuserpreference as $getuser)
                                                    @if ($getuser->preference_option_id == $lang->optid && $getuser->preference_id == $language[0]->preferid)
                                                        @php $varLang[] = $lang->optname;   @endphp
                                                    @endif
                                                @endforeach
                                            @endforeach
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Languages</label>
                                                    <input type="hidden"
                                                        value=" @if (sizeof($language) > 0) {{ $language[0]->preferid }} @endif"
                                                        name="language">
                                                    <select class="form-control" name="language_opt_id[]" multiple
                                                        multiple id="option-droup-demo">
                                                        @foreach ($language as $lang)
                                                            <option value="{{ $lang->optid }}"
                                                                @if (in_array($lang->optname, $varLang)) selected="selected" @endif>
                                                                {{ $lang->optname }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="">Qualification</label>
                                                    <input class="form-control" type="text" name="qualification"
                                                        value="{{ isset($userz->profile->qualification) ? $userz->profile->qualification : '' }}"
                                                        placeholder="MBBS" required>
                                                    @if ($errors->has('qualification'))
                                                        <span class="help-block text-danger">
                                                            {{ $errors->first('qualification') }}
                                                        </span>
                                                    @endif

                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label class="">Bio</label>
                                                    <textarea class="form-control" name="bio" id="bio" cols="30" rows="3" required
                                                        placeholder="Write your bio…">{{ isset($userz->profile->about) ? $userz->profile->about : '' }}</textarea>
                                                    @if ($errors->has('bio'))
                                                        <span class="help-block text-danger">
                                                            {{ $errors->first('bio') }}
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-footer2">
                                                    <input type="submit" name="update" class="btn rounded radius-btn"
                                                        value="Update">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>







                            </div>
                        </div>

                        <!--  <div id="menu6" class="tab-pane past-bokking fade in">
                        <div class="chart-time-intr">
                            <h5>Edit Availability</h5>
                            <div class="time-table">
     <h5>Select Time</h5>
                            </div>
                        </div>
                        </div> -->

                        <div id="menu7" class="tab-pane past-bokking fade in">
                            <div class="bokking-date">
                                <h3>Update Courses</h3>
                            </div>
                            <div class="edit-course">
                                <form class="" method="post" action="{{ url('sp-course') }}">
                                    <input type="hidden" name="step_type" value="edit_courses">
                                    @csrf
                                    <section class="tutor-popular-classes">
                                        <div class="row">
                                            <input type="hidden" name="course_id" class="course_id"
                                                value="{{ implode(',', $selected_ids) }}">
                                            <?php foreach ($Courses as $key => $course) {

									?>


                                            <div class="col-lg-4 col=md-6 col-sm-6 col-6 course_div" data-id="{{ $course->id }}">

                                                <div
                                                    @if ($course->active != true) class="class-card Music" data-id="{{ $course->id }}"
										@else
										class="class-card Music active" data-id="{{ $course->id }}" @endif>
                                                    <div class="image-wrap">
                                                        <img
                                                            src="{{ Storage::disk('spaces')->url('original/' . $course->image_icon) }}">
                                                    </div>
                                                    <h3 class="mt-3">{{ $course->title }}</h3>
                                                    <!-- <p>1,119,045 Graduates</p> -->
                                                </div>
                                            </div>
                                            <?php } ?>

                                        </div>
                                    </section>



                                    <div class="form-group back-steap">

                                        <input type="submit" name="next" value="Submit" class="btn rounded">
                                    </div>
                                </form>
                            </div>

                        </div>


                        <div id="menu8" class="tab-pane past-bokking fade in">
                            <div class="bokking-date">
                                <h3>Update Emsats</h3>
                            </div>
                            <div class="edit-emsat">
                                <form class="" method="post" action="{{ url('sp-emsat') }}">
                                    <input type="hidden" name="step_type" value="edit_emsats">
                                    @csrf
                                    <section class="popular-classes pt-3 tab-size tutor-popular-classes">
                                        <div class="row">

                                            <?php foreach ($emsats as $key => $emsat) {

                                    ?>
                                            <div class="col-lg-4 col-md-6 col-sm-6 emsat_div">
                                                <input type="hidden" name="id[]" class="emsat_id"
                                                    value="{{ $emsat->id }}">
                                                <div @if ($emsat->consult_price != null) class="class-card Music active" data-id="{{ $emsat->id }}
                                        @else
                                            class="class-card Music" data-id="{{ $emsat->id }} @endif
                                                    style="height:100px">
                                                    <div class="image-wrap">
                                                        <img
                                                            src="{{ Storage::disk('spaces')->url('original/' . $emsat->icon) }}">
                                                    </div>
                                                    <h3 class="mt-3">{{ $emsat->title }}</h3>
                                                    <!-- <p>1,119,045 Graduates</p> -->
                                                    <div class="consult_fee"
                                                        @if ($emsat->consult_price == null) style="display:none;" @endif>
                                                        <input class="price" name="price[]"
                                                            placeholder="Consultation fees"
                                                            value="{{ $emsat->consult_price }}" />
                                                    </div>
                                                </div>
                                            </div>
                                            <?php } ?>

                                        </div>
                                    </section>



                                    <div class="form-group back-steap">

                                        <input type="submit" name="next" value="Submit" class="btn rounded">
                                    </div>
                                </form>

                            </div>
                        </div>

                        <!-- <div id="menu9" class="tab-pane past-bokking fade in">
                                <div class="bokking-date">
                                <h3>Upload Documents</h3>
                                 </div>
                            </div> -->

                        <div id="menu10" class="tab-pane past-bokking fade in">
                            <div class="bokking-date">
                                <!-- <h3>Choose Category</h3> -->
                            </div>
                            <div class="edit-cat all-booking-section">
                                <span class="">
                                    <h5>Edit Category</h5>
                                </span>
                                <hr>
                                <form class="" method="post" action="{{ url('/profile/add_categories') }}">
                                    <input type="hidden" name="step_type" value="edit_category">
                                    @csrf
                                    <section class=" tutor-popular-classes">
                                        <div class="row">

                                            <?php foreach ($categories as $key => $category) {
                                        $CategoryServiceProvider = new \App\Model\CategoryServiceProvider;
                                        $category_data = $CategoryServiceProvider->getCategoryData($category->id);
                                        $category->name = $category_data->name;
                                        $category->color_code = $category_data->color_code;
                                        $category->description = $category_data->description;
                                        $category->image = $category_data->image;
                                        $category->image_icon = $category_data->image_icon;
                                    ?>


                                            <div class="col-md-12 col-6" data-id="{{ $category->id }}">
                                                <span class=""> {{ $category->name }}</span>
                                                <div class="image-wrap d-flex">



                                                    @foreach ($category->subjects as $sub)
                                                        <ul class="nav list-sub">
                                                            <li>
                                                                <div class="custom-control custom-checkbox">
                                                                    <input
                                                                        @if ($sub->checked == true) {{ 'checked' }} @endif
                                                                        type="checkbox" name="category_id[]"
                                                                        value="{{ $sub->id }}"
                                                                        class="custom-control-input  subcheck"
                                                                        id="customCheckBox{{ $sub->id }}">
                                                                    <label class="custom-control-label"
                                                                        for="customCheckBox{{ $sub->id }}">{{ $sub->name }}</label>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    @endforeach
                                                </div>
                                            </div>
                                            <?php } ?>


                                        </div>




                                        <div class="form-group back-steap">

                                            <input type="submit" name="next" value="Submit" class="btn rounded mt-3">
                                        </div>
                                </form>
                            </div>

                        </div>


                        <div id="menu11" class="tab-pane past-bokking fade in">
                            <div class="edit-cat all-booking-section">
                                <span class="">
                                    <h5>Update Availability</h5>
                                </span>
                                <hr>
                                @if (Config('client_connected') && Config::get('client_data')->domain_name == 'iedu')
                                @php $currency = 'AED';  @endphp
                            @else
                                @php $currency = '₹'; @endphp
                            @endif
                            <form class="availbilityform" method="post" action="{{ url('/profile/add_availbility') }}">
                                @csrf
                                <div class="consult">
                                    <h5>Price</h5>
                                    {{ $currency }} <input type="text" name="price"  class="price" value="{{$amount->price ?? ''}}" required />
                                </div>
                                <div class="modal-body p-0 pt-3 pb-3">
                                    <h6>Week Days</h6>

                                    <div class="button-group-pills btn-simple text-center" data-toggle="buttons">
                                        <label class="btn btn-default active">
                                            <input type="checkbox" @if(in_array("0", $day)) checked @endif name="options[]" value="0">
                                            <div>S</div>
                                        </label>
                                        <label class="btn btn-default">
                                            <input type="checkbox"   @if(in_array("1", $day))checked @endif  name="options[]" value="1">
                                            <div>M</div>
                                        </label>
                                        <label class="btn btn-default">
                                            <input type="checkbox"  @if(in_array("2", $day)) checked @endif  name="options[]" value="2">
                                            <div>T</div>
                                        </label>
                                        <label class="btn btn-default">
                                            <input type="checkbox"  @if(in_array("3", $day)) checked @endif  name="options[]" value="3">
                                            <div>W</div>
                                        </label>
                                        <label class="btn btn-default">
                                            <input type="checkbox"  @if(in_array("4", $day)) checked @endif  name="options[]" value="4">
                                            <div>T</div>
                                        </label>
                                        <label class="btn btn-default">
                                            <input type="checkbox"  @if(in_array("5", $day)) checked @endif  name="options[]" value="5">
                                            <div>F</div>
                                        </label>
                                        <label class="btn btn-default">
                                            <input type="checkbox"  @if(in_array("6", $day)) checked @endif  name="options[]" value="6">
                                            <div>S</div>
                                        </label>
                                    </div>
                                    <input type="hidden" name="service_id" class="serviceid"
                                        value="@if (isset($service_id)) {{ $service_id }} @endif">
                                    <input type="hidden" name="category_id" class="categoryid"
                                        value="@if (isset($category_id)) {{ $category_id }} @endif">
                                    <h6 class="pt-3">Select Time</h6>
                                    <div id="customFields">
                                        <div class="new_row row align-items-center">
                                            <div class="col-11 pr-0 interv_div">
                                                {{-- @foreach ($data1 as $data) --}}
                                                <div class="row common-form">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>From</label>
                                                    <div class="time_icon position-relative ">
                                                            <input class="form-control timepicker" type="text" placeholder="11:00" value="{{$data1->start_time ?? ''}}"
                                                                name="start_time[]"  required>
                                                                <i class="fa fa-clock-o icon-pos icon-time" aria-hidden="true"></i>
                                                        </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>To</label>
                                                            <div class="time_icon position-relative ">
                                                            <input class="form-control timepicker" type="text" placeholder="11:00"
                                                                name="end_time[]"  value="{{$data1->end_time ?? ''}}" required>
                                                                <i class="fa fa-clock-o icon-pos icon-time" aria-hidden="true"></i>
                                                            </div>
                                                            </div>
                                                    </div>
                                                </div>
                                                {{-- @endforeach --}}
                                            </div>
                                            <div class="col-1">
                                                <label></label>
                                                <a class="remCF" href="#"><i class="fa fa-time"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <div class="row">
                                        <div class="col-12">
                                            <a class="newrow" href="#"><i class="fa fa-plus"></i> New Interval</a>
                                        </div>
                                    </div> --}}
                                    <div class="form-group spacing-eight mt-6 my-3 flex-bt">
                                        {{-- <a class="back-black"
                                            href="{{ url('/profile/profile-step-two/') }}/{{ Auth::user()->id }}">
                                            < Back</a> --}}
                                                <input type="submit" class="btn rounded  radius-btn" id="add_availbility" name="Save"
                                                    value="Update">
                                    </div>
                                </div>
                        </div>
                        </form>
                            </div>

                        </div>


    </section>







    </div>
    </div>
    </div>
    </section>
    <script>

        // $('.consult_fee').hide();
        $('.emsat_div').on('click', function(e) {

            // console.log(e.target.className);

            if (e.target.className != "price") {
                if ($(this).find('.class-card').hasClass("active")) {
                    $(this).find('.class-card').removeClass("active");
                    $(this).find('.consult_fee').hide();
                    $(this).find("input.price").removeAttr("required");
                    $(this).find("input.price").val(null);
                } else {
                    $(this).find('.class-card').addClass("active");
                    $(this).find('.consult_fee').show();
                    $(this).find("input.price").attr("required", "required");
                }
            }
        });
    </script>
    <script>


        $('.course_div').on('click', function(e) {

            var _this = this;
            var _values = $('.course_id').val();

            var courseId = $(this).attr('data-id');

            if (_values.length > 0) {
                var _old_values = _values.split(",");

                // check if exists
                if (_old_values.indexOf(courseId) > -1) {
                    // remove item and class

                    var index = _old_values.indexOf(courseId);
                    if (index !== -1) {
                        _old_values.splice(index, 1);
                    }

                    if (_old_values.length > 0) {
                        if (_old_values > 1) {
                            var _new_values = _old_values.join(",");
                        } else {
                            var _new_values = _old_values;
                        }
                    } else {
                        var _new_values = null;
                    }


                    _values = _new_values;
                    $(_this).find('.class-card').removeClass('active');

                } else {
                    // add item and class
                    _values = _values + "," + courseId;
                    $(_this).find('.class-card').addClass('active');
                }
            } else {
                _values = courseId;
                $(_this).find('.class-card').addClass('active');
            }

            $('.course_id').val(_values);
        });
    </script>
    <script>
        var _token = "{{ csrf_token() }}";
        var _post_cancel_request_url = "{{ url('cancel-request') }}";
        var _post_accept_request_url = "{{ url('accept-request') }}";
        var _post_start_request_url = "{{ url('start-request') }}";
        var _get_date_url = "{{ url('user/requests') }}";
        var _post_chat_complete_request_url = "{{ url('complete-chat') }}";
        var _post_complete_request_url = "{{ url('call-status') }}";
    </script>
    {{-- changes from footer-script --}}
    <script>
        $('.cancel_request, .start_request , .accept_request , .mark_complete').on('click',function(e)
    {
        e.preventDefault();
        var request_id = $(this).attr('data-request_id');
        var from_user = $(this).attr('data-from_user');
        var to_user = $(this).attr('data-to_user');
        var service_id = $(this).attr('data-service_id');
        var request = $(this).attr('data-request');
        var service = $(this).attr('data-service');


        $('.formConfirm').modal('show');

        $('.confirm_model_body .request_id').val(request_id);
        $('.confirm_model_body .from_user').val(from_user);
        $('.confirm_model_body .to_user').val(to_user);
        $('.confirm_model_body .service_id').val(service_id);
        $('.confirm_model_body .service').val(service);
        $('.request').text(request);


    });
    $('.final_cancel_confirmmation').on('click',function(e)
    {

        e.preventDefault();
        var request_id = $('.confirm_model_body .request_id').val();
        var from_user = $('.confirm_model_body .from_user').val();
        var to_user = $('.confirm_model_body .to_user').val();
        var service_id =  $('.confirm_model_body .service_id').val();
        var request =  $('.confirm_model_body .request').text();
        var service =  $('.confirm_model_body .service').val();

        if(request == 'Cancel')
        {
            _post_request_url = _post_cancel_request_url;
        }
        if(request == 'Accept')
        {
            _post_request_url = _post_accept_request_url;
        }
        if(request == 'Start')
        {
            _post_request_url = _post_start_request_url;
        }
        if(request == 'Mark Complete' &&  service == 'Chat' )
        {
            _post_request_url = _post_chat_complete_request_url;

        }
        if(request == 'Mark Complete' &&  service != 'Chat' )
        {

            _post_request_url = _post_complete_request_url;

        }

       // alert(_post_request_url);

        $.post(_post_request_url, {
                "_token": _token,
                "request_id": request_id,
                "from_user": from_user,
                "to_user": to_user,
                "service_id": service_id,
                "service":service,
                "reqstatus" : "completed"

            }).done(function(data){
                console.log(data);
                $('.confirm_model_body .request_id').val('');
                $('.confirm_model_body .from_user').val('');
                $('.confirm_model_body .to_user').val('');
                $('.confirm_model_body .service_id').val('');
                $('.confirm_model_body .service').val('');

                $('#formConfirm').modal('hide');
                if(request == 'Cancel')
                {
                    $('#formConfirm').modal('hide');
                    location.reload();
                }
                if(request == 'Accept')
                {
                    $('#formConfirm').modal('hide');
                    location.reload();
                }
                if(request == 'Mark Complete' )
                {
                    $('#formConfirm').modal('hide');
                    location.reload();

                }

               if(data.action == 'call')
               {
                var requestid = data.data.request_id;
                var main_service_type = data.main_service_type;

                var url  = '{{url('service')}}/'+requestid+'/'+main_service_type+'';
                window.location.href = url;
               }
               if(data.action == 'chat')
               {
                var requestid = data.data.request_id;
                var main_service_type = data.main_service_type;

                var url  = '{{url('user/chat')}}?request_id='+requestid+'';
                window.location.href = url;

               }

               //location.reload();

            });
    });
    </script>
@endsection
