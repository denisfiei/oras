@extends('layouts.horizontal')

@section('content')
@include('layouts.menu_h')
<header class="page-header">
    <div class="banner_top">

        <div data-label="Example" class="df-example">
            <div id="carouselExample3" class="carousel slide carousel-fade banner_background" data-bs-ride="carousel">
                
                    <ol class="carousel-indicators">
                        <li data-bs-target="#carouselExample3" data-bs-slide-to="0" class="active"></li>
                        <li data-bs-target="#carouselExample3" data-bs-slide-to="1"></li>
                        <li data-bs-target="#carouselExample3" data-bs-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="banner_background" style="background-image: url({{asset('images/banner_2.webp')}});">
                                <div class="container">
                                    <div style="padding-top: 5rem;">
                                        <h2 class="banner_title">Título 1</h2>
                                        <h5 class="banner_subtitle">Subtitulo 123</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="banner_background" style="background-image: url({{asset('images/banner_2.webp')}});">
                                <div class="container">
                                    <div style="padding-top: 5rem;">
                                        <h2 class="banner_title">Título 2</h2>
                                        <h5 class="banner_subtitle">Subtitulo 123</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="banner_background" style="background-image: url({{asset('images/banner_2.webp')}});">
                                <div class="container">
                                    <div style="padding-top: 5rem;">
                                        <h2 class="banner_title">Título 3</h2>
                                        <h5 class="banner_subtitle">Subtitulo 123</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <a class="carousel-control-prev" href="#carouselExample3" role="button" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"><i data-feather="chevron-left"></i></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExample3" role="button" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"><i data-feather="chevron-right"></i></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>
</header>

<main class="m-0">
    @if ($aviso)
    <div class="modal fade" id="onload-popup" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body pd-20 pd-sm-40">
                    <a href="#" role="button" class="close pos-absolute t-15 r-15" data-bs-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </a>
                    <div class="row">
                        @if ($aviso->solo_imagen == 'N')
                            <div class="col-sm-5">
                                <div class="aviso_img">
                                    <img class="img-fluid" src="{{asset('storage/'.$aviso->imagen)}}" alt="Imagen">
                                </div>
                            </div>
                            <div class="col-sm-7">
                                <div class="popup_content">
                                    <div class="popup-text">
                                        <div class="heading_s1">
                                            <h4>{{$aviso->titulo}}</h4>
                                        </div>
                                        <p>{{$aviso->descripcion}}</p>
                                    </div>
                                    @if ($aviso->boton)
                                        <div class="mt-3">
                                            <a href="{{$aviso->link}}" class="btn btn-outline-primary btn-block text-uppercase rounded-0">{{$aviso->boton}}</a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @else
                            <div class="col-sm-12 text-center">
                                <div class="aviso_img">
                                    <img class="img-fluid" src="{{asset('storage/'.$aviso->imagen)}}" alt="Imagen">
                                </div>

                                @if ($aviso->boton)
                                    <div class="mt-3">
                                        <a href="{{$aviso->link}}" class="btn btn-outline-primary btn-block text-uppercase rounded-0">{{$aviso->boton}}</a>
                                    </div>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    <div class="stats_layout container">
        <div class="stat_col propuse custom_shadow">
            @if ($present)
                <div style="background-image: url({{asset('storage/recursos/'.$present->imagen)}}); background-repeat: no-repeat, repeat; background-size: 100%; height: 70%;">
                    <div class="image_content_lateral">
                        <div class="content_lateral_text">
                            <p style="white-space: pre-line;">{{$present->descripcion}}</p>
                        </div>
                    </div>
                </div>
            @else
                <div style="background-image: url({{asset('images/lateral.jpg')}}); background-repeat: no-repeat, repeat; background-size: 100%; height: 70%;">
                    <div class="image_content_lateral">
                        <div class="content_lateral_text">
                            <p>El proyecto “Fortalecimiento de la toma de decisiones en el control de la pandemia Covid-19 mediante la vigilancia 
                                genómica en los países de Bolivia, Colombia, Ecuador y Perú”, del Organismo Andino de Salud - Convenio Hipólito 
                                Unanue (ORAS-CONHU) con el financiamiento del Banco Interamericano de Desarrollo (BID), tiene por finalidad la 
                                implementación de un observatorio regional que permitirá generar información y nuevas evidencias en base a la 
                                vigilancia genómica, donde la identificación y detección de variantes de los patógenos, permitirá la toma decisiones 
                                oportunas en salud pública, a través de la coordinación de capacidades de los institutos de salud de los cuatro países 
                                participantes.</p>
                            <p>La información obtenida en la vigilancia genómica será de acceso y uso público.</p>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        <div class="stat_col map">
            <div style="position: relative;" class="stat_map_container">
                <img src="{{asset('images/botones/mapa3.png')}}" alt="mapa" width="503" height="400" usemap="#workmap" class="maparea" id="america" style="max-width: 100%;">
                <map name="workmap">
                    <area alt="Perú" title="INS PERÚ" href="#" class="home" onmouseover="mouseover('{{asset('images/botones/mapa_peru_2.png')}}', '{{$peru}}', 'PERÚ', '{{date('d/m/Y', strtotime($peru_fecha))}}')" onmouseleave="mouseleave('{{asset('images/botones/mapa3.png')}}', '{{$casos}}', '{{date('d/m/Y', strtotime($casos_fecha))}}')"
                    coords="19,184,19,193,27,199,34,201,39,185,50,174,61,162,68,150,72,140,84,145,92,154,100,162,111,162,118,165,122,174,117,179,107,186,97,197,90,209,91,225,102,237,107,245,123,243,120,260,130,265,136,272,143,275,150,280,148,288,145,300,146,308,143,316,138,319,126,317,115,319,101,315,89,307,79,294,69,283,62,271,53,261,46,245,34,232,25,216,16,211,11,197,13,192,22,187,29,196,120" shape="poly">
                    <area alt="Ecuador" title="INSPI ECUADOR" href="#" onmouseover="mouseover('{{asset('images/botones/mapa_ecuador_2.png')}}', '{{$ecuador}}', 'ECUADOR', '{{date('d/m/Y', strtotime($ecuador_fecha))}}')" onmouseleave="mouseleave('{{asset('images/botones/mapa3.png')}}', '{{$casos}}', '{{date('d/m/Y', strtotime($casos_fecha))}}')"
                    coords="29,188,38,191,42,178,51,168,67,163,77,145,70,131,56,131,44,125,32,121,22,131,19,143,15,151,15,167,24,163,24,172,23,179" shape="poly">
                    <area alt="Colombia" title="INS COLOMBIA" href="#" onmouseover="mouseover('{{asset('images/botones/mapa_colombia_2.png')}}', '{{$colombia}}', 'COLOMBIA', '{{date('d/m/Y', strtotime($colombia_fecha))}}')" onmouseleave="mouseleave('{{asset('images/botones/mapa3.png')}}', '{{$casos}}', '{{date('d/m/Y', strtotime($casos_fecha))}}')"
                    coords="38,116,57,129,69,129,82,136,97,148,109,149,112,159,125,157,139,156,147,164,149,143,142,124,144,106,168,106,175,95,170,67,150,56,116,47,106,26,110,0,82,5,63,29,50,48,53,72,53,94,50,107" shape="poly">
                    <area alt="Bolivia" title="INLASA BOLIVIA" href="#" onmouseover="mouseover('{{asset('images/botones/mapa_bolivia_2.png')}}', '{{$bolivia}}', 'BOLIVIA', '{{date('d/m/Y', strtotime($bolivia_fecha))}}')" onmouseleave="mouseleave('{{asset('images/botones/mapa3.png')}}', '{{$casos}}', '{{date('d/m/Y', strtotime($casos_fecha))}}')"
                    coords="149,242,170,234,186,225,190,246,201,257,236,274,249,281,250,300,261,309,273,306,280,326,277,346,257,343,228,351,226,374,205,380,187,375,171,382,156,357,153,333,146,319,152,297,150,280,156,262" shape="poly">
                </map>

                <div class="total_casos">
                    <p><span id="tc_name">REGION ANDINA</span><br>Total de casos secuenciados <br>de COVID-19 </p>
                    <h2 id="tc_number">{{$casos}}</h2>
                    <small id="tc_fecha_pais">Fecha de actualización: {{ date('d/m/Y', strtotime($casos_fecha)) }}</small>
                </div>
            </div>
        </div>
        <div class="stat_col data custom_shadow"> 
            <div class="stats_data_links">
                <h4 class="text-center">CENTRO DE INFORMACIÓN Y DOCUMENTACIÓN CIENTÍFICA</h4>
                <ul>
                    <li>
                        <a href="{{url('centro_informacion/tipo/DT')}}">
                            <i>
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none"> <g clip-path="url(#clip0_32_8)"> <path d="M12 0H6C5.175 0 4.5 0.675 4.5 1.5V13.5C4.5 14.325 5.175 15 6 15H15C15.825 15 16.5 14.325 16.5 13.5V4.5L12 0ZM15 13.5H6V1.5H11.25V5.25H15V13.5ZM3 3V16.5H15V18H3C2.175 18 1.5 17.325 1.5 16.5V3H3ZM7.5 7.5V9H13.5V7.5H7.5ZM7.5 10.5V12H11.25V10.5H7.5Z" fill="white"/> </g> <defs> <clipPath id="clip0_32_8"> <rect width="18" height="18" fill="white"/> </clipPath> </defs> </svg>
                            </i>
                            <p>Documentos técnicos</p>
                        </a>
                    </li>
                    <li>
                        <a href="{{url('centro_informacion/tipo/PU')}}">
                            <i>
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="none"> <path d="M8.25 2.75V16.5H11V2.75H8.25ZM11 4.58333L14.6667 16.5L17.4167 15.5833L13.75 3.66667L11 4.58333ZM4.58333 4.58333V16.5H7.33333V4.58333H4.58333ZM2.75 17.4167V19.25H19.25V17.4167H2.75Z" fill="white"/> </svg>
                            </i>
                            <p>Publicaciones</p>
                        </a>
                    </li>
                    <li>
                        <a href="{{url('centro_informacion/tipo/WF')}}">
                            <i>
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none"> <g clip-path="url(#clip0_32_12)"> <path d="M16.5 3C16.8978 3 17.2794 3.15804 17.5607 3.43934C17.842 3.72064 18 4.10218 18 4.5V12C18 12.3978 17.842 12.7794 17.5607 13.0607C17.2794 13.342 16.8978 13.5 16.5 13.5H4.5C4.10218 13.5 3.72064 13.342 3.43934 13.0607C3.15804 12.7794 3 12.3978 3 12V3C3 2.60218 3.15804 2.22064 3.43934 1.93934C3.72064 1.65804 4.10218 1.5 4.5 1.5H9L10.5 3H16.5ZM1.5 4.5V15H15V16.5H1.5C1.10218 16.5 0.720644 16.342 0.43934 16.0607C0.158035 15.7794 0 15.3978 0 15V4.5H1.5ZM4.5 4.5V12H16.5V4.5H4.5Z" fill="white"/> </g> <defs> <clipPath id="clip0_32_12"> <rect width="18" height="18" fill="white"/> </clipPath> </defs> </svg>
                            </i>
                            <p>Pepiline - workflow</p>
                        </a>
                    </li>
                    <li>
                        <a href="{{url('centro_informacion/tipo/SP')}}">
                            <i>
                                <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 23 23" fill="none"> <path d="M11.7875 6.98624C11.9792 6.81374 12.2092 6.70832 12.4584 6.70832C12.7171 6.70832 12.9375 6.81374 13.1388 6.98624C13.3209 7.18749 13.4167 7.41749 13.4167 7.66666C13.4167 7.92541 13.3209 8.14582 13.1388 8.34707C12.9375 8.52916 12.7171 8.62499 12.4584 8.62499C12.2092 8.62499 11.9792 8.52916 11.7875 8.34707C11.6054 8.14582 11.5 7.92541 11.5 7.66666C11.5 7.41749 11.6054 7.18749 11.7875 6.98624ZM9.39169 11.4712C9.39169 11.4712 11.4713 9.82291 12.2284 9.75582C12.9375 9.69832 12.7938 10.5129 12.7267 10.9346L12.7171 10.9921C12.5829 11.5 12.42 12.1133 12.2571 12.6979C11.8929 14.03 11.5384 15.3333 11.6246 15.5729C11.7204 15.8987 12.3146 15.4867 12.7459 15.1992C12.8034 15.1608 12.8513 15.1225 12.8992 15.0937C12.8992 15.0937 12.9759 15.0171 13.0525 15.1225C13.0717 15.1512 13.0909 15.18 13.11 15.1992C13.1963 15.3333 13.2442 15.3812 13.1292 15.4579L13.0909 15.4771C12.88 15.6208 11.9792 16.2533 11.615 16.4833C11.2221 16.7421 9.71752 17.6046 9.94752 15.9275C10.1488 14.7487 10.4171 13.7329 10.6279 12.9375C11.0209 11.5 11.1934 10.8483 10.3117 11.4137C9.9571 11.6246 9.74627 11.7587 9.62169 11.845C9.51627 11.9217 9.50669 11.9217 9.4396 11.7971L9.41085 11.7396L9.36294 11.6629C9.29585 11.5671 9.29585 11.5575 9.39169 11.4712ZM21.0834 11.5C21.0834 16.7708 16.7709 21.0833 11.5 21.0833C6.22919 21.0833 1.91669 16.7708 1.91669 11.5C1.91669 6.22916 6.22919 1.91666 11.5 1.91666C16.7709 1.91666 21.0834 6.22916 21.0834 11.5ZM19.1667 11.5C19.1667 7.26416 15.7359 3.83332 11.5 3.83332C7.26419 3.83332 3.83335 7.26416 3.83335 11.5C3.83335 15.7358 7.26419 19.1667 11.5 19.1667C15.7359 19.1667 19.1667 15.7358 19.1667 11.5Z" fill="white"/> </svg>
                            </i>
                            <p>Centro de prensa</p>
                        </a>
                    </li>
                </ul>

                {{-- <div>
                    <ul class="centro_informacion">
                        <li class="mb-1">
                            <a href="{{url('centro_informacion/tipo/DT')}}" class="cd_btn">
                                <div class="cd_btn_img"><img src="{{asset('images/botones/cd_btn_2.png')}}" alt=""></div>
                                <div class="cd_btn_text">Documentos técnicos</div>
                            </a>
                        </li>
                        <li class="mb-1">
                            <a href="{{url('centro_informacion/tipo/PU')}}" class="cd_btn">
                                <div class="cd_btn_img"><img src="{{asset('images/botones/cd_btn_6.png')}}" alt=""></div>
                                <div class="cd_btn_text">Publicaciones</div>
                            </a>
                        </li>
                        <li class="mb-1">
                            <a href="{{url('centro_informacion/tipo/WF')}}" class="cd_btn">
                                <div class="cd_btn_img pt-2"><img src="{{asset('images/botones/cd_btn_3.png')}}" alt=""></div>
                                <div class="cd_btn_text">Pipeline - workflow</div>
                            </a>
                        </li>
                        <li class="mb-1">
                            <a href="{{url('centro_informacion/tipo/SP')}}" class="cd_btn">
                                <div class="cd_btn_img"><img src="{{asset('images/botones/cd_btn_4.png')}}" alt=""></div>
                                <div class="cd_btn_text">Centro de prensa</div>
                            </a>
                        </li>
                    </ul>
                </div> --}}
            </div>
            <div class="stats_data_detail">
                <h5 class="text-center">Variantes del SARS-CoV-2 bajo supervisión por la OMS (VUMs) en circulación en la Región Andina</h5>
                <div class="px-4 pt-1 pb-3 overflow" style="max-height: 100px;">
                    <table class="table_gradient w-100">
                        @if (count($voi) > 0)
                            <tr>
                                <td colspan="2">VOI - Variantes de Interes</td>
                            </tr>
                            @foreach ($voi as $item)
                                @if (($item->voi_voc_bolivia_count > 0) || ($item->voi_voc_colombia_count > 0) || ($item->voi_voc_ecuador_count > 0) || ($item->voi_voc_peru_count > 0))
                                <tr>
                                    <td class="text-center bg_1" width="30%">{{$item->codigo}}</td>
                                    <td class="bg_3" width="70%">
                                        @if ($item->voi_voc_bolivia_count > 0)
                                            <div class="d-flex justify-content-between">
                                                <div>BOLIVIA</div>
                                                <div>{{$item->voi_voc_bolivia_count}} casos</div>
                                            </div>
                                        @endif
                                        @if ($item->voi_voc_colombia_count > 0)
                                            <div class="d-flex justify-content-between">
                                                <div>COLOMBIA</div>
                                                <div>{{$item->voi_voc_colombia_count}} casos</div>
                                            </div>
                                        @endif
                                        @if ($item->voi_voc_ecuador_count > 0)
                                            <div class="d-flex justify-content-between">
                                                <div>ECUADOR</div>
                                                <div>{{$item->voi_voc_ecuador_count}} casos</div>
                                            </div>
                                        @endif
                                        @if ($item->voi_voc_peru_count > 0)
                                            <div class="d-flex justify-content-between">
                                                <div>PERÚ</div>
                                                <div>{{$item->voi_voc_peru_count}} casos</div>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                                @endif
                            @endforeach
                        @endif
                            
                        @if (count($voc) > 0)
                            <tr>
                                <td colspan="2">VOC - Variantes de Preocupación</td>
                            </tr>
                            @foreach ($voc as $item)
                                @if (($item->voi_voc_bolivia_count > 0) || ($item->voi_voc_colombia_count > 0) || ($item->voi_voc_ecuador_count > 0) || ($item->voi_voc_peru_count > 0))
                                <tr>
                                    <td class="text-center bg_1" width="30%">{{$item->codigo}}</td>
                                    <td class="bg_3" width="70%">
                                        @if ($item->voi_voc_bolivia_count > 0)
                                            <div class="d-flex justify-content-between">
                                                <div>BOLIVIA</div>
                                                <div>{{$item->voi_voc_bolivia_count}} casos</div>
                                            </div>
                                        @endif
                                        @if ($item->voi_voc_colombia_count > 0)
                                            <div class="d-flex justify-content-between">
                                                <div>COLOMBIA</div>
                                                <div>{{$item->voi_voc_colombia_count}} casos</div>
                                            </div>
                                        @endif
                                        @if ($item->voi_voc_ecuador_count > 0)
                                            <div class="d-flex justify-content-between">
                                                <div>ECUADOR</div>
                                                <div>{{$item->voi_voc_ecuador_count}} casos</div>
                                            </div>
                                        @endif
                                        @if ($item->voi_voc_peru_count > 0)
                                            <div class="d-flex justify-content-between">
                                                <div>PERÚ</div>
                                                <div>{{$item->voi_voc_peru_count}} casos</div>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                                @endif
                            @endforeach
                        @endif

                        @if (count($vbm) > 0)
                            <tr>
                                <td colspan="2">VBM - Variantes bajo Monitoreo</td>
                            </tr>
                            @foreach ($vbm as $item)
                                @if (($item->voi_voc_bolivia_count > 0) || ($item->voi_voc_colombia_count > 0) || ($item->voi_voc_ecuador_count > 0) || ($item->voi_voc_peru_count > 0))
                                <tr>
                                    <td class="text-center bg_1" width="30%">{{$item->codigo}}</td>
                                    <td class="bg_3" width="70%">
                                        @if ($item->voi_voc_bolivia_count > 0)
                                            <div class="d-flex justify-content-between">
                                                <div>BOLIVIA</div>
                                                <div>{{$item->voi_voc_bolivia_count}} casos</div>
                                            </div>
                                        @endif
                                        @if ($item->voi_voc_colombia_count > 0)
                                            <div class="d-flex justify-content-between">
                                                <div>COLOMBIA</div>
                                                <div>{{$item->voi_voc_colombia_count}} casos</div>
                                            </div>
                                        @endif
                                        @if ($item->voi_voc_ecuador_count > 0)
                                            <div class="d-flex justify-content-between">
                                                <div>ECUADOR</div>
                                                <div>{{$item->voi_voc_ecuador_count}} casos</div>
                                            </div>
                                        @endif
                                        @if ($item->voi_voc_peru_count > 0)
                                            <div class="d-flex justify-content-between">
                                                <div>PERÚ</div>
                                                <div>{{$item->voi_voc_peru_count}} casos</div>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                                @endif
                            @endforeach
                        @endif
                    </table>
                </div>
                <div class="mt-3">
                    <a target="_blank" href="https://www.who.int/activities/tracking-SARS-CoV-2-variants" class="ps-4 button_link text-white"><i class="fas fa-link"></i> FUENTE </a>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@section('js')

    @if ($aviso)
        <script>
            $(window).on('load',function(){
                setTimeout(function() {
                    $("#onload-popup").modal('show', {}, 500);
                }, 1000);
            });
        </script>
    @endif

    <script>
        function mouseover(image, number, name, fecha) {
            document.getElementById("america").src = image;

            $("#tc_name").html(name);
            $("#tc_number").html(number);
            $("#tc_fecha_pais").html("Fecha de actualización: "+fecha);
        }
        function mouseleave(image, number, fecha) {
            document.getElementById("america").src = image;

            $("#tc_name").html("REGIÓN ANDINA");
            $("#tc_number").html(number);
            $("#tc_fecha_pais").html("Fecha de actualización: "+fecha);
        }
    </script>
@endsection