<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserPincode extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function pincode()
    {
        return $this->belongsTo('App\Model\Pincode', 'pincode_id', 'id');
    }
}
