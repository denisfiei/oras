@extends('layouts.horizontal')

@section('content')
@include('layouts.menu_h')
@include('layouts.header_v', [
    'title_include' => $banner ? $banner->titulo : 'VIGILANCIA GENÓMICA',
    'subtitle_include' => $banner ? $banner->descripcion : '', 
    'image' => $banner ? 'storage/recursos/'.$banner->imagen : 'images/banner_2.webp'
])

<main class="m-0" >
    <div class="last_banner watcher_banner" style="background-image: url({{asset('images/colombia-fondo.jpg')}});background-repeat: no-repeat, repeat;
    background-size: cover;">
        <div class="bg_color">
            <div class="container">
                <div class="row mb-5">
                    @php
                        $img_vig = 'images/lateral.jpg';
                        $title_vig = 'Red Regional de Vigilancia Genómica';
                        if ($intro) {
                            $img_vig = 'storage/recursos/'.$intro->imagen;
                            $title_vig = $intro->titulo;
                        }
                    @endphp
                    <h2 class="mt-5" style="text-shadow: 2px 2px 2px rgba(0,0,0,0.39);">{{$title_vig}}</h2>
                    <div class="watcher_wrapper">
                        <img class="custom_shadow" src="{{asset($img_vig)}}" alt="img1" >
                        <div>
                            @if ($intro)
                                <p class="text_secuencia" style="white-space: pre-line;">{{$intro->descripcion}}</p>
                            @else
                                <p class="text_secuencia">
                                    Método de laboratorio que se usa para determinar la composición genética completa de un patógeno u organismo específico.
                                </p>
                                <p class="text_secuencia">
                                    Esta técnica permite a los científicos conocer información imprescindible del desarrollo y funcionamiento de los organismos o patógenos, confirmando su existencia y detectando los cambios en las áreas del genoma. En el caso de la COVID-19, la secuenciación genómica ha sido la puerta de acceso para conocer mejor al SARS-CoV-2, definiendo sus características y comportamiento, y así entendiendo cómo se forma la enfermedad y la forma de combatirlo (tratamiento e inmunizaciones).
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="watcher_method">
            <div class="method toAnimate custom_shadow">
                <h3>¿Que es la secuenciación genómica?</h3>
                <div class="method_text">
                    <h4>Metodología de Caracterización Genética</h4>
                    <hr class="subraya mb-3">
                    <p class="tx-16 text-justify pe-3">Método de laboratorio que se usa para determinar la composición genética completa de un patógeno u organismo específico.</p>
                    <p class="tx-16 text-justify pe-3">Esta técnica permite a los científicos conocer información imprescindible del desarrollo y funcionamiento de los organismos o patógenos, confirmando su existencia y detectando los cambios en las áreas del genoma.</p>
                    <p class="tx-16 text-justify pe-3">En el caso de la COVID-19, la secuenciación genómica ha sido la puerta de acceso para conocer mejor al SARS-CoV-2, definiendo sus características y comportamiento, y así entendiendo cómo se forma la enfermedad y la forma de combatirlo (tratamiento e inmunizaciones).</p>
                </div>
            </div>

            <div class="steps toAnimate custom_shadow">
                <h3>
                    ¿Cómo funciona la secuenciación genómica?</span>
                </h3>
                <div class="steps_wrapper">
                    <article>
                        <div>
                            <h4>1. Extracción</h4>
                            <p>En primer lugar, se extrae el material genético (ADN o ARN) del patógeno u organismo.</p>
                        </div>
                        <img src="{{asset('images/fotos/img_1.jpeg')}}" alt="img_1" style="width: 150px;" >
                    </article>
                    <article>
                        <img src="{{asset('images/fotos/img_2.jpeg')}}" alt="img_2" style="width: 150px;" >
                        <div>
                            <h4>2. Preparación de librerías genómicas</h4>
                            <p>El material genético que se va secuencias debe ser preparado antes de colocarlo en el equipo de 
                                secuenciación. Los pasos del proceso pueden variar según el tipo de muestra y del equipo específico 
                                que se utilice.</p>
                        </div>
                    </article>
                    <article>
                        <div>
                            <h4>3. Secuenciación</h4>
                            <p>La librería se carga en un secuenciador, que identificará la secuencia de nucleótidos (A-C-G-T) presentes 
                                en el material genético. El secuenciador produce datos —millones de extensas cadenas de letras— que luego 
                                se ensamblan o alinean con una secuencia de referencia de alta calidad. </p>
                        </div>
                        <img src="{{asset('images/fotos/img_3.jpeg')}}" alt="img_3" style="width: 150px;" >
                    </article>
                    <article>
                        <img src="{{asset('images/fotos/img_4.jpeg')}}" alt="img_4" style="width: 150px;" >
                        <div>
                            <h4>4. Análisis Bioinformático</h4>
                            <p>Los programas bioinformáticos ensamblan y alinean la nueva secuencia de referencia. Estos softwares permiten 
                                identificar variaciones, conocer las relaciones ancestrales (filogenia) y determinar los genes.</p>
                        </div>
                    </article>
                </div>
            </div>
        </div>

        <div class="watcher_infographograpy toAnimate ">
            <img src="{{asset('images/fotos/secuenciacion.jpg')}}" alt="img_secuenciacion" class="img-fluid">
        </div>
        
        <div class="watcher_concepts toAnimate">
            <h2>CONCEPTOS IMPORTANTES</h2>
            <div class="watcher_concepts_wrapper">
                <article class="custom_shadow">
                    <h3>Nucleótidos</h3>
                    <p class="text-justify">Estructuras o unidades que enlazadas forman las cadenas del ácido desoxirribonucleico (ADN) o ácido ribonucleico (ARN).</p>
                </article>
                <article class="custom_shadow">
                    <h3>Mutación</h3>
                    <p class="text-justify">Cambio en la secuencia genética de un organismo o tipo de célula específico. En los virus, la mutación es un evento natural dentro de su proceso evolutivo, y un conjunto de mutaciones puede definir filogenéticamente una nueva variante del virus.</p>
                </article>
                <article class="custom_shadow">
                    <h3>Variante</h3>
                    <p class="text-justify">Clasificación filogenética de un virus, que permite diferenciarlo de otras variantes circulantes. Las nuevas variantes de un virus pueden desaparecer o persistir en el tiempo.</p>
                </article>
                <article class="custom_shadow">
                    <h3>Gen</h3>
                    <p class="text-justify">Es una porción de ADN que transmite la información para producir una proteína.</p>
                </article>
            </div>
        </div>
    </div>
</main>
@endsection

@section('js')
@endsection