@extends('vendor.care_connect_live.layouts.dashboard', ['title' => 'Doctor'])
@section('content')
<div class="offset-top"></div>
 <!-- Wallet Section -->
 <section class="Wallet-content py-lg-5 mb-lg-5">
        <div class="container">

            <div class="row">
                <div class="col-lg-4">
                    @if(Auth::user()->hasrole('service_provider'))
                    <div class="bg-them mb-6">
                        <h4 class="border-bottom p-3 mb-2">Menu</h4>
                        <ul class="doctor-list pb-2">
                            <li class="active"><a href="{{url('user/requests')}}"><i class="fas fa-calendar-week"></i> Appointments</a></li>
                            <li><a href="{{url('user/revenue')}}"><i class="fas fa-signal"></i>Revenue</a></li>
                            <li><a href="#"><i class="far fa-list-alt"></i>Prescription</a></li>
                        </ul>
                    </div>
                    <div class="bg-them">
                        <h4 class="border-bottom p-3 d-flex align-items-center justify-content-between"><span>Recent
                                Chats</span> <a class="txt-14 text-blue" href="{{url('user/chat')}}"> <b>View all</b></a></h4>

                        <ul class="recent-chat-list py-4">
                            <li class="">
                                <a href="">
                                    <ul class="d-flex align-items-center justify-content-start px-3">
                                        <li class="chat-icon"><img src="{{asset('assets/images/ic_profile-header@2x.png')}}" alt=""></li>
                                        <li class="chat-text">
                                            <h6 class="m-0 d-flex align-items-center justify-content-between"><label>
                                                    Stella</label> <span class="online-time">1h</span></h6>
                                            <div class="pr-4 position-relative">
                                                <p class="m-0 ellipsis">But recently started facing som.............</p>
                                                <span class="msg-no position-absolute">2</span>
                                            </div>
                                        </li>
                                    </ul>
                                </a>
                            </li>

                            <li>
                                <a href="">
                                    <ul class="d-flex align-items-center justify-content-start px-3">
                                        <li class="chat-icon"><img src="{{asset('assets/images/ic_profile-header@2x.png')}}" alt=""></li>
                                        <li class="chat-text">
                                            <h6 class="m-0 d-flex align-items-center justify-content-between">
                                                <label>Gibby Radki</label> <span class="online-time">1h</span></h6>
                                            <label class="status-txt d-block">Sure, No Problem</label>
                                        </li>
                                    </ul>
                                </a>
                            </li>

                            <li>
                                <a href="">
                                    <ul class="d-flex align-items-center justify-content-start px-3">
                                        <li class="chat-icon"><img src="{{asset('assets/images/ic_profile-header@2x.png')}}" alt=""></li>
                                        <li class="chat-text">
                                            <h6 class="m-0 d-flex align-items-center justify-content-between">
                                                <label>Jessica Stone</label> <span class="online-time">1h</span></h6>
                                            <label class="status-txt d-block">Sure, No Problem</label>
                                        </li>
                                    </ul>
                                </a>
                            </li>

                            <li>
                                <a href="">
                                    <ul class="d-flex align-items-center justify-content-start px-3">
                                        <li class="chat-icon"><img src="{{asset('images/ic_profile-header@2x.png')}}" alt=""></li>
                                        <li class="chat-text">
                                            <h6 class="m-0 d-flex align-items-center justify-content-between">
                                                <label>Raheem Sterling</label> <span class="online-time">1h</span></h6>
                                            <label class="status-txt d-block">Sure, No Problem</label>
                                        </li>
                                    </ul>
                                </a>
                            </li>
                        </ul>


                    </div>
                    @endif
                </div>
                <div class="col-lg-8">
                  <div id="meet">
                  </div>
            </div>

        </div>

      </section>
      <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src='https://meet.royoapps.com/external_api.js'></script>

    <script>
      var base_url = "{{ url('/') }}";
        var calltype = '{{$call_type}}';
        const domain = 'meet.royoapps.com';
       if(calltype == 'audio_call')
       {
           const options = {
            roomName: "{{ $room_id }}",
            width: 800, //Well, you know.
            height: 480,


            parentNode: document.querySelector('#meet'),

            configOverwrite: {
                // startAudioOnly: true,
                // startWithVideoMuted : true,
                // // desktopSharingChromeDisabled: true,
                // disableDeepLinking:true,
               // disableInviteFunctions: false,
               DISABLE_PRESENCE_STATUS: false,
                DISABLE_RINGING: false,

            },
            interfaceConfigOverwrite: {
                DEFAULT_LOGO_URL: '',   // dont work
                TOOLBAR_ALWAYS_VISIBLE: true, // ok
                APP_NAME: 'TFH', // dont  work
                fileRecordingsEnabled: true,
                liveStreamingEnabled: true,
                enableFeaturesBasedOnToken: true,

               // HIDE_INVITE_MORE_HEADER: false,
               TOOLBAR_BUTTONS: [
                'microphone', 'camera', 'closedcaptions', 'desktop', 'fullscreen',
                'fodeviceselection', 'hangup', 'profile', 'info', 'chat', 'recording',
                'livestreaming', 'etherpad', 'sharedvideo', 'settings', 'raisehand',
                'videoquality', 'filmstrip', 'invite', 'feedback', 'stats', 'shortcuts',
                'tileview'
            ],
            SETTINGS_SECTIONS: [ 'devices', 'language', 'moderator', 'profile', 'calendar' ],
            // SETTINGS_SECTIONS: [ 'devices', 'profile' ],
            // SHARING_FEATURES: ['email', 'url'],
             },
             CONNECTION_INDICATOR_AUTO_HIDE_TIMEOUT: 5000,
            //  localRecording: {
            //     enabled: true,

            //  },
            userInfo: {
                email: "{{$userdata->self_user->email}}",
                displayName: "{{$userdata->self_user->name}}",

            }

        };
        const api = new JitsiMeetExternalAPI(domain, options);


        api.executeCommand('displayName', '{{$userdata->self_user->name}}');


        api.on('readyToClose', () => {

            var request_id = '{{ $request_id }}';
            var status  = 'completed';

            $.post( base_url + '/call-status', {
                "_token": "{{csrf_token()}}",
                "request_id": request_id,
                "status": status

            }).done(function(data2) {
                window.location.href = "{{ $redirect_url }}";
            })
            .fail(function() {
                window.location.href = "{{ $redirect_url }}";
            })
            .always(function() {
                window.location.href = "{{ $redirect_url }}";
            });
            jqxhr.always(function() {
                window.location.href = "{{ $redirect_url }}";
            });


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

       }
       else
       {
        const options = {
            roomName: "{{ $room_id }}",

            width: 800, //Well, you know.
            height: 480,

            parentNode: document.querySelector('#meet'),
            configOverwrite: {
                 // startWithVideoMuted : true,
                 disableDeepLinking:true,
                 inviteServiceUrl: 'https://newdomain',

            },

            interfaceConfigOverwrite: {
                DEFAULT_LOGO_URL: '{{asset('assets/images/ic_logo2.png')}}',   // dont work
                disableInviteFunctions: false,
                inviteServiceUrl: 'https://newdomain',
                TOOLBAR_ALWAYS_VISIBLE: true, // ok
                APP_NAME: 'TFH', // dont  work
                TOOLBAR_BUTTONS: [
                'microphone', 'camera','hangup', 'profile', 'fullscreen', 'videoquality', 'tileview', 'settings'
            ],

            },
            userInfo: {
                email: "{{$userdata->self_user->email}}",
                displayName: "{{$userdata->self_user->name}}",

            }

        };
        const api = new JitsiMeetExternalAPI(domain, options);

        api.executeCommand('displayName', '{{$userdata->self_user->name}}');


        api.on('readyToClose', () => {

        var request_id = '{{ $request_id }}';
        var status  = 'completed';

        $.post( base_url + '/call-status', {
            "_token": "{{csrf_token()}}",
            "request_id": request_id,
            "status": status

        }).done(function(data2) {
            window.location.href = "{{ $redirect_url }}";
        })
        .fail(function() {
            window.location.href = "{{ $redirect_url }}";
        })
        .always(function() {
            window.location.href = "{{ $redirect_url }}";
        });
        jqxhr.always(function() {
            window.location.href = "{{ $redirect_url }}";
        });


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


       }




    </script>

    <script>
        $("#start").click(function(){
            alert("sadada");
        });
    </script>
     <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.4/socket.io.js"></script>
     <script src="{{ asset('assets/care_connect_live/js/jquery.toast.min.js') }}"></script>

  <script type="text/javascript">
    callsenderId = "{{ $sender_id}}";
    callreceiverId = "{{ $receiver_id }}";
     callreuquestId = '{{ $request_id }}';
</script>

@endsection
