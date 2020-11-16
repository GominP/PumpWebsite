<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderList extends Model
{
    public function order(){
        return $this->hasMany(Order::class);
    }

    public function user(){
        return $this->hasMany(User::class);
    }
}
