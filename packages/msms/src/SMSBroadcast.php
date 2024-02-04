<?php

namespace MSMS;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class SMSBroadcast
{
    protected $passPhrase = '',
           $senderAddress = '',
           $clientCorrelator = '';  
    /*
     * @return void
     * @throws InvalidArgumentException
    */
    public function __construct($passPhrase, $senderAddress, $clientCorrelator) {
        $this->_setPassPhrase($passPhrase);
        $this->_setSenderAddress($senderAddress);
        $this->_setClientCorrelator($clientCorrelator);
    }

    protected function _setPassPhrase($passPhrase) {
        if (in_array($passPhrase, ['', null])) {
            throw new \InvalidArgumentException(
                'Pass Phrase field is required.'
            );
        }
        $this->passPhrase = $passPhrase;
    }  
    protected function _setSenderAddress($senderAddress) {
        if (in_array($senderAddress, ['', null])) {
            throw new \InvalidArgumentException(
                'Sender Address field is required.'
            );
        }
        $this->senderAddress = $senderAddress;
    }  
    protected function _setClientCorrelator($clientCorrelator) {
        if (in_array($clientCorrelator, ['', null])) {
            throw new \InvalidArgumentException(
                'Client Correlator field is required.'
            );
        }
        $this->clientCorrelator = $clientCorrelator;
    }  

    public function broadcast($message, $address) {
        if(in_array($message, ['', null])){
            return json_encode([
                'code' => 500,
                'message' => 'Test message field is required.',
            ]);
        }

        if(in_array($address, ['', null])){
            return json_encode([
                'code' => 500,
                'message' => 'Number / Address / MSISDN field is required.',
            ]);
        }

        $data = [
            'outboundSMSMessageRequest' => [    
                'clientCorrelator' => $this->clientCorrelator,
                'senderAddress' => $this->senderAddress,
                'outboundSMSTextMessage' => [
                    'message' => $message
                ],
                'address' => $address
            ]
        ];
        return $this->sendRequest('POST', $data);
    }

    private function sendRequest($method, $data) {
		
        $client = new Client([
            'base_uri' => 'https://api.m360.com.ph/v3/api/globelabs/mt/'.$this->passPhrase
        ]);
        try {
            $res = $client->request(
                $method, '',
                [
                    'json' => $data,
                    'headers' => [
                        'Content-Type' => 'application/json'
                    ]

                ]);
            return json_encode([
                'code' => $res->getStatusCode(),
                'message' => $res->getReasonPhrase(),
            ]);
            
        } catch(GuzzleException $e) {
            return json_encode([
                'code' => 500,
                'message' => $e->getMessage()
            ]);
        }
        
    }
}
