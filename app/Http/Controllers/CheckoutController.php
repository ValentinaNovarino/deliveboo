<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dish;
use App\Restaurant;
use App\Order;

class CheckoutController extends Controller
{
    public function index(Request $request) {

        $cartItems = session()->get('cart');
        $data = [
            'dishes' => $cartItems
        ];
        // dd(session()->get('cart'));
        // dd(Product::all());
        return view('checkout', $data);
    }

    public function store(Request $request) {
        // dd($request);

        $request->validate([
            'guest_name' => 'required|max:100',
            'guest_lastname' => 'required|max:100',
            'guest_city' => 'required|max:100',
            'guest_address' => 'required|max:100',
            'guest_mobile' => 'required|numeric|gt:-1|max:9999999999|min:1111111111',
            'guest_email' => 'email:rfc|required|max:100'
        ]);
        $data = $request->all();
        $newOrder = new Order();


        $newOrder->fill($data);

        $newOrder->save();
        return redirect()->route('guest.restaurants');
    }
}
