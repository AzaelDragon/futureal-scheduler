@php(Debugbar::info($schedules))
@extends('layouts.dashboard', ['active' => 'schedules'])
@section('title', 'Mis Agendamientos')
@section('nav-link', route('schedules.index'))
@section('content')
    <div class="content-center">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <i class="fas fa-school" style="font-size: 6em"></i>
            </div>
            <br/>
            <div class="row justify-content-center">
                <h1> Mis Agendamientos </h1>
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
                            @if(!$schedules -> isEmpty())
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th> Fecha </th>
                                            <th> Hora </th>
                                            <th> Salón </th>
                                            <th> Materia </th>
                                            <th class="text-right"> Acciones </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($schedules as $schedule)
                                            <tr>
                                                <td> {{ \Carbon\Carbon::parse($schedule -> date) -> locale('es') -> isoFormat('LL') }} </td>
                                                <td> {{ $blocks -> find($schedule -> block) -> name }} </td>
                                                <td> {{ $rooms -> find($schedule -> room) -> name }}, {{ $buildings -> find($rooms -> find($schedule -> room) -> id) -> name }} </td>
                                                <td> {{ $subjects -> find($schedule -> subject) -> name }}</td>
                                                <td class="td-actions text-right">
                                                    <button type="button" class="btn btn-info edit" style="display: inline-block" onclick="prepareEdit({{json_encode($schedule)}})" data-toggle="modal" data-target="#edit-modal">
                                                        <i class="fas fa-pen" style="margin: 0 0.25em 0 0.25em"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-danger" onclick="deleteEntry({{ $schedule -> id }})">
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
                                        <label for="date" class="bmd-label-static">
                                            Fecha
                                        </label>
                                        <input id="date" name="date" type="text" class="form-control datepicker" value="{{ now() -> day }}/{{ now() -> month }}/{{ now() -> year }}" required>
                                    </div>
                                    <div class="row justify-content-center">
                                        <select id="block" name="block" class="selectpicker" data-size="{{ count($blocks) }}" data-style="select-with-transition" title="Elije un bloque de tiempo" required>
                                            @foreach($blocks as $block)
                                                <option value="{{ $block -> id }}"> {{ $block -> name }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="row justify-content-center">
                                        <select id="subject" name="subject" class="selectpicker" data-size="{{ count($subjects) }}" data-style="select-with-transition" title="Elije una materia" required>
                                            @foreach($subjects as $subject)
                                                <option value="{{ $subject -> id }}"> {{ $subject -> name }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="row justify-content-center">
                                        <select id="room" name="room" class="selectpicker" data-size="{{ count($rooms) }}" data-style="select-with-transition" title="Elije un salón" required>
                                            @foreach($rooms as $room)
                                                <option value="{{ $room -> id }}"> {{ $room -> name }}, {{ $buildings -> find($room -> building) -> name }} </option>
                                            @endforeach
                                        </select>
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
                                    <br/>
                                    <div class="form-group">
                                        <label for="date" class="bmd-label-static">
                                            Fecha
                                        </label>
                                        <input id="new-date" name="new-date" type="text" class="form-control datepicker" required>
                                    </div>
                                    <div class="row justify-content-center">
                                        <select id="new-block" name="block" class="selectpicker" data-size="{{ count($blocks) }}" data-style="select-with-transition" title="Elije un bloque de tiempo" required>
                                            @foreach($blocks as $block)
                                                <option value="{{ $block -> id }}"> {{ $block -> name }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="row justify-content-center">
                                        <select id="new-subject" name="subject" class="selectpicker" data-size="{{ count($subjects) }}" data-style="select-with-transition" title="Elije una materia" required>
                                            @foreach($subjects as $subject)
                                                <option value="{{ $subject -> id }}"> {{ $subject -> name }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="row justify-content-center">
                                        <select id="new-room" name="room" class="selectpicker" data-size="{{ count($rooms) }}" data-style="select-with-transition" title="Elije un salón" required>
                                            @foreach($rooms as $room)
                                                <option value="{{ $room -> id }}"> {{ $room -> name }}, {{ $buildings -> find($room -> building) -> name }} </option>
                                            @endforeach
                                        </select>
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
            $('#new-date').val(data['date']);
            $('#new-block').selectpicker('val', data['block']);
            $('#new-subject').selectpicker('val', data['subject']);
            $('#new-room').selectpicker('val', data['room']);
            $('#edit-id').val(data['id']);
        };
        function editEntry() {
            $.ajax({
                url: '{{ url('schedules') }}' + '/' + $('#edit-id').val(),
                type: 'POST',
                data: {
                    '_method': 'PUT',
                    'date': $('#new-date').val(),
                    'block': $('#new-block').val(),
                    'subject': $('#new-subject').val(),
                    'room': $('#new-room').val()
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
                error: (jqXHR) => {
                    if (jqXHR.responseText === "OVERSCHEDULED") {
                        Swal.fire({
                            title: '¡Hey!',
                            text: 'No puedes agendar una clase la misma hora y día que otra ya existente.',
                            icon: 'warning',
                            confirmButtonText: '¡Vale!'
                        });
                    } else {
                        Swal.fire({
                            title: '¡Oh, No!',
                            text: 'No se ha podido actualizar el registro especificado.',
                            icon: 'error',
                            confirmButtonText: '¡Vale!'
                        });
                    }
                }
            })
        }
        function createEntry() {
            $.ajax({
                url: '{{ route('schedules.store') }}',
                type: 'POST',
                data: {
                    'date': $('#date').val(),
                    'block': $('#block').val(),
                    'subject': $('#subject').val(),
                    'room': $('#room').val()
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
                error: (jqXHR) => {
                    if (jqXHR.responseText === "OVERSCHEDULED") {
                        Swal.fire({
                            title: '¡Hey!',
                            text: 'No puedes agendar una clase la misma hora y día que otra ya existente.',
                            icon: 'warning',
                            confirmButtonText: '¡Vale!'
                        });
                    } else {
                        Swal.fire({
                            title: '¡Oh, No!',
                            text: 'No se ha podido crear el registro especificado.',
                            icon: 'error',
                            confirmButtonText: '¡Vale!'
                        });
                    }
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
                        url: '{{ url('schedules') }}' + '/' + id,
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
    <script>
        $('.datepicker').datetimepicker({
            locale: 'es',
            format: 'DD/MM/YYYY',
            icons: {
                time: "fas fa-clock-o",
                date: "fas fa-calendar",
                up: "fas fa-chevron-up",
                down: "fas fa-chevron-down",
                previous: 'fas fa-chevron-left',
                next: 'fas fa-chevron-right',
                today: 'fas fa-screenshot',
                clear: 'fas fa-trash',
                close: 'fas fa-remove'
            }
        });
    </script>
@endsection
