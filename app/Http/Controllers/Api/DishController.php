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
    public function index(Dish $dish) {

        // $dishA = Dish::find(1);
        // dd(Auth::user()->id);
    //     for ($i=0; $i < 5 ; $i++) {
    //         $newDish = new Dish();
    //         $newDish->name = 'pippo';
    //         dd($dish->restaurants());
    //         // code...
    //     }
    //
    // $userRestaurant = Restaurant::where('user_id', Auth::user()->id)->get();
    // $arrayRid = [];
    // for ($i=0; $i < count($userRestaurant) ; $i++) {
    //     $rid = $userRestaurant[$i]->id;
    //     $newDisches = Dish::where('restaurant_id', $rid)->get();
    //     $arrayRid[] = $newDisches;
    // }
    //
    // $data = [
    //     'dishes' => $arrayRid,
    //     'restaurants' => $userRestaurant
    // ];

    $data = Dish::all();
    return response()->json([
        'succes' => true,
        'response' => $data,
    ]);
    // dd($data);
}
}
