<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Category;
use Config;
class CategoryServiceProvider extends Model
{
    //
	 //
    protected $table = 'category_service_provider';

    protected $fillable = ['sp_id'];

    public function getCategoryData($cat_id){
    	$cat = Category::where('id',$cat_id)->first();
    	if($cat){
            $cat->is_filters = false;
            if($cat->filters->count() > 0){
                $cat->is_filters = true;
            }
    		$cat->is_additionals = false;
            if($cat->additionals->count() > 0){
                $cat->is_additionals = true;
            }
            if(\Config::get('client_connected') && \Config::get('client_data')->domain_name=='curenik'){

                $cat->cure_additionals=\App\Model\AdditionalDetail::get();
                $cat->is_additionals = true;

            }

            unset($cat->additionals);
            unset($cat->filters);
    	}
    	return $cat;
    }

    public function getCategorysData($cat_id){
        $cat = Category::where('id',$cat_id)->first();
        if($cat){
            $cat->is_filters = false;
            if($cat->filters->count() > 0){
                $cat->is_filters = true;
            }
            $cat->is_additionals = false;
            if($cat->additionals->count() > 0){
                $cat->is_additionals = true;
            }
            unset($cat->additionals);
            unset($cat->filters);
        }
        return $cat;
    }

    public function user()
    {
        return $this->hasOne('App\User','id','sp_id');
    }


    public function users() {

        return $this->belongsTo('App\User','sp_id','id');
    }
}
