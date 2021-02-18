<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="//db.onlinewebfonts.com/c/dd97c93d1184d223b93c9042b7e57980?family=Stratos+Web" rel="stylesheet" type="text/css"/>

        {{-- FONTAWESOME --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        {{-- VUE --}}
        <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12"></script>
        {{-- AXIOS --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js" integrity="sha512-bZS47S7sPOxkjU/4Bt0zrhEtWx0y0CRkhEp8IckzK+ltifIIE9EMIMTuT/mEzoIMewUINruDBIR/jJnbguonqQ==" crossorigin="anonymous"></script>
    </head>
    <body>
        <div id="root">
            {{-- navbar --}}
            <div class="nav-bar-container">
                <div class="row">
                    <div class="col">
                        <nav class="navbar navbar-expand-lg navbar-light bg-light">
                            <div class="logo-guest-restaurant">
                                <a class="navbar-brand" href="{{ url('/') }}">
                                    <img src="{{ asset('../img/logo.png') }}" alt="logo deliveroo">
                                </a>
                            </div>
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>

                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav mr-auto">
                                    <li class="nav-item active">
                                        <a class="nav-link" href="{{ url('/') }}">Home <span class="sr-only">(current)</span></a>
                                    </li>
                                </ul>
                                <form class="form-inline my-2 my-lg-0">
                                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                                    <button class="btn btn-outline-success my-2 my-sm-0" type="">Search</button>
                                </form>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
            <main>
                {{-- POPUP CART  --}}
                <div class="section-dropcart p-2">
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

                <div class="main-container">
                    <div class="bg-light" id="sidebar-wrapper">
                        <h3>seleziona una categoria</h3>
                        <div class="form-check" v-for="category in categories">
                            <input  class="form-check-input" type="checkbox" v-model="checked" :value="category">
                            <label class="form-check-label">@{{category.name}}</label>
                        </div>
                    </div>
                    <div class="card-restaurant-container">
                        <div class="container">
                            <div class="row">
                                <div class="col">
                                    <div v-for="check in checked" class="card-restaurant" v-if="check.restaurants.length">
                                        <h2>Categoria: @{{check.name}}</h2>
                                        <p>@{{check}}</p>
                                        <div v-for="item in check.restaurants" class="card-restaurant">
                                            <h4>nome del ristorante :
                                                <a href="">@{{item.name}}</a>
                                            </h4>
                                        </div>
                                    </div>
                                    <div v-else class="card-restaurant">
                                        <h4>Non ci sono ristoranti per la categoria @{{check.name}}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <h3>seleziona un ristorante</h3>
                            <select @change="onChange(this.value)" v-model="selectedValue">
                                <option value="">seleziona ristorante</option>
                                @foreach ($restaurants as $restaurant)
                                    <option value="{{$restaurant->id}}">{{ $restaurant->name }}</option>
                                @endforeach
                            </select>
                            <div v-for="restaurant in restaurants" v-if="visible && restaurant.id == selectedValue" class="card-restaurant">
                                {{-- <p>@{{ restaurant.id }}</p> --}}
                                <h4>nome del ristorante : <a href="#">@{{ restaurant.name }}</a></h4>
                                <h4>@{{ restaurant.slug }}</h4>
                            </div>
                        </div>
                        <ul>
                            <li><router-link :to="{ name: 'restaurants', params: { restaurantSlug: 123 }}">qui</router-link></li>
                        </ul>
                    </div>
                </div>
            </main>
        </div>

        {{-- footer --}}
        @include('partials.footer')

        <script type="text/javascript">

            var app = new Vue ({
                el: '#root',
                data: {
                    selectedValue: '',
                    selectedCategoryValue: '',
                    changedValue: '',
                    changedCategoryValue: '',
                    visible: false,
                    visibleCategory: false,
                    restaurants: [],
                    restaurantSlugs: [],
                    categories: [],
                    checked: [],

                },
                methods: {
                    onChange(value) {
                        this.visible = false;
                        this.restaurants = [];
                        this.categories = [];

                        console.log(this.selectedValue);

                        axios.post('/api/restaurants')
                        .then((element) => {
                            // this.dishes = response.data.dishes;
                            console.log(element.data.response);
                            // console.log(element.data);
                            this.restaurants = element.data.response;
                            for (var i = 0; i < element.data.response.length; i++) {
                                console.log(element.data.response[i].id);
                                console.log(element.data.response[i].slug);
                                this.restaurantSlugs.push(element.data.response[i].slug);
                                this.changedValue = element.data.response[i].id;
                                if (this.selectedValue == this.changedValue) {
                                    this.visible = true;
                                }
                            }
                        })
                    },
                },
                mounted() {
                        axios.post('/api/categories')
                        .then((element) => {
                            this.categories = element.data.response.categoriesRestaurants;

                        })
                }
            })

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
    </body>
</html>
