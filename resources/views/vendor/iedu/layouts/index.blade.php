<!DOCTYPE html>
<html lang="en">
    <head>
        @include('vendor.iedu.layouts.shared/head', ['title' => $title])
        <script>
            let senderId = null;
            let receiverId = null;
            let reuquestId = null;
        </script>
    </head>

    <body data-layout-mode="detached" @yield('body-extra') @if(isset($after_signup)) class="fixed-nav sticky-footer" id="page-top" @endif>
        @if(!isset($no_show_header))
            @include('vendor.iedu.layouts.shared/header')
        @endif
        <!-- Begin page -->
        <div id="wrapper-main">
            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->
            <div class="content-page">
                <div class="content">
                    @include('vendor.iedu.layouts.shared/flash-message')
                    @yield('content')
                </div>
            </div>
            @if(isset($show_footer))
                @include('vendor.iedu.layouts.shared/footer')
            @endif
            @include('vendor.iedu.layouts.shared/footer-script')

        </div>
    </body>
</html>
