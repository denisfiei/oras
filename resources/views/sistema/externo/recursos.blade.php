@extends('layouts.horizontal')

@section('css')
    <style>
        .card {
            box-shadow: 4px 6px 12px 0px rgb(219 219 219 / 0%);
        }
        .cd_btn .cd_btn_text:hover {
            color: #fff;
            text-decoration: underline;
        }
        .active .cd_btn_text{
            color: #fff;
            text-decoration: underline;
        }
        .centro_menu {
            display: flex;
            align-items: center;
            height: 350px;
        }
        .link-02:hover {
            background-color: #e7e7e7;
            color: #0000ff;
        }
    </style>
@endsection

@section('content')

@include('layouts.header_v', [
    'title_include' => $banner ? $banner->titulo : 'CENTRO DE INFORMACIÓN Y DOCUMENTACIÓN CIENTÍFICA',
    'subtitle_include' => $banner ? $banner->descripcion : '', 
    'image' => $banner ? 'storage/recursos/'.$banner->imagen : 'images/banner_2.webp'
])

<main class="m-0" >
    <div class="last_banner" style="background-image: url({{asset('images/centro-fondo.jpg')}});background-repeat: no-repeat, repeat;
    background-size: cover;">
        <div class="bg_color">
            <div class="container">
                <div class="row">
                    <div class="col-xl-4 col-lg-5 col-md-12 col-sm-4 mt-4">
                        <div class="centro_menu">
                            <ul class="centro_informacion ps-0">
                                <li class="mb-1">
                                    <a href="{{url('centro_informacion/tipo/DT')}}" class="cd_btn {{(request()->is('centro_informacion/tipo/DT/*')) ? 'active' : ''}}">
                                        <div class="cd_btn_img"><img src="{{asset('images/botones/cd_btn_2.png')}}" alt=""></div>
                                        <div class="cd_btn_text">Documentos técnicos</div>
                                    </a>
                                </li>
                                <li class="mb-1">
                                    <a href="{{url('centro_informacion/tipo/PU')}}" class="cd_btn {{(request()->is('centro_informacion/tipo/PU/*')) ? 'active' : ''}}">
                                        <div class="cd_btn_img"><img src="{{asset('images/botones/cd_btn_6.png')}}" alt=""></div>
                                        <div class="cd_btn_text">Publicaciones</div>
                                    </a>
                                </li>
                                <li class="mb-1">
                                    <a href="{{url('centro_informacion/tipo/WF')}}" class="cd_btn {{(request()->is('centro_informacion/tipo/WF/*')) ? 'active' : ''}}">
                                        <div class="cd_btn_img pt-2"><img src="{{asset('images/botones/cd_btn_3.png')}}" alt=""></div>
                                        <div class="cd_btn_text">Pepiline - workflow</div>
                                    </a>
                                </li>
                                <li class="mb-1">
                                    <a href="{{url('centro_informacion/tipo/SP')}}" class="cd_btn {{(request()->is('centro_informacion/tipo/SP/*')) ? 'active' : ''}}">
                                        <div class="cd_btn_img"><img src="{{asset('images/botones/cd_btn_4.png')}}" alt=""></div>
                                        <div class="cd_btn_text">Centro de Prensa</div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-8 col-lg-7 col-md-12 col-sm-8">
                        <h2 class="title_secuencia mb-2 mt-5">
                            <span>{{$centro->nombre.': '}}</span> 
                            
                            <button class="tx-20" type="button" data-bs-toggle="dropdown" aria-expanded="false">{{$anio_text}}</button>
                            <div class="dropdown-menu">
                                @foreach ($anios as $an)
                                    <a href="{{url('centro_informacion/tipo/'.$tipo.'/'.$an['id'])}}" class="dropdown-item {{$anio == $an['id'] ? 'active' : ''}}">{{$an['nombre']}}</a>
                                @endforeach
                            </div>
                        </h2>
                        {{-- <div class="row">
                            @foreach ($recursos as $key => $item)
                                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">
                                    <div class="">
                                        <div class="card card-file">
                                            <div class="dropdown-file">
                                                <a href="" class="dropdown-link" data-bs-toggle="dropdown"><i data-feather="more-vertical"></i></a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a href="javascript:void(0)" class="dropdown-item details" onclick="OpenDetails({{json_encode($item)}})"><i data-feather="info"></i>Ver detalles</a>
                                                    <a href="javascript:void(0)" class="dropdown-item" onclick="Download({{$item->id}})"><i data-feather="download"></i>Descargar</a>
                                                </div>
                                            </div><!-- dropdown -->
                                            <div class="card-file-thumb tx-danger">
                                                <i class="far fa-file-pdf"></i>
                                            </div>
                                            <div class="card-body">
                                                <h6><a href="javascript:void(0)" onclick="Download({{$item->id}})" class="link-02" data-bs-toggle="tooltip" data-bs-placement="top" title="Click para descargar">{{$item->nombre_archivo}}</a></h6>
                                            </div>
                                            <div class="card-footer"><span class="text_1">Publicación: {{date('d/m/Y', strtotime($item->fecha))}}</span></div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div> --}}

                        <div data-label="Example" class="df-example">
                            <ul class="list-unstyled">
                                @foreach ($recursos as $key => $item)
                                    <div class="pos-absolute pais_top">
                                        <img src="{{asset('storage/paises/'.$item->pais->bandera)}}" class="codigo_tel">
                                    </div>
                                    <li class="media d-block d-sm-flex mb-3">    
                                        <img src="{{asset('storage/recursos/'.$item->imagen)}}" class="wd-100p wd-sm-200 rounded mg-sm-r-20 mg-b-20 mg-sm-b-0" alt="">
                                        <div class="media-body">
                                            <h5 class="mb-0 text_1">{{$item->titulo}}</h5>
                                            <div class="tx-12 mb-2"><strong><i class="fas fa-calendar-alt"></i> Publicación:</strong> {{date('d/m/Y', strtotime($item->fecha))}}</div>
                                            <div class="text-justify">{{$item->descripcion}}</div>

                                            <div class="text-end">
                                                <a href="{{$item->enlace}}" target="_blank" class="btn btn-sm btn-outline-dark"><i class="fas fa-download"></i> Descargar</a>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<div class="modal fade effect-scale" id="modalViewDetails" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body pd-20 pd-sm-30">
                <button type="button" class="close pos-absolute t-15 r-20" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

                <h4 class="tx-18 tx-sm-20 mg-b-30">Detalles</h4>

                <div class="row mg-b-10">
                    <div class="col-4">Archivo:</div>
                    <div class="col-8 file_name"></div>
                </div>
                <div class="row mg-b-10">
                    <div class="col-4">Tipo de Archivo:</div>
                    <div class="col-8 file_type">PDF</div>
                </div>
                <div class="row mg-b-10">
                    <div class="col-4">Pais:</div>
                    <div class="col-8 file_pais"></div>
                </div>
                <div class="row mg-b-10">
                    <div class="col-4">Título:</div>
                    <div class="col-8 file_title"></div>
                </div>
                <div class="row mg-b-10">
                    <div class="col-4">Descripción:</div>
                    <div class="col-8 file_description"></div>
                </div>
                <div class="row mg-b-10">
                    <div class="col-4">Publicación:</div>
                    <div class="col-8 file_date"></div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary mg-sm-l-5" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
    <script>
        function OpenDetails(key) {
            let data = key;
            
            $(".file_name").html(data.nombre_archivo);
            $(".file_type").html('PDF');
            $(".file_pais").html('<img src="../../../storage/paises/'+data.pais.bandera+'" class="codigo_tel"> '+data.pais.nombre);
            $(".file_title").html(data.titulo);
            $(".file_description").html(data.descripcion);
            $(".file_date").html(Fecha(data.fecha));
            $("#modalViewDetails").modal('show');
        }

        function Download(id) {
            window.location = '../../download/'+id;
        }

        function Fecha(date) {
            if (date) {
                let fecha = date.split('-');
                return fecha[2]+'/'+fecha[1]+'/'+fecha[0];
            }
            return '';
        }
    </script>
@endsection