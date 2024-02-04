<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Operation extends Model
{
	protected $table='operations';
    protected $timestamp=true;
    protected $fillable = [ 'user_id','category_id','sub_category_id','title','description','price','status'];

    public function addOperation($data)
    {
    	return self::create([
    		'user_id' => $data['user_id'],
    		'category_id' => $data['category_id'],
    		'sub_category_id' => $data['sub_category_id'],
    		'title' => $data['title'],
    		'description' => $data['description'],
    		'price' => $data['price'],
    		'status' => config('constants.status.ACTIVE'),
    	]);
    }
    public function updateOperation($data)
    {
    	return self::where('id',$data['operation_id'])->update([
    		'category_id' => $data['category_id'],
    		'sub_category_id' => $data['sub_category_id'],
    		'title' => $data['title'],
    		'description' => $data['description'],
    		'price' => $data['price'],
    		'status' => $data['status']??config('constants.status.ACTIVE'),
    	]);
    }

	

    public function deleteOperation($id)
    {
    	return self::where('id',$id)->delete();
    }
	
    public function medias()
    {
        return $this->hasMany('App\Model\OperationMedia','operation_id','id');
    }

}
