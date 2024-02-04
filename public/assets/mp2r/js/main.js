jQuery(window).scroll(function () {
    var scroll = jQuery(window).scrollTop();

    if (scroll >= 50) {
        jQuery("body").addClass("header-fixed");
    } else {
        jQuery("body").removeClass("header-fixed");
    }
});










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
          }else if(response.message){
              $("#guest__login .main_error").html(response.message);
          }
        }
    });
  });

  // $('#guest__forgot').on('submit', function(e){
  //   e.preventDefault();
  //   $(".forgot_password_btn").html('Please Wait...');
  //   $("#guest__forgot .email_error").html(''); 
  //   $("#guest__forgot .main_error").html(''); 
  //   var $this = $(this);
  //   $.ajax({
  //       type: "post",
  //       url: base_url+'/custom/forgot',
  //       data: $this.serializeArray(),
  //       dataType: "json",
  //       success: function (response) {
  //       $(".forgot_password_btn").html('Submit'); 
  //           // location.reload();
  //       },
  //       error: function (jqXHR) {
  //       $(".forgot_password_btn").html('Submit'); 
  //         var response = $.parseJSON(jqXHR.responseText);
  //         if(response.message){
  //             $("#guest__forgot .main_error").html(response.message);
  //         }
  //       }
  //   });
  // });

});
/*------------------------------signup---------------------------*/
$(document).ready(function() {
$(".forgotClick").click(function(){
      $("#resetPassword").modal("toggle");
      $("#login").modal("toggle");
  });
$('#OpenImgUpload').click(function(){ $('#imgupload').trigger('click'); });
function getCity(state_id){
  $("#city").find("option:gt(0)").remove();
    $("#city").find("option:first").text("Loading...");
    $.getJSON(base_url+"/get/cities", {
        state_id: state_id
    }, function (json) {
        $("#city").find("option:first").remove();
        for (var i = 0; i < json.length; i++) {
            $("<option/>").attr("value", json[i].id).text(json[i].name).appendTo($("#city"));
        }
    });
}
getCity('Alabama');
$("#state").change(function () {
    getCity($(this).val());
});

function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    
    reader.onload = function(e) {
      $('#OpenImgUpload').attr('src', e.target.result);
    }
    reader.readAsDataURL(input.files[0]); // convert to base64 string
  }
}

$("#imgupload").change(function() {
  readURL(this);
});

$('#step_first_user').on('submit', function(e){
    e.preventDefault();
    var formData = new FormData(this);
    $("#btn_text").html('Please Wait...');
    $("#step_first_user .first_name_error").html(''); 
    $("#step_first_user .last_name_error").html(''); 
    $("#step_first_user .phone_number_error").html(''); 
    $("#step_first_user .email_error").html(''); 
    $("#step_first_user .password_error").html(''); 
    $("#step_first_user .password_confirmation_error").html(''); 
    $("#step_first_user .main_error").html(''); 
    var $this = $(this);
    $.ajax({
        type: "post",
        url: base_url+'/register/user?step=1',
        data: formData,
        dataType: "json",
        cache:false,
        contentType: false,
        processData: false,
        success: function (response) {
        $("#btn_text").html('Next'); 
            location.reload();
        },
        error: function (jqXHR) {
        $("#btn_text").html('Next');
          var response = $.parseJSON(jqXHR.responseText);
          if(response.errors){
            if(response.errors.email){
              $("#step_first_user .email_error").html(response.errors.email[0]);
            }
            if(response.errors.phone){
              $("#step_first_user .phone_number_error").html(response.errors.phone[0]);
            }
            if(response.errors.first_name){
              $("#step_first_user .first_name_error").html(response.errors.first_name[0]);
            }
            if(response.errors.last_name){
              $("#step_first_user .last_name_error").html(response.errors.last_name[0]);
            }
            if(response.errors.password){
              $("#step_first_user .password_error").html(response.errors.password[0]);
            }
            if(response.errors.password_confirmation){
              $("#step_first_user .password_confirmation_error").html(response.errors.password_confirmation[0]);
            }
          }else if(response.message){
              $("#step_first_user .main_error").html(response.message);
          }
        }
    });
  });
$('#step_first').on('submit', function(e){
    e.preventDefault();
    var formData = new FormData(this);
    $("#btn_text").html('Please Wait...');
    $("#step_first .first_name_error").html(''); 
    $("#step_first .last_name_error").html(''); 
    $("#step_first .phone_number_error").html(''); 
    $("#step_first .email_error").html(''); 
    $("#step_first .password_error").html(''); 
    $("#step_first .password_confirmation_error").html(''); 
    $("#step_first .main_error").html(''); 
    var $this = $(this);
    $.ajax({
        type: "post",
        url: base_url+'/register/service_provider?step=1',
        data: formData,
        dataType: "json",
        cache:false,
        contentType: false,
        processData: false,
        success: function (response) {
        $("#btn_text").html('Next'); 
            location.reload();
        },
        error: function (jqXHR) {
        $("#btn_text").html('Next');
          var response = $.parseJSON(jqXHR.responseText);
          if(response.errors){
            if(response.errors.email){
              $("#step_first .email_error").html(response.errors.email[0]);
            }
            if(response.errors.phone){
              $("#step_first .phone_number_error").html(response.errors.phone[0]);
            }
            if(response.errors.first_name){
              $("#step_first .first_name_error").html(response.errors.first_name[0]);
            }
            if(response.errors.last_name){
              $("#step_first .last_name_error").html(response.errors.last_name[0]);
            }
            if(response.errors.password){
              $("#step_first .password_error").html(response.errors.password[0]);
            }
            if(response.errors.password_confirmation){
              $("#step_first .password_confirmation_error").html(response.errors.password_confirmation[0]);
            }
          }else if(response.message){
              $("#step_first .main_error").html(response.message);
          }
        }
    });
  });
var input = $('#phone');
var iti = intlTelInput(input.get(0));
$('#send_link').on('click', function(e){
    e.preventDefault();
    let isvalid = iti.isValidNumber();
    let phone = iti.getNumber(intlTelInputUtils.numberFormat.E164);
    if(!isvalid){
        Swal.fire('Error!','Phone number not valid','error');
        return false;
    }
    $("#send_link").html('Please Wait...');
    var $this = $(this);
    $.ajax({
        type: "post",
        url: base_url+'/send_link',
        data: {phone:phone},
        dataType: "json",
        success: function (response) {
             Swal.fire('Sent Link!','Link has been sent','success');
            $("#send_link").html('Send Link'); 
        },
        error: function (jqXHR) {
        $("#send_link").html('Send Link');
          var response = $.parseJSON(jqXHR.responseText);
          if(response.errors){
            if(response.errors.phone){
              Swal.fire('Error!',response.errors.address[0],'error');
              $("#step_second_user .address_error").html(response.errors.address[0]);
            }
          }else if(response.message){
              Swal.fire('Error!',response.message,'error');
          }
        }
    });
  });

$('#step_second_user').on('submit', function(e){
    e.preventDefault();
    $("#btn_text").html('Please Wait...');
    $("#step_second_user .address_error").html(''); 
    $("#step_second_user .state_error").html(''); 
    $("#step_second_user .city_error").html(''); 
    $("#step_second_user .zip_code_error").html(''); 
    $("#step_second_user .insurances_error").html(''); 
    $("#step_second_user .answer1").html(''); 
    $("#step_second_user .answer2").html(''); 
    $("#step_second_user .answer3").html(''); 
    $("#step_second_user .question1").html(''); 
    $("#step_second_user .question2").html(''); 
    $("#step_second_user .question3").html(''); 
    $("#step_second_user .main_error").html(''); 
    var $this = $(this);
    $.ajax({
        type: "post",
        url: base_url+'/register/user?step=2',
        data: $this.serializeArray(),
        dataType: "json",
        success: function (response) {
        $("#btn_text").html('Next'); 
            location.reload();
        },
        error: function (jqXHR) {
        $("#btn_text").html('Next');
          var response = $.parseJSON(jqXHR.responseText);
          if(response.errors){
            if(response.errors.address){
              $("#step_second_user .address_error").html(response.errors.address[0]);
            }
            if(response.errors.state){
              $("#step_second_user .state_error").html(response.errors.state[0]);
            }
            if(response.errors.city){
              $("#step_second_user .city_error").html(response.errors.city[0]);
            }
            if(response.errors.zip_code){
              $("#step_second_user .zip_code_error").html(response.errors.zip_code[0]);
            }
            if(response.errors.insurances){
              $("#step_second_user .insurances_error").html(response.errors.insurances[0]);
            }
            if(response.errors.answer1){
              $("#step_second_user .answer1_error").html(response.errors.answer1);
            }
            if(response.errors.answer2){
              $("#step_second_user .answer2_error").html(response.errors.answer2);
            }
            if(response.errors.answer3){
              $("#step_second_user .answer3_error").html(response.errors.answer3);
            }

            if(response.errors.question1){
              $("#step_second_user .question1_error").html(response.errors.question1);
            }
            if(response.errors.question2){
              $("#step_second_user .question2_error").html(response.errors.question2);
            }
            if(response.errors.question3){
              $("#step_second_user .question3_error").html(response.errors.question3);
            }
          }else if(response.message){
              $("#step_second_user .main_error").html(response.message);
          }
        }
    });
  });

$('#step_second').on('submit', function(e){
    e.preventDefault();
    $("#btn_text").html('Please Wait...');
    $("#step_second .address_error").html(''); 
    $("#step_second .state_error").html(''); 
    $("#step_second .city_error").html(''); 
    $("#step_second .zip_code_error").html(''); 
    $("#step_second .education_error").html(''); 
    $("#step_second .insurances_error").html('');
    $("#step_second .answer1").html(''); 
    $("#step_second .answer2").html(''); 
    $("#step_second .answer3").html(''); 
    $("#step_second .question1").html(''); 
    $("#step_second .question2").html(''); 
    $("#step_second .question3").html('');  
    $("#step_second .main_error").html(''); 
    var $this = $(this);
    $.ajax({
        type: "post",
        url: base_url+'/register/service_provider?step=2',
        data: $this.serializeArray(),
        dataType: "json",
        success: function (response) {
        $("#btn_text").html('Next'); 
            location.reload();
        },
        error: function (jqXHR) {
        $("#btn_text").html('Next');
          var response = $.parseJSON(jqXHR.responseText);
          if(response.errors){
            if(response.errors.address){
              $("#step_second .address_error").html(response.errors.address[0]);
            }
            if(response.errors.state){
              $("#step_second .state_error").html(response.errors.state[0]);
            }
            if(response.errors.city){
              $("#step_second .city_error").html(response.errors.city[0]);
            }
            if(response.errors.zip_code){
              $("#step_second .zip_code_error").html(response.errors.zip_code[0]);
            }
            if(response.errors.education){
              $("#step_second .education_error").html(response.errors.education[0]);
            }
            if(response.errors.insurances){
              $("#step_second .insurances_error").html(response.errors.insurances[0]);
            }
            if(response.errors.answer1){
              $("#step_second .answer1_error").html(response.errors.answer1);
            }
            if(response.errors.answer2){
              $("#step_second .answer2_error").html(response.errors.answer2);
            }
            if(response.errors.answer3){
              $("#step_second .answer3_error").html(response.errors.answer3);
            }

            if(response.errors.question1){
              $("#step_second .question1_error").html(response.errors.question1);
            }
            if(response.errors.question2){
              $("#step_second .question2_error").html(response.errors.question2);
            }
            if(response.errors.question3){
              $("#step_second .question3_error").html(response.errors.question3);
            }
            
          }else if(response.message){
              $("#step_second .main_error").html(response.message);
          }
        }
    });
  });

$('#make_online_offline').on('change', function(e){
    e.preventDefault();
    var user_id = $(this).data('user');
    var text = 'Online';
    if(this.checked){
      text = 'Online';
    }else{
      text = 'Offline';
    }
    $('#make_online_offline_text').text(text);
    $.ajax({
        type: "post",
        url: base_url+'/service_provider/makeonline',
        data: {manual_available:this.checked,user_id:user_id},
        dataType: "json",
        success: function (response) {

        }
    });
});
$('#step_third').on('submit', function(e){
    e.preventDefault();
    $("#btn_text").html('Please Wait...');
    if(!$("#category_id").val()){
      alert("Please Select Category");
      return true;
    }
    $("#step_second .address_error").html(''); 
    $("#step_second .main_error").html(''); 
    var $this = $(this);
    $.ajax({
        type: "post",
        url: base_url+'/register/service_provider?step=3',
        data: $this.serializeArray(),
        dataType: "json",
        success: function (response) {
        console.log(response.category);
        $("#btn_text").html('Next');
        if(response.category){
            window.location.assign(base_url+"/register/service_provider?step=3&category="+response.category);
        }else{
            window.location.assign(base_url+"/register/service_provider?step=4");
        } 
        },
        error: function (jqXHR) {
        $("#btn_text").html('Next');
          var response = $.parseJSON(jqXHR.responseText);
          if(response.errors){
            if(response.errors.address){
              $("#step_second .address_error").html(response.errors.address[0]);
            }
            if(response.errors.state){
              $("#step_second .state_error").html(response.errors.state[0]);
            }
            if(response.errors.city){
              $("#step_second .city_error").html(response.errors.city[0]);
            }
            if(response.errors.zip_code){
              $("#step_second .zip_code_error").html(response.errors.zip_code[0]);
            }
            if(response.errors.education){
              $("#step_second .education_error").html(response.errors.education[0]);
            }
            if(response.errors.insurances){
              $("#step_second .insurances_error").html(response.errors.insurances[0]);
            }
          }else if(response.message){
              $("#step_second .main_error").html(response.message);
          }
        }
    });
  });
  var group_dropdown = true;
  $(".new-group").click(function(){
      $("#create_group").toggle("fast", function(){
          if($("#create_group").is(":visible")){
              group_dropdown = false;
              $("#group_type").val("name");
              $("#create_group").attr('required',true);
          } else{
              group_dropdown = true;
              $("#group_type").val("id");
              $("#create_group").removeAttr('required',false);
          }
      });
  });
  $('.service_provider_href').on('click', function(event) {
      event.preventDefault(); 
      var url = $(this).data('target');
      location.replace(url);
  });
  $('li .service_provider_href').on('click', function(event) {
      event.preventDefault(); 
      var url = $(this).data('target');
      location.replace(url);
  });
  $(".modalLoginShow").click(function(){
      $("#login2").modal("toggle");
      $("#login").modal("toggle");
  });
$('#step_six').on('submit', function(e){
  e.preventDefault();
  $("#btn_text").html('Please Wait...');
    $("#step_second .group_name_error").html(''); 
    $("#step_second .group_id_error").html(''); 
    $("#step_second .main_error").html(''); 
    var $this = $(this);
    $.ajax({
        type: "post",
        url: base_url+'/register/service_provider?step=6',
        data: $this.serializeArray(),
        dataType: "json",
        success: function (response) {
        $("#btn_text").html('Next');
          location.reload();
        },
        error: function (jqXHR) {
        $("#btn_text").html('Next');
          var response = $.parseJSON(jqXHR.responseText);
          if(response.errors){
            if(response.errors.group_name){
              $("#step_second .group_name_error").html(response.errors.group_name[0]);
            }
            if(response.errors.group_id){
              $("#step_second .group_id_error").html(response.errors.group_id[0]);
            }
          }else if(response.message){
              $("#step_second .group_id_error").html(response.message);
          }
        }
    });
});
var total_price = parseInt($(".tab-pane.active").attr("data-price"));
$("#grand_total").text(total_price);
$("#total_price").val(total_price);
var selectedPlans = [];
var active_plans = $(".tab-pane.active").attr("data-plan_id");
selectedPlans.push(active_plans);

var payment_detail = false;
$('#submit_plan').on('submit', function(e){
  e.preventDefault();
  var active_plan = $(".tab-pane.active");
  var price = parseInt(total_price);
  console.log('price',price)
  var plan_id = active_plan.attr("data-plan_id");
  $("#plan_id").val(selectedPlans.join(','));
  $("#total_price").val(price);
  $("#plan_chase_btn").html("Process Payment "+price);
  if(!payment_detail && price!==0){
    payment_detail = true;
    if($("#upgrade").val()=='yes'){
      $("#btn_text").attr("form","upgradePlan");
    }else{
      $("#btn_text").attr("form","submit_plan2");
    }
    $('.plan-detail').toggle();
    $('.payment_form').toggle();
    return false;
  }
  if(price!==0){
    return false;
  }
  $("#btn_text").html('Please Wait...');
    $("#step_second .main_error").html(''); 
    var $this = $(this);
    $.ajax({
        type: "post",
        url: base_url+'/register/service_provider?step=5',
        data: $this.serializeArray(),
        dataType: "json",
        success: function (response) {
        $("#btn_text").html('Next');
          Swal.fire(
              'Success!','Package Subscribed','success'
            ).then((result)=>{
              location.reload();
            });
        },
        error: function (jqXHR) {
        $("#btn_text").html('Next');
          var response = $.parseJSON(jqXHR.responseText);
          if(response.errors){
            alert(response.errors);
          }else if(response.message){
            alert(response.message);
          }
        }
    });
});

$('#submit_plan2').on('submit', function(e){
  e.preventDefault();
  var active_plan = $(".tab-pane.active");
  var price = total_price;
  var plan_id = active_plan.attr("data-plan_id");
  $(".plan_id").val(selectedPlans.join(','));
  $(".total_price").val(price);
  $("#plan_chase_btn").html("Process Payment "+price);
  $("#btn_text").html('Please Wait...');
    $("#step_second .main_error").html(''); 
    var $this = $(this);
    $.ajax({
        type: "post",
        url: base_url+'/register/service_provider?step=5',
        data: $this.serializeArray(),
        dataType: "json",
        success: function (response) {
        $("#btn_text").html('Next');
          Swal.fire(
              'Success!','Package Subscribed','success'
            ).then((result)=>{
              location.reload();
            });
        },
        error: function (jqXHR) {
        $("#btn_text").html('Next');
          var response = $.parseJSON(jqXHR.responseText);
          if(response.errors){
            Swal.fire(
              'Error!',response.errors,'error'
            ).then((result)=>{

            });
          }else if(response.message){
             Swal.fire(
              'Error!',response.message,'error'
            ).then((result)=>{

            });
          }
        }
    });
});

$('#upgradePlan').on('submit', function(e){
  e.preventDefault();
  var active_plan = $(".tab-pane.active");
  var price = total_price;
  var plan_id = active_plan.attr("data-plan_id");
  $(".plan_id").val(selectedPlans.join(','));
  $(".total_price").val(price);
  $("#plan_chase_btn").html("Process Payment "+price);
  $("#btn_text").html('Please Wait...');
  var $this = $(this);
    $.ajax({
        type: "post",
        url: base_url+'/service_provider/plan',
        data: $this.serializeArray(),
        dataType: "json",
        success: function (response) {
        $("#btn_text").html('Next');
          Swal.fire(
              'Success!','Package Subscribed','success'
            ).then((result)=>{
              location.reload();
            });
        },
        error: function (jqXHR) {
        $("#btn_text").html('Next');
          var response = $.parseJSON(jqXHR.responseText);
          if(response.errors){
            Swal.fire(
              'Error!',response.errors,'error'
            ).then((result)=>{

            });
          }else if(response.message){
             Swal.fire(
              'Error!',response.message,'error'
            ).then((result)=>{

            });
          }
        }
    });
});


$("#Premium-pre").on('click', function(e){
    selectedPlans = [];
    active_plans = $("#Premium").attr("data-plan_id");
    selectedPlans.push(active_plans);
    var insurances = $("#insurance-pre");
    var group = $("#group-pre");
    total_price = $("#Premium").attr("data-price");
    if(insurances.is(':checked')){
      total_price = parseInt(total_price) + parseInt(insurances.attr("data-price"));
      selectedPlans.push(insurances.attr("data-plan_id"));
    }
    if(group.is(':checked')){
      total_price = parseInt(total_price) + parseInt(group.attr("data-price"));
      selectedPlans.push(group.attr("data-plan_id"));
    }
    $('#grand_total').text(total_price);
    console.log(total_price);
});
 $('#insurance-pre').on('change', function(e){
    if(this.checked) {
        total_price = parseInt(total_price) + parseInt($(this).attr("data-price"));
        if (!selectedPlans.includes($(this).attr("data-plan_id"))) {
          selectedPlans.push($(this).attr("data-plan_id"));
        }
    }else{
      if (selectedPlans.includes($(this).attr("data-plan_id"))) {
          selectedPlans.splice(selectedPlans.indexOf($(this).attr("data-plan_id")), 1);
      }
      total_price = parseInt(total_price) - parseInt($(this).attr("data-price"));
    }
    $('#grand_total').text(total_price);
    console.log(total_price);
}); 
$('#group-pre').on('change', function(e){
      if(this.checked) {
          total_price = parseInt(total_price) + parseInt($(this).attr("data-price"));
          if (!selectedPlans.includes($(this).attr("data-plan_id"))) {
            selectedPlans.push($(this).attr("data-plan_id"));
          }
      }else{
        if (selectedPlans.includes($(this).attr("data-plan_id"))) {
          selectedPlans.splice(selectedPlans.indexOf($(this).attr("data-plan_id")), 1);
        }
        total_price = parseInt(total_price) - parseInt($(this).attr("data-price"));
      }
      $('#grand_total').text(total_price);
      console.log(total_price);
});
$("#Executive-pre").on('click', function(e){
    var group = $("#group-exe");
    selectedPlans = [];
    active_plans = $("#Executive").attr("data-plan_id");
    selectedPlans.push(active_plans);
    total_price = parseInt($("#Executive").attr("data-price"));
    if(group.is(':checked')){
      total_price = parseInt(total_price) + parseInt(group.attr("data-price"));
      selectedPlans.push(group.attr("data-plan_id"));
    }
    $('#grand_total_exe').text(total_price);
    console.log(total_price);
});
$("#Basic-pre").on('click', function(e){
    total_price = $("#Basic").attr("data-price");
    selectedPlans = [];
    active_plans = $("#Basic").attr("data-plan_id");
    selectedPlans.push(active_plans);
    console.log(selectedPlans);
});
$('#group-exe').on('change', function(e){
      if(this.checked) {
          total_price = parseInt(total_price) + parseInt($(this).attr("data-price"));
          if (!selectedPlans.includes($(this).attr("data-plan_id"))) {
            selectedPlans.push($(this).attr("data-plan_id"));
          }
      }else{
        if (selectedPlans.includes($(this).attr("data-plan_id"))) {
          selectedPlans.splice(selectedPlans.indexOf($(this).attr("data-plan_id")), 1);
        }
        total_price = parseInt(total_price) - parseInt($(this).attr("data-price"));
      }
      $('#grand_total_exe').text(total_price);
      console.log(total_price);
});
$("#submit_plan_back").click(function(){
    if(payment_detail){
      $("#btn_text").attr("form","submit_plan");
      payment_detail = false;
      $('.plan-detail').toggle();
      $('.payment_form').toggle();
      return false;
    }else{
      // $("#btn_text").attr("form","submit_plan2");
    }
});
  $(".select_category").click(function(){
    var category_id = $(this).attr('data-category_id');
    $("#category_id").val(category_id);
    $("#btn_text").removeAttr('disabled');
    $('.outer-cover').removeClass('box_enable');
    $(this).find( ".outer-cover" ).addClass('box_enable');
  });

  $(".country_code_sel").on("click",function(){
    var country_code = $(this).html();
    $("#country_code").val(country_code);
    $(".text_code").html(country_code);
  });

  
  
});


