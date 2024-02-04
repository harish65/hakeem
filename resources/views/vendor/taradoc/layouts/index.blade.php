<!DOCTYPE html>
<html lang="en">
    <head>
        @include('vendor.taradoc.layouts.shared/head', ['title' => $title])
    </head>

    <body data-layout-mode="detached" @yield('body-extra')>
        @if(!isset($no_header_footer))
            @include('vendor.taradoc.layouts.shared/header')
        @endif
                    @yield('content')
            @if(!isset($no_header_footer))
                @include('vendor.taradoc.layouts.shared/footer')
            @endif
            @include('vendor.taradoc.layouts.shared/footer-script')
            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->

        </div>
        <style>
        .new-footer h4, .new-footer a, .general {
            color: #000!important;
        }
        .navigation-wrap .navbar-nav .nav-link, .copyright-text small{
            color: #000;
        }
        </style>
        <script type="text/javascript">
           // date-carousel
    jQuery('.items_cat').slick({
      dots: false,
      arrows: true,
      infinite: true,
      speed: 500,
      fade: true,
      slide: '> div',
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