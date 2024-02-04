<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Category extends Model
{
	 protected $fillable = ['parent_id', 'name','image','description','multi_select','color_code','time_slot','image_icon','doctor_service'];

	 use SoftDeletes;
	/**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];

    protected $appends = ['hourly','full_day'];

    public function subcategory(){
        return $this->hasMany('App\Model\Category', 'parent_id');
    }
    public function parent(){
        return $this->hasOne('App\Model\Category','id','parent_id');
    }

    public function filters(){
        return $this->hasMany('App\Model\FilterType', 'category_id');
    }
    public function additionals(){
        return $this->hasMany('App\Model\AdditionalDetail', 'category_id');
    }
    public function symptoms(){
        return $this->hasMany('App\Model\CategorySymptom', 'category_id');
    }
    public function services(){
        return $this->hasMany('App\Model\CategoryServiceType', 'category_id');
    }

    public function getHourlyAttribute()
    {
        $slots = explode(',',$this->time_slot);
        if(in_array(1,$slots)){
            return true;
        }
        return false;
    }

    public function getFullDayAttribute()
    {
        $slots = explode(',',$this->time_slot);
        if(in_array(2,$slots)){
            return true;
        }
        return false;
    }

    public function getColorCodeAttribute($value) {
        if($value){
            return '#'.$value;
        }else{
            return null;
        }
    }

   }
