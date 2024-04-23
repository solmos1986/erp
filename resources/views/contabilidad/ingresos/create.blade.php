@extends('layouts.admin')
@push('css')
    <!-- third party css -->

    <link href="{{ asset('/libs/dropzone/min/dropzone.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/libs/mohithg-switchery/switchery.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/libs/multiselect/css/multi-select.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('/libs/selectize/css/selectize.bootstrap3.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('/libs/quill/quill.core.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/libs/quill/quill.snow.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('/libs/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('/libs/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('/libs/datatables.net-select-bs5/css//select.bootstrap5.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('/libs/flatpickr/flatpickr.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/libs/printjs/print.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/libs/selectize/css/selectize.bootstrap3.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css') }}" rel="stylesheet"
        type="text/css" />
    <!-- App css -->
    <link href="{{ asset('/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />
@endpush

@section('contenido')
    <!-- start page title -->
    <form action="" id="form_inscripcion">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Erp</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Contabilidad</a></li>
                            <li class="breadcrumb-item active">Ingresos</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Nuevo INGRESO</h4>
                </div>
            </div>
        </div>
        <!-- end row-->
        <div class="card shadow-0 border rounded-3">
            <div class="card-body">
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                        <div class="row mb-1">
                            <label for="fechaIngreso" class="form-label col-12 col-xl-3">Fecha</label>
                            <div class="col-12 col-xl-9">
                                <input type="text" id="fechaIngreso" name="fechaIngreso"
                                    class="form-control form-control-sm" placeholder="Date and Time"
                                    value="<?php echo date('Y-m-d H:i:s'); ?>" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                        <div class="row mb-1">
                            <label for="idUsuario" class="form-label col-12 col-xl-3">Usuario</label>
                            <div class="col-12 col-xl-9">
                                <select class="form-control form-control-sm" id="idUsuario" name="idUsuario">
                                    @foreach ($usuario as $user)
                                        <option value="{{ $user->idUsuario }}">{{ $user->nomUsuario }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                        <div class="row mb-1">
                            <label for="idCliente" class="form-label col-12 col-xl-3">Cliente</label>
                            <div class="col-12 col-xl-9">
                                <select class="form-control form-control-sm" name="idCliente" id="idCliente">
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                        <div class="row mb-1">
                            <label for="idCliente" class="form-label col-12 col-xl-3">&nbsp;</label>
                            <div class="col-12 col-xl-9">
                                <div class="col-auto">
                                    <div class="text-lg-end">
                                        <button type="button"
                                            class="nuevo btn btn-sm btn-success waves-effect waves-light w-100">
                                            <i class="mdi mdi-plus-circle me-1"></i> Agregar Cliente</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                        <div class="row mb-1">
                            <label for="docCliente" class="form-label col-12 col-xl-3">NIT/CI</label>
                            <div class="col-12 col-xl-9">
                                <select class="form-control form-control-sm" name="docCliente" id="docCliente">
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                        <div class="row mb-1">
                            <label for="idTipoPago" class="form-label col-12 col-xl-3">Tipo Pago</label>
                            <div class="col-12 col-xl-9">
                                <select class="form-control form-control-sm" name="idTipoPago" id="idTipoPago">
                                    @foreach ($tipopago as $tp)
                                        <option value="{{ $tp->idTipoPago }}">{{ $tp->nomTipoPago }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                        <div class="row mb-1">
                            <label for="idTipoComprobante" class="form-label col-12 col-xl-3">Comprobante</label>
                            <div class="col-12 col-xl-9">
                                <div class="col-12 col-xl-12">
                                    <select class="form-control form-control-sm" id="idTipoComprobante"
                                        name="idTipoComprobante">
                                        @foreach ($tipo_comprobante as $tp)
                                            <option data-value="{{ $tp->impuestoComprobante }}"
                                                value="{{ $tp->idTipoComprobante }}">
                                                {{ $tp->nomTipoComprobante }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                        <div class="row mb-1">
                            <label for="numComprobante" class="form-label col-12 col-xl-3">No. Comprobante</label>
                            <div class="col-12 col-xl-9">
                                <input type="text" class="form-control form-control-sm" name="numComprobante"
                                    id="numComprobante" placeholder="## Comprobante">
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                        <div class="row mb-1">
                            <label for="descripcion" class="form-label col-12 col-xl-3">Descripcion</label>
                            <div class="col-12 col-xl-9">
                                <input type="text" class="form-control form-control-sm" name="descripcion"
                                    id="descripcion" placeholder="descripcion">
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                        <div class="row mb-1">
                            <label for="descripcion" class="form-label col-12 col-xl-3">Monto Bs.</label>
                            <div class="col-12 col-xl-9">
                                <input type="number" class="form-control form-control-sm" name="totalIngreso"
                                    id="totalIngreso" placeholder="" value="0">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center mb-0">
            <div class="col-md-12 col-xl-12">
                <div class="card shadow-0 border rounded-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 col-lg-12 col-xl-12">
                                <div class="row  p-2 mt-0 mb-3">
                                    <div class="col-lg-6">
                                        <h5 class="text-uppercase  ">DETALLE</h5>
                                    </div>
                                    <div class="col-lg-2">

                                    </div>
                                    <div class="col-lg-4">
                                        <div class="text-lg-end mr-0">
                                            <a id="add_cuenta"><button type="button" id="serchbtn"
                                                    class="add_cuenta btn btn-success waves-effect waves-light mb-0 me-0 mr-1"><i
                                                        class="mdi mdi-plus me-1"></i>
                                                    Agregar Cuenta</button></a>
                                        </div>
                                    </div>

                                </div>

                                <div class="table-responsive">
                                    <table class="dtCart table  table-nowrap table-centered mb-0" id="dtCart"
                                        style="min-block-size: ">
                                        <thead class="table-light">
                                            <tr>
                                                <th>idCuenta</th>
                                                <th>Cod.Cuenta</th>
                                                <th>Cuenta</th>
                                                <th>Debe</th>
                                                <th>Haber</th>
                                            </tr>
                                        </thead>
                                        <tbody id="dtVE">
                                            <tr>
                                                <td>
                                                    <select class="form-control form-control-sm" id="idPaquete"
                                                        name="idPaquete[]">
                                                        @foreach ($paquetes as $key => $pq)
                                                            <option data-id="{{ $pq->idPaquete }}"
                                                                value="{{ $pq->idPaquete }}"
                                                                data-duracion="{{ $pq->duracionPaquete }}"
                                                                data-costo="{{ $pq->costoPaquete }}"
                                                                {{ $key == 0 ? 'selected' : '' }}>
                                                                {{ $pq->nomPaquete }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control form-control-sm"
                                                        id="duracionPaquete" placeholder="duracion"
                                                        name="duracionPaquete[]" value="" readonly>
                                                </td>
                                                <td>
                                                    <input type="text" id="fechaInicio" name="fechaInicio[]"
                                                        class="form-control form-control-sm" placeholder="Fecha inicio">
                                                </td>
                                                <td>
                                                    <input type="text" id="fechaFin" name="fechaFin[]"
                                                        class="form-control form-control-sm" placeholder="Fecha fin"
                                                        readonly>
                                                </td>
                                                <td>
                                                    <input type="number" class="form-control form-control-sm"
                                                        name="costoPaquete[]" id="costoPaquete" placeholder="costo"
                                                        value="" readonly>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <select class="form-control form-control-sm" id="idPaquete"
                                                        name="idPaquete[]">
                                                        @foreach ($paquetes as $key => $pq)
                                                            <option data-id="{{ $pq->idPaquete }}"
                                                                value="{{ $pq->idPaquete }}"
                                                                data-duracion="{{ $pq->duracionPaquete }}"
                                                                data-costo="{{ $pq->costoPaquete }}"
                                                                {{ $key == 0 ? 'selected' : '' }}>
                                                                {{ $pq->nomPaquete }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control form-control-sm"
                                                        id="duracionPaquete" placeholder="duracion"
                                                        name="duracionPaquete[]" value="" readonly>
                                                </td>
                                                <td>
                                                    <input type="text" id="fechaInicio" name="fechaInicio[]"
                                                        class="form-control form-control-sm" placeholder="Fecha inicio">
                                                </td>
                                                <td>
                                                    <input type="text" id="fechaFin" name="fechaFin[]"
                                                        class="form-control form-control-sm" placeholder="Fecha fin"
                                                        readonly>
                                                </td>
                                                <td>
                                                    <input type="number" class="form-control form-control-sm"
                                                        name="costoPaquete[]" id="costoPaquete" placeholder="costo"
                                                        value="" readonly>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <select class="form-control form-control-sm" id="idPaquete"
                                                        name="idPaquete[]">
                                                        @foreach ($paquetes as $key => $pq)
                                                            <option data-id="{{ $pq->idPaquete }}"
                                                                value="{{ $pq->idPaquete }}"
                                                                data-duracion="{{ $pq->duracionPaquete }}"
                                                                data-costo="{{ $pq->costoPaquete }}"
                                                                {{ $key == 0 ? 'selected' : '' }}>
                                                                {{ $pq->nomPaquete }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control form-control-sm"
                                                        id="duracionPaquete" placeholder="duracion"
                                                        name="duracionPaquete[]" value="" readonly>
                                                </td>
                                                <td>
                                                    <input type="text" id="fechaInicio" name="fechaInicio[]"
                                                        class="form-control form-control-sm" placeholder="Fecha inicio">
                                                </td>
                                                <td>
                                                    <input type="text" id="fechaFin" name="fechaFin[]"
                                                        class="form-control form-control-sm" placeholder="Fecha fin"
                                                        readonly>
                                                </td>
                                                <td>
                                                    <input type="number" class="form-control form-control-sm"
                                                        name="costoPaquete[]" id="costoPaquete" placeholder="costo"
                                                        value="" readonly>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th style="text-align:right;"><b>Total Bs.</b>
                                                </th>
                                                <th style="text-align:left;"><span id="TotalCart"
                                                        style="padding-left: 15px"></span></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- <div class="row justify-content-center mb-0" style="display: none">
            <div class="col-md-12 col-xl-12">
                <div class="card shadow-0 border rounded-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 col-lg-12 col-xl-12">
                                <h5>DETALLE</h5>
                                <div class="table-responsive">
                                    <table class="dtCart table  table-nowrap table-centered mb-0" id="dtCart"
                                        style="min-block-size: ">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Paquete</th>
                                                <th>Duracion</th>
                                                <th>Inicio</th>
                                                <th>Fin</th>
                                                <th>Precio</th>
                                            </tr>
                                        </thead>
                                        <tbody id="dtVE">
                                            <tr>
                                                <td>
                                                    <select class="form-control form-control-sm" id="idPaquete"
                                                        name="idPaquete">
                                                        @foreach ($paquetes as $key => $pq)
                                                            <option data-id="{{ $pq->idPaquete }}"
                                                                value="{{ $pq->idPaquete }}"
                                                                data-duracion="{{ $pq->duracionPaquete }}"
                                                                data-costo="{{ $pq->costoPaquete }}"
                                                                {{ $key == 0 ? 'selected' : '' }}>
                                                                {{ $pq->nomPaquete }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control form-control-sm"
                                                        id="duracionPaquete" placeholder="duracion"
                                                        name="duracionPaquete" value="" readonly>
                                                </td>
                                                <td>
                                                    <input type="text" id="fechaInicio" name="fechaInicio"
                                                        class="form-control form-control-sm" placeholder="Fecha inicio">
                                                </td>
                                                <td>
                                                    <input type="text" id="fechaFin" name="fechaFin"
                                                        class="form-control form-control-sm" placeholder="Fecha fin"
                                                        readonly>
                                                </td>
                                                <td>
                                                    <input type="number" class="form-control form-control-sm"
                                                        name="costoPaquete" id="costoPaquete" placeholder="costo"
                                                        value="" readonly>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th style="text-align:right;"><b>Total Bs.</b>
                                                </th>
                                                <th style="text-align:left;"><span id="TotalCart"
                                                        style="padding-left: 15px"></span></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div> --}}
        <div class="row">
            <br>
        </div>
        <div class="row">
            <div class="col-md-12 col-lg-12 col-xl-12">
                <div class="text-lg-end my-1 my-lg-0">
                    <a href="{{ url('comercial/inscripcion') }}"><button type="button"
                            class="btn w-sm btn-light waves-effect">Cancelar</button></a>
                    <button type="button"
                        class="procesar btn w-sm btn-success waves-effect waves-light guardar">Guardar</button>
                    <button type="button" class="btn w-sm btn-danger waves-effect waves-light">Borrar</button>
                </div>
            </div> <!-- end col -->
        </div>
        </div>
        </div>
        </div>
        </div>
    </form>
    <x-components.modal size="modal-xl" id="modal_cliente" nameBtnSave="Guardar" nameBtnClose="Cancelar"
        idBtnSave="btn_save">
        @include('commom.ModalCrear_Cliente')
    </x-components.modal>
    @include('commom.ModalImprimir_VentaCompra')
@endsection

@push('javascript')
    <script src="{{ asset('/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('/libs/selectize/js/standalone/selectize.min.js') }}"></script>

    <script src="{{ asset('/libs/dropzone/min/dropzone.min.js') }}"></script>

    <script src="{{ asset('/libs/quill/quill.min.js') }}"></script>
    <script src="{{ asset('/libs/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('/libs/dropzone/min/dropzone.min.js') }}"></script>

    <script src="{{ asset('/libs/quill/quill.min.js') }}"></script>
    <script src="{{ asset('/libs/jquery-mockjax/jquery.mockjax.min.js') }}"></script>
    <script src="{{ asset('/libs/devbridge-autocomplete/jquery.autocomplete.min.js') }}"></script>
    <script src="{{ asset('/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js') }}"></script>
    <script src="{{ asset('/libs/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
    <script src="{{ asset('/libs/mohithg-switchery/switchery.min.js') }}"></script>
    <script src="{{ asset('/libs/multiselect/js/jquery.multi-select.js') }}"></script>
    <script src="{{ asset('/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('/libs/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ asset('/libs/printjs/print.min.js') }}"></script>
    <script src="{{ asset('/libs/webcam-easy/webcam-easy.min.js') }}"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>

    <script src="{{ asset('/js/components/datatables.js') }}"></script>
    <script src="{{ asset('/js/components/select2.js') }}"></script>
    <script src="{{ asset('/js/cliente/modal.js') }}"></script>
    <script src="{{ asset('/js/cliente/foto.js') }}"></script>
    <script src="{{ asset('/js/ingresos/create.js') }}"></script>
@endpush
