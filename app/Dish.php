<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    public function restaurants(){
        return $this->belongsTo('App\Restaurant');
    }

    public function menu_sections(){
        return $this->belongsTo('App\MenuSection');
    }
}
