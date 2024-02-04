@extends('vendor.tele.layouts.dashboard', ['title' => 'Doctor'])
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

            <div class="row">
                <div class="col-lg-8 pr-lg-4">
                    <div class="pr-lg-2">
                        <div class="balance-box bg-them border-0 mb-lg-5 mb-4 d-flex justify-content-between align-items-center">
                           <div class="balance-left">
                               @php
                               $balance = Auth::user()->wallet_amount->balance ?? 0;

                               @endphp
                                <h6>Available Balance</h6>
                                <p>₹ {{$balance ?? 0}} </p>
                            </div>
                            @if($balance)
                            <div class="balance-right">
                                <form method="post" action="{{url('service_provider/payouts')}}" id="balance_payout">
                                    @csrf
                                    <input type="hidden" name="amount" value="{{ $balance??0 }}" />
                                    <input type="hidden" name="bank_id" value="{{ $bank_accounts[0]->id??0 }}" />
                                    <input class="default-btn radius-btn" type="button" name="submit" value="Payout" data-balance = "{{$balance??0}}" data-min_balance="{{config('constants.min_payout_balance')}}" data-bank_id="{{ $bank_accounts[0]->id??0 }}" onclick="payout(this)" />
                                    <!-- <a class="default-btn radius-btn pay-btn" href="#"><span>Payout</span></a> -->
                                </form>
                            </div>
                            @endif
                        </div>
                        @if(sizeOf($bank_accounts)> 0)
                            @foreach($bank_accounts as $bankacc)
                            <div class="bg-them border-0 bankdetails show_bank_detail_{{$bankacc->id}}">
                                <div class="balance-left">
                                <input type="hidden" name="bank_id" value="{{ $bankacc->id }}" />
                                    <h4>Here is Your Bank Details</h4>
                                    <p class="holder_name" >{{$bankacc->name}}</p>
                                    <p class="bank_name" >{{$bankacc->bank_name}}</p><span class="acc_no" >{{$bankacc->account_number}}</span>
                                </div>
                                <div class="balance-right">
                                    <a class="editbank" data-id="{{$bankacc->id}}" href="#" onclick="show_edit_bank(this)">Edit</a>
                                </div>
                            </div>
                            <!-- Edit bank detail model-->
                            <div class="modal fade" id="edi_bank_detail_model" tabindex="-1">
                                <div class="modal-dialog modal-md modal-dialog-center">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">

                                            </h5>
                                            <img src="{{asset('assetss/images/unnamed.jpg')}}" height="150px" width="150px">

                                        </div>
                                        <div class="modal-body">
                                            <h5 id="booking_message" class="text-center"></h5>
                                        </div>
                                        <div class="modal-footer">

                                        </div>
                                    </div>
                                </div>
                            </div>
                    <div class ="add_account_detail bg-light border-0 justify-content-between align-items-center edit_bank_detail_{{$bankacc->id}}" style="display: none;">
                    <h4> Edit Bank Detail</h4>
                    <hr>
                    @if(session('status.success'))
                        <div class="alert alert-outline alert-success custom_alert">
                            {{ session('status.success') }}
                        </div>
                    @elseif(session('status.error'))
                        <div class="alert alert-outline alert-danger custom_alert">
                            {{ session('status.error') }}
                        </div>
                    @endif
                    <form action="{{url('service_provider/add-bank')}}" method="post">
                        @csrf
                        <div class="row">

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label >Account Number</label>
                                    <input class="form-control" name="account_number" type="text" required="" value="{{$bankacc->account_number}}" />
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
                                    <input class="form-control" name="account_holder_name" type="text"  required="" value="{{$bankacc->name}}" />
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
                                    <input class="form-control" name="bank_name" type="text" required="" value="{{$bankacc->bank_name}}" />
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
                                    <input class="form-control" name="ifc_code" type="text" required="" value="{{$bankacc->ifc_code}}" />
                                    @if ($errors->has('ifc_code'))
                                        <span class="help-block text-danger">
                                            {{ $errors->first('title') }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <input type="hidden" name="account_holder_type" value="individual" />
                            <input type="hidden" name="bank_id" value="{{$bankacc->id}}" />
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Country</label>
                                    <select class="form-control" name="country" required="">
                                    <option>Select Country</option>
                                        <option value="IN" {{$bankacc->country == "IN" ? 'selected' : ''}}>IN</option>
                                        <option value="US" {{$bankacc->country == "US" ? 'selected' : ''}}>US</option>
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
                                    <select class="form-control" name="currency" required="">
                                        <option value="" >Select Currency</option>
                                        <option value="INR" {{$bankacc->currency == "INR" ? 'selected' : ''}}>INR</option>
                                        <option value="USD" {{$bankacc->currency == "USD" ? 'selected' : ''}}>USD</option>
                                    </select>
                                    @if ($errors->has('currency'))
                                        <span class="help-block text-danger">
                                            {{ $errors->first('currency') }}
                                        </span>
                                    @endif

                            </div>
                            </div>
                            <div class="form-group col-sm-6">
                                <button type="submit" class="btn btn-primary default-btn radius-btn">Update</button>
                            </div>
                            </div>
                        </form>
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
                    @elseif(session('status.error'))
                        <div class="alert alert-outline alert-danger custom_alert">
                            {{ session('status.error') }}
                        </div>
                    @endif
                    <form action="{{url('service_provider/add-bank')}}" method="post">
                        @csrf
                        <div class="row">

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label >Account Number</label>
                                    <input class="form-control" name="account_number" type="text" required="" />
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
                                    <input class="form-control" name="account_holder_name" type="text"  required="" />
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
                                    <input class="form-control" name="bank_name" type="text" required="" />
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
                                    <input class="form-control" name="ifc_code" type="text" required="" />
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
                                    <label>Country</label>
                                    <select class="form-control" name="country" required="">
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
                                    <select class="form-control" name="currency" required="">
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
                                <button type="submit" class="btn btn-primary default-btn radius-btn">Create</button>
                            </div>
                            </div>
                        </form>
                        </div>
                        @endif
                    </div>
                </div>

                </div>
            </div>
        </div>
    </section>
    <script>
        var _token = "{{ csrf_token() }}";
        $('.editbank').click(function(e){
            e.preventDefault();
            var bankid = $(this).attr('data-id');

            // $.post("{{ url('/service_provider/add_bank') }}", { _token: "{{ csrf_token() }}", bank_id: bankid  }).done(function(data){
            //         console.log(data);
            // });
        });
        function show_edit_bank(obj)
        {
            var bankid = $(obj).data('id');
            $('.edit_bank_detail_'+bankid).css('display','block');
            $('.show_bank_detail_'+bankid).css('display','none');

        }
        function payout(obj)
        {
            var balance = $(obj).data('balance');
            var min_balance = $(obj).data('min_balance');
            var bank_id = $(obj).data('bank_id');
            var token = '{{ csrf_token() }}';
            if(balance < min_balance)
            {
                Swal.fire(
                    'Alert',
                    'The amount must be at least ₹'+min_balance,
                    'warning'
                );
            }else if(bank_id == 0 || bank_id == "0")
            {
                    Swal.fire('Alert','Please add bank before payout','warning');
            }else{
                $.ajax({
                    type:'POST',
                    url:"{{url('service_provider/payouts')}}",
                    data:{'_token':token,'amount':balance,'bank_id':bank_id},
                    success:function(data){
                        if(data.status == 'success')
                        {
                            Swal.fire('Success',data.message,'success').then((result)=>{
                                window.location.reload();
                            });
                        }else{
                            Swal.fire('Error',data.message,'error').then((result)=>{
                                window.location.reload();
                            });
                        }
                   }
                });
            }
        }

    </script>

