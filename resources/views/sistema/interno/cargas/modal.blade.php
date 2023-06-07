<!-- MODAL -->
<div class="modal fade" id="formularioModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" :class="modal.size">

        {{-- CARGA GISAID --}}
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
                            <div class="form-group col-md-12 mb-2">
                                <label class="form-label mb-0" for="file">SUBIR ARCHIVO <span class="obligatorio">(*)</span></label>
                                <input type="file" id="file" class="form-control" :class="[errors.file ? 'border-error' : '']" @change="File('import')" 
                                accept=".tsv">
                                {{-- accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"> --}}
                                <div class="input-error" v-if="errors.file">@{{ errors.file[0] }}</div>
                            </div>

                            <template v-if="carga.file">
                                <div class="col-12 mb-4 text-center">
                                    <span class="badge text-bg-warning">Se encontraron <strong>@{{total_rows}}</strong> filas por importar !!</span>
                                </div>
                                <div class="mt-2 mb-2 text-center col-12">
                                    <button class="btn btn-success w-100" @click="Gisaid('import')" style="width: 300px;"><i class="fa-light fa-upload"></i> Importar Datos</button>
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
                                        <th colspan="2"><i class="far fa-file-excel"></i> ERRORES AL IMPORTAR (@{{importar.rows_error}})</th>
                                    </tr>
                                    <tr v-if="importar.log_file">
                                        <th colspan="2" class="text-center"><a :href="importar.log_file" download id="log_file"><i class="fas fa-eye"></i> Ver archivo log</a></th>
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
        {{-- CARGA GISAID --}}
        
        {{-- CARGA DETALLE --}}
        <div class="modal-content" v-show="(modal.method == 'carga')" id="carga">
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

                    <div class="mb-4">
                        <strong>REFERENCIA GISAID:</strong> <span class="text-primary"><i class="far fa-file-times"></i> @{{carga.archivo}}</span>
                    </div>
                    <div data-label="DATOS GENERALES" class="df-example demo-forms" v-if="visible">
                        <div class="row">
                            {{-- <div class="form-group col-md-12 mb-3">
                                <label class="form-label mb-0" for="muestreo">TIPO DE MUESTREO <span class="obligatorio">(*)</span></label>
                                <div class="dropdown_select_content"> 
                                    <button class="form_select" type="button" data-bs-toggle="dropdown" aria-expanded="false" :class="[errors.muestreo ? 'border-error' : '']">@{{carga.muestreo_text}}</button>
                                    <div class="dropdown-menu w-100">
                                        <li v-for="m in muestreos">
                                            <a class="dropdown-item" href="#" :class="[carga.muestreo == m.id ? 'active' : '']" @click="SelectMuestreo(m)">@{{m.nombre}}</a>
                                        </li>
                                    </div>
                                </div>
                                <div class="input-error" v-if="errors.muestreo">@{{ errors.muestreo[0] }}</div>
                            </div> --}}
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
                                    <button class="btn btn-success w-100" @click="Detalle('carga')" style="width: 300px;"><i class="fa-light fa-upload"></i> Importar Datos</button>
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
                                        <th colspan="2"><i class="far fa-file-excel"></i> ERROR DE DATOS (@{{importar.rows_error}})</th>
                                    </tr>
                                    <tr style="background-color: #dddddd;">
                                        <th>FILA</th>
                                        <th>DETALLE</th>
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
        {{-- CARGA DETALLE --}}

        {{-- DELETE --}}
        <div class="modal-content" v-show="modal.method == 'delete'" id="delete">
            <div class="modal-body pd-20 pd-sm-40">
                <a href="#" role="button" class="close pos-absolute t-15 r-15" @click="CloseModal">
                    <span aria-hidden="true">&times;</span>
                </a>

                <div>
                    <h4 class="text-center mb-4">@{{modal.title}}</h4>
                    <p class="text-center mb-4">
                        ¿ Realmente desea eliminar la carga de datos del archivo: <br>
                        <strong class="text-primary"> @{{carga.archivo}}</strong> <br>
                        creada el <strong>@{{carga.fecha}}</strong> ?
                    </p>

                    <div class="text-center mt-2 pt-50">
                        <button class="btn btn-danger" @click="Delete('delete')" style="width: 300px;"><i class="far fa-trash-alt"></i> Eliminar</button>
                    </div>
                </div>
            </div>
        </div>
        {{-- DELETE --}}
        
        {{-- ROWS_GISAID --}}
        <div class="modal-content" v-show="modal.method == 'rows_gisaid'" id="rows_gisaid">
            <div class="modal-body pd-20 pd-sm-40">
                <a href="#" role="button" class="close pos-absolute t-15 r-15" @click="CloseModal">
                    <span aria-hidden="true">&times;</span>
                </a>

                <div>
                    <h4 class="text-center mb-4">@{{modal.title}}</h4>
                    <div class="mb-4">
                        <div>ARCHIVO: <i class="far fa-file-times"></i> @{{carga.archivo}}</div>
                    </div>
                    <div data-label="LISTA" class="df-example demo-forms">
                        <div class="table-responsive" style="max-height: calc(100vh - 230px);">
                            <table class="table table-hover table-sm">
                                <thead class="thead-primary">
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th>Virus Name</th>
                                        <th>Accesion id</th>
                                        <th>Collection date</th>
                                        <th>Location</th>
                                        <th>Host</th>
                                        <th>Gender</th>
                                        <th>Patient age</th>
                                        <th>Patient status</th>
                                        <th>Passage</th>
                                        <th>Specimen</th>
                                        <th>Additional host information</th>
                                        <th>Lineage</th>
                                        <th>Clade</th>
                                        <th>Aa substitutions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(g, index) in gisaids">
                                        <td class="text-center">@{{(index+1)}}</td>
                                        <td>@{{g.virus_name}}</td>
                                        <td>@{{g.accesion_id}}</td>
                                        <td>@{{g.collection_date}}</td>
                                        <td>@{{g.location}}</td>
                                        <td>@{{g.host}}</td>
                                        <td>@{{g.gender}}</td>
                                        <td>@{{g.patient_age}}</td>
                                        <td>@{{g.patient_status}}</td>
                                        <td>@{{g.passage}}</td>
                                        <td>@{{g.specimen}}</td>
                                        <td>@{{g.additional_host_information}}</td>
                                        <td>@{{g.linege}}</td>
                                        <td>@{{g.clade}}</td>
                                        <td>@{{g.aa_substitutions}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- ROWS_GISAID --}}
        
        {{-- ROWS_DETALLE --}}
        <div class="modal-content" v-show="modal.method == 'rows_detalle'" id="rows_detalle">
            <div class="modal-body pd-20 pd-sm-40">
                <a href="#" role="button" class="close pos-absolute t-15 r-15" @click="CloseModal">
                    <span aria-hidden="true">&times;</span>
                </a>

                <div>
                    <h4 class="text-center mb-4">@{{modal.title}}</h4>
                    <div class="mb-4">
                        <button class="float-end btn btn-sm btn-danger" @click="ConfirmModal"><i class="fas fa-trash-alt"></i> Borrar Detalle</button>
                        <div>ARCHIVO: <i class="far fa-file-times"></i> @{{carga.archivo}}</div>
                    </div>
                    <div data-label="LISTA" class="df-example demo-forms">
                        <div class="table-responsive" style="max-height: calc(100vh - 230px);">
                            <table class="table table-hover table-sm">
                                <thead class="thead-primary">
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th>Código</th>
                                        <th>Código pais</th>
                                        <th>Kit ct</th>
                                        <th>Gen</th>
                                        <th>Ct</th>
                                        <th>Ct2</th>
                                        <th>Fecha muestra</th>
                                        <th>Edad</th>
                                        <th>Sexo</th>
                                        <th>Vacunado</th>
                                        <th>Dosis 1</th>
                                        <th>Dosis 2</th>
                                        <th>Dosis 3</th>
                                        <th>Dosis 4</th>
                                        <th>Dosis 5</th>
                                        <th>Hospitalización</th>
                                        <th>Fallecido</th>
                                        <th>Número placa</th>
                                        <th>Placa</th>
                                        <th>Corrida</th>
                                        <th>Fecha sistema</th>
                                        <th>Cobertura</th>
                                        <th>Cobertura porcentage</th>
                                        <th>Asintomático</th>
                                        <th>Sintomas</th>
                                        <th>Comorbilidad</th>
                                        <th>Comorbilidad lista</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(d, index) in detalles">
                                        <td class="text-center">@{{(index+1)}}</td>
                                        <td>@{{d.codigo}}</td>
                                        <td>@{{d.codigo_pais}}</td>
                                        <td>@{{d.kit_ct}}</td>
                                        <td>@{{d.gen}}</td>
                                        <td>@{{d.ct}}</td>
                                        <td>@{{d.ct2}}</td>
                                        <td>@{{d.ct2}}</td>
                                        <td>@{{d.fecha_muestra}}</td>
                                        <td>@{{d.edad}}</td>
                                        <td>@{{d.sexo}}</td>
                                        <td>@{{d.vacunado}}</td>
                                        <td>@{{d.dosis_1}}</td>
                                        <td>@{{d.dosis_2}}</td>
                                        <td>@{{d.dosis_3}}</td>
                                        <td>@{{d.dosis_4}}</td>
                                        <td>@{{d.dosis_5}}</td>
                                        <td>@{{d.hospitalizacion}}</td>
                                        <td>@{{d.fallecido}}</td>
                                        <td>@{{d.numero_placa}}</td>
                                        <td>@{{d.corrida}}</td>
                                        <td>@{{d.fecha_sistema}}</td>
                                        <td>@{{d.cobertura}}</td>
                                        <td>@{{d.cobertura_porcentaje}}</td>
                                        <td>@{{d.asintomatico}}</td>
                                        <td>@{{d.sintomas}}</td>
                                        <td>@{{d.comorbilidad}}</td>
                                        <td>@{{d.comorbilidad_lista}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- ROWS_DETALLE --}}
    </div>
</div>
<!-- MODAL -->

<!-- MODAL CONFIRM-->
<div class="modal fade" id="confirmModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true"  style="background-color: #000000eb;">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body pd-20 pd-sm-40">
                <a href="#" role="button" class="close pos-absolute t-15 r-15" @click="CloseModalConfirm">
                    <span aria-hidden="true">&times;</span>
                </a>

                <div>
                    <h4 class="text-center mb-4">BORRAR LOS REGISTRO DETALLE</h4>
                    <p class="text-center mb-4">
                        Se eliminaran todos los registros de este archivo <br>
                        <strong class="text-primary"> @{{carga.archivo}}</strong> <br>
                        ¿ Deseas continuar ?
                    </p>

                    <div class="text-center mt-2 pt-50">
                        <button class="btn btn-danger" @click="DeleteDetalle('delete_detalle')" style="width: 300px;"><i class="far fa-trash-alt"></i> Eliminar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>