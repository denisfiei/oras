<div class="menu_nav">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link {{(request()->is('/')) ? 'active' : ''}}" href="{{url('/')}}"><i class="fas fa-home-lg me-1"></i></a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{(request()->is('vigilancia')) ? 'active' : ''}}" href="{{route('vigilancia')}}">
                <img class="img_nav" src="{{asset('images/botones/vigilancia.png')}}" alt="btn1">
                Vigilancia Genómica
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{(request()->is('red')) ? 'active' : ''}}" href="{{route('red')}}">
                <img class="img_nav" src="{{asset('images/botones/red.png')}}" alt="btn1">
                Red Regional
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{(request()->is('secuenciacion')) ? 'active' : ''}}" href="{{route('secuenciacion')}}" data-bs-toggle="dropdown">
                <img class="img_nav" src="{{asset('images/botones/genoma.png')}}" alt="btn1">
                Secuenciación
            </a>
            <div class="dropdown-menu tx-13">
                <a href="#" class="dropdown-item">TODOS</a>
                <a href="#" class="dropdown-item">BOLIVIA</a>
                <a href="#" class="dropdown-item">ECUADOR</a>
                <a href="#" class="dropdown-item">COLOMBIA</a>
                <a href="#" class="dropdown-item">PERÚ</a>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link {{(request()->is('distribucion')) ? 'active' : ''}}" href="{{route('distribucion')}}" data-bs-toggle="dropdown">
                <img class="img_nav" src="{{asset('images/botones/distribucion.png')}}" alt="btn1">
                VOC. Delta Ómicron
            </a>
            <div class="dropdown-menu tx-13">
                <a href="#" class="dropdown-item">TODOS</a>
                <a href="#" class="dropdown-item">BOLIVIA</a>
                <a href="#" class="dropdown-item">ECUADOR</a>
                <a href="#" class="dropdown-item">COLOMBIA</a>
                <a href="#" class="dropdown-item">PERÚ</a>
            </div>
        </li>
    </ul>
</div>