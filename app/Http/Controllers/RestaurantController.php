<?php

namespace App\Http\Controllers;
use App\Restaurant;
use App\Category;

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
}
