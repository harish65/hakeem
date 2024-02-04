<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Service;
use App\Model\Country;
use App\Model\State;
use App\Model\City;
use App\Model\Subscription;
use illuminate\Database\Eloquent\SoftDeletes;
class Profile extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','address', 'dob', 'name','pet_category_id','color','avatar','special_marking','pet_breed_id','qualification','city','state','country','experience','rating','about','user_id','speciality','call_price','chat_price','gender','weight','language'
    ];

    protected $appends = ['address_hide','dob_hide','qualification_hide','state_hide','gender_hide','experience_hide','speciality_hide','working_since_hide'];


    public function getAddressHideAttribute()
    {
        $res = false;
        $hide_inputs = EnableService::where('type', 'hide_inputs')->first();
        if($hide_inputs){
            $inputs = explode(',',$hide_inputs->value);
            $res = (in_array("profile.address", $inputs))?true:false;
        }
        return $res;
    }

    public function getDobHideAttribute()
    {
        $res = false;
        $hide_inputs = EnableService::where('type', 'hide_inputs')->first();
        if($hide_inputs){
            $inputs = explode(',',$hide_inputs->value);
            $res = (in_array("profile.dob", $inputs))?true:false;
        }
        return $res;
    }

    public function getQualificationHideAttribute()
    {
        $res = false;
        $hide_inputs = EnableService::where('type', 'hide_inputs')->first();
        if($hide_inputs){
            $inputs = explode(',',$hide_inputs->value);
            $res = (in_array("profile.qualification", $inputs))?true:false;
        }
        return $res;
    }

    public function getStateHideAttribute()
    {
        $res = false;
        $hide_inputs = EnableService::where('type', 'hide_inputs')->first();
        if($hide_inputs){
            $inputs = explode(',',$hide_inputs->value);
            $res = (in_array("profile.state", $inputs))?true:false;
        }
        return $res;
    }

    public function getGenderHideAttribute()
    {
        $res = false;
        $hide_inputs = EnableService::where('type', 'hide_inputs')->first();
        if($hide_inputs){
            $inputs = explode(',',$hide_inputs->value);
            $res = (in_array("profile.gender", $inputs))?true:false;
        }
        return $res;
    }

    public function getExperienceHideAttribute()
    {
        $res = false;
        $hide_inputs = EnableService::where('type', 'hide_inputs')->first();
        if($hide_inputs){
            $inputs = explode(',',$hide_inputs->value);
            $res = (in_array("profile.experience", $inputs))?true:false;
        }
        return $res;
    }

    public function getSpecialityHideAttribute()
    {
        $res = false;
        $hide_inputs = EnableService::where('type', 'hide_inputs')->first();
        if($hide_inputs){
            $inputs = explode(',',$hide_inputs->value);
            $res = (in_array("profile.speciality", $inputs))?true:false;
        }
        return $res;
    }

    public function getWorkingSinceHideAttribute()
    {
        $res = false;
        $hide_inputs = EnableService::where('type', 'hide_inputs')->first();
        if($hide_inputs){
            $inputs = explode(',',$hide_inputs->value);
            $res = (in_array("profile.working_since", $inputs))?true:false;
        }
        return $res;
    }
    public function getRatingHideAttribute()
    {
        $res = false;
        $hide_inputs = EnableService::where('type', 'hide_inputs')->first();
        if($hide_inputs){
            $inputs = explode(',',$hide_inputs->value);
            $res = (in_array("profile.rating", $inputs))?true:false;
        }
        return $res;
    }


    public function getLocationAttribute()
    {
       return ["name"=>$this->location_name,"lat"=>$this->lat,"long"=>$this->long];
    }
    public function getRatingAttribute($value) {
        return round($value, 2);
    }

    public function getDobAttribute($value) {
        if($value=='0000-00-00'){
            return null;
        }else{
            return $value;
        }
    }

    public function getAcceptSelfPayAttribute($value) {
        if($value){
            return true;
        }else{
            return false;
        }
    }

    public function getCountryAttribute($value) {
        $country =  Country::where('id',$value)->first();
        if($country)
            $value = $country->name;
        return $value;
    }

    public function getStateAttribute($value) {
        $state =  State::where('id',$value)->first();
        if($state)
            $value = $state->name;
        return $value;
    }

    public function getCityAttribute($value) {
        $city =  City::where('id',$value)->first();
        if($city)
            $value = $city->name;
        return $value;
    }

    public function setSubscription($profile){
    	if($profile->call_price){
    		$service_id = Service::getServiceId('call');
    		$subscription = Subscription::where([
    			'consultant_id'=>$profile->user_id,
    			'service_id'=>$service_id])
    		->first();
    		if($subscription){
    			$subscription->duration = 60;
    			$subscription->charges = $profile->call_price;
    			$subscription->save();
    		}
    	}
    	if($profile->chat_price){
    		$service_id = Service::getServiceId('chat');
    		$subscription = Subscription::where([
    			'consultant_id'=>$profile->user_id,
    			'service_id'=>$service_id])
    		->first();
    		if($subscription){
    			$subscription->duration = 60;
    			$subscription->charges = $profile->chat_price;
    			$subscription->save();
    		}
    	}
    }

    public function PetCategory(){
        return $this->belongsTo(PetCategory::class,'pet_category_id','id');
    }

    public function PetBreed(){
        return $this->belongsTo(PetBreed::class,'pet_breed_id','id');
    }
}
