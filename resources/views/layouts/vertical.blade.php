<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

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
    <link href="{{ asset('theme/lib/fontawesome-pro-master/css/all.min.css') }}" rel="stylesheet">
    {{-- <link href="{{ asset('theme/lib/ionicons/css/ionicons.min.css') }}" rel="stylesheet"> --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/lib/remixicon/fonts/remixicon.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/lib/jqvmap/jqvmap.min.css') }}">

    <!-- DashForge CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/assets/css/dashforge.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/assets/css/dashforge.dashboard.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/assets/css/dashforge.demo.css') }}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/sweetalert2.min.css?v=1.0')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app2.css?v=1.0.0') }}">

    <style>
        .nav-aside .nav-link span {
            padding-top: 4px; 
        }
    </style>

    @yield('css')
</head>
<body>
    @include('layouts.menu_v')

    <div class="content ht-100v pd-0">
        <div class="content-header">
            <div class="content-search">
                <i data-feather="search"></i>
                <input type="search" class="form-control" placeholder="Search...">
            </div>
            <nav class="nav">
                {{-- <a href="#" class="nav-link"><i data-feather="help-circle"></i></a>
                <a href="#" class="nav-link"><i data-feather="grid"></i></a> --}}
                <a href="{{route('home')}}" class="nav-link"><i data-feather="monitor"></i></a>
                <a href="{{ route('logout') }}" class="nav-link" data-bs-toggle="tooltip" title="Cerrar Sesión" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();"><i class="text-danger" data-feather="log-out"></i></a>
            </nav>
        </div>
    
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        
        {{-- LOAD SUBMIT --}}
        <div class="a_load">
            <img src="{{ asset('ajax-loader-1.gif') }}" alt="Loading ...">
            <h5 style="color: #2e2e2e;">PROCESANDO, ESPERE ...</h5>
        </div>
        {{-- LOAD SUBMIT --}}

        @yield('content')
    </div>
  
    <script src="{{ asset('theme/lib/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('theme/lib/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('theme/lib/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('theme/lib/ionicons/ionicons/ionicons.esm.js') }}" type="module"></script>
    <script src="{{ asset('theme/lib/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('theme/lib/jquery.flot/jquery.flot.js') }}"></script>
    <script src="{{ asset('theme/lib/jquery.flot/jquery.flot.stack.js') }}"></script>
    <script src="{{ asset('theme/lib/jquery.flot/jquery.flot.resize.js') }}"></script>
    <script src="{{ asset('theme/lib/chart.js/Chart.bundle.min.js') }}"></script>
    <script src="{{ asset('theme/lib/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('theme/lib/jqvmap/maps/jquery.vmap.usa.js') }}"></script>

    <script src="{{ asset('theme/assets/js/dashforge.js') }}"></script>
    <script src="{{ asset('theme/assets/js/dashforge.aside.js') }}"></script>
    <script src="{{ asset('theme/assets/js/dashforge.sampledata.js') }}"></script>

    <script src="{{ asset('js/sweetalert2.all.min.js?v=1.0') }}"></script>
    <script src="{{ asset('js/axios.min.js') }}"></script>
    <script src="{{ asset('js/vue.min.js') }}"></script>
    
    <!-- append theme customizer -->
    <script src="{{ asset('theme/lib/js-cookie/js.cookie.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>

    @yield('js')
</body>
</html>
