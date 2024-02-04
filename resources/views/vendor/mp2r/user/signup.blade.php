@extends('vendor.mp2r.layouts.index', ['title' => 'Home','sign_page'=>True])
@section('content')
<!-- second section -->
<div class="progress">
  <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
</div>
<section class="right-pos">
<div class="container">
	<div class="row ">  
		<div class="col-md-4 col-lg-4 pl-0 pos-static">
			<div class="right-pull">
			<img src="{{ asset('assets/mp2r/images/ic_signup-img1.png')}}" class="img-fluid w-100">
				<div class="join-expert">
					<div class="join-expt">
					<h1 class="join-text" >Get the Best Help</h1>
					<p  class="join-pera">One plateform takes care of your well being.Consult best professionals in various fields and get best help.</p>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-8 col-lg-8">
			<h2 class="signup-recovery">Signup for My Path 2 Recovery</h2>
			<p class="signup-pera">Set up your personal and Insurance details</p>
			<hr/>
			<section class="account-details">
				<h3 class="acc-details">Account Details</h3>
				<form id="step_first_user" enctype="multipart/form-data" method="post">
				<input name="profile_image" type="file" id="imgupload" style="display:none" accept="image/*" /> 
				<img id="OpenImgUpload" src="{{ asset('assets/mp2r/images/ic_upload profile img.png')}}" class="img-fluid pt-3 pb-3" height="130px" width="130px">
				
				<!-- form start -->
				<section class="form-sec">
				<input type="hidden" class="form-control" id="step" name="step" value="1">
				<div class="row pb-3">
					<div class="col-md-6">
						<div class="form-group">
						   <label for="first_name">First Name</label>
						  <input type="text" class="form-control" id="first_name" placeholder="First Name" name="first_name" required="">
						  <span class="alert-danger first_name_error"></span>
						</div>
					</div>
					
					<div class="col-md-6">
						<div class="form-group">
						   <label for="last_name">Last Name</label>
						  <input type="text" class="form-control" id="last_name" placeholder="Last Name" name="last_name" required="">
						  <span class="alert-danger last_name_error"></span>
						</div>
					</div>
				</div>
				
				<div class="row pb-3">
					<div class="col-md-6">
						<div class="form-group">
						   <label for="phone_number">Phone number</label>
						   
						   <div class="input-outer d-flex align-items-center p-2">
							   <div class="flag row m-0">
								<img src="{{ asset('assets/mp2r/images/ic_flag.png')}}" class="img-fluid pr-2">
								 <div class="dropdown">
								 	<input type="hidden" value="+1" name="country_code" id="country_code">
									<span type="button" data-toggle="dropdown" id="country_code_text">
										<span class="text_code">+1</span>
										<img src="{{ asset('assets/mp2r/images/ic_dd-header.png')}}" class="img-fluid pl-2">
									</span>
									 <ul class="dropdown-menu">
									  <li><a href="javascript:void(0)" class="country_code_sel">+1</a></li>
									  <li><a href="javascript:void(0)" class="country_code_sel">+91</a></li>
									  <li><a href="javascript:void(0)" class="country_code_sel">+92</a></li>
									  <li><a href="javascript:void(0)" class="country_code_sel">+93</a></li>
									</ul>
								  </div>
							   </div>
							   <input type="number" min="0" class="border-0 pl-2" id="phone_number" placeholder="9984929384" name="phone" required="" onkeypress="return isNumber(event)">
						   </div>
							<span class="alert-danger phone_number_error"></span>
						</div>
						
					</div>
					
					<div class="col-md-6">
						<div class="form-group">
						<label for="email">Username / Email</label>
						 <input type="text" class="form-control" id="email" placeholder="JohnDoe@gmail.com" name="email" required="">
						 <span class="alert-danger email_error"></span>
						</div>
					</div>
				</div>
				<div class="row pb-3">
					<div class="col-md-6">
						<div class="form-group">
						   <label for="pwd">Set a password</label>
						  <input type="password" class="form-control" id="pwd" placeholder="************" name="password" required="">
						  <small id="emailHelp" class="form-text text-muted">Password should contain at-least 1 Uppercase, 1 Lowercase, 1 Numeric and at least 8 characters.</small>
						  <span class="alert-danger password_error"></span>
						</div>
					</div>
					
					<div class="col-md-6">
						<div class="form-group">
						<label for="pwd2">Confim Password</label>
						 <input type="password" class="form-control" id="pwd2" placeholder="************" name="password_confirmation" required="">
						  <span class="alert-danger password_confirmation_error"></span>
						</div>
					</div>
					<span class="alert-danger main_error"></span>
				</div>
				</section>	
				</form>
			</section>
		</div>
	</div>
</div>
		
</section>

<section class="footer">
	<div class="col-md-12  col-lg-10 mx-auto">
		<div class="row">
			<div class="col-md-12 col-lg-9 col-sm-12">
				<div class="row align-items-center">
					<div class="col-md-6 col-sm-12 col-lg-6"><button id="btn_text" form="step_first_user" type="submit" class="btn-next">Next</button></div>
					<div class="col-md-6 col-sm-12 col-lg-6">
					<span class="already-acc">Already have an account? <a href="{{ url('/') }}" class="login-link">Login</a></span>
					</div>
				</div>
			</div>
		</div>
	</div>	
</section>

@endsection