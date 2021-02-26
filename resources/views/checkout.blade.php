@extends('layouts.app')

@section("content")
    <div class="container">
        <div class="row">
            <div class="col">
                {{-- {{dd(session('final_price'))}} --}}
                {{-- {{dd(session()->get('cart'))}} --}}
                @if(session('success_message'))
                    <div class="alert alert-success">
                        {{session('success_message')}}
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                        </ul>
                    </div>
                @endif
                @if (!session()->get('cart'))
                    <div class="checkout-without-container">
                        <h1>Non ci sono prodotti nel carrello</h1>
                        <a href="{{ route('guest.restaurants') }}">
                            <button type="submit" class="btn btn-warning">Torna allo shopping</button>
                        </a>
                    </div>
                @else
                    <div class="items-checkout">
                        @php $finalTotal = 0; @endphp
                        <h1>tutti i tuoi prodotti</h1>
                        @foreach ($dishes as $dish)
                            <div class="card">
                                <div class="image-container d-inline-block">
                                    <img src="{{ $dish['cover'] }}" alt="immagine {{ $dish['name'] }}">
                                </div>
                                <div class="sub-card">
                                    <p>{{ $dish['name'] }}</p>
                                    <p>Prezzo unitario: {{ $dish['price'] }} €</p>
                                    <p class="d-inline-block">Quantità: {{ $dish['quantity'] }}</p>
                                    <p class="d-inline-block">Totale: {{ $dish['quantity'] * $dish['price'] }} €</p>
                                </div>
                            </div>
                            @php $finalTotal += $dish['quantity'] * $dish['price']; @endphp
                        @endforeach
                    </div>
                    <div class="checkout-card-total">
                        <h3>Totale ordine: € {{$finalTotal}}</h3>
                    </div>

                    <h1>inserisci i tuoi dati</h1>
                    <form id="form" method="POST" name="formform" action="{{ route('checkout.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="guestName">Nome</label>
                            <input type="text" id="guestName" class="form-control-deliveroo" placeholder="Inserisci il tuo nome" name="guest_name" value="{{ old('guest_name') }}" maxlength="100" required>
                            @error('guest_name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="guestLastname">Cognome</label>
                            <input type="text" id="guestLastname" class="form-control-deliveroo" placeholder="Inserisci il tuo cognome" name="guest_lastname" value="{{ old('guest_lastname') }}" maxlength="100" required>
                            @error('guest_lastname')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="guestCity">Città</label>
                            <input type="text" id="guestCity" class="form-control-deliveroo" placeholder="Inserisci la città di consegna" name="guest_city" value="{{ old('guest_city') }}" maxlength="100" required>
                            @error('guest_city')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="guestAddress">Indirizzo</label>
                            <input type="text" id="guestAddress" class="form-control-deliveroo" placeholder="Inserisci l'indirizzo di consegna" name="guest_address" value="{{ old('guest_address') }}" maxlength="100" required>
                            @error('guest_address')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="checkout-mobile" for="guestMobile">Telefono</label>
                            <span class="checkout-mobile">+39</span>
                            <input type="text" id="guestMobile" class="form-control-deliveroo checkout-mobile" placeholder="Inserisci il tuo numero" name="guest_mobile" value="{{ old('guest_mobile') }}" maxlength="10" required>
                            @error('guest_mobile')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="guestEmail">Email</label>
                            <input type="email" id="guestEmail" class="form-control-deliveroo" placeholder="Inserisci la tua email" name="guest_email" value="{{ old('guest_email') }}" maxlength="100" required>
                            @error('guest_email')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>


                        <div id="dropin-wrapper">
                            <div id="dropin-container"></div>
                        </div>

                        {{-- input non visibili --}}

                        <input type="hidden" name="order_price" value="{{ session('order_price')}}">
                        <input type="hidden" name="delivery_price" value="{{ session('delivery_price')}}">
                        <input type="hidden" name="discount" value="{{ session('discount')}}">
                        <input type="hidden" name="final_price" value="{{ session('final_price')}}">

                        {{-- tempo della consegna in secondi --}}
                        <input type="hidden" name="delivery_time" value="{{ session('delivery_time')}}">
                        



                        <button type="submit" class="btn btn-deliveroo" id="submit-button">Procedi con il pagamento</button>
                    </form>
                    <a href="{{ route('cart') }}">
                        <button type="button" class="btn btn-lg btn-warning">Torna al carrello</button>
                    </a>
                @endif
            </div>
        </div>
    </div>

@endsection

<script src="https://js.braintreegateway.com/v2/braintree.js"></script>
<script type="text/javascript">
    braintree.setup("{{ $token }}", "dropin", {
        container: "dropin-container",
        form: 'form'
    });
</script>
