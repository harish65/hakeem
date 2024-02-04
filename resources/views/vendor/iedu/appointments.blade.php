@extends('vendor.iedu.layouts.index', ['title' => 'Bookings'])
@section('content')
 <!-- Offset Top -->
 <style>
 ul>li
 {
     list-style:none;
 }
 </style>
  <section class="study-material booking-request">
          <div class="container">
          <div class="row">
                <div class="col-6">
                    <h3 class="mb-3">Bookings</h3>
                </div>
                <div class="col-sm-6">
                    @if(Request::get('date'))
                    @php $date = date("d/m/Y",strtotime(Request::get('date'))); @endphp
                    @endif
                    <form class="appiontment" method="get" action= "{{ url('user/appointments') }}">
                    <input type="date" id="birthday" class="appiontmentdate" name="date" style="/*! text-align: right; *//*! float: center; *//*! float: inline-end; */width: 43%;height: 45px;float: right;">
                    </form>
                </div>
            </div> 
            @if(sizeof($requests)>0)
            <div class="row">
               
                <div class="col-md-8">  
                @foreach($requests as $request)
                    <div class="d-flex align-items-center doctor_box appointments-wrapper">
                        <img src="images/favourite_lender_4.png" alt="">
                        <div class="client-desc">
                      
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
                                    </h5>     
                                    
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

                                @if(Config('client_connected') && Config::get('client_data')->domain_name == 'iedu')
        @php $currency = 'AED';  @endphp
    @else
        @php $currency = '₹'; @endphp
    @endif
                                <span class="img-profile-in">
                            <img src="{{asset('assets/iedu/images/dummy_profile.webp')}}" height="50px" width="50px">  
                            <div>
                            <h4>{{ $request->to_user->name}}<span>.</span>{{$currency}} {{ $request->price}}</h4>
                            <p><a href="#" class="anchor-style">{{$request->to_user->categoryData->name}}</a>{{ date(' d M , Y',strtotime($request->booking_date))}}</p>
</div>
                        </span>
                        </div>
                      <div class="re-schedule" >
                            @if($status != 'completed' )
                            <div class=" client-btn appointment_div">
                           
                                <a class="view_details" data-id="{{$request->id}}"  href="javascript:void(0)"><span><i class="fa fa-eye"></i> View Details</span></a>
                            </div>
                            @else
                            <div  class="client-btn again_div">
                              
                               <!-- <a style="margin-bottom:10px;" class="" href="" ><span> Book Again</span></a> -->
                               <a class="ratingreview" data-id="{{$request->id}}"  href="" ><span> Review</span></a>
                              
                            </div>
                        
                             @endif 
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
                                <input type="hidden" value="booking_type={{$request->request_category_type}}&booking_id={{$request->request_category_type_id}}&category_id={{ $request->service->category_id}}&service_id={{$request->service_id}}&expert_id={{$request->to_user->id}}&schedule_type=schedule&date={{$current_date}}&request_id={{$request->id}}" class="schedule_url" />
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
                                @if($request->canReschedule == true)
                             
                                <div class="client-btn again_div">
                                    <a class="cancel_request mb-2" data-request = 'Cancel' data-service_id = '{{$request->service_id}}' data-request_id = '{{$request->id}}'  data-to_user = '{{$request->to_user->id}}' data-from_user = '{{$request->from_user->id}}' href="javascript:void(0)"><span>Cancel</span></a>
                                    <input class="btn no-box-shaddow reschedule mb-2" style="color:#fffff; !important" value="Re-Schedule" name="submit" >
                                </div>
                            
                                @endif
                             </form>
                    </div>
                     <!-- View detail Modal -->
                     <div class="modal fade" id="view_detail_container{{$request->id}}" tabindex="-1">
                                <div class="modal-dialog modal-md modal-dialog-center modal-head-bg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Details</h5>
                                        
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <div class="modal-body">

                                            <div class="d-flex align-items-center ">
                                                <div class="profile-size">
                                                @if($request->to_user->profile_image == '' ||  $request->to_user->profile_image == null)
                                                <img width="100px" src="{{asset('assets/iedu/images/dummy_profile.webp')}}" alt="">
                                                @else
                                                <img width="100px" src="{{Storage::disk('spaces')->url('uploads/'.$request->to_user->profile_image)}}" alt="">
                                                @endif
                                                </div>
                                                <div class="t-side">
                                                <label>{{ucwords($request->to_user->name)}}</label>
                                                </div>
                                        </div>
                                        <hr>
                                        
                                        @if($request->token_number != Null && $request->booking_date >= $current_date )
                                        <div class="row">
                                                <div class="col-sm-6 col-6">
                                                <h4> Token Number </h4>
                                                </div>
                                                <div class="col-sm-6 col-6">
                                                <h4>{{ $request->token_number }} </h4>
                                                </div>
                                        </div>
                                        <hr>
                                        @endif
                                        <div class="row mb-1 service-type">
                                                <div class="col-sm-6 col-6">
                                                <p> Service type </p>
                                                </div>
                                                <div class="col-sm-6 col-6">
                                                <p> {{ $request->service_type}} </p>
                                                </div>
                                        </div>
                                        <div class="row mb-1 date-t">
                                                <div class="col-sm-6 col-6">
                                                    Date
                                                </div>
                                                <div class="col-sm-6 col-6">
                                                 {{ date(' d M , Y',strtotime($request->booking_date))}}
                                                   
                                                </div>
                                        </div>
                                        <div class="row mb-1 date-t">
                                                <div class="col-sm-6 col-6">
                                                    Time
                                                </div>
                                                <div class="col-sm-6 col-6">
                                                   {{$request->time}}
                                                </div>
                                        </div>
                                        <div class="row mb-1 date-t">
                                                <div class="col-sm-6 col-6">
                                                    Price
                                                </div>
                                                <div class="col-sm-6 col-6">
                                                {{$currency}} {{$request->price}}
                                                </div>
                                        </div>
                                        </div>
                                        <!-- <div class="modal-footer">
                                        @if($request->booking_date <= $current_date)
                                        @if($request->join == '')
                                            <?php $join = ''; ?>
                                        @else
                                           <?php  $join = $request->join; ?>
                                        @endif
                                        @if($request->token_number != '' && $request->token_number != null && $status == 'accept' || $status == 'in-progress')
                                        <a href="{{url('user/waiting-room')}}/{{$request->id}}?join={{$join}} " class="btn no-box-shaddow w-100 radius-btn" id="join" >
                                        <span>Join</span>
                                        </a>
                                        @endif 
                                        @endif
                                        
                                        </div> -->
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
                                                                    <img width="100px" src="{{asset('assets/iedu/images/dummy_profile.webp')}}" alt="" width="80px" height="80px">
                                                                    @else
                                                                    <img width="100px" src="{{Storage::disk('spaces')->url('uploads/'.$request->to_user->profile_image)}}" alt="" width="80px" height="80px">
                                                                    @endif
                                                                
                                                            </br> <label class="mb-0">{{$request->to_user->name}}</label>
                                                            </div>
                                                           
                                                            <input id="input-1-ltr-star-xs" name="input-1-ltr-star-xs" class="kv-ltr-theme-fas-star rating-loading" value="1" dir="ltr" data-size="lg">
                                                           <input type="hidden" name="rating" id="rating"/>
                                                          
                                                            <div class="form-group">
                                                            <label for="review" class="control-label">Comments</label>
                                                            <textarea id="review" name="review" class="md-textarea" cols="27" rows="5" ></textarea>
                                                            </div>
                                                        </div>
                                                        
                                                    
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <button type="button" class="btn no-box-shaddow w-100 radius-btn" id="ratingbtn" ><span>Submit</span></button>
                                                </div>
                                            
                                            </form> 
                                        </div>
                                    
                                    </div>
                                </div>
                            </div>

                    </div>
                @endforeach   
                </div>
            </div>
            @else

            <div class="row">
                                
                <div class="col-md-8">
                    <h4 style="margin-top:60px;" class="mb-4 text-center">No Appointments.</h4>
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
        <button type="button" class="btn btn-danger col-sm-4 pull-right" style="color:white; font-weight:bold;" data-dismiss="modal" id="frm_cancel">No</button>
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