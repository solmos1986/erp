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
                <h4 class="page-title">Productos</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12">

        </div>
        <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12">

        </div>
        <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12">
            <a href="{{ url('almacen/producto/create') }}"><button type="button" id="serchbtn"
                    class="nuevo btn btn-sm btn-success waves-effect waves-light mb-2 me-2 w-100"><i
                        class="mdi mdi-plus me-1"></i>
                    Nuevo Producto </button></a>
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
                                <th>U. Medida</th>
                                <th>Categoria</th>
                                <th>Stock Min.</th>
                                <th>P. Compra</th>
                                <th>P. Venta</th>
                                <th>Stock Actual</th>
                                <th>Accion</th>
                            </tr>
                        </thead>
                        <tbody>


                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
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
    <script src="{{ asset('/libs/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('/libs/dropzone/min/dropzone.min.js') }}"></script>
    
    <script src="{{ asset('/js/producto/index.js') }}"></script>
@endpush
