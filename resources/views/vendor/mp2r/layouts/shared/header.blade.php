@if(!Auth::Check())
<header>
        <div class="navigation-wrap">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <nav class="navbar navbar-expand-lg">

                            <a class="navbar-brand" href="{{ url('/')}}">
                                <img src="{{ asset('assets/mp2r/images/ic_logo.png') }}" alt="">
                            </a>

                            <button class="navbar-toggler" type="button" data-toggle="collapse"
                                data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>

                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav ml-auto py-4 py-md-0">
                                    <!-- <li class="nav-item pl-md-0 ml-0 ">

                                        <div class="outerDiv">
                                            <div class="searchDiv">
                                                <img src="{{ asset('assets/mp2r/images/ic_location.png') }}" alt="">
                                                <select id="">
                                                    @foreach($us_states as $key=>$name)
                                                    <option value="{{ $key }}">{{ $name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="inputDiv">
                                                <img src="{{ asset('assets/mp2r/images/ic_search_grey.png') }}" alt="">
                                                <input type="text" placeholder="Search for Help Now…">
                                            </div>
                                        </div>

                                    </li> -->
                                    <li class="nav-item pl-md-0 ml-0 ml-md-4 d-flex">
                                            @if(Auth::Check())
                                            <a class="headerSignup" href="#"  >
                                                    {{ Auth::user()->name }}
                                            </a>
                                            @else
                                            <a  class="headerSignup" href="#" data-toggle="modal" data-target="#login2">
                                                    Signup
                                            </a>
                                            @endif
                                        @if(Auth::Check())
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                            @csrf
                                            <button type="submit" class="headerLogin">
                                              <span>Logout</span>
                                            </button>
                                        </form>
                                        @else
                                            <a  class="headerLogin" href="#" data-toggle="modal" data-target="#login">
                                                Login
                                            </a>
                                        @endif
                                    </li>
                                </ul>

                            </div>

                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </header>
    @else
    
    <header>
        <div class="navigation-wrap shadow pt-2 pb-3">
            <div class="container">
                
                <div class="row align-items-center ">
                    <div class="col-md-10">
                    <a class="navbar-brand pt-2" href="{{ url('/') }}"> <img src="{{  asset('assets/mp2r/images/ic_logo.png') }}" alt=""></a>
                    @if(Auth::user()->hasrole('service_provider'))
                        <div class="custom-control custom-switch pull-right">
                          <input type="checkbox" class="custom-control-input" id="make_online_offline" data-user="{{ Auth()->user()->id }}" <?php echo (Auth()->user()->manual_available == 1) ? 'checked' : '';?>>
                          <label class="custom-control-label" id="make_online_offline_text" for="make_online_offline"><?php echo (Auth()->user()->manual_available == 1) ? 'Online' : 'Offline';?>
                          </label>
                        </div>

                    @endif
                    
                    </div>
                    <span id="callend" style="display: none"> <img src="{{  asset('assets/mp2r/images/ic_end_call.png') }}" alt=""></span>
                    <div class="col-md-2 col-sm-3 col-6">
                        <div class="row align-items-center pt-2 m-0">
                            @if(Auth::user()->hasrole('service_provider'))
                            <div class="dropdown w-100 chat">
                                <div class="dropdown-toggle d-flex align-items-center" type="button" data-toggle="dropdown" aria-expanded="false">
                                    <div class="profile-img" style="width: 38%;display: inline;">
            
                                        <img src="{{ Auth()->user()->profile_image ? Storage::disk('spaces')->url('thumbs/'.Auth()->user()->profile_image):asset('assets/mp2r/images/default.png') }}" class="img-fluid" style="height: 40px;width: 40px;border-radius: 50%;">
                                    </div>
                                    <div class="text-profile">
                                        <a href="#" class="text-dark auter-name2">{{ Auth()->user()->name }}</a>
                                        <p class="auter-name" style="">{{ (Auth::user()->getCategoryData(Auth::user()->id))?Auth::user()->getCategoryData(Auth::user()->id)->name:'NA'}} </p>
                                   
									  <hr class="my-1">
									<p  class="auther-qualification"style="">{{ Auth()->user()->manual_available == 1 ? 'Available' : 'Unavailable' }}</p>
									
                                        
                                    </div>   
									
                                    <ul class="dropdown-menu menu-width" role="menu" style="">

                                     
                                        <li><a class="service_provider_href" href="javascript:void(0)" data-target="{{ url('Sp/manage_availibilty_new?tab=profile_detail')}}"><img src="{{ asset('assets/mp2r/images/ic_account.png') }}" class="px-3">Manage Account</a>
                                        </li>
                                        <li><a class="service_provider_href" href="javascript:void(0)" data-target="{{ url('Sp/manage_availibilty_new?tab=notification')}}"><img src="{{ asset('assets/mp2r/images/ic_notification2.png') }}" class="px-3"> Notifications</a></li>
                                        <li><a class="service_provider_href" href="javascript:void(0)" data-target="{{ route('logout') }}"><img src="{{ asset('assets/mp2r/images/ic_logout.png') }}" class="px-3">Logout</a></li>
                                    </ul>
                                </div>
								 
                            </div>
                            @endif
                            @if(Auth::user()->hasrole('customer'))

                            <div class="dropdown  chat">
                                <div class="dropdown-toggle d-flex align-items-center" type="button" data-toggle="dropdown" aria-expanded="false">
                                    <div class="profile-img" style="width: 38%;display: inline;">
            
                                        <img src="{{ Auth()->user()->profile_image ? Storage::disk('spaces')->url('thumbs/'.Auth()->user()->profile_image):asset('assets/mp2r/images/default.png') }}" class="img-fluid" style="height: 40px;width: 40px;border-radius: 50%;">
                                    </div>
                                    <div class="text-profile" style="display: inline;white-space: nowrap;width: 115px;overflow: hidden;text-overflow: ellipsis;">
                                        <a href="#" class="text-dark">{{ Auth()->user()->name }}</a>

                                    </div>   
                                    <ul class="dropdown-menu menu-width" role="menu" style="">

                                     
                                        <li><a  class="service_provider_href" href="javascript:void(0)" data-target="{{ url('user/account')}}"><img src="{{ asset('assets/mp2r/images/ic_account.png') }}" class="px-3">Account</a>
                                        </li>
                                        <li><a class="service_provider_href" href="javascript:void(0)" data-target="{{ url('user/account')}}"><img src="{{ asset('assets/mp2r/images/ic_notification2.png') }}" class="px-3">Notifications</a></li>
                                        <li><a class="service_provider_href" href="javascript:void(0)" data-target="{{ route('logout') }}"><img src="{{ asset('assets/mp2r/images/ic_logout.png') }}" class="px-3">Logout</a></li>
                                    </ul>
                                </div>
                            </div>

                            @endif
                        </div> 
                    </div>   
                </div>
            </div>
        </div>
    </header>
     @endif