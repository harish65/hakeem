<!-- footer -->
    <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script> -->
    <script src="{{ asset('assets/taradoc/js/slick.min.js')}}"></script>
    <script src="{{ asset('assets/taradoc/js/bootstrap.min.js')}}"></script>
    <!-- Date Rang JS -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script src="{{ asset('assets/taradoc/js/owl.carousel.min.js')}}"></script>
    <script src="{{ asset('assets/taradoc/js/main.js')}}"></script>
    <script src="{{asset('assets/libs/sweetalert2/sweetalert2.min.js')}}"></script>
    <script src="{{ asset('assets/taradoc/js/intlTelInput.js')}}"></script>
    <script>
        $('.carousel').carousel({
            pause: "false"
        });
    </script>

    
    <script>
        var input = document.querySelector("#phone");
        window.intlTelInput(input, {
            utilsScript: "{{ asset('assets/taradoc/js/utils.js') }}",
        });
        if($('#phone').get(0)!==undefined){
            var iti = intlTelInput($('#phone').get(0));
        }
    </script>
    <script type="text/javascript">
         // $(window).on("load resize", (function () { var o = $(".navigation-wrap"); $("body").css("padding-top", o.outerHeight()) }))
    </script>