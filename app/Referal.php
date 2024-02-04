<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Referal extends Model
{
    protected $fillable = [
        'patient_id', 'doctor_m_id', 'doctor_re_id'
    ];
}
