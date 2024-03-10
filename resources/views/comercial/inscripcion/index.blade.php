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
    <br>
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">
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
                <div class="col-lg-3">
                    <div class="input-group">
                        <input type="text" class="form-control" id="validationCustom15" placeholder="Buscar producto"
                            required>
                    </div>
                </div>
                <div class="col-lg-5">

                </div>
                <div class="col-lg-4">
                    <div class="text-lg-end">
                        <a href="{{ url('comercial/inscripcion/create') }}"><button type="button" id="serchbtn"
                                class="btn btn-success waves-effect waves-light mb-2 me-2"><i class="mdi mdi-plus me-1"></i>
                                Nueva Inscripcion </button></a>
                    </div>
                </div>
            </div>
            <div class="row">

                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-2">
                                <label class="form-label">Desde</label>
                                <input class="filtrar form-control" id="IngresoDesdeIns" type="date" name="date"
                                    value="<?php echo date('Y-m-d'); ?>">
                            </div>
                            <div class="col-2">
                                <label class="form-label">Hasta</label>
                                <input class="filtrar form-control" id="IngresoHastaIns" type="date" name="date"
                                    value="<?php echo date('Y-m-d'); ?>">

                            </div>
                            <div class="col-2">
                                <label for="example-select" class="form-label">Cliente</label>
                                <select class="filtrar form-select" id="idClienteIns">
                                    <option value="">Filtrar cliente</option>
                                    @foreach ($cliente as $cli)
                                        <option value="{{ $cli->idCliente }}">{{ $cli->nomCliente }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-2">
                                <label for="example-select" class="form-label">Comprobante</label>
                                <select class="filtrar form-select" id="idTipoComprobanteIns">
                                    <option value="">Filtrar comprobante</option>
                                    @foreach ($tipo_comprobante as $tcp)
                                        <option value="{{ $tcp->idTipoComprobante }}">{{ $tcp->nomTipoComprobante }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-2">
                                <label for="example-select" class="form-label">Forma de Pago</label>
                                <select class="filtrar form-select" id="idTipoPagoIns">
                                    <option value="">Filtrar pago</option>
                                    @foreach ($tipopago as $tp)
                                        <option value="{{ $tp->idTipoPago }}">{{ $tp->nomTipoPago }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-2">
                                <label for="example-select" class="form-label">Usuario</label>
                                <select class="filtrar form-select" id="idUsuarioIns">
                                    <option value="">Filtrar cajero</option>
                                    @foreach ($usuario as $user)
                                        <option value="{{ $user->idUsuario }}">{{ $user->nomUsuario }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div> <!-- end card -->

            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="dtInscripciones" class="dtInscripciones table dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Fecha</th>
                                        <th>Cliente</th>
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

                        </div> <!-- end card body-->
                        {{--  <div>
                    {{ $categorias->render() }}
                </div> --}}
                    </div> <!-- end card -->
                </div><!-- end col-->
            </div>

            <!-- end row-->
        </div>
    </div>
@endsection

@push('javascript')
    <script src="{{ asset('/libs/bootstrap-table/bootstrap-table.min.js') }}"></script>
    <script src="{{ asset('/js/pages/form-advanced.init.js') }}"></script>
    <script src="{{ asset('/libs/jquery-mockjax/jquery.mockjax.min.js') }}"></script>

    <!-- Init js -->
    <script src="{{ asset('/js/pages/bootstrap-tables.init.js') }}"></script>
    <script src="{{ asset('/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js') }}"></script>
    <!-- Select2 js-->
    <script src="{{ asset('/libs/select2/js/select2.min.js') }}"></script>
    <!-- Dropzone file uploads-->
    <script src="{{ asset('/libs/dropzone/min/dropzone.min.js') }}"></script>

    <!-- Quill js -->
    <script src="{{ asset('/libs/quill/quill.min.js') }}"></script>

    <!-- Init js-->
    {{--   <script src="{{ asset('/js/pages/form-fileuploads.init.js') }}"></script>

    <!-- Init js -->
    <script src="{{ asset('/js/pages/add-product.init.js') }}"></script> --}}
    <script>
        /* <!--AJAX CARGA DATA TABLE Function--> */
        $(document).ready(function() {

            const table = $('.dtInscripciones').DataTable({

                processing: true,
                serverSide: true,
                searchin: true,
                ajax: {
                    url: "{{ route('index.inscripcion') }}",
                    data: function(d) {

                        d.startDate = $('#IngresoDesdeIns').val() + 'T00:00:00',
                            d.endDate = $('#IngresoHastaIns').val() + 'T23:59:59',
                            d.idCliente = $('#idClienteIns').val(),
                            d.idTipoPago = $('#idTipoPagoIns').val(),
                            d.idTipoComprobante = $('#idTipoComprobanteIns').val(),
                            d.idUsuario = $('#idUsuarioIns').val()
                    },
                },
                dataType: 'json',
                type: "post",
                columns: [{
                        data: 'idInscripcion',
                        name: 'idInscripcion'
                    },
                    {
                        data: 'fechaInscripcion',
                        name: 'fechaInscripcion'
                    },
                    {
                        data: 'nomCliente',
                        name: 'nomCliente'
                    },
                    {
                        data: 'nomTipoComprobante',
                        name: 'nomTipoComprobante',
                        render: function(data, type, row, meta) {
                            // esto es lo que se va a renderizar como html
                            return `<b>${row.nomTipoComprobante}</b> ${row.numeroComprobante}`;
                        }
                    },
                    {
                        data: 'impuestoInscripcion',
                        name: 'impuestoInscripcion'
                    },
                    {
                        data: 'nomTipoPago',
                        name: 'nomTipoPago'
                    },
                    {
                        data: 'costoPaquete',
                        name: 'costoPaquete'
                    },
                    {
                        data: 'nomUsuario',
                        name: 'nomUsuario'
                    },
                    {
                        data: 'estadoInscripcion',
                        name: 'estadoInscripcion'
                    },
                    {
                        data: 'idInscripcion',
                        name: 'idInscripcion',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row, meta) {
                            console.log("LLEGO FILA", row)
                            return `<a href="{{ url('almacen/producto/${row.idInscripcion}') }}"  data-id="${row.idInscripcion}" class="edit fas fa-pencil-alt text-info"></a> &nbsp;&nbsp;&nbsp;<a href="javascript:void(0)"  data-id="${row.idInscripcion}" class="delete fas fa-trash-alt text-danger"></a>`;
                        }
                    },
                ],
                language: {
                    paginate: {
                        previous: "<i class='mdi mdi-chevron-left'>",
                        next: "<i class='mdi mdi-chevron-right'>"
                    }
                },
                drawCallback: function() {
                    $(".dataTables_paginate > .pagination").addClass("pagination-rounded")
                }
            });
            $(document).on('keyup change', '.filtrar', function() {
                table.draw()
            });
        });
    </script>
    <!-- Bootstrap Tables js -->
@endpush
