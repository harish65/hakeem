 <!-- header -->
<header class="top-header">
    <div class="navigation-wrap">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="navbar navbar-expand-lg px-0">
                        <a class="navbar-brand" href="{{ url('/') }}">
                            <img src="{{ asset('assets/healtcaremydoctor/images/ic_logo-new.png') }}" alt="">
                        </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ml-auto py-4 py-md-0">
                                <ul class="navbar-nav">
                                    <li class="nav-item active">
                                        <a class="nav-link" href="{{ url('/') }}">Home</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ url('/').'#about-us' }}">About us</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ url('web/support') }}">Help and Support</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ url('/').'#blogs' }}">Blogs</a>
                                    </li>
                                </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>