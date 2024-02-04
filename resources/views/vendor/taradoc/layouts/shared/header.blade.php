 <!-- header -->
<header class="top-header" style="background-color:#faf2eb!important;">
    <div class="navigation-wrap">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="navbar navbar-expand-lg px-0">
                        <a class="navbar-brand" style="width:30%;" href="{{ url('/') }}">
                            <img width="205px" src="{{ asset('assets/images/Logo.png') }}" alt="">
                        </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
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
                                    <!--li class="nav-item {{ Request::is('web/doctor') ? 'active' : '' }}">
                                        <a class="nav-link" href="{{ url('web/doctor') }}">For Doctors</a>
                                    </li>
                                    <li class="nav-item {{ Request::is('web/patient') ? 'active' : '' }}">
                                        <a class="nav-link" href="{{ url('web/patient') }}"> For Patients </a>
                                    </li-->
                                </ul>
                        </div>
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