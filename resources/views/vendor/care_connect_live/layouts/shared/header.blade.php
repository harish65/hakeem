 <!-- header -->
 <header class="top-header">
    <div class="navigation-wrap">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="navbar navbar-expand-lg px-0">

                    @if(Auth::check())
                        @if(Auth::user()->hasrole('customer') && Auth::user()->profile)
                        <a class="navbar-brand" href="{{ url('/user/patient') }}">
                            <h3 style="color:white;">Consultant</h3>
                            <!-- <img src="{{ asset('assets/care_connect_live/images/ic_logo-new.png') }}" alt=""> -->
                        </a>
                        @endif
                        @if(Auth::user()->hasrole('service_provider') && Auth::user()->profile)
                        <a class="navbar-brand" href="{{ url('/user/requests') }}">
                        <h3 style="color:white;">Consultant</h3>
                            <!-- <img src="{{ asset('assets/care_connect_live/images/ic_logo-new.png') }}" alt=""> -->
                        </a>
                        @endif
                        @if(Auth::user()->hasrole('customer') && !Auth::user()->profile)
                        <a class="navbar-brand" href="{{ url('/') }}">
                        <h3 style="color:white;">Consultant</h3>
                            <!-- <img src="{{ asset('assets/care_connect_live/images/ic_logo-new.png') }}" alt=""></a> -->
                        @endif
                    @else
                            <a class="navbar-brand" href="{{ url('/') }}">
                            <h3 style="color:white;">Consultant</h3>
                            <!-- <img src="{{ asset('assets/care_connect_live/images/ic_logo-new.png') }}" alt=""> -->
                        </a>

                    @endif

                    @if(Config('client_connected') && Config::get('client_data')->domain_name == 'iedu')
                        @php $currency = 'AED';  @endphp
                    @else
                        @php $currency = '₹'; @endphp
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
                                <li class="nav-item mt-1">
                                    <a class="nav-link" href=""><i class="far fa-comment-dots text-white"
                                            style="font-size: 24px;"></i>
                                    </a>
                                </li>
                                <li class="nav-item mt-1 position-relative">
                                    <a class="nav-link pr-0" href="#">
                                        <i class="far fa-bell" style="font-size: 24px;"></i>
                                    </a>
                                    <span class="notify-no position-absolute">4</span>
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
                                            <a href="{{url('/user/')}}">
                                                <i class="far fa-user-circle"></i>
                                                <span>Profile</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ url('user/notifications') }}">
                                                <i class="far fa-bell"></i>
                                                <span>Notifications</span>
                                            </a>
                                        </li>
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

                                        <li class="nav-item mt-1 position-relative">
                                            <a class="nav-link pr-0" href="#"><i class="far fa-bell"
                                                    style="font-size: 24px;"></i></a>
                                            <span class="notify-no position-absolute">3</span>
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

                                            <li>
                                            <a href="{{ url('expert/notifications') }}">
                                                <i class="far fa-bell"></i>
                                                <span>Notifications</span>
                                            </a>
                                        </li>
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
