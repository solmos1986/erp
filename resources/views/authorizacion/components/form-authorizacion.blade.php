<form id="form_autorizacion">
    <div class="row">
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
            <label class="mt-2 mb-1">Nombre completo:</label>
            <p id="nomUsuario">
            </p>
        </div>
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
            <label class="mt-2 mb-1">Nro Documento:</label>
            <p id="docUsuario">
            </p>
        </div>
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
            <div class="mb-3">
                <label class="form-label">Default</label>
                <select name="roles" id="roles" multiple>
                    <option value=""></option>
                </select>
            </div>
        </div>
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
            <label class="mt-2 mb-1">Telefono:</label>
            <p id="telUsuario">
            </p>
        </div>
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
            <label class="mt-2 mb-1">Email:</label>
            <p id="mailUsuario">
            </p>
        </div>
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
            <label class="mt-2 mb-1">Dirrecion:</label>
            <p id="dirUsuario">
            </p>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label for="simpleinput" class="form-label">Usuario</label>
                <input type="text" id="usuario" name="usuario" class="form-control">
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <div class="input-group input-group-merge">
                    <input type="password" id="contraseña" class="form-control" name="contraseña"
                        placeholder="Ingresa tu contraseña">
                    <div class="input-group-text" data-password="false">
                        <span class="password-eye"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
