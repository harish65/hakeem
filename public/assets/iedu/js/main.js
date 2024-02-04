$(function() {
  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });  
/* -------------------------------------Login------------------------ */
  $('#guest__login').on('submit', function(e){
    e.preventDefault();
    $(".login_btn_text").html('Please Wait...');
    $("#guest__login .email_error").html(''); 
    $("#guest__login .password_error").html(''); 
    $("#guest__login .role_error").html(''); 
    $("#guest__login .main_error").html(''); 
    var $this = $(this);
    $.ajax({
        type: "post",
        url: base_url+'/custom/login',
        data: $this.serializeArray(),
        dataType: "json",
        success: function (response) {
        $(".login_btn_text").html('Login'); 
            location.reload();
        },
        error: function (jqXHR) {
        $(".login_btn_text").html('Login'); 
          var response = $.parseJSON(jqXHR.responseText);
          if(response.errors){
            if(response.errors.email){
              $("#guest__login .email_error").html(response.errors.email[0]);
            }
            if(response.errors.password){
              $("#guest__login .password_error").html(response.errors.password[0]);
            }
            if(response.errors.role){
              $("#guest__login .role_error").html(response.errors.role[0]);
            }
          }else if(response.message){
              $("#guest__login .main_error").html(response.message);
          }
        }
    });
  });

  $("#back_btn_second").on('click',function(e){
      $("#signup_form_cus").toggle();
      $("#set_password").toggle();
  });
  $('#guest__signup_step_first').on('submit', function(e){
    e.preventDefault();
    $(".login_btn_text").html('Please Wait...');
    $("#guest__signup_step_first .first_name_error").html(''); 
    $("#guest__signup_step_first .last_name_error").html(''); 
    $("#guest__signup_step_first .email_error").html(''); 
    $("#guest__signup_step_first .phone_error").html(''); 
    var $this = $(this);
    $.ajax({
        type: "post",
        url: base_url+'/custom/sigup_validation',
        data: $this.serializeArray(),
        dataType: "json",
        success: function (response) {
          $("#first_name").val($("#first_name_first").val());
          $("#last_name").val($("#last_name_first").val());
          $("#email").val($("#email_first").val());
          $("#phone").val($("#phone_first").val());
          $(".login_btn_text").html('Next');
          $("#signup_form_cus").toggle();
          $("#set_password").toggle();
        },
        error: function (jqXHR) {
        $(".login_btn_text").html('Next'); 
          var response = $.parseJSON(jqXHR.responseText);
          if(response.errors){
            if(response.errors.first_name){
              $("#guest__signup_step_first .first_name_error").html(response.errors.first_name[0]);
            }
            if(response.errors.last_name){
              $("#guest__signup_step_first .last_name_error").html(response.errors.last_name[0]);
            }
            if(response.errors.email){
              $("#guest__signup_step_first .email_error").html(response.errors.email[0]);
            }
            if(response.errors.phone){
              $("#guest__signup_step_first .phone_error").html(response.errors.phone[0]);
            }
          }else if(response.message){
              $("#guest__signup_step_first .all_error").html(response.message);
          }
        }
    });
  });
  $('#guest__signup_step_second').on('submit', function(e){
    e.preventDefault();
    $(".login_btn_text").html('Please Wait...');
    $("#guest__signup_step_second .password_error").html(''); 
    $("#guest__signup_step_second .confirm_password_error").html(''); 
    $("#guest__signup_step_second .all_error").html('');
    var $this = $(this);
    $.ajax({
        type: "post",
        url: base_url+'/custom/sigup',
        data: $this.serializeArray(),
        dataType: "json",
        success: function (response) {
          $(".login_btn_text").html('Save');
          window.location.href = base_url;
        },
        error: function (jqXHR) {
        $(".login_btn_text").html('Save'); 
          var response = $.parseJSON(jqXHR.responseText);
          if(response.errors){
            if(response.errors.password){
              $("#guest__signup_step_second .password_error").html(response.errors.password[0]);
            }
            if(response.errors.confirm_password){
              $("#guest__signup_step_second .confirm_password_error").html(response.errors.confirm_password[0]);
            }
            if(response.errors.first_name){
              $("#guest__signup_step_second .all_error").html(response.errors.first_name[0]);
            }
            if(response.errors.last_name){
              $("#guest__signup_step_second .all_error").html(response.errors.last_name[0]);
            }
            if(response.errors.email){
              $("#guest__signup_step_second .all_error").html(response.errors.email[0]);
            }
            if(response.errors.phone){
              $("#guest__signup_step_second .all_error").html(response.errors.phone[0]);
            }
          }else if(response.message){
              $("#guest__signup_step_second .all_error").html(response.message);
          }
        }
    });
  });


 
$('input[name="dob"]').daterangepicker({
  singleDatePicker: true,
  showDropdowns: true,
  minYear: 1901,
  maxYear: parseInt(moment().format('YYYY'), 10),
  locale: {
    "format": "YYYY-MM-DD",
    "separator": "-",
  }
}, function (start, end, label) {
  var years = moment().diff(start, 'years');  
});



$('input[name="working_since"]').daterangepicker({
  singleDatePicker: true,
  showDropdowns: true,
  minYear: 1901,
  maxYear: parseInt(moment().format('YYYY'), 10),
  locale: {
    "format": "YYYY-MM-DD",
    "separator": "-",
  },		

}, function (start, end, label) {
  var years = moment().diff(start, 'years');
});



  });

