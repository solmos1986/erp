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
                        <li class="breadcrumb-item"><a href="#">Comercial</a></li>
                        <li class="breadcrumb-item active">Clientes</li>
                    </ol>
                </div>
                <h4 class="page-title">CLIENTES</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-lg-3">
            <div class="input-group">
                <input type="text" class="form-control" id="validationCustom15" placeholder="Buscar producto" required>
            </div>
        </div>
        <div class="col-lg-5">

        </div>
        <div class="col-lg-4">
            <div class="text-lg-end">
                <a href="#"><button type="button" id="serchbtn"
                        class="nuevo btn btn-success waves-effect waves-light mb-2 me-2"><i class="mdi mdi-plus me-1"></i>
                        Registrar Cliente </button></a>
            </div>
        </div>
    </div>
    {{-- <div class="row">
        <div class="col-md-3 mb-2">
            <div class="input-group">
                <input type="text" class="form-control" id="validationCustom15" placeholder="Buscar cliente" required>
            </div>
        </div>
        <div class="col-md-6 mb-2">
        </div>
        <div class="col-md-3 col-md-push mb-2">

            <div class="input-group">

                <button type="button" id="serchbtn" class="btn rounded-pill btn-success nuevo">NUEVO</button>
            </div>
        </div>
    </div> --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="dtCliente" class="dtCliente table dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>Codigo</th>
                                <th>Cliente</th>
                                <th>Telefono</th>
                                <th>Direccion</th>
                                <th>NIT / CI</th>
                                <th>Correo Electronico</th>
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

    <!-- NUEVO Modal -->

    <div id="formCliente" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="fullWidthModalLabel"
        aria-hidden="true">

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        {{--     {!! Form::open(['url' => 'comercial/cliente', 'method' => 'POST', 'autocomplete' => 'off']) !!}
        {{ Form::token() }} --}}
        <div class="modal-dialog modal-full-width">

            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="fullWidthModalLabel">CREAR CLIENTE</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/" method="post" enctype="multipart/form-data" {{-- class="dropzone" --}} id="form_client"
                        novalidate>
                        <div class="row">

                            <div class="col-md-7 mb-1">
                                <div class="row">
                                    <label for="nomCliente" class="form-label">Nombre Cliente</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="nomCliente"
                                            placeholder="Ingrese Cliente" required name="nomCliente">
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <label for="docCliente" class="form-label">NIT / CI</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="docCliente"
                                            placeholder="No. Documento" required name="docCliente">
                                    </div>

                                </div>
                                <div class="row mt-2">
                                    <label for="tel1Cliente" class="form-label">Telefono 1 Cliente</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="tel1Cliente" placeholder="Telefono 1"
                                            required name="tel1Cliente">
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <label for="tel2Cliente" class="form-label">Telefono 2 Cliente</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="tel2Cliente"
                                            placeholder="Telefono 2" required name="tel2Cliente">
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-12 mb-1">
                                        <label for="mailCliente" class="form-label">Correo Electronico</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="mailCliente"
                                                placeholder="E-mail" required name="mailCliente">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-12 mb-1">
                                        <label for="dirCliente" class="form-label">Direccion</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="dirCliente"
                                                placeholder="Direccion" required name="dirCliente">
                                            <input type="text" class="form-control" id="base64" readonly
                                                value="" required name="base64">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5 mb-1 ml-2">

                                <video id="webcam" autoplay playsinline width="640" height="480"></video>
                                <img class="mb-1"id="foto_tomada" src="" alt="">
                                <canvas id="canvas" class="d-none"></canvas>
                                {{-- <audio id="snapSound" src="audio/snap.wav" preload = "auto"></audio> --}}

                                <button class="btn btn-primary" id="iniciar" type="button">
                                    Tomar foto
                                </button>
                                <button class="btn btn-primary capturar" id="capturar" type="button">
                                    Capturar foto
                                </button>
                                <button class="btn btn-primary" id="cancelar" type="button">
                                    Cancelar
                                </button>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-6 mb-1">

                            </div>
                            <div class="col-md-6 mb-1">

                            </div>


                        </div>


                    </form>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary waves-effect"
                            data-bs-dismiss="modal">Cancelar</button>
                        <button type="button" class="guardar btn btn-info waves-effect waves-light">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div><!-- /.modal -->

    <!-- EDIT Modal -->

    <div class="modal fade" id="formEditarCliente" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Editar Cliente</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="needs-validation" novalidate>
                        <div class="row">
                            <div class="col-md-2 mb-1">
                                <label for="idClienteEdit" class="form-label">Id Cliente</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="idClienteEdit" placeholder=""
                                        required name="idClienteEdit">
                                </div>
                            </div>
                            <div class="col-md-7 mb-1">
                                <label for="nomClienteEdit" class="form-label">Nombre Cliente</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="nomClienteEdit" required
                                        name="nomClienteEdit">
                                </div>
                            </div>
                            <div class="col-md-3 mb-1">
                                <label for="docClienteEdit" class="form-label">NIT / CI</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="docClienteEdit" required
                                        name="docClienteEdit">
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-md-3 mb-1">
                                <label for="tel1ClienteEdit" class="form-label">Telefono 1 Usuario</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="tel1ClienteEdit" required
                                        name="tel1ClienteEdit">
                                </div>
                            </div>
                            <div class="col-md-3 mb-1">
                                <label for="tel2ClienteEdit" class="form-label">Telefono 2 Usuario</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="tel2ClienteEdit" required
                                        name="tel2ClienteEdit">
                                </div>
                            </div>
                            <div class="col-md-6 mb-1">
                                <label for="mailClienteEdit" class="form-label">Correo Electronico</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="mailClienteEdit" required
                                        name="mailClienteEdit">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 mb-1">
                                <label for="dirClienteEdit" class="form-label">Direccion</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="dirClienteEdit" required
                                        name="dirClienteEdit">
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary waves-effect"
                            data-bs-dismiss="modal">Cancelar</button>
                        <button type="sumit" class="update btn btn-info waves-effect waves-light">Guardar</button>
                    </div>
                </div>
            </div>
        </div>

    </div><!-- /.modal -->

    <!-- DELETE Modal -->
    <div id="formDeleteCliente" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
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
                        <p class="mt-3 text-white">Esta seguro de eliminar Cliente?</p>
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
    <script src="{{ asset('/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('/libs/webcam-easy/webcam-easy.min.js') }}"></script>


    <script type="text/javascript">
        /* <!--AJAX CARGA DATA TABLE Function--> */
        $(function() {

            var table = $('.dtCliente').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('index.cliente') }}",

                columns: [{
                        data: 'idCliente',
                        name: 'idCliente'
                    },
                    {
                        data: 'nomCliente',
                        name: 'nomCliente'
                    },
                    {
                        data: 'tel1Cliente',
                        name: 'tel1Cliente'
                    },
                    {
                        data: 'dirCliente',
                        name: 'dirCliente'
                    },
                    {
                        data: 'docCliente',
                        name: 'docCliente'
                    },
                    {
                        data: 'mailCliente',
                        name: 'mailCliente'
                    },
                    {
                        data: 'idCliente',
                        name: 'idCliente',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row, meta) {
                            console.log("LLEGO FILA", row)
                            return `<a href="javascript:void(0)"  data-id="${row.idCliente}" class="edit fas fa-pencil-alt text-info"></a> &nbsp;&nbsp;&nbsp;<a href="javascript:void(0)"  data-id="${row.idCliente}" class="delete far fa-trash-alt text-danger"></a>`;
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
        /* <!--AJAX EDITAR Modal--> */

        $(document).on("click", ".edit", function() {
            console.log("HOLA recibi info")
            const id = $(this).data('id');
            console.log(id, "estoy enviando?")
            $.ajax({
                type: "get",
                url: `${base_url}/comercial/cliente/${id}`,
                dataType: 'json',

                success: function(response) {
                    console.log(response, "LLEGO DATA?")

                    $('#idClienteEdit').val(response.data.idCliente)
                    $('#nomClienteEdit').val(response.data.nomCliente)
                    $('#docClienteEdit').val(response.data.docCliente)
                    $('#tel1ClienteEdit').val(response.data.tel1Cliente)
                    $('#tel2ClienteEdit').val(response.data.tel2Cliente)
                    $('#dirClienteEdit').val(response.data.dirCliente)
                    $('#mailClienteEdit').val(response.data.mailCliente)
                    $('#formEditarCliente').modal('show');
                    console.log(response, "QUE  PASO???");
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    //error_status(jqXHR)
                },
                fail: function() {
                    //fail()
                }
            })
        });
        /* <!--AJAX NUEVO Modal--> */
        $(document).on("click", ".nuevo", function() {
            $('#formCliente').modal('show');

        });

        /*<!-- AJAX UPDATE Modal -->*/
        $(document).on("click", ".update", function() {
            const id = $("#idClienteEdit").val();
            console.log(id)

            $.ajax({
                type: "put",
                url: `${base_url}/comercial/cliente/${id}`,
                dataType: 'json',
                data: {

                    idCliente: $('#idClienteEdit').val(),
                    nomCliente: $('#nomClienteEdit').val(),
                    docCliente: $('#docClienteEdit').val(),
                    tel1Cliente: $('#tel1ClienteEdit').val(),
                    tel2Cliente: $('#tel2ClienteEdit').val(),
                    dirCliente: $('#dirClienteEdit').val(),
                    mailCliente: $('#mailClienteEdit').val(),
                },
                success: function(response) {
                    console.log(response, "ACTUALIZO")
                    $('#formEditarCliente').modal('hide');
                    $('.dtCliente').DataTable().ajax.reload();
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


        /*<!-- AJAX DELETE Modal -->*/
        $(document).on("click", ".delete", function() {
            const id = $(this).data('id');
            console.log(id, "HOLA recibi info DELETE")
            $('#idClienteDelete').val(id)
            $('#formDeleteCliente').modal('show');
            $(".btnDelete").click(function() {
                $.ajax({
                    type: "delete",
                    url: `${base_url}/comercial/cliente/${id}`,
                    dataType: 'json',

                    success: function(response) {
                        console.log(response, "LLEGO DATA?")
                        $('#formDeleteCliente').modal('hide');
                        $('.dtCliente').DataTable().ajax.reload();
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

        $(document).on("click", ".guardar", function() {

            $.ajax({
                type: "post",
                url: `${base_url}/comercial/cliente`,
                dataType: 'json',
                data: {
                    nomCliente: $('#nomCliente').val(),
                    docCliente: $('#docCliente').val(),
                    tel1Cliente: $('#tel1Cliente').val(),
                    tel2Cliente: $('#tel2Cliente').val(),
                    dirCliente: $('#dirCliente').val(),
                    mailCliente: $('#mailCliente').val(),
                    imagen: $('#base64').val(),
                },
                success: function(response) {
                    console.log(response.img, "LLEGO NAMEEEEE?")
                    console.log(response.data, "LLEGO NAMEEEEE?")
                    $('#formCliente').modal('hide');
                    $('.dtCliente').DataTable().ajax.reload();
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
        const webcamElement = document.getElementById('webcam');
        const canvasElement = document.getElementById('canvas');
        const snapSoundElement = document.getElementById('snapSound');
        const webcam = new Webcam(webcamElement, 'user', canvasElement, snapSoundElement);

        $(document).on("click", "#capturar", function() {
            var base64Imagen = webcam.snap();
            console.log(base64Imagen, "BASE &$");
            $('#foto_tomada').prop('src', base64Imagen)
            $('#webcam').hide(),
                resizeBase64Image(base64Imagen);
            /* $.ajax({
                type: "POST",
                url: `${base_url}/comercial/clienteImagen`,
                dataType: 'json',
                data: {
                    imagen: base64Image,

                },
                success: function(response) {
                    console.log(response.data, "ACTUALIZO")

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
                },
            }) */

        });

        $(document).on("click", "#cancelar", function() {
            $('#foto_tomada').prop('src', '')
            //$('#foto_tomada').hide();
            $('#webcam').show();
        });
        $("#iniciar").click(function() {

            webcam.start()
                .then(result => {
                    console.log("webcam started");
                })
                .catch(err => {
                    console.log(err);
                });
            console.log("INICIAR CAM")
        });
        /*  $('#formCliente').on('dismiss', function() {
             webcam.stop();
         }) */
        $('#formCliente').on('hidden.bs.modal', function() {
            webcam.stop();
            $(this).removeData();
        })


        function resizeBase64Image(base64Imagen) {
            return new Promise((resolve, reject) => {
                const maxSizeInMB = 1;
                const maxSizeInBytes = maxSizeInMB * 350 * 350;
                const img = new Image();
                img.src = base64Imagen;
                img.onload = function() {
                    const canvas = document.createElement("canvas");
                    const ctx = canvas.getContext('2d');
                    const width = img.width;
                    const height = img.height;
                    const aspectRatio = width / height;
                    const newWidth = Math.sqrt(maxSizeInBytes * aspectRatio);
                    const newHeight = Math.sqrt(maxSizeInBytes / aspectRatio);
                    canvas.width = newWidth;
                    canvas.height = newHeight;
                    ctx.drawImage(img, 0, 0, newWidth, newHeight);
                    let quality = 0.8;
                    let dataURL = canvas.toDataURL('image/jpeg', quality);
                    var base64rz = dataURL;
                    console.log(base64rz, "ES LO QUE NECESOTPP???")
                    $('#base64').val(base64rz),
                        resolve(dataURL);
                }
            })

        }

        /*  function fileJPEG(base64Imagen) {
             let base64String = base64Imagen; // Not a real image
             // Remove header
             let base64Image = base64String.split(';base64,').pop();

             import fs from 'fs';
             fs.writeFile('image.png', base64Image, {
                 encoding: 'base64'
             }, function(err) {
                 console.log('File created');
             });
         } */
    </script>
@endpush
