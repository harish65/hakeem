<header class="fixed-top">
      <nav class="navbar navbar-expand-lg navbar-light container">
        <a class="navbar-brand" href="{{ url('/') }}"><img src="{{ asset('assets/heal/images/ic_logo.png') }}"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto display-flex align-items-center">
            <li class="nav-item active">
              <a class="nav-link" href="{{ url('/') }}">Home</a>
            </li>
            <li class="nav-item"> 
              <a class="nav-link" href="{{ route('about-us') }}">About Us</a>            
            </li>
            <li class="nav-item"> 
              <a class="nav-link" href="{{ url('/') }}">Services and Specialities</a>            
            </li>
            <li class="nav-item"> 
              <a class="nav-link" href=""  data-toggle="modal" data-target="#myModal">Heal for patients</a>         
            </li>
            <li class="nav-item"> 
              <a class="nav-link" href="{{ url('register/service_provider') }}">Heal for doctors</a>            
            </li>
            <li class="nav-item"> 
              <a class="nav-link" href="">Contact Us</a>            
            </li>
            <!-- <li class="nav-item"> 
              <a class="nav-link" href="">How we operate</a>            
            </li> -->
            <li class="nav-link">
              <img src="{{ asset('assets/heal/images/ic_language.png') }}">
              <select class="language-btn">
                <option>En</option>
                <option>Fr</option>
                <option>En</option>
                <option>Fr</option>
              </select>
            </li>
          </ul>
      </div>
    </nav>
  </header>