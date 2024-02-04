@extends('vendor.mp2r.layouts.index', ['title' => 'SignUp','sign_page'=>True,'completed'=>'100%'])
@section('content')
<div class="clearfix"></div>
   <!-- second section -->
<div class="progress">
  <div class="progress-bar" role="progressbar" style="width: 100%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
</div>
<section class="right-pos">
<div class="container">
	<div class="row ">  
		<div class="col-md-4 col-lg-4 pl-0 pos-static">
			<div class="right-pull">
			<img src="{{ asset('assets/mp2r/images/sign-left.png')}}" class="img-fluid w-100">
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
			<div class="plan-detail">
				 <!-- Nav pills -->
				  <ul class="nav nav-pills my-plans justify-content-end pt-2 pb-2" role="tablist">
					<li class="nav-item">
					  <a class="nav-link  active" data-toggle="pill" id="Basic-pre" href="#Basic">Basic</a>
					</li>
					<li class="nav-item">
					  <a class="nav-link" data-toggle="pill" id="Premium-pre" href="#Premium">Premium</a>
					</li>
					<li class="nav-item">
					  <a class="nav-link" data-toggle="pill"  id="Executive-pre" href="#Executive">Executive</a>
					</li>
				  </ul>

				  <form id="submit_plan">
				  		<input type="hidden" id="plan_id" name="plan_id">
				  		<input type="hidden" id="total_price" name="total_price">
				  </form>

				  <!-- Tab panes -->
				  <div class="tab-content">
					<div data-plan_id="com.mp2r.premium" data-price="250" id="Premium" class="tab-pane"><br>
					  	<div class="table-responsive form-sec">
						 <table class="table">
							<tbody>
							  <tr>
								<td>Real-time Patient Resource Directory</td>
								<td><img src="{{ asset('assets/mp2r/images/ic_feature-available-close.png')}}"></td>
								<td><img src="{{ asset('assets/mp2r/images/ic_feature-available-open.png')}}"></td>
								<td><img src="{{ asset('assets/mp2r/images/ic_feature-available-close.png')}}"></td>
							  </tr>
							  
							   <tr>
								<td>Area Counsellor List</td>
								<td><img src="{{ asset('assets/mp2r/images/ic_feature-available-close.png')}}"></td>
								<td><img src="{{ asset('assets/mp2r/images/ic_feature-available-open.png')}}"></td>
								<td><img src="{{ asset('assets/mp2r/images/ic_feature-available-close.png')}}"></td>
							  </tr>
							  
							   <tr>
								<td>Area Peer Support List</td>
								<td><img src="{{ asset('assets/mp2r/images/ic_feature-available-close.png')}}"></td>
								<td><img src="{{ asset('assets/mp2r/images/ic_feature-available-open.png')}}"></td>
								<td><img src="{{ asset('assets/mp2r/images/ic_feature-available-close.png')}}"></td>
							  </tr>
							  
							   <tr>
								<td>Area MAT Providers List</td>
								<td><img src="{{ asset('assets/mp2r/images/ic_feature-available-close.png')}}"></td>
								<td><img src="{{ asset('assets/mp2r/images/ic_feature-available-open.png')}}"></td>
								<td><img src="{{ asset('assets/mp2r/images/ic_feature-available-close.png')}}"></td>
							  </tr>
							  
							   <tr>
								<td>Unlimited Instant Messaging</td>
								<td><img src="{{ asset('assets/mp2r/images/ic_feature-available-close.png')}}"></td>
								<td><img src="{{ asset('assets/mp2r/images/ic_feature-available-open.png')}}"></td>
								<td><img src="{{ asset('assets/mp2r/images/ic_feature-available-close.png')}}"></td>
							  </tr>
							  
							   <tr>
								<td>Service Provider Profile</td>
								<td><img src="{{ asset('assets/mp2r/images/ic_feature-available-close.png')}}"></td>
								<td><img src="{{ asset('assets/mp2r/images/ic_feature-available-open.png')}}"></td>
								<td><img src="{{ asset('assets/mp2r/images/ic_feature-available-close.png')}}"></td>
							  </tr>
							  
							   <tr>
								<td>Access to On-demand Video Conferencing</td>
								<td><img src="{{ asset('assets/mp2r/images/ic_feature-notavailable-close.png')}}"></td>
								<td><img src="{{ asset('assets/mp2r/images/ic_feature-available-open.png')}}"></td>
								<td><img src="{{ asset('assets/mp2r/images/ic_feature-available-close.png')}}"></td>
							  </tr>
							  
							   <tr>
								<td>Geo-targated Banner Ad Rotation</td>
								<td><img src="{{ asset('assets/mp2r/images/ic_feature-notavailable-close.png')}}"></td>
								<td><img src="{{ asset('assets/mp2r/images/ic_feature-available-open.png')}}"></td>
								<td><img src="{{ asset('assets/mp2r/images/ic_feature-available-close.png')}}"></td>
							  </tr>
							  
							  <tr>
								<td>Listing in Active Directory with open scheduling</td>
								<td><img src="{{ asset('assets/mp2r/images/ic_feature-notavailable-close.png')}}"></td>
								<td class="local-region opacity-high">Local region<br>(upto 10 zip codes)</td>
								<td class="local-region">3 State Wide</td>
							  </tr>
							  
							  <tr>
								<td>Emphasized “Bold” Listing</td>
								<td><img src="{{ asset('assets/mp2r/images/ic_feature-notavailable-close.png')}}"></td>
								<td><img src="{{ asset('assets/mp2r/images/ic_feature-notavailable-open.png')}}"></td>
								<td><img src="{{ asset('assets/mp2r/images/ic_feature-available-close.png')}}"></td>
							  </tr>
							  
							  <tr>
								<td>Unlimited Real-time Insuarance Eligibility Verification</td>
								<td><img src="{{ asset('assets/mp2r/images/ic_feature-notavailable-open.png')}}"></td>
								<td>
								<div class="form-group form-check">
								  <label class="form-check-label">
									<input class="form-check-input" data-plan_id="com.mp2r.additional.insurance" id="insurance-pre" data-price="25" type="checkbox" name="insurance"> $25<br>(additional)
								  </label>
								</div>
								</td>
								<td><img src="{{ asset('assets/mp2r/images/ic_feature-available-close.png')}}"></td>
							  </tr>
							  
							  <tr>
								<td>Group Practice Button Association</td>
								
								<td><img src="{{ asset('assets/mp2r/images/ic_feature-notavailable-open.png')}}"></td>
								<td>
								<div class="form-group form-check">
								  <label class="form-check-label">
									<input class="form-check-input" data-plan_id="com.mp2r.additional.group" id="group-pre" data-price="500" type="checkbox" name="group"> $500<br>(additional)
								  </label>
								</div>
								</td>
								<td>
								<div class="form-group form-check">
								  <label class="form-check-label">
									<input class="form-check-input" type="checkbox" name="remember"> $500<br>(additional)
								  </label>
								</div>
								</td>
							  </tr>
							</tbody>
						  </table>
					  </div>
					  <div class="row">
					  <div class="col-md-6 col-lg-6 col-sm-12"><p class="adv">*Advertising subscription rates listed are monthly, and prepaid quaterly.</p></div>
					  <div class="col-md-6 col-lg-6 col-sm-12"><button type="submit" form="submit_plan" class="btn2">Subscribe to Premium for $<span id="grand_total"></span></button></div>
					  </div>
					</div>
					<div data-plan_id="com.mp2r.basic" data-price="0" id="Basic" class="tab-pane active"><br>
					  <div class="table-responsive form-sec">
						 <table class="table">
						
							<tbody>
							   <tr>
								<td>Real-time Patient Resource Directory</td>
								<td><img src="{{ asset('assets/mp2r/images/ic_feature-available-open.png')}}"></td>
								<td><img src="{{ asset('assets/mp2r/images/ic_feature-available-close.png')}}"></td>
								<td><img src="{{ asset('assets/mp2r/images/ic_feature-available-close.png')}}"></td>
							  </tr>
							  
							   <tr>
								<td>Area Counsellor List</td>
								<td><img src="{{ asset('assets/mp2r/images/ic_feature-available-open.png')}}"></td>
								<td><img src="{{ asset('assets/mp2r/images/ic_feature-available-close.png')}}"></td>
								<td><img src="{{ asset('assets/mp2r/images/ic_feature-available-close.png')}}"></td>
							  </tr>
							  
							   <tr>
								<td>Area Peer Support List</td>
								<td><img src="{{ asset('assets/mp2r/images/ic_feature-available-open.png')}}"></td>
								<td><img src="{{ asset('assets/mp2r/images/ic_feature-available-close.png')}}"></td>
								<td><img src="{{ asset('assets/mp2r/images/ic_feature-available-close.png')}}"></td>
							  </tr>
							  
							   <tr>
								<td>Area MAT Providers List</td>
								<td><img src="{{ asset('assets/mp2r/images/ic_feature-available-open.png')}}"></td>
								<td><img src="{{ asset('assets/mp2r/images/ic_feature-available-close.png')}}"></td>
								<td><img src="{{ asset('assets/mp2r/images/ic_feature-available-close.png')}}"></td>
							  </tr>
							  
							   <tr>
								<td>Unlimited Instant Messaging</td>
								<td><img src="{{ asset('assets/mp2r/images/ic_feature-available-open.png')}}"></td>
								<td><img src="{{ asset('assets/mp2r/images/ic_feature-available-close.png')}}"></td>
								<td><img src="{{ asset('assets/mp2r/images/ic_feature-available-close.png')}}"></td>
							  </tr>
							  
							   <tr>
								<td>Service Provider Profile</td>
								<td><img src="{{ asset('assets/mp2r/images/ic_feature-available-open.png')}}"></td>
								<td><img src="{{ asset('assets/mp2r/images/ic_feature-available-close.png')}}"></td>
								<td><img src="{{ asset('assets/mp2r/images/ic_feature-available-close.png')}}"></td>
							  </tr>
							  
							  <tr>
								<td>Access to On-demand Video Conferencing</td>
								<td><img src="{{ asset('assets/mp2r/images/ic_feature-notavailable-open.png')}}"></td>
								<td><img src="{{ asset('assets/mp2r/images/ic_feature-available-close.png')}}"></td>
								<td><img src="{{ asset('assets/mp2r/images/ic_feature-available-close.png')}}"></td>
							  </tr>
							  
							   <tr>
								<td>Geo-targated Banner Ad Rotation</td>
								<td><img src="{{ asset('assets/mp2r/images/ic_feature-notavailable-open.png')}}"></td>
								<td><img src="{{ asset('assets/mp2r/images/ic_feature-available-close.png')}}"></td>
								<td><img src="{{ asset('assets/mp2r/images/ic_feature-available-close.png')}}"></td>
							  </tr>
							  
							  <tr>
								<td>Listing in Active Directory with open scheduling</td>
								<td><img src="{{ asset('assets/mp2r/images/ic_feature-notavailable-open.png')}}"></td>
								<td class="local-region">Local region<br>(upto 10 zip codes)</td>
								<td class="local-region opacity-high">3 State Wide</td>
							  </tr>
							  
							  <tr>
								<td>Emphasized “Bold” Listing</td>
								<td><img src="{{ asset('assets/mp2r/images/ic_feature-notavailable-open.png')}}"></td>
								<td><img src="{{ asset('assets/mp2r/images/ic_feature-notavailable-close.png')}}"></td>
								<td><img src="{{ asset('assets/mp2r/images/ic_feature-available-close.png')}}"></td>
							  </tr>
							  
							  <tr>
								<td>Unlimited Real-time Insuarance Eligibility Verification</td>
								<td><img src="{{ asset('assets/mp2r/images/ic_feature-notavailable-open.png')}}"></td>
								<td>
								<div class="form-group form-check">
								  <label class="form-check-label">
									<input class="form-check-input" type="checkbox" name="remember"> $25/month<br>(additional)
								  </label>
								</div>
								</td>
								<td><img src="{{ asset('assets/mp2r/images/ic_feature-available-close.png')}}"></td>
							  </tr>
							  
							  <tr>
								<td>Group Practice Button Association</td>
								
								<td><img src="{{ asset('assets/mp2r/images/ic_feature-notavailable-open.png')}}"></td>
								<td>
								<div class="form-group form-check">
								  <label class="form-check-label">
									<input class="form-check-input" type="checkbox" name="remember"> $500/month<br>(additional)
								  </label>
								</div>
								</td>
								<td>
								<div class="form-group form-check">
								  <label class="form-check-label">
									<input class="form-check-input" type="checkbox" name="remember"> $500/month<br>(additional)
								  </label>
								</div>
								</td>
							  </tr>
							  
							 
							</tbody>
						  </table>
					  </div>
					  <div class="row">
					  <div class="col-md-6 col-lg-6 col-sm-12"><p class="adv">*Advertising subscription rates listed are monthly, and prepaid quaterly.</p></div>
					  <div class="col-md-6 col-lg-6 col-sm-12"><button form="submit_plan" type="submit" class="btn2">Subscribe to Basic for FREE</button></div>
					  </div>
					</div>
					<div data-plan_id="com.mp2r.executive" data-price="350" id="Executive" class="tab-pane"><br>
					  	<div class="table-responsive form-sec">
						 <table class="table">
						
							<tbody>
							   <tr>
								<td>Real-time Patient Resource Directory</td>
								<td><img src="{{ asset('assets/mp2r/images/ic_feature-available-close.png')}}"></td>
								<td><img src="{{ asset('assets/mp2r/images/ic_feature-available-close.png')}}"></td>
								<td><img src="{{ asset('assets/mp2r/images/ic_feature-available-open.png')}}"></td>
							  </tr>
							  
							   <tr>
								<td>Area Counsellor List</td>
								<td><img src="{{ asset('assets/mp2r/images/ic_feature-available-close.png')}}"></td>
								<td><img src="{{ asset('assets/mp2r/images/ic_feature-available-close.png')}}"></td>
								<td><img src="{{ asset('assets/mp2r/images/ic_feature-available-open.png')}}"></td>
							  </tr>
							  
							   <tr>
								<td>Area Peer Support List</td>
								<td><img src="{{ asset('assets/mp2r/images/ic_feature-available-close.png')}}"></td>
								<td><img src="{{ asset('assets/mp2r/images/ic_feature-available-close.png')}}"></td>
								<td><img src="{{ asset('assets/mp2r/images/ic_feature-available-open.png')}}"></td>
							  </tr>
							  
							   <tr>
								<td>Area MAT Providers List</td>
								<td><img src="{{ asset('assets/mp2r/images/ic_feature-available-close.png')}}"></td>
								<td><img src="{{ asset('assets/mp2r/images/ic_feature-available-close.png')}}"></td>
								<td><img src="{{ asset('assets/mp2r/images/ic_feature-available-open.png')}}"></td>
							  </tr>
							  
							   <tr>
								<td>Unlimited Instant Messaging</td>
								<td><img src="{{ asset('assets/mp2r/images/ic_feature-available-close.png')}}"></td>
								<td><img src="{{ asset('assets/mp2r/images/ic_feature-available-close.png')}}"></td>
								<td><img src="{{ asset('assets/mp2r/images/ic_feature-available-open.png')}}"></td>
							  </tr>
							  
							   <tr>
								<td>Service Provider Profile</td>
								<td><img src="{{ asset('assets/mp2r/images/ic_feature-available-close.png')}}"></td>
								<td><img src="{{ asset('assets/mp2r/images/ic_feature-available-close.png')}}"></td>
								<td><img src="{{ asset('assets/mp2r/images/ic_feature-available-open.png')}}"></td>
							  </tr>
							  
							   <tr>
								<td>Access to On-demand Video Conferencing</td>
								<td><img src="{{ asset('assets/mp2r/images/ic_feature-notavailable-close.png')}}"></td>
								<td><img src="{{ asset('assets/mp2r/images/ic_feature-available-close.png')}}"></td>
								<td><img src="{{ asset('assets/mp2r/images/ic_feature-available-open.png')}}"></td>
							  </tr>
							  
							   <tr>
								<td>Geo-targated Banner Ad Rotation</td>
								<td><img src="{{ asset('assets/mp2r/images/ic_feature-notavailable-close.png')}}"></td>
								<td><img src="{{ asset('assets/mp2r/images/ic_feature-available-close.png')}}"></td>
								<td><img src="{{ asset('assets/mp2r/images/ic_feature-available-open.png')}}"></td>
							  </tr>
							  
							  <tr>
								<td>Listing in Active Directory with open scheduling</td>
								<td><img src="{{ asset('assets/mp2r/images/ic_feature-notavailable-close.png')}}"></td>
								<td class="local-region">Local region<br>(upto 10 zip codes)</td>
								<td class="local-region opacity-high">3 State Wide</td>
							  </tr>
							  
							  <tr>
								<td>Emphasized “Bold” Listing</td>
								<td><img src="{{ asset('assets/mp2r/images/ic_feature-notavailable-close.png')}}"></td>
								<td><img src="{{ asset('assets/mp2r/images/ic_feature-notavailable-close.png')}}"></td>
								<td><img src="{{ asset('assets/mp2r/images/ic_feature-available-open.png')}}"></td>
							  </tr>
							  
							  <tr>
								<td>Unlimited Real-time Insuarance Eligibility Verification</td>
								<td><img src="{{ asset('assets/mp2r/images/ic_feature-notavailable-close.png')}}"></td>
								<td>
								<div class="form-group form-check">
								  <label class="form-check-label">
									<input class="form-check-input" type="checkbox" name="remember"> $25/month<br>(additional)
								  </label>
								</div>
								</td>
								<td><img src="{{ asset('assets/mp2r/images/ic_feature-available-open.png')}}"></td>
							  </tr>
							  
							  <tr>
								<td>Group Practice Button Association</td>
								
								<td><img src="{{ asset('assets/mp2r/images/ic_feature-notavailable-close.png')}}"></td>
								<td>
								<div class="form-group form-check">
								  <label class="form-check-label">
									<input class="form-check-input" type="checkbox" name="remember"> $500/month<br>(additional)
								  </label>
								</div>
								</td>
								<td>
								<div class="form-group form-check">
								  <label class="form-check-label">
									<input class="form-check-input" data-plan_id="com.mp2r.additional.group" id="group-exe" data-price="500" type="checkbox" name="remember"> $500/month<br>(additional)
								  </label>
								</div>
								</td>
							  </tr>
							  
							 
							</tbody>
						  </table>
					  </div>
					  <div class="row">
					  <div class="col-md-6 col-lg-6 col-sm-12"><p class="adv">*Advertising subscription rates listed are monthly, and prepaid quaterly.</p></div>
					  <div class="col-md-6 col-lg-6 col-sm-12">
					  	<button type="submit" form="submit_plan" class="btn2">Subscribe to Executive for $
					  		<span id="grand_total_exe"></span>
					  	</button>
					  </div>
					  </div>
					</div>
				  </div>
			</div>
			<div class="payment_form" style="display: none;">
				@php
				    $months = array(1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr', 5 => 'May', 6 => 'Jun', 7 => 'Jul', 8 => 'Aug', 9 => 'Sep', 10 => 'Oct', 11 => 'Nov', 12 => 'Dec');
				@endphp
				<div class="card col-md-12 ">
                <div class="card-header">
                    <div class="row">
                        <h3 class="text-xs-center">Payment Details</h3>
                        <img class="img-fluid cc-img" src="http://www.prepbootstrap.com/Content/images/shared/misc/creditcardicons.png">
                    </div>
                </div>
                <div class="card-block">
                    <form id="submit_plan2">
					<input type="hidden" class="plan_id" name="plan_id">
					<input type="hidden" class="total_price" name="total_price">
                        <div class="row">
                            <div class="col-md-6 mb-3">
				                <label for="cc_number" id="plan_chase_btn">Total Payment</label>
			              </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
				                <label for="cc_number">Credit card number</label>
				                <input type="text" name="cc_number" class="form-control" id="cc_number" placeholder="card number" required="">
				                <div class="invalid-feedback cc_number">
				                  Credit card number is required
				                </div>
			              </div>
                        </div>
                        <div class="row">
			              <div class="col-md-3 mb-3">
			                <label for="expiration-month">Exp. Month</label>
			                <select class="form-control" id="expiration-month" name="expiration_month" required>
                                @foreach($months as $k=>$v)
                                    <option value="{{ $k }}" {{ old('expiration_month') == $k ? 'selected' : '' }}>{{ $v }}</option>                                                        
                                @endforeach
                            </select>
                             <div class="invalid-feedback expiration_month">
			                  Exp. Month Required
			                </div>  
			              </div>
			              <div class="col-md-3 mb-3">
			                <label for="expiration-year">Exp. Year</label>
			                 <select class="form-control" id="expiration-year" name="expiration_year" required>
			                 	@for($i = date('Y'); $i <= (date('Y') + 15); $i++)
                                <option value="{{ $i }}">{{ $i }}</option>            
                                @endfor
                            </select>
                            <div class="invalid-feedback expiration_year">
			                  Security code required
			                </div>
			              </div>
			              <div class="col-md-3 mb-3">
			                <label for="cvv">CVV</label>
			                <input  type="number" name="cvv" class="form-control" id="cvv" placeholder="" required="">
			                <div class="invalid-feedback cvv">
			                  Security code required
			                </div>
			              </div>
			            </div>
                        <div class="row">
                           <div class="col-md-6 mb-3">
				                <label for="cc-name">Name on card</label>
				                <input type="text" name="name" class="form-control" id="cc-name" placeholder="" required="">
				                <small class="text-muted">Full name as displayed on card</small>
				                <div class="invalid-feedback name">
				                  Name on card is required
				                </div>
				              </div>
                        </div>
                    </form>
                </div>
               <!--  <div class="card-footer">
                    <div class="row">
                        <div class="col-xs-12">
                            <button class="btn btn-warning btn-lg btn-block" id="plan_chase_btn">Process Payment</button>
                        </div>
                    </div>
                </div> -->
            </div>
			</div>
			
		</div>
	</div>
</div>

<section class="footer flex-end ">
			<div class="container">
			
			<div class="row">
			<div class="col-md-12">
				<div class="row align-items-center">
					<div class="col-md-6 col-sm-6 col-lg-6">
						<a href="javascript:void(0)" id="submit_plan_back" class="back-btn"><img src="{{ asset('assets/mp2r/images/ic_back.png')}}">Back
						</a>
						<button id="btn_text" form="submit_plan" type="submit" class="btn-next">Next
						</button>
					</div>
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