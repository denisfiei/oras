@extends('layouts.horizontal')

@section('content')

@include('layouts.header_v', [
    'title_include' => $banner ? $banner->titulo : 'SECUENCIACIÓN GENÓMICA',
    'subtitle_include' => $banner ? $banner->descripcion : '', 
    'image' => $banner ? 'storage/recursos/'.$banner->imagen : 'images/banner_2.webp'
])

<main class="m-0" >
    <div class="last_banner" style="background-image: url({{asset('images/colombia-fondo.jpg')}});background-repeat: no-repeat, repeat;
    background-size: cover;">
        <div style="background-color: #32afc9d1; height: 100%;">
            <div class="ms-5 me-5">
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-sm-12 pt-3 pb-3">
                        <div class="secuencia">
                            @php
                                $img_mapa = 'images/colombia-mapa.png';
                                if ($mapa) {
                                    $img_mapa = 'storage/recursos/'.$mapa->imagen;
                                }
                            @endphp
                            <img class="img_sec_pais" src="{{asset($img_mapa)}}" alt="{{$pais->nombre}}" 
                            style="shape-outside: url({{asset($img_mapa)}}); shape-image-threshold: 0.5; shape-margin: 20px; float: left; shape-margin: 2em;">
                            
                            <p class="text-center title_pais pb-3"><span class="bg">{{$pais->nombre}}</span></p>
                            <p class="subtitle_pais">
                                <span class="md">Genomas completos</span><br>
                                <span class="sm">
                                    secuenciados 
                                    <sub class="lg">25830</sub>
                                </span>
                            </p>
                            <p class="subtitle_pais">
                                <span class="md">Linajes</span><br>
                                <span class="sm">
                                    identificados</span>
                                    <span class="lg">310</span>
                                </span>
                            </p>

                            <p class="float-end">
                                <a href="#" class="btn_sec_pais">
                                    @php
                                        $img_inst = 'images/logos/logo_ins_col.png';
                                        if ($instituto) {
                                            $img_inst = 'storage/recursos/'.$instituto->imagen;
                                        }
                                    @endphp
                                    <span class="btn_sec_img">
                                        <img class="img_lab_pais" src="{{asset($img_inst)}}" alt="logo_pais">
                                    </span>
                                    Consulte más estadísticas
                                </a>
                            </p>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                        <div class="secuencia_iframe mt-5">
                            <div class="content_iframe">
                                @if ($video)
                                    {!! $video->descripcion !!}
                                @else
                                    <iframe width="560" src="https://www.youtube.com/embed/bDEDx8J10Wo" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                                @endif
                            </div>
                        </div>
                        <div class="text_iframe">{{$video ? $video->titulo : 'Resultado de Secuenciación'}}</div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 mt-4">
                        <h5><span class="tema_interes">Temas de Interés</span></h5>
                        <div data-label="Example" class="df-example">
                            <div id="carouselExample2" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    @if (count($temas) > 0)
                                        @foreach ($temas as $tema)
                                        <div class="carousel-item active">
                                            <img src="{{asset('storage/recursos/'.$tema->imagen)}}" alt="img1" style="height: 200px; width: 100%;">
                                            <h5 class="tittle_interes">
                                                <a href="{{$tema->enlace}}" target="_blank" class="btn_interes">{{$tema->titulo}}</a>
                                            </h5>
                                            <p class="text_interes" style="white-space: pre-line;">{{$tema->descripcion}}</p>
                                        </div>
                                        @endforeach

                                        @if (count($temas) > 1)
                                            <a class="carousel-control-prev" href="#carouselExample2" role="button" data-bs-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"><i data-feather="chevron-left"></i></span>
                                                <span class="sr-only">Previous</span>
                                            </a>
                                            <a class="carousel-control-next" href="#carouselExample2" role="button" data-bs-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"><i data-feather="chevron-right"></i></span>
                                                <span class="sr-only">Next</span>
                                            </a>
                                        @endif
                                    @else
                                        <div class="carousel-item active">
                                            <img src="{{asset('images/lateral.jpg')}}" alt="img1" style="height: 200px; width: 100%;">
                                            <h5 class="tittle_interes">Programa Nacional de Laboratorios de Vigilancia Genómica</h5>
                                            <p class="text_interes">Esta constituida por 22 Laboratorios, donde se incluye universidades, 
                                                centros de investigación y laboratorios de Salud públicos y privados</p>
                                        </div>
                                    @endif
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