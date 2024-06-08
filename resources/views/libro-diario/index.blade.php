@extends('layouts.admin')
@push('css')
    <link href="{{ asset('/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/libs/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('/libs/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('/libs/datatables.net-select-bs5/css//select.bootstrap5.min.css') }}" rel="stylesheet"
        type="text/css" />

    <link href="{{ asset('/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />
    <style>
        .descripcion {
            overflow: hidden;
            white-space: wrap;
            text-overflow: ellipsis
        }
    </style>
@endpush

@section('contenido')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="#">Contabilidad</a></li>
                        <li class="breadcrumb-item"><a href="#">Cuenta</a></li>
                        <li class="breadcrumb-item active">Libro diario</li>
                    </ol>
                </div>
                <h4 class="page-title">Libro diario</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-xl-2 col-lg-3 col-md-12 col-sm-12">
                    <label class="form-label">Desde</label>
                    <input class="form-control form-control-sm" id="MovimientoDesde" type="date" name="MovimientoDesde">
                </div>
                <div class="col-xl-2 col-lg-3 col-md-12 col-sm-12">
                    <label class="form-label">Hasta</label>
                    <input class="form-control form-control-sm" id="MovimientoHasta" type="date" name="MovimientoHasta">
                </div>
               {{--  <div class="col-xl-2 col-lg-3 col-md-12 col-sm-12">
                    <label for="idTipoMovimiento" class="form-label">Tipo Movimiento</label>
                    <select class="form-select form-select-sm form-control form-control-sm" id="idTipoMovimiento"
                        name="idTipoMovimiento">
                        @foreach ($tipo_movimientos as $tipo_movimiento)
                            <option value="{{ $tipo_movimiento->idTipoMovimiento }}">{{ $tipo_movimiento->nomMovimiento }}
                            </option>
                        @endforeach
                    </select>
                </div> --}}
                <div class="col-xl-2 col-lg-3 col-md-12 col-sm-12">
                    <label class="form-label">&nbsp;</label>
                    <button type="button" id="btn"
                        class="todo_movimientos btn btn-sm btn-primary waves-effect waves-light w-100">
                        <i class="mdi mdi-plus-circle me-1"></i>Todos los asientos</button>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <h4 class="header-title">Detalle del Asiento</h4>
            <p class="sub-header">
            </p>
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="border p-3 rounded">
                        <div class="row">
                            <input id="idMovimiento" name="idMovimiento" disabled hidden
                                value="{{ $ultimo_movimiento->ultimo == null ? '0' : $ultimo_movimiento->ultimo }}">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-1">
                                <label for="razon_social" class="form-label">Razon social</label>
                                <input class="form-control form-control-sm" id="razon_social" name="razon_social" disabled>
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 mb-1">
                                <label for="razon_social" class="form-label">Comprabante</label>
                                <input class="form-control form-control-sm" id="numComprobante" name="numComprobante"
                                    disabled>
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 mb-1">
                                <label for="razon_social" class="form-label">Tipo movmiento</label>
                                <input class="form-control form-control-sm" id="nomMovimiento" name="nomMovimiento"
                                    disabled>
                            </div>
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-1">
                                <label for="descripcion" class="form-label">Glosa</label>
                                <textarea class="form-control form-control-sm" id="descripcion" name="descripcion" rows="3" disabled></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mt-2">
                    <div class="border p-3 rounded">
                        <div class="table-responsive">
                            <table id="dataTableMovimiento" class="table  nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>Codigo</th>
                                        <th>Razon social</th>
                                        <th>Glosa</th>
                                        <th>Debe</th>
                                        <th>Haber</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-components.modal size="modal-md" id="modal_descripcion" nameBtnSave="Guardar" nameBtnClose="Cancelar"
        idBtnSave="btn_descripcion">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mt-2">
                <textarea class="form-control" name="descripcion" id="descripcion" cols="5" rows="5" disabled>

                </textarea>
            </div>
        </div>
    </x-components.modal>
    <x-components.modal size="modal-xl" id="modal_table_libro_diario" nameBtnSave="Guardar" nameBtnClose="Cancelar"
        idBtnSave="btn_save">
        @include('libro-diario.components.table-libro-diario')
    </x-components.modal>
@endsection

@push('javascript')
    <script src="{{ asset('/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('/libs/select2/js/select2.min.js') }}"></script>

    <script src="{{ asset('/js/libro-diario/index.js') }}"></script>
    <script src="{{ asset('/js/libro-diario/modal-historial.js') }}"></script>
@endpush
