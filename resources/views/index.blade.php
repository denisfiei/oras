@extends('layouts.horizontal')

@section('content')
<div class="me-4 ms-4">
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

    <div class="row">
        <div class="col-lg-4 col-sm-12">
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
                                        <a href="#" class="button_link float-end text-white">Seguir leyendo <i class="fas fa-arrow-right"></i></a>
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
                                        <a href="#" class="button_link float-end text-white">Seguir leyendo <i class="fas fa-arrow-right"></i></a>
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
                                        <a href="#" class="button_link float-end text-white">Seguir leyendo <i class="fas fa-arrow-right"></i></a>
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
        <div class="col-lg-5 col-sm-12 ps-5">
            <img src="{{asset('images/botones/mapa2.png')}}" alt="mapa" width="503" height="400" usemap="#workmap" class="maparea">
            <map name="workmap">
                <area target="_blank" alt="Perú" title="Perú" href="" coords="11,238,9,228,5,219,10,211,17,209,15,216,21,219,27,220,35,223,42,215,47,203,54,198,63,192,72,186,76,178,81,165,87,166,94,172,103,177,110,186,126,187,137,186,137,191,135,199,132,204,125,206,107,219,99,227,98,244,95,256,102,269,106,279,116,279,122,282,135,287,143,294,160,302,159,314,157,326,156,339,155,347,155,355,155,361,153,371,149,379,135,371,115,358,99,353,82,338,75,321,62,300,56,286,43,270,40,258,28,251,19,239" shape="poly">
                <area target="_blank" alt="Ecuador" title="Ecuador" href="" coords="27,209,22,201,27,193,20,183,14,189,13,177,20,170,21,156,27,150,34,146,39,150,50,152,59,158,66,158,71,160,71,167,70,174,61,180,54,185,49,188,40,196,38,204,32,211" shape="poly">
                <area target="_blank" alt="Colombia" title="Colombia" href="" coords="40,139,47,129,54,123,56,109,53,94,53,79,55,67,65,61,70,49,79,39,89,27,99,23,110,16,105,39,106,52,115,68,124,68,137,75,147,76,152,78,163,79,170,81,169,95,169,106,169,116,169,123,160,124,149,126,143,133,139,144,141,158,147,166,148,178,138,178,126,178,116,177,108,165,91,159,76,148,69,142,58,144" shape="poly">
                <area target="_blank" alt="Bolivia" title="Bolivia" href="" coords="166,372,166,358,165,331,169,315,169,300,167,290,182,285,188,280,198,277,203,281,202,293,207,302,219,309,235,315,246,317,257,322,263,336,263,346,268,355,279,355,286,356,288,366,291,374,293,384,284,387,264,388,249,392,241,408,235,420,220,420,211,420,200,420,185,431,174,409" shape="poly">
            </map>
        </div>
        <div class="col-lg-3 col-sm-12">
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
@endsection

@section('js')
    <!-- jQuery Script -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <!-- Maphighlight Script -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/maphilight/1.4.0/jquery.maphilight.min.js"></script>
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
        $(function() {
            $('.maparea').maphilight();
        });
    </script>
@endsection