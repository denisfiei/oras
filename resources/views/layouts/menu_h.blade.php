@php
    $config_cache = Cache::get('config_cache');
@endphp

<nav class="navbar navbar-header navbar-header-fixed">
    <a href="#" id="mainMenuOpen" class="burger-menu"><i data-feather="menu"></i></a>
    <div class="navbar-brand">
        @if ($config_cache->logo)
            <a href="{{url("/")}}" class="df-logo"><img src="{{ 'storage/'.$config_cache->logo }}" alt="Logo" style="max-width: 170px; max-height: 45px;"></a>
        @else
            <a href="{{url("/")}}" class="df-logo">ORAS-<span>APP</span></a>
        @endif
        <span class="logo_title">ORGANISMO ANDINO DE SALUD<br>CONVENIO HIPÓLITO UNANUE</span>
    </div>
    <div id="navbarMenu" class="navbar-menu-wrapper">
        <div class="navbar-menu-header">
            <a href="theme/index.html" class="df-logo">dash<span>forge</span></a>
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

            @if (Auth::check())
                <a href="{{route('home')}}" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hola {{Auth::user()->nombres}}, haga click para ir al Sistema"><img src="{{asset('images/auth.png')}}" alt="auth" class="img_icon"></a>
            @else
                <a href="{{route('login')}}" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Iniciar Sesión" class="{{(request()->is('login')) ? 'hide' : ''}}"><img src="{{asset('images/auth.png')}}" alt="auth" class="img_icon"></a>
            @endif
        </ul>
    </div>
    <div class="navbar-right df-logo">
        <div class="df-logo">
            <img src="{{asset('images/logos/logo_BID.png')}}" alt="BID" class="bid">
        </div>
    </div>
</nav>