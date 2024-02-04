<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
class Rewards extends Model
{

    public function wallet()
    {
        return $this->belongsTo('App\Model\Wallet','wallet_id','id');
    }

    
}
