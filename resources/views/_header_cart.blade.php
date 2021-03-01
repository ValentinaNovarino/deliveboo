<div class="container">
    <div id="header-bar" class="main-section">
        <div class="single-restaurant-logo">
            <a href="{{ route('uiHome') }}">
                <img src="../img/logo.png" alt="">
            </a>
        </div>
        <div class="dropdown">
            <button id="open"onclick=popup() type="button" class="btn btn-deliveroo" data-toggle="dropdown">
                @if (!session()->get('cart'))
                    <i class="fa fa-shopping-cart p-1" aria-hidden="true"></i><span class="badge badge-pill badge-danger"> 0 €</span>

                @else
                    @php
                    $elementi = session()->get('cart');
                    $totale = 0;
                    @endphp

                    {{-- {{dd($elementi)}} --}}
                    {{-- {{ dd($elementi) }} --}}
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
                        {{-- {{dd($details)}} --}}
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
        <div class="header-bar-menu">
            <!-- Right Side Of Navbar -->
            <ul>
                <li>
                    <a class="nav-link" href="#">
                        Home
                    </a>
                </li>
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
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
            </ul>
        </div>
    </div>
</div>

<script type="text/javascript">

    //function for opening the popup
    function popup(){
        var mes=document.getElementById('pop');
        mes.style.transform="scale(1)";
        mes.style.transitionTimingFunction="cubic-bezier(0,0,0,1.47)";
        navigator.vibrate(250);
    }

    //function for closing the popup
    function popin(){
        var mes=document.getElementById('pop');
        mes.style.transform="scale(0)";
        mes.style.transitionTimingFunction="cubic-bezier(0,0,0,-1.47)";
    }
</script>
