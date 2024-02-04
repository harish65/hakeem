<!DOCTYPE html>
<html lang="en">
    <head>
        @include('vendor.healtcaremydoctor.layouts.shared/head', ['title' => $title])
    </head>

    <body data-layout-mode="detached" @yield('body-extra')>
        @if(!isset($no_header_footer))
            @include('vendor.healtcaremydoctor.layouts.shared/header')
        @endif
                    @yield('content')
            @if(!isset($no_header_footer))
                @include('vendor.healtcaremydoctor.layouts.shared/footer')
            @endif
            @include('vendor.healtcaremydoctor.layouts.shared/footer-script')
            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->

        </div>
        <script type="text/javascript">
            $('.items_cat').slick({
              infinite: true,
              slidesToShow: 4,
              slidesToScroll: 1
            });
        </script>
    </body>
</html>
