<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dish;

use App\Restaurant;

class DishController extends Controller
{
        // TEST Carrello

    public function index()
    {
        $dishes = Dish::all();
        $restaurants = Restaurant::all();

        return view('guest.restaurants.show', compact('dishes', "restaurants"));
    }

    public function cart()
    {
        return view('cart');

    }

    public function addToCart($id)
    {
        $restaurant = Restaurant::all();
        // $dish = Dish::where('restaurant_id' == $restaurant->id);

        $dish = Dish::find($id);



        if(!$dish)  {

            abort(404);

        }


        $cart = session()->get('cart');
        // $currentRestaurantId;
        if (empty($cart)) {
            $currentRestaurantId = $dish->restaurant_id;
        }

        if(!$cart) {

            $cart = [
                $id => [
                    "id" => $dish->id,
                    "name" => $dish->name,
                    "quantity" => 1,
                    "price" => $dish->price,
                    "cover" => $dish->cover,
                    "restaurant_id" => $dish->restaurant_id
                ]
            ];

            // $currentId = $dish->id;
            // $mainRestaurantId = Dish::find($id)->restaurant_id;
            session()->put('cart', $cart);
            // session()->put('cart', $mainRestaurantId);
            // $currentRestaurantId = $cart[$id]->restaurant_id;
            $htmlCart = view('_header_cart')->render();

            return response()->json(['msg' => 'Prodotto aggiunto al carrello!', 'data' => $htmlCart]);

        }

        // se il carrello non è vuoto, check del prodotto e aumento della quantità
        if(isset($cart[$id])) {

            $cart[$id]['quantity']++;

            session()->put('cart', $cart);
            $htmlCart = view('_header_cart')->render();

            return response()->json(['msg' => 'Prodotto aggiunto al carrello!', 'data' => $htmlCart]);

        }
        // if (session()->has('restaurant_id')) {
        //
        // }


        // se il prodotto non esiste nel carrello, viene aggiunto con quantità = 1
        if ($dish->restaurant_id == 1) {
            $cart[$id] = [
                "id" => $dish->id,
                "name" => $dish->name,
                "quantity" => 1,
                "price" => $dish->price,
                "cover" => $dish->cover,
                "restaurant_id" => $dish->restaurant_id
            ];

            session()->put('cart', $cart);

            $htmlCart = view('_header_cart')->render();

            return response()->json(['msg' => 'Prodotto aggiunto al carrello!', 'data' => $htmlCart]);
        } else {
            return response()->json(['msg' => 'errore', 'data' => $htmlCart]);

        }


    }


    public function update(Request $request)
    {
        if($request->id and $request->quantity)
        {
            $cart = session()->get('cart');

            $cart[$request->id]["quantity"] = $request->quantity;

            session()->put('cart', $cart);

            $subTotal = $cart[$request->id]['quantity'] * $cart[$request->id]['price'];

            $total = $this->getCartTotal();

            $htmlCart = view('_header_cart')->render();

            return response()->json(['msg' => 'Carrello aggiornato', 'data' => $htmlCart, 'total' => $total, 'subTotal' => $subTotal]);

            //session()->flash('success', 'Cart updated successfully');
        }
    }

    public function remove(Request $request)
    {
        if($request->id) {

            $cart = session()->get('cart');

            if(isset($cart[$request->id])) {

                unset($cart[$request->id]);

                session()->put('cart', $cart);
            }

            $total = $this->getCartTotal();

            $htmlCart = view('_header_cart')->render();

            return response()->json(['msg' => 'Prodotto rimosso!', 'data' => $htmlCart, 'total' => $total]);

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
