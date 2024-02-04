<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class OperationMedia extends Model
{
    protected $table='operation_media';
    protected $timestamp=true;
    protected $fillable = [ 'operation_id','media_type','media','thumbnail'];

    public function addOperationMedia($data)
    {
    	return self::create([
    		'operation_id' => $data['operation_id'],
    		'media_type' => $data['media_type'],
    		'media' => $data['media'],
    		'thumbnail' => $data['thumbnail']??null,
    	]);
    }
    public function deleteOperationMedia($operation_id)
    {
    	return self::where('operation_id',$operation_id)->delete();
    }

}
