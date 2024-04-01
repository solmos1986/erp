@extends('layouts.admin')
@push('css')
    <!-- third party css -->
    <link href="{{ asset('/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/libs/dropify/css/dropify.min.css') }}" rel="stylesheet" type="text/css" />
    {{-- <link href="{{ asset('/libs/dropzone/min/dropzone.min.css') }}" rel="stylesheet" type="text/css" /> --}}
    <link href="{{ asset('/libs/mohithg-switchery/switchery.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/libs/multiselect/css/multi-select.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('/libs/quill/quill.core.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/libs/quill/quill.snow.css') }}" rel="stylesheet" type="text/css" />
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
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Almacen</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Productos</a></li>
                                <li class="breadcrumb-item active">Agregar Producto</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Agregar Producto</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <form action="/" method="post" enctype="multipart/form-data" {{-- class="dropzone" --}} id="form_product"
                {{-- data-plugin="dropzone" data-previews-container="#file-previews"
                data-upload-preview-template="#uploadPreviewTemplate" --}}>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="text-uppercase bg-light p-2 mt-0 mb-3">General</h5>

                                <div class="mb-3">
                                    <label for="codProducto" class="form-label">Codigo <span
                                            class="text-danger">*</span></label>
                                    <input type="text" id="codProducto" name="codProducto" class="form-control"
                                        placeholder="ej: #######">
                                </div>

                                <div class="mb-3">
                                    <label for="nomProducto" class="form-label">Nombre Producto <span
                                            class="text-danger">*</span></label>
                                    <input type="text" id="nomProducto" class="form-control" name="nomProducto"
                                        placeholder="ej : Apple iMac">
                                </div>

                                <div class="mb-3">
                                    <label for="product-description" class="form-label">Descripcion del producto <span
                                            class="text-danger">*</span></label>
                                    <div id="snow-editor" style="height: 150px;"></div> <!-- end Snow-editor-->
                                </div>

                                <div class="mb-3">
                                    <label for="product-summary" class="form-label">Resumen del producto</label>
                                    <textarea class="form-control" id="product-summary" rows="3" placeholder="Porfavor ingresa un resumen"></textarea>
                                </div>


                            </div>
                            <!-- end card -->
                        </div>

                    </div> <!-- end col -->

                    <div class="col-lg-6">

                        <div class="card">
                            <div class="card-body">
                                <h5 class="text-uppercase mt-0 mb-3 bg-light p-2">Imagenes Producto</h5>
                                <input type="file" data-plugins="dropify" name="imagenProducto" id="imagenProducto"
                                    data-height="300" />
                            </div>
                        </div> <!-- end col-->

                        <div class="card">
                            <div class="card-body">
                                <h5 class="text-uppercase bg-light p-2 mt-0 mb-3">Almacen</h5>

                                <div class="mb-3">
                                    <label for="unidadMedida" class="form-label">Unidad de Medida <span
                                            class="text-danger">*</span></label>
                                    <select class="form-control select2" id="unidadMedida" name="unidadMedida">
                                        @foreach ($categoria as $cat)
                                            <option value="metro">metro</option>
                                            <option value="pieza">pieza</option>
                                            <option value="kilogramo">kilogramo</option>
                                            <option value="balde">balde</option>
                                            <option value="bolsa">bolsa</option>
                                        @endforeach

                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="idCategoria" class="form-label">Categoria <span
                                            class="text-danger">*</span></label>
                                    <select class="form-control select2" id="idCategoria" name="idCategoria">
                                        @foreach ($categoria as $cat)
                                            <option value="{{ $cat->idCategoria }}">{{ $cat->nomCategoria }}</option>
                                        @endforeach

                                    </select>
                                </div>

                                <div class="row">
                                    <div class="col-4">
                                        <label for="precioCompra">Precio Compra <span
                                                class="text-danger">*</span></label><!-- Trae el resultado del promedio de los ingresos a almacen por compra -->
                                        <input type="text" class="form-control" id="precioCompra" name="precioCompra"
                                            placeholder="Enter amount" readonly>
                                    </div>
                                    <div class="col-4">
                                        <label for="pecioVenta">Precio Venta <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="precioVentaProducto"
                                            name="precioVentaProducto" placeholder="Enter amount">
                                    </div>
                                    <div class="col-4">
                                        <label for="stockMinimo">Stock Minimo <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="stockMinimo" name="stockMinimo"
                                            placeholder="Enter amount">
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end card -->

                    </div> <!-- end col-->

                </div>
                <!-- end row -->
            </form>
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


            <!-- file preview template -->
            <div class="d-none" id="uploadPreviewTemplate">
                <div class="card mt-1 mb-0 shadow-none border">
                    <div class="p-2">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <img data-dz-thumbnail src="#" class="avatar-sm rounded bg-light" alt="">
                            </div>
                            <div class="col ps-0">
                                <a href="javascript:void(0);" class="text-muted fw-bold" data-dz-name></a>
                                <p class="mb-0" data-dz-size></p>
                            </div>
                            <div class="col-auto">
                                <!-- Button -->
                                <a href="" class="btn btn-link btn-lg text-muted" data-dz-remove>
                                    <i class="dripicons-cross"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
@endsection

@push('javascript')
    <!-- Select2 js-->
    <script src="{{ asset('/libs/select2/js/select2.min.js') }}"></script>
    <!-- Dropzone file uploads-->
    {{--  <script src="{{ asset('/libs/dropzone/min/dropzone.min.js') }}"></script> --}}

    <!-- Quill js -->
    <script src="{{ asset('/libs/quill/quill.min.js') }}"></script>

    <!-- Init js -->
    <script src="{{ asset('/libs/jquery-mockjax/jquery.mockjax.min.js') }}"></script>
    <script src="{{ asset('/libs/devbridge-autocomplete/jquery.autocomplete.min.js') }}"></script>
    <script src="{{ asset('/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js') }}"></script>
    <script src="{{ asset('/libs/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
    <script src="{{ asset('/libs/mohithg-switchery/switchery.min.js') }}"></script>
    <script src="{{ asset('/libs/multiselect/js/jquery.multi-select.js') }}"></script>
    <script src="{{ asset('/libs/dropify/js/dropify.min.js') }}"></script>

    <script src="{{ asset('/js/pages/add-product.init.js') }}"></script>
    <script>
        $('[data-plugins="dropify"]').dropify({
            messages: {
                default: "Drag and drop a file here or click",
                replace: "Drag and drop or click to replace",
                remove: "Remove",
                error: "Ooops, something wrong appended.",
            },
            error: {
                fileSize: "The file size is too big (1M max)."
            },
        });
    </script>
    <script>
        function name(params) {
            return "";
        }
        /*<!-- AJAX GUARDAR Producto -->*/
        $(document).on("click", ".guardar", function() {
            var formData = new FormData($('#form_product')[0]);

            $.ajax({
                async: true,
                type: 'post',
                url: `${base_url}/almacen/producto`,
                data: formData,
                cache: false,
                processData: false,
                contentType: false,
                success: function(data) {
                    console.log("success")
                    window.location = "index";
                },
                error: function(request, status, error) {
                    console.log("error")
                }
            });

        })
    </script>
@endpush
