@extends('vendor.tele.layouts.index', ['title' => 'Call 2'])
@section('content')
<div class="offset-top"></div>
 <!-- Wallet Section -->
 <section class="Wallet-content py-lg-5 mb-lg-5">
        <div class="container">

            <div class="row">
                <div class="col-lg-12">
                    <div id="meet">
                    </div>
                    </div>
            </div>

        </div>

      </section>

      <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script> -->
    <script src='https://meet.royoapps.com/external_api.js'></script>

    <script>
      var base_url = "{{ url('/') }}";
        var calltype = '{{$call_type}}';
        var redirect_url = '{{$redirect_url}}';
        const domain = 'meet.royoapps.com';
        var isStreamOn = false; //This is a variable I've defined to use later.
        // alert('hehe');
        const options = {
            roomName: "{{ $room_id }}",
            parentNode: document.querySelector('#meet'),
            width: 800, //Well, you know.
            height: 480,

            configOverwrite: {
                  // startWithVideoMuted : true,
                 disableDeepLinking:true,

            },

            interfaceConfigOverwrite: {
                DEFAULT_LOGO_URL: "{{asset('assets/images/ic_logo2.png')}}",   // dont work
                // disableInviteFunctions: false,
                // DISABLE_DOMINANT_SPEAKER_INDICATOR: true,
                TOOLBAR_ALWAYS_VISIBLE: true, // ok
                APP_NAME: 'iEdu', // dont  work

            },
            userInfo: {
                email:  "{{$userdata->self_user->email}}",
                displayName: "{{$userdata->self_user->name}}",

            }

        };
        const api = new JitsiMeetExternalAPI(domain, options);

        api.executeCommand('displayName', '{{$userdata->self_user->name}}');


        api.on('readyToClose', () => {
                window.location.href = "{{ url($redirect_url) }}";
        });
        api.addEventListener(`isJoined`, () => {

        });

        api.addEventListener('participantJoined', function(data){
            var request_id = '{{ $request_id }}';
            var status  = 'CALL_ACCEPTED';

            $.post( base_url + '/call-status', {
                "_token": "{{csrf_token()}}",
                "request_id": request_id,
                "status": status

            }).done(function(data2) {
                console.log(data2);
            });

        });

        // function streamHandler() {
        // try {
        //     if (!isStreamOn) {
        //         document.getElementById("streamingResponseMsg").innerHTML = "Starting streaming...";
        //         //The function below starts the stream or recording, according to its "mode"
        //         api.executeCommand('startRecording', {
        //             mode: 'stream', //recording mode, either `file` or `stream`.
        //             rtmpStreamKey: '', //This where you *should* put your favoured rtmp stream server along with your key, like "rtmp:\/\/some.address/norecord/stream-key"
        //             youtubeStreamKey: 'rtmp:\/\/some.address/norecord/stream-key', //the youtube stream key.
        //         });
        //     } else {
        //         document.getElementById("streamingResponseMsg").innerHTML = "Stopping streaming...";
        //         //The function below stops the stream or recording, according to the string you pass. Official guide shows an object, while it should be a string
        //         api.executeCommand('stopRecording', 'stream');
        //     }

        // }catch (e){
        //     if (isStreamOn){
        //         document.getElementById("streamingResponseMsg").innerHTML = "Error while stopping stream.";
        //         console.log("Exception while stopping stream.", e);
        //     }else{
        //         document.getElementById("streamingResponseMsg").innerHTML = "Error while starting stream.";
        //         console.log("Exception while starting stream.", e);

        //     }
        //     this.isStreamOn = false;
        //  }
        // };
        //This part doesn't work without making some changes to the code as per this; https://github.com/team-ai-repo/jitsi-meet/pull/4/files
        // api.addEventListener("recordingStarted", () => {
        //     document.getElementById("stream-btn").innerHTML="Stop Streaming";
        //     document.getElementById("streamingResponseMsg").innerHTML = "Stream is on";
        //     this.isStreamOn = true;
        //     console.log("Example Stream On", this.isStreamOn);
        // });

        // api.addEventListener("recordingStopped", () => {
        //     document.getElementById("stream-btn").innerHTML="Start Streaming";
        //     document.getElementById("streamingResponseMsg").innerHTML = "Stream is off";
        //     console.log("Example Stream Off", this.isStreamOn);
        //     this.isStreamOn = false;
        // });




    </script>

    <script>
        $("#start").click(function(){
            alert("sadada");
        });
    </script>
     <!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.4/socket.io.js"></script> -->
     <script src="{{ asset('assets/tele/js/jquery.toast.min.js') }}"></script>

  <script type="text/javascript">
    var senderId = "{{ $sender_id}}";
    var receiverId = "{{ $receiver_id }}";
    var reuquestId = '{{ $request_id }}';
    var call_type = '{{$call_type  }}';
    var call_id = '{{ request()->call_id }}'
 </script>

@endsection
