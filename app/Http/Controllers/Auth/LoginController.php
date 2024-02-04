<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Socialite;
use App\User;
use Auth;
use Config;
use Session;
use DB;
use App\Model\Role;
use App\Model\Wallet;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers{
        logout as performLogout;
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function logout(Request $request) {
        $user = Auth::user();
        $redirect = '/';
        if ($user->hasrole('admin')) {
            $redirect = 'admin/login';
        }
        if ($user->hasrole('doctor_manager')) {
            $redirect = 'admin/login';
        }
        $this->performLogout($request);
        return redirect($redirect);
    }

    protected function authenticated(Request $request, $user){
        
        if ($user->hasrole('admin') && $user->type == 'user') {
            return redirect('/admin/dashboard');
        }
        if ($user->hasrole('doctor_manager') && $user->type == 'user') {
            return redirect('/admin/dashboard');
        }
        if($user->hasrole('godadmin')){
            return redirect('/godpanel/dashboard');
        }
        if($user->type == 'clinic'){
            return redirect('/clinic/dashboard');
        }
        // if($user->hasrole('service_provider')){
        //     return redirect('/service_provider/manage_availibilty');
        // }

        // return redirect('/home');
    }

    public function redirectToProvider(Request $request )
    {
        // dd($request->all());
        // $request->session()->put('role', );
        Session::put('role', $request->role);
        return Socialite::driver($request->type)
        // ->redirectUrl('https://hexalud.royoconsult.com/callback/google/'.$request->role)
        ->redirect();
    }

    /**
     * Obtain the user information from Google.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback(Request $request)
    {
        // dd($request->all(),$type);
        try {

            $user = Socialite::driver('google')->user();




        } catch (\Exception $e) {
            // print_r($e->getMessage());die;
            return abort(500);
        }
        // only allow people with @company.com to login
        // if(explode("@", $user->email)[1] !== 'company.com'){
        //     return redirect()->to('/');
        // }
        // check if they're an existing user
        $roles=Session::get('role');
        // dd($roles);
        Session::forget('role',$roles);
        if($roles=='patient'){
            $roles='customer';
        }
        if($roles=='doctor'){
            $roles='service_provider';
        }
        // dd($role);
        $existingUser = User::where('email', $user->email)->first();
        if($existingUser){
            auth()->login($existingUser, true);
            // if (Config::get('client_connected') && Config::get("client_data")->domain_name=="hexalud") {
            //     if($roles='service_provider'){
            //         Session::forget('role',$roles);
            //         if($existingUser->account_step==4){
            //             return redirect('/');
            //         }else{
            //             return redirect('/profile/profile-setup-one/'.$existingUser->id);
            //         }


            //     }
            // }
        } else {
            if (Config::get('client_connected') && (Config::get("client_data")->domain_name=="telegreen" || Config::get("client_data")->domain_name=="hexalud" || Config::get("client_data")->domain_name=="iedu" || Config::get("client_data")->domain_name=="912consult")) {

                $add = new User;
                $add->email = $user->email;
                $add->name =$user->name;
                $add->provider_type='google';
                $add->save();

                $role = Role::where('name',$roles)->first();
                // print_r($role); die();
                $rolename = $role->name;
                $roleid = $role->id;
                if($role){
                    DB::table('role_user')->insert(['role_id'=>$roleid,'user_id'=>$add->id]);
                }
                $wallet = new Wallet();
                $wallet->balance = 0;
                $wallet->user_id = $add->id;
                $wallet->save();
                auth()->login($add, true);
                if($roles=='service_provider'){
                    Session::forget('role',$roles);
                    return redirect('/profile/profile-setup-one/'.$add->id);
                }
            }
        }
        Session::forget('role',$roles);
        return redirect()->to('/');
    }

     /**
     * Obtain the user information from Google.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallbackFacebook(Request $request)
    {
        try {
            $user = Socialite::driver('facebook')->user();
            // dd($user);
        } catch (\Exception $e) {
            // print_r($e->getMessage());die;
            return abort(422);
        }
        // only allow people with @company.com to login
        // if(explode("@", $user->email)[1] !== 'company.com'){
        //     return redirect()->to('/');
        // }
        // check if they're an existing user
        $roles=Session::get('role');
        Session::forget('role',$roles);
        if($roles=='patient'){
            $roles='customer';
        }
        if($roles=='doctor'){
            $roles='service_provider';
        }
        $existingUser = User::where('email', $user->email)->first();
        if($existingUser){
            auth()->login($existingUser, true);
        } else {
            if (Config::get('client_connected') && (Config::get("client_data")->domain_name=="telegreen" || Config::get("client_data")->domain_name=="hexalud" || Config::get("client_data")->domain_name=="912consult")) {

                $add = new User;
                $add->email = $user->email;
                $add->name =$user->name;
                $add->provider_type='facebook';
                $add->save();

                $role = Role::where('name',$roles)->first();
                // print_r($role); die();
                $rolename = $role->name;
                $roleid = $role->id;
                if($role){
                    DB::table('role_user')->insert(['role_id'=>$roleid,'user_id'=>$add->id]);
                }
                $wallet = new Wallet();
                $wallet->balance = 0;
                $wallet->user_id = $add->id;
                $wallet->save();
                auth()->login($add, true);
                if($roles=='service_provider'){

                    return redirect('/profile/profile-setup-one/'.$add->id);
                }
            }
        }
        Session::forget('role',$roles);
        return redirect()->to('/');
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showHomePage()
    {
        return redirect('/');
    }


    public function clinicLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
   
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {

            return redirect()->intended('dashboard')
                        ->withSuccess('You have Successfully loggedin');
        }
  
        return redirect("login")->withSuccess('Oppes! You have entered invalid credentials');
    }
}
