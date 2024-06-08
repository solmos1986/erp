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
    <link href="{{ asset('/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/libs/selectize/css/selectize.bootstrap3.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />
@endpush

@section('contenido')
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="#">ERP</a></li>
                                <li class="breadcrumb-item"><a href="#">Comercial</a></li>
                                <li class="breadcrumb-item active">Inscripciones</li>
                            </ol>
                        </div>
                        <h4 class="page-title">INSCRIPCIONES</h4>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-4 col-lg-3 col-md-12 col-sm-12">
                </div>
                <div class="col-xl-4 col-lg-3 col-md-12 col-sm-12">
                </div>
                <div class="col-xl-2 col-lg-3 col-md-12 col-sm-12">
                    <div class="d-flex justify-content-end mb-2">
                        <button type="button" id="limpiar_equipos"
                            class="btn btn-sm btn-danger waves-effect waves-light w-100">
                            Limpiar dispositivos </button>
                        
                    </div>
                </div>
                <div class="col-xl-2 col-lg-3 col-md-12 col-sm-12">
                    <div class="d-flex justify-content-end mb-2">
                        <a class="w-100" href="{{ url('comercial/inscripcion/create') }}"><button type="button" id="serchbtn"
                                class="btn btn-sm btn-primary waves-effect waves-light w-100"><i class="mdi mdi-plus me-1"></i>
                                Nueva Inscripcion </button></a>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row ">
                        <div class="col-xl-2 col-lg-2 col-md-6 col-sm-12 mb-1">
                            <label class="form-label">Desde</label>
                            <input class="filtrar form-control form-control-sm" id="IngresoDesdeIns" type="date"
                                name="date" value="{{ date('Y-m-d') }}">
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-6 col-sm-12 mb-1">
                            <label class="form-label">Hasta</label>
                            <input class="filtrar form-control form-control-sm" id="IngresoHastaIns" type="date"
                                name="date" value="{{ date('Y-m-d') }}">

                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-6 col-sm-12 mb-1">
                            <label for="example-select" class="form-label">Cliente</label>
                            <select class="filtrar form-control form-control-sm" id="idClienteIns">

                            </select>
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-6 col-sm-12 mb-1">
                            <label for="example-select" class="form-label">Comprobante</label>
                            <select class="filtrar form-control form-control-sm form-select-sm form-select" id="idTipoComprobanteIns">
                                @foreach ($tipo_comprobante as $tcp)
                                    <option value="{{ $tcp->idTipoComprobante }}">{{ $tcp->nomTipoComprobante }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-6 col-sm-12 mb-1">
                            <label for="example-select" class="form-label">Metodo de Pago</label>
                            <select class="filtrar form-control form-control-sm form-select-sm form-select" name="idMetodoPago" id="idMetodoPago">
                                @foreach ($metodo_pago as $mp)
                                    <option value="{{ $mp->idMetodoPago }}">{{ $mp->nomMetodoPago }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-6 col-sm-12 mb-1">
                            <label for="example-select" class="form-label">Usuario</label>
                            <select class="filtrar form-control form-control-sm form-select-sm form-select" id="idUsuarioIns">
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
                    <table id="dtInscripciones" class="dtInscripciones table dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Fecha</th>
                                <th>Cliente</th>
                                <th>Comprobante</th>
                                <th>Metodo Pago</th>
                                <th>Total</th>
                                <th>Usuario</th>
                                <th>Fecha inicio/fin</th>
                                <th>Estado</th>
                                <th>Accion</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
    <x-components.modal size="modal-xl" id="modalImprimir" nameBtnSave="Imprimir" nameBtnClose="Cancelar"
        idBtnSave="btn_save">
        @include('commom.pdf-imprimir')
    </x-components.modal>
@endsection

@push('javascript')
    <script src="{{ asset('/libs/bootstrap-table/bootstrap-table.min.js') }}"></script>
    <script src="{{ asset('/libs/jquery-mockjax/jquery.mockjax.min.js') }}"></script>

    <!-- Init js -->
    <script src="{{ asset('/js/pages/bootstrap-tables.init.js') }}"></script>
    <script src="{{ asset('/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js') }}"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script src="{{ asset('/libs/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('/js/inscripcion/index.js') }}"></script>
@endpush
