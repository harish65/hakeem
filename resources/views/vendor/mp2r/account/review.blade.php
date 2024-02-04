@extends('vendor.mp2r.layouts.index', ['title' => 'Manage Availability','header_after_login'=>true])
@section('css')
    
@endsection
@section('content')

<style>
.hide{
	display:none;
}
.imgt{
height: 79px;
    width: 79px;
    border-radius: 50%;
    object-fit: cover;
    /* border: solid; */
}
</style>
	<section class="main-height-clr bg-clr">
		<div class="container">
			<div class="row">
					<!-- left side  -->
				<div class="col-md-4 col-lg-4 col-sm-4">
					<div class="left-dashboard mt-5">
						<div class="side-head pb-0">
						<h3 class="">Service Provider Dashboard</h3>
						</div>
						<hr/>
						@include('vendor.mp2r.layouts.spmenu',['tab' =>'review'])
					</div>
				</div>
				
			<!-- left side  end -->	
				<div class="col-lg-8 col-md-8 col-sm-8">
					<section class="right-side mt-5">
					<div class="row align-items-center">
						<div class="col-md-12 col-sm-12">
						<h3 class="appointment">Reviews</h3>
						</div>
						
					</div>
					</section>

					<section class="wrapper wrap">
					@forelse($review_list as $review)
					<div class="row align-items-center m-0 wrap-height border-0 pt-3">
						<div class="col-md-12 col-lg-12 ">
							<div class="row m-0 ">
								<div class="col-md-2 col-lg-1 pl-0"><img src="{{ $review->profile_image?Storage::disk('spaces')->url('uploads/'.$review->user->profile_image):asset('assets/mp2r/images/ic_prof-medium@2x.png') }} " class="img-fluid pb-2 "></div>
									<div class="col-md-10 col-lg-11 p-0">
									<p class="first-name">{{ $review->user->name }}</p>
									<img src="{{ asset('assets/mp2r/images/ic_Star.png') }}"> <span class="rating">{{ $review->rating }}</span>
									<p class="second-name pt-2 ">{{ $review->comment }}</p>
									</div>
							</div>
						</div>	
					</div>
					@empty
					<center>No Review Found </center>
					@endforelse
					<?php echo $review_list->render(); ?>
					</section>
				</div>
			</div>
		</div>
	</section>
	    @endsection