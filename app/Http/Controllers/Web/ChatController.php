<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use LRedis;
use Config;
use App\User,App\Model\Message;
use Illuminate\Support\Facades\Auth;
use Validator,Hash,Mail,DB;
use DateTime,DateTimeZone;
use Redirect,Response,File,Image;
use Illuminate\Support\Facades\URL;
use App\Model\Role;
use App\Model\Wallet;
use App\Model\Profile;
use App\Model\Payment;
use App\Model\Card;
use App\Model\Request as Booking;
use App\Model\SocialAccount;
use Socialite,Exception;
use Intervention\Image\ImageManager;
use Carbon\Carbon;

use ElephantIO\Client;
use ElephantIO\Engine\SocketIO\Version2X;

class ChatController extends Controller{

    public function getCustomerChat(Request $request)
    {
    	$user = Auth::user();
    	$service_type = 'chat';
        $per_page = (isset($request->per_page)?$request->per_page:10);
    	$chats = Booking::select('id','service_id','from_user','to_user','created_at as booking_date','created_at')->
            where(function($q) use ($user) {
            	if($user->hasrole('customer')){
            		$q->where('from_user',$user->id);
            	}else if($user->hasrole('service_provider')){
            		$q->where('to_user',$user->id);
            	}
			})
            ->whereHas('servicetype', function($query) use ($service_type){
                if($service_type!=='all')
                    return $query->where('type', $service_type);
            })
            ->whereHas('requesthistory', function($query){
                    return $query->whereIn('status',['completed','in-progress','in_progress']);
            })
            ->orderBy('id', 'desc')->cursorPaginate($per_page);

            $id = null;
            foreach ($chats as $key => $request_status) {
            	if($id==null)
            		$id = $request_status->id;
            	$last_message = \App\Model\Message::getLastMessage($request_status);
                $request_status->unReadCount = \App\Model\Message::getUnReadCount($request_status,$user->id);
                $date = Carbon::parse($request_status->booking_date,'UTC')->setTimezone('Asia/Kolkata');
                $request_status->booking_date = $date->isoFormat('D MMMM YYYY, h:mm:ss a');
                $request_status->time = $date->isoFormat('h:mm a');
                $request_history = $request_status->requesthistory;
                $request_status->last_message = $last_message;
                $request_status->duration = $request_history->duration;
                $request_status->service_type = $request_status->servicetype->type;
                $request_status->status = $request_history->status;
                $request_status->booking_status = $request_status->status;
                $request_status->from_user = User::select('id', 'name', 'email','phone','profile_image','manual_available')->where('id',$request_status->from_user)->first();
                $request_status->to_user = User::select('id', 'name', 'email','phone','profile_image','manual_available')->with('profile')->where('id',$request_status->to_user)->first();
        }
        if(isset($request['request_id'])){
        	$id = $request['request_id'];
        }
        // print_r($id);die;
      // return $chats;
        $messages = \App\Model\Message::getMessages($id,$user->id);
        if (\Config('client_connected') && Config::get("client_data")->domain_name=="hexalud") {
            return view('vendor.hexalud.chat',compact('chats'))->with($messages);
        }elseif(\Config('client_connected') && Config::get("client_data")->domain_name=="telegreen") {
            return view('vendor.tele.chat',compact('chats'))->with($messages);
        }elseif(\Config('client_connected') && Config::get("client_data")->domain_name=="912consult") {
            return view('vendor.912consult.chat',compact('chats'))->with($messages);
        }else{
            return view('vendor.care_connect_live.chat',compact('chats'))->with($messages);
        }

        // return view('vendor.care_connect_live.chat',compact('chats'))->with($messages);
    }

    public function getChatListingBak(Request $request) {
    try{
        $user = Auth::user();
        $messages = [];
        $service_type = 'chat';
        $per_page = (isset($request->per_page)?$request->per_page:10);

        $lists = [];
        $user_ids = \App\Model\DataFlag::getFlagUserIds($user->id);
        $receiver_ids = \App\Model\Message::whereNotIn('receiver_id',$user_ids)->orderBy('id','DESC')->pluck('receiver_id')->toArray();
        $results = \DB::select( \DB::raw("SELECT *, GROUP_CONCAT(DISTINCT
            CASE WHEN user_id = $user->id
            THEN receiver_id
            ELSE user_id
            END ORDER BY id DESC) userID,id
            FROM messages
            WHERE $user->id IN (user_id, receiver_id)") );
        $ids = explode(',',$results[0]->userID);
        $u_list = [];
        $messages = [];
        $after = null;
        $before = null;
        if(count($ids)>0 && $ids[0]!==''){
        $u_list = User::select('id')->whereIn('id',$ids)->whereNotIn('id',$user_ids)->orderByRaw('FIELD(id,'.implode(",", $receiver_ids).')')->get();
        $id = null;
        foreach ($u_list as $list) {
        if($id==null)
        $id = $list->id;
        $find = Follower::where([
        'user_id'=>$user->id,
        'following_id'=>$list->id
        ])->first();
        $list->followers = 3;
        if($find){
        if($find->status=='pending')
        $list->followers = 2;
        else
        $list->followers = 1;

        }
        $find = Follower::where([
        'following_id'=>$user->id,
        'user_id'=>$list->id
        ])->first();
        $list->followings = 3;
        if($find){
        if($find->status=='pending')
        $list->followings = 2;
        else
        $list->followings = 1;
        }
        $list->unReadCount = \App\Model\Message::getUnReadCount($list->id,$user->id);
        $list->user = User::select('id','name','email','user_name','phone','profile_image','country_code','name as short_name')->find($list->id);
        $list->last_message = \App\Model\Message::getLastMessageByUser($user->id,$list->id);
        }
        }
        return response(['status' => "success", 'statuscode' => 200,
        'message' => __('Chat Listing'), 'data' =>['lists'=>$u_list]], 200);
        }catch(Exception $ex){
            return response(['status' => "error", 'statuscode' => 500, 'message' => $ex->getMessage()], 500);
        }
    }

    public function getCustomerChatIedu(Request $request){
        $user = Auth::user();
        $service_type = 'chat';
        $per_page = (isset($request->per_page)?$request->per_page:10);
        $results = \DB::select( \DB::raw("SELECT *, GROUP_CONCAT(DISTINCT
            CASE WHEN user_id = $user->id
            THEN receiver_id
            ELSE user_id
            END ORDER BY id DESC) userID,id
            FROM messages
            WHERE $user->id IN (user_id, receiver_id)") );
        $ids = explode(',',$results[0]->userID);
        $chats = [];
        $messages = [];
        $after = null;
        $before = null;
        $receiver_ids = \App\Model\Message::orderBy('id','DESC')->pluck('receiver_id')->toArray();
        if(count($ids)>0 && $ids[0]!==''){
            $chats = User::select('id')->whereIn('id',$ids)->orderByRaw('FIELD(id,'.implode(",", $receiver_ids).')')->paginate($per_page);
        }
        $id = 0;
        foreach ($chats as $key => $request_status) {
             $request_status->selected = false;
            if($key==0 && !isset($request['request_id'])){
                $id = $request_status->id;
                $request_status->selected = true;
            }
            $last_message = \App\Model\Message::getLastMessageByUser($user->id,$request_status->id);
            $request_status->from_user = User::select('id','name','email','user_name','phone','profile_image','country_code','name as short_name')->find($request_status->id);
            $request_status->unReadCount = 0;
            // $request_status->unReadCount = \App\Model\Message::getUnReadCount($request_status,$user->id);
            $date = Carbon::parse($request_status->booking_date,'UTC')->setTimezone('Asia/Kolkata');
            $request_status->last_message = $last_message;
        }
        $messages = ['messages'=>[],'request_dt'=>[]];
        if(isset($request['request_id'])){
            $id = $request['request_id'];
        }
        $messages = \App\Model\Message::getMessagesByUser($id,$user->id);
        $user = User::find($id);
        // print_r($user);die;
      // return $chats;

        return view('vendor.iedu.chat',compact('chats','user'))->with($messages);
    }

    public function getCustomerChatIeduBak(Request $request){
        $user = Auth::user();
        $service_type = 'chat';
        $per_page = (isset($request->per_page)?$request->per_page:10);
        $chats = Booking::select('id','service_id','from_user','to_user','created_at as booking_date','created_at')->
            where(function($q) use ($user) {
                if($user->hasrole('customer')){
                    $q->where('from_user',$user->id)->groupBy('to_user');
                }else if($user->hasrole('service_provider')){
                    $q->where('to_user',$user->id)->groupBy('from_user');
                }
            })
            // ->whereHas('servicetype', function($query) use ($service_type){
            //     if($service_type!=='all')
            //         return $query->where('type', $service_type);
            // })
            // ->whereHas('requesthistory', function($query){
            //         return $query->whereIn('status',['completed','in-progress','in_progress']);
            // })
            ->orderBy('id', 'desc')->cursorPaginate($per_page);

            $id = null;
            print_r($chats);die;
            foreach ($chats as $key => $request_status) {
                if($id==null)
                    $id = $request_status->id;
                $last_message = \App\Model\Message::getLastMessage($request_status);
                $request_status->unReadCount = \App\Model\Message::getUnReadCount($request_status,$user->id);
                $date = Carbon::parse($request_status->booking_date,'UTC')->setTimezone('Asia/Kolkata');
                $request_status->booking_date = $date->isoFormat('D MMMM YYYY, h:mm:ss a');
                $request_status->time = $date->isoFormat('h:mm a');
                $request_history = $request_status->requesthistory;
                $request_status->last_message = $last_message;
                $request_status->duration = $request_history->duration;
                $request_status->service_type = $request_status->servicetype->type;
                $request_status->status = $request_history->status;
                $request_status->from_user = User::select('id', 'name', 'email','phone','profile_image','manual_available')->where('id',$request_status->from_user)->first();
                $request_status->to_user = User::select('id', 'name', 'email','phone','profile_image','manual_available')->with('profile')->where('id',$request_status->to_user)->first();
        }
        if(isset($request['request_id'])){
            $id = $request['request_id'];
        }
        // print_r($id);die;
      // return $chats;
        $messages = \App\Model\Message::getMessages($id,$user->id);

        return view('vendor.iedu.chat',compact('chats'))->with($messages);
    }


    public function getChatSearch(Request $request)
    {
       $searchVal = $request->searchVal;
       $user = Auth::user();
       $service_type = 'chat';
       $chats = Booking::select('id','service_id','from_user','to_user')->
            where(function($q) use ($user) {
            	if($user->hasrole('customer')){
            		$q->where('from_user',$user->id);
            	}else if($user->hasrole('service_provider')){
            		$q->where('to_user',$user->id);
            	}
			})
            ->whereHas('servicetype', function($query) use ($service_type){
                if($service_type!=='all')
                    return $query->where('type', $service_type);
            })
            ->whereHas('requesthistory', function($query){
                    return $query->whereIn('status',['completed','in-progress','in_progress']);
            })
            ->orderBy('id', 'desc')->get();

            $id = null;
            foreach ($chats as $key => $request_status) {
            	if($id==null)
            	$id = $request_status->id;
                $request_status->from_user = User::select('id', 'name','manual_available')->where('id',$request_status->from_user)->first();
                $request_status->to_user = User::select('id', 'name','manual_available')->where('id',$request_status->to_user)->first();
             }
             return $chats;


    }

    public function test()
    {
        // $redis = LRedis::connection();
	    // Message::create([
        //     'user_id' => '1',
        //     'message' => '1',
        //     'request_id' => '1'
        // ]);
		// $data = ['message' => '1', 'user' => '1'];
		// $redis->publish('message', json_encode($data));
        $socket_url = env('SOCKET_URL');
        $client = new Client(new Version2X($socket_url,[
            'user_id'   =>  '262'
        ]));

        $client->initialize();
        $client->emit('broadcast', ['message' => 'hello shaveta']);
        $client->close();
    }


}
