@extends('layouts.admin')
@push('css')
    <!-- third party css -->
    <link href="{{ asset('/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/libs/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('/libs/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('/libs/datatables.net-select-bs5/css//select.bootstrap5.min.css') }}" rel="stylesheet"
        type="text/css" />
@endpush

@section('contenido')
    <div class="row">

        <div class="col-lg-6">
            <div class="card mt-3 mb-3">
                <div class="row g-0">
                    <div class="col-md-12">
                        <div class="card-body">
                            @include('almacen.configurar.EstadoPedido')
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card mt-3 mb-3">
                <div class="row g-0">
                    <div class="col-md-12">
                        <div class="card-body">
                            @include('almacen.configurar.FormaPago')
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="card mt-3 mb-3">
                <div class="row g-0">
                    <div class="col-md-12">
                        <div class="card-body">
                            @include('almacen.configurar.TipoComprobante')
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card mt-3 mb-3">
                <div class="row g-0">
                    <div class="col-md-12">
                        <div class="card-body">
                            @include('almacen.configurar.Marcas')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('javascript')
    <script src="{{ asset('/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js') }}"></script>

    <script src="{{ asset('/js/configuracion/estado_pedidos.js') }}"></script>
    <script src="{{ asset('/js/configuracion/formas_pago.js') }}"></script>
    <script src="{{ asset('/js/configuracion/tipo_comprobante.js') }}"></script>
    <script src="{{ asset('/js/configuracion/marcas.js') }}"></script>
    <!-- Bootstrap Tables js -->
@endpush
