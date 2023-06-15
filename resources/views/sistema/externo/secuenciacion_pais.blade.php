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
        <div class="bg_color">
            <div class="ms-5 me-5">
                <div class="row">
                    <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 py-3">
                        <div class="row secuencia">
                            @php
                                $img_mapa = 'images/colombia-mapa.png';
                                if ($mapa) {
                                    $img_mapa = 'storage/recursos/'.$mapa->imagen;
                                }
                            @endphp
                            <div class="col-lg-5 text-end">
                                <img class="img_sec_pais" src="{{asset($img_mapa)}}" alt="{{$pais->nombre}}">
                            </div>

                            <div class="col-lg-7">
                                <p class="title_pais pb-3"><span class="bg">{{$pais->nombre}}</span></p>
                                <p class="subtitle_pais pb-0">
                                    <span class="md">Genomas completos</span><br>
                                    <span class="sm">
                                        secuenciados 
                                        <sub class="lg">{{$genomas}}</sub>
                                    </span>
                                </p>
                                <div class="pb-3">
                                    <a href="https://app.powerbi.com/reportEmbed?reportId=dc6929df-bb74-4880-b591-268427197f0f&autoAuth=true&ctid=3a897b8b-2f6b-4b49-94a1-be7da333e39f" class="button_link text-white"><i class="fas fa-arrow-right"></i> Ver Dashboard</a>
                                </div>
                                <p class="subtitle_pais pb-0">
                                    <span class="md">Linajes</span><br>
                                    <span class="sm">
                                        identificados</span>
                                        <span class="lg">{{$linajes}}</span>
                                    </span>
                                </p>
                                <div class="pb-3">
                                    <a href="#" class="button_link text-white"><i class="fas fa-arrow-right"></i> Ver Dashboard</a>
                                </div>
    
                                <p class="text-center">
                                    <a href="{{$instituto->enlace}}" target="_blank" class="btn_sec_pais">
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
                    </div>

                    <div class="col-xl-3 col-lg-6 col-md-12 col-sm-12 py-5">
                        <div class="secuencia_iframe ">
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
                    <div class="col-xl-3 col-lg-6 col-md-12 col-sm-12 py-3">
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