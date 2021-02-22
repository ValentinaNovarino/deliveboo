<div id="header-bar" class="main-section">
    <div class="dropdown">
        <button type="button" class="btn btn-deliveroo" data-toggle="dropdown">

            @if (!session()->get('cart'))
                <i class="fa fa-shopping-cart p-1" aria-hidden="true"></i><span class="badge badge-pill badge-danger"> 0 €</span>

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
                <i class="fa fa-shopping-cart p-1" aria-hidden="true"></i><span class="badge badge-pill badge-danger"> {{ $totale }} €</span>

            @endif

            {{-- <i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart <span class="badge badge-pill badge-danger">{{ count((array) session('cart')) }}</span> --}}

        </button>
        <div class="dropdown-menu">
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
                            <img src="{{ $details['cover'] }}" />
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
</div>
