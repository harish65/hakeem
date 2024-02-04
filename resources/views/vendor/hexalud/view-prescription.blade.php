@extends('vendor.hexalud.layouts.dashboard', ['title' => 'Doctor'])
@section('content')
<div class="offset-top"></div>

 <!-- Wallet Section -->
 <section class="Wallet-content py-lg-5 mb-lg-5">
        <div class="container">

            <div class="row">
                <div class="col-lg-4">
                    <div class="bg-them mb-6">
                        <h4 class="border-bottom p-3 mb-2">Menu</h4>
                        <ul class="doctor-list pb-2">
                            <li><a href="{{url('user/doctor')}}"><i class="fas fa-calendar-week"></i> Appointments</a></li>
                            <li><a href="{{url('service_provider/revenue')}}"><i class="fas fa-signal"></i>Revenue</a></li>
                            <li class="active"><a href="{{url('service_provider/prescription')}}"><i class="far fa-list-alt"></i>Prescription</a></li>
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
                </div>
               <div class="col-lg-8">
              </div>
            </div>
            </div>

        </div>


    </section>

@endsection
