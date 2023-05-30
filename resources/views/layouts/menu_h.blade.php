<div class="menu_nav">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link {{(request()->is('/')) ? 'active' : ''}}" href="{{url('/')}}"><i class="fas fa-home-lg me-1"></i></a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{(request()->is('vigilancia')) ? 'active' : ''}}" href="{{route('vigilancia')}}">Vigilancia Genómica</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{(request()->is('red')) ? 'active' : ''}}" href="{{route('red')}}">Red Regional</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{(request()->is('secuenciacion')) ? 'active' : ''}}" href="{{route('secuenciacion')}}">Secuenciación</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{(request()->is('distribucion')) ? 'active' : ''}}" href="{{route('distribucion')}}">VOC. Delta Ómicron</a>
        </li>
    </ul>
</div>