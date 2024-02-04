@extends('vendor.mp2r.layouts.index', ['title' => 'Doctor Detail','header_after_login'=>true])
@section('css')
    
@endsection
@section('content')
<style>
   .tablinks{
      cursor: pointer;
   }

   .time-link.actives {
    border: 1px solid #48D3B3;
    border-radius: 60px;
    color: white !important;
    font-size: 14px;
   
    background-color: #48D3B3;
    }

    .slick-current{
        width: 70px !important;

    }


   </style>
	
	<section class="main-height-clr ">
        
		<div class="container">
			<div class="row">
			<!-- breadcrum -->
				<section class="bread-sec">
					<nav aria-label="breadcrumb">
					  <ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="#">Home </a></li>
						<li class="breadcrumb-item"><a href="#">{{ $Get_Category->name }}</a></li>
						<li class="breadcrumb-item"><a href="#">Doctor Details </a></li>
						<!-- <li class="breadcrumb-item active" aria-current="page"> Doctor Details</li> -->
					  </ol>
					</nav>
				</section>
            </div>
			<!-- breadcrum -->
            <div class="row">
				<div class="col-lg-8 col-md-8 col-sm-8">
                    @if(session('message'))
                       <div class="alert alert-success" role="alert">
                             {{session('message')}}
                       </div>
                    @endif
					<section class="right-side ">
						<div class="wrapper3 mb-3">
							<div class="row m-0 align-items-center wrap-height pt-0">
								<div class="col-md-3"><img  style="border-radius: 50%;width: 100px;height: 100px;" src="{{ $Sp_Detail->profile_image?Storage::disk('spaces')->url('uploads/'.$Sp_Detail->profile_image):asset('assets/mp2r/images/ic_prof-medium@2x.png') }}" class="img-fluid"></div>
								<div class="col-md-9 pl-0">
                                    
									<h5 class="first-name">{{ $Sp_Detail->name }}</h5>
									
                                        <p class="second-name pt-2 pb-1">{{ $Sp_Detail->categoryData->name}}</p>
                                        
									<img src="{{ asset('assets/images/ic_Star.png') }}"> <span class="rating2">{{ $Sp_Detail->totalRating }} · {{ $Sp_Detail->reviewCount }} Reviews</span>
								</div>
							</div>
							
							<div class="wrap-height">
							 <h4 class="spacial ">Qualification</h4>
                                @foreach( $Sp_Detail->custom_fields as $Education)
                                    @if($Education->id == 5)
    							     <p class="second-name pt-2 pb-1">{{ $Education->field_value }}</p>
                                     @endif
                                @endforeach
							</div>
							
<!-- 							<div class="wrap-height">
							 <h4 class="spacial ">Medications offered</h4>
							 <p class="second-name pt-2 pb-1">{{ $Sp_Detail->categoryData->name}}</p>
							</div> -->
							
							<div class="wrap-height">
							 <h4 class="spacial ">About</h4>
							 <p class="second-name pt-2 pb-1">{{ $Sp_Detail->about }} </p>
							</div>
							
							<div class="wrap-height2">
							 <h4 class="spacial ">Reviews</h4>
							 
							 
							 <div class="row align-items-center m-0 wrap-height border-0 pt-3">
                                @foreach($feedback as $feedback_info)
								<div class="col-md-12 col-lg-12 ">
									<div class="row m-0 ">
										<!-- <div class="col-md-2 col-lg-1 pl-0"><img src="{{ $feedback_info->user->profile_image?Storage::disk('spaces')->url('uploads/'.$feedback_info->user->profile_image):asset('assets/mp2r/images/ic_prof-medium@2x.png') }}" class="img-fluid pb-2 "></div> -->
											<div class="col-md-12 col-lg-11 p-0">
											<p class="first-name">{{ $feedback_info->user->name }}</p>
											<img src="{{ asset('assets/images/ic_Star.png') }}"> <span class="rating">{{ $feedback_info->rating }}</span>
											<p class="second-name pt-2">{{ $feedback_info->comment }}</p>
											</div>
									</div>
								</div>	
                                @endforeach
							  </div>
							  							 
							 
                             {{ $feedback->links() }}
							 </div>
						</div>
					</section>
					
					
				</div>
				
				<!-- left side  -->
				<div class="col-md-4 col-lg-4 col-sm-4" id="timeslots_avail">
					<div class="right-schdule mt-3">
					<!-- <button type="submit" class="btn-consult mt-0">Connect Now</button> -->
                    <form id="formScheduleBooking" method="post" >
                        @csrf
                        <input id="from_user" name="from_user" type="hidden" value="{{ request()->route('user_id') }}">
                        <input id="category_id_index" name="cat_id" type="hidden" value="{{ request()->route('id') }}">
                        <button type="submit" class="btn-consult confirm mt-2 mb-3">Connect Now</button>
                    </form>
					<div class="wrapper3 p-0 mb-3">
					<div style="cursor: pointer"  data-toggle="collapse" data-target="#collapseExample" aria-expanded="false">
						<div class="p-3">
						<span class="first-name ">Schedule Booking </span>
						<img src="{{ asset('assets/images/ic_dd-header.png') }}" class="js-rotate-if-collapsed pull-right pt-2">
						</div>
					</div>
                    <!-- <form id="formScheduleBooking" method="post"> -->
                        <input type="hidden" id="user_idforbooking" value="{{ request()->route('user_id')}}">
						<!-- <div id="collapseExample" class="collapse"> -->
							<section class="day-slider ml-4" id="dateList">
                            <div style="width: 53px !important" data-userid="{{ request()->route('user_id') }}" data-catid="{{ $Get_Category->id }}" id="selectdatefrom" v-for="date in dates" class='slider-days text-center' @click='selectedData(date)'>
                               <!--  <P class='today'>@{{ date . day_text }}</P> -->
                                <P class='date'>@{{ date . date }}</P>
                            </div>
                        	</section>									
						<!-- </div> -->
					<hr class="mt-1 mb-1">


					
					<section class="morning p-3">
						<div style="cursor: pointer"  data-toggle="collapse" data-target="#collapse2" aria-expanded="false">
						<div class="">
						<span class="first-name "><img src="{{ asset('assets/images/ic_morning.png') }}" class="pr-2"> Morning </span>
						<img src="{{ asset('assets/images/ic_dd-header.png') }}" class="js-rotate-if-collapsed pull-right pt-2">
						</div>
					</div>
						<div id="collapse2" class="collapse pt-2">
						<ul class="nav">
						<!-- <li class="time-link"> <a href="#">07:24 am</a></li>
						<li class="time-link"> <a href="#">07:39 am</a></li>
						<li class="time-link"> <a href="#">07:54 am</a></li>
						<li class="time-link"> <a href="#">08:09 am</a></li>
						<li class="time-link"> <a href="#">08:24 am</a></li>
						<li class="time-link"> <a href="#">08:39 am</a></li> -->
						</ul>
						</div>
					
					</section>
					<hr class="mt-1 mb-1">
					
					
					<section class="morning p-3">
						<div style="cursor: pointer"  data-toggle="collapse" data-target="#collapse3" aria-expanded="false">
						<div class="">
						<span class="first-name "><img src="{{ asset('assets/images/ic_afternoon.png') }}" class="pr-2"> Afternoon </span>
						<img src="{{ asset('assets/images/ic_dd-header.png') }}" class="js-rotate-if-collapsed pull-right pt-2">
						</div>
					</div>
						<div id="collapse3" class="collapse pt-2">
						<ul class="nav">
						<!-- <li class="time-link"> <a href="#">12:00 pm</a></li>
						<li class="time-link"> <a href="#">12:20 pm</a></li>
						<li class="time-link"> <a href="#">12:40 pm</a></li>
						<li class="time-link"> <a href="#">12:53 pm</a></li>
						<li class="time-link"> <a href="#">01:24 pm</a></li>
						<li class="time-link"> <a href="#">02:00 pm</a></li> -->
						</ul>
						</div>
					
					</section>
					<hr class="mt-1 mb-1">
					
					
					<section class="morning p-3">
						<div style="cursor: pointer"  data-toggle="collapse" data-target="#collapse4" aria-expanded="false">
						<div class="">
						<span class="first-name "><img src="{{ asset('assets/images/ic_evening.png') }}" class="pr-2"> Evening </span>
						<img src="{{ asset('assets/images/ic_dd-header.png') }}" class="js-rotate-if-collapsed pull-right pt-2">
						</div>
					</div>
						<div id="collapse4" class="collapse pt-2">
						<ul class="nav">
						<!-- <li class="time-link"> <a href="#">04:00 pm</a></li>
						<li class="time-link"> <a href="#">04:23 pm</a></li>
						<li class="time-link"> <a href="#">05:00 pm</a></li>
						<li class="time-link"> <a href="#">05:17 pm</a></li>
						<li class="time-link"> <a href="#">05:43 pm</a></li>
						<li class="time-link"> <a href="#">06:10 pm</a></li> -->
						</ul>
						</div>
					
					</section>
					
					
					<hr class="mt-1 mb-1">
					
					<section class="time-schdule p-3">
						
						
						<button @click="saveAvai()" type="button" class="btn-consult confirm mt-0">Confirm</button>
					  
					</section>
					<!-- </form> -->
					
					</div>						
					</div>
				</div>
				
			<!-- left side  end -->	
				
				
				
				
			</div>
		</div>
		
	</section>

         @endsection
         @section('script')
<script>
    $(document).ready(function() {});

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
        "date": moment(day).format('MMM D,YY'),
        "full_date": moment(day).format('Y/M/D')
    };
    var current_date = new Date();
    var last_date = new Date(addMonths(new Date(), 1).toString());
    var dates = [];
    var weekday = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
    for (var day = current_date; day <= last_date; day.setDate(day.getDate() + 1)) {
        var same = moment(today_date).isSame(moment(day).format('Y/M/D'));
        var day_name = weekday[day.getDay()];
        if (same) {
            selected_date_model = {
                'day_text': 'Today',
                'day': day_name,
                "date": moment(day).format('MMM D,YY'),
                "full_date": moment(day).format('Y/M/D')
            };
            dates.push({
                'day_text': 'Today',
                'day': day_name,
                "date": moment(day).format('MMM D,YY'),
                "full_date": moment(day).format('Y/M/D')
            });
        } else {
            dates.push({
                'day_text': day_name,
                'day': day_name,
                "date": moment(day).format('MMM D,YY'),
                "full_date": moment(day).format('Y/M/D')
            });
        }
    }
    new Vue({
        el: '#timeslots_avail',
        data: {
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
            handle_type: 'date',
            submit_btn_text: 'Next',
        },
        methods: {
            selectedData: function(data) {
                this.selected_date_model = data;
            },
            clickHadleType: function(type) {
                this.handle_type = type;
            },
            saveAvai: function() {
                var _this = this;
                var Gettime=$(".actives").find('a').text();
                Swal.fire({
                    title: 'Confirm!',
                    text: 'Please confirm your schedule  request for ' +  _this.selected_date_model.date+' ' +Gettime,
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes!',
                }).then((result) => {
                    if (result.value) {
                         var time=$(".actives").find('a').text();
                         var from_user=$("#user_idforbooking").val();
                         
                        _this.submit_btn_text = 'Saving...';
                        $.ajax({
                            type: "post",
                            url: base_url + '/user/SpScheduleBooking',
                            data: {
                                'timzone': timZone,
                                "dates":  _this.selected_date_model,
                                "time" : time,
                                "from_user" : from_user,
                                
                            },
                            
                            success: function(response) {
                                
                              
                                Swal.fire('Success!', 'Your Schedule request has been sent Successfully', 'success').then((result) => {
                                    location.reload();
                                });
                            },
                            error: function(jqXHR) {
                                _this.submit_btn_text = 'Next';
                                var response = $.parseJSON(jqXHR.responseText);
                                if (response.errors) {
                                    
                                    Swal.fire('Error!', response.errors.time[0], 'error');
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

    $(document).on('click','.slider-days',function(){
       
        $(".slider-days").removeClass('slick-current');

        $(this).addClass('slick-current');



        var date=$(this).find('p').text();

        var category_id=$(this).attr('data-catid');

        var userid=$(this).attr('data-userid');

            $.ajax({
                type: "post",
                url: base_url + '/user/getSlotsByMultipleDates',
                data: {
                    'dates': date,
                    "category_id": category_id,
                    "doctor_id": userid,
                    "service_id": 1, 
                },
                dataType: "json",
                success: function(response) {

                    var pm="";
                    
                    var am="";

                    var noon="";
                    
                    $.each(response.data.interval, function (key, val) {
                       
                        
                        var gettime=(val.time.substr(5));
                        
                        var time=gettime.replace(/\s/g, '');

                        if(time == 'pm'){

                             if(val.time >= '12:00 pm' && val.time <= '13:00 pm'){

                                noon += "<li class='time-link'><a style='cursor:pointer'>"+val.time+"</a></li>";
                            }

                            else if(val.time >= '04:00 pm'){
                                pm += "<li class='time-link'><a style='cursor:pointer'>"+val.time+"</a></li>";
                            }else if(val.time <= '04:00 pm')
                            {
                                noon += "<li class='time-link'><a style='cursor:pointer'>"+val.time+"</a></li>";
                            }
                            
                            
                        }else if(time == 'am')
                        {
                            am += "<li class='time-link'><a style='cursor:pointer'>"+val.time+"</a></li>";
                        }
                        
                       
                    });
                    
                    
                    $("#collapse4").find('ul').html(pm);
                    $("#collapse3").find('ul').html(noon);
                    $("#collapse2").find('ul').html(am);
                    
                    
                    
                },
                error: function(jqXHR) {
                    
                },

            });
        });

    $(document).on('click','.time-link',function(){

        $(".time-link").removeClass("actives");

        $(".time-link").find('a').css("color","black");

        $(this).addClass("actives");

        $(this).find('a').css("color","white");
    });


     $(document).on('submit','#formScheduleBooking',function(e){

            e.preventDefault();
                var now = moment().format("dddd, MMMM Do, YYYY, h:mm:ss A");
                Swal.fire({
                    title: 'Confirm Booking!',
                    text: 'Do You Want To Confirm Connect Now request on '+now,
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes!',
                }).then((result) => {
                    if (result.value) {
                       
                        var from_user=$("#from_user").val();

                        var cat_id=$("#category_id_index").val();

                       

                        $.ajax({
                            type: "post",
                            url: base_url + '/request_connect_now',
                            data: {
                                
                                "from_user": from_user,
                                "cat_id":cat_id,
                                
                            },
                            
                            success: function(response) {
                                
                                
                                Swal.fire('Success!', 'Connect Now request has been sent now', 'success').then((result) => {
                                    location.reload();
                                });
                            },
                            error: function(response) {

                                alert('error');
                            }
                        });
                    }
                });
            });


</script>

@endsection