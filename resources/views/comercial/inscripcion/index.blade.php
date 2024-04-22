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
                            class="btn btn-danger waves-effect waves-light w-100">
                            Limpiar dispositivos </button>
                        
                    </div>
                </div>
                <div class="col-xl-2 col-lg-3 col-md-12 col-sm-12">
                    <div class="d-flex justify-content-end mb-2">
                        <a class="w-100" href="{{ url('comercial/inscripcion/create') }}"><button type="button" id="serchbtn"
                                class="btn btn-success waves-effect waves-light w-100"><i class="mdi mdi-plus me-1"></i>
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
                            <select class="filtrar form-control form-control-sm" id="idTipoComprobanteIns">
                                <option value="">Filtrar comprobante</option>
                                @foreach ($tipo_comprobante as $tcp)
                                    <option value="{{ $tcp->idTipoComprobante }}">{{ $tcp->nomTipoComprobante }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-6 col-sm-12 mb-1">
                            <label for="example-select" class="form-label">Forma de Pago</label>
                            <select class="filtrar form-control form-control-sm" id="idTipoPagoIns">
                                <option value="">Filtrar pago</option>
                                @foreach ($tipopago as $tp)
                                    <option value="{{ $tp->idTipoPago }}">{{ $tp->nomTipoPago }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-6 col-sm-12 mb-1">
                            <label for="example-select" class="form-label">Usuario</label>
                            <select class="filtrar form-control form-control-sm" id="idUsuarioIns">
                                <option value="">Filtrar cajero</option>
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
                                <th>Impuestos</th>
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

    <script>
        /* <!--AJAX CARGA DATA TABLE Function--> */
        const columns = [{
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
                    return `<b>${row.nomTipoComprobante}</b> ${row.idInscripcion}`;
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
                data: 'fechaInicio',
                name: 'fechaInicio',
                orderable: false,
                searchable: false,
                render: function(data, type, row, meta) {
                    return `${moment(row.fechaInicio).format('YYYY-MM-DD')} <br> ${moment(row.fechaFin).format('YYYY-MM-DD')} `;
                }
            },
            {
                data: 'estado',
                name: 'estado',
                render: function(data, type, row, meta) {
                    return estadoInscripcion(row.estado);
                }
            },
            {
                data: 'idInscripcion',
                name: 'idInscripcion',
                orderable: false,
                searchable: false,
                render: function(data, type, row, meta) {
                    return `<i data-id="${row.idInscripcion}" class="ver_pdf fas fa-eye text-info m-1 cursor-pointer" title="Ver pdf"></i>`;
                }
            },
        ];
        const table = dataTable($('.dtInscripciones'),
            `${base_url}/comercial/inscripcion?startDate=${$('#IngresoDesdeIns').val() + 'T00:00:00'}&endDate=${$('#IngresoHastaIns').val() + 'T23:59:59'}&idCliente=${$('#idClienteIns').val()}&idTipoPago=${$('#idTipoPagoIns').val()}&idTipoComprobante=${$('#idTipoComprobanteIns').val()}&idUsuario=${$('#idUsuarioIns').val()}`,
            columns)

        $(document).on('keyup change', '.filtrar', function() {
            table.ajax.url(
                `${base_url}/comercial/inscripcion?startDate=${$('#IngresoDesdeIns').val() + 'T00:00:00'}&endDate=${$('#IngresoHastaIns').val() + 'T23:59:59'}&idCliente=${$('#idClienteIns').val()}&idTipoPago=${$('#idTipoPagoIns').val()}&idTipoComprobante=${$('#idTipoComprobanteIns').val()}&idUsuario=${$('#idUsuarioIns').val()}`,
            ).load();
        });

        select2(
            "#idClienteIns",
            `${base_url}/clientes/buscar-nombre`,
            "GET",
            () => {}
        );
    </script>
    <script>
        $(document).on('click', '#limpiar_equipos', function() {
            const btn = $(this);
            btn.prop('disable', true)
            ajax(`${base_url}/comercial/eliminar-cliente-automatico`, 'GET').catch(
                (response) => {
                    console.log(response)
                }
            )
        });

        $(document).on('click', '.ver_pdf', function() {
            const id = $(this).data('id')
            console.log('open modal')
            verPDF(id)
        });

        function verPDF(id) {
            var frame = $("#iframePDF");
            var ahref = $("#cancelPDF");
            //LOADER
            ajax(`${base_url}/comercial/inscripcion-pdf/${id}`, "GET").then(
                (response) => {
                    var src = `data:application/pdf;base64,${response.data}`;
                    $("#modalImprimir .modal-title").text("RECIBO DE INSCRIPCION");
                    ahref.attr("href", `${base_url}/comercial/inscripcion/index`);
                    frame.attr("src", `data:application/pdf;base64,${response.data}`);
                    $("#modalImprimir").modal("show");
                    $("#iframePDF").data("url", response.data);
                }
            );
        }

        function estadoInscripcion(estado) {
            switch (estado) {
                case 'ven':
                    return `<div class="badge bg-secondary text-light mb-0 m-1">VENCIDO</div>`;
                    break;
                case 'vig':
                    return `<div class="badge bg-secondary text-light mb-0 m-1">VIGENTE</div>`;
                    break;
                case 'ant':
                    return `<div class="badge bg-secondary text-light mb-0 m-1">ANTICIPADO</div>`;
                    break;
            }
        }
    </script>
@endpush
