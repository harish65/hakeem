<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CategorySymptom extends Model
{
    public function category()
    {
        return $this->hasOne('App\Model\Category','id','category_id');
    }

    
}
