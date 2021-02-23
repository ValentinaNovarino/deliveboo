<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function restaurants(){
        return $this->belongsTo('App\Restaurant');
    }

    protected $fillable = ['order_price', 'delivery_price', 'delivery_time', 'discount', 'final_price', 'guest_name', 'guest_lastname', 'guest_address', 'guest_city', 'guest_mobile', 'guest_email'];
    // protected $fillable = ['restaurant_id', 'order_price', 'delivery_price', 'delivery_time', 'discount', 'final_price', 'guest_name', 'guest_lastname', 'guest_address', 'guest_city', 'guest_mobile', 'guest_email'];
}
