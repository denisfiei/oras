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
    {{-- <link href="{{ asset('theme/lib/@fortawesome/fontawesome-free/css/all.min.css') }}" rel="stylesheet"> --}}
    <link href="{{ asset('theme/lib/fontawesome-pro-master/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('theme/lib/remixicon/fonts/remixicon.css') }}" rel="stylesheet">

    <!-- DashForge CSS -->
    <link rel="stylesheet" href="{{ asset('theme/assets/css/dashforge.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/assets/css/dashforge.auth.css') }}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/sweetalert2.min.css?v=1.0') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    {{-- <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Archivo:wght@300&family=Merriweather+Sans:wght@300&display=swap" rel="stylesheet"> --}}
    <style>
        /*body {
            font-family: 'Archivo', sans-serif;
            font-family: 'Merriweather Sans', sans-serif;
        }*/
        .page-header {
            position: relative;
            background: #fff;
            padding: 4.29em 0 0 0;
            overflow: hidden;
            z-index: 1;
        }
        .logo_title {
            font-size: 13px;
            line-height: 14px;
            margin-left: 10px;
            font-weight: bold;
        }
        .image_content_lateral {
            display: flex;
            height: 370px;
            background: rgb(0,0,0);
            background: linear-gradient(180deg, rgba(0,0,0,0) 0%, rgba(0,50,96,1) 60%, rgba(0,50,96,1) 100%);
        }
        .content_lateral_text {
            display: inline-block;
            align-self: flex-end;
            padding: 10px 20px;
            color: #fff;
            text-align: justify;
            font-size: 12px;
        }
        .title_gradient {
            color: #fff;
            padding: 5px 20px;
            background: rgb(0,50,96);
            background: linear-gradient(90deg, rgba(0,50,96,0.9669117647058824) 0%, rgba(0,50,96,1) 50%, rgba(0,50,96,0.09576330532212884) 100%);
        }
        .img_sec_pais {
            width: 290px;
        }
        .img_lab_pais {
            width: 70px;
            border-radius: 50%;
        }
        .title_pais {
            font-weight: bold;
            font-size: 45px;
            text-shadow: 2px 2px 2px rgba(0,0,0,0.39);
        }
        .title_pais .bg {
            padding: 0 20px;
            background-color: #fff;
            color: #003260;
        }
        .subtitle_pais {
            color: #fff;
            font-size: 30px;
            line-height: 30px;
            text-shadow: 2px 2px 2px rgba(0,0,0,0.39);
            padding-bottom: 20px;
            float: right;
            padding-right: 35px;
        }
        .subtitle_pais .md {
            font-weight: bold;
            font-size: 35px
        }
        .subtitle_pais .lg {
            font-weight: bold;
            font-size: 45px
        }
        .cd_btn {
            display: inline-grid;
            background: #003260;
            color: #fff;
            border: 1px solid #003260;
            padding: 4px 8px;
            border-radius: 50%;
            margin: 0 2px;
        }
        .cd_btn img {
            width: 50px;
            height: 50px;
            padding: 8px;
        }
        .cd_btn:hover {
            outline: 4px solid #00b1cb;
        }
        .btn_socials {
            background: #003260;
            border-radius: 50%;
            margin: 0 2px;
            color: #fff;
            width: 24px;
            height: 24px;
            text-align: center;
            display: flex;
        }
        .btn_socials i {
            margin: auto;
        }
        .btn_socials:hover {
            outline: 2px solid #00b1cb;
            color: #00b1cb
        }
        .btn_sec_pais {
            background: rgb(0,50,96);
            background: linear-gradient(90deg, rgba(0,50,96,0) 0%, rgba(0,50,96,1) 15%, rgba(0,50,96,0) 100%);
            padding: 10px 16px 10px 0px;
            font-size: 18px;
            color: #fff;
            text-shadow: 2px 2px 2px rgba(0,0,0,0.39);
            margin-right: 35px;
        }
        .btn_sec_pais:hover {
            border: 2px solid #fff;
            border-radius: 20px;
            color: #fff;
        }
        .secuencia_iframe {
            height: 245px;
            padding: 8px;
            background-color: #fff;
        }
        .content_iframe {
            width: 100%;
            position: relative;
        }
        .content_iframe iframe {
            width: 100%;
            min-height: 230px;
            position: absolute;
            display: block;
        }
        .text_iframe {
            font-size: 18px;
            color: #fff;
            text-shadow: 2px 2px 2px rgba(0,0,0,0.39);
            text-align: center;
            margin-top: 5px;
            font-weight: bold;
        }

        @media(max-width: 1400px) and (min-width: 1250px) {
            .img_sec_pais {
                width: 250px;
            }
            .img_lab_pais {
                width: 50px;
                border-radius: 50%;
            }
            .title_pais {
                font-weight: bold;
                font-size: 40px;
                text-shadow: 2px 2px 2px rgba(0,0,0,0.39);
            }
            .subtitle_pais {
                color: #fff;
                font-size: 25px;
                line-height: 25px;
                text-shadow: 2px 2px 2px rgba(0,0,0,0.39);
                padding-bottom: 15px;
                float: right;
                padding-right: 30px;
            }
            .subtitle_pais .md {
                font-weight: bold;
                font-size: 30px
            }
            .subtitle_pais .lg {
                font-weight: bold;
                font-size: 40px
            }
            .btn_sec_pais {
                font-size: 15px;
                margin-right: 30px;
            }
        }
        @media(max-width: 1249px) and (min-width: 1050px) {
            .img_sec_pais {
                width: 230px;
            }
            .img_lab_pais {
                width: 35px;
                border-radius: 50%;
            }
            .title_pais {
                font-weight: bold;
                font-size: 30px;
                text-shadow: 2px 2px 2px rgba(0,0,0,0.39);
            }
            .subtitle_pais {
                color: #fff;
                font-size: 18px;
                line-height: 18px;
                text-shadow: 2px 2px 2px rgba(0,0,0,0.39);
                padding-bottom: 15px;
                float: right;
                padding-right: 20px;
            }
            .subtitle_pais .md {
                font-weight: bold;
                font-size: 20px
            }
            .subtitle_pais .lg {
                font-weight: bold;
                font-size: 30px
            }
            .btn_sec_pais {
                font-size: 13px;
                margin-right: 20px;
            }
        }
    </style>

    @yield('css')
</head>

<body>
    @include('layouts.menu_h')
    {{-- LOAD SUBMIT --}}
    <div class="a_load">
        <img src="{{ asset('ajax-loader-1.gif') }}" alt="Loading ...">
        <h5>PROCESANDO, ESPERE ...</h5>
    </div>
    {{-- LOAD SUBMIT --}}

    @yield('content')

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
