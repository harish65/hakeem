@extends('vendor.912consult.layouts.dashboard', ['title' => 'Doctor'])
@section('content')
<div class="offset-top"></div>
  <!-- Chats Section -->
  <section class="appointments-content py-lg-5 mb-lg-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1>Chats</h1>
                </div>
            </div>

            <div class="message_wrapper bg-them mt-lg-5 mt-4">
                <div class="row no-gutters">
                    <div class="col-md-4 border-right">
                        <div class="chat_box">
                            <div class="input-group custom_search_form position-relative border-bottom">
                                <span class="input-group-btn border-right-0">
                                    <button class="btn btn-default pr-0" type="button">
                                        <i class="fas fa-search" style="font-size: 20px;"></i>
                                    </button>
                                </span>
                                <input type="text"
                                    class="form-control border-left-0 placeholder_text text-uppercase pl-1"
                                    placeholder="Search">
                            </div>

                            <ul class="active-users">
                                <li class="active">
                                    <a href="#">
                                        <ul class="chat-user active d-flex align-items-center justify-content-start">
                                            <li class="doctor_pic">
                                                <img src="images/ic_prof-medium@2x.png" alt="">
                                            </li>
                                            <li class="doctor_detail pl-3">
                                                <h4>Dr. Jack Wilson</h4>
                                                <p>Sure, No Problem</p>
                                            </li>
                                        </ul>
                                    </a>
                                </li>

                                <li>
                                    <a href="#">
                                        <ul class="chat-user d-flex align-items-center justify-content-start">
                                            <li class="doctor_pic">
                                                <img src="images/ic_prof-medium@2x.png" alt="">
                                            </li>
                                            <li class="doctor_detail pl-3">
                                                <h4>Dr. Steve Curry</h4>
                                                <p>Sure, No Problem</p>
                                            </li>
                                        </ul>
                                    </a>
                                </li>

                                <li>
                                    <a href="#">
                                        <ul class="chat-user d-flex align-items-center justify-content-start">
                                            <li class="doctor_pic">
                                                <img src="images/ic_prof-medium@2x.png" alt="">
                                            </li>
                                            <li class="doctor_detail pl-3">
                                                <h4>Dr. Amanda Nunez</h4>
                                                <p>Sure, No Problem</p>
                                            </li>
                                        </ul>
                                    </a>
                                </li>

                                <li>
                                    <a href="#">
                                        <ul class="chat-user d-flex align-items-center justify-content-start">
                                            <li class="doctor_pic">
                                                <img src="images/ic_prof-medium@2x.png" alt="">
                                            </li>
                                            <li class="doctor_detail pl-3">
                                                <h4>Dr. Jack Wilson</h4>
                                                <p>Sure, No Problem</p>
                                            </li>
                                        </ul>
                                    </a>
                                </li>
                            </ul>


                        </div>
                    </div>
                    <div class="col-md-8 border-left-0 chat-right">

                        <ul class="chat-user border-bottom d-flex align-items-center justify-content-start mb-4">
                            <li class="doctor_pic">
                                <img src="images/ic_prof-medium@2x.png" alt="">
                            </li>
                            <li class="doctor_detail pl-3">
                                <h4>Dr. Jack Wilson</h4>
                            </li>
                        </ul>

                        <div class="chat_box_wrapper">
                            <div class="day_title text-center mb-4 pb-2">Fri · May 12</div>
                            <div class="send_msg position-relative p-md-4 p-3 mb-3">
                                <p>Hi Stella, Let me know what kind of problem are you facing? I’m here to help. First start by telling me your recent history with medications and all.</p>
                            </div>
                            <div class="recived_msg position-relative mb-3">
                                <p>Hi Doctor</p>
                            </div>
                            <div class="recived_msg position-relative mb-3 round-msg">
                                <p>Yeah. In past 6 months, probably 2 or 3 times</p>
                            </div>
                            <div class="recived_msg position-relative mb-3">
                                <p>But recently started facing some issues with health.</p>
                            </div>
                        </div>
                        <div class="send_msg_box position-relative">
                            <div class="form-group p-0 d-flex align-items-center mb-0">
                                <i class="far fa-smile" style="font-size: 20px;"></i>
                                <input class="form-control border-0" type="" name="" placeholder="Write your message here…">

                                <div class="img-wrapper">
                                    <label for="image_uploads" class="img-upload-btn"><i class="fas fa-camera"></i> </label>
                                    <input type="file" id="image_uploads" name="image_uploads" accept=".jpg, .jpeg, .png" style="opacity: 0;">
                                 </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endsection
