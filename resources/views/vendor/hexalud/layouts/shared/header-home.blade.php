 <!-- header -->
 <header class="top-header">
        <div class="navigation-wrap">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <nav class="navbar navbar-expand-lg px-0 ">
                            <a class="navbar-brand" href="{{url('/home')}}">
                                {{-- <img src="{{ asset('assetss/images/ic_logo.png')}}" alt=""> --}}
                                Hexalud
                            </a>

                            <!--button class="navbar-toggler ml-auto" type="button" data-toggle="collapse"
                                data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>

                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav ml-auto py-4 py-md-0 pr-4">
                                    <ul class="navbar-nav">
                                        <li class="nav-item">
                                            <a class="nav-link" href="#">Home</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#">Ask Free Questions</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#">Appointments</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#">Chats</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#"><span>₹ 2239.00</span></a>
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
                                    <a class="nav-link pr-0" href="#"><i class="far fa-bell"
                                            style="font-size: 24px;"></i></a>
                                    <span class="notify-no position-absolute">3</span>
                                </li>
                                <li class="mt-1 pl-4">
                                    <a class="user-icon d-flex align-items-center" href="javascript:void(0)">
                                        <img src="images/ic_profile-header.png" alt="">
                                        <i class="fas fa-angle-down ml-2 text-white" style="font-size: 24px;"></i>
                                    </a>
                                    <ul class="user-option position-absolute">
                                        <li>
                                            <a href="#">
                                                <i class="far fa-user-circle"></i>
                                                <span>Profile</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="">
                                                <i class="far fa-bell"></i>
                                                <span>Notifications</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="">
                                                <i class="fas fa-sign-out-alt"></i>
                                                <span>Logout</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul-->

                            <ul class="navbar-nav setup-nav ml-auto">
                                <li>
                                    <!-- <span>0% Complete</span> -->
                                </li>
                                <li>
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
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- header -->

