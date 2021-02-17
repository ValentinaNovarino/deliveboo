<!DOCTYPE html>
@extends('layouts.app')

@section('content')



<div class="wrap">
    {{-- <div class="header-top">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-xs-12">
                    <div class="logo">
                        <img class="logo-header"src="{{'../img/logo-bianco.jpg'}}" alt="">
                    </div>
                </div>
                <div class="col-md-2 col-xs-12">
                    <div class="menu-header">
                        <button type="button" name="button">Collabora con noi</button>
                    </div>
                </div>
                <div class="col-md-1 col-xs-12">
                    <button type="button" name="button">0.00</button>
                </div>
                <div class="col-md-1 col-xs-12">
                    <button type="button" name="button">Menu</button>
                </div>
            </div>
            {{-- <div class="row">
                <div class="col-xs-12 col-xs-12"> --}}
                    {{-- <div class="titleHeader">
                        <h1>I piatti che ami, a domicilio.</h1>
                    </div> --}}
                {{-- </div>
            </div> --}}
        {{-- </div>
    </div> --}}



    <div class="header-bottom">
        {{-- TEST DROPDOWN CART  --}}
        <div class="section-dropcart">
            <button type="button" class="btn-deliveroo " data-toggle="dropdown">
                @if (!session()->get('cart'))
                    <i class="fa fa-shopping-cart" aria-hidden="true"></i> Carrello <span class="badge badge-pill badge-danger">0 €</span>
                @else
                    @php
                        $elementi = session()->get('cart');
                        $totale = 0;
                    @endphp
                        {{-- {{ dd($elementi) }} --}}
                        @foreach ($elementi as $element)
                            {{-- {{$element['name'] }}
                            {{$element['quantity'] }}
                            {{$element['price'] }} --}}
                            @php
                                $subtotale = $element['price'] * $element['quantity'];
                                $totale = $subtotale + $totale;
                            @endphp

                        @endforeach
                            <i class="fa fa-shopping-cart" aria-hidden="true"></i> Carrello <span class="badge badge-pill badge-danger">{{ $totale }} €</span>
                    @endif

                {{-- <i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart <span class="badge badge-pill badge-danger">{{ count((array) session('cart')) }}</span> --}}
            </button>

            <div class="dropdown-menu">
                <div class="row total-header-section">
                    <div class="col-lg-6 col-sm-6 col-6">
                        <i class="fa fa-shopping-cart" aria-hidden="true"></i> <span class="badge badge-pill badge-danger">{{ count((array) session('cart')) }}</span>
                    </div>

                    <?php $total = 0 ?>
                    @foreach((array) session('cart') as $id => $details)
                        <?php $total += $details['price'] * $details['quantity'] ?>
                    @endforeach

                    <div class="col-lg-6 col-sm-6 col-6 total-section text-right">
                        <p>Totale: <span class="text-info">$ {{ $total }}</span></p>
                    </div>
                </div>

                @if(session('cart'))
                    @foreach((array) session('cart') as $id => $details)
                        <div class="row cart-detail">
                            <div class="col-lg-4 col-sm-4 col-4 cart-detail-img">
                                <img src="{{ $details['photo'] }}" />
                            </div>
                            <div class="col-lg-8 col-sm-8 col-8 cart-detail-product">
                                <p>{{ $details['name'] }}</p>
                                <span class="price text-info"> ${{ $details['price'] }}</span> <span class="count"> Quantità:{{ $details['quantity'] }}</span>
                            </div>
                        </div>
                    @endforeach
                @endif

                <div class="row">
                    <div class="col-lg-12 col-sm-12 col-12 text-center checkout p-5">
                        <a href="{{ url('cart') }}" class="btn btn-deliveroo ">Vai al carrello</a>
                    </div>
                </div>
            </div>
        </div>

        {{-- FINE TEST DROP DOWN CART --}}
        <div class="container">

            {{-- <div class="titleHeader">
                <h1>I piatti che ami, a domicilio.</h1>
            </div> --}}
            <div class="row">
                <div class="col-md-6 col-xs-12">
                    <div class="titleHeader">
                        <h1>I piatti che ami, a domicilio.</h1>
                    </div>
                    <div class="div-search">
                        {{-- <div class="search-header"> --}}
                            <span>Entra e scegli il tuo ristorante</span>
                            <button class="capitalize btn btn-primary" type="button" name="button">cerca</button>
                        {{-- </div> --}}
                    </div>
                </div>
                <div class="col-md-1 col-xs-12">
                </div>
                <div class="col-md-5 col-xs-12">
                    <div class="image-header">
                        <img src="{{'../img/campaignrit.png'}}" alt="">
                        <div class="riquadro-blu-header">
                            <div class="riquadro-blu-header-inside">
                                <h1>#aCasaTuaConDeliveroo</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- fine_header --}}

<section class="jumbo-first">
    <div class="container">
        <h1>La selezione di Deliveroo</h1>
        <div class="row justify-content-between">
            <div class="col-md-5 col-xs-12">
                <div class="menu-image-small">
                    <img class="img-small" src="{{'../img/confort.jpg'}}" alt="">
                    <p>I grandi classici che scaldano il cuore, perfetti in ogni momento.</p>
                    <a href="#">Scopri Comfort food</a>
                </div>

            </div>
            <div class="col-md-7 col-xs-12">
                <div class="menu-image-large">
                    <img class="img-large"src="{{'../img/dolci_e_dessert.jpg'}}" alt="">
                    <p>Dolci piaceri per rendere la giornata ancora più gustosa</p>
                    <a href="#">Scopri Dolci e Dessert</a>
                </div>
            </div>
        </div>
        <div class="row justify-content-between">
            <div class="col-md-7 col-xs-12">
                <div class="menu-image-large">
                    <img class="img-large" src="{{'../img/condividere.jpg'}}" alt="">
                    <p>Serve una scusa per stare insieme? Ordina dai ristoranti che trasformeranno la tua serata in una vera festa.</p>
                    <a href="#">Scopri Perfetti da condividere</a>
                </div>
            </div>
            <div class="col-md-5 col-xs-12">
                <div class="menu-image-small">
                    <img class="img-small" src="{{'../img/esclusiva.jpg'}}" alt="">
                    <p>I più famosi, i più buoni, i preferiti. Quelli che trovi solo su Deliveroo.</p>
                    <a href="#">Scopri Esclusiva Deliveroo</a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="cibi-preferiti">
    <div class="container">
        <h1>I tuoi piatti preferiti, consegnati da noi.</h1>
            <div class="row justify-content-between">
                <div class="col-xs-12 col-md-4">
                    <img src="{{'../img/croce.jpg'}}" alt="">
                    <h2>Deliveroo per Croce Rossa Italiana</h2>
                    <p>Deliveroo sta raccogliendo fondi per fornire cibo gratuito alle famiglie più in difficoltà, attraverso la Croce Rossa Italiana (CRI). Puoi contribuire alla raccolta fondi facendo una donazione qui.</p>
                </div>
                <div class="col-xs-12 col-md-4">
                    <img src="{{'../img/mac.jpg'}}" alt="">
                    <h2>McDonald's</h2>
                    <p></p>
                </div>
                <div class="col-xs-12 col-md-4">
                    <img src="{{'../img/obica.jpg'}}" alt="">
                    <h2>Obicà</h2>
                    <p>Ordina la tua mozzarella preferita a casa tua da Obicà grazie alla consegna a domicilio di Deliveroo.</p>
                </div>
            </div>
            <div class="row justify-content-between">
                <div class="col-xs-12 col-md-4">
                    <img src="{{'../img/lievita.jpg'}}" alt="">
                    <h2>Lievità</h2>
                    <p>Ordina la tua pizza preferita a casa tua da Lievità grazie alla consegna a domicilio di Deliveroo.</p>
                </div>
                <div class="col-xs-12 col-md-4">
                    <img src="{{'../img/poke.jpg'}}" alt="">
                    <h2>Pokèria by NIMA</h2>
                    <p></p>
                </div>
                <div class="col-xs-12 col-md-4">
                    <img src="{{'../img/sushi.jpg'}}" alt="">
                    <h2>Daruma Sushi - Ponte Milvio e Centro</h2>
                    <p>Ordina il tuo sushi preferito a casa tua da Daruma Sushi grazie alla consegna a domicilio di Deliveroo.</p>
                </div>
            </div>
            <div class="row justify-content-between">
                <div class="col-xs-12 col-md-4">
                    <img src="{{'../img/temakinho.jpg'}}" alt="">
                    <h2>Temakinho</h2>
                    <p>Ordina il tuo sushi preferito a casa tua da Temakinho grazie alla consegna a domicilio di Deliveroo.</p>
                </div>
                <div class="col-xs-12 col-md-4">
                    <img src="{{'../img/berbere.jpg'}}" alt="">
                    <h2>Berberè Pizzeria</h2>
                    <p></p>
                </div>
                <div class="col-xs-12 col-md-4">
                    <img src="{{'../img/rosticceria.jpg'}}" alt="">
                    <h2>Rosticceria Giacomo</h2>
                    <p></p>
                </div>
            </div>
            <div class="row justify-content-between">
                <div class="col-xs-12 col-md-4">
                    <img src="{{'../img/burger_king.jpg'}}" alt="">
                    <h2>Burger King</h2>
                    <p></p>
                </div>
                <div class="col-xs-12 col-md-4">
                    <img src="{{'../img/macha.jpg'}}" alt="">
                    <h2>Macha</h2>
                    <p>Ordina i tuoi piatti preferiti della cucina giapponese a casa tua da Macha grazie alla consegna a domicilio di Deliveroo.</p>
                </div>
                <div class="col-xs-12 col-md-4">
                    <img src="{{'../img/grom.jpg'}}" alt="">
                    <h2>Grom</h2>
                    <p>Tutti i prodotti sono senza glutine. Sono realizzati senza aggiunta di aromi, coloranti o emulsionanti e creati scegliendo solo il meglio della natura. Innamorati del nostro gelato e gusta anche i nostri biscotti, le creme spalmabili e il nostro cioccolato</p>
                </div>
            </div>
    </div>
</section>

<section class="cerca-tipo">
    <div class="container">
        <h1>Cerchi qualcos'altro?</h1>
        <span class="capitalize">halal</span>
        <span class="capitalize">colazione</span>
        <span class="capitalize">vegetariano</span>
        <span class="capitalize">messicano</span>
        <span class="capitalize">dessert</span>
        <span class="capitalize">indiano</span>
        <span class="capitalize">greco</span>
        <span class="capitalize">giapponese</span>
        <span class="capitalize">cinese</span>
        <span class="capitalize">libanese</span>
        <span class="capitalize">americano</span>
        <span class="capitalize">italiano</span>
        <span class="capitalize">thailandese</span>
        <span class="capitalize">sushi</span>
        <span class="capitalize">pizza</span>
    </div>
</section>


@endsection
