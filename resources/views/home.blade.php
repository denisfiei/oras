@extends('layouts.vertical')

@section('content')
<div class="content-body" id="form_avisos">
    <div class="container pd-x-0">
        <div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
            <div>
                <h4 class="mg-b-0 tx-spacing--1"><i class="far fa-home-lg"></i> Bienvenidos a la Plataforma de ORAS</h4>
            </div>
        </div>
    </div>

    @include('sistema.interno.avisos.modal')

    <div class="row">
        <div class="col-lg-4 col-md-6 mg-t-10">
            <div class="card">
                <div class="card-body pd-y-20 pd-x-25">
                    <div class="row row-sm">
                        <div class="col-12">
                            <span class="float-end">
                                <i class="far fa-file-pdf tx-primary" style="font-size: 80px;"></i>
                            </span>
                            <h4 class="tx-normal tx-rubik tx-spacing--1 mg-b-5 tx-primary">Manuales</h4>
                            {{-- <h6 class="tx-12 tx-semibold tx-uppercase tx-spacing-1 tx-primary mg-b-5">Manuales de uso de la plataforma</h6> --}}
                            <p class="tx-13 tx-color-03 mg-b-0">Manual sobre el uso de la plataforma.</p>
                        </div>
                    </div>
                </div>
                <table class="table table-dashboard table-hover mg-b-0">
                    <tbody>
                        <tr>
                            <td class="tx-normal"><span class="tx-color-03">Manual perfil</span> ADMINISTRADOR</td>
                            <td class="tx-medium text-end">
                                <a href="manuales/manual_sistema.pdf" download data-bs-toggle="tooltip" data-bs-placement="left" title="Descargar Manual" class="tx-15 tx-primary"><i class="far fa-download"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td class="tx-normal"><span class="tx-color-03">Manual perfil</span> OPERADOR</td>
                            <td class="tx-medium text-end">
                                <a href="manuales/manual_operativo.pdf" download data-bs-toggle="tooltip" data-bs-placement="left" title="Descargar Manual" class="tx-15 tx-primary"><i class="far fa-download"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td class="tx-normal"><span class="tx-color-03">Manual perfil</span> GESTOR DE CONTENIDO</td>
                            <td class="tx-medium text-end">
                                <a href="manuales/manual_gestor.pdf" download data-bs-toggle="tooltip" data-bs-placement="left" title="Descargar Manual" class="tx-15 tx-primary"><i class="far fa-download"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td class="tx-normal"><span class="tx-color-03">Manual</span> INSTALACIÓN POWER BI</td>
                            <td class="tx-medium text-end">
                                <a href="manuales/manual_power_bi.pdf" download data-bs-toggle="tooltip" data-bs-placement="left" title="Descargar Manual" class="tx-15 tx-primary"><i class="far fa-download"></i></a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 mg-t-10">
            <div class="card">
                <div class="card-body pd-y-20 pd-x-25">
                    <div class="row row-sm">
                        <div class="col-12">
                            <span class="float-end">
                                <i class="fas fa-film tx-teal" style="font-size: 80px;"></i>
                            </span>
                            <h4 class="tx-normal tx-rubik tx-spacing--1 mg-b-5 tx-teal">Tutoriales</h4>
                            <p class="tx-13 tx-color-03 mg-b-0">Tutoriales sobre el uso de la plataforma.</p>
                        </div>
                    </div>
                </div>
                <table class="table table-dashboard table-hover mg-b-0">
                    <tbody>
                        <tr>
                            <td class="tx-normal"><span class="tx-color-03">Video Tutorial perfil</span> ADMINISTRADOR</td>
                            <td class="tx-medium text-end">
                                <a href="https://drive.google.com/file/d/1fRQ5WVIIoGH_fy6y-nYIlSfRefXfy2WD/view?usp=sharing" target="_blank" data-bs-toggle="tooltip" data-bs-placement="left" title="Ver Video Tutorial" class="tx-15 tx-teal"><i class="far fa-caret-circle-right"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td class="tx-normal"><span class="tx-color-03">Video Tutorial perfil</span> OPERADOR</td>
                            <td class="tx-medium text-end">
                                <a href="https://drive.google.com/file/d/1GDU1OJThXuipPT2O7Ayzr9PkU9ARA5Kw/view?usp=sharing" target="_blank" data-bs-toggle="tooltip" data-bs-placement="left" title="Ver Video Tutorial" class="tx-15 tx-teal"><i class="far fa-caret-circle-right"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td class="tx-normal"><span class="tx-color-03">Video Tutorial perfil</span> GESTOR DE CONTENIDO <span>parte 1</span></td>
                            <td class="tx-medium text-end">
                                <a href="https://drive.google.com/file/d/1lEIeeY1-J6MeBVE0u8pf09fqwzevuPqX/view?usp=sharing" target="_blank" data-bs-toggle="tooltip" data-bs-placement="left" title="Ver Video Tutorial" class="tx-15 tx-teal"><i class="far fa-caret-circle-right"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td class="tx-normal"><span class="tx-color-03">Video Tutorial perfil</span> GESTOR DE CONTENIDO <span>parte 2</span></td>
                            <td class="tx-medium text-end">
                                <a href="https://drive.google.com/file/d/1GURiPV5aOwyTS9YV_ZYX2SCPxh-JWkQ7/view?usp=sharing" target="_blank" data-bs-toggle="tooltip" data-bs-placement="left" title="Ver Video Tutorial" class="tx-15 tx-teal"><i class="far fa-caret-circle-right"></i></a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 mg-t-10">
            <div class="card">
                <div class="card-body pd-y-20 pd-x-25">
                    <div class="row row-sm">
                        <div class="col-12">
                            <span class="float-end">
                                <i class="far fa-file-invoice tx-pink" style="font-size: 80px;"></i>
                            </span>
                            <h4 class="tx-normal tx-rubik tx-spacing--1 mg-b-5 tx-pink">Plantilla de Carga</h4>
                            <p class="tx-13 tx-color-03 mg-b-0">Plantillas para la carga Gisaid y Detalle.</p>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-dashboard table-hover mg-b-0">
                        <tbody>
                            <tr>
                                <td class="tx-normal"><span class="tx-color-03">Carga</span> GISAID (TSV)</td>
                                <td class="tx-medium text-end">
                                    <a href="files/carga_gisaid_plantilla.tsv" download data-bs-toggle="tooltip" data-bs-placement="left" title="Descargar Plantilla" class="tx-15 tx-pink"><i class="far fa-download"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td class="tx-normal"><span class="tx-color-03">Carga</span> GISAID (XLSX)</td>
                                <td class="tx-medium text-end">
                                    <a href="files/carga_gisaid_plantilla.xlsx" download data-bs-toggle="tooltip" data-bs-placement="left" title="Descargar Plantilla" class="tx-15 tx-pink"><i class="far fa-download"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td class="tx-normal"><span class="tx-color-03">Carga</span> DETALLE (TSV)</td>
                                <td class="tx-medium text-end">
                                    <a href="files/carga_detalle_plantilla.tsv" download data-bs-toggle="tooltip" data-bs-placement="left" title="Descargar Plantilla" class="tx-15 tx-pink"><i class="far fa-download"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td class="tx-normal"><span class="tx-color-03">Carga</span> DETALLE (XLSX)</td>
                                <td class="tx-medium text-end">
                                    <a href="files/carga_detalle_plantilla.xlsx" download data-bs-toggle="tooltip" data-bs-placement="left" title="Descargar Plantilla" class="tx-15 tx-pink"><i class="far fa-download"></i></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                  </div>
            </div>
          </div>
    </div>
</div>
@endsection
