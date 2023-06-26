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
                        <div class="row mb-3">
                            <div class="form-group col-md-12 mb-3">
                                <label class="form-label mb-0" for="nombre">NOMBRE <span class="obligatorio">(*)</span></label>
                                <input type="text" id="nombre" v-model="rol.nombre" class="form-control" :class="[errors.nombre ? 'border-error' : '']">
                                <div class="input-error" v-if="errors.nombre">@{{ errors.nombre[0] }}</div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div data-label="MENU ADMINISTRATIVO" class="df-example mb-4">
                                    <ul class="list-group">
                                        <li class="list-group-item" v-for="item in administrativos">
                                            @{{item.nombre}}
                                            <div class="form-check form-switch float-end">
                                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div data-label="MENU OPERATIVO" class="df-example mb-4">
                                    <ul class="list-group">
                                        <li class="list-group-item" v-for="item in operativos">
                                            @{{item.nombre}}
                                            <div class="form-check form-switch float-end">
                                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div data-label="MENU DE SISTEMA" class="df-example mb-0">
                                    <ul class="list-group">
                                        <li class="list-group-item" v-for="item in sistemas">
                                            @{{item.nombre}}
                                            <div class="form-check form-switch float-end">
                                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                            </div>
                                        </li>
                                    </ul>
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
                        ¿ Realmente desea eliminar el Centro de Información: <br>
                        <strong> @{{rol.nombre}}</strong> ?
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