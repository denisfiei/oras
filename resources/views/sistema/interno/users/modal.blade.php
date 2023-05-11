<!-- MODAL -->
<div class="modal fade" id="formularioModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" :class="modal.size">

        {{-- CREATE --}}
        <div class="modal-content" v-show="(modal.method == 'create') || (modal.method == 'edit')" id="create">
            <div class="modal-body pd-20 pd-sm-40">
                <a href="#" role="button" class="close pos-absolute t-15 r-15" @click="CloseModal">
                    <span aria-hidden="true">&times;</span>
                </a>

                <div>
                    <h4 class="text-center mb-1">@{{modal.title}}</h4>
                    {{-- <p class="tx-color-03">It's free to signup and only takes a minute.</p> --}}
                    <div class="obligatorio text-end mb-4 mt-3" style="max-height: 15px;">
                        (*)<small style="vertical-align: top;"> Obligatorio</small>
                    </div>

                    <div data-label="DATOS GENERALES" class="df-example demo-forms">
                        <div class="row">
                            <div class="form-group col-md-12 mb-3">
                                <label class="form-label mb-0" for="nombres">NOMBRES <span class="obligatorio">(*)</span></label>
                                <input type="text" id="nombres" v-model="user.nombres" class="form-control" :class="[errors.nombres ? 'border-error' : '']">
                                <div class="input-error" v-if="errors.nombres">@{{ errors.nombres[0] }}</div>
                            </div>
                            <div class="form-group col-md-12 mb-3">
                                <label class="form-label mb-0" for="telefono">TELÉFONO CELULAR <span class="obligatorio">(*)</span></label>
                                <div class="input-group">
                                    <div class="dropdown_select_content">
                                        <button class="form_select" type="button" data-bs-toggle="dropdown" aria-expanded="false">@{{user.codigo}}</button>
                                        <div class="dropdown-menu w-100">
                                            <li v-for="pais in paises">
                                                <a class="dropdown-item" href="#" @click="user.codigo = pais.codigo_tel" :class="[user.codigo == pais.codigo_tel ? 'active' : '']" style="white-space: nowrap;"><span class="text_codigo_tel">@{{pais.codigo_tel}}</span> <img :src="'storage/paises/'+pais.bandera" class="codigo_tel"> @{{pais.nombre}}</a>
                                            </li>
                                        </div>
                                    </div>
                                    <input type="text" id="telefono" v-model="user.telefono" class="form-control text_numeric" :class="[errors.telefono ? 'border-error' : '']" maxlength="9">
                                </div>
                                <div class="input-error" v-if="errors.telefono">@{{ errors.telefono[0] }}</div>
                            </div>
                            <div class="form-group col-md-12 mb-3">
                                <label class="form-label mb-0" for="perfil">PERFIL / ROL <span class="obligatorio">(*)</span></label>
                                <div class="dropdown_select_content"> 
                                    <button class="form_select" type="button" data-bs-toggle="dropdown" aria-expanded="false" :class="[errors.perfil ? 'border-error' : '']">@{{user.perfil_text}}</button>
                                    <div class="dropdown-menu w-100">
                                        <li v-for="rol in roles">
                                            <a class="dropdown-item" href="#" :class="[user.perfil == rol.id ? 'active' : '']" @click="SelectRol(rol)">@{{rol.nombre}}</a>
                                        </li>
                                    </div>
                                </div>
                                <div class="input-error" v-if="errors.perfil">@{{ errors.perfil[0] }}</div>
                            </div>
                            <div class="form-group col-md-12 mb-3">
                                <label class="form-label mb-0" for="pais">PAIS <span class="obligatorio">(*)</span></label>
                                <div class="dropdown_select_content"> 
                                    <button class="form_select" type="button" data-bs-toggle="dropdown" aria-expanded="false" :class="[errors.pais ? 'border-error' : '']">@{{user.pais_text}}</button>
                                    <div class="dropdown-menu w-100">
                                        <li v-for="pais in paises">
                                            <a class="dropdown-item" href="#" :class="[user.pais == pais.id ? 'active' : '']" @click="SelectPais(pais)"><img :src="'storage/paises/'+pais.bandera" class="codigo_tel"> @{{pais.nombre}}</a>
                                        </li>
                                    </div>
                                </div>
                                <div class="input-error" v-if="errors.pais">@{{ errors.pais[0] }}</div>
                            </div>
                            <div class="form-group col-md-12 mb-0">
                                <label class="form-label mb-0" for="laboratorio">LABORATORIO <span class="obligatorio">(*)</span></label>
                                <div class="dropdown_select_content"> 
                                    <button class="form_select" type="button" data-bs-toggle="dropdown" aria-expanded="false" :class="[errors.laboratorio ? 'border-error' : '']">@{{user.laboratorio_text}}</button>
                                    <div class="dropdown-menu w-100">
                                        <li v-for="lab in laboratorios_pais">
                                            <a class="dropdown-item" href="#" :class="[user.laboratorio == lab.id ? 'active' : '']" @click="SelectLab(lab)"><i class="fas fa-flask"></i> <span>@{{lab.nombre}}</span></a>
                                        </li>
                                    </div>
                                </div>
                                <div class="input-error" v-if="errors.laboratorio">@{{ errors.laboratorio[0] }}</div>
                            </div>
                        </div>
                    </div>

                    <div data-label="DATOS DE LA CUENTA" class="df-example demo-forms mt-4">
                        <div class="row row-sm">
                            <div class="form-group col-md-12 mb-3">
                                <label class="form-label mb-0" for="email">EMAIL <span class="obligatorio">(*)</span></label>
                                <input type="email" id="email" v-model="user.email" class="form-control" :class="[errors.email ? 'border-error' : '']">
                                <div class="input-error" v-if="errors.email">@{{ errors.email[0] }}</div>
                            </div>
                            <div class="form-group col-md-12 mb-0">
                                <label class="form-label mb-0" for="password">CONTRASEÑA <span class="obligatorio">(*)</span></label>
                                <div class="input-group form-password-toggle">
                                    <input type="password" id="password" v-model="user.password" class="form-control" :class="[errors.password ? 'border-error' : '']">
                                    <span class="input-group-text show_password cursor_pointer"><i class="far fa-eye"></i></span>
                                </div>
                                <div class="input-error" v-if="errors.password">@{{ errors.password[0] }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="d-grid mt-3">
                        <button class="btn btn-primary" @click="Store('create')" v-if="modal.method == 'create'"><i class="fas fa-save"></i>&nbsp; Guardar registro</button>
                        <button class="btn btn-secondary" @click="Update('create')" v-else><i class="fas fa-save"></i>&nbsp; Actualizar registro</button>
                    </div>
                </div>
            </div>
        </div>
        {{-- CREATE --}}

        {{-- DELETE --}}
        <div class="modal-content" v-show="modal.method == 'delete'" id="delete">
            <div class="modal-body pd-20 pd-sm-40">
                <a href="#" role="button" class="close pos-absolute t-15 r-15" @click="CloseModal">
                    <span aria-hidden="true">&times;</span>
                </a>

                <div>
                    <h4 class="text-center mb-4">BAJA DE USUARIO</h4>
                    <p class="text-center mb-4">
                        ¿ Realmente desea dar de baja al usuario: <br>
                        <strong> @{{user.nombres}}</strong> ?
                    </p>

                    <div class="text-center mt-2 pt-50">
                        <button class="btn btn-danger" @click="Delete('delete')" style="width: 300px;"><i class="far fa-trash-alt"></i> Dar de Baja</button>
                    </div>
                </div>
            </div>
        </div>
        {{-- DELETE --}}
        
        {{-- ALTA --}}
        <div class="modal-content" v-show="modal.method == 'alta'" id="alta">
            <div class="modal-body pd-20 pd-sm-40">
                <a href="#" role="button" class="close pos-absolute t-15 r-15" @click="CloseModal">
                    <span aria-hidden="true">&times;</span>
                </a>

                <div>
                    <h4 class="text-center mb-4">ALTA DE USUARIO</h4>
                    <p class="text-center mb-4">
                        ¿ Realmente desea dar de alta al usuario: <br>
                        <strong> @{{user.nombres}}</strong> ?
                    </p>

                    <div class="text-center mt-2 pt-50">
                        <button class="btn btn-success" @click="Alta('alta')" style="width: 300px;"><i class="fas fa-check-circle"></i> Dar de Alta</button>
                    </div>
                </div>
            </div>
        </div>
        {{-- ALTA --}}
    </div>
</div>
<!-- MODAL -->