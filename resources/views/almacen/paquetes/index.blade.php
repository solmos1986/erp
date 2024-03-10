@extends('layouts.admin')
@push('css')
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
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="#">ERP</a></li>
                        <li class="breadcrumb-item"><a href="#">Almacen</a></li>
                        <li class="breadcrumb-item active">Paquetes</li>
                    </ol>
                </div>
                <h4 class="page-title">PAQUETES</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-lg-3">
            <div class="input-group">
                <input type="text" class="form-control" id="validationCustom15" placeholder="Buscar producto" required>
            </div>
        </div>
        <div class="col-lg-5">

        </div>
        <div class="col-lg-4">
            <div class="text-lg-end">
                <a href="#"><button type="button" id="serchbtn"
                        class="nuevo btn btn-success waves-effect waves-light mb-2 me-2"><i class="mdi mdi-plus me-1"></i>
                        Nuevo Paquete </button></a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="dtPaquetes" class="dtPaquetes table dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Paquete</th>
                                <th>Duracion</th>
                                <th>Costo</th>
                                <th style="width: 50px;">Status</th>
                                <th style="width: 50px;">Accion</th>
                            </tr>
                        </thead>
                        <tbody>


                        </tbody>
                    </table>

                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>

    <!-- MODAL  -->

    <!-- NUEVO Modal -->
    <div class="modal fade" id="formPaquetes" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        {!! Form::open(['url' => 'almacen/paquetes', 'method' => 'POST', 'autocomplete' => 'off']) !!}
        {{ Form::token() }}

        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Crear Pquete</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="needs-validation" novalidate>
                        <div class="row">

                            <div class="col-md-12 mb-1">
                                <label for="nomPaquete" class="form-label">Nombre Paquete</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="nomPaquete" placeholder="Ingrese Paquete"
                                        required name="nomPaquete">
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-6 mb-1">
                                <label for="duracionPaquete" class="form-label">Duracion</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="duracionPaquete"
                                        placeholder="No. de meses" required name="duracionPaquete">
                                </div>
                            </div>
                            <div class="col-md-6 mb-1">
                                <label for="costoPaquete" class="form-label">Costo</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="costoPaquete" placeholder="Costo en Bs."
                                        required name="costoPaquete">
                                </div>
                            </div>


                        </div>
                    </form>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary waves-effect"
                            data-bs-dismiss="modal">Cancelar</button>
                        <button type="sumit" class="btn btn-info waves-effect waves-light">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div><!-- /.modal -->

    <!-- EDIT Modal -->

    <div class="modal fade" id="formEditarPaquete" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Editar Paquete</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="needs-validation" novalidate>
                        <div class="row">
                            <div class="col-md-4 mb-1">
                                <label for="idPaqueteEdit" class="form-label">Id Paquete</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="idPaqueteEdit" placeholder=""
                                        required name="idPaqueteEdit">
                                </div>
                            </div>
                            <div class="col-md-8 mb-1">
                                <label for="nomPaqueteEdit" class="form-label">Nombre Paquete</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="nomPaqueteEdit" required
                                        name="nomPaqueteEdit">
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-md-3 mb-1">
                                <label for="duracionPaqueteEdit" class="form-label">Duracion</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="duracionPaqueteEdit" required
                                        name="duracionPaqueteEdit">
                                </div>
                            </div>
                            <div class="col-md-3 mb-1">
                                <label for="costoPaqueteEdit" class="form-label">Costo</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="costoPaqueteEdit" required
                                        name="costoPaqueteEdit">
                                </div>
                            </div>

                        </div>

                    </form>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary waves-effect"
                            data-bs-dismiss="modal">Cancelar</button>
                        <button type="sumit" class="update btn btn-info waves-effect waves-light">Guardar</button>
                    </div>
                </div>
            </div>
        </div>

    </div><!-- /.modal -->

    <!-- DELETE Modal -->
    <div id="formDeletePaquete" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content modal-filled bg-danger">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel"></h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="text-center">
                        <i class="dripicons-wrong h1 text-white"></i>
                        <h4 class="mt-2 text-white">CUIDADO !</h4>
                        <p class="mt-3 text-white">Esta seguro de eliminar Paquete?</p>
                        <button type="button" class="btnDelete btn btn-light my-2"
                            data-bs-dismiss="modal">Eliminar</button>

                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

@endsection

@push('javascript')
    <script src="{{ asset('/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js') }}"></script>

    <script type="text/javascript">
        /* <!--AJAX CARGA DATA TABLE Function--> */
        $(function() {

            var table = $('.dtPaquetes').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('index.paquete') }}",

                columns: [{
                        data: 'idPaquete',
                        name: 'idPaquete'
                    },
                    {
                        data: 'nomPaquete',
                        name: 'nomPaquete'
                    },
                    {
                        data: 'duracionPaquete',
                        name: 'duracionPaquete'
                    },
                    {
                        data: 'costoPaquete',
                        name: 'costoPaquete'
                    },
                    {
                        data: "condicionPaquete",
                        name: "condicionPaquete",
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row, meta) {
                            console.log("LLEGO FILA", data);
                            var condicion = `${row.condicionPaquete}`;
                            console.log(condicion, "valor condicion");
                            if (condicion == 1) {
                                return `<div class="form-check form-switch"><input type="checkbox" data-id="${row.idPaquete}" class="statusPaquete form-check-input" id="customSwitch1" checked>
                </div>`;
                            } else {
                                return `<div class="form-check form-switch"><input type="checkbox" data-id="${row.idPaquete}" class="statusPaquete form-check-input" id="customSwitch1">
                </div>`;
                            }
                        },
                    },
                    {
                        data: 'idPaquete',
                        name: 'idPaquete',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row, meta) {
                            console.log("LLEGO FILA", row)
                            return `&nbsp;&nbsp;<a href="javascript:void(0)"  data-id="${row.idPaquete}" class="edit fas fa-pencil-alt text-info"></a>`;
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
            /* <!--AJAX EDITAR Modal--> */

            $(document).on("click", ".edit", function() {
                console.log("HOLA recibi info")
                const id = $(this).data('id');
                console.log(id, "estoy enviando?")
                $.ajax({
                    type: "get",
                    url: `${base_url}/almacen/paquetes/${id}`,
                    dataType: 'json',

                    success: function(response) {
                        console.log(response, "LLEGO DATA?")

                        $('#idPaqueteEdit').val(response.data.idPaquete)
                        $('#nomPaqueteEdit').val(response.data.nomPaquete)
                        $('#duracionPaqueteEdit').val(response.data.duracionPaquete)
                        $('#costoPaqueteEdit').val(response.data.costoPaquete)
                        $('#formEditarPaquete').modal('show');
                        console.log(response, "QUE  PASO???");
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        //error_status(jqXHR)
                    },
                    fail: function() {
                        //fail()
                    }
                })
            });
            /* <!--AJAX NUEVO Modal--> */
            $(document).on("click", ".nuevo", function() {
                $('#formPaquetes').modal('show');

            });

            /*<!-- AJAX UPDATE Modal -->*/
            $(document).on("click", ".update", function() {
                const id = $("#idPaqueteEdit").val();
                console.log(id)

                $.ajax({
                    type: "put",
                    url: `${base_url}/almacen/paquetes/${id}`,
                    dataType: 'json',
                    data: {

                        idPaquete: $('#idPaqueteEdit').val(),
                        nomPaquete: $('#nomPaqueteEdit').val(),
                        duracionPaquete: $('#duracionPaqueteEdit').val(),
                        costoPaquete: $('#costoPaqueteEdit').val(),
                    },
                    success: function(response) {
                        console.log(response, "ACTUALIZO")
                        $('#formEditarPaquete').modal('hide');
                        $('.dtPaquetes').DataTable().ajax.reload();
                        Swal.fire({
                            type: 'success',
                            title: 'OK',
                            text: response.message,
                        });
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
                })
            })
        });

        /*<!-- AJAX DELETE Modal -->*/
        $(document).on("click", ".delete", function() {
            const id = $(this).data('id');
            console.log(id, "HOLA recibi info DELETE")
            $('#idPaqueteDelete').val(id)
            $('#formDeletePaquete').modal('show');
            $(".btnDelete").click(function() {
                $.ajax({
                    type: "delete",
                    url: `${base_url}/almacen/paquetes/${id}`,
                    dataType: 'json',

                    success: function(response) {
                        console.log(response, "LLEGO DATA?")
                        $('#formDeletePaquete').modal('hide');
                        $('.dtPaquetes').DataTable().ajax.reload();
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        //error_status(jqXHR)
                        console.log(response, "ERROR?")
                    },
                    fail: function() {
                        //fail()
                    }
                })
            })
        });


        $(document).ready(function() {
            $("#basic-datatable").DataTable({
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
            $("#basic-datatable").DataTable({
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
        });
        $(document).on("change", ".statusPaquete", function() {
            const id = $(this).data("id");
            var estado = $(this).prop("checked") == true ? 1 : 0;
            console.log(estado, "EL ESTADO DEL SWITCH");
            $.ajax({
                type: "delete",
                url: `${base_url}/almacen/paquetes/${id}`,
                dataType: "json",
                data: {
                    condicionPaquete: estado,
                    idPaquete: id
                },

                success: function(response) {
                    console.log(response, "LLEGO DATA?");
                    $(".dtPaquetes").DataTable().ajax.reload();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    //error_status(jqXHR)
                    console.log(response, "ERROR?");
                },
                fail: function() {
                    //fail()
                },
            });
        });
    </script>
@endpush
