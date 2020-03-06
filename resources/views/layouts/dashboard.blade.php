@extends('layouts.app')
@section('body')
    <div class="wrapper">
        <div class="sidebar" data-color="purple" data-background-color="black" data-image="{{ asset('img/sidebar.jpg') }}">
            <div class="logo">
                <a href="{{ route('home') }}" class="simple-text logo-mini">
                    <i class="fas fa-calendar-exclamation"></i>
                </a>
                <a href="{{ route('home') }}" class="simple-text logo-normal">
                    Futureal
                </a>
            </div>
            <div class="sidebar-wrapper">
                <div class="user">
                    <div class="photo">
                        <img src="{{ asset('img/default-avatar.png') }}" alt="Imágen de perfil" />
                    </div>
                    <div class="user-info">
                        <a data-toggle="collapse" href="#user-collapse" class="username">
                          <span>
                            {{ Auth::user() -> name }}
                            <b class="caret"></b>
                          </span>
                        </a>
                        <div class="collapse" id="user-collapse">
                            <ul class="nav">
                                <li class="nav-item">
                                    <a class="nav-link" href="#">
                                        <span class="sidebar-mini"> <i class="fas fa-user-cog"></i> </span>
                                        <span class="sidebar-normal"> Mi cuenta </span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <span class="sidebar-mini"> <i class="fas fa-sign-out-alt"></i> </span>
                                        <span class="sidebar-normal"> Cerrar sesión </span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <ul class="nav">
                    <li class="nav-item @if($active == 'home') active @endif">
                        <a class="nav-link" href="{{ route('home') }}">
                            <i class="fas fa-home-heart"></i>
                            <p> Inicio </p>
                        </a>
                    </li>
                    <li class="nav-item @if($active == 'buildings') active @endif">
                        <a class="nav-link" href="{{ route('buildings.index') }}">
                            <i class="fas fa-building"></i>
                            <p> Mis edificios </p>
                        </a>
                    </li>
                    <li class="nav-item @if($active == 'rooms') active @endif">
                        <a class="nav-link" href="{{ route('rooms.index') }}">
                            <i class="fas fa-school"></i>
                            <p> Mis salones </p>
                        </a>
                    </li>
                    <li class="nav-item @if($active == 'subjects') active @endif">
                        <a class="nav-link" href="{{ route('subjects.index') }}">
                            <i class="fas fa-graduation-cap"></i>
                            <p> Mis materias </p>
                        </a>
                    </li>
                    <li class="nav-item @if($active == 'schedules') active @endif">
                        <a class="nav-link" href="{{ route('schedules.index') }}">
                            <i class="fas fa-chalkboard-teacher"></i>
                            <p> Mi agenda </p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-panel">
            <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
                <div class="container-fluid">
                    <div class="navbar-wrapper">
                        <div class="navbar-minimize">
                            <button id="minimizeSidebar" class="btn btn-just-icon btn-white btn-fab btn-round" style="padding-top: 1px">
                                <i class="fal fa-ellipsis-v text_align-center visible-on-sidebar-regular"></i>
                                <i class="fal fa-list design_bullet-list-67 visible-on-sidebar-mini"></i>
                            </button>
                        </div>
                        <a class="navbar-brand" href="@yield('nav-link')"> @yield('title') </a>
                    </div>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="navbar-toggler-icon icon-bar"></span>
                        <span class="navbar-toggler-icon icon-bar"></span>
                        <span class="navbar-toggler-icon icon-bar"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <button class="btn btn-link nav-link" data-toggle="modal" data-target="#support-modal">
                                    <i class="fas fa-life-ring" style="font-size: large"></i>
                                    <p class="d-lg-none d-md-block">
                                        Soporte Técnico
                                    </p>
                                </button>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link" href="javascript:;" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-user" style="font-size: large"></i>
                                    <p class="d-lg-none d-md-block">
                                        Mi cuenta
                                    </p>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                                    <a class="dropdown-item" href="#">
                                        Configuración de cuenta
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        Cerrar sesión
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="content">
                @yield('content')
            </div>
        </div>
    </div>
    <div class="modal fade" id="support-modal" tabindex="-1" role="dialog" aria-labelledby="support-modal-label" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="support-modal-label">
                        ¿Necesitas ayuda?
                    </h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body justify-content-center text-center align-content-center">
                    <h5> Contáctame por los siguientes medios: </h5>
                    <div class="container">
                        <h3>
                            <a class="text-success" href="https://api.whatsapp.com/send?phone=+573023923950" target="_blank">
                                <i class="fab fa-whatsapp"></i> &nbsp; +57 302 392 3950
                            </a>
                        </h3>
                        <h3>
                            <a class="text-info" href="https://t.me/DavidSGarcia" target="_blank">
                                <i class="fab fa-telegram"></i> &nbsp; @DavidSGarcia
                            </a>
                        </h3>
                        <h3>
                            <a class="text-danger" href="mailto::azael@dragonspark.tech" target="_blank">
                                <i class="fas fa-envelope"></i> &nbsp; azael@dragonspark.tech
                            </a>
                        </h3>
                    </div>
                    <br/>
                    <h5> <i>Responderé lo más pronto posible.</i> </h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Cerrar
                    </button>
                </div>
            </div>
        </div>
    </div>
    @yield('modals')
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
@endsection
@section('body-scripts')
    <script>
        $(document).ready(function() {
            $().ready(function() {
                $sidebar = $('.sidebar');
                $sidebar_img_container = $sidebar.find('.sidebar-background');
                $full_page = $('.full-page');
                $sidebar_responsive = $('body > .navbar-collapse');
                window_width = $(window).width();
                fixed_plugin_open = $('.sidebar .sidebar-wrapper .nav li.active a p').html();
                if (window_width > 767 && fixed_plugin_open == 'Dashboard') {
                    if ($('.fixed-plugin .dropdown').hasClass('show-dropdown')) {
                        $('.fixed-plugin .dropdown').addClass('open');
                    }
                }
                $('.fixed-plugin a').click(function(event) {
                    if ($(this).hasClass('switch-trigger')) {
                        if (event.stopPropagation) {
                            event.stopPropagation();
                        } else if (window.event) {
                            window.event.cancelBubble = true;
                        }
                    }
                });
                $('.fixed-plugin .active-color span').click(function() {
                    $full_page_background = $('.full-page-background');
                    $(this).siblings().removeClass('active');
                    $(this).addClass('active');
                    var new_color = $(this).data('color');

                    if ($sidebar.length != 0) {
                        $sidebar.attr('data-color', new_color);
                    }
                    if ($full_page.length != 0) {
                        $full_page.attr('filter-color', new_color);
                    }
                    if ($sidebar_responsive.length != 0) {
                        $sidebar_responsive.attr('data-color', new_color);
                    }
                });
                $('.fixed-plugin .background-color .badge').click(function() {
                    $(this).siblings().removeClass('active');
                    $(this).addClass('active');
                    var new_color = $(this).data('background-color');
                    if ($sidebar.length != 0) {
                        $sidebar.attr('data-background-color', new_color);
                    }
                });
                $('.fixed-plugin .img-holder').click(function() {
                    $full_page_background = $('.full-page-background');

                    $(this).parent('li').siblings().removeClass('active');
                    $(this).parent('li').addClass('active');
                    var new_image = $(this).find("img").attr('src');
                    if ($sidebar_img_container.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
                        $sidebar_img_container.fadeOut('fast', function() {
                            $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
                            $sidebar_img_container.fadeIn('fast');
                        });
                    }
                    if ($full_page_background.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
                        var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

                        $full_page_background.fadeOut('fast', function() {
                            $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
                            $full_page_background.fadeIn('fast');
                        });
                    }
                    if ($('.switch-sidebar-image input:checked').length == 0) {
                        var new_image = $('.fixed-plugin li.active .img-holder').find("img").attr('src');
                        var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

                        $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
                        $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
                    }
                    if ($sidebar_responsive.length != 0) {
                        $sidebar_responsive.css('background-image', 'url("' + new_image + '")');
                    }
                });
                $('.switch-sidebar-image input').change(function() {
                    $full_page_background = $('.full-page-background');
                    $input = $(this);
                    if ($input.is(':checked')) {
                        if ($sidebar_img_container.length != 0) {
                            $sidebar_img_container.fadeIn('fast');
                            $sidebar.attr('data-image', '#');
                        }
                        if ($full_page_background.length != 0) {
                            $full_page_background.fadeIn('fast');
                            $full_page.attr('data-image', '#');
                        }
                        background_image = true;
                    } else {
                        if ($sidebar_img_container.length != 0) {
                            $sidebar.removeAttr('data-image');
                            $sidebar_img_container.fadeOut('fast');
                        }
                        if ($full_page_background.length != 0) {
                            $full_page.removeAttr('data-image', '#');
                            $full_page_background.fadeOut('fast');
                        }
                        background_image = false;
                    }
                });
                $('.switch-sidebar-mini input').change(function() {
                    $body = $('body');
                    $input = $(this);
                    if (md.misc.sidebar_mini_active == true) {
                        $('body').removeClass('sidebar-mini');
                        md.misc.sidebar_mini_active = false;
                        $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar();
                    } else {
                        $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar('destroy');
                        setTimeout(function() {
                            $('body').addClass('sidebar-mini');
                            md.misc.sidebar_mini_active = true;
                        }, 300);
                    }
                    var simulateWindowResize = setInterval(function() {
                        window.dispatchEvent(new Event('resize'));
                    }, 180);
                    setTimeout(function() {
                        clearInterval(simulateWindowResize);
                    }, 1000);
                });
            });
        });
    </script>
    @yield('scripts')
@endsection
