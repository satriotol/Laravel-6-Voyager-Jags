<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    public function city()
    {
        return $this->belongsTo(City::class);
    }
    public function province()
    {
        return $this->belongsTo(Province::class);
    }
}
