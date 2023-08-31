@extends('layouts.vertical')

@section('content')
    
<div class="content-body" id="form_users">
    <div class="container pd-x-0">
        <div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
            <div>
                <h4 class="mg-b-0 tx-spacing--1"><i class="fas fa-edit"></i> EDITAR PERFIL</h4>
            </div>
        </div>
    </div>

    <div class="col-lg-5 col-md-6 col-sm-12 mg-t-10">
        <div class="card mg-b-10" id="form_perfil">
            <div class="card-header d-flex align-items-center justify-content-between pd-r-12">
                <h6 class="mg-b-0">DATOS DE PERFIL</h6>
                <div class="d-flex tx-16">
                    <a href="#" class="link-03 lh-0" data-bs-toggle="tooltip" title="Recargar datos" onclick="window.location.reload();"><ion-icon name="reload-sharp"></ion-icon></a>
                    {{-- <a href="" class="link-03 lh-0 mg-l-2"><ion-icon name="ellipsis-vertical"></ion-icon></a> --}}
                </div>
            </div>
            <div class="card-body pd-y-30">
                <div data-label="DATOS GENERALES" class="df-example demo-forms">
                    <div class="row">
                        <div class="form-group col-md-12 mb-3">
                            <label class="form-label mb-0" for="nombres">NOMBRES <span class="obligatorio">(*)</span></label>
                            <input type="text" id="nombres" v-model="perfil.nombres" class="form-control" :class="[errors.nombres ? 'border-error' : '']">
                            <div class="input-error" v-if="errors.nombres">@{{ errors.nombres[0] }}</div>
                        </div>
                        <div class="form-group col-md-12 mb-3">
                            <label class="form-label mb-0" for="telefono">TELÉFONO CELULAR <span class="obligatorio">(*)</span></label>
                            <input type="text" id="telefono" v-model="perfil.telefono" class="form-control text_numeric" :class="[errors.telefono ? 'border-error' : '']" maxlength="9">
                            <div class="input-error" v-if="errors.telefono">@{{ errors.telefono[0] }}</div>
                        </div>
                    </div>
                </div>

                <div data-label="DATOS DE LA CUENTA" class="df-example demo-forms mt-4">
                    <div class="row row-sm">
                        <div class="form-group col-md-12 mb-3">
                            <label class="form-label mb-0" for="email">EMAIL <span class="obligatorio">(*)</span></label>
                            <input type="email" id="email" v-model="perfil.email" class="form-control" :class="[errors.email ? 'border-error' : '']">
                            <div class="input-error" v-if="errors.email">@{{ errors.email[0] }}</div>
                        </div>
                        <div class="form-group col-md-12 mb-0">
                            <label class="form-label mb-0" for="password">CONTRASEÑA <span class="obligatorio">(*)</span></label>
                            <div class="input-group form-password-toggle">
                                <input type="password" id="password" v-model="perfil.password" class="form-control" :class="[errors.password ? 'border-error' : '']">
                                <span class="input-group-text show_password cursor_pointer"><i class="far fa-eye"></i></span>
                            </div>
                            <div class="input-error" v-if="errors.password">@{{ errors.password[0] }}</div>
                        </div>
                    </div>
                </div>

                <div class="d-grid mt-3">
                    <button class="btn btn-primary" @click="Store()"><i class="fas fa-save"></i>&nbsp; Guardar registro</button>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
    <script>
        var my_perfil = {!! json_encode(Auth::user()) !!};
    </script>
    <script src="{{asset('views/interno/perfil.js?v=1.0.0')}}"></script>
@endsection