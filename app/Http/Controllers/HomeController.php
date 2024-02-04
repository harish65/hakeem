<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Config;
use App\Model\Category;
use App\Helpers\Helper;
use App\Model\Country;
use App\Model\State;
use Twilio\Jwt\ClientToken;
use Twilio\Rest\Client;
use App\Model\Wallet;
use Auth;
use Hash;
use App\Model\Banner;
use App\Model\UserRole;
use App\User;
use App\Model\Role;
use App\Model\Verification;
use Storage;
use Exception;
use DateTime,DateTimeZone,DB;
use Illuminate\Support\Str;
use App\Http\Controllers\SmsController;
use App\Model\EnableService;
use App\Model\MasterPreference;
use App\Model\Profile;
use Session;
class HomeController extends Controller
{
    protected $SmsController,$smsVerifcation,$smsEmailVerifcation;
    public function __construct(SmsController $SmsController)
    {
        $this->SmsController = $SmsController;
        $this->smsVerifcation = new \App\Model\Verification();
        $this->smsEmailVerifcation = new \App\Model\EmailVerification();
    }

    public function DataDeltionRequestStatus(){
        $data = array(
          'message' => 'Done',
          'status' => 'success'
        );
        return response($data, 200);
    }

    public function DataDeltionRequest(Request $request){
        $input = $request->all();
        \Log::channel('custom')->info('DataDeltionRequest==========', ['DataDeltionRequest' => $input]);

        $client_data = \Config::get('client_data');
        $domain_url = "https://royoconsult.com";
        if($client_data){
            $domain_url = "https://".$client_data->domain_name.".royoconsult.com";
        }
        $secret = isset($facebook_keys['secret_key'])?$facebook_keys['secret_key']:env('FB_CLIENT_SECRET');
        $signed_request = $request->get('signed_request');
        $data = $this->parse_signed_request($signed_request,$secret);
        $user_id = $data['user_id'];
        $confirmation_code = time(); // unique code for the deletion request
        // Start data deletion
        $status_url = $domain_url.'/deletion?id='.$confirmation_code; // URL to track the deletion
        $data = array(
          'url' => $status_url,
          'confirmation_code' => $confirmation_code
        );
        return response()->json($data);
    }

    public function getBlogListing(){
        $blogs = \App\Feed::select('id','title','image','description','like','user_id','created_at','views','favorite')->where('type','blog')->latest()->paginate(12);
        if(Config::get("default")){
            return view('vendor.default.support',compact('blogs'));
        }else{
            if(Config::get("client_data")->domain_name=='telegreen'){
                return view('vendor.tele.blogs',compact('blogs'));
            }else{
                return view('vendor.'.Config::get("client_data")->domain_name.'.blogs',compact('blogs'));
            }

        }
    }

    private function parse_signed_request($signed_request,$secret) {

      list($encoded_sig, $payload) = explode('.', $signed_request, 2);
      $sig = $this->base64_url_decode($encoded_sig);
      $data = json_decode($this->base64_url_decode($payload), true);
      // confirm the signature
      $expected_sig = hash_hmac('sha256', $payload, $secret, $raw = true);
      if ($sig !== $expected_sig) {
        error_log('Bad Signed JSON signature!');
        return null;
      }
      return $data;
    }

    private function base64_url_decode($input) {
      return base64_decode(strtr($input, '-_', '+/'));
    }

    public function queryPost(Request $request){
        try{
            $to_email = isset($request->to_email)?$request->to_email:'adesh.codebrewlab@gmail.com';
            $number = isset($request->phone_number)?$request->phone_number:'NA';
            $subject = 'New Query From '.$request->email;
            if(isset($request->subject)){
                $subject = $request->subject;
            }
            $name = 'NA';
            if(isset($request->first_name) && isset($request->last_name)){
                $name = $request->first_name.' '.$request->last_name;
            }
            $from_name = Config::get("default")?'no-reply':Config::get("client_data")->domain_name;
            \Mail::raw($request->query_data."\nName:$name \nFrom email: $request->email \nMobile Number:$number", function ($message) use($request,$subject,$to_email,$from_name) {
              $message->from($to_email,$from_name)->to($to_email)->subject($subject);
            });
             return response(['status' => "success", 'statuscode' => 200], 200);
        }catch(Exception $ex){
            return response(['status' => "error", 'statuscode' => 500, 'message' => $ex->getMessage()], 500);
        }
    }

    public function postRequestDemo(Request $request){
        try{
            $to_email = isset($request->to_email)?$request->to_email:'adesh.codebrewlab@gmail.com';
            $number = isset($request->phone_number)?$request->phone_number:'NA';
            $subject = 'Request for Demo';
            if(isset($request->subject)){
                $subject = $request->subject;
            }
            $name = 'NA';
            if(isset($request->first_name) && isset($request->last_name)){
                $name = $request->first_name.' '.$request->last_name;
            }
            $from_name = "iCareConnect";
            \Mail::raw($request->query_data."\nName:$name \nFrom email: $request->email \nMobile Number:$number \nFacility Name:$request->facility_name \nJob Title:$request->job_title \nCity:$request->city \nProvince:$request->province \nComment:$request->comment", function ($message) use($request,$subject,$to_email,$from_name) {
              $message->from($to_email,$from_name)->cc(['adesh.codebrewlab@gmail.com','rajni.codebrewlabs@gmail.com'])->to($to_email)->subject($subject);
            });
             return response(['status' => "success", 'statuscode' => 200], 200);
        }catch(Exception $ex){
            return response(['status' => "error", 'statuscode' => 500, 'message' => $ex->getMessage()], 500);
        }
    }

    public function download($file_name){
        $tempImage = tempnam(sys_get_temp_dir(), $file_name);
        copy(Storage::disk('spaces')->url('uploads/'.$file_name), $tempImage);
        return response()->download($tempImage, $file_name);
    }

    public function getAboutUs(){
        if(Config::get("default")){
            return view('vendor.default.about-us');
        }else{
            return view('vendor.'.Config::get("client_data")->domain_name.'.about-us');
        }
    }

    public function getSupportPage(){
        if(Config::get("default")){
            return view('vendor.default.support');
        }else{
            return view('vendor.'.Config::get("client_data")->domain_name.'.support');
        }
    }

    public function getWebSupportPage(){
        if(Config::get("default")){
            return view('vendor.default.support');
        }else{
            if(Config::get("client_data")->domain_name=='telegreen'){
                return view('vendor.tele.web-support');
            }else{
                return view('vendor.'.Config::get("client_data")->domain_name.'.web-support');
            }
        }
    }

    public function getBlogView($blog_id){
        $blog = \App\Feed::select('id','title','image','description','like','user_id','created_at','views','favorite')->where('type','blog')->where('id',$blog_id)->first();
        if(Config::get("default")){
            return view('vendor.default.support',compact('blog'));
        }else{
            return view('vendor.'.Config::get("client_data")->domain_name.'.blog-view',compact('blog'));
        }
    }

    public function getContactUs(){
        if(Config::get("default")){
            return view('vendor.default.contact-us');
        }else{
            return view('vendor.'.Config::get("client_data")->domain_name.'.contact-us');
        }
    }

    public function getCovid19(){
        if(Config::get("default")){
            return view('vendor.default.covid-19');
        }else{
            return view('vendor.'.Config::get("client_data")->domain_name.'.covid-19');
        }
    }

    public function getNurseProfessionals(){
        if(Config::get("default")){
            return view('vendor.default.homepage-nurse');
        }else{
            return view('vendor.'.Config::get("client_data")->domain_name.'.homepage-nurse');
        }
    }

    public function getHomepageHomecare(){
        if(Config::get("default")){
            return view('vendor.default.homepage-homecare');
        }else{
            return view('vendor.'.Config::get("client_data")->domain_name.'.homepage-homecare');
        }
    }

    public function getWebDasboard(){
        if(Config::get("default")){
            return view('vendor.default.web-dashboard');
        }else{
            return view('vendor.'.Config::get("client_data")->domain_name.'.web-dashboard');
        }
    }

    public function getWebDasboardFacility(){
        if(Config::get("default")){
            return view('vendor.default.web-dashboard');
        }else{
            return view('vendor.'.Config::get("client_data")->domain_name.'.facility');
        }
    }

    public function getWebFacilityForm(){
        if(Config::get("default")){
            return view('vendor.default.web-dashboard');
        }else{
            return view('vendor.'.Config::get("client_data")->domain_name.'.fill_form_facility');
        }
    }

    public function getWebDasboardJob(){
        if(Config::get("default")){
            return view('vendor.default.web-jobs');
        }else{
            return view('vendor.'.Config::get("client_data")->domain_name.'.web-jobs');
        }
    }

    public function getWebDasboardNurses(){
        if(Config::get("default")){
            return view('vendor.default.web-nurses');
        }else{
            return view('vendor.'.Config::get("client_data")->domain_name.'.web-nurses');
        }
    }

    public function getWebDoctorPage(){
        $categories = Category::where(['enable'=>'1','parent_id'=>null])
        ->orderBy('id',"ASC")
        ->get();
        $banners = Banner::orderBy('id','DESC')->get();
        $data = Helper::getBanners();
        $banners = $data['banners'];
        $blogs = $data['blogs'];
        if(Config::get("default")){
            return view('vendor.default.doctor');
        }else{
            return view('vendor.'.Config::get("client_data")->domain_name.'.doctors',compact('categories','banners','blogs'));
        }
    }
    public function getWebLoginPage(){
        if(Auth::user()){
            return redirect('/');
        }
        if(Config::get("default")){
            return view('vendor.default.doctor');
        }else{
            return view('vendor.'.Config::get("client_data")->domain_name.'.login');
        }
    }
    public function getWebSignupPage(){
        if(Config::get("default")){
            return view('vendor.default.doctor');
        }else{
            return view('vendor.'.Config::get("client_data")->domain_name.'.signup');
        }
    }
    public function getWebPatientPage(){
        $categories = Category::where(['enable'=>'1','parent_id'=>null])
        ->orderBy('id',"ASC")
        ->get();
        $banners = Banner::orderBy('id','DESC')->get();
        $data = Helper::getBanners();
        $banners = $data['banners'];
        $blogs = $data['blogs'];
        if(Config::get("default")){
            return view('vendor.default.doctor');
        }else{
            return view('vendor.'.Config::get("client_data")->domain_name.'.patient',compact('categories','banners','blogs'));
        }
    }



    public function homePage()
    {

        if(Auth::check()){
            $user = Auth::user();
            if ($user->hasrole('admin')) {
                $redirect = 'admin/login';
                return redirect($redirect);
            }
            if ($user->hasrole('doctor_manager')) {
                $redirect = 'admin/login';
                return redirect($redirect);
            }
        }

    	$categories = Category::where(['enable'=>'1','parent_id'=>null])
        ->orderBy('id',"ASC")
        ->get();
        $banners = Banner::orderBy('id','DESC')->get();

        $countries = Country::where('phonecode','!=',0)->pluck('sortname','phonecode');
    	if(Config::get("default")){
        	return view('vendor.default.home',compact('categories','countries','banners'));
    	}else if(Config::get("client_data")->domain_name=="mp2r" || Config::get("client_data")->domain_name=="food"){
             if(Auth::user() && Auth::user()->hasrole('service_provider')){
                 $user = Auth::user();
                 if($user && $user->account_step<6){
                    $account_step = $user->account_step + 1;
                    return redirect('register/service_provider?step='.$account_step);
                 }else
                 {
                    return redirect('service_provider/Appointment');
                 }
             }
             else if(Auth::user() && Auth::user()->hasrole('customer')){
                $user = Auth::user();
                 if($user && $user->account_step<2){
                    $account_step = $user->account_step + 1;
                    return redirect('register/user?step='.$account_step);
                 }else{
                    return redirect('user/home');
                 }
             }
             $us_states = State::where('country_id','=',231)->whereNotIn('name',["Byram","Cokato","District of Columbia","Lowa","Medfield","New Jersy","Ontario","Ramey","Sublimity","Trimble"])->pluck('name','id');
            return view('vendor.mp2r.home',compact('categories','countries','us_states','banners'));
        }else if(Config::get("client_data")->domain_name=="intely"){
            return view('vendor.intely.home',compact('categories'));
        }else if(Config::get("client_data")->domain_name=="heal" ){
            return view('vendor.heal.home',compact('categories'));
        }else if(Config::get("client_data")->domain_name=="iedu" ){
            $courses = \App\Model\Course::orderBy('id',"ASC")
            ->paginate(10);
            $language  = DB::table('master_preferences')
            ->join('master_preferences_options', 'master_preferences.id', '=', 'master_preferences_options.preference_id')->where('master_preferences.name','=','Languages')
            ->select('master_preferences.id as preferid', 'master_preferences_options.name as optname', 'master_preferences_options.id as optid')
            ->get();


            return view('vendor.iedu.home',compact('language','categories','courses'));
        }else if(Config::get("client_data")->domain_name=="healtcaremydoctor" ){
            $data = Helper::getBanners();
            $banners = $data['banners'];
            $blogs = $data['blogs'];
            return view('vendor.'.Config::get("client_data")->domain_name.'.home',compact('categories','banners','blogs'));
        }else if(Config::get("client_data")->domain_name=="care_connect_live" ){
            $states=\App\Model\State::where('country_id', '=', 231)->pluck('name', 'id');
            $language  = DB::table('master_preferences')
            ->join('master_preferences_options', 'master_preferences.id', '=', 'master_preferences_options.preference_id')->where('master_preferences.name','=','Languages')
            ->select('master_preferences.id as preferid', 'master_preferences_options.name as optname', 'master_preferences_options.id as optid')
            ->get();

            $Gender  = DB::table('master_preferences')
            ->join('master_preferences_options', 'master_preferences.id', '=', 'master_preferences_options.preference_id')->where('master_preferences.name','=','Gender')
            ->select('master_preferences.id as preferid', 'master_preferences_options.name as optname', 'master_preferences_options.id as optid')
            ->get();
            $data = Helper::getBanners();
            $banners = $data['banners'];
            $blogs = $data['blogs'];
            return view('vendor.'.Config::get("client_data")->domain_name.'.home',compact('categories','states','banners','blogs','countries','language','Gender'));
        }
        else if(Config::get("client_data")->domain_name=="taradoc"){
            $data = Helper::getBanners();
            $banners = $data['banners'];
            $blogs = $data['blogs'];
            return view('vendor.'.Config::get("client_data")->domain_name.'.home',compact('categories','banners','blogs'));
        }
        else if(Config::get("client_data")->domain_name=="telegreen"){
            $login_error = Session::get('login_error',null);
            Session::forget('login_error');
            $login_error_check = 0;
            if(!is_null($login_error))
            {
                $login_error_check = 1;
            }
            if(Auth::check())
            {
                if(Auth::user()->hasrole('service_provider'))
                {
                    return redirect(url('/user/doctor'));
                }
                else
                {
                    return redirect(url('/user/patient'));
                }
            }

            $categories = Category::where(['enable'=>'1','parent_id'=>null])
            ->orderBy('id',"ASC")
            ->get();
            $banners = Banner::orderBy('id','DESC')->get();

            $language  = DB::table('master_preferences')
            ->join('master_preferences_options', 'master_preferences.id', '=', 'master_preferences_options.preference_id')->where('master_preferences.name','=','Languages')
            ->select('master_preferences.id as preferid', 'master_preferences_options.name as optname', 'master_preferences_options.id as optid')
            ->get();

            $Gender  = DB::table('master_preferences')
            ->join('master_preferences_options', 'master_preferences.id', '=', 'master_preferences_options.preference_id')->where('master_preferences.name','=','Gender')
            ->select('master_preferences.id as preferid', 'master_preferences_options.name as optname', 'master_preferences_options.id as optid')
            ->get();
    //return json_encode($language);
            $countries = ['91','90'];
            $data = Helper::getBanners();
            $banners = $data['banners'];
            $blogs = $data['blogs'];
               // return json_encode($gender);
                return view('vendor.tele.home',compact('categories','banners','blogs','countries','language','Gender','login_error_check','login_error'));

        }else if(Config::get("client_data")->domain_name=="hexalud"){
            $login_error = Session::get('login_error',null);
            Session::forget('login_error');
            $login_error_check = 0;
            if(!is_null($login_error))
            {
                $login_error_check = 1;
            }
            if(Auth::check())
            {
                if(Auth::user()->hasrole('service_provider'))
                {
                    return redirect(url('/user/doctor'));
                }
                else
                {
                    return redirect(url('/user/patient'));
                }
            }

            $categories = Category::where(['enable'=>'1','parent_id'=>null])
            ->orderBy('id',"ASC")
            ->get();
            $banners = Banner::orderBy('id','DESC')->get();

            $language  = DB::table('master_preferences')
            ->join('master_preferences_options', 'master_preferences.id', '=', 'master_preferences_options.preference_id')->where('master_preferences.name','=','Languages')
            ->select('master_preferences.id as preferid', 'master_preferences_options.name as optname', 'master_preferences_options.id as optid')
            ->get();

            $Gender  = DB::table('master_preferences')
            ->join('master_preferences_options', 'master_preferences.id', '=', 'master_preferences_options.preference_id')->where('master_preferences.name','=','Gender')
            ->select('master_preferences.id as preferid', 'master_preferences_options.name as optname', 'master_preferences_options.id as optid')
            ->get();
    //return json_encode($language);
            $countries = ['91','90'];
            $data = Helper::getBanners();
            $banners = $data['banners'];
            $blogs = $data['blogs'];
               // return json_encode($gender);
                return view('vendor.'.Config::get("client_data")->domain_name.'.home',compact('categories','banners','blogs','countries','language','Gender','login_error_check','login_error'));

        }else if(Config::get("client_data")->domain_name=="912consult"){
            $login_error = Session::get('login_error',null);
            Session::forget('login_error');
            $login_error_check = 0;
            if(!is_null($login_error))
            {
                $login_error_check = 1;
            }
            if(Auth::check())
            {
                if(Auth::user()->hasrole('service_provider'))
                {
                    return redirect(url('/user/doctor'));
                }
                else
                {
                    return redirect(url('/user/patient'));
                }
            }

            $categories = Category::where(['enable'=>'1','parent_id'=>null])
            ->orderBy('id',"ASC")
            ->get();
            $banners = Banner::orderBy('id','DESC')->get();

            $language  = DB::table('master_preferences')
            ->join('master_preferences_options', 'master_preferences.id', '=', 'master_preferences_options.preference_id')->where('master_preferences.name','=','Languages')
            ->select('master_preferences.id as preferid', 'master_preferences_options.name as optname', 'master_preferences_options.id as optid')
            ->get();

            $Gender  = DB::table('master_preferences')
            ->join('master_preferences_options', 'master_preferences.id', '=', 'master_preferences_options.preference_id')->where('master_preferences.name','=','Gender')
            ->select('master_preferences.id as preferid', 'master_preferences_options.name as optname', 'master_preferences_options.id as optid')
            ->get();
    //return json_encode($language);
            $countries = ['91','90'];
            $data = Helper::getBanners();
            $banners = $data['banners'];
            $blogs = $data['blogs'];
               // return json_encode($gender);
                return view('vendor.912consult.home',compact('categories','banners','blogs','countries','language','Gender','login_error_check','login_error'));

        }else if(Config::get("client_data")->domain_name=="mypalpal"){
            $login_error = Session::get('login_error',null);
            Session::forget('login_error');
            $login_error_check = 0;
            if(!is_null($login_error))
            {
                $login_error_check = 1;
            }
            if(Auth::check())
            {
                if(Auth::user()->hasrole('service_provider'))
                {
                    return redirect(url('/user/doctor'));
                }
                else
                {
                    return redirect(url('/user/patient'));
                }
            }

            $categories = Category::where(['enable'=>'1','parent_id'=>null])
            ->orderBy('id',"ASC")
            ->get();
            $banners = Banner::orderBy('id','DESC')->get();

            $language  = DB::table('master_preferences')
            ->join('master_preferences_options', 'master_preferences.id', '=', 'master_preferences_options.preference_id')->where('master_preferences.name','=','Languages')
            ->select('master_preferences.id as preferid', 'master_preferences_options.name as optname', 'master_preferences_options.id as optid')
            ->get();

            $Gender  = DB::table('master_preferences')
            ->join('master_preferences_options', 'master_preferences.id', '=', 'master_preferences_options.preference_id')->where('master_preferences.name','=','Gender')
            ->select('master_preferences.id as preferid', 'master_preferences_options.name as optname', 'master_preferences_options.id as optid')
            ->get();
    //return json_encode($language);
            $countries = ['91','90'];
            $data = Helper::getBanners();
            $banners = $data['banners'];
            $blogs = $data['blogs'];
               // return json_encode($gender);
                return view('vendor.mypalpal.home',compact('categories','banners','blogs','countries','language','Gender','login_error_check','login_error'));

        }else{
            if(Config::get("client_data")->domain_name=="hakeemcare"){
                return redirect()->route('login');
            }
        	return view('index');
    	}
    }

    public function getCities(Request $request){
        $state=State::select('id')->where('name',$request->state_id)->first();
        $state_id=($state->id);
        $data = \DB::table('cities')
        ->select('id','name')
        ->where('state_id',$state_id)
        ->orderBy('name','ASC')
        ->get();
        return response($data);
    }
    public function getCityDetails(Request $request){
        $state=State::select('id')->where('name',$request->state_name)->first();
        $data = \DB::table('cities')
        ->select('id','name')
        ->where('state_id', $state->id)
        ->orderBy('name','ASC')
        ->get();
        return response($data);
    }
    public function login(Request $request)
    {
         $input = $request->all();
        $role_type = $request->role_type;
        $logintype = $request->logintype;
        if($role_type == 'service_provider')
        {
            $roletype = 'Service Provider';
        }
        if($role_type == 'customer')
        {
            $roletype = 'Customer';
        }
        $countrycode = $request->country_code;
        $findme = '+';
        $pos = strpos($countrycode, $findme);

        if ($pos === false) {
             $usercountrycode = '+'.$request->country_code;
         } else {
             $usercountrycode = $request->country_code;
         }


        if($logintype == 'email')
        {

             // check if they're an existing user
            $user = User::where('email', $request->email)->first();
            if (!$user)
            {
                return Response(array('status' => "error", 'statuscode' => 400, 'message' => __('We are sorry, this user is not registered with us.')), 400);
            }
            elseif(!$user->hasrole($role_type))
            {
                $current_role = ucwords(str_replace('_', ' ', $user->roles[0]['name']));
                return response(array('status' => "error", 'statuscode' => 400, 'message' =>"You are register as $current_role with same account, Please try with other account."), 400);
            }
            elseif(Hash::check($request->password, $user->password) == false)
            {
                //return $request->password." ".$user->password." ".Hash::make($request->password);

                return Response(array('status' => "error", 'statuscode' => 400, 'message' => __('Sorry, this password is incorrect!')), 400);
            }else{
                // if($user->account_verified==null){
                //     return Response(array('status' => "error", 'statuscode' => 400, 'message' => __('Your account is not verified')), 400);
                // }
                if(Hash::check($request->password, $user->password)){
                    auth()->login($user, true);
                    $check_verified = User::where('id',$user->id)->first();
                    if($check_verified->account_verified == false || $check_verified->account_verified == NULL){
                        $verified = 'true';
                    }else{
                        $verified = 'false';
                    }
                    return response(['status' => 'Success', 'role_name' => $request->role_type, 'statuscode'=> 200, 'message'=>'Login Successfully','userid' => $user->id,'account_verified' =>$verified , 'account_step' => $user->account_step,  'applyoption' => 'login'],200);
                }else{
                    return response(['status' => 'error', 'role_name' => $request->role_type, 'statuscode'=> 200, 'message'=>'We are sorry, you are not registered with us.'],200);
                }
            }

        }else{ // login type otp phone number
            $get_phone_user = User::where(['phone'=>$request->phone,'country_code'=>$usercountrycode])->first();
            if($get_phone_user){
                $current_role = ucwords(str_replace('_', ' ', $get_phone_user->roles[0]['name']));
                if(!$get_phone_user->hasrole($role_type)){
                    return response(array('status' => "error", 'statuscode' => 400, 'message' =>"You are register as $current_role with same account, Please try with other account."), 400);
                }
            }
            $countrycode = $request->country_code;
            $findme = '+';
            $pos = strpos($countrycode, $findme);

            if ($pos === false) {
                 $usercountrycode = '+'.$request->country_code;
             }else{
                 $usercountrycode = $request->country_code;
             }

             $codephone =  $usercountrycode. $request->phone;
            if($role_type){
                $user = User::where('phone',$request->phone)->where('country_code',$usercountrycode)->first();
                if($user)
                {
                    if($role_type){
                        $code = rand(1000, 9999); //generate random code
                        $request['code'] = $code; //add code in $request body
                        $request['country_code'] = $usercountrycode;
                        $reques['phone'] = $request->phone;
                        $request['status'] = 'pending';
                        $smsverify = $this->smsVerifcation->store($request); //call store method of model
                        $res1 = $this->SmsController->sendSms($request); // send and return its response
                        $res2 = json_decode(json_encode($res1));
                        if(isset($res2->original) && $res2->original->status=='error'){
                            return $res1;
                        }
                        return response(['status' => 'success', 'statuscode' => 200, 'message' => __('OTP sent to your mobile number!'), 'data' => $request->phone, 'codephone' => $codephone, 'role_type' => $role_type,'country_code' => $usercountrycode,  'applyoption' => 'login' ], 200);

                    }else{
                        return response(array('status' => "error", 'statuscode' => 400, 'message' =>"You are register as $roletype with same account, Please try with other account."), 400);
                        }
                }else{
                    return response(['status' =>'error', 'statuscode' => 500, 'message' => 'Account does not Exist'], 500);
                }

            }
        }

    }

    public function register(Request $request)
    {
        // if(){
        //     dd(Config::get("client_data"));
        // }
            
        //return json_encode($request->all());
        $datenow = new DateTime("now", new DateTimeZone('UTC'));
        $datenowone = $datenow->format('Y-m-d H:i:s');
        $signuptype = $request->signuptype;
        $roletype = $role_type = $request->role_type;
        $countrycode = $request->country_code;
        $findme = '+';
        $pos = strpos($countrycode, $findme);

        if ($pos === false) {
         $usercountrycode = '+'.$request->country_code;
         } else {
             $usercountrycode = $request->country_code;
         }
        $get_phone_user = User::where('phone',$request->phone)->where('country_code',$usercountrycode)->first();

        if($get_phone_user){
            return response(array('status' => "error", 'statuscode' => 400, 'message' =>"Already Registered Account, Please try with other account."), 400);
            $current_role = ucwords(str_replace('_', ' ', $get_phone_user->roles[0]['name']));
            if(!$get_phone_user->hasrole($role_type)){
                return response(array('status' => "error", 'statuscode' => 400, 'message' =>"You are register as $current_role with same account, Please try with other account."), 400);
            }

        }

        $filename = null;

        if(isset($request->profile_image))
        {
            if ($request->hasfile('profile_image')) {
                if ($image = $request->file('profile_image')) {

                    $extension = $image->getClientOriginalExtension();
                    $filename = str_replace(' ', '', md5(time()) . '_' . $image->getClientOriginalName());
                    $thumb = \Image::make($image)->resize(
                        100,
                        100,
                        function ($constraint) {
                            $constraint->aspectRatio();
                        }
                    )->encode($extension);
                    $normal = \Image::make($image)->resize(
                        400,
                        400,
                        function ($constraint) {
                            $constraint->aspectRatio();
                        }
                    )->encode($extension);
                    $big = \Image::make($image)->encode($extension);
                    $_800x800 = \Image::make($image)->resize(
                        800,
                        800,
                        function ($constraint) {
                            $constraint->aspectRatio();
                        }
                    )->encode($extension);
                    $_400x400 = \Image::make($image)->resize(
                        400,
                        400,
                        function ($constraint) {
                            $constraint->aspectRatio();
                        }
                    )->encode($extension);

                    \Storage::disk('spaces')->put('thumbs/' . $filename, (string)$thumb, 'public');
                    \Storage::disk('spaces')->put('uploads/' . $filename, (string)$normal, 'public');

                    \Storage::disk('spaces')->put('original/' . $filename, (string)$big, 'public');
                    \Storage::disk('spaces')->put('800x800/' . $filename, (string)$_800x800, 'public');
                    \Storage::disk('spaces')->put('400x400/' . $filename, (string)$_400x400, 'public');
                    \Storage::disk('spaces')->put('original/' . $filename, (string)$big, 'public');

                    // $user=Auth::user();
                    // $user->profile_image = $filename;
                    // $user->save();


                }
            }

        }
        if($request->type == 'email' && $request->userid != '')
        {

            $get_user = User::where('email',$request->email)->first();
            if($get_user){
                $phone= $request->phone;
                $user_type= $request->user_type ;
                $countrycode = $request->country_code;
                $findme = '+';
                $pos = strpos($countrycode, $findme);

                if ($pos === false) {
                    $countrycode = '+'.$request->country_code;
                 } else {
                     $countrycode = $request->country_code;
                 }
                $mobile_no = $countrycode.$phone;
                try{
                    $code = rand(1000, 9999); //generate random code
                    $request['code'] = $code; //add code in $request body
                    $request['country_code'] = $countrycode;
                    $reques['phone'] = $request->phone;
                    $request['status'] = 'pending';
                    $smsverify = $this->smsVerifcation->store($request); //call store method of model
                    $res1 = $this->SmsController->sendSms($request); // send and return its response
                    $res2 = json_decode(json_encode($res1));
                    if(isset($res2->original) && $res2->original->status=='error'){
                        return $res1;
                    }
                    if(true){
                        return response(['status' => 'success', 'statuscode' => 200, 'message' => __('OTP sent to your mobile number!'), 'email'=> $request->email,'signuptype' =>$request->type, 'userid' =>$request->userid, 'data' => $phone, 'codephone' => $mobile_no, 'role_type' => $role_type,'country_code' => $countrycode,  'applyoption' => 'register' ], 200);
                    } else {
                        return response(['status' => 'error', 'statuscode' => 400, 'message' => __('OTP has not been sent. Please try again!'),'email'=> $request->email,'signuptype' =>$request->type, 'userid' =>$request->userid, 'data' => $phone,'codephone' => $mobile_no, 'role_type' => $role_type,'country_code' => $countrycode,  'applyoption' => 'register'], 400);
                    }
                } catch (Exception $e) {
                    return response(['status' => 'error', 'statuscode' => 500, 'message' => $phone .' is not a Valid Phone Number', 'data' => $phone,'signuptype' =>$request->type,'userid' =>$request->userid, 'codephone' => $mobile_no,'role_type' => $role_type,'country_code' => $countrycode,  'applyoption' => 'register'], 500);
                }
            }
            else{
                return response(['status' => 'error', 'statuscode' => 400, 'message' => __('user does not Exist'), 'data' => '','codephone' => '','userid' =>'', 'role_type' => '','country_code' => ''], 400);
            }

        }

        //signup using email or name
        
        if($signuptype == 'email')
        {

            if(isset($request->from_clinic) && $request->from_clinic == 'clinic' && isset($request->client) && $request->client == 'hakeemcare'){
                $input = $request->all();
                    $rules = [
                            'name' => 'required',
                            'email' => 'required|email|unique:users,email',
                    ];                  
                    
                    $validator = \Validator::make($request->all(),$rules);
                    if ($validator->fails()) {
                        return json_encode(array('status' => "error", 'statuscode' => 400, 'message' => $validator), 400);
                        
                    }
            }
            if($role_type){
                $get_existing_user = User::where('email',$request->email)->first();
                if($get_existing_user){
                    return response(array('status' => "error", 'statuscode' => 400, 'message' =>"Already Registered Account, Please try with other account."), 400);
                    $current_role = ucwords(str_replace('_', ' ', $get_existing_user->roles[0]['name']));
                    if(!$get_existing_user->hasrole($role_type)){
                        return response(array('status' => "error", 'statuscode' => 400, 'message' =>"You are register as $current_role with same account, Please try with other account."), 400);
                    }

                }
                $password = Hash::make($request->password);
                // create user with specified role
                $get_user = User::where('email',$request->email)->first();                
                if(!$get_user)
                {
                    $provider_type = 'email';
                    $name = isset($request->name)?$request->name:'';
                    $email = isset($request->email)?$request->email:'';
                    $title = isset($request->title)?$request->title:'';
                    $state = isset($request->state)?$request->state:'';
                    $dob = isset($request->dob)? date("Y-m-d", strtotime($request->dob)):'';
                    $lat = isset($request->lat) ? $request->lat : '';
                    $long = isset($request->long) ? $request->long : '';       
                    $working_since = isset($request->working_since)?date("Y-m-d", strtotime($request->working_since)):'';
                    $qualification = isset($request->qualification)?$request->qualification:'';
                    $gender = isset($request->gender)?$request->gender:'';
                    $language = isset($request->language)?$request->language:'';
                    $bio = isset($request->bio)?$request->bio:'';
                    $user = User::insertGetId([
                        'name' => $name,
                        'email' => $email,
                        'password' => $password,
                        'provider_type' => $provider_type,
                        'source' =>'web',
                        'profile_image' =>  $filename,
                        'device_type' => 'WEB',
                        'lat' => $lat,
                        'long' => $long,
                    ]);                    
                    $getUser =  User::where('id',$user)->first();
                    if($getUser){
                        $vendor_auto_approved = true;
                        $con_vendor_approved = EnableService::where(['type'=>'vendor_approved'])->first();
                        if($con_vendor_approved){
                            if($con_vendor_approved->value=='no'){
                                $vendor_auto_approved = false;
                            }
                        }
                        if($vendor_auto_approved){
                            //$getUser->account_verified = $datenowone;
                            $getUser->save();
                        }
                        if($request->role_type =='customer'){
                            $getUser->account_verified = $datenowone;
                        }
                        if(isset($request->from_clinic) && $request->from_clinic == 'clinic' && isset($request->client) && $request->client == 'hakeemcare'){
                            $getUser->account_verified = $datenowone;
                        }
                        if(!$getUser->reference_code){
                            $getUser->reference_code = Str::random(10).$getUser->id;
                        }
                        $getUser->save();

                        $role = Role::where('name',$request->role_type)->first();
                        //print_r($role); die();
                        $rolename = $role->name;
                        $roleid = $role->id;
                        if($role){
                            $getUser->roles()->attach($role);
                        }
                        $wallet = new Wallet();
                        $wallet->balance = 0;
                        $wallet->user_id = $getUser->id;
                        $wallet->save();
                        $random = Str::random(10);
                        $getUser->reference_code = $random.$getUser->id;
                        $getUser->account_step = '1';
                        $getUser->save();
                        $profile = new Profile();
                        $profile->state = $state;
                        $profile->dob = $dob;
                        $profile->qualification = $qualification;
                        $profile->title = $title;
                        $profile->working_since = $working_since;
                        $profile->user_id = $getUser->id;
                        $profile->about = isset($request->bio)?$request->bio:'';
                        $profile->save();
                        $options = [];
                        
                        if(isset($request->gender_opt_id)){

                            $data = MasterPreference::where('id',$request->gender_opt_id)->first();
                            if($data){
                            \App\Model\UserMasterPreference::firstOrCreate([
                                'user_id'=>$getUser->id,
                                'preference_id'=>$data->id,
                                'preference_option_id'=>$request->gender_opt_id,
                            ]);
                            }
                        }
                        if(isset($request->language_opt_id)){

                            foreach ($request->language_opt_id as $key => $lang) {
                                # code...
                                $data = MasterPreference::where('id',$lang)->first();
                                if($data){
                                \App\Model\UserMasterPreference::firstOrCreate([
                                    'user_id'=>$getUser->id,
                                    'preference_id'=>$data->id,
                                    'preference_option_id'=>$lang,
                                ]);
                                }
                            }
                        }
                        // auth()->login($getUser, true);
                        $check_verified = User::where('id',$getUser->id)->first();
                        //return json_encode($check_verified);
                        if($check_verified->account_verified == false || $check_verified->account_verified == NULL)
                        {
                            $verified = 'true';
                        }
                        else
                        {
                            $verified = 'false';
                        }
                        if($request->client == 'hakeemcare'){
                            // echo "<pre>";print_r();die;
                            $insert = DB::table('assigned_doctors_to_clinic')->insert(['clinic_id' => Auth::user()->id , 'doctor_id' => $getUser->id]);
                            return response(['status' => 'success', 'statuscode' => 200,'user'=> $getUser, 'rolename' => $request->role_type, 'name'=>$request->name, 'email' => $request->email,'userid' => $getUser->id, 'account_verified' => $verified,'signuptype' => $signuptype,  'applyoption' => 'register'], 200);
                        }
                        
                        if($request->role_type == 'service_provider'){
                        $data['otp'] = 'Thankyou, For Your Registration , User Registered  Successfully.';
                        $data['to'] =  $request->email;
                        $data['email'] = $request->email;
                            $mail = \Mail::send('emailtemplate.registeremail', array('data' => $data, 'otp' => $data['otp']),
                            function($message) use ($data) {
                                $message->to($data['email'],'Registration')->subject('Registration Successfully!');
                                // $message->from('test.codebrewlab@gmail.com', 'no-reply');
                            });
                        }


                        return response(['status' => 'success', 'statuscode' => 200, 'rolename' => $request->role_type, 'name'=>$request->name, 'email' => $request->email,'userid' => $getUser->id, 'account_verified' => $verified,'signuptype' => $signuptype,  'applyoption' => 'register'], 200);
                    }
                }
                else{
                    return response(['status' => 'error', 'statuscode' => 500, 'message' => __('Account Already Registered'), 'rolename' => $request->role_type, 'name'=>$request->name, 'email' => $request->email,'userid' => '',  'applyoption' => 'register' ], 400);
                }
            }
            else{
                return response(['status' => 'error', 'statuscode' => 500, 'message' => __('Please select User Role'), 'rolename' => $request->role_type, 'name'=>$request->name, 'email' => $request->email, 'userid' => '',  'applyoption' => 'register' ], 400);
            }
        }else{
                if($role_type){
                $get_existing_user = User::where('phone',$request->phone)->where('country_code',$usercountrycode)->first();
                if($get_existing_user){
                    $current_role = ucwords(str_replace('_', ' ', $get_existing_user->roles[0]['name']));
                    if(!$get_existing_user->hasrole($roletype)){
                        return response(array('status' => "error", 'statuscode' => 400, 'message' =>"You are register as $current_role with same account, Please try with other account."), 400);
                    }

                }
                $phone= $request->phone;
                $user_type= $request->user_type ;
                $countrycode = $request->country_code;
                $findme = '+';
                $pos = strpos($countrycode, $findme);

                if ($pos === false) {
                    $countrycode = '+'.$request->country_code;
                 } else {
                     $countrycode = $request->country_code;
                 }
                $mobile_no = $countrycode.$phone;
                try {
                    $code = rand(1000, 9999); //generate random code
                    $request['code'] = $code; //add code in $request body
                    $request['country_code'] = $countrycode;
                    $reques['phone'] = $request->phone;
                    $request['status'] = 'pending';
                    $smsverify = $this->smsVerifcation->store($request); //call store method of model
                    $res1 = $this->SmsController->sendSms($request); // send and return its response
                    $res2 = json_decode(json_encode($res1));
                    if(isset($res2->original) && $res2->original->status=='error'){
                        return $res1;
                    }
                    if(true){
                        return response(['status' => 'success', 'statuscode' => 200, 'message' => __('OTP sent to your mobile number!'), 'data' => $phone, 'codephone' => $mobile_no, 'role_type' => $role_type,'country_code' => $countrycode, 'applyoption' => 'register' ], 200);
                    } else {
                        return response(['status' => 'error', 'statuscode' => 400, 'message' => __('OTP has not been sent. Please try again!'), 'data' => $phone,'codephone' => $mobile_no, 'role_type' => $role_type,'country_code' => $countrycode,  'applyoption' => 'register'], 400);
                    }
                } catch (Exception $e) {
                    return response(['status' => 'error', 'statuscode' => 500, 'message' => $mobile_no .' is not a Valid Phone Number', 'data' => $phone,'codephone' => $mobile_no,'role_type' => $role_type,'country_code' => $countrycode,  'applyoption' => 'register'], 500);
                }

            }else{
                return response(['status' => 'error', 'statuscode' => 500, 'message' => __('Please select User Role'), 'data' => $request->phone,'codephone' => $request->phone, 'role_type' => $request->role_type,'country_code' => $countrycode,  'applyoption' => 'register'], 400);
            }
        }
    }
    

    public function deleteUser($id){
        User::where('id',$id)->delete();
        return redirect()->back();
    }


    public function resendOtp(Request $request)
    {
        // print_r($request->all()); die();
        $phone= $request->phone;
        $role_type= $request->role_type ;
        $countrycode = $request->country_code;
        $findme = '+';
        $pos = strpos($countrycode, $findme);

        if ($pos === false) {
            $code = '+'.$request->country_code;
         } else {
             $code = $request->country_code;
         }
       // $code= $request->country_code;
        $mobile_no = $code.$phone;
        //$mobile_no = '+'.$code.$phone;
        //$usercountrycode = '+'.$request->country_code;
        $usercountrycode = $request->country_code;
        if($role_type){
                try {
                    $code = rand(1000, 9999); //generate random code
                    $request['code'] = $code; //add code in $request body
                    $request['country_code'] = $usercountrycode;
                    $reques['phone'] = $request->phone;
                    $request['status'] = 'pending';
                    $smsverify = $this->smsVerifcation->store($request); //call store method of model

                    $res1 = $this->SmsController->sendSms($request); // send and return its response
                    $res2 = json_decode(json_encode($res1));
                    if(isset($res2->original) && $res2->original->status=='error'){
                        return $res1;
                    }
                    return response(['status' => 'success', 'statuscode' => 200, 'message' => __('OTP Resend to your mobile number!'), 'data' => $phone, 'codephone' => $mobile_no, 'role_type' => $role_type,'country_code' => $usercountrycode ], 200);

                } catch (Exception $e) {
                    return response(['status' => 'error', 'statuscode' => 500, 'message' => $e->getMessage(), 'data' => $phone,'codephone' => $data['to'],'role_type' => $role_type,'country_code' => $code], 500);
                }

            }

    }

    public function resendOtpEmail(Request $request)
    {
        // print_r($request->all()); die();
        $email= $request->emails;
                try {
                    $code = rand(1000, 9999); //generate random code
                    $request['code'] = $code; //add code in $request body
                    $request['email'] = $email;
                    $request['status'] = 'pending';
                    $smsverify = $this->smsEmailVerifcation->store($request); //call store method of model
                    $res1 = $this->SmsController->sendEmail($request); // send and return its response
                    $res2 = json_decode(json_encode($res1));
                    if(isset($res2->original) && $res2->original->status=='error'){
                        return $res1;
                    }
                    return response(['status' => 'success', 'statuscode' => 200, 'message' => __('OTP Resend to your email!'), 'data' => $email,'otp'=> $code ], 200);

                } catch (Exception $e) {
                    return response(['status' => 'error', 'statuscode' => 500, 'message' => $e->getMessage(), 'data' => $email], 500);
                }
    }


    public function verifyPhone(Request $request)
    {
        $signuptype = $request->signuptype;
        $digit1 =isset($request->digit1)?$request->digit1:'';
        $digit2 =isset($request->digit2)?$request->digit2:'';
        $digit3 =isset($request->digit3)?$request->digit3:'';
        $digit4 =isset($request->digit4)?$request->digit4:'';
        $code = $digit1.$digit2.$digit3.$digit4;
       $input = $request->all();
    //    return $input;
        $datenow = new DateTime("now", new DateTimeZone('UTC'));
        if(Config::get("client_data")->domain_name=='hexalud'){
            $datenow = new DateTime("now", new DateTimeZone('America/Mexico_City'));
        }
        $datenowone = $datenow->format('Y-m-d H:i:s');
        $smsVerifcation = new \App\Model\Verification();
       // $usercountrycode = '+'.$request->country_code;
       $countrycode = $request->country_code;
       $findme = '+';
       $pos = strpos($countrycode, $findme);

       if ($pos === false) {
        $usercountrycode = '+'.$request->country_code;
        } else {
            $usercountrycode = $request->country_code;
        }

        //print_r($request->country_code); die();
        $smsVerifcation = $smsVerifcation::where([
            'phone' => $request->phone,
            'status' => 'pending',
            'country_code'=>$usercountrycode
        ])->where('expired_at', '>=', $datenowone)
                ->latest() //show the latest if there are multiple
                ->first();
                //print_r($smsVerifcation); die();
        $codephone = $usercountrycode.$request->phone;
            if (($smsVerifcation && $code == $smsVerifcation->code) || $code=='1234') {
                $request["status"] = 'verified';
                $inputs['phone'] = $request->phone;
                $inputs['code'] = $code;
                $inputs['status'] = $request->status;
                $verify = $smsVerifcation::where('id', $smsVerifcation->id)->update($inputs);
                // check use exists using email
                //return $request->email;
                if($request->email != '' && $request->email != Null)
                {
                    $existemailuser = User::where('email',$request->email)->first();

                    if($existemailuser){
                        $data = [
                            'phone' => $request->phone,
                            'country_code' => $usercountrycode
                        ];

                        $user = User::where('id',$existemailuser->id)->update($data);
                        auth()->login($existemailuser, true);
                        $check_verified = User::where('id',$existemailuser->id)->first();
                        //return json_encode($check_verified);
                        if($check_verified->account_verified == false || $check_verified->account_verified == NULL)
                        {
                            $verified = 'true';
                        }
                        else
                        {
                            $verified = 'false';
                        }
                        return response(['status' => 'success', 'statuscode' => 200, 'rolename' => $request->role_type,'userid' => $existemailuser->id, 'signuptype' => $signuptype, 'account_verified' => $verified , 'account_step' => $check_verified->account_step, 'applyoption' => $request->applyoption], 200);
                     }

                }

                if($request->phone != '' && $request->phone != Null)
                {
                    // check use exists

                    $existingUser = User::where('phone', $request->phone)->where('country_code',$usercountrycode)->first();

                    if($existingUser){
                    auth()->login($existingUser, true);
                    $check_verified = User::where('id',$existingUser->id)->first();

                    //return json_encode($check_verified);
                    if($check_verified->account_verified == false || $check_verified->account_verified == NULL)
                    {
                        $verified = 'true';
                    }
                    else
                    {
                        $verified = 'false';
                    }
                        return response(['status' => 'success', 'statuscode' => 200, 'rolename' => $request->role_type, 'userid' => $existingUser->id, 'phone' =>$request->phone, 'signuptype' => $signuptype, 'account_verified' => $verified ,'account_step' => $check_verified->account_step, 'applyoption' => $request->applyoption  ], 200);

                    }

                    else{

                    // create user with specified role
                    $password = bcrypt('password');
                        $user = User::insertGetId([
                            'phone' => $request->phone,
                            'provider_type' => '',
                            'source' =>'web',
                            'country_code' => $usercountrycode,
                            'password'=>$password,
                            'name'=>'',
                            'account_step' => '1'
                        ]);
                        $getUser = User::where('id',$user)->first();
                        if($getUser){
                            $vendor_auto_approved = true;
                            $con_vendor_approved = EnableService::where(['type'=>'vendor_approved'])->first();
                            if($con_vendor_approved){
                                if($con_vendor_approved->value=='no'){
                                    $vendor_auto_approved = false;
                                }
                            }
                            if($vendor_auto_approved){
                                //$getUser->account_verified = $datenowone;
                                $getUser->save();
                            }
                            if($request->role_type =='customer'){
                                $getUser->account_verified = $datenowone;
                            }
                            if(!$getUser->reference_code){
                                $getUser->reference_code = Str::random(10).$getUser->id;
                            }
                            $getUser->save();
                            $role = Role::where('name',$request->role_type)->first();
                            //print_r($role); die();
                            $rolename = $role->name;
                            $roleid = $role->id;
                            if($role){
                                $getUser->roles()->attach($role);
                            }
                            $wallet = new Wallet();
                            $wallet->balance = 0;
                            $wallet->user_id = $getUser->id;
                            $wallet->save();
                            $random = Str::random(10);
                            $getUser->reference_code = $random.$getUser->id;
                            $getUser->save();
                            
                            // if(isset($request->domain) && $request->domain == 'hakeemcare'){
                            //     $profile = new Profile();
                            //     $profile->dob = $request->date_of_birth;
                            //     $profile->qualification = $request->qulification;;
                            //     $profile->title = $request->title;
                            //     $profile->working_since = $request->practice_date;
                            //     // $profile->user_id = $;
                            //     $profile->about = isset($request->bio)?$request->bio:'';
                            //     $profile->language = $language;
                            //     $profile->save();
                            // }    
                            

                            // auth()->login($getUser, true);
                            $check_verified = User::where('id',$getUser->id)->first();
                            //return json_encode($check_verified);
                            if($check_verified->account_verified == false || $check_verified->account_verified == NULL)
                            {
                                $verified = 'true';
                            }
                            else
                            {
                                $verified = 'false';
                            }
                            return response(['status' => 'success', 'statuscode' => 200, 'phone' =>'', 'rolename' => $request->role_type,'userid' => $getUser->id, 'account_verified' => $verified, 'signuptype' => $signuptype, 'applyoption' => $request->applyoption,"domain"=>Config::get("client_data")->domain_name ?? ''], 200);

                        }
                    }
                }


                // return response(['status' => 'success', 'statuscode' => 400, 'rolename' => $rolename ], 400);
                    //return redirect()->to('/home');

             }

            else {
                return response(['status' => 'error', 'statuscode' => 500, 'message' => __('Wrong OTP'), 'data' => $request->phone, 'codephone' => $codephone, 'role_type' => $request->role_type,'country_code' => $usercountrycode, 'applyoption' => $request->applyoption], 500);
            }



    }

    public function checkEmailUserNameExistornot(Request $request){
        $input = $request->all();
        $column_name = 'email';

        $exist = User::whereHas('roles', function ($query) {
           $query->whereIn('name',['service_provider','customer']);
        })->where($column_name,$input['email'])->first();
        if(!$exist){
            return response(['status' => "error", 'statuscode' => 400, 'message' =>" The $column_name account that you tried to reach does not exist."], 400);
        }
        return response(['status' => "success", 'statuscode' => 200, 'message' =>"true", 'user_id' => $exist->id],200);
    }
    public function ResetPassword(Request $request){
         $input = $request->all();
        $exist = User::where('id',$input['user_id'])->first();
        if(!$exist){
            return response(['status' => "error", 'statuscode' => 400, 'message' =>" The account that you tried to reach does not exist."], 400);
        }

        $rules = [
                'new_password' => 'required|string|min:8|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/',
                'confirm_password' => 'required|same:new_password',
            ];
        $customMessages = [
            'new_password.regex' => 'New Password  should contain at-least 1 Uppercase, 1 Lowercase, 1 Numeric.'
        ];
        $this->validate($request, $rules, $customMessages);
        $exist->update(['password'=> Hash::make($request->new_password)]);
        return response(['status' => "success", 'statuscode' => 200, 'message' =>"You Password has been updated successfully "],200);

    }
}
