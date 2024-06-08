@extends('layouts.admin')
@push('css')
    <link href="{{ asset('/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/libs/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('/libs/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('/libs/datatables.net-select-bs5/css//select.bootstrap5.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('/libs/printjs/print.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/libs/selectize/css/selectize.bootstrap3.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css') }}" rel="stylesheet"
        type="text/css" />
    <!-- App css -->
    <link href="{{ asset('/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />
@endpush

@php
    $rutas = [
        [
            'direccion' => '#',
            'nombre' => 'Sistema venta',
        ],
        [
            'direccion' => '#',
            'nombre' => 'Gest. venta',
        ],
        [
            'direccion' => '#',
            'nombre' => 'Incripcion',
        ],
    ];
@endphp
@section('contenido')
    <x-components.miga-pan :rutas="$rutas" rutaActual="Nueva Inscripcion">
    </x-components.miga-pan>
    <!-- end row-->
    <form action="" id="form_inscripcion">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-3">
                        <input type="text" name="idTipoIngreso" id="idTipoIngreso" value="2" hidden>
                        <x-components.seccion nameSeccion="Informacion de inscripcion">
                            @include('commom.ingreso')
                        </x-components.seccion>
                    </div>
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                        <x-components.seccion nameSeccion="Detalle inscripcion">
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                    <div class="table-responsive">
                                        <table class="dtCart table  table-nowrap table-centered mb-0" id="dtCart"
                                            style="min-block-size: ">
                                            <thead>
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
                                                        <select
                                                            class="form-control form-control-sm form-select form-select-sm"
                                                            id="idPaquete" name="idPaquete">
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
                                                        <input type="date" id="fechaInicio" name="fechaInicio"
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
                            </div>
                        </x-components.seccion>
                    </div>
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mt-2">
                        <div class="text-center mb-3">
                            <a href="{{ url('comercial/inscripcion') }}">
                                <button type="button" class="btn btn-sm btn-light waves-effect">Cancelar</button>
                            </a>
                            <button type="button"
                                class="procesar btn btn-sm btn-primary waves-effect waves-light">Guardar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <x-components.modal size="modal-xl" id="modal_cliente" nameBtnSave="Guardar" nameBtnClose="Cancelar"
        idBtnSave="btn_save">
        @include('comercial.cliente.components.form-cliente-inscripcion')
    </x-components.modal>
    <x-components.modal size="modal-xl" id="modalImprimir" nameBtnSave="Imprimir" nameBtnClose="Cancelar"
        idBtnSave="ImprimirPDF">
        @include('commom.pdf-imprimir')
    </x-components.modal>
@endsection

@push('javascript')
    <script src="{{ asset('/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('/libs/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('/libs/printjs/print.min.js') }}"></script>
    <script src="{{ asset('/libs/webcam-easy/webcam-easy.min.js') }}"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>

    <script src="{{ asset('/js/cliente/modal.js') }}"></script>
    <script src="{{ asset('/js/cliente/foto.js') }}"></script>
    <script src="{{ asset('/js/inscripcion/create.js') }}"></script>
@endpush
