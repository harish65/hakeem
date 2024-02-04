<?php

namespace App\Http\Middleware;

use Closure;


use Cookie;
use Config;
use DB;
use App\User;
use Auth;
use Session;
class DataBaseConnectionDynamicWeb
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
        Config::set("default",true);
        if(isset($_SERVER['HTTP_HOST'])){
            $database_name = strstr($_SERVER["HTTP_HOST"], '.', true);
	    if($database_name){
            if($database_name=='dashboard'){
              $database_name = 'mataki';
            }
            $client = DB::connection('godpanel')->table('clients')->where('domain_name','=',$database_name)->first();
                if($client){
                    if($client->db_id!=="default"){
                        Config::set("default",false);
		              }
                    $client->payment_type = 'stripe';
                    $client->gateway_key = '';
                    $client->gateway_secret = '';
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
                                    if(strtolower($client_feature->feature->name)=='razor pay' && ($client->domain_name=='healtcaremydoctor' || $client->domain_name=='physiotherapist' || $client->domain_name=='curenik' || $client->domain_name=='taradoc'|| $client->domain_name=='telegreen'|| $client->domain_name=='hexalud' || $client->domain_name=='medex')){
                                        $client->{$featurekey->key_name} = $value;
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
                    $client_features = [];
                    $builds = (object)[];
                    Config::set("client_id", $client->id);
                    Config::set("client_connected",true);
                    Config::set("client_data",$client);
                    $builds->ios_url = \App\Helpers\Helper::getClientFeatureKeys('Build Urls','IOS Url');
                    $builds->android_url = \App\Helpers\Helper::getClientFeatureKeys('Build Urls','Android Url');
                    $client_feature_type = \App\Model\GodPanel\ClientFeature::where('client_id',$client->id)->pluck('feature_id')->toArray();
                    if($client_feature_type){
                        $client_features = \App\Model\GodPanel\Feature::whereIn('id',$client_feature_type)->groupBy('feature_type_id')->get();
                    }
                    Config::set("client_features",$client_features);
                    Config::set("builds",$builds);
                }
            }
        }
        return $next($request);
    }
}
