@extends('vendor.mp2r.layouts.index', ['title' => 'Home','sign_page'=>True,'completed'=>'100%'])
@section('content')
   <!-- second section -->
<div class="progress">
  <div class="progress-bar" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">100%</div>
</div>
<section class="right-pos">
<div class="container">
	<div class="row ">  
		<div class="col-md-4 col-lg-4 pl-0 pos-static">
			<div class="right-pull">
			<img src="{{ asset('assets/mp2r/images/ic_signup-img2.png')}}" class="img-fluid w-100">
				<div class="join-expert">
					<div class="join-expt">
					<h1 class="join-text" >Join the best Experts</h1>
					<p  class="join-pera">Millions of people are looking for the right expert on My Path 2 recovery. Start your digital journey with Expert Profile</p>
					</div>
				</div>
			</div>
			
		</div>
		<div class="col-md-8 col-lg-8 main-height">
			<h2 class="signup-recovery">Start your Journey now</h2>
			<p class="signup-pera">Set up your personal and Insurance details</p>
			<hr/>
			
			<section class="account-details">
				<h3 class="acc-details">Other & Insurance Details</h3>
				
				<!-- form start -->
				<section class="form-sec">
				<form id="step_second_user">
				<input type="hidden" class="form-control" id="step" name="step" value="2">
				<div class="row pb-3">
					<div class="col-md-6">
						<div class="form-group">
						   <label for="pwd">Address</label>
						  <input type="text" class="form-control" id="pac-input" placeholder="204, Eloisa Village Apt. 827" name="address">
						  <span class="alert-danger address_error"></span>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
						   <label for="state">State</label>					   
						    <select class="form-control" id="state" name="state">
						    	@foreach($states as $id=>$name)
								<option value="{{ $name }}">{{ $name }}</option>
								@endforeach
							 </select>
							 <span class="alert-danger state_error"></span>					
						</div>
						
					</div>
					
				</div>
				
				<div class="row pb-3">
					<div class="col-md-6">
						<div class="form-group">
						   <label for="state">City</label>					   
						    <select class="form-control" id="city" name="city">
						    	<!-- <option>---Select City---</option> -->
						    	<option></option>
							 </select>
							 <span class="alert-danger city_error"></span>						
						</div>
					</div>
					
					<div class="col-md-6">
						<div class="form-group">
						<label for="email">Zip Code</label>
						 <input type="number" onkeypress="return isNumber(event)"   class="form-control" id="zipcodee" placeholder="Zip Code" name="zip_code" maxlength="6">
						 <span class="alert-danger zip_code_error"></span>
						</div>
					</div>
				</div>
				<div class="seprator" style="border:1px solid #ddd;padding: 15px 20px; position:relative;">
					<span style="position:absolute;left: 20px;padding: 0 20px;top: -12px;background: #fff;">Security Question for reset password</span>
					<div class="row pb-3">
						<div class="col-md-6">
							<div class="form-group">
							   <label for="question1">Question1</label>					   
							    <select class="form-control" id="question1" name="question1">
								 	@foreach($question1 as $q)
									<option value="{{ $q->id }}">{{ $q->question }}</option>
									@endforeach
								 </select>
								 <span class="alert-danger question1_error"></span>						
							</div>
						</div>
						
						<div class="col-md-6">
							<div class="form-group">
							   <label for="state">Answer1</label>					   
							    <input type="text" class="form-control" id="answer1" name="answer1" placeholder="Answer1">
								 <span class="alert-danger answer1_error"></span>						
							</div>
						</div>
					</div>
					<div class="row pb-3">
						<div class="col-md-6">
							<div class="form-group">
							   <label for="state">Question2</label>					   
							    <select class="form-control" id="question2" name="question2">
								 	@foreach($question2 as $q)
									<option value="{{ $q->id }}">{{ $q->question }}</option>
									@endforeach
								 </select>
								 <span class="alert-danger question3_error"></span>						
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
							   <label for="state">Answer2</label>					   
							    <input type="text" class="form-control" id="answer2" name="answer2" placeholder="Answer2">
								 <span class="alert-danger answer2_error"></span>						
							</div>
						</div>
					</div>
					<div class="row pb-3">
						<div class="col-md-6">
							<div class="form-group">
							   <label for="state">Question3</label>					   
							    <select class="form-control" id="question3" name="question3">
								 	@foreach($question3 as $q)
									<option value="{{ $q->id }}">{{ $q->question }}</option>
									@endforeach
								 </select>
								 <span class="alert-danger question3_error"></span>						
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
							   <label for="state">Answer3</label>					   
							    <input type="text" class="form-control" id="answer3" name="answer3" placeholder="Answer3">
								 <span class="alert-danger answer3_error"></span>						
							</div>
						</div>
					</div>
				</div>
				<div class="row pb-3">
					<div class="col-md-6">
						<div class="form-group">
							<label> Do you have Insurance?</label>
							<!-- <div class="form-control"></div> -->
							<select name="" id="insurances_select_dropdown" class="form-control">
								<option value="0">No</option>
								<option value="1">Yes</option>
							</select>
                          	<!-- <input type="" name=""> -->
						</div>
					</div>
					
					<div class="col-md-6" style="display: none;" id="insurances_dropdown">
						<label for="pwd">Select Insurance</label>
						<div class="form-group">
						 <select class="form-control" id="insurances" name="insurance">
						 	<option value="">---Select Insurance---</option>
						 	@foreach($insurances as $id=>$name)
							<option value="{{ $id }}">{{ $name }}</option>
							@endforeach
						  </select>	
							<span class="alert-danger insurances_error"></span>
						</div>
					</div>
				</div>
				<!-- <div class="form-group form-check">
				  <label class="form-check-label edit-label align-items-center d-flex">
					<input class="form-check-input " type="checkbox" name="remember" checked><span class="pl-2"> I Accept Self pay</span>
				  </label>
				</div> -->
				
				<div class="form-group form-check">
				 
					<input class="form-check-input opacity" type="checkbox" name="remember" checked> <label class="form-check-label  "><span class="pl-2 d-block"> I agree to the Samaritan Service Solutions Inc Terms of Service, Privacy Policy, Cookies Policy and Fee Schedules. </span>
				  </label>
				</div>
				
				<div class="form-group form-check">
				  
					<input class="form-check-input " type="checkbox" name="remember" checked><label class="form-check-label  "><span class="pl-2 d-block"> I understand that the service providers and other professionals that I am connected to on My Path 2 Recovery aren't associated with My Path 2 Recovery or Samaritan Service Solutions LLC, and hold harmless Samaritan Service Solutions LLC, and understand the My Path 2 Recovery product/service is a communication tool only. </span>
				  </label>
				</div>
				
				<div class="form-group form-check">
					<input class="form-check-input " type="checkbox" name="remember" checked> <label class="form-check-label  "><span class="pl-2 d-block">I understand that each service provider may have their own fee schedule and billing details</span>
				  </label>
				</div>
				
				

				</form>
				</section>	
			</section>
			
		</div>
	</div>
</div>
</section>

<section class="footer flex-end ">
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-lg-10">
				<div class="row align-items-center">
					<div class="col-md-6 col-sm-6 col-lg-6">
						<a href="#" class="back-btn"><img src="{{ asset('assets/mp2r/images/ic_back.png') }}">Back</a>
						<button id="btn_text" form="step_second_user" type="submit" class="btn-next">Next</button>
					</div>
					<div class="col-md-6 col-sm-6 col-lg-6">
						<span class="already-acc">Already have an account? <a href="{{ url('/') }}" class="login-link">Login</a></span>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

@endsection
