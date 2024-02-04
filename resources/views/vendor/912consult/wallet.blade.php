@extends('vendor.912consult.layouts.dashboard', ['title' => 'Patient'])
@section('content')
 <!-- Offset Top -->
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

                    <div class="balance-box mb-lg-5 mb-4">
                        <h6>Available Balance</h6>
                        <p>₹ @if($balance){{$balance}} @else {{0}} @endif</p>
                    </div>

                    <h4 class="text-uppercase">Transaction History</h4>

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
                                             - ₹ {{ $payment->amount }}
                                        </td>
                                    @elseif ( $payment->type  == 'add_money')
                                        <td> Added to wallet </td>
                                        <td>

                                                + ₹ {{ $payment->amount }}
                                        </td>
                                    @elseif( $payment->type  == 'deposit' ||  $payment->type  == 'refund')
                                        <td>Received From {{ $payment->from->name }}</td>
                                        <td>
                                             + ₹ {{ $payment->amount }}
                                        </td>
                                    @elseif($payment->type == 'asked_question')
                                        <td>Asked a question</td>
                                        <td>
                                             - ₹ {{ $payment->amount }}
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
                                    <p>You don't have any transaction till.</p>
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

    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
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
    </script>
@endsection
