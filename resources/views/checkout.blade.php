
@extends('layouts.app')

@section("content")
    <div class="container">
        <div class="row">
            <div class="col">
                {{-- {{dd(session())}} --}}
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
                    <form method="POST" action="{{ route('checkout.store') }}" id="form">
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

                        <div class="form-group">
                            <section>
                                <div class="bt-drop-in-wrapper">
                                    <div id="bt-dropin"></div>
                                </div>
                            </section>
                            <input id="nonce" name="payment_method_nonce" type="hidden"/>
                        </div>

                        {{-- input non visibili --}}
                        <input type="hidden" name="order_price" value="{{ $finalTotal }}">
                        @php $sconto10 = $finalTotal * 10 / 100 @endphp
                        @if ($finalTotal >= 30)
                            <input type="hidden" name="delivery_price" value="0">
                            <input type="hidden" name="discount" value="{{ $sconto10 }}">
                            <input type="hidden" name="final_price" value="{{ $finalTotal + 0 - $sconto10 }}">
                        @else
                            <input type="hidden" name="delivery_price" value="5">
                            <input type="hidden" name="discount" value="0">
                            <input type="hidden" name="final_price" value="{{ $finalTotal + 5 }}">
                        @endif
                        {{-- tempo della consegna in secondi --}}
                        <input type="hidden" name="delivery_time" value="3000">
                        {{-- <input type="hidden" name="delivery_time" value="session('cart')"> --}}



                        <button type="submit" class="button btn btn-deliveroo">Procedi con il pagamento</button>
                    </form>
                    <a href="{{ route('cart') }}">
                        <button type="submit" class="btn btn-lg btn-warning">Torna al carrello</button>
                    </a>
                @endif
            </div>
        </div>
    </div>

@endsection

<script src="https://js.braintreegateway.com/web/dropin/1.26.1/js/dropin.min.js"></script>
<script>
    var form = document.querySelector('#form');
    var client_token = "{{ $token }}";

    braintree.dropin.create({
      authorization: client_token,
      selector: '#bt-dropin',
      paypal: {
        flow: 'vault'
      }
    }, function (createErr, instance) {
      if (createErr) {
        console.log('Create Error', createErr);
        return;
      }
      form.addEventListener('submit', function (event) {
        event.preventDefault();

        instance.requestPaymentMethod(function (err, payload) {
          if (err) {
            console.log('Request Payment Method Error', err);
            return;
          }

          // Add the nonce to the form and submit
          document.querySelector('#nonce').value = payload.nonce;
          form.submit();
        });
      });
    });
</script>

{{-- <script type="text/javascript">
    function blocco_mousedx()
     { return(false); }
    document.oncontextmenu = blocco_mousedx;

        document.onkeydown = function(blocco_tasti) {
     if(event.keyCode == 123)
    { return false; }
     if(blocco_tasti.ctrlKey && blocco_tasti.shiftKey && blocco_tasti.keyCode == 'I'.charCodeAt(0)) { return false; }
     if(blocco_tasti.ctrlKey && blocco_tasti.shiftKey && blocco_tasti.keyCode == 'C'.charCodeAt(0)) { return false; }
     if(blocco_tasti.ctrlKey && blocco_tasti.shiftKey && blocco_tasti.keyCode == 'J'.charCodeAt(0)) { return false; }
     if(blocco_tasti.ctrlKey && blocco_tasti.keyCode == 'U'.charCodeAt(0))
    { return false; }
    }
</script> --}}
