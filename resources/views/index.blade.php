@extends('layouts.horizontal')

@section('content')
@include('layouts.header_v', ['title_include' => 'VIGILACIA GENÓMICA', 'subtitle_include' => 'EN LOS PAISE DE BOLIVIA, COLOMBIA, ECUADOR Y PERÚ'])

<main class="m-0">
    <div class="last_banner">
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
    
        <div class="w-100">
            <div class="row ms-5 me-5">
                <div class="col-lg-4 col-sm-12 mt-4">
                    <div data-label="Example" class="df-example">
                        <div id="carouselExample2" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <div style="background-image: url({{asset('images/lateral.jpg')}}); background-repeat: no-repeat, repeat; background-size: 100%;">
                                        <div class="image_content_lateral">
                                            <div class="content_lateral_text">
                                                <p>El proyecto “Fortalecimiento de la toma de decisiones en el control de la pandemia Covid-19 
                                                mediante la vigilancia genómica en los países de Bolivia, Colombia, Ecuador y Perú”, del 
                                                Organismo Andino de Salud - Convenio Hipólito Unanue (ORAS-CONHU) con el financiamiento del Banco 
                                                Interamericano de Desarrollo (BID).</p>
                                                <a href="#" class="button_link float-end text-white me-5">Seguir leyendo <i class="fas fa-arrow-right"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <div style="background-image: url({{asset('images/lateral2.jpg')}}); background-repeat: no-repeat, repeat; background-size: 100%;">
                                        <div class="image_content_lateral">
                                            <div class="content_lateral_text">
                                                <p>El proyecto “Fortalecimiento de la toma de decisiones en el control de la pandemia Covid-19 
                                                mediante la vigilancia genómica en los países de Bolivia, Colombia, Ecuador y Perú”, del 
                                                Organismo Andino de Salud - Convenio Hipólito Unanue (ORAS-CONHU) con el financiamiento del Banco 
                                                Interamericano de Desarrollo (BID).</p>
                                                <a href="#" class="button_link float-end text-white me-5">Seguir leyendo <i class="fas fa-arrow-right"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <div style="background-image: url({{asset('images/lateral3.jpg')}}); background-repeat: no-repeat, repeat; background-size: 100%;">
                                        <div class="image_content_lateral">
                                            <div class="content_lateral_text">
                                                <p>El proyecto “Fortalecimiento de la toma de decisiones en el control de la pandemia Covid-19 
                                                mediante la vigilancia genómica en los países de Bolivia, Colombia, Ecuador y Perú”, del 
                                                Organismo Andino de Salud - Convenio Hipólito Unanue (ORAS-CONHU) con el financiamiento del Banco 
                                                Interamericano de Desarrollo (BID).</p>
                                                <a href="#" class="button_link float-end text-white me-5">Seguir leyendo <i class="fas fa-arrow-right"></i></a>
                                            </div>
                                        </div>
                                    </div>
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
                <div class="col-lg-5 col-sm-12 ps-5 mt-4">
                    <img src="{{asset('images/botones/mapa2.png')}}" alt="mapa" width="503" height="400" usemap="#workmap" class="maparea" id="america">
                    <map name="workmap">
                        <area target="_blank" alt="Perú" title="Perú" href="" class="home" onmouseover="mouseover('{{asset('images/botones/mapa_peru.png')}}')" onmouseleave="mouseleave({{asset('images/botones/mapa2.png')}})"
                        coords="19,184,19,193,27,199,34,201,39,185,50,174,61,162,68,150,72,140,84,145,92,154,100,162,111,162,118,165,122,174,117,179,107,186,97,197,90,209,91,225,102,237,107,245,123,243,120,260,130,265,136,272,143,275,150,280,148,288,145,300,146,308,143,316,138,319,126,317,115,319,101,315,89,307,79,294,69,283,62,271,53,261,46,245,34,232,25,216,16,211,11,197,13,192,22,187,29,196,120" shape="poly">
                        <area target="_blank" alt="Ecuador" title="Ecuador" href="" onmouseover="mouseover('{{asset('images/botones/mapa_ecuador.png')}}')" onmouseleave="mouseleave({{asset('images/botones/mapa2.png')}})"
                        coords="29,188,38,191,42,178,51,168,67,163,77,145,70,131,56,131,44,125,32,121,22,131,19,143,15,151,15,167,24,163,24,172,23,179" shape="poly">
                        <area target="_blank" alt="Colombia" title="Colombia" href="" onmouseover="mouseover('{{asset('images/botones/mapa_colombia.png')}}')" onmouseleave="mouseleave({{asset('images/botones/mapa2.png')}})"
                        coords="38,116,57,129,69,129,82,136,97,148,109,149,112,159,125,157,139,156,147,164,149,143,142,124,144,106,168,106,175,95,170,67,150,56,116,47,106,26,110,0,82,5,63,29,50,48,53,72,53,94,50,107" shape="poly">
                        <area target="_blank" alt="Bolivia" title="Bolivia" href="" onmouseover="mouseover('{{asset('images/botones/mapa_bolivia.png')}}')" onmouseleave="mouseleave({{asset('images/botones/mapa2.png')}})"
                        coords="149,242,170,234,186,225,190,246,201,257,236,274,249,281,250,300,261,309,273,306,280,326,277,346,257,343,228,351,226,374,205,380,187,375,171,382,156,357,153,333,146,319,152,297,150,280,156,262" shape="poly">
                    </map>
                    </map>
                </div>
                <div class="col-lg-3 col-sm-12 mt-4">
                    <div class="float-end">
                        <h4 class="title_gradient">Centro de Información y Documentación Científica</h4>
                        <div class="mt-4 text-center">
                            <div class="d-grid gap-4 d-md-block mb-4">
                                <a href="#" class="cd_btn" data-bs-toggle="tooltip" data-bs-placement="top" title="Título 1"><img src="{{asset('images/botones/cd_btn_1.png')}}" alt=""></a>
                                <a href="#" class="cd_btn" data-bs-toggle="tooltip" data-bs-placement="top" title="Título 2"><img src="{{asset('images/botones/cd_btn_2.png')}}" alt=""></a>
                                <a href="#" class="cd_btn" data-bs-toggle="tooltip" data-bs-placement="top" title="Título 3"><img src="{{asset('images/botones/cd_btn_3.png')}}" alt=""></a>
                                <a href="#" class="cd_btn" data-bs-toggle="tooltip" data-bs-placement="top" title="Título 4"><img src="{{asset('images/botones/cd_btn_4.png')}}" alt=""></a>
                            </div>
                            <div class="d-grid gap-4 d-md-block mb-4">
                                <a href="#" class="cd_btn" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Título 5"><img src="{{asset('images/botones/cd_btn_5.png')}}" alt=""></a>
                                <a href="#" class="cd_btn" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Título 6"><img src="{{asset('images/botones/cd_btn_6.png')}}" alt=""></a>
                                <a href="#" class="cd_btn" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Título 7"><img src="{{asset('images/botones/cd_btn_7.png')}}" alt=""></a>
                                <a href="#" class="cd_btn" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Título 8"><img src="{{asset('images/botones/cd_btn_8.png')}}" alt=""></a>
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
        function mouseover(image) {
            document.getElementById("america").src = image;
        }
        function mouseleave(image) {
            document.getElementById("imageid").src = image;
        }
    </script>
@endsection