@extends('vendor.tele.layouts.dashboard', ['title' => 'Doctor'])
@section('content')
<div class="offset-top"></div>
<style>
    .availability.mb-4.d-block.border-line-bottom {
    width: 100%;
    border-top: none;
    border-left: none;
    border-right: none;
}
</style>
 <!-- Wallet Section -->
 <section class="Wallet-content py-lg-5 mb-lg-5">
        <div class="container">

            <div class="row">
                <div class="col-lg-4">
                    <div class="bg-them mb-6">
                        <h4 class="border-bottom p-3 mb-2">Menu</h4>
                        <ul class="doctor-list pb-2">
                            <li><a href="{{url('user/doctor')}}"><i class="fas fa-calendar-week"></i> Appointments</a></li>
                            <li><a href="{{url('service_provider/revenue')}}"><i class="fas fa-signal"></i>Revenue</a></li>
                            <li class="active"><a href="{{url('service_provider/prescription')}}"><i class="far fa-list-alt"></i>Prescription</a></li>
                        </ul>
                    </div>
                    <!-- <div class="bg-them">
                        <h4 class="border-bottom p-3 d-flex align-items-center justify-content-between"><span>Recent
                                Chats</span> <a class="txt-14 text-blue" href="{{url('user/chat')}}"> <b>View all</b></a></h4>

                        <ul class="recent-chat-list py-4">
                            <li class="">
                                <a href="">
                                    <ul class="d-flex align-items-center justify-content-start px-3">
                                        <li class="chat-icon"><img src="{{asset('assetss/images/ic_profile-header@2x.png')}}" alt=""></li>
                                        <li class="chat-text">
                                            <h6 class="m-0 d-flex align-items-center justify-content-between"><label>
                                                    Stella</label> <span class="online-time">1h</span></h6>
                                            <div class="pr-4 position-relative">
                                                <p class="m-0 ellipsis">But recently started facing som.............</p>
                                                <span class="msg-no position-absolute">2</span>
                                            </div>
                                        </li>
                                    </ul>
                                </a>
                            </li>

                                <a href="">
                               <li>
                                 <ul class="d-flex align-items-center justify-content-start px-3">
                                        <li class="chat-icon"><img src="{{asset('assetss/images/ic_profile-header@2x.png')}}" alt=""></li>
                                        <li class="chat-text">
                                            <h6 class="m-0 d-flex align-items-center justify-content-between">
                                                <label>Gibby Radki</label> <span class="online-time">1h</span></h6>
                                            <label class="status-txt d-block">Sure, No Problem</label>
                                        </li>
                                    </ul>
                                </a>
                            </li>

                            <li>
                                <a href="">
                                    <ul class="d-flex align-items-center justify-content-start px-3">
                                        <li class="chat-icon"><img src="{{asset('assetss/images/ic_profile-header@2x.png')}}" alt=""></li>
                                        <li class="chat-text">
                                            <h6 class="m-0 d-flex align-items-center justify-content-between">
                                                <label>Jessica Stone</label> <span class="online-time">1h</span></h6>
                                            <label class="status-txt d-block">Sure, No Problem</label>
                                        </li>
                                    </ul>
                                </a>
                            </li>

                            <li>
                                <a href="">
                                    <ul class="d-flex align-items-center justify-content-start px-3">
                                        <li class="chat-icon"><img src="{{asset('images/ic_profile-header@2x.png')}}" alt=""></li>
                                        <li class="chat-text">
                                            <h6 class="m-0 d-flex align-items-center justify-content-between">
                                                <label>Raheem Sterling</label> <span class="online-time">1h</span></h6>
                                            <label class="status-txt d-block">Sure, No Problem</label>
                                        </li>
                                    </ul>
                                </a>
                            </li>
                        </ul>


                    </div> -->
                </div>
                <div class="col-lg-8">
                    <div class="row align-items-center mb-4 pb-2">
                        <div class="col-sm-6">
                            <h3 class="appoitment-title">Prescription</h3>
                        </div>
                        <div class="col-12">
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
                    </div>

                    <div class="starter-template">
                        <ul class="nav nav-tabs bg-them px-4" id="myTab" role="tablist">

                            <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Manual Prescription</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Digital Prescription</a>
                            </li>

                        </ul>

                        <!-- tab content starts here -->
                        <div class="tab-content mt-4" id="myTabContent">

                        <!-- content 1 -->
                        <div class="tab-pane masonry-container fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div class="bg-them p-4">
                                <div class="txt-18 mb-4">Patient</div>
                                @if($requests != '' || $requests != Null )
                                    <div class="row">
                                    <div class="col">
                                        <ul class="d-flex align-items-center justify-content-start">
                                            <li class="chat-icon">
                                                @if($requests->from_user->profile_image == '' &&  $requests->from_user->profile_image == null)
                                                <img src="{{asset('assetss/images/ic_upload profile img.png')}}" alt="">
                                                @else
                                                <img src="{{Storage::disk('spaces')->url('uploads/'.$requests->from_user->profile_image)}}" alt="">
                                                @endif
                                            </li>
                                            <li class="chat-text">
                                                <h6 class="m-0 d-flex align-items-center justify-content-between">
                                                    <label> {{ ucwords($requests->from_user->name) }} </label></h6>
                                                <label class="status-txt d-flex align-items-center"><span> {{$requests->gender}}</span> <span class="mx-2 align-middle">
                                                <i class="fas fa-circle" style="font-size: 4px;"></i></span>
                                                 <span>{{ \Carbon\Carbon::parse($requests->from_user->profile->dob)->diff(\Carbon\Carbon::now())->format('%y years')}} old</span> </label>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="txt-18 mb-2">Appointment</div>
                                        <div class="date-time"> {{ date('d-M-Y h:i A',strtotime($requests->booking_date))}}</div>
                                    </div>
                                    <form class="manual-form" method="post" action="{{url('/pre_screptions')}}" enctype="multipart/form-data" >
                                    {{ csrf_field() }}
                                    <div class="col-12 mt-4">
                                        <a class="availability mb-4 d-block" href="{{url('user/doctor')}}"><i class="fas fa-plus"></i> Choose Appointment </a>
                                        <div class="divider-line"></div>
                                        <div class="tile-16 my-4">Record Details</div>
                                        <div class="tile-14 mb-2">
                                            @php

                                            $requestId =  isset($requests->id) ? $requests->id : Request::get('request_id');
                                            $preScriptionId =isset($requests->prescription->id) ? $requests->prescription->id : Request::get('pre_scription_id');
                                            @endphp
                                            <input type="hidden" value="manual" name="type">
                                            <input type="hidden" value="{{ $requestId }}" name="request_id">
                                            <input type="hidden" value="{{ $preScriptionId }}" name="pre_scription_id">
                                            <input type="text" required class="form-control" value="{{isset($requests->prescription->title) ? $requests->prescription->title : '' }}" name="title" placeholder="Record title">
                                            @if ($errors->has('title'))
                                                <span class="help-block text-danger">
                                                    {{ $errors->first('title') }}
                                                </span>
                                            @endif
                                        </div>
                                        <div class="divider-line-thin mb-4"></div>
                                    </div>

                                    <div class="col-12">
                                        <div class="tile-16 mb-4">Add Images</div>
                                        <ul class="add-images d-flex align-items-center">
                                            <li>

                                                <div class="img-box">
                                                    <label for="image_uploads_new" class="img-upload-btn"><i class="fas fa-camera" style="font-size: 24px;"></i>
                                                    </label>

                                                    <input type="file" style="visibility:hidden;" required multiple id="image_uploads_new" name="image[]" accept=".jpg, .jpeg, .png" >
                                                    @if ($errors->has('image'))
                                                    <span class="help-block text-danger">
                                                        {{ $errors->first('image') }}
                                                    </span>
                                                    @endif
                                                </div>
                                            </li>
                                            @if($requests->prescriptionImage)
                                                @foreach($requests->prescriptionImage as $key=>$preImage)
                                                <li class="img-added position-relative">
                                                    <img class="user-profile showImgEditNew" data-image-id="{{$preImage->id}}" data-id="{{$key}}" src="{{Storage::disk('spaces')->url('uploads/'.$preImage->image_name)}}" alt="">
                                                    <i class="fas fa-trash-alt  reemoveEditImg" data-image-id="{{$preImage->id}}" data-id="{{$key}}" ></i>
                                                </li>
                                                @endforeach
                                            @endif
                                            @for($i=0; $i<=9; $i++)
                                            <li class="img-added position-relative" style="display: none;">
                                                <img class="user-profile showImgNew" data-id="{{$i}}" src="" alt="">
                                                <i class="fas fa-trash-alt  reemoveImg" data-id="{{$i}}" ></i>
                                            </li>
                                            @endfor
                                        </ul>
                                    </div>
                                    @if($preScriptionId)
                                    <div class="col-12 mt-5 text-center">
                                         @if($requests->type="digital")
                                        <button type="submit" disabled class="default-btn radius-btn" ><span>Done</span></button>
                                        @else
                                        <button type="submit" class="default-btn radius-btn" ><span>Update</span></button>
                                        @endif

                                    </div>
                                    @else
                                    <div class="col-12 mt-5 text-center">

                                        <button type="submit" class="default-btn radius-btn" ><span>Done</span></button>
                                    </div>
                                    @endif
                                </form>
                                </div>

                            @else
                            <div class="row">
                                    <div class="col">
                                    <h3 class="text-center"> {{ "No Records" }} </h3>
                                    </div>
                                </div>
                            @endif

                            </div>
                        </div>

                        <!-- content 2 -->

                        <div class="tab-pane fade masonry-container" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <div class="bg-them p-4">
                                <div class="txt-18 mb-4">Patient</div>
                                @if($requests != '' || $requests != Null )

                                <div class="row">
                                    <div class="col">
                                        <ul class="d-flex align-items-center justify-content-start">
                                            <li class="chat-icon">
                                                @if($requests->from_user->profile_image == '' &&  $requests->from_user->profile_image == null)
                                                <img src="{{asset('assetss/images/ic_upload profile img.png')}}" alt="">
                                                @else
                                                <img src="{{Storage::disk('spaces')->url('uploads/'.$requests->from_user->profile_image)}}" alt="">
                                                @endif
                                            </li>
                                            <li class="chat-text">
                                                <h6 class="m-0 d-flex align-items-center justify-content-between">
                                                    <label> {{ ucwords($requests->from_user->name) }} </label></h6>
                                                <label class="status-txt d-flex align-items-center"><span> {{$requests->gender}}</span> <span class="mx-2 align-middle">
                                                <i class="fas fa-circle" style="font-size: 4px;"></i></span>
                                                 <span>{{ \Carbon\Carbon::parse($requests->from_user->profile->dob)->diff(\Carbon\Carbon::now())->format('%y years')}} old</span> </label>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="txt-18 mb-2">Appointment</div>
                                        <div class="date-time"> {{ date('d-M-Y h:i A',strtotime($requests->booking_date))}}</div>
                                    </div>
                                    <div class="col-12 mt-4">

                                        <!-- <a class="availability mb-4 d-block border-line-bottom pb-4" href="#">Medicine Name</a> -->
                                        <form id="digitalFrm" class="digital-form" method="post" action="{{url('/pre_screptions')}}"  >
                                        {{ csrf_field() }}
                                        <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                    <input type="text" class="availability mb-4 d-block border-line-bottom " style="color: #020202 !important;"  name="medicine_name" placeholder="Medicine Name" required>
                                                    </div>
                                                </div>
                                        </div>

                                        @php

                                            $requestId =  isset($requests->id) ? $requests->id : Request::get('request_id');
                                            $preScriptionId =isset($requests->prescription->id) ? $requests->prescription->id : Request::get('pre_scription_id');
                                            @endphp
                                            <input type="hidden" value="digital" name="type">
                                            <input type="hidden" value="" name="pre_scriptions[]" class="pre_scriptions">
                                            <input type="hidden" value="{{ $requestId }}" name="request_id">
                                            <input type="hidden" value="" name="dummy_id" class="dummy_id">
                                            <input type="hidden" value="{{ $preScriptionId }}" name="pre_scription_id">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Duration</label>
                                                        <div class="custm-slect position-relative">
                                                        <input type="hidden" value="manual" name="digital">

                                                            <select name="duration" id="duration" required>
                                                                <option value=""> Select Duration </option>
                                                                 @for($i=1; $i<=50; $i++)
                                                                    <option value="{{$i}} day">{{$i}} day</option>
                                                                 @endfor


                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Dosage Type</label>
                                                        <div class="custm-slect position-relative">
                                                            <select name="dosage_type" id="dosageType" required>
                                                                <option value=""> Select Dosage </option>
                                                                <option value="Tablet">Tablet</option>
                                                                <option value="Capsule">Capsule</option>
                                                                <option value="Syrup">Syrup</option>

                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-8">
                                                    <div class="form-group">
                                                        <label>Dosage Timings</label>
                                                        <input type="hidden" class="dosagetiming" id="dosageTiming" name="dosage_timing" value="" />
                                                        <div class="chiller_cb small_label d-block breakfast_div">
                                                            <input  class="breakfastdiv" name="breakfasttime" value="Breakfast" id="pd" type="checkbox" checked="">
                                                            <label for="pd">Breakfast</label>
                                                            <span class="check_icon"></span>
                                                            <div class="breakfast_drop_div_container">
                                                                <ul class="sift-time d-flex align-items-center ml-5 my-4">
                                                                    <li>
                                                                        <input type="radio" name='with-breakfast' style="display: none!important;"  value="Before" id="before"/>
                                                                        <a class="withdata" data-target="breakfast" data-time="Before" for="before">Before</a>
                                                                    </li>
                                                                    <li>
                                                                        <input type="radio" name='with-breakfast' style="display: none!important;"  value="After" id="after"/>
                                                                        <a class="withdata" data-target="breakfast" data-time="After" for="after">After</a>
                                                                    </li>
                                                                    <li>
                                                                        <input type="radio" name='with-breakfast'  style="display: none!important;"  value="With" id="with" />
                                                                        <a class="withdata" data-target="breakfast" data-time="With" for="with">With</a>
                                                                    </li>
                                                                </ul>

                                                                <div class="form-group ml-5 mb-4 empty_dosage_div" id="">
                                                                    <label>Dosage </label>
                                                                    <div class="custm-slect position-relative">
                                                                        <select name="breakfast_dose_value" id="doseValue"></select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group ml-5 mb-4 tablet_div" id="">
                                                                <label>Tablet </label>
                                                                <div class="custm-slect position-relative">
                                                                    <select name="tablet_breakfast_dose_value" class="breakfast"  id="doseValue">
                                                                        <option value="">Select</option>
                                                                        <option value="One">One</option>
                                                                        <option value="Two">Two</option>
                                                                        <option value="Three">Three</option>
                                                                        <option value="Four">Four</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group ml-5 mb-4 capsule_div" id="" >
                                                                <label>Capsule </label>
                                                                <div class="custm-slect position-relative">
                                                                    <select name="capsule_breakfast_dose_value" class="breakfast" id="doseValue">
                                                                        <option value="">Select</option>
                                                                        <option value="One">One</option>
                                                                        <option value="Two">Two</option>
                                                                        <option value="Three">Three</option>
                                                                        <option value="Four">Four</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group ml-5 mb-4 syrup_div" id="" >
                                                                <label>Syrup </label>
                                                                <div class="custm-slect position-relative">
                                                                    <select name="syrup_breakfast_dose_value" class="breakfast" id="doseValue">
                                                                        <option value="">Select</option>
                                                                        @for($i=1; $i<=50; $i++)
                                                                            <option value="{{$i}} ml">{{$i}} ml</option>
                                                                        @endfor
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="chiller_cb small_label d-block lunch_div">
                                                            <input id="lunch" class="lunchdiv" type="checkbox" name="lunchtime"  value="Lunch">
                                                            <label for="lunch">Lunch</label>
                                                            <span class="check_icon"></span>
                                                            <div class="lunchdrop_div_container">
                                                            <ul class="sift-time d-flex align-items-center ml-5 my-4">

                                                              <li>
                                                                <input type="radio" style="display: none!important;" name='with-lunch'   value="Before" />
                                                                <a data-target="lunch" data-time="Before" class="withdata">Before</a>
                                                              </li>
                                                              <li>
                                                                 <input type="radio" style="display: none!important;" name='with-lunch'   value="After" />
                                                                <a data-target="lunch" data-time="After" class="withdata">After</a>
                                                            </li>
                                                            <li>
                                                                <input type="radio" style="display: none!important;" name='with-lunch'   value="With"  />
                                                                <a data-target="lunch" data-time="With" class="withdata">With</a>
                                                            </li>
                                                          </ul>

                                                          <div class="form-group ml-5 mb-4 empty_dosage_div" id="">
                                                              <label>Dosage </label>
                                                              <div class="custm-slect position-relative">
                                                                  <select name="lunch_dose_value" id="doseValue">

                                                                  </select>
                                                              </div>
                                                          </div>
                                                          <div class="form-group ml-5 mb-4 tablet_div" id="" style="display:none;">
                                                              <label>Tablet </label>
                                                              <div class="custm-slect position-relative">
                                                                  <select name="tablet_lunch_dose_value" class="lunch" id="doseValue">
                                                                      <option value="">Select</option>
                                                                      <option value="One">One</option>
                                                                      <option value="Two">Two</option>
                                                                      <option value="Three">Three</option>
                                                                      <option value="Four">Four</option>

                                                                  </select>
                                                              </div>
                                                          </div>
                                                          <div class="form-group ml-5 mb-4 capsule_div" id=""  style="display:none;">
                                                              <label>Capsule </label>
                                                              <div class="custm-slect position-relative">
                                                                  <select name="capsule_lunch_dose_value" class="lunch" id="doseValue">
                                                                     <option value="">Select</option>
                                                                      <option value="One">One</option>
                                                                      <option value="Two">Two</option>
                                                                      <option value="Three">Three</option>
                                                                      <option value="Four">Four</option>

                                                                  </select>
                                                              </div>
                                                          </div>
                                                          <div class="form-group ml-5 mb-4 syrup_div" id="" style="display:none;" >
                                                              <label>Syrup </label>
                                                              <div class="custm-slect position-relative">
                                                                  <select name="syrup_lunch_dose_value" class="lunch"  id="doseValue">
                                                                    <option value="">Select</option>
                                                                      @for($i=1; $i<=50; $i++)
                                                                      <option value="{{$i}} ml">{{$i}} ml</option>
                                                                      @endfor

                                                                  </select>
                                                              </div>
                                                          </div>
                                                            </div>
                                                        </div>
                                                        <div class="chiller_cb small_label d-block dinner_div">
                                                            <input id="dinner" class="dinnerdiv" type="checkbox" name="dinnertime" value="Dinner">
                                                            <label for="dinner">Dinner</label>
                                                            <span class="check_icon"></span>
                                                            <div class="dinner_drop_div_container">
                                                            <ul class="sift-time d-flex align-items-center ml-5 my-4">
                                                              <li class="active">
                                                                <input type="radio" name='with-dinner' style="display: none!important;"  value="Before" />
                                                                <a data-target="dinner" data-time="Before" class="withdata">Before</a>
                                                              </li>
                                                              <li>
                                                                 <input type="radio" name='with-dinner' style="display: none!important;"  value="After" />
                                                                <a data-target="dinner" data-time="After" class="withdata">After</a>
                                                            </li>
                                                            <li>
                                                                <input type="radio" name='with-dinner'  style="display: none!important;"  value="With"  />
                                                                <a data-target="dinner" data-time="With" class="withdata">With</a>
                                                            </li>
                                                          </ul>

                                                          <div class="form-group ml-5 mb-4 empty_dosage_div" id="">
                                                              <label>Dosage </label>
                                                              <div class="custm-slect position-relative">
                                                                  <select name="dinner_dose_value" id="doseValue">

                                                                  </select>
                                                              </div>
                                                          </div>
                                                          <div class="form-group ml-5 mb-4 tablet_div" id="" style="display:none;">
                                                              <label>Tablet </label>
                                                              <div class="custm-slect position-relative">
                                                                  <select name="tablet_dinner_dose_value" class="dinner" id="doseValue">
                                                                      <option value="">Select</option>
                                                                      <option value="One">One</option>
                                                                      <option value="Two">Two</option>
                                                                      <option value="Three">Three</option>
                                                                      <option value="Four">Four</option>

                                                                  </select>
                                                              </div>
                                                          </div>
                                                          <div class="form-group ml-5 mb-4 capsule_div" id="" style="display:none;" >
                                                              <label>Capsule </label>
                                                              <div class="custm-slect position-relative">
                                                                  <select name="capsule_dinner_dose_value" class="dinner"  id="doseValue">
                                                                     <option value="">Select</option>
                                                                      <option value="One">One</option>
                                                                      <option value="Two">Two</option>
                                                                      <option value="Three">Three</option>
                                                                      <option value="Four">Four</option>

                                                                  </select>
                                                              </div>
                                                          </div>
                                                          <div class="form-group ml-5 mb-4 syrup_div" id="" style="display:none;" >
                                                              <label>Syrup </label>
                                                              <div class="custm-slect position-relative">
                                                                  <select name="syrup_dinner_dose_value" class="dinner"  id="doseValue">
                                                                    <option value="">Select</option>
                                                                      @for($i=1; $i<=50; $i++)
                                                                      <option value="{{$i}} ml">{{$i}} ml</option>
                                                                      @endfor

                                                                  </select>
                                                              </div>
                                                          </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12 mt-3">
                                                    <a class="default-btn radius-btn border-btn mr-4 prescription_medicine_add" href=""><span>Add</span></a>
                                                    <a class="default-btn radius-btn border-btn red-border prescription_medicine_reset" href=""><span>Reset</span></a>
                                                </div>
                                                <div class="col-12 append_row">
                                                @if($requests->prescriptionMedicine)
                                                @foreach($requests->prescriptionMedicine as $med)
                                                    <div class="row" data-id="{{ $med->id }}">
                                                        <div class="col-6" style="float: left;">
                                                            {{ $med->medicine_name }}
                                                        </div>
                                                        <div class="col-6" style="float: right; text-align:end;">
                                                            <a class="prescription_medicine_edit" data-pre-scription-id = '{{ $med->pre_scription_id }}' data-med-id = "{{ $med->id }}"  data-request_id = "{{ $requests->request_id }}"  data-medicine_name = '{{$med->medicine_name}}' data-duration = '{{$med->duration}}'  data-dosage_type = '{{$med->dosage_type}}' data-dosage_timing = '{{$med->dosage_timing}}' href="#">
                                                            <span>Edit</span>
                                                            </a> |
                                                            <a class="prescription_medicine_delete" data-med-id = "{{ $med->id }}" href=""><span>Delete</span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                @endif

                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group my-4">
                                                        <div class="txt-18 mb-2">Prescription Notes</div>
                                                      @php $notes = isset($requests->prescription) ? $requests->prescription->pre_scription_notes : '' ; @endphp
                                                        <textarea class="form-control" name="pre_scription_notes" id="" cols="30" rows="6" placeholder="Add Note">{{$notes}}</textarea>
                                                    </div>
                                                    <div class="text-center">
                                                    <button type="submit" class="default-btn radius-btn w-344"><span>Done</span></button>
                                                </div>
                                            </div>
                                            </div>
                                        </form>
                                    </div>
                            </div>

                            @else
                            <div class="row">
                                    <div class="col">
                                   <h3 class="text-center"> {{ "No Records" }} </h3>
                                    </div>
                                </div>
                            @endif
                        </div>

                        </div>
                    </div>


                </div>
            </div>
            </div>

        </div>
<!-- Edit prescription  medicine Modal -->
<div class="modal fade" id="edit_prescription_model" tabindex="-1" role="dialog" aria-labelledby="medicine-popupLabel" aria-hidden="true">
        <div class="modal-dialog modal-md ">
            <div class="modal-content ">
                <div class="modal-header d-block pt-3 px-4 pb-0 border-0">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title login-head">Edit</h4>
                    <!-- <p class="text-14 mt-1">We need your phone number to identify you</p> -->
                    <hr>
                </div>
                <div class="modal-body px-4 pt-2 pb-3" id="edit_medicine" name="c-form">
                    <div class="msgdivsuccess text-success" style="display: none;"></div>
                    <div class="msgdiv text-danger" style="display: none;"></div>
                    <div class="col-12">

                        <!-- <a class="availability mb-4 d-block border-line-bottom pb-4" href="#">Medicine Name</a> -->
                        <form id="dummyFrm" class="digital-form" method="post" action="#"  >
                        {{ csrf_field() }}
                        <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                    <input type="text" class="availability mb-4 d-block border-line-bottom medicine_name" style="color: #020202 !important;"  name="medicine_name" placeholder="Medicine Name" >
                                    </div>
                                </div>
                        </div>

                        @php

                            $requestId =  isset($requests->id) ? $requests->id : Request::get('request_id');
                            $dummy_id =  isset($requests->dummy_id) ? $requests->dummy_id : Request::get('dummy_id');
                            $preScriptionId =isset($requests->prescription->id) ? $requests->prescription->id : Request::get('pre_scription_id');
                            @endphp
                            <input type="hidden" value="digital" name="type">
                            <input type="hidden" value="" name="pre_scriptions">
                            <input type="hidden" value="{{ $requestId }}" class="request_id" name="request_id">
                            <input type="hidden" value="{{ $preScriptionId }}" class="pre_scription_id" name="pre_scription_id">
                            <input type="hidden" value="{{ $dummy_id }}" name="dummy_id" class="dummy_id">
                            <input type="hidden" value="" name="medicine_id" class="medicine_id">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Duration</label>
                                        <div class="custm-slect position-relative">
                                        <input type="hidden" value="manual" name="digital">

                                            <select name="duration" id="duration">
                                                <option value=""> Select Duration </option>
                                                    @for($i=1; $i<=50; $i++)
                                                    <option value="{{$i}} day">{{$i}} day</option>
                                                    @endfor


                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Dosage Type</label>
                                        <div class="custm-slect position-relative">
                                            <select name="dosage_type" id="dosageType">
                                                <option value=""> Select Dosage </option>
                                                <option value="Tablet">Tablet</option>
                                                <option value="Capsule">Capsule</option>
                                                <option value="Syrup">Syrup</option>

                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Dosage Timings</label>
                                        <input type="hidden" class="dosagetiming" id="dosageTiming" name="dosage_timing" value="" />
                                        <div class="chiller_cb small_label d-block breakfast_div">
                                            <input  class="breakfastdiv" name="breakfasttime" value="Breakfast" id="pd1" type="checkbox" >
                                            <label for="pd1">Breakfast</label>
                                            <span class="check_icon"></span>
                                            <div class="breakfast_drop_div_container">
                                                <ul class="sift-time d-flex align-items-center ml-5 my-4">
                                                    <li>
                                                        <input type="radio" name='with-breakfast' style="display: none!important;"  value="Before" id="before"/>
                                                        <a class="withdata" data-target="breakfast" data-time="Before" for="before">Before</a>
                                                    </li>
                                                    <li>
                                                        <input type="radio" name='with-breakfast' style="display: none!important;"  value="After" id="after"/>
                                                        <a class="withdata" data-target="breakfast" data-time="After" for="after">After</a>
                                                    </li>
                                                    <li>
                                                        <input type="radio" name='with-breakfast'  style="display: none!important;"  value="With" id="with" />
                                                        <a class="withdata" data-target="breakfast" data-time="With" for="with">With</a>
                                                    </li>
                                                </ul>

                                                <div class="form-group ml-5 mb-4 empty_dosage_div" id="">
                                                    <label>Dosage </label>
                                                    <div class="custm-slect position-relative">
                                                        <select name="breakfast_dose_value" id="doseValue"></select>
                                                </div>
                                            </div>
                                            <div class="form-group ml-5 mb-4 tablet_div" id="">
                                                <label>Tablet </label>
                                                <div class="custm-slect position-relative">
                                                    <select name="tablet_breakfast_dose_value" class="breakfast"  id="doseValue">
                                                        <option value="">Select</option>
                                                        <option value="One">One</option>
                                                        <option value="Two">Two</option>
                                                        <option value="Three">Three</option>
                                                        <option value="Four">Four</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group ml-5 mb-4 capsule_div" id="" >
                                                <label>Capsule </label>
                                                <div class="custm-slect position-relative">
                                                    <select name="capsule_breakfast_dose_value" class="breakfast" id="doseValue">
                                                        <option value="">Select</option>
                                                        <option value="One">One</option>
                                                        <option value="Two">Two</option>
                                                        <option value="Three">Three</option>
                                                        <option value="Four">Four</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group ml-5 mb-4 syrup_div" id="" >
                                                <label>Syrup </label>
                                                <div class="custm-slect position-relative">
                                                    <select name="syrup_breakfast_dose_value" class="breakfast" id="doseValue">
                                                        <option value="">Select</option>
                                                        @for($i=1; $i<=50; $i++)
                                                            <option value="{{$i}} ml">{{$i}} ml</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="chiller_cb small_label d-block lunch_div">
                                            <input id="lunch1" class="lunchdiv" type="checkbox" name="lunchtime"  value="Lunch">
                                            <label for="lunch1">Lunch</label>
                                            <span class="check_icon"></span>
                                            <div class="lunchdrop_div_container">
                                            <ul class="sift-time d-flex align-items-center ml-5 my-4">

                                                <li>
                                                <input type="radio" style="display: none!important;" name='with-lunch'   value="Before" />
                                                <a data-target="lunch" data-time="Before" class="withdata">Before</a>
                                                </li>
                                                <li>
                                                    <input type="radio" style="display: none!important;" name='with-lunch'   value="After" />
                                                <a data-target="lunch" data-time="After" class="withdata">After</a>
                                            </li>
                                            <li>
                                                <input type="radio" style="display: none!important;" name='with-lunch'   value="With"  />
                                                <a data-target="lunch" data-time="With" class="withdata">With</a>
                                            </li>
                                            </ul>

                                            <div class="form-group ml-5 mb-4 empty_dosage_div" id="">
                                                <label>Dosage </label>
                                                <div class="custm-slect position-relative">
                                                    <select name="lunch_dose_value" id="doseValue">

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group ml-5 mb-4 tablet_div" id="" style="display:none;">
                                                <label>Tablet </label>
                                                <div class="custm-slect position-relative">
                                                    <select name="tablet_lunch_dose_value" class="lunch" id="doseValue">
                                                        <option value="">Select</option>
                                                        <option value="One">One</option>
                                                        <option value="Two">Two</option>
                                                        <option value="Three">Three</option>
                                                        <option value="Four">Four</option>

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group ml-5 mb-4 capsule_div" id=""  style="display:none;">
                                                <label>Capsule </label>
                                                <div class="custm-slect position-relative">
                                                    <select name="capsule_lunch_dose_value" class="lunch" id="doseValue">
                                                        <option value="">Select</option>
                                                        <option value="One">One</option>
                                                        <option value="Two">Two</option>
                                                        <option value="Three">Three</option>
                                                        <option value="Four">Four</option>

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group ml-5 mb-4 syrup_div" id="" style="display:none;" >
                                                <label>Syrup </label>
                                                <div class="custm-slect position-relative">
                                                    <select name="syrup_lunch_dose_value" class="lunch"  id="doseValue">
                                                    <option value="">Select</option>
                                                        @for($i=1; $i<=50; $i++)
                                                        <option value="{{$i}} ml">{{$i}} ml</option>
                                                        @endfor

                                                    </select>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                        <div class="chiller_cb small_label d-block dinner_div">
                                            <input id="dinner1" class="dinnerdiv" type="checkbox" name="dinnertime" value="Dinner">
                                            <label for="dinner1">Dinner</label>
                                            <span class="check_icon"></span>
                                            <div class="dinner_drop_div_container">
                                            <ul class="sift-time d-flex align-items-center ml-5 my-4">
                                                <li class="active">
                                                <input type="radio" name='with-dinner' style="display: none!important;"  value="Before" />
                                                <a data-target="dinner" data-time="Before" class="withdata">Before</a>
                                                </li>
                                                <li>
                                                    <input type="radio" name='with-dinner' style="display: none!important;"  value="After" />
                                                <a data-target="dinner" data-time="After" class="withdata">After</a>
                                            </li>
                                            <li>
                                                <input type="radio" name='with-dinner'  style="display: none!important;"  value="With"  />
                                                <a data-target="dinner" data-time="With" class="withdata">With</a>
                                            </li>
                                            </ul>

                                            <div class="form-group ml-5 mb-4 empty_dosage_div" id="">
                                                <label>Dosage </label>
                                                <div class="custm-slect position-relative">
                                                    <select name="dinner_dose_value" id="doseValue">

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group ml-5 mb-4 tablet_div" id="" style="display:none;">
                                                <label>Tablet </label>
                                                <div class="custm-slect position-relative">
                                                    <select name="tablet_dinner_dose_value" class="dinner" id="doseValue">
                                                        <option value="">Select</option>
                                                        <option value="One">One</option>
                                                        <option value="Two">Two</option>
                                                        <option value="Three">Three</option>
                                                        <option value="Four">Four</option>

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group ml-5 mb-4 capsule_div" id="" style="display:none;" >
                                                <label>Capsule </label>
                                                <div class="custm-slect position-relative">
                                                    <select name="capsule_dinner_dose_value" class="dinner"  id="doseValue">
                                                        <option value="">Select</option>
                                                        <option value="One">One</option>
                                                        <option value="Two">Two</option>
                                                        <option value="Three">Three</option>
                                                        <option value="Four">Four</option>

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group ml-5 mb-4 syrup_div" id="" style="display:none;" >
                                                <label>Syrup </label>
                                                <div class="custm-slect position-relative">
                                                    <select name="syrup_dinner_dose_value" class="dinner"  id="doseValue">
                                                    <option value="">Select</option>
                                                        @for($i=1; $i<=50; $i++)
                                                        <option value="{{$i}} ml">{{$i}} ml</option>
                                                        @endfor

                                                    </select>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 mt-3">
                                    <a class="default-btn radius-btn border-btn mr-4 prescription_medicine_edit_submit" href=""><span>Edit</span></a>
                                    <a class="default-btn radius-btn border-btn red-border prescription_medicine_reset" href=""><span>Reset</span></a>
                                </div>

                            </div>
                            </div>
                        </form>
                                    </div>
                </div>

            </div>
        </div>
    </div>


    </section>
    <script>
        var _token = "{{ csrf_token() }}";
        var _image_delete_path = "{{ url('delete-prescription-image') }}/";
        var _prescription_medicine_add_path = "{{ url('prescription-medicine/add')}}";
        var _medicine_add_path = "{{ url('medicine/add')}}";
        var _prescription_medicine_delete_path = "{{url('prescription-medicine/delete')}}/";
        var _prescription_medicine_edit_path = "{{url('prescription-medicine/edit')}}/";
        var _medicine_get_edit_path = "{{url('prescription-medicine/getedit')}}/";
        var _medicine_edit_path = "{{url('prescription-medicine/medicineedit')}}/";
    </script>


@endsection
