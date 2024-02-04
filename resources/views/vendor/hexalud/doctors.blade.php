@extends('vendor.hexalud.layouts.dashboard', ['title' => 'Doctor'])
@section('content')
<div class="offset-top"></div>
 <!-- Wallet Section -->
 <section class="Wallet-content py-lg-5 mb-lg-5">
        <div class="container">

            <div class="row">
                <div class="col-lg-4">
                    <div class="bg-them mb-6">
                        <h4 class="border-bottom p-3 mb-2">Menu</h4>
                        <ul class="doctor-list pb-2">
                            <li class="active"><a href="{{url('user/doctor')}}"><i class="fas fa-calendar-week"></i> Appointments</a></li>
                            <li><a href="{{url('service_provider/revenue')}}"><i class="fas fa-signal"></i>Revenue</a></li>
                            <li><a href="{{url('service_provider/prescription')}}"><i class="far fa-list-alt"></i>Prescription</a></li>
                        </ul>
                    </div>
                    <div class="bg-them" style="display:none">
                        <h4 class="border-bottom p-3 d-flex align-items-center justify-content-between"><span>Recent
                                Chats</span> <a class="txt-14 text-blue" href="{{url('user/chat')}}"> <b>View all</b></a></h4>

                        <ul class="recent-chat-list py-4">
                        @if($data)
                        @foreach($data as $chat)
                        <?php

                                if($chat->id == request()->get('request_id') )
                                {
                                    $class='active';
                                }
                                else
                                {
                                    $class='';
                                }

                                ?>
                                @if($chat->service_type == 'Chat')
                                <li  class={{$class}} >
                                    <a href="{{ url('user/chat').'?request_id='.$chat->id }}">
                                    <ul class="d-flex align-items-center justify-content-start px-3">
                                        <li class="chat-icon">
                                        <img src="{{ Storage::disk('spaces')->url('uploads/'.$chat->from_user->profile_image) }}" alt="">
                                        </li>
                                        <li class="chat-text">
                                            <h6 class="m-0 d-flex align-items-center justify-content-between"><label>
                                                {{ ucwords($chat->from_user->name) }}</label>
                                                <span class="online-time">
                                                @php
                                                if($chat->last_message){
                                                    $message_created = $chat->last_message->created_at;
                                                    $msg_date = Carbon\Carbon::parse($message_created,'UTC')->setTimezone('Asia/Kolkata');
                                                    echo $msg_date->isoFormat('h:mm a');
                                                }
                                                else{
                                                  echo $chat->time;
                                                }
                                                @endphp
                                                </span></h6>
                                            <div class="pr-4 position-relative">
                                                <p class="m-0 ellipsis">{{ ($chat->last_message)?$chat->last_message->message:'' }}</p>
                                                <!-- <span class="msg-no position-absolute">2</span> -->
                                            </div>
                                        </li>
                                    </ul>
                                </a>
                            </li>
                                @endif

                            @endforeach
                            @else
                            'No Records'
                            @endif

                        </ul>


                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="row align-items-center mb-4 pb-2">
                    @if((Auth::user()->account_verified == '' || Auth::user()->account_verified == NULL) && (Auth::user()->account_rejected != '' && Auth::user()->account_rejected != NULL))
                    <div class="col-sm-12">
                        <h3>Your profile has been rejected.</h3><br>
                        <h4>Reason By Admin: {{ Auth::user()->custom_message??"" }}</h4>
                    </div>
                    @elseif(Auth::user()->account_verified == '' || Auth::user()->account_verified == NULL )
                    <div class="col-sm-12">
                        <h4> Your Profile Submit for Approval. </h4>
                    </div>
                    @else
                        <div class="col-sm-6">
                            <h3 class="appoitment-title">Appointments</h3>
                        </div>
                        <div class="col-sm-6 text-sm-right">
                            <form class="appiontment" method="get" action= "{{ url('user/doctor') }}">
                                <div id="appointmentdatepicker" class="input-group date" data-date-format="mm-dd-yyyy">
                                    <input class="form-control bg-transparent border-0" type="text"
                                        name="date" placeholder="2020/07/07" />
                                    <span class="input-group-addon">
                                        <img src="{{asset('assetss/images/ic_calender.svg')}}" alt="">
                                    </span>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            @if($data)
                                @foreach($data as $request)
                            <div class="bg-them consultation-box mb-4" data-id="{{$request->id}}">
                                <h4> {{ date(' d M , Y h:i A',strtotime($request->booking_date))}} <button class="default-btn  float-right clickAddSymtomps" onClick="javascript:clickAddSymtomps(this)" data-image="{{@$request->request_image->image_name}}" data-request_id="{{$request->id}}" >Symptoms</button></h4>
                                <label class="label  mt-3">{{$request->service_type}}  </label>
                                @php $status = $request->requesthistory->status;
                                $bookingdate = date('Y-m-d',strtotime($request->booking_date))
                                @endphp
                                    @if($status  == 'pending')
                                    <span class="badge badge-primary">{{ 'NEW REQUEST' }}</span>
                                    @elseif($status == 'canceled')

                                        <span class="badge badge-secondary">{{ 'CANCELLED' }}</span>
                                    @elseif($status == 'accept')
                                        <span class="badge badge-info ">{{ 'ACCEPTED' }}</span>
                                    @elseif($status == 'in-progress')
                                        <span class="badge badge-danger">{{ 'In Progress' }}</span>
                                    @else
                                    <span class="badge badge-success">{{ 'COMPLETED' }}</span>
                                    @endif


                                <div class="d-flex justify-content-between align-items-center mt-4 appointment_div">
                                    <ul class="d-flex align-items-center justify-content-start">
                                        <li class="chat-icon">
                                        @if($request->from_user->profile_image == '' &&  $request->from_user->profile_image == null)
                                        <img src="{{asset('assetss/images/ic_upload profile img.png')}}" alt="">
                                        @else
                                        <img src="{{Storage::disk('spaces')->has('uploads/'.$request->from_user->profile_image)?Storage::disk('spaces')->url('uploads/'.$request->from_user->profile_image):asset('assetss/images/ic_upload profile img.png')}}" alt="">
                                        @endif
                                        </li>
                                        <li class="chat-text">
                                            <h6 class="m-0 d-flex align-items-center justify-content-between">
                                                <label>{{ucwords($request->from_user->name)}}</label></h6>
                                            <label class="status-txt d-block">{{$request->from_user->country_code}} {{$request->from_user->phone}}</label>
                                            <a class="view_details" href="javascript:void(0)" data-id="{{$request->id}}" ><span>View Details</span></a>
                                        </li>
                                        @if($status == 'pending')
                                        <li>
                                        <a class="default-btn radius-btn border-btn accept_request" data-request = 'Accept' href="javascript:void(0)" data-service_id = '{{$request->service_id}}' data-request_id = '{{$request->id}}'  data-to_user = '{{$request->to_user->id}}' data-from_user = '{{$request->from_user->id}}'><span>Accept</span></a>
                                        <a class="default-btn radius-btn border-btn  cancel_request" data-request = 'Cancel' data-service_id = '{{$request->service_id}}' data-request_id = '{{$request->id}}'  data-to_user = '{{$request->to_user->id}}' data-from_user = '{{$request->from_user->id}}' href="javascript:void(0)"><span>Cancel</span></a>
                                        </li>
                                        @endif
                                        @if($status == 'accept' && $request->service_type != 'Clinic Visit')
                                        <li>
                                         <a class="default-btn radius-btn border-btn start_request" data-request = 'Start' href="javascript:void(0)" data-service_id = '{{$request->service_id}}' data-request_id = '{{$request->id}}'  data-to_user = '{{$request->to_user->id}}' data-from_user = '{{$request->from_user->id}}'><span>Start Request</span></a>
                                         <a class="default-btn radius-btn border-btn mark_complete" data-service = '{{$request->service_type}}' data-request = 'Mark Complete' href="javascript:void(0)" data-service_id = '{{$request->service_id}}' data-request_id = '{{$request->id}}'  data-to_user = '{{$request->to_user->id}}' data-from_user = '{{$request->from_user->id}}'><span>Mark Complete</span></a>
                                        </li>
                                        @endif
                                        @if($status == 'in-progress' )
                                        <li>

                                        <a class="default-btn radius-btn border-btn mark_complete" data-service = '{{$request->service_type}}' data-request = 'Mark Complete' href="javascript:void(0)" data-service_id = '{{$request->service_id}}' data-request_id = '{{$request->id}}'  data-to_user = '{{$request->to_user->id}}' data-from_user = '{{$request->from_user->id}}'><span>Mark Complete</span></a>
                                        </li>
                                        @endif
                                        @if($status == 'completed' )
                                        <li>
                                            @if($request->is_prescription == true )
                                            <a class="default-btn radius-btn border-btn prescription" href="{{ url('/generate-pdf')}}?request_id={{$request->id}}&client_id={{ Config::get('client_id') }}" ><span><i class="fas fa-eye"></i> Prescription</span></a>
                                            {{--  <a class="default-btn radius-btn border-btn prescription" href="{{ url('service_provider/prescription')}}?request_id={{$request->id}}&pre_scription_id={{$request->prescription->id}}" ><span><i class="fas fa-edit"></i> Prescription</span></a>  --}}
                                            @else
                                            <a class="default-btn radius-btn border-btn prescription" href="{{ url('service_provider/prescription')}}?request_id={{$request->id}}" ><span><i class="fas fa-plus"></i> Prescription</span></a>
                                            @endif
                                        </li>
                                        @endif
                                    </ul>

                                </div>
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
                                        @if(@$request->request_image->image_name != '' || @$request->request_image->image_name != null)
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <img width="300px" src="{{Storage::disk('spaces')->url('uploads/'.$request->request_image->image_name)}}" alt="">
                                            </div>
                                        </div>
                                        <hr>
                                        @endif
                                        <div class="row">
                                                <div class="col-sm-6">
                                                <p> Symptoms </p>
                                                </div>
                                                <div class="col-sm-6">
                                                <p>
                                                @php $p_count = $request->request_master_preference ? $request->request_master_preference->count():0; @endphp
                                                @php $other_sympton = json_decode(@$request->symptomps_text->raw_detail); @endphp
                                                @if($p_count)
                                                @foreach($request->request_master_preference as $key=>$master_preference)
                                                 {{ $master_preference->preference_option->name}} {{$key+1 < $p_count ?',':''}}
                                                @endforeach
                                                @else
                                                 N/A
                                                 @endif
                                                </p>
                                                </div>
                                        </div>
                                        <div class="row">
                                                <div class="col-sm-6">
                                                    Symptom Detail
                                                </div>
                                                <div class="col-sm-6">
                                                 {{ $other_sympton->symptom_details ?? 'N/A'}}

                                                </div>
                                        </div>
                                        </div>
                                        <div class="modal-footer">

                                        </div>
                                    </div>
                                </div>
                            </div>
                              @endforeach

                              <div class="row mt-5 pt-lg-4">
                                <div class="col text-center">
                                    {{ $data->links() }}
                                </div>
                            </div>
                            @else
                            <div class="row">
                                <div class="appointment-inner">
                                    <img src="{{asset('assets/healtcaremydoctor/images/n-booking.png')}}" />
                                    <div class="text">
                                    <h4 class="mb-4">No Bookings</h4>
                                    <p>You do not have any Bookings till.</p>
                                    </div>
                                </div>
                            </div>
                            @endif

                        </div>
                        @endif
                    </div>
                </div>
            </div>

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
                                <input type="hidden" class="service" name="service">
                                </div>
                                <div class="modal-footer">
                                    @if(isset($request))
                                    <button  type="button" class="btn btn-primary col-sm-4 pull-right final_cancel_confirmmation" data-service = '{{$request->service_type}}' data-service_id = '{{$request->service_id}}' data-request_id = '{{$request->id}}'  data-to_user = '{{$request->to_user->id}}' data-from_user = '{{$request->from_user->id}}' id="frm_submit"><span class="request"></span> </button>
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
        var _post_accept_request_url = "{{ url('accept-request') }}";
        var _post_start_request_url = "{{ url('start-request') }}";
        var _get_date_url = "{{ url('user/doctor') }}";
        var _post_chat_complete_request_url = "{{ url('complete-chat') }}";
        var _post_complete_request_url = "{{ url('call-status') }}";

        var _symtomps_by_request_url = "{{ url('/user/appointment/symptons') }}";
   function clickAddSymtomps(obj) {
      var request_id = $(obj).data('request_id');
        $("#view_detail_container"+request_id).modal("show");
   }


    </script>

@endsection
