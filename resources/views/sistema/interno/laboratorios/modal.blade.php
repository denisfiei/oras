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
                                <label class="form-label mb-0" for="pais">PAIS <span class="obligatorio">(*)</span></label>
                                <div class="dropdown_select_content"> 
                                    <button class="form_select" type="button" data-bs-toggle="dropdown" aria-expanded="false" :class="[errors.pais ? 'border-error' : '']">@{{lab.pais_text}}</button>
                                    <div class="dropdown-menu w-100">
                                        <li v-for="pais in paises">
                                            <a class="dropdown-item" href="#" :class="[lab.pais == pais.id ? 'active' : '']" @click="SelectPais(pais)"><img :src="'storage/paises/'+pais.bandera" class="codigo_tel"> @{{pais.nombre}}</a>
                                        </li>
                                    </div>
                                </div>
                                <div class="input-error" v-if="errors.pais">@{{ errors.pais[0] }}</div>
                            </div>
                            <div class="form-group col-md-12 mb-3">
                                <label class="form-label mb-0" for="codigo">CÓDIGO </label>
                                <input type="text" id="codigo" v-model="lab.codigo" class="form-control" :class="[errors.codigo ? 'border-error' : '']">
                                <div class="input-error" v-if="errors.codigo">@{{ errors.codigo[0] }}</div>
                            </div>
                            <div class="form-group col-md-12 mb-3">
                                <label class="form-label mb-0" for="nombre">NOMBRE <span class="obligatorio">(*)</span></label>
                                <input type="text" id="nombre" v-model="lab.nombre" class="form-control" :class="[errors.nombre ? 'border-error' : '']">
                                <div class="input-error" v-if="errors.nombre">@{{ errors.nombre[0] }}</div>
                            </div>
                            <div class="form-group col-md-12 mb-3">
                                <label class="form-label mb-0" for="email">EMAIL </label>
                                <input type="email" id="email" v-model="lab.email" class="form-control" :class="[errors.email ? 'border-error' : '']">
                                <div class="input-error" v-if="errors.email">@{{ errors.email[0] }}</div>
                            </div>
                            <div class="form-group col-md-12 mb-3">
                                <label class="form-label mb-0" for="direccion">DIRECCIÓN </label>
                                <input type="text" id="direccion" v-model="lab.direccion" class="form-control" :class="[errors.direccion ? 'border-error' : '']">
                                <div class="input-error" v-if="errors.direccion">@{{ errors.direccion[0] }}</div>
                            </div>
                            <div class="form-group col-md-12 mb-3">
                                <label class="form-label mb-0" for="telefono">TELÉFONO CELULAR <span class="obligatorio">(*)</span></label>
                                <div class="input-group">
                                    <div class="dropdown_select_content">
                                        <button class="form_select" type="button" data-bs-toggle="dropdown" aria-expanded="false">@{{lab.codigo_telefono}}</button>
                                        <div class="dropdown-menu">
                                            <li v-for="pais in paises">
                                                <a class="dropdown-item" href="#" @click="lab.codigo_telefono = pais.codigo_tel" :class="[lab.codigo_telefono == pais.codigo_tel ? 'active' : '']" style="white-space: nowrap;"><span class="text_codigo_tel">@{{pais.codigo_tel}}</span> <img :src="'storage/paises/'+pais.bandera" class="codigo_tel"> @{{pais.nombre}}</a>
                                            </li>
                                        </div>
                                    </div>
                                    <input type="text" id="telefono" v-model="lab.telefono" class="form-control text_numeric" :class="[errors.telefono ? 'border-error' : '']" maxlength="9">
                                </div>
                                <div class="input-error" v-if="errors.telefono">@{{ errors.telefono[0] }}</div>
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
                    <h4 class="text-center mb-4">@{{modal.title}}</h4>
                    <p class="text-center mb-4">
                        ¿ Realmente desea eliminar el laboratorio: <br>
                        <strong> @{{lab.nombre}}</strong> ?
                    </p>

                    <div class="text-center mt-2 pt-50">
                        <button class="btn btn-danger" @click="Delete('delete')" style="width: 300px;"><i class="far fa-trash-alt"></i> Eliminar</button>
                    </div>
                </div>
            </div>
        </div>
        {{-- DELETE --}}
    </div>
</div>
<!-- MODAL -->