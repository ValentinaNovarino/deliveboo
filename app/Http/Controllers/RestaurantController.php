<?php

namespace App\Http\Controllers;
use App\Restaurant;
use App\Category;
use Illuminate\Support\Str;

use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    public function index() {
        $restaurants = Restaurant::all();
        $categories = Category::all();

        $data = [
            'restaurants' => $restaurants,
            'categories' => $categories
        ];
        return view('guest.restaurants.index', $data);
    }



   //  public function show($slug) {
   //     $restaurant = Restaurant::where('slug', $slug)->first();
   //     if(!$restaurant) {
   //         abort(404);
   //     }
   //     $data = ['restaurant' => $restaurant];
   //     return view('guest.restaurants.show', $data);
   // }
}
