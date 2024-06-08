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
    <link href="{{ asset('/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />
    <link href="{{ asset('/libs/printjs/print.min.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('contenido')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="#">ERP</a></li>
                        <li class="breadcrumb-item"><a href="#">Comercial</a></li>
                        <li class="breadcrumb-item active">Ventas</li>
                    </ol>
                </div>
                <h4 class="page-title">Ventas</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12">

        </div>
        <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12">

        </div>
        <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12">
            <div class="text-lg-end">
                <a href="{{ url('comercial/venta/create') }}"><button type="button" id="serchbtn"
                        class="btn btn-sm btn-primary waves-effect waves-light mb-2 me-2"><i class="mdi mdi-plus me-1"></i>
                        Nueva Venta </button></a>

            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12">
                    <label class="form-label">Desde</label>
                    <input class="form-control form-control-sm" id="IngresoDesde" type="date" name="IngresoDesde">
                </div>
                <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12">
                    <label class="form-label">Hasta</label>
                    <input class="form-control form-control-sm" id="IngresoHasta" type="date" name="IngresoHasta">
                </div>
                <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12">
                    <label for="idCliente" class="form-label">Cliente</label>
                    <select class="filtrar form-select form-select-sm form-control form-control-sm" id="idCliente"
                        name="idCliente">
                        {{--  @foreach ($cliente as $cli)
                            <option value="{{ $cli->idCliente }}">{{ $cli->nomCliente }}
                            </option>
                        @endforeach --}}
                    </select>
                </div>
                <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12">
                    <label for="idTipoComprobante" class="form-label">Comprobante</label>
                    <select class="filtrar form-select form-select-sm form-control form-control-sm" id="idTipoComprobante"
                        name="idTipoComprobante">
                        @foreach ($tipo_comprobante as $tcp)
                            <option value="{{ $tcp->idTipoComprobante }}">{{ $tcp->nomTipoComprobante }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12">
                    <label for="idMetodoPago" class="form-label">Forma de Pago</label>
                    <select class="filtrar form-select form-select-sm form-control form-control-sm" id="idMetodoPago"
                        name="idMetodoPago">
                        @foreach ($metodo_pago as $tp)
                            <option value="{{ $tp->idMetodoPago }}">{{ $tp->nomMetodoPago }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12">
                    <label for="idUsuario" class="form-label">Usuario</label>
                    <select class="filtrar form-select form-select-sm form-control form-control-sm" id="idUsuario"
                        name="idUsuario">
                        @foreach ($usuario as $user)
                            <option value="{{ $user->idUsuario }}">{{ $user->nomUsuario }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <table id="dtIngresos" class="dtIngresos table dt-responsive nowrap w-100">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Fecha</th>
                        <th>Cliente</th>
                        <th>Comprobante</th>
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
    <!-- Select2 js-->
    <script src="{{ asset('/libs/select2/js/select2.min.js') }}"></script>
    <!-- Dropzone file uploads-->
    <script src="{{ asset('/libs/dropzone/min/dropzone.min.js') }}"></script>¿
    <script src="{{ asset('/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('/libs/datatables.net/plug-ins/1.10.20/api/sum().js') }}"></script>
    <script src="{{ asset('/libs/printjs/print.min.js') }}"></script>
    <script src="{{ asset('/libs/select2/js/select2.min.js') }}"></script>

    <script src="{{ asset('/js/ingresos/index.js') }}"></script>
    <script src="{{ asset('/js/ingresos/modal-imprimir.js') }}"></script>
@endpush
