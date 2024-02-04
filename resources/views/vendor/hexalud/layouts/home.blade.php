<!DOCTYPE html>
<html lang="en">
    <head>
        @include('vendor.hexalud.layouts.shared/head-home', ['title' => $title])
    </head>

    <body data-layout-mode="detached" @yield('body-extra')>
        @if(!isset($no_header_footer))
            @include('vendor.hexalud.layouts.shared/header')
        @endif
                    @yield('content')
            @if(!isset($no_header_footer))
                @include('vendor.hexalud.layouts.shared/footer-home')
            @endif
            @include('vendor.hexalud.layouts.shared/footer-home-script')
            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->

        </div>
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
    </body>
</html>
