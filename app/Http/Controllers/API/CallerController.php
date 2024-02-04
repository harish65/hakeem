<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Config;
use App\User;
use App\Notification;
use Illuminate\Support\Facades\Auth;
use Validator,Hash,Mail,DB;
use DateTime,DateTimeZone;
use Redirect,Response,File,Image;
use Illuminate\Support\Facades\URL;
use App\Model\Role;
use App\Model\Wallet;
use App\Model\Profile;
use App\Model\Payment;
use App\Model\RequestHistory;
use App\Model\Transaction;
use App\Model\SocialAccount;
use Socialite,Exception;
use Intervention\Image\ImageManager;
use Carbon\Carbon;
use Twilio\Rest\Client;
use Twilio\TwiML\VoiceResponse;
use Twilio\Jwt\AccessToken;
use Twilio\Jwt\Grants\VoiceGrant;
use Twilio\Jwt\Grants\VideoGrant;
use App\Model\EnableService;
use App\Helpers\Helper;
class CallerController extends Controller{

	public function __construct() {
		$this->middleware('auth')->except(['callbackExotel','callTwillio','accessTokenTwillio','twillioCallback','callTwillio1','placeCall','incoming','makeCallTestToken']);
	}

    /**
     * @SWG\Post(
     *     path="/start-request",
     *     description="startRequest",
     * tags={"Service Provider"},
     *     security={
     *     {"Bearer": {}},
     *   },
     *  @SWG\Parameter(
     *         name="request_id",
     *         in="query",
     *         type="number",
     *         description=" Request Id",
     *         required=true,
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="OK",
     *     ),
     *     @SWG\Response(
     *         response=400,
     *         description="Please provide all data"
     *     )
     * )
     */

    public function startRequest(Request $request){
        $user = Auth::user();
        $rules = ['request_id' => 'required|exists:requests,id'];
        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()) {
            return response(array('status' => "error", 'statuscode' => 400, 'message' =>
                $validator->getMessageBag()->first()), 400);
        }
        $sr_request = \App\Model\Request::where(['id'=>$request->request_id])->first();
        $category_name = '';
        if($sr_request->sr_info->getCategoryData($sr_request->sr_info->id)){
            $category_name = $sr_request->sr_info->getCategoryData($sr_request->sr_info->id)->name;
        }
        $call_id = $sr_request->call_id;
    if(config('client_connected') && Config::get("client_data")->domain_name == "care_connect_live")
    {
        if($sr_request->requesthistory->status=='in-progress')
        {
            $main_service_type = ($sr_request->servicetype->service_type)?$sr_request->servicetype->service_type:$sr_request->servicetype->type;
            if(strtolower($main_service_type)=='call'||strtolower($main_service_type)=='video call'  || strtolower($main_service_type)=='audio_call' || strtolower($main_service_type)=='video_call')
            {
                $sr_request->requesthistory->status = "in-progress";

                $action = 'Call';
                $calling_type = $main_service_type;

            }
            $sr_request->requesthistory->calling_type = $calling_type;
            $sr_request->requesthistory->save();
            if(strtolower($main_service_type)=='video call' || strtolower($main_service_type)=='call' || strtolower($main_service_type)=='audio_call' || strtolower($main_service_type)=='video_call')
            {
                // $call_id = bin2hex(random_bytes(9)).$sr_request->id;
                if($sr_request->cus_info->device_type=='IOS'){
                    $apn_notification =array(
                        'pushType'=>($action),
                        'title'=>strtoupper($action),
                        'message'=>__('notification.sp_calling_text',['vendor_name' => $user->name]),
                        'isCallFrom'=>strtoupper($action),
                        'request_id'=>$sr_request->id,
                        'service_type'=>$sr_request->servicetype->type,
                        'main_service_type'=>$main_service_type,
                        'request_time'=>$sr_request->booking_date,
                        'sender_name'=>$user->name,
                        'sender_image'=>$user->profile_image,
                        'vendor_category_name'=>$category_name,
                        'tokens'=>$sr_request->cus_info->apn_token
                    );
                    $push = Helper::sendAPNPushNotification($sr_request->cus_info,$apn_notification);
                }else{
                    $notification = new Notification();
                    $notification->push_notification(array($sr_request->from_user),array(
                        'pushType'=>strtoupper($action),
                        'message'=>__('notification.sp_calling_text',['vendor_name' => $user->name]),
                        'isCallFrom'=>strtoupper($action),
                        'request_id'=>$sr_request->id,
                        'call_id'=>$call_id,
                        'service_type'=>$sr_request->servicetype->type,
                        'main_service_type'=>$main_service_type,
                        'request_time'=>$sr_request->booking_date,
                        'sender_name'=>$user->name,
                        'sender_image'=>$user->profile_image,
                        'vendor_category_name'=>$category_name,
                    ));
                }
            }else{

            }
            // $sr_request->call_id = $call_id;
            $sr_request->save();
            return response(
                array(
                'status' =>"success",
                'statuscode' => 200,
                'action'=>$action,
                'data'=>array('action'=>$action,'call_id'=>$call_id),
                'message' =>__("Request $action"))
            , 200);
        }
    }


        if($sr_request->requesthistory->status=='accept'){
            $calling_type = $sr_request->servicetype->type;
            $main_service_type = ($sr_request->servicetype->service_type)?$sr_request->servicetype->service_type:$sr_request->servicetype->type;
            $action = $sr_request->servicetype->type;
            if(strtolower($main_service_type)=='chat'){
                $sr_request->requesthistory->status = "in-progress";
                $action = 'chat';
            }elseif(strtolower($main_service_type)=='call'||strtolower($main_service_type)=='video call'  || strtolower($main_service_type)=='audio_call' || strtolower($main_service_type)=='video_call') {
                if(config('client_connected') && Config::get("client_data")->domain_name == "care_connect_live"){
                    $sr_request->requesthistory->status = "in-progress";
                }
                $action = 'call';
                $calling_type = $main_service_type;
            }else{
                $sr_request->requesthistory->status = "in-progress";
            }
            $sr_request->requesthistory->calling_type = $calling_type;
            $sr_request->requesthistory->save();
            if(strtolower($sr_request->servicetype->type)=='chat'){
                $notification = new Notification();
                $notification->push_notification(array($sr_request->from_user),array(
                    'pushType'=>"Chat Started",
                    'message'=>"$user->name started chat",
                    'request_id'=>$sr_request->id,
                    'service_type'=>$sr_request->servicetype->type,
                    'main_service_type'=>$main_service_type,
                    'request_time'=>$sr_request->booking_date,
                    'senderName'=>$user->name,
                    'senderId'=>$user->id,
                    'sender_image'=>$user->profile_image,
                    'vendor_category_name'=>$category_name,
                ));
            }else if(strtolower($main_service_type)=='video call' || strtolower($main_service_type)=='call' || strtolower($main_service_type)=='audio_call' || strtolower($main_service_type)=='video_call'){
                $call_id = bin2hex(random_bytes(9)).$sr_request->id;
                if($sr_request->cus_info->device_type=='IOS'){
                    $apn_notification =array(
                        'pushType'=>strtoupper($action),
                        'title'=>strtoupper($action),
                        'message'=>__('notification.sp_calling_text',['vendor_name' => $user->name]),
                        'isCallFrom'=>strtoupper($action),
                        'request_id'=>$sr_request->id,
                        'service_type'=>$sr_request->servicetype->type,
                        'main_service_type'=>$main_service_type,
                        'request_time'=>$sr_request->booking_date,
                        'sender_name'=>$user->name,
                        'sender_image'=>$user->profile_image,
                        'vendor_category_name'=>$category_name,
                        'tokens'=>$sr_request->cus_info->apn_token
                    );
                    $push = Helper::sendAPNPushNotification($sr_request->cus_info,$apn_notification);
                }else{
                    $notification = new Notification();
                    $notification->push_notification(array($sr_request->from_user),array(
                        'pushType'=>strtoupper($action),
                        'message'=>__('notification.sp_calling_text',['vendor_name' => $user->name]),
                        'isCallFrom'=>strtoupper($action),
                        'request_id'=>$sr_request->id,
                        'call_id'=>$call_id,
                        'service_type'=>$sr_request->servicetype->type,
                        'main_service_type'=>$main_service_type,
                        'request_time'=>$sr_request->booking_date,
                        'sender_name'=>$user->name,
                        'sender_image'=>$user->profile_image,
                        'vendor_category_name'=>$category_name,
                    ));
                }
            }else{

            }
            $sr_request->call_id = $call_id;
            $sr_request->save();
            return response(
                array(
                'status' =>"success",
                'statuscode' => 200,
                'action'=>$action,
                'data'=>array('action'=>$action,'call_id'=>$call_id),
                'message' =>__("Request $action"))
            , 200);
        }else{
            return response(
                array(
                'status' =>"error",
                'statuscode' => 400,
                'message' =>__("Request status already ".$sr_request->requesthistory->status))
            , 400);
        }
    }


    /**
     * @SWG\Post(
     *     path="/start-call",
     *     description="start Call",
     * tags={"Service Provider"},
     *     security={
     *     {"Bearer": {}},
     *   },
     *  @SWG\Parameter(
     *         name="request_id",
     *         in="query",
     *         type="number",
     *         description=" Request Id",
     *         required=true,
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="OK",
     *     ),
     *     @SWG\Response(
     *         response=400,
     *         description="Please provide all data"
     *     )
     * )
     */

    public function startCall(Request $request){
        $user = Auth::user();
        $rules = ['request_id' => 'required|exists:requests,id'];
        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()) {
            return response(array('status' => "error", 'statuscode' => 400, 'message' =>
                $validator->getMessageBag()->first()), 400);
        }
        $sr_request = \App\Model\Request::where(['id'=>$request->request_id])->first();
        $category_name = '';
        if($sr_request->sr_info->getCategoryData($sr_request->sr_info->id)){
            $category_name = $sr_request->sr_info->getCategoryData($sr_request->sr_info->id)->name;
        }
        $main_service_type = ($sr_request->servicetype->service_type)?$sr_request->servicetype->service_type:$sr_request->servicetype->type;
        $action = 'Call';
        $call_id = bin2hex(random_bytes(9)).$sr_request->id;
        $call_to = $sr_request->cus_info;
        if($user->hasrole('customer')){
            $call_to = $sr_request->sr_info;
        }
        if($call_to->device_type=='IOS'){
            $apn_notification =array(
                'pushType'=>strtoupper($action),
                'title'=>strtoupper($action),
                'message'=>__('notification.sp_calling_text',['vendor_name' => $user->name]),
                'isCallFrom'=>strtoupper($action),
                'request_id'=>$sr_request->id,
                'service_type'=>$sr_request->servicetype->type,
                'main_service_type'=>$main_service_type,
                'request_time'=>$sr_request->booking_date,
                'sender_name'=>$user->name,
                'sender_image'=>$user->profile_image,
                'vendor_category_name'=>$category_name,
                'tokens'=>$call_to->apn_token
            );
            $push = Helper::sendAPNPushNotification($call_to,$apn_notification);
        }else{
            $notification = new Notification();
            $notification->push_notification(array($sr_request->from_user),array(
                'pushType'=>strtoupper($action),
                'message'=>__('notification.sp_calling_text',['vendor_name' => $user->name]),
                'isCallFrom'=>strtoupper($action),
                'request_id'=>$sr_request->id,
                'call_id'=>$call_id,
                'service_type'=>$sr_request->servicetype->type,
                'main_service_type'=>$main_service_type,
                'request_time'=>$sr_request->booking_date,
                'sender_name'=>$user->name,
                'sender_image'=>$user->profile_image,
                'vendor_category_name'=>$category_name,
            ));
        }
        $sr_request->call_id = $call_id;
        $sr_request->save();
        return response(
            array(
            'status' =>"success",
            'statuscode' => 200,
            'action'=>$action,
            'data'=>array('action'=>$action,'call_id'=>$call_id),
            'message' =>__("Request $action"))
        , 200);
    }


     /**
     * Test Token
     *
     */
    public function makeCallTestToken(Request $request){
        try{
            $input = $request->all();
            //validation rules
            $rules = array(
                        'token'=>'required',
                        'password'=>'required',
                        'sender_type'=>'required',
                    );
            //validate input
            $validation = \Validator::make($input,$rules);
            if($validation->fails()){
                return response(array('status' => "error", 'statuscode' => 400, 'message' =>
                    $validation->getMessageBag()->first()), 400);
            }
            $push = Helper::sendAPNPushNotificationTest($request);
            return $push;
        }catch(Exception $e){
            return response(array('status' => "error", 'statuscode' => 500, 'message' =>$e->getMessage()), 500);
        }
    }

    public static function makeCallRequest(Request $request) {}

    public static function callbackExotel(Request $request){}

    public  function callTwillio(Request $request){}

    public  function incoming(Request $request){}

    public  function placeCall(Request $request){}

    public  function twillioCallback(Request $request){}

    public  function accessTokenTwillio(Request $request){}
    /**
     * @SWG\Get(
     *     path="/contact-list",
     *     description="User Contact List",
     * tags={"Service Provider"},
     *     security={
     *     {"Bearer": {}},
     *   },
     *     @SWG\Response(
     *         response=200,
     *         description="OK",
     *     ),
     *     @SWG\Response(
     *         response=400,
     *         description="Please provide all data"
     *     )
     * )
     */

    public function contactList(){
        try{
            $user = Auth::user();
            $per_page = (isset($request->per_page)?$request->per_page:10);
            $lists = \App\Model\ContactList::select('id','name')->orderBy('name','ASC')->where([
                'parent_id'=>null,
                'user_id'=>$user->id,
            ])->cursorPaginate($per_page);
            foreach ($lists as $key => $list) {
                $list->phone_numbers = \App\Model\ContactList::select('phone','type_label')->where('parent_id',$list->id)->orWhere('id',$list->id)->get();
            }
            $after = null;
            if($lists->meta['next']){
                $after = $lists->meta['next']->target;
            }
            $before = null;
            if($lists->meta['previous']){
                $before = $lists->meta['previous']->target;
            }
            $per_page = $lists->perPage();
            return response(['status' => "success", 'statuscode' => 200,
                                'message' => __('Contact List...'),
                                'data' =>[
                                    'contacts'=>$lists->items(),
                                    'after'=>$after,
                                    'before'=>$before,
                                    'per_page'=>$per_page
                                ]], 200);
            }catch(Exception $ex){
                return response(['status' => "error", 'statuscode' => 500, 'message' => $ex->getMessage().' '.$ex->getLine()], 500);
            }
    }

    /**
     * @SWG\Post(
     *     path="/contact-add",
     *     description="Add Contact List",
     * tags={"Service Provider"},
     *     security={
     *     {"Bearer": {}},
     *   },
     *  @SWG\Parameter(
     *         name="contacts",
     *         in="query",
     *         type="string",
     *         description="array type [{'name':'abc','phone_numbers':[{'phone':1234567,'type_label':'mobile'},{'phone':90838838,'type_label':'home'}]}]",
     *         required=true,
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="OK",
     *     ),
     *     @SWG\Response(
     *         response=400,
     *         description="Please provide all data"
     *     )
     * )
     */

    public function addContactList(Request $request){
        try{
            $input = $request->all();
            $user = Auth::user();
            $rules = [
                'contacts' => 'required'
            ];
            $validator = Validator::make($request->all(),$rules);
            if ($validator->fails()) {
                return response(array('status' => "error", 'statuscode' => 400, 'message' =>
                    $validator->getMessageBag()->first()), 400);
            }

            if(!is_array($input['contacts']))
                $input['contacts'] = json_decode($input['contacts'],true);
            if(is_array($input['contacts'])){
                foreach ($input['contacts'] as $key => $contact) {
                    $parent_id = null;
                    if(!is_array($contact['phone_numbers']))
                        $contact['phone_numbers'] = json_decode($contact['phone_numbers'],true);
                    if(is_array($contact['phone_numbers'])){
                        foreach ($contact['phone_numbers'] as $key => $value) {
                            if($value){
                                $parent = \App\Model\ContactList::firstOrCreate([
                                    'user_id'=>$user->id,
                                    'parent_id'=>$parent_id,
                                    'name'=>$contact['name'],
                                    'phone'=>$value['phone'],
                                    'type_label'=>$value['type_label'],
                                ]);
                                $parent_id = $parent->id;
                            }
                        }
                    }
                }
            }
            return response(['status' => "success", 'statuscode' => 200,
                                'message' => __('Contact List Added')], 200);
            }catch(Exception $ex){
                return response(['status' => "error", 'statuscode' => 500, 'message' => $ex->getMessage().' '.$ex->getLine()], 500);
            }
    }

    /**
     * @SWG\Post(
     *     path="/contact-delete",
     *     description="Delete Contact",
     * tags={"Service Provider"},
     *     security={
     *     {"Bearer": {}},
     *   },
     *  @SWG\Parameter(
     *         name="id",
     *         in="query",
     *         type="number",
     *         description="contact ID",
     *         required=true,
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="OK",
     *     ),
     *     @SWG\Response(
     *         response=400,
     *         description="Please provide all data"
     *     )
     * )
     */

    public function deleteContact(Request $request){
        try{
            $input = $request->all();
            $user = Auth::user();
            $rules = [
                'id' => 'required|exists:contact_lists,id'
            ];
            $validator = Validator::make($request->all(),$rules);
            if ($validator->fails()) {
                return response(array('status' => "error", 'statuscode' => 400, 'message' =>
                    $validator->getMessageBag()->first()), 400);
            }
            \App\Model\ContactList::where('id',$input['id'])->delete();
            \App\Model\ContactList::where('parent_id',$input['id'])->delete();
            return response(['status' => "success", 'statuscode' => 200,
                                'message' => __('Contact Deleted...')], 200);
            }catch(Exception $ex){
                return response(['status' => "error", 'statuscode' => 500, 'message' => $ex->getMessage().' '.$ex->getLine()], 500);
            }
    }

    /**
     * @SWG\Post(
     *     path="/contact-message",
     *     description="Send SMS Contact",
     * tags={"Service Provider"},
     *     security={
     *     {"Bearer": {}},
     *   },
     *  @SWG\Parameter(
     *         name="body",
     *         in="query",
     *         type="string",
     *         description="Message",
     *         required=true,
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="OK",
     *     ),
     *     @SWG\Response(
     *         response=400,
     *         description="Please provide all data"
     *     )
     * )
     */

    public function sendContactMessage(Request $request){
        // $data['to'] = $request->phone;
        $input = $request->all();
        $user = Auth::user();
        // $rules = [
        //     // 'body' => 'required'
        // ];
        // $validator = Validator::make($request->all(),$rules);
        // if ($validator->fails()) {
        //     return response(array('status' => "error", 'statuscode' => 400, 'message' =>
        //         $validator->getMessageBag()->first()), 400);
        // }
        $lists = \App\Model\ContactList::select('id','name','phone')->orderBy('id','ASC')->where([
                'parent_id'=>null,
                'user_id'=>$user->id,
            ])->get();
        if($lists->count()<=0){
            return response(array(
                'status' => "success",
                'statuscode' => 200,
                'data'=>array('contact_added'=>false),
                'message' =>'You have not added any contact ,Please add contacts'), 200);
        }
        $f_keys = Helper::getClientFeatureKeys('social login','Twilio OTP');
        $accountSid = isset($f_keys['account_sid'])?$f_keys['account_sid']:"";
        $authToken = isset($f_keys['token'])?$f_keys['token']:"";
        $number = isset($f_keys['number'])?$f_keys['number']:"";
        try {
            $body = "Help Needed!
".$user->name." need help of you.
".$user->name." current location is ".$user->profile->location_name."
http://maps.google.com/maps?daddr=".$user->profile->lat.",".$user->profile->long."(".$user->profile->location_name.")";

            $twilio = new Client($accountSid, $authToken);
            foreach ($lists as $key => $list) {
                $this->sendSms($list,$twilio,$number,$body);
            }
            return response(array(
                'status' => "success",
                'statuscode' => 200,
                'data'=>array('contact_added'=>true),
                'message' =>'Message Sent'), 200);
        } catch (Exception $e) {
            return response(['status' => 'error', 'statuscode' => 500, 'message' => $e->getMessage()], 500);
        }
    }


    private function sendSms($list,$twilio,$number,$body){
        try{
            $contact = str_replace(['(',')','-','_',' '], '', $list->phone);
            if (strpos($contact, '+') !== false) {
            }else{
                $contact = '+1'.$contact;
            }
            $message = $twilio->messages->create($contact,["body" =>$body,"from" => $number]);
        }catch(Exception $ex){
            return true;
        }
    }

}
