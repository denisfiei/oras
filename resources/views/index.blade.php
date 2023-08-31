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
                <div style="background-image: url({{asset('storage/recursos/'.$present->imagen)}}); background-repeat: no-repeat, repeat; background-size: 100%; height: 100%;">
                    <div class="image_content_lateral">
                        <div class="content_lateral_text">
                            <p style="white-space: pre-line;">{{$present->descripcion}}</p>
                        </div>
                    </div>
                </div>
            @else
                <div style="background-image: url({{asset('images/lateral.jpg')}}); background-repeat: no-repeat, repeat; background-size: 100%; height: 100%;">
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
                <h4 class="text-center mb-0">CENTRO DE INFORMACIÓN Y DOCUMENTACIÓN CIENTÍFICA</h4>
                <ul class="mb-0">
                    @foreach ($centros as $item)
                    <li>
                        <a href="{{url('centro_informacion/tipo/'.$item->id)}}">
                            <i class="{{$item->icono}} cen_inf"></i>
                            <p>{{$item->nombre}}</p>
                        </a>
                    </li>
                    @endforeach
                    {{-- <li>
                        <a href="{{url('centro_informacion/tipo/PU')}}">
                            <i class="fas fa-books cen_inf"></i>
                            <p>Publicaciones</p>
                        </a>
                    </li>
                    <li>
                        <a href="{{url('centro_informacion/tipo/WF')}}">
                            <i class="fal fa-folder-open cen_inf"></i>
                            <p>Pepiline - workflow</p>
                        </a>
                    </li>
                    <li>
                        <a href="{{url('centro_informacion/tipo/SP')}}">
                            <i class="far fa-exclamation-circle cen_inf"></i>
                            <p>Centro de prensa</p>
                        </a>
                    </li> --}}
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
                <h5 class="text-center mb-0">Variantes del SARS-CoV-2 bajo supervisión por la OMS (VUMs) en circulación en la Región Andina</h5>
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