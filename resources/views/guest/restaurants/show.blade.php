@extends('layouts.app')

@section('content')
    {{-- POPUP CART  --}}
    <div class="section-dropcart p-2 d-flex justify-content-center">
        <button id="open"onclick=popup() type="button" class="btn-deliveroo " data-toggle="dropdown">
            @if (!session()->get('cart'))
                <i class="fa fa-shopping-cart" aria-hidden="true"></i> <span class="badge badge-pill badge-danger">0 €</span>
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
                <i class="fa fa-shopping-cart" aria-hidden="true"></i> <span class="badge badge-pill badge-danger">{{ $totale }} €</span>
            @endif

            {{-- <i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart <span class="badge badge-pill badge-danger">{{ count((array) session('cart')) }}</span> --}}
        </button>

        <div id="pop" class="dropdown-menu">
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
                <button id="cross"onclick=popin()>
                    &times;
                </button>
            </div>
        </div>
    </div>

    {{-- FINE POPUP CART --}}

    <main>
        <h1>Pagina singolo ristorante</h1>


    </main>

    <script type="text/javascript">
    //function for opening the popup
        function popup(){
            var mes=document.getElementById('pop');
            mes.style.transform="scale(1)";
            mes.style.transitionTimingFunction="linear";
            navigator.vibrate(250);
        }

        //function for closing the popup
        function popin(){
            var mes=document.getElementById('pop');
            mes.style.transform="scale(0)";
            mes.style.transitionTimingFunction="linear";
        }
    </script>
@endsection
