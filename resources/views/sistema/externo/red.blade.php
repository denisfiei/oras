@extends('layouts.horizontal')

@section('content')

@include('layouts.header_v', [
    'title_include' => $banner ? $banner->titulo : 'RED REGIONAL',
    'subtitle_include' => $banner ? $banner->descripcion : '', 
    'image' => $banner ? 'storage/recursos/'.$banner->imagen : 'images/banner_2.webp'
])

<main class="m-0" >
    <div class="last_banner" style="background-image: url({{asset('images/centro-fondo.jpg')}});background-repeat: no-repeat, repeat;
    background-size: cover;">
        <div style="background-color: #32afc9d1; height: 100%;">
            <div class="container">
                <div class="row">
                    @php
                        $img_red = 'images/lateral.jpg';
                        $title_red = 'Red Regional de Vigilancia Genómica';
                        if ($intro) {
                            $img_red = 'storage/recursos/'.$intro->imagen;
                            $title_red = $intro->titulo;
                        }
                    @endphp
                    <h2 class="title_secuencia mb-2 mt-5">{{$title_red}}</h2>
                    <div class="col-xl-5 col-lg-6 col-md-12 col-sm-12 mt-4">
                        <div class="img_contenedor">
                            <img src="{{asset($img_red)}}" alt="img1" class="w-100 h-100">
                        </div>
                    </div>
                    <div class="col-xl-7 col-lg-6 col-md-12 col-sm-12 mt-4">
                        @if ($intro)
                            <p class="text_secuencia" style="white-space: pre-line;">{{$intro->descripcion}}</p>
                        @else
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
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row mt-5 mb-5">
            <h2 class="text-center text_1 mb-5  lh-1">Institutos que forman parte de la<br>Red Regional</h2>
            <div class="col-12">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-12 bg_1">
                        <h3 class="text-center tx-bold mt-5"><span class="bg_4 red_title_pais">BOLIVIA</span></h3>
                        <h6 class="text-center text-white">INSTITUTO NACIONAL DE<br>LABORATORIOS DE SALUD<br>(INLASA)</h6>
                        <div class="mt-5">
                            <ul>
                                <li class="list_red mb-3">
                                    <i class="far fa-calendar-alt"></i>
                                    <span>Horario de atención<br>
                                    Lunes a viernes de 8:00 a 15:00<br>
                                    Atención de laboratorios de 8:00 a 14:00.</span>
                                </li> 
                                <li class="list_red mb-3">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span>Ubicación<br>
                                    Pasaje Rafael Zubieta #1889 <br>
                                    (Lado Hospital del Niño), Zona Miraflores.</span>
                                </li> 
                                <li class="list_red mb-3">
                                    <i class="fas fa-phone-rotary"></i>
                                    <span>Números de contacto<br>
                                    (591-2) 2226048, 2226670, 2225194, 2225198<br>
                                    Fax: (591-2) 2228254, 2225007</span>
                                </li> 
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-sm-12 bg_2">
                        <h3 class="text-center tx-bold mt-5"><span class="bg_4 red_title_pais">COLOMBIA</span></h3>
                        <h6 class="text-center text-white">INSTITUTO NACIONAL DE<br>SALUD (INS)</h6>
                        <div class="mt-5">
                            <ul>
                                <li class="list_red mb-3">
                                    <i class="far fa-calendar-alt"></i>
                                    <span>Horario de atención<br>
                                    Lunes a viernes de 8:00 a 17:00</span>
                                </li> 
                                <li class="list_red mb-3">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span>Ubicación<br>
                                    Ac. 26 #5120, Bogotá, Colombia<br>
                                </li> 
                                <li class="list_red mb-3">
                                    <i class="fas fa-phone-rotary"></i>
                                    <span>Números de contacto<br>
                                    (+57) 601 2207700</span>
                                </li> 
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 bg_4">
                        <h3 class="text-center mt-5"><span class="bg_1 red_title_pais">ECUADOR</span></h3>
                        <h6 class="text-center">INSTITUTO NACIONAL DE<br>INVESTIGACIÓN EN SALUD<br>PÚBLICA (INSPI)</h6>
                        <div class="mt-5">
                            <ul>
                                <li class="list_red mb-3">
                                    <i class="far fa-calendar-alt"></i>
                                    <span>Horario de atención<br>
                                    Lunes a viernes de 8:00 a 16:30</span>
                                </li> 
                                <li class="list_red mb-3">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span>Ubicación<br>
                                    Av. Julián Coronel 905 entre Esmeralda y José Mascote</span>
                                </li> 
                                <li class="list_red mb-3">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span>Ubicación<br>
                                    Av. Juan Tanca Marengo #100<</span>
                                </li> 
                                <li class="list_red mb-3">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span>Ubicación<br>
                                    Av. de las Américas Guayaquil - Ecuador</span>
                                </li> 
                                <li class="list_red mb-3">
                                    <i class="fas fa-phone-rotary"></i>
                                    <span>Números de contacto<br>
                                    (04) 228 8097</span>
                                </li> 
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 bg_3">
                        <h3 class="text-center mt-5"><span class="bg_1 red_title_pais">PERÚ</span></h3>
                        <h6 class="text-center">INSTITUTO NACIONAL DE<br>SALUD (INS)</h6>
                        <div class="mt-5 mb-5">
                            <ul>
                                <li class="list_red mb-3">
                                    <i class="far fa-calendar-alt"></i>
                                    <span>Horario de atención<br>
                                    Lunes a viernes de 8:00 a 16:15.</span>
                                </li> 
                                <li class="list_red mb-3">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span>Ubicación<br>
                                    Sede central: Cápac yupanqui #1400 - Jesús María, Lima 11, Perú</span>
                                </li> 
                                <li class="list_red mb-3">
                                    <i class="fas fa-phone-rotary"></i>
                                    <span>Números de contacto<br>
                                    (511) 748 1111</span>
                                </li> 
                                <li class="list_red mb-3">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span>Ubicación<br>
                                    Sede Chorrillos: Av. Defensores del Morro #2268 (Ex Huaylas) - Chorrillos, Lima 9</span>
                                </li> 
                                <li class="list_red mb-3">
                                    <i class="fas fa-phone-rotary"></i>
                                    <span>Números de contacto<br>
                                    (511) 748 0000</span>
                                </li> 
                            </ul>
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