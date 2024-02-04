@extends('vendor.mp2r.layouts.index', ['title' => 'Counselor'])
@section('content')
	
	<section class="main-height-clr ">
		<div class="container">
			<!-- breadcrum -->
			<section class="right-side mt-5">
					<div class="row align-items-center">
						<div class="col-md-2 col-sm-2 bread-sec">
							<a href="javascript:history.back()" class="back-btn"><img src="{{ asset('assets/mp2r/images/ic_back.png') }}">Back</a>
						</div>
						<div class="col-md-9 col-sm-6 bread-sec">
							<h3 class="appointment pb-2">What would you like help with?</h3>
						</div>	
					</div>
			</section>
			<section class="help-with2">
				<div class="row">
					@foreach($counselor_category as $counselor_categoryinfo)
					<div class="col-md-4 col-lg-4 col-sm-6">
						<a href="{{ route('User.SPRequest',['id' => $counselor_categoryinfo->id ])}}">
							<div class="outer-counsler" style="background-color: {{ $counselor_categoryinfo->color_code }};">
								<h2 class="head-mental">{{ $counselor_categoryinfo->name }}</h2>
								<p class="head-pera">{{ $counselor_categoryinfo->description }}</p>
							</div>
						</a>
					</div>
					@endforeach
					@foreach($counselor as $counselorInfo)
					<div class="col-md-4 col-lg-4 col-sm-6">
						<a href="{{ route('User.SPRequest',['id' => $counselorInfo->id ])}}">
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
