@extends('layouts.vertical')

@section('css')
    <link rel="stylesheet" href="{{asset('css/dataTables.bootstrap5.min.css')}}">
    <style>
        #table_linajes_info {
            display: none;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            background-color: #ffffff !important;
            padding: 0 !important;
        }
        .sorting_asc {
            background-color: #ffffff40 !important;
        }
    </style>
@endsection

@section('content')
    
<div class="content-body" id="form_linajes">
    <div class="container pd-x-0">
        <div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
            <div>
                <h4 class="mg-b-0 tx-spacing--1"><i class="fas fa-bezier-curve"></i>LINAJES</h4>
            </div>
            <div class="d-none d-md-block">
                <button class="btn btn-sm pd-x-15 btn-primary btn-uppercase mg-l-5" @click="Modal('modal-md', 'create', null, null)"><i class="fas fa-plus wd-10 mg-r-5"></i> Nuevo Carga</button>
            </div>
        </div>
    </div>

    @include('sistema.interno.linajes.modal')

    <div class="col-lg-12 col-xl-12 mg-t-10">
        <div class="card mg-b-10">
            <div class="card-header d-flex align-items-center justify-content-between pd-r-12">
                <h6 class="mg-b-0">LISTA DE CARGA DE LINAJES</h6>
                <div class="d-flex tx-16">
                    <a href="#" class="link-03 lh-0" data-bs-toggle="tooltip" title="Recargar Lista" onclick="window.location.reload();"><ion-icon name="reload-sharp"></ion-icon></a>
                    {{-- <a href="" class="link-03 lh-0 mg-l-2"><ion-icon name="ellipsis-vertical"></ion-icon></a> --}}
                </div>
            </div>
            <div class="card-body pd-y-30">
                <div class="row mb-3">
                    <div class="col-lg-8 col-md-12">

                    </div>

                    <div class="col-lg-4 col-md-12">
                        <div class="search-form">
                            <input type="text" class="form-control" v-model="search.datos" placeholder="Buscar" @keyup.enter="Buscar">
                            <button class="btn" type="button" @click="Buscar"><i data-feather="search"></i></button>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover mg-b-0">
                        <thead class="thead-light">
                            <tr>
                                <th class="text-center" width="5%">#</th>
                                <th class="text-center" width="15%">Fecha</th>
                                <th class="text-right" width="25%">Archivo</th>
                                <th class="text-center" width="15%">Cantidad</th>
                                <th class="text-center" width="20%">Detalle</th>
                                <th class="text-center" width="10%">Estado</th>
                                <th class="text-center" width="10%"><ion-icon name="ellipsis-vertical"></ion-icon></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-if="listRequest.length === 0">
                                <td class="text-center no_data" colspan="6"><i class="fas fa-exclamation-circle"></i> Sin datos encontrados </td>
                            </tr>
                            <tr class="my_vue" v-for="(data, index) in listRequest" style="display:none;">
                                <td class="text-center">@{{(index + pagination.index + 1)}}</td>
                                <td class="text-center">@{{FechaHora(data.created_at)}}</td>
                                <td class="text-right"><i class="far fa-file-times"></i> @{{data.archivo}}</td>
                                <td class="text-center">@{{data.cantidad}}</td>
                                <td class="text-center"><a href="javascript:void(0)" class="button_link" @click="Modal('modal-lg', 'detalles', data.id, data)">Ver registros</a></td>
                                <td class="text-center">
                                    <i class="fas fa-check text-success" v-if="data.activo == 'S'"></i>
                                    <i class="fas fa-times text-danger" v-else></i>
                                </td>
                                <td class="text-center">
                                    {{-- <a href="javascript:void(0)" class="btn_opt" data-bs-toggle="tooltip" title="Editar" @click="Modal('modal-md', 'edit', data.id, data)"><i class="text-secondary fas fa-pencil-alt"></i></a> --}}
                                    <a href="javascript:void(0)" class="btn_opt" data-bs-toggle="tooltip" title="Eliminar" @click="Modal('modal-md', 'delete', data.id, data)"><i class="text-danger far fa-trash-alt"></i></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="my_vue paginate row mt-3" style="display:none;">
                    <div class="col-lg-6 col-md-12">
                        Mostrando 
                        <template v-if="to_pagination">
                            @{{to_pagination+'/'+pagination.total}} 
                        </template>
                        <template v-else>
                            @{{'0/'+pagination.total}} 
                        </template> 
                        registros
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-end mg-b-0">
                                <li class="page-item" :class="[(pagination.current_page > 1) ? '' : 'disabled']"><a class="page-link page-link-icon" title="Anterior" href="#" @click.prevent="changePage(pagination.current_page - 1)"><i data-feather="chevron-left"></i></a></li>
                                <li class="page-item active"><a class="page-link" href="#">@{{pagination.current_page}}</a></li>
                                <li class="page-item" :class="[(pagination.current_page < pagination.last_page) ? '' : 'disabled']"><a class="page-link page-link-icon" href="#" title="Siguiente" @click.prevent="changePage(pagination.current_page + 1)"><i data-feather="chevron-right"></i></a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
    <script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('js/dataTables.bootstrap5.min.js')}}"></script>
    <script src="{{asset('views/interno/linajes.js?v=1.0.2')}}"></script>
@endsection