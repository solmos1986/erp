<form action="/" method="post" enctype="multipart/form-data" id="form_client" novalidate>
    <div class="row">
        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8">
            <div class="row">
                <input type="text" name="idCliente" id="idCliente" hidden>
                <label for="nomCliente" class="form-label">Nombre Cliente</label>
                <div class="input-group">
                    <input type="text" class="form-control" id="nomCliente" placeholder="Ingrese Cliente"
                        autocomplete="false" name="nomCliente">
                </div>
            </div>
            <div class="row mt-2">
                <label for="docCliente" class="form-label">NIT / CI</label>
                <div class="input-group">
                    <input type="text" class="form-control" id="docCliente" placeholder="No. Documento"
                        autocomplete="false" name="docCliente">
                </div>
            </div>
            <div class="row mt-2">
                <label for="tel1Cliente" class="form-label">Telefono 1 Cliente</label>
                <div class="input-group">
                    <input type="text" class="form-control" id="tel1Cliente" placeholder="Telefono 1"
                        autocomplete="false" name="tel1Cliente">
                </div>
            </div>
            <div class="row mt-2">
                <label for="tel2Cliente" class="form-label">Telefono 2 Cliente</label>
                <div class="input-group">
                    <input type="text" class="form-control" id="tel2Cliente" placeholder="Telefono 2"
                        autocomplete="false" name="tel2Cliente">
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-12 mb-1">
                    <label for="mailCliente" class="form-label">Correo Electronico</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="mailCliente" placeholder="E-mail"
                            autocomplete="false" name="mailCliente">
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-12 mb-1">
                    <label for="dirCliente" class="form-label">Direccion</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="dirCliente" placeholder="Direccion"
                            autocomplete="false" name="dirCliente">
                        <input type="text" class="form-control" id="base64" readonly value=""
                            autocomplete="false" name="base64">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="imagen-container">
                        <video id="webcam" autoplay playsinline width="355" style="width: 100%"></video>
                        <img width="355" style="width: 100%" id="foto_tomada" src="" alt="">
                        <input type="text" name="image" id="image" hidden>
                        <input type="file" name="file" id="file" accept="image/*" hidden>
                        <canvas id="canvas" class="d-none"></canvas>
                    </div>
                </div>
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="row pb-2">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <div class="form-check mb-2 form-check-primary">
                                <input class="form-check-input rounded-circle usar_camara" type="radio"
                                    value="usar_camara" name="input_file">
                                <label class="form-check-label" for="customckeck10">Usar camara</label>
                            </div>
                        </div>
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <button class="btn btn-primary capturar" id="capturar" type="button">
                                Tomar foto
                            </button>
                            <button class="btn btn-primary" id="cancelar" type="button">
                                Cancelar
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <div class="form-check mb-2 form-check-primary">
                                <input class="form-check-input rounded-circle subir_foto" type="radio"
                                    value="subir_foto" name="input_file">
                                <label class="form-check-label" for="customckeck10">Subir foto</label>
                            </div>
                        </div>
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <button class="btn btn-primary" id="subir_foto" type="button">
                                Subir foto
                            </button>
                            <button class="btn btn-primary" id="cancelar_subir_foto" type="button">
                                Cancelar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
