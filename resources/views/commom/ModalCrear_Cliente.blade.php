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
                                <label for="nomClientep" class="form-label">Nombre Cliente</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="nomClientep"
                                        placeholder="Ingrese Cliente" required name="nomClientep">
                                </div>
                            </div>
                            <div class="row mt-2">
                                <label for="docClientep" class="form-label">NIT / CI</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="docClientep"
                                        placeholder="No. Documento" required name="docClientep">
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
                                    <input type="text" class="form-control" id="tel2Cliente" placeholder="Telefono 2"
                                        required name="tel2Cliente">
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-12 mb-1">
                                    <label for="mailCliente" class="form-label">Correo Electronico</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="mailCliente" placeholder="E-mail"
                                            required name="mailCliente">
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
                    <button type="button" id="guardarCliente"
                        class="guardarCliente btn btn-info waves-effect waves-light">Guardar</button>
                </div>
            </div>
        </div>
    </div>

</div>
