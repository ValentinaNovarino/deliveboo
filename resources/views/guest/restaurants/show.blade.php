@extends('layouts.app')

@section('content')
    @include('partials.header-cart')

    <main>
        <div class="container">

            <div class="">
                <a href="{{ route('guest.restaurants') }}" class="btn btn-deliveroo ml-5">
                    <i class="fas fa-arrow-left"></i> Tutti i ristoranti
                </a>
            </div>
            <h1 class="text-center">Pagina singolo risorante</h1>

            <div class="card-restaurant border-form m-2 p-5 d-flex">
                <div class="info-restaurant">
                    <h2>{{ $restaurant->name}}</h2>
                    <p>Città: {{ $restaurant->city}}</p>
                    <p>Indirizzo: {{ $restaurant->address}}</p>
                    <p>Descrizione: Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                </div>
                <div class="cover-restaurant border m-2">
                    <img src="{{asset("img/logo.png")}}" alt="Cover ristorante" class="img-fluid">
                </div>
            </div>

            <div class="our-dishes border-top mt-5">
                <span id="status"></span>
                <h1 class="text-center m-5">I nostri piatti</h1>

                {{-- stampa dei piatti del ristorante  --}}
                {{-- @foreach($dishes as $dish) --}}
               <div class="col-xs-12 col-sm-6 col-md-3">
                   <div class="thumbnail">
                       {{-- <img src="{{ $dish->cover }}" width="200" height="200"> --}}
                       <img src="{{asset("img/logo.png")}}" alt="Cover piatto" width="200" height="200" class="img-fluid">
                       <div class="caption">
                           {{-- <h4>{{ $dish->name }}</h4> --}}
                           <h4>Nome piatto</h4>
                           {{-- <p>{{ str_limit(strtolower($dish->description), 50) }}</p> --}}
                           <p>Descrizione</p>
                           {{-- <p><strong>Price: </strong> {{ $dish->price }}$</p> --}}
                           <p>Prezzo</p>
                           {{-- <p class="btn-holder"><a href="javascript:void(0);" data-id="{{ $dish->id }}" class="btn btn-warning btn-block text-center add-to-cart" role="button">Add to cart</a>
                               <i class="fa fa-circle-o-notch fa-spin btn-loading" style="font-size:24px; display: none"></i>
                           </p> --}}

                           <button class="button-add-cart text-center add-to-cart btn-loading">
                               <span>Add to cart</span>
                               <div class="cart">
                                   <svg viewBox="0 0 36 26">
                                       <polyline points="1 2.5 6 2.5 10 18.5 25.5 18.5 28.5 7.5 7.5 7.5"></polyline>
                                       <polyline points="15 13.5 17 15.5 22 10.5"></polyline>
                                   </svg>
                               </div>
                            </button>
                       </div>
                   </div>
               </div>
           {{-- @endforeach --}}

            </div>
        </div>


    </main>


    <script type="text/javascript">

// Animazione buttone aggiunta al carrello
    document.querySelectorAll('.button-add-cart').forEach(button => button.addEventListener('click', e => {
        if (!button.classList.contains('loading')) {

            button.classList.add('loading');

            setTimeout(() => button.classList.remove('loading'), 3700);
        }
        e.preventDefault();
    }));
    // fine animazione bottone


// Funzione aggiunta al carrello
    $(".button-add-cart").click(function (e) {
            e.preventDefault();

            var ele = $(this);

            ele.siblings('.btn-loading').show();

            $.ajax({
                url: '{{ url('button-add-cart') }}' + '/' + ele.attr("data-id"),
                method: "get",
                // data: {_token: '{{ csrf_token() }}'},
                dataType: "json",
                success: function (response) {

                    ele.siblings('.btn-loading').hide();
                        // restituisce il messaggio di successo
                    $("span#status").html('<div class="alert alert-success">'+response.msg+'</div>');
                    $("#header-bar").html(response.data);
                }
            });
        });

    </script>

@endsection
