@extends('vendor.mp2r.layouts.index', ['title' => 'Manage Availability','header_after_login'=>true])
@section('css')
    
@endsection
@section('content')
<style>
   	.tablinks{
      cursor: pointer;
   	}
</style>
<section class="main-height-clr ">
	<div class="container">
		<!-- breadcrum -->
		<section class="right-side mt-5">
			<div class="row align-items-center">
				<div class="col-md-9 col-sm-6 bread-sec">
					<h3 class="appointment pb-2">{{ $Get_Category->name }}</h3>
					<nav aria-label="breadcrumb">
					  <ol class="breadcrumb mt-0 p-0">
						<li class="breadcrumb-item"><a href="#">Home </a></li>
						<li class="breadcrumb-item"><a href="#">Consult professionals </a></li>
					  </ol>
					</nav>
				</div>
			</div>
		</section>	
		<section class="mb-3">
			<div class="row">
				<div class="col-md-6 col-sm-9">
					<!-- <img src="{{ asset('assets/images/ic_search.png') }}" alt=""> -->
					<button type="button" data-toggle="modal" data-target="#confirm-booking-category-filter" class="btn-consult" style="width: 70%">FILTER FOR CONSULTANT</button>
				</div>
				<div class="col-md-6 col-sm-9">
					
					<button type="button" id="ClearFilter_for_SP" class="btn-consult" style="width: 50%;float: right;">CLEAR FILTER</button>
				</div>
			</div>
		</section>
		<div class="row">
			<!-- breadcrum -->
			<div class="col-lg-12 col-md-8 col-sm-8">
				<section class="right-side " id="filterData_for_doctor_side">
					
				</section>	
				<div class="modal fade" id="confirm-booking-category-filter">
				    <div class="modal-dialog modal-md">
					    <div class="modal-content">
					        <!-- Modal Header -->
					        <div class="modal-header p-4 border-0">
					          <h4 class="modal-head">Filter For Consultant</h4>
					          <button type="button" id="modal_filter_button" class="close p-0 m-0" data-dismiss="modal">&times;</button>
					        </div>
					        <!-- Modal body -->
					        <div class="modal-body p-4">
							  	
									<div class="row m-0">
										<div class="col-md-11  mx-auto d-block">
											<div class="form-group">
											  	<select class="form-control" name="state" id="state_filter">
											  		<option value="">Select State</option>
											  		@foreach($states as $id=> $name)
														<option value="{{ $name }}">{{ $name }}</option>
													@endforeach
											  	</select>  
											</div>
											<div class="form-group">
											  	<select class="form-control" name="city" id="city_filter">
											  		<option>Select city</option>
											  	</select>  
											</div>
											<div class="form-group">
											  	<input type="hidden"  id="category_id_filter_index" value="{{ request()->route('id') }}">
											  	<input type="text" id="zip_code" placeholder="Enter Zip" class="form-control" name="zip_code"> 
											</div>
											<button id="filter_for_button" type="button" class="confirm-book w-100 ">Filter Doctors</button>
										</div>
									</div>
							  	
					        </div>
					        <!-- Modal footer -->
					    </div>
				    </div>
				</div>	
			</div>
		</div>	
	</div>
</section>
@endsection
<script src="{{ asset('static/js/util.js') }}"></script>
<script src="{{ asset('static/js/index.js') }}"></script>
