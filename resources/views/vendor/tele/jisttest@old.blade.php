@extends('vendor.tele.layouts.dashboard', ['title' => 'Doctor'])
@section('content')
<style type="text/css">
    iframe#jitsiConferenceFrame0 {
    height: 650px !important;
    width: 100% !important;
}
</style>
<div class="offset-top"></div>
 <!-- Wallet Section -->
 <section class="Wallet-content py-lg-5 mb-lg-5">
        <div class="container">

            <div class="row">
              <!--   <div class="col-lg-4">
                    <div class="bg-them mb-6">
                        <h4 class="border-bottom p-3 mb-2">Menu</h4>
                        <ul class="doctor-list pb-2">
                            <li class="active"><a href="{{url('user/doctor')}}"><i class="fas fa-calendar-week"></i> Appointments</a></li>
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
                                        <li class="chat-icon"><img src="{{asset('assetss/images/ic_profile-header@2x.png')}}" alt=""></li>
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
                                        <li class="chat-icon"><img src="{{asset('assetss/images/ic_profile-header@2x.png')}}" alt=""></li>
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
                                        <li class="chat-icon"><img src="{{asset('assetss/images/ic_profile-header@2x.png')}}" alt=""></li>
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
                </div> -->
                <div class="col-lg-12">
                  <div id="meet">
                  </div>
            </div>

        </div>

      </section>
@endsection
@section('script')
    <script src='https://meet.thefinesthealthcare.com/external_api.js'></script>
    <script>
    let is_doctor = "{{ $is_doctor }}";
    var calltype = '{{$call_type}}';
    const domain = 'meet.thefinesthealthcare.com';
    let booking = <?php echo $booking ?>;
    var request_id = '{{ $request_id }}';
    let options = {};
    let sender_name = "{{ $sender_name }}";
    let room_id = "{{ $room_id }}";

    console.log('Room ID : '+room_id);
    console.log('Sender Name : '+sender_name);
    console.log('Booking :'+booking);
    console.log('Call Type : '+calltype);
    console.log('Is Doctor : '+is_doctor);

    if(calltype == 'audio_call')
       {
           options = {
            roomName: "{{ $room_id }}",
            width: 800, //Well, you know.
            height: 480,
            parentNode: document.querySelector('#meet'),

            configOverwrite: {
                startAudioOnly: true,
                startWithVideoMuted : true,
                desktopSharingChromeDisabled: true,
                disableDeepLinking:true
            },
            interfaceConfigOverwrite: {
                DEFAULT_LOGO_URL: '',   // dont work
                TOOLBAR_ALWAYS_VISIBLE: true, // ok
                APP_NAME: 'TFH', // dont  work
                TOOLBAR_BUTTONS: [
                'microphone', 'raisehand','hangup', 'profile', 'settings'
            ],
            SETTINGS_SECTIONS: [ 'devices', 'profile' ],
            },
            userInfo: {
                email: "{{$userdata->self_user->email}}",
                displayName: "{{$userdata->self_user->name}}",
            }
        };
       }else{
        options = {
            roomName: "{{ $room_id }}",
            width: 1200, //Well, you know.
            height: 700,
            parentNode: document.querySelector('#meet'),
            configOverwrite: {
                 disableDeepLinking:true
            },
            interfaceConfigOverwrite: {
                DEFAULT_LOGO_URL: '{{asset('assetss/images/ic_logo2.png')}}',   // dont work
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
        }
        const api = new JitsiMeetExternalAPI(domain, options);

        api.executeCommand('displayName', '{{$userdata->self_user->name}}');
        // if(is_doctor!='1'){
        //     var status  = 'CALL_ACCEPTED';
        //     console.log('===============on load join==========');
        //     $.post( base_url + '/call-status', {
        //         "_token": "{{csrf_token()}}",
        //         "request_id": request_id,
        //         "status": status,
        //         "call_id":room_id
        //     }).done(function(data2) {
        //         console.log(data2);
        //     });
        // }
        if(is_doctor==='1'){
                socket.emit('callVideo', {
                    user_id:booking.to_user,
                    senderId:booking.to_user,
                    receiverId:booking.from_user,
                    reuquestId:request_id,
                    calltype:calltype,
                    senderData:sender_name,
                    call_id:room_id,
                    service_type:calltype,
                    main_service_type:calltype,
                    sender_name:"{{ $userdata->name }}",
                    sender_image:"{{ $userdata->profile_image }}",
                    vendor_category_name:"{{ $category_name }}"
                },function(res){
                   console.log('=============',res,'======================');
                });
        }else{
            var status  = 'CALL_ACCEPTED';
            console.log('===============isJoined CALL_ACCEPTED==========');
            $.post( base_url + '/call-status', {
                "_token": "{{csrf_token()}}",
                "request_id": request_id,
                "status": status,
                "call_id":room_id

            }).done(function(data2) {
                console.log(data2);
            });
        }
        api.on('readyToClose', () => {
        var request_id = '{{ $request_id }}';
        var status  = 'completed';
        window.location.href = "{{ $redirect_url }}";
        // $.post( base_url + '/call-status', {
        //     "_token": "{{csrf_token()}}",
        //     "request_id": request_id,
        //     "status": status

        // }).done(function(data2) {
        //     window.location.href = "{{ $redirect_url }}";
        // })
        // .fail(function() {
        //     window.location.href = "{{ $redirect_url }}";
        // })
        // .always(function() {
        //     window.location.href = "{{ $redirect_url }}";
        // });
        // jqxhr.always(function() {
        //     window.location.href = "{{ $redirect_url }}";
        // });


        });
        api.addEventListener(`isJoined`, () => {
            console.log('isJoined======================');
        });

        api.addEventListener('participantJoined', function(data){
            var status  = 'CALL_ACCEPTED';
                console.log('===============isJoined==========');
            $.post( base_url + '/call-status', {
                "_token": "{{csrf_token()}}",
                "request_id": request_id,
                "status": status,
                "call_id":room_id

            }).done(function(data2) {
                console.log(data2);
            });

        });
    </script>
@endsection
