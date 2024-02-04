@extends('vendor.care_connect_live.layouts.dashboard', ['title' => 'Patient'])
@section('content')
 <!-- Offset Top -->
 <style>
.image-list-item {
  background: rgba(255, 0, 0, 0.1);
  margin-left: 10px;
  display: inline-block;
}

.scroll-image { 
  /* height: 100vh; */
  overflow-x: scroll;
  overflow-y: hidden;
  white-space: nowrap;
  width: auto;
}
 </style>
 <div class="offset-top"></div>
     <!-- Appointments Section -->
     <section class="appointments-content py-lg-5 mb-lg-5">
        <div class="container">
            <div class="row">
                <div class="col-12 waiting-room-div">
                 <h3 class="text-center">Waiting Room</h3> 
                    
                </div>
              
            </div> 
            <div id="timeClock" style="margin:2em;"></div>
	  
            @if($advertisements)
            @foreach($advertisements as $advertise)
            <div class="row" style="padding-top:30px;" >
                <div class="adertisement_image-container" style="width:100%">
               
                    <div class="owl-carousel owl-theme">
                   
                        @if($advertise->image)
                            @foreach($advertise->image as $key=>$img)
                                <div class="item"><img class="img-fluid" style="max-width: 500px; max-height: 200px; margin: auto;" src="{{Storage::disk('spaces')->url('uploads/'.$img)}}"/></div>
                            @endforeach
                        @endif
                   
                </div>

                   
                </div>
             <div class="adertisement_video-container" style="width:100%; text-align:center; padding-top:30px">
                <div class="owl-carousel owl-theme">
                    
                    @if($advertise->video)
                        @foreach($advertise->video as $key=>$video)
                            <div class="item"><video id="video_player" style="max-width: 500px; max-height: 200px; margin: auto;" src="{{Storage::disk('spaces')->url('video/'.$video)}}" controls></video></div>
                        @endforeach
                    @endif
                
                </div>
                
            </div> 

                <div class="doctor_detail" style="padding-top:30px; width:100%; margin-left:25%">
                <ul class="chat-user active d-flex align-items-center ">
                    <li class="doctor_pic">
                    @if($requests->to_user->profile_image == '' ||  $requests->to_user->profile_image == null)
                    <img src="{{asset('assets/images/ic_upload profile img.png')}}" alt="" height="80px" width="80px">
                    @else
                    <img src="{{Storage::disk('spaces')->url('uploads/'.$requests->to_user->profile_image)}}" alt="" height="80px" width="80px">
                    @endif
                    
                    <div class="doctor_detail pl-3 active">
                    
                    <h4>{{ucwords($requests->to_user->name)}}</h4>
                    <p> {{$requests->to_user->categoryData->name}} </p>
                    
                    <h4>Token number: {{$requests->token_number}} </h4>
                    
                    @if($waiting_time != 0) <h4>Waiting Time: <span id="timer" ></span> </h4> @endif
                   
                    
                    </div>
                    
                  </li>                      
                </ul>
                </div>
               <div class="advertisement_share_btn">

               </div>
               @php $join = Request::get('join') @endphp
               @if($join=='true')
               <div class="advertisement_btn" style="padding-top:5px; width:100%; text-align:center;">
                         <button  style="margin: auto;width: 50%;margin-top: 2%;" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample" class="default-btn radius-btn">
                                        <span>Share</span>
                        </button>
                </div>
                        <div class="collapse mb-3" id="collapseExample" style="margin:auto; margin-top:2%">
                            <div class="card card-body">
                            <div id="shareIcons"></div>
                                
                            </div>
                        </div>
              
               @if($requests->service_type != 'Chat')
               <div class="advertisement_join_btn" style="padding-top:5px; width:100%; text-align:center;">
                         <a href="{{url('service/')}}/{{ $request_id }}/audio_call" class="default-btn radius-btn" style="width:50%;" >
                                        <span>Join</span>
                        </a>
               </div>
               @endif
              
               @endif

            </div>
            @endforeach
            @endif
        </div>

          </section>
    <script>
        var _token = "{{ csrf_token() }}";
        var _post_cancel_request_url = "{{ url('cancel-request') }}";
        var jistiid = '202001';
        var room_id = 'Call_'+jistiid+'_'+"{{$request_id}}";
        // var _rem_time = 220880;
        var _rem_time = "{{ $waiting_time }}";
        var timerVar = setInterval(countTimer, 1000);
        var totalSeconds = _rem_time;
        function countTimer() {
           ++totalSeconds;
           var hour = Math.floor(totalSeconds /3600);
           var minute = Math.floor((totalSeconds - hour*3600)/60);
           var seconds = totalSeconds - (hour*3600 + minute*60);
           if(hour < 10)
             hour = "0"+hour;
           if(minute < 10)
             minute = "0"+minute;
           if(seconds < 10)
             seconds = "0"+seconds;
           document.getElementById("timer").innerHTML = hour + ":" + minute + ":" + seconds;
        }
     
    </script>
   
  
@endsection