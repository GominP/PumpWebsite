<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderList extends Model
{
    public function order(){
        return $this->belongsTo(Order::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
