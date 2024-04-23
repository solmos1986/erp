<form action="/" method="post" enctype="multipart/form-data" id="form_client" novalidate>
    <div class="row">
        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8">
            <div class="row">
                <input type="text" name="idCliente" id="idCliente" hidden>
                <label for="nomCliente" class="form-label">Nombre Cliente</label>
                <div class="input-group">
                    <input type="text" class="form-control-sm form-control" id="nomCliente"
                        placeholder="Ingrese Cliente" autocomplete="false" name="nomCliente">
                </div>
            </div>
            <div class="row mt-2">
                <label for="docCliente" class="form-label">NIT / CI</label>
                <div class="input-group">
                    <input type="text" class="form-control-sm form-control" id="docCliente"
                        placeholder="No. Documento" autocomplete="false" name="docCliente">
                </div>
            </div>
            <div class="row mt-2">
                <label for="tel1Cliente" class="form-label">Telefono 1 Cliente</label>
                <div class="input-group">
                    <input type="text" class="form-control-sm form-control" id="tel1Cliente" placeholder="Telefono 1"
                        autocomplete="false" name="tel1Cliente">
                </div>
            </div>
            <div class="row mt-2">
                <label for="tel2Cliente" class="form-label">Telefono 2 Cliente</label>
                <div class="input-group">
                    <input type="text" class="form-control-sm form-control" id="tel2Cliente" placeholder="Telefono 2"
                        autocomplete="false" name="tel2Cliente">
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-12 mb-1">
                    <label for="mailCliente" class="form-label">Correo Electronico</label>
                    <div class="input-group">
                        <input type="text" class="form-control-sm form-control" id="mailCliente" placeholder="E-mail"
                            autocomplete="false" name="mailCliente">
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-12 mb-1">
                    <label for="dirCliente" class="form-label">Direccion</label>
                    <div class="input-group">
                        <input type="text" class="form-control-sm form-control" id="dirCliente"
                            placeholder="Direccion" autocomplete="false" name="dirCliente">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12" id="camara">
                    <div class="imagen-container">
                        <video id="webcam" autoplay playsinline width="355" style="width: 100%"></video>
                        <input type="text" name="image" id="image" hidden>
                        <canvas id="canvas" class="d-none"></canvas>
                    </div>
                </div>
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12" id="preview">
                    <input type="file" name="imagenCliente" id="imagenCliente" accept="image/*" data-height="355" />
                </div>
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="row">
                        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 p-1">
                            <button class="btn btn-sm btn-primary w-100" id="activar_camara" type="button">
                                Activar camara
                            </button>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 p-1">
                            <button class="btn btn-sm btn-secondary w-100" id="tomar_foto" type="button">
                                Tomar foto
                            </button>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 p-1">
                            <button class="btn btn-sm btn-danger w-100" id="cancelar" type="button">
                                Cancelar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
