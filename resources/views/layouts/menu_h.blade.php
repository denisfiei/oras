@php
    $config_cache = Cache::get('config_cache');
@endphp

<aside class="aside aside-fixed">
    <div class="aside-header">
        <a href="{{ url('/') }}" class="aside-logo">
            @if ($config_cache->logo_dark)
                <img src="{{ 'storage/'.$config_cache->logo_dark }}" alt="Logo Sistema" style="width: 170px; max-height: 45px;">
            @else
                ORAS-<span>APP</span>
            @endif
        </a>
        <a href="" class="aside-menu-link">
            <i data-feather="menu"></i>
            <i data-feather="x"></i>
        </a>
    </div>
    <div class="aside-body">
        <div class="aside-loggedin">
            <div class="d-flex align-items-center justify-content-start">
                <a href="" class="avatar"><img src="https://placehold.co/387" class="rounded-circle" alt=""></a>
                <div class="aside-alert-link">
                    {{-- <a href="" class="new" data-bs-toggle="tooltip" title="You have 2 unread messages"><i data-feather="message-square"></i></a>
                    <a href="" class="new" data-bs-toggle="tooltip" title="You have 4 new notifications"><i data-feather="bell"></i></a> --}}
                    <a href="{{ route('logout') }}" data-bs-toggle="tooltip" title="Cerrar Sesión" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();"><i class="text-danger" data-feather="log-out"></i></a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
            <div class="aside-loggedin-user">
                <a href="#loggedinMenu" class="d-flex align-items-center justify-content-between mg-b-2" data-bs-toggle="collapse">
                    <h6 class="tx-semibold text_recortar mg-b-0">{{ Auth::user()->nombres }}</h6>
                    <i data-feather="chevron-down"></i>
                </a>
                <p class="tx-color-03 tx-12 mg-b-0">
                    @switch(Auth::user()->perfil)
                        @case(1)
                            Administrador
                            @break
                        @default
                            Otros
                    @endswitch
                </p>
            </div>
            <div class="collapse" id="loggedinMenu">
                <ul class="nav nav-aside mg-b-0">
                    <li class="nav-item"><a href="" class="nav-link"><i data-feather="edit"></i> <span>Editar Perfil</span></a></li>
                    <li class="nav-item"><a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" 
                        class="nav-link text-danger"><i class="text-danger" data-feather="log-out"></i> <span>Cerrar Sesión</span></a></li>
                </ul>
            </div>
        </div>
        <ul class="nav nav-aside">
            <li class="nav-label">SISTEMA</li>
            <li class="nav-item {{(request()->is('home')) ? 'active' : ''}}"><a href="{{ url('/') }}" class="nav-link"><i data-feather="monitor"></i> <span>Inicio</span></a></li>
            {{-- <li class="nav-item"><a href="dashboard-two.html" class="nav-link"><i data-feather="globe"></i> <span>Website Analytics</span></a></li>
            <li class="nav-item"><a href="dashboard-three.html" class="nav-link"><i data-feather="pie-chart"></i> <span>Cryptocurrency</span></a></li> --}}
            <li class="nav-item {{(request()->is('users')) ? 'active' : ''}}"><a href="{{ route('users') }}" class="nav-link"><i data-feather="user"></i> <span>Usuarios</span></a></li>
            <li class="nav-item {{(request()->is('clientes')) ? 'active' : ''}}"><a href="{{ route('clientes') }}" class="nav-link"><i data-feather="users"></i> <span>Clientes</span></a></li>
            <li class="nav-item {{(request()->is('config')) ? 'active' : ''}}"><a href="{{ route('config') }}" class="nav-link"><i data-feather="settings"></i> <span>Datos de configuración</span></a></li>
            {{-- <li class="nav-item with-sub">
                <a href="" class="nav-link"><i data-feather="user"></i> <span>Usuarios</span></a>
                <ul>
                    <li><a href="page-profile-view.html">View Profile</a></li>
                    <li><a href="page-connections.html">Connections</a></li>
                    <li><a href="page-groups.html">Groups</a></li>
                    <li><a href="page-events.html">Events</a></li>
                </ul>
            </li> --}}

            <li class="nav-label mg-t-25">PÁGINA WEB</li>
            <li class="nav-item {{(request()->is('carrusel')) ? 'active' : ''}}"><a href="{{ route('carusel') }}" class="nav-link"><i data-feather="columns"></i> <span>Carrusel</span></a></li>
            <li class="nav-item {{(request()->is('avisos')) ? 'active' : ''}}"><a href="{{ route('avisos') }}" class="nav-link"><i data-feather="message-square"></i> <span>Avisos</span></a></li>
        </ul>
    </div>
</aside>