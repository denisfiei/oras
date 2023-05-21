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

                    <div data-label="IMPORTAR ARCHIVO" class="df-example demo-forms" v-if="visible">
                        <div class="row">
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
                                        <td class="text-left">@{{error.error}}</td>
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
                        ¿ Realmente desea eliminar la carga de linajes: <br>
                        <strong> @{{carga.archivo}}</strong> ?
                    </p>

                    <div class="text-center mt-2 pt-50">
                        <button class="btn btn-danger" @click="Delete('delete')" style="width: 300px;"><i class="far fa-trash-alt"></i> Eliminar</button>
                    </div>
                </div>
            </div>
        </div>
        {{-- DELETE --}}

        {{-- DETALLES --}}
        <div class="modal-content" v-show="modal.method == 'detalles'" id="detalles">
            <div class="modal-body pd-20 pd-sm-40">
                <a href="#" role="button" class="close pos-absolute t-15 r-15" @click="CloseModal">
                    <span aria-hidden="true">&times;</span>
                </a>

                <div>
                    <h4 class="text-center mb-4">@{{modal.title}}</h4>
                    <div class="mb-4">
                        <i class="far fa-file-times"></i> @{{carga.archivo}}
                    </div>
                    <div data-label="LISTA" class="df-example demo-forms">
                        <div class="table-responsive" style="max-height: calc(100vh - 285px);">
                            <table class="table table-hover table-sm table_overflow">
                                <thead class="thead-primary">
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th>Código</th>
                                        <th>Nombre</th>
                                        <th>Clade</th>
                                        <th class="text-center">Estado</th>
                                    </tr>
                                </thead>
                                <tbody style="height: calc(100vh - 335px);">
                                    <tr v-for="(lin, index) in linajes">
                                        <td class="text-center">@{{(index+1)}}</td>
                                        <td>@{{lin.codigo}}</td>
                                        <td>@{{lin.nombre}}</td>
                                        <td>@{{lin.clade}}</td>
                                        <td class="text-center">
                                            <i class="fas fa-check text-success" v-if="lin.activo == 'S'"></i>
                                            <i class="fas fa-times text-danger" v-else></i>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- DETALLES --}}
    </div>
</div>
<!-- MODAL -->