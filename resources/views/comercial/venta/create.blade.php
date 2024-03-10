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
    {{-- <link href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" /> --}}
@endpush

@section('contenido')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">UBold</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Ecommerce</a></li>
                        <li class="breadcrumb-item active">Ventas</li>
                    </ol>
                </div>
                <h4 class="page-title">VENTA</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row justify-content-between">
                        <div class="col-auto">
                            <form class="d-flex flex-wrap align-items-center">
                                <label for="inputPassword2" class="visually-hidden">Search</label>
                                <div class="me-3">
                                    <input type="search" class="form-control my-1 my-lg-0" id="inputPassword2"
                                        placeholder="Search...">
                                </div>
                                <label for="status-select" class="me-2">Sort By</label>
                                <div class="me-sm-3">
                                    <select class="form-select my-1 my-lg-0" id="status-select">
                                        <option selected="">All</option>
                                        <option value="1">Popular</option>
                                        <option value="2">Price Low</option>
                                        <option value="3">Price High</option>
                                        <option value="4">Sold Out</option>
                                    </select>
                                </div>
                            </form>
                        </div>
                        <div class="col-auto">
                            <div class="text-lg-end my-1 my-lg-0">
                                <button type="button" class="btn btn-success waves-effect waves-light me-1"><i
                                        class="mdi mdi-cog"></i></button>
                                <a href="ecommerce-product-edit.html" class="btn btn-danger waves-effect waves-light"><i
                                        class="mdi mdi-plus-circle me-1"></i> Add New</a>
                            </div>
                        </div><!-- end col-->
                    </div> <!-- end row -->
                </div>
            </div> <!-- end card -->
        </div> <!-- end col-->
    </div>
    <!-- end row-->
    <div class="row">
        <div class="col-md-6 col-lg-6 col-xl-6 container py-0">
            <div class="row justify-content-center mb-0" id="list_cards">

            </div>
            <div class="row">
                <div class="col-12">
                    <ul class="pagination pagination-rounded justify-content-end mb-3">
                        <li class="page-item">
                            <a class="page-link" href="javascript: void(0);" aria-label="Previous">
                                <span aria-hidden="true">«</span>
                                <span class="visually-hidden">Previous</span>
                            </a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="javascript: void(0);">1</a></li>
                        <li class="page-item"><a class="page-link" href="javascript: void(0);">2</a></li>
                        <li class="page-item"><a class="page-link" href="javascript: void(0);">3</a></li>
                        <li class="page-item"><a class="page-link" href="javascript: void(0);">4</a></li>
                        <li class="page-item"><a class="page-link" href="javascript: void(0);">5</a></li>
                        <li class="page-item">
                            <a class="page-link" href="javascript: void(0);" aria-label="Next">
                                <span aria-hidden="true">»</span>
                                <span class="visually-hidden">Next</span>
                            </a>
                        </li>
                    </ul>
                </div> <!-- end col-->
            </div> <!-- end row-->
            {{-- </div> <!-- end col-8--> --}}
        </div>
        <div class="col-md-6 col-lg-6 col-xl-6 container py-0">
            <div class="row justify-content-center mb-0">
                <div class="col-md-12 col-xl-12">
                    <div class="card shadow-0 border rounded-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 col-lg-12 col-xl-12 mb-4 mb-lg-0">
                                    <div class="row mb-1">
                                        <label for="fechaVenta" class="form-label col-2 col-xl-2">Fecha</label>
                                        <div class="col-4 col-xl-4">
                                            <input type="text" class="form-control form-control-sm" id="fechaVenta"
                                                name="date" placeholder="Fecha" value="<?php echo date('Y-m-d H:i:s'); ?>">
                                        </div>
                                        <label for="idVendedor" class="form-label col-2 col-xl-2">Vendedor</label>
                                        <select class="form-control form-control-sm" id="idTipoPago">
                                            @foreach ($usuario as $user)
                                                <option value="{{ $user->idUsuario }}">{{ $user->nomUsuario }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="row mb-1">
                                        <label for="idCliente" class="form-label col-2 col-xl-2">Cliente</label>
                                        <div class="col-10 col-xl-10">
                                            <select class="form-control form-control-sm" id="idCliente">
                                                @foreach ($cliente as $cli)
                                                    <option value="{{ $cli->idCliente }}">{{ $cli->nomCliente }}
                                                    </option>
                                                @endforeach
                                            </select>

                                        </div>
                                    </div>
                                    <div class="row mb-1">
                                        <label for="docCliente" class="form-label col-2 col-xl-2">NIT/CI</label>
                                        <div class="col-4 col-xl-4">
                                            <input type="select" class="form-control form-control-sm" id="docCliente"
                                                placeholder="NIT/CI">
                                        </div>
                                        <label for="idTipoPago" class="form-label col-2 col-xl-2">Tipo Pago</label>
                                        <div class="col-4 col-xl-4">
                                            <select class="form-control form-control-sm" id="idTipoPago">
                                                @foreach ($tipopago as $tp)
                                                    <option value="{{ $tp->idTipoPago }}">{{ $tp->nomTipoPago }}</option>
                                                @endforeach
                                            </select>

                                        </div>

                                    </div>
                                    <div class="row mb-1">
                                        <label for="idTipoComprobante"
                                            class="form-label col-2 col-xl-2">Comprobante</label>
                                        <div class="col-4 col-xl-4">
                                            <div class="col-12 col-xl-12">
                                                <select class="form-control form-control-sm" id="idTipoComprobante">
                                                    @foreach ($tipo_comprobante as $tp)
                                                        <option value="{{ $tp->impuestoComprobante }}">
                                                            {{ $tp->nomTipoComprobante }}
                                                        </option>
                                                    @endforeach
                                                </select>

                                            </div>
                                        </div>
                                        <label for="impuestoIngreso" class="form-label col-2 col-xl-2">Impuestos</label>
                                        <div class="col-4 col-xl-4">
                                            <input type="number" class="form-control form-control-sm"
                                                id="impuestoIngreso" placeholder="% impuesto" value="">
                                        </div>
                                        {{-- <label for="example-input-small"
                                            class="form-label col-2 col-xl-2">Vendedor</label>
                                        <div class="col-4 col-xl-4">
                                            <input type="select" class="form-control form-control-sm"
                                                id="example-input-small" placeholder="Vendedor">
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-lg-12 col-xl-12 mb-4 mb-lg-0">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center mb-0">
                <div class="col-md-12 col-xl-12">
                    <div class="card shadow-0 border rounded-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 col-lg-12 col-xl-12">
                                    <h5>DETALLE</h5>
                                    <div class="table-responsive">
                                        <table class="dtCart table  table-nowrap table-centered mb-0" id="dtCart"
                                            style="min-block-size: ">
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
                                            <tbody id="dtVE">

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
                                <br>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-lg-12 col-xl-12">
                                    <div class="text-lg-end my-1 my-lg-0">
                                        <a href="{{ url('comercial/venta') }}"><button type="button"
                                                class="btn w-sm btn-light waves-effect">Cancelar</button></a>
                                        <button type="button"
                                            class="procesar btn w-sm btn-success waves-effect waves-light guardar">Guardar</button>
                                        <button type="button"
                                            class="btn w-sm btn-danger waves-effect waves-light">Borrar</button>
                                    </div>
                                </div> <!-- end col -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('javascript')
    {{--  <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
        <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script> --}}
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

    <!-- Select2 js-->
    <script src="{{ asset('/libs/select2/js/select2.min.js') }}"></script>
    <!-- Dropzone file uploads-->
    <script src="{{ asset('/libs/dropzone/min/dropzone.min.js') }}"></script>

    <!-- Quill js -->
    <script src="{{ asset('/libs/quill/quill.min.js') }}"></script>
    <script src="{{ asset('/libs/jquery-mockjax/jquery.mockjax.min.js') }}"></script>
    <script src="{{ asset('/libs/devbridge-autocomplete/jquery.autocomplete.min.js') }}"></script>
    <script src="{{ asset('/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js') }}"></script>
    <script src="{{ asset('/libs/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
    <script src="{{ asset('/libs/mohithg-switchery/switchery.min.js') }}"></script>
    <script src="{{ asset('/libs/multiselect/js/jquery.multi-select.js') }}"></script>


    <script>
        var productos = [];
        var stock = 0;
        var detalleVenta = [];

        console.log(detalleVenta, "IniciadorDetalleVenta")

        $(document).ready(function() {
            $.ajax({
                type: "get",
                url: `${base_url}/producto`,
                dataType: 'json',
                success: function callbackFuntion(response) {
                    console.log(response, "lista de productos")
                    productos = response.data;
                    stock = response.stock;
                    const array3 = productos.concat(stock);
                    array3.join()
                    console.log(array3, "CONCAT")

                    renderCard()
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
        console.log(stock, "STOCK")
        console.log(productos, "productos")





        function renderCard() {

            $('#list_cards').html('')
            let cards = ``;
            productos.map((item, i) => {
                cards += `
                <div class="col-md-12 col-lg-12 col-xl-12">
                    <div class="card shadow-0 border rounded-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 col-lg-3 col-xl-3 mb-4 mb-lg-0" >
                                    <div class="bg-image hover-zoom ripple rounded ripple-surface" >
                                    <img src="${base_url}/imagenes/productos/${item.imagenProducto}" 
                                        class="w-100" />
                                    <a href="#!">
                                        <div class="hover-overlay">
                                        <div class="mask" style="background-color: rgba(253, 253, 253, 0.15);"></div>
                                        </div>
                                    </a>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6 col-xl-6">
                                    <div>
                                        <h5 class="text-truncate">${item.nomProducto}</h5>
                                    </div>
                                    
                                    <div class="mt-1 mb-0 text-muted small">
                                        <span>Caract.1</span>
                                        <span class="text-primary"> • </span>
                                        <span>Caract.2</span>
                                        <span class="text-primary"> • </span>
                                        <span>Caract.3<br /></span>
                                    </div>
                                    <div class="mb-2 text-muted small">
                                        <span>Categoria</span>
                                        <span class="text-primary"> • </span>
                                        <span>SubCate</span>
                                        <span class="text-primary"> • </span>
                                        <span>Tipo<br /></span>
                                    </div>
                                    <p class="texto mb-4 mb-md-0">
                                    There are many variations of passages of Lorem Ipsum available, but the
                                    majority have suffered alteration in some form, by injected humour, or
                                    randomised words which don't look even slightly believable.
                                    </p>
                                </div>
                                <div class="col-md-6 col-lg-3 col-xl-3 border-sm-start-none border-start ">
                                    <div class="d-flex flex-row justify-content-center align-items-center mb-1">
                                        <h4 class="mb-1 me-1">Bs. ${item.precioVentaProducto}</h4>
                                       
                                    </div>
                                        
                                    <div class="d-flex flex-column mt-4">
                                        <button data-id="${i}" class="add_product btn btn-outline-primary btn-sm mt-2 " type="button">
                                            Agregar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div> 
                `;
            })
            $('#list_cards').append(cards)

        }
        $(document).on('click', '.add_product', function() {

            let posicion = $(this).data('id');
            console.log(posicion, "IDDDD");
            let producto = productos[posicion];
            console.log(producto, "PRODUCTOOOO")
            const validador = detalleVenta.find(((item) => item.idProducto == producto
                .idProducto));

            if (validador == undefined) {
                detalleVenta.push({
                    ...producto,
                    cantidad: 1,
                    precio: producto.precioVentaProducto,
                    precioTotal: parseFloat((producto.precioVentaProducto * 1))
                });
            } else {
                detalleVenta.map(item => {
                    if (item.idProducto == producto.idProducto) {
                        item.cantidad = item.cantidad + 1;
                        item.precioTotal = parseFloat((item.precio * item.cantidad)
                            /* .repleace(",", ".") */
                        ) /* .toFixed(2) */ ;
                    }
                });
            }
            console.log('detalleVentaAddCard', detalleVenta)
            SumaTotales();
            renderDetalleVenta();
        });

        function renderDetalleVenta() {
            console.log('detalleVentaAddCard', detalleVenta)
            $('#dtVE').html('')
            let html = ``;
            detalleVenta.forEach((item, i) => {
                html += `
                        <tr id="fila${i}">
                            <td style="min-width: 80px; max-width:200px; overflow: hidden; word-break: break-all;"><p class="">${item.codProducto}<br>${item.nomProducto}</p><input type="hidden" min="1" name="idProducto[]" value="${item.idProducto}" id="idProducto${i}" class="id form-control" placeholder="0" style="width: 90px;"></td>
                            <td><input type="number" min="1" value="${item.cantidad}" data-id="${i}" name="cantidad[]" class="cantidad form-control" placeholder="0" style="width: 90px;"></td>
                            <td><input type="number" min="1" value="${item.precioVentaProducto}" data-id="${i}" name="precioVentaProducto[]" class="precio form-control" placeholder="0" style="width: 90px;"></td>
                            <td class="total${i}">${item.precioTotal}</td>
                            <td class="delete${i}"><i data-id="${i}"  class="deleteItem fas fa-trash-alt text-danger"></i></td>
                        </tr>
                        `;
            });
            $('#dtVE').append(html)
        }
        $(document).on('keyup change', '.precio', function() {

            let precio = $(this).val();
            let posicion = $(this).data('id');
            /* let td = '#pro' + posicion
            let colum = $(this).data('td');*/
            console.log(precio, posicion, "PROBANDO")
            let total = 0;
            detalleVenta.map((item, i) => {
                if (i == posicion) {
                    item.precioTotal = parseFloat(precio * item.cantidad);
                    item.precioVentaProducto = parseFloat(precio);
                    $(`.total${posicion}`).text(item
                        .precioTotal); //restringir cantidad decimales
                }
                total += item.precioTotal
            })

            console.log(detalleVenta, "Mapeando Precio")
            SumaTotales();
        });
        $(document).on('keyup change', '.cantidad', function() {
            let cantidad = $(this).val();
            let posicion = $(this).data('id');
            console.log(cantidad, posicion)
            detalleVenta.map((item, i) => {
                if (i == posicion) {
                    item.precioTotal = parseFloat(item.precio * cantidad);
                    item.cantidad = parseFloat(cantidad);
                    $(`.total${posicion}`).text(item.precioTotal);
                }
            })
            console.log(detalleVenta, "Mapeando cantidad")
            SumaTotales();
        });

        var comprobante = document.getElementById("idTipoComprobante");
        comprobante.addEventListener("change", function() {
            console.log("Comprobante cambio", comprobante.value)
            calcularImpuesto();
        });

        function calcularImpuesto() {
            var impuesto = comprobante.value;
            var costoIns = $('#TotalCart').val();
            var tImpuesto = impuesto * costoIns;
            $('#impuestoIngreso').val(tImpuesto);
            console.log(tImpuesto, "Valor Comprobante");
        }

        function SumaTotales() {
            let tabla = document.getElementById("dtVE");
            let total = 0;
            detalleVenta.map((item, i) => {
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
            detalleVenta.splice(posicion, 1);
            console.log('resultado', detalleVenta)
            SumaTotales();
            //renderDetalleVenta()
        })

        $(document).on('click', '.procesar', function() {
            if ($('#impuestoIngreso').val() == 0) {
                var idTC = 1;
            } else {
                var idTC = 2;
            }
            var dato = {
                detalleVenta: detalleVenta,
                idCliente: $('#idCliente').val(),
                idTipoPago: $('#idTipoPago').val(),
                idTipoComprobante: idTC,
                fechaIngreso: $('#fechaVenta').val(),
                impuestoIngreso: $('#impuestoIngreso').val(),
                estadoIngreso: 1,
                idUsuario: $('#idVendedor').val(),


            };
            console.log(dato, "ENVIADO A STORE");
            $.ajax({
                type: "post",
                url: `${base_url}/comercial/venta`,
                dataType: 'json',
                data: dato,
                success: function(response) {
                    console.log(response, "ACTUALIZO")
                    window.location = "index";



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
    </script>
    <style>
        .texto {
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
            overflow: hidden;
            /* margin: 1rem; */
        }
    </style>
@endpush
