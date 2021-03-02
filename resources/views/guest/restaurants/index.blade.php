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
        {{-- navbar --}}
        <div class="nav-bar-container">
            <div class="row m-0">
                <div class="col p-0" style="background-color:white;">
                    <nav class="navbar navbar-expand-lg navbar-light bg-white navbar-restaurants">
                        <div class="logo-guest-restaurant">
                            <a class="navbar-brand" href="{{ url('/') }}">
                                <img src="{{'../img/logo.png'}}" alt="logo deliveroo">
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
                        </div>
                        @include('_header_cart')
                    </nav>
                </div>
            </div>
        </div>
        <div id="root">
            <main>
                {{-- ANIMATIONE CAMION --}}
                <section id="bike-animation">
                    <div class="container-camion">
                        <div class="car-wrapper">
                            <div class="car-wrapper_inner">

                                <div class="car_outter">
                                        <div class="car">
                                            <div class="body">
                                                <div></div>
                                            </div>
                                            <div class="decos">
                                                <div class="line-bot"></div>
                                                <div class="door">
                                                    <div class="handle"></div>
                                                    <div class="bottom-camion"></div>
                                                </div>
                                                <div class="window"></div>
                                                <div class="light"></div>
                                                <div class="light-front"></div>
                                                <div class="antenna"></div>
                                                <div class="logo-camion">
                                                    <img src="{{asset("img/icona-deliveroo.png")}}" alt="Deliveroo">
                                                    {{-- <div class="cone"></div> --}}
                                                </div>
                                            </div>
                                            <div>
                                                <div class="wheel"></div>
                                                <div class="wheel"></div>
                                            </div>
                                            <div class="wind">
                                                <div class="p p1"></div>
                                                <div class="p p2"></div>
                                                <div class="p p3"></div>
                                                <div class="p p4"></div>
                                                <div class="p p5"></div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                        <div class="background-stuff">
                        <div class="bg"></div>
                        <div class="bg bg-2"></div>
                        <div class="bg bg-3"></div>
                        <div class="ground"></div>
                        </div>
                    </div>
                </section>
                {{-- FINE ANIMAZIONE CAMION --}}

                <div class="main-container">
                    <div class="bg-light ml-3" id="sidebar-wrapper">
                        <h4>Categorie:</h4>
                        <div v-for="categoryName in filterCategory" class="ml-3">
                            <input @change="onChangeCategory(this.value)" class="form-check-input" type="checkbox" v-model="checked"
                            :value="categoryName">
                            <label class="form-check-label capitalize">@{{categoryName}}</label>
                        </div>

                    </div>
                    <div class="box-restaurant-container print-restaurants">
                        <h4>Ristoranti che consegnano nella tua città</h4>
                            <p>Consegna gratuita per ordini superiori a 30 €</p>
                            <div class="restaurant-strip">
                                <input type="checkbox" id="checkboxItaliano" class="d-none" @change="onChangeCategory(this.value)" v-model="checked" value="italiano"/>
                                <label class="strip" for="checkboxItaliano"><img src="{{'../img/italian-r.png'}}" alt="ristorante italiano">
                                    <span class="capitalize">Italiano</span>
                                </label>
                                <input type="checkbox" id="checkboxFastFood" class="d-none" @change="onChangeCategory(this.value)" v-model="checked" value="fast-food"/>
                                <label class="strip" for="checkboxFastFood"><img src="{{'../img/fast-food-r.png'}}" alt="ristorante fast-food">
                                    <span class="capitalize">Fast-Food</span>
                                </label>
                                <input type="checkbox" id="checkboxPizza" class="d-none" @change="onChangeCategory(this.value)" v-model="checked" value="pizzeria"/>
                                <label class="strip" for="checkboxPizza"><img src="{{'../img/pizza.png'}}" alt="ristorante pizzeria">
                                    <span class="capitalize">Pizza</span>
                                </label>
                                <input type="checkbox" id="checkboxSushi" class="d-none" @change="onChangeCategory(this.value)" v-model="checked" value="giapponese"/>
                                <label class="strip" for="checkboxSushi"><img src="{{'../img/sushi-1.png'}}" alt="ristorante sushi">
                                    <span class="capitalize">Sushi</span>
                                </label>
                                <input type="checkbox" id="checkboxDessert" class="d-none" @change="onChangeCategory(this.value)" v-model="checked" value="dessert"/>
                                <label class="strip" for="checkboxDessert"><img src="{{'../img/dessert.png'}}" alt="ristorante dessert">
                                    <span class="capitalize">Dessert</span>
                                </label>
                                <input type="checkbox" id="checkboxPoke" class="d-none" @change="onChangeCategory(this.value)" v-model="checked" value="poke"/>
                                <label class="strip" for="checkboxPoke"><img src="{{'../img/poke.png'}}" alt="ristorante poke">
                                    <span class="capitalize">Poke</span>
                                </label>
                            </div>
                            {{-- <div class="video-spot">
                                <div class="container-video">
                                    <video width='600' height="200" autoplay loop muted>
                                        <source src={{asset("video/spot-deliveroo.webm")}} type="video/webm">
                                    </video>
                                </div>
                            </div> --}}
                            <div class="offers-promo">
                                <img src="{{'../img/promo-1.jpg'}}" alt="offers">
                                <img src="{{'../img/promo-2.jpg'}}" alt="offers">
                                <img src="{{'../img/promo-3.jpg'}}" alt="offers">
                            </div>
                {{-- test sezione stampa di tutti i ristoranti --}}
                        <div class="print-restaurants" v-if="!checked.length">
                                <h4>In primo piano</h4>
                                <p>Spazi pagati da partner di qualità</p>
                            <div id="all-restaurants">
                                @foreach ($restaurants as $restaurant)
                                    <a href="{{ route('restaurants.show', ['slug' => $restaurant->slug]) }}">
                                        <div class="box-restaurant">
                                            <div class="restaurant-img">
                                                <img src="{{ asset('storage/' . $restaurant->cover) }}" alt="{{ $restaurant->name }}">
                                            </div>
                                            <h4>
                                                {{ $restaurant->name }}
                                            </h4>
                                            <p> {{ $restaurant->city }}</p>
                                            <p> {{ $restaurant->address}}</p>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                        {{-- Fine sezione stampa dei ristoranti--}}
                        <div v-for="categoryRest in categoriesRestaurants" v-if="visibleRestaurant">
                            <div v-for="item in categoryRest" v-if="checked.includes(item.name)">
                                <h4 class="capitalize underline divisor">Categoria: @{{item.name}}</h4>
                                <div class="card-restaurant-container">
                                    <div v-for="restaurant in item.restaurants" class="all-category">
                                        <a :href="'restaurants/' + restaurant.slug">
                                            <div class="card-restaurant">
                                                <div class="restaurant-img">
                                                        <img :src="'../../storage/' + restaurant.cover" :alt="'immagine ' + restaurant.name">
                                                </div>
                                                <h4>Ristorante: @{{restaurant.name}}</h4>
                                                <p> @{{restaurant.city}}</p>
                                                <p> @{{restaurant.address}}</p>
                                            </div>
                                        </a>
                                    </div>
                                    <div v-if="item.restaurants.length < 1" class="card-restaurant">
                                        <h4>Non ci sono ristoranti per la categoria @{{item.name}}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="main-container">
                    <div class="side">

                    </div>
                    <div class="reserch-restaurant">
                        <h4>Serve una mano con la ricerca?</h4>
                        <div class="restaurant-strip">
                            <input type="checkbox" id="checkboxItaliano" class="d-none" @change="onChangeCategory(this.value)" v-model="checked" value="italiano"/>
                            <label class="strip" for="checkboxItaliano"><img src="{{'../img/italian-r.png'}}" alt="ristorante italiano">
                                <span class="capitalize">Italiano</span>
                            </label>
                            <input type="checkbox" id="checkboxFastFood" class="d-none" @change="onChangeCategory(this.value)" v-model="checked" value="fast-food"/>
                            <label class="strip" for="checkboxFastFood"><img src="{{'../img/fast-food-r.png'}}" alt="ristorante fast-food">
                                <span class="capitalize">Fast-Food</span>
                            </label>
                            <input type="checkbox" id="checkboxPizza" class="d-none" @change="onChangeCategory(this.value)" v-model="checked" value="pizzeria"/>
                            <label class="strip" for="checkboxPizza"><img src="{{'../img/pizza.png'}}" alt="ristorante pizzeria">
                                <span class="capitalize">Pizza</span>
                            </label>
                            <input type="checkbox" id="checkboxSushi" class="d-none" @change="onChangeCategory(this.value)" v-model="checked" value="giapponese"/>
                            <label class="strip" for="checkboxSushi"><img src="{{'../img/sushi-1.png'}}" alt="ristorante sushi">
                                <span class="capitalize">Sushi</span>
                            </label>
                            <input type="checkbox" id="checkboxDessert" class="d-none" @change="onChangeCategory(this.value)" v-model="checked" value="dessert"/>
                            <label class="strip" for="checkboxDessert"><img src="{{'../img/dessert.png'}}" alt="ristorante dessert">
                                <span class="capitalize">Dessert</span>
                            </label>
                            <input type="checkbox" id="checkboxPoke" class="d-none" @change="onChangeCategory(this.value)" v-model="checked" value="poke"/>
                            <label class="strip" for="checkboxPoke"><img src="{{'../img/poke.png'}}" alt="ristorante poke">
                                <span class="capitalize">Poke</span>
                            </label>
                        </div>
                    </div>
                </div>
            </main>
            @include('partials.footer')
        </div>


        <script type="text/javascript">

            var app = new Vue ({
                el: '#root',
                data: {
                    categoriesRestaurants: [],
                    checked: [],
                    filterCategory: [],
                    visibleRestaurant: false,
                },
                methods: {
                    onChangeCategory(value) {
                        this.visibleRestaurant = false;
                        this.categoriesRestaurants = [];

                        // console.log(this.selectedCategoryValue);
                        axios.post('/api/categoriesRestaurants')
                        .then((element) => {
                            // console.log(element.data.response.categoriesRestaurants);
                            this.categoriesRestaurants.push(element.data.response.categoriesRestaurants);
                            for (var i = 0; i < element.data.response.categoriesRestaurants.length; i++) {
                                this.visibleRestaurant = false;

                                if (element.data.response.categoriesRestaurants[i].restaurants.length > 0) {
                                    this.visibleRestaurant = true;
                                }
                                // console.log(this.visibleRestaurant);
                            }


                        })
                    },
                },
                mounted() {
                    axios.post('/api/categories').then((element) => {
                        // console.log(element.data.response.categories);
                        for (var i = 0; i < element.data.response.categories.length; i++) {
                            this.filterCategory.push(element.data.response.categories[i].name);
                        }

                    });
                }
            });

        </script>
    </body>
</html>
