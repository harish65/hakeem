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
        }
        else{
            var userrole = 'Patient';
        }
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
                var user = response.userid;
                window.location.href= base_url + '/profile/profile-setup-one/'+user;
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

    $(".forgotClick").click(function(e){
        e.preventDefault();
        $("#loginEmailModal").modal("hide");
        $("#resetPassword").modal("show");
       
    });

    $('#guest__forgot').on('submit', function(e){
    e.preventDefault();
  //  alert();
    $(".forgot_password_btn").html('Please Wait...');
    $("#guest__forgot .email_error").html(''); 
    $("#guest__forgot .main_error").html(''); 
    var $this = $(this);
    $.ajax({
        type: "post",
        url: base_url+'/forgot/password',
        data: $this.serializeArray(),
        dataType: "json",
        success: function (response) {
            console.log(response);
        $(".forgot_password_btn").html('Submit'); 
        $('#resetPassword').modal('hide');
        $('#resetPassword2').modal('show');
        $('#resetPassword2 .user_id').val(response.user_id);
            // location.reload();
        },
        error: function (jqXHR) {
        $(".forgot_password_btn").html('Submit'); 
          var response = $.parseJSON(jqXHR.responseText);
          if(response.message){
              $("#guest__forgot .main_error").html(response.message);
          }
        }
    });
  });


  $('#guest__pass').on('submit',function(e){
        e.preventDefault();

        var $this = $(this);
        $('.forgot_password_btn').html('Please Wait...');
        $("#guest__pass .main_error").html('');
        $("#guest__pass .new_password_error").html('');
        $("#guest__pass .confirm_password_error").html('');
        var _token = "{{  csrf_token() }}";
        $.ajax({
            type: "post",
            url: base_url+'/custom/reset-password',
            data: $this.serialize(),
            dataType: "json",
            success: function (response) {
              $(".forgot_password_btn").html('Submit');
              Swal.fire(
                  'Success!',response.message,'success'
                ).then((result)=>{
                  location.reload();
                });
            },
            error: function (jqXHR) {
            $(".forgot_password_btn").html('Submit'); 
              var response = $.parseJSON(jqXHR.responseText);
              if(response.errors!==undefined){
                if(response.errors.new_password!==undefined){
                  $("#guest__pass .new_password_error").html(response.errors.new_password);
                }else if(response.errors.confirm_password!==undefined){
                    $("#guest__pass .confirm_password_error").html(response.errors.confirm_password);
                }
              }else{
                $("#guest__pass .main_error").html(response.message);
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
                var user = response.userid;
                window.location.href= base_url + '/edit/profile/';
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

                if(response.rolename == 'service_provider')
                {
                    if(response.account_verified == "true" && response.signuptype == 'email')
                    {
                      
                           // window.location.href = base_url + '/web/doctor'; 
                        window.location.href = base_url + '/profile/profile-setup-one/'+ response.userid;
                      
                       
                    }
                    if(response.account_verified == "false" && response.signuptype == 'email')
                    {
                      
                            window.location.href = base_url + '/user/requests'; 
                        //window.location.href = base_url + '/profile/profile-setup-one/'+ response.userid;
                      
                       
                    }
                    
                    if(response.account_verified == "true" && response.signuptype == null)
                    {
                      
                        // window.location.href = base_url + '/user/doctor'; 
                        window.location.href = base_url + '/profile/profile-setup-one/'+ response.userid;
                      
                       
                    }
                    if(response.account_verified == "false" &&  response.signuptype == null)
                    {
                      
                           window.location.href = base_url + '/user/requests'; 
                       // window.location.href = base_url + '/profile/profile-setup-one/'+ response.userid;
                      
                       
                    }
                   
                   
                }
                
                
              
                if(response.rolename == 'customer' && response.applyoption != 'register')
                { 
                    window.location.href = base_url + '/user/patient';
                }
                if(response.rolename == 'customer' && response.applyoption == 'register')
                { 
                    window.location.href = base_url + '/edit/profile';
                }
                if(response.statuscode == 400)
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
              //  console.log(response);
                if(response.role_name == 'service_provider')
                {
                    $('#loginEmailModal').modal('hide');
                    if(response.account_verified == "false")
                    {
                        window.location.href = base_url + '/user/requests';    
                    }
                    else{
                        window.location.href = base_url + '/profile/profile-setup-one/'+ response.userid;
                    }       
                    
                    
                   
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
      e.preventDefault();
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
          $(this).parent().find(".hide-password").hide();
          $(this).parent().find(".show-password").show();
        }
      });

      $('.editbank').click(function(e){
        e.preventDefault();
        var bankid = $(this).attr('data-id');

        $.post("{{ url('/service_provider/add_bank') }}", { _token: "{{ csrf_token() }}", bank_id: bankid  }).done(function(data){
                console.log(data);
        });
    });
   

});