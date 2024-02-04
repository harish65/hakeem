@extends('vendor.iedu.layouts.index', ['title' => 'Notifications'])
@section('content')
<style>
ul>li
{
    list-style:none;
}
</style>
@php
    if(isset($_COOKIE['royo_timZone'])) 
        $timeZone = $_COOKIE['royo_timZone']; 
    else
        $timeZone = 'Asia/Calcutta';
@endphp
<section class="study-material booking-request">
        <div class="container">
            <div class="row">
                <div class="col-12 mb-3">
                    <h3 class="">Notifications</h3>
                </div>
                <div class="col-lg-12 border-out">
                    @if(sizeof($notifications)>0)
                        @foreach($notifications as $notify)
                            <ul class="notification-list border-bottom mb-4 pb-4 d-flex align-items-center" style="background-color:light-grey; width:100%">
                                <li class="left-icon">
                                @if($notify->form_user->profile_image == '' &&  $notify->form_user->profile_image == null)
                                 <img src="{{asset('assets/iedu/images/dummy_profile.webp')}}" alt="" height="50px" width="50px">
                                 @else
                                 <img src="{{Storage::disk('spaces')->url('uploads/'.$notify->form_user->profile_image)}}" alt="" height="50px" width="50px">
                                @endif
                                </li>
                                <li class="right-text position-relative text_16 ml-2">
                                <p class="text-heading">{{ ucwords($notify->form_user->name) }}</p>
                                <p class="text-pera">
                                    @if($notify->pushType=='BOOKING_RESERVED' || $notify->pushType=='CALL_ACCEPTED' || $notify->pushType=='NEW_REQUEST')
                                        <a href="{{ url('user/appointments') }}">{{ $notify->message }}</a>
                                    @else
                                        {{ $notify->message }}
                                    @endif
                                </p>
                                <span class="position-link">{{ \Carbon\Carbon::parse($notify->created_at)->setTimeZone($timeZone)->diffForHumans() }}</span></li>
                            </ul>
                        @endforeach

                        {{ $notifications->links() }}
                    @else
                    <ul class="notification-list border-bottom mb-4 pb-4 d-flex align-items-center" style="background-color:light-grey; width:100%">
                    <li class="right-text position-relative text_16">  {{'No Record'}} </li>
                    </ul>

                    @endif

                   
                </div>
            </div>
        </div>
    </section>
@endsection