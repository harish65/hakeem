@extends('vendor.mp2r.layouts.index', ['title' => 'Manage Availability','header_after_login'=>true])
@section('content')
	
	<section class="main-height-clr ">
		<div class="container">
			<!-- breadcrum -->
			<section class="right-side mt-5">
					<div class="row align-items-center">
						<div class="col-md-9 col-sm-6 bread-sec">
						<h3 class="appointment pb-2">What do you need help with?</h3>
						</div>	
					</div>
			</section>
			<section class="help-with2">
				<div class="row">
					@foreach($counselor_category as $counselor_categoryinfo)
					<div class="col-md-4 col-lg-4 col-sm-6">
						<a href="{{ route('SPCategoryFilter',['id' => $counselor_categoryinfo->id ])}}">
							<div class="outer-counsler" style="background-color: {{ $counselor_categoryinfo->color_code }};">
								<h2 class="head-mental">{{ $counselor_categoryinfo->name }}</h2>
								<p class="head-pera">{{ $counselor_categoryinfo->description }}</p>
							</div>
						</a>
					</div>
					@endforeach
					@foreach($categories as $counselorInfo)
					<div class="col-md-4 col-lg-4 col-sm-6">
						<a href="{{ route('SPCategoryFilter',['id' => $counselorInfo->id ])}}">
							<div class="outer-counsler" style="background-color: {{ $counselorInfo->color_code }};">
								<h2 class="head-mental">{{ $counselorInfo->name }}</h2>
								<p class="head-pera">{{ $counselorInfo->description }}</p>
							</div>
						</a>
					</div>
					@endforeach
				</div>
			</section>
		</div>
	</section>
@endsection
