@extends('layouts.vertical')

@section('content')
    
<div class="content-body" id="form_cargas">
    <div class="container pd-x-0">
        <div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
            <div>
                <h4 class="mg-b-0 tx-spacing--1"><i class="fas fa-file-upload"></i> CARGA DE DATOS</h4>
            </div>
            <div class="d-none d-md-block">
                <button class="btn btn-sm pd-x-15 btn-primary btn-uppercase mg-l-5" @click="Modal('modal-md', 'create', null, null)"><i class="fas fa-plus wd-10 mg-r-5"></i> Nuevo Carga Gisaid</button>
            </div>
        </div>
    </div>

    @include('sistema.interno.cargas.modal')

    <div class="col-lg-12 col-xl-12 mg-t-10">
        <div class="card mg-b-10">
            <div class="card-header d-flex align-items-center justify-content-between pd-r-12">
                <h6 class="mg-b-0">LISTA DE CARGA DE DATOS</h6>
                <div class="d-flex tx-16">
                    <a href="#" class="link-03 lh-0" data-bs-toggle="tooltip" title="Recargar Lista" onclick="window.location.reload();"><ion-icon name="reload-sharp"></ion-icon></a>
                    {{-- <a href="" class="link-03 lh-0 mg-l-2"><ion-icon name="ellipsis-vertical"></ion-icon></a> --}}
                </div>
            </div>
            <div class="card-body pd-y-30">
                <div class="row mb-3">
                    <div class="col-lg-8 col-md-12"></div>

                    <div class="col-lg-4 col-md-12">
                        <div class="search-form">
                            <input type="text" class="form-control" v-model="search.datos" placeholder="Buscar" @keyup.enter="Buscar">
                            <button class="btn" type="button" @click="Buscar"><i data-feather="search"></i></button>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover mg-b-0" id="my_tabla">
                        <thead class="thead-light">
                            <tr>
                                <th class="text-center" rowspan="2" width="5%">#</th>
                                <th class="text-start" rowspan="2" width="15%">País / Fecha</th>
                                <th class="text-center" rowspan="2" width="13%">Virus</th>
                                <th class="text-center p_0" colspan="3" width="25%">Gisaid</th>
                                <th class="text-center p_0" colspan="3" width="25%">Detalle</th>
                                <th class="text-center" rowspan="2" width="10%">Publicado</th>
                                <th class="text-center" rowspan="2" width="7%"><ion-icon name="ellipsis-vertical"></ion-icon></th>
                            </tr>
                            <tr>
                                <th class="text-center p_0" width="12%">Archivo</th>
                                <th class="text-center p_0" width="8%">Cantidad</th>
                                <th class="text-center p_0" width="5%">Obs.</th>
                                <th class="text-center p_0" width="12%">Archivo</th>
                                <th class="text-center p_0" width="8%">Cantidad</th>
                                <th class="text-center p_0" width="5%">Obs.</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-if="listRequest.length === 0">
                                <td class="text-center no_data" colspan="11"><i class="fas fa-exclamation-circle"></i> Sin datos encontrados </td>
                            </tr>
                            <tr class="my_vue" v-for="(data, index) in listRequest" style="display:none;">
                                <td class="text-center">@{{(index + pagination.index + 1)}}</td>
                                <td class="text-right">
                                    <div><img :src="'storage/paises/'+data.pais.bandera" v-if="data.pais.bandera" class="codigo_tel"> @{{data.pais.nombre}}</div>
                                    <div><small><i class="far fa-calendar-alt"></i> @{{FechaHora(data.created_at)}}</small></div>
                                </td>
                                <td class="text-center">@{{data.virus.nombre}}</td>

                                <td class="text-center">
                                    <a href="javascript:void(0)" class="text-success button_link text_bold" title="Ver Datos" @click="Modal('modal-fullscreen', 'rows_gisaid', data.id, data)">@{{data.archivo_gisaid}}</a>
                                </td>
                                <td class="text-center text-success text_bold">@{{data.cantidad_gisaid}}</td>
                                <td class="text-center">
                                    <a :href="'storage/'+data.log_gisaid" target="_blank" title="Ver Archivo Log"><span class="badge text-bg-danger" v-if="data.error_gisaid > 0"><i class="fas fa-exclamation-triangle"></i> @{{data.error_gisaid}}</span></a>
                                </td>

                                <td class="text-center">
                                    <a href="javascript:void(0)" class="button_link text-info text_bold"  title="Ver Datos" @click="Modal('modal-fullscreen', 'rows_detalle', data.id, data)" v-if="data.archivo_detalle">@{{data.archivo_detalle}}</a>
                                    <a href="javascript:void(0)" class="btn_opt text-info" data-bs-toggle="tooltip" title="Subir Detalle"  @click="Modal('modal-md', 'carga', data.id, data)" v-else><i class="fas fa-file-upload"></i></a>
                                </td>
                                <td class="text-center text-info text_bold">@{{data.cantidad_detalle}}</td>
                                <td class="text-center">
                                    <a :href="'storage/'+data.log_detalle" target="_blank" title="Ver Archivo Log"><span class="badge text-bg-danger" v-if="data.error_detalle > 0"><i class="fas fa-exclamation-triangle"></i> @{{data.error_detalle}}</span></a>
                                </td>
                                
                                <td class="text-center">
                                    <div class="form-switch">
                                        <input class="form-check-input" type="checkbox" role="switch" id="publicado" v-model="data.activo" true-value="P" false-value="S" style="width: 36px; height: 18px;" @change="Publicado(data.id, data.activo)">
                                    </div>
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
    <script src="{{asset('views/interno/cargas.js?v=1.0.2')}}"></script>
@endsection