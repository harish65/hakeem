@extends('vendor.care_connect_live.layouts.dashboard', ['title' => 'Patient'])
@section('content')
 <!-- Offset Top -->
 <style>

 </style>
 <div class="offset-top"></div>
     <!-- Appointments Section -->
     <section class="appointments-content py-lg-5 mb-lg-5">
        <div class="container">
            <div class="row">
                <div class="col-6">
                    <h1>Appointments</h1>
                </div>
                <div class="col-sm-6">
                          @if(Request::get('date'))
                           @php $date = date("d/m/Y",strtotime(Request::get('date'))); @endphp
                          @endif
                            <form class="appiontment" method="get" action= "{{ url('user/requests') }}">
                            <div id="appointment-date" class="input-group date ml-auto appiontmentdate" data-date-format="mm-dd-yyyy">
                                <input readonly class="form-control bg-transparent border-0" type="text" name="date" 
                                    placeholder="11/12/2020" />
                                <span class="input-group-addon">
                                    <img src="{{asset('assets/images/ic_calender.svg')}}" alt="">
                                </span>
                            </div>
                            </form>
                        </div>
            </div> 
            @if(sizeof($requests)>0)
                  
            <div class="row my-lg-5 my-4 pb-lg-3">
                                
                <div class="col-lg-10">
                    <!-- <h6 class="mb-4">Appointments</h6> -->
                    @foreach($requests as $request)
                 
                    <div class="doctor_box appointments-wrapper">
                        <h4 class="mb-2"> {{ date(' d M , Y',strtotime($request->booking_date))}}
                          @php $status = $request->requesthistory->status; 
                          $bookingdate = date('Y-m-d',strtotime($request->booking_date));
                          @endphp
                                @if($bookingdate >= $current_date)
                                    @if($status  == 'pending')
                                    <span class="badge badge-primary ">{{ 'NEW REQUEST' }}</span>
                                    @elseif($status == 'canceled')
                                    <span class="badge badge-danger">{{ 'CANCELLED' }}</span>
                                    @elseif($status == 'accept')
                                        <span class="badge badge-success">{{ 'ACCEPTED' }}</span>
                                    @elseif($status == 'in-progress')
                                        <span class="badge badge-info">{{ 'In Progress' }}</span>
                                    @else
                                    <span class="badge badge-dark">{{ 'COMPLETED' }}</span>
                                    @endif
                                    </h4>     
                                    @if($request->token_number != '' && $request->token_number != null && $status == 'accept' || $status == 'in-progress')
                                    <p class="badge badge-primary">{{'Token Number'}}<span class="token_number">{{ ' '.$request->token_number}}</span></p>
                                    @endif
                                @else
                                    @if($status  == 'pending')
                                    <span class="badge badge-danger ">{{ 'No Show' }}</span>
                                    @elseif($status == 'canceled')
                                    <span class="badge badge-secondary">{{ 'CANCELLED' }}</span>
                                    @elseif($status == 'accept')
                                        <span class="badge badge-danger">{{ 'No Show' }}</span>
                                    @elseif($status == 'in-progress')
                                        <span class="badge badge-danger">{{ 'No Show' }}</span>
                                    @else
                                    <span class="badge badge-dark">{{ 'COMPLETED' }}</span>
                                    @endif
                                    </h4>     
                                   
                                @endif

                        <ul class="appointments-box d-flex align-items-center justify-content-between">
                        @if(Config('client_connected') && Config::get('client_data')->domain_name == 'iedu')
                        <li><h6 class="m-0">{{ $request->service_type}} consultation · AED{{ $request->price}}</a></h6></li>
                        @else
                        <li><h6 class="m-0">{{ $request->service_type}} consultation · ₹{{ $request->price}}</a></h6></li>
                        @endif
                            
                            @if($status != 'completed' )
                            <li class="appointment_div">
                           
                            <a class="default-btn  view_details" data-id="{{$request->id}}"  href="javascript:void(0)"><span><i class="fas fa-eye"></i> View Details</span></a>
                            </li>
                            @else
                            <li>
                              
                               <a style="margin-bottom:10px;" class="default-btn radius-btn border-btn" href="" ><span> Book Again</span></a>
                               <a class="default-btn radius-btn border-btn ratingreview" data-id="{{$request->id}}"  href="" ><span> Rate</span></a>
                              
                           </li>
                           <li>
                           @if($request->is_prescription == true )
                            <a class="default-btn radius-btn border-btn prescription" style="margin-bottom:10px;" href="{{ url('/generate-pdf')}}?request_id={{$request->id}}&client_id={{ Config::get('client_id') }}" ><span><i class="fas fa-eye"></i> Prescription</span></a>
                            <a class="default-btn radius-btn border-btn prescription" href="{{ url('service_provider/prescription')}}?request_id={{$request->id}}&pre_scription_id={{$request->prescription->id}}" ><span><i class="fas fa-edit"></i> Prescription</span></a>
                            @else
                            <a class="default-btn radius-btn border-btn prescription" href="{{ url('service_provider/prescription')}}?request_id={{$request->id}}" ><span><i class="fas fa-plus"></i> Prescription</span></a>
                            @endif
                            </li>
                           <!-- @if($request->is_prescription == true )
                           <li>
                               <a class="default-btn radius-btn border-btn prescription" href="{{ url('/generate-pdf')}}?request_id={{$request->id}}&client_id={{ Config::get('client_id') }}" ><span><i class="fas fa-eye"></i> Prescription</span></a>
                            </li>  
                              
                            @endif -->
                          
                            @endif
                           
                        </ul>
                        @php
                       
                       $date = Carbon\Carbon::now();
              
                       //Get date
                       $current_date =$date->toDateString();

                       //Get date
                       $current_time =$date->toTimeString();
                        @endphp
                        <form method="post" id="reschedule_request" action="">
                        <input type="hidden" value="{{$request->schedule_type}}" name="schedule_type" class="schedule_type" />
                        <input type="hidden" value="{{$request->to_user->id}}" name="consultant_id" class="consultant_id" />
                        <input type="hidden" value="request_id={{$request->id}}" class="instant_url" name="instant_url" />
                        <input type="hidden" value="category_id={{ $request->service->category_id}}&service_id={{$request->service_id}}&doctor_id={{$request->to_user->id}}&schedule_type=schedule&date={{$current_date}}&request_id={{$request->id}}" class="schedule_url" />
                        @csrf
                        <input type="hidden" value="{{$request->id}}" name="request_id" class="request_id" />
                       
                        <input type="hidden" value="{{$current_date}}" name="date" class="date" />
                       
                        <input type="hidden" value="{{$current_time}}" name="time" class="time" />
                        <input type="hidden" value="" name="request_step" class="request_step" />
                       <input type="hidden" value="{{ $request->service_id }}" name="service_id" class="service_id" />
                        <input type="hidden" value="{{ $request->service->category_id }}" name="category_id" class="category_id" />
                        <input type="hidden" name="package_id" value="" class="package_id">
                        <input type="hidden" name="payment_type" value="{{ isset($request->categoryData['payment_type']) ? $request->categoryData['payment_type'] : ''}}" class="payment_type">
                      
                        <input type="hidden" name="total" value="@if( $request->price ){{ $request->price .'.00' }}@else{{ 0.00}} @endif">
                        <ul class="appointments-box d-flex align-items-center justify-content-between">
                            <li class="user-info d-flex align-items-center chat-icon2">
                                        @if($request->to_user->profile_image == '' ||  $request->to_user->profile_image == null)
                                        <img src="{{asset('assets/images/ic_upload profile img.png')}}" alt="" height="80px" width="80px">
                                        @else
                                        <img src="{{Storage::disk('spaces')->url('uploads/'.$request->to_user->profile_image)}}" alt="" height="80px" width="80px">
                                        @endif
                                <label class="mb-0 ml-3">{{ucwords($request->to_user->name)}}</label>
                            </li>
                             @if($request->canReschedule == true)
                             
                             <li>
                                <a class="default-btn border-btn radius-btn cancel_request mb-2" data-request = 'Cancel' data-service_id = '{{$request->service_id}}' data-request_id = '{{$request->id}}'  data-to_user = '{{$request->to_user->id}}' data-from_user = '{{$request->from_user->id}}' href="javascript:void(0)"><span>Cancel</span></a>
                                <input class="default-btn border-btn radius-btn reschedule" style="color:#262F8A;" value="Re-Schedule" name="submit" >
                            </li>
                         
                            @endif
                         
                          
                        </ul>
                        </form>
                    </div>
                     <!-- View detail Modal -->
                     <div class="modal fade" id="view_detail_container{{$request->id}}" tabindex="-1">
                                <div class="modal-dialog modal-md modal-dialog-center">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Details</h5>
                                        
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <div class="modal-body">

                                            <div class="row">
                                                <div class="col-sm-6">
                                                @if($request->to_user->profile_image == '' ||  $request->to_user->profile_image == null)
                                                <img width="100px" src="{{asset('assets/images/ic_upload profile img.png')}}" alt="">
                                                @else
                                                <img width="100px" src="{{Storage::disk('spaces')->url('uploads/'.$request->to_user->profile_image)}}" alt="">
                                                @endif
                                                </div>
                                                <div class="col-sm-6">
                                                <label>{{ucwords($request->to_user->name)}}</label>
                                                </div>
                                        </div>
                                        <hr>
                                        
                                        @if($request->token_number != Null && $request->booking_date >= $current_date )
                                        <div class="row">
                                                <div class="col-sm-6">
                                                <h4> Token Number </h4>
                                                </div>
                                                <div class="col-sm-6">
                                                <h4>{{ $request->token_number }} </h4>
                                                </div>
                                        </div>
                                        <hr>
                                        @endif
                                        <div class="row">
                                                <div class="col-sm-6">
                                                <p> Service type </p>
                                                </div>
                                                <div class="col-sm-6">
                                                <p> {{ $request->service_type}} </p>
                                                </div>
                                        </div>
                                        <div class="row">
                                                <div class="col-sm-6">
                                                    Date
                                                </div>
                                                <div class="col-sm-6">
                                                 {{ date(' d M , Y',strtotime($request->booking_date))}}
                                                   
                                                </div>
                                        </div>
                                        <div class="row">
                                                <div class="col-sm-6">
                                                    Time
                                                </div>
                                                <div class="col-sm-6">
                                                   {{$request->time}}
                                                </div>
                                        </div>
                                        <div class="row">
                                                <div class="col-sm-6">
                                                    Price
                                                </div>
                                                <div class="col-sm-6">
                                                @if(Config('client_connected') && Config::get('client_data')->domain_name == 'iedu')
                                                AED {{$request->price}}
                                                @else
                                                ₹ {{$request->price}}
                                                @endif
                                               
                                                </div>
                                        </div>
                                        </div>
                                        <div class="modal-footer">
                                       
                                        @if($current_date >= $bookingdate)
                                        @if($request->join == '')
                                            <?php $join = ''; ?>
                                        @else
                                           <?php  $join = $request->join; ?>
                                        @endif
                                        @if($request->token_number != '' && $request->token_number != null && $status == 'accept' || $status == 'in-progress')
                                        <a href="{{url('user/waiting-room')}}/{{$request->id}}?join={{$join}} " class="default-btn w-100 radius-btn join_room" id="join" >
                                        <span>Join</span>
                                        </a>
                                        @endif 
                                        @endif
                                        
                                        </div>
                                    </div>
                                </div>
                            </div>
                             <!-- Enter-Feedback Modal -->
                        <div class="modal fade" id="ratingModal" tabindex="-1" role="dialog" aria-labelledby="rating-popupLabel" aria-hidden="true">
                                <div class="modal-dialog modal-md ">
                                    <div class="modal-content ">
                                        <div class="modal-header d-block pt-3 px-4 pb-0 border-0">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title login-head">Please give Feedback</h4>
                                            <!-- <p class="text-14 mt-1">We need your phone number to identify you</p> -->
                                            <hr>
                                        </div>
                                        <div class="modal-body px-4 pt-2 pb-3" id="login_form" name="c-form">
                                            <div class="msgdivsuccess text-success" style="display: none;"></div>
                                            <div class="msgdiv text-danger" style="display: none;"></div>
                                            
                                            <form class="form-default" id="ratingForm" role="form" action="{{url('add-review')}}" method="POST">
                                                @csrf
                                                <div class="form-group mb-4">
                                                    <div class="row no-gutters col-spacing">
                                                        <div class="col-12">
                                                            <div class="form-group chat-icon2 text-center" style="margin-bottom:0px !important" >
                                                                    <input type="hidden" class="consultant_id" name="consultant_id" value="{{$request->to_user->id}}" />
                                                                    <input type="hidden" class="request_id" name="request_id" value="{{$request->id}}" />
                                                                    @if($request->to_user->profile_image == '' ||  $request->to_user->profile_image == null)
                                                                    <img width="100px" src="{{asset('assets/images/ic_upload profile img.png')}}" alt="" width="80px" height="80px">
                                                                    @else
                                                                    <img width="100px" src="{{Storage::disk('spaces')->url('uploads/'.$request->to_user->profile_image)}}" alt="" width="80px" height="80px">
                                                                    @endif
                                                                
                                                            </br> <label class="mb-0">{{$request->to_user->name}}</label>
                                                            </div>
                                                           
                                                            <input id="input-1-ltr-star-xs" name="input-1-ltr-star-xs" class="kv-ltr-theme-fas-star rating-loading" value="1" dir="ltr" data-size="lg">
                                                           <input type="hidden" name="rating" id="rating"/>
                                                          
                                                            <div class="form-group">
                                                            <label for="review" class="control-label">Comments</label>
                                                            <textarea id="review" name="review" class="md-textarea" cols="35" rows="5" ></textarea>
                                                            </div>
                                                        </div>
                                                        
                                                    
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <button type="button" class="default-btn w-100 radius-btn" id="ratingbtn" ><span>Submit</span></button>
                                                </div>
                                            
                                            </form> 
                                        </div>
                                    
                                    </div>
                                </div>
                            </div>

                    @endforeach
                </div>
            </div>
            @else

            <div class="row">
                                
                <div class="col-lg-6">
                    <h4 style="margin-top:60px;" class="mb-4 text-center">No Apointments.</h4>
                </div>
            </div>
 
            @endif    
        </div>

           <!-- Delete  Modal -->
           <div class="modal fade formConfirm" id="" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-md modal-dialog-center">
                                <div class="modal-content">
                                <div class="modal-header" style="display:block !important;">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true"></span><span class="sr-only">Close</span></button>
                                    <h4 class="modal-title" id="frm_title"><span class="request" style="opicity:1 !important"> </span> Confirmation</h4>
                                </div>
                                <div class="modal-body confirm_model_body" id="frm_body">
                                <p> Are you Sure you want to <span class="request" style="opicity:1 !important"></span> Request ? </p>
                                <input type="hidden" class="request_id" name="request_id">
                                <input type="hidden" class="from_user" name="from_user">
                                <input type="hidden" class="to_user" name="to_user">
                                <input type="hidden" class="service_id" name="service_id">
                                </div>
                                <div class="modal-footer">
                                    @if(isset($request))
                                    <button style='margin-left:10px;' type="button" class="btn btn-primary col-sm-4 pull-right final_cancel_confirmmation" data-service_id = '{{$request->service_id}}' data-request_id = '{{$request->id}}'  data-to_user = '{{$request->to_user->id}}' data-from_user = '{{$request->from_user->id}}' id="frm_submit"><span class="request"></span> </button>
                                    <button type="button" class="btn btn-danger col-sm-4 pull-right" data-dismiss="modal" id="frm_cancel">No</button>
                                     @endif
                                </div>
                                </div>
                            </div>
                            </div>
    </section>
    <script>
        var _token = "{{ csrf_token() }}";
        var _post_cancel_request_url = "{{ url('cancel-request') }}";
        var _get_date_url = "{{ url('user/appointments') }}";
       
    </script>
  
@endsection