<?php

namespace MSMS;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use MSMS\SMSBroadcast;

class BroadcastTestController extends Controller
{
    public function broadcastTest(Request $request) {
  
        $passPhrase = 'EsvziOgj'; //update pass phrase
        $senderAddress = 'PetPal'; //update sender address
        $clientCorrelator = '123456'; //update client correlator
        $message = 'this is demo message from sms gateway';
        $address ='8999977775'; //update number

        $broadcast = new SMSBroadcast($passPhrase, $senderAddress, $clientCorrelator);
    
        $res = json_decode($broadcast->broadcast($message, $address));
        if($res->code == 201){
            return response()->json([
                'code' => $res->code,
                'messsage' => $res->message
            ],  201);
        }else{
            return response()->json([
                'code' => $res->code,
                'messsage' => $res->message
            ],  500);
        }
        
    }
}
