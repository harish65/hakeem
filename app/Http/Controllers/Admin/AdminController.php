<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Model\ServiceCredential;
use App\Model\Transaction;
use App\Model\Country;
use App\Model\AppVersion;
use App\Model\PayoutRequest;
use Config,DB;
use Illuminate\Support\Facades\Auth;
use App\Notification;
use App\Http\Traits\CategoriesTrait;
use Illuminate\Support\Facades\Artisan;

class AdminController extends Controller
{
    use CategoriesTrait;

    public function adHocSync(){
        Artisan::call('sync:careproviders',['run' => 'true']);
        return redirect()->route('update_schedule')->with('success', 'Ad-Hoc Synced!');
    }

    public function getScheduleTime(){
        $cron = \App\Model\CronSchedule::where('command_name','sync:careproviders')->first();
        $cron->schedule_at = json_decode($cron->schedule_at);
        return view('admin.schedule',compact('cron'));
    }
    public function postScheduleTime(Request $request){
        $rule = [
                'time' => 'required'
        ];
        $validator = \Validator::make($request->all(),$rule);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $time = json_encode($request->time);
        $cron = \App\Model\CronSchedule::where('id',$request->cron_id)->first();
        $cron->schedule_at = $time;
        $cron->save();
        return back();
    }
    //
    public function getDashboard(Request $request){
        $categories = $this->getAllCategories();
        $admin = \Auth::user();
    	$userCount = User::whereHas('roles', function ($query) {
                           $query->where('name','customer');
                        })->count();
    	$vendorCount = User::whereHas('roles', function ($query) {
                           $query->where('name','service_provider');
                        })->where('permission',null)->count();
    	$chatCount = \App\Model\Request::whereHas('servicetype', function ($query) {
                           $query->where('type','chat');
                        })->count();
        if($admin->hasRole('service_provider')){
            $revenue = Transaction::getRevenueByAdmin('weekly',$admin->id);
            $total_req = \App\Model\Request::where('to_user',$admin->id)->count();
            return redirect('admin/requests');
        }else{
            $revenue = Transaction::getRevenueByAdmin('weekly');
            $total_req = \App\Model\Request::count();
        }
    	$callCount = \App\Model\Request::whereHas('servicetype', function ($query) {
                           $query->where('type','call');
                        })->count();
        $latest_customers = User::whereHas('roles', function ($query) {
                           $query->where('name','customer');
                        })->orderBy('id','desc')->take(8)->get();
        $latest_sp = User::whereHas('roles', function ($query) {
                           $query->where('name','service_provider');
                        })->where('permission',null)->orderBy('id','desc')->take(8)->get();

        $revenue = Transaction::getRevenueByAdmin('weekly');
        $radius = DB::table('locations')->pluck('radius')->first();
        if(Auth::user()->type == 'clinic'){
            $allDoctorsInClinic = DB::table('assigned_doctors_to_clinic')->where('clinic_id' , '=' , Auth::user()->id)->get()->toArray(); 
                $araryData = array_column($allDoctorsInClinic , 'doctor_id'); 
                $consultants =  User::whereIn('id' , $araryData)->whereNotNull('email')->get();
                return view('admin.dashboard-clinic' , ['consultants' => $consultants]);
            
        }else{
            return view('admin.dashboard')->with([
                'userCount'=>$userCount,
                'vendorCount'=>$vendorCount,
                'chatCount'=>$chatCount,
                'callCount'=>$callCount,
                'total_req'=>$total_req,
                'latest_customers'=>$latest_customers,
                'latest_sp'=>$latest_sp,
                'revenue'=>$revenue,
                'categories'=>$categories,
                'radius' => $radius
            ]);
        }
    	
    }

    public function getCustomServiceProvider(){
        $admin = \Auth::user();
        $category = $admin->getCategoryData($admin->id);
        $doctors = \App\Model\CustomInfo::where([
            'ref_table'=>'category',
            'ref_table_id'=>$category->id,
            'info_type'=>'custom_sp'])->get();
        return view('admin.custom_doctors')->with(['doctors'=>$doctors]);
    }

    public function getCustomServiceProviderEdit($id){
        // $admin = \Auth::user();
        // $category = $admin->getCategoryData($admin->id);
        $doctor = \App\Model\CustomInfo::where(
            ['id'=>$id,
            'ref_table'=>'category',
            'info_type'=>'custom_sp'])->first();
        if($doctor)
            $doctor->d_detail = json_decode($doctor->raw_detail);
        return view('admin.custom_doctor_update')->with(['doctor'=>$doctor]);
    }

    public function postCustomServiceProviderEdit(Request $request){
        $doctor = \App\Model\CustomInfo::where(
            ['id'=>$request->doctor_id,
            'ref_table'=>'category',
            'info_type'=>'custom_sp'])->first();
        if(!$doctor){
            abort(404);
        }else{
            $doctor->raw_detail = json_encode([
                'first_name'=>$request->first_name,
                'last_name'=>$request->last_name
            ]);
            $doctor->save();
            return redirect('admin/centre/doctors');
        }
    }
    public function postCustomServiceProviderDelete(Request $request){
        $doctor = \App\Model\CustomInfo::where(
            ['id'=>$request->doctor_id,
            'ref_table'=>'category',
            'info_type'=>'custom_sp'])->delete();
        return response()->json(['status'=>'success']);
    }

    public function getRevenueByCategory(Request $request){
        $input = $request->all();
        $category = explode('_', $input['category']);
        $filter_id = null;
        $category_id = null;
        if(count($category)>1){
            $filter_id = $category[1];
        }else{
          $category_id = $category[0];
        }
        $data = Transaction::getRevenueByCategory($category_id,$filter_id);
        return response()->json(['status'=>'success','data'=>$data]);
    }

    public function getSendEmail(){
        return view('admin.email.create');
    }
    public function postSendEmail(Request $request){
        $rule = [
                'subject' => 'required',
                'body' => 'required',
                'to'=>'required'
          ];
         $validator = \Validator::make($request->all(),$rule);
          if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
          }
          $input = $request->all();
            $to_email = $input['to'];
            $subject = $input['subject'];
            $headers = "From: " . env('MAIL_FROM_ADDRESS') . "\r\n";
            $headers .= "Reply-To: ". env('MAIL_FROM_ADDRESS') . "\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
            // $body = str_replace('>','&gt;',str_replace('<', '&lt;', $input['body']));
            $from_name = Config::get("default")?'no-reply':Config::get("client_data")->domain_name;
            // mail($to_email, $subject, $input['body'], $headers);
            \Mail::send([], [], function ($message) use($request,$subject,$to_email,$from_name,$input) {
              $message->from($to_email,$from_name)->to($to_email)->subject($subject)->setBody($input['body'], 'text/html'); // for HTML rich messages
            });

            // \Mail::raw(htmlspecialchars($input['body']), function ($message) use($request,$subject,$to_email,$from_name) {
            //   $message->from($to_email,$from_name)->to($to_email)->subject($subject);
            // });
            return redirect()->back()->with('message', 'Mail Sent');
    }

    public function addCustomServiceProvider(){
        $admin = \Auth::user();
        return view('admin.custom_doctor_add');
    }

    public function postAssignDoctor(Request $request){
        \App\Model\CustomInfo::where(['ref_table'=>'requests','ref_table_id'=>$request->request_id,'info_type'=>'doctor_assign'])->delete();
        $admin = \Auth::user();
        $input = $request->all();
        $category = $admin->getCategoryData($admin->id);
        $input['category_id'] = $category->id;
        $new_sp = new \App\Model\CustomInfo();
        $new_sp->ref_table = 'requests';
        $new_sp->ref_table_id = $request->request_id;
        $new_sp->info_type = 'doctor_assign';
        $new_sp->raw_detail = json_encode($input);
        $new_sp->save();
        return response()->json(['status'=>'success']);
    }

    public function postCustomServiceProvider(Request $request){
        $admin = \Auth::user();
        $category = $admin->getCategoryData($admin->id);
        $new_sp = new \App\Model\CustomInfo();
        $new_sp->ref_table = 'category';
        $new_sp->ref_table_id = $category->id;
        $new_sp->info_type = 'custom_sp';
        $new_sp->raw_detail = json_encode(['first_name'=>$request->first_name,'last_name'=>$request->last_name]);
        $new_sp->save();
        return redirect('admin/centre/doctors');
    }


    public function getCurrentAppVersion(){
        $data = [];

        $data['ios_user'] = AppVersion::where('app_type',1)
                            ->where('device_type',1)
                            ->latest()
                            ->first();
        $data['ios_doc'] = AppVersion::where('app_type',2)
                            ->where('device_type',1)
                            ->latest()
                            ->first();
        $data['and_user'] = AppVersion::where('app_type',1)
                            ->where('device_type',2)
                            ->latest()
                            ->first();
        $data['and_doc'] = AppVersion::where('app_type',2)
                            ->where('device_type',2)
                            ->latest()
                            ->first();
        return view('admin.app_version',compact('data'));

    }

    public function createAppVersion(){
        return view('admin.add_version');
    }

    public function postAppVersion(Request $request){
        $input = $request->all();
        $msg = [];
        $rule = [
                'device_type' => 'required',
                'app_type' => 'required',
                'version_number' => 'required|numeric',
                'version_name' => 'required',
                'update_type' => 'required',
          ];
          if(isset($request->version_number)){
            $app_version = AppVersion::where('app_type',$request->app_type)
            ->where('device_type',$request->device_type)
            ->orderBy('version','DESC')
            ->latest()
            ->first();
            if(!$app_version->version<=$request->version_number){
                $new_number = $app_version->version + 1;
                $rule["version_number"] = "required|numeric|min:$new_number";
            }
          }
         $validator = \Validator::make($request->all(),$rule);
          if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
          }
          // print_r($start_date);die;
          $appversion = new AppVersion();
          $appversion->device_type = $input['device_type'];
          $appversion->app_type = $input['app_type'];
          $appversion->version = $input['version_number'];
          $appversion->version_name = $input['version_name'];
          $appversion->update_type = $input['update_type'];
          $appversion->save();
          return redirect('admin/app_version');
    }
    public function getServices(Request $request){
        if($request->service_id){
            $service = ServiceCredential::where('id',$request->service_id)->first();
            return view('admin.service_update')->with(array('service'=>$service));
        }else{
            $services = ServiceCredential::where('enabled','1')->get();
            return view('admin.services')->with(array('services'=>$services));
        }
    }
    public function postServices(Request $request){
        if($request->service_name){
            $call_service = ServiceCredential::where('name',$request->service_name)->update(['enabled'=>'1']);
        }
        if($request->last_service_id){
            $call_service = ServiceCredential::where('id',$request->last_service_id)->update(['enabled'=>'0']);
        }
        return redirect('admin/services');
    }

    public function getPayoutRequest(Request $request){
        $payoutrequests = PayoutRequest::orderBy('id','desc')->get();
        return view('admin.payouts.index',compact('payoutrequests'));
    }

    public function getPayoutRequestView(Request $request,$id){
        $payoutrequest = PayoutRequest::where(['id'=>$id])->first();
        return view('admin.payouts.view',compact('payoutrequest'));
    }

    public function postPayoutRequestMark(Request $request,$payout_id){
        $payoutrequest = PayoutRequest::where(['id'=>$payout_id,'status'=>'pending'])->first();
        if($payoutrequest){
            $payoutrequest->status = 'paid';
            if($payoutrequest->save()){
                $transaction = Transaction::where(array(
                    'status'=>'pending',
                    'transaction_type'=>'payouts',
                    'id'=>$payoutrequest->transaction_id
                ))->first();
                if($transaction){
                    $transaction->status = 'success';
                    $transaction->save();
                }
                $admin = Auth::user();
                $notification = new Notification();
                $notification->sender_id = $admin->id;
                $notification->receiver_id = $payoutrequest->vendor_id;
                $notification->module_id = $payoutrequest->id;
                $notification->module ='payouts';
                $notification->notification_type ='PAYOUT_PROCESSED';
                $notification->message =__('Your payout has been processed.');;
                $notification->save();
                $notification->push_notification(array($payoutrequest->vendor_id),array(
                    'pushType'=>'PAYOUT_PROCESSED','message'=>__('Your payout has been processed.')));
            }
        }
        return response()->json(['status'=>'success']);
    }

    public function postPayoutRejectMark(Request $request,$payout_id){
        $payoutrequest = PayoutRequest::where(['id'=>$payout_id,'status'=>'pending'])->first();
        if($payoutrequest){
            $payoutrequest->status = 'reject';
            if($payoutrequest->save()){
                $transaction = Transaction::where(array(
                    'status'=>'pending',
                    'transaction_type'=>'payouts',
                    'id'=>$payoutrequest->transaction_id
                ))->first();
                if($transaction){
                    $transaction->status = 'failed';
                    $payoutrequest->cus_info->wallet->increment('balance',$transaction->amount);
                    $transaction->closing_balance = $payoutrequest->cus_info->wallet->balance;
                    $transaction->payout_message = $request->comment;
                    $transaction->save();
                }
                $admin = Auth::user();
                $notification = new Notification();
                $notification->sender_id = $admin->id;
                $notification->receiver_id = $payoutrequest->vendor_id;
                $notification->module_id = $payoutrequest->id;
                $notification->module ='payouts';
                $notification->notification_type ='PAYOUT_FAILED';
                $notification->message =__($request->comment);
                $notification->save();
                $notification->push_notification(array($payoutrequest->vendor_id),array(
                    'pushType'=>'PAYOUT_FAILED','message'=>__($request->comment)));
            }
        }
        return response()->json(['status'=>'success']);
    }

    public function getFeatureTypes(Request $request){
        $client_features = [];
        if(Config::get('client_connected')){
            $client_feature_type = \App\Model\GodPanel\ClientFeature::where('client_id',Config::get('client_id'))->pluck('feature_id')->toArray();
            if($client_feature_type){
                $client_features = \App\Model\GodPanel\Feature::whereIn('id',$client_feature_type)->groupBy('feature_type_id')->get();
            }
            return view('admin.feature.index',compact('client_features'));
        }
    }

    public function getFeaturesByType(Request $request,$feature_type_id){
        $features = [];
        if(Config::get('client_connected')){
            $client_feature_ids = \App\Model\GodPanel\Feature::where('feature_type_id',$feature_type_id)->pluck('id')->toArray();
            if($client_feature_ids){
                $features = \App\Model\GodPanel\ClientFeature::where('client_id',Config::get('client_id'))->whereIn('feature_id',$client_feature_ids)->get();
            }
        }
        return view('admin.feature.feature',compact('features','feature_type_id'));
    }

    public function postFeatures(Request $request,$feature_type_id){
        $input = $request->all();        
        if(Config::get('client_connected')){
            if(isset($input['feature_keys'])){
                foreach ($input['feature_keys'] as $feature_id => $feature_values) {
                    $client_feature = \App\Model\GodPanel\ClientFeature::where(['feature_id'=>$feature_id,'client_id'=>Config::get('client_id')])->first();
                    if($client_feature){
                        $client_feature->feature_values = json_encode($feature_values,true);
                        $client_feature->save();
                    }
                }
            }
        }
        return redirect()->back()->with('message', 'Feature Keys Updated');
    }

    public function getTopics(){
        $topics = \App\Model\Topic::orderBy('id', 'DESC')->get();
        return view('admin.topic.index',compact('topics'));
    }

    public function getchangePassword(){
        return view('admin.users.change_password');
    }

    public function postchangePassword(Request $request){
        $rules = [
            'old_password' => 'required|password',
            'new_password' => 'required|string|min:8|regex:/[a-z]/|regex:/[0-9]/',
            're_password' => 'required|same:new_password',
        ];

        $customMessages = [
            'old_password.required' => 'The :attribute field is required.',
            'old_password.password' => 'The :attribute does not match',
            'new_password.regex' => 'New Password  should contain at-least, 1 Lowercase, 1 Numeric.'
        ];
        $this->validate($request, $rules, $customMessages);
        User::find(auth()->user()->id)->update(['password'=> \Hash::make($request->new_password)]);
        return redirect()->back()->with('success', 'Password Changed Successfully!');
    }

    public function getUpdateUser(){
        $user = \Auth::user();
        $countries = Country::select('id','name','phonecode')->get();
        return view('admin.users.update_user',compact('countries','user'));
    }

    public function postUpdateUser(Request $request){
        $user = \Auth::user();
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'country'=>'required',
            'phone'=>'required|unique:users,phone,'.$user->id,
        ]);
        $input = $request->all();
        $country = Country::find($input['country']);
        $input = $request->except('_token', '_method','country');
        $input['country_code'] = '+'.$country->phonecode;
        User::where('id', $user->id)->update($input);
        return redirect()->back()->with('success', 'User Updated!');
    }

    public function getReviews(Request $request){
        $review_list = \App\Model\Feedback::with(['user' => function($query) {
                            return $query->select(['id', 'name', 'email']);
        }])->orderBy('id', 'desc')->get();
        return view('admin.reviews',compact('review_list'));
    }

}
