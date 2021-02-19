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

        {{-- VUE-MULTIselect --}}
        <script src="https://unpkg.com/vue-simple-multi-select@latest"></script>
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
                                <div class="d-flex align-items-center" v-if="prova">
                                    <label>Choose a category!</label>
                                    <vue-multi-select
                                    v-model="value"
                                    :options="filterCategory"
                                    ></vue-multi-select>
                                </div>

                            </div>
                        </nav>
                    </div>
                </div>
            </div>
            <main>
            @include('partials.header-cart')

                <div class="main-container">
                    <div class="bg-light" id="sidebar-wrapper">
                        <h3>seleziona una categoria</h3>
                        <div class="form-check" v-for="category in categories">
                            <input  @click="checkSuperContainer(category)" class="form-check-input" type="checkbox" v-model="checked" :value="category">
                            <label class="form-check-label">@{{category.name}}</label>
                        </div>
                    </div>
                    {{-- <div class="card-restaurant-container">
                        <div class="container">
                            <div class="row">
                                <div class="col">
                                    <div v-for="check in checked" class="div" v-if="check.restaurants.length">
                                        <div v-for="category in categories" class="div2" v-if="value.includes(category.name) || check.restaurants.length">
                                            <h2>Categoria: @{{check.name}}</h2>
                                            <div v-for="item in check.restaurants" class="card-restaurant">
                                                <h4>nome del ristorante : <a href="#">@{{item.name}}</a>
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <div v-if="checked.length" class="for-checkbox-container">
                        <div class="card-restaurant-container">
                            <div class="container">
                                <div class="row">
                                    <div class="col">
                                        <div v-for="check in checked" class="card-restaurant" v-if="check.restaurants.length">
                                            <h2>Categoria: @{{check.name}}</h2>
                                            <div v-for="item in check.restaurants" class="card-restaurant">
                                                <h4>nome del ristorante : <a href="#">@{{item.name}}</a>
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
                    <div v-else class="for-select-container">
                        <div class="card-restaurant-container">
                            <div class="container">
                                <div class="row">
                                    <div class="col">
                                        <div v-for="category in categories" class="card-restaurant" v-if="value.includes(category.name)">
                                            <h2>Categoria: @{{category.name}}</h2>
                                            <div v-for="item in category.restaurants" class="card-restaurant">
                                                <h4>Nome del ristorante: <a href="#">@{{item.name}}</a></h4>
                                            </div>
                                            <div v-if="category.restaurants.length < 1" class="card-restaurant">
                                                <h4>Non ci sono ristoranti per la categoria @{{category.name}}</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- test sezione stampa di tutti i ristoranti --}}
                <section id="all-restaurants">
                    @foreach ($restaurants as $restaurant)
                        <div class="box-restaurant">
                            <h2>
                                {{ $restaurant->name }}
                            </h2>
                            <p> {{ $restaurant->slug }}</p>
                            <a class="" href="{{ route('restaurants.show', ['slug' => $restaurant->slug]) }}">
                                See restaurant page
                            </a>
                        </div>
                    @endforeach
                </section>
                {{-- Fine sezione stampa dei ristoranti--}}
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
                    link: "{{url('/')}}",
                    value: '',
                    filterCategory: [],
                    superContainer: [],
                    prova: true,
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
                    checkSuperContainer(element) {
                        this.superContainer.push(element)
                    },
                },
                mounted() {
                        axios.post('/api/categories')
                        .then((element) => {
                            this.categories = element.data.response.categoriesRestaurants;
                            for (var i = 0; i < element.data.response.categoriesRestaurants.length; i++) {

                                this.filterCategory.push(element.data.response.categoriesRestaurants[i].name);
                                // console.log(element.data.response.categoriesRestaurants[i].restaurants);
                                // if (element.data.response.categoriesRestaurants[i].restaurants.length) {
                                //     this.filterCategory.push(element.data.response.categoriesRestaurants[i].name);
                                // }
                            }

                        })
                }
            })

        </script>
    </body>
</html>
