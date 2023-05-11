@extends('layouts.vertical')

@section('content')
    
<div class="content-body" id="form_users">
    <div class="container pd-x-0">
        <div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
            <div>
                {{-- <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Sales Monitoring</li>
                    </ol>
                </nav> --}}
                <h4 class="mg-b-0 tx-spacing--1"><i class="fas fa-users"></i> USUARIOS</h4>
            </div>
            <div class="d-none d-md-block">
                {{-- <button class="btn btn-sm pd-x-15 btn-white btn-uppercase"><i data-feather="mail" class="wd-10 mg-r-5"></i> Email</button>
                <button class="btn btn-sm pd-x-15 btn-white btn-uppercase mg-l-5"><i data-feather="printer" class="wd-10 mg-r-5"></i> Print</button> --}}
                <button class="btn btn-sm pd-x-15 btn-primary btn-uppercase mg-l-5" @click="Modal('modal-md', 'create', null, null)"><i class="fas fa-plus wd-10 mg-r-5"></i> Nuevo Usuario</button>
            </div>
        </div>
    </div>

    @include('sistema.interno.users.modal')

    <div class="col-lg-12 col-xl-12 mg-t-10">
        <div class="card mg-b-10">
            <div class="card-header d-flex align-items-center justify-content-between pd-r-12">
                <h6 class="mg-b-0">LISTA DE USUARIOS</h6>
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
                                <th class="text-center">#</th>
                                <th class="text-right">Nombres</th>
                                <th class="text-right">Pais</th>
                                <th class="text-center">Teléfono</th>
                                <th class="text-center">Perfil</th>
                                <th class="text-center">Estado </th>
                                <th class="text-center"><ion-icon name="ellipsis-vertical"></ion-icon></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-if="listRequest.length === 0">
                                <td class="text-center no_data" colspan="7"><i class="fas fa-exclamation-circle"></i> Sin datos encontrados </td>
                            </tr>
                            <tr class="my_vue" v-for="(data, index) in listRequest" style="display:none;">
                                <td class="text-center">@{{(index + pagination.index + 1)}}</td>
                                <td class="text-right">@{{data.nombres}}</td>
                                <td class="text-right">
                                    <img :src="'storage/paises/'+data.pais.bandera" v-if="data.pais.bandera" class="codigo_tel"> 
                                    @{{data.pais.nombre}}
                                </td>
                                <td class="text-center">@{{'('+data.codigo_tel+') '+data.telefono}}</td>
                                <td class="text-center">@{{data.rol.nombre}}</td>
                                <td class="text-center">
                                    <span class="text-success" v-if="data.activo == 'S'"><i class="fas fa-check"></i> ACTIVO</span>
                                    <span class="text-danger" v-else><i class="fas fa-times"></i> INACTIVO</span>
                                </td>
                                <td class="text-center">
                                    <template v-if="data.activo === 'S'">
                                        <a href="javascript:void(0)" class="btn_opt" data-bs-toggle="tooltip" title="Editar" @click="Modal('modal-md', 'edit', data.id, data)"><i class="text-secondary fas fa-pencil-alt"></i></a>
                                        <a href="javascript:void(0)" class="btn_opt" data-bs-toggle="tooltip" title="Dar de Baja" @click="Modal('modal-md', 'delete', data.id, data)"><i class="text-danger far fa-trash-alt"></i></a>
                                    </template>
                                    <template v-else>
                                        <a href="javascript:void(0)" class="btn_opt" data-bs-toggle="tooltip" title="Dar de Alta" @click="Modal('modal-md', 'alta', data.id, data)"><i class="text-success fas fa-check-circle"></i></a>
                                    </template>
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
    <script src="{{asset('views/interno/users.js?v=1.0.0')}}"></script>
@endsection