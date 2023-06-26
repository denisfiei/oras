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
                                <label class="form-label mb-0" for="categoria">CATEGORÍA <span class="obligatorio">(*)</span></label>
                                <div class="dropdown_select_content"> 
                                    <button class="form_select" type="button" data-bs-toggle="dropdown" aria-expanded="false" :class="[errors.categoria ? 'border-error' : '']">@{{menu.categoria_text}}</button>
                                    <div class="dropdown-menu w-100">
                                        <li v-for="catg in categorias">
                                            <a class="dropdown-item" href="#" :class="[menu.categoria == catg.id ? 'active' : '']" @click="SelectCategoria(catg)">@{{catg.text}}</a>
                                        </li>
                                    </div>
                                </div>
                                <div class="input-error" v-if="errors.categoria">@{{ errors.categoria[0] }}</div>
                            </div>
                            <div class="form-group col-md-12 mb-3">
                                <label class="form-label mb-0" for="nombre">NOMBRE <span class="obligatorio">(*)</span></label>
                                <input type="text" id="nombre" v-model="menu.nombre" class="form-control" :class="[errors.nombre ? 'border-error' : '']">
                                <div class="input-error" v-if="errors.nombre">@{{ errors.nombre[0] }}</div>
                            </div>
                            <div class="form-group col-md-12 mb-3">
                                <a href="https://fontawesome.com/v5/search" target="_blank" class="float-end button_link fs_11">Ver más iconos</a>
                                <label for="icono">ICONO <small>(ingresar solo la clase) </small><span class="obligatorio">(*)</span></label>
                                <div class="input-group mb-0">
                                    <input type="text" id="icono" v-model="menu.icono" class="form-control form-control-border" :class="[errors.icono ? 'border-error' : '']">
                                    <span class="input-group-text"><i :class="menu.icono"></i></span>
                                </div>
                                <div class="input-error" v-if="errors.icono">@{{ errors.icono[0] }}</div>
                            </div>
                            <div class="form-group col-md-12 mb-3">
                                <label class="form-label mb-0" for="route">ROUTE <span class="obligatorio">(*)</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-link"></i></span>
                                    <input type="text" id="route" v-model="menu.route" class="form-control form-control-border" :class="[errors.route ? 'border-error' : '']">
                                  </div>
                                <div class="input-error" v-if="errors.route">@{{ errors.route[0] }}</div>
                            </div>
                            <div class="form-group col-md-12 mb-3">
                                <label class="form-label mb-0" for="url">URL <span class="obligatorio">(*)</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><strong>{{Request::root().'/'}}</strong></span>
                                    <input type="text" id="url" v-model="menu.url" class="form-control form-control-border" :class="[errors.url ? 'border-error' : '']">
                                  </div>
                                <div class="input-error" v-if="errors.url">@{{ errors.url[0] }}</div>
                            </div>
                            <div class="form-group col-md-6 mb-3">
                                <label class="form-label mb-0" for="orden">ORDEN <span class="obligatorio">(*)</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-hashtag"></i></span>
                                    <input type="text" id="orden" v-model="menu.orden" class="form-control form-control-border text_numeric" :class="[errors.orden ? 'border-error' : '']" maxlength="2">
                                  </div>
                                <div class="input-error" v-if="errors.orden">@{{ errors.orden[0] }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="d-grid mt-4">
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
                        ¿ Realmente desea eliminar el Centro de Información: <br>
                        <strong> @{{menu.nombre}}</strong> ?
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