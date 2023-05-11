@extends('layouts.horizontal')

@section('content')
<!-- START LOGIN SECTION -->
<div class="login_register_wrap section pt-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-md-10">
                <div class="login_wrap">
            		<div class="padding_eight_all bg-white">
                        <div class="heading_s1">
                            <h3>Registrar</h3>
                        </div>
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="nombres">Datos (Nombres completos ó razón social) <span class="obligatorio">*</span></label>
                                <input type="text" id="nombres" class="form-control form-control-sm @error('nombres') is-invalid @enderror" name="nombres" value="{{ old('nombres') }}" required autocomplete="nombres" autofocus>
                                @error('nombres')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="telefono">Teléfono celular <span class="obligatorio">*</span></label>
                                <div class="input-group">
                                    <input type="hidden" name="codigo_tel" id="codigo_tel" value="+51">
                                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"  style="padding: 9px 20px !important;">+51</button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="javascript:void(0)">+51 - Perú</a></li>
                                        <li><a class="dropdown-item" href="javascript:void(0)">+54 - Argentina</a></li>
                                        <li><a class="dropdown-item" href="javascript:void(0)">+55 - Brasil</a></li>
                                        <li><a class="dropdown-item" href="javascript:void(0)">+56 - Chile</a></li>
                                        <li><a class="dropdown-item" href="javascript:void(0)">+57 - Colombia</a></li>
                                        <li><a class="dropdown-item" href="javascript:void(0)">+591 - Bolivia</a></li>
                                        <li><a class="dropdown-item" href="javascript:void(0)">+593 - Ecuador</a></li>
                                        <li><a class="dropdown-item" href="javascript:void(0)">+595 - Paraguay</a></li>
                                        <li><a class="dropdown-item" href="javascript:void(0)">+598 - Uruguay</a></li>
                                    </ul>
                                    <input type="text" id="telefono" class="form-control form-control-sm @error('telefono') is-invalid @enderror" name="telefono" value="{{ old('telefono') }}" required autocomplete="telefono" autofocus>
                                </div>
                                @error('telefono')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="email">Email <span class="obligatorio">*</span></label>
                                <input type="email" id="email" class="form-control form-control-sm @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="password">Contraseña <span class="obligatorio">*</span></label>
                                <input type="password" id="password" class="form-control form-control-sm @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
    
                            <div class="form-group mb-3">
                                <label for="password-confirm">Confirmar contraseña <span class="obligatorio">*</span></label>
                                <input type="password" id="password-confirm" class="form-control form-control-sm" name="password_confirmation" required autocomplete="new-password">
                            </div>
                            <div class="form-group mb-3">
                                <button type="submit" class="btn btn-fill-out btn-block" name="login">Registrar Cuenta</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END LOGIN SECTION -->
@endsection
