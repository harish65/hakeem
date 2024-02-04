@extends('vendor.mp2r.layouts.index', ['title' => 'Manage Availability','header_after_login'=>true])
@section('css')
    
@endsection
@section('content')

<style>
.hide{
	display:none;
}
.imgt{
height: 79px;
    width: 79px;
    border-radius: 50%;
    object-fit: cover;
    /* border: solid; */
}
</style>
 <script type="text/javascript" src="{{ asset('asset/js/jquery.min.js') }}"></script>
<script type="text/javascript"  src="{{ asset('asset/js/SendBirdCall.min.js') }}"></script>

	<section class="main-height-clr bg-clr">
		<div class="container">
			<div class="row">
					<!-- left side  -->
				<div class="col-md-4 col-lg-4 col-sm-4">
					<div class="left-dashboard mt-5">
						<div class="side-head pb-0">
						<h3 class="">Service Provider Dashboard</h3>
						</div>
						<hr/>
						@include('vendor.mp2r.layouts.spmenu',['tab' =>'spappointment'])
					</div>
				</div>
				
			<!-- left side  end -->	
				
				<div class="col-lg-8 col-md-8 col-sm-8">
					<section class="right-side mt-5">
					<div class="row align-items-center">
						<div class="col-md-12 col-sm-12">
						<h3 class="appointment">UPCOMING REQUESTS</h3>
						</div>
						
					</div>
					</section>
					
					<section class="wrapper wrap">

					@forelse($bookingRequest as $bookingRequestInfo)
					<div class="row align-items-center m-0 wrap-height pt-3">
						<div class="col-md-7 col-lg-7 p-0 ">
							<div class="row m-0 align-items-center">
								<div class="apponit-img"><img  style="" src="{{ $bookingRequestInfo->cus_info->profile_image?Storage::disk('spaces')->url('uploads/'.$bookingRequestInfo->cus_info->profile_image):asset('assets/mp2r/images/ic_prof-medium@2x.png') }}" class="img-fluid img-round-second "></div>
									<div class="appoint-text">
									<p class="first-name">{{ $bookingRequestInfo->cus_info->name}}</p>
									<p class="second-call"><span class="clr-call"> {{ $bookingRequestInfo->requesthistory->status }}</span>
										@php $book_date=date("d F, yy h:i A", strtotime($bookingRequestInfo->booking_date)); @endphp
										{{ $book_date }}</p>
									</div>
							</div>
						</div>
						<div class="col-md-5 col-lg-5 ">
							@if($bookingRequestInfo->requesthistory->status == 'pending')

							<a id="userverifyEligibility" data-hisid="{{ $bookingRequestInfo->requesthistory->id }}" data-id="{{ $bookingRequestInfo->id }}"  type="button" class="btn-begin2">Accept</a>

							<a  href="{{ route('RequestCallStatus',['id' => $bookingRequestInfo->requesthistory->id,'status' => 'canceled' ])}}" type="button" class="btn-begin2 reject ml-2 ">Reject</a>
							

							@elseif($bookingRequestInfo->servicetype->id == 1)
							<a href="{{ url('service_provider/Chat?userid='.Auth::user()->id.'&nickname='.Auth::user()->name.'&receiver_id='.$bookingRequestInfo->from_user)}}" id="btn_start" data-guest-id="{{ $bookingRequestInfo->cus_info->id }}" class="btn-begin2 ml-2 modal-messaging-list__icon--select modal-confirm-submit">Chat</a>

							

							<!-- <button id="btn_login" data-id="{{ Auth::user()->id }}" class="btn-begin2 title">Video</button> -->

							<div id="form_container" class="login_div" style="display: none;">
			<label id="input_id_label" for="input_id" class="sendbird-sample-fieldLabel sendbird-sample-fontSmall sendbird-sample-fontHeavy">User ID</label>
			<input id="input_id" required="">
			<button id="btn_login" class="sendbird-sample-btn sendbird-sample-btnPrimary sendbird-sample-btnMid sendbird-sample-loginButton sendbird-sample-fontNormal">
				<label id="login_label" class="sendbird-sample-fontNormal sendbird-sample-fontColorWhite sendbird-sample-fontDemi">Sign in</label>
			</button>
		</div>

							<div id="content" class="call_to" style="display: none;">
			<div class="sendbird-sample-formContainer sendbird-sample-column sendbird-sample-center"><div id="title" class="sendbird-sample-fontBig sendbird-sample-fontDemi sendbird-sample-dialTitle">Make a call
			</div>
			<input id="peer_id" placeholder="Enter user ID" value="{{ $bookingRequestInfo->cus_info->id }}">
			<div id="buttons">
				<button id="make_call">Call</button>
				<button id="btn_audio">Audio</button>
			</div>
			</div>
		</div>

		<button style="display: none" class="loginclickphp" href="#" data-toggle="modal" data-target="#loginmodaal">
                                                Login
        </button>

		<div class="modal fade" id="loginmodaal" role="dialog" data-keyboard="false" data-backdrop="static">
                    <div class="modal-dialog modal-md ">
                      <div class="modal-content ">
                        <div class="modal-header d-block p-3">
                          <button id="closelogin" type="button" class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title login-head">Video</h4>
                        </div>
                        <div class="modal-body p-3">
                           <audio id="local_audio_element_id" autoplay></audio>
							<video id="local_video_element_id" style="width: 400px" autoplay></video>

							<audio id="remote_audio_element_id" autoplay></audio>
							<video id="remote_video_element_id" style="width: 400px;height: 200px" autoplay></video>
                              
                        </div>
                        
                      </div>
                    </div>
                  </div>

		

							@endif


							
						</div>
					</div>
					@empty
					<center>No record Found </center>
					@endforelse
					
					</section>
					
					
					
					
				
				
				</div>
			</div>
		</div>
	
	
	</section>


	<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="{{ asset('static/js/jquery-1.11.3.min.js') }}"></script>
  <script src="{{ asset('static/js/util.js') }}"></script>
  <script src="{{ asset('static/js/index.js') }}"></script>

 
	
	    @endsection
@section('script')
<script>
   function openCity(evt, cityName,dot1) {
	//   alert('a');
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";

  evt.currentTarget.className += " active";
  $('.dot').hide();
  //document.getElementsByClassName('dot').style.display = "none";
  document.getElementById(dot1).style.display = "inline-block";
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();
</script>



<script type="text/javascript">
	
			var user = null,connected= false;
		    SendBirdCall.init('B13514F8-4AB5-4ABA-87D6-C3904DA10C96');
		    $("#btn_login").on('click', async function(){
			    try {
			      var userId = $(this).attr('data-id');
			      if(!userId){
			      	alert('userId required');
			      	return false;
			      }
			      $(this).text('Signing...');
			      user = await SendBirdCall.authenticate({ userId: userId});
			      await SendBirdCall.connectWebSocket();
			      if(user){
			      	$(".login_div").hide();
			      	$(".call_to").hide();
			      }
			     
			      $("#make_call").trigger('click');


			    } catch (e) {
			      if (this.onLoginFailure) this.onLoginFailure(e);
			      alert(e);
			      $(this).text('Video call');
			    }
		  });

		 $("#make_call").on('click', async function(callback){

			    try {
			      var peerId = $("#peer_id").val();
			      if(!peerId){
			      	alert('peerId required');
			      	return false;
			      }
			      var callOption = {};
			      const _callOption = getCallOption(callOption);
			      try {
				      const call = SendBirdCall.dial({
				        userId: peerId,
				        isVideoCall: true,
				        callOption: _callOption
				      },async (call, error) => {
				        if (error) {
				          alert(error);
				          if (callback) callback(call, error);
				          return;
				        }
				        await addCall(call, 'dialing');
				      });
				    } catch (e) {
				      alert(e);
				    }
			    } catch (e) {
			      if (this.onLoginFailure) this.onLoginFailure(e);
			      alert(e);
			    }
		  });

		 function getCallOption(callOption) {
		  return Object.assign({
		    localMediaView: null,
		    remoteMediaView: null,
		    videoEnabled: true,
		    localMediaView: document.getElementById('local_video_element_id'),
							        remoteMediaView: document.getElementById('remote_video_element_id'),
		    audioEnabled: true
		  }, callOption);
		}

		async function  addCall(call, state) {
			$("#btn_login").text('dialing...');
			addCallListeners(call);
		    if (await isBusy()) {
		      return undefined;
		    }
		}

		async function isBusy() {
		    
		}

		function addCallListeners(call) {
			call.onRinging= () => {
			  $("#btn_login").text('Ringing...');
		      console.log('onRinging');

		      drawCurrentTime();
		      if (call.isVideoCall) {
		        hideSecondaryInfo();
		      }

		      const acceptParams = {
							            callOption: {
							                localMediaView: document.getElementById('local_video_element_id'),
							                remoteMediaView: document.getElementById('remote_video_element_id'),
							                audioEnabled: true,
							                videoEnabled: true,
							            }
							        };

							        call.accept(acceptParams);
		      
		    };
		    call.onConnected = () => {
		    	$("#btn_login").text('Connected...');
		    	$(".loginclickphp").trigger('click');
		      console.log('connected');
		      connected = true;
		      // drawCurrentTime();
		      // if (call.isVideoCall) {
		      //   hideSecondaryInfo();
		      // }
		    };

		    call.onEnded = (endedCall) => {
		    	$("#btn_login").text('Video call');
		      console.log('onEnded');
		      $("#loginmodaal").css('display','none');
		      // drawEndResult();
		      // if (endedCall.isVideoCall) {
		      //   showSecondaryInfo();
		      // }
		    };

		    call.onReconnected = () => {
		    		$("#title").text('Reconnected...');
		    	console.log('onReconnected');
		      // drawCurrentTime();
		    };

		    call.onReconnecting = () => {
		    		$("#title").text('Reconnecting...');
		    	console.log('Reconnecting');
		      // drawReconnectingText();
		    };

		    call.onRemoteAudioSettingsChanged = (call) => {
		    	console.log('onRemoteAudioSettingsChanged');
		      // onRemoteAudioMuted(call.isRemoteAudioEnabled);
		    };
		    call.onRemoteVideoSettingsChanged = (call) => {
		    	console.log('onRemoteVideoSettingsChanged');
		      // onRemoteVideoMuted(call.isRemoteVideoEnabled);
		    };
		  }

		  var receiver_id=$("#btn_login").attr('data-id');
		  SendBirdCall.addListener(receiver_id, {
			    onRinging: (call) => {
			        call.onEstablished = (call) => {
			            alert("Call Accept onEstablished");		    
			        };

			        call.onConnected = (call) => {
			            alert("Call Accept onConnected");		    
			        };

			        call.onEnded = (call) => {
			            alert("Call Accept onEnded");		    
			        };
			        
			        call.onRemoteAudioSettingsChanged = (call) => {
			            alert("Call Accept onRemoteAudioSettingsChanged");		    
			        };

			        call.onRemoteVideoSettingsChanged = (call) => {
			            alert("Call Accept onRemoteVideoSettingsChanged");		    
			        };

			        const acceptParams = {
			            callOption: {
			                localMediaView: document.getElementById('local_video_element_id'),
			                remoteMediaView: document.getElementById('remote_video_element_id'),
			                audioEnabled: true,
			                videoEnabled: false
			            }
			        };

			        call.accept(acceptParams);
			    }
			});


		  

		</script>
@endsection