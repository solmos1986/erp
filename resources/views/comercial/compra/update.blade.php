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
                            <h5 class="text-uppercase mt-0 mb-3  p-2">DETALLE</h5>
                            <div class="table-responsive">
                                <table class=" table table-borderless table-nowrap table-centered mb-0" id="dtCart">
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
                                    <tfoot>
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total Bs.</th>
                                            <th id="TotalCart"></th>
                                        </tr>
                                    </tfoot>
                                </table>
                                <br>
                                {{-- <div class="border p-3 mt-4 mt-lg-0 rounded">
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

                                </div> --}} <!-- end table-responsive-->

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
                                            <i class="procesar mdi mdi-cart-plus btn btn-danger">Procesar</i>
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



                    </div> <!-- end col-->
                    <div class="card">
                        <div class="card-body">
                            <h5 class="text-uppercase mt-0 mb-3  p-2">OTRA INFO</h5>





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
                $.ajax({
                    type: "get",
                    url: `${base_url}/comercial/detalle-compra`,
                    dataType: 'json',
                    success: function callbackFuntion(response) {
                        console.log(response, "ACTUALIZO")
                        detallecompra = response.data;
                        SumaTotales();
                        renderDetalleVenta()

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
            $(document).ready(function() {

                let table = $('.dtProducto').DataTable({

                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('create.compra') }}",

                    columns: [{
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
                                return `<i data-id="${row.idProducto}" class="addCart fas fa-shopping-cart text-success"></i>`;
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

                $('#dtProducto').on('click', '.addCart', function() {
                    var data = table.row($(this).closest('tr')).data();
                    //push
                    const validador = detallecompra.find(((item) => item.idProducto == data
                        .idProducto));
                    console.log('detallecompra1', detallecompra, validador)
                    if (validador == undefined) {
                        detallecompra.push({
                            ...data,
                            cantidad: 1,
                            precio: 0,
                            precioTotal: 0
                        });
                    } else {
                        detallecompra.map(item => {
                            if (item.idProducto == data.idProducto) {
                                item.cantidad = item.cantidad + 1;
                                item.precioTotal = parseFloat((item.precio * item.cantidad)
                                    /* .repleace(",", ".") */
                                ) /* .toFixed(2) */ ;
                            }
                        });
                    }
                    console.log('detallecompraAddCard', detallecompra)
                    SumaTotales();
                    renderDetalleVenta()
                });
            });

            function renderDetalleVenta() {
                $('#dtOC').html('')
                let html = ``;
                detallecompra.forEach((item, i) => {
                    html += `
                        <tr id="fila${i}">
                            <td>${item.nomProducto}<input type="hidden" min="1" name="idProducto[]" value="${item.idProducto}" id="idProducto${i}" class="id form-control" placeholder="0" style="width: 90px;"></td>
                            <td><input type="number" min="1" value="${item.precio}" data-id="${i}" name="precio[]" class="precio form-control" placeholder="0" style="width: 90px;"></td>
                            <td><input type="number" min="1" value="${item.cantidad}" data-id="${i}" name="cantidad[]" class="cantidad form-control" placeholder="0" style="width: 90px;"></td>
                            <td class="total${i}">${item.precioTotal}</td>
                            <td class="delete${i}"><i data-id="${i}"  class="deleteItem fas fa-trash-alt text-danger"></i></td>
                        </tr>
                        `
                });
                $('#dtOC').append(html)
            }
            $(document).on('click', '.procesar', function() {
                $.ajax({
                    type: "post",
                    url: `${base_url}/comercial/compra`,
                    dataType: 'json',
                    data: {
                        detallecompra: detallecompra,
                        idproveedor: 1,

                    },
                    success: function callbackFuntion(response) {
                        console.log(response, "ACTUALIZO")
                        /* window.location = "index";
                         */
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
            });
            $(document).on('keyup change', '.precio', function() {

                let precio = $(this).val();
                let posicion = $(this).data('id');
                /* let td = '#pro' + posicion
                let colum = $(this).data('td');
                console.log(precio, posicion, colum, "PROBANDO") */
                let total = 0;
                detallecompra.map((item, i) => {
                    if (i == posicion) {
                        item.precioTotal = parseFloat(precio * item.cantidad);
                        item.precio = parseFloat(precio);
                        $(`.total${posicion}`).text(item
                            .precioTotal); //restringir cantidad decimales
                    }
                    total += item.precioTotal
                })

                console.log(detallecompra, "Mapeando Precio")
                SumaTotales();
            });
            $(document).on('keyup change', '.cantidad', function() {
                let cantidad = $(this).val();
                let posicion = $(this).data('id');
                console.log(cantidad, posicion)
                detallecompra.map((item, i) => {
                    if (i == posicion) {
                        item.precioTotal = parseFloat(item.precio * cantidad);
                        item.cantidad = parseFloat(cantidad);
                        $(`.total${posicion}`).text(item.precioTotal);
                    }
                })
                console.log(detallecompra, "Mapeando cantidad")
                SumaTotales();
            });

            function SumaTotales() {
                let tabla = document.getElementById("dtOC");
                let total = 0;
                detallecompra.map((item, i) => {
                    total += parseFloat(item.precioTotal);
                });
                $("#TotalCart").html(total);
                /* console.log(longitud, "numero de filas") */
                /* for (let i = 0, celda; i < tabla.rows.length; i++) {
                    let celda = tabla.rows[i].cells[3].firstChild.data;
                    console.log(celda, "CELDAAAA")
                    total += parseFloat(celda);
                    console.log(total, "cTotal");
                    $("#TotalCart").html(total);
                    //renderDetalleVenta();
                } */

            }

            $(document).on('click', '.deleteItem', function() {
                let posicion = $(this).data('id');
                let tr = document.querySelector('#fila' + posicion)
                tr.remove();
                console.log('eliminando elemento', posicion)
                detallecompra.splice(posicion, 1);
                console.log('resultado', detallecompra)
                SumaTotales();
                //renderDetalleVenta()
            })
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
