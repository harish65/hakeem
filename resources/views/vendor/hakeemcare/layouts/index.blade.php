<!DOCTYPE html>
<html lang="en">
    <head>
        @include('vendor.tele.layouts.shared/head', ['title' => $title])
    </head>

    <body data-layout-mode="detached" @yield('body-extra')>
        @if(!isset($no_header_footer))
            @include('vendor.tele.layouts.shared/header')
        @endif
                    @yield('content')
            @if(!isset($no_header_footer))
                @include('vendor.tele.layouts.shared/footer')
            @endif

            @auth
            @include('vendor.tele.layouts.web/footer-script')
            @endauth
            @guest()
            @include('vendor.tele.layouts.shared/footer-script')
            @endguest

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->

        </div>
        {{--  <script src="{{ asset('assets/tele/js/jquery.toast.min.js') }}"></script>  --}}
        <script type="text/javascript">

          function getUrlVars()
          {
              var vars = [], hash;
              var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
              for(var i = 0; i < hashes.length; i++)
              {
                  hash = hashes[i].split('=');
                  vars.push(hash[0]);
                  vars[hash[0]] = hash[1];
              }
              return vars;
          }

          var _id = getUrlVars()["tab"];

          if(_id != undefined)
          {
            var pos = $("#"+_id).offset().top - 40;
              $('html, body').animate({
                  scrollTop: pos
              }, 2000);
          }
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
    </body>
</html>
