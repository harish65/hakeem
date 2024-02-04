@extends('vendor.mp2r.layouts.index',['title' => 'Manage Availability','header_after_login'=>true])
@section('content')
<style>
.today{
  font-size:11px;
}
  </style>
	<section class="main-height-clr " id="manage_avail1">
		<div class="container">
			<div class="row">
													
			<!-- breadcrum -->
				<section class="bread-sec">
					<nav aria-label="breadcrumb">
					  <ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="#">Home </a></li>
						<li class="breadcrumb-item"><a href="#">Consult M.A.T Providers </a></li>
						<li class="breadcrumb-item"><a href="#">Doctor Details </a></li>
						<!-- <li class="breadcrumb-item active" aria-current="page"> Doctor Details</li> -->
					  </ol>
					</nav>
				</section>
			<!-- breadcrum -->
				<div class="col-lg-8 col-md-8 col-sm-8">
          <!-- //asset('assets/mp2r/images/ic_prof-large.png') -->
					<section class="right-side ">
						<div class="wrapper3 mb-3">
							<div class="row m-0 align-items-center wrap-height pt-0">
								<div class="col-md-3"><img src="{{ isset($doctor->profile_image) ?  Storage::disk('spaces')->url('uploads/'.$doctor->profile_image) : asset('assets/mp2r/images/ic_prof-large.png')}}" class="img-fluid"></div>
								<div class="col-md-9 pl-0">
									<h5 class="first-name">{{$doctor->name}} </h5>
									<p class="second-name pt-2 pb-1">{{isset($doctor->profile->qualification) ? $doctor->profile->qualification : 'N/A'}} </p>
									<img src="{{ asset('assets/mp2r/images/ic_Star.png')}}"> <span class="rating2">4.8 · {{$reviewCount}} Reviews</span>
								</div>
							</div>
							
							<div class="wrap-height">
							 <h4 class="spacial ">Specialities</h4>
							 <p class="second-name pt-2 pb-1">{{isset($doctor->profile->speciality) ? $doctor->profile->speciality : 'N/A'}}</p>
							</div>
							
							<div class="wrap-height">
							 <h4 class="spacial ">Medications offered</h4>
							 <p class="second-name pt-2 pb-1">Synthroid (Levothyroxine), Crestor (Rosuvastatin), Ventolin HFA (Albuterol) </p>
							</div>
							
							<div class="wrap-height">
							 <h4 class="spacial ">About</h4>
							 <p class="second-name pt-2 pb-1">{{isset($doctor->profile->about) ? $doctor->profile->about : 'N/A'}}</p>
							</div>
							
							<div class="wrap-height2">
							 <h4 class="spacial ">Reviews</h4>
							 
							 @foreach($reviews as $review)
							 <div class="row align-items-center m-0 wrap-height border-0 pt-3">
								<div class="col-md-12 col-lg-12 ">
									<div class="row m-0 ">
										<div class="col-md-2 col-lg-1 pl-0"><img src="{{ Storage::disk('spaces')->url('uploads/'.$review->user->profile_image) }}" class="img-fluid pb-2 "></div>
											<div class="col-md-10 col-lg-11 p-0">
											<p class="first-name">{{$review->user->name}}</p>
											<img src="{{ asset('assets/mp2r/images/ic_Star.png')}}"> <span class="rating">{{$review->rating}}</span>
											<p class="second-name pt-2">{{$review->comment}}</p>
											</div>
									</div>
								</div>	
                              </div>
                              @endforeach
							  
							
							  
							 							 
							 <!-- <a href="#" class="more-review"> View more reviews</a> -->
							 </div>
						</div>
					</section>
					
					
				</div>
				
				<!-- left side  -->
				<div class="col-md-4 col-lg-4 col-sm-4">
					<div class="right-schdule mt-3">
					<button type="submit" class="btn-consult mt-0">Consult Now</button>
					<div class="wrapper3 p-0 mb-3">
					<div style="cursor: pointer"  data-toggle="collapse" data-target="#collapseExample" aria-expanded="false">
						<div class="p-3">
						<span class="first-name ">Schedule Booking </span>
						<img src="{{ asset('assets/mp2r/images/ic_dd-header.png')}}" class="js-rotate-if-collapsed pull-right pt-2">
						</div>
					</div>
						<div id="collapseExample" class="collapse">
						<section class="day-slider1 ml-4" id="dateList">
                     <div v-for="date in dates" class='slider-days text-center' @click='selectedData(date)'><P class='today'>@{{ date.day_text }}</P><P class='date'>@{{ date.date }}</P></div>
                  </section>								
						</div>
					<hr class="mt-1 mb-1">


					
					<section class="morning p-3">
						<div style="cursor: pointer"  data-toggle="collapse" data-target="#collapse2" aria-expanded="false">
						<div class="">
						<span class="first-name "><img src="{{ asset('assets/mp2r/images/ic_morning.png')}}" class="pr-2"> Morning </span>
						<img src="{{ asset('assets/mp2r/images/ic_dd-header.png')}}" class="js-rotate-if-collapsed pull-right pt-2">
						</div>
					</div>
						<div id="collapse2" class="collapse pt-2">
						<ul class="nav">
						<li class="time-link"> <a href="#">9:00 am</a></li>
						<li class="time-link"> <a href="#">9:00 am</a></li>
						<li class="time-link  active"> <a href="#">9:00 am</a></li>
						<li class="time-link"> <a href="#">9:00 am</a></li>
						<li class="time-link"> <a href="#">9:00 am</a></li>
						<li class="time-link"> <a href="#">9:00 am</a></li>
						</ul>
						</div>
					
					</section>
					<hr class="mt-1 mb-1">
					
					
					<section class="morning p-3">
						<div style="cursor: pointer"  data-toggle="collapse" data-target="#collapse3" aria-expanded="false">
						<div class="">
						<span class="first-name "><img src="{{ asset('assets/mp2r/images/ic_afternoon.png')}}" class="pr-2"> Afternoon </span>
						<img src="{{ asset('assets/mp2r/images/ic_dd-header.png')}}" class="js-rotate-if-collapsed pull-right pt-2">
						</div>
					</div>
						<div id="collapse3" class="collapse pt-2">
						<ul class="nav">
						<li class="time-link"> <a href="#">9:00 am</a></li>
						<li class="time-link"> <a href="#">9:00 am</a></li>
						<li class="time-link"> <a href="#">9:00 am</a></li>
						<li class="time-link active"> <a href="#">9:00 am</a></li>
						<li class="time-link"> <a href="#">9:00 am</a></li>
						<li class="time-link"> <a href="#">9:00 am</a></li>
						</ul>
						</div>
					
					</section>
					<hr class="mt-1 mb-1">
					
					
					<section class="morning p-3">
						<div style="cursor: pointer"  data-toggle="collapse" data-target="#collapse4" aria-expanded="false">
						<div class="">
						<span class="first-name "><img src="{{ asset('assets/mp2r/images/ic_evening.png')}}" class="pr-2"> Evening </span>
						<img src="{{ asset('assets/mp2r/images/ic_dd-header.png')}}" class="js-rotate-if-collapsed pull-right pt-2">
						</div>
					</div>
						<div id="collapse4" class="collapse pt-2">
						<ul class="nav">
						<li class="time-link"> <a href="#">9:00 am</a></li>
						<li class="time-link"> <a href="#">9:00 am</a></li>
						<li class="time-link"> <a href="#">9:00 am</a></li>
						<li class="time-link active"> <a href="#">9:00 am</a></li>
						<li class="time-link"> <a href="#">9:00 am</a></li>
						<li class="time-link"> <a href="#">9:00 am</a></li>
						</ul>
						</div>
					
					</section>
					<hr class="mt-1 mb-1">
					
					<section class="time-schdule p-3">
						<form action="/action_page.php">
						<div class="form-group">
						  <label for="email">Email</label>
						  <input type="email" class="form-control " id="email" placeholder="{{$doctor->email}}" name="email">
						</div>
						<div class="form-group">
						  <label for="pwd">Phone Number</label>
						  <input type="phone" class="form-control" id="pwd" placeholder="{{$doctor->phone}}" name="pswd">
						</div>
						
						<p class="booking-text">By Booking this appointment, you agree to the terms & conditions</p>
						
						<button type="submit" class="btn-consult confirm mt-0">Confirm</button>
					  </form>
					</section>
					
					
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


function addMonths(date, months) {
       var d = date.getDate();
       date.setMonth(date.getMonth() + +months);
       if (date.getDate() != d) {
         date.setDate(0);
       }
       return date;
}
var today_date = moment().format('Y/M/D');
var selected_date_model = {'day_text':'','day':'',"date":moment(day).format('MMM D,YY'),"full_date":moment(day).format('Y/M/D')};
var current_date =  new Date();
var last_date = new Date(addMonths(new Date(),3).toString());
var dates = [];
var weekday = ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"]; 
for (var day = current_date; day <= last_date; day.setDate(day.getDate() + 1)) {
      var same = moment(today_date).isSame(moment(day).format('Y/M/D'));
      var day_name = weekday[day.getDay()];
      if(same){
         selected_date_model = {'day_text':'Today','day':day_name,"date":moment(day).format('MMM D,YY'),"full_date":moment(day).format('Y/M/D')};
         dates.push({'day_text':'Today','day':day_name,"date":moment(day).format('MMM D,YY')});
      }else{
         dates.push({'day_text':day_name,'day':day_name,"date":moment(day).format('MMM D,YY')});
      }
}
new Vue({
  el: '#manage_avail1',
  data: {  
    dates:dates,
    start_times:[
    {"key":"00:00","value":"00:00 am"},
    {"key":"01:00","value":"01:00 am"},
    {"key":"02:00","value":"02:00 am"},
    {"key":"03:00","value":"03:00 am"},
    {"key":"04:00","value":"04:00 am"},
    {"key":"05:00","value":"05:00 am"},
    {"key":"06:00","value":"06:00 am"},
    {"key":"07:00","value":"07:00 am"},
    {"key":"08:00","value":"08:00 am"},
    {"key":"09:00","value":"09:00 am"},
    {"key":"10:00","value":"10:00 am"},
    {"key":"11:00","value":"11:00 am"},
    {"key":"12:00","value":"12:00 pm"},
    {"key":"14:00","value":"13:00 pm"},
    {"key":"01:00","value":"14:00 pm"},
    {"key":"15:00","value":"15:00 pm"},
    {"key":"16:00","value":"16:00 pm"},
    {"key":"17:00","value":"17:00 pm"},
    {"key":"18:00","value":"18:00 pm"},
    {"key":"19:00","value":"19:00 pm"},
    {"key":"20:00","value":"20:00 pm"},
    {"key":"21:00","value":"21:00 pm"},
    {"key":"22:00","value":"22:00 pm"},
    {"key":"23:00","value":"23:00 pm"}],
    end_times:[
    {"key":"01:00","value":"01:00 am"},
    {"key":"02:00","value":"02:00 am"},
    {"key":"03:00","value":"03:00 am"},
    {"key":"04:00","value":"04:00 am"},
    {"key":"05:00","value":"05:00 am"},
    {"key":"06:00","value":"06:00 am"},
    {"key":"07:00","value":"07:00 am"},
    {"key":"08:00","value":"08:00 am"},
    {"key":"09:00","value":"09:00 am"},
    {"key":"10:00","value":"10:00 am"},
    {"key":"11:00","value":"11:00 am"},
    {"key":"12:00","value":"12:00 pm"},
    {"key":"14:00","value":"13:00 pm"},
    {"key":"01:00","value":"14:00 pm"},
    {"key":"15:00","value":"15:00 pm"},
    {"key":"16:00","value":"16:00 pm"},
    {"key":"17:00","value":"17:00 pm"},
    {"key":"18:00","value":"18:00 pm"},
    {"key":"19:00","value":"19:00 pm"},
    {"key":"20:00","value":"20:00 pm"},
    {"key":"21:00","value":"21:00 pm"},
    {"key":"22:00","value":"22:00 pm"},
    {"key":"23:00","value":"23:00 pm"}],
    intervals:[{seleted_start:"00:00",seleted_end:"01:00",start_times:[
    {"key":"00:00","value":"00:00 am"},
    {"key":"01:00","value":"01:00 am"},
    {"key":"02:00","value":"02:00 am"},
    {"key":"03:00","value":"03:00 am"},
    {"key":"04:00","value":"04:00 am"},
    {"key":"05:00","value":"05:00 am"},
    {"key":"06:00","value":"06:00 am"},
    {"key":"07:00","value":"07:00 am"},
    {"key":"08:00","value":"08:00 am"},
    {"key":"09:00","value":"09:00 am"},
    {"key":"10:00","value":"10:00 am"},
    {"key":"11:00","value":"11:00 am"},
    {"key":"12:00","value":"12:00 pm"},
    {"key":"14:00","value":"13:00 pm"},
    {"key":"01:00","value":"14:00 pm"},
    {"key":"15:00","value":"15:00 pm"},
    {"key":"16:00","value":"16:00 pm"},
    {"key":"17:00","value":"17:00 pm"},
    {"key":"18:00","value":"18:00 pm"},
    {"key":"19:00","value":"19:00 pm"},
    {"key":"20:00","value":"20:00 pm"},
    {"key":"21:00","value":"21:00 pm"},
    {"key":"22:00","value":"22:00 pm"},
    {"key":"23:00","value":"23:00 pm"}],
    end_times:[
    {"key":"01:00","value":"01:00 am"},
    {"key":"02:00","value":"02:00 am"},
    {"key":"03:00","value":"03:00 am"},
    {"key":"04:00","value":"04:00 am"},
    {"key":"05:00","value":"05:00 am"},
    {"key":"06:00","value":"06:00 am"},
    {"key":"07:00","value":"07:00 am"},
    {"key":"08:00","value":"08:00 am"},
    {"key":"09:00","value":"09:00 am"},
    {"key":"10:00","value":"10:00 am"},
    {"key":"11:00","value":"11:00 am"},
    {"key":"12:00","value":"12:00 pm"},
    {"key":"14:00","value":"13:00 pm"},
    {"key":"01:00","value":"14:00 pm"},
    {"key":"15:00","value":"15:00 pm"},
    {"key":"16:00","value":"16:00 pm"},
    {"key":"17:00","value":"17:00 pm"},
    {"key":"18:00","value":"18:00 pm"},
    {"key":"19:00","value":"19:00 pm"},
    {"key":"20:00","value":"20:00 pm"},
    {"key":"21:00","value":"21:00 pm"},
    {"key":"22:00","value":"22:00 pm"},
    {"key":"23:00","value":"23:00 pm"}]}],
    start_intervals:"00:00",
    end_intervals:"01:00",
    class_number:1,
    selected_int_list:[],
    delete_img:base_url+"/assets/mp2r/images/delet.png",     
    selected_date_model:selected_date_model,
    submit:false,
    handle_type:'date',
    submit_btn_text:'Save',
  },
   methods: {
    selectedData: function (data) {
      this.selected_date_model = data;
    },
    clickHadleType:function(type){
      this.handle_type = type;
    },
    saveAvai:function(){
      var _this = this;
      Swal.fire({
        title: 'Confirm!',
        text:'Do you want to set Availability for '+_this.handle_type,
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes!',
      }).then((result)=>{
           if (result.value) {
              _this.submit_btn_text = 'Saving...';
              $.ajax({
                  type: "post",
                  url: base_url+'/service_provider/manage_availibilty',
                  data:{'timzone':timZone,"date":_this.selected_date_model,"interval":_this.intervals,"handle_type":_this.handle_type},
                  dataType: "json",
                  success: function (response) {
                      _this.submit_btn_text = 'Save';
                      Swal.fire('Success!','Availability Saved','success');
                  },
                  error: function (jqXHR) {
                    _this.submit_btn_text = 'Save';
                    var response = $.parseJSON(jqXHR.responseText);
                    if(response.message){
                        Swal.fire('Error!',response.message,'error');
                    }
                  }
              });
            }
      });
    },
    deleteInterval:function(index){
      this.intervals.splice(index,1);
    },
    newInterval:function(){
      this.intervals.push({seleted_start:"00:00",seleted_end:"01:00",start_times:this.start_times,end_times:this.end_times});
    },
   },
   mounted() {
  }
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
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();
</script>
@endsection