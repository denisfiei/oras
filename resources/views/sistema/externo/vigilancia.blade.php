@extends('layouts.horizontal')

@section('content')

@include('layouts.header_v', [
    'title_include' => $banner ? $banner->titulo : 'VIGILANCIA GENÓMICA',
    'subtitle_include' => $banner ? $banner->descripcion : '', 
    'image' => $banner ? 'storage/recursos/'.$banner->imagen : 'images/banner_2.webp'
])

<main class="m-0" >
    <div class="last_banner" style="background-image: url({{asset('images/colombia-fondo.jpg')}});background-repeat: no-repeat, repeat;
    background-size: cover;">
        <div class="bg_color">
            <div class="container">
                <div class="row">
                    @php
                        $img_vig = 'images/lateral.jpg';
                        $title_vig = 'Red Regional de Vigilancia Genómica';
                        if ($intro) {
                            $img_vig = 'storage/recursos/'.$intro->imagen;
                            $title_vig = $intro->titulo;
                        }
                    @endphp
                    <h2 class="title_secuencia mb-2 mt-5">{{$title_vig}}</h2>
                    <div class="col-xl-5 col-lg-6 col-md-12 col-sm-12 mt-4">
                        <div class="img_contenedor">
                            <img src="{{asset($img_vig)}}" alt="img1" class="w-100 h-100">
                        </div>
                        {{-- <div data-label="Example" class="df-example">
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
                        </div> --}}
                    </div>
                    <div class="col-xl-7 col-lg-6 col-md-12 col-sm-12 mt-4">
                        @if ($intro)
                            <p class="text_secuencia" style="white-space: pre-line;">{{$intro->descripcion}}</p>
                        @else
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
                        @endif
                    </div>
                    {{-- <div class="col-xl-2 col-lg-6 col-md-6 col-sm-12 mt-4">
                        <a href="#" class="btn btn_secuencia">¿Como funciona?</a>
                        <hr>
                        <a href="#" class="btn btn_secuencia">Conceptos</a>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row mt-5 mb-5">
            <div class="col-12">
                <div class="row">
                    <div class="col-lg-6 col-md-12 col-sm-12 bg_4">
                        <h3 class="text-center bg_1 py-3">¿Que es la secuenciación genómica?</h3>
                        <h3 class="text_1 tx-bold pt-3"><strong>Metodología</strong> de Caracterización Genética</h3>
                        <hr class="subraya">
                        <div class="mt-2">
                            <p class="tx-16 text-justify pe-3">Método de laboratorio que se usa para determinar la composición genética completa de un patógeno u organismo específico.</p>
                            <p class="tx-16 text-justify pe-3">Esta técnica permite a los científicos conocer información imprescindible del desarrollo y funcionamiento de los organismos o patógenos, confirmando su existencia y detectando los cambios en las áreas del genoma.</p>
                            <p class="tx-16 text-justify pe-3">En el caso de la COVID-19, la secuenciación genómica ha sido la puerta de acceso para conocer mejor al SARS-CoV-2, definiendo sus características y comportamiento, y así entendiendo cómo se forma la enfermedad y la forma de combatirlo (tratamiento e inmunizaciones).</p>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-12 col-sm-12 bg_1">
                        <h3 class="text-center mt-5"><span class="bg_1 red_title_pais text_2">¿Cómo funciona la secuenciación genómica?</span></h3>
                        <div class="mt-5 mb-5">
                            <div style="display: flex;" class="bg_2">
                                <div class="px-3 py-2">
                                    <h5 class="text_1">1. EXTRACCIÓN</h5>
                                    <p class="lh-1 text-justify">En primer lugar, se extrae el material genético (ADN o ARN) del patógeno u organismo.</p>
                                </div>
                                <img src="{{asset('images/fotos/img_1.jpeg')}}" alt="img_1" style="width: 150px;" class="ps-3">
                            </div>
                            <div style="display: flex;" class="bg_2">
                                <img src="{{asset('images/fotos/img_2.jpeg')}}" alt="img_2" style="width: 150px;" class="pe-3">
                                <div class="px-3 py-2">
                                    <h5 class="text_1">2. PREPARACIÓN DE LIBRERÍAS GENÓMICAS</h5>
                                    <p class="lh-1 text-justify">El material genético que se va secuencias debe ser preparado antes de colocarlo en el equipo de 
                                        secuenciación. Los pasos del proceso pueden variar según el tipo de muestra y del equipo específico 
                                        que se utilice.</p>
                                </div>
                            </div>
                            <div style="display: flex;" class="bg_2">
                                <div class="px-3 py-2">
                                    <h5 class="text_1">3. SECUENCIACIÓN</h5>
                                    <p class="lh-1 text-justify">La librería se carga en un secuenciador, que identificará la secuencia de nucleótidos (A-C-G-T) presentes 
                                        en el material genético. El secuenciador produce datos —millones de extensas cadenas de letras— que luego 
                                        se ensamblan o alinean con una secuencia de referencia de alta calidad. </p>
                                </div>
                                <img src="{{asset('images/fotos/img_3.jpeg')}}" alt="img_3" style="width: 150px;" class="ps-3">
                            </div>
                            <div style="display: flex;" class="bg_2">
                                <img src="{{asset('images/fotos/img_4.jpeg')}}" alt="img_4" style="width: 150px;" class="pe-3">
                                <div class="px-3 py-2">
                                    <h5 class="text_1">4. ANÁLISIS BIOINFORMÁTICO</h5>
                                    <p class="lh-1 text-justify">Los programas bioinformáticos ensamblan y alinean la nueva secuencia de referencia. Estos softwares permiten 
                                        identificar variaciones, conocer las relaciones ancestrales (filogenia) y determinar los genes.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-5 mb-5">
            <div class="text-center">
                <img src="{{asset('images/fotos/secuenciacion.jpg')}}" alt="img_secuenciacion" class="img-fluid">
            </div>
        </div>
        
        <div class="row pt-5 pb-5">
            <h2 class="text-center text_1 mb-4">CONCEPTOS IMPORTANTES</h2>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="pb-3 bg_1"></div>
                <div class="py-3 px-3 bg_4 h-100">
                    <h3 class="text_2">Nucleótidos</h3>
                    <p class="text-justify">Estructuras o unidades que enlazadas forman las cadenas del ácido desoxirribonucleico (ADN) o ácido ribonucleico (ARN).</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="pb-3 bg_1"></div>
                <div class="py-3 px-3 bg_4 h-100">
                    <h3 class="text_2">Mutación:</h3>
                    <p class="text-justify">Cambio en la secuencia genética de un organismo o tipo de célula específico. En los virus, la mutación es un evento natural dentro de su proceso evolutivo, y un conjunto de mutaciones puede definir filogenéticamente una nueva variante del virus.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="pb-3 bg_1"></div>
                <div class="py-3 px-3 bg_4 h-100">
                    <h3 class="text_2">Variante:</h3>
                    <p class="text-justify">Clasificación filogenética de un virus, que permite diferenciarlo de otras variantes circulantes. Las nuevas variantes de un virus pueden desaparecer o persistir en el tiempo.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="pb-3 bg_1"></div>
                <div class="py-3 px-3 bg_4 h-100">
                    <h3 class="text_2">Gen:</h3>
                    <p class="text-justify">Es una porción de ADN que transmite la información para producir una proteína.</p>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@section('js')
    
@endsection