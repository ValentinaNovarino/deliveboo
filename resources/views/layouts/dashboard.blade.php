<!DOCTYPE html>
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

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark flex-md-nowrap p-0">
        <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Boolpress</a>
        <ul class="navbar-nav px-3 ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="#">
                    Posts Management
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.index') }}">
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                    Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
    </nav>
    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-2 d-none d-md-block bg-light sidebar py-4">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="{{route('admin.index')}}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('admin.dishes.index')}}">
                                <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 56.999 56.999" style="enable-background:new 0 0 56.999 56.999;" xml:space="preserve" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <g>
                                        <path d="M56.784,40.046C56.452,39.4,55.795,39,55.069,39h-1.095c-0.464-12.195-9.362-22.26-21.017-24.52
                                        C32.974,14.319,33,14.159,33,14c0-2.757-2.243-5-5-5s-5,2.243-5,5c0,0.159,0.025,0.32,0.043,0.48
                                        C11.387,16.739,2.489,26.805,2.025,39H1.93c-0.726,0-1.383,0.4-1.715,1.046s-0.276,1.413,0.146,2.004l2.26,3.164
                                        C3.867,46.959,5.891,48,8.034,48h40.932c2.143,0,4.167-1.041,5.413-2.786l2.261-3.164C57.061,41.459,57.116,40.691,56.784,40.046z
                                        M25.006,14.172C25.002,14.114,25,14.056,25,14c0-1.654,1.346-3,3-3s3,1.346,3,3c0,0.057-0.002,0.114-0.006,0.172
                                        c-0.047-0.005-0.094-0.007-0.14-0.012c-0.344-0.038-0.69-0.065-1.038-0.089c-0.128-0.009-0.255-0.022-0.383-0.029
                                        C28.957,14.015,28.48,14,28,14s-0.958,0.015-1.432,0.041c-0.128,0.007-0.255,0.02-0.383,0.029
                                        c-0.348,0.024-0.694,0.052-1.038,0.089C25.1,14.165,25.053,14.166,25.006,14.172z M24.406,16.269
                                        c0.535-0.08,1.075-0.138,1.615-0.182c0.11-0.009,0.22-0.017,0.33-0.024c1.098-0.074,2.201-0.074,3.299,0
                                        c0.11,0.008,0.22,0.016,0.33,0.024c0.54,0.044,1.079,0.102,1.615,0.182C42.806,17.96,51.503,27.437,51.979,39H4.02
                                        C4.497,27.437,13.193,17.96,24.406,16.269z M52.751,44.051C51.879,45.271,50.464,46,48.965,46H8.034
                                        c-1.499,0-2.914-0.729-3.786-1.948L2.068,41H54h0.931L52.751,44.051z"/>
                                        <path d="M27.986,18c-1.643,0-3.278,0.181-4.86,0.537c-0.539,0.121-0.877,0.656-0.756,1.195c0.105,0.465,0.518,0.78,0.975,0.78
                                        c0.073,0,0.147-0.008,0.221-0.024C25.004,20.164,26.491,20,27.986,20c0.004,0,0.008,0,0.013,0h0c0.552,0,1-0.447,1-0.999
                                        C29,18.444,28.556,17.981,27.986,18z"/>
                                        <path d="M17.15,20.899C11.946,23.982,8.158,29.56,7.016,35.82c-0.099,0.544,0.261,1.064,0.805,1.163
                                        C7.881,36.995,7.941,37,8.001,37c0.474,0,0.895-0.338,0.983-0.82c1.039-5.698,4.473-10.768,9.186-13.56
                                        c0.475-0.281,0.632-0.895,0.351-1.37C18.238,20.775,17.626,20.618,17.15,20.899z"/>
                                    </svg>
                                Dishes
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                              Users
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><polyline points="4 7 4 4 20 4 20 7"></polyline><line x1="9" y1="20" x2="15" y2="20"></line><line x1="12" y1="4" x2="12" y2="20"></line></svg>
                              Categories
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path><line x1="7" y1="7" x2="7" y2="7"></line></svg>
                              Tags
                            </a>
                        </li>
                    </ul>

                </div>
            </nav>

            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 py-4">
                @yield('admin.content')
            </main>
        </div>
    </div>
</body>
</html>
