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
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">UBold</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Ecommerce</a></li>
                                <li class="breadcrumb-item active">Products</li>
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
                                        <a href="ecommerce-product-edit.html"
                                            class="btn btn-danger waves-effect waves-light"><i
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
                <div class="col-md-6 col-lg-6 col-xl-6 container py-2">
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
                </div> <!-- end col-8-->

                {{-- <div class="col-4">
                    <div class="row"> --}}
                <div class="col-md-6 col-lg-6 col-xl-6 container py-2"> <!-- Desde aqui repite los Tag's -->
                    <div class="card product-box">
                        <div class="row card-body">
                            {{-- AQui EL ENCABEZAO DE LA NOTA DE VENTA --}}
                        </div>
                    </div>
                    <div class="card product-box">
                        <div class="row card-body">
                            <div class="table-responsive">
                                <table class="dtCart table  table-nowrap table-centered mb-0" id="dtCart"
                                    style="min-block-size: ">
                                    <thead class="table-light">
                                        <tr>
                                            <th width="35%">Producto</th>
                                            <th width="20%">Precio</th>
                                            <th width="20%">Cantidad</th>
                                            <th width="20%">Total</th>
                                            <th width="5%"></th>
                                        </tr>
                                    </thead>
                                    <tbody id="dtVE">

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Total Bs.</b></th>
                                            <th id="TotalCart"></th>
                                            <th></th>
                                        </tr>
                                    </tfoot>
                                </table>

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
                                <div class="row mt-2">
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
                        </div>
                    </div> <!-- end card-->

                </div> <!-- end col HASTA AQUI SON LOS TAGs-->

                {{-- </div>

                </div> --}}
            </div>
        </div> <!-- container -->
    </div> <!-- content -->
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

        function renderCard() {
            $('#list_cards').html('')
            let cards = ``;
            productos.map((item, i) => {
                cards += `
           
               
            
                <div class="col-md-12 col-lg-12 col-xl-12">
                    <div class="card shadow-0 border rounded-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 col-lg-3 col-xl-3 mb-4 mb-lg-0">
                                <div class="bg-image hover-zoom ripple rounded ripple-surface">
                                <img src="https://mdbcdn.b-cdn.net/img/Photos/Horizontal/E-commerce/Products/img%20(4).webp"
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
                                    <h5>Quant trident shirts</h5>
                                </div>
                                <div class="d-flex flex-row">
                                <div class="text-danger mb-1 me-2">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <span>310</span>
                                </div>
                                <div class="mt-1 mb-0 text-muted small">
                                <span>100% cotton</span>
                                <span class="text-primary"> • </span>
                                <span>Light weight</span>
                                <span class="text-primary"> • </span>
                                <span>Best finish<br /></span>
                                </div>
                                <div class="mb-2 text-muted small">
                                <span>Unique design</span>
                                <span class="text-primary"> • </span>
                                <span>For men</span>
                                <span class="text-primary"> • </span>
                                <span>Casual<br /></span>
                                </div>
                                <p class="text-truncate mb-4 mb-md-0">
                                There are many variations of passages of Lorem Ipsum available, but the
                                majority have suffered alteration in some form, by injected humour, or
                                randomised words which don't look even slightly believable.
                                </p>
                            </div>
                            <div class="col-md-6 col-lg-3 col-xl-3 border-sm-start-none border-start">
                                <div class="d-flex flex-row align-items-center mb-1">
                                <h4 class="mb-1 me-1">$13.99</h4>
                                <span class="text-danger"><s>$20.99</s></span>
                                </div>
                                <h6 class="text-success">Free shipping</h6>
                                <div class="d-flex flex-column mt-4">
                                <button class="btn btn-primary btn-sm" type="button">Details</button>
                                <button class="btn btn-outline-primary btn-sm mt-2" type="button">
                                    Add to cart
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
            let producto = productos[posicion];
            console.log(producto, "PRODUCTOOOO")
            const validador = detalleVenta.find(((item) => item.idProducto == producto
                .idProducto));

            if (validador == undefined) {
                detalleVenta.push({
                    ...producto,
                    cantidad: 1,
                    precio: 0,
                    precioTotal: 0
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
            /* console.log('detalleVentaAddCard', detalleVenta) */
            SumaTotales();
            renderDetalleVenta();
        });

        function renderDetalleVenta() {
            $('#dtVE').html('')
            let html = ``;
            detalleVenta.forEach((item, i) => {
                html += `
                        <tr id="fila${i}">
                            <td>${item.nomProducto}<input type="hidden" min="1" name="idProducto[]" value="${item.idProducto}" id="idProducto${i}" class="id form-control" placeholder="0" style="width: 90px;"></td>
                            <td><input type="number" min="1" value="${item.precio}" data-id="${i}" name="precio[]" class="precio form-control" placeholder="0" style="width: 90px;"></td>
                            <td><input type="number" min="1" value="${item.cantidad}" data-id="${i}" name="cantidad[]" class="cantidad form-control" placeholder="0" style="width: 90px;"></td>
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
            let colum = $(this).data('td');
            console.log(precio, posicion, colum, "PROBANDO") */
            let total = 0;
            detalleVenta.map((item, i) => {
                if (i == posicion) {
                    item.precioTotal = parseFloat(precio * item.cantidad);
                    item.precio = parseFloat(precio);
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

        function SumaTotales() {
            let tabla = document.getElementById("dtVE");
            let total = 0;
            detalleVenta.map((item, i) => {
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
        }
    </script>
    <style>
        .card1 {
            background-color: rgb(255, 255, 255);
            flex: 100%;
            margin-bottom: 15px;
            border: 5px;
            display: flex;
            flex-direction: column;
        }

        .footer1 {
            background-color: rgb(255, 255, 255);
            padding: 10px;
        }

        .content1 {
            flex-grow: 1;
            flex-shrink: 1;

        }
    </style>
@endpush
