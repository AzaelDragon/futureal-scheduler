@php(Debugbar::info($subjects))
@extends('layouts.dashboard', ['active' => 'subjects'])
@section('title', 'Mis Materias')
@section('nav-link', route('subjects.index'))
@section('content')
    <div class="content-center">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <i class="fas fa-graduation-cap" style="font-size: 6em"></i>
            </div>
            <br/>
            <div class="row justify-content-center">
                <h1> Mis Materias </h1>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header card-header-primary card-header-icon">
                            <div class="card-icon">
                                <i class="fas fa-cogs"></i>
                            </div>
                            <h4 class="card-title"> Configuración </h4>
                        </div>
                        <div class="card-body">
                            @if(!$subjects -> isEmpty())
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th> Nombre </th>
                                            <th class="text-right"> Acciones </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($subjects as $subject)
                                            <tr>
                                                <td> {{ $subject -> name }} </td>
                                                <td class="td-actions text-right">
                                                    <button type="button" class="btn btn-info edit" style="display: inline-block" onclick="prepareEdit({{json_encode($subject)}})" data-toggle="modal" data-target="#edit-modal">
                                                        <i class="fas fa-pen" style="margin: 0 0.25em 0 0.25em"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-danger" onclick="deleteEntry({{ $subject -> id }})">
                                                        <i class="fas fa-trash" style="margin: 0 0.25em 0 0.25em"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <br/>
                                <div class="row justify-content-center">
                                    <i class="fas fa-sad-tear" style="font-size: xx-large"></i>
                                </div>
                                <div class="row justify-content-center">
                                    <h3> ¡Está un poco solitario por aquí! </h3>
                                </div>
                                <div class="row justify-content-center">
                                    <h4> Parece ser que no tienes ningún registro. </h4>
                                </div>
                                <br/>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="row justify-content-center">
                                <button data-toggle="modal" data-target="#creation-modal" class="btn btn-round btn-primary">
                                    <i class="fas fa-plus"></i> &nbsp; Crear un nuevo registro
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('modals')
    <div class="modal fade" id="creation-modal" tabindex="-1" role="dialog" aria-hidden="true">
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
                                        <i class="fas fa-plus-hexagon" style="font-size: 2em"></i>
                                    </div>
                                    <br/>
                                    <div class="row justify-content-center">
                                        <h4> Crear un nuevo registro </h4>
                                    </div>
                                    <br/>
                                    <div class="form-group">
                                        <label for="name" class="bmd-label-floating">
                                            Nombre
                                        </label>
                                        <input id="name" name="name" type="text" class="form-control" value="{{ old('name') }}" required>
                                    </div>
                                    <br/>
                                    <div class="row justify-content-center">
                                        <button type="button" class="btn btn-fill btn-primary" onclick="createEntry();">
                                            <i class="fas fa-plus"></i> &nbsp; Crear
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
    <div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-hidden="true">
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
                                    <input id="edit-id" name="edit-id" type="hidden" />
                                    <div class="row justify-content-center">
                                        <i class="fas fa-edit" style="font-size: 2em"></i>
                                    </div>
                                    <br/>
                                    <div class="row justify-content-center">
                                        <h4> Editar registro existente </h4>
                                    </div>
                                    <br/>
                                    <div class="form-group">
                                        <label for="new-name" class="bmd-label-static">
                                            Nombre
                                        </label>
                                        <input id="new-name" name="new-name" type="text" class="form-control" required>
                                    </div>
                                    <br/>
                                    <div class="row justify-content-center">
                                        <button type="button" class="btn btn-fill btn-primary" onclick="editEntry();">
                                            <i class="fas fa-check"></i> &nbsp; Editar
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
        function prepareEdit(data) {
            $('#new-name').val(data['name']);
            $('#edit-id').val(data['id']);
        };
        function editEntry() {
            $.ajax({
                url: '{{ url('subjects') }}' + '/' + $('#edit-id').val(),
                type: 'POST',
                data: {
                    '_method': 'PUT',
                    'name': $('#new-name').val(),
                },
                success: (_) => {
                    Swal.fire({
                        title: '¡Bien!',
                        text: 'Se ha actualizado el registro especificado.',
                        icon: 'success',
                        confirmButtonText: '¡Perfecto!'
                    }).then((_) => {
                        location.reload();
                    });
                },
                error: (_) => {
                    Swal.fire({
                        title: '¡Oh, No!',
                        text: 'No se ha podido actualizar el registro especificado.',
                        icon: 'error',
                        confirmButtonText: '¡Vale!'
                    });
                }
            })
        }
        function createEntry() {
            $.ajax({
                url: '{{ route('subjects.store') }}',
                type: 'POST',
                data: {
                    'name': $('#name').val(),
                },
                success: (_) => {
                    Swal.fire({
                        title: '¡Bien!',
                        text: 'Se ha creado un nuevo registro en la base de datos.',
                        icon: 'success',
                        confirmButtonText: '¡Perfecto!'
                    }).then((_) => {
                        location.reload();
                    });
                },
                error: (_) => {
                    Swal.fire({
                        title: '¡Oh, No!',
                        text: 'No se ha podido crear el registro especificado.',
                        icon: 'error',
                        confirmButtonText: '¡Vale!'
                    });
                }
            })
        }
    </script>
    <script>
        function deleteEntry(id) {
            Swal.fire({
                title: '¿Estás seguro?',
                text: "¡Esta acción es irreversible!",
                icon: 'warning',
                showCancelButton: true,
                cancelButtonText: 'Cancelar',
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, ¡Elimínalo!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: '{{ url('subjects') }}' + '/' + id,
                        type: 'POST',
                        data: {'_method': 'DELETE'},
                        success: (_) => {
                            Swal.fire({
                                title: '¡Bien!',
                                text: 'Se ha eliminado el registro especificado.',
                                icon: 'success',
                                confirmButtonText: '¡Perfecto!'
                            }).then((_) => {
                                location.reload();
                            });
                        }
                    });
                }
            })
        };
    </script>
@endsection
