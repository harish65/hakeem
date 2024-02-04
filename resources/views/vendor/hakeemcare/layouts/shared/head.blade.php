<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('assets/tele/images/favicon.ico')}}" type="image/x-icon">
    <!-- Bootstrap Css -->
    <link rel="stylesheet" href="{{ asset('assets/tele/css/fontawesome.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/tele/css/slick.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/tele/css/slick-theme.css')}}">
     <link rel="stylesheet" href="{{ asset('assets/tele/css/bootstrap.css')}}">
     <link rel="stylesheet" href="{{ asset('assets/tele/css/emojionearea.css')}}">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link rel="stylesheet" href="{{ asset('assets/tele/css/intlTelInput.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/tele/css/owl.carousel.min.css')}}" />
    <link rel="stylesheet" href="{{ asset('assets/tele/css/owl.theme.default.min.css')}}" />
    <link rel="stylesheet" href="{{ asset('assets/tele/css/style.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/tele/css/style.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/tele/css/responsive.css')}}">
    <link href="{{asset('assets/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>


    <title>Home</title>
    <script type="text/javascript">
      var base_url = "{{ url('/') }}";
      var timeZone = Intl.DateTimeFormat().resolvedOptions().timeZone;
    </script>
    <title>Home</title>
    <style type="text/css">
        span.select2-selection.select2-selection--multiple {
            min-width: 430px;
            min-height: 42px;
        }
        .select2-container .select2-search--inline .select2-search__field {
            margin-top:10px;

        }
        .select2-container--default .select2-selection--multiple{
            border: 1px solid #D8D8D8;
        }
        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
          -webkit-appearance: none;
          margin: 0;
        }

        /* Firefox */
        input[type=number] {
          -moz-appearance: textfield;
        }
    </style>
    @yield('css-script')

</head>
