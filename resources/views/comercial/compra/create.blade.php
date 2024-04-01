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
    <link href="{{ asset('/libs/printjs/print.min.css') }}" rel="stylesheet" type="text/css">
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

                <div class="row bg-light p-2 mt-0 mb-3">
                    <div class="col-lg-6">
                        <h5 class="text-uppercase  ">INFO COMPRAS</h5>
                    </div>
                    <div class="col-lg-2">

                    </div>
                    <div class="col-lg-4">
                        <div class="text-lg-end mr-0">
                            <a id="creaProducto"><button type="button" id="serchbtn"
                                    class="nuevop btn btn-success waves-effect waves-light mb-0 me-0 mr-1"><i
                                        class="mdi mdi-plus me-1"></i>
                                    Crear Proveedor</button></a>
                        </div>
                    </div>

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
                            <select class="form-control select2" id="nomProveedor" name="nomProveedor">
                                <option value="">Seleccione...</option>
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
                    <div class="row bg-light p-2 mt-0 mb-3">
                        <div class="col-lg-6">
                            <h5 class="text-uppercase  ">SELECCIONA PRODUCTOS</h5>
                        </div>
                        <div class="col-lg-2">

                        </div>
                        <div class="col-lg-4">
                            <div class="text-lg-end mr-0">
                                <a id="creaProducto"><button type="button" id="serchbtn"
                                        class="creaProducto btn btn-success waves-effect waves-light mb-0 me-0 mr-1"><i
                                            class="mdi mdi-plus me-1"></i>
                                        Crear Producto</button></a>
                            </div>
                        </div>

                    </div>


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
                                    <h5><b>DETALLE</b></h5>
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
    @include('commom.ModalCrear_Proveedor')
    @include('commom.ModalCrear_Producto')
    @include('commom.ModalImprimir_VentaCompra')
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
    <script src="{{ asset('/libs/printjs/print.min.js') }}"></script>
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

        $(document).ready(function() {
            var message = "Custom message here";
            var title = "Hello World!";

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



            $('#dtProducto').on('click', '.addCart', function() {
                var data = table.row($(this).closest('tr')).data();
                //push
                const validador = detallecompra.find(((item) => item.idProducto == data
                    .idProducto));
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
            $.ajax({
                type: "post",
                url: `${base_url}/comercial/compra`,
                dataType: 'json',
                data: dato,
                success: function(response) {

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
                        text: 'ejemplos!',
                    });
                },
                fail: function() {}
            });
        });

        function verPDF(id) {
            var frame = $('#iframePDF');
            var ahref = $('#cancelPDF');
            //LOADER
            $.ajax({
                type: "GET",
                url: `${base_url}/comercial/compra-pdf/${id}`,
                dataType: 'json',
                success: function(response) {
                    var src = `data:application/pdf;base64,${response.data}`;
                    $('#modalImprimir .modal-title').text('ORDEN DE COMPRA');
                    ahref.attr('href', "{{ url('comercial/compra/index') }}");
                    frame.attr('src', `data:application/pdf;base64,${response.data}`);
                    $('#modalImprimir').modal('show');
                    $('#iframePDF').data('url', response.data)
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log('error de programacion');
                    Swal.fire({
                        type: 'error',
                        title: 'Oops...',
                        text: 'ejemplo!',
                    });
                },
                fail: function() {}
            });

        }
        $(document).on('keyup change', '.precio', function() {

            let precio = $(this).val();
            let posicion = $(this).data('id');
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
            SumaTotales();
        });

        $(document).on('keyup change', '.cantidad', function() {
            let cantidad = $(this).val();
            let posicion = $(this).data('id');
            detallecompra.map((item, i) => {
                if (i == posicion) {
                    item.precioTotal = parseFloat(item.precio * cantidad);
                    item.cantidad = parseFloat(cantidad);
                    $(`.total${posicion}`).text(item.precioTotal);
                }
            })
            SumaTotales();
        });

        var comprobante = document.getElementById("TipoComprobante");
        comprobante.addEventListener("change", function() {
            calcularImpuesto();
        });

        function calcularImpuesto() {
            var impuesto = comprobante.value;
            var costoIns = $("#TotalCart").val();
            var tImpuesto = impuesto * costoIns;
            $('#impuestoCompra').val(tImpuesto);
        }

        function SumaTotales() {
            let tabla = document.getElementById("dtOC");
            let total = 0;
            detallecompra.map((item, i) => {
                total += parseFloat(item.precioTotal);
                $("#TotalCart").val(total);
            });
            $("#TotalCart").html(total);
            calcularImpuesto();
        }

        $(document).on('click', '.deleteItem', function() {
            let posicion = $(this).data('id');
            let tr = document.querySelector('#fila' + posicion)
            tr.remove();
            detallecompra.splice(posicion, 1);
            SumaTotales();
            //renderDetalleVenta()
        })

        $(document).on("click", ".nuevop", function() {
            $('#formProveedor').modal('show');

        });

        $(document).on("click", ".guardarp", function() {
            $.ajax({
                type: "post",
                url: "{{ route('store.proveedor') }}",
                dataType: 'json',
                data: {
                    nomProveedor: $('#nomProveedorp').val(),
                    tel1Proveedor: $('#tel1Proveedorp').val(),
                    tel2Proveedor: $('#tel2Proveedorp').val(),
                    dirProveedor: $('#dirProveedorp').val(),
                    mailProveedor: $('#mailProveedorp').val(),
                },
                success: function(response) {
                    $('#formProveedor').modal('hide');
                    var proveedor = response.data
                    var id = proveedor.idProveedor
                    var nom = proveedor.nomProveedor
                    $('#nomProveedor')
                        .append($("<option selected></option>")
                            .attr("value", id)
                            .text(nom));
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    //error_status(jqXHR)
                },
                fail: function() {
                    //fail()
                }
            })
        });

        $(document).on('click', '.imprimir', function() {
            const base64 = $('#iframePDF').data('url')
            printJS({
                printable: base64,
                type: 'pdf',
                base64: true,
                onPrintDialogClose: () => {
                    $('#modalImprimir').modal('hide');
                    window.location = "index";
                }
            });

        })
        $(document).on('click', '.creaProducto', function() {
            $('#crearProducto').modal('show');
        })
        $(document).on('click', '.guardarprod', function() {
            $.ajax({
                type: "post",
                url: `${base_url}/almacen/producto`,
                dataType: 'json',
                data: {
                    codProducto: $('#codProducto').val(),
                    nomProducto: $('#nomProducto').val(),
                    stockMinimo: $('#stockMinimo').val(),
                    unidadMedida: $('#unidadMedida').val(),
                    idCategoria: 1,
                },
                success: function(response) {
                    console.log(response.data, "GUARDO PRODUCTO CON EXITOOO")
                    $('#crearProducto').modal('hide');
                    $('.dtProducto').DataTable().ajax.reload();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    //error_status(jqXHR)
                },
                fail: function() {
                    //fail()
                }
            })

        })
    </script>
    <!-- Init js -->
@endpush
