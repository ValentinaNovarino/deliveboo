<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dish;
use App\Restaurant;
use App\Order;
use Illuminate\Validation\Rule;

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

        $request->validate([
            'guest_name' => 'required|max:100',
            'guest_lastname' => 'required|max:100',
            'guest_city' => 'required|max:100',
            'guest_address' => 'required|max:100',
            'guest_mobile' => 'required|numeric|gt:-1|max:9999999999|min:1111111111',
            'guest_email' => 'email:rfc|required|max:100',
            'order_price' => ['required', Rule::in([session('order_price')])],
        ]);
        $data = $request->all();
        $newOrder = new Order();


        $newOrder->fill($data);

        $newOrder->save();
        session()->forget('cart');
        return redirect()->route('guest.restaurants');
    }
}
