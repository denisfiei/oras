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

                    <div class="row">
                        <div class="col-lg-6 col-md-12">
                            <div data-label="DATOS GENERALES" class="df-example demo-forms mb-3">
                                <div class="row">
                                    <div class="form-group col-lg-12 mb-3">
                                        <label class="form-label mb-0" for="nivel">NIVEL <span class="obligatorio">(*)</span></label>
                                        {{-- <input type="text" id="nivel" v-model="recurso.nivel" class="form-control text_numeric" :class="[errors.nivel ? 'border-error' : '']" maxlength="2"> --}}
                                        <div class="dropdown_select_content"> 
                                            <button class="form_select" type="button" data-bs-toggle="dropdown" aria-expanded="false" :class="[errors.nivel ? 'border-error' : '']">@{{recurso.nivel_text}}</button>
                                            <div class="dropdown-menu w-100">
                                                <li v-for="niv in niveles">
                                                    <a class="dropdown-item" href="#" :class="[recurso.nivel == niv.id ? 'active' : '']" @click="SelectNivel(niv)">@{{niv.text}}</a>
                                                </li>
                                            </div>
                                        </div>
                                        <div class="input-error" v-if="errors.nivel">@{{ errors.nivel[0] }}</div>
                                    </div>

                                    <div class="form-group col-md-12 mb-3"  v-if="recurso.nivel < 20 && recurso.nivel >= 10">
                                        <label class="form-label mb-0" for="pais">PAIS <span class="obligatorio">(*)</span></label>
                                        <div class="dropdown_select_content"> 
                                            <button class="form_select" type="button" data-bs-toggle="dropdown" aria-expanded="false" :class="[errors.pais ? 'border-error' : '']">@{{recurso.pais_text}}</button>
                                            <div class="dropdown-menu w-100">
                                                <li v-for="pais in paises">
                                                    <a class="dropdown-item" href="#" :class="[recurso.pais == pais.id ? 'active' : '']" @click="SelectPais(pais)"><img :src="'storage/paises/'+pais.bandera" class="codigo_tel"> @{{pais.nombre}}</a>
                                                </li>
                                            </div>
                                        </div>
                                        <div class="input-error" v-if="errors.pais">@{{ errors.pais[0] }}</div>
                                    </div>
                                    <div class="form-group col-md-12 mb-3"  v-if="recurso.nivel >= 20">
                                        <label class="form-label mb-0" for="centro">CENTRO DE INFORMACIÓN <span class="obligatorio">(*)</span></label>
                                        <div class="dropdown_select_content"> 
                                            <button class="form_select" type="button" data-bs-toggle="dropdown" aria-expanded="false" :class="[errors.centro ? 'border-error' : '']">@{{recurso.centro_text}}</button>
                                            <div class="dropdown-menu w-100">
                                                <li v-for="cet in centros">
                                                    <a class="dropdown-item" href="#" :class="[recurso.centro == cet.id ? 'active' : '']" @click="SelectCentro(cet)">@{{cet.nombre}}</a>
                                                </li>
                                            </div>
                                        </div>
                                        <div class="input-error" v-if="errors.centro">@{{ errors.centro[0] }}</div>
                                    </div>
                                    
                                    <div class="form-group col-md-12 mb-3">
                                        <label class="form-label mb-0" for="titulo">TÍTULO <span class="obligatorio">(*)</span></label>
                                        <input type="text" id="titulo" v-model="recurso.titulo" class="form-control" :class="[errors.titulo ? 'border-error' : '']">
                                        <div class="input-error" v-if="errors.titulo">@{{ errors.titulo[0] }}</div>
                                    </div>
                                    <div class="form-group col-md-12 mb-3">
                                        <label class="form-label mb-0" for="descripcion">DESCRIPCIÓN (Para videos <strong>"iframe"</strong> )</label>
                                        <textarea id="descripcion" v-model="recurso.descripcion" class="form-control" :class="[errors.descripcion ? 'border-error' : '']"></textarea>
                                        <div class="input-error" v-if="errors.descripcion">@{{ errors.descripcion[0] }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div data-label="OTROS DATOS" class="df-example demo-forms mb-3">
                                <div class="row">
                                    <div class="form-group col-lg-4 col-md-4 col-sm-12 mb-3">
                                        <label class="form-label mb-0" for="orden">ORDEN </label>
                                        <input type="text" id="orden" v-model="recurso.orden" class="form-control text_numeric" :class="[errors.orden ? 'border-error' : '']" maxlength="2">
                                        <div class="input-error" v-if="errors.orden">@{{ errors.orden[0] }}</div>
                                    </div>
                                    <div class="form-group col-lg-8 col-md-8 col-sm-12 mb-0">
                                        <label class="form-label mb-0" for="fecha">FECHA DE PUBLICACIÓN <span class="obligatorio">(*)</span></label>
                                        <input type="date" id="fecha" v-model="recurso.fecha" class="form-control" :class="[errors.fecha ? 'border-error' : '']" max="{{date('Y-m-d')}}">
                                        <div class="input-error" v-if="errors.fecha">@{{ errors.fecha[0] }}</div>
                                    </div>
                                    <div class="form-group col-md-12 mb-0">
                                        <label class="form-label mb-0" for="enlace">ENLACE / LINK&nbsp; <i class="fas fa-exclamation-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="Escriba el enlace al cual se redireccionará al hacer click."></i></label>
                                        <input type="text" id="enlace" v-model="recurso.enlace" class="form-control" :class="[errors.enlace ? 'border-error' : '']">
                                        <div class="input-error" v-if="errors.enlace">@{{ errors.enlace[0] }}</div>
                                    </div>
                                </div>
                            </div>

                            <div data-label="ARCHIVO" class="df-example demo-forms mb-3">
                                <div class="row">
                                    <div class="form-group col-md-12 mb-0">
                                        <label class="form-label mb-0" for="imagen">IMAGEN&nbsp; <i class="fas fa-exclamation-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="Dimención de la imagen 300x400 píxeles"></i> <span class="obligatorio">(*)</span></label>
                                        <input type="file" id="imagen" class="form-control" :class="[errors.imagen ? 'border-error' : '']" accept="image/*" @change="Imagen">
                                        <div class="input-error" v-if="errors.imagen">@{{ errors.imagen[0] }}</div>
                                    </div>
                                    <div class="col-md-12 mt-3 mb-0 text-center">
                                        <img class="img-fluid" :src="imagen_recurso" alt="Imagen" v-if="imagen_recurso" style="max-width: 250px;"/>
                                    </div>
                                </div>
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
                        ¿ Realmente desea eliminar el recurso: <br>
                        <strong> @{{recurso.titulo}}</strong> ?
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