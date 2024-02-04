@extends('vendor.care_connect_live.layouts.dashboard', ['title' => 'Patient'])
@section('content')
<div class="offset-top"></div>
 <!-- Notifications Section -->
 <section class="Notifications-wrapper mb-lg-5 py-5">
        <div class="container">
            <div class="row">
                <div class="col-12 mb-5">
                    <h1>Notifications</h1>
                </div>
                <div class="col-lg-10">
                    @if($notifications)
                        @foreach($notifications as $notify)
                            <ul class="notification-list border-bottom mb-4 pb-4 d-flex align-items-center" style="background-color:light-grey; width:100%">
                                <li class="left-icon">
                                @if($notify->form_user->profile_image == '' &&  $notify->form_user->profile_image == null)
                                 <img src="{{asset('assets/images/ic_upload profile img.png')}}" alt="">
                                 @else
                                 <img src="{{Storage::disk('spaces')->url('uploads/'.$notify->form_user->profile_image)}}" alt="">
                                @endif
                                </li>
                                <li class="right-text position-relative text_16">
                                <p>{{ ucwords($notify->form_user->name) }}</p>
                                <p>{{ $notify->message }}</p><span class="position-absolute">{{ $notify->sent }}</span></li>
                            </ul>
                        @endforeach
                    @endif

                   
                </div>
            </div>
        </div>
    </section>
@endsection