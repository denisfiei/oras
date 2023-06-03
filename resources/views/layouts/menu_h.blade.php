@php
    $paises = App\Models\Pais::where('activo', 'S')->select('id', 'nombre', 'token')->get();
@endphp
<div class="menu_nav">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link {{(request()->is('/')) ? 'active' : ''}}" href="{{url('/')}}"><i class="fas fa-home-lg me-1 text_1"></i></a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{(request()->is('vigilancia')) ? 'active' : ''}}" href="{{route('vigilancia')}}">
                <img class="img_nav" src="{{asset('images/botones/menu_vigilancia.png')}}" alt="btn1">
                Vigilancia Genómica
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{(request()->is('red_regional')) ? 'active' : ''}}" href="{{route('red_regional')}}">
                <img class="img_nav" src="{{asset('images/botones/menu_red.png')}}" alt="btn1">
                Red Regional
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{(request()->is('secuenciacion/*')) ? 'active' : ''}}" href="{{route('secuenciacion')}}" data-bs-toggle="dropdown">
                <img class="img_nav" src="{{asset('images/botones/menu_secuenciacion.png')}}" alt="btn1">
                Secuenciación
            </a>
            <div class="dropdown-menu tx-13">
                <a href="{{route('secuenciacion')}}" class="dropdown-item">Todos</a>
                @foreach ($paises as $p)
                    <a href="{{url('secuenciacion/'.$p->token)}}" class="dropdown-item">{{$p->nombre}}</a>
                @endforeach
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link {{(request()->is('distribucion/*')) ? 'active' : ''}}" href="{{route('distribucion')}}" data-bs-toggle="dropdown">
                <img class="img_nav" src="{{asset('images/botones/menu_voc.png')}}" alt="btn1">
                Distribución
            </a>
            <div class="dropdown-menu tx-13">
                <a href="{{route('distribucion')}}" class="dropdown-item">Todos</a>
                @foreach ($paises as $p)
                    <a href="{{url('distribucion/'.$p->token)}}" class="dropdown-item">{{$p->nombre}}</a>
                @endforeach
            </div>
        </li>
    </ul>
</div>