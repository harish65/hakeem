<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
            .payment-height{
                height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
            }
        </style>
    </head>
    <body>
        <section class="payment-height">
            <meta name="csrf-token" content="{{ csrf_token() }}" />

            <div id="pp-button"></div>
        </section>
    </body>
    <script src="https://pay.payphonetodoesposible.com/api/button/js?appId={{env('APP_ID')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

   <script>
        window.onload = function() {
        payphone.Button({

        //token obtained from the developer console
        token: "{{env('AUTH_TOKEN')}}",

        //CONFIGURATION PARAMETERS
        btnHorizontal: true,
        btnCard: true,
        context:"iframe",

        createOrder: function(actions){

            //If the transaction data is entered there. mountain, impuestos, etc
            return actions.prepare({
                amount:             "{{$amount}}",
                amountWithoutTax:   "{{$amountwithouttax}}",
                currency:           "{{$currency}}",
                clientTransactionId:"{{$clienttrans_id}}",
                email :             "{{$email}}",
                id  :               "{{$id}}",
                user_id :           "{{$user_id}}",

            });
        },

        onComplete: function(model, actions){
                //If confirmed from payment made
                actions.confirm({
                    id: model.id,
                    clientTxId: model.clientTxId
                }).then(function(value){

            //IN THIS SECTION SE RECIBE THE RESPONSE Y SE SHOW TO THE USER
            if (value.transactionStatus == "Approved"){
                // console.log('value -------------',value);
                // console.log('models-------',model);

            // alert("Pago " + value.transactionId + " recibido, estado " + value.transactionStatus );
            $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    var model       = model;
                    var valuee       = value.transactionId;
                    var id          = "{{$id}}";
                    var user_id     = "{{$user_id}}";
                    var amount      = "{{$amount}}";
                    var phone       = "{{$phone}}";
                    var email       = "{{$email}}";

                    $.ajax({
                    type:'POST',
                    url:"{{ route('payment.start') }}",
                    data:{value:valuee,amount:amount,id:id,user_id:user_id,phoneNumber:phone,email:email},
                    success:function(data){
                     alert("Pago " + value.transactionId + " recibido, estado " + value.transactionStatus );
                    }
                    });
            }
            }).catch(function(err){
                console.log(err);
            });
        }

        }).render("#pp-button");
        }

        </script>
</html>
