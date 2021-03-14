<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <meta name="csrf-token" value="{{ csrf_token() }}">
        <title>Admin</title>
        <link href="{{ asset('admin/css/app.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <link rel="stylesheet" href="{{ asset('admin/lte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('admin/lte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">  
        <link rel="stylesheet" href="{{ asset('admin/lte/plugins/fontawesome-free/css/all.min.css') }}">
        <link rel="stylesheet" href="{{ asset('admin/lte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
        <link rel="stylesheet" href="{{ asset('admin/lte/dist/css/adminlte.min.cs') }}s">
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    </head>
    <body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
        <div id="app">
            <mainapp></mainapp>
        </div>

        <script src="{{ asset('admin/js/app.js') }}"></script>
        <script src="{{ asset('admin/lte/plugins/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('admin/lte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('admin/lte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
        <script src="{{ asset('admin/lte/dist/js/adminlte.min.js') }}"></script>
        <script src="{{ asset('admin/lte/dist/js/demo.js') }}"></script>
        <script src="{{ asset('admin/lte/plugins/jquery-mousewheel/jquery.mousewheel.js') }}"></script>
        <script src="{{ asset('admin/lte/plugins/raphael/raphael.min.js') }}"></script>
        <script src="{{ asset('admin/lte/plugins/jquery-mapael/jquery.mapael.min.js') }}"></script>
        <script src="{{ asset('admin/lte/plugins/jquery-mapael/maps/usa_states.min.js') }}"></script>
        <script src="{{ asset('admin/lte/plugins/chart.js/Chart.min.js') }}"></script>
        <script src="{{ asset('admin/lte/dist/js/pages/dashboard2.js') }}"></script>    
        <script src="{{ asset('admin/lte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('admin/lte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('admin/lte/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
        <script src="{{ asset('admin/lte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    </body>
</html>