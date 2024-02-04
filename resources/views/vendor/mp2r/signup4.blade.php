@extends('vendor.mp2r.layouts.index', ['title' => 'Manage Availability','sign_page'=>True,'completed'=>'50%'])
@section('css')
@endsection
@section('content')
<style type="text/css">
    .box_enable{
        box-shadow: inset 0 2px 0 0 #39C6C0, 0 1px 6px 0 rgba(0,0,0,0.11) !important;
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
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<div class="progress">
  <div class="progress-bar" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
</div>
<section class="right-pos" id="manage_avail">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-lg-4 pl-0 pos-static">
                <div class="right-pull">
                <img src="{{ asset('assets/mp2r/images/sign-left.png') }}" class="img-fluid w-100">
                    <div class="join-expert">
                        <div class="join-expt">
                        <h1 class="join-text" >Join the best Experts</h1>
                        <p  class="join-pera">Millions of people are looking for the right expert on My Path 2 recovery. Start your digital journey with Expert Profile</p>
                        </div>
                    </div>
                </div>
            </div>

            <div id="manage_availability" class="col-lg-8 col-md-8 col-sm-8 tabcontent">
                <section class="wrapper2 form-sec">
                    <p class="change-pw">Manage Availability</p>
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
            <section class="day-slider-signup ml-4" id="dateList">
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


            <!-- <div id="manage_availability" class="col-md-8 col-lg-8 main-height">
                <section class="wrapper2 form-sec">
                    <p class="change-pw">Manage Availability</p>
                    <div class="slider-sec">
                        @if (session('message'))

                        <div class="alert alert-success" role="alert">
                            {{ session('message') }}
                        </div>
                        @endif
                        <p class="select-date">Select Date</p>
                        <section class="day-slider ml-4" id="dateList">
                            <div v-for="date in dates" class='slider-days text-center' @click='selectedData(date)'>
                                <P class='today'>@{{ date . day_text }}</P>
                                <P class='date'>@{{ date . date }}</P>
                            </div>
                        </section>
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
                    <section class="radios">
                        <form id="submit_availiblity">
                            <ul class="nav">
                                <li class="radio-cover">
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" id="Weekdays" name="handle_type" value="all_weekdays" @input="clickHadleType('all_weekdays')"><label class="form-check-label pb-0" for="Weekdays">All Weekdays</label>
                                    </div>
                                </li>
                                <li class="radio-cover">
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" id="For" name="handle_type" value="date" @input="clickHadleType('date')" checked> <label class="form-check-label pb-0" for="For">For
                                            @{{ selected_date_model . date }}</label>
                                    </div>
                                </li>
                                <li class="radio-cover">
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" id="All" name="handle_type" value="all_selected_day" @input="clickHadleType('all_selected_day')"> <label class="form-check-label pb-0" for="All">All
                                            @{{ selected_date_model . day }}</label>
                                    </div>
                                </li>
                            </ul>
                        </form>
                    </section>
                    <div class="container">
        
                        <div class="row">
                        <div class="col-md-12">
                            <div class="row align-items-center">
                                <div class="col-md-6 col-sm-6 col-lg-6">
                                    <a href="#" class="back-btn"><img src="{{ asset('assets/mp2r/images/ic_back.png') }}">Back</a>
                                    <button id="btn_text" type="button" class="btn-next" @click="saveAvai()">@{{ submit_btn_text }}</button>
                                </div>
                                <div class="col-md-6 col-sm-6 col-lg-6">
                                <span class="already-acc">Already have an account? <a href="{{ url('/') }}" class="login-link">Login</a></span>
                                </div>
                            </div>
                        </div>
                        </div>
                        </div>
                    <!-- <div class="row m-0 ">
                        <button type="button" id="submit_btn_id" class="btn-next mt-3" @click="saveAvai()">
                            @{{ submit_btn_text }}</button>
                    </div> -->
                </section>
            </div>  -->         
        </div>
    </div>

   <!--  <section class="footer flex-end ">
        <div class="container">
        
        <div class="row">
        <div class="col-md-12">
            <div class="row align-items-center">
                <div class="col-md-6 col-sm-6 col-lg-6">
                    <a href="#" class="back-btn"><img src="{{ asset('assets/mp2r/images/ic_back.png') }}">Back</a>
                    <button id="btn_text" type="button" class="btn-next" @click="saveAvai()">@{{ submit_btn_text }}</button>
                </div>
                <div class="col-md-6 col-sm-6 col-lg-6">
                <span class="already-acc">Already have an account? <a href="#" class="login-link">Login</a></span>
                </div>
            </div>
        </div>
        </div>
        </div>
    </section>   -->
</section>
@endsection
@section('script')
<script>
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
                $('.day-slider-signup').css('display','block');
                $("#submit_btn_id").text('Save');
            }else{
                $("#daterangepicker").trigger('click');
                if(date_picker_date!==null){
                    var today_date23 = moment(date_picker_date).format('MMM D,YY');
                    $('.day-slider-signup').css('display','none');
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
        $('.day-slider-signup').css('display','none');
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
    for (let i = 0; i<daysRequired; i++) {
        var d = moment().add(i, 'days');
        var same = moment(today_date).isSame(d.format('Y/M/D'));
        var day_name = weekday[d.day()];
        if (same) {
            selected_date_model = {
                'day_text': 'Today',
                'day': day_name,
                "date": moment(d).format('MMM D,YY'),
                'day_count': moment(d).day(),
                "full_date": moment(d).format('Y/M/D')
            };
            days.push(selected_date_model);
            dates.push({
                'day_text': 'Today',
                'day': day_name,
                "date": moment(d).format('MMM D,YY'),
                'day_count': moment(d).day(),
                "full_date": moment(d).format('Y/M/D')
            });
        } else {
            dates.push({
                'day_text': day_name,
                'day': day_name,
                "date": moment(d).format('MMM D,YY'),
                'day_count': moment(d).day(),
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
                                "sign_up":true,
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
<script type="text/javascript">
    var slider = $(".day-slider-signup");
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