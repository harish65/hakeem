<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\User;
use App\Model\EmergancyRequest;
use Config; 
use App\Notification;

use Illuminate\Support\Facades\Log;

class EmergencyRequestProcess implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
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
       
        $consultant_ids = \App\Model\SpServiceType::where('category_service_id', $this->data['category_service_id'])->pluck('sp_id');
        
        Log::channel('emergency_req')->info($consultant_ids);

        // $ratings = [
        //     "5",
        //     "4.9",
        //     "4.8",
        //     "4.7",
        //     "4.6",
        //     "4.5",
        //     "4.4",
        //     "4.3",
        //     "4.2",
        //     "4.1",
        //     "4", 
        //     "3.9",
        //     "3.8",
        //     "3.7",
        //     "3.6",
        //     "3.5"
        // ];

        // foreach($ratings as $rating)
        // {
          
            $getConsults = User::whereHas('roles', function ($query) {
                            $query->whereIn('name',['service_provider']);
                        })->whereIn('id',$consultant_ids)->where('account_verified','!=',Null)->orderBy('id','desc')
                        ->get();

            $sent_count = 0;
            $lastuser_id = null;
         
            foreach($getConsults as $consult)
            {
                Log::channel('emergency_req')->info($consult->id);
                
                $sent_count++;
                // request
                $sr_request = new \App\Model\Request();
                $sr_request->from_user = $this->data['userid'];
                $sr_request->booking_date = $this->data['datenow'];
                $sr_request->to_user = isset($consult->id) ? $consult->id : '';
                $sr_request->service_id =isset($this->data['service_id']) ? $this->data['service_id'] : '';
                $sr_request->sp_service_type_id = 1;
                if($request->has('request_type')){
                    $sr_request->request_type = $this->data['request_type'];
                    $sr_request->total_hours = 1;
                    $sr_request->payment = 'pending';
                }
                if($request->has('filter_id')){
                    $sr_request->request_category_type = 'filter_option';
                    $sr_request->request_category_type_id = $this->data['filter_id'];
                }

                $sr_request->save();

                // request history
                $requesthistory = new \App\Model\RequestHistory();
                $requesthistory->duration = 0;
                $requesthistory->discount = 0;
                $requesthistory->service_tax = 0;
                $requesthistory->tax_percantage = 0;
                $requesthistory->without_discount = 100;
                $requesthistory->total_charges = 100;
                $requesthistory->schedule_type = "instant";
                $requesthistory->status = 'pending';
                $requesthistory->request_id = $sr_request->id;
                $requesthistory->total_distance = 20;
                $requesthistory->total_distance_price_per_km = 100;
                $requesthistory->total_distance_price = 100;
                $requesthistory->save();

                // send notification
                $notification = new Notification();
                $notification->sender_id = $this->data['userid'];
                $notification->receiver_id = isset($consult->id) ? $consult->id : '';
                $notification->module_id = $sr_request->id;
                $notification->module ='request';
                $notification->notification_type ='NEW_EMERGENCY_REQUEST';
                $notification->message = __('notification.new_req_text', ['user_name' => $this->data['username'],'service_type'=>($this->data['service_type'])?($this->data['service_type']):'']);
                $notification->save();
                //return $notification;
                $notification->push_notification(array($consult),array(
                    'request_id'=>$emr_request->id,
                    'pushType'=>'New Emergency Request',
                    'is_second_oponion'=>'',
                    'message'=>$message
                ));
                 $lastuser_id = $consult->id;
                
                // check if accepted or not
                // $check_emergency_request = \App\Model\Request::where('id', $this->data['id'])->first();
                // if($check_emergency_request->status == 'accept')
                // {
                //     break;
                // }

                if($sent_count == 10)
                {
                   
                    // $emergency = \App\Model\EmergancyRequest::where('id', $emr_request->id)->first();
                    // $emergency->limit ='';
                    // $emergency->request_time = $user_time_zone_slot;
                    // $emergency->lastid = $lastuser_id;
                    // $emergency->rating = $rating;
                    // $emergency->save();

                    sleep(10);

                  
                    // if accepted break the loop

                    $sent_count = 0;
                }
            }

            sleep(10);
        //}

    }

    public function failed($exception)
    {
        Log::channel('emergency_req')->info($exception);
    }
}
