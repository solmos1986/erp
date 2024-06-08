<!DOCTYPE html>
<html lang="es" data-topbar-color="dark">

<head>
    <meta charset="utf-8" />
    <title>Dashboard | Ubold - Responsive Bootstrap 5 Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('/images/favicon.ico') }}">
    <!-- Plugins css -->
    <link href="{{ asset('/libs/jquery-toast-plugin/jquery.toast.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/libs/printjs/print.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/libs/flatpickr/flatpickr.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/libs/dropify/css/dropify.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/libs/selectize/css/selectize.bootstrap3.css') }}" rel="stylesheet" type="text/css" />
    @stack('css')
    <!-- Theme Config Js -->
    <script src="{{ asset('/js/head.js') }}"></script>
    <!-- Bootstrap css -->
    <link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />
    <!-- App css -->
    <link href="{{ asset('/css/app.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Icons css -->
    <link href="{{ asset('/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    @stack('css')
    <style>
        .descripcion {
            overflow: hidden;
            white-space: wrap;
            text-overflow: ellipsis
        }
    </style>
</head>

<body>
    <div id="preloader">
        <div id="status">
            <div class="spinner">Cargando...</div>
        </div>
    </div>
    <!-- Begin page -->
    <div id="wrapper">
        <!-- ========== Menu ========== -->
        <!-- ========== Left menu End ========== -->
        @component('layouts.parts.sidebar')
        @endcomponent
        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->
        <div class="content-page">
            <!-- ========== Topbar Start ========== -->
            @component('layouts.parts.nav')
            @endcomponent
            <!-- ========== Topbar End ========== -->
            <div class="content">
                <!-- Start Content-->
                <div class="container-fluid">
                    @yield('contenido')
                </div> <!-- container -->
            </div> <!-- content -->
            <!-- Footer Start -->
            @component('layouts.parts.footer')
            @endcomponent
            <!-- end Footer -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->
    </div>
    <!-- END wrapper -->
    <!-- INICIO MENU DE CONFIGURACION DE LA DERECHA -->
    <!-- Theme Settings -->
    <script type="text/javascript">
        var base_url = "{{ url('/') }}";
        var socket_url = "{{ env('ROUTE_SOCKET_IO') }}"
        var channel = "web"
        var client = {{ auth()->user()->obtener_usuario()->authenticacion_id }}
    </script>

    <!-- Vendor js -->
    <script src="{{ asset('/js/vendor.min.js') }}"></script>

    <!-- App js -->
    <script src="{{ asset('/js/app.min.js') }}"></script>
    <!-- Plugins js-->
    <script src="{{ asset('/libs/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ asset('/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('/libs/selectize/js/standalone/selectize.min.js') }}"></script>
    <script src="{{ asset('/libs/swatalert/swatalert.min.js') }}"></script>
    <script src="{{ asset('/libs/jquery-serializeJSON/jquery-serializeJSON.js') }}"></script>

    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>


    <script src="{{ asset('/libs/jquery-mockjax/jquery.mockjax.min.js') }}"></script>
    <script src="{{ asset('/libs/socket.io.min.js') }}"></script>
    <script src="{{ asset('/libs/jquery-toast-plugin/jquery.toast.min.js') }}"></script>
    <script src="{{ asset('/libs/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ asset('/libs/dropify/js/dropify.min.js') }}"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script src="{{ asset('/js/components/utils.js') }}"></script>
    <script src="{{ asset('/js/components/errors_ajax.js') }}"></script>
    <script src="{{ asset('/js/components/ajax.js') }}"></script>
    <script src="{{ asset('/js/components/swall-alerts.js') }}"></script>
    <script src="{{ asset('/js/components/buttons.js') }}"></script>
    <script src="{{ asset('/js/components/datatables.js') }}"></script>
    <script src="{{ asset('/js/components/select2.js') }}"></script>
    <script src="{{ asset('/js/components/flatpickr.js') }}"></script>
    @stack('javascript')
    {{--  <script src="{{ asset('/js/socket/socket.js') }}"></script>
    <script src="{{ asset('/js/socket/insert-inscripcion.js') }}"></script>
    <script src="{{ asset('/js/socket/limpiar-dispositivo.js') }}"></script> --}}
</body>

</html>
