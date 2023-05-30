@extends('layouts.horizontal')

@section('content')

@include('layouts.header_v', ['title_include' => 'SECUENCIACIÓN GENÓMICA', 'subtitle_include' => '', 'image' => 'images/banner_2.webp'])

<main class="m-0" >
    <div class="last_banner" style="background-image: url({{asset('images/colombia-fondo.jpg')}});background-repeat: no-repeat, repeat;
    background-size: cover;">
        <div style="background-color: #32afc9d1; height: 100%;">
            <div class="container">
                <div class="row">
                    <h2 class="title_secuencia mb-2 mt-5">Secuenciación Genómica</h2>
                    <div class="col-xl-5 col-lg-12 col-md-12 col-sm-12 mt-4">
                        <div data-label="Example" class="df-example">
                            <div id="carouselExample2" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img src="{{asset('images/lateral.jpg')}}" alt="img1" style="height: 280px; width: 100%;">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="{{asset('images/lateral2.jpg')}}" alt="img2" style="height: 280px; width: 100%;">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="{{asset('images/lateral3.jpg')}}" alt="img3" style="height: 280px; width: 100%;">
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
                    <div class="col-xl-5 col-lg-6 col-md-12 col-sm-12 mt-4">
                        <p class="text_secuencia">Método de laboratorio que se usa para determinar la composición
                            genética completa de un patógeno u organismo específico.
                           </p>

                        <p class="text_secuencia"> Esta técnica permite a los científicos conocer información
                            imprescindible del desarrollo y funcionamiento de los organismos o
                            patógenos, confirmando su existencia y detectando los cambios en
                            las áreas del genoma. En el caso de la COVID-19, la secuenciación genómica ha sido la
                            puerta de acceso para conocer mejor al SARS-CoV-2, definiendo sus
                            características y comportamiento, y así entendiendo cómo se forma
                            la enfermedad y la forma de combatirlo (tratamiento e
                            inmunizaciones).</p>
                    </div>
                    <div class="col-xl-2 col-lg-6 col-md-6 col-sm-12 mt-4">
                        <a href="#" class="btn btn_secuencia">¿Como funciona?</a>
                        <hr>
                        <a href="#" class="btn btn_secuencia">Conceptos</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@section('js')
    
@endsection