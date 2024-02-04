@extends('vendor.tele.layouts.dashboard', ['title' => 'Patient'])
@section('content')
<!-- Offset Top -->
<style>
    .apponintment-desc {
        margin-left:40px !important;
    }
    .appointments-box h6, .appointments-wrapper p {
        font-size: 14px;
        line-height: 19px;
        font-weight: normal;
    }
</style>
<div class="offset-top"></div>
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- Appointments Section -->
<section class="appointments-content2 py-lg-5 mb-lg-5">
   <div class="container">
      <div class="row">
         <div class="col-8">
            <h1>Appointments</h1>
         </div>
         <div class="col-4">
            <a class=" default-btn" href="{{url('/user/experts')}}"><span> New Appointment</span></a>
         </div>
         <div class="col-sm-6">
            @if(Request::get('date'))
            @php $date = date("d/m/Y",strtotime(Request::get('date'))); @endphp
            @endif
            <!-- <form class="appiontment" method="get" action= "{{ url('user/requests') }}">
               <div id="appointment-date" class="input-group date ml-auto appiontmentdate" data-date-format="mm-dd-yyyy">
                   <input readonly class="form-control bg-transparent border-0" type="text" name="date"
                       placeholder="11/12/2020" />
                   <span class="input-group-addon">
                       <img src="{{asset('assets/images/ic_calender.svg')}}" alt="">
                   </span>
               </div>
               </form> -->
         </div>
      </div>
      @if($requests->isNotEmpty())
      <div class="row my-lg-5 my-4">
         <div class="col-lg-10">
            <!-- <h6 class="mb-4">Appointments</h6> -->
            @foreach($requests as $key => $request)
            <div class="doctor_box appointments-wrapper">
               <h4 class="mb-2"> {{ date(' d M , Y h:i A',strtotime($request->booking_date))}}
                  </br>
                  @php $status = $request->requesthistory->status;
                  $bookingdate = date('Y-m-d',strtotime($request->booking_date))
                  @endphp
                  @if($bookingdate >= $current_date)
                  @if($status  == 'pending')
                  <span class="badge badge-primary">{{ 'NEW REQUEST' }}</span>
                  @elseif($status == 'canceled')
                  <span class="badge badge-secondary">{{ 'CANCELLED' }}</span>
                  @elseif($status == 'accept')
                  <span class="badge badge-info">{{ 'ACCEPTED' }}</span>
                  @elseif($status == 'in-progress')
                  <span class="badge badge-danger">{{ 'In Progress' }}</span>
                  @elseif($status == 'failed')
                  <span class="badge badge-danger">No Show</span>
                  @else
                  <span class="badge badge-success">{{ 'COMPLETED' }}</span>
                  @endif
               </h4>
               @else
               @if($status  == 'pending')
               <span class="badge badge-danger">{{ 'No Show' }}</span>
               @elseif($status == 'canceled')
               <span class="badge badge-secondary">{{ 'CANCELLED' }}</span>
               @elseif($status == 'accept')
               <span class="badge badge-danger">{{ 'No Show' }}</span>
               @elseif($status == 'failed')
               <span class="badge badge-danger">No Show</span>
               @elseif($status == 'in-progress')
               <span class="badge badge-danger">{{ 'No show' }}</span>
               @else
               <span class="badge badge-success">{{ 'COMPLETED' }}</span>
               @endif
               @endif
               <ul class="appointments-box d-flex align-items-center justify-content-between">
                  <li>
                     <h6 class="m-0">{{ $request->service_type}} consultation · ₹{{ $request->price}}</h6>
                  </li>
                  @if($status != 'completed' && $status != 'canceled')
                  @php $other_sympton = json_decode(@$request->symptomps_text->raw_detail); @endphp
                  <li class="appointment_div" style="margin-left:auto;">
                     <a class="default-btn  view_details" href="javascript:void(0)" class="clickAddSymtomps" onClick="javascript:clickAddSymtomps(this)" data-image="{{@$request->request_image->image_name ? Storage::disk('spaces')->url('uploads/'.$request->request_image->image_name) : 0}}" data-request_id="{{$request->id}}" data-other_symptons="{{@$other_sympton->symptom_details}}"><span>Update Symptoms</span></a>
                     <br>
                     <a class="default-btn  view_details" data-id="{{$request->id}}"  href="javascript:void(0)"><span><i class="fas fa-eye"></i> View Details</span></a>
                  </li>
                  <li>
                  @else
                     @php
                     $to_user = $request->to_user->id;
                     $cat_id = $request->to_user->categoryData->id;
                     if($request->schedule_type == "instant")
                     {
                     $url="user/doctor_details/$to_user/$request->service_id";
                     }
                     else
                     {
                     $d = date("m-d-y");
                     $url="user/getSchedule?category_id=$cat_id&service_id=$request->service_id&doctor_id=$to_user&schedule_type=schedule&date=$d&Schedule=Schedule";
                     }
                     @endphp
                     <a style="margin-bottom:10px;" class="default-btn radius-btn border-btn book_again" href="{{ url($url) }}" ><span> Book Again</span></a>
                     @if($status != 'canceled')
                     <button class="default-btn radius-btn border-btn ratingreview " data-id="{{$request->id}}" data-toggle="modal" data-target="#ratingModal_{{$request->id}}"  href="" ><span> {{!is_null($request->request_rating) ? 'Update' : 'Add'}} Review</span></button>
                     @endif
                  </li>
                  <li>
                     @if($request->is_prescription == true )
                     <a class="default-btn radius-btn border-btn prescription" style="margin-bottom:10px;" href="{{ url('/generate-pdf')}}?request_id={{$request->id}}&client_id={{ Config::get('client_id') }}" ><span><i class="fas fa-eye"></i> Prescription</span></a>
                     <!-- <a class="default-btn radius-btn border-btn prescription" href="{{ url('service_provider/prescription')}}?request_id={{$request->id}}&pre_scription_id={{$request->prescription->id}}" ><span><i class="fas fa-edit"></i> Prescription</span></a> -->
                     @else
                     <!-- <a class="default-btn radius-btn border-btn prescription" href="{{ url('service_provider/prescription')}}?request_id={{$request->id}}" ><span><i class="fas fa-plus"></i> Prescription</span></a> -->
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
                        <span>
                        @if($request->to_user->profile_image == '' ||  $request->to_user->profile_image == null)
                        <img src="{{asset('assetss/images/ic_upload profile img.png')}}" alt="" height="80px" width="80px">
                        @else
                        <img src="{{Storage::disk('spaces')->url('uploads/'.$request->to_user->profile_image)}}" alt="" height="80px" width="80px">
                        @endif
                        <a class="view_profile d-block mt-2" href="{{url('service_provider/profile/')}}/{{$request->to_user->id}}">View Profile</a>
                        </span>
                        <div class="apponintment-desc">
                           <label class="mb-0   ">{{ucwords($request->to_user->name)}}</label>
                           <p>  @if($request->to_user->categoryData) {{ $request->to_user->categoryData->name }} @else {{''}}  @endif · @if ($request->to_user->profile->working_since == '' || $request->to_user->profile->working_since== null)
                              {{ 0 }} years
                              @else
                              @php
                              $exp_start = new DateTime($request->to_user->profile->working_since);
                              $today_date = new DateTime();
                              @endphp
                              {{@$exp_start->diff($today_date)->y}}+ years
                              @endif of exp
                           </p>
                           <p>Qualifications: {{strtoupper($request->to_user->profile->qualification)}}</p>
                           @php $preference = $request->to_user->master_preferences; @endphp
                           @foreach($preference as $prefer)
                           @if($prefer['preference_name'] == "Languages")
                           <p>
                              {{ $prefer['preference_name'] }}:
                              @foreach(json_decode($prefer['options']) as  $key => $opt)
                              {{ $opt->option_name }}
                              @if($key + 1 != sizeof(json_decode($prefer['options'])))
                              ,
                              @endif
                              @endforeach
                           </p>
                           @else
                           @foreach($prefer['options'] as $opt)
                           <p>
                              {{ $prefer['preference_name'] }}:
                              {{$opt->option_name}}
                           </p>
                           @endforeach
                           @endif
                           @endforeach
                           <span class="rating vertical-middle">
                           <a class="review_txt" href="javascript:void(0);" style="cursor: default;"><i class="fas fa-star"></i> {{$request->totalRating}} · {{$request->reviewCount}} Reviews</a>
                           </span>
                        </div>
                     </li>
                     <!--<li>
                        <a class="view_profile d-block mt-2" href="{{url('service_provider/profile')}}/{{$request->to_user->id}}">View Profile</a>
                        </li>-->
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
                              <img width="100px" src="{{asset('assetss/images/ic_upload profile img.png')}}" alt="">
                              @else
                              <img width="100px" src="{{Storage::disk('spaces')->has('uploads/'.$request->to_user->profile_image)?Storage::disk('spaces')->url('uploads/'.$request->to_user->profile_image):asset('assetss/images/ic_upload profile img.png')}}" alt="">
                              @endif
                           </div>
                           <div class="col-sm-6">
                              <label>{{ucwords($request->to_user->name)}}</label>
                           </div>
                        </div>
                        <hr>
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
                              ₹ {{$request->price}}
                           </div>
                        </div>
                     </div>
                     <div class="modal-footer">
                     </div>
                  </div>
               </div>
            </div>
            <!-- Enter-Feedback Modal -->
            <div class="modal fade" id="ratingModal_{{$request->id}}" tabindex="-1" role="dialog" aria-labelledby="rating-popupLabel" aria-hidden="true">
               <div class="modal-dialog modal-md ">
                  <div class="modal-content ">
                     <div class="modal-header d-block pt-3 px-4 pb-0 border-0">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title login-head">Please given Feedback</h4>
                        <!-- <p class="text-14 mt-1">We need your phone number to identify you</p> -->
                        <hr>
                     </div>
                     <div class="modal-body px-4 pt-2 pb-3" id="login_form" name="c-form">
                        <div class="msgdivsuccess text-success" style="display: none;"></div>
                        <div class="msgdiv text-danger" style="display: none;"></div>
                        <div class="form-default" id="ratingForm" >
                           <form method="post" action="{{ route('add-review') }}">
                           @csrf
                              <div class="form-group mb-4">
                                 <div class="row no-gutters col-spacing">
                                    <div class="col-12">
                                       <div class="form-group chat-icon2 text-center" style="margin-bottom:0px !important" >
                                          <input type="hidden" class="consultant_id" name="consultant_id" value="{{$request->to_user->id}}" >
                                          <input type="hidden" class="request_id" name="request_id" value="{{$request->id}}" />
                                          @if($request->to_user->profile_image == '' ||  $request->to_user->profile_image == null)
                                          <img width="100px" src="{{asset('assetss/images/ic_upload profile img.png')}}" alt="" width="80px" height="80px">
                                          @else
                                          <img width="100px" src="{{Storage::disk('spaces')->has('uploads/'.$request->to_user->profile_image)?Storage::disk('spaces')->url('uploads/'.$request->to_user->profile_image):asset('assetss/images/ic_upload profile img.png')}}" alt="" width="80px" height="80px">
                                          @endif
                                          <br> <label class="mb-0">{{$request->to_user->name}}</label>
                                       </div>
                                       <input id="input-1-ltr-star-xs" name="rating" class="kv-ltr-theme-fas-star rating-loading" value="{{$request->request_rating->rating ?? 0}}" dir="ltr" data-size="lg" required>
                                       <div class="form-group">
                                          <!-- <label for="review" class="control-label d-block">Comments</label> -->
                                          <textarea id="review" name="review" class="md-textarea reviewd mx-auto d-block p-2 mt-3" cols="35" rows="5" placeholder="Comment">{{$request->request_rating->comment ?? ""}}</textarea>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <button type="submit" class="default-btn w-100 radius-btn" id="ratingbtn"  data-consultant_id = "{{$request->to_user->id}}"  data-request_id = "{{$request->id}}"  ><span>Submit</span></button>
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
      <div class="row">
         <div class="col text-center">
            {{-- {{ $requests->links() }} --}}
         </div>
      </div>
      @else
      <div class="row">
         <div class="appointment-inner">
            <img src="{{asset('assets/healtcaremydoctor/images/n-appointment.png')}}" />
            <div class="text">
               <h4 class="mb-4">No Appointment</h4>
               <p>You don't have any Appointment till</p>
            </div>
            <br>
            <a class="btn-info btn" href="{{url('/user/experts')}}">Book Now</a>
         </div>
      </div>
      @endif
   </div>
   <div class="modal fade" id="upload-img" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <div class="upload-doc">
                  <h5>Tell us your symptom or health problem</h5>
                  <div class="form-group">
                     <form id="submitAJaxForm" enctype="multipart/form-data" method="post">
                        <input type="hidden" name="request_id" id="request_id">
                        <textarea name="symptom_details" id="symptom_details" placeholder="Thnaks for the update and for"></textarea>
                        <span class="uload-img-cm">
                           <i class="fa fa-camera" aria-hidden="true"></i>
                           <ul>
                              <li><a href="javascript:void(0);" id="OpenImgUpload">Select image</a></li>
                              <li><a href="javascript:void(0);" id="OpenDocUpload">Select document</a></li>
                           </ul>
                        </span>
                        <img src="" id="output" style="height: 100px;width: 100px;padding-top: 10px; padding-left: 10px;display: none;">
                        <img src="{{asset('assets/images/png-transparent-pdf.png')}}" id="outputPDF" style="height: 100px;width: 100px;padding-top: 10px;display: none;"  alt="PDF">
                        <input type="file" name="image_upload_file" id="imgUpload" style="display:none" accept="image/*" onchange="loadFile(event)"/>
                        <input type="file" name="pdf_upload_file" id="documentUpload" style="display:none" accept="application/pdf" onchange="loadFilePDF(event)" />
                        <div class="select-btn">
                           <ul class="all_preference_options">
                              @foreach($MasterPreferencesOptions as $op)
                              <li><input class="opt-btn" type="checkbox" name="option_ids[]" value="{{ $op->id }}">
                                 <span>{{ $op->name }}</span>
                              </li>
                              @endforeach
                           </ul>
                           <button form="submitAJaxForm" type="submit" class="btn-next" id="btn_text">Done</button>
                        </div>
                     </form>
                  </div>
               </div>
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
@section('script')
 {{--  <script src="{{ asset('assets/care_connect_live/js/jquery.toast.min.js') }}"></script>  --}}
<script>
   var _symtomps_by_request_url = "{{ url('/user/appointment/symptons') }}";
   function clickAddSymtomps(obj) {
      var request_id = $(obj).data('request_id');
      var image = $(obj).data('image');
      var sym = $(obj).data('other_symptons');
      $('#upload-img #symptom_details').val(sym);
      if(image)
      {
         $("#output").show();
         var output = document.getElementById('output');
         output.src = image;
      }
      $("#request_id").val(request_id);
      $.getJSON(_symtomps_by_request_url+'?request_id='+ request_id, function(data){
         var listItems = $("#upload-img .all_preference_options li");
         listItems.each(function(idx, li) {
            var value = $(li).find(":checkbox").val();
            $.each(data, function(key, item){
              if(value == item)
              {
               $(li).addClass('active');
               $(li).find(":checkbox").prop('checked', true);;
              }
            });
         });
    });
   $("#upload-img").modal("show");
   }

    $('#submitAJaxForm').on('submit', function(e){
           e.preventDefault();
           var formData = new FormData(this);
           $("#btn_text").html('Please Wait...');
           var $this = $(this);
           $.ajax({
               type: "post",
               url: base_url+'/user/update-symtoms',
               data: formData,
               dataType: "json",
               cache:false,
               contentType: false,
               processData: false,
               success: function (response) {
                    Swal.fire(
                      'Success!',
                      'Symptoms Updated',
                      'success'
                    ).then((result)=>{
                        location.reload();
                    });
               },
               error: function (jqXHR) {
                   $("#btn_text").html('Done');
                    Swal.fire(
                      'Error!',
                      'something went wrong please try later',
                      'error'
                    );
               }
           });
     });

   $('#OpenImgUpload').click(function(){ $('#imgUpload').trigger('click'); });
   $('#OpenDocUpload').click(function(){ $('#documentUpload').trigger('click'); });
   var loadFile = function(event) {
       $("#output").show();
       var reader = new FileReader();
       reader.onload = function(){
         var output = document.getElementById('output');
         output.src = reader.result;
       };
       reader.readAsDataURL(event.target.files[0]);
   }

   var loadFilePDF = function(event) {
       $("#outputPDF").show();
   }

   var _token = "{{ csrf_token() }}";
   var _post_cancel_request_url = "{{ url('cancel-request') }}";

     $('.ratingbtn').click(function(e) {
           consultant_id =  $(this).attr('data-consultant_id');
           request_id =  $(this).attr('data-request_id');
            token =  $(this).attr('data-token');

           rating = $("#ratingModal_"+request_id+" .ratingd").val();
           review = $("#ratingModal_"+request_id+".reviewd").val();
           // token = $(".data-token").val();
           var csrf_token = $('meta[name="csrf-token"]').attr('content');
           console.log(csrf_token);
           var data = { consultant_id : consultant_id , request_id : request_id, rating : rating, review : review }
           $.ajax({
              headers: {
           'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
           },
           type:'POST',
           url:"{{ route('add-review') }}",
           data :data,
           dataType: 'json',
           token: csrf_token,
           success:function(data){
                location.reload();
            },error:function(data){

              }

        });
   });
</script>
@endsection
@endsection
