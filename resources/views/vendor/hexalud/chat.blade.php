@extends('vendor.hexalud.layouts.dashboard', ['title' => 'Patient'])
@section('content')
 <!-- Offset Top -->
 <style>
    .active-users {
        overflow: auto;
        scroll-behavior: smooth;
        max-height: 459px;
        margin-bottom: 0px;
    }
    .send_msg_box .emojionearea.emojionearea-inline {
        height: 34px;
        border: 0px !important;
        outline: none;
        box-shadow: none;
    }
    .send_msg_box input{box-shadow: none;border: 0px;}
    .send_msg_box input:focus{box-shadow: none;border: 0px;}
    .chat_box_wrapper {
        overflow: auto;
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
footer {
    display: none;
}
 </style>
@php
    use app\Model\RequestHistory;

    $timezone = 'Asia/Kolkata';
    if(Config::get("client_data")->domain_name == "hexalud"){
        $timezone='America/Mexico_City';
    }
@endphp
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
                                {{--  <span class="input-group-btn border-right-0">
                                    <button class="btn btn-default pr-0" type="button">
                                        <i class="fas fa-search" style="font-size: 20px;"></i>
                                    </button>
                                </span>  --}}
                                {{--  <input type="text" style="height:38px"
                                    class="form-control placeholder_text text-uppercase pl-1 searchInput"
                                    placeholder="Search">  --}}
                            </div>

                            <ul class="active-users">
                                @foreach($chats as $chat)
                                <?php

                                if($chat->id == request()->get('request_id') )
                                {
                                    $class='active';
                                }
                                else
                                {
                                    $class='';
                                }

                                ?>
                                <li  class={{$class}} >
                                    <a href="{{ url('user/chat').'?request_id='.$chat->id.'&status='.$chat->status }}">
                                    @if(Auth::user()->hasrole('service_provider'))
                                        <ul class="chat-user active d-flex align-items-center justify-content-start">
                                            <li class="doctor_pic">
                                                <img src="{{ Storage::disk('spaces')->url('uploads/'.$chat->from_user->profile_image) }}" alt="">
                                            </li>
                                             <li class="doctor_detail pl-3 active">

                                                <h4>{{ ucwords($chat->from_user->name).' ('.ucwords($chat->status).')' }}</h4>
                                                <p>{{ ($chat->last_message)?$chat->last_message->message:'' }}</p>
                                                <p>  @php
                                                if($chat->last_message){
                                                    $message_created = $chat->last_message->created_at;

                                                    $msg_date = Carbon\Carbon::parse($message_created,'UTC')->setTimezone($timezone);
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
                                                <img src="{{ Storage::disk('spaces')->url('uploads/'.$chat->to_user->profile_image) }}" alt="">
                                            </li>
                                            <li class="doctor_detail pl-3 active">

                                            <h4>{{ ucwords($chat->to_user->name).' ('.ucwords($chat->status).')' }}</h4>
                                            <p>{{ ($chat->last_message)?$chat->last_message->message:'' }} </p>
                                            <p>  @php
                                            if($chat->last_message){
                                                $message_created = $chat->last_message->created_at;
                                                $msg_date = Carbon\Carbon::parse($message_created,'UTC')->setTimezone($timezone);
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
                                @if($request_dt)
                                <img src="{{ Storage::disk('spaces')->url('uploads/'.$request_dt->cus_info->profile_image) }}" alt="">
                                @endif
                            </li>
                            <li class="doctor_detail pl-3">
                                <h4>{{ ($request_dt)? ucwords($request_dt->cus_info->name):'' }}</h4>
                                <div class="">
                                </div>
                            </li>
                        </ul>


                    @else

                    <ul class="chat-user border-bottom d-flex align-items-center justify-content-start">
                            <li class="doctor_pic">
                                @if($request_dt)
                                <img src="{{ Storage::disk('spaces')->url('uploads/'.$request_dt->sr_info->profile_image) }}" alt="">
                                @endif
                            </li>
                            <li class="doctor_detail pl-3">
                                <h4>{{ ($request_dt)?ucwords($request_dt->sr_info->name):'' }}</h4>
                                <div class="">
                                </div>
                            </li>

                        </ul>

                    @endif


                        <div class="chat_box_wrapper" id="output">
                            <!-- <div class="day_title text-center mb-4 pb-2">Fri · May 12</div> -->

                            @for($m = count($messages)-1; $m>=0 ;$m--)
                                @if($messages[$m]['sender'])
                                    <div class="send_msg position-relative  p-3 mb-3 round-msg">
                                        @if(strtolower($messages[$m]['messageType'])=='image')
                                        <img height="100%" width="100%" src="{{ Storage::disk('spaces')->url('thumbs/'.$messages[$m]['imageUrl']) }}"/>
                                        @else
                                        <p>{{ $messages[$m]['message'] }}</p>

                                        @endif
                                        <p class="text-right">
                                        @php
                                        $date = Carbon\Carbon::parse($messages[$m]['created_at'],'UTC')->setTimezone($timezone);
                                        @endphp
                                        {{ $date->isoFormat('h:mm a') }}</p>
                                    </div>
                                @else
                                    <div class="recived_msg position-relative p-3 mb-3 round-msg">
                                        @if(strtolower($messages[$m]['messageType'])=='image')
                                        <img height="100%" width="100%" src="{{ Storage::disk('spaces')->url('thumbs/'.$messages[$m]['imageUrl']) }}"/>
                                        @else
                                        <p>{{ $messages[$m]['message'] }}</p>

                                        @endif
                                        <p class="text-right">
                                        @php
                                        $date = Carbon\Carbon::parse($messages[$m]['created_at'],'UTC')->setTimezone($timezone);
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
                        @php
                            $sat=RequestHistory::where('request_id',$request_dt->id ?? 0)->value('status');
                        @endphp
                        <div class="send_msg_box position-relative">
                            <div class="form-group p-0 d-flex align-items-center mb-0">
                                @if(request()->status!='completed' && $sat !='completed')
                                    @if($sat!='completed' && $sat!=null  && $sat!='')
                                        <input class="form-control border-0" type="" name="" placeholder="Write your message here…" id="message">
                                     {{--  @else
                                        <input class="form-control border-0" type="" name="" placeholder="Write your message here…" id="message" disabled>  --}}
                                    @endif
                                {{--  @else
                                    <input class="form-control border-0" type="" name="" placeholder="Write your message here…" id="message" disabled>  --}}
                                @endif
                               @php
                                $mytime = Carbon\Carbon::now()->setTimezone($timezone);

                               @endphp
                               @if(request()->status!='completed' && $sat !='completed')
                                    @if($sat!='completed' && $sat!=null  && $sat!='')
                                        <input type="hidden" name="time" id="time"  value="{{$mytime->isoFormat('h:mm a')}}"/>
                                        <div class="img-wrapper" id="send" data-request_id="{{ ($request_dt)?$request_dt->id:'' }}" data-receiverid="{{ ($request_dt)?$request_dt->receiverId:'' }}" data-senderid="{{ Auth::user()->id }}">
                                            <label for="image_uploads" class="img-upload-btn"><i class="fas fa-camera"></i> </label>
                                            <form enctype="multipart/form-data" id="upload_image_form" action="javascript:void(0)">
                                                <input type="file" id="image_uploads" name="image" accept=".jpg, .jpeg, .png" style="opacity: 0;">
                                                <button type="submit" class="btn btn-primary" style="display: none;">Submit</button>
                                            </form>
                                        </div>
                                    @endif

                                 @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.4/socket.io.js"></script>
    <script src="{{ asset('assets/hexalud/js/emojionearea.js')}}"></script>
    <script type="text/javascript">

        $("a[href='{{ url('/user/chat') }}']").closest("li").addClass("active");
        $("#message").emojioneArea({
            pickerPosition: "bottom",
            filtersPosition: "bottom",
            tonesStyle: "checkbox",
            events: {
                keyup: function(editor, event) {
                    // alert(event.which);
                    if(event.which == 13)
                    {
                        var _data = $("#message").emojioneArea().data("emojioneArea").getText();
                        // console.log(_data);

                        socket.emit('sendMessage', {
                            message:_data,
                            time:time,
                            messageType:"TEXT",
                            senderId:senderId,
                            receiverId:receiverId,
                            request_id:request_id
                        },function(res){
                           // console.log(res);
                            if(res.status=='REQUEST_COMPLETED')
                                alert(res.message);
                            else if(res.status=='MESSAGE_SENT'){
                                $("#output").append('<div class="send_msg position-relative p-3 mb-3 round-msg"><p>'+ _data + '</p><p class="text-right">'+ time.value + '</p> </div>');
                                // message.value = '';
                                $("#message").emojioneArea().data("emojioneArea").setText('');
                                $(".chat_box_wrapper").stop().animate({ scrollTop: $(".chat_box_wrapper")[0].scrollHeight}, 1000);
                               // location.reload();
                            }else{
                                alert(res.message);
                            }
                        });
                    }

                }
            }
        });





        //Query DOM
        var message = document.querySelector("#message");
        console.log("============>",message)
        var handle = document.querySelector("#handle");
        var btn = document.querySelector("#send");
        var output  = document.querySelector("#output");
        var feedback  = document.querySelector("#feedback");
        let senderId = btn.getAttribute('data-senderid');
        let receiverId = btn.getAttribute('data-receiverid');
        let request_id = btn.getAttribute('data-request_id');
        let image_name = null;
        var time = document.querySelector("#time");

        //Emit event
        btn.addEventListener("click", function () {

        });

        message.addEventListener("keypress", function (e) {
            console.log("e",e)
            if(e.which == 13) {
                socket.emit('sendMessage', {
                    messageType:'TEXT',
                    message:message.value,
                    senderId:senderId,
                    receiverId:receiverId,
                    request_id:request_id
                },function(res){
                    if(res.status=='REQUEST_COMPLETED')
                        alert(res.message);
                    else if(res.status=='MESSAGE_SENT'){
                        $("#output").append('<div class="send_msg position-relative p-3 mb-3 round-msg"><p>'+ message.value + '</p> </div>');
                        message.value = '';
                        location.reload();
                    }else{
                        alert(res.message);
                    }
                });
            }
            // socket.emit("typing", handle.value);
        });

        //Listen event


        socket.on("typing", function (data) {
                console.log('typing....');
        });
        $("#image_uploads").change(function(e){
             $('#upload_image_form').submit();
        });
        $('#upload_image_form').submit(function(e) {
             e.preventDefault();
             var formData = new FormData(this);
             $.ajax({
                type:'POST',
                url:base_url+'/api/upload-image',
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
                        senderId:senderId,
                        receiverId:receiverId,
                        request_id:request_id
                    },function(res){
                        if(res.status=='REQUEST_COMPLETED')
                            alert(res.message);
                        else if(res.status=='MESSAGE_SENT'){
                            $("#output").append('<div class="send_msg position-relative p-3 mb-3 round-msg"><img height="100%" width="100%" src="'+ storage_url+image_name+ '"/><p class="text-right">'+ time.value +'</p> </div>');
                        }else{
                            alert(res.message);
                        }
                    });
               },error:function(data){
                    alert(data.message);
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
