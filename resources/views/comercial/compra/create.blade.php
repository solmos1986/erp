@extends('layouts.admin')
@push('css')
    <!-- third party css -->
    <link href="{{ asset('/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/libs/dropify/css/dropify.min.css') }}" rel="stylesheet" type="text/css" />
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
    <link href="{{ asset('/libs/flatpickr/flatpickr.min.css') }}" rel="stylesheet" type="text/css" />
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
                        <li class="breadcrumb-item"><a href="#">Comercial</a></li>
                        <li class="breadcrumb-item"><a href="#">Compras</a></li>
                        <li class="breadcrumb-item active">Orden De Compra</li>
                    </ol>
                </div>
                <h4 class="page-title">Orden compra</h4>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="border p-3 mt-lg-2 rounded">
                        <div class="row">
                            <div class="col-xl-3 col-lg-3 col-md-4 col-sm-12 mb-2">
                                <label for="estadoEgresoCreate" class="form-label">Estado <span
                                        class="text-danger">*</span></label>
                                <select class="form-control form-control-sm select2" id="estadoEgresoCreate"
                                    name="estadoEgresoCreate">
                                    <option value="1">Ordenado</option>
                                    <option value="2">Recibido-Pagado</option>
                                    <option value="3">Recibido-NoPagado</option>
                                    <option value="4">NoRecibido-Pagado</option>
                                </select>
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-4 col-sm-12 mb-2">
                                <label for="nomUsuario" class="form-label">Usuario <span
                                        class="text-danger">*</span></label>
                                <select class="form-control form-control-sm select2" id="nomUsuario" disabled>
                                    <option value="{{ auth()->user()->obtener_usuario()->idUsuario }}">
                                        {{ auth()->user()->obtener_usuario()->nomUsuario }}</option>
                                </select>
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-4 col-sm-12 mb-2">
                                <label for="idProveedorCreate" class="form-label">Proveedor <span
                                        class="text-danger">*</span></label>
                                <select class="form-control form-control-sm select2" id="idProveedorCreate"
                                    name="idProveedorCreate">

                                </select>
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-4 col-sm-12 mb-2">
                                <label for="TipoComprobante" class="form-label">&nbsp;</label>
                                <button type="button" id="serchbtn"
                                    class="nuevo btn btn-sm btn-success waves-effect waves-light w-100">
                                    <i class="mdi mdi-plus me-1"></i>
                                    Crear Proveedor</button>
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-4 col-sm-12 mb-2">
                                <label for="idTipoPagoCreate" class="form-label">Metodo de Pago <span
                                        class="text-danger">*</span></label>
                                <select class="form-control form-control-sm select2" id="idTipoPagoCreate"
                                    name="idTipoPagoCreate">
                                    @foreach ($tipopago as $fp)
                                        <option value="{{ $fp->idTipoPago }}">{{ $fp->nomTipoPago }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-4 col-sm-12 mb-2">
                                <label for="idTipoComprobanteCreate" class="form-label">Tipo Comprobante <span
                                        class="text-danger">*</span></label>
                                <select class="form-control form-control-sm select2" id="idTipoComprobanteCreate"
                                    name="idTipoComprobanteCreate">
                                    @foreach ($tipo_comprobante as $tp)
                                        <option value="{{ $tp->idTipoComprobante }}"
                                            data-impuesto="{{ $tp->impuestoComprobante }}">
                                            {{ $tp->nomTipoComprobante }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-4 col-sm-12 mb-2">
                                <label for="impuestoEgresoCreate" class="form-label">Impuestos <span
                                        class="text-danger">*</span></label>
                                <input type="number" class="form-control form-control-sm" id="impuestoEgresoCreate"
                                    name="impuestoEgresoCreate" placeholder="# comprobante..">
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-4 col-sm-12 mb-2">
                                <label for="numeroComprobanteCreate" class="form-label">No. Comprobante <span
                                        class="text-danger">*</span></label>
                                <input type="number" class="form-control form-control-sm" id="numeroComprobanteCreate"
                                    name="numeroComprobanteCreate" placeholder="# comprobante..">
                            </div>
                        </div>
                    </div>
                    <br>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                    <div class="border p-3 mt-lg-2 rounded">
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                <div class="row bg-light p-2 mt-0 mb-3">
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                        <h5 class="text-uppercase  ">SELECCIONA PRODUCTOS</h5>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                        <button type="button" id="serchbtn"
                                            class="creaProducto btn btn-sm btn-success waves-effect waves-light w-100"><i
                                                class="mdi mdi-plus me-1"></i>
                                            Crear Producto</button>
                                    </div>
                                </div>
                                <table id="dtProducto" class="dtProducto table dt-responsive nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th width="10">Codigo</th>
                                            <th width="30">Producto</th>
                                            <th width="10">Stock</th>
                                            <th width="30">Unid.Medida</th>
                                            <th width="20">Accion</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                    <div class="border p-3 mt-lg-2 rounded">
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                <div class="row bg-light p-2 mt-0 mb-3">
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                        <h5 class="text-uppercase">DETALLE</h5>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                        <div class="table-responsive">
                                            <table class="dtCart table table-nowrap table-centered mb-0" id="dtCart">
                                                <thead>
                                                    <tr>
                                                        <th
                                                            style="max-width: 35%; overflow: hidden; word-break: break-all;">
                                                            Producto</th>
                                                        <th
                                                            style="max-width: 20%; overflow: hidden; word-break: break-all;">
                                                            Cant.</th>
                                                        <th
                                                            style="max-width: 20%; overflow: hidden; word-break: break-all;">
                                                            Precio</th>
                                                        <th
                                                            style="max-width: 20%; overflow: hidden; word-break: break-all;">
                                                            Total</th>
                                                        <th
                                                            style="max-width: 5%; overflow: hidden; word-break: break-all;">
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody id="dtOC">

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
                </div>
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <br>
                    <div class="text-center mb-3">
                        <a href="{{ url('comercial/compra') }}"><button type="button"
                                class="btn btn-sm btn-light waves-effect">Cancelar</button></a>
                        <button type="button"
                            class="procesar btn btn-sm btn-primary waves-effect waves-light guardar">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-components.modal size="modal-lg" id="modal_proveedor" nameBtnSave="Guardar" nameBtnClose="Cancelar"
        idBtnSave="btn_save">
        @include('almacen.proveedor.components.form-proveedor')
    </x-components.modal>

    <x-components.modal size="modal-lg" id="modal_pdf" nameBtnSave="Guardar" nameBtnClose="Cancelar"
        idBtnSave="btn_save">
        @include('commom.pdf-imprimir')
    </x-components.modal>

    <x-components.modal size="modal-xl" id="modal_producto" nameBtnSave="Guardar" nameBtnClose="Cancelar"
        idBtnSave="btn_save_producto">
        @include('almacen.producto.components.form-producto-create')
    </x-components.modal>
@endsection

@push('javascript')
    <script src="{{ asset('/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('/libs/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('/libs/quill/quill.min.js') }}"></script>
    <script src="{{ asset('/libs/dropify/js/dropify.min.js') }}"></script>
    <script src="{{ asset('/libs/printjs/print.min.js') }}"></script>

    <script src="{{ asset('/js/proveedor/modal.js') }}"></script>
    <script src="{{ asset('/js/egresos/modal-imprimir.js') }}"></script>
    <script src="{{ asset('/js/egresos/create.js') }}"></script>
    <script src="{{ asset('/js/producto/create.js') }}"></script>
@endpush
