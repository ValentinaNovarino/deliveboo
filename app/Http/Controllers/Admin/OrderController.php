<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Order;
use App\Restaurant;
use Illuminate\Support\Facades\Auth;


class OrderController extends Controller
{
    public function index() {

        $userRestaurant = Restaurant::where('user_id', Auth::user()->id)->first();
        $userOrders = Order::where('restaurant_id', $userRestaurant->id)->get();

        $data = [
            'orders' => $userOrders,
            'restaurant' => $userRestaurant,
        ];

        // dd($data);
        return view('admin.orders.index', $data);
    }
}
