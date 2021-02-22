@extends('layouts.app')

@section('content')

        @include('_header_cart')
        {{-- {{dd($restaurantDishes)}} --}}

        {{-- @foreach ($restaurantDishes as $value) --}}
            {{-- {{dd($value->name)}} nome ristorante --}}
            {{-- {{dd($value->dishes)}} --}}
            {{-- @foreach ($value->dishes as $e)
                {{dd($e->name)}}
            @endforeach

        @endforeach --}}
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
                </div>
                <div class="cover-restaurant border m-2">
                    <img src="{{asset("img/logo.png")}}" alt="Cover ristorante" class="img-fluid">
                </div>
            </div>

            <div class="our-dishes border-top mt-5">
                <span id="status"></span>
                <h1 class="text-center m-5">I nostri piatti</h1>

                {{-- stampa dei piatti del ristorante  --}}

               <div class="col-xs-12 col-sm-6 col-md-3 d-flex">
                   @foreach ($restaurantDishes as $restaurant)
                       @foreach ($restaurant->dishes as $dish)
                           <div class="thumbnail ">
                               {{-- <img src="{{ $dish->cover }}" width="200" height="200"> --}}
                               <img src="{{asset("img/logo.png")}}" alt="Cover piatto" width="200" height="200" class="img-fluid">
                               <div class="caption">
                                   <h4>{{ $dish->name }}</h4>
                                   <p><strong>Descrizione:</strong>{{ ($dish->description) }}</p>
                                   <p><strong>Prezzo:</strong> {{ $dish->price }} </p>
                                   <p class="btn-holder"><a href="javascript:void(0);" data-id="{{ $dish->id }}" class="btn btn-warning btn-block text-center add-to-cart" role="button">Add to cart</a>
                                       <i class="fa fa-circle-o-notch fa-spin btn-loading" style="font-size:24px; display: none"></i>
                                   </p>
                               </div>
                           </div>
                       @endforeach
                   @endforeach
               </div>

            </div>
        </div>
    </main>


    <script type="text/javascript">
            $(".add-to-cart").click(function (e) {
                e.preventDefault();

                var ele = $(this);

                ele.siblings('.btn-loading').show();

                $.ajax({
                    url: '{{ url('add-to-cart') }}' + '/' + ele.attr("data-id"),
                    method: "get",
                    data: {_token: '{{ csrf_token() }}'},
                    dataType: "json",
                    success: function (response) {

                        ele.siblings('.btn-loading').hide();

                        $("span#status").html('<div class="alert alert-success">'+response.msg+'</div>');
                        $("#header-bar").html(response.data);
                    }
                });
            });
        </script>

@endsection
