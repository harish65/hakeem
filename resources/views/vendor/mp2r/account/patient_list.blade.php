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
						@include('vendor.mp2r.layouts.spmenu',['tab' =>'patient'])
					</div>
				</div>
				<div class="col-lg-8 col-md-8 col-sm-8">
					<section class="right-side mt-5">
					<div class="row align-items-center">
						<div class="col-md-8 col-sm-6">
						<h3 class="appointment">Patient List</h3>
						</div>
						<!-- <div class="col-md-4 col-sm-6">
							<div class="appointment-date">
								<form>
								 <div class="form-group mb-0"> 
								 <input type="date" class="form-control border-0" id="usr">
								</div>
								</form>
							</div>
						</div> -->
					</div>
					</section>
					<section class="wrapper wrap">
						@forelse($patients as $patient)
							<div class="row align-items-center m-0 wrap-height pt-3">
								<div class="col-md-6 col-lg-6 ">
									<div class="row m-0 align-items-center">
										<div class="col-md-3 p-0">
											<img src="{{isset($patient->profile_image) ?  Storage::disk('spaces')->url('uploads/'.$patient->profile_image) : asset('assets/mp2r/images/default.png') }}" class="img-fluid notif-img "></div>
											<div class="col-md-9 p-0">
											<p class="first-name">{{isset($patient->name) ? $patient->name : '' }}</p>
											<p class="second-name">{{ \Carbon\Carbon::parse($patient->last_consult_date)->format('j F, Y h:i A') }}</p>
											</div>
									</div>
								</div>
								<div class="col-md-6 col-lg-6 ">
								<a  href="{{ url('service_provider/Chat?userid='.Auth::user()->id.'&nickname='.Auth::user()->name.'&receiver_id='.$patient->id)}}" type="button" class="btn-begin2">Chat</a>
								</div>
							</div>
						@empty
							No data found.
						@endforelse
					</section>
				</div>
			</div>
		</div>
	</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
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
		    };

		    call.onEnded = (endedCall) => {
		    	$("#btn_login").text('Video call');
		      $("#loginmodaal").css('display','none');
		    };

		    call.onReconnected = () => {
		    		$("#title").text('Reconnected...');
		    	console.log('onReconnected');
		    };

		    call.onReconnecting = () => {
		    		$("#title").text('Reconnecting...');
		    	console.log('Reconnecting');
		    };

		    call.onRemoteAudioSettingsChanged = (call) => {
		    	console.log('onRemoteAudioSettingsChanged');
		    };
		    call.onRemoteVideoSettingsChanged = (call) => {
		    	console.log('onRemoteVideoSettingsChanged');
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