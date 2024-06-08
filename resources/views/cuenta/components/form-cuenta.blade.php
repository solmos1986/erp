<form method="post" id="form_cuenta" novalidate>
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
            <input type="text" name="cuenta_id" id="cuenta_id" hidden>
            <label for="nomCliente" class="form-label">Codigo</label>
            <input type="text" class="form-control-sm form-control" id="codigo_cuenta" placeholder="Codigo"
                autocomplete="false" name="codigo_cuenta" readonly>
        </div>
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mt-2">
            <input type="text" name="padre_cuenta_id" id="padre_cuenta_id" hidden>
            <label for="nomCliente" class="form-label">Nombre cuenta</label>
            <input type="text" class="form-control-sm form-control" id="nombre_cuenta" placeholder="Nombre cuenta"
                autocomplete="false" name="nombre_cuenta">
        </div>
    </div>
</form>
