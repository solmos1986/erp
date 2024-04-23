@extends('layouts.admin')
@push('css')
    <!-- third party css -->
    <link href="{{ asset('/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/libs/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('/libs/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('/libs/datatables.net-select-bs5/css//select.bootstrap5.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('/libs/printjs/print.min.css') }}" rel="stylesheet" type="text/css">
    {{-- <link href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" /> --}}
@endpush

@section('contenido')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Gest Compra</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Compras</a></li>
                        <li class="breadcrumb-item active">Producto almacen</li>
                    </ol>
                </div>
                <h4 class="page-title">Producto almacen</h4>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="border p-3 mt-lg-2 rounded">
                        <div class="row">
                            <div class="col-xl-2 col-lg-4 col-md-4 col-sm-12 mb-2">
                                <h4 class="font-13 text-muted text-uppercase mb-1">Orden compra:</h4>
                                <p class="mb-3">{{ $egreso->idEgreso }}</p>
                            </div>
                            <div class="col-xl-2 col-lg-4 col-md-4 col-sm-12 mb-2">
                                <h4 class="font-13 text-muted text-uppercase mb-1">Comprobante :</h4>
                                <p class="mb-3">{{ $egreso->numeroComprobante }}</p>
                            </div>
                            <div class="col-xl-2 col-lg-4 col-md-4 col-sm-12 mb-2">
                                <h4 class="font-13 text-muted text-uppercase mb-1">Fecha registro :</h4>
                                <p class="mb-3">{{ $egreso->create_at }}</p>
                            </div>
                            <div class="col-xl-2 col-lg-4 col-md-4 col-sm-12 mb-2">
                                <h4 class="font-13 text-muted text-uppercase mb-1">Proveedor :</h4>
                                <p class="mb-3">{{ $egreso->nomProveedor }}</p>
                            </div>
                            <div class="col-xl-2 col-lg-4 col-md-4 col-sm-12 mb-2">
                                <h4 class="font-13 text-muted text-uppercase mb-1">Monto Total Bs:</h4>
                                <p class="mb-3">{{ $egreso->monto_total }} </p>
                            </div>
                            <div class="col-xl-2 col-lg-4 col-md-4 col-sm-12 mb-2">
                                <h4 class="font-13 text-muted text-uppercase mb-1">Usuario :</h4>
                                <p class="mb-3">{{ $egreso->nomUsuario }}</p>
                            </div>
                        </div>
                    </div>
                    <br>
                </div>
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="border p-3 mt-lg-2 rounded">
                        <div class="row">
                            <div class="col-xl-3 col-lg-3 col-md-4 col-sm-12 mb-2">
                                <h4 class="font-13 text-muted text-uppercase mb-1">fecha vencimiento para todos:</h4>
                                <input class="fecha_vencimiento_all form-control form-control-sm" type="date">
                            </div>
                        </div>
                    </div>
                    <br>
                </div>
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="border p-3 mt-lg-2 rounded">
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                <div></div>
                                <table id="data_table_entrada" class="table dt-responsive nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th width="20">Codigo barra</th>
                                            <th width="30">Producto</th>
                                            <th width="10">Fecha vencimiento</th>
                                            <th width="30">Almacen</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <br>
                    <div class="text-center mb-3">
                        <a href="{{ url('comercial/compra') }}"><button type="button"
                                class="btn btn-sm btn-light waves-effect">Cancelar</button></a>
                        <button type="button"
                            class="procesar btn btn-sm btn-primary waves-effect waves-light store">Guardar</button>
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
    <script src="{{ asset('/libs/dropzone/min/dropzone.min.js') }}"></script>
    <script src="{{ asset('/libs/select2/js/select2.min.js') }}"></script>
    <script>
        const idEgreso = '{{ $egreso->idEgreso }}'
    </script>
    <script src="{{ asset('/js/entrada-producto/create.js') }}"></script>
@endpush
