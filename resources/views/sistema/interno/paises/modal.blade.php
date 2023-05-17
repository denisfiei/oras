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
                                <label class="form-label mb-0" for="codigo">CÓDIGO </label>
                                <input type="text" id="codigo" v-model="pais.codigo" class="form-control" :class="[errors.codigo ? 'border-error' : '']">
                                <div class="input-error" v-if="errors.codigo">@{{ errors.codigo[0] }}</div>
                            </div>
                            <div class="form-group col-md-12 mb-3">
                                <label class="form-label mb-0" for="nombre">NOMBRE <span class="obligatorio">(*)</span></label>
                                <input type="text" id="nombre" v-model="pais.nombre" class="form-control" :class="[errors.nombre ? 'border-error' : '']">
                                <div class="input-error" v-if="errors.nombre">@{{ errors.nombre[0] }}</div>
                            </div>
                            <div class="form-group col-md-12 mb-3">
                                <label class="form-label mb-0" for="codigo_telefono">CÓDIGO DE TELÉFONO</label>
                                <input type="text" id="codigo_telefono" v-model="pais.codigo_telefono" class="form-control" :class="[errors.codigo_telefono ? 'border-error' : '']" placeholder="+51">
                                <div class="input-error" v-if="errors.codigo_telefono">@{{ errors.codigo_telefono[0] }}</div>
                            </div>

                            <div class="form-group col-md-12 mb-0">
                                <label class="form-label mb-0" for="bandera">IMAGEN DE BANDERA </label>
                                <input type="file" id="bandera" class="form-control" :class="[errors.bandera ? 'border-error' : '']" accept="image/*" @change="Bandera">
                                <div class="input-error" v-if="errors.bandera">@{{ errors.bandera[0] }}</div>
                            </div>
                            <div class="col-md-12 mt-3 mb-0">
                                <img class="img-fluid" :src="imagen_bandera" alt="Logo Sistema Oscuro" v-if="imagen_bandera"/>
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
                        ¿ Realmente desea eliminar el pais: <br>
                        <strong> @{{pais.nombre}}</strong> ?
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