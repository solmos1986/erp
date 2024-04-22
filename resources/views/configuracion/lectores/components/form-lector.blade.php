<form id="form_lector" class="needs-validation" novalidate>
    <div class="row">
        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mb-2">
            <label for="nomLector" class="form-label">Nombre Lector</label>
            <div class="input-group">
                <input type="text" class="form-control" id="idLector" hidden>
                <input type="text" class="form-control" id="nomLector" placeholder="Nombre Lector" name="nomLector">
            </div>
        </div>
        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mb-2">
            <label for="ipLector" class="form-label">Direccion IP</label>
            <div class="input-group">
                <input type="text" class="form-control" id="ipLector" placeholder="xxx.xxx.xxx.xxx" name="ipLector">
            </div>
        </div>
        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
            <label for="userLector" class="form-label">Usuario</label>
            <div class="input-group">
                <input type="text" class="form-control" id="userLector" placeholder="usuario" name="userLector">
            </div>
        </div>
        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
            <label for="passLector" class="form-label">Contraseña</label>
            <div class="input-group input-group-merge">
                <input type="password" id="passLector" class="form-control" name="passLector"
                    placeholder="Ingresa tu contraseña">
                <div class="input-group-text" data-passLector="false">
                    <span class="password-eye"></span>
                </div>
            </div>
        </div>
    </div>
</form>
