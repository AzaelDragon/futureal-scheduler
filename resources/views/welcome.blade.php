@extends('layouts.page')
@section('title', '¡Bienvenido!')
@section('body-class', 'off-canvas-sidebar')
@section('header-class', 'page-header error-page header-filter')
@section('header-image', asset('img/bg1.jpg'))
@section('filter-color', 'black')
@section('content')
    <div class="content-center">
        <div class="row">
            <div class="col-md-12">
                <h1 class="title">¡Hola!</h1>
                @auth <h2>¡Bienvenido de vuelta, {{ Auth::user() -> name }}!</h2>
                @endauth
                <h3> Haz click en el botón <b><i class="fas fa-cloud-meatball"></i> Aplicación</b> en la parte superior izquierda para comenzar. </h3>
            </div>
        </div>
    </div>
@endsection
