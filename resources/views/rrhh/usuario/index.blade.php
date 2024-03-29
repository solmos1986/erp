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
                        <li class="breadcrumb-item"><a href="#">RRHH</a></li>
                        <li class="breadcrumb-item active">Usuarios</li>
                    </ol>
                </div>
                <h4 class="page-title">USUARIOS</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-md-3 mb-2">
            <div class="input-group">
                <input type="text" class="form-control" id="validationCustom15" placeholder="Buscar usuario" required>
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
                    <table id="dtUsuario" class="table dt-responsive nowrap w-100 dtUsuario">
                        <thead>
                            <tr>
                                <th>Codigo</th>
                                <th>Usuario</th>
                                <th>Telefono</th>
                                <th>Direccion</th>
                                <th>Identificacion</th>
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

    <!-- MODAL  -->

    <!-- NUEVO Modal -->
    <div class="modal fade" id="formUsuario" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
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
        {!! Form::open(['url' => 'rrhh/usuario', 'method' => 'POST', 'autocomplete' => 'off']) !!}
        {{ Form::token() }}

        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Crear Usuario</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="needs-validation" novalidate>
                        <div class="row">

                            <div class="col-md-8 mb-1">
                                <label for="nomUsuario" class="form-label">Nombre Usuario</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="nomUsuario" placeholder="Ingrese Usuario"
                                        required name="nomUsuario">
                                </div>
                            </div>
                            <div class="col-md-4 mb-1">
                                <label for="docUsuario" class="form-label">NIT / CI</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="docUsuario" placeholder="No. Documento"
                                        required name="docUsuario">
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-4 mb-1">
                                <label for="telUsuario" class="form-label">Telefono Usuario</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="telUsuario" placeholder="Telefono"
                                        required name="telUsuario">
                                </div>
                            </div>
                            <div class="col-md-8 mb-1">
                                <label for="mailUsuario" class="form-label">Correo Electronico</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="mailUsuario" placeholder="E-mail"
                                        required name="mailUsuario">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mb-1">
                                <label for="dirUsuario" class="form-label">Direccion</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="dirUsuario" placeholder="Direccion"
                                        required name="dirUsuario">
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

    <div class="modal fade" id="formEditarUsuario" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
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
                    <h4 class="modal-title" id="myLargeModalLabel">Editar Usuario</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="needs-validation" novalidate>
                        <div class="row">
                            <div class="col-md-2 mb-1">
                                <label for="idUsuario" class="form-label">Id Usuario</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="idUsuarioEdit" placeholder=""
                                        required name="idUsuario">
                                </div>
                            </div>
                            <div class="col-md-7 mb-1">
                                <label for="nomUsuario" class="form-label">Nombre Usuario</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="nomUsuarioEdit" required
                                        name="nomUsuarioEdit">
                                </div>
                            </div>
                            <div class="col-md-3 mb-1">
                                <label for="docUsuario" class="form-label">NIT / CI</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="docUsuarioEdit" required
                                        name="docUsuarioEdit">
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-md-4 mb-1">
                                <label for="telUsuario" class="form-label">Telefono Usuario</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="telUsuarioEdit" required
                                        name="telUsuario">
                                </div>
                            </div>
                            <div class="col-md-8 mb-1">
                                <label for="mailUsuario" class="form-label">Correo Electronico</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="mailUsuarioEdit" required
                                        name="mailUsuario">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 mb-1">
                                <label for="dirUsuario" class="form-label">Direccion</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="dirUsuarioEdit" required
                                        name="dirUsuario">
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
    <div id="formDeleteUsuario" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
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
                        <p class="mt-3 text-white">Esta seguro de eliminar?</p>
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

            var table = $('.dtUsuario').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('index.usuario') }}",
                columns: [{
                        data: 'idUsuario',
                        name: 'idUsuario'
                    },
                    {
                        data: 'nomUsuario',
                        name: 'nomUsuario'
                    },
                    {
                        data: 'telUsuario',
                        name: 'telUsuario'
                    },
                    {
                        data: 'dirUsuario',
                        name: 'dirUsuario'
                    },
                    {
                        data: 'docUsuario',
                        name: 'docUsuario'
                    },
                    {
                        data: 'idUsuario',
                        name: 'idUsuario',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row, meta) {
                            console.log(row)
                            return `<a href="javascript:void(0)"  data-id="${row.idUsuario}" class="edit fas fa-pencil-alt text-info"></a> &nbsp;&nbsp;&nbsp;<a href="javascript:void(0)"  data-id="${row.idUsuario}" class="delete far fa-trash-alt text-danger"></a>`;
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
                    url: `${base_url}/rrhh/usuario/${id}`,
                    dataType: 'json',

                    success: function(response) {
                        console.log(response, "LLEGO DATA?")

                        $('#idUsuarioEdit').val(response.data.idUsuario)
                        $('#nomUsuarioEdit').val(response.data.nomUsuario)
                        $('#docUsuarioEdit').val(response.data.docUsuario)
                        $('#telUsuarioEdit').val(response.data.telUsuario)
                        $('#dirUsuarioEdit').val(response.data.dirUsuario)
                        $('#mailUsuarioEdit').val(response.data.mailUsuario)
                        $('#formEditarUsuario').modal('show');
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
                $('#formUsuario').modal('show');

            });

            /*<!-- AJAX UPDATE Modal -->*/
            $(document).on("click", ".update", function() {
                const id = $("#idUsuarioEdit").val();
                console.log(id)

                $.ajax({
                    type: "put",
                    url: `${base_url}/rrhh/usuario/${id}`,
                    dataType: 'json',
                    data: {

                        idUsuario: $('#idUsuarioEdit').val(),
                        nomUsuario: $('#nomUsuarioEdit').val(),
                        docUsuario: $('#docUsuarioEdit').val(),
                        telUsuario: $('#telUsuarioEdit').val(),
                        dirUsuario: $('#dirUsuarioEdit').val(),
                        mailUsuario: $('#mailUsuarioEdit').val(),
                    },
                    success: function(response) {
                        console.log(response, "ACTUALIZO")
                        $('#formEditarUsuario').modal('hide');
                        $('.dtUsuario').DataTable().ajax.reload();
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
            console.log(id, "HOLA recibi info")
            $('#idUsuarioDelete').val(id)
            $('#formDeleteUsuario').modal('show');
            $(".btnDelete").click(function() {
                $.ajax({
                    type: "delete",
                    url: `${base_url}/rrhh/usuario/${id}`,
                    dataType: 'json',

                    success: function(response) {
                        console.log(response, "LLEGO DATA?")
                        $('#formDeleteUsuario').modal('hide');
                        $('.dtUsuario').DataTable().ajax.reload();
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        //error_status(jqXHR)
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
