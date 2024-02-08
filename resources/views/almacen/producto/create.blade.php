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


            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="text-uppercase bg-light p-2 mt-0 mb-3">General</h5>

                            <div class="mb-3">
                                <label for="codProducto" class="form-label">Codigo <span
                                        class="text-danger">*</span></label>
                                <input type="text" id="codProducto" class="form-control" placeholder="ej: #######">
                            </div>

                            <div class="mb-3">
                                <label for="nomProducto" class="form-label">Nombre Producto <span
                                        class="text-danger">*</span></label>
                                <input type="text" id="nomProducto" class="form-control" placeholder="ej : Apple iMac">
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

                            <form action="/" method="post" class="dropzone" id="myAwesomeDropzone"
                                data-plugin="dropzone" data-previews-container="#file-previews"
                                data-upload-preview-template="#uploadPreviewTemplate">
                                <div class="fallback">
                                    <input name="file" id="imagenProducto"type="file" multiple />
                                </div>

                                <div class="dz-message needsclick">
                                    <i class="h1 text-muted dripicons-cloud-upload"></i>
                                    <h3>Desplaza archivo aqui or click para cargar.</h3>
                                    {{-- <span class="text-muted font-13">(This is just a demo dropzone. Selected files are
                                        <strong>not</strong> actually uploaded.)</span> --}}
                                </div>
                            </form>

                            <!-- Preview -->
                            <div class="dropzone-previews mt-3" id="file-previews"></div>
                        </div>
                    </div> <!-- end col-->

                    <div class="card">
                        <div class="card-body">
                            <h5 class="text-uppercase bg-light p-2 mt-0 mb-3">Almacen</h5>

                            <div class="mb-3">
                                <label for="unidadMedida" class="form-label">Unidad de Medida <span
                                        class="text-danger">*</span></label>
                                <select class="form-control select2" id="unidadMedida">
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
                                <select class="form-control select2" id="idCategoria">
                                    @foreach ($categoria as $cat)
                                        <option value="{{ $cat->idCategoria }}">{{ $cat->nomCategoria }}</option>
                                    @endforeach

                                </select>
                            </div>

                            <div class="row">
                                <div class="col-4">
                                    <label for="precioCompra">Precio Compra <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="precioCompra"
                                        placeholder="Enter amount">
                                </div>
                                <div class="col-4">
                                    <label for="pecioVenta">Precio Venta <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="pecioVenta"
                                        placeholder="Enter amount">
                                </div>
                                <div class="col-4">
                                    <label for="stockMinimo">Stock Minimo <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="stockMinimo"
                                        placeholder="Enter amount">
                                </div>
                            </div>
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
    <script>
        function name(params) {
            return "";
        }
        /*<!-- AJAX GUARDAR Producto -->*/
        $(document).on("click", ".guardar", function() {

            $.ajax({
                type: "post",
                url: `${base_url}/almacen/producto/`,
                dataType: 'json',
                data: {
                    nomProducto: $('#nomProducto').val(),
                    codProducto: $('#codProducto').val(),
                    idCategoria: $('#idCategoria').val(),
                    unidadMedida: $('#unidadMedida').val(),
                    stockMinimo: $('#stockMinimo').val(),
                    imagenProducto: $('#imagenProducto').val(),

                },
                success: function callbackFuntion(response) {
                    console.log(response, "ACTUALIZO")
                    window.location = "index";

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
    </script>
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
