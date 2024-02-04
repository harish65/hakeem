@extends('vendor.mp2r.layouts.index', ['title' => 'Manage Availability','header_after_login'=>true])
@section('css')
@endsection
@section('content')
<style>
    .tablinks {
        cursor: pointer;
    }
    .second-name p{
        font-size: 16px !important;
    }
    .slider-days.text-center.slick-slide.slick-current.slick-active {

        width: 100px !important;
        cursor: pointer;
    }

    .slider-days.text-center.slick-slide.slick-active{

        width: 100px !important;
        cursor: pointer;
    }
</style>
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<section class="main-height-clr bg-clr" id="manage_avail">
    <div class="container">
        <h2 class="heading-top">Account</h2>
        <div class="row">
            <!-- left side  -->
            <div class="col-md-4 col-lg-4 col-sm-4">
                <div class="left-dashboard2 mt-4">
                    <div class="side-head p-4">
                        <img id="OpenImgUpload"  src="{{ Auth()->user()->profile_image ? Storage::disk('spaces')->url('uploads/' . Auth()->user()->profile_image) : asset('assets/mp2r/images/default.png') }}" class="img-fluid mx-auto d-block" style="height: 192px;width: 192px;border-radius: 50%;">
                        <form id="user_image_upload" enctype="multipart/form-data" method="post">
                          <input name="profile_image" type="file" id="imgupload" style="display:none" accept="image/*" /> 
                          <input type="submit" name="" id="submitfile" style="display: none;">
                        </form>
                    </div>
                    <ul class="left-side-bar mb-3">
                        <div class="tab">
                            <li class="tablinks active" id="defaultOpen">Manage Availability</li>
                            <li class="tablinks"><a href="{{ url('/Sp/ChatHistoryPage?userid='.Auth::user()->id.'&nickname='.Auth::user()->name)}}" style="color: black;">Chat</a></li>
                            <li class="tablinks"><a href="{{ url('Sp/manage_availibilty_new?tab=notification')}}" style="color: black;">Notification</a></li>
                             <li class="tablinks" ><a style="color: #212529" href="{{ url('service_provider/Appointment') }}">Service Provider Dashboard</a></li>
                            <li class="tablinks" id="profile_detail_1"><a href="{{ url('Sp/manage_availibilty_new?tab=profile_detail')}}" style="color: black;">Profile Details</a> </li>
                            <li class="tablinks" id="change_password_1"><a href="{{ url('Sp/manage_availibilty_new?tab=change_password')}}" style="color: black;">Change Password</a></li>
                            <li class="tablinks" id="update_category_1"><a href="{{ url('Sp/manage_availibilty_new?tab=update_category')}}" style="color: black;">Update Category</a></li>
                            <li  data-id="{{ Auth::user()->id }}" id="cookie_policy_1"  class="tablinks"><a href="{{ url('Sp/manage_availibilty_new?tab=cookie_policy')}}" style="color: black;">Cookie Policy</a></li>
                            <li  data-id="{{ Auth::user()->id }}" id="privacy_policy_1"  class="tablinks"><a href="{{ url('Sp/manage_availibilty_new?tab=privacy_policy')}}" style="color: black;">Privacy Policy</a></li>
                        </div>
                    </ul>
                </div>
            </div>
            <div id="manage_availability" class="col-lg-8 col-md-8 col-sm-8 tabcontent">
                <section class="wrapper2 form-sec">
                    <p class="change-pw">Select Availability</p>
                    <div class="slider-sec">
                        @if (session('message'))

                        <div class="alert alert-success" role="alert">
                            {{ session('message') }}
                        </div>
                        @endif
                        
                    </div>
                    <section class="select-time">
                        <p class="select-date">Select Time</p>
                        <div class="row" id="intervalList">
                            <div v-for="(interval, index) in intervals" class="col-md-12 row start_times">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="pwd">From</label>
                                        <select v-model="interval.seleted_start" class="form-control" id="sel1">
                                            <option v-for="time1 in interval.start_times" :value="time1.key">
                                                @{{ time1.value }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="pwd">To</label>
                                        <select v-model="interval.seleted_end" class="form-control" id="sel1">
                                            <option v-for="time in interval.end_times" :value="time.key">
                                                @{{ time.value }}</option>
                                        </select>
                                        <img :src="delete_img" class="img-fluid del-img delete_interval" @click="deleteInterval(index)">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <a href="javascript:void(0)" id='new_interval' @click="newInterval" class=" new-group">+ New
                        Interval</a>
            <div class="slider-sec">
            <div class="row m-0">
                <div class="col-md-12">
                 <div class="form-group form-check">
                      <div id="daterangepicker"></div>
                      <input id="onclickdate" @input="clickHadleType('specific_date')" class="form-check-input pr-2" type="checkbox"><label class="form-check-label pb-0 checkbox-label">Select availabilty for Particular date
                    </label>
                  </div>
                </div>
            </div>
            <h6>Select Day</h6>
            <section class="day-slider3 ml-4" id="dateList">
                <div v-for="date in dates" class='slider-days text-center' @click="selectedData($event,date)">
                    <P class='today'>@{{ date . day_text }}</P>
                    
                </div>
            </section>          
            </div>
                    <div class="row m-0 ">
                        <button type="button" id="submit_btn_id" class="btn-next mt-3" @click="saveAvai()">
                            @{{ submit_btn_text }}</button>
                    </div>
                </section>
            </div>
            
            
        </div>
    </div>
</section>
@endsection
@section('script')
<script type="text/javascript">
    $(document).ready(function() {});
       $(function() {
          $("#daterangepicker").daterangepicker({
            autoclose: false,
            closeBtn: true,
            singleDatePicker: true,
            showDropdowns: true,
            minYear: 1901,
            maxYear: parseInt(moment().format('YYYY'),10),
            onClose: function () {
                alert('Datepicker Closed');
            }
          }, function(start, end, label) {
            console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));

        });
        $("#onclickdate").click(function () {
            console.log($(this).prop('checked'));
            if ($(this).prop('checked') == false) {
                $('.day-slider3').css('display','block');
                $("#submit_btn_id").text('Save');
            }else{
                $("#daterangepicker").trigger('click');
                if(date_picker_date!==null){
                    var today_date23 = moment(date_picker_date).format('MMM D,YY');
                    $('.day-slider3').css('display','none');
                    $("#submit_btn_id").text('Save For '+today_date23);
                }
            }
        });
    });
    var date_picker_date = null;
    $(document).on('click','.today',function(){
        if($(this).parent().hasClass('slick-current')){
           $(this).parent().removeClass('slick-current');
        }else{
          $(this).parent().addClass('slick-current');
        }
    });

    $(document).on('click','.applyBtn',function(){
        var startDate = $('#daterangepicker').data('daterangepicker').startDate._d;
        date_picker_date = startDate;
        var today_date = moment(startDate).format('MMM D,YY');
        $('.day-slider3').css('display','none');
        $("#submit_btn_id").text('Save For '+today_date);
    });
    let weeks = [];
    let daysRequired = 7;

    
    function addMonths(date, months) {
        var d = date.getDate();
        date.setMonth(date.getMonth() + +months);
        if (date.getDate() != d) {
            date.setDate(0);
        }
        return date;
    }
    var today_date = moment().format('Y/M/D');
    var selected_date_model = {
        'day_text': '',
        'day': '',
        "date": moment(today_date).format('MMM D,YY'),
        "full_date": moment(today_date).format('Y/M/D')
    };
    var days = [];
    var current_date = new Date();
    var last_date = new Date(addMonths(new Date(), 3).toString());
    var dates = [];
    var weekday = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
    var weekdaycount=[0, 1, 2, 3, 4, 5, 6];
    for (let i = 0; i<daysRequired; i++) {
        var d = moment().add(i, 'days');
        var same = moment(today_date).isSame(d.format('Y/M/D'));
        var day_name = weekday[d.day()];
        var day = 1; //second index after 0
        if (same) {
            selected_date_model = {
                'day_text': 'Today',
                'day': day_name,
                'day_count': moment(d).day(),
                "date": moment(d).format('MMM D,YY'),
                "full_date": moment(d).format('Y/M/D')
            };
            days.push(selected_date_model);
            dates.push({
                'day_text': 'Today',
                'day': day_name,
                'day_count': moment(d).day(),
                "date": moment(d).format('MMM D,YY'),
                "full_date": moment(d).format('Y/M/D')
            });
        } else {
            dates.push({
                'day_text': day_name,
                'day': day_name,
                'day_count': moment(d).day(),
                "date": moment(d).format('MMM D,YY'),
                "full_date": moment(d).format('Y/M/D')
            });
        }
    }
    // for (var day = current_date; day <= last_date; day.setDate(day.getDate() + 1)) {
    //     var same = moment(today_date).isSame(moment(day).format('Y/M/D'));
    //     var day_name = weekday[day.getDay()];
    //     if (same) {
    //         selected_date_model = {
    //             'day_text': 'Today',
    //             'day': day_name,
    //             "date": moment(day).format('MMM D,YY'),
    //             "full_date": moment(day).format('Y/M/D')
    //         };
    //         days[selected_date_model.day] = selected_date_model;
    //         dates.push({
    //             'day_text': 'Today',
    //             'day': day_name,
    //             "date": moment(day).format('MMM D,YY'),
    //             "full_date": moment(day).format('Y/M/D')
    //         });
    //     } else {
    //         dates.push({
    //             'day_text': day_name,
    //             'day': day_name,
    //             "date": moment(day).format('MMM D,YY'),
    //             "full_date": moment(day).format('Y/M/D')
    //         });
    //     }
    // }
    new Vue({
        el: '#manage_avail',
        data: {
            days:days,
            dates: dates,
            start_times: [{
                    "key": "00:00",
                    "value": "00:00 am"
                },
                {
                    "key": "01:00",
                    "value": "01:00 am"
                },
                {
                    "key": "02:00",
                    "value": "02:00 am"
                },
                {
                    "key": "03:00",
                    "value": "03:00 am"
                },
                {
                    "key": "04:00",
                    "value": "04:00 am"
                },
                {
                    "key": "05:00",
                    "value": "05:00 am"
                },
                {
                    "key": "06:00",
                    "value": "06:00 am"
                },
                {
                    "key": "07:00",
                    "value": "07:00 am"
                },
                {
                    "key": "08:00",
                    "value": "08:00 am"
                },
                {
                    "key": "09:00",
                    "value": "09:00 am"
                },
                {
                    "key": "10:00",
                    "value": "10:00 am"
                },
                {
                    "key": "11:00",
                    "value": "11:00 am"
                },
                {
                    "key": "12:00",
                    "value": "12:00 pm"
                },
                {
                    "key": "13:00",
                    "value": "13:00 pm"
                },
                {
                    "key": "14:00",
                    "value": "14:00 pm"
                },
                {
                    "key": "15:00",
                    "value": "15:00 pm"
                },
                {
                    "key": "16:00",
                    "value": "16:00 pm"
                },
                {
                    "key": "17:00",
                    "value": "17:00 pm"
                },
                {
                    "key": "18:00",
                    "value": "18:00 pm"
                },
                {
                    "key": "19:00",
                    "value": "19:00 pm"
                },
                {
                    "key": "20:00",
                    "value": "20:00 pm"
                },
                {
                    "key": "21:00",
                    "value": "21:00 pm"
                },
                {
                    "key": "22:00",
                    "value": "22:00 pm"
                },
                {
                    "key": "23:00",
                    "value": "23:00 pm"
                }
            ],
            end_times: [{
                    "key": "00:00",
                    "value": "00:00 am"
                },
                {
                    "key": "01:00",
                    "value": "01:00 am"
                },
                {
                    "key": "02:00",
                    "value": "02:00 am"
                },
                {
                    "key": "03:00",
                    "value": "03:00 am"
                },
                {
                    "key": "04:00",
                    "value": "04:00 am"
                },
                {
                    "key": "05:00",
                    "value": "05:00 am"
                },
                {
                    "key": "06:00",
                    "value": "06:00 am"
                },
                {
                    "key": "07:00",
                    "value": "07:00 am"
                },
                {
                    "key": "08:00",
                    "value": "08:00 am"
                },
                {
                    "key": "09:00",
                    "value": "09:00 am"
                },
                {
                    "key": "10:00",
                    "value": "10:00 am"
                },
                {
                    "key": "11:00",
                    "value": "11:00 am"
                },
                {
                    "key": "12:00",
                    "value": "12:00 pm"
                },
                {
                    "key": "13:00",
                    "value": "13:00 pm"
                },
                {
                    "key": "14:00",
                    "value": "14:00 pm"
                },
                {
                    "key": "15:00",
                    "value": "15:00 pm"
                },
                {
                    "key": "16:00",
                    "value": "16:00 pm"
                },
                {
                    "key": "17:00",
                    "value": "17:00 pm"
                },
                {
                    "key": "18:00",
                    "value": "18:00 pm"
                },
                {
                    "key": "19:00",
                    "value": "19:00 pm"
                },
                {
                    "key": "20:00",
                    "value": "20:00 pm"
                },
                {
                    "key": "21:00",
                    "value": "21:00 pm"
                },
                {
                    "key": "22:00",
                    "value": "22:00 pm"
                },
                {
                    "key": "23:00",
                    "value": "23:00 pm"
                }
            ],
            intervals: [{
                seleted_start: "00:00",
                seleted_end: "01:00",
                start_times: [{
                        "key": "00:00",
                        "value": "00:00 am"
                    },
                    {
                        "key": "01:00",
                        "value": "01:00 am"
                    },
                    {
                        "key": "02:00",
                        "value": "02:00 am"
                    },
                    {
                        "key": "03:00",
                        "value": "03:00 am"
                    },
                    {
                        "key": "04:00",
                        "value": "04:00 am"
                    },
                    {
                        "key": "05:00",
                        "value": "05:00 am"
                    },
                    {
                        "key": "06:00",
                        "value": "06:00 am"
                    },
                    {
                        "key": "07:00",
                        "value": "07:00 am"
                    },
                    {
                        "key": "08:00",
                        "value": "08:00 am"
                    },
                    {
                        "key": "09:00",
                        "value": "09:00 am"
                    },
                    {
                        "key": "10:00",
                        "value": "10:00 am"
                    },
                    {
                        "key": "11:00",
                        "value": "11:00 am"
                    },
                    {
                        "key": "12:00",
                        "value": "12:00 pm"
                    },
                    {
                        "key": "14:00",
                        "value": "13:00 pm"
                    },
                    {
                        "key": "01:00",
                        "value": "14:00 pm"
                    },
                    {
                        "key": "15:00",
                        "value": "15:00 pm"
                    },
                    {
                        "key": "16:00",
                        "value": "16:00 pm"
                    },
                    {
                        "key": "17:00",
                        "value": "17:00 pm"
                    },
                    {
                        "key": "18:00",
                        "value": "18:00 pm"
                    },
                    {
                        "key": "19:00",
                        "value": "19:00 pm"
                    },
                    {
                        "key": "20:00",
                        "value": "20:00 pm"
                    },
                    {
                        "key": "21:00",
                        "value": "21:00 pm"
                    },
                    {
                        "key": "22:00",
                        "value": "22:00 pm"
                    },
                    {
                        "key": "23:00",
                        "value": "23:00 pm"
                    }
                ],
                end_times: [{
                        "key": "00:00",
                        "value": "00:00 am"
                    },
                    {
                        "key": "01:00",
                        "value": "01:00 am"
                    },
                    {
                        "key": "02:00",
                        "value": "02:00 am"
                    },
                    {
                        "key": "03:00",
                        "value": "03:00 am"
                    },
                    {
                        "key": "04:00",
                        "value": "04:00 am"
                    },
                    {
                        "key": "05:00",
                        "value": "05:00 am"
                    },
                    {
                        "key": "06:00",
                        "value": "06:00 am"
                    },
                    {
                        "key": "07:00",
                        "value": "07:00 am"
                    },
                    {
                        "key": "08:00",
                        "value": "08:00 am"
                    },
                    {
                        "key": "09:00",
                        "value": "09:00 am"
                    },
                    {
                        "key": "10:00",
                        "value": "10:00 am"
                    },
                    {
                        "key": "11:00",
                        "value": "11:00 am"
                    },
                    {
                        "key": "12:00",
                        "value": "12:00 pm"
                    },
                    {
                        "key": "14:00",
                        "value": "13:00 pm"
                    },
                    {
                        "key": "01:00",
                        "value": "14:00 pm"
                    },
                    {
                        "key": "15:00",
                        "value": "15:00 pm"
                    },
                    {
                        "key": "16:00",
                        "value": "16:00 pm"
                    },
                    {
                        "key": "17:00",
                        "value": "17:00 pm"
                    },
                    {
                        "key": "18:00",
                        "value": "18:00 pm"
                    },
                    {
                        "key": "19:00",
                        "value": "19:00 pm"
                    },
                    {
                        "key": "20:00",
                        "value": "20:00 pm"
                    },
                    {
                        "key": "21:00",
                        "value": "21:00 pm"
                    },
                    {
                        "key": "22:00",
                        "value": "22:00 pm"
                    },
                    {
                        "key": "23:00",
                        "value": "23:00 pm"
                    }
                ]
            }],
            start_intervals: "00:00",
            end_intervals: "01:00",
            class_number: 1,
            selected_int_list: [],
            delete_img: base_url + "/assets/mp2r/images/delet.png",
            selected_date_model: selected_date_model,
            submit: false,
            handle_type: 'multiple_days',
            submit_btn_text: 'Next',
        },
        methods: {
            selectedData: function(event,data) {
                this.selected_date_model = data;
                const filteredPeople = this.days.findIndex((item) => item.day==data.day);
                if(filteredPeople!==-1){
                    this.days.splice(filteredPeople,1);
                }else{
                    this.days.push(data);
                }
            },
            clickHadleType: function(type) {
                this.handle_type = type;
                if($("#onclickdate").prop('checked') == false){
                    this.handle_type = 'multiple_days';
                }
            },
            saveAvai: function() {
                var _this = this;
                if(this.handle_type=='specific_date' && date_picker_date==null){
                    Swal.fire('Error!','Please Select Date', 'error');
                    return false;
                }else if(this.handle_type=='multiple_days' && _this.days.length==0){
                    Swal.fire('Error!','Please Select Days', 'error');
                    return false;
                }
                var date_picker_new=date=moment(date_picker_date).format('Y/M/D');
                Swal.fire({
                    title: 'Confirm!',
                    text: 'Do you want to set Availability for ' + _this.handle_type,
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes!',
                }).then((result) => {
                    if (result.value) {
                        _this.submit_btn_text = 'Saving...';
                        $.ajax({
                            type: "post",
                            url: base_url + '/service_provider/manage_availibilty',
                            data: {
                                'timzone': timZone,
                                "handle_type": _this.handle_type,
                                "date": _this.selected_date_model,
                                "interval": _this.intervals,
                                "days": _this.days,
                                "date_picker_date":date_picker_new,
                                
                            },
                            dataType: "json",
                            success: function(response) {
                                _this.submit_btn_text = 'Next';
                                Swal.fire('Success!', 'Availability Saved', 'success').then((result) => {
                                    location.reload();
                                });
                            },
                            error: function(jqXHR) {
                                _this.submit_btn_text = 'Next';
                                var response = $.parseJSON(jqXHR.responseText);
                                if (response.message) {
                                    Swal.fire('Error!', response.message, 'error');
                                }
                            }
                        });
                    }
                });
            },
            deleteInterval: function(index) {
                this.intervals.splice(index, 1);
            },
            newInterval: function() {
                this.intervals.push({
                    seleted_start: "00:00",
                    seleted_end: "01:00",
                    start_times: this.start_times,
                    end_times: this.end_times
                });
            },
        },
        mounted() {}
    });
</script>
<script>
    function openCity(evt, cityName) {

        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.className += " active";
        if(cityName=='edit_profile'){
            $("#OpenImgUpload").css('cursor','pointer');
        }else{
            $("#OpenImgUpload").css('cursor','auto');
        }
    }

    // Get the element with id="defaultOpen" and click on it
    document.getElementById("defaultOpen").click();


   
</script>
<script>
    var slider = $(".day-slider3");
    var scrollCount = null;
    var scroll= null;
    slider.slick({
          dots: false,
          infinite: true,
          speed: 500,
          slidesToShow: 7,
          slidesToScroll: 1,
          responsive: [
            {
              breakpoint: 990,
              settings: {
                slidesToShow: 7,
                slidesToScroll: 1
              }
            },
            {
              breakpoint: 480,
              settings: {
                slidesToShow: 1,
                slidesToScroll: 1
              }
            }
          ]
        });
    slider.on('wheel', (function(e) {
        e.preventDefault();
        clearTimeout(scroll);
        scroll = setTimeout(function(){scrollCount=0;}, 200);
        if(scrollCount) return 0;
        scrollCount=1;
        if (e.originalEvent.deltaY < 0) {
            $(this).slick('slickNext');
            console.log('this',$(this));
        } else {
            console.log('this',$(this));
            $(this).slick('slickPrev');
        }
    }));
slider.on('afterChange', function() {
    var dataId = $('.slick-current').attr("data-slick-index");
    $('.slick-current').trigger('click');    
});
</script> 
@endsection