@extends('vendor.mp2r.layouts.index', ['title' => 'SignUp','sign_page'=>True,'completed'=>'75%'])
@section('content')
   <!-- second section -->
<div class="progress">
  <div class="progress-bar" role="progressbar" style="width: 75%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
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
			<p class="signup-pera">Set up your personal, Insurance and work details</p>
			<hr/>
			
			<section class="account-details form-sec">
			<form id="step_six">
				<input type="hidden" class="form-control" id="step" name="step" value="6">
				<input type="hidden" class="form-control" id="group_type" name="group_type" value="id">
				<h3 class="acc-details pb-4">Be Part of a Group or Create One</h3>
					<div class="form-group">
					<label for="group_id">Search & Select Group</label>
					 <select class="form-control" id="group_id" name="group_id">
						<option value="">---Select Group---</option>
					 	@foreach($groups as $key=>$group)
							<option value="{{ $group->id }}">{{ $group->name }}</option>
					 	@endforeach
					  </select>
						<span class="alert-danger group_id_error"></span>

					</div>							
				<a href="javascript:void(0)" class="new-group">+ Create New Group</a>
				<input type="text" class="form-control" id="create_group" placeholder="group name" name="group_name" style="display: none;">
				<span class="alert-danger  group_name_error"></span>
			</form>	
			</section>
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
					<button id="btn_text" form="step_six" type="submit" class="btn-next">Next</button></div>
					<div class="col-md-6 col-sm-6 col-lg-6">
					<span class="already-acc">Already have an account? <a href="#" class="login-link">Login</a></span>
					</div>
				</div>
			</div>
			</div>
			</div>
		</section>	

			
</section>
@endsection