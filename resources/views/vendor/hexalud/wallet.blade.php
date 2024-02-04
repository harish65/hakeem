@extends('vendor.hexalud.layouts.dashboard', ['title' => 'Patient'])
@section('content')

<style>
    .error{
        color: #ed4337;
    }
</style>

 <div class="offset-top"></div>

    <!-- Wallet Section -->
    <section class="Wallet-content py-lg-5 mb-lg-5">
        <div class="container">
            <div class="row mb-lg-5 mb-4">
                <div class="col-12">
                    <h1 style="color: #000">Wallet</h1>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8 pr-lg-4">
                    <div class="pr-lg-2">

                    <div class="balance-box mb-lg-5 mb-4">
                        <h6>Available Balance</h6>
                        <p>$ @if($balance){{$balance}} @else {{0}} @endif</p>
                    </div>

                    <h4 class="text-uppercase">Transaction Historys</h4>

                    <div class="transaction-box doctor_box">
                        @if(isset($payments))
                        <table class="transaction_history text_16">
                            <tbody>

                                @forelse($payments as $payment)
                                <tr>
                                    <td>
                                        <label class="d-block m-0">{{ date('M d, y', strtotime($payment->created_at))  }}</label>
                                        <span>{{ date('g:i a', strtotime($payment->created_at)) }}</span>
                                    </td>
                                    @if ( $payment->type  == 'withdrawal')
                                        <td>Paid to {{ $payment->from->name }}</td>
                                        <td>
                                             - $ {{ $payment->amount }}
                                        </td>
                                    @elseif ( $payment->type  == 'add_money')
                                        <td> Added to wallet </td>
                                        <td>

                                                + $ {{ $payment->amount }}
                                        </td>
                                    @elseif( $payment->type  == 'deposit' ||  $payment->type  == 'refund')
                                        <td>Received From {{ $payment->from->name }}</td>
                                        <td>
                                             + $ {{ $payment->amount }}
                                        </td>
                                    @elseif($payment->type == 'asked_question')
                                        <td>Asked a question</td>
                                        <td>
                                             - $ {{ $payment->amount }}
                                        </td>
                                    @endif


                                </tr>
                                @empty
                                    <tr><td style="text-align:left">No transaction history</td></tr>
                                @endforelse


                            </tbody>
                        </table>
                        <div class="row  pt-lg-4">
                            <div class="col-sm-12 text-center">
                                {{ $payments->links() }}
                            </div>
                        </div>
                        @else
                        <div class="row">
                                <div class="appointment-inner">
                                    <img src="{{asset('assets/healtcaremydoctor/images/n-transection.png')}}" />
                                    <div class="text">
                                    <h4 class="mb-4">No Transaction</h4>
                                    <p>You do not have any transaction till.</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                </div>

            </div>
                <div class="col-lg-4 pl-lg-0">
                    <div class="wallat-right doctor_box">
                        <h6>Add Money to wallet</h6>
                        <hr class="mb-4">
                        <input class="form-control amtInput"  type="number" placeholder="Enter amount" name="amount" min="1" id="" required>
                        <div class="add-money">
                            <a class="amount" href="#" data-val="500">+500</a>
                            <a class="amount" href="#" data-val="1000">+1000</a>
                            <a class="amount" href="#" data-val="1500">+1500</a>
                        </div>
                        <button type="type" id="add_money" class="default-btn radius-btn w-100"><span>Add</span></button>

                    </div>
                </div>
            </div>
        </div>
    </section>

    {{--  <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        var _order_id = null;
        var _amount = null;
        var _name = "{{ Auth::user()->name }}";
        var _email = "{{ Auth::user()->email }}";
        var _contact = "{{ Auth::user()->country_code }}{{ Auth::user()->phone }}";

        var _order_url = "{{ url('/user/wallet_order_id') }}";
        var _wallet_url = "{{ url('/user/wallet') }}";
        var _order_token = "{{ csrf_token() }}";

        // document.getElementById('add_money').onclick = function(e){
        //     rzp1.open();
        //     e.preventDefault();
        // }
    </script>  --}}
        {{--  <div class="modal fade bd-example-modal-lg" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                    <div class="row">
                        <div class="col-12 mt-4">
                            <div class="card p-3">
                                <p class="mb-0 fw-bold h4">Payment Methods</p>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card p-3">
                                <div class="card-body border p-0">
                                    <p>
                                        <a class="btn btn-primary p-2 w-100 h-100 d-flex align-items-center justify-content-between"
                                            data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="true"
                                            aria-controls="collapseExample">
                                            <span class="fw-bold">Credit Card</span>
                                            <span class="">
                                                <span class="fab fa-cc-amex"></span>
                                                <span class="fab fa-cc-mastercard"></span>
                                                <span class="fab fa-cc-discover"></span>
                                            </span>
                                        </a>
                                    </p>
                                    <div class="collapse show p-3 pt-0" id="collapseExample">
                                        <div class="row">

                                            <div class="col-lg-12">
                                                <form action="" class="form" method="POST">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="form__div">
                                                                <input type="text" class="form-control" placeholder=" ">
                                                                <label for="" class="form__label">Card Number</label>
                                                            </div>
                                                        </div>

                                                        <div class="col-6">
                                                            <div class="form__div">
                                                                <input type="text" class="form-control" placeholder=" ">
                                                                <label for="" class="form__label">MM / yy</label>
                                                            </div>
                                                        </div>

                                                        <div class="col-6">
                                                            <div class="form__div">
                                                                <input type="password" class="form-control" placeholder=" ">
                                                                <label for="" class="form__label">cvv code</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form__div">
                                                                <input type="text" class="form-control" placeholder=" ">
                                                                <label for="" class="form__label">name on the card</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="btn btn-primary w-100" type="submit">Sumbit</div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="btn btn-primary payment">
                                Make Payment
                            </div>
                        </div>
                    </div>
            </div>
        </div>  --}}
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Payment Details</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                    <form role="form" id="payment-form" method="POST" action="javascript:void(0);">
                        <input type="hidden" name="amount" id="paid_amount">
                        <div class="form-group">
                            <label for="cardNumber">CARD NUMBER</label>
                            <div class="input-group">
                                <input
                                    type="tel"
                                    class="form-control"
                                    name="cardNumber"
                                    placeholder="Valid Card Number"
                                    autocomplete="cc-number"
                                    required autofocus
                                />
                                <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-7 col-md-7">
                                <div class="form-group">
                                    <label for="cardExpiry"><span class="hidden-xs">EXPIRATION</span>(<span class="visible-xs-inline">EXP</span> DATE)</label>
                                    <input
                                        type="tel"
                                        class="form-control"
                                        name="cardExpiry"
                                        placeholder="MM / YY"
                                        autocomplete="cc-exp"
                                        required
                                    />
                                </div>
                            </div>
                            <div class="col-xs-5 col-md-5 pull-right">
                                <div class="form-group">
                                    <label for="cardCVC">CVC CODE</label>
                                    <input
                                        type="tel"
                                        class="form-control"
                                        name="cardCVC"
                                        placeholder="CVC"
                                        autocomplete="cc-csc"
                                        required
                                    />
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <button class="subscribe btn btn-success btn-lg btn-block" type="button">Pay</button>
                        </div>
                    </form>
                </div>
                </div>
              </div>
            </div>





@endsection
