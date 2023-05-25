@extends('layouts.horizontal')

@section('content')
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

    <div class="banner_top">
        <img src="{{asset('images/banner_1.webp')}}" alt="banner" style="width: 100%;">
        <div class="buttons_right">
            <div><a href="#" class="{{(request()->is('/')) ? 'active' : ''}} rounded"><span class="right_content"><span class="text">VIGILANCIA GENÓMICA</span> <img src="{{asset('images/botones/vigilancia.png')}}" alt="btn1"></span></a></div>
            <div><a href="#" class="{{(request()->is('red')) ? 'active' : ''}} rounded"><span class="right_content"><span class="text">RED REGIONAL DE VIGILACIA GENÓMICA</span> <img src="{{asset('images/botones/red.png')}}" alt="btn1"></span></a></div>
            <div><a href="#" class="{{(request()->is('secuenciacion')) ? 'active' : ''}} rounded"><span class="right_content"><span class="text">SECUENCIACIÓN GENÓMICA</span> <img src="{{asset('images/botones/genoma.png')}}" alt="btn1"></span></a></div>
            <div><a href="#" class="{{(request()->is('distribucion')) ? 'active' : ''}} rounded"><span class="right_content"><span class="text">DISTRIBUCIÓN DE CASOS POR LAS VOC DELTA - OMICRON</span> <img src="{{asset('images/botones/distribucion.png')}}" alt="btn1"></span></a></div>
        </div>
    </div>

    <div class="row last_banner">
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
        <div class="col-lg-8 col-sm-12">
            <div>
                <div>
                    <img src="{{asset('images/botones/mapa2.png')}}" alt="mapa" style="width: 60%;">
                    <div class="float-end"  style="width: 40%;">
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
@endsection