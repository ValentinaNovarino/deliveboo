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
        $dish = Dish::find($id);
        if(!$dish)  {

            abort(404);

        }

        $cart = session()->get('cart');

        // se il prodotto cliccato è di un ristorante diverso visualizzo un alert
        // if ($dish->restaurant_id =! $cart[$id]->restaurant_id ) {
        //     alert("Non puoi inserire piatti da ristoranti diversi");
        // }
        //
        // session()->put('cart', $cart);
        //
        // $htmlCart = view('_header_cart')->render();
        //
        // return response()->json(['msg' => 'Prodotto aggiunto al carrello!', 'data' => $htmlCart]);

        // se il carrello è vuoto aggiungo il prodotto
        if(!$cart) {

            $cart = [
                $id => [
                    "name" => $dish->name,
                    "quantity" => 1,
                    "price" => $dish->price,
                    "cover" => $dish->cover,
                ]
            ];

            session()->put('cart', $cart);

            $htmlCart = view('_header_cart')->render();

            return response()->json(['msg' => 'Prodotto aggiunto al carrello!', 'data' => $htmlCart]);

            //return redirect()->back()->with('success', 'Prodotto aggiunto al carrello!');
        }

        // se il carrello non è vuoto, check del prodotto e aumento della quantità
        if(isset($cart[$id])) {

            $cart[$id]['quantity']++;

            session()->put('cart', $cart);

            $htmlCart = view('_header_cart')->render();

            return response()->json(['msg' => 'Prodotto aggiunto al carrello!', 'data' => $htmlCart]);

            //return redirect()->back()->with('success', 'Prodotto aggiunto al carrello!');
        }


        // se il prodotto non esiste nel carrello, viene aggiunto con quantità = 1
        $cart[$id] = [
            "name" => $dish->name,
            "quantity" => 1,
            "price" => $dish->price,
            "cover" => $dish->cover,
        ];

        session()->put('cart', $cart);

        $htmlCart = view('_header_cart')->render();

        return response()->json(['msg' => 'Prodotto aggiunto al carrello!', 'data' => $htmlCart]);

        //return redirect()->back()->with('success', 'Prodotto aggiunto al carrello!');
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
