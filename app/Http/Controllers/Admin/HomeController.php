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
        $newRestaurant = Restaurant::where('user_id', Auth::user()->id)->first();
        $data = [
            'restaurant' => $newRestaurant,
            'categories' => Category::with('restaurants')->get()
        ];
        return view('admin.home', $data);
    }
}
