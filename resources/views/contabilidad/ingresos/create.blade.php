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
    <form action="" id="form_ingreso_varios">
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

                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                        <x-components.seccion nameSeccion="Informacion de movimiento">
                            @include('commom.movimiento-general')
                        </x-components.modal>
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
                                        <h5 class="text-uppercase  ">ASIENTO CONTABLE</h5>
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
                                                    <select class="form-control form-control-sm" id="cuenta_id"
                                                        name="cuenta_id[]">
                                                        @foreach ($cuenta as $key => $cue)
                                                            <option data-id="{{ $cue->cuenta_id }}"
                                                                value="{{ $cue->cuenta_id }}"
                                                                {{ $key == 0 ? 'selected' : '' }}>
                                                                {{ $cue->cuenta_id }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <select class="form-control form-control-sm" id="cod_cuenta"
                                                        name="cod_cuenta[]">
                                                        @foreach ($cuenta as $key => $cue)
                                                            <option data-id="{{ $cue->cuenta_id }}"
                                                                value="{{ $cue->cuenta_id }}"
                                                                {{ $key == 0 ? 'selected' : '' }}>
                                                                {{ $cue->codigo_cuenta }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <select class="form-control form-control-sm" id="nombre_cuenta"
                                                        name="nombre_cuenta[]">
                                                        @foreach ($cuenta as $key => $cue)
                                                            <option data-id="{{ $cue->cuenta_id }}"
                                                                value="{{ $cue->cuenta_id }}"
                                                                {{ $key == 0 ? 'selected' : '' }}>
                                                                {{ $cue->nombre_cuenta }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="number" id="fechaFin" name="debe[]"
                                                        class="form-control form-control-sm" placeholder="debe"
                                                        value="">
                                                </td>
                                                <td>
                                                    <input type="number" class="form-control form-control-sm"
                                                        name="haber[]" id="costoPaquete" placeholder="haber"
                                                        value="">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <select class="form-control form-control-sm" id="cuenta_id"
                                                        name="cuenta_id[]">
                                                        @foreach ($cuenta as $key => $cue)
                                                            <option data-id="{{ $cue->cuenta_id }}"
                                                                value="{{ $cue->cuenta_id }}"
                                                                {{ $key == 0 ? 'selected' : '' }}>
                                                                {{ $cue->cuenta_id }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <select class="form-control form-control-sm" id="cod_cuenta"
                                                        name="cod_cuenta[]">
                                                        @foreach ($cuenta as $key => $cue)
                                                            <option data-id="{{ $cue->cuenta_id }}"
                                                                value="{{ $cue->cuenta_id }}"
                                                                {{ $key == 0 ? 'selected' : '' }}>
                                                                {{ $cue->codigo_cuenta }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <select class="form-control form-control-sm" id="nombre_cuenta"
                                                        name="nombre_cuenta[]">
                                                        @foreach ($cuenta as $key => $cue)
                                                            <option data-id="{{ $cue->cuenta_id }}"
                                                                value="{{ $cue->cuenta_id }}"
                                                                {{ $key == 0 ? 'selected' : '' }}>
                                                                {{ $cue->nombre_cuenta }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="number" id="fechaFin" name="debe[]"
                                                        class="form-control form-control-sm" placeholder="debe"
                                                        value="">
                                                </td>
                                                <td>
                                                    <input type="number" class="form-control form-control-sm"
                                                        name="haber[]" id="costoPaquete" placeholder="haber"
                                                        value="">
                                                </td>
                                            </tr>

                                        </tbody>
                                        {{-- <tfoot>
                                            <tr>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th style="text-align:right;"><b>Total Ingreso Bs.</b>
                                                </th>
                                                <th style="text-align:left;">
                                                    <input type="number" class="form-control form-control-sm"
                                                        name="totalIngreso[]" id="totalIngreso" placeholder="costo"
                                                        value="" readonly style="padding-left: 15px">
                                                </th>
                                                <th style="text-align:left;"><span id="totalIngreso[]"
                                                        style="padding-left: 15px"></span></th>
                                            </tr>
                                        </tfoot> --}}
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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

    <script src="{{ asset('/js/movimientos/create.js') }}"></script>
@endpush
