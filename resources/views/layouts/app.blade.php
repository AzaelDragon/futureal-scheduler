<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
        <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('apple-touch-icon.png') }}" />
        <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}" />
        <link rel="stylesheet" href="{{ asset('css/roboto.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/all.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/all-anim.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/material-dashboard.min.css') }}" />
        <title> Futureal - @yield('title') </title>
    </head>
    <body class="@yield('body-class')">
        @yield('body')
        <script src="{{ asset('js/core/jquery.min.js')}}" type="text/javascript"></script>
        <script src="{{ asset('js/core/popper.min.js')}}" type="text/javascript"></script>
        <script src="{{ asset('js/core/bootstrap-material-design.min.js')}}" type="text/javascript"></script>
        <script src="{{ asset('js/plugins/perfect-scrollbar.jquery.min.js')}}" type="text/javascript"></script>
        <script src="{{ asset('js/plugins/moment.min.js')}}" type="text/javascript"></script>
        <script src="{{ asset('js/plugins/sweetalert2.js')}}" type="text/javascript"></script>
        <script src="{{ asset('js/plugins/jquery.validate.min.js')}}" type="text/javascript"></script>
        <script src="{{ asset('js/plugins/jquery.bootstrap-wizard.js')}}" type="text/javascript"></script>
        <script src="{{ asset('js/plugins/bootstrap-selectpicker.js')}}" type="text/javascript"></script>
        <script src="{{ asset('js/plugins/bootstrap-datetimepicker.min.js')}}" type="text/javascript"></script>
        <script src="{{ asset('js/plugins/jquery.dataTables.min.js')}}" type="text/javascript"></script>
        <script src="{{ asset('js/plugins/bootstrap-tagsinput.js')}}" type="text/javascript"></script>
        <script src="{{ asset('js/plugins/jasny-bootstrap.min.js')}}" type="text/javascript"></script>
        <script src="{{ asset('js/plugins/fullcalendar.min.js')}}" type="text/javascript"></script>
        <script src="{{ asset('js/plugins/jquery-jvectormap.js')}}" type="text/javascript"></script>
        <script src="{{ asset('js/plugins/nouislider.min.js')}}" type="text/javascript"></script>
        <script src="{{ asset('js/plugins/core.js')}}" type="text/javascript"></script>
        <script src="{{ asset('js/plugins/arrive.min.js')}}" type="text/javascript"></script>
        <script src="{{ asset('js/plugins/chartist.min.js')}}" type="text/javascript"></script>
        <script src="{{ asset('js/plugins/bootstrap-notify.js')}}" type="text/javascript"></script>
        <script src="{{ asset('js/material-dashboard.js?v=2.1.1') }}" type="text/javascript"></script>
    </body>
</html>
