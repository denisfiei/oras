@php
    $config_cache = Cache::get('config_cache');
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    
    <!-- Meta -->
    <meta name="description" content="Plataforma de Vigilancia Genómica">
    <meta name="author" content="Oras">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    <title>{{ config('app.name', 'ORAS-APP') }}</title>

    <!-- vendor css -->
    <link href="{{ asset('theme/lib/@fortawesome/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('theme/lib/remixicon/fonts/remixicon.css') }}" rel="stylesheet">

    <!-- DashForge CSS -->
    <link rel="stylesheet" href="{{ asset('theme/assets/css/dashforge.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/assets/css/dashforge.auth.css') }}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/sweetalert2.min.css?v=1.0') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">

    @yield('css')
</head>

<body>
    @include('layouts.menu_h')

    <div class="content content-fixed content-auth">
        <div class="container">
            {{-- LOAD SUBMIT --}}
            <div class="a_load">
                <img src="{{ asset('ajax-loader-1.gif') }}" alt="Loading ...">
                <h5>PROCESANDO, ESPERE ...</h5>
            </div>
            {{-- LOAD SUBMIT --}}

            @yield('content')
        </div>
    </div>

    <footer class="footer">
        <div>
            <span>&copy; 2023 DashForge v1.0.0. </span>
            <span>Created by <a href="http://themepixels.me">ThemePixels</a></span>
        </div>
        <div>
            <nav class="nav">
                <a href="https://themeforest.net/licenses/standard" class="nav-link">Licenses</a>
                <a href="theme/change-log.html" class="nav-link">Change Log</a>
                <a href="https://discordapp.com/invite/RYqkVuw" class="nav-link">Get Help</a>
            </nav>
        </div>
    </footer>

    <script src="{{ asset('theme/lib/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('theme/lib/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('theme/lib/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('theme/lib/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>

    <script src="{{ asset('theme/assets/js/dashforge.js') }}"></script>

    <script src="{{ asset('js/sweetalert2.all.min.js?v=1.0') }}"></script>
    <script src="{{ asset('js/axios.min.js') }}"></script>
    <script src="{{ asset('js/vue.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>

    @yield('js')

    <!-- append theme customizer -->
    <script src="{{ asset('theme/lib/js-cookie/js.cookie.js') }}"></script>
    <script src="{{ asset('theme/assets/js/dashforge.settings.js') }}"></script>
    <script>
        $(function(){
            'use script'

            window.darkMode = function(){
                $('.btn-white').addClass('btn-dark').removeClass('btn-white');
            }

            window.lightMode = function() {
                $('.btn-dark').addClass('btn-white').removeClass('btn-dark');
            }

            var hasMode = Cookies.get('df-mode');
            if(hasMode === 'dark') {
                darkMode();
            } else {
                lightMode();
            }
        })
    </script>
  </body>
</html>
