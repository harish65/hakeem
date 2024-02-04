<?php

namespace App\Model;
use Illuminate\Database\Eloquent\Model;
use illuminate\Database\Eloquent\SoftDeletes;

class Medicines extends Model
{
    //
    use SoftDeletes;
    protected $fillable = ['name','date_intake','time_intake','dosage','dose_from','notes','status','profile_id'];
}
