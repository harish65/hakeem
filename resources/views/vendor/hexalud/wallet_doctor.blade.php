@extends('vendor.hexalud.layouts.dashboard', ['title' => 'Doctor'])
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
                                <h6>Available Balance</h6>
                                <p>$ @if($balance){{$balance}} @else {{0}} @endif</p>
                            </div>
                            <div class="balance-right">
                                <a class="default-btn radius-btn pay-btn" href="{{ url('service_provider/bank-accounts')}}"><span>Payout</span></a>
                            </div>
                        </div>

                        <h4 class="text-uppercase">Transaction Historys</h4>

                        <div class="transaction-box bg-them border-0">
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
                                         - {{ ($payment->amount>0)?'$ '.$payment->amount:$payment->amount }}
                                    </td>
                                    @endif
                                    @if ( $payment->type  == 'add_money')
                                    <td> Added to wallet </td>
                                    <td>

                                            + {{ ($payment->amount>0)?'$ '.$payment->amount:$payment->amount }}
                                    </td>
                                     @endif
                                    @if( $payment->type  == 'deposit' ||  $payment->type  == 'refund')
                                    <td>Received From {{ $payment->from->name }}</td>
                                    <td>
                                         + {{ ($payment->amount>0)?'$ '.$payment->amount:$payment->amount }}
                                    </td>
                                    @endif
                                    @if( $payment->type  == 'payouts')
                                    <td>Money sent to bank account ({{$payment->status}})</td>
                                    <td>
                                         - {{ ($payment->amount>0)?'$ '.$payment->amount:$payment->amount }}
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

                            </div>
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

    </script>

@endsection
