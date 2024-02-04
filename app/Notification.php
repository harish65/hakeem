<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use Config;
class Notification extends Model
{

  // if (Config::get('client_connected') && Config::get("client_data")->domain_name=="petpal") {
  //   $d = "REQUEST COMPLETEDS";
  // } else {
  //   $d = "REQUEST COMPLETED";
  // }
   public function push_notification($user_ids,$data){
   	    $others = [];
      $ios_types = [];
   		foreach ($user_ids as $key => $user_id) {
   			$user_data = User::find($user_id);
   			if($user_data && $user_data->fcm_id){
            if(strtolower($user_data->device_type)=='ios'){
                $ios_types[] =  $user_data->fcm_id;
            }else{
                $others[] = $user_data->fcm_id;
            }
   			}
   		}
      $timeToLive = null;
      $priority = "normal";
      $pushTypes = ["CALL","CALL RINGING","CALL ACCEPTED","CALL CANCELED","REQUEST COMPLETED","BOOKING REQUEST","EMERGENCY CALL CANCELED"];
      if(in_array($data['pushType'],$pushTypes)){
        $priority = "high";
      }
      if($data['pushType']=="CALL" || $data['pushType']=="CALL RINGING" || $data['pushType']=="CALL ACCEPTED" || $data['pushType']=="CALL CANCELED"){
        $timeToLive = 20;
      }
      $sound = "default";
      if($data['pushType']=="CALL RINGING"){
        $sound = "ring.wav";
      }
      $notification = [];
      if(count($others)>0){
        $notification = [
            "title" => $data["pushType"],
            "body"  => $data["message"],
            "sound" => $sound,
            "badge" =>  0
        ];
        $fields = array (
            'registration_ids' => $others,
            "priority"      => $priority,
            'notification'     => $notification,
            'data' =>$data,
        );
        //   $fields = array (
        //       'registration_ids' =>$others,
        //       'data' =>$data,
        //       'notification'=>null,
        //       "sound"=> $sound,
        //       "priority"=>$priority
        //   );
          if($timeToLive){
            $fields["time_to_live"] = $timeToLive;
          }
          \Log::channel('custom')->info('Android Notification Check', ['device_ids'=>$others,'fields' => $fields]);
          $this->sendNotification($fields);
      }
      if(count($ios_types)>0){
          if(isset($data['pushType'])){
            $notification = [
                "title" => $data["pushType"],
                "body"=> $data["message"],
                "sound"=> $sound,
                "badge"=>0
            ];
          }
          $fields = array (
              'registration_ids' =>$ios_types,
              'data' =>$data,
              'notification'=>$notification,
              "priority"=>$priority,
          );
          if($timeToLive){
            $fields["time_to_live"] = $timeToLive;
          }
          \Log::channel('custom')->info('IOS Notification', ['device_ids'=>$ios_types,'fields' => $fields]);
          $this->sendNotification($fields);
      }
      return;
   }

   public function push_test_notification($fcm_id,$data,$request){
      $others = [];
      $ios_types = [];
      if($request->device_type=='IOS'){
        $ios_types[] =  $fcm_id;
      }else{
         $others[] = $fcm_id;
      }
      $priority = "normal";
      $timeToLive = null;
      $notification = [];
      if(count($others)>0){
          $fields = array (
              'registration_ids' =>$others,
              'data' =>$data,
              'notification'=>null,
              "priority"=>$priority
          );
          if($timeToLive){
            $fields["time_to_live"] = $timeToLive;
          }
          return $this->sendTestNotification($fields,$request->fcm_server_key);
      }
      if(count($ios_types)>0){
          if(isset($data['pushType'])){
            $notification = [
                "title" => $data["pushType"],
                "body"=> $data["message"],
                "sound"=> "default",
                "badge"=>0
            ];
          }
          $fields = array (
              'registration_ids' =>$ios_types,
              'data' =>$data,
              'notification'=>$notification,
              "priority"=>$priority,
          );
          if($timeToLive){
            $fields["time_to_live"] = $timeToLive;
          }
          return $this->sendTestNotification($fields,$request->fcm_server_key);
      }

   }

   public function sendTestNotification($fields,$api_key){
   		$url = 'https://fcm.googleapis.com/fcm/send';
      $headers = array(
          'Content-Type:application/json',
          'Authorization:key='.$api_key
      );
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_POST, true);
      curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
      $result = curl_exec($ch);
      curl_close($ch);
      return $result;
   }


   public function sendNotification($fields){
      $url = 'https://fcm.googleapis.com/fcm/send';
      //header includes Content type and api key
      /*api_key available in:
      Firebase Console -> Project Settings -> CLOUD MESSAGING -> Server key*/
      $api_key = env('SERVER_KEY_ANDRIOD');
      if(Config::get('client_connected')){
        $f_keys = \App\Helpers\Helper::getClientFeatureKeys('keys', 'fcm');
        if(isset($f_keys['fcm_server_key']) && $f_keys['fcm_server_key']){
            $api_key = $f_keys['fcm_server_key'];
        }
      }

      $headers = array(
          'Content-Type:application/json',
          'Authorization:key='.$api_key
      );
      \Log::channel('custom')->info('encode value==========', ['encoding' => json_encode($fields)]);

      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_POST, true);
      curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
      $result = curl_exec($ch);
      curl_close($ch);
    //   \Log::channel('custom')->info('send Notification Checking==========', ['domain' => Config::get("client_data")->domain_name,'apikey'=>$api_key]);
      \Log::channel('custom')->info('send Notification==========', ['result' => $result]);
      return $result;
   }


   public static function markAsRead($receiver_id){
    	self::where(['read_status'=>'unread','receiver_id'=>$receiver_id])->update(['read_status' =>'read']);
    	return true;
    }
}



