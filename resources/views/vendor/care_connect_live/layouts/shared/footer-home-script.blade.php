 <!-- footer -->
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('assets/js/slick.min.js')}}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js')}}"></script>
    <!-- Date Rang JS -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

    <script src="{{ asset('assets/js/owl.carousel.min.js')}}"></script>
    <script src="{{ asset('assets/js/main.js')}}"></script>
    <script src="{{ asset('assets/js/intlTelInput.js')}}"></script>
    <script src="{{ asset('assets/care_connect_live/js/custom.js')}}"></script>


    <script>
        var base_url = "{{ url('/') }}";
        $('.carousel').carousel({
            pause: "false"
        });
    </script>
    <script>
        var input = document.querySelector("#phone");
        window.intlTelInput(input, {
            utilsScript: "js/utils.js",
        });

    </script>
    <script>
        $(".toggle-password").click(function () {
            $(this).toggleClass("fa-eye fa-eye-slash");
            var input = $($(this).attr("toggle"));
            if (input.attr("type") == "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });
    </script>
    <script type="text/javascript">
         // $(window).on("load resize", (function () { var o = $(".navigation-wrap"); $("body").css("padding-top", o.outerHeight()) }))
    </script>

    <script>
$('.updateserviceprice').on('change',function(e){
    e.preventDefault();
    var cat = $('.category').val();

    var service_id = $(this).attr('data-id');
    var price = $('.price[data-id='+service_id+']').val();

    var duration = $('.duration[data-id='+service_id+']').val();

      //alert(service_id);
     // add to db
     $.post("{{ url('/profile/update_service_type_avail') }}", { _token: "{{ csrf_token() }}", service_id: service_id , category_id: cat , price: price , duration: duration }).done(function(data){
        console.log(data);
        $('.price[data-id='+service_id+']').prop('required',false);
        $('.price[data-id='+service_id+']').css('border-color','');
    });
    
});

        function valueChanged(sel)
        {
            var toggle = sel.id;

            var cat = $('.category').val();

            var service_id = $(sel).attr('data-id');
            
            var price = $('.price[data-id='+service_id+']').val();
           
            var duration = $('.duration[data-id='+service_id+']').val();

           
             //alert(service_id);
        
            if($("#"+toggle).is(":checked"))
            {
                var l_price =  $('.price[data-id='+service_id+']').val();
                if(l_price == '' )
                {
                $('.price[data-id='+service_id+']').prop('required',true);
                $('.price[data-id='+service_id+']').css('border-color','red');
                }
               
                // alert("checked");
                $("#" + toggle + "_box").find(".togglediv").show();

                // add to db
                $.post("{{ url('/profile/add_service_type_avail') }}", { _token: "{{ csrf_token() }}", service_id: service_id , category_id: cat , price: price , duration: duration }).done(function(data){
                    console.log(data);
                });
            }
            else
            {
                $('.price[data-id='+service_id+']').prop('required',false);
                $('.price[data-id='+service_id+']').css('border-color','');
                // alert("hidden");
                $("#" + toggle + "_box").find(".togglediv").hide();

                // remove to db
                $.post("{{ url('/profile/remove_service_type_avail') }}", { _token: "{{ csrf_token() }}", service_id: service_id, category_id: cat  }).done(function(data){
                    console.log(data);
                });
            }
        }
    </script>