@extends('vendor.mp2r.layouts.index', ['title' => 'Service Provider Chat','header_after_login'=>true])
@section('css')
    
@endsection
@section('content')	
<style type="text/css">
	#local_video_element_id{
  object-fit: initial;
  width: 466px;
  height: 600px;
}
.video-top {
    position: absolute;
    top: 16px;
    right: 16px;
    width: 100px;
    height: 120px;
}
</style>
<section class="chat-page">
	<div class="container">
		<div class="row">
			<!-- left side  end -->	
	<div class="col-md-12">
	<section class="right-side mt-5">
	<div class="row align-items-center">
	<div class="col-md-12 col-sm-12">
	<h3 class="appointment">Chat</h3>
	</div>
	</div>
	</section>
	</div>
	<div class="col-md-12">
		<div class="brdr-1 rounded">
			<div class="row">
				
				<div class="col-md-12 pl-0 right-msg-tab">
					<div class="tab-content" id="myTabContent">
					  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
					  <div class="p-3">
					  	<div class="row d-flex align-items-center">
					  		<div class="col-md-6 chat-top">
					  			<img  style="width: 70px;height: 70px;border-radius: 50%;" class="d-inline-block " src="{{ $receiverInfo->profile_image ? Storage::disk('spaces')->url('uploads/' . $receiverInfo->profile_image) : asset('assets/mp2r/images/default.png') }}"><span style="display: block;" class="d-inline-block ml-3 chat-top__title chat-top__title--messaging"></span>
					  		</div>
					  		
					  		<div class="col-md-6 text-right">
					  			<img id="audio_login" data-id="{{ Auth::user()->id }}" style="width: 25px; cursor: pointer;" class="mr-3"  src="{{ asset('/assets/images/ic_audio.png') }}">
					  			<img style="width: 36px; cursor: pointer;" class="mr-3"   id="btn_login" data-id="{{ Auth::user()->id }}" src="{{ asset('/assets/images/ic_video.png') }}">
					  			
					  			<button id="make_call" style="display:none;">video</button>
					  			<button id="make_call_audio_button" style="display:none;">audio</button>
					  			<input id="peer_id" type="hidden"placeholder="Enter user ID" value="{{ $_GET['receiver_id']}}">
					  		</div>
					  	</div>
					  </div>
					  <hr class="mt-0">
					  <div class="p-3">
					  	<div class="row chat" style="max-height: calc(100vh - 180px);overflow-y: auto;">

					  		
				  			<div class="chat-canvas" style="width: 100%"></div>
				  			<label class="chat-input-typing" style="display: none;"></label>

					  	</div>
					  </div>
					  </div>
					  
					  
					</div>
					<div class="chat-footer">
					  	<div class="row d-flex align-items-center">
					  		<div class="col-md-1 text-center">
					  			<img src="{{ asset('/assets/images/emojis.png') }}">
					  		</div>
					  		<div class="col-md-9">
					  			<input type="" name="" class="chat-input-text__field">
					  		</div>

					  		<div class="col-md-2 text-right">
					  			<div class="pr-3">
					  				<div class="image-upload">
									    <label class="chat-input-file" for="chat_file_input">
									        <img src="{{ asset('/assets/images/ic_changeimage.png') }}">
									    </label>
									     
									    <input type="file"  name="file" id="chat_file_input" style="display: none;">
									</div>
					  			</div>
					  		</div>
					  	</div>
					  </div>
				</div>
			</div>
		</div>
	</div>
	</div>
</div>

</section>	
<button style="display: none" id="make_call_audio" href="#" data-toggle="modal" data-target="#myModalaudio">
                                                audio
</button>
<!-- Modal 1 -->
    <div class="modal fade" id="myModalaudio">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Audio call started</h4>
        <audio id="local_audio_element_id" autoplay></audio>
        <audio id="remote_audio_element_id" autoplay></audio>
        <button id="audio_call_end" type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body pb-5 text-center">
        <img class="mb-4" src="{{ asset('/assets/images/ic_support-active@2x.png') }}">
        <p>Your Voice Call has started</p>
      </div>
    </div>
  </div>
</div>

<!-- Modal 2 -->
<button style="display: none" class="loginclickphp" href="#" data-toggle="modal" data-target="#loginmodaal">
                                                video
</button>

<div class="modal fade" id="loginmodaal">
  <div class="modal-dialog">
    <div class="modal-content video-popup">

      <!-- Modal Header -->
      <div class="modal-header">
      	<h4 class="modal-title">Video call started</h4>
        <button id="video-close" type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
      	<!-- <img class="video-top" src="{{ asset('/assets/images/ic_signup-img1.png') }}">
        <img class="video-first" src="{{ asset('/assets/images/ic_signup-img1.png') }}" > -->
        <audio id="local_audio_element_id" autoplay></audio>
		<video id="local_video_element_id" style="width: 466px" autoplay></video>

		<audio id="remote_audio_element_id" autoplay></audio>
		<video id="remote_video_element_id" style="width: 172px; position: absolute;top: 16px;right: 17px;" autoplay class="video-first"></video>
      </div>
    </div>
  </div>
</div>

<script src="{{ asset('static/lib/SendBird.min.js') }}"></script>
<script src="{{ asset('static/js/util.js') }}"></script>
<script src="{{ asset('static/js/chat.js') }}"></script>
<script src="{{ asset('static/js/index.js') }}"></script>


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
			      //alert(userId);
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

		  $("#audio_login").on('click', async function(){
		    	
			    try {
			      var userId = $(this).attr('data-id');
			      
			     
			      await SendBirdCall.authenticate({ userId: userId});
			      await SendBirdCall.connectWebSocket();

			     
			      $("#make_call_audio_button").trigger('click');


			    } catch (e) {
			      if (this.onLoginFailure) this.onLoginFailure(e);
			      alert(e);
			      $(this).text('Video call');
			    }
		  });

		 $("#make_call_audio_button").on('click', async function(callback){
		 	

			    try {
			      var peerId = $("#peer_id").val();
			      
			      var callOption = {};
			      const _callOption = getCallOption(callOption);
			      try {
				      const call = SendBirdCall.dial({
				        userId: peerId,
				        isVideoCall: false,
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
		    	console.log(call._isVideoCall);
		    	if(call._isVideoCall == false){

		    		$("#make_call_audio").trigger('click');

		    	}else if(call._isVideoCall == true){

		    		$(".loginclickphp").trigger('click');
		    	}
		    	
		      console.log('connected');
		      console.log(call);
		      connected = true;
		      // drawCurrentTime();
		      // if (call.isVideoCall) {
		      //   hideSecondaryInfo();
		      // }
		    };

		    call.onEnded = (endedCall) => {
		    	$("#btn_login").text('Video call');
		      console.log('onEnded');
		      if(call._isVideoCall == false){
		      	$("#audio_call_end").trigger('click');
		      }else if(call._isVideoCall == true){

		    		$("#video-close").trigger('click');
		    	}
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
			        	$(".loginclickphp").trigger('click');
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
			                videoEnabled: true,
			            }
			        };

			        call.accept(acceptParams);
			    }
			});


		  

		</script>
@endsection