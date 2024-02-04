<!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.2/owl.carousel.min.js"></script>
  <script type="text/javascript" src="{{ asset('assets/iedu/js/main.js') }}"></script>
  <script type="text/javascript" src="{{ asset('assets/iedu/js/custom.js') }}"></script>
  <script src="{{asset('assets/iedu/js/intlTelInput.js')}}"></script>

  <!-- <script type="text/javascript" src="{{ asset('assets/iedu/js/script.js') }}"></script> -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.4/socket.io.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="{{ asset('assets/care_connect_live/js/emojionearea.js')}}"></script>

  <script src="https://momentjs.com/downloads/moment.js"></script>


  <script type="text/javascript">
    var pushId = "{{  env('VAPID_PUBLIC_KEY') }}";
    var _category_docs_url = "{{ url('/profile/docs') }}";
    @if(Auth::check())
  	    let user_id = "{{ Auth::user()->id }}";
        let sender_name = '{{ Auth::user()->name }}';
    @else
        let user_id = null;
        let sender_name = null;
    @endif

    let socket_url = "{{ env('SOCKET_URL') }}";
    let storage_url = "{{ Storage::disk('spaces')->url('thumbs/') }}";

    var socket = io.connect(socket_url, { query: "user_id="+parseInt(user_id)+"&domain=iedu" });

    var _data = {
        senderId:senderId,
        callreceiverId:receiverId,
        reuquestId:reuquestId,
        senderData:sender_name
    };

    socket.emit('callVideo', _data );



    socket.on("incomingCall", function (data) {
           // alert("incoming call from : " + data.senderData);
    		console.log('data',data);
            var audio_url = '{{ url("/") }}/service/'+ data.reuquestId +'/video_call';

           // alert(window.location.href);

            if(window.location.href.includes("video_call") == false)
            {

                Swal.fire({
                title: 'Incoming Call from '+data.senderData,
                text: "Accept or decline",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Accept'
                }).then((result) => {
                if (result.value) {
                window.location.href = audio_url;
                }
                });
            }
            // $.toaster({ priority : 'success', title : 'Title', message : data.message});

                //    $.toast({
                //        heading: 'Incoming Call from '+data.senderData,
                //        text : data.message + '<br> <br> <a class="btn btn-primary" style="padding:5px;" href="'+audio_url+'">Accept</a> &nbsp; &nbsp; &nbsp;  <a class="btn btn-danger cancel_call" data-id = "'+ data.reuquestId +'" style="padding:5px;" href="#">Decline</a> ',
                //        icon: 'info',
                //        loader: true,        // Change it to false to disable loader
                //        loaderBg: '#9EC600',  // To change the background
                //        hideAfter : false,
                //        position: 'top-right',
                //        allowToastClose: true,
                //        hideAfter: 60000,
                //        showHideTransition: 'slide'
                //    });



    });

     @if(@$user)
    socket.on("messageFromServer", function (data) {
        if(data.request_id==request_id){

            var timeCurrent = moment().format('hh:mm A');

            if(data.messageType !== undefined && data.messageType == 'IMAGE'){
                $("#output").append('<div class="recived_msg position-relative p-3 mb-3 round-msg"><img height="100%" width="100%" src="'+ storage_url+data.imageUrl+ '"/> <p class="text-right">'+ timeCurrent +'</p>  </div>');
            }else{
                $("#output").append('<div class="recived_msg position-relative p-3 mb-3 round-msg"><p>'+ data.message + '</p><p class="text-right">'+ timeCurrent + '</p> </div>');
                $(".chat_box_wrapper").stop().animate({ scrollTop: $(".chat_box_wrapper")[0].scrollHeight}, 1000);
            }
        }
    });
    @endif

      $(window).scroll(function() {
        if ($(document).scrollTop() > 50) {
          $("nav").addClass("shrink");
        } else {
          $("nav").removeClass("shrink");
        }
      });
      $(".noti-bar").click(function(e){
           e.preventDefault();
        $("#notifications").toggleClass("open");
       });
      $(function () {
        $(window).on("scroll", function () {
          if ($(window).scrollTop() > 250) {
            $("header").addClass("bg-black");
          } else {
            $("header").removeClass("bg-black");
          }
        });
      });
      $('.add').click(function() {
        $('.block:last').before('<div class="block optionBox"><div class="form-group"><label>From</label><input class="form-control" type="text" /></div><div class="form-group"><label>In</label><input class="form-control" type="text" /></div><span class="remove"><i class="fa fa-trash-o" aria-hidden="true"></i></span></div>');
    });
    $('.optionBox').on('click','.remove',function() {
      $(this).parent().remove();
    });
    </script>
    <script type="text/javascript">
      jQuery("#testimonial").owlCarousel({
      loop: true,
      margin: 40,
      responsiveClass: true,
      // autoHeight: true,
      autoplayTimeout: 7000,
      smartSpeed: 800,
      nav: true,
      items:3,
      responsiveClass:true,
      responsive: {
        0: {
          items: 1,
          nav:true
        },

        600: {
          items: 2,
          nav:true
        },

        1024: {
          items: 3,
          nav:true
        },

        1366: {
          items: 3,
          nav:true
        }
      }
    });




    var input = document.querySelector("#phone");

        var iti = intlTelInput(input, {
            utilsScript: "{{ asset('assets/care_connect_live/js/utils.js') }}",
            separateDialCode: true,
            preferredCountries: [],
            formatOnDisplay: true,
            preferredCountries:["ae"]
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
            preferredCountries:["ae"]
        });
        var countryCode_s = iti_s.getSelectedCountryData();
        $('#contact_details input[name=country_code]').val(countryCode_s.dialCode);
        // alert(countryCode_s.dialCode);
        input_s.addEventListener("countrychange", function() {
            var country = iti_s.getSelectedCountryData();
            $('#contact_details input[name=country_code]').val(country.dialCode);
            // alert(country.dialCode);
        });
//update model student
        var input_upstud = document.querySelector("#phone_update");

        var iti = intlTelInput(input_upstud, {
            utilsScript: "{{ asset('assets/care_connect_live/js/utils.js') }}",
            separateDialCode: true,
            preferredCountries: [],
            formatOnDisplay: true,
            preferredCountries:["ae"]
        });
        var countryCode = iti.getSelectedCountryData();
        $('#loginModal input[name=country_code]').val(countryCode.dialCode);
        // alert(countryCode.dialCode);
        input_upstud.addEventListener("countrychange", function() {
            var country = iti.getSelectedCountryData();
            $('#loginModal input[name=country_code]').val(country.dialCode);
            // alert(country.dialCode);
        });

        var input_edit = document.querySelector("#phone_edit");

        var iti = intlTelInput(input_edit, {
            utilsScript: "{{ asset('assets/care_connect_live/js/utils.js') }}",
            separateDialCode: true,
            preferredCountries: [],
            formatOnDisplay: true,
            preferredCountries:["ae"]
        });
        var countryCode = iti.getSelectedCountryData();
        $('#customer_profile input[name=country_code]').val(countryCode.dialCode);
        // alert(countryCode.dialCode);
        input_edit.addEventListener("countrychange", function() {
            var country = iti.getSelectedCountryData();
            $('#customer_profile input[name=country_code]').val(country.dialCode);
            // alert(country.dialCode);
        });



         // signup doctor

        //  var input_s1 = document.querySelector("#phone1");
        // var iti_s1 = intlTelInput(input_s1, {
        //     utilsScript: "{{ asset('assets/care_connect_live/js/utils.js') }}",
        //     separateDialCode: true,
        //     preferredCountries: [],
        //     formatOnDisplay: true,
        //     preferredCountries:["in"]
        // });
        // var countryCode_s1 = iti_s1.getSelectedCountryData();
        // $('#contact_details input[name=country_code]').val(countryCode_s1.dialCode);
        // // alert(countryCode_s.dialCode);
        // input_s1.addEventListener("countrychange", function() {
        //     var country = iti_s1.getSelectedCountryData();
        //     $('#contact_details input[name=country_code]').val(country.dialCode);
        //     // alert(country.dialCode);
        // });

    $("#contact_details #nextbtn").click(function (e) {
        e.preventDefault();
        let phoneno = $('#contact_details #phoneno').val();
        let role_type = $('#contact_details #role_type').val();
        let country_code = $('#contact_details #country_code').val();
        var v_token = "{{csrf_token()}}";
        $("#login_form .phone").html('');
        $("#login_form .main_error").html('');
        if (!phoneno) {
            $("#login_form .phone").html("The phone field is required.");
            $('#login_form #phoneno').css('border','1px solid red');
            //$('#contact_details-popup').modal('show');
            return false;
        }

        $("#login_btn span").html('wait');

        $.ajax({
            type: "post",
            dataType: "json",
            url: base_url + '/update/phone',
            data: $('#otp_login').serialize(),
            success: function (response) {
                //var data = response;
                //  console.log(data.data);

                $('#contact_details').modal('hide');

                $('#otp-popup').modal('show');
                $('#otp-popup .phonenumber').html('');
                $('#otp-popup .role_type').val('');
                $('#otp-popup .phone').val('');
                $('#otp-popup .country_code').val('');
                $('#otp-popup #digit-1').val('');
                $('#otp-popup #digit-2').val('');
                $('#otp-popup #digit-3').val('');
                $('#otp-popup #digit-4').val('');
                $('#otp-popup #applyoption').val();
                // formMessages.show();
                $('#otp-popup .phonenumber').html(response.codephone);
                $('#otp-popup .role_type').val(response.role_type);
                $('#otp-popup .country_code').val(response.country_code);
                $('#otp-popup .phone').val(response.data);
                $('#otp-popup #email').val(response.email);
                $('#otp-popup #userid').val(response.userid);
                $('#otp-popup #signuptype').val(response.signuptype);
                $('#otp-popup #applyoption').val(response.applyoption);

                //$("#login_btn span").html('Next');
                // location.reload();
            },
            error: function (jqXHR) {
                $("#login_btn span").html('Next');

                if (jqXHR.responseJSON.status === "error") {
                    // var msg = jqXHR.message;
                    // console.log(jqXHR.responseJSON.message);
                    // alert(jqXHR.responseJSON.message);
                    $("#contact_details .msgdiv").text(jqXHR.responseJSON.message);
                    $("#contact_details .msgdiv").show();
                    $('#contact_details .msgdiv').fadeIn('slow').delay(2000).fadeOut('slow');
                }


                var response = $.parseJSON(jqXHR.responseText);

                if (response.error) {

                    if (response.errors.password) {
                        $("#login_form .phoneno").html(response.errors.phoneno[0]);
                    }

                } else if (response.message) {
                    $("#login_form .main_error").html(response.message);


                }
            }
        });
    });


    $("#otp-popup #Submit").click(function (e) {
        e.preventDefault();
        $.ajax({
            type: "post",
            dataType: "json",
            url: base_url + '/verify/phone',
            data: $('#otpform').serialize(),
            success: function (response) {
                //var data = response;
                  console.log(response);
                  $('#otp-popup').modal('hide');
                  $.toast({
                heading: '',
                text : response.message ,
                icon: 'success',
                loader: true,        // Change it to false to disable loader
                loaderBg: '#9EC600',  // To change the background
                hideAfter : false,
                position: 'top-right',
                allowToastClose: true,
                hideAfter: 10000,
                showHideTransition: 'slide'
            });

            },
            error: function (jqXHR) {

                if (jqXHR.responseJSON.status === "error") {
                    // var msg = jqXHR.message;
                    // console.log(jqXHR.responseJSON.message);
                    // alert(jqXHR.responseJSON.message);
                    $('#otp-popup').modal('show');
                    // $('#otp-popup .phonenumber').html('');
                    // $('#otp-popup .role_type').val('');
                    // $('#otp-popup .phone').val('');
                    // $('#otp-popup .country_code').val('');
                    // $('#otp-popup #digit-1').val('');
                    //    $('#otp-popup #digit-2').val('');
                    // $('#otp-popup #digit-3').val('');
                    // $('#otp-popup #digit-4').val('');
                    // formMessages.show();
                    $('#otp-popup .phonenumber').html(jqXHR.responseJSON.codephone);
                    $('#otp-popup .role_type').val(jqXHR.responseJSON.role_type);
                    $('#otp-popup .country_code').val(jqXHR.responseJSON.country_code);
                    $('#otp-popup .phone').val(jqXHR.responseJSON.data);
                    $("#otp-popup .msgdiv").text(jqXHR.responseJSON.message);
                    $("#otp-popup .msgdiv").show();
                   $('#otp-popup .msgdiv').fadeIn('slow').delay(2000).fadeOut('slow');
                }


            }
        });
    });



    $('#resend_otp').on('click',function(e){
        e.preventDefault();
        $.ajax({
            type: "post",
            dataType: "json",
            url: base_url + '/resend/otp',
            data: $('#otpform').serialize(),
            success: function (response) {
                //var data = response;
                //  console.log(response);
                  $('#otp-popup').modal('show');
                  $('#otp-popup .phonenumber').html('');
                  $('#otp-popup .role_type').val('');
                  $('#otp-popup .phone').val('');
                  $('#otp-popup .country_code').val('');
                  $('#otp-popup #applyoption').val('');
                  $('#otp-popup .phonenumber').html(response.codephone);
                  $('#otp-popup .role_type').val(response.role_type);
                  $('#otp-popup .country_code').val(response.country_code);
                  $('#otp-popup .phone').val(response.data);
                  $('#otp-popup #email').val(response.email);
                  $('#otp-popup #signuptype').val(response.signuptype);
                  $('#otp-popup #userid').val(response.userid);
                  $('#otp-popup #applyoption').val(response.applyoption);
                  $("#otp-popup .msgdivsuccess").text(response.message);
                  $("#otp-popup .msgdivsuccess").show();
                  $('#otp-popup .msgdivsuccess').fadeIn('slow').delay(2000).fadeOut('slow');

            } ,
            error: function (jqXHR) {

                if (jqXHR.responseJSON.status === "error") {
                    // var msg = jqXHR.message;
                    // console.log(jqXHR.responseJSON.message);
                    // alert(jqXHR.responseJSON.message);
                    $("#otp-popup .msgdiv").text(jqXHR.responseJSON.message);
                    $("#otp-popup .msgdiv").show();
                    $('#otp-popup .msgdiv').fadeIn('slow').delay(2000).fadeOut('slow');
                }
            }
        });

    });


    $('#view_detail_container').modal('hide');
    $('.appointment_div .view_details').on('click',function(e){
     // e.prevntDefault();

       var id =  $(this).attr('data-id');
        $('#view_detail_container'+id).modal('show');
    });

    $('.formConfirm').modal('hide');
    $('.cancel_request, .start_request , .accept_request , .mark_complete').on('click',function(e)
    {
        e.preventDefault();
        var request_id = $(this).attr('data-request_id');
        var from_user = $(this).attr('data-from_user');
        var to_user = $(this).attr('data-to_user');
        var service_id = $(this).attr('data-service_id');
        var request = $(this).attr('data-request');
        var service = $(this).attr('data-service');


        $('.formConfirm').modal('show');

        $('.confirm_model_body .request_id').val(request_id);
        $('.confirm_model_body .from_user').val(from_user);
        $('.confirm_model_body .to_user').val(to_user);
        $('.confirm_model_body .service_id').val(service_id);
        $('.confirm_model_body .service').val(service);
        $('.request').text(request);


    });

    $('.owl-carousel').owlCarousel({
        loop:true,
        margin:10,
        nav:true,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:1
            },
            1000:{
                items:1
            }
        }
    })



    $('.final_cancel_confirmmation').on('click',function(e)
    {

        e.preventDefault();
        var request_id = $('.confirm_model_body .request_id').val();
        var from_user = $('.confirm_model_body .from_user').val();
        var to_user = $('.confirm_model_body .to_user').val();
        var service_id =  $('.confirm_model_body .service_id').val();
        var request =  $('.confirm_model_body .request').text();
        var service =  $('.confirm_model_body .service').val();

        if(request == 'Cancel')
        {
            _post_request_url = _post_cancel_request_url;
        }
        if(request == 'Accept')
        {
            _post_request_url = _post_accept_request_url;
        }
        if(request == 'Start')
        {
            _post_request_url = _post_start_request_url;
        }
        if(request == 'Mark Complete' &&  service == 'Chat' )
        {
            _post_request_url = _post_chat_complete_request_url;

        }
        if(request == 'Mark Complete' &&  service != 'Chat' )
        {

            _post_request_url = _post_complete_request_url;

        }

       // alert(_post_request_url);

        $.post(_post_request_url, {
                "_token": _token,
                "request_id": request_id,
                "from_user": from_user,
                "to_user": to_user,
                "service_id": service_id,
                "service":service,
                "reqstatus" : "completed"

            }).done(function(data){
                console.log(data);
                $('.confirm_model_body .request_id').val('');
                $('.confirm_model_body .from_user').val('');
                $('.confirm_model_body .to_user').val('');
                $('.confirm_model_body .service_id').val('');
                $('.confirm_model_body .service').val('');

                $('#formConfirm').modal('hide');
                if(request == 'Cancel')
                {
                    $('#formConfirm').modal('hide');
                    location.reload();
                }
                if(request == 'Accept')
                {
                    $('#formConfirm').modal('hide');
                    location.reload();
                }
                if(request == 'Mark Complete' )
                {
                    $('#formConfirm').modal('hide');
                    location.reload();

                }

               if(data.action == 'call')
               {
                var requestid = data.data.request_id;
                var main_service_type = data.main_service_type;

                var url  = '{{url('service')}}/'+requestid+'/'+main_service_type+'';
                window.location.href = url;
               }
               if(data.action == 'chat')
               {
                var requestid = data.data.request_id;
                var main_service_type = data.main_service_type;

                var url  = '{{url('user/chat')}}?request_id='+requestid+'';
                window.location.href = url;

               }

               //location.reload();

            });
    });

    function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}

function IsEmail(email) {
    var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if(!regex.test(email)) {
      return false;
    }else{
      return true;
    }
  }
  $('#reschedule_request .reschedule').on('click',function(e){
      var schedule_type =  $('.schedule_type').val();
      var consultant_id =  $('.consultant_id').val();
      var request_id =  $('.request_id').val();
      var service_id =  $('.service_id').val();
      var category_id =  $('.category_id').val();
      var payment_type =  $('.payment_type').val();
      var total =$('.total').val();
      var schedule_url = $('.schedule_url').val();
      var instant_url = $('.instant_url').val();
      if(schedule_type == 'instant')
      {
            var date = $('.date').val();
            var time = $('.time').val();
            var meet_now = base_url + '/user/doctor_details/' + consultant_id + '/' + service_id + '?' + instant_url;
            window.location = meet_now;
      }
      if(schedule_type == 'schedule')
      {
            var schedule_url = base_url + '/user/getSchedule?' + schedule_url;
            window.location = schedule_url;
      }
});




$('.start').click(function(e){
    var requestid = $(this).attr('data-request_id');
    var url  = '{{url('service')}}?request_id = '+requestid+'';
    window.open(url, '_blank').focus();
});

$("body").on("click", ".cancel_call", function(e) {

    e.preventDefault();


    var requestid = $(this).attr('data-id');
    var status  = 'CALL_CANCELED';
   // alert(requestid);

    $.post( base_url + '/call-status', {
        "_token": "{{csrf_token()}}",
        "request_id": requestid,
        "status": status

    }).done(function(data2) {
        console.log(data2);
    });

});


 $('.appiontmentdate').on('change',function(e)
    {
          e.preventDefault();
        var date = $('.appiontmentdate').val();
        window.location.href=_get_date_url+'?date='+date;

     });

     $("#create_request").submit(function(e) {
        e.preventDefault();

        // reset
        $("#form_message").hide();
        $("#form_message").attr("class", "");

        var _form = $(this);
        var _url = _form.attr("action");

        $.post(_url, $("#create_request").serialize())
            .done(function(data) {
             //console.log(data);
                if (data.status == "error") {

                    $("#wallet_message").text(data.message);

                    $("#wallet_message_container").modal('show');

                }

                else{

                        $('.spinner_btn').hide();
                       // $('#bookingCreatedModal').modal('show');
                       Swal.fire(
                            'Awesome!',
                            'Your booking created Successfully!',
                            'success'
                            )
                        var url  = '{{url('web/courses')}}';

                        setTimeout(function(){
                            window.location.href= url;
                            }, 2000);

                }
            })
            .fail(function (jqXHR) {
                var msg = jqXHR.responseJSON.message ;
                alert(msg);
                        setTimeout(function(){
                            window.location.reload(1);
                            }, 2000);

                 if(data.type="alert")
                     {
                        alert(data.message);
                        setTimeout(function(){
                            window.location.reload(1);
                            }, 2000);
                    }
             })

    });

    var rzp1 = null;

$("#add_money").click(function(e){
    _amount = $("input[name=amount]").val();
    $.post(_wallet_url, { balance: _amount, _token: _order_token }).done(function(data){
        if(data.status == "success"){
            window.location.href= data.data.url;
        }else{
            Swal.fire('Error!',data.message,'success');
        }
    });
    e.preventDefault();
});

$('.amount').click(function(e)
    {
        e.preventDefault();
        if($('.amtInput').val() == '')
        {
            var amtInput = 0;
        }
        else
        {
            var amtInput = $('.amtInput').val();

        }
        var amt= parseInt(amtInput);
        var value = parseInt($(this).attr('data-val'));
        var total = amt + value;
       $('.amtInput').val(total);
        //alert(value);
    });

    $('#booking_btn').click(function(e)
    {
        $(this).hide();
        $('.spinner_btn').show();
    });
//     (function ($) {
//     "use strict";
//     $.fn.ratingThemes['krajee-fas'] = {
//         filledStar: '<i class="fa fa-star"></i>',
//         emptyStar: '<i class="fa fa-star"></i>',
//         clearButton: '<i class="fa fa-minus-circle"></i>'
//     };
// })(window.jQuery);
$(document).ready(function(){
    $('.kv-ltr-theme-fas-star').rating({
        hoverOnClear: false,
        theme: 'krajee-fas',
        containerClass: 'is-star'
    });

    $('#input-1-ltr-star-xs').on('rating:change', function(event, value, caption) {
        $('#rating').val(value);
        //$('.caption span').val(caption);
    // console.log(value);
    // console.log(caption);
});
});


    $('.ratingreview').on('click',function(e)
{
    e.preventDefault();
    $('#ratingModal').modal('show');


})

$(" #ratingModal #ratingbtn").on('click',function (event) {
    event.preventDefault();
    var requestid = $("#ratingModal input[name=request_id]").val();
   // alert(requestid);
    var review = $("#ratingModal textarea[name=review]").val();
   // alert(review);

    var _data = $('#ratingModal form#ratingForm').serialize();

    console.log(_data);
    $.ajax({
      type: "POST",
      url: base_url+ '/add-review',
      data: _data,
      dataType: "json"
        }).done(function (data) {
            //console.log(data.status);
            if(data.status == 'success')
            {
            $("#ratingModal .msgdivsuccess").text(data.message);
            $("#ratingModal .msgdivsuccess").show();
            $('#ratingModal .msgdivsuccess').fadeIn('slow').delay(2000).fadeOut('slow');
            $('#ratingModal').modal('hide');
            $('.ratingreview').hide();
            if($('.ratingreview').attr('data-id') == requestid)
            {
                $('.ratingreview').hide();

            }

            }
            else{
                $("#ratingModal .msgdiverror").text(data.message);
            $("#ratingModal .msgdiverror").show();
            $('#ratingModal .msgdiverror').fadeIn('slow').delay(2000).fadeOut('slow');
            }
        });


  });


  function readURLImg(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function(e) {
        $('.showImg').attr('src', e.target.result);
      }

      reader.readAsDataURL(input.files[0]); // convert to base64 string
    }
  }

  $('.custom_alert')
        .fadeIn(3000)
        .delay(100)
        .fadeTo(1000, 0.4)
        .delay(100)
        .fadeTo(1000,1)
        .delay(100)
        .fadeOut(3000);


  $("#image_uploads").change(function() {
    readURLImg(this);
  });

  $("#image_upload2").change(function() {
    readURLImg(this);
  });



  $("#image_uploads_edit").change(function() {
    readURLImg(this);
  });


  $('.update_phone').click(function(e)
{
    e.preventDefault();
    $('#contact_details2').modal('show');

});
$('#trigger_upload').click(function(e)
{
    e.preventDefault();
    $('#image_uploads').trigger('click');

});
$("#contact_details2 #nextbtn").click(function (e) {
        e.preventDefault();
        let phoneno = $('#contact_details2 #phoneno').val();
        let role_type = $('#contact_details2 #role_type').val();
        let country_code = $('#contact_details2 #country_code').val();
        var v_token = "{{csrf_token()}}";
        $("#login_form .phone").html('');
        $("#login_form .main_error").html('');
        if (!phoneno) {
            $("#login_form .phone").html("The phone field is required.");
            $('#login_form #phoneno').css('border','1px solid red');
            //$('#contact_details-popup').modal('show');
            return false;
        }

        $("#login_btn span").html('wait');

        $.ajax({
            type: "post",
            dataType: "json",
            url: base_url + '/update/phone',
            data: $('#otp_login').serialize(),
            success: function (response) {
                //var data = response;
                //  console.log(data.data);

                $('#contact_details2').modal('hide');

                $('#otp-popup').modal('show');
                $('#otp-popup .phonenumber').html('');
                $('#otp-popup .role_type').val('');
                $('#otp-popup .phone').val('');
                $('#otp-popup .country_code').val('');
                $('#otp-popup #digit-1').val('');
                $('#otp-popup #digit-2').val('');
                $('#otp-popup #digit-3').val('');
                $('#otp-popup #digit-4').val('');
                $('#otp-popup #applyoption').val();
                // formMessages.show();
                $('#otp-popup .phonenumber').html(response.codephone);
                $('#otp-popup .role_type').val(response.role_type);
                $('#otp-popup .country_code').val(response.country_code);
                $('#otp-popup .phone').val(response.data);
                $('#otp-popup #email').val(response.email);
                $('#otp-popup #userid').val(response.userid);
                $('#otp-popup #signuptype').val(response.signuptype);
                $('#otp-popup #applyoption').val(response.applyoption);

                //$("#login_btn span").html('Next');
                // location.reload();
            },
            error: function (jqXHR) {
                $("#login_btn span").html('Next');

                if (jqXHR.responseJSON.status === "error") {
                    // var msg = jqXHR.message;
                    // console.log(jqXHR.responseJSON.message);
                    // alert(jqXHR.responseJSON.message);
                    $("#contact_details .msgdiv").text(jqXHR.responseJSON.message);
                    $("#contact_details .msgdiv").show();
                    $('#contact_details .msgdiv').fadeIn('slow').delay(2000).fadeOut('slow');
                }


                var response = $.parseJSON(jqXHR.responseText);

                if (response.error) {

                    if (response.errors.password) {
                        $("#login_form .phoneno").html(response.errors.phoneno[0]);
                    }

                } else if (response.message) {
                    $("#login_form .main_error").html(response.message);


                }
            }
        });
    });
let senderChatId = null,request_id=null,receiverIdChat=null;
var message = document.querySelector("#message");
        var handle = document.querySelector("#handle");
        var btn = document.querySelector("#send");
        var output  = document.querySelector("#output");
        var feedback  = document.querySelector("#feedback");
        if(btn!==null){
            senderChatId = btn.getAttribute('data-senderid');
            request_id = btn.getAttribute('data-request_id');
            receiverIdChat = btn.getAttribute('data-receiverid');
        }
        let image_name = null;
        var time = document.querySelector("#time");
// $("a[href='{{ url('/user/chat/iedu') }}']").closest("li").addClass("active");
        // $("#message").emojioneArea({
        //     pickerPosition: "bottom",
        //     filtersPosition: "bottom",
        //     tonesStyle: "checkbox",
        //     events: {
        //         keyup: function(editor, event) {
        //             // alert(event.which);
        //             if(event.which == 13)
        //             {
        //                 var _data = $("#message").emojioneArea().data("emojioneArea").getText();
        //                 if(_data){
        //                     // console.log(_data);
        //                     // console.log(res.status);
        //                     $("#output").append('<div class="send_msg position-relative p-3 mb-3 round-msg"><p>'+ _data + '</p><p class="text-right">'+ time.value + '</p> </div>');
        //                     // message.value = '';
        //                     $("#message").emojioneArea().data("emojioneArea").setText('');
        //                     $(".chat_box_wrapper").stop().animate({ scrollTop: $(".chat_box_wrapper")[0].scrollHeight}, 1000);
        //                     socket.emit('sendMessage', {
        //                         message:_data,
        //                         time:time,
        //                         senderId:senderChatId,
        //                         messageType:'TEXT',
        //                         imageUrl:'',
        //                         receiverId:receiverIdChat,
        //                         request_id:request_id
        //                     },function(res){
        //                     // console.log(_data);
        //                        console.log(res);
        //                         if(res.status=='REQUEST_COMPLETED')
        //                             console.log(res.status);
        //                         else if(res.status=='MESSAGE_SENT'){
        //                             // console.log(res.status);
        //                             // $("#output").append('<div class="send_msg position-relative p-3 mb-3 round-msg"><p>'+ _data + '</p><p class="text-right">'+ time.value + '</p> </div>');
        //                             // // message.value = '';
        //                             // $("#message").emojioneArea().data("emojioneArea").setText('');
        //                             // $(".chat_box_wrapper").stop().animate({ scrollTop: $(".chat_box_wrapper")[0].scrollHeight}, 1000);
        //                            // location.reload();
        //                         }else{
        //                             console.log(res.status);
        //                         }
        //                     });
        //                 }
        //             }

        //         }
        //     }
        // });





        //Query DOM


        $(document).ready(function(){
            $('#output').animate({ scrollTop: $('#output')[0].scrollHeight}, 100);
        })

        //Emit event
        // btn.addEventListener("click", function () {

        // });

        message.addEventListener("keyup", function (e) {
            if(e.which == 13)
            {
                var _data = message.value;
                if(_data){
                    var timeCurrent = moment().format('hh:mm A');
                    $("#output").append('<div class="send_msg position-relative p-3 mb-3 round-msg"><p>'+ _data + '</p><p class="text-right">'+ timeCurrent + '</p> </div>');
                    message.value = '';
                    $(".chat_box_wrapper").stop().animate({ scrollTop: $(".chat_box_wrapper")[0].scrollHeight}, 1000);
                    socket.emit('sendMessage', {
                        message:_data,
                        time:time,
                        senderId:senderChatId,
                        messageType:'TEXT',
                        imageUrl:'',
                        receiverId:receiverIdChat,
                        request_id:request_id
                    },function(res){
                       console.log(res);
                        if(res.status=='REQUEST_COMPLETED')
                            console.log(res.status);
                        else if(res.status=='MESSAGE_SENT'){
                        }else{
                            console.log(res.status);
                        }
                    });
                }
            }
        });

        //Listen event

        socket.on("typing", function (data) {
                console.log('typing....');
        });
        $("#image_uploadsid").change(function(e){
             $('#upload_image_form').submit();
        });
        $('#upload_image_form').submit(function(e) {

             e.preventDefault();

            var formData = new FormData(this);
            var timeCurrent = moment().format('hh:mm A');

            $.ajax({
                type:'POST',
                url: $(this).attr('action'),
                data:formData,
                cache:false,
                contentType: false,
                processData: false,
               success:function(data){
                   //console.log(data.data.image_name);
                    image_name = data.data.image_name;
                    socket.emit('sendMessage', {
                        message:null,
                        time:time,
                        imageUrl:image_name,
                        messageType:'IMAGE',
                        senderId:senderChatId,
                        receiverId:receiverIdChat,
                        request_id:request_id
                    },function(res){
                        console.log('data-------');
                        console.log(res);

                        if(res.status=='REQUEST_COMPLETED')
                            alert(res.message);
                        else if(res.status=='MESSAGE_SENT'){

                            $("#output").append('<div class="send_msg position-relative p-3 mb-3 round-msg"><img height="100%" width="100%" src="'+ storage_url+image_name+ '"/><p class="text-right">'+ timeCurrent +'</p> </div>');
                        }else{
                            alert(res.message);
                        }
                        $('#output').animate({ scrollTop: $('#output')[0].scrollHeight}, 100);
                    });
               },error:function(data){
                    // alert(data.message);
               }
            });

        });



         $(function () {
             function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#profile-img-tag').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
        });

        $('.searchInput').on('keyup',function(e)
        {
            e.preventDefault();
            var searchVal = $(this).val();
            var v_token = "{{csrf_token()}}";
            $.get(base_url + '/chat/search', {
                "_token": v_token,
                "searchVal": searchVal
            }).done(function(data){
                console.log(data);
            });


        });

  </script>
