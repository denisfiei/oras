@extends('layouts.horizontal')

@section('content')
<main class="content content-fixed content-auth" >
    <div class="container">
        <!-- START LOGIN SECTION -->
        <div class="media align-items-stretch justify-content-center ht-100p pos-relative">
            <div class="media-body align-items-center d-none d-lg-flex">
                <div class="mx-wd-600">
                    @if ($config_cache->logo_login)
                        <img src="{{ 'storage/'.$config_cache->logo_login }}" class="img-fluid" alt="Imagen_login" style="max-height: 400px;">
                    @else
                        <img src="https://placehold.co/1260x900" class="img-fluid" alt="Imagen_login">
                    @endif
                </div>
                <div class="pos-absolute b-0 l-0 tx-12 tx-center">
                    Plataforma de Vigilancia Genómica, creado por <a href="https://www.orasconhu.org/" target="_blank">ORAS (https://www.orasconhu.org/)</a>
                </div>
            </div>
            <div class="sign-wrapper mg-lg-l-50 mg-xl-l-60">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="wd-100p">
                        <h3 class="tx-color-01 mg-b-5">Iniciar Sesión</h3>
                        <p class="tx-color-03 tx-16 mg-b-20">Bienvenidos a la plataforma de Vigilancia Genómica.</p>
    
                        <div class="form-group">
                            <label>Email</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Escriba su email" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <div class="d-flex justify-content-between mg-b-5">
                                <label class="mg-b-0-f">Contraseña</label>
                                {{-- @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" class="tx-13">¿Olvido su Contraseña?</a>
                                @endif --}}
                            </div>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Escriba su contraseña">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-brand-02 w-100">Ingresar</button>
                        {{-- <div class="divider-text">or</div>
                        <div class="d-grid gap-2">
                            <button class="btn btn-outline-facebook btn-block">Sign In With Facebook</button>
                            <button class="btn btn-outline-twitter btn-block">Sign In With Twitter</button>
                        </div>
                        <div class="tx-13 mg-t-20 tx-center">Don't have an account? <a href="page-signup.html">Create an Account</a></div> --}}
                    </div>
                </form>
            </div>
        </div>
        {{-- <div class="login_register_wrap section pt-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-6 col-md-10">
                        <div class="login_wrap">
                            <div class="padding_eight_all bg-white">
                                <div class="heading_s1">
                                    <h3>Iniciar Sesión</h3>
                                </div>
                                <form method="POST" action="{{ route('login') }}">
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
                                        <input id="password" type="password" class="form-control form-control-sm @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Escriba su contraseña ">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="login_footer form-group mb-3">
                                        <div class="chek-form">
                                            <div class="custome-checkbox">
                                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="remember">Recordarme</label>
                                            </div>
                                        </div>
                                        @if (Route::has('password.request'))
                                            <a class="btn btn-link" href="{{ route('password.request') }}">¿Olvido su Contraseña?</a>
                                        @endif
                                    </div>
                                    <div class="form-group mb-3">
                                        <button type="submit" class="btn btn-fill-out btn-block" name="login">Ingresar</button>
                                    </div>
                                </form>
                                <div class="different_login">
                                    <span> or</span>
                                </div>
                                <ul class="btn-login list_none text-center">
                                    <li><a href="#" class="btn btn-facebook"><i class="ion-social-facebook"></i>Facebook</a></li>
                                    <li><a href="#" class="btn btn-google"><i class="ion-social-googleplus"></i>Google</a></li>
                                </ul>
                                <div class="form-note text-center">¿Aún no tienes una cuenta? <a href="{{route('register')}}">!! Registrese Aqui ¡¡</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
        <!-- END LOGIN SECTION -->
    </div>
</main>
@endsection
