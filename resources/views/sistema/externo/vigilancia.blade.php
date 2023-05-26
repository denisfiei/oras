@extends('layouts.horizontal')

@section('content')
@include('layouts.header_v', ['title_include' => 'VIGILANCIA GENÓMICA', 'subtitle_include' => ''])

<main class="m-0" >
    <div class="last_banner" style="background-image: url({{asset('images/colombia-fondo.jpg')}});background-repeat: no-repeat, repeat;
    background-size: cover;">
        <div style="background-color: #32afc9d1; height: 100%;">
            <div class="ms-5 me-5">
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-sm-12 pt-3 pb-3">
                        <div class="secuencia">
                            <img class="img_sec_pais" src="{{asset('images/colombia-mapa.png')}}" alt="colombia" 
                            style="shape-outside: url({{asset('images/colombia-mapa.png')}}); shape-image-threshold: 0.5; shape-margin: 20px; float: left; shape-margin: 2em;">
                            {{-- <h2 class="mb-3">Colombia</h2> --}}
                            <p class="text-center title_pais pb-3"><span class="bg">Colombia</span></p>
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
                                    <img class="img_lab_pais" src="{{asset('images/laboratorios/lab_colombia.png')}}" alt="logo_pais">
                                    Consulte más estadísticas
                                </a>
                            </p>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                        <div class="secuencia_iframe mt-5">
                            <div class="content_iframe">
                                <iframe width="560" src="https://www.youtube.com/embed/bDEDx8J10Wo" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                            </div>
                        </div>
                        <div class="text_iframe">Resultado de Secuenciación</div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 mt-4">
                        <h5><span class="tema_interes">Temas de Interés</span></h5>
                        <div data-label="Example" class="df-example">
                            <div id="carouselExample2" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img src="{{asset('images/lateral.jpg')}}" alt="img1" style="height: 200px; width: 100%;">
                                        <h5 class="tittle_interes">Programa Nacional de Laboratorios de Vigilancia Genómica</h5>
                                        <p class="text_interes">Esta constituida por 22 Laboratorios, donde se incluye universidades, 
                                            centros de investigación y laboratorios de Salud públicos y privados</p>
                                    </div>
                                    <div class="carousel-item">
                                        <img src="{{asset('images/lateral2.jpg')}}" alt="img2" style="height: 200px; width: 100%;">
                                        <h5 class="tittle_interes">Programa Nacional de Laboratorios de Vigilancia Genómica</h5>
                                        <p class="text_interes">Esta constituida por 22 Laboratorios, donde se incluye universidades, 
                                            centros de investigación y laboratorios de Salud públicos y privados</p>
                                    </div>
                                    <div class="carousel-item">
                                        <img src="{{asset('images/lateral3.jpg')}}" alt="img3" style="height: 200px; width: 100%;">
                                        <h5 class="tittle_interes">Programa Nacional de Laboratorios de Vigilancia Genómica</h5>
                                        <p class="text_interes">Esta constituida por 22 Laboratorios, donde se incluye universidades, 
                                            centros de investigación y laboratorios de Salud públicos y privados</p>
                                    </div>
                                </div>
                                <a class="carousel-control-prev" href="#carouselExample2" role="button" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"><i data-feather="chevron-left"></i></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExample2" role="button" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"><i data-feather="chevron-right"></i></span>
                                    <span class="sr-only">Next</span>
                                </a>
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