<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];
    public function district(){
        return $this->belongsTo(District::class);
    }
    public function getTotalAttribute(){
        return $this->subtotal + $this->cost;
    }
    public function customer(){
        return $this->belongsTo(Customer::class);
    }
}
