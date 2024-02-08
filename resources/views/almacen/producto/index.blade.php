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
                        <li class="breadcrumb-item active">Productos</li>
                    </ol>
                </div>
                <h4 class="page-title">PRODUCTOS</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-md-3 mb-2">
            <div class="input-group">
                <input type="text" class="form-control" id="validationCustom15" placeholder="Buscar producto" required>
            </div>
        </div>
        <div class="col-md-6 mb-2">
        </div>
        <div class="col-md-3 col-md-push mb-2">

            <div class="input-group">
                <a href="{{ url('almacen/producto/create') }}"><button type="button" id="serchbtn"
                        class="btn rounded-pill btn-success">NUEVO</button></a>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="dtProducto" class="dtProducto table dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>Imagen</th>
                                <th>Codigo</th>
                                <th>Producto</th>
                                <th>Unidad Medida</th>
                                <th>Categoria</th>
                                <th>Stock Minimo</th>
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

    <!-- DELETE Modal -->
    <div id="formDeleteProducto" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
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
                        <p class="mt-3 text-white">Esta seguro de eliminar Producto?</p>
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
    <!-- Select2 js-->
    <script src="{{ asset('/libs/select2/js/select2.min.js') }}"></script>
    <!-- Dropzone file uploads-->
    <script src="{{ asset('/libs/dropzone/min/dropzone.min.js') }}"></script>

    <!-- Quill js -->
    <script src="{{ asset('/libs/quill/quill.min.js') }}"></script>

    <!-- Init js-->
    <script src="{{ asset('/js/pages/form-fileuploads.init.js') }}"></script>

    <!-- Init js -->
    <script src="{{ asset('/js/pages/add-product.init.js') }}"></script>

    <script type="text/javascript">
        /* <!--AJAX CARGA DATA TABLE Function--> */
        $(function() {

            var table = $('.dtProducto').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('index.producto') }}",

                columns: [{
                        data: 'imagenProducto',
                        name: 'imagenProducto'
                    },
                    {
                        data: 'codProducto',
                        name: 'codProducto'
                    },
                    {
                        data: 'nomProducto',
                        name: 'nomProducto'
                    },
                    {
                        data: 'unidadMedida',
                        name: 'unidadMedida'
                    },
                    {
                        data: 'idCategoria',
                        name: 'idCategoria'
                    },
                    {
                        data: 'stockMinimo',
                        name: 'stockMinimo'
                    },
                    {
                        data: 'idProducto',
                        name: 'idProducto',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row, meta) {
                            console.log("LLEGO FILA", row)
                            return `<a href="{{ url('almacen/producto/${row.idProducto}') }}"  data-id="${row.idProducto}" class="edit fas fa-pencil-alt text-info"></a> &nbsp;&nbsp;&nbsp;<a href="javascript:void(0)"  data-id="${row.idProducto}" class="delete far fa-trash-alt text-danger"></a>`;
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
        });
        /*<!-- AJAX GUARDAR Producto -->*/



        /*<!-- AJAX DELETE Modal -->*/
        $(document).on("click", ".delete", function() {
            const id = $(this).data('id');
            console.log(id, "HOLA recibi info DELETE")
            $('#idProductoDelete').val(id)
            $('#formDeleteProducto').modal('show');
            $(".btnDelete").click(function() {
                $.ajax({
                    type: "delete",
                    url: `${base_url}/almacen/producto/${id}`,
                    dataType: 'json',

                    success: function(response) {
                        console.log(response, "LLEGO DATA?")
                        $('#formDeleteProducto').modal('hide');
                        $('.dtProducto').DataTable().ajax.reload();
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
