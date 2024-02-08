@extends('layouts.admin')
@push('css')
    <!-- third party css -->
    <link href="{{ asset('/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/libs/dropzone/min/dropzone.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/libs/mohithg-switchery/switchery.min.css') }}" rel="stylesheet" type="text/css" />
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
    {{-- <link href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" /> --}}
@endpush

@section('contenido')
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Comercial</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Compras</a></li>
                                <li class="breadcrumb-item active">Orden De Compra</li>
                            </ol>
                        </div>
                        <h4 class="page-title">OC - Detalle de Compra</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->


            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="text-uppercase bg-light p-2 mt-0 mb-3">SELECCIONA PRODUCTOS</h5>

                            <table id="dtProducto" class="dtProducto table dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        {{--    <th>Imagen</th> --}}
                                        <th>Codigo</th>
                                        <th>Producto</th>
                                        <th>Unidad Medida</th>
                                        <th>Accion</th>
                                    </tr>
                                </thead>
                                <tbody>


                                </tbody>
                            </table>


                        </div>
                        <!-- end card -->
                    </div>

                </div> <!-- end col -->

                <div class="col-lg-6">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="text-uppercase mt-0 mb-3 bg-light p-2">Imagenes Producto</h5>
                            <div class="table-responsive">
                                <table class="dtOC table table-borderless table-nowrap table-centered mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Producto</th>
                                            <th>Precio</th>
                                            <th>Cantidad</th>
                                            <th>Total</th>
                                            <th style="width: 50px;"></th>
                                        </tr>
                                    </thead>
                                    <tbody id="dtOC">

                                    </tbody>
                                </table>
                                <div class="border p-3 mt-4 mt-lg-0 rounded">
                                    <h4 class="header-title mb-3">Order Summary</h4>

                                    <div class="table-responsive">
                                        <table class="table mb-0">
                                            <tbody>
                                                <tr>
                                                    <td>Grand Total :</td>
                                                    <td>$1571.19</td>
                                                </tr>
                                                <tr>
                                                    <td>Discount : </td>
                                                    <td>-$157.11</td>
                                                </tr>
                                                <tr>
                                                    <td>Shipping Charge :</td>
                                                    <td>$25</td>
                                                </tr>
                                                <tr>
                                                    <td>Estimated Tax : </td>
                                                    <td>$19.22</td>
                                                </tr>
                                                <tr>
                                                    <th>Total :</th>
                                                    <th>$1458.3</th>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                </div> <!-- end table-responsive-->

                                <!-- Add note input-->
                                <div class="mt-3">
                                    <label for="example-textarea" class="form-label">Add a Note:</label>
                                    <textarea class="form-control" id="example-textarea" rows="3" placeholder="Write some note.."></textarea>
                                </div>

                                <!-- action buttons-->
                                <div class="row mt-4">
                                    <div class="col-sm-6">
                                        {{-- <a href="ecommerce-products.html"
                                        class="btn text-muted d-none d-sm-inline-block btn-link fw-semibold">
                                        <i class="mdi mdi-arrow-left"></i> Continue Shopping </a> --}}
                                    </div> <!-- end col -->
                                    <div class="col-sm-6">
                                        <div class="text-sm-end">
                                            <a href="ecommerce-checkout.html" class="btn btn-danger"><i
                                                    class="mdi mdi-cart-plus me-1"></i> Checkout </a>
                                        </div>
                                    </div> <!-- end col -->
                                </div> <!-- end row-->
                            </div>
                            <!-- end col -->

                            <div class="col-lg-4">


                                <!-- Preview -->
                                <div class="dropzone-previews mt-3" id="file-previews"></div>
                            </div>
                        </div> <!-- end col-->

                        <div class="card">
                            <div class="card-body">
                                <h5 class="text-uppercase bg-light p-2 mt-0 mb-3">Almacen</h5>





                                {{-- <div class="row">
                                <div class="col-4">
                                    <label for="precioCompra">Precio Compra <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="precioCompra" placeholder="Enter amount">
                                </div>
                                <div class="col-4">
                                    <label for="pecioVenta">Precio Venta <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="pecioVenta" placeholder="Enter amount">
                                </div>
                                <div class="col-4">
                                    <label for="stockMinimo">Stock Minimo <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="stockMinimo" placeholder="Enter amount">
                                </div>
                            </div> --}}
                            </div>
                        </div> <!-- end card -->

                    </div> <!-- end col-->
                </div>
                <!-- end row -->

                <div class="row">
                    <div class="col-12">
                        <div class="text-center mb-3">
                            <a href="{{ url('almacen/producto') }}"><button type="button"
                                    class="btn w-sm btn-light waves-effect">Cancelar</button></a>
                            <button type="button"
                                class="btn w-sm btn-success waves-effect waves-light guardar">Guardar</button>
                            <button type="button" class="btn w-sm btn-danger waves-effect waves-light">Borrar</button>
                        </div>
                    </div> <!-- end col -->
                </div>
                <!-- end row -->



            </div>
        </div>
    @endsection

    @push('javascript')
        <script>
            var detallecompra = []
            console.log('detallecompra inicial', detallecompra)
            $(document).ready(function() {

                let table = $('.dtProducto').DataTable({

                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('create.compra') }}",

                    columns: [
                        /* {
                                                    data: 'imagenProducto',
                                                    name: 'imagenProducto'
                                                }, */
                        {
                            data: 'idProducto',
                            name: 'idProducto'
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
                            data: 'idProducto',
                            name: 'idProducto',
                            orderable: false,
                            searchable: false,
                            render: function(data, type, row, meta) {
                                return `<i data-id="${row.idProducto}" class="edit fas fa-shopping-cart text-success"></i>`;
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

                $('#dtProducto').on('click', '.edit', function() {
                    var data = table.row($(this).closest('tr')).data();
                    console.log("ROWWW SERGIOOOO", data);
                    //push
                    const validador = detallecompra.find((producto => producto.idProducto == data.idProducto));
                    console.log('validador', validador)
                    if (validador == undefined) {
                        detallecompra.push({
                            ...data,
                            cantidad: 1
                        });
                    } else {
                        detallecompra.map(producto => {
                            if (producto.idProducto == data.idProducto) {
                                producto.cantidad = producto.cantidad + 1;
                            }
                        });
                    }

                    console.log('detallecompra', detallecompra)

                    console.log("DATA VALUE", data);
                    console.log("ROWWW 333333333", data);

                    table_filtered = table.rows({
                        page: 'current'
                    })

                    console.log({
                        data: table_filtered.data()
                    });

                    renderDetalleVenta()

                });
            });

            function renderDetalleVenta() {
                let precioTotal = 0;
                $('#dtOC').html('')
                let html = ``;

                detallecompra.forEach(producto => {

                    html += `
                        <tr>
                            <td>${producto.nomProducto}</td>
                            <td><input type="text" value="0"></td>
                            <td><input type="text" value="${producto.cantidad}"></td>
                            <td>${producto.nomProducto}</td>
                        </tr>
                        `
                });
                $('#dtOC').append(html)
            }
        </script>

        {{--  <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
        <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script> --}}
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
        <script src="{{ asset('/libs/jquery-mockjax/jquery.mockjax.min.js') }}"></script>
        <script src="{{ asset('/libs/devbridge-autocomplete/jquery.autocomplete.min.js') }}"></script>
        <script src="{{ asset('/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js') }}"></script>
        <script src="{{ asset('/libs/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
        <script src="{{ asset('/libs/mohithg-switchery/switchery.min.js') }}"></script>
        <script src="{{ asset('/libs/multiselect/js/jquery.multi-select.js') }}"></script>
    @endpush
