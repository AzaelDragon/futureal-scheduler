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
                                <i class="material-icons">store</i>
                            </div>
                            <p class="card-category">Revenue</p>
                            <h3 class="card-title">$34,245</h3>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                                <i class="material-icons">date_range</i> Last 24 Hours
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
