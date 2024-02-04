<!DOCTYPE html>
<html lang="en">
    <head>
        @include('vendor.mp2r.layouts.shared/head', ['title' => $title])
        <style type="text/css">
          .select2-container .select2-selection--single {

            height: 48px !important;
          }

          .select2-selection__rendered{

            color: gray !important;
          }

          #first_name::placeholder {
            color: gray !important;
          }

          #last_name::placeholder {
            color: gray !important;
          }
          .left-dashboard{
            height: auto !important;
          }
          .custom-control.custom-switch.pull-right {
            position: relative !important;;
            top: 34px !important;;
        }
        </style>
    </head>

    <body data-layout-mode="detached" @yield('body-extra')>

        <!-- Begin page -->
        <div id="wrapper-main">
            @if(isset($sign_page))
                @include('vendor.mp2r.layouts.shared/si-header')
            @else
                @include('vendor.mp2r.layouts.shared/header')
            @endif
            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">
                    
                    @yield('content')

                </div>

            </div>
   
            @if(!isset($sign_page))
                @include('vendor.mp2r.layouts.shared/footer')
            @endif
            @include('vendor.mp2r.layouts.shared/footer-script')
            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->


        </div>
          <section class="model-form">
              <div class="modal fade" id="login2" role="dialog" data-keyboard="false" data-backdrop="static">
                <div class="modal-dialog modal-md ">
                  <div class="modal-content ">
                    <div class="modal-header d-block p-4 border-0">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                     <img src="{{ asset('assets/mp2r/images/ic_logo-login.png') }}" class="img-fluid">
                    </div>
                    <div class="modal-body p-4 text-center">
                        <div class="pb-3">
                            <h4 class="welcome-back">Welcome back!</h4>
                            <button type="submit" class="btn-login modalLoginShow">Login 2 Continue your journey</button>
                        </div>
                        
                        <div class="pb-3">
                            <h4 class="welcome-back ">Are you new 2 recovery and <br>looking for help?</h4>
                            <button type="submit" data-target="{{ url('register/user') }}" class="btn-login  service_provider_href">Start your journey now, It’s free to Sign Up</button>
                        </div>
                        
                        <div class="pb-3">
                            <h4 class="welcome-back ">I’d like 2 help people <br>on their journey</h4>
                            <button type="submit" class="btn-login service_provider_href" data-target="{{ url('register/service_provider') }}">I’m a Service Provider</button>
                        </div>
                        
                    </div>
                    
                  </div>
                </div>
              </div>
        </section>
        
             <section class="model-form">
                  <div class="modal fade" id="login" role="dialog" data-keyboard="false" data-backdrop="static">
                    <div class="modal-dialog modal-md ">
                      <div class="modal-content ">
                        <div class="modal-header d-block p-3">
                          <button id="closelogin" type="button" class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title login-head">Login</h4>
                        </div>
                        <div class="modal-body p-3">
                           <form id="guest__login">
                                <div class="form-group">
                                  <label for="email " class="user-name">Username / Email</label>
                                  <input required="" type="text" class="form-control" id="email"  name="email">
                                  <span class="alert-danger email_error"></span>
                                </div>
                                <div class="form-group show-pos">
                                  <label for="pwd">Enter Password</label>
                                  <input required="" id="password-field" type="password"  class="form-control" name="password">
                                  <span toggle="#password-field" class="field-icon toggle-password hide-show">Show</span>
                                  <span class="alert-danger password_error"></span>
                                </div>
                                <div class="checkbox">
                                  <label><input type="checkbox" name="remember"> Remember me</label>
                                  <a href="#" class="forgot-pw forgotClick">Forgot Password?</a>
                                </div>
                                <span class="alert-danger main_error"></span>
                                <button type="submit" class="btn-login login_btn_text">Login</button>
                                <p class="sign-in">New 2 the Path? <a href="javascript:void(0)" class="modalLoginShow">Sign up</a></p>
                              </form>
                              
                        </div>
                        <div class="modal-footer border-0 d-block bg-clr ">
                          <p class="emergency">If this is a Medical Emergency, Dial 911</p>
                        </div>
                      </div>
                    </div>
                  </div>
            </section>
            <section class="model-form">
                  <div class="modal fade" id="resetPassword" role="dialog" data-keyboard="false" data-backdrop="static">
                    <div class="modal-dialog modal-md ">
                      <div class="modal-content" v-if="show_first_page">
                        <div class="modal-header d-block p-3">
                          <button id="closelogin" type="button" class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title login-head">Forgot Password</h4>
                          <h5 class="modal-title login-head">Enter your email/username to reset password</h5>
                        </div>
                        <div class="modal-body p-3">
                           <form id="guest__forgot">
                                <div class="form-group">
                                  <label for="email " class="user-name">Email/Username</label>
                                  <input v-model="user_name" required="" type="text" class="form-control" id="email"  name="email">
                                  <span class="alert-danger email_error"></span>
                                </div>
                                <span class="alert-danger main_error"></span>
                                <button @click="verifyEmail" type="button" class="btn-login forgot_password_btn">Submit
                                </button>
                            </form>  
                        </div>
                        <div class="modal-footer border-0 d-block bg-clr ">
                          <p class="emergency">If this is a Medical Emergency, Dial 911</p>
                        </div>
                      </div>

                      <div class="modal-content" v-else-if="show_security_questions">
                        <div class="modal-header d-block p-3">
                          <button id="closelogin" type="button" class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title login-head">Security Questions</h4>
                          <h5 class="modal-title login-head">Please give answers following questions</h5>
                        </div>
                        <div class="modal-body p-3">
                           <form id="guest__question">
                                <div class="form-group">
                                  <label for="email " class="user-name">@{{ questions.question1.question}}</label>
                                  <input v-model="questions.question1.user_answer" required="" type="text" class="form-control">
                                  <span class="alert-danger question1_error"></span>
                                </div>
                                <div class="form-group">
                                  <label for="email " class="user-name">@{{ questions.question2.question}}</label>
                                  <input v-model="questions.question2.user_answer" required="" type="text" class="form-control">
                                  <span class="alert-danger question2_error"></span>
                                </div>
                                <div class="form-group">
                                  <label for="email " class="user-name">@{{ questions.question3.question}}</label>
                                  <input v-model="questions.question3.user_answer" required="" type="text" class="form-control">
                                  <span class="alert-danger question3_error"></span>
                                </div>
                                <span class="alert-danger main_error"></span>
                                <button @click="verifyQuestions" type="button" class="btn-login forgot_password_btn">Verify Answers
                                </button>
                           </form>  
                        </div>
                        <div class="modal-footer border-0 d-block bg-clr ">
                          <p class="emergency">If this is a Medical Emergency, Dial 911</p>
                        </div>
                      </div>
                      <div class="modal-content" v-else-if="reset_password">
                        <div class="modal-header d-block p-3">
                          <button id="closelogin" type="button" class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title login-head">Reset Password</h4>
                        </div>
                        <div class="modal-body p-3">
                           <form id="guest__pass">
                                <div class="form-group">
                                  <label for="email " class="user-name">New Password</label>
                                  <input v-model="new_password" required="" type="text" class="form-control" id="email"  name="email">
                                  <span class="alert-danger new_password_error"></span>
                                </div>
                                <div class="form-group">
                                  <label for="email " class="user-name">Confirm Password</label>
                                  <input v-model="confirm_password" required="" type="text" class="form-control" id="email"  name="email">
                                  <span class="alert-danger confirm_password_error"></span>
                                </div>
                                <span class="alert-danger main_error"></span>
                                <button @click="setPassword" type="button" class="btn-login forgot_password_btn">Submit
                                </button>
                            </form>  
                        </div>
                        <div class="modal-footer border-0 d-block bg-clr ">
                          <p class="emergency">If this is a Medical Emergency, Dial 911</p>
                        </div>
                      </div>
                    </div>
                  </div>
            </section>
            <button style="display: none" class="insurancepopupclass" href="#" data-toggle="modal" data-target="#insurancespopup">
                                                Login
                                            </button>
            <section class="model-form">
                  <div class="modal fade" id="insurancespopup" role="dialog" data-keyboard="false" data-backdrop="static">
                    <div class="modal-dialog modal-md ">
                      <div class="modal-content ">
                        <div class="modal-header d-block p-3">
                          <button id="closelogin" type="button" class="close" data-dismiss="modal">&times;</button>
                          <h6 class="modal-title login-head">We need additional details regarding your insurance</h6>
                        </div>
                        <div class="modal-body p-3">
                           <form method="post" id="user_insurancedetail" >
                            @csrf
                                <div class="form-group">
                                  <label for="email " class="user-name">Member Id</label>
                                  <input required="" type="text" class="form-control"   name="member_id">
                                  <span class="alert-danger member_id_error"></span>
                                </div>
                                <div class="form-group show-pos">
                                  <label for="pwd">DOB</label>
                                  <input required="" type="date"  class="form-control" name="dob">
                                  
                                  <span class="alert-danger password_error"></span>
                                </div>
                                
                                <span class="alert-danger main_error"></span>
                                <button type="submit" class="btn-login login_btn_text">SUBMIT</button>
                                
                              </form>
                              
                        </div>
                        
                      </div>
                    </div>
                  </div>
            </section>
           <!--  <div  style="display:none;width:69px;height:89px;border:1px solid black;position:absolute;top:50%;left:50%;padding:2px;"><img src="{{ asset('assets/images/loader.gif') }}" width="64" height="64" /><br>Loading..</div> -->
            <div  id="wait" class="loader" style="display:none;position:absolute;top:50%;left:50%;padding:2px;"></div>
    </body>

</html>

<script type="text/javascript">
  $("#closelogin").click(function(){

        window.location.reload();
    })

  function isNumber(evt) {
      evt = (evt) ? evt : window.event;
      var charCode = (evt.which) ? evt.which : evt.keyCode;
      if (charCode > 31 && (charCode < 48 || charCode > 57)) {
          return false;
      }
      return true;
  }

  $(document).on('change','#insurances_select_dropdown',function(){

    if($(this).val() == '0'){

      $("#insurances_dropdown").css('display','none');

    }else{

      $("#insurances_dropdown").css('display','block');
    }
  });
</script>
<!-- <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.js"></script> -->
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.full.js"></script>
<link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.css" rel="stylesheet" />
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAV4UFmQuEWaFEnrA5Q7Q0rxwVr5jOqR4Y&amp;libraries=places"></script>

<script type="text/javascript">
    google.maps.event.addDomListener(window, 'load', initialize);
    function initialize() {
      var input = document.getElementById('pac-input');
      var autocomplete = new google.maps.places.Autocomplete(input);
      autocomplete.setComponentRestrictions({
          country: ["us"],
        });
      autocomplete.addListener('place_changed', function () {
      var place = autocomplete.getPlace();
      // place variable will have all the information you are looking for.

      var address = place.address_components;
      var city, state, zip;
      address.forEach(function(component) {
        var types = component.types;
        if (types.indexOf('locality') > -1) {
          city = component.long_name;
          //alert();
        }

        if (types.indexOf('administrative_area_level_1') > -1) {
          state = component.long_name;
        }

        if (types.indexOf('postal_code') > -1) {
          zip = component.long_name;
        }
      });
      
      $('.search_latitude1').val(place.geometry.location.lat());
      $('.search_longitude1').val(place.geometry.location.lng());
      $('#city').val(place.name);
      $('#state').val(state);
      
      getCity(state);
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
      $('#zipcodee').val(zip);
    });
  }


  function search(term, text) {
  if (text.toUpperCase().indexOf(term.toUpperCase()) == 0) {
    return true;
  }
 
  return false;
}
 
$.fn.select2.amd.require(['select2/compat/matcher'], function (f) {
  $("#insurances").select2({
    matcher: f(search)
  });
  $("#insurances2").select2({
    matcher: f(search)
  });
});

// $('#state').select2();
// $('#city').select2();

$(document).on("change","#insurances",function(){
  $(".insurancepopupclass").trigger('click');

});

$(document).on("submit","#user_insurancedetail",function(e){

  e.preventDefault();
    

  $.ajax({
        type: "post",
        url:"{{ route('user.saveuserInsuranceInfo')}}",
        data: $(this).serialize(),
        success: function (response) {

          Swal.fire(
              'Success!','Insurance Detail Save Successfully!','success'
            ).then((result)=>{
              
            });
        
        },
        error: function (response) {
        
        alert('error');
          
        }
    });


});


$("#state_filter").on('change',function(){

  var state_id=$(this).val();

    $("#city_filter").find("option:gt(0)").remove();
      $("#city_filter").find("option:first").text("Loading...");
      $.getJSON(base_url+"/get/cities", {
          state_id: state_id
      }, function (json) {
          $("#city_filter").find("option:first").remove();
          for (var i = 0; i < json.length; i++) {
              $("<option/>").attr("value", json[i].id).text(json[i].name).appendTo($("#city_filter"));
          }
      });

  });


if(navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
    function showPosition(position) {

      var  latitude=position.coords.latitude;
         
        var longitude=position.coords.longitude;
        $("#searchByServiceProvider").attr('data-lat',latitude);

        $("#searchByServiceProvider").attr('data-long',longitude);

        $("#filter_for_button").attr('data-lat',latitude);

        $("#filter_for_button").attr('data-long',longitude);


         var category_id=$("#category_id_index_userside").val();

         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
                    
       
        

         $.ajax({
          url:"{{ route('user.getUserDoctorList')}}",
          method:"post",
          data:{lat:latitude,long:longitude,category_id:category_id},
          beforeSend: function() {
              $("#wait").show();
           },
          success:function(data){

            
            $("#filterData").html(data);

            $("#wait").css("display", "none");
            
          },error: function(data) {
               //alert('hh1');
            }
         });

         var cat_id=$("#category_id_filter_index").val();

         $.ajax({
          url:"{{ route('SP.getDoctorFilterList')}}",
          method:"post",
          data:{lat:latitude,long:longitude,category_id:cat_id},
          beforeSend: function() {
              $("#wait").show();
          },
          success:function(data){

            
            $("#filterData_for_doctor_side").html(data);

            $("#wait").css("display", "none");
            
          },error: function(data) {
               //alert('hh1');
            }
         });
    }
    
  };


  $(document).on('keyup',"#searchByServiceProvider",function(){

      var category_id=$("#category_id_index_userside").val();
      
      var  latitude=$(this).attr('data-lat');
         
      var longitude=$(this).attr('data-long');

      var search=$(this).val();


         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
                    
       
        
         $.ajax({
         
          url:"{{ route('user.getUserDoctorList')}}",
          method:"post",
          data:{lat:latitude,long:longitude,category_id:category_id,search:search},
          
          beforeSend: function() {
              $("#wait").show();
           },
          success:function(data){
            
            $("#filterData").html(data);

            $("#wait").css("display", "none");
            
          },error: function(data) {
               //alert('hh1');
            }
         });


  });


  $(document).on('click','#userverifyEligibility',function(){

        var request_id=$(this).attr('data-id');

        var request_history_id=$(this).attr('data-hisid');

        $.ajax({
            type: "post",
            url:"{{ route('SP.UserverifyEligibility')}}",
            data: {

              'request_id':request_id,
              
            },
            success: function (response) {

              
              $.ajax({
                type: "get",
                url:"{{ url('/service_provider/Booking')}}"+'/'+request_history_id+'/status/in-progress',
                data: {

                  'id':request_history_id,
                  'status': 'in-progress',
                  
                },
                success: function (response) {

                  Swal.fire(
                  'Success!','Request Accepted Successfully!','success'
                ).then((result)=>{
                  location.reload();
                });


                }
              });
            
            },
            error: function (jqXHR) {
            
              var response = $.parseJSON(jqXHR.responseText);
              if(response.errors){
                Swal.fire(
                  'Error!',response.errors,'error'
                ).then((result)=>{

                });
              }else if(response.message){
                Swal.fire({
                    title: 'Confirm!',
                    text: 'Insurance Not Verified.Do you want to Continue',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes!',
                }).then((result) => {

                     if (result.value) {

                        $.ajax({
                            type: "get",
                            url:"{{ url('/service_provider/Booking')}}"+'/'+request_history_id+'/status/in-progress',
                            data: {

                              'id':request_history_id,
                              'status': 'in-progress',
                              
                            },
                            success: function (response) {

                              Swal.fire(
                                'Success!','Request Accepted Successfully!','success'
                              ).then((result)=>{
                                location.reload();
                              });
                  
                            }
                        });
                      }else{

                        $.ajax({
                            type: "get",
                            url:"{{ url('/service_provider/Booking')}}"+'/'+request_history_id+'/status/canceled',
                            data: {

                              'id':request_history_id,
                              'status': 'canceled',
                              
                            },
                            success: function (response) {

                              Swal.fire(
                                'Success!','Request Cancelled Successfully!','success'
                              ).then((result)=>{
                                location.reload();
                              });
                  
                            },

                            error: function(jqXHR) {
                               
                                var response = $.parseJSON(jqXHR.responseText);
                                if (response.message) {
                                    Swal.fire('Error!', response.message, 'error');
                                }
                            }
                        });

                        
                      }

                });
              }
              
            }
        });
      });




      $(document).on('click','#submitReviewButton',function(){

          
       
            var id=$(this).attr('data-requestid');

            $.ajax({
             
              url:"{{ route('user.ServiceProviderReview')}}",
              method:"post",
              data:{

                'consultant_id':$(this).attr('data-consultantid'),

                'rating':$("#rating_"+id).val(),

                'request_id':$(this).attr('data-requestid'),

                'comment': $("#comment_"+id).val(),
              },
              
              success:function(data){
                
                Swal.fire(
                    'Success!','Service Provider Rated Successfully!','success'
                  ).then((result)=>{
                   
                   window.location.reload();
                  });
                
              },
                error: function(data) {
                   // alert('hh1');
                }
            });


        });


        $(document).on('click','#filter_for_button',function(){

            var cat_id=$("#category_id_filter_index").val();

            var city=$("#city").val();

            var state=$("#state").val();

            var zip_code=$("#zip_code").val();
            

            var  latitude=$(this).attr('data-lat');
         
            var longitude=$(this).attr('data-long');

            $.ajax({
            url:"{{ route('SP.getDoctorFilterList')}}",
            method:"post",
            data:{lat:latitude,long:longitude,category_id:cat_id,city:city,state:state,zip_code:zip_code},
            beforeSend: function() {
                $("#wait").show();
            },
            success:function(data){

              
              $("#filterData_for_doctor_side").html(data);

              $("#modal_filter_button").trigger('click');

              $("#wait").css("display", "none");
              
            },error: function(data) {
                 //alert('hh1');
              }
           });
        })

        $(document).on('click','#ClearFilter_for_SP',function(){

            window.location.reload();
        });
new Vue({
  el: '#resetPassword',
  data: {  
    user_name:'',
    user_id:null,
    questions:{question1:{},question2:{},question3:{}},
    show_first_page:true,
    show_security_questions:false,
    reset_password:false,
    new_password:'',
    confirm_password:'',
  },
   methods: {
    selectedData: function (data) {
      this.selected_date_model = data;
    },
    clickHadleType:function(type){
      this.handle_type = type;
    },
    verifyEmail:function(){
      var _this = this;
      console.log(_this.user_name);
      if(!_this.user_name){
        $("#guest__forgot .email_error").html('User Name or Email required');
        return true;
      }
      $(".forgot_password_btn").html('Please Wait...');
      $("#guest__forgot .email_error").html('');
      $("#guest__forgot .main_error").html('');
      $.ajax({
          type: "post",
          url: base_url+'/custom/forgot',
          data:{'email':_this.user_name},
          dataType: "json",
          success: function (response) {
            $(".forgot_password_btn").html('Submit');
            _this.show_first_page = false;
            _this.reset_password = false;
            _this.show_security_questions = true;
            _this.questions = response.data.questions;
          },
          error: function (jqXHR) {
          $(".forgot_password_btn").html('Submit'); 
            var response = $.parseJSON(jqXHR.responseText);
            if(response.message){
                $("#guest__forgot .main_error").html(response.message);
            }
          }
      }); 
    },
    verifyQuestions:function(){
      var _this = this;
      $(".forgot_password_btn").html('Please Wait...');
      $("#guest__question .main_error").html('');
      $("#guest__question .question1_error").html('');
      $("#guest__question .question2_error").html('');
      $("#guest__question .question3_error").html('');
      $.ajax({
          type: "post",
          url: base_url+'/custom/question-verify',
          data:{'email':_this.user_name,"questions":_this.questions},
          dataType: "json",
          success: function (response) {
            $(".forgot_password_btn").html('Verify Answers');
            _this.reset_password = true;
            _this.show_security_questions = false;
            _this.user_id = response.data.user_id;
          },
          error: function (jqXHR) {
          $(".forgot_password_btn").html('Verify Answers'); 
            var response = $.parseJSON(jqXHR.responseText);
            if(response.errors.question1!==undefined){
                $("#guest__question .question1_error").html(response.errors.question1);
            }
            if(response.errors.question2!==undefined){
                $("#guest__question .question2_error").html(response.errors.question2);
            }
            if(response.errors.question3!==undefined){
                $("#guest__question .question3_error").html(response.errors.question3);
            }
            if(response.message){
                $("#guest__question .main_error").html(response.message);
            }
          }
      });
    },
    setPassword:function(){
      var _this = this;
      $('.forgot_password_btn').html('Please Wait...');
      $("#guest__pass .main_error").html('');
      $("#guest__pass .new_password_error").html('');
      $("#guest__pass .confirm_password_error").html('');
      $.ajax({
          type: "post",
          url: base_url+'/custom/reset-password',
          data:{
            "user_id":_this.user_id,
            "new_password":_this.new_password,
            "confirm_password":_this.confirm_password
          },
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
    },
   },
   mounted() {
  }
});



$(document).on('change','#state_manage',function(){

    
    var state_id =$(this).val();
    $("#city_manage").find("option:gt(0)").remove();
      $("#city_manage").find("option:first").text("Loading...");
      $.getJSON(base_url+"/get/cities", {
          state_id: state_id
      }, function (json) {
          $("#city_manage").find("option:first").remove();
          for (var i = 0; i < json.length; i++) {
              $("<option/>").attr("value", json[i].id).text(json[i].name).appendTo($("#city_manage"));
          }
    });
});      
</script>