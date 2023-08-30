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
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css?v=1.0.1') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    {{-- <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Archivo:wght@300&family=Merriweather+Sans:wght@300&display=swap" rel="stylesheet"> --}}

    <link rel="stylesheet" type="text/css" href="{{ asset('css/responsive.css') }}">

    @yield('css')
</head>

<body>
    <nav class="navbar navbar-header my-navbar">
        <div class="nav_logo_wrapper">
            @if ($config_cache->logo)
                <a href="{{url("/")}}" class="df-logo"><img src="{{ $path.'/storage/'.$config_cache->logo }}" alt="Logo" style="max-width: 70px; max-height: 45px;"></a>
            @else
                <a href="{{url("/")}}" class="df-logo">ORAS-<span>APP</span></a>
            @endif
            <span class="logo_title">ORGANISMO ANDINO DE SALUD<br>CONVENIO HIPÓLITO UNANUE</span>
        </div>
        <div class="nav_links_icons">
            <a href="{{$config_cache->facebook}}" class="btn_socials facebook" target="_blank"><i class="fab fa-facebook-f"></i> </a>
            <a href="{{$config_cache->twitter}}" class="btn_socials twitter" target="_blank"><i class="fab fa-twitter"></i> </a>
            <a href="{{$config_cache->instagram}}" class="btn_socials instagram" target="_blank"><i class="fab fa-instagram"></i> </a>
            <a href="{{$config_cache->youtube}}" class="btn_socials youtube" target="_blank"><i class="fab fa-youtube"></i> </a>
            @if (Auth::check())
                <a href="{{route('home')}}" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hola {{Auth::user()->nombres}}, haga click para ir al Sistema" class="btn_auth">
                    {{-- <img src="{{asset('images/auth.png')}}" alt="auth" class="img_icon"> --}}
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none"> <path d="M14.6667 12V14.6666H12V12.6666H10V10.6666H8.00001L6.49334 9.15998C6.12668 9.27331 5.74001 9.33331 5.33334 9.33331C4.27248 9.33331 3.25506 8.91189 2.50492 8.16174C1.75477 7.41159 1.33334 6.39418 1.33334 5.33331C1.33334 4.27245 1.75477 3.25503 2.50492 2.50489C3.25506 1.75474 4.27248 1.33331 5.33334 1.33331C6.39421 1.33331 7.41163 1.75474 8.16177 2.50489C8.91192 3.25503 9.33334 4.27245 9.33334 5.33331C9.33334 5.73998 9.27334 6.12665 9.16001 6.49331L14.6667 12ZM4.66668 3.33331C4.31305 3.33331 3.97392 3.47379 3.72387 3.72384C3.47382 3.97389 3.33334 4.31302 3.33334 4.66665C3.33334 5.02027 3.47382 5.35941 3.72387 5.60946C3.97392 5.8595 4.31305 5.99998 4.66668 5.99998C5.0203 5.99998 5.35944 5.8595 5.60949 5.60946C5.85953 5.35941 6.00001 5.02027 6.00001 4.66665C6.00001 4.31302 5.85953 3.97389 5.60949 3.72384C5.35944 3.47379 5.0203 3.33331 4.66668 3.33331Z" fill="white"/> </svg>
                </a>
            @else
                <a href="{{route('login')}}" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Iniciar Sesión" class="{{(request()->is('login')) ? 'hide' : 'btn_auth'}}">
                    {{-- <img src="{{asset('images/auth.png')}}" alt="auth" class="img_icon"> --}}
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none"> <path d="M14.6667 12V14.6666H12V12.6666H10V10.6666H8.00001L6.49334 9.15998C6.12668 9.27331 5.74001 9.33331 5.33334 9.33331C4.27248 9.33331 3.25506 8.91189 2.50492 8.16174C1.75477 7.41159 1.33334 6.39418 1.33334 5.33331C1.33334 4.27245 1.75477 3.25503 2.50492 2.50489C3.25506 1.75474 4.27248 1.33331 5.33334 1.33331C6.39421 1.33331 7.41163 1.75474 8.16177 2.50489C8.91192 3.25503 9.33334 4.27245 9.33334 5.33331C9.33334 5.73998 9.27334 6.12665 9.16001 6.49331L14.6667 12ZM4.66668 3.33331C4.31305 3.33331 3.97392 3.47379 3.72387 3.72384C3.47382 3.97389 3.33334 4.31302 3.33334 4.66665C3.33334 5.02027 3.47382 5.35941 3.72387 5.60946C3.97392 5.8595 4.31305 5.99998 4.66668 5.99998C5.0203 5.99998 5.35944 5.8595 5.60949 5.60946C5.85953 5.35941 6.00001 5.02027 6.00001 4.66665C6.00001 4.31302 5.85953 3.97389 5.60949 3.72384C5.35944 3.47379 5.0203 3.33331 4.66668 3.33331Z" fill="white"/> </svg>
                </a>
            @endif
        </div>
        <div class="navbar-right df-logo">
            {{-- <img src="{{asset('images/logos/logo_BID.png')}}" alt="BID" class="bid"> --}}
        </div>
    </nav>
    
    {{-- LOAD SUBMIT --}}
    <div class="a_load">
        <img src="{{ asset('ajax-loader-1.gif') }}" alt="Loading ...">
        <h5>PROCESANDO, ESPERE ...</h5>
    </div>
    {{-- LOAD SUBMIT --}}

    @yield('content')

    <div class="bg_1">
        <div class="container footer_wrapper">
            <div class="contact_content custom_shadow">
                <h2 class="py-4">CONTACTO</h2>
                <div class="contact_info">
                    <ul>
                        <li>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none"> <path d="M10 9.58329C9.44749 9.58329 8.91758 9.3638 8.52688 8.9731C8.13618 8.5824 7.91669 8.05249 7.91669 7.49996C7.91669 6.94743 8.13618 6.41752 8.52688 6.02682C8.91758 5.63612 9.44749 5.41663 10 5.41663C10.5526 5.41663 11.0825 5.63612 11.4732 6.02682C11.8639 6.41752 12.0834 6.94743 12.0834 7.49996C12.0834 7.77355 12.0295 8.04446 11.9248 8.29722C11.8201 8.54998 11.6666 8.77964 11.4732 8.9731C11.2797 9.16655 11.05 9.32001 10.7973 9.42471C10.5445 9.52941 10.2736 9.58329 10 9.58329ZM10 1.66663C8.45292 1.66663 6.96919 2.28121 5.87523 3.37517C4.78127 4.46913 4.16669 5.95286 4.16669 7.49996C4.16669 11.875 10 18.3333 10 18.3333C10 18.3333 15.8334 11.875 15.8334 7.49996C15.8334 5.95286 15.2188 4.46913 14.1248 3.37517C13.0308 2.28121 11.5471 1.66663 10 1.66663Z"/> </svg>
                            <span>Av. Paseo la República N° 3832 Tercer Piso. Lima - Perú</span>
                        </li>
                        <li>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none"> <path d="M5.51667 8.99167C6.71667 11.35 8.65 13.2833 11.0083 14.4833L12.8417 12.65C13.075 12.4167 13.4 12.35 13.6917 12.4417C14.625 12.75 15.625 12.9167 16.6667 12.9167C16.8877 12.9167 17.0996 13.0045 17.2559 13.1607C17.4122 13.317 17.5 13.529 17.5 13.75V16.6667C17.5 16.8877 17.4122 17.0996 17.2559 17.2559C17.0996 17.4122 16.8877 17.5 16.6667 17.5C12.9094 17.5 9.30609 16.0074 6.64932 13.3507C3.99256 10.6939 2.5 7.09057 2.5 3.33333C2.5 3.11232 2.5878 2.90036 2.74408 2.74408C2.90036 2.5878 3.11232 2.5 3.33333 2.5H6.25C6.47101 2.5 6.68298 2.5878 6.83926 2.74408C6.99554 2.90036 7.08333 3.11232 7.08333 3.33333C7.08333 4.375 7.25 5.375 7.55833 6.30833C7.65 6.6 7.58333 6.925 7.35 7.15833L5.51667 8.99167Z"/> </svg>
                            <span>(511) 611-3700</span>
                        </li>
                        <li>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none"> <path d="M16.6667 6.66671L10 10.8334L3.33335 6.66671V5.00004L10 9.16671L16.6667 5.00004M16.6667 3.33337H3.33335C2.40835 3.33337 1.66669 4.07504 1.66669 5.00004V15C1.66669 15.4421 1.84228 15.866 2.15484 16.1786C2.4674 16.4911 2.89133 16.6667 3.33335 16.6667H16.6667C17.1087 16.6667 17.5326 16.4911 17.8452 16.1786C18.1578 15.866 18.3334 15.4421 18.3334 15V5.00004C18.3334 4.55801 18.1578 4.13409 17.8452 3.82153C17.5326 3.50897 17.1087 3.33337 16.6667 3.33337Z"/> </svg>
                            <span>contacto@conhu.org.pe</span>
                        </li>
                    </ul>
                </div>
                <div class="socials">
                    <h5>Redes Sociales</h5>
                    <div class="nav_links_icons mb-3">
                        <a href="{{$config_cache->facebook}}" class="btn_socials facebook" target="_blank"><i class="fab fa-facebook-f"></i> </a>
                        <a href="{{$config_cache->twitter}}" class="btn_socials twitter" target="_blank"><i class="fab fa-twitter"></i> </a>
                        <a href="{{$config_cache->instagram}}" class="btn_socials instagram" target="_blank"><i class="fab fa-instagram"></i> </a>
                        <a href="{{$config_cache->youtube}}" class="btn_socials youtube" target="_blank"><i class="fab fa-youtube"></i> </a>
                    </div>
                </div>
            </div>
            <div class="footer_logo">
                <h4>Accesos Rápidos</h4>
                <div>
                    <ul class="nav_footer">
                        <li><a href="{{url('/')}}">Inicio</a></li>
                        <li><a href="{{route('vigilancia')}}">Vigilancia Genómica</a></li>
                        <li><a href="{{route('red_regional')}}">Red Regional</a></li>
                        <li><a href="{{route('secuenciacion')}}">Secuenciación</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer_logo">
                <div class="footer_logo_wrapper">
                    <div class="logo_app">
                        @if ($config_cache->logo)
                            <img src="{{ $path.'/storage/'.$config_cache->logo }}" alt="Logo" style="max-width: 100px;"></a>
                        @endif
                        <span>ORGANISMO ANDINO DE SALUD<br>CONVENIO HIPÓLITO UNANUE</span>
                    </div>
                    <div class="text-center">
                        <img src="{{asset('images/logos/logo_home_white.png')}}" alt="logo_white" style="max-width: 200px">
                    </div>
                    <div class="partners_content text-center">
                        <img src="{{asset('images/logos/logo_ins_bol.png')}}" alt="Ins_Bol" style="max-height: 40px;">
                        <img src="{{asset('images/logos/logo_ins_col.png')}}" alt="Ins_Col" style="max-height: 40px;">
                        <img src="{{asset('images/logos/logo_ins_ecu.png')}}" alt="Ins_Ecu" style="max-height: 40px;">
                        <img src="{{asset('images/logos/logo_ins_per.png')}}" alt="Ins_Per" style="max-height: 40px;">
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
    
    <script src="{{ asset('theme/lib/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('theme/lib/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('theme/lib/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('theme/lib/feather-icons/feather.min.js') }}"></script>
    
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

    <script>
        const the_animation = document.querySelectorAll('.toAnimate')
        const observer = new IntersectionObserver((entries) => {
            console.log(entries)
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('fadeInDown')
                }
                // else {
                //     entry.target.classList.remove('fadeInDown')
                // }
                
            })
        },
        { threshold: 0.5
        });
        //
        for (let i = 0; i < the_animation.length; i++) {
            const elements = the_animation[i];
            observer.observe(elements);
        } 
    </script>
  </body>
</html>
