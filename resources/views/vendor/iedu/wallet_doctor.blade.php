@extends('vendor.iedu.layouts.index', ['title' => 'Wallet'])
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

                        <div class="balance-box bg-them border-0 mb-lg-5 mb-4 d-flex justify-content-between align-items-center">
                           <div class="balance-left">
                                <h6>Available Balance</h6>
                                <p>{{$currency}} @if($balance){{$balance}} @else {{0}} @endif</p>
                            </div>
                            <div class="balance-right">
                                <a class="default-btn radius-btn pay-btn" href="{{ url('service_provider/bank-accounts')}}"><span>Payout</span></a>
                            </div>
                        </div>

                        <h4 class="text-uppercase">Transaction History</h4>

                        <div class="transaction-box bg-them border-0">
                        @if(isset($payments))
                        <table class="transaction_history text_16">
                            <tbody>
                               
                                @foreach($payments as $payment)
                                <tr>
                                    <td>
                                        <label class="d-block m-0">{{ date('M Y', strtotime($payment->created_at))  }}</label>
                                        <span>{{ date('g:i a', strtotime($payment->created_at)) }}</span>
                                    </td>
                                    @if ( $payment->type  == 'withdrawal')
                                    <td>Paid to {{ $payment->from->name }}</td>
                                    <td>
                                         - {{$currency}} {{ $payment->amount }}
                                    </td>
                                    @endif
                                    @if ( $payment->type  == 'add_money')
                                    <td> Added to wallet </td>
                                    <td>
                                   
                                            + {{$currency}} {{ $payment->amount }}
                                    </td>
                                     @endif
                                    @if( $payment->type  == 'deposit' ||  $payment->type  == 'refund')
                                    <td>Received From {{ $payment->from->name }}</td>
                                    <td>
                                         + {{$currency}} {{ $payment->amount }}
                                    </td>
                                    @endif
                                        
                                   
                                </tr>
                                @endforeach
                              
                               
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