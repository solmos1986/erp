@extends('layouts.admin')
@push('css')
    <!-- Bootstrap css -->
    <link href="{{ asset('/libs/bootstrap-table/bootstrap-table.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />
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
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="#">ERP</a></li>
                        <li class="breadcrumb-item"><a href="#">Comercial</a></li>
                        <li class="breadcrumb-item active">Compras</li>
                    </ol>
                </div>
                <h4 class="page-title">Orden compra</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12">

        </div>
        <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12">

        </div>
        <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12">
            <a class="w-100" href="{{ url('comercial/compra/create') }}"><button type="button" id="serchbtn"
                    class="btn btn-sm btn-success waves-effect waves-light mb-2 me-2 w-100"><i
                        class="mdi mdi-plus me-1"></i>
                    Nueva Compra </button></a>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-xl-2 col-lg-3 col-md-12 col-sm-12">
                    <label class="form-label">Desde</label>
                    <input class="form-control form-control-sm" id="IngresoDesdeCompra" type="date"
                        name="IngresoDesdeCompra">
                </div>
                <div class="col-xl-2 col-lg-3 col-md-12 col-sm-12">
                    <label class="form-label">Hasta</label>
                    <input class="form-control form-control-sm" id="IngresoHastaCompra" type="date"
                        name="IngresoHastaCompra">

                </div>
                <div class="col-xl-2 col-lg-3 col-md-12 col-sm-12">
                    <label for="example-select" class="form-label">Proveedor</label>
                    <select class="filtrar form-control form-control-sm" id="idProveedor" name="idProveedor">
                        @foreach ($proveedores as $proveedor)
                            <option value="{{ $proveedor->idProveedor }}">{{ $proveedor->nomProveedor }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-xl-2 col-lg-3 col-md-12 col-sm-12">
                    <label for="example-select" class="form-label">Comprobante</label>
                    <select class="filtrar form-control form-control-sm" id="idTipoComprobante" name="idTipoComprobante">
                        @foreach ($tipo_comprobante as $tcp)
                            <option value="{{ $tcp->idTipoComprobante }}">{{ $tcp->nomTipoComprobante }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-xl-2 col-lg-3 col-md-12 col-sm-12">
                    <label for="example-select" class="form-label">Forma de Pago</label>
                    <select class="filtrar form-control form-control-sm" id="idTipoPago">
                        @foreach ($tipopago as $tp)
                            <option value="{{ $tp->idTipoPago }}">{{ $tp->nomTipoPago }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-xl-2 col-lg-3 col-md-12 col-sm-12">
                    <label for="example-select" class="form-label">Usuario</label>
                    <select class="filtrar form-control form-control-sm" id="idUsuario">
                        @foreach ($usuario as $user)
                            <option value="{{ $user->idUsuario }}">{{ $user->nomUsuario }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div> <!-- end card -->
    <div class="card">
        <div class="card-body">
            <table id="dtEgresos" class="dtEgresos table dt-responsive nowrap w-100">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Fecha</th>
                        <th>Proveedor</th>
                        <th>Comprobante</th>
                        <th>Impuestos</th>
                        <th>Metodo Pago</th>
                        <th>Total</th>
                        <th>Usuario</th>
                        <th>Estado</th>
                        <th>Accion</th>
                    </tr>
                </thead>
                <tbody>


                </tbody>
            </table>

        </div>
    </div>

    <x-components.modal size="modal-lg" id="modal_pdf" nameBtnSave="Guardar" nameBtnClose="Cancelar" idBtnSave="btn_save">
        @include('commom.pdf-imprimir')
    </x-components.modal>
@endsection

@push('javascript')
    <script src="{{ asset('/libs/bootstrap-table/bootstrap-table.min.js') }}"></script>
    <script src="{{ asset('/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('/libs/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('/libs/printjs/print.min.js') }}"></script>

    <script src="{{ asset('/js/egresos/index.js') }}"></script>
    <script src="{{ asset('/js/egresos/modal-imprimir.js') }}"></script>
@endpush
