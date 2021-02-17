<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Restaurant;
use App\Category;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index() {

        return view('admin.home');
    }

    public function showRestaurant() {
        $newRestaurant = new Restaurant;
        $currentRestaurant = Restaurant::where('user_id', Auth::user()->id)->get();
        $data = [
            'restaurants' => $currentRestaurant,
            'categories' => $newRestaurant->categories()
        ];
        return view('admin.home', $data);
    }
}
