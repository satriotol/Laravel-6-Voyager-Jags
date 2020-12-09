<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function colour()
    {
        return $this->hasMany('App\Colour','colours');
    }
}
