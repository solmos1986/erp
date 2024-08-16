<form id="form_autorizacion">
    <div class="row">
        <input type="text" id="authenticacion_id" name="authenticacion_id" hidden>
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
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
            <div class="mb-3">
                <label class="form-label">Selecione rol</label>
                <select class="form-control form-control-sm form-select form-select-sm" name="roles[]" id="roles"
                    multiple>
                    @foreach ($roles as $rol)
                        <option value="{{ $rol->rol_id }}">{{ $rol->nombre_rol }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label for="simpleinput" class="form-label">Usuario</label>
                <input type="text" class="form-control form-control-sm" id="usuario" name="usuario">
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <div class="input-group input-group-merge">
                    <input type="password" id="contraseña" class="form-control form-control-sm" name="contraseña"
                        placeholder="Ingresa tu contraseña" autocomplete="on">
                    <div class="input-group-text" style="padding: .1rem .3rem" data-password="false">
                        <span class="password-eye"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
