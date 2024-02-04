<!-- footer -->
    <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script> -->
    <script src="{{ asset('assets/care_connect_live/js/slick.min.js')}}"></script>
    <script src="{{ asset('assets/care_connect_live/js/bootstrap.min.js')}}"></script>
    <!-- Date Rang JS -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script src="{{ asset('assets/care_connect_live/js/owl.carousel.min.js')}}"></script>
    <script src="{{ asset('assets/care_connect_live/js/main.js')}}"></script>
    <script src="{{ asset('assets/care_connect_live/js/custom.js')}}"></script>
    <script src="{{asset('assets/libs/sweetalert2/sweetalert2.min.js')}}"></script>
    <script src="{{ asset('assets/care_connect_live/js/intlTelInput.js')}}"></script>
    <script>
        $('.carousel').carousel({
            pause: "false"
        });
        $(document).ready(function() {
        $(window).keydown(function(event){
            if(event.keyCode == 13) {
            event.preventDefault();
            return false;
            }
        });
        });
    </script>
     <!-- Start of callmydoctor952 Zendesk Widget script -->
        <script id="ze-snippet" src="https://static.zdassets.com/ekr/snippet.js?key=e107e764-365e-4593-9c07-0911838d7706"> </script>
        <!-- End of callmydoctor952 Zendesk Widget script -->

    
    <script>
        // var input = document.querySelector("#phone");
        // var isPhoneShown = true;

        // window.intlTelInput(input, {
        //     utilsScript: "{{ asset('assets/care_connect_live/js/utils.js') }}",
        //     separateDialCode: true,
        //     preferredCountries: []
        // });
        // if($('#phone').get(0)!==undefined){
        //     var iti = intlTelInput($('#phone').get(0));
        //     var countryCode = iti.getSelectedCountryData();
        //     alert(countryCode);
        // }


        //

        // var isPhoneShown = true;
        var input = document.querySelector("#phone");
        var iti = intlTelInput(input, {
            utilsScript: "{{ asset('assets/care_connect_live/js/utils.js') }}",
            separateDialCode: true,
            preferredCountries: [],
            formatOnDisplay: true,
            preferredCountries:["in"]
        });
        var countryCode = iti.getSelectedCountryData();
        $('#loginModal input[name=country_code]').val(countryCode.dialCode);
        // alert(countryCode.dialCode);
        input.addEventListener("countrychange", function() {
            var country = iti.getSelectedCountryData();
            $('#loginModal input[name=country_code]').val(country.dialCode);
            // alert(country.dialCode);
        });

        // signup doctor

        var input_s = document.querySelector("#phoneno");
        var iti_s = intlTelInput(input_s, {
            utilsScript: "{{ asset('assets/care_connect_live/js/utils.js') }}",
            separateDialCode: true,
            preferredCountries: [],
            formatOnDisplay: true,
            preferredCountries:["in"]
        });
        var countryCode_s = iti_s.getSelectedCountryData();
        $('#contact_details input[name=country_code]').val(countryCode_s.dialCode);
        // alert(countryCode_s.dialCode);
        input_s.addEventListener("countrychange", function() {
            var country = iti_s.getSelectedCountryData();
            $('#contact_details input[name=country_code]').val(country.dialCode);
            // alert(country.dialCode);
        });

         // signup doctor

         var input_s1 = document.querySelector("#phone1");
        var iti_s1 = intlTelInput(input_s1, {
            utilsScript: "{{ asset('assets/care_connect_live/js/utils.js') }}",
            separateDialCode: true,
            preferredCountries: [],
            formatOnDisplay: true,
            preferredCountries:["in"]
        });
        var countryCode_s1 = iti_s1.getSelectedCountryData();
        $('#contact_details input[name=country_code]').val(countryCode_s1.dialCode);
        // alert(countryCode_s.dialCode);
        input_s1.addEventListener("countrychange", function() {
            var country = iti_s1.getSelectedCountryData();
            $('#contact_details input[name=country_code]').val(country.dialCode);
            // alert(country.dialCode);
        });
    </script>