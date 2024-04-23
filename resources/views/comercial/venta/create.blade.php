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
    <link href="{{ asset('/libs/dropify/css/dropify.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/libs/printjs/print.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />
@endpush

@section('contenido')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Gest. Venta</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Ventas</a></li>
                        <li class="breadcrumb-item active">Nueva venta</li>
                    </ol>
                </div>
                <h4 class="page-title">Nueva venta</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="border p-3 mt-lg-2 rounded">
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-2">
                                <div class="row bg-light p-2">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                        <h5 class="text-uppercase">Cliente</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mb-2">
                                <label for="fechaVenta" class="form-label">Fecha</label>
                                <input type="text" class="form-control form-control-sm" id="fechaVenta" name="date"
                                    placeholder="Fecha" value="<?php echo date('Y-m-d H:i:s'); ?>" readonly>
                            </div>
                            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mb-2">
                                <label for="idVendedor" class="form-label">Vendedor</label>
                                <input type="text" id="idVendedor" name="idVendedor" class="form-control form-control-sm"
                                    placeholder="" value="{{ auth()->user()->obtener_usuario()->nomUsuario }}" disabled>
                            </div>
                            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mb-2">
                                <label for="idCliente" class="form-label">Cliente</label>
                                <select class="form-control form-control-sm" id="idCliente" name="idCliente">
                                </select>
                            </div>
                            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mb-2">
                                <label for="btn" class="form-label">&nbsp </label>
                                <button type="button" id="btn"
                                    class="nuevo btn btn-sm btn-primary waves-effect waves-light w-100">
                                    <i class="mdi mdi-plus-circle me-1"></i> Agregar Cliente</button>
                            </div>
                            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mb-2">
                                <label for="docCliente" class="form-label">NIT/CI</label>
                                <select class="form-control form-control-sm" id="docCliente" name="docCliente">
                                </select>
                            </div>
                            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mb-2">
                                <label for="idTipoPago" class="form-label">Tipo Pago</label>
                                <select class="form-control form-control-sm" id="idTipoPago">
                                    @foreach ($tipopago as $tp)
                                        <option value="{{ $tp->idTipoPago }}">{{ $tp->nomTipoPago }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mb-2">
                                <label for="idTipoComprobante" class="form-label">Comprobante</label>
                                <select class="form-control form-control-sm" id="idTipoComprobante">
                                    @foreach ($tipo_comprobante as $tp)
                                        <option value="{{ $tp->impuestoComprobante }}">
                                            {{ $tp->nomTipoComprobante }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mb-2">
                                <label for="impuestoIngreso" class="form-label">Impuestos</label>
                                <input type="number" class="form-control form-control-sm" id="impuestoIngreso"
                                    placeholder="% impuesto" value="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="border p-3 mt-lg-2 rounded">
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-2">
                                <div class="row bg-light p-2 mt-0 mb-3">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-6">
                                        <h5 class="text-uppercase">Detalle venta</h5>
                                    </div>
                                </div>
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-2">
                                    <label for="impuestoIngreso" class="form-label">Buscar por code barra</label>
                                    <input type="text" class="form-control form-control-sm" id="code_barra"
                                        placeholder="Buscar por code barra">
                                </div>
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mt-2">
                                    <div class="table-responsive">
                                        <table class="dtCart table  table-nowrap table-centered" id="dtCart">
                                            <thead>
                                                <tr>
                                                    <th style="max-width: 35%; overflow: hidden; word-break: break-all;">
                                                        Producto</th>
                                                    <th style="max-width: 20%; overflow: hidden; word-break: break-all;">
                                                        Cant.</th>
                                                    <th style="max-width: 20%; overflow: hidden; word-break: break-all;">
                                                        Precio</th>
                                                    <th style="max-width: 20%; overflow: hidden; word-break: break-all;">
                                                        Total</th>
                                                    <th style="max-width: 5%; overflow: hidden; word-break: break-all;">
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody id="dtVE">

                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th></th>
                                                    <th></th>
                                                    <th><b>Total.</b>
                                                    </th>
                                                    <th id="TotalCart"></th>
                                                    <th></th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mt-2">
                    <div class="text-center mb-3">
                        <a href="{{ url('comercial/compra') }}">
                            <button type="button" class="btn btn-sm btn-light waves-effect">Cancelar</button>
                        </a>
                        <button type="button"
                            class="procesar btn btn-sm btn-primary waves-effect waves-light procesar">Guardar</button>
                    </div>
                </div>
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="border p-3 mt-lg-2 rounded">
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                <div class="row bg-light p-2 mt-0 mb-3">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-6">
                                        <h5 class="text-uppercase">Productos</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <label for="docCliente1" class="form-label">Buscar</label>
                                <input type="select" class="form-control form-control-sm" placeholder="Buscar">
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <label for="docCliente1" class="form-label">Ordenar por precio</label>
                                <input type="select" class="form-control form-control-sm"
                                    placeholder="Ordenar por precio">
                            </div>
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12" id="loader_producto">
                                <div class="d-flex justify-content-center p-5">
                                    <div class="spinner-border avatar-lg text-primary m-2" role="status"></div>
                                </div>
                            </div>
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                <div class="row justify-content-center pt-2" id="list_cards">

                                </div>
                            </div>
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12" id="paginate_producto">
                                <ul class="pagination pagination-rounded justify-content-end mb-3">
                                    <li class="page-item">
                                        <a class="page-link" href="javascript: void(0);" aria-label="Previous">
                                            <span aria-hidden="true">«</span>
                                            <span class="visually-hidden">Previous</span>
                                        </a>
                                    </li>
                                    <li class="page-item active"><a class="page-link" href="javascript: void(0);">1</a>
                                    </li>
                                    <li class="page-item"><a class="page-link" href="javascript: void(0);">2</a></li>
                                    <li class="page-item"><a class="page-link" href="javascript: void(0);">3</a></li>
                                    <li class="page-item"><a class="page-link" href="javascript: void(0);">4</a></li>
                                    <li class="page-item"><a class="page-link" href="javascript: void(0);">5</a></li>
                                    <li class="page-item">
                                        <a class="page-link" href="javascript: void(0);" aria-label="Next">
                                            <span aria-hidden="true">»</span>
                                            <span class="visually-hidden">Next</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-components.modal size="modal-xl" id="modal_cliente" nameBtnSave="Guardar" nameBtnClose="Cancelar"
        idBtnSave="btn_save">
        @include('comercial.cliente.components.form-cliente-inscripcion')
    </x-components.modal>
    @include('commom.pdf-imprimir')
@endsection

@push('javascript')
    <script src="{{ asset('/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('/libs/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('/libs/printjs/print.min.js') }}"></script>
    <script src="{{ asset('/libs/webcam-easy/webcam-easy.min.js') }}"></script>
    <script src="{{ asset('/libs/dropify/js/dropify.min.js') }}"></script>

    <script src="{{ asset('/js/ingresos/create.js') }}"></script>
    <script src="{{ asset('/js/cliente/modal.js') }}"></script>
    <script src="{{ asset('/js/cliente/foto.js') }}"></script>
    <style>
        .texto {
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
            overflow: hidden;
            /* margin: 1rem; */
        }
    </style>
@endpush
