<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Restaurant;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index() {

        return view('admin.home');
    }

    public function showRestaurant() {
        $data = [
            'restaurants' => Restaurant::where('user_id', Auth::user()->id)->get()
        ];
        return view('admin.home', $data);
    }
}
