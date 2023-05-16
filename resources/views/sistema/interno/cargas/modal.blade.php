<!-- MODAL -->
<div class="modal fade" id="formularioModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" :class="modal.size">

        {{-- CREATE --}}
        <div class="modal-content" v-show="(modal.method == 'create')" id="create">
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

                    <div data-label="DATOS GENERALES" class="df-example demo-forms" v-if="visible">
                        <div class="row">
                            <div class="form-group col-md-12 mb-3">
                                <label class="form-label mb-0" for="virus">VIRUS <span class="obligatorio">(*)</span></label>
                                <div class="dropdown_select_content"> 
                                    <button class="form_select" type="button" data-bs-toggle="dropdown" aria-expanded="false" :class="[errors.virus ? 'border-error' : '']">@{{carga.virus_text}}</button>
                                    <div class="dropdown-menu w-100">
                                        <li v-for="v in virus">
                                            <a class="dropdown-item" href="#" :class="[carga.virus == v.id ? 'active' : '']" @click="SelectVirus(v)">@{{v.nombre}}</a>
                                        </li>
                                    </div>
                                </div>
                                <div class="input-error" v-if="errors.virus">@{{ errors.virus[0] }}</div>
                            </div>
                            <div class="form-group col-md-12 mb-3">
                                <label class="form-label mb-0" for="tipo">TIPO DE CARGA <span class="obligatorio">(*)</span></label>
                                <div class="dropdown_select_content"> 
                                    <button class="form_select" type="button" data-bs-toggle="dropdown" aria-expanded="false" :class="[errors.tipo ? 'border-error' : '']">@{{carga.tipo_text}}</button>
                                    <div class="dropdown-menu w-100">
                                        <a class="dropdown-item" href="#" :class="[carga.tipo == 1 ? 'active' : '']" @click="SelectTipo(1, 'GISAID')">GISAID</a>
                                        <a class="dropdown-item" href="#" :class="[carga.tipo == 2 ? 'active' : '']" @click="SelectTipo(2, 'DETALLE')">DETALLE</a>
                                    </div>
                                </div>
                                <div class="input-error" v-if="errors.tipo">@{{ errors.tipo[0] }}</div>
                            </div>
                            <div class="form-group col-md-12 mb-2">
                                <label class="form-label mb-0" for="file">SUBIR ARCHIVO <span class="obligatorio">(*)</span></label>
                                <input type="file" id="file" class="form-control" :class="[errors.file ? 'border-error' : '']" @change="File('import')" 
                                accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                                <div class="input-error" v-if="errors.file">@{{ errors.file[0] }}</div>
                            </div>

                            <template v-if="carga.file">
                                <div class="col-12 mb-4 text-center">
                                    <span class="badge text-bg-warning">Se encontraron <strong>@{{total_rows}}</strong> filas por importar !!</span>
                                </div>
                                <div class="mt-2 mb-2 text-center col-12">
                                    <button class="btn btn-success w-100" @click="Importar('import')" style="width: 300px;"><i class="fa-light fa-upload"></i> Importar Datos</button>
                                </div>
                            </template>
                        </div>
                    </div>

                    <div data-label="RESUMEN DE LA IMPORTACIÓN" class="df-example demo-forms" v-else>
                        <div class="project_progress pt-4">
                            <div class="progress ht-20">
                                <div class="progress-bar bg-success progress-bar-striped progress-bar-animated wd-45p" role="progressbar" aria-valuenow="100%" aria-valuemin="0" aria-valuemax="100" style="width:100%">
                                    <span style="position: absolute; left: 50%;">100%</span>
                                </div>
                            </div>
                            <p class="mt-2">
                                <i class="fas fa-check-circle text-success"></i> @{{importar.rows+'/'+total_rows}} Filas importadas.
                            </p>
                            <div class="mt-4" v-if="importar.errors.length > 0" style="max-height: 500px; overflow-y: auto;">
                                <table class="table table-sm table-error">
                                    <tr style="background-color: #dddddd;">
                                        <th colspan="2"><i class="far fa-file-excel"></i> DATOS DUPLICADOS (@{{importar.rows_error}})</th>
                                    </tr>
                                    <tr style="background-color: #dddddd;">
                                        <th>FILA</th>
                                        <th>NOMBRE</th>
                                    </tr>
                                    <tr v-for="error in importar.errors">
                                        <td>@{{error.fila}}</td>
                                        <td class="text-left">@{{error.nombre}}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
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
                        ¿ Realmente desea eliminar el carga: <br>
                        <strong> @{{carga.nombre}}</strong> ?
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