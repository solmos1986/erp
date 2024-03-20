@extends('layouts.admin')
@push('css')
    <!-- third party css -->
    <link href="{{ asset('/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/libs/dropzone/min/dropzone.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/libs/mohithg-switchery/switchery.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/libs/selectize/css/selectize.bootstrap3.css') }}" rel="stylesheet" type="text/css" />
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
    <link href="{{ asset('/libs/clockpicker/bootstrap-clockpicker.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('/libs/flatpickr/flatpickr.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/libs/spectrum-colorpicker2/spectrum.min.css') }}" rel="stylesheet" type="text/css">
    {{-- <link href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" /> --}}
@endpush

@section('contenido')
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
                <h4 class="page-title"><b>OC - ORDEN DE COMPRA</b></h4>
            </div>
        </div>
    </div>
    <!-- end page title -->


    <div class="row">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <h5 class="text-uppercase bg-light p-2 mt-0 mb-3">INFO COMPRA</h5>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label for="fechaOC" class="form-label">Fecha</label>
                            <input type="text" id="fechaOC" class="form-control" placeholder="Date and Time"
                                value="<?php echo date('Y-m-d H:i:s'); ?>">
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <label for="EstadoOC" class="form-label">Estado <span class="text-danger">*</span></label>
                        <select class="form-control select2" id="EstadoOC">
                            <option value="1">Ordenado</option>
                            <option value="2">Recibido-Pagado</option>
                            <option value="3">Recibido-NoPagado</option>
                            <option value="4">NoRecibido-Pagado</option>
                        </select>

                    </div>
                    <div class="col-lg-3">
                        <label for="nomUsuario" class="form-label">Usuario <span class="text-danger">*</span></label>
                        <select class="form-control select2" id="nomUsuario">
                            @foreach ($usuario as $user)
                                <option value="{{ $user->idUsuario }}">{{ $user->nomUsuario }}</option>
                            @endforeach
                        </select>

                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3">
                        <div class="mb-3" id="12">
                            <label for="nomProveedor" class="form-label">Proveedor <span
                                    class="text-danger">*</span></label>
                            <select class="form-control select2" id="nomProveedor">
                                @foreach ($proveedor as $pro)
                                    <option value="{{ $pro->idProveedor }}">{{ $pro->nomProveedor }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="mb-3" id="12">
                            <label for="MetodoPago" class="form-label">Metodo de Pago <span
                                    class="text-danger">*</span></label>
                            <select class="form-control select2" id="MetodoPago">
                                @foreach ($tipopago as $fp)
                                    <option value="{{ $fp->idTipoPago }}">{{ $fp->nomTipoPago }}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                    <div class="col-lg-2">
                        <div class="mb-3" id="12">
                            <label for="TipoComprobante" class="form-label">Tipo Comprobante <span
                                    class="text-danger">*</span></label>
                            <select class="form-control select2" id="TipoComprobante" value='1'>
                                @foreach ($tipo_comprobante as $tp)
                                    <option value="{{ $tp->impuestoComprobante }}">
                                        {{ $tp->nomTipoComprobante }}
                                    </option>
                                @endforeach

                            </select>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="mb-3" id="12">
                            <label for="impuestoCompra" class="form-label">Impuestos <span
                                    class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="impuestoCompra" placeholder="# comprobante.."
                                value="1">
                        </div>

                    </div>
                    <div class="col-lg-2">
                        <div class="mb-3" id="12">
                            <label for="NumComprobante" class="form-label">No. Comprobante <span
                                    class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="NumComprobante"
                                placeholder="# comprobante..">
                        </div>

                    </div>

                </div>
                <div class="row">


                </div>
                <div class="row">

                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-xl-6">

            <div class="card">
                <div class="card-body">
                    <h5 class="text-uppercase bg-light p-2 mt-0 mb-3">SELECCIONA PRODUCTOS</h5>

                    <table id="dtProducto" class="dtProducto table dt-responsive nowrap w-100" style="min-block-size: ;">
                        <thead>
                            <tr>
                                {{--    <th>Imagen</th> --}}
                                <th>Codigo</th>
                                <th>Producto</th>
                                <th>Unid.Medida</th>
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


        <div class="col-md-12 col-xl-6 container py-0">
            <div class="row justify-content-center mb-0">
                <div class="col-md-12 col-xl-12">
                    <div class="card shadow-0 border rounded-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 col-lg-12 col-xl-12">
                                    <h5>DETALLE</h5>
                                    <div class="table-responsive">
                                        <table class="dtCart table  table-nowrap table-centered mb-0" id="dtCart"
                                            style="min-block-size: ;">
                                            <thead class="table-light">
                                                <tr>
                                                    <th style="max-width: 35%; overflow: hidden; word-break: break-all;">
                                                        Producto</th>

                                                    <th style="max-width: 20%; overflow: hidden; word-break: break-all;">
                                                        Cant.</th>
                                                    <th style="max-width: 20%; overflow: hidden; word-break: break-all;">
                                                        Precio</th>
                                                    <th style="max-width: 20%; overflow: hidden; word-break: break-all;">
                                                        Total</th>
                                                    <th style="max-width: 5%; overflow: hidden; word-break: break-all;">
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody id="dtOC">

                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th></th>
                                                    <th></th>
                                                    <th><b>Total.</b>
                                                    </th>
                                                    <th id="TotalCart"></th>
                                                    <th></th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-lg-3 col-xl-3 border-sm-start-none border-start">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="card shadow-0 border rounded-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 col-lg-12 col-xl-12">
                                    <h5>DETALLE</h5>
                                    <div class="table-responsive">
                                        <table class="dtCart table  table-nowrap table-centered mb-0" id="dtCart"
                                            style="min-block-size: ;">
                                            <thead class="table-light">
                                                <tr>
                                                    <th style="max-width: 35%; overflow: hidden; word-break: break-all;">
                                                        Producto</th>

                                                    <th style="max-width: 20%; overflow: hidden; word-break: break-all;">
                                                        Cant.</th>
                                                    <th style="max-width: 20%; overflow: hidden; word-break: break-all;">
                                                        Precio</th>
                                                    <th style="max-width: 20%; overflow: hidden; word-break: break-all;">
                                                        Total</th>
                                                    <th style="max-width: 5%; overflow: hidden; word-break: break-all;">
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody id="dtOC">

                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th></th>
                                                    <th></th>
                                                    <th><b>Total.</b>
                                                    </th>
                                                    <th id="TotalCart"></th>
                                                    <th></th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-lg-3 col-xl-3 border-sm-start-none border-start">

                                </div>
                            </div>
                        </div>
                    </div> --}}


    {{-- <div class="col-md-6">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="text-uppercase mt-0 mb-3  p-2"><B>DETALLE DE COMPRA</B></h5>
                            <div class="table-responsive">
                                <table class=" table  table-nowrap table-centered mb-0" id="dtCart">
                                    <thead class="table-light">
                                        <tr>
                                            <th width="45%">Producto</th>
                                            <th width="15%">Cantidad</th>
                                            <th width="15%">Precio</th>
                                            <th width="15%">Total</th>
                                            <th width="10%" style="width: 50px;"></th>
                                        </tr>
                                    </thead>
                                    <tbody id="dtOC">

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th>&nbsp;&nbsp;&nbsp;&nbsp;<b>Total Bs.</b></th>
                                            <th id="TotalCart"></th>
                                            <th></th>
                                        </tr>
                                    </tfoot>
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
                                        <a href="ecommerce-products.html"
                                        class="btn text-muted d-none d-sm-inline-block btn-link fw-semibold">
                                        <i class="mdi mdi-arrow-left"></i> Continue Shopping </a>
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
                    <!-- end card -->
                </div>
                <!-- end row --> --}}

    <div class="row">
        <div class="col-12">
            <div class="text-center mb-3">
                <a href="{{ url('comercial/compra') }}"><button type="button"
                        class="btn w-sm btn-light waves-effect">Cancelar</button></a>
                <button type="button"
                    class="procesar btn w-sm btn-success waves-effect waves-light guardar">Guardar</button>
                <button type="button" class="btn w-sm btn-danger waves-effect waves-light">Borrar</button>
            </div>
        </div> <!-- end col -->
    </div>
    <!-- end row -->
@endsection

@push('javascript')
    <script src="{{ asset('/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js') }}"></script>
    <!-- Select2 js-->

    <script src="{{ asset('/libs/selectize/js/standalone/selectize.min.js') }}"></script>

    <!-- Dropzone file uploads-->
    <script src="{{ asset('/libs/dropzone/min/dropzone.min.js') }}"></script>

    <!-- Quill js -->
    <script src="{{ asset('/libs/quill/quill.min.js') }}"></script>

    <!-- Init js-->

    <script src="{{ asset('/libs/select2/js/select2.min.js') }}"></script>
    <!-- Dropzone file uploads-->
    <script src="{{ asset('/libs/dropzone/min/dropzone.min.js') }}"></script>

    <!-- Quill js -->
    <script src="{{ asset('/libs/quill/quill.min.js') }}"></script>

    <!-- Init js-->

    <script src="{{ asset('/libs/jquery-mockjax/jquery.mockjax.min.js') }}"></script>
    <script src="{{ asset('/libs/devbridge-autocomplete/jquery.autocomplete.min.js') }}"></script>
    <script src="{{ asset('/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js') }}"></script>
    <script src="{{ asset('/libs/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
    <script src="{{ asset('/libs/mohithg-switchery/switchery.min.js') }}"></script>
    <script src="{{ asset('/libs/multiselect/js/jquery.multi-select.js') }}"></script>
    <script src="{{ asset('/libs/clockpicker/bootstrap-clockpicker.min.js') }}"></script>
    <script src="{{ asset('/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('/libs/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ asset('/libs/spectrum-colorpicker2/spectrum.min.js') }}"></script>
    {{-- <script src="{{ asset('/js/pages/form-pickers.init.js') }}"></script> --}}

    {{-- <script src="{{ asset('/js/pages/form-fileuploads.init.js') }}"></script>
    <script src="{{ asset('/js/pages/form-fileuploads.init.js') }}"></script>
    <script src="{{ asset('/js/pages/add-product.init.js') }}"></script>
    <!-- Init js -->
    <script src="{{ asset('/js/pages/add-product.init.js') }}"></script>
    <!-- Select2 js-->
    <script src="{{ asset('/js/pages/form-advanced.init.js') }}"></script> --}}
    <style>
        .texto {
            min-width: 80px;
            max-width: 180px;
            overflow: hidden;
            word-break: break-all;
        }
    </style>
    <script>
        var detallecompra = []
        console.log('detallecompra inicial', detallecompra)
        /*    $(document).ready(function() {
               $.ajax({
                   type: "get",
                   url: `${base_url}/comercial/detalle-compra`,
                   dataType: 'json',
                   success: function callbackFuntion(response) {
                       console.log(response, "ACTUALIZO")
                       detallecompra =

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
           }); */
        /* $(document).ready(function() {
            var dttable = $('#dtProducto').DataTable({
                columnDefs: [{
                    targets: 1,
                    className: "text-truncate"
                }],
                createdRow: function(row) {
                    var td = $(row).find(".text-truncate");
                    var td = $(row).find(".");
                    td.attr("title", td.html());
                }
            });
        }); */
        $(document).ready(function() {

            let table = $('.dtProducto').DataTable({
                columnDefs: [{
                    targets: 1,
                    className: "texto"
                }],
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
                },


            });


            function agregarOpciones(domElement, proveedor) {
                // Cargar todos los selects
                console.log(proveedor, "add options");
                let selects = document.getElementsByName(domElement);
                // Seleccionar el último
                let select = selects[selects.length - 1];

                for (value in proveedor) {
                    let option = document.createElement("option");
                    option.value = proveedor[value];
                    option.text = proveedor[value];
                    select.add(option);
                }
            }
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
                            <td style="min-width: 80px; max-width:200px; overflow: hidden; word-break: break-all;"><p class="">${item.codProducto}<br>${item.nomProducto}</p><input type="hidden" min="1" name="idProducto[]" value="${item.idProducto}" id="idProducto${i}" class="id form-control" placeholder="0" style="width: 90px;"></td>
                            <td><input type="number" min="1" value="${item.cantidad}" data-id="${i}" name="cantidad[]" class="cantidad form-control" placeholder="0" style="width: 90px;"></td>
                            <td><input type="number" min="1" value="${item.precio}" data-id="${i}" name="precio[]" class="precio form-control" placeholder="0" style="width: 90px;"></td>
                            <td class="total${i}">${item.precioTotal}</td>
                            <td class="delete${i}"><i data-id="${i}"  class="deleteItem fas fa-trash-alt text-danger"></i></td>
                        </tr>
                        `
            });
            $('#dtOC').append(html)
        }
        $(document).on('click', '.procesar', function() {
            if ($('#impuestoCompra').val() == 0) {
                var idTC = 1
            } else {
                var idTC = 2
            }
            var dato = {
                detallecompra: detallecompra,
                idProveedor: $('#nomProveedor').val(),
                idTipoPago: $('#MetodoPago').val(),
                idTipoComprobante: idTC,
                numeroComprobante: $('#NumComprobante').val(),
                fechaEgreso: $('#fechaOC').val(),
                impuestoEgreso: $('#impuestoCompra').val(),
                estadoEgreso: 1,
                idUsuario: $('#nomUsuario').val(),


            };
            console.log(dato, "ENVIADO A STORE");
            $.ajax({
                type: "post",
                url: `${base_url}/comercial/compra`,
                dataType: 'json',
                data: dato,
                success: function(response) {
                    console.log(response.data, "ACTUALIZO")
                    // window.location = "index";
                    Swal.fire({
                        title: 'Desea imprimir?',
                        text: "Esta proceso es irreversible",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Si, imprimir!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            verPDF(response.data)

                        } else {
                            window.location = "index";
                        }
                    })




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

        function verPDF(id) {
            window.open(`${base_url}/comercial/compra-pdf/${id}`, '_blank');
            window.location = "index";
        }

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
        var comprobante = document.getElementById("TipoComprobante");
        comprobante.addEventListener("change", function() {
            console.log("Comprobante cambio", comprobante.value)
            calcularImpuesto();
        });

        function calcularImpuesto() {
            var impuesto = comprobante.value;
            var costoIns = $("#TotalCart").val();;
            console.log("Valor Total CArt", costoIns)
            var tImpuesto = impuesto * costoIns;
            $('#impuestoCompra').val(tImpuesto);
            console.log(tImpuesto, "Valor Comprobante");

        }

        function SumaTotales() {
            let tabla = document.getElementById("dtOC");
            let total = 0;
            detallecompra.map((item, i) => {
                total += parseFloat(item.precioTotal);
                $("#TotalCart").val(total);
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
            calcularImpuesto();
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


    <!-- Init js -->
@endpush
