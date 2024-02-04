<!-- footer -->
    <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script> -->
    <script src="{{ asset('assets/healtcaremydoctor/js/slick.min.js')}}"></script>
    <script src="{{ asset('assets/healtcaremydoctor/js/bootstrap.min.js')}}"></script>
    <!-- Date Rang JS -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script src="{{ asset('assets/healtcaremydoctor/js/owl.carousel.min.js')}}"></script>
    <script src="{{ asset('assets/healtcaremydoctor/js/main.js')}}"></script>
    <script src="{{asset('assets/libs/sweetalert2/sweetalert2.min.js')}}"></script>
    <script src="{{ asset('assets/healtcaremydoctor/js/intlTelInput.js')}}"></script>
    <script>
        $('.carousel').carousel({
            pause: "false"
        });
    </script>
     <!-- Start of callmydoctor952 Zendesk Widget script -->
        <script id="ze-snippet" src="https://static.zdassets.com/ekr/snippet.js?key=e107e764-365e-4593-9c07-0911838d7706"> </script>
        <!-- End of callmydoctor952 Zendesk Widget script -->

    
    <script>
        var input = document.querySelector("#phone");
        window.intlTelInput(input, {
            utilsScript: "{{ asset('assets/healtcaremydoctor/js/utils.js') }}",
        });
        if($('#phone').get(0)!==undefined){
            var iti = intlTelInput($('#phone').get(0));
        }
    </script>
    <script type="text/javascript">
         // $(window).on("load resize", (function () { var o = $(".navigation-wrap"); $("body").css("padding-top", o.outerHeight()) }))
    </script>