<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dish;

class CheckoutController extends Controller
{
    public function index(Request $request) {

        $cartItems = session()->get('cart');
        $data = [
            'items' => $cartItems
        ];
        // dd(session()->get('cart'));
        // dd(Product::all());
        return view('checkout', $data);
    }
}
