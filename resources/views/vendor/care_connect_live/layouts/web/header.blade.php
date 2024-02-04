 <!-- header -->
 @if(Config('client_connected') && Config::get('client_data')->domain_name == 'hexalud')
 <style>
    .top-header{
        background-color: #eaeaea !important;
    }
    .user-option li i, .notification-list li i{
        color: #eaeaea !important;
    }
    .border-btn{
        border:#eaeaea !important;
    }
    .border-btn span{
        border:#eaeaea !important;
    }
    .default-btn{
        background-color: #000 !important;
    }
    .more_review{
        color: #eaeaea !important;
    }
    .copyright-text{
        background-color: #eaeaea !important;
    }
    .default-btn:before, .default-btn:after{
        color: #000;
    }
    section.bannerSection.dr-slider{
        margin-top: 160px;

    }
    .tab-pane .availability{
        color: #00C46B !important;
    }
    .navigation-wrap .navbar-nav .nav-link{
        color: #000 !important;
    }
    .fa-comment-dots{
        display: none;
    }
 </style>
 {{--  background-color: #00C46B !important;  --}}
 @endif
 <header class="top-header">
    <div class="navigation-wrap">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="navbar navbar-expand-lg px-0">

                    @if(Config('client_connected') && Config::get('client_data')->domain_name == 'iedu')
                        @php $currency = 'AED';  @endphp
                    @elseif(Config('client_connected') && Config::get('client_data')->domain_name == 'hexalud')
                        @php $currency = '$';  @endphp
                    @else
                        @php $currency = '₹'; @endphp
                    @endif

                    @if(Auth::check())
                        @if(Auth::user()->hasrole('customer') && Auth::user()->profile)
                        <a class="navbar-brand" href="{{ url('/user/patient') }}">
                            @if(Config('client_connected') && Config::get('client_data')->domain_name == 'tele')
                                {{--  <h3 style="color:white;">Telegreen</h3>  --}}

                                <img src="{{ asset('assets/tele/images/telegreen.png') }}" alt="" style="height:55px;">
                            @elseif(Config('client_connected') && Config::get('client_data')->domain_name == 'hexalud')
                                {{--  <h3 style="color:white;">Hexalud</h3>  --}}

                                <img src="{{ asset('assets/hexalud/images/ic_logo-new_expert.png') }}" alt="" style="height:55px;">
                                <span style="    display: inline-block;color: #00C46B;padding-left: 10px;font-size: 22px;font-weight: 600;">Hexalud</span>
                            @else
                                <h3 style="color:white;">Consultant</h3>
                            @endif
                            <!-- <img src="{{ asset('assets/care_connect_live/images/ic_logo-new.png') }}" alt=""> -->
                        </a>
                        @endif
                        @if(Auth::user()->hasrole('service_provider') && Auth::user()->profile)
                        <a class="navbar-brand" href="{{ url('/user/requests') }}">
                            @if(Config('client_connected') && Config::get('client_data')->domain_name == 'telegreen')
                                <h3 style="color:white;">Telegreen</h3>
                            @elseif(Config('client_connected') && Config::get('client_data')->domain_name == 'hexalud')
                                {{--  <h3 style="color:white;">Hexalud</h3>  --}}
                                <img src="{{ asset('assets/hexalud/images/Group 14@2x.png') }}" alt="" style="height:55px;">
                                <span style="    display: inline-block;color: #00C46B;padding-left: 10px;font-size: 22px;font-weight: 600;">Hexalud</span>
                            @else
                                <h3 style="color:white;">Consultant</h3>
                            @endif
                            <!-- <img src="{{ asset('assets/care_connect_live/images/ic_logo-new.png') }}" alt=""> -->
                        </a>
                        @endif
                        @if(Auth::user()->hasrole('customer') && !Auth::user()->profile)
                        {{-- <a class="navbar-brand" href="{{ url('/') }}"> --}}
                        <h3 style="color:white;">Consultant</h3>
                            <!-- <img src="{{ asset('assets/care_connect_live/images/ic_logo-new.png') }}" alt=""></a> -->
                        @endif
                    @else
                            <a class="navbar-brand" href="{{ url('/') }}">
                            <h3 style="color:white;">Consultant</h3>
                            <!-- <img src="{{ asset('assets/care_connect_live/images/ic_logo-new.png') }}" alt=""> -->
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
                                        @if(Auth::user()->hasrole('customer'))
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{url('/user/patient')}}">Home</a>
                                        </li>
                                        @else
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{url('/user/requests')}}">Home</a>
                                        </li>
                                        @endif
                                    @else
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{url('/')}}">Home</a>
                                        </li>

                                    @endif



                                        <li class="nav-item">
                                            <a class="nav-link" href="#">Ask Free Questions</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{url('user/appointments')}}">Appointments</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{url('user/chat')}}">Chats</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#"><span>{{$currency}} @if(Auth::user()->wallet) {{ Auth::user()->wallet->balance}} @endif</span></a>
                                        </li>
                                    </ul>
                            </div>

                            <ul class="navbar-nav ml-auto">
                                @if(Config('client_connected') && Config::get('client_data')->domain_name == 'tele' || Config('client_connected') && Config::get('client_data')->domain_name == 'hexalud')
                                @else
                                <li class="nav-item mt-1">
                                    <a class="nav-link" href=""><i class="far fa-comment-dots text-white"
                                            style="font-size: 24px;"></i>
                                    </a>
                                </li>
                                @endif
                                @php
                                $notifications = App\Notification::where('receiver_id',Auth::user()->id)
	    	                    ->orderBy('id', 'desc')->take('3')->get();


                                @endphp
                                <li class="nav-item mt-1 position-relative noti-bar">
                                    <a class="nav-link pr-0" href="#"><i class="far fa-bell"
                                            style="font-size: 24px;"></i></a>
                                    <span class="notify-no position-absolute">{{$notifications->count()}}</span>
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
                                            <a class="nt-view" href="{{url('user/notifications')}}">View all <i class="fas fa-chevron-right"></i></a>

                                    </ul>
                                </li>
                                <li class="mt-1 pl-4">
                                    @if(Auth::user()->profile_image)
                                    <a class="user-icon d-flex align-items-center" href="javascript:void(0)">
                                        <img src="{{ Storage::disk('spaces')->url('thumbs/'.Auth::user()->profile_image) }}" alt="">
                                        <i class="fas fa-angle-down ml-2 text-white" style="font-size: 24px;"></i>
                                    </a>
                                    @else
                                    <a class="user-icon d-flex align-items-center" href="javascript:void(0)">
                                        <img src="{{asset('assets/care_connect_live/images/ic_upload profile img.png')}}" alt="" height="30px" width="30px">
                                        <i class="fas fa-angle-down ml-2 text-white" style="font-size: 24px;"></i>
                                    </a>
                                    @endif

                                    <ul class="user-option position-absolute">
                                        <li>
                                            @if(Config('client_connected') && (Config::get('client_data')->domain_name == 'tele' || Config::get('client_data')->domain_name == 'hexalud'))
                                            <a href="{{url('/edit/profile')}}">
                                            @else
                                            <a href="{{url('/user/account')}}">
                                            @endif
                                                <i class="far fa-user-circle"></i>
                                                <span>Profile</span>
                                            </a>
                                        </li>
                                        <!-- <li>
                                            <a href="{{ url('user/notifications') }}">
                                                <i class="far fa-bell"></i>
                                                <span>Notifications</span>
                                            </a>
                                        </li> -->
                                        <li>
                                            <a href="{{url('/logout')}}">
                                                <i class="fas fa-sign-out-alt"></i>
                                                <span>Logout</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>

                        @endif

                        @if(!Auth::user())



                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ml-auto py-4 py-md-0">
                                <ul class="navbar-nav">
                                    <li class="nav-item {{ (Request::is('/') && request()->get('tab')=='') ? 'active' : '' }}">
                                        <a class="nav-link" href="{{ url('/') }}">Home</a>
                                    </li>
                                    <li class="nav-item {{ request()->get('tab')=='about'?'active':''  }}">
                                        <a class="nav-link" href="{{ url('/').'?tab=about#about-us' }}">About us</a>
                                    </li>
                                    <li class="nav-item {{ Request::is('web/support') ? 'active' : '' }}">
                                        <a class="nav-link" href="{{ url('web/support') }}">Help & Support</a>
                                    </li>
                                    <li class="nav-item {{ request()->get('tab')=='blog'?'active':''  }}">
                                        <a class="nav-link" href="{{ url('/').'?tab=blog#blogs' }}">Blogs</a>
                                    </li>
                                    <!-- <li class="nav-item {{ Request::is('web/doctors') ? 'active' : '' }}">
                                        <a class="nav-link" href="{{ url('web/doctors') }}">For Doctors</a>
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

                                        <li class="nav-item">
                                            <a class="nav-link" href="{{url('/user/requests')}}">Home</a>
                                        </li>
                                     @endif
                                    @endif
                                    @if(Auth::check() && Auth::user()->account_verified != Null)
                                        <li class="nav-item mr-3">
                                            <a class="nav-link" href="{{url('user/chat')}}">Chats</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{url('service_provider/wallet')}}"><img class="mr-2" src="{{asset('assets/care_connect_live/images/ic_wallet.png')}}" alt=""><span>{{$currency}} @if(Auth::user()->wallet->balance){{Auth::user()->wallet->balance}} @else {{0}} @endif</span></a>
                                        </li>
                                        @php
                                        $notifications = App\Notification::where('receiver_id',Auth::user()->id)
                                        ->orderBy('id', 'desc')->take('3')->get();

                                        @endphp

                                        <li class="nav-item mt-1 position-relative noti-bar">
                                    <a class="nav-link pr-0" href="#"><i class="far fa-bell"
                                            style="font-size: 24px;"></i></a>
                                    <span class="notify-no position-absolute">{{$notifications->count()}}</span>
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
                                            <a class="nt-view" href="{{url('user/notifications')}}">View all <i class="fas fa-chevron-right"></i></a>

                                    </ul>
                                </li>

                                        <li class="mt-1 pl-4">
                                    @if(Auth::user()->profile_image)
                                    <a class="user-icon d-flex align-items-center" href="javascript:void(0)">
                                        <img   src="{{ Storage::disk('spaces')->url('thumbs/'.Auth::user()->profile_image) }}" alt="">
                                        <i class="fas fa-angle-down ml-2 text-white" style="font-size: 24px;"></i>
                                    </a>
                                    @else
                                    <a class="user-icon d-flex align-items-center" href="javascript:void(0)">
                                        <img src="{{asset('assets/care_connect_live/images/ic_upload profile img.png')}}" alt="" height="30px" width="30px">
                                        <i class="fas fa-angle-down ml-2 text-white" style="font-size: 24px;"></i>
                                    </a>
                                    @endif

                                    <ul class="user-option position-absolute">
                                        <li>

                                            <a href="{{url('/service_provider/profile')}}/{{ Auth::user()->id }}">
                                                <i class="far fa-user-circle"></i>
                                                <span>Profile</span>
                                            </a>
                                        </li>

                                            <!-- <li>
                                            <a href="{{ url('expert/notifications') }}">
                                                <i class="far fa-bell"></i>
                                                <span>Notifications</span>
                                            </a>
                                        </li> -->
                                        <li>
                                            <a href="{{url('/logout')}}">
                                                <i class="fas fa-sign-out-alt"></i>
                                                <span>Logout</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                @endif

                                @if(Auth::check() && Auth::user()->account_verified == Null)
                                    <a href="{{url('/logout')}}" style="color:white;">
                                                <i class="fas fa-sign-out-alt"></i>
                                                <span>Logout</span>
                                            </a>
                                @endif

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
      var base_url = "{{ url('/') }}";
      var timeZone = Intl.DateTimeFormat().resolvedOptions().timeZone;
    </script>
