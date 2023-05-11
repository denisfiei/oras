<!-- MODAL -->
<div class="modal fade" id="formularioModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" :class="modal.size">

        {{-- CREATE --}}
        <div class="modal-content" v-if="modal.method == 'create'" id="create">
            <div class="modal-body pd-20 pd-sm-40">
                <a href="#" role="button" class="close pos-absolute t-15 r-15" @click="CloseModal">
                    <span aria-hidden="true">&times;</span>
                </a>

                <div>
                    <h4 class="text-center mb-1">NUEVO AVISO</h4>
                    <div class="obligatorio text-end mb-4 mt-3" style="max-height: 15px;">
                        (*)<small style="vertical-align: top;"> Obligatorio</small>
                    </div>

                    <div class="row">
                        <div class="col-lg-7 col-md-12 mb-3">
                            <div data-label="FORMULARIO" class="df-example demo-forms">
                                <div class="row row-sm">
                                    <div class="form-group form-group-sm col-md-12 mb-3">
                                        <label class="form-label mb-0" for="titulo">TÍTULO <span class="obligatorio">(*)</span></label>
                                        <input type="text" id="titulo" v-model="aviso.titulo" class="form-control" :class="[errors.titulo ? 'border-error' : '']">
                                        <div class="input-error" v-if="errors.titulo">@{{ errors.titulo[0] }}</div>
                                    </div>
                                    <div class="form-group form-group-sm col-md-12 mb-3">
                                        <label class="form-label mb-0" for="descripcion">DESCRIPCIÓN <span class="obligatorio">(*)</span></label>
                                        <textarea id="descripcion" v-model="aviso.descripcion" class="form-control" :class="[errors.descripcion ? 'border-error' : '']"></textarea>
                                        <div class="input-error" v-if="errors.descripcion">@{{ errors.descripcion[0] }}</div>
                                    </div>
                                    <div class="form-group form-group-sm col-md-12 mb-3">
                                        <label class="form-label mb-0" for="boton">NOMBRE DEL BOTÓN &nbsp;<i class="fas fa-exclamation-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="Si no desea el botón dejar en blanco"></i></label>
                                        <input type="text" id="boton" v-model="aviso.boton" class="form-control" :class="[errors.boton ? 'border-error' : '']" maxlength="9">
                                        <div class="input-error" v-if="errors.boton">@{{ errors.boton[0] }}</div>
                                    </div>
                                    <div class="form-group form-group-sm col-md-12 mb-3" v-if="aviso.boton">
                                        <label class="form-label mb-0" for="link">LINK </label>
                                        <input type="text" id="link" v-model="aviso.link" class="form-control" :class="[errors.link ? 'border-error' : '']">
                                        <div class="input-error" v-if="errors.link">@{{ errors.link[0] }}</div>
                                    </div>
                                    <div class="form-group form-group-sm col-md-12 mb-3">
                                        <label class="form-label mb-0" for="mostrar">MOSTRAR <span class="obligatorio">(*)</span></label>
                                        <select id="mostrar" v-model="aviso.mostrar" class="form-select" :class="[errors.mostrar ? 'border-error' : '']">
                                            <option value="S">SI</option>
                                            <option value="N">NO</option>
                                        </select>
                                        <div class="input-error" v-if="errors.mostrar">@{{ errors.mostrar[0] }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-5 col-md-12 mb-3">
                            <div data-label="IMAGEN" class="df-example demo-forms">
                                <div class="row row-sm">
                                    <div class="form-group form-group-sm col-md-12 mb-3">
                                        <label class="form-label mb-0" for="imagen">IMAGEN &nbsp; <i class="fas fa-exclamation-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="Dimención de la imagen 300x400"></i> <span class="obligatorio"> &nbsp;(*)</span></label>
                                        <input type="file" id="imagen" @change="Imagen" class="form-control" :class="[errors.imagen ? 'border-error' : '']">
                                        <div class="input-error" v-if="errors.imagen">@{{ errors.imagen[0] }}</div>
                                    </div>
                                    <div class="col-12">
                                        <img class="img-fluid" :src="img" alt="Imagen" v-if="img"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-grid mt-3">
                        <button class="btn btn-primary" @click.once="Store('create')" :key="buttonKey"><i class="fas fa-save"></i>&nbsp; Guardar registro</button>
                    </div>
                </div>
            </div>
        </div>
        {{-- CREATE --}}

        {{-- EDIT --}}
        <div class="modal-content" v-else-if="modal.method == 'edit'" id="edit">
            <div class="modal-body pd-20 pd-sm-40">
                <a href="#" role="button" class="close pos-absolute t-15 r-15" @click="CloseModal">
                    <span aria-hidden="true">&times;</span>
                </a>

                <div>
                    <h4 class="text-center mb-1">EDITAR AVISO</h4>
                    <div class="obligatorio text-end mb-4 mt-3" style="max-height: 15px;">
                        (*)<small style="vertical-align: top;"> Obligatorio</small>
                    </div>

                    <div class="row">
                        <div class="col-lg-7 col-md-12 mb-3">
                            <div data-label="FORMULARIO" class="df-example demo-forms">
                                <div class="row row-sm">
                                    <div class="form-group form-group-sm col-md-12 mb-3">
                                        <label class="form-label mb-0" for="titulo">TÍTULO <span class="obligatorio">(*)</span></label>
                                        <input type="text" id="titulo" v-model="aviso.titulo" class="form-control" :class="[errors.titulo ? 'border-error' : '']">
                                        <div class="input-error" v-if="errors.titulo">@{{ errors.titulo[0] }}</div>
                                    </div>
                                    <div class="form-group form-group-sm col-md-12 mb-3">
                                        <label class="form-label mb-0" for="descripcion">DESCRIPCIÓN <span class="obligatorio">(*)</span></label>
                                        <textarea id="descripcion" v-model="aviso.descripcion" class="form-control" :class="[errors.descripcion ? 'border-error' : '']"></textarea>
                                        <div class="input-error" v-if="errors.descripcion">@{{ errors.descripcion[0] }}</div>
                                    </div>
                                    <div class="form-group form-group-sm col-md-12 mb-3">
                                        <label class="form-label mb-0" for="boton">NOMBRE DEL BOTÓN &nbsp;<i class="fas fa-exclamation-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="Si no desea el botón dejar en blanco"></i></label>
                                        <input type="text" id="boton" v-model="aviso.boton" class="form-control" :class="[errors.boton ? 'border-error' : '']" maxlength="9">
                                        <div class="input-error" v-if="errors.boton">@{{ errors.boton[0] }}</div>
                                    </div>
                                    <div class="form-group form-group-sm col-md-12 mb-3" v-if="aviso.boton">
                                        <label class="form-label mb-0" for="link">LINK </label>
                                        <input type="text" id="link" v-model="aviso.link" class="form-control" :class="[errors.link ? 'border-error' : '']">
                                        <div class="input-error" v-if="errors.link">@{{ errors.link[0] }}</div>
                                    </div>
                                    <div class="form-group form-group-sm col-md-12 mb-3">
                                        <label class="form-label mb-0" for="mostrar">MOSTRAR <span class="obligatorio">(*)</span></label>
                                        <select id="mostrar" v-model="aviso.mostrar" class="form-select" :class="[errors.mostrar ? 'border-error' : '']">
                                            <option value="S">SI</option>
                                            <option value="N">NO</option>
                                        </select>
                                        <div class="input-error" v-if="errors.mostrar">@{{ errors.mostrar[0] }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-5 col-md-12 mb-3">
                            <div data-label="IMAGEN" class="df-example demo-forms">
                                <div class="row row-sm">
                                    <div class="form-group form-group-sm col-md-12 mb-3">
                                        <label class="form-label mb-0" for="imagen">IMAGEN &nbsp; <i class="fas fa-exclamation-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="Dimención de la imagen 300x400"></i> <span class="obligatorio"> &nbsp;(*)</span></label>
                                        <input type="file" id="imagen" @change="Imagen" class="form-control" :class="[errors.imagen ? 'border-error' : '']">
                                        <div class="input-error" v-if="errors.imagen">@{{ errors.imagen[0] }}</div>
                                    </div>
                                    <div class="col-12">
                                        <img class="img-fluid" :src="img" alt="Imagen" v-if="img"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-grid mt-3">
                        <button class="btn btn-secondary" @click="Update('edit')"><i class="fas fa-save"></i>&nbsp; Actualizar registro</button>
                    </div>
                </div>
            </div>
        </div>
        {{-- EDIT --}}

        {{-- DELETE --}}
        <div class="modal-content" v-else-if="modal.method == 'delete'" id="delete">
            <div class="modal-body pd-20 pd-sm-40">
                <a href="#" role="button" class="close pos-absolute t-15 r-15" @click="CloseModal">
                    <span aria-hidden="true">&times;</span>
                </a>

                <div>
                    <h4 class="text-center mb-4">ELIMINAR AVISO</h4>
                    <p class="text-center mb-4">
                        ¿ Realmente desea eliminar el Aviso: <br>
                        <strong> @{{aviso.titulo}}</strong> ?
                    </p>

                    <div class="text-center mt-2 pt-50">
                        <button class="btn btn-danger" @click="Delete('delete')" style="width: 300px;"><i class="far fa-trash-alt"></i> Eliminar</button>
                    </div>
                </div>
            </div>
        </div>
        {{-- DELETE --}}
        
        {{-- ALTA --}}
        <div class="modal-content" v-else-if="modal.method == 'alta'" id="alta">
            <div class="modal-body pd-20 pd-sm-40">
                <a href="#" role="button" class="close pos-absolute t-15 r-15" @click="CloseModal">
                    <span aria-hidden="true">&times;</span>
                </a>

                <div>
                    <h4 class="text-center mb-4">ALTA DE USUARIO</h4>
                    <p class="text-center mb-4">
                        ¿ Realmente desea dar de alta al cliente: <br>
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