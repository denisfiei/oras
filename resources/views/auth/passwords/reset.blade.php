@extends('layouts.horizontal')

@section('content')
<div class="media align-items-stretch justify-content-center ht-100p pos-relative">
    <div class="media-body align-items-center d-none d-lg-flex">
        <div class="mx-wd-600">
            <img src="https://placehold.co/1260x900" class="img-fluid" alt="">
        </div>
        <div class="pos-absolute b-0 l-0 tx-12 tx-center">
            Plataforma de Vigilancia Genómica, creado por <a href="https://www.freepik.com/pikisuperstar" target="_blank">ORAS (oras.com)</a>
        </div>
    </div>
    <div class="sign-wrapper mg-lg-l-50 mg-xl-l-60">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-md-10">
                <div class="login_wrap">
            		<div class="padding_eight_all bg-white">
                        <div class="heading_s1">
                            <h3>Restablecer contraseña</h3>
                        </div>
                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">
                            <div class="form-group mb-3">
                                <label for="password">Email <span class="obligatorio">*</span></label>
                                <input id="email" type="email" class="form-control form-control-sm @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                            <div class="form-group mb-3">
                                <label for="password">Contraseña <span class="obligatorio">*</span></label>
                                <input type="password" id="password" class="form-control form-control-sm @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
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
                                <button type="submit" class="btn btn-fill-out btn-block tt-none" name="Reset">Resetear</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
