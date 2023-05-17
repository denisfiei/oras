@extends('layouts.horizontal')

@section('css')
    <style>
        .a_load {
            background-color: #ffffffd1;
            bottom: 0;
            height: 100%;
            left: 0;
            position: fixed;
            right: 0;
            top: 0;
            width: 100%;
            z-index: 9999;
            display: none;
        }
        .a_load img {
            margin: 0 auto;
            position: relative;
            top: 50%;
            left: 50%;
            -moz-transform: translateY(-50%);
            -webkit-transform: translateY(-50%);
            transform: translateY(-50%);
            text-align: center;
            z-index: 9999; width: 35px;
        }
    </style>
@endsection

@section('content')
<div class="a_load">
    <img src="{{ asset('assets/images/ajax-loader-1.gif') }}" alt="">
</div>
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
            <div class="col-xl-12">
                <div class="login_wrap">
            		<div class="padding_eight_all bg-white">
                        <div class="heading_s1">
                            <h3 class="text-center">Restablecer contraseña</h3>
                            @if (session('status'))
                                <div class="alert alert-success mt-3 pb-2" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <p class="pt-2 fs-12 text-justify">¿Olvidaste tu contraseña?<br>No hay problema. Simplemente ingrese su email registrado en la página y le enviaremos un enlace de restablecimiento de contraseña que le permitirá cambiar por una nueva.</p>
                        </div>
                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <div class="form-group mb-3">
                                <input id="email" type="email" class="form-control form-control-sm @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Escriba su email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <button type="submit" class="btn btn-block btn-primary" id="reset_email">Enviar enlace para restablecer contraseña</button>
                            </div>
                        </form>
                        {{-- <ul class="btn-login list_none text-center">
                            <li><a href="#" class="btn btn-facebook"><i class="ion-social-facebook"></i>Facebook</a></li>
                            <li><a href="#" class="btn btn-google"><i class="ion-social-googleplus"></i>Google</a></li>
                        </ul> --}}
                        <div class="form-note text-center pt-3">
                            <a href="{{route('login')}}" class="btn btn-sm btn-outline-secondary"><i class="fas fa-arrow-left"></i> Iniciar Sesión </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END LOGIN SECTION -->
@endsection

@section('js')
    <script>
        $("#reset_email").click( function() {
            $(".a_load").show();
        });
    </script>
@endsection
