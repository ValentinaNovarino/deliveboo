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
        $gateway = new \Braintree\Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchantId'),
            'publicKey' => config('services.braintree.publicKey'),
            'privateKey' => config('services.braintree.privateKey')
        ]);
        $cartItems = session()->get('cart');
        $data = [
            'dishes' => $cartItems,
            'token' => $gateway->ClientToken()->generate()
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

        $gateway = new \Braintree\Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchantId'),
            'publicKey' => config('services.braintree.publicKey'),
            'privateKey' => config('services.braintree.privateKey')
        ]);

        $amount = $request->amount;
        $nonce = $request->payment_method_nonce;

        $result = $gateway->transaction()->sale([
            'amount' => $amount,
            'paymentMethodNonce' => $nonce,
            'options' => [
                'submitForSettlement' => true
            ]
        ]);

        if ($result->success) {
            $transaction = $result->transaction;
            return back()->with('success_message', 'Transaction successful. The ID is:'.$transaction->id);
        } else {
            $errorString = "";

            foreach($result->errors->deepAll() as $error) {
                $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
            }
            return back()->withErrors('An error occurred with the message:'.$result->message);
        }
        session()->forget('cart');
        return redirect()->route('guest.restaurants');
    }
}
