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
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

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
            <div class="container">
                <div class="row">
                    <div class="col">
                        <nav class="navbar navbar-expand-lg navbar-light bg-light">
                            <a class="navbar-brand" href="{{ url('/') }}">
                                <img src="{{ asset('../img/logo-bianco.jpg') }}" alt="logo deliveroo">
                            </a>
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>

                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav mr-auto">
                                    <li class="nav-item active">
                                        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
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
            <div class="bg-light border-right" id="sidebar-wrapper">
                <div class="sidebar-heading">Start Bootstrap </div>
                <h3>seleziona un ristorante</h3>
                <select @change="onChange(this.value)" v-model="selectedValue">
                    <option value="">seleziona ristorante</option>
                    @foreach ($restaurants as $restaurant)
                        <option value="{{$restaurant->id}}">{{ $restaurant->name }}</option>
                    @endforeach
                </select>

                <h3>seleziona una categoria</h3>
                <select @change="onChangeCategory(this.value)" v-model="selectedCategoryValue">
                    <option value="">seleziona categoria</option>
                    @foreach ($categories as $category)
                        <option value="{{$category->id}}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div v-for="restaurant in restaurants" v-if="visible && restaurant.id == selectedValue">
                            <p>@{{ restaurant.id }}</p>
                            <p>nome del ristorante : @{{ restaurant.name }}</p>
                            <p>@{{ restaurant.slug }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div v-for="category in categories" v-if="visibleCategory && category.id == selectedCategoryValue">
                            {{-- <p>@{{ category.id }}</p> --}}
                            <h4>categoria : @{{ category.name }}</h4>
                            <div v-for="item in category.restaurants">
                                <h4>nome del ristorante : <a href="#">@{{item.name}}</a></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- @include('partials.footer') --}}
        <script type="text/javascript">
        var app = new Vue ({
            el: '#root',
            data: {
                saluto: 'ciao',
                selectedValue: '',
                selectedCategoryValue: '',
                changedValue: '',
                changedCategoryValue: '',
                visible: false,
                visibleCategory: false,
                restaurants: [],
                categories: [],
                categorieRestaurants: [],

            },
            methods: {
                onChange(value) {
                    this.visible = false;

                    console.log(this.selectedValue);

                    axios.post('/api/restaurants')
                    .then((element) => {
                        // this.dishes = response.data.dishes;
                        console.log(element.data.response);
                        // console.log(element.data);
                        this.restaurants = element.data.response;
                        for (var i = 0; i < element.data.response.length; i++) {
                            console.log(element.data.response[i].id);
                            this.changedValue = element.data.response[i].id;
                            if (this.selectedValue == this.changedValue) {
                                this.visible = true;
                            }
                        }
                    })
                },
                onChangeCategory(value) {
                    this.visibleCategory = false;
                    this.categorieRestaurants = [];
                    console.log(this.selectedCategoryValue);

                    axios.post('/api/categories')
                    .then((element) => {
                        // this.dishes = response.data.dishes;
                        // console.log(element.data.response);
                        // console.log(element.data.response.prova);
                        // console.log(element.data.response.prova[0].restaurants[0].name);
                        // console.log(element.data);
                        this.categories = element.data.response.prova;
                        for (var i = 0; i < element.data.response.prova.length; i++) {
                            console.log(element.data.response.prova[i]);
                            // console.log(element.data.response.prova[i].restaurants);
                            if (element.data.response.prova[i].restaurants.length > 0) {
                                this.categorieRestaurants.push(element.data.response.prova[i].restaurants);
                                // console.log(this.categorieRestaurants);
                            }
                            // console.log(element.data.response.prova[i].id);
                            this.changedCategoryValue = element.data.response.prova[i].id;
                            if (this.selectedCategoryValue == this.changedCategoryValue) {
                                this.visibleCategory = true;
                            }
                        }
                    })
                },
                // onChangeCategory(value) {
                //     this.visibleCategory = false;
                //
                //     console.log(this.selectedCategoryValue);
                //
                //     axios.post('/api/categories')
                //     .then((element) => {
                //
                //         console.log(element.data.response);
                //
                //         // console.log(element.data);
                //         this.categories = element.data.response;
                //         for (var i = 0; i < element.data.response.length; i++) {
                //             console.log(element.data.response[i].id);
                //             this.changedCategoryValue = element.data.response[i].id;
                //             if (this.selectedCategoryValue == this.changedCategoryValue) {
                //                 this.visibleCategory = true;
                //             }
                //         }
                //     })
                // },
            },
            mounted() {

            }
        })
    </script>
    </body>
</html>
