@extends('layouts.page')
@section('title', 'Inicio de Sesión')
@section('body-class', 'off-canvas-sidebar')
@section('header-class', 'page-header login-page header-filter')
@section('header-image', asset('img/bg2.jpg'))
@section('filter-color', 'black')
@section('scripts')
    <script>
        $(document).ready(function() {
            md.checkFullPageBackgroundImage();
            setTimeout(function() {
                $('.card').removeClass('card-hidden');
            }, 700);
        });
    </script>
    @error
        <script>
            Swal.fire({
                title: '¡Oh, No!',
                text: 'Los datos introducidos parecen ser incorrectos.',
                icon: 'error',
                confirmButtonText: '¡Vale!'
            });
        </script>
    @enderror
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-8 ml-auto mr-auto">
                <form class="form" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="card card-login card-hidden">
                        <div class="card-header card-header-primary text-center">
                            <h1><i class="fas fa-fingerprint"></i></h1>
                            <h4 class="card-title"> Inicio de Sesión </h4>
                        </div>
                        <div class="card-body ">
                            <p class="card-description text-center"> Llena todos los campos cuidadosamente.</p>
                            <div class="bmd-form-group">
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-envelope"></i>
                                    </span>
                                  </div>
                                  <input id="email" name="email" type="email" value="{{ old('email') }}" autocomplete="email" class="form-control @error('email') form-control-danger @enderror" placeholder="Correo electrónico" required autofocus>
                                </div>
                            </div>
                            <div class="bmd-form-group">
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-lock"></i>
                                    </span>
                                  </div>
                                  <input id="password" name="password" type="password" autocomplete="current-password" class="form-control @error('password') form-control-danger @enderror" placeholder="Contraseña" required>
                                </div>
                            </div>
                            <br/>
                            <div class="bmd-form-group" style="padding-left: 1.2em">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} class="form-check-input" type="checkbox" value="">
                                        Recordarme
                                        <span class="form-check-sign">
                                      <span class="check"></span>
                                    </span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <br/>
                        <div class="card-footer justify-content-center">
                            <button type="submit" class="btn btn-primary faa-parent animated-hover">
                                <b>¡Vamos!</b> &nbsp; <i class="fas fa-arrow-right faa-horizontal"></i>
                            </button>
                        </div>
                        <br/>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
