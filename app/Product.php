<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    public function orderList(){
        return $this->hasMany(OrderList::class);
    }
}
