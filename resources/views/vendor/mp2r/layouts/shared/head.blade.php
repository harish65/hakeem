<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>{{  'Manage Account'}}</title>
    <link rel="shortcut icon" href="images/ic_32.png" type="image/x-icon">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="{{ asset('assets/mp2r/css/slick-theme.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/mp2r/css/slick.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/mp2r/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/mp2r/css/style-2.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/mp2r/css/style-3.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/mp2r/css/loader.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/mp2r/css/fonts-style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/mp2r/css/intlTelInput.css') }}">

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" />
    <link href="{{asset('assets/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    @if(Auth::Check())
        <script type="text/javascript" src="{{ asset('assets/mp2r/js/SendBirdCall.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/mp2r/js/Chart.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/mp2r/js/utils_chart.js') }}"></script>
        <script type="text/javascript">
            var c_user_id = "{{ Auth::user()->id }}";
            var c_user_object = <?php echo json_encode(Auth::user()); ?>;
            SendBirdCall.init('B13514F8-4AB5-4ABA-87D6-C3904DA10C96');
        </script>
    @endif
    @yield('css')
    <script type="text/javascript">
      var base_url = "{{ url('/') }}";
      var timZone = Intl.DateTimeFormat().resolvedOptions().timeZone;
      document.cookie = "timZone="+timZone;
      console.log(document.cookie);
    </script>

</head>