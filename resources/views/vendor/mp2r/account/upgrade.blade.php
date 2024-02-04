@extends('vendor.mp2r.layouts.index', ['title' => 'Upgrade Plan','header_after_login'=>true])
@section('css')
@endsection
@section('content')
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
					@include('vendor.mp2r.layouts.spmenu',['tab' =>'subscription'])
				</div>
			</div>
			<div class="col-lg-8 col-md-8 col-sm-8">
						<section class="right-side mt-5">
							<div class="row align-items-center">
								<div class="col-md-12 col-sm-12">
								<h4 class="appointment">Upgrade Plans</h4>
								</div>
							</div>
						</section>
						<form id="submit_plan">
					  		<input type="hidden" id="plan_id" name="plan_id">
					  		<input type="hidden" id="upgrade" name="upgrade" value="yes">
					  		<input type="hidden" id="total_price" name="total_price">
					  	</form>
						<!-- tabs start -->
					<section class="premium-tab plan-detail">
						<div class="tabs-width">
						 <ul class="nav nav-pills nav-justified align-items-center" role="tablist">
							<li class="nav-item">
							  <a class="nav-link {{ ($user->current_plan==null || $user->current_plan->plan_attribute==$user->basic->plan_id)?'active':'' }}" data-toggle="pill" id="Basic-pre" href="#Basic">Basic<br> Free</a>
							</li>
							<li class="nav-item">
							  <a class="nav-link {{ ($user->current_plan && $user->current_plan->plan_attribute==$user->premium->plan_id)?'active':'' }}" data-toggle="pill" id="Premium-pre" href="#Premium">Premium <br>{{ '$'.$user->premium->price }}*</a>
							</li>
							<li class="nav-item">
							  <a class="nav-link {{ ($user->current_plan && $user->current_plan->plan_attribute==$user->executive->plan_id)?'active':'' }}" data-toggle="pill" id="Executive-pre" href="#Executive">Executive <br>{{ '$'.$user->executive->price }}*</a>
							</li>
						  </ul>
						</div>
						<p class="advertising">*Advertising subscription rates listed are monthly, and prepaid quaterly.</p>
						  <!-- Tab panes -->
						<div class="col-md-7 mx-auto tabs-bg">
							<div class="tab-content">
								<div data-plan_id="{{ $user->premium->plan_id }}" data-price="{{ $user->premium->price }}" id="Premium" class=" tab-pane {{ ($user->current_plan && $user->current_plan->plan_attribute==$user->premium->plan_id)?'active':'' }}">
								  <h3 class="premium-head">Premium - {{ '$'.$user->premium->price }}*</h3>
								  <p class="premium-pera">(End Users-Service Providers)</p>
								  <ul class=" pl-5 p-3 real-time-list">
									  <li>
									  	<img src="{{ asset('assets/mp2r/images/ic_feature-available-open.png') }}" class="img-fluid pr-2">
									  	<span class="real-time-text"> Real-time Patient Resource Directory
									  	</span>
									  </li>
									  <li>
									  	<img src="{{ asset('assets/mp2r/images/ic_feature-available-open.png') }}" class="img-fluid pr-2">
									  	<span class="real-time-text"> Area Counselor List</span>
									  </li>
									  <li>
									  	<img src="{{ asset('assets/mp2r/images/ic_feature-available-open.png') }}" class="img-fluid pr-2">
									  	<span class="real-time-text"> Area Peer Support List</span>
									  </li>
									  <li>
									  	<img src="{{ asset('assets/mp2r/images/ic_feature-available-open.png') }}" class="img-fluid pr-2">
									  	<span class="real-time-text"> Area MAT Providers List</span>
									  </li>
									  <li>
									  	<img src="{{ asset('assets/mp2r/images/ic_feature-available-open.png') }}" class="img-fluid pr-2">
									  	<span class="real-time-text"> Unlimited Instant Messaging</span>
									  </li>
									  <li>
									  	<img src="{{ asset('assets/mp2r/images/ic_feature-available-open.png') }}" class="img-fluid pr-2">
									  	<span class="real-time-text"> Service Provider Profile</span>
									  </li>
									  <li>
									  	<img src="{{ asset('assets/mp2r/images/ic_feature-available-open.png') }}" class="img-fluid pr-2">
									  	<span class="real-time-text"> Access to On-demand Video Conferencing</span>
									  </li>
									  <li>
									  	<img src="{{ asset('assets/mp2r/images/ic_feature-available-open.png') }}" class="img-fluid pr-2">
									  	<span class="real-time-text"> Geo-targated Banner Ad Rotation(Local region upto 10 zip codes)</span>
									  </li>
									  <li>
									  	<img src="{{ asset('assets/mp2r/images/ic_feature-notavailable-open.png') }}" class="img-fluid pr-2">
									  	<span class="real-time-text"> Emphasized “Bold” Listing</span>
									  </li>
								  </ul>
								  <div class="check-sec pl-4 p-2">
									  <form>
										 <div class="form-group">
											<div class="form-check">
											  <input class="form-check-input mr-2" data-plan_id="{{ $user->insurance->plan_id }}" id="insurance-pre" data-price="{{ $user->insurance->price }}" type="checkbox" name="insurance">
											  <label class="form-check-label pl-2" for="insurance-pre">
												{{ '$'.$user->insurance->price }} Additional, Unlimiteed Real-time Insuarance Eligibility Verification.
											  </label>
											</div>
										</div>
										
										<div class="form-group">
											<div class="form-check">
											  <input class="form-check-input mr-2" type="checkbox"  data-plan_id="{{ $user->group->plan_id }}" id="group-pre" data-price="{{ $user->group->price }}" name="group">
											  <label class="form-check-label pl-2" for="group-pre">
												{{ '$'.$user->group->price }} Additional, Group Practice Button Association.
											  </label>
											</div>
										</div>
									  </form>
								  </div>
								  @if($user->current_plan && $user->current_plan->plan_attribute=='com.mp2r.premium')
								  	<button type="submit" class="suscribe premium-head" disabled="">Subscription Expiring on 
								  		{{ \Carbon\Carbon::parse($user->current_plan->expired_on)->format('Y-m-d') }}
									  </button>
								  @else
									  <button type="submit" form="submit_plan" class="suscribe">Subscribe to Premium Package for $<span id="grand_total"></span>
									  </button>
								  @endif
								</div>
								<div data-plan_id="{{ $user->basic->plan_id }}" data-price="{{ $user->basic->price }}" id="Basic" class="tab-pane {{ ($user->current_plan==null || $user->current_plan->plan_attribute==$user->basic->plan_id)?'active':'' }}"><br>
								  <h3 class="premium-head">Basic - {{ '$'.$user->basic->price }}*</h3>
								  <p class="premium-pera">(End Users-Service Providers)</p>
								  <ul class=" pl-5 p-3 real-time-list">
									  <li>
									  	<img src="{{ asset('assets/mp2r/images/ic_feature-available-open.png') }}" class="img-fluid pr-2">
									  	<span class="real-time-text"> Real-time Patient Resource Directory
									  	</span>
									  </li>
									  <li>
									  	<img src="{{ asset('assets/mp2r/images/ic_feature-available-open.png') }}" class="img-fluid pr-2">
									  	<span class="real-time-text"> Area Counselor List</span>
									  </li>
									  <li>
									  	<img src="{{ asset('assets/mp2r/images/ic_feature-available-open.png') }}" class="img-fluid pr-2">
									  	<span class="real-time-text"> Area Peer Support List</span>
									  </li>
									  <li>
									  	<img src="{{ asset('assets/mp2r/images/ic_feature-available-open.png') }}" class="img-fluid pr-2">
									  	<span class="real-time-text"> Area MAT Providers List</span>
									  </li>
									  <li>
									  	<img src="{{ asset('assets/mp2r/images/ic_feature-available-open.png') }}" class="img-fluid pr-2">
									  	<span class="real-time-text"> Unlimited Instant Messaging</span>
									  </li>
									  <li>
									  	<img src="{{ asset('assets/mp2r/images/ic_feature-available-open.png') }}" class="img-fluid pr-2">
									  	<span class="real-time-text"> Service Provider Profile</span>
									  </li>
									  <li>
									  	<img src="{{ asset('assets/mp2r/images/ic_feature-notavailable-open.png') }}" class="img-fluid pr-2">
									  	<span class="real-time-text"> Access to On-demand Video Conferencing</span>
									  </li>
									  <li>
									  	<img src="{{ asset('assets/mp2r/images/ic_feature-notavailable-open.png') }}" class="img-fluid pr-2">
									  	<span class="real-time-text"> Geo-targated Banner Ad Rotation(Local region upto 10 zip codes)</span>
									  </li>
									  <li>
									  	<img src="{{ asset('assets/mp2r/images/ic_feature-notavailable-open.png') }}" class="img-fluid pr-2">
									  	<span class="real-time-text"> Emphasized “Bold” Listing</span>
									  </li>
								  </ul>
								  @if($user->current_plan && $user->current_plan->plan_attribute==$user->basic->plan_id)
								  	<button type="submit" class="suscribe premium-head" disabled="">Subscription Expiring on 
								  		{{ \Carbon\Carbon::parse($user->current_plan->expired_on)->format('Y-m-d') }}
									  </button>
								  @else
								  <button form="submit_plan" type="submit" class="suscribe">Subscribe to Basic Package Free
								  </button>
								  @endif
								</div>
								<div data-plan_id="{{ $user->executive->plan_id }}" data-price="{{ $user->executive->price }}" id="Executive" class=" tab-pane {{ ($user->current_plan && $user->current_plan->plan_attribute==$user->executive->plan_id)?'active':'' }}"><br>
								  <h3 class="premium-head">Executive - {{ '$'.$user->executive->price }}*</h3>
								  <p class="premium-pera">(End Users-Service Providers)</p>
								  
								  <ul class=" pl-5 p-3 real-time-list">
								  <li>
								  	<img src="{{ asset('assets/mp2r/images/ic_feature-available-open.png') }}" class="img-fluid pr-2">
								  	<span class="real-time-text"> Real-time Patient Resource Directory
								  	</span>
								  </li>
								  <li>
								  	<img src="{{ asset('assets/mp2r/images/ic_feature-available-open.png') }}" class="img-fluid pr-2">
								  	<span class="real-time-text"> Area Counselor List</span>
								  </li>
								  <li>
								  	<img src="{{ asset('assets/mp2r/images/ic_feature-available-open.png') }}" class="img-fluid pr-2">
								  	<span class="real-time-text"> Area Peer Support List</span>
								  </li>
								  <li>
								  	<img src="{{ asset('assets/mp2r/images/ic_feature-available-open.png') }}" class="img-fluid pr-2">
								  	<span class="real-time-text"> Real-time Patient Resource Directory
								  	</span>
								  </li>
								  <li>
								  	<img src="{{ asset('assets/mp2r/images/ic_feature-available-open.png') }}" class="img-fluid pr-2">
								  	<span class="real-time-text"> Area Counselor List</span>
								  </li>
								  <li>
								  	<img src="{{ asset('assets/mp2r/images/ic_feature-available-open.png') }}" class="img-fluid pr-2">
								  	<span class="real-time-text"> Area Peer Support List</span>
								  </li>
								  </ul>
								  <div class="check-sec pl-4 p-2">
									 <div class="form-group">
										<div class="form-check">
										  <input class="form-check-input mr-2" type="checkbox"  data-plan_id="{{ $user->group->plan_id }}" id="group-exe" data-price="{{ $user->group->price }}" name="group">
										  <label class="form-check-label pl-2" for="group-pre">
											${{ $user->group->price }} Additional, Group Practice Button Association.
										  </label>
										</div>
									</div>
								  </div>
								  @if($user->current_plan && $user->current_plan->plan_attribute==$user->executive->plan_id)
								  	<button type="submit" class="suscribe premium-head" disabled="">Subscription Expiring on 
								  		{{ \Carbon\Carbon::parse($user->current_plan->expired_on)->format('Y-m-d') }}
									  </button>
								  @else
								  <button type="submit" form="submit_plan" class="suscribe">Subscribe to Executive Package for $<span id="grand_total_exe"></span>
								  </button>
								  @endif
								</div>
							</div>
						</div>
					</section>
					<section class="payment_form" style="display: none;">
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
		                    <form id="upgradePlan">
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
		                  <div class="card-footer">
		                    <div class="row">
								<div class="col-md-12">
									<div class="row align-items-center">
										<div class="col-md-6 col-sm-6 col-lg-6">
											<a href="javascript:void(0)" id="submit_plan_back" class="back-btn"><img src="{{ asset('assets/mp2r/images/ic_back.png') }}">Back
											</a>
											<button value="upgrade" id="btn_text" form="upgradePlan" type="submit" class="btn-next">Submit
											</button>
										</div>
									</div>
								</div>
							</div>
		                </div>
		            </div>
				</section>
			</div>
		</div>
	</div>
</section>
@endsection
@section('script')
@endsection