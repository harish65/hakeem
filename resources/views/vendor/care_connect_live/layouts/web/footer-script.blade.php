<style>
    .jssocials-share i.fa {
        font-family: "Font Awesome 5 Brands";
    }
</style>



<div class="modal fade" id="wallet_message_container" tabindex="-1">
    <div class="modal-dialog modal-md modal-dialog-center">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Added to Wallet</h5>

                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <p> You need to maintain sufficient balance <span style="opacity: 1 !important;" id="wallet_message" ></span> </p>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger col-sm-4" data-dismiss="modal">Cancel</button>
                <a href="{{ url('/user/wallet') }}" class="btn btn-primary col-sm-4">Add Money</a>
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

<!-- availbility -->

 <!-- Add Availability Modal -->
 <section class="availability-popup">
  <div class="container">
    <div class="row">
      <div class="col">

        <div class="modal fade" id="addAvailbityModal_manage">
          <div class="modal-dialog modal-md ">
              <div class="modal-content " style="height:700px;">
                  <div class="modal-header d-block pt-3 px-4 pb-0 border-0">
                      <button type="button" class="close" data-dismiss="modal">
                          <img src="{{asset('assets/care_connect_live/images/ic_cancel.png')}}" alt="">
                      </button>
                      <h4 class="modal-title login-head">Add availability</h4>
                      <hr>
                  </div>
                  <form class="availbilityform"  method="post" action="{{url('/service_provider/add_availbility')}}">
                  @csrf
                  <div class="modal-body px-4 pt-2 pb-3">

                      <input type="hidden" name="service_id" class="serviceid">
                      <input type="hidden" name="category_id" class="categoryid">

                      <h6>Select Date</h6>
                      <div  class="bg-gray position-relative p-3 mt-4">
                        <ul class="days-list d-flex align-items-center" id="schedules">
                                @if(isset($data))
                                    @foreach($data as $datas)
                                    @php $showDate = date('d M, y', strtotime($datas['date'])); @endphp
                                    <input type="hidden" name="slot_date" value="{{$datas['date']}}" />
                                <li class="schedule_date" data-val = "{{$datas['date']}}">
                                    <a href="" >
                                    <span>{{ $datas['day']}}</span>
                                    <label class="m-0">{{ $showDate }}</label>
                                </a>
                                </li>
                                    @endforeach
                                @endif

                        </ul>
                    </div>
                    <div class="time_options_div">
                      <h6>Select Time</h6>
                      <div id="customFields">
                        <div class="new_row row align-items-center">
                            <div class="col-11 pr-0 interv_div" >
                                <div class="row common-form">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>From</label>
                                            <input class="form-control" type="time" placeholder="11:00 am" name="start_time[]" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>To</label>
                                            <input class="form-control" type="time" placeholder="11:00 am" name="end_time[]" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-1">
                                <label></label>
                                <a class="remCF" href="#"><i class="fas fa-trash-alt"></i></a>
                            </div>
                        </div>
                      </div>
                      <div class="row">
                          <div class="col-12">
                              <a class="newrow" href="#"><i class="fas fa-plus"></i> New Interval</a>
                          </div>
                      </div>

                      <div class="row no-gutters spacing-eight mt-6 mb-3" >
                      <div class="col-sm-4">
                              <button type="submit" name="action" value="weekdays" class="default-btn radius-btn border-btn w-100 px-2" ><span>All Weekdays</span></button>
                          </div>
                          <div class="col-sm-3">
                              <button type="submit" name="action" value="specific_date" class="default-btn radius-btn border-btn w-100 px-2" ><span>For Jun 24, 20</span></button>
                          </div>
                          <div class="col-sm-3">
                              <button type="submit" name="action" value="specific_day" class="default-btn radius-btn border-btn w-100 px-2" href="#"><span>All Wednesday</span></button>
                          </div>
                    </div>
                  </div>
                </form>
              </div>
          </div>
        </div>


        <div class="modal fade" id="editAvailbityModal">
          <div class="modal-dialog modal-md ">
              <div class="modal-content ">
                  <div class="modal-header d-block pt-3 px-4 pb-0 border-0">
                      <button type="button" class="close" data-dismiss="modal">
                          <img src="{{asset('assets/care_connect_live/images/ic_cancel.png')}}" alt="">
                      </button>
                      <h4 class="modal-title login-head">Edit availability</h4>
                      <hr>
                  </div>
                  <form class="availbilityform" method="post" action="{{url('/service_provider/edit_availbility')}}">
                    @csrf

                  <div class="modal-body px-4 pt-2 pb-3">
                      <h6>Select Date</h6>
                      <div  class="bg-gray position-relative p-3 mt-4">
                        <ul class="days-list d-flex align-items-center" id="schedules">
                                @if(isset($data))
                                    @foreach($data as $datas)
                                    @php $showDate = date('d M, y', strtotime($datas['date'])); @endphp

                                <li class="schedule_date" data-val = "{{$datas['date']}}">
                                    <a href="" >
                                    <span>{{ $datas['day']}}</span>
                                    <label class="m-0">{{ $showDate }}</label>
                                </a>
                                </li>
                                    @endforeach
                                @endif

                        </ul>
                    </div>
                      <input type="hidden" name="service_id" class="serviceid">
                      <input type="hidden" name="category_id" class="categoryid">
                      <h6>Select Time</h6>
                      <div id="customFields">
                      </div>
                      <div class="row">
                          <div class="col-12">
                              <a class="newrow" href="#"><i class="fas fa-plus"></i> New Interval</a>
                          </div>
                      </div>
                      <!-- <div class="form-group spacing-eight mt-6 mb-3">
                        <input type="submit" class="default-btn w-100 radius-btn" id="add_availbility" name="Save" value="Update">
                      </div> -->
                      <div class="row no-gutters spacing-eight mt-6 mb-3" >
                          <div class="col-sm-4">
                              <button type="submit" name="action" value="weekdays" class="default-btn radius-btn border-btn w-100 px-2" ><span>All Weekdays</span></button>
                          </div>
                          <div class="col-sm-3">
                              <button type="submit" name="action" value="specific_date" class="default-btn radius-btn border-btn w-100 px-2" ><span>For Jun 24, 20</span></button>
                          </div>
                          <div class="col-sm-3">
                              <button type="submit" name="action" value="specific_day" class="default-btn radius-btn border-btn w-100 px-2" href="#"><span>All Wednesday</span></button>
                          </div>
                      </div>
                  </div>
                </form>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

  <!-- Enter-Contact Modal -->
  <div class="modal fade" id="contact_details" tabindex="-1" role="dialog" aria-labelledby="login-popupLabel" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
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
                    <form class="form-default" id="otp_login" role="form" action="#" method="POST">
                        @csrf
                        <div class="form-group mb-4">
                            <div class="row no-gutters col-spacing">
                                <div class="col-12 phon_field">
                                  <input class="form-control" type="tel" style="width:100%;" onkeypress="return isNumberKey(event)" onchange="return isNumberKey(event)"  id="phoneno" name="phone">

                                  <input type="hidden" id="role_type" name="role_type" value="{{'service_provider'}}">
                                <input type="hidden" id="type" name="type" value="">
                                <input type="hidden" id="email" name="email" value="{{Auth::user()->email}}">
                                <input type="hidden" id="userid" name="userid" value="{{Auth::user()->id}}">
                               <input type="hidden" name="country_code" id="country_code" value="{{Auth::user()->country_code}}">
                               <span class="alert-danger phone"></span><br>

                                </div>

                            </div>
                        </div>
                        <div class="form-group">
                            <button type="button" class="default-btn w-100 radius-btn" id="nextbtn" ><span>Next</span></button>
                        </div>

                     </form>
                </div>

            </div>
        </div>
    </div>

    @if(Config('client_connected') && Config::get('client_data')->domain_name == 'iedu')
        @php $currency = 'AED';  @endphp
    @else
        @php $currency = '₹'; @endphp
    @endif

     <!-- Enter-Otp Modal -->
     <div class="modal fade" id="otp-popup" role="dialog" tabindex="-1" role="dialog" aria-labelledby="otp-popupLabel" aria-hidden="true">
        <div class="modal-dialog modal-md  modal-dialog-centered">
            <div class="modal-content ">
                <div class="modal-header d-block pt-3 px-4 pb-0 border-0">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title login-head">Verification</h4>
                    <p class="text-14 mt-1">We sent you a code to <span class="phonenumber" style="font-weight: bold; opacity: 1.0;color: #323a8f;">+91 **********</span>
                    <hr>
                </div>
                <div class="modal-body px-4 pt-2 pb-3">
                <div class="msgdivsuccess text-success" style="display: none;"></div>
                    <div class="msgdiv text-danger" style="display: none;"></div>
                    <h6>Enter OTP</h6>
                    <form class="digit-group" data-group-name="digits" data-autosubmit="false" autocomplete="off" id="otpform" role="form" action="#" method="POST">
                        @csrf
                        <input type="hidden" class="role_type" name="role_type" value="">
                        <input type="hidden" class="phone" name="phone" value="">
                        <input type="hidden" class="country_code" name="country_code" value="">
                        <input type="hidden" id="signuptype" name="signuptype" value="">
                        <input type="hidden" id="email" name="email" value="">
                         <input type="hidden" name="userid" id="userid" value="">
                         <input type="hidden" name="applyoption" id="applyoption" value="">

                        <input class="form-control mr-2" value="" id="digit-1" name="digit1" data-next="digit-2"  type="text" placeholder=""  style="width: 80px; display: inline-block;">
                        <input class="form-control  mr-2" value="" id="digit-2" name="digit2" data-next="digit-3" data-previous="digit-1"  type="text" placeholder=""  style="width: 80px; display: inline-block;">
                        <input class="form-control  mr-2" value=""  id="digit-3" name="digit3" data-next="digit-4" data-previous="digit-2"  type="text" placeholder=""  style="width: 80px; display: inline-block;">
                        <input class="form-control  mr-2" value="" id="digit-4"  name="digit4" data-previous="digit-3"  type="text" placeholder=""  style="width: 80px; display: inline-block;">

                        <p class="my-4"><span>Didn’t receive the code yet?</span>  <a href="#" id="resend_otp"> Resend Code</a></p>
                        <div class="form-group">
                            <button type="button" class="default-btn w-100 radius-btn" id="Submit"><span>Submit</span></button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>



<div class="modal fade" id="booking_successfully_container" tabindex="-1">
    <div class="modal-dialog modal-md modal-dialog-centered">
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

 <!-- Add document Modal -->
 <div class="modal fade" id="">
  <div class="modal-dialog modal-md modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header d-block pt-3 px-4 pb-0 border-0">
        <button type="button" class="close" data-dismiss="modal">
          <img src="{{asset('assets/care_connect_live/images/ic_cancel.png')}}" alt="">
        </button>
        <h4 class="modal-title login-head">
          <div class="row">
          <div class="col-8">
            Upload Documents
          </div>
          <div class="col-4">
            <button type="button" data-cat-id="" class="default-btn radius-btn w-100" id="add_doc">+ Add</button>
          </div>
        </h4>
      </div>
      <div class="modal-body px-4 pt-2 pb-3">
        <div class="table-responsive upload-documents-modal">
          <table class="table">
            <tbody id="doc_list">

              <tr>
                <td>Masters</td>
                <td>
                  <div class="document-image-wrap">
                    <img src="{{asset('assets/care_connect_live/images/ic_98.png')}}">
                  </div>
                </td>
                <td>
                  <a href=""  data-toggle="modal" data-target="#myModal"><i class="fas fa-edit mr-2"></i> <i class="fas fa-trash-alt"></i></a>
                </td>
              </tr>

              <tr>
                <td>Masters</td>
                <td>
                  <div class="document-image-wrap">
                    <img src="{{asset('assets/care_connect_live/images/ic_98.png')}}">
                  </div>
                </td>
                <td>
                  <a href=""><i class="fas fa-edit mr-2"></i> <i class="fas fa-trash-alt"></i></a>
                </td>
              </tr>

              <tr>
                <td>Masters</td>
                <td>
                  <div class="document-image-wrap">
                    <img src="{{asset('assets/care_connect_live/images/ic_98.png')}}">
                  </div>
                </td>
                <td>
                  <a href=""><i class="fas fa-edit mr-2"></i> <i class="fas fa-trash-alt"></i></a>
                </td>
              </tr>

            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>


<!-- The Modal -->
<div class="modal fade" id="myModal">
  <div class="modal-dialog modal-md modal-dialog-centered">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Document Details</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <section class="profile-wrapper edit-profile">
            <div class="row">
                <!-- <div class="col-12 mb-5">
                    <h1>Account</h1>
                </div> -->
                <div class="col-lg-12 profile-detail">
                    <div class="doctor_box">
                        <form action="{{ url('/profile/add_doc') }}" method="post" enctype="multipart/form-data">
                          {{ csrf_field() }}
                          <div class="position-relative document-upload-block">
                              <img class="user-profile showImg rounded-circle" src="{{asset('assets/care_connect_live/images/document1.png')}}" alt="" >
                              <div class="img-wrapper position-absolute">
                                  <label for="image_uploads" class="img-upload-btn"><i class="fas fa-camera"></i> </label>
                                  <input type="file" id="image_uploads" name="image_uploads" accept=".jpg, .jpeg, .png" style="opacity: 0;" required>
                              </div>
                          </div>
                          <div class="row">
                              <div class="col-sm-12">
                                  <div class="form-group">
                                      <label>Category</label>
                                      <select id="doc_cats" class="form-control" name="doc_category" required id=""></select>
                                  </div>
                              </div>
                              <div class="col-sm-12">
                                  <div class="form-group">
                                      <label>Title</label>
                                      <input name="title" required class="form-control" type="text" placeholder="">
                                  </div>
                              </div>
                              <div class="col-sm-12">
                                  <div class="form-group">
                                      <label>Description</label>
                                      <input name="description" required class="form-control" type="text" placeholder="">
                                  </div>
                              </div>
                              <div class="offset-md-9 col-md-3">
                                  <button type="submit" class="default-btn radius-btn w-100"><span>Save</span></button>
                              </div>
                          </div>
                        </form>
                    </div>
                </div>
        </div>
    </section>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="myModal_edit">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Document Details</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <section class="profile-wrapper edit-profile">
            <div class="row">
                <!-- <div class="col-12 mb-5">
                    <h1>Account</h1>
                </div> -->
                <div class="col-lg-12 profile-detail">
                    <div class="doctor_box">
                        <form action="{{ url('/profile/edit_doc') }}" method="post" enctype="multipart/form-data">
                          {{ csrf_field() }}
                          <input type="hidden" name="doc_id">
                          <div class="position-relative document-upload-block">
                              <img  class="user-profile showImg rounded-circle" src="{{asset('assets/care_connect_live/images/document1.png')}}" alt="" >
                              <div class="img-wrapper position-absolute">
                                  <label for="image_uploads_edit" class="img-upload-btn"><i class="fas fa-camera"></i> </label>
                                  <input type="file" id="image_uploads_edit" required name="image_uploads" accept=".jpg, .jpeg, .png" style="opacity: 0;">
                              </div>
                          </div>
                          <div class="row">
                              <div class="col-sm-12">
                                  <div class="form-group">
                                      <label>Category</label>
                                      <select disabled id="doc_cats_edit" class="form-control" name="doc_category" required id=""></select>
                                  </div>
                              </div>
                              <div class="col-sm-12">
                                  <div class="form-group">
                                      <label>Title</label>
                                      <input name="title" required class="form-control" type="text" placeholder="">
                                  </div>
                              </div>
                              <div class="col-sm-12">
                                  <div class="form-group">
                                      <label>Description</label>
                                      <input name="description" required class="form-control" type="text" placeholder="">
                                  </div>
                              </div>
                              <div class="offset-md-9 col-md-3">
                                  <button type="submit" class="default-btn radius-btn w-100"><span>Save</span></button>
                              </div>
                          </div>
                        </form>
                    </div>
                </div>
        </div>
    </section>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="myModal_blank">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Document Details</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <section class="profile-wrapper edit-profile">
            <div class="row">
                <!-- <div class="col-12 mb-5">
                    <h1>Account</h1>
                </div> -->
                <div class="col-lg-12 profile-detail">
                  <h3>No Record</h3>
                </div>
        </div>
    </section>
      </div>
    </div>
  </div>
</div>



<!-- footer -->
<script src="{{asset('assets/care_connect_live/js/jquery-min.js')}}"></script>
<script src="{{asset('assets/care_connect_live/js/slick.min.js')}}"></script>
<script src="{{asset('assets/care_connect_live/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/care_connect_live/js/jssocials.js')}}"></script>
<script src="{{asset('assets/care_connect_live/js/star-rating.min.js')}}" type="text/javascript"></script>

<script>

       $(".noti-bar").click(function(e){
           if(e.target.className == "nt-view")
           {
               return true;
           }
           else
           {
            e.preventDefault();
            $.ajax({
                type: "get",
                dataType: "json",
                url: base_url+'/user/notifications_ajax',
                //data: $('#digitalFrm').serialize(),
                success: function (response) {
                    console.log(response);
                    $("#notifications").toggleClass("open");
                }
            });
        }


       });

       if(typeof room_id === 'undefined')
       {

       }
       else
       {
var url = "https://meet.inhomed.com/Call_202001_151";
        //var url = "https://meet.royoapps.com/"+room_id;
   // var text = "Some text to share";


     $("#shareIcons").jsSocials({
            url: url,
         //   text: text,
            showLabel: false,
            showCount: false,
            shareIn: "popup",
            shares: [
                    {
                        share: "email",
                        label: "E-mail",
                        logo: "fas fa-at",
                        shareIn: "popup"

                    },
                    {
                        share: "whatsapp",
                        label: "E-mail",
                        logo: "fa fa-whatsapp",
                        shareIn: "popup",
                        shareUrl: "https://web.whatsapp.com/send?text="+encodeURI(url)
                        // shareUrl: 'https://test.com?url=https://assdas.com'

                    },
                    "facebook"
                ]
        });
    }
    if(typeof $("#video_player")[0] === 'undefined')
    {

    }
    else{
    $("#video_player")[0].autoplay = true;
    }



(function ($) {
    "use strict";
    $.fn.ratingThemes['krajee-fas'] = {
        filledStar: '<i class="fas fa-star"></i>',
        emptyStar: '<i class="far fa-star"></i>',
        clearButton: '<i class="fas fa-minus-circle"></i>'
    };
})(window.jQuery);
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
</script>



<script src='https://meet.royoapps.com/external_api.js'></script>
<!-- Date Rang JS -->
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src="{{asset('assets/care_connect_live/js/owl.carousel.min.js')}}"></script>
<script src="{{asset('assets/care_connect_live/js/main.js')}}"></script>
<script src="{{asset('assets/care_connect_live/js/intlTelInput.js')}}"></script>
<script src="{{ asset('assets/care_connect_live/js/custom.js')}}"></script>
<script src="{{ asset('assets/care_connect_live/js/jquery.toast.min.js') }}"></script>

<script>
    var base_url = "{{ url('/') }}";
    $('.carousel').carousel({
        pause: "false"
    });


</script>
@yield('script')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.4/socket.io.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

 var pushId = "{{  env('VAPID_PUBLIC_KEY') }}";
    @if(Auth::check())
  	    let user_id = "{{ Auth::user()->id }}";
        let sender_name = '{{ Auth::user()->name }}';
    @else
        let user_id = null;
        let sender_name = null;
    @endif

    let socket_url = "http://localhost:8080";
    let storage_url = "{{ Storage::disk('spaces')->url('thumbs/') }}";

    var socket = io.connect(socket_url, { query: "user_id="+parseInt(user_id) });

    var _data = {
        callsenderId:callsenderId,
        callreceiverId:callreceiverId,
        callreuquestId:callreuquestId,
        callsenderData:sender_name
    };

    socket.emit('callVideo', _data );



    socket.on("incomingCall", function (data) {
           // alert("incoming call from : " + data.senderData);
    		console.log('data',data);
            var audio_url = '{{ url("/") }}/service/'+ data.callreuquestId +'/audio_call';

           // alert(window.location.href);

            if(window.location.href.includes("audio_call") == false)
            {

                Swal.fire({
                title: 'Incoming Call from '+data.callsenderData,
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


</script>
<script>

$("#addAvailbityModal_manage .time_options_div").hide();

$('#addAvailbityModal_manage .schedule_date').on('click',function(e){
    e.preventDefault();
    $("#addAvailbityModal_manage .specific_date span").text('');
    $("#addAvailbityModal_manage .time_options_div").show();

    var date =  $(this).attr('data-val');
    var dateVal = $(this).find('label').text();

    $("#addAvailbityModal_manage .specific_date span").text(dateVal);
    //$("#addAvailbityModal .time_options_div").css("display", "block");
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

<script>

$('.custom_alert')
        .fadeIn(3000)
        .delay(100)
        .fadeTo(1000, 0.4)
        .delay(100)
        .fadeTo(1000,1)
        .delay(100)
        .fadeOut(3000);


    $(".toggle-password").click(function() {
        $(this).toggleClass("fa-eye fa-eye-slash");
        var input = $($(this).attr("toggle"));
        if (input.attr("type") == "password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }
    });

    var input = document.querySelector("#phoneno");
    var iti = intlTelInput(input, {
        utilsScript: "{{ asset('assets/care_connect_live/js/utils.js') }}",
        separateDialCode: true,
        preferredCountries: [],
        formatOnDisplay: true,
        preferredCountries: ["in"]
    });
    var countryCode = iti.getSelectedCountryData();
    var userFlag = "{{Auth::user()->country_code.Auth::user()->phone}}";
    if(userFlag)
    {
        iti.setNumber(userFlag);
    }
    else{
        $('#otp_login input[name=country_code]').val(countryCode.dialCode);
    }



    input.addEventListener("countrychange", function() {
        var country = iti.getSelectedCountryData();
        $('#otp_login input[name=country_code]').val(country.dialCode);
        // alert(country.dialCode);
    });

    var input = document.querySelector("#phone");
    var iti = intlTelInput(input, {
        utilsScript: "{{ asset('assets/care_connect_live/js/utils.js') }}",
        separateDialCode: true,
        preferredCountries: [],
        formatOnDisplay: true,
        preferredCountries: ["in"]
    });
    var countryCode = iti.getSelectedCountryData();
    var userFlag = "{{Auth::user()->country_code.Auth::user()->phone}}";
    if(userFlag)
    {
        iti.setNumber(userFlag);
    }
    else{
        $('#customer_profile input[name=country_code]').val(countryCode.dialCode);
    }



    input.addEventListener("countrychange", function() {
        var country = iti.getSelectedCountryData();
        $('#customer_profile input[name=country_code]').val(country.dialCode);
        // alert(country.dialCode);
    });
</script>
<script type="text/javascript">
    $("body").on("click", ".chat_btn ", function(e) {

        e.preventDefault();

        var serviceid = $(this).attr('data-serviceid');
        var userid = $(this).attr('data-userid');
        var categoryid = $(this).attr('data-categoryid');
        var url = $(this).attr('data-url');



        $('#booking').modal('show');

        $('.userid').val(userid);
        $('.serviceid').val(serviceid);
        $('.categoryid').val(categoryid);

        // var schedule_chat = base_url + '/user/schedule_chat/'+ userid + '/' + serviceid;

        var meet_now = base_url + '/user/doctor_details/' + userid + '/' + serviceid;

        // var oldmeetUrl = $('.meet_now').attr("href");
        // var newmeetUrl = oldmeetUrl.replace("#", meet_now);

        // $('#booking .meet_now').attr('href').replace(meet_now);

        //$('.meet_now').attr('href',meet_now);
        //$('#booking .schedule_chat').attr('href').replace(schedule_chat);

    });


    $('#booking .meet_now').on('click', function(e) {
        e.preventDefault();
        var userid = $('#booking .userid').val();
        var serviceid = $('#booking .serviceid').val();
        $('#booking .schedule_type').val('instant');

        //var schedule_chat = base_url + '/user/schedule_chat/'+ userid + '/' + serviceid;

        var meet_now = base_url + '/user/doctor_details/' + userid + '/' + serviceid;
        console.log(meet_now);
        window.location = meet_now;
        // $('#booking .meet_now').attr('href').replace(meet_now);

    });

    //  $('#booking .schedule_chat').on('click',function(e)
    //  {
    //     e.preventDefault();
    //     var userid = $('#booking .userid').val();
    //     var serviceid = $('#booking .serviceid').val();

    //     var schedule_chat = base_url + '/user/schedule_chat/'+ userid + '/' + serviceid;

    //     var meet_now = base_url + '/user/doctor_details/'+ userid;
    //     $('#booking .schedule_chat').attr('href').replace(schedule_chat);

    //  });

    $("#apply_coupon").click(function() {
        // get input
        var _coupon = $("input[name=coupon_code]").val();
        var _consultant_id = $("input[name=consultant_id]").val();
        var _service_id = $("input[name=service_id]").val();
        var _category_id = $("input[name=category_id]").val();
        var _total = $("input[name=total]").val();

        if (_coupon.length > 0) {
            // check code and apply
            $.post(_coupon_check_url, {
                "_token": _token,
                "coupon_code": _coupon,
                "consultant_id": _consultant_id,
                "service_id": _service_id,
                "category_id": _category_id,
                "total": _total
            }).done(function(data) {
                data = JSON.parse(data);
                // reset class
                $("#coupon_message").attr("class", "");


                if (data.status == "success") {
                    $("#coupon_message").text('Coupon Applied');
                    $("#coupon_message").addClass("text-success");
                    $("#promo_value").text(<?php echo $currency ?> + data.discount);
                    $("#total_value").text(<?php echo $currency ?> + data.grand_total);
                } else {
                    $("#coupon_message").text(data.message);
                    $("#coupon_message").addClass("text-danger");
                    $("#promo_value").text('<?php echo $currency ?> 0.00');
                    $("#total_value").text(<?php echo $currency ?> + _total);
                }
                $("#coupon_message").show();
                console.log(data);
            });
            // update promo applied
        } else {
            alert("Coupon Code Empty");
        }
    })


    $('#customer_profile .phone_patient').on('change', function() {
        var phone = $(this).val();
        var _country_code = $('#customer_profile #country_code').val();
        $.post(_check_phone, {
            "_token": _token,
            "phone": phone,
            "_country_code": _country_code
        }).done(function(data) {
            // console.log(data);
            $('#customer_profile .error').html(data.message);
        });
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

                if (data.status == "error") {
                        //alert(data.message);
                    // $('#create_request').text('create');
                    // if(data.message == 'Request could not Re-Scheduled becuase request going live into next hour')
                    // {
                    //      alert(data.message);
                    // }
                    $("#wallet_message").text(data.message);
                    // $("#form_message").addClass("text-danger");
                    // $("#form_message").show();

                    $("#wallet_message_container").modal('show');

                }

                else{

                        $('.spinner_btn').hide();
                        $('#bookingCreatedModal').modal('show');
                        var url  = '{{url('user/experts')}}';

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
                            }, 3000);

                 if(data.type="alert")
                     {
                        alert(data.message);
                        setTimeout(function(){
                            window.location.reload(1);
                            }, 3000);
                    }
             })

    });

    var rzp1 = null;

    $("#add_money").click(function(e){
        _amount = $("input[name=amount]").val();

        // generate order id
        $.post(_order_url, { amount: _amount, _token: _order_token }).done(function(data){
            if(data != "error")
            {
                _order_id = data;

                _amount = _amount * 100;

                // alert(_amount);

                var options = {
                    "key": "rzp_test_Aal6QDJNaVoFUs", // Enter the Key ID generated from the Dashboard
                    "amount": _amount, // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
                    "currency": "INR",
                    "name": "My Doctor",
                    "description": "Test Transaction",
                    "image": base_url + '/assets/care_connect_live/images/ic_logo2.png',
                    "order_id": _order_id, //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
                    // "callback_url": "{{ url('/user/wallet') }}",
                    "prefill": {
                        "name": _name,
                        "email": _email,
                        "contact": _contact
                    },

                    "notes": {
                        "address": "Razorpay Corporate Office"
                    },
                    "theme": {
                        "color": "#3399cc"
                    },
                    "handler": function (response){
                        console.log(response);
                        // save to db
                        // alert(response.razorpay_payment_id);
                        // alert(_order_id);


                        // update balance
                        $.post(_wallet_url, {
                            "_token": _order_token,
                            "razorpay_payment_id": response.razorpay_payment_id,
                            "razorpay_order_id": response.razorpay_order_id,
                            "razorpay_signature": response.razorpay_signature
                        }).done(function(data){
                            if(data == "done")
                            {
                                // show popup
                                // console.log(data);
                                alert("Payment added in wallet Successfully");
                                location.reload();
                            }
                            else
                            {
                                if(data != "error")
                                {
                                    location.href = data;
                                }
                                else
                                {
                                    alert("something went wrong");
                                }
                            }
                        })
                    },
                };

                rzp1 = new Razorpay(options);

                rzp1.open();
            }
            else
            {
                alert("something went wrong");
            }
        });
        e.preventDefault();
    });

    // rzp1.on('payment.failed', function (response){
    //     // something went wrong
    //     alert(response.error.code);
    //     alert(response.error.description);
    //     alert(response.error.source);
    //     alert(response.error.step);
    //     alert(response.error.reason);
    //     alert(response.error.metadata.order_id);
    //     alert(response.error.metadata.payment_id);
    // });

    // $(document).on('keyup',".search_box .searchInput",function(e){
    //     e.preventDefault();

    //     var category_id=$(".categoryInp").val();

    //     var service_id=$(".serviceInp").val();


    //     var search=$(this).val();

    //     $.get(_search_url,  {
    //         "_token": _token,
    //         "search": search,
    //         "category_id": category_id,
    //         "service_id": service_id
    //     }).done(function(data) {

    //             console.log(data);
    //             $("#filterData").html(data);
    //         });
    // });

    $("#searchSubmitButton").click(function(){
        var _input = $("#search_input").val();

        // alert(_input);

        location.href = window.location.href.split('?')[0] + "?search=" + _input;
    })

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





    $('#view_detail_container').modal('hide');
    $('.appointment_div .view_details').on('click',function(e){
        e.preventDefault();

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



    // $('.appiontmentdate').on('change',function(e)
    // {
    //       e.preventDefault();
    //     var date = $('.appiontment .date').val();
    //     alert(date);
    //     // $.get(_get_date_url, {
    //     //         "_token": _token,
    //     //         "date": date
    //     //     }).done(function(data){
    //     //         console.log(data);
    //     //     });
    // });

    $('input[name="date"]').on('apply.daterangepicker', function(ev, picker) {
      //  alert(picker.startDate.format('YYYY-MM-DD'));
      //  alert(picker.endDate.format('YYYY-MM-DD'));
       var  date = picker.startDate.format('YYYY-MM-DD');
       window.location.href=_get_date_url+'?date='+date;
     //  $(this).val(date);
       // alert(date);
        // $.get(_get_date_url+date, {
        //     "_token": _token,
        //     "date": date
        // }).done(function(data){
        //     console.log(data);
        // });
    });


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

$('.update_phone').click(function(e)
{
    e.preventDefault();
    $('#contact_details').modal('show');

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



    $('.update_password').click(function(e){
        e.preventDefault();
        $('#change-password').modal('show');
    });


	$(".toggle-password").click(function() {
		$(this).toggleClass("fa-eye fa-eye-slash");
        var input = $($(this).attr("toggle"));
        if (input.attr("type") == "password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }
    });

$('.choose_category').click(function(e){
    e.preventDefault();

    // get category id from data-id
    var _id = $(this).attr('data-id');

    // empty old data
    $("#doc_list").empty();

    $("# #add_doc").attr('data-cat-id', _id);

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

    window.$("#").modal("show");

});

    $("body").on("click", "# .delete_doc", function(e){

        var answer = confirm("Do you want to delete ?");

        if(!answer) {
            e.preventDefault();
        }
    });

    $("body").on("click", "# .edit_doc", function(e){

        window.$("#").modal("hide");

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

    $("# #add_doc").click(function(e){
        e.preventDefault();

        // clear old inputs
        $("#doc_cats").empty();
        $("#myModal input[name=title]").val('');
        $("#myModal input[name=description]").val('');

        window.$("#").modal("hide");

        var _id = $("# #add_doc").attr('data-cat-id');

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



    // if(_next_needed_doc_id != null && _next_needed_cat_id != null)
    // {
    //     // clear old inputs
    //     $("#doc_cats").empty();
    //     $("#myModal input[name=title]").val('');
    //     $("#myModal input[name=description]").val('');

    //     window.$("#").modal("hide");

    //     var _id = _next_needed_cat_id;

    //     var _total_doc_options = 0;

    //     // get categories from ajax
    //     $.getJSON(_category_id_url+'?cat_id='+_id, function(data){
    //         _total_doc_options = data.length;
    //         $.each(data, function(key, item){
    //             console.log(item.name);
    //             var _option = `
    //                 <option value="`+item.id+`">`+item.name+`</option>
    //             `;
    //             $("#doc_cats").append(_option);
    //         });

    //         if(_total_doc_options > 0)
    //         {
    //             window.$("#myModal").modal("show");

    //             $("#doc_cats").val(_next_needed_doc_id);
    //         }
    //         else
    //         {
    //             window.$("#myModal_blank").modal("show");
    //         }
    //     });

    // }


    function readURLImgNew(input) {

    if (input.files && input.files[0]) {
      // var reader = new FileReader();

    //   reader.onload = function(e) {
    //     $('.showImg').attr('src', e.target.result);
    //   }

      var data = input.files;

      $.each(data, function(index, file){
        var fRead = new FileReader(); //new filereader

        fRead.readAsDataURL(file);

        fRead.onload = (function(e){
           // alert(index);
            $('.showImgNew[data-id='+index+']').attr('src', e.target.result);
            $('.showImgNew[data-id='+index+']').closest("li").show();
        });
      })



      // reader.readAsDataURL(input.files[0]); // convert to base64 string
    }
  }

  $('.reemoveImg').click(function(e){
      var index = $(this).attr('data-id');
    $('.showImgNew[data-id='+index+']').closest("li").remove();
  });


  $('.reemoveEditImg').click(function(e){
    e.preventDefault();
      var index = $(this).attr('data-id');

      var imageId =  $(this).attr('data-image-id');
      // fetch data based on id
      $.getJSON(_image_delete_path+imageId, function(data){
           //    console.log(data);
           $('.showImgEditNew[data-id='+index+']').closest("li").remove();
           location.reload();
     });

  });


  $("#image_uploads_new").change(function() {
    readURLImgNew(this);
  });

  $("#image_uploads_new_edit").change(function() {
    readURLImgNew(this);
  });
  $('.empty_dosage_div').show();
    $('.tablet_div').hide();
    $('.capsule_div').hide();
    $('.syrup_div').hide();
    $('.capsule_div').prop('disabled', 'disabled');
    $('.syrup_div').prop('disabled', 'disabled');
    $('.tablet_div').prop('disabled', 'disabled');
    $('.empty_dosage_div').prop('disabled', false);


  $('#dosageType').on('change',function(e){
       var dosagetype = $(this).val();
       if(dosagetype == 'Tablet')
       {
           $('.tablet_div').show();
           $('.capsule_div').hide();
           $('.syrup_div').hide();
           $('.empty_dosage_div').hide();
           $('.capsule_div').prop('disabled', 'disabled');
           $('.syrup_div').prop('disabled', 'disabled');
           $('.empty_dosage_div').prop('disabled', 'disabled');
           $('.tablet_div').prop('disabled', false);

       }
       if(dosagetype == 'Capsule')
       {
           $('.tablet_div').hide();
           $('.capsule_div').show();
           $('.syrup_div').hide();
           $('.empty_dosage_div').hide();
           $('.capsule_div').prop('disabled', false);
           $('.syrup_div').prop('disabled', 'disabled');
           $('.empty_dosage_div').prop('disabled', 'disabled');
           $('.tablet_div').prop('disabled', 'disabled');
       }
       if(dosagetype == 'Syrup')
       {
           $('.tablet_div').hide();
           $('.capsule_div').hide();
           $('.syrup_div').show();
           $('.empty_dosage_div').hide();
           $('.capsule_div').prop('disabled', 'disabled');
           $('.syrup_div').prop('disabled', false);
           $('.empty_dosage_div').prop('disabled', 'disabled');
           $('.tablet_div').prop('disabled', 'disabled');

       }
  });

  $('.breakfast_drop_div_container').show();
$('.dinner_drop_div_container').hide();
$('.lunchdrop_div_container').hide();

$("select option").each(function(){
  if ($(this).text() == "B")
    $(this).attr("selected","selected");
});

$('.breakfast').on('change',function(){
  var selval = $(this).val();
  $(this).find('option[value="' + selval + '"]').attr("selected", "selected");
});


$(".breakfastdiv").on('click',function() {
 //   e.preventdefault();

    if($(this).is(":checked"))
    {

        $('.breakfast_drop_div_container').show();


    }
    else{
        // $(this).attr('checked',false);
        // $(this).find('#doseValue').attr('selected',false);
         $('.breakfast_drop_div_container').hide();

    }

});

$('.prescription_medicine_delete').on('click',function(e){
    var delId = $(this).attr('data-id');
     // fetch data based on id
     $.getJSON(_prescription_medicine_delete_path+delId, function(data){
           //    console.log(data);
           $(this).closest("div").remove();
          // location.reload();
     });
});


$(".lunchdiv").on('click',function() {
 //   e.preventdefault();

    if($(this).is(":checked"))
    {

        $('.lunchdrop_div_container').show();

    }
    else{
         $('.lunchdrop_div_container').hide();

    }

});

$(".dinnerdiv").on('click',function() {
 //   e.preventdefault();

    if($(this).is(":checked"))
    {

        $('.dinner_drop_div_container').show();

    }
    else{
         $('.dinner_drop_div_container').hide();

    }

});

var _items = [];
//$('.append_row').hide();
$('.prescription_medicine_add').on('click',function(e){
    e.preventDefault();

    $.ajax({
        type: "post",
        dataType: "json",
        url: _prescription_medicine_add_path,
        data: $('#digitalFrm').serialize(),
        success: function (response) {
           //console.log(response);

           $('.append_row').show();
           if(response.pre_scription_id == null)
           {
            $('.append_row').append(' <div class="row" data-id="'+response.id+'"> <div class="col-6" style="float: left;"> '+ response.medicine_name +' </div><div class="col-6" style="float: right; text-align:end;"><a class="prescription_medicine_edit" data-id = '+response.id+'  data-request_id = '+response.request_id+'  data-medicine_name = '+response.medicine_name+' data-duration = '+response.duration+'  data-dosage_type = '+response.dosage_type+' data-dosage_timing = '+response.dosage_timing+' href="#"><span>Edit</span></a> | <a class="prescription_medicine_delete" data-id = '+response.id+' href=""><span>Delete</span></a></div></div>');
            $('#digitalFrm .dummy_id').val(response.id);
            $('#digitalFrm input[name="dummy_id"]').val('');
           }
           else{
            $('.append_row').append(' <div class="row"  data-id="'+response.id+'"> <div class="col-6" style="float: left;"> '+ response.medicine_name +' </div><div class="col-6" style="float: right; text-align:end;"><a class="prescription_medicine_edit" data-pre-scription-id = "'+response.pre_scription_id+'" data-med-id = '+response.id+'  data-request_id = '+response.request_id+'  data-medicine_name = '+response.medicine_name+' data-duration = '+response.duration+'  data-dosage_type = '+response.dosage_type+' data-dosage_timing = '+response.dosage_timing+' href="#"><span>Edit</span></a> | <a class="prescription_medicine_delete" data-med-id = '+response.id+' href=""><span>Delete</span></a></div></div>');
            $('#digitalFrm .medicine_id').val(response.id);
            $('#digitalFrm input[name="medicine_id"]').val('');
           }

           $('#digitalFrm .dosagetiming').val(response.dosage_timing);
           $('#digitalFrm .pre_scriptions').val(response.pre_scriptions);
           //resetForm('digitalFrm');
        //    $('#digitalFrm input[name="medicine_name"]').val('');
        //    $('#digitalFrm select').val('');
        //    $('#digitalFrm checkbox').attr('selected',false);
        //    $('#digitalFrm radio').attr('checked',false);
        //    $('#digitalFrm input[name="dosage_timing"]').val('');

           //$('#digitalFrm').empty();
        }
    });


});

$('#digitalfrm .prescription_medicine_reset').on('click',function(e){
    e.preventDefault();
    resetForm('digitalFrm');
});

$('#dummyfrm .prescription_medicine_reset').on('click',function(e){
    e.preventDefault();
    resetForm('dummyFrm');
});

function resetForm(formid) {
    $(':input','#'+formid) .not(':button, :submit, :reset, :hidden') .val('')
  .removeAttr('checked') .removeAttr('selected');
  }

$('#edit_prescription_model .dummy_id').val('');
$('#edit_prescription_model .medicine_name').val('');
$("body").on("click", ".prescription_medicine_edit ", function(e) {
 e.preventDefault();
    var dummy_id = $(this).attr('data-id');
    var medicine_id = $(this).attr('data-med-id');
    var pre_scription_id= $(this).attr('data-pre-scription-id');
    var request_id = $(this).attr('data-request_id');

    if(pre_scription_id != null && medicine_id != null)
    {
        var url = _medicine_edit_path+medicine_id+'/'+pre_scription_id;
    }
    else{
        var url = _medicine_get_edit_path+dummy_id;
    }

   // alert(url);
    $.getJSON(url, function(data){
              // console.log(data);

            $('#edit_prescription_model').modal('show');
            if(pre_scription_id != null && medicine_id != null )
            {
                $('#edit_prescription_model .pre_scription_id').val(data.pre_scription_id);
                $('#edit_prescription_model .medicine_id').val(data.id);
                var dosage = JSON.parse(data.dosage_timing);
            }
            else{
                $('#edit_prescription_model .dummy_id').val(data.id);
                var dosage = JSON.parse(data.dosage_timimg);
            }
            $('#edit_prescription_model .medicine_name').val(data.medicine_name);
            $("#edit_prescription_model #duration option[value='" + data.duration + "']").attr("selected","selected");
            $("#edit_prescription_model #dosageType option[value='" + data.dosage_type + "']").attr("selected","selected");

             $.each( dosage, function( key, value ) {
              //   alert(value);
                var _og_target = value.time;
                var _time = value.with;

                var _target = 'with-' + _og_target;

               //  alert(_target + " "+ _time);

                $("a.withdata[data-target="+_og_target+"]").closest("li").removeClass("active");


                $("#edit_prescription_model input[type=radio][name="+_target+"][value="+_time+"]").prop("checked", true);
                $("#edit_prescription_model input[type=radio][name="+_target+"][value="+_time+"]").closest("li").addClass("active");
                var _txt = _og_target.toLowerCase();

                $("#edit_prescription_model ."+_txt+" ").val(value.dose_value);

                $("."+ _txt +"div").prop("checked", "checked");
           });



     });



});

$('.prescription_medicine_edit_submit').on('click',function(e){
    e.preventDefault();
    var dummy_id = $('#edit_prescription_model .dummy_id').val();
    var medicine_id = $('#edit_prescription_model .medicine_id').val();
    var pre_scription_id = $('#edit_prescription_model .pre_scription_id').val();


    $.ajax({
        type: "post",
        dataType: "json",
        url: _prescription_medicine_edit_path,
        data: $('#dummyFrm').serialize(),
        success: function (response) {
           console.log(response);
           $('#edit_prescription_model').modal('hide');
          // $('.append_row').closest().remove();
          if(pre_scription_id != null && medicine_id != null)
          {
            $(".append_row .row[data-id="+medicine_id+"]").remove();
            $('.append_row').append(' <div class="row"  data-id="'+response.id+'"> <div class="col-6" style="float: left;"> '+ response.medicine_name +' </div><div class="col-6" style="float: right; text-align:end;"><a class="prescription_medicine_edit" data-pre-scription-id = "'+response.pre_scription_id+'" data-med-id = '+response.id+'  data-request_id = '+response.request_id+'  data-medicine_name = '+response.medicine_name+' data-duration = '+response.duration+'  data-dosage_type = '+response.dosage_type+' data-dosage_timing = '+response.dosage_timing+' href="#"><span>Edit</span></a> | <a class="prescription_medicine_delete" data-med-id = '+response.id+' href=""><span>Delete</span></a></div></div>');
            $('#digitalFrm .medicine_id').val(response.id);
          }
          else{
            $(".append_row .row[data-id="+dummy_id+"]").remove();
            $('.append_row').append(' <div class="row" data-id="'+response.id+'"> <div class="col-6" style="float: left;"> '+ response.medicine_name +' </div><div class="col-6" style="float: right; text-align:end;"><a class="prescription_medicine_edit" data-id = '+response.id+'  data-request_id = '+response.request_id+'  data-medicine_name = '+response.medicine_name+' data-duration = '+response.duration+'  data-dosage_type = '+response.dosage_type+' data-dosage_timing = '+response.dosage_timing+' href="#"><span>Edit</span></a> | <a class="prescription_medicine_delete" data-id = '+response.id+' href=""><span>Delete</span></a></div></div>');
            $('#digitalFrm .dummy_id').val(response.id);
          }

           $('#digitalFrm .dosagetiming').val(response.dosage_timing);
           $('#digitalFrm .pre_scriptions').val(response.pre_scriptions);
         //  $("#dummyFrm")[0].reset();

        }
    });


});

$(".withdata").click(function(){
    var _og_target = $(this).attr('data-target');
    var _time = $(this).attr('data-time');

    var _target = 'with-' + _og_target;

    // alert(_target + " "+ _time);

    $("a.withdata[data-target="+_og_target+"]").closest("li").removeClass("active");


    $("input[type=radio][name="+_target+"][value="+_time+"]").prop("checked", true);
    $("input[type=radio][name="+_target+"][value="+_time+"]").closest("li").addClass("active");
    // $("input[type=radio][name="+_target+"][value="+_time+"]").hide();
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


 $('.availability_manage').click(function(e){

      var serviceid =  $(this).attr('data-id');
      var categoryid =  $(this).attr('data-category-id');
      //  alert(serviceid);
      $('#addAvailbityModal_manage').modal('show');
      $('#addAvailbityModal_manage .serviceid').val(serviceid);
      $('#addAvailbityModal_manage .categoryid').val(categoryid);
  });



  $("#addAvailbityModal_manage #customFields").on('click','.remCF',function(){
      // alert("asda");
      $(this).closest('.new_row').remove();
      // $(this).parent(".new_row").remove();
  });




$('#appointmentdatepicker').daterangepicker();
$('#appointmentdatepicker').on('apply.daterangepicker', function(ev, picker) {

  console.log(picker.startDate.format('YYYY-MM-DD'));
  console.log(picker.endDate.format('YYYY-MM-DD'));
});



$('.ratingreview').on('click',function(e)
{
    e.preventDefault();
    $('#ratingModal').modal('show');


})

$(" #ratingModal #ratingbtn").on('click',function (event) {
    event.preventDefault();
    var requestid = $("#ratingModal input[name=request_id]").val();
    $.ajax({
      type: "POST",
      url: base_url+ '/add-review',
      data: $('#ratingModal #ratingForm').serialize(),
      dataType: "json"
        }).done(function (data) {
            //console.log(data.status);
            if(data.status == 'success')
            {
            $("#ratingModal .msgdivsuccess").text(data.message);
            $("#ratingModal .msgdivsuccess").show();
            $('#ratingModal .msgdivsuccess').fadeIn('slow').delay(2000).fadeOut('slow');
            $('#ratingModal').modal('hide');
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


  $('#toggleSwitch1').on('change',function(){
        var manual_available = false;
        // alert(_toggle_val);
        if($(this).is(":checked"))
        {
           var manual_available = true;
        }
        $.post("{{ url('/online-toggle') }}", { _token: "{{ csrf_token() }}", manual_available: manual_available  }).done(function(data){
            console.log(data);
        });
  });

  $('.advertisement_share_btn').click(function(e){
        e.preventDefault();
        $('#shareIcons').show();
  });

  $('#state_filter').on('change',function(){
        var state = $(this).val();
        $.get("{{ url('/user/experts') }}", { _token: "{{ csrf_token() }}", state: state  }).done(function(data){
            console.log(data);
        });
 });



</script>

