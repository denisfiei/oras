@php
    $path = Request::root();
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
    {{-- <link href="{{ asset('theme/lib/@fortawesome/fontawesome-free/css/all.min.css') }}" rel="stylesheet"> --}}
    <link href="{{ asset('theme/lib/fontawesome-pro-master/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('theme/lib/remixicon/fonts/remixicon.css') }}" rel="stylesheet">

    <!-- DashForge CSS -->
    <link rel="stylesheet" href="{{ asset('theme/assets/css/dashforge.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/assets/css/dashforge.auth.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/assets/css/dashforge.filemgr.css') }}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/sweetalert2.min.css?v=1.0') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css?v=1.0.0') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    {{-- <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Archivo:wght@300&family=Merriweather+Sans:wght@300&display=swap" rel="stylesheet"> --}}

    @yield('css')
</head>

<body>
    <nav class="navbar navbar-header navbar-header-fixed">
        <a href="#" id="mainMenuOpen" class="burger-menu"><i data-feather="menu"></i></a>
        <div class="navbar-brand">
            @if ($config_cache->logo)
                <a href="{{url("/")}}" class="df-logo"><img src="{{ $path.'/storage/'.$config_cache->logo }}" alt="Logo" style="max-width: 70px; max-height: 45px;"></a>
            @else
                <a href="{{url("/")}}" class="df-logo">ORAS-<span>APP</span></a>
            @endif
            <span class="logo_title">ORGANISMO ANDINO DE SALUD<br>CONVENIO HIPÓLITO UNANUE</span>
        </div>
        <div id="navbarMenu" class="navbar-menu-wrapper">
            <div class="navbar-menu-header">
                <a href="theme/index.html" class="df-logo">ORAS</span></a>
                <a id="mainMenuClose" href=""><i data-feather="x"></i></a>
            </div>
            <ul class="nav navbar-menu">
                {{-- <li class="nav-label pd-l-20 pd-lg-l-25 d-lg-none">Main Navigation</li>
                <li class="nav-item with-sub">
                    <a href="" class="nav-link"><i data-feather="package"></i> Apps</a>
                    <ul class="navbar-menu-sub">
                        <li class="nav-sub-item"><a href="app-calendar.html" class="nav-sub-link"><i data-feather="calendar"></i>Calendar</a></li>
                        <li class="nav-sub-item"><a href="app-chat.html" class="nav-sub-link"><i data-feather="message-square"></i>Chat</a></li>
                        <li class="nav-sub-item"><a href="app-contacts.html" class="nav-sub-link"><i data-feather="users"></i>Contacts</a></li>
                        <li class="nav-sub-item"><a href="app-file-manager.html" class="nav-sub-link"><i data-feather="file-text"></i>File Manager</a></li>
                        <li class="nav-sub-item"><a href="app-mail.html" class="nav-sub-link"><i data-feather="mail"></i>Mail</a></li>
                    </ul>
                </li>
                <li class="nav-item"><a href="theme/components/" class="nav-link"><i data-feather="box"></i> Components</a></li>
                <li class="nav-item"><a href="theme/collections/" class="nav-link"><i data-feather="archive"></i> Collections</a></li> --}}

                <a href="{{$config_cache->facebook}}" class="btn_socials" target="_blank"><i class="fab fa-facebook-f"></i> </a>
                <a href="{{$config_cache->twitter}}" class="btn_socials" target="_blank"><i class="fab fa-twitter"></i> </a>
                <a href="{{$config_cache->instagram}}" class="btn_socials" target="_blank"><i class="fab fa-instagram"></i> </a>
                <a href="{{$config_cache->youtube}}" class="btn_socials" target="_blank"><i class="fab fa-youtube"></i> </a>
                @if (Auth::check())
                    <a href="{{route('home')}}" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hola {{Auth::user()->nombres}}, haga click para ir al Sistema" class="btn_auth ms-1"><img src="{{asset('images/auth.png')}}" alt="auth" class="img_icon"></a>
                @else
                    <a href="{{route('login')}}" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Iniciar Sesión" class="{{(request()->is('login')) ? 'hide' : 'btn_auth ms-1'}}"><img src="{{asset('images/auth.png')}}" alt="auth" class="img_icon"></a>
                @endif
            </ul>
        </div>
        <div class="navbar-right df-logo">
            <div class="df-logo">
                <img src="{{asset('images/logos/logo_BID.png')}}" alt="BID" class="bid">
            </div>
        </div>
    </nav>
    
    {{-- LOAD SUBMIT --}}
    <div class="a_load">
        <img src="{{ asset('ajax-loader-1.gif') }}" alt="Loading ...">
        <h5>PROCESANDO, ESPERE ...</h5>
    </div>
    {{-- LOAD SUBMIT --}}

    @yield('content')

    <div class="bg_1 mt-5">
        <div class="container">
            <div class="row pt-5 pb-5">
                <div class="col-lg-6 col-md-12 col-sm-12">
                    <h2 class="bg_5 px-5 py-5 m-0">Contacto</h2>
                    <div class="bg_3 px-5 py-3">
                        <ul class="p-0 m-0">
                            <li class="list_red mb-1 tx-18">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>Av. Paseo la República N° 3832<br>Tercer Piso. Lima - Perú</span>
                            </li>
                            <li class="list_red tx-18">
                                <i class="fas fa-phone-rotary"></i>
                                <span>(511) 611-3700</span>
                            </li>
                        </ul>
                    </div>
                    <div class="bg_6 px-5 py-3">
                        <h5 class="">Email</h5>
                        <ul class="p-0 m-0">
                            <li class="list_red">
                                <i class="fas fa-envelope"></i>
                                <span class="tx-18">contacto@conhu.org.pe</span>
                            </li>
                        </ul>
                    </div>
                    <div class="bg-white px-5 py-3">
                        <h5 class="text_1">Redes Sociales</h5>
                        <div style="display: flex;">
                            <a href="{{$config_cache->facebook}}" class="btn_socials" target="_blank"><i class="fab fa-facebook-f"></i> </a>
                            <a href="{{$config_cache->twitter}}" class="btn_socials" target="_blank"><i class="fab fa-twitter"></i> </a>
                            <a href="{{$config_cache->instagram}}" class="btn_socials" target="_blank"><i class="fab fa-instagram"></i> </a>
                            <a href="{{$config_cache->youtube}}" class="btn_socials" target="_blank"><i class="fab fa-youtube"></i> </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12">
                    <div class="mt-3 text-center">
                        <div style="display: flex; justify-content: center;">
                            @if ($config_cache->logo)
                                <img src="{{ $path.'/storage/'.$config_cache->logo }}" alt="Logo" style="max-width: 100px;"></a>
                            @endif
                            <span class="text-white tx-bold ps-3 tx-18" style="padding-top: 22px;">ORGANISMO ANDINO DE SALUD<br>CONVENIO HIPÓLITO UNANUE</span>
                        </div>
                    </div>
                    <div class="mt-5 text-center">
                        <img src="{{asset('images/logos/logo_home_white.png')}}" alt="logo_white" style="max-width: 300px">
                    </div>
                    <div class="mt-5 text-center">
                        <div class="content_institutos">
                            <img src="{{asset('images/logos/logo_ins_bol.png')}}" alt="Ins_Bol" style="max-height: 50px;" class="pe-2">
                            <img src="{{asset('images/logos/logo_ins_col.png')}}" alt="Ins_Col" style="max-height: 50px;" class="pe-2">
                            <img src="{{asset('images/logos/logo_ins_ecu.png')}}" alt="Ins_Ecu" style="max-height: 50px;" class="pe-2">
                            <img src="{{asset('images/logos/logo_ins_per.png')}}" alt="Ins_Per" style="max-height: 50px;" class="pe-2">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- <footer class="footer">
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
    </footer> --}}

    <script src="{{ asset('theme/lib/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('theme/lib/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('theme/lib/feather-icons/feather.min.js') }}"></script>
    {{-- <script src="{{ asset('theme/lib/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script> --}}

    <script src="{{ asset('theme/assets/js/dashforge.js') }}"></script>
    <script src="{{ asset('theme/assets/js/dashforge.filemgr.js') }}"></script>
    <script src="{{ asset('js/sweetalert2.all.min.js?v=1.0') }}"></script>
    <script src="{{ asset('js/axios.min.js') }}"></script>
    <script src="{{ asset('js/vue.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>

    @yield('js')

    <!-- append theme customizer -->
    <script src="{{ asset('theme/lib/js-cookie/js.cookie.js') }}"></script>
    {{-- <script src="{{ asset('theme/assets/js/dashforge.settings.js') }}"></script> --}}
    <script>
        $(function(){
            'use script'

            const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
            const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))

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
