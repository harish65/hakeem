@extends('vendor.mp2r.layouts.index', ['title' => 'Manage Availability','header_after_login'=>true])
@section('css')
    
@endsection
@section('content')
<style>
   .tablinks{
      cursor: pointer;
   }
   #Schedulecolor:hover {
  color: white;
}
   </style>
	<section class="main-height-clr ">
		<div class="container">
			
			<!-- breadcrum -->
			<section class="right-side mt-5">
				@if(session('message'))
               
               <div class="alert alert-success" role="alert">
                     {{session('message')}}
               </div>
            @endif
					<div class="row align-items-center">
						<div class="col-md-9 col-sm-6 bread-sec">
						<h3 class="appointment pb-2">{{ $Get_Category->name }}</h3>
						<nav aria-label="breadcrumb">
						  <ol class="breadcrumb mt-0 p-0">
							<li class="breadcrumb-item"><a href="#">Home </a></li>
							<li class="breadcrumb-item"><a href="#">Consult professionals </a></li>
							<!-- <li class="breadcrumb-item active" aria-current="page"> Doctor Details</li> -->
						  </ol>
						</nav>
						</div>
						
					</div>
					</section>
					
					<section class="mb-3">
					<div class="row">
						<div class="col-md-6 col-sm-9 mx-auto d-block">
					<div class="input-search mt-2"> 
						<div class="inputDiv">
							<img src="{{ asset('asets/images/ic_search.png') }}" alt="">
							<input type="text" id="searchByServiceProvider" placeholder="Search for a professional" class="w-100">
							<input type="hidden"  value="{{ request()->route('id')}}" id="category_id_index_userside">
						</div>
					</div>
					</div>
					</div>
					</section>
		
				
				<div class="row">
						<!-- left side  -->
				
			<!-- left side  end -->	
				
				
				
				
				
			<!-- breadcrum -->
				<div class="col-lg-12 col-md-8 col-sm-12">
					<section class="right-side " id="filterData">
						
						
							
					</section>		
				</div>
				</div>	
			</div>
	</section>

	<script type="text/javascript">
		$(document).on('click','#formScheduleBooking',function(e){

            e.preventDefault();
                var now = moment().format("dddd, MMMM Do, YYYY, h:mm:ss A");
                Swal.fire({
                    title: 'Confirm Booking!',
                    text: 'Do You Want To Confirm Connect Now request on  '+now,
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes!',
                }).then((result) => {
                    if (result.value) {
                        
                        var from_user=$(this).attr('data-id');

                        var cat_id=$("#category_id_index").val();

                       

                        $.ajax({
                            type: "post",
                            url: base_url + '/request_connect_now',
                            data: {
                                
                                "from_user": from_user,
                                "cat_id":cat_id,
                                
                            },
                            
                            success: function(response) {
                                
                                
                                Swal.fire('Success!', 'Your connect now request has been sent successfully', 'success').then((result) => {
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
