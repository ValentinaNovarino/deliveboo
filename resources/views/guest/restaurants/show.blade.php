
@extends('layouts.app')

@section('content')


    @include('_header_cart')


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
                    @foreach ($restaurantDishes as $restaurant)
                        <h2>{{ $restaurant->name}}</h2>
                        <p>Città: {{ $restaurant->city}}</p>
                        <p>Indirizzo: {{ $restaurant->address}}</p>
                        <p>Descrizione: Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                    @endforeach
                    <a href="#all-restaurants">Clicca per vedere i nostri piatti</a>
                </div>
                <div class="cover-restaurant m-2">
                    <img src="{{ asset('storage/' . $restaurant->cover) }}" alt="Cover ristorante" class="img-fluid">
                </div>
            </div>

            <div class="our-dishes border-top mt-5">
                <span id="status"></span>
                <h1 class="text-center m-5">I nostri piatti</h1>

                {{-- stampa dei piatti del ristorante  --}}

                <div id="all-dishes" class="">
                    @foreach ($restaurantDishes as $restaurant)
                        @foreach ($restaurant->dishes as $dish)
                            <div class="thumbnail-container">
                                <div class="thumbnail">
                                    <div class="thumbnail-front">
                                       {{-- <img src="{{ $dish->cover }}" width="200" height="200"> --}}
                                        <img src="{{$dish->cover}}" alt="Cover piatto" width="200" height="200" class="img-fluid">
                                        <div class="caption">
                                           <h4>{{ $dish->name }}</h4>
                                           <p id="description">{{ ($dish->description) }}</p>
                                           <p>€{{ $dish->price }} </p>
                                           {{-- <p class="btn-holder "><a href="javascript:void(0);" data-id="{{ $dish->id }}" class="btn btn-warning btn-block text-center add-to-cart" role="button">Add to cart</a>
                                               <i class="fa fa-circle-o-notch fa-spin btn-loading" style="font-size:24px; display: none"></i>

                                           </p> --}}

                                        </div>
                                    </div>
                                    <div class="thumbnail-back">
                                        <p><strong>Descrizione: </strong>{{ ($dish->description) }}</p>
                                        <p><strong>Prezzo: </strong>€{{ $dish->price }} </p>
                                        <button class="button-add-cart">
                                            <a href="javascript:void(0);" data-id="{{ $dish->id }}" class="btn btn-deliveroo btn-block add-to-cart p-3 m-0" role="button">Add to cart</a>
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

                            {{-- <div class="info">
                                <div class="caption">
                                   <h4>{{ $dish->name }}</h4>
                                   <p id="description">{{ ($dish->description) }}</p>
                                   <p>€{{ $dish->price }} </p>
                               </div>
                            </div> --}}
                        @endforeach
                    @endforeach
                </div>

            </div>
        </div>

    </main>


    <script type="text/javascript">

    // ANIMAZIONE BOTTONE
    document.querySelectorAll('.button-add-cart').forEach(button => button.addEventListener('click', e => {
        if (!button.classList.contains('loading')) {

        button.classList.add('loading');

        setTimeout(() => button.classList.remove('loading'), 3700);
        }
        e.preventDefault();
        }));
    // FINE ANIMAZIONE BOTTONE

            $(".add-to-cart").click(function (e) {
                e.preventDefault();

                var ele = $(this);

                // ele.siblings('.btn-loading').show();

                $.ajax({
                    url: '{{ url('add-to-cart') }}' + '/' + ele.attr("data-id"),
                    method: "get",
                    data: {_token: '{{ csrf_token() }}'},
                    dataType: "json",
                    success: function (response) {

                        // ele.siblings('.btn-loading').hide();

                        $("span#status").html('<div class="alert alert-success">'+response.msg+'</div>');
                        $("#header-bar").html(response.data);
                    }
                });
            });



        </script>

@endsection
