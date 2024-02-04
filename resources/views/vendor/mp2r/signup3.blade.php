@extends('vendor.mp2r.layouts.index', ['title' => 'Home','sign_page'=>True,'completed'=>'50%'])
@section('content')
<style type="text/css">
	.box_enable{
		box-shadow: inset 0 2px 0 0 #39C6C0, 0 1px 6px 0 rgba(0,0,0,0.11) !important;
	}
</style>
   <!-- second section -->
<div class="progress">
  <div class="progress-bar" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
</div>
<section class="right-pos">
<div class="container">
	<div class="row ">  
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
		<div class="col-md-8 col-lg-8 main-height">
			<h2 class="signup-recovery">Signup</h2>
			<p class="signup-pera">Select Category</p>
			<hr/>
			<form id="step_third">
			<input type="hidden" class="form-control" id="step" name="step" value="3">
			@if(isset($categories))
			<section class="account-details main_category">
				<h3 class="acc-details">Select a category</h3>
				<input type="hidden" name="category" id="category_id">
				<div class="row">
					@foreach($categories as $category)
						<div class="col-md-6 col-lg-6 col-sm-6 select_category"  data-category_id="{{ $category->id}}" data-is_subcategory="{{ $category->is_subcategory}}">
							<a href="javascript:void(0)">
								<div class="outer-cover" style="box-shadow: inset 0 2px 0 0 #F6B568, 0 1px 6px 0 rgba(0,0,0,0.11);">
									<h2 class="mat-provider">{{ $category->name }} </h2>
									<img style="height: 200px" src="{{ Storage::disk('spaces')->url('uploads/'.$category->image) }}" class="img-fluid ml-auto d-block pt-3">
								</div>
							</a>
						</div>
					@endforeach
					
				</div>
			</section>
			@elseif(isset($sub_category))
			<section class="main-height-clr ">
				<div class="container">
					<section class="help-with2">
						<h3 class="appointment pb-2">What would you like help with?</h3>
						<div class="row">
							<input type="hidden" name="category" id="category_id">
							@foreach($sub_category  as $key=>$cat)
							<div class="col-md-6 col-lg-6 col-sm-6 select_category" data-category_id="{{ $cat->id}}" data-is_subcategory="{{ $cat->is_subcategory}}">
								<a href="javascript:void(0)">
									<div class="outer-counsler outer-cover" style="box-shadow: inset 0 2px 0 0 #F6B568, 0 1px 6px 0 rgba(0,0,0,0.11);background-color: {{ $cat->color_code }};">
										<h2 class="head-mental">{{ $cat->name }}</h2>
										<p class="head-pera">{{ $cat->description }}</p>
									</div>
								</a>
							</div>
							@endforeach
						</div>
					</section>
				</div>
			</section>
			<!-- <section class="account-details subcategory_view" >
				<h3 class="acc-details pb-4">What would you like to help with?</h3>
				<div id="subcategory_list">
					<div class="row">
					<input type="hidden" name="category" id="category_id">
					@foreach($sub_category  as $key=>$cat)
						<div class="col-md-6 select_category"  data-category_id="{{ $cat->id}}" data-is_subcategory="{{ $cat->is_subcategory}}">
							<div class="outer-cover-small">
								<ul class="nav">
								<li><div class="form-group form-check">
									<input class="form-check-input" type="checkbox" name="category_enable"></div></li>
								<li><img  src="{{ Storage::disk('spaces')->url('uploads/'.$cat->image) }}" class="img-fluid" style="height:20px !important;"></li>
								<li>{{ $cat->name }}</li>
								</ul>
							</div>
						</div>
					@endforeach
					</div>
				</div>
			</section> -->
			@endif
		</form>
		</div>
	</div>
</div>

<section class="footer flex-end ">
			<div class="container">
			
			<div class="row">
			<div class="col-md-12">
				<div class="row align-items-center">
					<div class="col-md-6 col-sm-6 col-lg-6">
					<a href="#" class="back-btn"><img src="{{ asset('assets/mp2r/images/ic_back.png') }}">Back</a>
					<button id="btn_text" form="step_third" type="submit" class="btn-next" disabled>Next</button></div>
					<div class="col-md-6 col-sm-6 col-lg-6">
					<span class="already-acc">Already have an account? <a href="{{ url('/') }}" class="login-link">Login</a></span>
					</div>
				</div>
			</div>
			</div>
			</div>
</section>		
</section>
@endsection