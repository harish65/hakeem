//c_user_object;
console.log('c_user_object',c_user_object);
const authOption = { userId: c_user_object.id};
SendBirdCall.authenticate(authOption, (res, error) => {
	if (error) {
		console.log('error',error);
    } else {
    }
});
SendBirdCall.connectWebSocket()
.then(() => {
	console.log('connectWebSocket');
}).catch((err) => {
    console.log(err);
    alert("Failed to connect")
});
$("#callBtn").on('click', function(){
			const dialParams = {
			    userId: 184,
			    isVideoCall: false,
			    callOption: {
			        localMediaView: document.getElementById('local_video_element_id'),
			        remoteMediaView: document.getElementById('remote_video_element_id'),
			        audioEnabled: true,
			        videoEnabled: false
			    }
			};
			const call = SendBirdCall.dial(dialParams, (call, error) => {
				console.log(call);
			    if (error) {
			        console.log("Dialing failed");
			        alert("Dialing failed");
			        console.log(error);
			    }else{
			    	console.log("Dialing succeeded");	
			    	alert("Dialing succeeded");		    
			    }
			});

			call.onEstablished = (call) => {
			    alert("Call onEstablished");		    
			};

			call.onConnected = (call) => {
			    alert("Call onConnected");		    
			};

			call.onEnded = (call) => {
			    alert("Call onEnded");		    
			};

			call.onRemoteAudioSettingsChanged = (call) => {
			    alert("Call onRemoteAudioSettingsChanged");		    
			};

			call.onRemoteVideoSettingsChanged = (call) => {
			    alert("Call onRemoteVideoSettingsChanged");		    
			};

			SendBirdCall.addListener(c_user_object.id, {
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
});