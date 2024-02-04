<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CsvFiles extends Model
{
    //
    protected $fillable = ['file_name','file_path','file_description','thumbnail_path','file_type','type','status'];
}
