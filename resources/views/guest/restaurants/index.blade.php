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
        {{-- <script src="https://unpkg.com/vue-simple-multi-select@latest"></script> --}}
    </head>
    <body>
        <div id="root">
            {{-- navbar --}}
            <div class="nav-bar-container">
                <div class="row">
                    <div class="col">
                        <nav class="navbar navbar-expand-lg navbar-light color-bg">
                            <div class="logo-guest-restaurant">
                                <a class="navbar-brand" href="{{ url('/') }}">
                                    <img src="{{'../img/logo-bianco.jpg'}}" alt="logo deliveroo">
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
                        </nav>
                    </div>
                </div>
            </div>
            <main>
            @include('_header_cart')

                <div class="main-container">
                    <div class="bg-light ml-3" id="sidebar-wrapper">
                        <h3>seleziona una categoria</h3>
                        <div v-for="categoryName in filterCategory" class="ml-3">
                            <input @change="onChangeCategory(this.value)" class="form-check-input" type="checkbox" v-model="checked"
                            :value="categoryName">
                            <label class="form-check-label">@{{categoryName}}</label>
                        </div>
                    </div>
                    <div class="container box-restaurant-container">
                        <div v-if="!checked.length">
                            {{-- test sezione stampa di tutti i ristoranti --}}
                            <h1>In primo piano</h1>
                            <section id="all-restaurants">
                                @foreach ($restaurants as $restaurant)
                                    <div class="box-restaurant">
                                        <div class="restaurant-img">
                                            <img src="{{ asset('storage/' . $restaurant->cover) }}" alt="{{ $restaurant->name }}">
                                        </div>
                                        <h2>
                                            {{ $restaurant->name }}
                                        </h2>
                                        {{-- <p> {{ $restaurant->slug }}</p> --}}
                                        <p> {{ $restaurant->city }}</p>
                                        <p> {{ $restaurant->address}}</p>
                                        <a href="{{ route('restaurants.show', ['slug' => $restaurant->slug]) }}">
                                            See restaurant page
                                        </a>
                                    </div>
                                @endforeach
                            </section>
                            {{-- Fine sezione stampa dei ristoranti--}}

                        </div>
                        <div v-for="categoryRest in categoriesRestaurants" v-if="visibleRestaurant">
                            <div v-for="item in categoryRest" v-if="checked.includes(item.name)">
                                <h2>Categoria: @{{item.name}}</h2>
                                <div class="card-restaurant-container">
                                    <div v-for="restaurant in item.restaurants" class="card-restaurant">
                                        <div class="restaurant-img">
                                            <img :src="'../../storage/' + restaurant.cover" :alt="'immagine ' + restaurant.name">
                                        </div>
                                        <h4>Restaurant: <a :href="'restaurants/' + restaurant.slug">@{{restaurant.name}}</a></h4>
                                    </div>
                                    <div v-if="item.restaurants.length < 1" class="card-restaurant">
                                        <h4>Non ci sono ristoranti per la categoria @{{item.name}}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                    categoriesRestaurants: [],
                    checked: [],
                    filterCategory: [],
                    visibleRestaurant: false,
                    // selectedValue: '',
                    // selectedCategoryValue: '',
                    // changedValue: '',
                    // changedCategoryValue: '',
                    // visible: false,
                    // visibleCategory: false,
                    // restaurants: [],
                    // restaurantSlugs: [],
                    //
                    // value: '',
                    //
                    // supaCntainer: [],
                    // valoreCheck: '',
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
                        axios.post('/api/categories')
                        .then((element) => {
                            // console.log(element.data.response.categories);
                            for (var i = 0; i < element.data.response.categories.length; i++) {
                                this.filterCategory.push(element.data.response.categories[i].name);
                            }

                        })
                }
            })

        </script>
    </body>
</html>
