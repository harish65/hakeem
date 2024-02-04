@extends('vendor.iedu.layouts.index', ['title' => 'Wallet Detail','show_footer'=>true])
@section('content')
<style>
  ul>li
  {
    list-style:none;
  }
  </style>
<!-- Bannar Section -->
<section class="choose-tutor header-height">
  <div class="container">

  <div class="row mb-lg-5 mb-4">
                <div class="col-12">
                    <h1>Wallet</h1>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8 pr-lg-4">
                    <div class="pr-lg-2">

                    @if(Config('client_connected') && Config::get('client_data')->domain_name == 'iedu')
        @php $currency = 'AED';  @endphp
    @else
        @php $currency = '₹'; @endphp
    @endif
                    <div class="balance-box mb-lg-5 mb-4">
                        <h6>Available Balance</h6>
                        <p>{{$currency}} @if($balance){{$balance}} @else {{0}} @endif</p>
                    </div>

                    <h4 class="text-uppercase">Transaction History</h4>

                    <div class="transaction-box doctor_box">
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
                                    <td> @if($payment->status=='failed') Failed to Add in wallet @else Add to wallet @endif</td>
                                    <td>

                                        @if($payment->status!='failed') + @endif {{$currency}} {{ $payment->amount }}
                                    </td>
                                     @endif
                                    @if( $payment->type  == 'deposit' ||  $payment->type  == 'refund')
                                    <td>Received From {{ $payment->from->name }}</td>
                                    <td>
                                        + {{$currency}} {{ $payment->amount }}
                                    </td>
                                    
                                    @endif
                                    <td>{{$payment->status ?? ''}}</td>


                                </tr>
                                @endforeach


                            </tbody>
                        </table>
                        <div class="row  pt-lg-4">
                            <div class="col-sm-12 text-center">
                                {{ $payments->links() }}
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
                        <div class="add-money" style="padding-top:20px;">
                            <a class="amount" href="#" data-val="500">+500</a>
                            <a class="amount" href="#" data-val="1000">+1000</a>
                            <a class="amount" href="#" data-val="1500">+1500</a>
                        </div>
                        <button type="type" id="add_money" class="btn mt-5 mb-3 full-width no-box-shaddow"><span>Add</span></button>
                    </div>
                </div>
            </div>
    </div>
  </div>
</section>
<script>
        var _order_id = null;
        var _amount = null;
        var _name = "{{ Auth::user()->name }}";
        var _email = "{{ Auth::user()->email }}";
        var _contact = "{{ Auth::user()->country_code }}{{ Auth::user()->phone }}";

        var _order_url = "{{ url('/user/wallet_order_id') }}";
        var _wallet_url = "{{ url('/user/wallet') }}";
        var _order_token = "{{ csrf_token() }}";


    </script>
    <script>
        $("#add_money").click(function(e){
          _amount = $("input[name=amount]").val();
          $.post(_wallet_url, { balance: _amount, _token: _order_token }).done(function(data){
              if(data.status == "success"){
                  window.location.href= data.data.url;
              }else{
                  Swal.fire('Error!',data.message,'success');
              }
          });
          e.preventDefault();
      });

        $('#add_money').on('click',function(){
            $('#exampleModalCenter').modal('show')
        })

      $('.amount').click(function(e)
          {
              e.preventDefault();
              if($('.amtInput').val() == '')
              {
                  var amtInput = 0;
              }
              else
              {
                  var amtInput = $('.amtInput').val();

              }
              var amt= parseInt(amtInput);
              var value = parseInt($(this).attr('data-val'));
              var total = amt + value;
             $('.amtInput').val(total);
              //alert(value);
          });
    </script>
@endsection
