<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    public function users(){
        return $this->belongsTo('App\User');
    }

    public function dishes(){
        return $this->belongsTo('App\Dish');
    }

    public function categories() {
        return $this->belongsToMany('App\Category');
    }
}
