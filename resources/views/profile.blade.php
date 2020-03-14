@extends('layouts.dashboard', ['active' => 'account'])
@section('title', 'Mi Cuenta')
@section('nav-link', route('profile'))
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card card-profile">
                    <div class="card-avatar">
                        <img class="img" src="{{ asset('img/default-avatar.png') }}" alt="Imágen de perfil" />
                    </div>
                    <div class="card-body">
                        <h6 class="card-category text-primary"> Usuario de Futureal  </h6>
                        <button class="btn btn-link card-title" style="font-size: large" data-toggle="modal" data-target="#name-modal">
                            {{ \Illuminate\Support\Facades\Auth::user() -> name }}
                        </button>
                        <br/>
                        <button class="btn btn-link" style="font-size: medium" data-toggle="modal" data-target="#email-modal">
                            {{ \Illuminate\Support\Facades\Auth::user() -> email }}
                        </button>
                        <br/>
                        <button class="btn btn-link" style="font-size: x-large" data-toggle="modal" data-target="#password-modal">
                            •••••••••••••••
                        </button>
                        <br/><br/>
                        <i class="text-primary"> Puedes hacer click en cualquiera de los campos anteriores para modificar tu información.</i>
                        <br/>
                        <i class="text-gray"> Tu contraseña se ha ocultado por tu seguridad.</i>
                        <br/><br/><br/>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('modals')
    <div class="modal fade" id="name-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                <div style="padding: 2em 5em 2em 5em">
                                    <div class="row justify-content-center">
                                        <i class="fas fa-user-tag" style="font-size: 2em"></i>
                                    </div>
                                    <br/>
                                    <div class="row justify-content-center">
                                        <h4> Cambiar mi nombre </h4>
                                    </div>
                                    <div class="form-group">
                                        <label for="name" class="bmd-label-floating">
                                            Nombre
                                        </label>
                                        <input id="name" name="name" type="text" class="form-control" value="{{ \Illuminate\Support\Facades\Auth::user() -> name }}" required>
                                    </div>
                                    <br/>
                                    <div class="row justify-content-center">
                                        <button type="button" class="btn btn-fill btn-primary" onclick="editName();">
                                            <i class="fas fa-pencil-alt"></i> &nbsp; Editar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="email-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                <div style="padding: 2em 5em 2em 5em">
                                    <div class="row justify-content-center">
                                        <i class="fas fa-envelope-open-text" style="font-size: 2em"></i>
                                    </div>
                                    <br/>
                                    <div class="row justify-content-center">
                                        <h4> Cambiar mi correo electrónico </h4>
                                    </div>
                                    <br/>
                                    <div class="form-group">
                                        <label for="email" class="bmd-label-floating">
                                            Correo electrónico
                                        </label>
                                        <input id="email" name="email" type="email" class="form-control" value="{{ \Illuminate\Support\Facades\Auth::user() -> email }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="email-confirm" class="bmd-label-floating">
                                            Confirmación
                                        </label>
                                        <input id="email-confirm" name="email-confirm" type="email" class="form-control" value="" required>
                                    </div>
                                    <br/>
                                    <div class="row justify-content-center">
                                        <button type="button" class="btn btn-fill btn-primary" onclick="editEmail();">
                                            <i class="fas fa-pencil-alt"></i> &nbsp; Editar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="password-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                <div style="padding: 2em 5em 2em 5em">
                                    <div class="row justify-content-center">
                                        <i class="fas fa-key-skeleton" style="font-size: 2em"></i>
                                    </div>
                                    <br/>
                                    <div class="row justify-content-center">
                                        <h4> Cambiar mi contraseña </h4>
                                    </div>
                                    <br/>
                                    <div class="form-group">
                                        <label for="current-password" class="bmd-label-floating">
                                            Contraseña actual
                                        </label>
                                        <input id="current-password" name="current-password" type="password" class="form-control" value="" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="new-password" class="bmd-label-floating">
                                            Nueva contraseña
                                        </label>
                                        <input id="new-password" name="current-password" type="password" class="form-control" value="" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="password-confirm" class="bmd-label-floating">
                                            Contraseña actual
                                        </label>
                                        <input id="password-confirm" name="password-confirm" type="password" class="form-control" value="" required>
                                    </div>
                                    <br/>
                                    <div class="row justify-content-center">
                                        <button type="button" class="btn btn-fill btn-primary" onclick="editPassword();">
                                            <i class="fas fa-pencil-alt"></i> &nbsp; Editar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <script>
        function editName() {
            $.ajax({
                url: '{{ route('profile.name') }}',
                type: 'POST',
                data: {
                    'name': $('#name').val(),
                },
                success: (_) => {
                    Swal.fire({
                        title: '¡Bien!',
                        text: 'Se ha actualizado tu nombre en la base de datos.',
                        icon: 'success',
                        confirmButtonText: '¡Perfecto!'
                    }).then((_) => {
                        location.reload();
                    });
                },
                error: (_) => {
                    Swal.fire({
                        title: '¡Oh, No!',
                        text: 'No se ha podido actualizar tu nombre en la base de datos.',
                        icon: 'error',
                        confirmButtonText: '¡Vale!'
                    });
                }
            })
        };
        function editEmail() {
            $.ajax({
                url: '{{ route('profile.email') }}',
                type: 'POST',
                data: {
                    'email': $('#email').val(),
                    'confirmEmail': $('#email-confirm').val()
                },
                success: (_) => {
                    Swal.fire({
                        title: '¡Bien!',
                        text: 'Se ha actualizado tu correo electrónico en la base de datos.',
                        icon: 'success',
                        confirmButtonText: '¡Perfecto!'
                    }).then((_) => {
                        location.reload();
                    });
                },
                error: (jqXHR) => {
                    switch (jqXHR.responseText) {
                        case "NOMATCH":
                            Swal.fire({
                                title: '¡Oh, No!',
                                text: 'Los correos que has introducido no parecen concuerdar.',
                                icon: 'error',
                                confirmButtonText: '¡Vale!'
                            });
                        break;
                        default:
                            Swal.fire({
                                title: '¡Oh, No!',
                                text: 'No se ha podido actualizar tu correo electrónico en la base de datos.',
                                icon: 'error',
                                confirmButtonText: '¡Vale!'
                            });
                        break;
                    }
                }
            })
        };
        function editPassword() {
            $.ajax({
                url: '{{ route('profile.password') }}',
                type: 'POST',
                data: {
                    'currentPassword': $('#current-password').val(),
                    'password': $('#new-password').val(),
                    'confirmPassword': $('#password-confirm').val()
                },
                success: (_) => {
                    Swal.fire({
                        title: '¡Bien!',
                        text: 'Se ha actualizado tu contraseña en la base de datos.',
                        icon: 'success',
                        confirmButtonText: '¡Perfecto!'
                    }).then((_) => {
                        location.reload();
                    });
                },
                error: (jqXHR) => {
                    switch (jqXHR.responseText) {
                        case "NOMATCH":
                            Swal.fire({
                                title: '¡Oh, No!',
                                text: 'Las contraseñas que has introducido no parecen concuerdar.',
                                icon: 'error',
                                confirmButtonText: '¡Vale!'
                            });
                            break;
                        case "WRONGPASSWORD":
                            Swal.fire({
                                title: '¡Oh, No!',
                                text: 'La contraseña que ingresaste no concuerda con tu actual contraseña.',
                                icon: 'error',
                                confirmButtonText: '¡Vale!'
                            });
                            break;
                        default:
                            Swal.fire({
                                title: '¡Oh, No!',
                                text: 'No se ha podido actualizar tu contraseña en la base de datos.',
                                icon: 'error',
                                confirmButtonText: '¡Vale!'
                            });
                            break;
                    }
                }
            })
        };
    </script>
@endsection
