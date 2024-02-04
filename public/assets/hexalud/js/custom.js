var AUTH_TYPE_LOGIN = "login";
var AUTH_TYPE_SIGNUP = "signup";

var AUTH_USER_TYPE_DOCTOR = "service_provider";
var AUTH_USER_TYPE_PATIENT = "customer";

var authType = AUTH_TYPE_LOGIN;
var showSuggestion = false;



function showLoginForm(type) {
    $('#users').modal('hide');
    $('#loginModal').modal('show');
    $("#loginform .phone").html("");
    $('#loginform #phone').css('border','');

    if (type == AUTH_USER_TYPE_PATIENT) {
        $('.social-login-section').show();
    } else {
        $('.social-login-section').hide();
    }
}
function toggleFieldsByUserType(userType) {
    if (userType == AUTH_USER_TYPE_DOCTOR) {
        $('.doctor-fields').show();
        $('.patient-fields').hide();
    } else if (userType == AUTH_USER_TYPE_PATIENT) {
        $('.doctor-fields').hide();
        $('.patient-fields').show();
    }
}

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


$(document).ready(function ($) {
    $(".noti-bar").click(function(){
        $("#notifications").toggleClass("open");
      });
    $('.drop2').click(function(){
        $("#notifications").toggleClass("close");
      });
    $('.custom_alert')
        .fadeIn(3000)
        .delay(100)
        .fadeTo(1000, 0.4)
        .delay(100)
        .fadeTo(1000,1)
        .delay(100)
        .fadeOut(3000);

    $("#users #doctor_sign_up_modal_btn").click(function (e) {
        e.preventDefault();
        let role_type = $(this).data('type');
        $('#loginModal').modal('show');
        $('#loginModal #phone').val('');
        $("#loginform .phone").html("");
        $('#loginform #phone').css('border','');
        $("#loginModal #code").val($("#loginModal #code option:first").val());
        $('#users').modal('hide');
        $('#sign-up #role_type').val(role_type);
        $('#loginModal #role_type').val(role_type);
        $('#loginEmailModal #role_type').val(role_type);

        if(role_type == 'service_provider')
        {
            var userrole = 'Doctor';
            var userrole_href = base_url + '/redirect?type=facebook&role=doctor';
            var google_href = base_url + '/redirect?type=google&role=doctor';
        }
        else{
            var userrole = 'Patient';
            var userrole_href = base_url + '/redirect?type=facebook&role=patient';
            var google_href = base_url + '/redirect?type=google&role=patient';
        }
        $('.social_login').attr('href',userrole_href);
        $('.social_login_google').attr('href',google_href);
        // if (authType == AUTH_TYPE_SIGNUP) {
        //     $('#sign-up').modal('show');
        //     $('#sign-up #email').val('');
        //     $('#sign-up #password').val('');
        //     $('#users').modal('hide');
        //     $('#sign-up #signup_modal_title').text('Sign up as a Doctor with');
        //     $('.social-login-section').hide();
        // } else {
        //     showLoginForm(AUTH_USER_TYPE_CREATOR);
        // }
        // toggleFieldsByUserType(AUTH_USER_TYPE_CREATOR);
    });
    $("#users #patient_sign_up_modal_btn").click(function (e) {
        e.preventDefault();
        let role_type = $(this).data('type');
        $('#loginModal').modal('show');
        $('#loginModal #phone').val('');
        $("#loginform .phone").html("");
        $('#loginform #phone').css('border','');
        $("#loginModal #code").val($("#loginModal #code option:first").val());
        $('#users').modal('hide');
        $('#sign-up #role_type').val(role_type);
        $('#loginModal #role_type').val(role_type);
        $('#loginEmailModal #role_type').val(role_type);
        if(role_type == 'service_provider')
        {
            var userrole = 'Doctor';
            var userrole_href = base_url + '/redirect?type=facebook&role=doctor';
            var google_href = base_url + '/redirect?type=google&role=doctor';
        }
        else{
            var userrole = 'Patient';
            var userrole_href = base_url + '/redirect?type=facebook&role=patient';
            var google_href = base_url + '/redirect?type=google&role=patient';
        }

        $('.social_login').attr('href',userrole_href);
        $('.social_login_google').attr('href',google_href);
    });


    $('#loginModal #loginnextbtn').click(function(e){
        e.preventDefault();
        let phoneno = $('#loginModal #phone').val();
        let role_type = $('#loginModal #role_type').val();
        let country_code = $('#loginModal #country_code').val();
        var v_token = "{{csrf_token()}}";
        $("#loginform .phone").html('');
        $("#loginform .main_error").html('');
        if (!phoneno) {
            $("#loginform .phone").html("The phone field is required.");
            $('#loginform #phone').css('border','1px solid red');
            //$('#contact_details-popup').modal('show');
            return false;
        }
        if(phoneno.length!=10)
        {
            $("#loginform .phone").html("The phone no. must be 10 digits.");
            $('#loginform #phone').css('border','1px solid red');
            return false;
        }
        $("#login_btn span").html('wait');

        $.ajax({
            type: "post",
            dataType: "json",
            url: base_url + '/users/login',
            data: $('#loginform').serialize(),
            success: function (response) {
                //var data = response;
                //  console.log(data.data);

                $('#loginModal').modal('hide');

                $('#otp-popup').modal('show');
                $('#otp-popup .phonenumber').html('');
                $('#otp-popup .role_type').val('');
                $('#otp-popup .phone').val('');
                $('#otp-popup .country_code').val('');
                $('#otp-popup #digit-1').val('');
                $('#otp-popup #digit-2').val('');
                $('#otp-popup #digit-3').val('');
                $('#otp-popup #digit-4').val('');
                $('#otp-popup #applyoption').val('');
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
                    $("#loginModal .msgdiv").text(jqXHR.responseJSON.message);
                    $("#loginModal .msgdiv").show();
                    $('#loginModal .msgdiv').fadeIn('slow').delay(2000).fadeOut('slow');
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

    })

    // $("#contact_details #nextbtn").click(function () {
    //     // $('#otp-popup').modal('show');
    //     //    $('#contact_details #phone').val('');

    //     // TODO
    //     // check form is valid
    //     // all inputs are filled

    //     $('#contact_details').modal('hide');
    // });
    $("#sign_up_modal").click(function (e) {
        e.preventDefault();
        let role_type = $('#sign-up #role_type').val();
        // alert(role_type);
        authType = AUTH_TYPE_SIGNUP;
        $('#contact_details').modal('hide');
        $('#users').modal('hide');
        $('#sign-up').modal('show');
        //let role_type = $('#sign-up #role_type').val();
        if(role_type == 'service_provider')
        {
            var userrole = 'Doctor';

        }
        else{
            var userrole = 'Patient';

        }

        $('#signup_modal_title').html('SignUp For' + ' ' + userrole);
        if (role_type == 'service_provider') {
            $('#users #doctor_sign_up_modal_btn').trigger('click');
        } else {
            $('#users #patient_sign_up_modal_btn').trigger('click');
        }
    });

    $('#contact_detail .signup_email').click(function(e)
    {
        let role_type = $('#sign-up #role_type').val();
        if(role_type == 'service_provider')
        {
            $('#signupdoctorEmailModal').modal('show');
            $('#signupdoctorEmailModal #role_type').val(role_type);
        }
        else{
            $('#signuppatientEmailModal').modal('show');
            $('#signuppatientEmailModal #role_type').val(role_type);
        }
    });


    $(".login_sign_up_modal").click(function (e) {
        e.preventDefault();
        let role_type = $('#sign-up #role_type').val();
        // alert(role_type);
        authType = AUTH_TYPE_SIGNUP;
        $('#loginEmailModal').modal('hide');
        $('#loginModal').modal('hide');
        $('#users').modal('hide');
        $('#sign-up').modal('show');
        if(role_type == 'service_provider')
        {
            var userrole = 'Doctor';
            var userrole_href = base_url + '/redirect?type=facebook&role=doctor';
            var google_href = base_url + '/redirect?type=google&role=doctor';
        }
        else{
            var userrole = 'Patient';
            var userrole_href = base_url + '/redirect?type=facebook&role=patient';
            var google_href = base_url + '/redirect?type=google&role=patient';
        }
        $('.social_login').attr('href',userrole_href);
        $('.social_login_google').attr('href',google_href);
        //let role_type = $('#sign-up #role_type').val();
        $('#sign-up #signup_modal_title').html('SignUp For' + ' ' + userrole);
        if (role_type == 'service_provider') {
            $('#users #doctor_sign_up_modal_btn').trigger('click');
        } else {
            $('#users #patient_sign_up_modal_btn').trigger('click');
        }
    });


    $('.login_email').click(function(e){
        e.preventDefault();
        $('#loginModal').modal('hide');
        $('#loginEmailModal').modal('show');
        $('#email').val('');
        $('#password').val('');
        $("#loginEmailModal .email_error").html('');
        $('#loginform #email').css('border','');

        $("#loginEmailModal .email_password").html('');
        $('#loginform #password').css('border','');
        $("#loginEmailModal .msgdiv").text('');
        $("#loginEmailModal .msgdivsuccess").text('');
        $("#loginEmailModal #email").val('');
        $("#loginEmailModal #password").val('');
    });


    $(".login_btn_modal").click(function (e) {
        e.preventDefault();
        $('#sign-up').modal('hide');
        $('#users').modal('hide');
        $('#contact_details').modal('hide');
        $('#loginModal').modal('show');
        $("#loginform .phone").html("");
        $('#loginform #phoneno').css('border','');

    });
    $("#sign-up #signup_phone_number").click(function () {
        $('#sign-up').modal('hide');
        $('#users').modal('hide');
        $('#contact_details').modal('show');
        $('#contact_details #phoneno').val('');
        $("#contact_details .phone").html("");
        $('#contact_details #phoneno').css('border','');
        $("#contact_details #code").val($("#contact_details #code option:first").val());
        let role_type = $('#sign-up #role_type').val();
        $('#sign-up #role_type').val(role_type);
        $('#contact_details #role_type').val(role_type);

    });
    $("#sign-up #signup_email").click(function () {
        $('#sign-up').modal('hide');
        $('#users').modal('hide');
        let role_type = $('#sign-up #role_type').val();
        if(role_type == 'customer')
        {
            $('#signuppatientEmailModal').modal('show');
            $('#signuppatientEmailModal #name').val('');
            $('#signuppatientEmailModal #email').val('');
            $('#signuppatientEmailModal #password').val('');
            $('#sign-up #role_type').val(role_type);
            $('#signuppatientEmailModal #role_type').val(role_type);

        }
        if(role_type == 'service_provider')
        {
            $('#signupdoctorEmailModal').modal('show');
            $('#signupdoctorEmailModal #name').val('');
            $('#signupdoctorEmailModal #email').val('');
            $('#signupdoctorEmailModal #password').val('');
            $('#sign-up #role_type').val(role_type);
            $('#signupdoctorEmailModal #role_type').val(role_type);


        }

    });
    $('#signupdoctorEmailModal #sign_upnextbtn').click(function (e) {
        e.preventDefault();

        // validate

        var email =  $('#SignupDoctorEmailForm input[name=email]').val();
        var pass = $('#SignupDoctorEmailForm input[name=password]').val();
        // $("#loginEmailModal .email_error").html('');
        // $("#loginEmailModal .password_error").html('');

        if(email == ''){
            $("#signupdoctorEmailModal .msgdiv").text('Email is Required');
            $("#signupdoctorEmailModal .msgdiv").show();
            $('#SignupDoctorEmailForm input[name=email]').css('border','1px solid red');
            return false;
        }
        else
        {
            $("#signupdoctorEmailModal .msgdiv").hide();
            $('#SignupDoctorEmailForm input[name=email]').css('border','');
        }

        if(pass == ''){
            $("#signupdoctorEmailModal .msgdiv").text('Password is Required');
            $("#signupdoctorEmailModal .msgdiv").show();
            $('#SignupDoctorEmailForm input[name=password]').css('border','1px solid red');
            return false;
        }
        else
        {
            $('#SignupDoctorEmailForm input[name=password]').css('border','');
            $("#signupdoctorEmailModal .msgdiv").hide();
        }

        $.ajax({
            type: "post",
            dataType: "json",
            url: base_url + '/users/register',
            data: $('#SignupDoctorEmailForm').serialize(),
            success: function (response) {
              //  console.log(response);
                $("#signupdoctorEmailModal").modal('hide');
                window.location.href = base_url + '/profile/profile-setup-one/'+ response.userid;
                // $('#contact_details').modal('show');
                // $('#contact_details #phoneno').val('');
                // $("#contact_details .phone").html("");
                // $('#contact_details #phoneno').css('border','');
                // $("#contact_details #code").val($("#contact_details #code option:first").val());
                // $('#contact_details #role_type').val(response.rolename);
                // $('#contact_details #type').val(response.signuptype);
                // $('#contact_details #userid').val(response.userid);
                // $('#contact_details #email').val(response.email);

            },
            error: function (jqXHR) {
                $("#login_btn span").html('Next');

                if (jqXHR.responseJSON.status === "error") {
                    $("#signupdoctorEmailModal .msgdiv").text(jqXHR.responseJSON.message);
                    $("#signupdoctorEmailModal .msgdiv").show();
                    $('#signupdoctorEmailModal .msgdiv').fadeIn('slow').delay(2000).fadeOut('slow');
                }
            }
        });
    });

    $('#sign_upnextbtn').click(function (e) {
        e.preventDefault();
        var fd = new FormData($("#SignuppatientEmailForm")[0]);
        $.ajax({
            type: "post",
            dataType: "json",
            url: base_url + '/users/register',
            cache: false,
            contentType: false,
            processData: false,
            async: false,
            data: fd,
            //data: $('#SignuppatientEmailForm').serialize(),
            success: function (response) {
                console.log(response);
                if(response.status == 'success')
                {
                $('#signuppatientEmailModal').modal('hide');
                window.location.href = base_url + '/edit/profile';
                // $('#contact_details').modal('show');
                // $('#contact_details #phoneno').val('');
                // $("#contact_details .phone").html("");
                // $('#contact_details #phoneno').css('border','');
                // $("#contact_details #code").val($("#contact_details #code option:first").val());
                // $('#contact_details #role_type').val(response.rolename);
                // $('#contact_details #email').val(response.email);
                // $('#contact_details #userid').val(response.userid);
                // $('#contact_details #type').val(response.signuptype);
                }
            },
            error: function (jqXHR) {
                $("#login_btn span").html('Next');

                if (jqXHR.responseJSON.status === "error") {
                    $("#signuppatientEmailModal .msgdiv").text(jqXHR.responseJSON.message);
                    $("#signuppatientEmailModal .msgdiv").show();
                   $('#signuppatientEmailModal .msgdiv').fadeIn('slow').delay(2000).fadeOut('slow');
                }
            }
        });
    });


    // $('#code').on('change',function(){
    //    let code =  $(this).val();
    //    $('#country_code').val(code);
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
        if(phoneno.length!=10)
        {
            $("#login_form .phone").html("The phone no. must be 10 digits.");
            $('#login_form #phone').css('border','1px solid red');
            return false;
        }

        $("#login_btn span").html('wait');

        $.ajax({
            type: "post",
            dataType: "json",
            url: base_url + '/users/register',
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
            url: base_url + '/users/verifyPhone',
            data: $('#otpform').serialize(),
            success: function (response) {
                //var data = response;
                  console.log(response);
                  console.log(response.account_step);
                // return false;


                if(response.rolename == 'service_provider')
                {
                    if(response.account_step == 4)
                    {
                        window.location.href = base_url + '/user/doctor';
                        // window.location.href = base_url + '/profile/profile-setup-one/'+ response.userid;
                    }else if(response.account_verified == "true" && response.signuptype == 'email')
                    {

                           // window.location.href = base_url + '/web/doctor';
                        window.location.href = base_url + '/profile/profile-setup-one/'+ response.userid;


                    }
                    else if(response.account_verified == "false" && response.signuptype == 'email')
                    {

                            window.location.href = base_url + '/user/doctor';
                        //window.location.href = base_url + '/profile/profile-setup-one/'+ response.userid;


                    }

                    else if(response.account_verified == "true" && response.signuptype == null && response.applyoption == "login")
                    {

                        window.location.href = base_url + '/user/doctor';
                        // window.location.href = base_url + '/profile/profile-setup-one/'+ response.userid;


                    }
                    else if(response.account_verified == "true" && response.signuptype == null)
                    {

                        // window.location.href = base_url + '/user/doctor';
                        window.location.href = base_url + '/profile/profile-setup-one/'+ response.userid;


                    }
                    else if(response.account_verified == "false" &&  response.signuptype == null)
                    {

                            window.location.href = base_url + '/user/doctor';
                        //window.location.href = base_url + '/profile/profile-setup-one/'+ response.userid;


                    }


                }



                if(response.rolename == 'customer' && response.applyoption != 'register')
                {
                    window.location.href = base_url + '/user/patient';
                }
                else if(response.rolename == 'customer' && response.applyoption == 'register')
                {
                    window.location.href = base_url + '/edit/profile';
                }
                else if(response.statuscode == 400)
                {
                    window.location.href = base_url + '/home';
                }

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
            url: base_url + '/users/resendotp',
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

    // $('input').keyup(function(){
    //     if($(this).val().length==$(this).attr("maxlength")){
    //         $(this).next().focus();
    //     }
    // });


    $('.digit-group').find('input').each(function() {
        $(this).attr('maxlength', 1);

        $(this).on('keyup', function(e) {

            var parent = $($(this).parent());

            if(e.keyCode === 8 || e.keyCode === 37) {
                var prev = parent.find('input#' + $(this).data('previous'));

                if(prev.length) {
                    $(prev).select();
                }
            } else if((e.keyCode >= 48 && e.keyCode <= 57) || (e.keyCode >= 65 && e.keyCode <= 90) || (e.keyCode >= 96 && e.keyCode <= 105) || e.keyCode === 39) {
                var next = parent.find('input#' + $(this).data('next'));

                if(next.length) {
                    $(next).select();
                } else {
                    if(parent.data('autosubmit')) {
                        parent.submit();
                    }
                }
            }
        });
    });

    $('#loginEmailModal #loginnextbtn').click(function(e){
        e.preventDefault();
        var email =  $('#loginEmailModal #email').val();
        var pass = $('#loginEmailModal #password').val();
        // $("#loginEmailModal .email_error").html('');
        // $("#loginEmailModal .password_error").html('');

        if(email == ''){
            $("#loginEmailModal .email_error").html('Email is Required');
            $('#loginform #email').css('border','1px solid red');
            return false;
        }
        else
        {
            $("#loginEmailModal .email_error").hide();
            $('#loginform #email').css('border','');
        }
        if(IsEmail(email) == false){
            $("#loginEmailModal .email_error").html('Please Enter Valid Email');
            $('#loginform #email').css('border','1px solid red');
            return false;
        }
        else
        {
            $("#loginEmailModal .email_error").hide();
            $('#loginform #email').css('border','');
        }

        if(pass == ''){
            $("#loginEmailModal .email_password").html('Password is Required');
            $('#loginform #password').css('border','1px solid red');
            return false;
        }
        else
        {
            $("#loginEmailModal .email_password").hide();
            $('#loginform #password').css('border','');
        }


        $.ajax({
            type: "post",
            dataType: "json",
            url: base_url + '/users/login',
            data: $('#loginEmailModal #loginform').serialize(),
            success: function (response) {
                if(response.role_name == 'service_provider')
                {
                     $('#loginEmailModal').modal('hide');
                    if(response.account_step == 4)
                    {
                        window.location.href = base_url + '/user/doctor';
                        // window.location.href = base_url + '/profile/profile-setup-one/'+ response.userid;
                    }else{
                        // window.location.href = base_url + '/user/doctor';
                        window.location.href = base_url + '/profile/profile-setup-one/'+ response.userid;
                    }
                    // if(response.account_verified == "false")
                    // {
                    //     window.location.href = base_url + '/user/doctor';
                    // }
                    // else{
                    //     window.location.href = base_url + '/profile/profile-setup-one/'+ response.userid;
                    // }



                }
                if(response.role_name == 'customer')
                {
                    $('#loginEmailModal').modal('hide');
                    window.location.href = base_url + '/user/patient';
                }

                // $("#otp-popup .msgdivsuccess").text(response.message);
                //   $("#otp-popup .msgdivsuccess").show();
                //   $('#otp-popup .msgdiv').fadeIn('slow').delay(2000).fadeOut('slow');
            },
            error: function (jqXHR) {

                if (jqXHR.responseJSON.status === "error") {
                    // var msg = jqXHR.message;
                    // console.log(jqXHR.responseJSON.message);
                    // alert(jqXHR.responseJSON.message);
                    $("#loginEmailModal .msgdiv").text(jqXHR.responseJSON.message);
                    $("#loginEmailModal .msgdiv").show();
                    $('#loginEmailModal .msgdiv').fadeIn('slow').delay(2000).fadeOut('slow');
                }
            }
        });

    });


    $('.choose_category').click(function(e)
    {
        e.preventDefault();

        // get category id from data-id
        var _id = $(this).attr('data-id');
        var user_id = $(this).attr('data-user_id');
        $('#myModal #user_id').val(user_id);

        // empty old data
        $("#doc_list").empty();

        $("#ServiceModal #add_doc").attr('data-cat-id', _id);

        // get filled docs (from selected category)
        $.getJSON(_category_docs_url+'?cat_id='+ _id, function(data){
             console.log(data);
            $.each(data, function(key, item){
                var _file = `
                    <tr>
                        <td>`+item.title+`<br><span class="badge badge-secondary">`+ item.cat_info +`</span></td>
                        <td>
                            <div class="document-image-wrap">
                                <img src="`+item.file_name+`"/>
                            </div>
                        </td>
                        <td>
                            <a href="`+_doc_edit_path+item.id+`" class="edit_doc" data-id="`+item.id+`"><i class="fas fa-edit mr-2"></i></a>
                            <a href="`+_doc_del_path+item.id+`" class="delete_doc" data-id="`+item.id+`"><i class="fas fa-trash-alt"></i></a>
                        </td>
                    </tr>
                `;
                $("#doc_list").append(_file);
            });
        });

        // show docs filled by user

        window.$("#ServiceModal").modal("show");

    });

    $("body").on("click", "#ServiceModal .delete_doc", function(e){

        var answer = confirm("Do you want to delete ?");

        if(!answer) {
            e.preventDefault();
        }
    });

    $("body").on("click", "#ServiceModal .edit_doc", function(e){

        window.$("#ServiceModal").modal("hide");

        e.preventDefault();

        // clear old data
        $("#myModal_edit input[name=title]").val('');
        $("#myModal_edit input[name=description]").val('');
        $("#myModal_edit #doc_cats_edit").empty();

        var _id = $(this).attr("data-id");

        // fetch data based on id
        $.getJSON(_doc_edit_path+_id, function(data){
           //    console.log(data);

            // fill modal with data

            // TODO
            // add correct path with domain
            $("#myModal_edit img.user-profile").attr('src', data.file_name);

            $("#myModal_edit input[name=doc_id]").val(data.id);
            $("#myModal_edit input[name=title]").val(data.title);
            $("#myModal_edit input[name=description]").val(data.description);

            var _option = `
                <option value="`+data.additional_detail_id+`">`+data.additional_detail_name+`</option>
            `;
            $("#doc_cats_edit").append(_option);
        });

        // show modal
        window.$("#myModal_edit").modal("show");
    });

    $("#ServiceModal #add_doc").click(function(e){
        e.preventDefault();

        // clear old inputs
        $("#doc_cats").empty();
        $("#myModal input[name=title]").val('');
        $("#myModal input[name=description]").val('');

        window.$("#ServiceModal").modal("hide");

        var _id = $("#ServiceModal #add_doc").attr('data-cat-id');

        var _total_doc_options = 0;

        // get categories from ajax
        $.getJSON(_category_id_url+'?cat_id='+_id, function(data){
            _total_doc_options = data.length;
            $.each(data, function(key, item){
                console.log(item.name);
                var _option = `
                    <option value="`+item.id+`">`+item.name+`</option>
                `;
                $("#doc_cats").append(_option);
            });

            if(_total_doc_options > 0)
            {
                window.$("#myModal").modal("show");
            }
            else
            {
                window.$("#myModal_blank").modal("show");
            }
        });
    });

    if(_next_needed_doc_id != null && _next_needed_cat_id != null)
    {
        // clear old inputs
        $("#doc_cats").empty();
        $("#myModal input[name=title]").val('');
        $("#myModal input[name=description]").val('');

        window.$("#ServiceModal").modal("hide");

        var _id = _next_needed_cat_id;

        var _total_doc_options = 0;

        // get categories from ajax
        $.getJSON(_category_id_url+'?cat_id='+_id, function(data){
            _total_doc_options = data.length;
            $.each(data, function(key, item){
                console.log(item.name);
                var _option = `
                    <option value="`+item.id+`">`+item.name+`</option>
                `;
                $("#doc_cats").append(_option);
            });

            if(_total_doc_options > 0)
            {
                window.$("#myModal").modal("show");

                $("#doc_cats").val(_next_needed_doc_id);
            }
            else
            {
                window.$("#myModal_blank").modal("show");
            }
        });

    }
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

  $("#image_uploads").change(function() {
    readURLImg(this);
  });

  $("#image_uploads_edit").change(function() {
    readURLImg(this);
  });

  $('.availability').click(function(e)
  {
      var serviceid =  $(this).attr('data-id');
      var categoryid =  $(this).attr('data-category-id');
     // alert(serviceid);
      $('#addAvailbityModal').modal('show');
      $('#addAvailbityModal .serviceid').val(serviceid);
      $('#addAvailbityModal .categoryid').val(categoryid);
  });

  $(".editavailability").click(function(e){

    e.preventDefault();

    $("#editAvailbityModal #customFields").empty();

    var _id = $(this).attr('data-id');
    var _categoryid = $(this).attr('data-category-id');

    $.getJSON(_availbility_edit_path + _id, function(data){
        console.log(data);

        $("#editAvailbityModal input[name=service_id]").val(_id);
        $("#editAvailbityModal input[name=category_id]").val(_categoryid);


        $.each(data.days, function(key, val){
            console.log(val);
            $('#editAvailbityModal input[name="options[]"][value='+val+']').prop("checked", true);
            $('#editAvailbityModal input[name="options[]"][value='+val+']').closest(".btn").addClass("active");
        });

        $.each(data.start_slots, function(key, val){

            var _item = `
                <div class="new_row row align-items-center">
                    <div class="col-11 pr-0 interv_div">
                        <div class="row common-form">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>From</label>
                                    <input class="form-control" type="time" placeholder="11:00 am" name="start_time[]" required value="`+data.start_slots[key]+`">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>To</label>
                                    <input class="form-control" type="time" placeholder="11:00 am" name="end_time[]" required value="`+data.end_slots[key]+`">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-1">
                        <label></label>
                        <a class="remCF" href="#"><i class="fas fa-trash-alt"></i></a>
                    </div>
                </div>`;

            $("#editAvailbityModal #customFields").append(_item);

        });

        $("#editAvailbityModal").modal('show');
    });
  })

  $('#addAvailbityModal .newrow').click(function(){
   $("#addAvailbityModal #customFields").append('<div class="new_row row align-items-center"><div class="col-11 pr-0"><div class="row common-form"><div class="col-sm-6"><div class="form-group"><label>From</label><input class="form-control" type="time" placeholder="11:00 am" name="start_time[]" required ></div></div><div class="col-sm-6"><div class="form-group"><label>To</label><input class="form-control" type="time" placeholder="11:00 am" name="end_time[]" required></div></div></div></div><div class="col-1"><label></label> <a class="remCF" href="#"><i class="fas fa-trash-alt"></i></a></div></div>');
  });

  $('#editAvailbityModal .newrow').click(function(){
    $("#editAvailbityModal #customFields").append('<div class="new_row row align-items-center"><div class="col-11 pr-0"><div class="row common-form"><div class="col-sm-6"><div class="form-group"><label>From</label><input class="form-control" type="time" placeholder="11:00 am" name="start_time[]" required ></div></div><div class="col-sm-6"><div class="form-group"><label>To</label><input class="form-control" type="time" placeholder="11:00 am" name="end_time[]" required></div></div></div></div><div class="col-1"><label></label> <a class="remCF" href="#"><i class="fas fa-trash-alt"></i></a></div></div>');
   });


  $("#addAvailbityModal #customFields").on('click','.remCF',function(){
      // alert("asda");
      $(this).closest('.new_row').remove();
      // $(this).parent(".new_row").remove();
  });
  $("#editAvailbityModal #customFields").on('click','.remCF',function(){
    // alert("asda");
    $(this).closest('.new_row').remove();
    // $(this).parent(".new_row").remove();
});

 $( "#addAvailbityModal" ).submit(function( e ) {

    //window.$("#addAvailbityModal").modal("hide");

    e.preventDefault();

    // clear old data
    $("#addAvailbityModal input[name=start_time]").val('');
    $("#addAvailbityModal input[name=end_time]").val('');
    $("#addAvailbityModal input[name=options]").val('');

    var _service_id = $('#addAvailbityModal .serviceid').val();

    var _category_id = $('#addAvailbityModal .categoryid').val();

    $.ajax({
        type: "post",
        dataType: "json",
        url: _availbility_add_path,
        data: $('#addAvailbityModal .availbilityform').serialize(),
        success: function (response) {
           // console.log(response);
            if(response.status == 'success')
            {
                window.location.href = base_url + '/profile/profile-step-four/'+ response.userid;
            }
        }
    });
});



$( "#editAvailbityModal" ).submit(function( e ) {

    //window.$("#addAvailbityModal").modal("hide");

    e.preventDefault();

    // clear old data
    // $("#addAvailbityModal input[name=start_time]").val('');
    // $("#addAvailbityModal input[name=end_time]").val('');
    // $("#addAvailbityModal input[name=options]").val('');

    var _service_id = $('#editAvailbityModal .serviceid').val();

    var _category_id = $('#editAvailbityModal .categoryid').val();


    $.ajax({
        type: "post",
        dataType: "json",
        url: _availbility_edit_path,
        data: $('#editAvailbityModal .availbilityform').serialize(),
        success: function (response) {
           // console.log(response);
            if(response.status == 'success')
            {
                window.location.href = base_url + '/profile/profile-step-four/'+ response.userid;
            }
        }
    });

    $('a.amount').on('click',function(e)
    {
        e.prevantDefault();
        alert();
    });

    $(".show-password, .hide-password").on('click', function() {

        var passwordId = $("#userpassword").attr('type');

        if ($(this).hasClass('show-password')) {

          $("#userpassword").attr("type", "text");
          $(this).parent().find(".show-password").hide();
          $(this).parent().find(".hide-password").show();
        } else {

          $("#userpassword").attr("type", "password");
          $(this).parent().find(".hide-password").hide();                  $(this).parent().find(".show-password").show();
        }
      });



      $(document).delegate(".iti__country", "click", function (e) {
        // var primary_mobile_code = $(this).attr("data-dial-code");
        // $("input[name='country_code'").val(primary_mobile_code);
        });

        // EDIT Numbers
        const CountryArr = {
        1: "us",
        7: "ru",
        20: "eg",
        27: "za",
        30: "gr",
        31: "nl",
        32: "be",
        33: "fr",
        34: "es",
        36: "hu",
        39: "va",
        40: "ro",
        41: "ch",
        43: "at",
        44: "gb",
        45: "dk",
        46: "se",
        47: "sj",
        48: "pl",
        49: "de",
        51: "pe",
        52: "mx",
        53: "cu",
        54: "ar",
        55: "br",
        56: "cl",
        57: "co",
        58: "ve",
        60: "my",
        61: "cc",
        62: "id",
        63: "ph",
        64: "nz",
        65: "sg",
        66: "th",
        81: "jp",
        82: "kr",
        84: "vn",
        86: "cn",
        90: "tr",
        91: "in",
        92: "pk",
        93: "af",
        94: "lk",
        95: "mm",
        98: "ir",
        211: "ss",
        212: "eh",
        213: "dz",
        216: "tn",
        218: "ly",
        220: "gm",
        221: "sn",
        222: "mr",
        223: "ml",
        224: "gn",
        225: "ci",
        226: "bf",
        227: "ne",
        228: "tg",
        229: "bj",
        230: "mu",
        231: "lr",
        232: "sl",
        233: "gh",
        234: "ng",
        235: "td",
        236: "cf",
        237: "cm",
        238: "cv",
        239: "st",
        240: "gq",
        241: "ga",
        242: "cg",
        243: "cd",
        244: "ao",
        245: "gw",
        246: "io",
        248: "sc",
        249: "sd",
        250: "rw",
        251: "et",
        252: "so",
        253: "dj",
        254: "ke",
        255: "tz",
        256: "ug",
        257: "bi",
        258: "mz",
        260: "zm",
        261: "mg",
        262: "re",
        263: "zw",
        264: "na",
        265: "mw",
        266: "ls",
        267: "bw",
        268: "sz",
        269: "km",
        290: "sh",
        291: "er",
        297: "aw",
        298: "fo",
        299: "gl",
        350: "gi",
        351: "pt",
        352: "lu",
        353: "ie",
        354: "is",
        355: "al",
        356: "mt",
        357: "cy",
        358: "ax",
        359: "bg",
        370: "lt",
        371: "lv",
        372: "ee",
        373: "md",
        374: "am",
        375: "by",
        376: "ad",
        377: "mc",
        378: "sm",
        380: "ua",
        381: "rs",
        382: "me",
        385: "hr",
        386: "si",
        387: "ba",
        389: "mk",
        420: "cz",
        421: "sk",
        423: "li",
        500: "fk",
        501: "bz",
        502: "gt",
        503: "sv",
        504: "hn",
        505: "ni",
        506: "cr",
        507: "pa",
        508: "pm",
        509: "ht",
        590: "mf",
        591: "bo",
        592: "gy",
        593: "ec",
        594: "gf",
        595: "py",
        596: "mq",
        597: "sr",
        598: "uy",
        599: "cw",
        670: "tl",
        672: "nf",
        673: "bn",
        674: "nr",
        675: "pg",
        676: "to",
        677: "sb",
        678: "vu",
        679: "fj",
        680: "pw",
        681: "wf",
        682: "ck",
        683: "nu",
        685: "ws",
        686: "ki",
        687: "nc",
        688: "tv",
        689: "pf",
        690: "tk",
        691: "fm",
        692: "mh",
        850: "kp",
        852: "hk",
        853: "mo",
        855: "kh",
        856: "la",
        880: "bd",
        886: "tw",
        960: "mv",
        961: "lb",
        962: "jo",
        963: "sy",
        964: "iq",
        965: "kw",
        966: "sa",
        967: "ye",
        968: "om",
        970: "ps",
        971: "ae",
        972: "il",
        973: "bh",
        974: "qa",
        975: "bt",
        976: "mn",
        977: "np",
        992: "tj",
        993: "tm",
        994: "az",
        995: "ge",
        996: "kg",
        998: "uz",
        1242: "bs",
        1246: "bb",
        1264: "ai",
        1268: "ag",
        1284: "vg",
        1340: "vi",
        1345: "ky",
        1441: "bm",
        1473: "gd",
        1649: "tc",
        1664: "ms",
        1670: "mp",
        1671: "gu",
        1684: "as",
        1721: "sx",
        1758: "lc",
        1767: "dm",
        1784: "vc",
        1868: "tt",
        1869: "kn",
        1876: "jm",
        };

        var country_code = $("#country_code");
        const phone = document.querySelector("#phone");

        if(country_code && phone)
        {

            var phone_initialCountry = CountryArr[country_code.val()]   ;


            iti = intlTelInput(phone, {
            initialCountry: phone_initialCountry || "us",
            separateDialCode: true,
            // any initialisation options go here
            // utilsScript:
            // "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/8.4.6/js/utils.js"
            });
        }


});
