
@extends('layouts.app')

@section('content')

    <main>
        <div class="container">
            <nav class="header-single-rest">
                <div class="single-restaurant-logo">
                    <a href="{{ route('uiHome') }}">
                        <img src="../img/logo.png" alt="">
                    </a>
                </div>
                <div class="header-bar-menu">
                    <ul>
                        <li>
                            <div class="dropdown">
                                <button id="open"onclick=popup() type="button" class="btn btn-deliveroo" data-toggle="dropdown">
                                    @if (!session()->get('cart'))
                                        <i class="fa fa-shopping-cart p-1" aria-hidden="true"></i><span class="badge badge-pill badge-danger"> 0 €</span>

                                    @else
                                        @php
                                        $elementi = session()->get('cart');
                                        $totale = 0;
                                        @endphp
                                        @foreach ($elementi as $element)
                                            @php
                                            $subtotale = $element['price'] * $element['quantity'];
                                            $totale = $subtotale + $totale;
                                            @endphp

                                        @endforeach
                                        <i class="fa fa-shopping-cart p-1" aria-hidden="true"></i><span class="badge badge-pill badge-danger"> {{ $totale }} €</span>
                                    @endif

                                </button>
                                <div id="pop" class="dropdown-menu p-4">
                                    <div class="row total-header-section">
                                        <div class="col-xs-6 col-lg-6 col-sm-6 col-6">
                                            <i class="fa fa-shopping-cart" aria-hidden="true"></i> <span class="badge badge-pill badge-danger">{{ count((array) session('cart')) }}</span>
                                        </div>

                                        <?php $total = 0 ?>
                                        @foreach((array) session('cart') as $id => $details)
                                            <?php $total += $details['price'] * $details['quantity'] ?>
                                        @endforeach

                                        <div class="col-lg-6 col-sm-6 col-6 total-section text-right">
                                            <p>Totale: <span class="text-info">€ {{ $total }}</span></p>
                                        </div>
                                    </div>

                                    @if(session('cart'))
                                        @foreach((array) session('cart') as $id => $details)
                                            <div class="row cart-detail">
                                                <div class="col-lg-4 col-sm-4 col-4 cart-detail-img">
                                                    <img src="{{ $details['cover'] }} " />
                                                </div>
                                                <div class="col-lg-8 col-sm-8 col-8 cart-detail-product">
                                                    <p>{{ $details['name'] }}</p>
                                                    <span class="price text-info"> €{{ $details['price'] }}</span> <span class="count"> Quantità:{{ $details['quantity'] }}</span>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                    <div class="row">
                                        <div class="col-lg-12 col-sm-12 col-12 text-center checkout">
                                            <a href="{{ url('cart') }}" class="btn btn-deliveroo btn-block">Vai al carrello</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}"><i class="fas fa-house-user"></i> {{ __('Login') }}</a>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('admin.index') }}">
                                        Dashboard
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>

                        @endguest
                        <li>
                            <a class="nav-link" href="#">
                                <i class="fas fa-bars"></i> Menu
                            </a>
                        </li>
                    </ul>
                </div>

            </nav>

            <div class="card-restaurant d-flex">
                <div class="info-restaurant d-flex flex-column justify-content-center">
                    @foreach ($restaurantDishes as $restaurant)
                        <h2>{{ $restaurant->name}}</h2>
                        <p> <i id="star-vote" class="fas fa-star"></i> {{ $numero = rand(2,5)}},{{ $numero2 = rand(0,9) }} </p>
                        <p><span>Città: </span>{{ $restaurant->city}}</p>
                        <p><span>Indirizzo: </span>{{ $restaurant->address}}</p>
                        <p><span>Descrizione: </span>{{ $restaurant->description}}</p>
                    @endforeach
                    <a class="menu" href="#all-dishes-title">Clicca per vedere i nostri piatti</a>
                    <span class="text-center" id="news"><i class="fas fa-exclamation"></i> New</span>
                    <div class="info-details">
                        <div class="info-icon d-flex justify-content-start align-items-center">
                            <i class="fas fa-info-circle"></i>
                        </div>
                        <div class="details d-flex flex-column justify-content-center align-items-start">
                            <p>Dettagli del ristorante</p>
                            <a href="#">Allergenti e tanto altro</a>
                        </div>
                    </div>
                </div>
                <div class="cover-restaurant m-2">
                    <img src="{{ asset('storage/' . $restaurant->cover) }}" alt="Cover ristorante" class="img-fluid">
                    <div class="delivery">
                        <div class="img-rider">
                            <p>Consegna dalle 19:30</p>
                            <span>{{ $restaurant->city}}, Italia</span>
                        </div>
                    </div>
                    <button class="order" type="button" name="button">Avvia ordine di gruppo</button>
                </div>
            </div>

            <div>
                <a href="{{ route('guest.restaurants') }}" class=" all-restaurant-btn btn btn-deliveroo">
                    <i class="fas fa-arrow-left"></i> Tutti i ristoranti
                </a>
            </div>

            <div class="components border-top border-bottom mt-5 d-flex align-items-center">
                <span id="status" class="text-center"></span>

                <ul>
                    <li>
                        <a href="#">Piatti</a>
                    </li>
                    <li>
                        <a href="#">Bevande</a>
                    </li>
                    <li>
                        <a href="#">Birre</a>
                    </li>
                    <li>
                        <a href="#">Vini</a>
                    </li>
                </ul>
            </div>

        </div>

        <div class="container-dishes">
            <div class="container">
                <div id="all-dishes-title">
                    <h1>I nostri piatti</h1>
                    <div class="all-dishes">
                        @foreach ($restaurantDishes as $restaurant)
                            @foreach ($restaurant->dishes as $dish)
                                <a onclick="show('{{ $dish->id }}'); return false" class="dish-card-link" href="#">
                                    <div id="dish-card">
                                        <div class="left-card">
                                            <h4>{{ $dish->name }}</h4>
                                            <p id="description">{{ ($dish->description) }}</p>
                                            <p>€{{ $dish->price }}</p>
                                        </div>
                                        <div class="right-card d-flex justify-content-end align-items-center">
                                            <div class="dish-cover">
                                                <img src="{{$dish->cover}}" alt="Cover piatto" class="img-fluid">
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <div id="{{ $dish->id }}" class="dish-card-details" style="display:none">
                                    <div class="card-details-header text-right">
                                        <i onclick="show('{{ $dish->id }}'); return false" class="fas fa-times"></i>
                                    </div>
                                    <h4>{{ $dish->name }}</h4>
                                    <p> <i id="star-vote" class="fas fa-star"></i> {{ $numero = rand(2,5)}},{{ $numero2 = rand(0,9) }} </p>
                                    <div class="dish-cover">
                                        <img src="{{$dish->cover}}" alt="Cover piatto" class="img-fluid">
                                    </div>
                                    <p id="description">{{ ($dish->description) }}</p>
                                    <p>€{{ $dish->price }}</p>
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
                            @endforeach
                        @endforeach
                    </div>
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
                if (response.msg) {
                    $("span#status").html('<div class="alert alert-success ">'+response.msg+'</div>');
                    $("#header-bar").html(response.data);

                } else if (response.error){
                    $("span#status").html('<div class="alert alert-danger ">'+response.error+'</div>');
                    $("#header-bar").html(response.data);
                }
            }
        });
    });

    function show(id){
        if (document.getElementById){
            if(document.getElementById(id).style.display == 'none'){
                document.getElementById(id).style.display = 'block';
            } else {
                document.getElementById(id).style.display = 'none';
            }
        }
    }

    function hide(id) {
        if(document.getElementById(id).style.display == 'block'){
            document.getElementById(id).style.display = 'none;';
        }
    }
    </script>

@endsection
