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
                        <li class="breadcrumb-item"><a href="#">Alamcen</a></li>
                        <li class="breadcrumb-item active">Proveedores</li>
                    </ol>
                </div>
                <h4 class="page-title">PROVEEDORES</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-md-3 mb-2">
            <div class="input-group">
                <input type="text" class="form-control" id="validationCustom15" placeholder="Buscar proveedor" required>
            </div>
        </div>
        <div class="col-md-6 mb-2">
        </div>
        <div class="col-md-3 col-md-push mb-2">

            <div class="input-group">

                <button type="button" id="serchbtn" class="btn rounded-pill btn-success nuevo">NUEVO</button>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="dtProveedor" class="dtProveedor table dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>Codigo</th>
                                <th>Proveedor</th>
                                <th>Telefono</th>
                                <th>Direccion</th>
                                <th>Correo Electronico</th>
                                <th>Accion</th>
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
    <div class="modal fade" id="formProveedor" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
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
        {!! Form::open(['url' => 'almacen/proveedor', 'method' => 'POST', 'autocomplete' => 'off']) !!}
        {{ Form::token() }}

        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Crear Proveedor</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="needs-validation" novalidate>
                        <div class="row">

                            <div class="col-md-12 mb-1">
                                <label for="nomProveedor" class="form-label">Nombre Proveedor</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="nomProveedor"
                                        placeholder="Ingrese Proveedor" required name="nomProveedor">
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-6 mb-1">
                                <label for="tel1Proveedor" class="form-label">Telefono 1 Proveedor</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="tel1Proveedor" placeholder="Telefono 1"
                                        required name="tel1Proveedor">
                                </div>
                            </div>
                            <div class="col-md-6 mb-1">
                                <label for="tel2Proveedor" class="form-label">Telefono 2 Proveedor</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="tel2Proveedor" placeholder="Telefono 2"
                                        required name="tel2Proveedor">
                                </div>
                            </div>


                        </div>
                        <div class="row">
                            <div class="col-md-12 mb-1">
                                <label for="mailProveedor" class="form-label">Correo Electronico</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="mailProveedor" placeholder="E-mail"
                                        required name="mailProveedor">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mb-1">
                                <label for="dirProveedor" class="form-label">Direccion</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="dirProveedor" placeholder="Direccion"
                                        required name="dirProveedor">
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

    <div class="modal fade" id="formEditarProveedor" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
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
                    <h4 class="modal-title" id="myLargeModalLabel">Editar Proveedor</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="needs-validation" novalidate>
                        <div class="row">
                            <div class="col-md-4 mb-1">
                                <label for="idProveedorEdit" class="form-label">Id Proveedor</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="idProveedorEdit" placeholder=""
                                        required name="idProveedorEdit">
                                </div>
                            </div>
                            <div class="col-md-8 mb-1">
                                <label for="nomProveedorEdit" class="form-label">Nombre Proveedor</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="nomProveedorEdit" required
                                        name="nomProveedorEdit">
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-md-3 mb-1">
                                <label for="tel1ProveedorEdit" class="form-label">Telefono 1 Proveedor</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="tel1ProveedorEdit" required
                                        name="tel1ProveedorEdit">
                                </div>
                            </div>
                            <div class="col-md-3 mb-1">
                                <label for="tel2ProveedorEdit" class="form-label">Telefono 2 Proveedor</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="tel2ProveedorEdit" required
                                        name="tel2ProveedorEdit">
                                </div>
                            </div>
                            <div class="col-md-6 mb-1">
                                <label for="mailProveedorEdit" class="form-label">Correo Electronico</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="mailProveedorEdit" required
                                        name="mailProveedorEdit">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 mb-1">
                                <label for="dirProveedorEdit" class="form-label">Direccion</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="dirProveedorEdit" required
                                        name="dirProveedorEdit">
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
    <div id="formDeleteProveedor" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
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
                        <p class="mt-3 text-white">Esta seguro de eliminar Proveedor?</p>
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

            var table = $('.dtProveedor').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('index.proveedor') }}",

                columns: [{
                        data: 'idProveedor',
                        name: 'idProveedor'
                    },
                    {
                        data: 'nomProveedor',
                        name: 'nomProveedor'
                    },
                    {
                        data: 'tel1Proveedor',
                        name: 'tel1Proveedor'
                    },
                    {
                        data: 'dirProveedor',
                        name: 'dirProveedor'
                    },
                    {
                        data: 'mailProveedor',
                        name: 'mailProveedor'
                    },
                    {
                        data: 'idProveedor',
                        name: 'idProveedor',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row, meta) {
                            console.log("LLEGO FILA", row)
                            return `<a href="javascript:void(0)"  data-id="${row.idProveedor}" class="edit fas fa-pencil-alt text-info"></a> &nbsp;&nbsp;&nbsp;<a href="javascript:void(0)"  data-id="${row.idProveedor}" class="delete far fa-trash-alt text-danger"></a>`;
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
                    url: `${base_url}/almacen/proveedor/${id}`,
                    dataType: 'json',

                    success: function(response) {
                        console.log(response, "LLEGO DATA?")

                        $('#idProveedorEdit').val(response.data.idProveedor)
                        $('#nomProveedorEdit').val(response.data.nomProveedor)
                        $('#tel1ProveedorEdit').val(response.data.tel1Proveedor)
                        $('#tel2ProveedorEdit').val(response.data.tel2Proveedor)
                        $('#dirProveedorEdit').val(response.data.dirProveedor)
                        $('#mailProveedorEdit').val(response.data.mailProveedor)
                        $('#formEditarProveedor').modal('show');
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
                $('#formProveedor').modal('show');

            });

            /*<!-- AJAX UPDATE Modal -->*/
            $(document).on("click", ".update", function() {
                const id = $("#idProveedorEdit").val();
                console.log(id)

                $.ajax({
                    type: "put",
                    url: `${base_url}/almacen/proveedor/${id}`,
                    dataType: 'json',
                    data: {

                        idProveedor: $('#idProveedorEdit').val(),
                        nomProveedor: $('#nomProveedorEdit').val(),
                        tel1Proveedor: $('#tel1ProveedorEdit').val(),
                        tel2Proveedor: $('#tel2ProveedorEdit').val(),
                        dirProveedor: $('#dirProveedorEdit').val(),
                        mailProveedor: $('#mailProveedorEdit').val(),
                    },
                    success: function(response) {
                        console.log(response, "ACTUALIZO")
                        $('#formEditarProveedor').modal('hide');
                        $('.dtProveedor').DataTable().ajax.reload();
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
            $('#idProveedorDelete').val(id)
            $('#formDeleteProveedor').modal('show');
            $(".btnDelete").click(function() {
                $.ajax({
                    type: "delete",
                    url: `${base_url}/almacen/proveedor/${id}`,
                    dataType: 'json',

                    success: function(response) {
                        console.log(response, "LLEGO DATA?")
                        $('#formDeleteProveedor').modal('hide');
                        $('.dtProveedor').DataTable().ajax.reload();
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
    </script>
@endpush
