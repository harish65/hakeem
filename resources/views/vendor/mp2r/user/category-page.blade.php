@extends('vendor.mp2r.layouts.index', ['title' => 'Home'])
@section('content')

    
    
	
	<section class="main-height-clr ">
		<div class="container">

			<!-- breadcrum -->
			<section class="right-side mt-5">
					<div class="row align-items-center">
						<div class="col-md-9 col-sm-6 bread-sec">
						<h3 class="appointment pb-2">{{$category->name}}</h3>
						<nav aria-label="breadcrumb">
						  <ol class="breadcrumb mt-0 p-0">
							<li class="breadcrumb-item"><a href="#">Home </a></li>
							<li class="breadcrumb-item"><a href="#">Consult professionals </a></li>
							<!-- <li class="breadcrumb-item active" aria-current="page"> Doctor Details</li> -->
						  </ol>
						</nav>
						</div>
						
						<div class="col-md-3 col-sm-6">
							<div class="appointment-date">
								<section class="morning">
								
									 <div class="dropdown">
										<span type="button" class="btn text-left w-100 dropdown-toggle" data-toggle="dropdown">
										<span class="first-name "><img src="{{ asset('assets/mp2r/images/ic_location.png') }}" class="pr-2"> California <img src="{{ asset('assets/mp2r/images/ic_dd-header.png') }}" class=" pull-right pt-2"></span>
										</span>
										<div class="dropdown-menu">
										  <a class="dropdown-item" href="#">Link 1</a>
										  <a class="dropdown-item" href="#">Link 2</a>
										  <a class="dropdown-item" href="#">Link 3</a>
										</div>
									  </div>
					
								</section>
							</div>
						</div>
					</div>
					</section>
					
					<section class="mb-3">
					<div class="row">
						<div class="col-md-6 col-sm-9">
					<div class="input-search mt-2"> 
						<div class="inputDiv">
							<img src="{{ asset('assets/mp2r/images/ic_search.png') }}" alt="">
							<input type="text" placeholder="Search for a professional" class="w-100">
						</div>
					</div>
					</div>
					</div>
					</section>
		
				
				<div class="row">
						<!-- left side  -->
				<div class="col-md-4 col-lg-3 col-sm-4">
					<div class="right-schdule left-form mt-3">
					
					<div class="wrapper3 p-0 mb-3">
					<section class="morning p-3">
						<div style="cursor: pointer"  data-toggle="collapse" data-target="#collapse04" aria-expanded="false">
						<div class="">
						<span class="first-name "> Need Help With?</span>
						<img src="{{ asset('assets/mp2r/images/ic_dd-header.png') }}" class="js-rotate-if-collapsed pull-right pt-2">
						</div>
					</div>
						<div id="collapse04" class="collapse pt-2 "><br>
						<form action="/action_page.php">
						<div class="form-group">
						  <input type="radio" id="management" name="management" value="male">
						  <label class="pl-2" for="male">Anger Management</label>
						  </div>
						  <div class="form-group">
						   <input type="radio" id="management" name="management" value="male">
						   <label class="pl-2" for="male">Adoption</label>
						  </div>
						  <div class="form-group">
						   <input type="radio" id="management" name="management" value="male">
						   <label class="pl-2" for="male">Alcohol Use</label>
							</div>
							
							<div class="form-group">
						   <input type="radio" id="management" name="management" value="male">
						   <label class="pl-2" for="male">Anxiety</label>
							</div>
							<div class="form-group">
						   <input type="radio" id="management" name="management" value="male">
						   <label class="pl-2" for="male">Child or Adolescent</label>
							</div>
							
						</form>
						</div>
					
					</section>
					</div>	
					
					<div class="wrapper3 p-0 mb-3">
					<section class="morning p-3">
						<div style="cursor: pointer"  data-toggle="collapse" data-target="#collapse2" aria-expanded="false">
						<div class="">
						<span class="first-name "> Days Availability</span>
						<img src="{{ asset('assets/mp2r/images/ic_dd-header.png') }}" class="js-rotate-if-collapsed pull-right pt-2">
						</div>
					</div>
						<div id="collapse2" class="collapse pt-2"><br>
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
					</div>
					
					
					<div class="wrapper3 p-0 mb-3">
					<section class="morning p-3">
						<div style="cursor: pointer"  data-toggle="collapse" data-target="#collapse02" aria-expanded="false">
						<div class="">
						<span class="first-name "> Gender</span>
						<img src="{{ asset('assets/mp2r/images/ic_dd-header.png') }}" class="js-rotate-if-collapsed pull-right pt-2">
						</div>
					</div>
						<div id="collapse02" class="collapse pt-2 "><br>
						<form action="/action_page.php">
						<div class="form-group">
						  <input type="radio" id="male" name="gender" value="male">
						  <label class="pl-2" for="male">Male</label>
						  </div>
						  <div class="form-group">
						  <input type="radio" id="female" name="gender" value="female">
						  <label class="pl-23 for="female">Female</label>
						  </div>
						  <div class="form-group">
						  <input type="radio" id="other" name="gender" value="other">
						  <label class="pl-2 for="other">Other</label>
							</div>
						</form>
						</div>
					
					</section>
					</div>	

					<div class="wrapper3 p-0 mb-3">
					<section class="morning ">
						<span class="first-name p-3 "> Insurance</span>
						<hr>
						
						<div class="p-3 left-form ">
						<form action="/action_page.php">
						<div class="form-group">
						  <input type="radio" id="male" name="city" value="male">
						  <label class="pl-2" for="male">Aetna</label>
						  </div>
						  <div class="form-group">
						  <input type="radio" id="female" name="city" value="female">
						  <label class="pl-2 for="female">Cigna</label>
						  </div>
						  <div class="form-group">
						  <input type="radio" id="other" name="city" value="other">
						  <label class="pl-2 for="other">EmblemHealth (GHI)</label>
						  </div>
						  
						  <div class="form-group">
						  <input type="radio" id="other" name="city" value="other">
						  <label class="pl-2 for="other">EmblemHealth (HIP)</label>
						  </div>
						  
						  <div class="form-group">
						  <input type="radio" id="other" name="city" value="other">
						  <label class="pl-2 for="other">United healthcare</label>
						  </div>
						   <a href="#" class="more-link">+19 More</a>
						</form>
						</div>
					
					</section>
					</div>		


					
					</div>
				</div>
				
			<!-- left side  end -->	
				
				
				
				
				
			<!-- breadcrum -->
				<div class="col-lg-9 col-md-8 col-sm-8">
					<section class="right-side ">
                        @foreach($doctors as $doctor)
						<div class="wrapper3 mb-3">
						<div class="row">
								<div class="col-md-6 col-lg-8 col-sm-12">
									<div class="row m-0 align-items-center sm-text-center pt-0">
										<div class="col-md-12 col-lg-3 "><img src="{{ Storage::disk('spaces')->url('uploads/'.$doctor->profile_image) }}" class="img-fluid mb-2"></div>
										<div class="col-md-12 col-lg-9 pl-0 pt-2">
											<h5 class="first-name">{{$doctor->name}}</h5>
											<p class="second-name pt-2 pb-1">{{$doctor->profile->qualification}} </p>
											<img src="{{ asset('assets/mp2r/images/ic_Star.png') }}"> <span class="rating2">{{isset($doctor->feedback->rating) ? $doctor->feedback->rating : 0}} {{$doctor->reviewCount}} Reviews</span>
											<a href="{{route('doctor-single-page',$doctor->id)}}" class="view-profile">View Profile</a>
										</div>
									</div>
								</div>
								<div class="col-md-6 col-lg-4 col-sm-12">
								<button type="submit" class="btn-consult confirm mt-2 mb-3">Connect Now</button>
								<button type="submit" class="btn-consult confirm schdule-booking mt-0 mb-2">Schedule Booking</button>
								</div>
						</div>	
						</div>
						@endforeach

                        <div class="d-flex justify-content-center">
    {!! $doctors->links() !!}
</div>
				
						<!-- pagination -->
							
					</section>		
				</div>
				</div>	
			</div>
	</section>

@endsection
