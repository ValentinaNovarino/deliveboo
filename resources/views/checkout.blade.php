
@extends('layouts.app')

@section("content")
    <div class="container">
        <div class="row">
            <div class="col">
                @if (!session()->get('cart'))
                    <div class="checkout-without-container">
                        <h1>Non ci sono prodotti nel carrello</h1>
                        <a href="{{ route('guest.restaurants') }}">
                            <button type="submit" class="btn btn-warning">Torna allo shopping</button>
                        </a>
                    </div>
                @else
                    <div class="items-checkout">
                        <h1>tutti i tuoi prodotti</h1>
                        @foreach ($dishes as $dish)
                            <div class="card">
                                <div class="image-container d-inline-block">
                                    <img src="{{ $dish['cover'] }}" alt="'immagine ' . {{ $dish['name'] }}">
                                </div>
                                <div class="sub-card">
                                    <p>{{ $dish['name'] }}</p>
                                    <p>prezzo: {{ $dish['price'] }} €</p>
                                    <p class="d-inline-block">quantità: {{ $dish['quantity'] }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <a href="{{ route('cart') }}">
                        <button type="submit" class="btn btn-warning">Torna al carrello</button>
                    </a>

                    <h1>inserisci i tuoi dati</h1>
                    <form>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" require>
                            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" require>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1" require>
                            <label class="form-check-label" for="exampleCheck1">Check me out</label>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                @endif
            </div>
        </div>
    </div>

@endsection
