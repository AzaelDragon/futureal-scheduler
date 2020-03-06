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
                            <h3 class="card-title"> {{ \App\Http\Controllers\ScheduleController::findAmount() }} </h3>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                                Actualizado justo ahora
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
