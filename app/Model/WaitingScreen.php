<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class WaitingScreen extends Model
{
    public function getCategory($category_id)
    {
        $category= \App\Model\Category::find($category_id);

        return $category;
    }
}
