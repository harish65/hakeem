<?php

namespace App\Http\Middleware;

use Closure;


use Cookie;
use Config;
use DB;
use App\User;
use Auth;
use Session;
class DataBaseConnectionDynamic
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $timezone = Config::get('constants.DEFAULT_TIMEZONE');
        if($request->headers->has('timezone')){
            $timezone = $request->header('timezone');
        }
        Config::set("timezone",$timezone);
        if($request->headers->has('app-id')){
              $app_id = $request->header('app-id');
              $client = DB::connection('godpanel')->table('clients')->where('client_key',$app_id)->first();
             if($client){
                $client->payment_type = 'stripe';
                $client->gateway_key = '';
                $client->gateway_secret = '';
                $client_features = DB::connection('godpanel')->table('godpanel_client_features')->where('client_id',$client->id)->pluck('feature_id')->toArray();
               $client_features2 = \App\Model\GodPanel\ClientFeature::select('id as client_feature_id','client_id','feature_id','feature_values')
                ->where(['client_id'=>$client->id])
                ->get();
                foreach ($client_features2 as $key => $client_feature) {
                    if($client_feature->feature_values){
                        $client_feature->feature_values = json_decode($client_feature->feature_values,true);
                        $client_feature_key_values = [];
                        foreach ($client_feature->feature_values as $key_id => $value) {
                            $featurekey = \App\Model\GodPanel\FeatureKey::where('id',$key_id)
                            ->first();
                            if($featurekey){
                                if(strtolower($client_feature->feature->name)=='razor pay' && ($client->domain_name=='healtcaremydoctor' || $client->domain_name=='physiotherapist' || $client->domain_name=='curenik' || $client->domain_name=='taradoc'|| $client->domain_name=='telegreen' || $client->domain_name=='hexalud' || $client->domain_name=='medex')){
                                    $client->{$featurekey->key_name} = $value;
                                }
                                if(strtolower($client_feature->feature->name)=='al rajhi bank' && ($client->domain_name=='homedoctor')){
                                    $client->payment_type = 'al_rajhi_bank';
                                }else if(strtolower($client_feature->feature->name)=='hyperpay' && ($client->domain_name=='heal')){
                                    $client->{$featurekey->key_name} = $value;
                                }else if(strtolower($client_feature->feature->name)=='paystack' && ($client->domain_name=='airdoc')){
                                    $client->{$featurekey->key_name} = $value;
                                }else if(strtolower($client_feature->feature->name)=='paystack' && ($client->domain_name=='clouddoc')){
                                    $client->{$featurekey->key_name} = $value;
                                }else if (strtolower($client_feature->feature->name) == 'telr' && ($client->domain_name == 'iedu')) {
                                    $client->{$featurekey->key_name} = $value;
                                }
                            }
                        }
                    }
                }
                $database_name = 'db_'.$client->db_id;
                $default = [
                    'driver' => env('DB_CONNECTION','mysql'),
                    'host' => env('DB_HOST'),
                    'port' => env('DB_PORT'),
                    'database' => $database_name,
                    'username' => env('DB_USERNAME'),
                    'password' => env('DB_PASSWORD'),
                    'charset' => 'utf8mb4',
                    'collation' => 'utf8mb4_unicode_ci',
                    'prefix' => '',
                    'prefix_indexes' => true,
                    'strict' => false,
                    'engine' => null
                ];
                $builds = (object)[];
                $builds->ios_url = \App\Helpers\Helper::getClientFeatureKeys('Build Urls','IOS Url');
                $builds->android_url = \App\Helpers\Helper::getClientFeatureKeys('Build Urls','Android Url');
                Config::set("builds",$builds);

                Config::set("database.connections.$database_name", $default);
                Config::set("client_features", $client_features);
                Config::set("client_id", $client->id);
                Config::set("client_connected",true);
                Config::set("client_data",$client);
                DB::setDefaultConnection($database_name);
                DB::purge($database_name);
            }
        }
        return $next($request);
    }
}
