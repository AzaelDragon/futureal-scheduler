@extends('layouts.app')
@section('body')
    <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top text-white">
        <div class="container">
            <div class="navbar-wrapper">
                <a class="navbar-brand" href="{{ route('welcome') }}">
                    <i class="fas fa-calendar-exclamation"></i>&nbsp;
                    @yield('title')
                </a>
            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                <span class="sr-only"> Alternar navegación </span>
                <span class="navbar-toggler-icon icon-bar"></span>
                <span class="navbar-toggler-icon icon-bar"></span>
                <span class="navbar-toggler-icon icon-bar"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="{{ route('home') }}" class="nav-link">
                            <i class="fas fa-cloud-meatball"></i>
                            Aplicación
                        </a>
                    </li>
                    @auth
                        <li class="nav-item ">
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link">
                                <i class="fas fa-sign-out-alt"></i>
                                Cerrar sesión
                            </a>
                        </li>
                    @else
                        <li class="nav-item ">
                            <a href="{{ route('login') }}" class="nav-link">
                                <i class="fas fa-fingerprint"></i>
                                Iniciar sesión
                            </a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>
    <div class="wrapper wrapper-full-page">
        <div class="@yield('header-class')" filter-color="@yield('filter-color')" style="background-image: url('@yield('header-image')'); background-size: cover; background-position: top center;">
            @yield('content')
            <footer class="footer">
                <div class="container">
                    <nav class="float-left">
                        <ul>
                            <li>
                                <a href="{{ route('welcome') }}">
                                    <i class="fas fa-calendar-exclamation"></i>&nbsp;
                                    Futureal
                                </a>
                            </li>
                        </ul>
                    </nav>
                    <div class="copyright float-right">
                        &copy;
                        <script>
                            document.write(new Date().getFullYear().toString())
                        </script>, Hecho con <i class="text-danger fas fa-heart faa-pulse animated"></i> por
                        <a class="text-success" href="https://github.com/AzaelDragon" target="_blank"> David S. García</a> para Guillermo Rojas.
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
@endsection
@section('body-scripts')
    @yield('scripts')
@endsection
