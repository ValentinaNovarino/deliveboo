<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dish;

class DishController extends Controller
{
    public function index()
    {
        $dishes = Dish::all();

        return view('cart', compact('dishes'));
    }

    public function cart()
    {
        return view('cart');
    }

    // FUNZIONE DI AGGIUNTA AL CARRELLO
    public function addToCart($id){
        $dish = Dish::find($id);

        if(!$dish) {

            abort(404);

        }

        $cart = session()->get('cart');

        // if cart is empty then this the first product
        if(!$cart) {

            $cart = [
                $id => [
                    "name" => $dish->name,
                    "quantity" => 1,
                    "price" => $dish->price,
                    "photo" => $dish->cover
                ]
            ];

            session()->put('cart', $cart);

            $htmlCart = view('header-cart')->render();

            return response()->json(['msg' => 'Piatto aggiunto con successo!', 'data' => $htmlCart]);

            //return redirect()->back()->with('success', 'Product added to cart successfully!');
        }

        // if cart not empty then check if this product exist then increment quantity
        if(isset($cart[$id])) {

            $cart[$id]['quantity']++;

            session()->put('cart', $cart);

            $htmlCart = view('header-cart')->render();

            return response()->json(['msg' => 'Piatto aggiunto con successo!', 'data' => $htmlCart]);

            //return redirect()->back()->with('success', 'Product added to cart successfully!');

        }

        // if item not exist in cart then add to cart with quantity = 1
        $cart[$id] = [
            "name" => $dish->name,
            "quantity" => 1,
            "price" => $dish->price,
            "photo" => $dish->cover
        ];

        session()->put('cart', $cart);

        $htmlCart = view('header-cart')->render();

        return response()->json(['msg' => 'Piatto aggiunto con successo!', 'data' => $htmlCart]);

        //return redirect()->back()->with('success', 'Product added to cart successfully!');
    }


    // FUNZIONE AGGIORNAMENTO CARRELLO
    public function update(Request $request){
        if($request->id and $request->quantity)
        {
            $cart = session()->get('cart');

            $cart[$request->id]["quantity"] = $request->quantity;

            session()->put('cart', $cart);

            $subTotal = $cart[$request->id]['quantity'] * $cart[$request->id]['price'];

            $total = $this->getCartTotal();

            $htmlCart = view('_header_cart')->render();

            return response()->json(['msg' => 'Cart updated successfully', 'data' => $htmlCart, 'total' => $total, 'subTotal' => $subTotal]);

            //session()->flash('success', 'Cart updated successfully');
        }
    }


    // FUNZIONE RIMOZIONE DAL CARRELLO
    public function remove(Request $request){
        if($request->id) {

            $cart = session()->get('cart');

            if(isset($cart[$request->id])) {

                unset($cart[$request->id]);

                session()->put('cart', $cart);
            }

            $total = $this->getCartTotal();

            $htmlCart = view('_header_cart')->render();

            return response()->json(['msg' => 'Product removed successfully', 'data' => $htmlCart, 'total' => $total]);

            //session()->flash('success', 'Product removed successfully');
        }
    }


    /**
     * getCartTotal
     *
     *
     * @return float|int
     */
    private function getCartTotal()
    {
        $total = 0;

        $cart = session()->get('cart');

        foreach($cart as $id => $details) {
            $total += $details['price'] * $details['quantity'];
        }

        return number_format($total, 2);
    }
}
