<?php

namespace App\Model;
use Illuminate\Database\Eloquent\Model;
use illuminate\Database\Eloquent\SoftDeletes;

class Vaccination extends Model
{
    //
    use SoftDeletes;
    protected $fillable = ['name','date_adminstrated','pet_weight','next_vaccination_date','veternation',
                            'veternation_license_number','lot_number','profile_id','status'];
}
