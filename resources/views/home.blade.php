@extends('layouts.dashboard', ['active' => 'home'])
@section('title', 'Inicio')
@section('nav-link', route('home'))
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header card-header-info card-header-icon">
                            <div class="card-icon">
                                <i class="fas fa-building"></i>
                            </div>
                            <p class="card-category"> Edificios </p>
                            <h3 class="card-title"> {{ \App\Http\Controllers\BuildingController::findAmount() }} </h3>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                                Actualizado justo ahora
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header card-header-warning card-header-icon">
                            <div class="card-icon">
                                <i class="fas fa-school"></i>
                            </div>
                            <p class="card-category"> Salones </p>
                            <h3 class="card-title"> {{ \App\Http\Controllers\RoomController::findAmount() }} </h3>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                                Actualizado justo ahora
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header card-header-rose card-header-icon">
                            <div class="card-icon">
                                <i class="fas fa-graduation-cap"></i>
                            </div>
                            <p class="card-category"> Materias </p>
                            <h3 class="card-title"> {{ \App\Http\Controllers\SubjectController::findAmount()  }} </h3>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                                Actualizado justo ahora
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header card-header-success card-header-icon">
                            <div class="card-icon">
                                <i class="fas fa-chalkboard-teacher"></i>
                            </div>
                            <p class="card-category"> Agendamientos </p>
                            <h3 class="card-title"> {{ \App\Http\Controllers\ScheduleController::find_amount() }} </h3>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                                Actualizado justo ahora
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row d-none d-lg-block">
                <div class="col-md-12">
                    <div class="card" style="padding: 5em 5em 5em 5em">
                        <div class="response"></div>
                        <div id='calendar'></div>
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
        $calendar = $('#calendar');

        today = new Date();
        y = today.getFullYear();
        m = today.getMonth();
        d = today.getDate();

        $calendar.fullCalendar({
            locale: 'es',
            viewRender: function(view, element) {
                if (view.name != 'month') {
                    $(element).find('.fc-scroller').perfectScrollbar();
                }
            },
            header: {
                left: 'title',
                center: 'month,agendaWeek,agendaDay',
                right: 'prev,next,today'
            },
            defaultDate: today,
            selectable: true,
            selectHelper: true,
            views: {
                month: {
                    titleFormat: 'MMMM YYYY'
                },
                week: {
                    titleFormat: " MMMM D YYYY"
                },
                day: {
                    titleFormat: 'D MMM, YYYY'
                }
            },

            select: function(start, end) {
                $('#date').val(moment(start).format('DD/MM/YYYY'));
                $('#creation-modal').modal('toggle');
            },

            eventClick: function(info) {
                $('#new-date').val(moment(info.event.start).format('DD/MM/YYYY'));
                $('#new-block').selectpicker('val', info.event.block);
                $('#new-subject').selectpicker('val', info.event.subject);
                $('#new-room').selectpicker('val', info.event.room);
                $('#edit-id').val(info.event.id);
                $('#edit-modal').modal('toggle');
            },

            editable: false,
            eventLimit: true,
            events: '{{ route('schedules.calendar') }}'
        });
    </script>
    <script>
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
