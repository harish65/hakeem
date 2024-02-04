@extends('vendor.iedu.layouts.index', ['title' => 'Chat'])
<link rel="stylesheet" href="{{asset('assets/care_connect_live/css/fontawesome.css')}}">
    <link rel="stylesheet" href="{{asset('assets/care_connect_live/css/slick.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/care_connect_live/css/slick-theme.css')}}">
     <link rel="stylesheet" href="{{asset('assets/care_connect_live/css/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link rel="stylesheet" href="{{asset('assets/care_connect_live/css/intlTelInput.css')}}">
    <link rel="stylesheet" href="{{asset('assets/care_connect_live/css/owl.carousel.min.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/care_connect_live/css/owl.theme.default.min.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/care_connect_live/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/care_connect_live/css/responsive.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/care_connect_live/css/emojionearea.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/care_connect_live/css/jquery.toast.min.css')}}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link href="{{asset('assets/care_connect_live/css/jssocials.css')}}" rel="stylesheet"  />
    <link href="{{asset('assets/care_connect_live/css/jssocials-theme-classic.css')}}" rel="stylesheet"  />
    <link href="{{asset('assets/care_connect_live/css/star-rating.min.css')}}" rel="stylesheet"  />

    <link href="{{asset('assets/care_connect_live/css/theme.css')}}" rel="stylesheet"  />
    <link rel="stylesheet" href="{{asset('assets/care_connect_live/css/flipclock.css')}}">
@section('content')
 <!-- Offset Top -->
 <style>
 .active-users {
    overflow: scroll;
    scroll-behavior: smooth;
    max-height: 410px;
    margin-bottom: 10px;
}
.chat_box_wrapper {
    overflow: scroll;
    scroll-behavior: smooth;
    margin-bottom: 0;
    background-color: #f9f9f9;
    height: 370px !important;
}
.send_msg{
    background-color: white !important;
    color: unset !important;
}
.recived_msg::after
{
    background-color: #efeff0 !important;
}
.input-group-btn.border-right-0 {
    height: 38px !important;
}

 </style>

 <div class="offset-top"></div>
   <!-- Chats Section -->
   <section class="appointments-content mb-lg-5">
        <div class="container">
            <!-- <div class="row"> -->
                <!-- <div class="col-12">
                    <h1>Chats</h1> -->
                    <!-- <div class="bg-light-gray position-relative p-3 mt-4">
                        <ul class="appointments-nav d-flex align-items-center">
                            <li class="active"><a href="#">Super Specialits</a></li>
                            <li><a href="#">Dietician</a></li>
                            <li><a href="#">Homopathy</a></li>
                            <li><a href="#">Gynaecology</a></li>
                        </ul>
                    </div> -->
                <!-- </div>
            </div> -->


            <div class="message_wrapper mt-lg-5 mt-4">
                <div class="row no-gutters">
                    <div class="col-md-4 border_gray">
                        <div class="chat_box">
                            <div class="input-group custom_search_form position-relative">
                                <span class="input-group-btn border-right-0">
                                    <button class="btn btn-default pr-0" type="button">
                                        <i class="fas fa-search" style="font-size: 16px;"></i>
                                    </button>
                                </span>
                                <input type="text" style="height:48px"
                                    class="form-control border-left-0 placeholder_text text-uppercase pl-1 searchInput"
                                    placeholder="Search">
                            </div>

                            <ul class="active-users">
                                @foreach($chats as $chat)
                                <?php

                                if($chat->id == request()->get('request_id'))
                                {
                                    $class='active';
                                }elseif($chat->selected){
                                     $class='active';
                                }else{
                                    $class='';
                                }

                                ?>
                                <li  class={{$class}} >
                                    <a href="{{ url('user/chat/iedu').'?request_id='.$chat->id }}">
                                    @if(Auth::user()->hasrole('service_provider'))
                                        <ul class="chat-user active d-flex align-items-center justify-content-start">
                                            <li class="doctor_pic">
                                                @if($chat->from_user->profile_image != '' || $chat->from_user->profile_image != null)
                                                <img src="{{ Storage::disk('spaces')->url('uploads/'.$chat->from_user->profile_image) }}" alt="">
                                                @else
                                                <img src="{{asset('assets/care_connect_live/images/ic_upload profile img.png')}}" alt="">
                                                @endif
                                            </li>
                                             <li class="doctor_detail pl-3 active">

                                                <h4>{{ ucwords($chat->from_user->name) }} </h4>
                                                @if($chat->from_user->manual_available == '1')
                                                <small><i class="fa fa-circle text-success"></i> Online</small>
                                                @endif
                                                <p> @if($chat->last_message->message != 'null') {{$chat->last_message->message}} @else <img src="https://cdn4.iconfinder.com/data/icons/ionicons/512/icon-image-512.png" style="height: 17px;padding-bottom: 1px;margin-right: 4px;"> Media @endif </p>
                                                <p>  @php
                                                if($chat->last_message){
                                                    $message_created = $chat->last_message->created_at;
                                                    $msg_date = Carbon\Carbon::parse($message_created,'UTC')->setTimezone('Asia/Kolkata');
                                                    echo $msg_date->isoFormat('h:mm a');
                                                }
                                                else{
                                                  echo $chat->time;
                                                }
                                                @endphp
                                               </p>
                                            </li>
                                        </ul>
                                    @else
                                        <ul class="chat-user active d-flex align-items-center justify-content-start">
                                            <li class="doctor_pic">
                                                <img src="{{ Storage::disk('spaces')->url('uploads/'.$chat->from_user->profile_image) }}" alt="">
                                            </li>
                                            <li class="doctor_detail pl-3 active">
                                            <h4>{{ ucwords($chat->from_user->name) }}</h4>
                                            <p> @if($chat->last_message->message != 'null') {{$chat->last_message->message}} @else <img src="https://cdn4.iconfinder.com/data/icons/ionicons/512/icon-image-512.png" style="height: 17px;padding-bottom: 1px;margin-right: 4px;"> Media @endif </p>
                                            <p>  @php
                                            if($chat->last_message){
                                                $message_created = $chat->last_message->created_at;
                                                $msg_date = Carbon\Carbon::parse($message_created,'UTC')->setTimezone('Asia/Kolkata');
                                                echo $msg_date->isoFormat('h:mm a');
                                            }
                                            else{
                                              echo $chat->time;
                                            }
                                            @endphp
                                           </p>
                                        </li>

                                        </ul>
                                    @endif



                                    </a>
                                </li>
                                @endforeach
                            </ul>


                        </div>
                    </div>
                    <div class="col-md-8 border_gray border-left-0 chat-right">
                    @if(Auth::user()->hasrole('service_provider'))

                    <ul class="chat-user border-bottom d-flex align-items-center justify-content-start">
                            <li class="doctor_pic">
                                @if($user)
                                <img src="{{ Storage::disk('spaces')->url('uploads/'.$user->profile_image) }}" alt="">
                                @endif
                            </li>
                            <li class="doctor_detail pl-3">
                                <h4>{{ ($user)? ucwords($user->name):'' }}</h4>
                                <div class="">
                                </div>
                            </li>
                        </ul>


                    @else

                    <ul class="chat-user border-bottom d-flex align-items-center justify-content-start">
                            <li class="doctor_pic">
                                @if($user)
                                <img src="{{ Storage::disk('spaces')->url('uploads/'.$user->profile_image) }}" alt="">
                                @endif
                            </li>
                            <li class="doctor_detail pl-3">
                                <h4>{{ ($user)?ucwords($user->name):'' }}</h4>
                                <div class="">
                                </div>
                            </li>

                        </ul>

                    @endif


                        <div class="chat_box_wrapper" id="output">

                            @if(!$user)
                                <div class="day_title text-center mb-4 pb-2">Chat not available</div>
                            @endif

                            @for($m = count($messages)-1; $m>=0 ;$m--)
                                @if($messages[$m]['sender'])
                                    <div class="send_msg position-relative  mb-3 round-msg">
                                        @if(strtolower($messages[$m]['messageType'])=='image')
                                        <img height="100%" width="100%" src="{{ Storage::disk('spaces')->url('thumbs/'.$messages[$m]['imageUrl']) }}"/>
                                        @else
                                        <p>{{ $messages[$m]['message'] }}</p>

                                        @endif
                                        <p class="text-right">
                                        @php
                                        $date = Carbon\Carbon::parse($messages[$m]['created_at'],'UTC')->setTimezone('Asia/Kolkata');
                                        @endphp
                                        {{ $date->isoFormat('h:mm a') }}</p>
                                    </div>
                                @else
                                    <div class="recived_msg position-relative mb-3 round-msg">
                                        @if(strtolower($messages[$m]['messageType'])=='image')
                                        <img height="100%" width="100%" src="{{ Storage::disk('spaces')->url('thumbs/'.$messages[$m]['imageUrl']) }}"/>
                                        @else
                                        <p>{{ $messages[$m]['message'] }}</p>

                                        @endif
                                        <p class="text-right">
                                        @php
                                        $date = Carbon\Carbon::parse($messages[$m]['created_at'],'UTC')->setTimezone('Asia/Kolkata');
                                        @endphp
                                        {{ $date->isoFormat('h:mm a') }}</p>
                                    </div>
                                @endif
                            @endfor
                            <!-- <div class="send_msg position-relative p-md-4 p-3 mb-3">
                                <p> Hi Doctor, I just want to thank you for your help. Because of you, I’m now feeling way better. Can I book a follow up?
                                </p>
                            </div>
                            <div class="recived_msg position-relative mb-3">
                                <p>Glad, I can be of any help to you</p>
                            </div>
                            <div class="recived_msg position-relative mb-3 round-msg">
                                <p>Regarding follow up</p>
                            </div>
                            <div class="recived_msg position-relative mb-3">
                                <p>Sure, No problem</p>
                            </div> -->
                        </div>
                        @if($user)
                        <div class="send_msg_box position-relative">
                            <div class="form-group p-0 d-flex align-items-center mb-0">

                                <input class="form-control pl-0 border-0 pr-50" type="" name="" placeholder="Write your message here…" id="message">
                               @php
                                $mytime = Carbon\Carbon::now()->setTimezone('Asia/Kolkata');


                               @endphp

                                <input type="hidden" name="time" id="time"  value="{{$mytime->isoFormat('h:mm a')}}"/>
                                <div class="img-wrapper" id="send" data-request_id="0" data-receiverid="{{ ($receiverId)?$receiverId:'' }}" data-senderid="{{ Auth::user()->id }}">

                                    <label for="image_uploads" class="img-upload-btn"><i class="fas fa-camera"></i> </label>

                                    <form action="{{ url('api/upload-image') }}" id="upload_image_form" method="POST" enctype="multipart/form-data">
                                        <input type="file" name="image" id="image_uploadsid" accept="image/*">
                                    </form>

                                 </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.4/socket.io.js"></script>
    <script src="{{ asset('assets/iedu/js/emojionearea.js')}}"></script>
<script>
    let senderChatId = null,request_id=null,receiverIdChat=null;
var message = document.querySelector("#message");
        var handle = document.querySelector("#handle");
        var btn = document.querySelector("#send");
        var output  = document.querySelector("#output");
        var feedback  = document.querySelector("#feedback");
        if(btn!==null){
            senderChatId = btn.getAttribute('data-senderid');
            request_id = btn.getAttribute('data-request_id');
            receiverIdChat = btn.getAttribute('data-receiverid');
        }
        let image_name = null;
        var time = document.querySelector("#time");
// $("a[href='{{ url('/user/chat/iedu') }}']").closest("li").addClass("active");
        // $("#message").emojioneArea({
        //     pickerPosition: "bottom",
        //     filtersPosition: "bottom",
        //     tonesStyle: "checkbox",
        //     events: {
        //         keyup: function(editor, event) {
        //             // alert(event.which);
        //             if(event.which == 13)
        //             {
        //                 var _data = $("#message").emojioneArea().data("emojioneArea").getText();
        //                 if(_data){
        //                     // console.log(_data);
        //                     // console.log(res.status);
        //                     $("#output").append('<div class="send_msg position-relative p-3 mb-3 round-msg"><p>'+ _data + '</p><p class="text-right">'+ time.value + '</p> </div>');
        //                     // message.value = '';
        //                     $("#message").emojioneArea().data("emojioneArea").setText('');
        //                     $(".chat_box_wrapper").stop().animate({ scrollTop: $(".chat_box_wrapper")[0].scrollHeight}, 1000);
        //                     socket.emit('sendMessage', {
        //                         message:_data,
        //                         time:time,
        //                         senderId:senderChatId,
        //                         messageType:'TEXT',
        //                         imageUrl:'',
        //                         receiverId:receiverIdChat,
        //                         request_id:request_id
        //                     },function(res){
        //                     // console.log(_data);
        //                        console.log(res);
        //                         if(res.status=='REQUEST_COMPLETED')
        //                             console.log(res.status);
        //                         else if(res.status=='MESSAGE_SENT'){
        //                             // console.log(res.status);
        //                             // $("#output").append('<div class="send_msg position-relative p-3 mb-3 round-msg"><p>'+ _data + '</p><p class="text-right">'+ time.value + '</p> </div>');
        //                             // // message.value = '';
        //                             // $("#message").emojioneArea().data("emojioneArea").setText('');
        //                             // $(".chat_box_wrapper").stop().animate({ scrollTop: $(".chat_box_wrapper")[0].scrollHeight}, 1000);
        //                            // location.reload();
        //                         }else{
        //                             console.log(res.status);
        //                         }
        //                     });
        //                 }
        //             }

        //         }
        //     }
        // });





        //Query DOM


        $(document).ready(function(){
            $('#output').animate({ scrollTop: $('#output')[0].scrollHeight}, 100);
        })

        //Emit event
        // btn.addEventListener("click", function () {

        // });

        message.addEventListener("keyup", function (e) {
            if(e.which == 13)
            {
                var _data = message.value;
                if(_data){
                    var timeCurrent = moment().format('hh:mm A');
                    $("#output").append('<div class="send_msg position-relative p-3 mb-3 round-msg"><p>'+ _data + '</p><p class="text-right">'+ timeCurrent + '</p> </div>');
                    message.value = '';
                    $(".chat_box_wrapper").stop().animate({ scrollTop: $(".chat_box_wrapper")[0].scrollHeight}, 1000);
                    socket.emit('sendMessage', {
                        message:_data,
                        time:time,
                        senderId:senderChatId,
                        messageType:'TEXT',
                        imageUrl:'',
                        receiverId:receiverIdChat,
                        request_id:request_id
                    },function(res){
                       console.log(res);
                        if(res.status=='REQUEST_COMPLETED')
                            console.log(res.status);
                        else if(res.status=='MESSAGE_SENT'){
                        }else{
                            console.log(res.status);
                        }
                    });
                }
            }
        });

        //Listen event

        socket.on("typing", function (data) {
                console.log('typing....');
        });
        $("#image_uploadsid").change(function(e){
             $('#upload_image_form').submit();
        });
        $('#upload_image_form').submit(function(e) {

             e.preventDefault();

            var formData = new FormData(this);
            var timeCurrent = moment().format('hh:mm A');

            $.ajax({
                type:'POST',
                url: $(this).attr('action'),
                data:formData,
                cache:false,
                contentType: false,
                processData: false,
               success:function(data){
                   //console.log(data.data.image_name);
                    image_name = data.data.image_name;
                    socket.emit('sendMessage', {
                        message:null,
                        time:time,
                        imageUrl:image_name,
                        messageType:'IMAGE',
                        senderId:senderChatId,
                        receiverId:receiverIdChat,
                        request_id:request_id
                    },function(res){
                        console.log('data-------');
                        console.log(res);

                        if(res.status=='REQUEST_COMPLETED')
                            alert(res.message);
                        else if(res.status=='MESSAGE_SENT'){

                            $("#output").append('<div class="send_msg position-relative p-3 mb-3 round-msg"><img height="100%" width="100%" src="'+ storage_url+image_name+ '"/><p class="text-right">'+ timeCurrent +'</p> </div>');
                        }else{
                            alert(res.message);
                        }
                        $('#output').animate({ scrollTop: $('#output')[0].scrollHeight}, 100);
                    });
               },error:function(data){
                    // alert(data.message);
               }
            });

        });



         $(function () {
             function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#profile-img-tag').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
        });

        $('.searchInput').on('keyup',function(e)
        {
            e.preventDefault();
            var searchVal = $(this).val();
            var v_token = "{{csrf_token()}}";
            $.get(base_url + '/chat/search', {
                "_token": v_token,
                "searchVal": searchVal
            }).done(function(data){
                console.log(data);
            });


        });

  </script>

@endsection
