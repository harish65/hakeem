<footer>
    <div class="container">
        <div class="row no-gutters">
            <div class="col-md-12">
                <h4>iEDU</h4>
                <hr>
            </div>
            <div class="row no-gutters">
            <div class="col-md-10 copyright-and-links">
                <span>© 2021 iEducation, Inc.</span>
                <a href="{{ url('/') .'/term-conditions'}}">Terms & Conditions</a>
                <a href="{{ url('/') .'/privacy-policy'}}">Privacy Policy</a>
                <a href="{{ route('about-us') }}">About Us </a>
                <a href="{{ route('contact-us') }}">Contact Us</a>
            </div>
            <div class="col-md-2 text-mob-right">
                <span><img src="{{asset('assets/iedu/images/visa.png')}}" alt=""></span>
            </div>
            </div>
        </div>
    </div>
</footer>

<div class="modal fade" id="wallet_message_container" tabindex="-1">
    <div class="modal-dialog modal-md modal-dialog-center">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Added to Wallet</h5>

                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <p> You need to maintain sufficient balance <span style="opacity: 1 !important;" id="wallet_message"></span> </p>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                <a href="{{ url('/user/wallet') }}" class="btn btn-primary">Add Money</a>
            </div>
        </div>
    </div>
</div>



<!-- Booking Modal HTML -->
<div id="bookingCreatedModal" class="modal fade">
    <div class="modal-dialog modal-confirm">
        <div class="modal-content">
            <div class="modal-header">
                <div class="icon-box">
                    <i class="material-icons">&#xE876;</i>
                </div>
                <h4 class="modal-title w-100">Awesome!</h4>
            </div>
            <div class="modal-body">
                <p class="text-center">Your booking has been created.</p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success btn-block" data-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="booking_successfully_container" tabindex="-1">
    <div class="modal-dialog modal-md modal-dialog-center">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">

                </h5>
                <img src="{{asset('assets/care_connect_live/images/unnamed.jpg')}}" height="150px" width="150px">

            </div>
            <div class="modal-body">
                <h5 id="booking_message" class="text-center"></h5>
            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>

<!-- Enter-Contact Modal -->
<div class="modal fade" id="contact_details2" tabindex="-1" role="dialog" aria-labelledby="login-popupLabel" aria-hidden="true">
    <div class="modal-dialog modal-md ">
        <div class="modal-content ">
            <div class="modal-header d-block pt-3 px-4 pb-0 border-0">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title login-head">Update</h4>
                <!-- <p class="text-14 mt-1">We need your phone number to identify you</p> -->
                <hr>
            </div>
            <div class="modal-body px-4 pt-2 pb-3" id="login_form" name="c-form">
                <div class="msgdivsuccess text-success" style="display: none;"></div>
                <div class="msgdiv text-danger" style="display: none;"></div>
                <h6>Enter your contact number</h6>
                <form class="form-default" id="otp_login3" role="form" action="#" method="POST">
                    @csrf
                    <div class="form-group mb-4">
                        <div class="row no-gutters col-spacing">
                            <div class="col-12 phon_field">
                                <input type="tel" style="width:100%;" onkeypress="return isNumberKey(event)" onchange="return isNumberKey(event)" id="phone_update" name="phone" class="form-control">
                                {{-- <input type="hidden" class="phone" name="phone" value=""> --}}
                                <input type="hidden" id="role_type" name="role_type" value="@if(Auth::check()){{Auth::user()->role}} @else {{'service_provider'}} @endif">
                                <input type="hidden" id="type" name="type" value="">
                                <input type="hidden" id="email" name="email" value="@if(Auth::check()){{Auth::user()->email}}@endif">
                                <input type="hidden" id="userid" name="userid" value="@if(Auth::check()){{Auth::user()->id}}@endif">
                                <input type="hidden" name="country_code" id="country_code" value="@if(Auth::check()){{Auth::user()->country_code}}@endif">
                                <span class="alert-danger phone"></span><br>

                            </div>

                        </div>
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn rounded w-100 radius-btn" id="nextbtn"><span>Next</span></button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>
<div class="modal fade" id="contact_details2" tabindex="-1" role="dialog" aria-labelledby="login-popupLabel" aria-hidden="true">
    <div class="modal-dialog modal-md ">
        <div class="modal-content ">
            <div class="modal-header d-block pt-3 px-4 pb-0 border-0">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title login-head">Update</h4>
                <!-- <p class="text-14 mt-1">We need your phone number to identify you</p> -->
                <hr>
            </div>
           
            <div class="modal-body px-4 pt-2 pb-3" id="login_form" name="c-form">
                <div class="msgdivsuccess text-success" style="display: none;"></div>
                <div class="msgdiv text-danger" style="display: none;"></div>
                <h6>Enter your contact number</h6>
                <form class="form-default" id="otp_login3" role="form" action="#" method="POST">
                    @csrf
                    <div class="form-group mb-4">
                        <div class="row no-gutters col-spacing">
                            <div class="col-12 phon_field">
                                <input type="tel" style="width:100%;" onkeypress="return isNumberKey(event)" onchange="return isNumberKey(event)" id="phone_update" name="phone" class="form-control">
                                {{-- <input type="hidden" class="phone" name="phone" value=""> --}}
                                <input type="hidden" id="role_type" name="role_type" value="@if(Auth::check()){{Auth::user()->roles[0]->name}}@endif">
                                <input type="hidden" id="type" name="type" value="">
                                <input type="hidden" id="email" name="email" value="@if(Auth::check()){{Auth::user()->email}}@endif">
                                <input type="hidden" id="userid" name="userid" value="@if(Auth::check()){{Auth::user()->id}}@endif">
                                <input type="hidden" name="country_code" id="country_code" value="@if(Auth::check()){{Auth::user()->country_code}}@endif">
                                <span class="alert-danger phone"></span><br>

                            </div>

                        </div>
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn rounded w-100 radius-btn" id="nextbtn"><span>Next</span></button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>
<script>
      $('.update_phone').click(function(e)
{
    e.preventDefault();
    $('#contact_details2').modal('show');

});
$("#contact_details2 #nextbtn").click(function (e) {
        e.preventDefault();
        let phoneno = $('#contact_details2 #phone_update').val();
        console.log("==>>>>",phoneno)
        let role_type = $('#contact_details2 #role_type').val();
        let country_code = $('#contact_details2 #country_code').val();
        var v_token = "{{csrf_token()}}";
        $("#login_form .phone").html('');
        $("#login_form .main_error").html('');
        if (!phoneno) {
            $("#login_form #phone_update").html("The phone field is required.");
            $('#login_form #phone_update').css('border','1px solid red');
            //$('#contact_details-popup').modal('show');
            return false;
        }

        $("#login_btn span").html('wait');

        $.ajax({
            type: "post",
            dataType: "json",
            url: base_url + '/update/phone',
            data: $('#otp_login3').serialize(),
            success: function (response) {
                //var data = response;
                 console.log("ppppppppppp-------->>",response);

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
</script>