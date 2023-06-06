@extends('layouts.horizontal')

@section('css')
    <style>
        .cd_btn .cd_btn_text:hover {
            color: #fff;
            text-decoration: underline;
        }
        .active .cd_btn_text{
            color: #fff;
            text-decoration: underline;
        }
        .centro_menu {
            display: flex;
            align-items: center;
            height: 350px;
        }
    </style>
@endsection

@section('content')

@include('layouts.header_v', [
    'title_include' => $banner ? $banner->titulo : 'CENTRO DE INFORMACIÓN Y DOCUMENTACIÓN CIENTÍFICA',
    'subtitle_include' => $banner ? $banner->descripcion : '', 
    'image' => $banner ? 'storage/recursos/'.$banner->imagen : 'images/banner_2.webp'
])

<main class="m-0" >
    <div class="last_banner" style="background-image: url({{asset('images/centro-fondo.jpg')}});background-repeat: no-repeat, repeat;
    background-size: cover;">
        <div class="bg_color">
            <div class="container">
                <div class="row">
                    <div class="col-xl-4 col-lg-5 col-md-12 col-sm-4 mt-4">
                        <div class="centro_menu">
                            <ul class="centro_informacion ps-0">
                                <li class="mb-1">
                                    <a href="{{url('centro_informacion/tipo/DT')}}" class="cd_btn {{(request()->is('centro_informacion/tipo/DT')) ? 'active' : ''}}">
                                        <div class="cd_btn_img"><img src="{{asset('images/botones/cd_btn_2.png')}}" alt=""></div>
                                        <div class="cd_btn_text">Documentos técnicos</div>
                                    </a>
                                </li>
                                <li class="mb-1">
                                    <a href="{{url('centro_informacion/tipo/PU')}}" class="cd_btn {{(request()->is('centro_informacion/tipo/PU')) ? 'active' : ''}}">
                                        <div class="cd_btn_img"><img src="{{asset('images/botones/cd_btn_6.png')}}" alt=""></div>
                                        <div class="cd_btn_text">Publicaciones</div>
                                    </a>
                                </li>
                                <li class="mb-1">
                                    <a href="{{url('centro_informacion/tipo/WF')}}" class="cd_btn {{(request()->is('centro_informacion/tipo/WF')) ? 'active' : ''}}">
                                        <div class="cd_btn_img pt-2"><img src="{{asset('images/botones/cd_btn_3.png')}}" alt=""></div>
                                        <div class="cd_btn_text">Pepiline - workflow</div>
                                    </a>
                                </li>
                                <li class="mb-1">
                                    <a href="{{url('centro_informacion/tipo/SP')}}" class="cd_btn {{(request()->is('centro_informacion/tipo/SP')) ? 'active' : ''}}">
                                        <div class="cd_btn_img"><img src="{{asset('images/botones/cd_btn_4.png')}}" alt=""></div>
                                        <div class="cd_btn_text">Centro de Prensa</div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-8 col-lg-7 col-md-12 col-sm-8">
                        <h2 class="title_secuencia mb-2 mt-5">{{$centro->nombre}}</h2>
                        <div class="row">
                            <div class="col-xl-4 col-lg-6 col-md-12 col-sm-12 mt-4">
                                <div class="">
                                    <img src="{{asset('images/placehold1.jpg')}}" class="card-img-top" alt="" style="height: 180px;">
                                    <div class="">
                                        <a href="{{url('centro_informacion/tipo/'.$tipo.'/'.$anios[0])}}" class="ci_anio">{{$anios[0]}}</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-6 col-md-12 col-sm-12 mt-4">
                                <div class="">
                                    <img src="{{asset('images/placehold2.jpg')}}" class="card-img-top" alt="" style="height: 180px;">
                                    <div class="">
                                        <a href="{{url('centro_informacion/tipo/'.$tipo.'/'.$anios[1])}}" class="ci_anio">{{$anios[1]}}</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-6 col-md-12 col-sm-12 mt-4">
                                <div class="">
                                    <img src="{{asset('images/placehold3.jpg')}}" class="card-img-top" alt="" style="height: 180px;">
                                    <div class="">
                                        <a href="{{url('centro_informacion/tipo/'.$tipo.'/'.$anios[2])}}" class="ci_anio">Anteriores</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@section('js')
    
@endsection