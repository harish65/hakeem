<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendSms implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $api_url = 'https://me.ccmghousecalls.com/uber/';
    public $x_access_token = null;
    protected $data;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $res = $this->loginAPI();
        if($res){
            $this->x_access_token = $res;
        }else{
            echo 'Can not login';die;
        }
        if($this->x_access_token){
            $this->sendSmsFromUberApi();
        }

    }

    public function sendSmsFromUberApi(){
        $user = \App\User::find($this->data['to']);
        if($user){
            $data = [];
            $data['param'] = ['message'=>$this->data['message'],'toNumber'=>$user->country_code.''.$user->phone];
            $data['end_point'] = 'sendMessage';
            $data['type'] = 'POST';
            $res = $this->responseAPI($data);
            $bodyResponse = json_decode($res->getBody());
            \Log::channel('custom')->info('sendSmsFromUberApi', ['res'=>$res->getBody()]);
        }
    }

    public function loginAPI(){
        $data = [];
        $data['param'] = ['userId'=>'uber_myccmg','password'=>'p@$$w0rd@jOyC0ffEE@78'];
        $data['end_point'] = 'login';
        $data['type'] = 'POST';
        $res = $this->responseAPI($data);
        $bodyResponse = json_decode($res->getBody());
        if(isset($bodyResponse->entity) && isset($bodyResponse->entity->x_access_token)){
            return $bodyResponse->entity->x_access_token;
        }else{
            return false;
        }
    }

    private function responseAPI($data){
        $client = new \GuzzleHttp\Client();
        $res = $client->request($data['type'],$this->api_url.$data['end_point'],
            [
                'json'=>$data['param'],
                'headers'=>['x-access-token'=>$this->x_access_token]
        ]);
        return $res;
    }
}
