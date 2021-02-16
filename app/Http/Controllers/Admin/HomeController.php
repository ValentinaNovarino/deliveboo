<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Restaurant;

class HomeController extends Controller
{
    public function index() {

        return view('admin.home');
    }

    // public function showRestaurant($id) {
    //     $data = [
    //         'restaurants' => Restaurant::where('user_id', $id)->get()
    //     ];
    //     return view('admin.home', $data);
    // }
}
