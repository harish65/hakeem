 <!-- footer -->
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('assets/912consult/js/slick.min.js')}}"></script>
    <script src="{{ asset('assets/912consult/js/bootstrap.min.js')}}"></script>
    <!-- Date Rang JS -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

    <script src="{{asset('assets/912consult/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('assets/912consult/js/main.js')}}"></script>
    <script src="{{asset('assets/912consult/js/intlTelInput.js')}}"></script>
    <script src="{{ asset('assets/912consult/js/custom.js')}}"></script>
    <script src="{{asset('assets/libs/sweetalert2/sweetalert2.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


    <script>
        var base_url = "{{ url('/') }}";
        $('.carousel').carousel({
            pause: "false"
        });
        $(document).ready(function() {
            $('#multiselect').select2({
              placeholder: "Select Languages",
              allowClear: true
            });
        });
    </script>
    <script>
        var input = document.querySelector("#phone");
        window.intlTelInput(input, {
            utilsScript: "js/utils.js",
        });

    function check_slots_validity(obj,type,key, id)
    {
      $('.start_time_'+key).html("");
      $('.end_time_'+key).html("");
      if(type == 'start' && key == 0)
      {
        return false;
      }
      else if(type == 'start' && key > 0)
      {
        var last_end = $('#'+id+' #end_time_'+(key-1)).val();
        if($(obj).val() < last_end)
        {
          $(obj).val("");
          $('#'+id+' .start_time_'+key).html("Start time must be greater than last entered end time");
        }
      }
      else if(type == "end")
      {
        var start_time = $('#'+id+' #start_time_'+key).val();
        if(start_time >= $(obj).val())
        {
          $(obj).val("");
          $('#'+id+' .end_time_'+key).html("End time must be greater than start time");
        }
      }
    }
    function submit_availbility_form()
    {
        if($('#addAvailbityModal div.button-group-pills.required :checkbox:checked').length > 0)
        {
            $('#add_availbility_form').submit();
        }else{
            swal.fire('Warning!','Please select atleast one day','warning');
        }

    }

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
         $(".lout").click(function(e){
            e.preventDefault();
            //alert();
            $('#logoutConfirm').modal('show');
        });


        $(".lout-cnfrm").click(function() {

        window.location.href = "/logout";

        });
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

            var user_id = $(sel).attr('data-user_id');

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
                $.post("{{ url('/profile/add_service_type_avail') }}", { _token: "{{ csrf_token() }}", service_id: service_id , category_id: cat , price: price , duration: duration, user_id : user_id }).done(function(data){
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
