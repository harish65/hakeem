<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use App\Notification;
use App\Model\Role;
use App\Model\Wallet;
use Carbon\Carbon;
use App\Model\Profile;
use App\Model\Request as RequestData;
use App\Model\CustomField;
use App\Model\SpServiceType;
use App\Model\CustomUserField;
use App\Model\CronSchedule;
use Illuminate\Support\Facades\Hash;
use DateTime,DateTimeZone;
use App\Jobs\SendSms;
use Illuminate\Support\Facades\Artisan;
class SyncCareProviders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:careproviders {run=false}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'To Sync Providers and their appointments';

    public $api_url = 'http://medev-env.ap-south-1.elasticbeanstalk.com/uber/';
    // public $api_url = 'https://me.ccmghousecalls.com/uber/';
    public $x_access_token = null;
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        \App\Helpers\Helper::connectByDomain('care_connect_live');
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $run_option = $this->argument('run');
        $dateznow = new DateTime("now", new DateTimeZone('UTC'));
        $datenow = $dateznow->format('H:i');
        $run = false;
        $crons = CronSchedule::get();
        foreach ($crons as $key => $value) {
            $times = json_decode($value->schedule_at);
            foreach ($times as  $time) {
                if($time && $time===$datenow)
                    $run = true;
            }
        }
        $this->info("Sync Starting...at ".$datenow.' run'.$run);
        \Log::info("Sync Starting...at ".$datenow.' run'.$run.' run_option'.$run_option);
        if($run || $run_option=='true'){
            try{
                $res = $this->loginAPI();
                if($res){
                    $this->x_access_token = $res;
                }else{
                    echo 'Can not login';die;
                }

                // $data = $this->getlookUpDataAPI();
                // get providers detail with access token
                $this->getExpertsFromMicrosoftLogin();
            }catch(\Exception $ex){
                echo $ex->getMessage();
            }
        }
        $this->info("Sync End.. ");
        \Log::info("Sync End..");
    }

    private function getExpertsFromMicrosoftLogin(){
        $providers = User::select('id','name','email','provider_type')->whereHas('roles', function ($query) {
           $query->where('name','service_provider');
        })->where('provider_type','microsoft')->where('email','!=',null)->orderBy('id','DESC')->get();
        foreach ($providers as $key => $provider) {
            $result = $this->getProviderDetailsAPI($provider);
            if($result)
                $this->insertProviders($result,$provider);
        }
    }


    private function insertProviders($experts,$provider){
        \Log::info("Sync insertProviders...");
        $this->info('insertProviders...');
        foreach ($experts as $key => $expert) {
            $user = $this->saveExpertToDB($expert,$provider);
            /* Check Expert Exist  */
            if($user){
                $appointments = $this->getProviderAppointmentsAPI($provider->email,$user->user_api_id);
                /* Check appointments  */
                if($appointments){
                    foreach ($appointments as $key2 => $appointment) {
                        if(isset($appointment->visitType) && $appointment->visitType=='Telemedicine'){
                            $customer = $this->saveUserToDB($appointment);
                            /* Check User */
                            if($customer){
                                $this->createRequest($appointment,$customer,$user);
                            }
                            /* End Check User */
                        }

                    }
                }
                /*End  Check appointments  */
                $notification = new Notification();
                $notification->push_notification(array($user->id),array(
                    'pushType'=>'Synced',
                    'message'=>"Sync Done"));
            }
            /* End Check Expert Exist  */
        }
    }

    private function  saveExpertToDB($expert,$provider){
        $this->info('insertProviders...'.$expert->providerID);
        $user = User::where('id', $provider->id)->first();
        if($user){
            $dateznow = new \DateTime("now", new DateTimeZone('UTC'));
            $datenow = $dateznow->format('Y-m-d H:i:s');
            $user->account_verified = $datenow;
            $user->npi_id = $expert->npi;
            $user->user_api_id = $expert->providerID;
            $user->phone = str_replace(["'","(","_",")","-"," "],"",$expert->contact);
            $user->country_code = '+1';
            $user->save();
            if(!$user->profile){
                $profile = New Profile();
                $profile->user_id = $user->id;
                $profile->dob = '0000-00-00';
                $profile->save();
            }else{
                $profile = Profile::where('user_id',$user->id)->first();
            }
            $profile->address = isset($expert->addressLine1)?$expert->addressLine1:null;
            $profile->city = $expert->city;
            $profile->state = $expert->state;
            $profile->country = $expert->country;
            $profile->save();
            $this->info('insertProviders...expert id '.$user->id);
            return $user;
        }
    }

    private function  saveUserToDB($appointment){
        $this->info('memberID...'.$appointment->memberID);
        $user = User::where('user_api_id', $appointment->memberID)->first();
        if(!$appointment->memberPrimaryEmail){
            $appointment->memberPrimaryEmail = null;
        }
        if(!$user && $appointment->memberPrimaryEmail!=null){
            $user = User::where('email', $appointment->memberPrimaryEmail)->first();
        }
        $appointment->memberPrimaryPhone = str_replace(["'","(","_",")","-"," "],"",$appointment->memberPrimaryPhone);
        if(!$user && $appointment->memberPrimaryPhone!=null){
            $user = User::where([
                'phone'=>$appointment->memberPrimaryPhone,
                'country_code'=>'+1'
            ])->first();
        }
        if(!$user){
            $user =User::create([
                   'name'     => $appointment->memberName,
                   'email'    => $appointment->memberPrimaryEmail, 
                   'phone'    => $appointment->memberPrimaryPhone, 
                   'password' => Hash::make('password'),
                   'country_code' => '+1',
            ]);
            $wallet = new Wallet();
            $wallet->balance = 0;
            $wallet->user_id = $user->id;
            $wallet->save();
        }
        if($user){
            $role1 = Role::where('name','archived_user')->first();
            $role = Role::where('name','customer')->first();
            if($role){
                $user->roles()->detach($role1);
                $user->roles()->attach($role);
            }
            $dateznow = new \DateTime("now", new DateTimeZone('UTC'));
            $datenow = $dateznow->format('Y-m-d H:i:s');
            $user->account_verified = $datenow;
            $user->user_api_id = $appointment->memberID;
            $user->email = $appointment->memberPrimaryEmail;
            $user->phone = str_replace(['(_) -'], '',$appointment->memberPrimaryPhone);
            $user->country_code ='+1';
            $user->save();
            if(!$user->profile){
                $profile = New Profile();
                $profile->user_id = $user->id;
                $profile->dob = '0000-00-00';
                $profile->save();
            }else{
                $profile = Profile::where('user_id',$user->id)->first();
            }
            $profile->address = isset($appointment->memberAddress)?$appointment->memberAddress:null;
            $profile->city = $appointment->memberCity;
            $profile->state = $appointment->memberState;
            $profile->country = 'USA';
            $profile->save();
            $zip_code = CustomField::where(['field_name' => 'Zip Code', 'user_type' => 1])->first();
            if ($zip_code) {
                CustomUserField::where('user_id', $user->id)->where('custom_field_id', $zip_code->id)->delete();
                $CustomUserField = new CustomUserField();
                $CustomUserField->user_id = $user->id;
                $CustomUserField->field_value = $appointment->memberZip;
                $CustomUserField->custom_field_id = $zip_code->id;
                $CustomUserField->save();
            }
            $deviceType = strtoupper($appointment->deviceType);
            if($appointment->deviceType=="PC"){
                $deviceType = "WEB";
            }
            $user->provider_type = 'email';
            $user->device_type = $deviceType;
            $user->account_step = 6;
            $user->save();
            $this->info('insert/Update User...user id '.$user->id);
        }
        return $user;
    }

    private function savaAppointment($appointment,$customer_id,$expert_id){

    }

    private function createRequest($input,$customer,$expert){
        try{
        $status = $this->status($input->appointmentStatus);
        $second_oponion = false;
        $datenow = Carbon::parse($input->appointmentDate.' '.$input->appointmentStartTime)->format('Y-m-d H:i:s');
        $end_time_slot_utcdate = null;
        if(isset($input->appointmentEndTime)){
            $end_time_slot_utcdate = Carbon::parse($input->appointmentDate.' '.$input->appointmentEndTime)->format('Y-m-d H:i:s');
        }
        $category_id = $expert->getCategoryData($expert->id);
        if(!$category_id){
            $cat = \App\Model\Category::first();
            $category_service =  new \App\Model\CategoryServiceProvider();
            $category_service->sp_id = $expert->id;
            $category_service->category_id = $cat->id;
            $category_service->save();
            $category_id = $cat->id;
        }
        $service = \App\Model\Service::where('service_type','video_call')->first();
        $service_id = $service->id;

        $spservicetype_id = SpServiceType::where('sp_id',$expert->id)->first();
        if($spservicetype_id){
            $CategoryServiceType = \App\Model\CategoryServiceType::where('id',$spservicetype_id->category_service_id)->first();
        }
        /* Create Request */
        $fresh = false;
        $sr_request = \App\Model\Request::where('appointment_id',$input->appointmentID)->first();
        if(!$sr_request){
            $fresh = true;
            $sr_request = new \App\Model\Request();
            $sr_request->appointment_id = $input->appointmentID;
        }
        $sr_request->from_user = $customer->id;
        $sr_request->booking_date = $datenow;
        $sr_request->to_user = $expert->id;
        $sr_request->service_id = $service_id;
        $sr_request->source_type = 'crm_server';
        // $sr_request->sp_service_type_id = isset($spservicetype_id)?$spservicetype_id->id:null;
        $sr_request->booking_end_date = $end_time_slot_utcdate;
        if($sr_request->save()){
            $requesthistory = \App\Model\RequestHistory::where('request_id',$sr_request->id)->first();
                if(!$requesthistory){
                    $requesthistory = new \App\Model\RequestHistory();
                    $requesthistory->discount = 0;
                    $requesthistory->service_tax = 0;
                    $requesthistory->tax_percantage = 0;
                    $requesthistory->without_discount = 0;
                    $requesthistory->total_charges = 0;
                    $requesthistory->schedule_type = 'schedule';
                    $requesthistory->status = "accept";
                    $requesthistory->request_id = $sr_request->id;
                    $requesthistory->sid = 'Call_'.time().'_'.$sr_request->id;
                    $sr_request->call_id = $requesthistory->sid;
                    $sr_request->save();
                    if($requesthistory->save()){
                        $this->insertRequestDetail($sr_request->id,$input);
                            $this->sendAsSms($sr_request->id);
                    }
                }

            }
        }catch(\Exception $ex){
            $this->info("Appointment_Status -----".$ex->getMessage());
        }
    }

     public function sendAsSms($request_id){
        \Log::channel('custom')->info('SMS booking==========',["request_id"=>$request_id]);
        $requestdata = RequestData::find($request_id);
        $url = env('JISTI_URL').$requestdata->requesthistory->sid;
        if($requestdata->cus_info->phone){
            $message = "Please use following link :
            $url
            To join the video call for the appointment you have booked.
            Thanks";
            $push_data = [
                "request_id"=>$requestdata->id,
                "to"=>$requestdata->to_user,
                "message"=>$message
            ];
            $job = (new SendSms($push_data));
            dispatch($job);
        }
        if($requestdata->sr_info->phone){
            $message = "Please use following link :
            $url
            To join the video call for the appointment you have booked.
            Thanks";
            $push_data = [
                "request_id"=>$requestdata->id,
                "to"=>$requestdata->from_user,
                "message"=>$message
            ];
            $job = (new SendSms($push_data));
            dispatch($job);
        }
    }

    private function status($status){
        if($status=='APTS001'){
            $status = 'approved';
        }elseif ($status=='APTS002') {
            $status = 'admin cancelled';
        }elseif ($status=='APTS003') {
            $status = 'rescheduled';
        }elseif ($status=='APTS004') {
            $status = 'completed';
        }elseif ($status=='APTS005') {
            $status = 'no-show';
        }elseif ($status=='APTS006') {
            $status = 'np/member cancelled';
        }
        return $status;
    }

    private  function  insertRequestDetail($request_id,$input){
        $requestdetail= \App\Model\RequestDetail::firstOrCreate(['request_id'=>$request_id]);
        if($requestdetail){
            $requestdetail->lat =  isset($input->lat)?$input->lat:null;
            $requestdetail->long =  isset($input->lng)?$input->lng:null;
        }
        $requestdetail->save();
    }


    public function getlookUpDataAPI(){
        $data = [];
        $data['param'] = ['lookupType'=>'Appointment_Status'];
        $data['end_point'] = 'getLookupData';
        $data['type'] = 'POST';
        $res = $this->responseAPI($data);
        $bodyResponse = json_decode($res->getBody());
        if(isset($bodyResponse->entity)){
            return $bodyResponse->entity;
        }else{
            return false;
        }
    }

    private function getProviderAppointmentsAPI($userName,$p_id){
        $data = [];
        $userName = substr($userName, 0, strpos($userName, "@"));
        $data['param'] = [
            'userName'=>$userName,
            'startDate'=>date("Y-m-d"),
            'endDate'=>date("Y-m-d"),
            'aptVisitStatus'=>'APTS001',
            // 'visitType'=>'Telemedicine',
            'pageSize'=>0,
            'pageIndex'=>1,
            'offset'=>0
        ];
        $data['end_point'] = 'getProviderAppointments';
        $data['type'] = 'POST';
        $res = $this->responseAPI($data);
        $bodyResponse = json_decode($res->getBody());
        $this->info('userName='.$userName);
        $this->info('res='.$res->getBody());
        if(isset($bodyResponse->entity) && isset($bodyResponse->entity->appointmentDetails)){
            return $bodyResponse->entity->appointmentDetails;
        }else{
            return false;
        }
    }

    public function getProviderDetailsAPI($provider){
        $data = [];
        $userName = substr($provider->email, 0, strpos($provider->email, "@"));
        $data['param'] = ['userName'=>$userName];
        $data['end_point'] = 'getProviderDetails';
        $data['type'] = 'POST';
        $res = $this->responseAPI($data);
        $bodyResponse = json_decode($res->getBody());
        if(isset($bodyResponse->entity) && $bodyResponse->entity->providerDetails){
            return $bodyResponse->entity->providerDetails;
        }else{
            return false;
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
