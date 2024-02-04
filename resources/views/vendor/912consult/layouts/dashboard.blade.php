<!DOCTYPE html>
<html lang="en">
    <head>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.js" integrity="sha512-bUg5gaqBVaXIJNuebamJ6uex//mjxPk8kljQTdM1SwkNrQD7pjS+PerntUSD+QRWPNJ0tq54/x4zRV8bLrLhZg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.css" integrity="sha512-42kB9yDlYiCEfx2xVwq0q7hT4uf26FUgSIZBK8uiaEnTdShXjwr8Ip1V4xGJMg3mHkUt9nNuTDxunHF0/EgxLQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <style>

          #nprogress .bar {

            background-color: #ed9c3d !important;
            height: 5px;
            z-index: 11;
          }

          #nprogress .spinner .spinner-icon {
            border-top-color: #ed9c3d;
            border-left-color: #ed9c3d;
            position: fixed;
            z-index: 11;

            top: 40vh;
            left: 100vh;
            width: 100px;
            height: 100px;
          }

          .overlay{
            background-color: #808080;
            /* position: fixed;
            top:0;
            right: 0;
            bottom: 0;
            left: 0; */
            opacity: 0.3;
            z-index: 10;
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

        @include('vendor.912consult.layouts.web/header-script', ['title' => $title])
    </head>

    <body data-layout-mode="detached" @yield('body-extra')>
        @if(!isset($no_header_footer))
            @include('vendor.912consult.layouts.shared/header')
        @endif

        <div id="overlay" class="overlayq">

                @yield('content')
        </div>
            @if(!isset($no_header_footer))
                @include('vendor.912consult.layouts.web/footer')
            @endif
            @include('vendor.912consult.layouts.web/footer-script')
            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->

        </div>

        <script>
          // Show the progress bar
          NProgress.start();

          // Increase randomly
          var interval = setInterval(function() { NProgress.inc(); }, 1000);


          // Trigger finish when page fully loaded
          jQuery(window).load(function () {
              clearInterval(interval);
              NProgress.done();
              $("#overlay").removeClass("overlay");
          });

          // Trigger bar when exiting the page
          jQuery(window).unload(function () {
              $("#overlay").addClass("overlay");
              NProgress.start();
          });

          $(".left-list a").click(function(){
            NProgress.start();
            $("#overlay").addClass("overlay");
          });
          $(".navbar-nav .menudata").click(function(){
            NProgress.start();
            $("#overlay").addClass("overlay");
          });
          $('.booknow').click(function(){
            NProgress.start();
            $("#overlay").addClass("overlay");
          });
          $(".doctor-list a").click(function(){
            NProgress.start();
            $("#overlay").addClass("overlay");
          });
          $(".call_btn a").click(function(){
            NProgress.start();
            $("#overlay").addClass("overlay");
          });
          $("#searchSubmitButton").click(function(){
            // NProgress.start();
            // $("#overlay").addClass("overlay");
          });
          $(".pagination a").click(function(){
            NProgress.start();
            $("#overlay").addClass("overlay");
          });

          $(".view_details").click(function (e) {
            NProgress.done();
            $("#overlay").removeClass("overlay");
          })
           $('.booking-cnfrm').click(function(){
            NProgress.start();
            $("#overlay").addClass("overlay");
          });


        </script>


        <script type="text/javascript">

           // date-carousel
    jQuery('.items_cat').slick({
        infinite: true,
        arrows: true,
        speed: 300,
        dots: false,
        autoplay: false,
        autoplaySpeed: 5000,
          slidesToShow: 4,
          slidesToScroll: 1,
          responsive: [
            {
              breakpoint: 1024,
              settings: {
                slidesToShow: 4,
                slidesToScroll: 1,
                infinite: true
              }
            },
            {
              breakpoint: 767,
              settings: {
                slidesToShow: 3,
                slidesToScroll: 1,
                infinite: true
              },
            },
            {
              breakpoint: 520,
              settings: {
                slidesToShow: 2,
                slidesToScroll: 1,
                infinite: true
              },
            },
            {
              breakpoint: 400,
              settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                infinite: true
              }
            },
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
        ]
    });


        </script>
    @include('vendor.tele.layouts.shared.firebase')
    </body>
</html>
