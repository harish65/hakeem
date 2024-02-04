<!-- header -->
 <header class="top-header">
    <div class="navigation-wrap">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="navbar navbar-expand-lg px-0">
<style>
    h1, .heading-32 {
    color: white;
    font-size: 32px;
    font-weight: 600;
    letter-spacing: 0;
    line-height: 40px;
}
.text-white{
    color: #000 !important;
}
    </style>
                    @if(Auth::check())
                        @if(Auth::user()->hasrole('customer') && Auth::user()->profile)
                        <a class="navbar-brand" href="{{ url('/user/patient') }}">
                            {{-- <img src="{{ asset('assets/hexalud/images/ic_logo-new_user.png') }}" alt=""> --}}
                            {{--  <h1>Hexalud</h1>  --}}
                            <img src="{{ asset('assets/hexalud/images/user_hexalud.png') }}" alt="" style="height:55px;">
                            {{-- <span style="    display: inline-block;color: #00C46B;padding-left: 10px;font-size: 22px;font-weight: 600;">Hexalud</span> --}}
                        </a>
                        @endif
                        @if(Auth::user()->hasrole('service_provider') && Auth::user()->profile)
                        <a class="navbar-brand" href="{{ url('/user/doctor') }}">

                            {{--  <h1>Hexalud</h1>  --}}
                            <img src="{{ asset('assets/hexalud/images/Group 14@2x.png') }}" alt="" style="height:55px;">
                            {{--  <span style="    display: inline-block;color: #00C46B;padding-left: 10px;font-size: 22px;font-weight: 600;">Hexalud</span>  --}}
                        </a>
                        @endif
                        @if(Auth::user()->hasrole('customer') && !Auth::user()->profile)
                        <a class="navbar-brand" href="{{ url('/') }}">
                            {{-- <img src="{{ asset('assets/healtcaremydoctor/images/logo_tele1.png') }}" alt=""></a> --}}
                            <span style="    display: inline-block;color: #00C46B;padding-left: 10px;font-size: 22px;font-weight: 600;">Hexalud</span>
                        @endif
                    @else
                            <a class="navbar-brand" href="{{ url('/') }}">
                            {{-- <img src="{{ asset('assets/healtcaremydoctor/images/logo_tele1.png') }}" alt=""> --}}
                            {{--  <h1>Hexalud</h1>  --}}
                            <img src="{{ asset('assets/hexalud/images/user_hexalud.png') }}" alt="" style="height:55px;">
                            {{--  <span style="    display: inline-block;color: #00C46B;padding-left: 10px;font-size: 22px;font-weight: 600;">Hexalud</span>  --}}
                        </a>

                    @endif

                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        @if(Auth::user() && Auth::user()->hasRole('customer') )
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav ml-auto py-4 py-md-0 pr-4">
                                    <ul class="navbar-nav">
                                    @if(Auth::check())

                                        @if(Auth::user()->hasrole('customer') && Auth::user()->profile != null)
                                        <li class="nav-item {{ Request::is('user/patient') ? 'active' : '' }}">
                                            <a class="nav-link menudata" href="{{url('/user/patient')}}">Home</a>
                                        </li>
                                        @endif
                                        @if(Auth::user()->hasrole('service_provider') && Auth::user()->account_verified != null)
                                        <li class="nav-item">
                                            <a class="nav-link menudata" href="{{url('/user/doctor')}}">Home</a>
                                        </li>
                                        @endif
                                    @else
                                        <li class="nav-item {{ Request::is('user/patient') ? 'active' : '' }}">
                                            <a class="nav-link menudata" href="{{url('/')}}">Home</a>
                                        </li>
                                    @endif


                                    @if(Auth::user()->hasrole('customer') && Auth::user()->profile != null)
                                        {{--  <li class="nav-item {{ Request::is('web/ask-question') ? 'active' : '' }}">
                                            <a class="nav-link" href="{{url('web/ask-question')}}">Ask Free Questions</a>
                                        </li>  --}}
                                        <li class="nav-item {{ Request::is('user/appointments') ? 'active' : '' }}">
                                            <a class="nav-link menudata" href="{{url('user/appointments')}}">Appointments</a>
                                        </li>
                                        <li class="nav-item {{ Request::is('user/chat') ? 'active' : '' }}">
                                            <a class="nav-link menudata"  href="{{url('user/chat')}}">Chats</a>
                                        </li>
                                        @endif
                                        <li class="nav-item {{ Request::is('user/wallet') ? 'active' : '' }}">
                                            <a class="nav-link menudata" href="{{url('user/wallet')}}"><img class="mr-2" src="{{asset('assetss/images/ic_wallet.png')}}" alt=""><span>$ @if(Auth::user()->wallet->balance){{Auth::user()->wallet->balance}} @else {{0}} @endif</span></a>
                                        </li>
                                    </ul>
                            </div>

                            <ul class="navbar-nav ml-auto">
                            <!-- <li class="nav-item mt-1">
                                    <a class="nav-link" href=""><i class="far fa-comment-dots text-white"
                                            style="font-size: 24px;"></i>
                                    </a>
                                </li> -->
                            @php
                            $notifications = App\Notification::where('receiver_id',Auth::user()->id)->orderBy('id', 'desc')->take('3')->get();
                            $notification_count = App\Notification::where('receiver_id',Auth::user()->id)->where('read_status','unread')
                                ->count();


                            @endphp
                                <li class="nav-item mt-1 position-relative noti-bar">
                                    <a class="nav-link pr-0" id="ringing_bell_icon" href="#">
                                        <i class="far fa-bell" style="font-size: 24px;"></i>
                                    </a>
                                    <span class="{{$notification_count ? 'notify-no' : ''}} position-absolute" id="user_notification_count">{{$notification_count != 0 ? $notification_count :''}}</span>
                                   @php $value = (Config::get('client_connected') && (Config::get('client_data')->domain_name !=='tele')) @endphp
                                   @if($value == '1')
                                       <ul id="notifications">
                                            <div class="not-head">
                                                <h4>Notifications</h4>
                                                <!-- <a href="#">Clear All</a> -->
                                            </div>
                                            @if($notifications)
                                            @foreach($notifications as $notification)
                                            @php $sender =  \App\User::select('id','name','profile_image')->where('id',$notification->sender_id)->first();
                                            $sentAt = \Carbon\Carbon::parse($notification->created_at)->getPreciseTimestamp(3);
	    			                        $sent = $notification->created_at->diffForHumans();
                                            @endphp
                                            <li>
                                                @if($sender->profile_image == '' || $sender->profile_image == Null)
                                                <img src="{{asset('assets/care_connect_live/images/ic_upload profile img.png')}}" alt="">
                                                @else
                                                <img src="{{ Storage::disk('spaces')->url('thumbs/'.$sender->profile_image) }}" alt="">
                                                @endif
                                                <span>
                                                <h4>{{ucwords($sender->name)}}</h4>
                                                <p>{{$notification->message}}<span class="" style="float:right;">{{ $sent }}</span></p> </span>
                                            </li>
                                            @endforeach
                                            @endif
                                            @if($notifications->count()>1)
                                            <a class="nt-view" href="{{url('user/notifications')}}">View all <i class="fas fa-chevron-right"></i></a>
                                            @else
                                                <h6 class="text-center">No  Notifications</h6>
                                            @endif
                                    </ul>
                                    @endif
                                </li>
                                <li class="mt-1 pl-4 drop2">
                                    @if(Auth::user()->profile_image)
                                    <a class="user-icon d-flex align-items-center" href="javascript:void(0)">
                                        <img src="{{ Storage::disk('spaces')->url('thumbs/'.Auth::user()->profile_image) }}" alt="">
                                        <i class="fas fa-angle-down ml-2 text-white" style="font-size: 24px;"></i>
                                    </a>
                                    @else
                                    <a class="user-icon d-flex align-items-center" href="javascript:void(0)">
                                        <img src="{{asset('assetss/images/ic_upload profile img.png')}}" alt="" height="30px" width="30px">
                                        <i class="fas fa-angle-down ml-2 text-white" style="font-size: 24px;"></i>
                                    </a>
                                    @endif

                                    <ul class="user-option position-absolute">
                                    @if(Auth::user()->hasrole('customer') && Auth::user()->profile != null)
                                        <li class="nav-item {{ Request::is('edit/profile') ? 'active' : '' }}">
                                            <a  class="nav-link" href="{{url('/edit/profile')}}">
                                                <i class="far fa-user-circle"></i>
                                                <span>Profile</span>
                                            </a>

                                        </li>
                                        <!-- <li class="nav-item {{ Request::is('user/notifications') ? 'active' : '' }}">
                                            <a href="{{ url('user/notifications') }}">
                                                <i class="far fa-bell"></i>
                                                <span>Notifications</span>
                                            </a>
                                        </li> -->
                                        @endif
                                        <li class="nav-item {{ Request::is('/logout') ? 'active' : '' }}">
                                            <a  href="{{url('/logout')}}" class="lout nav-link" >
                                                <i class="fas fa-sign-out-alt lout"></i>
                                                <span>Logout</span>
                                            </a>
                                        </li>
                                        <li>


                                        </li>
                                    </ul>
                                </li>
                            </ul>

                        @endif

                        @if(!Auth::user() && (Route::currentRouteName() != 'profile.profileSetupOne' && Route::currentRouteName() != 'profile.profileStepTwo' && Route::currentRouteName() != 'profile.profileStepThree' && Route::currentRouteName() != 'profile.profileStepFour'))

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ml-auto py-4 py-md-0">
                                <ul class="navbar-nav">
                                    <li class="nav-item {{ (Request::is('/') && request()->get('tab')=='') ? 'active' : '' }}">
                                        <a class="nav-link menudata" href="{{ url('/') }}">Home</a>
                                    </li>
                                    <li class="nav-item {{ request()->get('tab')=='about'?'active':''  }}">
                                        <a class="nav-link menudata" href="{{ url('/about') }}" target="_blank">About us</a>
                                    </li>
                                    <li class="nav-item {{ Request::is('web/support') ? 'active' : '' }}">
                                        <a class="nav-link menudata" href="{{ url('web/support') }}">Help & Support</a>
                                    </li>
                                    <li class="nav-item {{ request()->get('tab')=='blog'?'active':''  }}">
                                        <a class="nav-link menudata" href="{{ url('/').'?tab=blogs' }}">Blogs</a>
                                    </li>
                                    <!-- <li class="nav-item {{ Request::is('web/doctors') ? 'active' : '' }}">
                                        <a class="nav-link" href="{{ url('web/doctors') }}">For Experts</a>
                                    </li>
                                    <li class="nav-item {{ Request::is('web/patients') ? 'active' : '' }}">
                                        <a class="nav-link" href="{{ url('web/patients') }}"> For Patients </a>
                                    </li>   -->


                                    <li class="nav-item pl-md-0 ml-0 ml-md-4 d-flex">
                                     @if(Auth::check())

                                       <a>
                                            <span class="profile_image_circle">
                                                <img class="mr-2 profile_image" src="{{Auth::user()->profile_image}}">
                                            </span>
                                            <span></span>
                                        </a>
                                        <a class="headerSignup" href="{{ url('/logout')}}"  style="width:140px;">
                                                Logout
                                            </a>
                                    @else
                                            <a class="headerSignup" href="#" data-toggle="modal" data-target="#users" style="width:140px;">
                                                Login | Signup
                                            </a>
                                    @endif

                                    </li>

                                </ul>
                        </div>

                        @endif

                        @if(Auth::user() && Auth::user()->hasRole('service_provider')  )
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ml-auto py-4 py-md-0">
                                <ul class="navbar-nav">

                                     @if(Auth::check())
                                        @if(Auth::user()->hasrole('service_provider') && Auth::user()->account_verified != null)

                                        <li class="nav-item {{ Request::is('user/doctor') ? 'active' : '' }}">
                                            <a class="nav-link menudata" href="{{url('/user/doctor')}}">Home</a>
                                        </li>
                                     @endif
                                    @endif
                                    @if(Auth::check() && Auth::user()->account_verified != null)
                                        <li class="nav-item mr-3 {{ Request::is('user/chat') ? 'active' : '' }}">
                                            <a class="nav-link menudata" href="{{url('user/chat')}}">Chats</a>
                                        </li>
                                        <li class="nav-item {{ Request::is('service_provider/wallet') ? 'active' : '' }}">
                                            <a class="nav-link menudata" href="{{url('service_provider/wallet')}}"><img class="mr-2" src="{{asset('assetss/images/ic_wallet.png')}}" alt=""><span>$ @if(Auth::user()->wallet->balance){{Auth::user()->wallet->balance}} @else {{0}} @endif</span></a>
                                        </li>

                                        @php
                                        $notifications = App\Notification::where('receiver_id',Auth::user()->id)
                                        ->orderBy('id', 'desc')->take('3')->get();
                                        $notification_count = App\Notification::where('receiver_id',Auth::user()->id)->where('read_status','unread')
                                        ->count();

                                        @endphp

                                        <li class="nav-item mt-1 position-relative noti-bar">
                                    <a class="nav-link pr-0" id="ringing_bell_icon" href="#">
                                        <i class="far fa-bell" style="font-size: 24px;"></i>
                                    </a>
                                    <span class="{{$notification_count ? 'notify-no' : ''}} position-absolute" id="user_notification_count">{{$notification_count != 0 ? $notification_count :''}}</span>
                                    <ul id="notifications">
                                            <div class="not-head">
                                                <h4>Notifications</h4>
                                                <!-- <a href="#">Clear All</a> -->
                                            </div>
                                            @if($notifications)
                                            @foreach($notifications as $notification)
                                            @php $sender =  \App\User::select('id','name','profile_image')->where('id',$notification->sender_id)->first();
                                            $sentAt = \Carbon\Carbon::parse($notification->created_at)->getPreciseTimestamp(3);
	    			                        $sent = $notification->created_at->diffForHumans();
                                            @endphp
                                            <li>
                                                @if($sender->profile_image == '' || $sender->profile_image == Null)
                                                <img src="{{asset('assets/care_connect_live/images/ic_upload profile img.png')}}" alt="">
                                                @else
                                                <img src="{{ Storage::disk('spaces')->url('thumbs/'.$sender->profile_image) }}" alt="">
                                                @endif
                                                <span>
                                                <h4>{{ucwords($sender->name)}}</h4>
                                                <p>{{$notification->message}}<span class="" style="float:right;">{{ $sent }}</span></p> </span>
                                            </li>
                                            @endforeach
                                            @endif
                                            @if($notifications->count()>1)
                                            <a class="nt-view" href="{{url('user/notifications')}}">View all <i class="fas fa-chevron-right"></i></a>
                                            @else
                                                <h6 class="text-center">No  Notifications</h6>
                                            @endif


                                    </ul>
                                </li>


                                   @endif
                                        <li class="mt-1 pl-4">
                                    @if(Auth::user()->profile_image)
                                    <a class="user-icon d-flex align-items-center" href="javascript:void(0)">
                                        <img   src="{{ Storage::disk('spaces')->url('thumbs/'.Auth::user()->profile_image) }}" alt="">
                                        <i class="fas fa-angle-down ml-2 text-white" style="font-size: 24px;"></i>
                                    </a>
                                    @else
                                    <a class="user-icon d-flex align-items-center" href="javascript:void(0)">
                                        <img src="{{asset('assetss/images/ic_upload profile img.png')}}" alt="" height="30px" width="30px">
                                        <i class="fas fa-angle-down ml-2 text-white" style="font-size: 24px;"></i>
                                    </a>
                                    @endif

                                    <ul class="user-option position-absolute">
                                       <!-- Also show when service provider is not verified (Auth::user()->account_verified != null)-->
                                        <li class="nav-item mr-3 {{ Request::is('service_provider/profile/'.Auth::user()->id) ? 'active' : '' }}">

                                            <a class="nav-link" href="{{url('/service_provider/profile')}}/{{ Auth::user()->id }}">
                                                <i class="far fa-user-circle"></i>
                                                <span>Profile</span>
                                            </a>
                                        </li>

                                            <!-- <li class="nav-item {{ Request::is('expert/notifications') ? 'active' : '' }}">
                                            <a class="nav-link" href="{{ url('expert/notifications') }}">
                                                <i class="far fa-bell"></i>
                                                <span>Notifications</span>
                                            </a>
                                        </li> -->

                                        <li class="nav-item {{ Request::is('/logout') ? 'active' : '' }}">
                                            <a href="{{url('/logout')}}" class="lout nav-link" >
                                                <i class="fas fa-sign-out-alt lout"></i>
                                                <span>Logout</span>
                                            </a>
                                        </li>
                                        <!-- <li class="{{ Request::is('/logout') ? 'active' : '' }}">
                                            <a  class="nav-link" class="lout" >
                                                <i class="fas fa-sign-out-alt lout"></i>
                                                <span>Logout</span>
                                            </a>
                                        </li> -->

                                    </ul>
                                </li>
                                </ul>

                            <ul>
                        </div>
                        @endif
                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>
<script>
// Add active class to the current button (highlight it)
var header = document.getElementById("navbarSupportedContent");
var btns = header.getElementsByClassName("nav-item");
for (var i = 0; i < btns.length; i++) {
  btns[i].addEventListener("click", function() {
  var current = document.getElementsByClassName("active");
  current[0].className = current[0].className.replace(" active", "");
  this.className += " active";
  });
}
</script>


<script type="text/javascript">
    function logout(event){
            event.preventDefault();
            var check = confirm("Do you really want to logout?");
            if(check){
                url = '/logout'
              window.location.href = url;
            }
     }
</script>
