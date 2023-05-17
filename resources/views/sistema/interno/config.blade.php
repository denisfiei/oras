@extends('layouts.vertical')

@section('content')
    
<div class="content-body" id="form_config">
    <div class="container pd-x-0">
        <div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
            <div>
                <h4 class="mg-b-0 tx-spacing--1"><i data-feather="settings"></i> Datos de Configuración</h4>
            </div>
            <div class="d-none d-md-block">
                
            </div>
        </div>
    </div>

    <div class="col-lg-12 col-xl-12 mg-t-10">
        <div class="card mg-b-10">
            <div class="card-header d-flex align-items-center justify-content-between pd-r-12">
                <h6 class="mg-b-0">CONFIGURACIÓN DEL SISTEMA</h6>
                <div class="d-flex tx-16">
                    <a href="#" class="link-03 lh-0" data-bs-toggle="tooltip" title="Recargar Lista" onclick="window.location.reload();"><ion-icon name="reload-sharp"></ion-icon></a>
                </div>
            </div>
            <div class="card-body pd-y-30">
                <div class="row my_vue" style="display:none;">
                    <div class="obligatorio text-end mb-4" style="max-height: 15px;">
                        (*)<small style="vertical-align: top;"> Obligatorio</small>
                    </div>
                    <div class="col-lg-8 col-md-12">
                        <div data-label="DATOS GENERALES" class="df-example demo-forms mb-3">
                            <div class="row row-sm">
                                <div class="form-group col-lg-4 col-md-12 mb-3">
                                    <label class="form-label mb-0" for="nombre">NOMBRE DEL SISTEMA <span class="obligatorio">(*)</span></label>
                                    <input type="text" id="nombre" v-model="form.nombre" class="form-control" :class="[errors.nombre ? 'border-error' : '']">
                                    <div class="input-error" v-if="errors.nombre">@{{ errors.nombre[0] }}</div>
                                </div>
                                <div class="form-group col-lg-8 col-md-12 mb-3">
                                    <label class="form-label mb-0" for="direccion">DIRECCIÓN <span class="obligatorio">(*)</span></label>
                                    <input type="text" id="direccion" v-model="form.direccion" class="form-control" :class="[errors.direccion ? 'border-error' : '']">
                                    <div class="input-error" v-if="errors.direccion">@{{ errors.direccion[0] }}</div>
                                </div>
                                <div class="form-group col-lg-12 col-md-12 mb-3">
                                    <label class="form-label mb-0" for="descripcion">DESCRIPCIÓN <span class="obligatorio">(*)</span></label>
                                    <textarea id="descripcion" v-model="form.descripcion" class="form-control" :class="[errors.descripcion ? 'border-error' : '']"></textarea>
                                    <div class="input-error" v-if="errors.descripcion">@{{ errors.descripcion[0] }}</div>
                                </div>
                                <div class="form-group col-lg-4 col-md-6 col-sm-12 mb-3">
                                    <label class="form-label mb-0" for="telefono_1">TELÉFONO 1 <span class="obligatorio">(*)</span></label>
                                    <input type="text" id="telefono_1" v-model="form.telefono_1" class="form-control text_numeric" :class="[errors.telefono_1 ? 'border-error' : '']" maxlength="9">
                                    <div class="input-error" v-if="errors.telefono_1">@{{ errors.telefono_1[0] }}</div>
                                </div>
                                <div class="form-group col-lg-4 col-md-6 col-sm-12 mb-3">
                                    <label class="form-label mb-0" for="telefono_2">TELÉFONO 2 <span class="obligatorio">(*)</span></label>
                                    <input type="text" id="telefono_2" v-model="form.telefono_2" class="form-control text_numeric" :class="[errors.telefono_2 ? 'border-error' : '']" maxlength="9">
                                    <div class="input-error" v-if="errors.telefono_2">@{{ errors.telefono_2[0] }}</div>
                                </div>
                                <div class="form-group col-lg-4 col-md-6 col-sm-12 mb-3">
                                    <label class="form-label mb-0" for="whatsapp">WHATSAPP <span class="obligatorio">(*)</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fab fa-whatsapp"></i></span>
                                        <input type="text" id="whatsapp" v-model="form.whatsapp" class="form-control text_numeric" :class="[errors.whatsapp ? 'border-error' : '']">
                                    </div>
                                    <div class="input-error" v-if="errors.whatsapp">@{{ errors.whatsapp[0] }}</div>
                                </div>
                                <div class="form-group col-lg-5 col-md-6 col-sm-12 mb-0">
                                    <label class="form-label mb-0" for="email">EMAIL <span class="obligatorio">(*)</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="far fa-envelope"></i></span>
                                        <input type="email" id="email" v-model="form.email" class="form-control" :class="[errors.email ? 'border-error' : '']">
                                    </div>
                                    <div class="input-error" v-if="errors.email">@{{ errors.email[0] }}</div>
                                </div>
                            </div>
                        </div>

                        <div data-label="REDES SOCIALES" class="df-example demo-forms mb-3">
                            <div class="row row-sm">
                                <div class="form-group col-lg-12 col-md-12 col-sm-12 mb-3">
                                    <label class="form-label mb-0" for="facebook">FACEBOOK </label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fab fa-facebook-f"></i></span>
                                        <input type="text" id="facebook" v-model="form.facebook" class="form-control" :class="[errors.facebook ? 'border-error' : '']">
                                    </div>
                                    <div class="input-error" v-if="errors.facebook">@{{ errors.facebook[0] }}</div>
                                </div>
                                <div class="form-group col-lg-12 col-md-12 col-sm-12 mb-3">
                                    <label class="form-label mb-0" for="twitter">TWITTER </label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fab fa-twitter"></i></span>
                                        <input type="text" id="twitter" v-model="form.twitter" class="form-control" :class="[errors.twitter ? 'border-error' : '']">
                                    </div>
                                    <div class="input-error" v-if="errors.twitter">@{{ errors.twitter[0] }}</div>
                                </div>
                                <div class="form-group col-lg-12 col-md-12 col-sm-12 mb-0">
                                    <label class="form-label mb-0" for="instagram">INSTAGRAM </label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fab fa-instagram"></i></span>
                                        <input type="text" id="instagram" v-model="form.instagram" class="form-control" :class="[errors.instagram ? 'border-error' : '']">
                                    </div>
                                    <div class="input-error" v-if="errors.instagram">@{{ errors.instagram[0] }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <div data-label="LOGO DEL SISTEMA" class="df-example demo-forms mb-4">
                            <div class="row row-sm mb-4">
                                <div class="form-group col-md-12 mb-3">
                                    <label class="form-label mb-0" for="logo">LOGO <span class="obligatorio">(* resolución 180x45)</span></label>
                                    <input type="file" id="logo" class="form-control" :class="[errors.logo ? 'border-error' : '']" accept="image/*" @change="Imagen">
                                    <div class="input-error" v-if="errors.logo">@{{ errors.logo[0] }}</div>
                                </div>
                                <div class="col-md-12">
                                    <img class="img-fluid" :src="imagen" alt="Logo Sistema Claro" v-if="imagen" style="background-color: #dbdbdb;"/>
                                </div>
                            </div>
                            
                            <div class="row row-sm">
                                <div class="form-group col-md-12 mb-3">
                                    <label class="form-label mb-0" for="logo_login">IMAGEN LOGIN <span class="obligatorio">(* resolución 600x430)</span></label>
                                    <input type="file" id="logo_login" class="form-control" :class="[errors.logo_login ? 'border-error' : '']" accept="image/*" @change="ImagenDark">
                                    <div class="input-error" v-if="errors.logo_login">@{{ errors.logo_login[0] }}</div>
                                </div>
                                <div class="col-md-12">
                                    <img class="img-fluid" :src="imagen_login" alt="Logo Sistema Oscuro" v-if="imagen_login"/>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-center mt-3">
                        <button class="btn btn-primary" @click.once="Update('form_config')" :key="buttonKey" style="min-width: 300px;"><i class="fas fa-save"></i> Guardar datos</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
    <script src="{{asset('views/interno/config.js?v=1.0.0')}}"></script>
@endsection