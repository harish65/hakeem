@extends('vendor.care_connect_live.layouts.dashboard', ['title' => 'Doctor'])
@section('content')
<div class="offset-top"></div>
  <!-- Wallet Section -->
  <section class="Wallet-content py-lg-5 mb-lg-5">
        <div class="container">
            <div class="row mb-lg-5 mb-4">
                <div class="col-12">
                    <h1>Wallet</h1>
                </div>
            </div>

            @if(Config('client_connected') && Config::get('client_data')->domain_name == 'iedu')
                @php $currency = 'AED';  @endphp
            @else
                @php $currency = '₹'; @endphp
            @endif

            <div class="row">
                <div class="col-lg-8 pr-lg-4">
                    <div class="pr-lg-2">
                    <form method="post" action="{{url('service_provider/payouts')}}">
                        <div class="balance-box bg-them border-0 mb-lg-5 mb-4 d-flex justify-content-between align-items-center">
                           <div class="balance-left">
                               @php $balance = Auth::user()->wallet->balance; @endphp
                                <h6>Available Balance</h6>
                                <p>{{$currency}} @if($balance){{$balance}} @else {{0}} @endif</p>
                            </div>
                            @if($balance)
                            <div class="balance-right">
                                <input class="default-btn radius-btn" type="submit" name="submit" value="Payout" />
                                <!-- <a class="default-btn radius-btn pay-btn" href="#"><span>Payout</span></a> -->
                            </div>
                            @endif
                        </div>
                        <input type="hidden" name="amount" value="{{ $balance }}" />
                        @if(sizeOf($bank_accounts)> 0)
                            @foreach($bank_accounts as $bankacc)
                            <div class="bg-them border-0 bankdetails" >
                                <div class="balance-left">
                                <input type="hidden" name="bank_id" value="{{ $bankacc->id }}" />
                                    <h4>Here is Your Bank Details</h4>
                                    <p class="holder_name" >{{$bankacc->holder_name}}</p>
                                    <p class="bank_name" >{{$bankacc->bank_name}}</p><span class="acc_no" >{{$bankacc->account_number}}</span>
                                </div>
                                <div class="balance-right">
                                    <a class="editbank" data-id="{{$bankacc->id}}" href="#">Edit</a>
                                </div>
                            </div>
                    </form>
                            <!-- Edit bank detail model-->
                            <div class="modal fade" id="edi_bank_detail_model" tabindex="-1">
                                <div class="modal-dialog modal-md modal-dialog-center">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">
                                        
                                            </h5>
                                            <img src="{{asset('assets/care_connect_live/images/unnamed.jpg')}}" height="150px" width="150px">
                                        
                                        </div>
                                        <div class="modal-body">
                                            <h5 id="booking_message" class="text-center"></h5>
                                        </div>
                                        <div class="modal-footer">
                                        
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        @else
                <div class ="add_account_detail bg-light border-0 justify-content-between align-items-center">
                    <h4> Add Bank Detail</h4> 
                    <hr>
                    @if(session('status.success'))
                        <div class="alert alert-outline alert-success custom_alert">
                            {{ session('status.success') }}
                        </div>
                    @endif

                    @if(session('status.error'))
                        <div class="alert alert-outline alert-danger custom_alert">
                            {{ session('status.error') }}
                        </div>
                    @endif
                    <form action="{{url('service_provider/add-bank')}}" method="post">
                        <div class="row">
                                
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="">Account Number</label>
                                    <input class="form-control" name="account_number" type="text" required placeholder="" value=""  required />
                                    @if ($errors->has('account_number'))
                                        <span class="help-block text-danger">
                                            {{ $errors->first('account_number') }}
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="">Account Holder Name</label>
                                    <input class="form-control" name="account_holder_name" type="text" required placeholder="" value=""  required />
                                    @if ($errors->has('holder_name'))
                                        <span class="help-block text-danger">
                                            {{ $errors->first('holder_name') }}
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="">Bank Name</label>
                                    <input class="form-control" name="bank_name" type="text" required placeholder="" value=""  required />
                                    @if ($errors->has('bank_name'))
                                                <span class="help-block text-danger">
                                                    {{ $errors->first('bank_name') }}
                                                </span>
                                            @endif
                                </div>
                            </div>
                            

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="">IFSC Code</label>
                                    <input class="form-control" name="ifc_code" type="text" required placeholder="" value=""  required />
                                    @if ($errors->has('ifc_code'))
                                        <span class="help-block text-danger">
                                            {{ $errors->first('title') }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <input type="hidden" name="account_holder_type" value="individual" />
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="">Country</label>
                                    <select class="form-control" name="country" required>
                                    <option>Select Country</option>
                                        <option value="IN" >IN</option>
                                        <option value="US" >US</option>
                                    </select>
                                    @if ($errors->has('country'))
                                        <span class="help-block text-danger">
                                            {{ $errors->first('country') }}
                                        </span>
                                    @endif
                                       
                                </div>
                            </div>
                            <div class="col-sm-6">
                            <div class="form-group">
                                    <label class="">Currency</label>
                                    <select class="form-control" name="currency" required>
                                        <option value="" >Select Currency</option>
                                        <option value="INR" >INR</option>
                                        <option value="USD" >USD</option>
                                    </select>
                                    @if ($errors->has('currency'))
                                        <span class="help-block text-danger">
                                            {{ $errors->first('currency') }}
                                        </span>
                                    @endif
                                       
                            </div>
                            </div>
                            <div class="form-group col-sm-6">
                                <input class="default-btn radius-btn " type="submit" value="Submit" name="Submit" />
                            </div>
                            </div>

                                </div>
                    </div>
                </div>
                @endif
                </div>
            </div>
        </div>
    </section>
    <script>
        var _token = "{{ csrf_token() }}";
       
    </script>
  
@endsection