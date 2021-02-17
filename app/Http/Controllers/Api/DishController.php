<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Dish;
use App\Restaurant;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class DishController extends Controller
{
    public function dishes(Dish $dish) {


    $data = Dish::all();
    return response()->json([
        'succes' => true,
        'response' => $data,
    ]);
}
    public function restaurants(Dish $dish) {


    $data = Restaurant::all();
    return response()->json([
        'succes' => true,
        'response' => $data,
    ]);
}
}
