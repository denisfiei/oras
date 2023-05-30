@extends('layouts.horizontal')

@section('content')

@include('layouts.header_v', ['title_include' => 'CENTRO DE INFORMACIÓN Y DOCUMENTACIÓN CIENTÍFICA', 'subtitle_include' => '', 'image' => 'images/banner_2.webp'])

<main class="m-0" >
    <div class="last_banner" style="background-image: url({{asset('images/centro-fondo.jpg')}});background-repeat: no-repeat, repeat;
    background-size: cover;">
        <div style="background-color: #32afc9d1; height: 100%;">
            <div class="container">
                <div class="row">
                    <h2 class="title_secuencia mb-2 mt-5">DOCUMENTOS TÉCNICOS</h2>
                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-4 mt-4">
                        <div class="text-center">
                            <div><a href="#" class="cd_btn" data-bs-toggle="tooltip" data-bs-placement="right" title="Título 1"><span class="cd_text">DT</span></a></div>
                            <div><a href="#" class="cd_btn" data-bs-toggle="tooltip" data-bs-placement="right" title="Título 1"><span class="cd_text">PU</span></a></div>
                            <div><a href="#" class="cd_btn" data-bs-toggle="tooltip" data-bs-placement="right" title="Título 1"><span class="cd_text">WF</span></a></div>
                            <div><a href="#" class="cd_btn" data-bs-toggle="tooltip" data-bs-placement="right" title="Título 1"><span class="cd_text">SP</span></a></div>
                        </div>
                    </div>
                    <div class="col-xl-9 col-lg-9 col-md-8 col-sm-8">
                        <div class="row">
                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 mt-4">
                                <div class="">
                                    <img src="{{asset('images/placehold1.jpg')}}" class="card-img-top" alt="" style="height: 180px;">
                                    <div class="">
                                        <a href="#" class="ci_anio">2023</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 mt-4">
                                <div class="">
                                    <img src="{{asset('images/placehold2.jpg')}}" class="card-img-top" alt="" style="height: 180px;">
                                    <div class="">
                                        <a href="#" class="ci_anio">2022</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 mt-4">
                                <div class="">
                                    <img src="{{asset('images/placehold3.jpg')}}" class="card-img-top" alt="" style="height: 180px;">
                                    <div class="">
                                        <a href="#" class="ci_anio">Anteriores</a>
                                    </div>
                                </div>
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