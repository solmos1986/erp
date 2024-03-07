@extends('layouts.admin')
@push('css')
    <!-- third party css -->
    <link href="{{ asset('/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/libs/dropzone/min/dropzone.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/libs/mohithg-switchery/switchery.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/libs/selectize/css/selectize.bootstrap3.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/libs/multiselect/css/multi-select.css') }}" rel="stylesheet" type="text/css" />
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
    {{-- <link href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" /> --}}
@endpush

@section('contenido')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">UBold</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Ecommerce</a></li>
                        <li class="breadcrumb-item active">Inscripciones</li>
                    </ol>
                </div>
                <h4 class="page-title">INSCRIPCION</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row justify-content-between">
                        <div class="col-auto">
                            <form class="d-flex flex-wrap align-items-center">
                                <label for="inputPassword2" class="visually-hidden">Search</label>
                                <div class="me-3">
                                    <input type="search" class="form-control my-1 my-lg-0" id="inputPassword2"
                                        placeholder="Search...">
                                </div>
                                <label for="status-select" class="me-2">Sort By</label>
                                <div class="me-sm-3">
                                    <select class="form-select my-1 my-lg-0" id="status-select">
                                        <option selected="">All</option>
                                        <option value="1">Popular</option>
                                        <option value="2">Price Low</option>
                                        <option value="3">Price High</option>
                                        <option value="4">Sold Out</option>
                                    </select>
                                </div>
                            </form>
                        </div>
                        <div class="col-auto">
                            <div class="text-lg-end my-1 my-lg-0">
                                <button type="button" class="btn btn-success waves-effect waves-light me-1"><i
                                        class="mdi mdi-cog"></i></button>
                                <a href="ecommerce-product-edit.html" class="btn btn-danger waves-effect waves-light"><i
                                        class="mdi mdi-plus-circle me-1"></i> Add New</a>
                            </div>
                        </div><!-- end col-->
                    </div> <!-- end row -->
                </div>
            </div> <!-- end card -->
        </div> <!-- end col-->
    </div>
    <!-- end row-->

    <div class="row justify-content-center mb-0">
        <div class="col-md-12 col-xl-12">
            <div class="card shadow-0 border rounded-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 col-lg-12 col-xl-12 mb-4 mb-lg-0">
                            <div class="row mb-1">
                                <label for="fechaInscripcion" class="form-label col-2 col-xl-2">Fecha</label>
                                <div class="col-4 col-xl-4">
                                    <input type="text" id="datetime-datepicker" class="form-control"
                                        placeholder="Date and Time" value="<?php echo date('Y-m-d H:i:s'); ?>">
                                </div>
                                <label for="idVendedor" class="form-label col-2 col-xl-2">Vendedor</label>
                                <div class="col-4 col-xl-4">
                                    <input type="text" class="form-control form-control-sm" id="idVendedor"
                                        placeholder="Vendedor" value="8888">
                                </div>
                            </div>
                            <div class="row mb-1">
                                <label for="idCliente" class="form-label col-2 col-xl-2">Cliente</label>
                                <div class="col-10 col-xl-10">
                                    <select class="form-control form-control-sm" id="idCliente">
                                        @foreach ($cliente as $cli)
                                            <option value="{{ $cli->idCliente }}">{{ $cli->nomCliente }}
                                            </option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>
                            <div class="row mb-1">
                                <label for="docCliente" class="form-label col-2 col-xl-2">NIT/CI</label>
                                <div class="col-4 col-xl-4">
                                    <input type="select" class="form-control form-control-sm" id="docCliente"
                                        placeholder="NIT/CI">
                                </div>
                                <label for="idTipoPago" class="form-label col-2 col-xl-2">Tipo Pago</label>
                                <div class="col-4 col-xl-4">
                                    <select class="form-control form-control-sm" id="idTipoPago">
                                        @foreach ($tipopago as $tp)
                                            <option value="{{ $tp->idTipoPago }}">{{ $tp->nomTipoPago }}</option>
                                        @endforeach
                                    </select>

                                </div>

                            </div>
                            <div class="row mb-1">
                                <label for="idTipoComprobante" class="form-label col-2 col-xl-2">Comprobante</label>
                                <div class="col-4 col-xl-4">
                                    <div class="col-12 col-xl-12">
                                        <select class="form-control form-control-sm" id="idTipoComprobante"
                                            value='1'>
                                            @foreach ($tipo_comprobante as $tp)
                                                <option value="{{ $tp->impuestoComprobante }}">
                                                    {{ $tp->nomTipoComprobante }}
                                                </option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                                <label for="impuestoInscripcion" class="form-label col-2 col-xl-2">Impuestos</label>
                                <div class="col-4 col-xl-4">
                                    <input type="number" class="form-control form-control-sm" id="impuestoInscripcion"
                                        placeholder="% impuesto" value="0" readonly>
                                </div>
                                {{-- <label for="example-input-small"
                                            class="form-label col-2 col-xl-2">Vendedor</label>
                                        <div class="col-4 col-xl-4">
                                            <input type="select" class="form-control form-control-sm"
                                                id="example-input-small" placeholder="Vendedor">
                                        </div> --}}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-lg-12 col-xl-12 mb-4 mb-lg-0">

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
                            <h5>DETALLE</h5>
                            <div class="table-responsive">
                                <table class="dtCart table  table-nowrap table-centered mb-0" id="dtCart"
                                    style="min-block-size: ">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Paquete</th>
                                            <th>Duracion</th>
                                            <th>Inicio</th>
                                            <th>fin</th>
                                            <th>Precio</th>
                                        </tr>
                                    </thead>
                                    <tbody id="dtVE">
                                        <tr>
                                            <td><select class="form-control form-control-sm" id="paquetes"
                                                    name="paquetes">
                                                    <option value="">Seleccion un Paquete</option>
                                                    @foreach ($paquetes as $pq)
                                                        <option data-id="{{ $pq->idPaquete }}"
                                                            value="{{ $pq->idPaquete }}">
                                                            {{ $pq->nomPaquete }}
                                                        </option>
                                                    @endforeach
                                                </select></td>
                                            <td>

                                                <input type="text" class="form-control form-control-sm"
                                                    id="duracionPaquete" placeholder="duracion" value="" readonly>

                                            </td>
                                            <td>
                                                <input type="date" class="form-control form-control-sm"
                                                    id="fechaInicio" name="date" placeholder="Fecha"
                                                    value="<?php echo date('Y-m-d'); ?>">
                                            </td>
                                            <td>
                                                <input type="date" class="form-control form-control-sm" id="fechaFin"
                                                    name="date" placeholder="Fecha" value="<?php echo date('Y-m-d'); ?>"
                                                    readonly>
                                            </td>
                                            <td>
                                                <input type="number" class="form-control form-control-sm"
                                                    id="costoPaquete" placeholder="costo" value="0" readonly>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th><b>Total.</b>
                                            </th>
                                            <th id="TotalCart"></th>

                                        </tr>
                                    </tfoot>
                                </table>
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
                                <button type="button"
                                    class="btn w-sm btn-danger waves-effect waves-light">Borrar</button>
                            </div>
                        </div> <!-- end col -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('javascript')
    {{--  <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
        <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script> --}}
    <script src="{{ asset('/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js') }}"></script>
    <!-- Select2 js-->

    <script src="{{ asset('/libs/selectize/js/standalone/selectize.min.js') }}"></script>

    <!-- Dropzone file uploads-->
    <script src="{{ asset('/libs/dropzone/min/dropzone.min.js') }}"></script>

    <!-- Quill js -->
    <script src="{{ asset('/libs/quill/quill.min.js') }}"></script>

    <!-- Select2 js-->
    <script src="{{ asset('/libs/select2/js/select2.min.js') }}"></script>
    <!-- Dropzone file uploads-->
    <script src="{{ asset('/libs/dropzone/min/dropzone.min.js') }}"></script>

    <!-- Quill js -->
    <script src="{{ asset('/libs/quill/quill.min.js') }}"></script>
    <script src="{{ asset('/libs/jquery-mockjax/jquery.mockjax.min.js') }}"></script>
    <script src="{{ asset('/libs/devbridge-autocomplete/jquery.autocomplete.min.js') }}"></script>
    <script src="{{ asset('/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js') }}"></script>
    <script src="{{ asset('/libs/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
    <script src="{{ asset('/libs/mohithg-switchery/switchery.min.js') }}"></script>
    <script src="{{ asset('/libs/multiselect/js/jquery.multi-select.js') }}"></script>
    <script src="{{ asset('/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('/libs/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ asset('/js/pages/form-pickers.init.js') }}"></script>


    <script>
        var paquete = [];
        var detalleVenta = [];
        var select = document.getElementById("paquetes");
        select.addEventListener("change", function(e) {

            var id = this.options[this.selectedIndex].value;
            console.log("Option selected: " + id);
            $.ajax({
                type: "get",
                url: `${base_url}/almacen/paquetes/${id}`,
                dataType: 'json',
                success: function(response) {
                    console.log(response.data.costoPaquete, "lista de paquetes")
                    $('#costoPaquete').val(response.data.costoPaquete)
                    $('#duracionPaquete').val(response.data.duracionPaquete)
                    AddMes();
                    calcularImpuesto();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log('error de programacion');
                    Swal.fire({
                        type: 'error',
                        title: 'Oops...',
                        text: 'ejemplosdsfs!',
                    });
                },
                fail: function() {
                    console.log('error servidor')
                }

            });

        });
        var inicio = document.getElementById("fechaInicio");
        inicio.addEventListener("ready", function() {
            console.log("Cambio fecha inicio");
            AddMes();
        });
        var comprobante = document.getElementById("idTipoComprobante");
        comprobante.addEventListener("change", function() {
            calcularImpuesto();
        });

        function calcularImpuesto() {
            var impuesto = comprobante.value;
            var costoIns = $('#costoPaquete').val();
            var tImpuesto = impuesto * costoIns;
            $('#impuestoInscripcion').val(tImpuesto);
            console.log(tImpuesto, "Valor Comprobante");

        }


        var obj = document.getElementById('fechaInicio');
        var obj2 = document.getElementById('duracionPaquete');
        var obj3 = document.getElementById('fechaFin');
        obj.value = setFormato(new Date());

        function AddMes() {
            var fecha = new Date(obj.value);
            console.log("fechasss", fecha)
            var mes = fecha.getMonth();
            console.log("MEESSS", mes);
            fecha.setMonth(fecha.getMonth() + +(obj2.value));
            console.log(fecha, "fecha sumada")
            obj3.value = setFormato(fecha);
        }

        function setFormato(fecha) {
            var day = ("0" + fecha.getDate()).slice(-2);
            var month = ("0" + (fecha.getMonth() + 1)).slice(-2);
            var date = fecha.getFullYear() + "-" + (month) + "-" + (day);
            return date;
        }
        $(document).on('click', '.procesar', function() {
            if ($('#impuestoInscripcion').val() == 0) {
                var idTC = 1
            } else {
                var idTC = 2
            }
            var dato = {

                idCliente: $('#idCliente').val(),
                idTipoPago: $('#idTipoPago').val(),
                idTipoComprobante: idTC,

                impuestoInscripcion: $('#impuestoInscripcion').val(),
                estadoInscripcion: 1,
                idUsuario: $('#idVendedor').val(),
                idPaquete: $('#paquetes').val(),
                fechaInicio: $('#fechaInicio').val(),
                fechaFin: $('#fechaFin').val(),
                costoPaquete: $('#costoPaquete').val(),


            };
            console.log(dato, "ENVIADO A STORE");
            $.ajax({
                type: "post",
                url: `${base_url}/comercial/inscripcion`,
                dataType: 'json',
                data: dato,
                success: function(response) {
                    console.log(response, "ACTUALIZO")
                    window.location = "index";



                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log('error de programacion');
                    Swal.fire({
                        type: 'error',
                        title: 'Oops...',
                        text: 'ejemplosdsfs!',
                    });
                },
                fail: function() {
                    console.log('error servidor')
                }
            });
        });
    </script>
@endpush
