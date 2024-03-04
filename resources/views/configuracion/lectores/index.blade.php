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
                        <li class="breadcrumb-item"><a href="#">Configuracion</a></li>
                        <li class="breadcrumb-item active">Control de Acceso</li>
                    </ol>
                </div>
                <h4 class="page-title">LECTORES</h4>
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
                        Nuevo Lector </button></a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="dtLectores" class="dtLectores table dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nombre</th>
                                <th>Direccion IP</th>
                                <th>Puerto</th>
                                <th>Usuario</th>
                                <th>Constraseña</th>
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
    <div class="modal fade" id="formLector" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
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
        {!! Form::open(['url' => 'configuracion/lectores', 'method' => 'POST', 'autocomplete' => 'off']) !!}
        {{ Form::token() }}

        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Agregar Lector</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="needs-validation" novalidate>
                        <div class="row">

                            <div class="col-md-12 mb-1">
                                <label for="nomLector" class="form-label">Nombre Lector</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="nomLector"
                                        placeholder="Ingrese Proveedor" required name="nomLector">
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-6 mb-1">
                                <label for="ipLector" class="form-label">Direccion IP</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="ipLector" placeholder="xxx.xxx.xxx.xxx"
                                        required name="ipLector">
                                </div>
                            </div>
                            <div class="col-md-6 mb-1">
                                <label for="portLector" class="form-label">Puerto Lector</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="portLector" placeholder="ej. 80" required
                                        name="portLector">
                                </div>
                            </div>


                        </div>
                        <div class="row">
                            <div class="col-md-12 mb-1">
                                <label for="userLector" class="form-label">Usuario</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="userLector" placeholder="user" required
                                        name="userLector">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mb-1">
                                <label for="passLector" class="form-label">Contraseña</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="passLector" placeholder="contraseña"
                                        required name="passLector">
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

    <div class="modal fade" id="formEditarLector" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
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
                    <h4 class="modal-title" id="myLargeModalLabel">Editar Lector</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="needs-validation" novalidate>
                        <div class="row">
                            <div class="col-md-4 mb-1">
                                <label for="idLectorEdit" class="form-label">Id Lector</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="idLectorEdit" placeholder="" required
                                        name="idLectorEdit">
                                </div>
                            </div>
                            <div class="col-md-8 mb-1">
                                <label for="nomLectorEdit" class="form-label">Nombre Lector</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="nomLectorEdit" required
                                        name="nomLectorEdit">
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-md-3 mb-1">
                                <label for="ipLectorEdit" class="form-label">Direccion IP</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="ipLectorEdit" required
                                        name="ipLectorEdit">
                                </div>
                            </div>
                            <div class="col-md-3 mb-1">
                                <label for="portLectorEdit" class="form-label">Puerto Lector</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="portLectorEdit" required
                                        name="portLectorEdit">
                                </div>
                            </div>
                            <div class="col-md-6 mb-1">
                                <label for="userLectorEdit" class="form-label">Usuario</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="userLectorEdit" required
                                        name="userLectorEdit">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 mb-1">
                                <label for="passLectorEdit" class="form-label">Contraseña</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="passLectorEdit" required
                                        name="passLectorEdit">
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
    <div id="formDeleteLector" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
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
                        <p class="mt-3 text-white">Esta seguro de eliminar Lector?</p>
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

            var table = $('.dtLectores').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('index.lector') }}",

                columns: [{
                        data: 'idLector',
                        name: 'idLector'
                    },
                    {
                        data: 'nomLector',
                        name: 'nomLector'
                    },
                    {
                        data: 'ipLector',
                        name: 'ipLector'
                    },
                    {
                        data: 'portLector',
                        name: 'portLector'
                    },
                    {
                        data: 'userLector',
                        name: 'userLector'
                    },
                    {
                        data: 'passLector',
                        name: 'passLector'
                    },
                    {
                        data: 'idLector',
                        name: 'idLector',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row, meta) {
                            console.log("LLEGO FILA", row)
                            return `<a href="javascript:void(0)"  data-id="${row.idLector}" class="edit fas fa-pencil-alt text-info"></a> &nbsp;&nbsp;&nbsp;<a href="javascript:void(0)"  data-id="${row.idLector}" class="delete far fa-trash-alt text-danger"></a>`;
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
                    url: `${base_url}/configuracion/lectores/${id}`,
                    dataType: 'json',

                    success: function(response) {
                        console.log(response, "LLEGO DATA?")

                        $('#idLectorEdit').val(response.data.idLector)
                        $('#nomLectorEdit').val(response.data.nomLector)
                        $('#ipLectorEdit').val(response.data.ipLector)
                        $('#portLectorEdit').val(response.data.portLector)
                        $('#userLectorEdit').val(response.data.userLector)
                        $('#passLectorEdit').val(response.data.passLector)
                        $('#formEditarLector').modal('show');
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
                $('#formLector').modal('show');

            });

            /*<!-- AJAX UPDATE Modal -->*/
            $(document).on("click", ".update", function() {
                const id = $("#idLectorEdit").val();
                console.log(id)

                $.ajax({
                    type: "put",
                    url: `${base_url}/configuracion/lectores/${id}`,
                    dataType: 'json',
                    data: {

                        idLector: $('#idLectorEdit').val(),
                        nomLector: $('#nomLectorEdit').val(),
                        ipLector: $('#ipLectorEdit').val(),
                        portLector: $('#portLectorEdit').val(),
                        userLector: $('#userLectorEdit').val(),
                        passLector: $('#passLectorEdit').val(),
                    },
                    success: function(response) {
                        console.log(response, "ACTUALIZO")
                        $('#formEditarLector').modal('hide');
                        $('.dtLectores').DataTable().ajax.reload();
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
            $('#idLectorDelete').val(id)
            $('#formDeleteLector').modal('show');
            $(".btnDelete").click(function() {
                $.ajax({
                    type: "delete",
                    url: `${base_url}/configuracion/lectores/${id}`,
                    dataType: 'json',

                    success: function(response) {
                        console.log(response, "LLEGO DATA?")
                        $('#formDeleteLector').modal('hide');
                        $('.dtLectores').DataTable().ajax.reload();
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
